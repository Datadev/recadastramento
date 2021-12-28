<?php

use App\Models\Recurso;
use App\Models\RoleComRecurso;
use Illuminate\Database\Migrations\Migration;

class IncluiRecursoCampanha extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        $recursoCampanhas = Recurso::create([
                    'router_link' => 'campanhas',
                    'descricao' => 'Campanhas',
        ]);
        $this->associarRecursosComRole('validador', [
            $recursoCampanhas,
        ]);
    }
    
    private function associarRecursosComRole(string $roleName = '', $recursos = []) {
        /** @var RoleComRecurso $role */
        $role = RoleComRecurso::where('name', $roleName)->first();
        if (!is_null($role)) {
            /** @var Recurso $recurso */
            foreach ($recursos as $recurso) {
                $role->recursos()->attach($recurso->id);
            }
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
