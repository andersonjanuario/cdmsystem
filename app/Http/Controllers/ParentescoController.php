<?php

namespace App\Http\Controllers;
use App\Models\Parentesco;
//use Illuminate\Http\Request;

class ParentescoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return Parentesco::all();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        return Parentesco::find($id);
    }


    
}
