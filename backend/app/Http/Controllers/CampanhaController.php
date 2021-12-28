<?php

namespace App\Http\Controllers;

use App\Models\Campanha;
use App\Models\CampanhaMes;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Lumen\Routing\Controller;
use function dd;
use function response;

class CampanhaController extends Controller {
    public function listar(Request $request): JsonResponse {
        $orderBy = Str::snake($request->order_by ?? 'id');
        $sortOrder = $request->sort_order ?? 'asc';
        $page = $request->page ?? 0;
        $per_page = $request->per_page ?? 10;
        
        $retorno = Campanha::query()
                ->with('meses')
                ->orderBy($orderBy, $sortOrder)
                ->paginate($per_page, ['*'], 'page', $page);
        return response()->json($retorno);
    }
    
    public function criar(Request $request): JsonResponse {
        DB::beginTransaction();
        try {
            $campanha = Campanha::create($request->all());
            $campanha->save();
            foreach ($request->input('meses') as $mes) {
                $campanhaMes = CampanhaMes::create([
                    'id_campanha' => $campanha->id,
                    'mes' => $mes,
                ]);
                $campanhaMes->save();
            }
            DB::commit();
            return response()->json([
                'mensagem' => 'Campanha criada com sucesso',
                'id' => $campanha->id,
            ]);
        } catch (Exception $ex) {
            DB::rollback();
            Log::error('Falha ao criar campanha: ' . $ex->getMessage());
            return response()->json([
                'mensagem' => $ex->getMessage(),
            ], 500);
        }   
    }
    
    public function buscarElegivel() {
        /** @var User $usuario */
        $usuario = Auth::user();
        
        $condicaoServidorAtivo = UsuarioController::CONDICAO_SERVIDOR_ATIVO;
        
        $resultadoNascimento = DB::connection('ecidade')->select("
            SELECT
                p.rh01_nasc as nascimento
            FROM 
                pessoal.rhpessoal p
                INNER JOIN protocolo.cgm c ON p.rh01_numcgm = c.z01_numcgm 
            WHERE 
                p.rh01_regist = :matricula", [
            'matricula' => $usuario->login
        ]);
        if (sizeof($resultadoNascimento) > 0) {
            $mesAniversario = (int) date('m', strtotime($resultadoNascimento[0]->nascimento));

            $idCampanha = DB::select("
                SELECT
                    c.id 
                FROM 
                    campanha c 
                    INNER JOIN campanha_mes m ON c.id = m.id_campanha 
                WHERE
                    c.ativo = 'S'
                    AND c.inicio <= now()
                    AND c.fim >= now()
                    AND m.mes = :mes
                ORDER BY
                    c.id ASC
                LIMIT 1", [
                    'mes' => $mesAniversario,
                ]);
            if (sizeof($idCampanha) > 0) {
                return $this->buscarPorId($idCampanha[0]->id);
            } 
        }
        return response()->json();
    }
    
    public function buscarPorId($idCampanha): JsonResponse {
        return response()->json(Campanha::with('meses')->where('id', $idCampanha)->first());
    }

    public function alterarPorId(Request $request, $idCampanha): JsonResponse {
        DB::beginTransaction();
        try {
            $campanha = Campanha::where('id', $idCampanha)->first();
            $campanha->fill($request->all());
            $campanha->save();
            CampanhaMes::where('id_campanha',$idCampanha)->delete();
            foreach ($request->input('meses') as $mes) {
                $campanhaMes = CampanhaMes::create([
                    'id_campanha' => $campanha->id,
                    'mes' => $mes,
                ]);
                $campanhaMes->save();
            }
            DB::commit();
            return $this->buscarPorId($idCampanha);
        } catch (Exception $ex) {
            DB::rollback();
            Log::error('Falha ao criar campanha: ' . $ex->getMessage());
            return response()->json([
                'mensagem' => $ex->getMessage(),
            ], 500);
        }
        
    }
}
