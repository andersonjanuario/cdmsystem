<?php

namespace App\Http\Controllers;

use App\Models\Apartamento;
use Illuminate\Http\Request;

class ApartamentoController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return Apartamento::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $objeto = new Apartamento;
        $objeto->numero = $request->input('numero');
        $objeto->bloco = $request->input('bloco');
        $objeto->bosque = $request->input('bosque');
        $objeto->proprietario_id = $request->input('proprietario_id');
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
        return Apartamento::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $objeto = Apartamento::find($id);
        $objeto->numero = $request->input('numero');
        $objeto->bloco = $request->input('bloco');
        $objeto->bosque = $request->input('bosque');
        $objeto->proprietario_id = $request->input('proprietario_id');
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
        $objeto = Apartamento::find($id);
        $objeto->delete();
        return "Record successfully deleted #" . $id;
    }

}
