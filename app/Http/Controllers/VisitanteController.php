<?php

namespace App\Http\Controllers;

use App\Models\Visitante;
use Illuminate\Http\Request;
use App\Models\VisitanteMorador;
use App\Http\Controllers\VisitanteMoradorController;

class VisitanteController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return Visitante::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        if($request->input('visitantes') !== null && count($request->input('visitantes')) > 0){
            foreach ($request->input('visitantes') as $visitante) {
                $objeto = new Visitante;
                $objeto->nome = $visitante['nome'];
                //$objeto->descricao = $visitante['descricao'];
                $objeto->cpf = $visitante['cpf'];
                $objeto->foto = $visitante['foto'];
                $objeto->idade = $visitante['idade'];
                $objeto->rg = $visitante['rg'];
                $objeto->created_at = date("Y-m-d H:i:s");
                //$objeto->fone_principal = $visitante['fone_principal'];
                $objeto->save();

                $visitanteMorador = new VisitanteMorador;
                $visitanteMorador->visitante_id = $objeto->id;
                $visitanteMorador->morador_id = $request->input('morador_id');
                $visitanteMorador->data_visita = date("Y-m-d");
                $visitanteMorador->created_at = date("Y-m-d H:i:s");
                $visitanteMorador->save();   

            }
        }

        return "Visitante(s) cadastrado com sucesso";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        return Visitante::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $objeto = Visitante::find($id);
        $objeto->nome = $request->input('nome');
        $objeto->descricao = $request->input('descricao');
        $objeto->cpf = $request->input('cpf');
        $objeto->foto = $request->input('foto');
        $objeto->idade = $request->input('idade');
        $objeto->rg = $request->input('rg');
        $objeto->fone_principal = $request->input('fone_principal');
        
        $objeto->updated_at = date("Y-m-d H:i:s");
        $objeto->save();
        return "Visitante(s) atualizado com sucesso";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $objeto = Visitante::find($id);
        $objeto->delete();
        return "Visitante(s) excluído com sucesso";
    }

}
