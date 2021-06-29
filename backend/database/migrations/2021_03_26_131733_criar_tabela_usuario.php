<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriarTabelaUsuario extends Migration {

    private $tabela = 'usuario';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        if (!Schema::hasTable($this->tabela)) {
            Schema::create($this->tabela, function (Blueprint $table) {
                $table->id();
                $table->string('login')->unique();
                $table->string('nome');
                $table->string('senha');
                $table->string('email');
                $table->boolean('validado')->default(false);
                $table->string('validacao')->nullable();
                $table->dateTime('expiracao_validacao')->nullable();
                $table->dateTime('ultimo_login')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists($this->tabela);
    }

}
