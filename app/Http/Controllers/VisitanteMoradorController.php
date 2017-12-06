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

        return $dados;
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
        $dados = DB::table('tb_cdm_visitante_morador as t')
                ->select('m.*','t.data_visita')
                ->join('tb_cdm_morador as m', 't.morador_id', '=', 'm.id')
                ->where('t.visitante_id', $id)
                 ->orderBy('m.nome', 'asc')   
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
