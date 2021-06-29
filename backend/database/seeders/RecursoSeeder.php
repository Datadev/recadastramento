<?php

namespace Database\Seeders;

use App\Models\Recurso;
use App\Models\RoleComRecurso;
use Illuminate\Database\Seeder;

class RecursoSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $this->criarRecursos();
    }

    private function criarRecursos() {
        $recursoRecadastramentos = Recurso::create([
                    'router_link' => 'recadastramentos',
                    'descricao' => 'Recadastramentos',
        ]);

        $recursoRecadastramentosNovo = Recurso::create([
                    'router_link' => 'recadastramentos/novo',
                    'descricao' => 'Novo recadastramento',
        ]);

        $recursoUsuarios = Recurso::create([
                    'router_link' => 'usuarios',
                    'descricao' => 'Usuários',
        ]);

        $this->associarRecursosComRole('administrador', [
            $recursoUsuarios,
        ]);

        $this->associarRecursosComRole('validador', [
            $recursoRecadastramentos,
            $recursoRecadastramentosNovo,
        ]);

        $this->associarRecursosComRole('servidor', [
            $recursoRecadastramentosNovo,
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

}
