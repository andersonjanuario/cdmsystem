<?php

namespace App\Http\Controllers;
use App\Models\VisitanteMorador;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class VisitanteMoradorController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $dados = DB::table('tb_cdm_visitante_morador as t')
                ->select('m.id as id_morad',
                        'm.nome as nome_morad',
                        'm.email as email_morad',
                        'm.cpf as cpf_morad',
                        'm.inquilino as inquilino_morad',
                        'm.foto as foto_morad',
                        'm.idade as idade_morad',
                        'm.entrada as entrada_morad',
                        'm.saida as saida_morad',
                        'm.status as status_morad',
                        'm.rg as rg_morad',
                        'm.fone_principal as fone_principal_morad',
                        'm.fone_secundario as fone_secundario_morad',
                        'm.apartamento_id as apartamento_id_morad',
                        'm.parentesco_id as parentesco_id_morad',
                        'm.created_at as created_at_morad',
                        'm.updated_at as updated_at_morad',
                        'v.id as id_visit',
                        'v.nome as nome_visit',
                        'v.cpf as cpf_visit',
                        'v.foto as foto_visit',
                        'v.idade as idade_visit',
                        'v.descricao as descricao_visit',
                        'v.fone_principal as fone_principal_visit',
                        'v.rg as rg_visit',
                        'v.created_at as created_at_visit',
                        'v.updated_at as updated_at_visit',
                        't.data_visita')
                ->join('tb_cdm_morador as m', 't.morador_id', '=', 'm.id')
                ->join('tb_cdm_visitante as v', 't.visitante_id', '=', 'v.id')
                ->orderBy('m.nome', 'asc')
                ->orderBy('v.nome', 'asc')                
                ->get();

                foreach ($dados as $objeto) {
                    $objeto->foto_morad = null;
                }

        return $dados;
    }

    public function findByDateMorador(VisitanteMorador $visitMorador, Request $request){
        $total = 0;
        $skip = 0;
        $take = 5;
        $order = 'tb_cdm_visitante_morador.data_visita';
        $sort = 'desc';        
        if($request->input('skip') !== null && $request->input('skip') !== ''){
            $skip = $request->input('skip');
        }
        if($request->input('take') !== null && $request->input('take') !== ''){
            $take =  $request->input('take');
        }
        if($request->input('order') !== null && $request->input('order') !== ''){
            $order = $request->input('order');
        }
        if($request->input('sort') !== null && $request->input('sort') !== '' ){
            $sort = $request->input('sort');
        }
        if($request->input('pesquisa') !== null && $request->input('pesquisa') !== '' ){
            $content = DB::table('tb_cdm_visitante_morador')
                   ->select('tb_cdm_visitante_morador.morador_id',
                    'tb_cdm_morador.nome',
                    'tb_cdm_apartamento.numero as numero_apto',
                    'tb_cdm_apartamento.bloco as bloco_apto',
                    'tb_cdm_apartamento.bosque as bosque_apto',                    
                    'tb_cdm_visitante_morador.data_visita')
                   ->join('tb_cdm_morador', 'tb_cdm_visitante_morador.morador_id', '=', 'tb_cdm_morador.id')
                   ->join('tb_cdm_apartamento', 'tb_cdm_morador.apartamento_id', '=', 'tb_cdm_apartamento.id')
                   ->skip($skip)   
                   ->take($take)   
                   //->where('tb_cdm_veiculo.placa', 'like', '%' . $request->input('pesquisa') . '%')
                   //->orWhere('tb_cdm_veiculo.cor', 'like', '%' . $request->input('pesquisa') . '%')
                   //->orWhere('tb_cdm_veiculo.tipo', 'like', '%' . $request->input('pesquisa') . '%')
                   //->orWhere('tb_cdm_veiculo.descricao', 'like', '%' . $request->input('pesquisa') . '%')
                   ->groupBy('morador_id')
                   ->groupBy('tb_cdm_morador.nome')
                   ->groupBy('numero_apto')
                   ->groupBy('bloco_apto')
                   ->groupBy('bosque_apto')
                   ->groupBy('data_visita')                   
                   ->orderBy($order, $sort)
                   ->get();

            $total = DB::table('tb_cdm_visitante_morador')
                   ->select('tb_cdm_visitante_morador.morador_id',            
                    'tb_cdm_morador.nome',
                    'tb_cdm_apartamento.numero as numero_apto',
                    'tb_cdm_apartamento.bloco as bloco_apto',
                    'tb_cdm_apartamento.bosque as bosque_apto',                    
                    'tb_cdm_visitante_morador.data_visita')
                   ->join('tb_cdm_morador', 'tb_cdm_visitante_morador.morador_id', '=', 'tb_cdm_morador.id')
                   ->join('tb_cdm_apartamento', 'tb_cdm_morador.apartamento_id', '=', 'tb_cdm_apartamento.id')
                   ->skip($skip)   
                   ->take($take)   
                   //->where('tb_cdm_veiculo.placa', 'like', '%' . $request->input('pesquisa') . '%')
                   //->orWhere('tb_cdm_veiculo.cor', 'like', '%' . $request->input('pesquisa') . '%')
                   //->orWhere('tb_cdm_veiculo.tipo', 'like', '%' . $request->input('pesquisa') . '%')
                   //->orWhere('tb_cdm_veiculo.descricao', 'like', '%' . $request->input('pesquisa') . '%')
                   ->groupBy('morador_id')
                   ->groupBy('tb_cdm_morador.nome')
                   ->groupBy('numero_apto')
                   ->groupBy('bloco_apto')
                   ->groupBy('bosque_apto')
                   ->groupBy('data_visita')                 
                   ->get()->count();     

        }else{
            $content = DB::table('tb_cdm_visitante_morador')
           ->select('tb_cdm_visitante_morador.morador_id',            
                    'tb_cdm_morador.nome',
                    'tb_cdm_apartamento.numero as numero_apto',
                    'tb_cdm_apartamento.bloco as bloco_apto',
                    'tb_cdm_apartamento.bosque as bosque_apto',                    
                    'tb_cdm_visitante_morador.data_visita')
                   ->join('tb_cdm_morador', 'tb_cdm_visitante_morador.morador_id', '=', 'tb_cdm_morador.id')
                   ->join('tb_cdm_apartamento', 'tb_cdm_morador.apartamento_id', '=', 'tb_cdm_apartamento.id')
                   ->skip($skip)   
                   ->take($take)   
                   ->groupBy('morador_id')
                   ->groupBy('tb_cdm_morador.nome')
                   ->groupBy('numero_apto')
                   ->groupBy('bloco_apto')
                   ->groupBy('bosque_apto')
                   ->groupBy('data_visita')                   
                   ->orderBy($order, $sort)
                   ->get();

            $total = DB::table('tb_cdm_visitante_morador')
           ->select('tb_cdm_visitante_morador.morador_id',             
                    'tb_cdm_morador.nome',
                    'tb_cdm_apartamento.numero as numero_apto',
                    'tb_cdm_apartamento.bloco as bloco_apto',
                    'tb_cdm_apartamento.bosque as bosque_apto',                    
                    'tb_cdm_visitante_morador.data_visita')
                   ->join('tb_cdm_morador', 'tb_cdm_visitante_morador.morador_id', '=', 'tb_cdm_morador.id')
                   ->join('tb_cdm_apartamento', 'tb_cdm_morador.apartamento_id', '=', 'tb_cdm_apartamento.id')
                   ->skip($skip)   
                   ->take($take)   
                   ->groupBy('morador_id')
                   ->groupBy('tb_cdm_morador.nome')
                   ->groupBy('numero_apto')
                   ->groupBy('bloco_apto')
                   ->groupBy('bosque_apto')
                   ->groupBy('data_visita')                 
                   ->get()->count();        
        }

            return response($content)->header('X-Total-Registros', $total);          
    }
    
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $objeto = new VisitanteMorador;
        $objeto->visitante_id = $request->input('visitante_id');
        $objeto->morador_id = $request->input('morador_id');
        $objeto->data_visita = $request->input('data_visita');
        $objeto->created_at = date("Y-m-d H:i:s");
        $objeto->save();        
    }    
    
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $objeto = VisitanteMorador::find($id);
        $objeto->visitante_id = $request->input('visitante_id');
        $objeto->morador_id = $request->input('morador_id');
        $objeto->data_visita = $request->input('data_visita');
        $objeto->updated_at = date("Y-m-d H:i:s");
        $objeto->save();  
    }    
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $objeto = VisitanteMorador::find($id);
        $objeto->delete();
        return "Record successfully deleted #" . $id;
    }    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showMoradores($id) {
        $dados = DB::table('tb_cdm_visitante_morador')
                ->select('tb_cdm_morador.id',
                        'tb_cdm_morador.nome',
                        'tb_cdm_morador.email',
                        'tb_cdm_morador.cpf',
                        'tb_cdm_morador.foto',
                        'tb_cdm_morador.inquilino',                        
                        'tb_cdm_morador.idade',
                        'tb_cdm_morador.entrada',
                        'tb_cdm_morador.saida',
                        'tb_cdm_morador.status',
                        'tb_cdm_morador.rg',
                        'tb_cdm_morador.fone_principal',
                        'tb_cdm_morador.fone_secundario',
                        'tb_cdm_morador.created_at',
                        'tb_cdm_morador.updated_at',
                        'tb_cdm_morador.apartamento_id',
                        'tb_cdm_apartamento.numero as numero_apto',
                        'tb_cdm_apartamento.bloco as bloco_apto',
                        'tb_cdm_apartamento.bosque as bosque_apto',
                        'tb_cdm_visitante_morador.data_visita')
                ->join('tb_cdm_morador', 'tb_cdm_visitante_morador.morador_id', '=', 'tb_cdm_morador.id')
                ->join('tb_cdm_apartamento', 'tb_cdm_morador.apartamento_id', '=', 'tb_cdm_apartamento.id')
                ->where('tb_cdm_visitante_morador.visitante_id', $id)
                ->orderBy('tb_cdm_morador.nome', 'asc')   
                ->get();

        return $dados;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showVisitantes($id) {
        $dados = DB::table('tb_cdm_visitante_morador as t')
                ->select('v.*','t.data_visita')
                ->join('tb_cdm_visitante as v', 't.visitante_id', '=', 'v.id')
                ->where('t.morador_id', $id)
                ->orderBy('v.nome', 'asc')                  
                ->get();

        return $dados;
    }

    

}
