<?php

namespace App\Http\Controllers;

use App\Models\TokenRevogado;
use App\Models\User;
use DomainException;
use Exception;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\SignatureInvalidException;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Lumen\Routing\Controller;
use UnexpectedValueException;
use function env;
use function response;

/**
 * Description of TokenController
 *
 * @author fabricio
 */
class TokenController extends Controller {

    public function gerarToken(Request $request) {
        $this->validate($request, [
            'login' => 'required',
            'senha' => 'required'
        ]);

        /** @var User $usuario */
        $usuario = User::where('login', $request->login)->first();

        if (is_null($usuario) || !Hash::check($request->senha, $usuario->senha) || !$usuario->validado) {
            return response()->json(['message' => 'Não possível acessar. Os dados estão corretos?'], 401);
        }

        $accessToken = $this->gerarAccessToken($usuario);
        $refreshToken = $this->gerarRefreshToken($usuario);

        $usuario
                ->fill(['ultimo_login' => Carbon::now()])
                ->save();
        
        return [
            'access_token' => $accessToken,
            'expires_in' => env('JWT_ACCESS_TTL'),
            'refresh_token' => $refreshToken
        ];
    }

    public function revogarToken(Request $request) {
        $accessToken = $this->obterTokenDoCabecalho($request);
        $refreshToken = $request->refresh_token;

        try {
            $dadosAccessToken = JWT::decode($accessToken, env('JWT_KEY'), ['HS256']);
            $dadosRefreshToken = JWT::decode($refreshToken, env('JWT_KEY'), ['HS256']);
        } catch (Exception $ex) {
            return response()->json(['message' => 'Falha ao ler token'], 400);
        }

        if ($this->validarToken($refreshToken) && strval(Auth::user()->id) === strval($dadosRefreshToken->sub) && $dadosRefreshToken->token === 'refresh') {
            TokenRevogado::create([
                'tipo' => TokenRevogado::TIPO_ACCESS_TOKEN,
                'token' => $accessToken,
                'expiracao' => $dadosAccessToken->exp
            ]);

            TokenRevogado::create([
                'tipo' => TokenRevogado::TIPO_REFRESH_TOKEN,
                'token' => $refreshToken,
                'expiracao' => $dadosRefreshToken->exp
            ]);

            return response()->json(['message' => 'Sucesso'], 200);
        } else {           
            return response()->json(['message' => 'Token inválido'], 400);
        }
    }

    public function validarToken($token): bool {
        if (is_null($token)) {
            return false;
        }
        try {
            JWT::decode($token, env('JWT_KEY'), ['HS256']);
        } catch (DomainException | ExpiredException | SignatureInvalidException | UnexpectedValueException | Exception $ex) {
            return false;
        }
        if ($this->isTokenRevogado($token)) {
            return false;
        }
        if ($this->isUsuarioAlteradoAposToken($token)) {
            return false;
        }
        return true;
    }

    public function atualizarToken(Request $request) {
        try {
            $refreshToken = $request->refresh_token;
            if (!$this->validarToken($refreshToken)) {
                throw new \Exception('Token inválido');
            }

            $dadosRefreshToken = JWT::decode($refreshToken, env('JWT_KEY'), ['HS256']);
            if ($dadosRefreshToken->token !== 'refresh') {
                throw new \Exception('Token não é refresh');
            }
            
            TokenRevogado::create([
                'tipo' => TokenRevogado::TIPO_REFRESH_TOKEN,
                'token' => $refreshToken,
                'expiracao' => $dadosRefreshToken->exp
            ]);

            $usuario = User::where('id', $dadosRefreshToken->sub)->first();
            $novoAccessToken = $this->gerarAccessToken($usuario);
            $novoRefreshToken = $this->gerarRefreshToken($usuario);

            return [
                'access_token' => $novoAccessToken,
                'expires_in' => env('JWT_ACCESS_TTL'),
                'refresh_token' => $novoRefreshToken
            ];
        } catch (\Exception $ex) {
            return response()->json(['message' => 'Token inválido'], 400);
        }
    }

    public function isTokenRevogado($token): bool {
        /** @var TokenRevogado $tokenRevogado */
        $tokenRevogado = TokenRevogado::where('token', $token)->first();
        return !is_null($tokenRevogado);
    }

    public function isUsuarioValidado($token): bool {
        $dados = JWT::decode($token, env('JWT_KEY'), ['HS256']);
        
        /** @var User $usuario */
        $usuario = User::where('id', $dados->sub)->first();
        return !is_null($usuario) && ($usuario->validado);
    }
    
    public function isUsuarioAlteradoAposToken($token): bool {
        $dados = JWT::decode($token, env('JWT_KEY'), ['HS256']);

        /** @var User $usuario */
        $usuario = User::where('id', $dados->sub)->first();
        return !is_null($usuario) && ($dados->iat > $usuario->updateAtTimestamp);
    }

    public function obterTokenDoCabecalho(Request $request): string {
        if (!$request->hasHeader('Authorization')) {
            throw new Exception('Não há cabeçalho de autorização na requisição');
        }
        $authorizationHeader = $request->header('Authorization');
        return str_replace('Bearer ', '', $authorizationHeader);
    }

    private function gerarAccessToken(User $usuario): string {
        $payload = [
            'iss' => env('APP_URL'),
            'sub' => $usuario->id,
            'iat' => time(),
            'exp' => time() + env('JWT_ACCESS_TTL'),
            'token' => 'access',
            'login' => $usuario->login,
            'roles' => $usuario->getRoleNames(),
        ];
        return JWT::encode($payload, env('JWT_KEY'));
    }

    private function gerarRefreshToken(User $usuario): string {
        $payload = [
            'iss' => env('APP_URL'),
            'sub' => $usuario->id,
            'iat' => time(),
            'exp' => time() + env('JWT_REFRESH_TTL'),
            'token' => 'refresh',
        ];
        return JWT::encode($payload, env('JWT_KEY'));
    }

}
