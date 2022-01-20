<?php

namespace App\Http\Controllers;

use App\Models\Dependente;
use App\Models\Escolaridade;
use App\Models\Recadastramento;
use Illuminate\Support\Facades\DB;
use Laravel\Lumen\Routing\Controller;
use PDO;
use function dd;
use function response;

/**
 * Description of ConfiguracaoController
 *
 * @author fabricio
 */
class ConfiguracaoController extends Controller {

    public const ESTADO_CIVIL = [
        1 => 'SOLTEIRO',
        2 => 'CASADO',
        3 => 'VIUVO',
        4 => 'SEP. CONSENSUAL',
        5 => 'DIVORCIADO',
        6 => 'UNIÃO ESTÁVEL',
    ];
    public const MESES = [
        1 => 'Janeiro',
        2 => 'Fevereiro',
        3 => 'Março',
        4 => 'Abril',
        5 => 'Maio',
        6 => 'Junho',
        7 => 'Julho',
        8 => 'Agosto',
        9 => 'Setembro',
        10 => 'Outubro',
        11 => 'Novembro',
        12 => 'Dezembro',
    ];
    public const PERFIS = [
        'administrador' => 'Administrador',
        'validador' => 'Validador',
        'servidor' => 'Servidor',
    ];
    public const SEXO = [
        'F' => 'Feminino',
        'M' => 'Masculino',
    ];
    public const SIMNAO = [
        'S' => 'Sim',
        'N' => 'Não',
    ];
    public const UF = [
        21 => 'RS',
        1 => 'AC',
        2 => 'AL',
        3 => 'AP',
        4 => 'AM',
        5 => 'BA',
        6 => 'CE',
        7 => 'DF',
        8 => 'ES',
        9 => 'GO',
        10 => 'MA',
        11 => 'MT',
        12 => 'MS',
        13 => 'MG',
        14 => 'PA',
        15 => 'PB',
        16 => 'PR',
        17 => 'PE',
        18 => 'PI',
        19 => 'RJ',
        20 => 'RN',
        21 => 'RS',
        22 => 'RO',
        23 => 'RR',
        24 => 'SC',
        25 => 'SP',
        26 => 'SE',
        27 => 'TO',
    ];
    
    public function getTipoContrato(): array {
        DB::connection('ecidade')->beginTransaction();
        DB::connection('ecidade')->select("SET NAMES 'utf8'");
        $resultado = DB::connection('ecidade')->select("
            SELECT 
                c.h13_codigo as chave,
                '(' || r.rh127_descricao || ') ' || c.h13_descr as valor
            FROM 
                recursoshumanos.tpcontra c
                INNER JOIN pessoal.regimeprevidencia r ON c.h13_regime = r.rh127_sequencial
            ORDER BY
                c.h13_codigo ASC;
        ");
        DB::connection('ecidade')->commit();
//        $array = (array) $resultado;
//        return array_map(array($this, 'encode_all_strings'), $array);
        return $resultado;
    }
    
    private function encode_all_strings($arr) {
        foreach($arr as $key => $value) {
            $arr[$key] = $value;
        }
        return $arr;
    }


    public function getConfiguracaoList() {
        $config = [
            'condicaoEspecialDependente' => $this->converterChaveValor(Dependente::CONDICAO_ESPECIAL_DEPENDENTE),
            'estadoCivil' => $this->converterChaveValor(self::ESTADO_CIVIL),
            'grauInstrucao' => $this->converterChaveValor(Escolaridade::GRAU_INSTRUCAO),
            'grauParentesco' => $this->converterChaveValor(Dependente::GRAU_PARENTESCO),
            'irf' => $this->converterChaveValor(Dependente::IRF),
            'meses' => $this->converterChaveValor(self::MESES),
            'perfis' => $this->converterChaveValor(self::PERFIS),
            'sexo' => $this->converterChaveValor(self::SEXO),
            'simnao' => $this->converterChaveValor(self::SIMNAO),
            'situacaoRecadastramento' => $this->converterChaveValor(Recadastramento::SITUACAO_RECADASTRAMENTO),
            'tipoContrato' => $this->getTipoContrato(),
            'uf' => $this->converterChaveValor(self::UF),
        ];
        return response()->json($config, 200);
    }

    private function converterChaveValor($arr) {
        $retorno = [];
        if (is_array($arr)) {
            foreach ($arr as $chave => $valor) {
                if (is_array($valor)) {
                    $retorno[] = [
                        'chave' => $chave,
                        'valor' => $this->converterChaveValor($valor),
                    ];
                } else {
                    $retorno[] = [
                        'chave' => $chave,
                        'valor' => $valor,
                    ];
                }
            }
        }

        return $retorno;
    }

}
