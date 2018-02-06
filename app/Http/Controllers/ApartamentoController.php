<?php

namespace App\Http\Controllers;
use Exception;
use App\Models\Apartamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ApartamentoFormRequest;
use Illuminate\Http\Response;

class ApartamentoController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Apartamento $apto, Request $request) {
        $total = 0;
        $skip = 0;
        $take = 5;
        $order = 'tb_cdm_apartamento.bosque';
        $sort = 'asc';        
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
          $content = DB::table('tb_cdm_apartamento')
                ->select('tb_cdm_apartamento.id',
                        'tb_cdm_apartamento.numero',
                        'tb_cdm_apartamento.bloco',
                        'tb_cdm_apartamento.bosque',
                        'tb_cdm_apartamento.created_at',
                        'tb_cdm_apartamento.updated_at',
                        'tb_cdm_apartamento.proprietario_id',
                        'tb_cdm_proprietario.nome as nome_prop',
                        'tb_cdm_proprietario.cpf as cpf_prop',
                        'tb_cdm_proprietario.fone_principal as fone_principal_prop',
                        'tb_cdm_proprietario.fone_secundario as fone_secundario_prop',
                        'tb_cdm_proprietario.rg as rg_prop')
                ->join('tb_cdm_proprietario', 'tb_cdm_apartamento.proprietario_id', '=', 'tb_cdm_proprietario.id')
                   ->skip($skip)   //Pagina atual
                   ->take($take)   //Total por Pagina
                   ->where('tb_cdm_apartamento.numero', '=', $request->input('pesquisa') )
                   ->orWhere('tb_cdm_apartamento.bloco', '=', $request->input('pesquisa') )                   
                   ->orWhere('tb_cdm_apartamento.bosque', '=', $request->input('pesquisa') )                   
                   ->orWhere('tb_cdm_proprietario.nome', 'like', '%' . $request->input('pesquisa') . '%')
                   ->orderBy($order, $sort)
                   ->get();

                $total = DB::table('tb_cdm_apartamento')
                ->select('tb_cdm_apartamento.id')
                ->join('tb_cdm_proprietario', 'tb_cdm_apartamento.proprietario_id', '=', 'tb_cdm_proprietario.id')
                   ->where('tb_cdm_apartamento.numero', '=', $request->input('pesquisa') )
                   ->orWhere('tb_cdm_apartamento.bloco', '=', $request->input('pesquisa') )                   
                   ->orWhere('tb_cdm_apartamento.bosque', '=', $request->input('pesquisa') )                   
                   ->orWhere('tb_cdm_proprietario.nome', 'like', '%' . $request->input('pesquisa') . '%')
                   ->get()->count();     

               }else{
            $content = DB::table('tb_cdm_apartamento')
                ->select('tb_cdm_apartamento.id',
                        'tb_cdm_apartamento.numero',
                        'tb_cdm_apartamento.bloco',
                        'tb_cdm_apartamento.bosque',
                        'tb_cdm_apartamento.created_at',
                        'tb_cdm_apartamento.updated_at',
                        'tb_cdm_apartamento.proprietario_id',
                        'tb_cdm_proprietario.nome as nome_prop',
                        'tb_cdm_proprietario.cpf as cpf_prop',
                        'tb_cdm_proprietario.fone_principal as fone_principal_prop',
                        'tb_cdm_proprietario.fone_secundario as fone_secundario_prop',
                        'tb_cdm_proprietario.rg as rg_prop')
                    ->join('tb_cdm_proprietario', 'tb_cdm_apartamento.proprietario_id', '=', 'tb_cdm_proprietario.id')                
                   ->skip($skip)   //Pagina atual
                   ->take($take)   //Total por Pagina
                   ->orderBy($order, $sort)
                   ->get();

                   $total =  $apto->all()->count();      
               }

            return response($content)->header('X-Total-Registros', $total);        
    }


    private function exists(Request $request){
        $total = Apartamento::where('numero', '=', $request->input('numero') )
                           ->where('bloco', '=', $request->input('bloco') )                   
                           ->where('bosque', '=', $request->input('bosque') )  
                           ->where('proprietario_id', '=', $request->input('proprietario_id') )  
                           ->get()->count();

        return $total;                   
           
    }

    public function all(Apartamento $apto) {
        return $apto->orderBy('bosque', 'asc')->orderBy('bloco', 'asc')->orderBy('numero', 'asc')->get(); 
    }  

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApartamentoFormRequest $request) {

        if($this->exists($request) === 0){

            $objeto = new Apartamento;
            $objeto->numero = $request->input('numero');
            $objeto->bloco = $request->input('bloco');
            $objeto->bosque = $request->input('bosque');
            $objeto->proprietario_id = $request->input('proprietario_id');
            $objeto->created_at = date("Y-m-d H:i:s");
            $objeto->save();
        }else{
            throw new Exception("Apartamento ja existe!");
        }
        return "Apartamento cadastrado com sucesso";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        return Apartamento::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ApartamentoFormRequest $request, $id) {
        $objeto = Apartamento::find($id);
        $objeto->numero = $request->input('numero');
        $objeto->bloco = $request->input('bloco');
        $objeto->bosque = $request->input('bosque');
        $objeto->proprietario_id = $request->input('proprietario_id');
        $objeto->updated_at = date("Y-m-d H:i:s");
        $objeto->save();
        return "Apartamento atualizado com sucesso";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $objeto = Apartamento::find($id);
        $objeto->delete();
        return "Apartamento removido com sucesso";
    }


  

}
