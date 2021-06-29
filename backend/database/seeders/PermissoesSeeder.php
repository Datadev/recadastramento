<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use function app;

class PermissoesSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $this->criarPermissoes();
        $this->criarPerfis();
    }

    private function criarPermissoes() {
        Permission::create(['name' => 'criar-meu-recadastramento']);
        Permission::create(['name' => 'listar-recadastramento']);
        Permission::create(['name' => 'ler-recadastramento']);
        Permission::create(['name' => 'validar-recadastramento']);

        Permission::create(['name' => 'listar-usuario']);
        Permission::create(['name' => 'ler-usuario']);
        Permission::create(['name' => 'atualizar-usuario']);
    }

    private function criarPerfis() {
        // create roles and assign existing permissions
        /** @var Role $administrador */
        $administrador = Role::create(['name' => 'administrador']);
        $administrador->givePermissionTo('listar-usuario');
        $administrador->givePermissionTo('ler-usuario');
        $administrador->givePermissionTo('atualizar-usuario');

        /** @var Role $validador */
        $validador = Role::create(['name' => 'validador']);
        $validador->givePermissionTo('criar-meu-recadastramento');
        $validador->givePermissionTo('listar-recadastramento');
        $validador->givePermissionTo('ler-recadastramento');
        $validador->givePermissionTo('validar-recadastramento');

        /** @var Role $servidor */
        $servidor = Role::create(['name' => 'servidor']);
        $servidor->givePermissionTo('criar-meu-recadastramento');
    }

}
