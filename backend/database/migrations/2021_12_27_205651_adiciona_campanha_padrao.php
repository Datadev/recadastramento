<?php

use App\Models\Campanha;
use App\Models\CampanhaMes;
use Illuminate\Database\Migrations\Migration;

class AdicionaCampanhaPadrao extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        $campanha = Campanha::create([
                    'descricao' => 'Campanha padrão',
                    'inicio' => '2000-01-01',
                    'fim' => '2100-12-31',
                    'ativo' => 'S',
        ]);
        $campanha->save();
        for ($cont = 1; $cont <= 12; $cont++) {
            CampanhaMes::create([
                        'id_campanha' => $campanha->id,
                        'mes' => $cont,
                    ])
                    ->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        //
    }

}
