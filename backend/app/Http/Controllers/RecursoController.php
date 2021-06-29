<?php

namespace App\Http\Controllers;

use App\Models\RoleComRecurso;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Lumen\Routing\Controller;
use function response;

class RecursoController extends Controller {
    
    public function listarRecursosDoUsuario() {
        /** @var User $usuario */
        $usuario = Auth::user();
        
        $recursos = [];
        
        foreach ($usuario->roles as $role) {
            /** @var RoleComRecurso $roleComRecurso */
            $roleComRecurso = RoleComRecurso::where('name', $role->name)->first();
            $recursos = array_unique(array_merge($recursos, $roleComRecurso->recursos->all()));
        }
        array_multisort(array_column($recursos, 'router_link'), SORT_ASC, $recursos);
        return response()->json($recursos, 200);
    }
}
