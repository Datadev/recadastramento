<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriaTabelaArquivo extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('arquivo', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_recadastramento');
            $table->string('mime_type');
            $table->string('descricao');
            $table->string('dependente')->nullable();
            $table->text('conteudo');
            $table->string('arquivo');
            $table->timestamps();

            $table->foreign('id_recadastramento')
                    ->references('id')
                    ->on('recadastramento')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('arquivo');
    }

}
