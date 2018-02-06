<?php

namespace App\Http\Controllers;
use App\Models\Veiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\VeiculoFormRequest;
use Illuminate\Http\Response;

class VeiculoController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Veiculo $veiculo, Request $request) {
       // return Veiculo::all();
        $total = 0;
        $skip = 0;
        $take = 5;
        $order = 'tb_cdm_veiculo.descricao';
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
          $content = DB::table('tb_cdm_veiculo')
                ->select('tb_cdm_veiculo.id',
                        'tb_cdm_veiculo.descricao',
                        'tb_cdm_veiculo.placa',
                        'tb_cdm_veiculo.cor',
                        'tb_cdm_veiculo.tipo',
                        'tb_cdm_veiculo.created_at',
                        'tb_cdm_veiculo.updated_at',
                        'tb_cdm_veiculo.apartamento_id',
                        'tb_cdm_apartamento.numero as numero_apto',
                        'tb_cdm_apartamento.bloco as bloco_apto',
                        'tb_cdm_apartamento.bosque as bosque_apto')
                   ->join('tb_cdm_apartamento', 'tb_cdm_veiculo.apartamento_id', '=', 'tb_cdm_apartamento.id')
                   ->skip($skip)   
                   ->take($take)   
                   ->where('tb_cdm_veiculo.placa', 'like', '%' . $request->input('pesquisa') . '%')
                   ->orWhere('tb_cdm_veiculo.cor', 'like', '%' . $request->input('pesquisa') . '%')
                   ->orWhere('tb_cdm_veiculo.tipo', 'like', '%' . $request->input('pesquisa') . '%')
                   ->orWhere('tb_cdm_veiculo.descricao', 'like', '%' . $request->input('pesquisa') . '%')
                   ->orderBy($order, $sort)
                   ->get();

                   $total = DB::table('tb_cdm_veiculo')
                   ->select('tb_cdm_veiculo.id')
                   ->join('tb_cdm_apartamento', 'tb_cdm_veiculo.apartamento_id', '=', 'tb_cdm_apartamento.id')
                   ->where('tb_cdm_veiculo.placa', 'like', '%' . $request->input('pesquisa') . '%')
                   ->orWhere('tb_cdm_veiculo.cor', 'like', '%' . $request->input('pesquisa') . '%')
                   ->orWhere('tb_cdm_veiculo.tipo', 'like', '%' . $request->input('pesquisa') . '%')
                   ->orWhere('tb_cdm_veiculo.descricao', 'like', '%' . $request->input('pesquisa') . '%')
                   ->get()->count();     

               }else{
                  $content = DB::table('tb_cdm_veiculo')
                    ->select('tb_cdm_veiculo.id',
                            'tb_cdm_veiculo.descricao',
                            'tb_cdm_veiculo.placa',
                            'tb_cdm_veiculo.cor',
                            'tb_cdm_veiculo.tipo',
                            'tb_cdm_veiculo.created_at',
                            'tb_cdm_veiculo.updated_at',
                            'tb_cdm_veiculo.apartamento_id',
                            'tb_cdm_apartamento.numero as numero_apto',
                            'tb_cdm_apartamento.bloco as bloco_apto',
                            'tb_cdm_apartamento.bosque as bosque_apto')
                   ->join('tb_cdm_apartamento', 'tb_cdm_veiculo.apartamento_id', '=', 'tb_cdm_apartamento.id')              
                   ->skip($skip)   
                   ->take($take)   
                   ->orderBy($order, $sort)
                   ->get();

                   $total =  $veiculo->all()->count();      
               }

            return response($content)->header('X-Total-Registros', $total);        
           
    }


    public function all(Veiculo $veiculo) {
        return $veiculo->orderBy('descricao', 'asc')->get(); 
    }  

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VeiculoFormRequest $request) {
        $objeto = new Veiculo;
        $objeto->placa = $request->input('placa');
        $objeto->descricao = $request->input('descricao');
        $objeto->cor = $request->input('cor');
        $objeto->tipo = $request->input('tipo');
        $objeto->apartamento_id = $request->input('apartamento_id');
        $objeto->created_at = date("Y-m-d H:i:s");
        $objeto->save();

        return "Veiculo cadastrado com sucesso";
        
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
    public function update(VeiculoFormRequest $request, $id) {
        $objeto = Veiculo::find($id);
        $objeto->placa = $request->input('placa');
        $objeto->descricao = $request->input('descricao');
        $objeto->cor = $request->input('cor');
        $objeto->tipo = $request->input('tipo');
        $objeto->apartamento_id = $request->input('apartamento_id');        
        $objeto->updated_at = date("Y-m-d H:i:s");
        $objeto->save();
        return "Veiculo atualizado com sucesso";
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
        return "Veiculo excluido com sucesso";
    }

  

    
}
