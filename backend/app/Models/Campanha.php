<?php

namespace App\Models;

use Eloquence\Behaviours\CamelCasing;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable as Auditable2;
use OwenIt\Auditing\Contracts\Auditable;

class Campanha extends Model implements Auditable {

    use Auditable2;
    use CamelCasing;

    protected $table = 'campanha';
    protected $fillable = ['descricao', 'inicio', 'fim', 'ativo'];

    public function meses() {
        return $this->hasMany(CampanhaMes::class, 'id_campanha');
    }

}
