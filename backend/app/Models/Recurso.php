<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class Recurso extends Model {

    protected $table = 'recurso';
    protected $fillable = ['router_link', 'descricao'];

    /**
     * The attributes that should be visible in arrays.
     *
     * @var array
     */
    protected $visible = ['router_link', 'descricao'];
    
    public function roles() {
        return $this->belongsToMany(Role::class, 'role_recurso', 'id_recurso', 'id_role');
    }

}
