<?php

namespace App\Models;

use Spatie\Permission\Models\Role;

class RoleComRecurso extends Role {
    
    public function recursos() {
        return $this->belongsToMany(Recurso::class, 'role_recurso', 'id_role', 'id_recurso');
    }
}
