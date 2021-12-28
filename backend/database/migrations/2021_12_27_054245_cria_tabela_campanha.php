<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriaTabelaCampanha extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('campanha', function (Blueprint $table) {
            $table->id();
            $table->string('descricao');
            $table->date('inicio');
            $table->date('fim');
            $table->string('ativo', 1);
            $table->timestamps();
        });
        Schema::create('campanha_mes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_campanha');
            $table->integer('mes');
            $table->timestamps();
            
            $table->foreign('id_campanha')
                    ->references('id')
                    ->on('campanha')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('campanha_mes');
        Schema::dropIfExists('campanha');
    }

}
