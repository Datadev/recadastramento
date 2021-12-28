<?php

use Laravel\Lumen\Routing\Router;

/** @var Router $router */
/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It is a breeze. Simply tell Lumen the URIs it should respond to
  | and give it the Closure to call when that URI is requested.
  |
 */
$router->group(['prefix' => 'auth'], function () use ($router) {
    $router->post('login', 'TokenController@gerarToken');
    $router->post('refresh', 'TokenController@atualizarToken');
    $router->post('gerar-senha', 'UsuarioController@gerarSenha');
    $router->post('validacao', 'UsuarioController@validarAcesso');
});

$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->group(['prefix' => 'auth'], function () use ($router) {
        $router->post('logout', 'TokenController@revogarToken');
        $router->get('recursos', 'RecursoController@listarRecursosDoUsuario');
    });
    $router->get('config', 'ConfiguracaoController@getConfiguracaoList');
    $router->group(['prefix' => 'recadastramento'], function () use ($router) {
        $router->group(['middleware' => ['role:servidor|validador']], function () use ($router) {
            $router->post('', 'RecadastramentoController@criar');
            $router->get('', 'RecadastramentoController@listar');
        });
        $router->group(['middleware' => ['role:validador']], function () use ($router) {
            $router->get('download', 'RecadastramentoController@download');
            $router->post('email', 'RecadastramentoController@email');
            $router->get('{idRecadastramento}', 'RecadastramentoController@buscarPorId');
            $router->patch('{idRecadastramento}', 'RecadastramentoController@alterarSituacao');
            $router->get('{idRecadastramento}/dependente', 'RecadastramentoController@listarDependente');
            $router->get('{idRecadastramento}/escolaridade', 'RecadastramentoController@listarEscolaridade');
            $router->get('{idRecadastramento}/arquivo', 'RecadastramentoController@listarArquivo');
            $router->get('{idRecadastramento}/arquivo/{idArquivo}', 'RecadastramentoController@buscarArquivoPorId');
        });
    });
    $router->group(['prefix' => 'campanha'], function () use ($router) {
        $router->group(['middleware' => ['role:servidor|validador']], function () use ($router) {
            $router->get('', 'CampanhaController@listar');
        });
        $router->group(['middleware' => ['role:validador']], function () use ($router) {
            $router->post('', 'CampanhaController@criar');
            $router->get('{idCampanha}', 'CampanhaController@buscarPorId');
            $router->put('{idCampanha}', 'CampanhaController@alterarPorId');
        });
    });
    $router->group(['middleware' => ['role:administrador']], function () use ($router) {
        $router->group(['prefix' => 'usuario'], function () use ($router) {
            $router->get('', 'UsuarioController@listar');
            $router->get('{idUsuario}', 'UsuarioController@buscarPorId');
            $router->patch('{idUsuario}', 'UsuarioController@alterarPerfil');
        });
    });
});


