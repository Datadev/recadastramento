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
class Recadastramento extends BaseModel implements Auditable {

    use Auditable2;
    use CamelCasing;
    
    public const CAMPOS_RECADASTRAMENTO = [
      'created_at' => 'Data',
      'matricula' => 'Matrícula',
      'codigo' => 'Protocolo',
      'situacao' => 'Situação',
    ];

    public const SITUACAO_RECADASTRAMENTO = [
        'A' => 'Aprovado',
        'P' => 'Pendente',
        'R' => 'Recusado',
        'S' => 'Somente recusados',
        'N' => 'Não realizado'
    ];
    
    protected $table = 'recadastramento';
    protected $fillable = ['matricula', 'sexo', 'estadoCivil','nome', 'pai', 'mae', 'nascimento', 'telefone', 'email', 'endereco', 'numero', 'complemento',
        'bairro', 'cidade', 'uf', 'cep', 'cpf', 'pis', 'rg', 'expedicaoRg', 'orgaoRg', 'possuiCtps', 'numeroCtps', 'digitoCtps', 'serieCtps', 'expedicaoCtps', 
        'ufCtps', 'possuiCnh', 'numeroCnh', 'validadeCnh', 'emissaoCnh', 'categoriaCnh', 'numeroTe', 'zonaTe', 'secaoTe', 'grauInstrucao', 'codigo', 'situacao', 'motivoSituacao', 'idCampanha'];
    
    public function getPossuiCtpsAttribute($value) {
        return $value ? 'S' : 'N';
    }
    
    public function setPossuiCtpsAttribute($value) {
        $this->attributes['possui_ctps'] = $value == 'S' ? true : false;
    }
    
    public function getPossuiCnhAttribute($value) {
        return $value ? 'S' : 'N';
    }
    
    public function setPossuiCnhAttribute($value) {
        $this->attributes['possui_cnh'] = $value == 'S' ? true : false;
    }
}
