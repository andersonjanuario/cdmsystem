<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proprietario;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProprietarioFormRequest;
use Illuminate\Http\Response;

class ProprietarioController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Proprietario $prop,Request $request) {

        //dd($request->input('pesquisa')); 
        $total = 0;
        $skip = 0;
        $take = 5;
        $order = 'nome';
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
            $content = $prop
                   ->skip($skip)   //Pagina atual
                   ->take($take)   //Total por Pagina
                   ->where('nome', 'like', '%' . $request->input('pesquisa') . '%')
                   ->orWhere('email', 'like', '%' . $request->input('pesquisa') . '%')
                   ->orderBy($order, $sort)
                   ->get();

                   $total = $prop
                   ->where('nome', 'like', '%' . $request->input('pesquisa') . '%')
                   ->orWhere('email', 'like', '%' . $request->input('pesquisa') . '%')
                   ->get()->count();     

               }else{
                $content = $prop
                   ->skip($skip)   //Pagina atual
                   ->take($take)   //Total por Pagina
                   ->orderBy($order, $sort)
                   ->get();

                   $total =  $prop->all()->count();      
               }



               foreach ($content as $objeto) {
                $objeto->foto = null;
            }

            return response($content)->header('X-Total-Registros', $total);     
        }


    public function all(Proprietario $prop) {
        $content = $prop->orderBy('nome', 'asc')->get(); 
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
    public function store(ProprietarioFormRequest $request) {
        $objeto = new Proprietario;

        $objeto->nome = $request->input('nome');
        $objeto->email = $request->input('email');
        $objeto->cpf = $request->input('cpf');
        $objeto->rg = $request->input('rg');
        $objeto->foto = $request->input('foto');
        $objeto->adimplente = $request->input('adimplente');
        $objeto->debito = $request->input('debito');
        $objeto->morador = $request->input('morador');
        $objeto->created_at = date("Y-m-d H:i:s");
        $objeto->fone_principal = $request->input('fone_principal');
        $objeto->fone_secundario = $request->input('fone_secundario');
        $objeto->save();

        return "Proprietário cadastrado com sucesso";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        return Proprietario::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProprietarioFormRequest $request, $id) {
        $objeto = Proprietario::find($id);
        $objeto->nome = $request->input('nome');
        $objeto->email = $request->input('email');
        $objeto->cpf = $request->input('cpf');
        $objeto->rg = $request->input('rg');
        $objeto->foto = $request->input('foto');
        $objeto->adimplente = $request->input('adimplente');
        $objeto->debito = $request->input('debito');
        $objeto->morador = $request->input('morador');
        $objeto->fone_principal = $request->input('fone_principal');
        $objeto->fone_secundario = $request->input('fone_secundario');
        
        $objeto->updated_at = date("Y-m-d H:i:s");
        $objeto->save();
        //dd($employee); debug do laravel.
        return "Proprietário atualizado com sucesso";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $objeto = Proprietario::find($id);
        $objeto->delete();
        return "Proprietário removido com sucesso";
    }

}
