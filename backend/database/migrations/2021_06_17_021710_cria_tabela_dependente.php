<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriaTabelaDependente extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('dependente', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_recadastramento');
            $table->string('nome', 256);
            $table->date('nascimento');
            $table->string('cpf', 20);
            $table->string('parentesco', 1);
            $table->string('irf', 1);
            $table->string('sexo', 1);
            $table->timestamps();

            $table->foreign('id_recadastramento')
                    ->references('id')
                    ->on('recadastramento')
                    ->onDelete('cascade');

            $table->unique(['id_recadastramento', 'cpf']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('dependente');
    }

}
