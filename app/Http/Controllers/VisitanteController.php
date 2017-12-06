<?php

namespace App\Http\Controllers;

use App\Models\Visitante;
use Illuminate\Http\Request;

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
        $objeto = new Visitante;
        $objeto->nome = $request->input('nome');
        $objeto->descricao = $request->input('descricao');
        $objeto->cpf = $request->input('cpf');
        $objeto->foto = $request->input('foto');
        $objeto->idade = $request->input('idade');
        $objeto->rg = $request->input('rg');
        $objeto->created_at = date("Y-m-d H:i:s");
        $objeto->fone_principal = $request->input('fone_principal');

        $objeto->save();
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
        return "Proprietário sucess updating user #" . $id;
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
        return "Record successfully deleted #" . $id;
    }

}
