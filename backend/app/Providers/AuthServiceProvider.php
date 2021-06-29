<?php

namespace App\Providers;

use App\Http\Controllers\TokenController;
use App\Models\User;
use Exception;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use function env;

class AuthServiceProvider extends ServiceProvider {

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot() {
        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.

        $this->app['auth']->viaRequest('api', function (Request $request) {
            try {
                $tokenController = new TokenController();
                $token = $tokenController->obterTokenDoCabecalho($request);
                if ($tokenController->validarToken($token)) {
                    $dados = JWT::decode($token, env('JWT_KEY'), ['HS256']);
                    if ($dados->token === 'access') {
                        return User::where('id', $dados->sub)->first();
                    }
                }
            } catch (Exception $ex) {

            }
            return null;
        });
    }

}
