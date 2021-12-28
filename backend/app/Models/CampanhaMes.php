<?php

namespace App\Models;

use Eloquence\Behaviours\CamelCasing;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable as Auditable2;
use OwenIt\Auditing\Contracts\Auditable;

class CampanhaMes extends Model implements Auditable {

    use Auditable2;
    use CamelCasing;

    protected $table = 'campanha_mes';
    protected $fillable = ['id_campanha', 'mes'];
    protected $visible = ['mes'];

    public function campanha() {
        return $this->belongsTo(Campanha::class, 'id_campanha');
    }

}
