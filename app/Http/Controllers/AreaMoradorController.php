<?php

namespace App\Http\Controllers;
use App\Models\AreaMorador;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AreaMoradorController extends Controller
{
/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dados = DB::table('tb_cdm_area_morador as t')
                ->select('a.id as id_visit',
                        'a.titulo as nome_visit',
                        'a.descricao as cpf_visit',
                        'a.created_at as created_at_visit',
                        'a.updated_at as updated_at_visit',
                        'm.id as id_morad',
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
                        't.reserva',
                        't.status',
                        't.saldo')
                ->join('tb_cdm_morador as m', 't.morador_id', '=', 'm.id')
                ->join('tb_cdm_area as a', 't.area_id', '=', 'a.id')
                ->orderBy('a.titulo', 'asc')  
                ->orderBy('m.nome', 'asc')                              
                ->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $objeto = new AreaMorador;
        $objeto->area_id = $request->input('area_id');
        $objeto->morador_id = $request->input('morador_id');
        $objeto->reserva = $request->input('reserva');
        $objeto->status = $request->input('status');
        $objeto->saldo = $request->input('saldo');
        $objeto->created_at = date("Y-m-d H:i:s");
        $objeto->save();  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showAreas($id)
    {
        $dados = DB::table('tb_cdm_area_morador as t')
                ->select('a.*',
                        't.reserva',
                        't.status',
                        't.saldo')
                ->join('tb_cdm_area as a', 't.area_id', '=', 'a.id')
                ->where('t.morador_id', $id)
                ->orderBy('a.titulo', 'asc')                  
                ->get();
        
        return $dados;        
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showMoradores($id)
    {
        $dados = DB::table('tb_cdm_area_morador as t')
                ->select('m.*',
                        't.reserva',
                        't.status',
                        't.saldo')
                ->join('tb_cdm_morador as m', 't.morador_id', '=', 'm.id')
                ->where('t.area_id', $id)
                ->orderBy('m.nome', 'asc')                              
                ->get();
        
        return $dados;
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
        $objeto = AreaMorador::find($id);
        $objeto->area_id = $request->input('area_id');
        $objeto->morador_id = $request->input('morador_id');
        $objeto->reserva = $request->input('reserva');
        $objeto->status = $request->input('status');
        $objeto->saldo = $request->input('saldo');
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
        $objeto = AreaMorador::find($id);
        $objeto->delete();
        return "Record successfully deleted #" . $id;
    }   
}
