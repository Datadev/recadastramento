<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriaTabelaRecadastramento extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('recadastramento', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('matricula');
            $table->string('nome', 256);
            $table->string('sexo', 1);
            $table->unsignedBigInteger('estado_civil');
            $table->string('pai', 256);
            $table->string('mae', 256);
            $table->date('nascimento');
            $table->string('telefone', 20);
            $table->string('email', 100);
            $table->string('endereco', 256);
            $table->string('numero', 20);
            $table->string('complemento', 20)->nullable();
            $table->string('bairro', 256);
            $table->string('cidade', 256);
            $table->unsignedBigInteger('uf');
            $table->string('cep', 20);
            $table->string('cpf', 20);
            $table->string('pis', 20);
            $table->string('rg', 20);
            $table->date('expedicao_rg');
            $table->string('orgao_rg', 20);
            $table->boolean('possui_ctps');
            $table->string('numero_ctps', 20)->nullable();
            $table->string('digito_ctps', 1)->nullable();
            $table->string('serie_ctps', 20)->nullable();
            $table->date('expedicao_ctps')->nullable();
            $table->string('uf_ctps', 5)->nullable();
            $table->boolean('possui_cnh');
            $table->string('numero_cnh', 20)->nullable();
            $table->date('validade_cnh')->nullable();
            $table->date('emissao_cnh', 20)->nullable();
            $table->string('categoria_cnh', 3)->nullable();
            $table->string('numero_te', 20);
            $table->string('zona_te', 10);
            $table->string('secao_te', 10);
            $table->unsignedBigInteger('grau_instrucao');
            $table->string('codigo');
            $table->string('situacao', 20);
            $table->text('motivo_situacao')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('recadastramento');
    }

}
