<?php

namespace App\Http\Controllers;
use App\Models\Morador;
use Illuminate\Http\Request;

class MoradorController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return Morador::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $objeto = new Morador;
        $objeto->nome = $request->input('nome');
        $objeto->email = $request->input('email');
        $objeto->cpf = $request->input('cpf');
        
        $objeto->inquilino = $request->input('inquilino');
        $objeto->foto = $request->input('foto');
        $objeto->idade = $request->input('idade');
        $objeto->entrada = $request->input('entrada');
        $objeto->saida = $request->input('saida');
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
    public function update(Request $request, $id) {
        $objeto = Morador::find($id);
        $objeto->nome = $request->input('nome');
        $objeto->email = $request->input('email');
        $objeto->cpf = $request->input('cpf');
        
        $objeto->inquilino = $request->input('inquilino');
        $objeto->foto = $request->input('foto');
        $objeto->idade = $request->input('idade');
        $objeto->entrada = $request->input('entrada');
        $objeto->saida = $request->input('saida');
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
