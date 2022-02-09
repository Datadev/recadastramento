<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Laravel\Lumen\Routing\Controller;
use Ramsey\Uuid\Uuid;
use Spatie\Permission\Models\Role;
use function env;
use function iconv;
use function response;

class UsuarioController extends Controller {
    
    public const CONDICAO_SERVIDOR_ATIVO = "NOT EXISTS (
        SELECT
            1
        FROM 
            pessoal.rhpessoalmov pm
            INNER JOIN pessoal.rhpesrescisao pr ON pm.rh02_seqpes = pr.rh05_seqpes 
        WHERE
            pm.rh02_regist = p.rh01_regist
    )";
    
    const DEFAULT_ROLE = 'servidor';
    const EXPIRACAO_VALIDACAO_EM_HORAS = 4;
    

    public function gerarSenha(Request $request) {
        if ($this->isPodeGerarSenha($request->matricula, $request->cpf, $request->nascimento)) {
            $solicitacaoSenha = [
                'login' => $request->matricula,
                'nome' => $this->obterNomeEC($request->matricula),
                'email' => $request->email,
                'senha' => Hash::make($request->senha),
                'validado' => false,
                'validacao' => Uuid::uuid4(),
                'expiracao_validacao' => Carbon::now()->addHours(UsuarioController::EXPIRACAO_VALIDACAO_EM_HORAS),
            ];

            $usuario = User::where('login', $request->matricula)->first();
            if (is_null($usuario)) {
                $usuario = User::create($solicitacaoSenha);
                $perfil = Role::findByName(UsuarioController::DEFAULT_ROLE);
                $usuario->assignRole($perfil);
            } else {
                $usuario->fill($solicitacaoSenha);
                $usuario->save();
            }

            $solicitacaoSenha['senha'] = $request->senha;

            Mail::send('link-validacao', $solicitacaoSenha, function ($message) use ($solicitacaoSenha) {
                $message
                        ->to($solicitacaoSenha['email'])
                        ->subject('Validação ' . env('APP_NAME'));
            });
            return response()->json(['message' => 'Sucesso'], 200);
        } else {
            return response()->json(['message' => 'Não foi possível validar seus dados'], 400);
        }
    }

    public function buscarPorId($idUsuario) {
        return response()->json(User::where('id', $idUsuario)->first());
    }

    public function alterarPerfil(Request $request, $idUsuario) {
        $perfil = $request->perfil;
        if ($perfil === 'administrador') {
            return response()->json(['message' => 'Não é possível atribuir o perfil de administrador'], 400);
        }
        $user = User::where('id', $idUsuario)->first();
        $user->syncRoles([$perfil]);
        return response()->json(['message' => 'Sucesso'], 200);
    }

    public function listar(Request $request) {
        $filter = $request->filter;
        $orderBy = Str::snake($request->order_by ?? 'nome');
        $sortOrder = $request->sort_order ?? 'asc';
        $page = $request->page ?? 0;
        $per_page = $request->per_page ?? 10;

        $retorno = User::query()
                ->when($filter, function($q) use ($filter) {
                    return $q->where(function($query) use ($filter) {
                        $query
                        ->orWhereRaw('lower(login) like ?', ['%' . strtolower($filter) . '%'])
                        ->orWhereRaw('lower(nome)  like ?', ['%' . strtolower($filter) . '%'])
                        ->orWhereRaw('lower(email) like ?', ['%' . strtolower($filter) . '%']);
                    });
                })
                ->orderBy($orderBy, $sortOrder)
                ->paginate($per_page, ['*'], 'page', $page);
        return response()->json($retorno);
    }

    public function validarAcesso(Request $request) {
        $usuario = User::where('validacao', $request->validacao)
                ->where('expiracao_validacao', '>=', Carbon::now())
                ->first();

        if (is_null($usuario)) {
            return response()->json(['message' => 'Não foi possível validar seu acesso'], 400);
        } else {
            $alteracoes = [
                'validado' => true,
                'validacao' => null,
                'expiracao_validacao' => null
            ];

            $usuario->fill($alteracoes);
            $usuario->save();

            Mail::send('usuario-validado', ['login' => $usuario->login], function ($message) use ($usuario) {
                $message
                        ->to($usuario->email)
                        ->subject('Ativação ' . env('APP_NAME'));
            });
            return response()->json(['message' => 'Sucesso'], 200);
        }
    }

    private function isPodeGerarSenha($matricula, $cpf, $nascimento): bool {      
        $resultado = DB::connection('ecidade')->select("
            SELECT
                p.rh01_regist,
                c.z01_nome,
                p.rh01_nasc,
                c.z01_cgccpf,
                p.rh01_numcgm
            FROM 
                pessoal.rhpessoal p
                INNER JOIN protocolo.cgm c ON p.rh01_numcgm = c.z01_numcgm 
                INNER JOIN pessoal.rhpessoalmov pm1 ON pm1.rh02_regist = p.rh01_regist
                LEFT JOIN pessoal.rhpessoalmov pm2 ON (pm2.rh02_regist = p.rh01_regist AND pm1.rh02_seqpes < pm2.rh02_seqpes)
                LEFT JOIN pessoal.rhpesrescisao pr ON pm1.rh02_seqpes = pr.rh05_seqpes 
            WHERE 
                pm2.rh02_seqpes IS NULL
                AND pr.rh05_seqpes IS NULL
                AND p.rh01_regist = :matricula
                AND p.rh01_nasc = :nascimento
                AND c.z01_cgccpf = :cpf", [
            'matricula' => $matricula,
            'nascimento' => $nascimento,
            'cpf' => $cpf
        ]);
        return sizeof($resultado) > 0;
    }

    private function obterNomeEC($matricula): string {
        $resultado = DB::connection('ecidade')->select('
            SELECT
                c.z01_nome
            FROM 
                pessoal.rhpessoal p
                INNER JOIN protocolo.cgm c ON p.rh01_numcgm = c.z01_numcgm 
            WHERE 
                p.rh01_regist = :matricula',
                ['matricula' => $matricula]);
        return sizeof($resultado) > 0 ? iconv("ISO-8859-1", "UTF-8//TRANSLIT", $resultado[0]->z01_nome) : '';
    }
}
