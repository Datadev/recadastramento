<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdministradorSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        /** @var User $usuario */
        $usuario = User::create([
                    'login' => 'admin',
                    'nome' => 'Administrador',
                    'senha' => Hash::make('123'),
                    'email' => 'teste@teste.com',
                    'validado' => true,
        ]);

        $perfil = Role::findByName('administrador');

        $usuario->assignRole($perfil);
    }

}
