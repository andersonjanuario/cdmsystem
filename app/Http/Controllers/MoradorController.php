<?php

namespace App\Http\Controllers;
use App\Models\Morador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\MoradorFormRequest;

class MoradorController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Morador $morador,Request $request) {
        //return Morador::all();
        $total = 0;
        $skip = 0;
        $take = 5;
        $order = 'tb_cdm_morador.nome';
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
          $content = DB::table('tb_cdm_morador')
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
                        'tb_cdm_morador.parentesco_id',
                        'tb_cdm_parentesco.descricao as descricao_parent')
                   ->join('tb_cdm_apartamento', 'tb_cdm_morador.apartamento_id', '=', 'tb_cdm_apartamento.id')
                   ->join('tb_cdm_parentesco', 'tb_cdm_morador.parentesco_id', '=', 'tb_cdm_parentesco.id')                   
                   ->skip($skip)   
                   ->take($take)   
                   ->where('tb_cdm_morador.nome', 'like', '%' . $request->input('pesquisa') . '%')
                   ->orWhere('tb_cdm_morador.cpf', 'like', '%' . $request->input('pesquisa') . '%')
                   ->orWhere('tb_cdm_morador.rg', 'like', '%' . $request->input('pesquisa') . '%')
                   ->orWhere('tb_cdm_morador.fone_principal', 'like', '%' . $request->input('pesquisa') . '%')
                   ->orWhere('tb_cdm_morador.fone_secundario', 'like', '%' . $request->input('pesquisa') . '%')
                   ->orderBy($order, $sort)
                   ->get();

                   $total = DB::table('tb_cdm_morador')
                   ->select('tb_cdm_morador.id')
                   ->join('tb_cdm_apartamento', 'tb_cdm_morador.apartamento_id', '=', 'tb_cdm_apartamento.id')
                   ->where('tb_cdm_morador.nome', 'like', '%' . $request->input('pesquisa') . '%')
                   ->orWhere('tb_cdm_morador.cpf', 'like', '%' . $request->input('pesquisa') . '%')
                   ->orWhere('tb_cdm_morador.rg', 'like', '%' . $request->input('pesquisa') . '%')
                   ->orWhere('tb_cdm_morador.fone_principal', 'like', '%' . $request->input('pesquisa') . '%')
                   ->orWhere('tb_cdm_morador.fone_secundario', 'like', '%' . $request->input('pesquisa') . '%')
                   ->get()->count();     

               }else{
                 $content = DB::table('tb_cdm_morador')
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
                        'tb_cdm_morador.parentesco_id',
                        'tb_cdm_parentesco.descricao as descricao_parent')
                   ->join('tb_cdm_apartamento', 'tb_cdm_morador.apartamento_id', '=', 'tb_cdm_apartamento.id') 
                   ->join('tb_cdm_parentesco', 'tb_cdm_morador.parentesco_id', '=', 'tb_cdm_parentesco.id')                   
                   ->skip($skip)   
                   ->take($take)   
                   ->orderBy($order, $sort)
                   ->get();

                   $total =  $morador->all()->count();      
               }

            foreach ($content as $objeto) {
                $objeto->foto = null;
            }   

            return response($content)->header('X-Total-Registros', $total);        

    }

    public function all(Morador $morador) {
        $content = $morador->orderBy('nome', 'asc')->get(); 
        foreach ($content as $objeto) {
            $objeto->foto = null;
        }
        return $content;        
    }  


    public function findByApartamento(Morador $morador,$apartamento_id) {
        $content = $morador
                    ->where('tb_cdm_morador.apartamento_id', '=', $apartamento_id)
                    ->orderBy('nome', 'asc')->get(); 
        foreach ($content as $objeto) {
            $objeto->foto = null;
        }
        return $content;
    }         

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MoradorFormRequest $request) {
        $objeto = new Morador;
        $objeto->nome = $request->input('nome');
        $objeto->email = $request->input('email');
        $objeto->cpf = $request->input('cpf');
        
        $objeto->inquilino = $request->input('inquilino');
        $objeto->foto = $request->input('foto');
        $objeto->idade = $request->input('idade');
        
        if($request->input('entrada') !== null || $request->input('entrada') !== ''){
            $seconds = $request->input('entrada') / 1000;
            $objeto->entrada = date("Y-m-d H:i:s", $seconds);    
        }

        if($request->input('saida') !== null || $request->input('saida') !== ''){
            $seconds = $request->input('saida') / 1000;
            $objeto->saida = date("Y-m-d H:i:s", $seconds);    
        }

        $objeto->status = $request->input('status');
        $objeto->rg = $request->input('rg');
        $objeto->fone_principal = $request->input('fone_principal');
        $objeto->fone_secundario = $request->input('fone_secundario');
        
        
        $objeto->apartamento_id = $request->input('apartamento_id');
        $objeto->parentesco_id = $request->input('parentesco_id');
        $objeto->created_at = date("Y-m-d H:i:s");
        $objeto->save();
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        return Morador::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MoradorFormRequest $request, $id) {
        //dd($request->input('entrada'));
        $objeto = Morador::find($id);
        $objeto->nome = $request->input('nome');
        $objeto->email = $request->input('email');
        $objeto->cpf = $request->input('cpf');

        $objeto->inquilino = $request->input('inquilino');
        $objeto->foto = $request->input('foto');
        $objeto->idade = $request->input('idade');
        if($request->input('entrada') !== null && $request->input('entrada') !== ''){
            $seconds = $request->input('entrada') / 1000;
            $objeto->entrada = date("Y-m-d H:i:s", $seconds);    
        }else{
            $objeto->entrada = null;
        }

        if($request->input('saida') !== null && $request->input('saida') !== ''){
            $seconds = $request->input('saida') / 1000;
            $objeto->saida = date("Y-m-d H:i:s",  $seconds);    
        }else{
            $objeto->saida = null;
        }

        $objeto->status = $request->input('status');
        $objeto->rg = $request->input('rg');
        $objeto->fone_principal = $request->input('fone_principal');
        $objeto->fone_secundario = $request->input('fone_secundario');
        
        
        $objeto->apartamento_id = $request->input('apartamento_id');
        $objeto->parentesco_id = $request->input('parentesco_id');
        $objeto->updated_at = date("Y-m-d H:i:s");
        $objeto->save();
        return "Proprietário sucess updating user #" . $id;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $objeto = Morador::find($id);
        $objeto->delete();
        return "Record successfully deleted #" . $id;
    }

}
