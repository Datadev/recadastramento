<?php

namespace App\Models;

use Eloquence\Behaviours\CamelCasing;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable as Auditable2;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Description of Dependente
 *
 * @author fabricio
 */
class Dependente extends Model implements Auditable {

    use Auditable2;
    use CamelCasing;

    public const CONDICAO_ESPECIAL_DEPENDENTE = [
        'N' => 'Não Dependente',
        'C' => 'Cálculo',
        'S' => 'Sempre Dependente',
    ];
    public const GRAU_PARENTESCO = [
        'C' => 'Cônjuge',
        'F' => 'Filho',
        'P' => 'Pai',
        'M' => 'Mãe',
        'A' => 'Avó (ô)',
        'O' => 'Outros',
    ];
    public const IRF = [
        0 => 'Não Dependente',
        1 => 'Cônjuge',
        2 => 'Filho(a) até 21 anos',
        3 => 'Filho(a) ou enteado(a) até 24 anos em curso universitário ou técnico de segundo grau',
        4 => 'Irmão(ã), neto(a), bisneto(a) até 21 anos',
        5 => 'Irmão(ã), neto(a), bisneto(a), com 21 à 24 anos',
        6 => 'Pais ,avós, bisavós',
        7 => 'Menor pobre até 21 anos',
        8 => 'Absolutamente incapaz',
    ];

    protected $table = 'dependente';
    protected $fillable = ['id_recadastramento', 'nome', 'nascimento', 'cpf', 'parentesco', 'irf', 'sexo'];

}
