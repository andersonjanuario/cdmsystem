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
    public function index(AreaMorador $areaMorador,Request $request){
        $total = 0;
        $skip = 0;
        $take = 5;
        $order = 'tb_cdm_area_morador.reserva';
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
            $content = DB::table('tb_cdm_area_morador')
                    ->select('tb_cdm_area_morador.id','tb_cdm_area_morador.reserva',
                            'tb_cdm_area_morador.status',
                            'tb_cdm_area_morador.saldo',
                            'tb_cdm_area.id as area_id',
                            'tb_cdm_area.titulo as nome_area',
                            'tb_cdm_area.descricao as cpf_area',
                            'tb_cdm_area.created_at as created_at_area',
                            'tb_cdm_area.updated_at as updated_at_area',
                            'tb_cdm_morador.id as morador_id',
                            'tb_cdm_morador.nome as nome_morad',
                            'tb_cdm_morador.email as email_morad',
                            'tb_cdm_morador.cpf as cpf_morad',
                            'tb_cdm_morador.inquilino as inquilino_morad',
                            'tb_cdm_morador.foto as foto_morad',
                            'tb_cdm_morador.idade as idade_morad',
                            'tb_cdm_morador.entrada as entrada_morad',
                            'tb_cdm_morador.saida as saida_morad',
                            'tb_cdm_morador.status as status_morad',
                            'tb_cdm_morador.rg as rg_morad',
                            'tb_cdm_morador.fone_principal as fone_principal_morad',
                            'tb_cdm_morador.fone_secundario as fone_secundario_morad',
                            'tb_cdm_morador.apartamento_id as apartamento_id_morad',
                            'tb_cdm_morador.parentesco_id as parentesco_id_morad',
                            'tb_cdm_morador.created_at as created_at_morad',
                            'tb_cdm_morador.updated_at as updated_at_morad')
                    ->join('tb_cdm_morador', 'tb_cdm_area_morador.morador_id', '=', 'tb_cdm_morador.id')
                    ->join('tb_cdm_area', 'tb_cdm_area_morador.area_id', '=', 'tb_cdm_area.id')
                    ->skip($skip)   //Pagina atual
                    ->take($take)   //Total por Pagina
                    ->where('tb_cdm_area.titulo', 'like', '%' . $request->input('pesquisa') . '%')
                    ->orWhere('tb_cdm_morador.nome', 'like', '%' . $request->input('pesquisa') . '%')
                    ->orderBy($order, $sort)
                    ->get();
 
                   $total =DB::table('tb_cdm_area_morador')
                        ->select('tb_cdm_area_morador.id','tb_cdm_area_morador.reserva',
                                'tb_cdm_area_morador.status',
                                'tb_cdm_area_morador.saldo',
                                'tb_cdm_area.id as area_id',
                                'tb_cdm_morador.id as morador_id')
                        ->join('tb_cdm_morador', 'tb_cdm_area_morador.morador_id', '=', 'tb_cdm_morador.id')
                        ->join('tb_cdm_area', 'tb_cdm_area_morador.area_id', '=', 'tb_cdm_area.id')
                        ->where('tb_cdm_area.titulo', 'like', '%' . $request->input('pesquisa') . '%')
                        ->orWhere('tb_cdm_morador.nome', 'like', '%' . $request->input('pesquisa') . '%')
                        ->get()->count();     

        }else{
            $content = DB::table('tb_cdm_area_morador')
                ->select('tb_cdm_area_morador.id','tb_cdm_area_morador.reserva',
                        'tb_cdm_area_morador.status',
                        'tb_cdm_area_morador.saldo',
                        'tb_cdm_area.id as area_id',
                        'tb_cdm_area.titulo as nome_area',
                        'tb_cdm_area.descricao as cpf_area',
                        'tb_cdm_area.created_at as created_at_area',
                        'tb_cdm_area.updated_at as updated_at_area',
                        'tb_cdm_morador.id as morador_id',
                        'tb_cdm_morador.nome as nome_morad',
                        'tb_cdm_morador.email as email_morad',
                        'tb_cdm_morador.cpf as cpf_morad',
                        'tb_cdm_morador.inquilino as inquilino_morad',
                        'tb_cdm_morador.foto as foto_morad',
                        'tb_cdm_morador.idade as idade_morad',
                        'tb_cdm_morador.entrada as entrada_morad',
                        'tb_cdm_morador.saida as saida_morad',
                        'tb_cdm_morador.status as status_morad',
                        'tb_cdm_morador.rg as rg_morad',
                        'tb_cdm_morador.fone_principal as fone_principal_morad',
                        'tb_cdm_morador.fone_secundario as fone_secundario_morad',
                        'tb_cdm_morador.apartamento_id as apartamento_id_morad',
                        'tb_cdm_morador.parentesco_id as parentesco_id_morad',
                        'tb_cdm_morador.created_at as created_at_morad',
                        'tb_cdm_morador.updated_at as updated_at_morad')
                ->join('tb_cdm_morador', 'tb_cdm_area_morador.morador_id', '=', 'tb_cdm_morador.id')
                ->join('tb_cdm_area', 'tb_cdm_area_morador.area_id', '=', 'tb_cdm_area.id')
                ->skip($skip)   //Pagina atual
                ->take($take)   //Total por Pagina
                ->orderBy($order, $sort)
                ->get();

                $total =  $areaMorador->all()->count();      
        }

        foreach ($content as $objeto) {
            $objeto->foto_morad = null;
        }                  


        return response($content)->header('X-Total-Registros', $total);   

    }


    public function all() {
        $dados = DB::table('tb_cdm_area_morador')
                ->select('tb_cdm_area_morador.id',
                        'tb_cdm_area_morador.reserva',
                        'tb_cdm_area_morador.status',
                        'tb_cdm_area_morador.saldo',
                        'tb_cdm_area.id as area_id',
                        'tb_cdm_area.titulo as nome_area',
                        'tb_cdm_area.descricao as cpf_area',
                        'tb_cdm_area.created_at as created_at_area',
                        'tb_cdm_area.updated_at as updated_at_area',
                        'tb_cdm_morador.id as morador_id',
                        'tb_cdm_morador.nome as nome_morad',
                        'tb_cdm_morador.email as email_morad',
                        'tb_cdm_morador.cpf as cpf_morad',
                        'tb_cdm_morador.inquilino as inquilino_morad',
                        'tb_cdm_morador.foto as foto_morad',
                        'tb_cdm_morador.idade as idade_morad',
                        'tb_cdm_morador.entrada as entrada_morad',
                        'tb_cdm_morador.saida as saida_morad',
                        'tb_cdm_morador.status as status_morad',
                        'tb_cdm_morador.rg as rg_morad',
                        'tb_cdm_morador.fone_principal as fone_principal_morad',
                        'tb_cdm_morador.fone_secundario as fone_secundario_morad',
                        'tb_cdm_morador.apartamento_id as apartamento_id_morad',
                        'tb_cdm_morador.parentesco_id as parentesco_id_morad',
                        'tb_cdm_morador.created_at as created_at_morad',
                        'tb_cdm_morador.updated_at as updated_at_morad')
                ->join('tb_cdm_morador', 'tb_cdm_area_morador.morador_id', '=', 'tb_cdm_morador.id')
                ->join('tb_cdm_area', 'tb_cdm_area_morador.area_id', '=', 'tb_cdm_area.id')
                ->orderBy('tb_cdm_area.titulo', 'asc')  
                ->orderBy('tb_cdm_morador.nome', 'asc')                              
                ->get();        
        foreach ($dados as $objeto) {
            $objeto->foto_morad = null;
        }                  

        return $dados;
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

        if($request->input('reserva') !== null || $request->input('reserva') !== ''){
            $seconds = $request->input('reserva') / 1000;
            $objeto->reserva = date("Y-m-d", $seconds);    
        }
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
    public function showMoradores($id){
        $dados = DB::table('tb_cdm_area_morador as t')
                ->select('m.*',
                        't.reserva',
                        't.status',
                        't.saldo')
                ->join('tb_cdm_morador as m', 't.morador_id', '=', 'm.id')
                ->where('t.area_id', $id)
                ->orderBy('m.nome', 'asc')                              
                ->get();

        foreach ($dados as $objeto) {
            $objeto->foto = null;
        }           

        return $dados;
    }    
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $objeto = AreaMorador::find($id);
        $objeto->area_id = $request->input('area_id');
        $objeto->morador_id = $request->input('morador_id');

        if($request->input('reserva') !== null || $request->input('reserva') !== ''){
            $seconds = $request->input('reserva') / 1000;
            $objeto->reserva = date("Y-m-d", $seconds);    
        }

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
