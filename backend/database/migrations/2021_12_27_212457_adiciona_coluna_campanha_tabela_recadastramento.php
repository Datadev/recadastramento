<?php

use App\Models\Campanha;
use App\Models\Recadastramento;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class AdicionaColunaCampanhaTabelaRecadastramento extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('recadastramento', function ($table) {
            $table->unsignedBigInteger('id_campanha')->nullable(true);
            $table->foreign('id_campanha')->references('id')->on('campanha');
        });
        
        $campanha = Campanha::where('id', '>', 0)->first();
        Recadastramento::where('id', '>', 0)->update(['id_campanha' => $campanha->id]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('recadastramento', function ($table) {
            $table->dropForeign(['id_campanha']);
            $table->dropColumn('id_campanha');
        });
    }

}
