<?php

namespace App\Http\Controllers;
use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Area $area,Request $request) {

        //dd($request->input('pesquisa')); 
        $total = 0;
        $skip = 0;
        $take = 5;
        $order = 'titulo';
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
            $content = $area
                   ->skip($skip)   //Pagina atual
                   ->take($take)   //Total por Pagina
                   ->where('titulo', 'like', '%' . $request->input('pesquisa') . '%')
                   ->orWhere('descricao', 'like', '%' . $request->input('pesquisa') . '%')
                   ->orderBy($order, $sort)
                   ->get();

                   $total = $area
                   ->where('titulo', 'like', '%' . $request->input('pesquisa') . '%')
                   ->orWhere('descricao', 'like', '%' . $request->input('pesquisa') . '%')
                   ->get()->count();     

        }else{
                $content = $area
                   ->skip($skip)   //Pagina atual
                   ->take($take)   //Total por Pagina
                   ->orderBy($order, $sort)
                   ->get();

                   $total =  $area->all()->count();      
        }
            return response($content)->header('X-Total-Registros', $total);     
    }


    public function all(Area $area) {
        $content = $area->orderBy('titulo', 'asc')->get(); 
        return $content;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $objeto = new Area;
        $objeto->titulo = $request->input('titulo');
        $objeto->descricao = $request->input('descricao');
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
        return Area::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $objeto = Area::find($id);
        $objeto->titulo = $request->input('titulo');
        $objeto->descricao = $request->input('descricao');
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
        $objeto = Area::find($id);
        $objeto->delete();
        return "Record successfully deleted #" . $id;
    }
    
}
