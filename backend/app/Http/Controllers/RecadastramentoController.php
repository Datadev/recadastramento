<?php

namespace App\Http\Controllers;

use App\Models\Arquivo;
use App\Models\Dependente;
use App\Models\Escolaridade;
use App\Models\Recadastramento;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Laravel\Lumen\Routing\Controller;
use Ramsey\Uuid\Uuid;
use function env;
use function iconv;
use function mb_internal_encoding;
use function response;

/**
 * Description of RecadastramentoController
 *
 * @author fabricio
 */
class RecadastramentoController extends Controller {

    public function alterarSituacao(Request $request, $idRecadastramento) {
        /** @var User $usuario */
        $usuario = Auth::user();

        /** @var Recadastramento $recadastramento */
        $recadastramento = Recadastramento::where('id', $idRecadastramento)->first();
        if (is_null($recadastramento)) {
            return response()->json(['message' => 'Recurso não encontrado'], 400);
        }
        
        /** @var User $servidor */
        $servidor = User::where('login', $recadastramento->matricula)->first();
        
        $recadastramento->situacao = $request->situacao;

        if ($recadastramento->situacao === 'A') {
            try {
                $this->gravarECidade($recadastramento);
                $this->enviarEmailRecadastramentoAprovado($recadastramento, $servidor);
                $recadastramento->save();
            } catch (Exception $ex) {
                Log::error($ex);
                return response()->json(['message' => 'Falha ao processar o recadastramento'], 500);
            }
        } else if ($recadastramento->situacao === 'R') {
            $recadastramento->motivoSituacao = $request->motivoSituacao;
            $recadastramento->save();
            $this->enviarEmailRecadastramentoRecusado($recadastramento, $servidor);
        }

        return response()->json($recadastramento);
    }

    public function buscarPorId($idRecadastramento) {
        return response()->json(Recadastramento::where('id', $idRecadastramento)->first());
    }

    public function buscarArquivoPorId($idRecadastramento, $idArquivo) {
        return response()->json(
                        Arquivo::where('id_recadastramento', $idRecadastramento)
                                ->where('id', $idArquivo)
                                ->first()
                                ->makeVisible('conteudo'));
    }

    public function gravarECidade(Recadastramento $recadastramento) {
        $dependentes = Dependente::where('id_recadastramento', $recadastramento->id)->get();
        try {
            DB::connection('ecidade')->beginTransaction();
            
            mb_internal_encoding('iso-8859-1');

            $numcgm = $this->prepararValor(DB::connection('ecidade')->select('
                SELECT
                    c.z01_numcgm
                FROM 
                    pessoal.rhpessoal p
                    INNER JOIN protocolo.cgm c ON p.rh01_numcgm = c.z01_numcgm 
                WHERE 
                    p.rh01_regist = :matricula',
                            ['matricula' => $recadastramento->matricula])[0]->z01_numcgm);

            $z01_nome = $this->prepararValor($recadastramento->nome);
            $z01_nomecomple = $this->prepararValor($recadastramento->nome);
            $z01_pai = $this->prepararValor($recadastramento->pai);
            $z01_mae = $this->prepararValor($recadastramento->mae);
            $z01_telef = $this->prepararValor($recadastramento->telefone);
            $z01_email = $this->prepararValor($recadastramento->email);
            $z01_ender = $this->prepararValor($recadastramento->endereco);
            $z01_numero = $this->prepararValor($recadastramento->numero, '0');
            $z01_compl = $this->prepararValor($recadastramento->complemento);
            $z01_bairro = $this->prepararValor($recadastramento->bairro);
            $z01_munic = $this->prepararValor($recadastramento->cidade);
            $z01_uf = $this->prepararValor(ConfiguracaoController::UF[$recadastramento->uf]);
            $z01_cep = $this->prepararValor($recadastramento->cep);
            $z01_cgccpf = $this->prepararValor($recadastramento->cpf);
            $z01_pis = $this->prepararValor($recadastramento->pis);
            $z01_ident = $this->prepararValor($recadastramento->pis);
            $z01_identdtexp = $this->prepararValor($recadastramento->expedicaoRg);
            $z01_identorgao = $this->prepararValor($recadastramento->orgaoRg);
            if ($recadastramento->possuiCnh === 'S'){
                $z01_cnh = $this->prepararValor($recadastramento->numeroCnh, '0');
                $z01_dthabilitacao = $this->prepararValor($recadastramento->emissaoCnh);
                $z01_dtemissao = $this->prepararValor($recadastramento->emissaoCnh);
                $z01_categoria = $this->prepararValor($recadastramento->categoriaCnh);
            } else {
                $z01_cnh = 'NULL';
                $z01_dthabilitacao = 'NULL';
                $z01_dtemissao = 'NULL';
                $z01_categoria = 'NULL';
            }

            $searchPath = env('DB_SEARCHPATH_ECIDADE', 'public');
            DB::connection('ecidade')
                    ->unprepared("SET search_path TO $searchPath;
                    UPDATE protocolo.cgm SET 
                        z01_nome = $z01_nome,
                        z01_nomecomple = $z01_nomecomple, 
                        z01_pai = $z01_pai,
                        z01_mae = $z01_mae,
                        z01_telef = $z01_telef,
                        z01_email = $z01_email,
                        z01_ender = $z01_ender,
                        z01_numero = $z01_numero,
                        z01_compl = $z01_compl,
                        z01_bairro = $z01_bairro,
                        z01_munic = $z01_munic,
                        z01_uf = $z01_uf,
                        z01_cep = $z01_cep,
                        z01_cgccpf = $z01_cgccpf,
                        z01_pis = $z01_pis,
                        z01_ident = $z01_ident,
                        z01_identdtexp = $z01_identdtexp,
                        z01_identorgao = $z01_identorgao,
                        z01_cnh = $z01_cnh,
                        z01_dthabilitacao = $z01_dthabilitacao,
                        z01_dtemissao = $z01_dtemissao,
                        z01_categoria = $z01_categoria
                    WHERE z01_numcgm = $numcgm");

            $rh01_regist = $this->prepararValor($recadastramento->matricula);
            $rh01_sexo = $this->prepararValor($recadastramento->sexo);
            $rh01_estciv = $this->prepararValor($this->deParaEstadoCivil($recadastramento->estadoCivil));
            $rh01_nasc = $this->prepararValor($recadastramento->nascimento);
            $rh01_instru = $this->prepararValor($this->deParaGrauInstrucao($recadastramento->grauInstrucao));

            DB::connection('ecidade')
                    ->unprepared("SET search_path TO $searchPath;
                    UPDATE pessoal.rhpessoal SET 
                        rh01_sexo = $rh01_sexo,
                        rh01_estciv = $rh01_estciv,
                        rh01_nasc = $rh01_nasc,
                        rh01_instru = $rh01_instru
                    WHERE rh01_regist = $rh01_regist");

            $rh16_regist = $rh01_regist;
            $rh16_pis = $this->prepararValor($recadastramento->pis);
            if ($recadastramento->possuiCnh === 'S'){
                $rh16_ctps_n = $this->prepararValor($recadastramento->numeroCtps, '0');
                $rh16_ctps_d = $this->prepararValor($recadastramento->digitoCtps, '0');
                $rh16_ctps_s = $this->prepararValor($recadastramento->serieCtps, '0');
                $rh16_emissao = $this->prepararValor($recadastramento->expedicaoCtps);
                $rh16_ctps_uf = $this->prepararValor(ConfiguracaoController::UF[$recadastramento->ufCtps]);    
            } else {
                $rh16_ctps_n = 'NULL';
                $rh16_ctps_d = 'NULL';
                $rh16_ctps_s = 'NULL';
                $rh16_emissao = 'NULL';
                $rh16_ctps_uf = 'NULL';
            }

            if ($recadastramento->possuiCnh === 'S'){
                $rh16_carth_n = $this->prepararValor($recadastramento->numeroCnh);
                $rh16_carth_val = $this->prepararValor($recadastramento->validadeCnh);
                $rh16_carth_cat = $this->prepararValor($recadastramento->categoriaCnh);
            } else {
                $rh16_carth_n = 'NULL';
                $rh16_carth_val = 'NULL';
                $rh16_carth_cat = 'NULL';
            }

            $rh16_titele = $this->prepararValor($recadastramento->numeroTe);
            $rh16_zonael = $this->prepararValor($recadastramento->zonaTe);
            $rh16_secaoe = $this->prepararValor($recadastramento->secaoTe);

            DB::connection('ecidade')
                    ->unprepared("SET search_path TO $searchPath;
                    UPDATE pessoal.rhpesdoc SET 
                        rh16_pis = $rh16_pis,
                        rh16_ctps_n = $rh16_ctps_n,
                        rh16_ctps_d = $rh16_ctps_d,
                        rh16_ctps_s = $rh16_ctps_s,
                        rh16_emissao = $rh16_emissao,
                        rh16_ctps_uf = $rh16_ctps_uf,
                        rh16_carth_n = $rh16_carth_n,
                        rh16_carth_val = $rh16_carth_val,
                        r16_carth_cat = $rh16_carth_cat,
                        rh16_titele = $rh16_titele,
                        rh16_zonael = $rh16_zonael,
                        rh16_secaoe = $rh16_secaoe
                    WHERE rh16_regist = $rh16_regist");
            
            $dp01_regist = $rh16_regist;
            DB::connection('ecidade')
                    ->unprepared("SET search_path TO $searchPath;
                    DELETE FROM pessoal.rhdependeplug WHERE dp01_regist = $dp01_regist");
            
            $rh31_regist = $dp01_regist;           
            DB::connection('ecidade')
                    ->unprepared("SET search_path TO $searchPath;
                    DELETE FROM pessoal.rhdepend WHERE rh31_regist = $rh31_regist");
            
            foreach ($dependentes as $dependente) {
                $rh31_nome = $this->prepararValor($dependente->nome);
                $rh31_dtnasc = $this->prepararValor($dependente->nascimento);
                $rh31_gparen = $this->prepararValor($dependente->parentesco);
                $rh31_depend = $dependente->parentesco === 'F' ? 'C' : 'N';
                $rh31_irf = $this->prepararValor($dependente->irf);
                $rh31_especi = 'N';
                $rh31_fins_previdenciarios = 'false';
                
                DB::connection('ecidade')
                    ->unprepared("SET search_path TO $searchPath;
                    INSERT INTO pessoal.rhdepend 
                        (rh31_codigo, rh31_regist, rh31_nome, rh31_dtnasc, rh31_gparen, rh31_depend, rh31_irf, rh31_especi, rh31_fins_previdenciarios)
                    VALUES
                        ((SELECT max(rh31_codigo) + 1 FROM pessoal.rhdepend), $rh31_regist, $rh31_nome, $rh31_dtnasc, $rh31_gparen, '$rh31_depend', $rh31_irf, '$rh31_especi', $rh31_fins_previdenciarios)");
                
                $dp01_rhdepend = $this->prepararValor(DB::connection('ecidade')->select('
                    SELECT rh31_codigo FROM pessoal.rhdepend WHERE rh31_regist = :matricula',
                                ['matricula' => $recadastramento->matricula])[0]->rh31_codigo);
                
                $dp01_regist = $rh31_regist;
                $dp01_instit = 1;
                $dp01_cpf = $this->prepararValor($dependente->cpf);
                $dp01_sexo = $this->prepararValor($dependente->sexo);
                
                DB::connection('ecidade')
                    ->unprepared("SET search_path TO $searchPath;
                    INSERT INTO pessoal.rhdependeplug 
                        (dp01_rhdepend, dp01_regist, dp01_instit, dp01_cpf, dp01_sexo)
                    VALUES
                        ($dp01_rhdepend, $dp01_regist, $dp01_instit, $dp01_cpf, $dp01_sexo)");
            }

            DB::connection('ecidade')->commit();
        } catch (Exception $ex) {
            Log::error($ex);
            DB::connection('ecidade')->rollBack();
            throw new Exception('Falha ao gravar na base do e-Cidade.');
        }
    }
    
    private function deParaEstadoCivil($valor): string {
        $retorno = $valor;
        if ($valor === '6'){
            $retorno = '2';
        }
        return $retorno;
    }
    
    private function deParaGrauInstrucao($valor): string {
        $retorno = $valor;
        if ($valor === '12'){
            $retorno = '9';
        }
        return $retorno;
    }

    private function prepararValor($valor, $default = ''): string {
        return sprintf("'%s'", isset($valor) ? iconv("UTF-8", "ISO-8859-1//TRANSLIT", pg_escape_string($valor)) : $default);
    }

    public function listar(Request $request) {
        /** @var User $usuario */
        $usuario = Auth::user();
        $matricula = null;
        if ($usuario->hasRole(User::ROLE_SERVIDOR)) {
            $matricula = $usuario->login;
        }
        $filter = $request->filter;
        $orderBy = Str::snake($request->order_by ?? 'id');
        $sortOrder = $request->sort_order ?? 'asc';
        $page = $request->page ?? 0;
        $per_page = $request->per_page ?? 10;
        $situacao = $request->situacao;
        
        if ($situacao === 'S') {
            return response()->json($this->listarSomenteRecusados($matricula, $filter, $orderBy, $sortOrder, $per_page, $page));
        }
        if ($situacao === 'N') {
            return response()->json($this->listarNaoRealizados($matricula, $filter, $orderBy, $sortOrder, $per_page, $page, $request));
        }

        $retorno = Recadastramento::query()
                ->when($matricula, function ($q) use ($matricula) {
                    return $q->where('matricula', $matricula);
                })
                ->when($situacao, function ($q) use ($situacao) {
                    return $q->where('situacao', $situacao);
                })
                ->when($filter, function($q) use ($filter) {
                    return $q->where(function($query) use ($filter) {
                        $query
                        ->orWhereRaw('lower(matricula::text) like ?', ['%' . strtolower($filter) . '%'])
                        ->orWhereRaw('lower(codigo) like ?', ['%' . strtolower($filter) . '%'])
                        ->orWhereRaw('lower(nome) like ?', ['%' . strtolower($filter) . '%']);
                    });
                })
                ->orderBy($orderBy, $sortOrder)
                ->paginate($per_page, ['*'], 'page', $page);
        return response()->json($retorno);
    }
    
    private function listarSomenteRecusados($matricula, $filter, $orderBy, $sortOrder, $per_page, $page) {
        $retorno = Recadastramento::query()
                ->when($matricula, function ($q) use ($matricula) {
                    return $q->where('matricula', $matricula);
                })
                ->when($filter, function($q) use ($filter) {
                    return $q->where(function($query) use ($filter) {
                        $query
                        ->orWhereRaw('lower(matricula::text) like ?', ['%' . strtolower($filter) . '%'])
                        ->orWhereRaw('lower(codigo) like ?', ['%' . strtolower($filter) . '%'])
                        ->orWhereRaw('lower(nome) like ?', ['%' . strtolower($filter) . '%']);
                    });
                })
                ->whereNotExists(function($query){
                    $query->select(DB::raw(1))
                            ->from('recadastramento as r2')
                            ->whereRaw('recadastramento.matricula = r2.matricula')
                            ->where('situacao', 'A');
                })
                ->where('situacao', 'R')
                ->orderBy($orderBy, $sortOrder)
                ->paginate($per_page, ['*'], 'page', $page);
        return $retorno;
    }
    
    private function listarNaoRealizados($matricula, $filter, $orderBy, $sortOrder, $per_page, $page, $request) {
        $condicaoServidorAtivo = UsuarioController::CONDICAO_SERVIDOR_ATIVO;

        $eCidadeDatabaseHost = env('DB_HOST_ECIDADE');
        $eCidadeDatabaseName = DB::connection('ecidade')->getDatabaseName();
        $eCidadeDatabaseUser = env('DB_USERNAME_ECIDADE');
        $eCidadeDatabasePassword = env('DB_PASSWORD_ECIDADE');
        
        $condicao = '';
        if (isset($filter) && trim($filter) !== '') {
            $filter = strtolower(pg_escape_string($filter));
            $condicao .= " and (lower(e.matricula::text) like '%$filter%' or lower(e.nome) like '%$filter%') ";
        }
        if (isset($matricula) && trim($matricula) !== '') {
            $matricula = pg_escape_string($filter);
            $condicao .= " and e.matricula::text = '$$matricula' ";
        }
                
        $consulta = "SELECT DISTINCT
            r.created_at AS createdAt,
            r.codigo,
            'N' AS situacao,
            e.matricula,
            e.nome
        FROM
            dblink('host=$eCidadeDatabaseHost dbname=$eCidadeDatabaseName user=$eCidadeDatabaseUser password=$eCidadeDatabasePassword', $$
                SELECT DISTICT
                    p.rh01_regist AS matricula,
                    c.z01_nome AS nome
                FROM 
                    pessoal.rhpessoal p
                    INNER JOIN protocolo.cgm c ON p.rh01_numcgm = c.z01_numcgm 
                WHERE
                    $condicaoServidorAtivo
                $$) AS e (
                    matricula int,
                    nome char(40)
                )
            LEFT JOIN recadastramento r ON e.matricula = r.matricula 
        WHERE 
            r.codigo IS NULL
            $condicao
        ORDER BY
            $orderBy $sortOrder";
        
        return $this->arrayPaginator(DB::select(DB::raw($consulta)), $per_page, $page, $request);
    }
    
    private function arrayPaginator($array, $per_page, $page, $request){
        if ($page === 0) {
            $page++;
        }
        $offset = ($page * $per_page) - $per_page;
        return new LengthAwarePaginator(array_slice($array, $offset, $per_page), count($array), $per_page, $page,
            ['path' => $request->url(), 'query' => $request->query()]);
    }


    public function listarArquivo($idRecadastramento) {
        $retorno = Arquivo::where('id_recadastramento', $idRecadastramento)->get();
        return response()->json($retorno);
    }

    public function listarDependente($idRecadastramento) {
        $retorno = Dependente::where('id_recadastramento', $idRecadastramento)->get();
        return response()->json($retorno);
    }

    public function listarEscolaridade($idRecadastramento) {
        $retorno = Escolaridade::where('id_recadastramento', $idRecadastramento)->get();
        return response()->json($retorno);
    }

    public function criar(Request $request) {
        /** @var User $usuario */
        $usuario = Auth::user();

        if ((int) $usuario->login !== (int) $request->matricula) {
            $retorno = [
                'mensagem' => 'Não é possível executar esta ação',
            ];
            return response()->json($retorno, 400);
        }

        $recadastramento = $this->adicionarRecadastramento($request);
        $this->adicionarEscolaridade($request, $recadastramento);
        $this->adicionarDependente($request, $recadastramento);
        $this->adicionarArquivo($request, $recadastramento);
        $this->enviarEmailRecadastramentoRecebido($recadastramento, $usuario);

        $retorno = [
            'protocolo' => $recadastramento->codigo,
            'mensagem' => 'Seu recadastramento foi recebido e aguarda avaliação.',
        ];
        return response()->json($retorno, 201);
    }

    private function enviarEmailRecadastramentoRecebido(Recadastramento $recadastramento, User $usuario) {
        $dados = [
            'codigo' => $recadastramento->codigo,
        ];
        Mail::send('recadastramento-recebido', $dados, function ($message) use ($usuario) {
            $message
                    ->to($usuario->email)
                    ->subject('Recadastramento recebido');
        });
    }

    private function enviarEmailRecadastramentoAprovado(Recadastramento $recadastramento, User $usuario) {
        $dados = [
            'codigo' => $recadastramento->codigo,
        ];
        Mail::send('recadastramento-aprovado', $dados, function ($message) use ($usuario) {
            $message
                    ->to($usuario->email)
                    ->subject('Recadastramento aprovado');
        });
    }

    private function enviarEmailRecadastramentoRecusado(Recadastramento $recadastramento, User $usuario) {
        $dados = [
            'codigo' => $recadastramento->codigo,
        ];
        Mail::send('recadastramento-recusado', $dados, function ($message) use ($usuario) {
            $message
                    ->to($usuario->email)
                    ->subject('Recadastramento recusado');
        });
    }

    private function adicionarRecadastramento(Request $request): Recadastramento {
        $dadosRecadastramento = $request->all();
        $dadosRecadastramento['codigo'] = Uuid::uuid4();
        $dadosRecadastramento['situacao'] = 'P';
        $dadosRecadastramento['grauInstrucao'] = $request->grauInstrucao['chave'];
        $recadastramento = Recadastramento::create($dadosRecadastramento);
        $recadastramento->save();
        return $recadastramento;
    }

    private function adicionarEscolaridade(Request $request, Recadastramento $recadastramento): void {
        if (is_array($request->escolaridade)) {
            foreach ($request->escolaridade as $escolaridade) {
                $escolaridadeObj = new Escolaridade();
                $escolaridadeObj->fill($escolaridade);
                $escolaridadeObj->idRecadastramento = $recadastramento->id;
                $escolaridadeObj->save();
            }
        }
    }

    private function adicionarDependente(Request $request, Recadastramento $recadastramento): void {
        if (is_array($request->dependentes)) {
            foreach ($request->dependentes as $dependente) {
                $dependenteObj = new Dependente();
                $dependenteObj->fill($dependente);
                $dependenteObj->idRecadastramento = $recadastramento->id;
                $dependenteObj->save();
            }
        }
    }

    private function adicionarArquivo(Request $request, Recadastramento $recadastramento): void {
        if (is_array($request->arquivos)) {
            foreach ($request->arquivos as $arquivo) {
                $partes = explode(':', $arquivo['conteudo']);
                $mimeType = explode(';', $partes[1]);
                $dependenteObj = new Arquivo();
                $dependenteObj->fill($arquivo);
                $dependenteObj->idRecadastramento = $recadastramento->id;
                $dependenteObj->mimeType = $mimeType[0];
                $dependenteObj->arquivo = $arquivo['arquivo']['_fileNames'];
                $dependenteObj->save();
            }
        }
    }
}
