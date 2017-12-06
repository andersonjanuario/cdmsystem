<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proprietario;

class ProprietarioController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Proprietario $prop) {
        return $prop->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
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

        return 'Proprietário record successfully created with id ' . $objeto->id;
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
    public function update(Request $request, $id) {
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
        return "Proprietário sucess updating user #" . $id;
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
        return "Proprietário record successfully deleted #" . $id;
    }

}
