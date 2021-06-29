<?php

namespace App\Models;

use DateTime;
use Eloquence\Behaviours\CamelCasing;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
use OwenIt\Auditing\Auditable as Auditable2;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\Permission\Traits\HasRoles;

class User extends Model implements AuthenticatableContract, AuthorizableContract, Auditable {

    use Auditable2,
        Authenticatable,
        Authorizable,
        CamelCasing,
        HasFactory,
        HasRoles;

    protected $guard_name = 'api';
    protected $table = 'usuario';

    public const ROLE_ADMINISTRADOR = 'administrador';
    public const ROLE_SERVIDOR = 'servidor';
    public const ROLE_VALIDADOR = 'validador';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'login', 'nome', 'email', 'senha', 'validacao', 'validado', 'expiracao_validacao', 'ultimo_login'
    ];
    protected $appends = ['updateAtTimestamp', 'perfis'];
    protected $auditExclude = [
        'senha',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'senha', 'validacao', 'expiracao_validacao',
    ];

    public function getUpdateAtTimestampAttribute() {
        $datetime = new DateTime($this->updateAt);
        return $datetime->getTimestamp();
    }

    public function getPerfisAttribute() {
        return $this->getRoleNames();
    }

}
