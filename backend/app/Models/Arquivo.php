<?php

namespace App\Models;

use Eloquence\Behaviours\CamelCasing;
use Illuminate\Database\Eloquent\Model;

/**
 * Description of Arquivo
 *
 * @author fabricio
 */
class Arquivo extends Model {

    use CamelCasing;
    
    protected $table = 'arquivo';
    protected $fillable = ['id_recadastramento', 'mimeType', 'descricao', 'dependente','conteudo', 'arquivo'];
    protected $hidden = ['conteudo'];
}
