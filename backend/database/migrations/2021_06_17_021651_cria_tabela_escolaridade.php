<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriaTabelaEscolaridade extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('escolaridade', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_recadastramento');
            $table->string('curso', 256);
            $table->integer('ano_conclusao')->nullable();
            $table->string('tipo', 20);
            $table->timestamps();

            $table->foreign('id_recadastramento')
                    ->references('id')
                    ->on('recadastramento')
                    ->onDelete('cascade');

            $table->unique(['id_recadastramento', 'tipo']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('escolaridade');
    }

}
