<?php

namespace App\Http\Controllers;

use App\Models\Dependente;
use App\Models\Escolaridade;
use App\Models\Recadastramento;
use Laravel\Lumen\Routing\Controller;
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
