<?php

namespace App\Models;

use Eloquence\Behaviours\CamelCasing;
use OwenIt\Auditing\Auditable as Auditable2;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Description of Recadastramento
 *
 * @author fabricio
 */
class Escolaridade extends BaseModel implements Auditable {

    use Auditable2;
    use CamelCasing;

    public const GRAU_INSTRUCAO = [
        1 => [
            'descricao' => 'ANALFABETO, INCLUSIVE, EMBORA INSTRUIDO',
        ],
        2 => [
            'descricao' => 'ATÉ O 5º ANO INCOMPLETO/ANTIGA 4ª SÉRIE',
        ],
        3 => [
            'descricao' => '5º ANO COMPLETO DO ENSINO FUNDAMENTAL',
        ],
        4 => [
            'descricao' => 'DO 6º AO 9º ANO DO ENSINO FUNDAMENTAL',
        ],
        5 => [
            'descricao' => 'ENSINO FUNDAMENTAL COMPLETO',
        ],
        6 => [
            'descricao' => 'ENSINO MÉDIO INCOMPLETO',
        ],
        7 => [
            'descricao' => 'ENSINO MÉDIO COMPLETO',
        ],
        8 => [
            'descricao' => 'EDUCAÇÃO SUPERIOR INCOMPLETA',
            'habilita' => 'SUPERIOR',
        ],
        9 => [
            'descricao' => 'EDUCAÇÃO SUPERIOR COMPLETA',
            'habilita' => 'SUPERIOR',
        ],
        12 => [
            'descricao' => 'PÓS GRADUACAO',
            'habilita' => 'SUPERIOR|POS'
        ],
        10 => [
            'descricao' => 'MESTRADO COMPLETO',
            'habilita' => 'SUPERIOR|POS|MESTRADO'
        ],
        11 => [
            'descricao' => 'DOUTORADO COMPLETO',
            'habilita' => 'SUPERIOR|POS|MESTRADO|DOUTORADO',
        ],
    ];
    
    protected $table = 'escolaridade';
    protected $fillable = ['idRecadastramento', 'curso', 'anoConclusao', 'tipo'];
    protected $nullable = ['anoConclusao'];
}
