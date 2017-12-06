<?php

namespace App\Http\Controllers;
use App\Models\Veiculo;
use Illuminate\Http\Request;

class VeiculoController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return Veiculo::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $objeto = new Veiculo;
        $objeto->placa = $request->input('placa');
        $objeto->descricao = $request->input('descricao');
        $objeto->cor = $request->input('cor');
        $objeto->tipo = $request->input('tipo');
        $objeto->apartamento_id = $request->input('apartamento_id');
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
        return Veiculo::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $objeto = Veiculo::find($id);
        $objeto->placa = $request->input('placa');
        $objeto->descricao = $request->input('descricao');
        $objeto->cor = $request->input('cor');
        $objeto->tipo = $request->input('tipo');
        $objeto->apartamento_id = $request->input('apartamento_id');        
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
        $objeto = Veiculo::find($id);
        $objeto->delete();
        return "Record successfully deleted #" . $id;
    }

    
}
