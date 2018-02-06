<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'proprietario'], function () {
    Route::get('', 'ProprietarioController@index');
    Route::get('/all', 'ProprietarioController@all');
    Route::get('/{id}', 'ProprietarioController@show');
    Route::post('', 'ProprietarioController@store');
    Route::put('/{id}', 'ProprietarioController@update');
    Route::delete('/{id}', 'ProprietarioController@destroy');
});

Route::group(['prefix' => 'apartamento'], function () {
    Route::get('', 'ApartamentoController@index');
    Route::get('/all', 'ApartamentoController@all');
    Route::get('/{id}', 'ApartamentoController@show');    
    Route::post('', 'ApartamentoController@store');
    Route::put('/{id}', 'ApartamentoController@update');
    Route::delete('/{id}', 'ApartamentoController@destroy');
});

Route::group(['prefix' => 'area'], function () {
    Route::get('', 'AreaController@index');
    Route::get('/all', 'AreaController@all');
    Route::get('/{id}', 'AreaController@show');
    Route::post('', 'AreaController@store');
    Route::put('/{id}', 'AreaController@update');
    Route::delete('/{id}', 'AreaController@destroy');
});

Route::group(['prefix' => 'veiculo'], function () {
    Route::get('', 'VeiculoController@index');
    Route::get('/all', 'VeiculoController@all');
    Route::get('/{id}', 'VeiculoController@show');
    Route::post('', 'VeiculoController@store');
    Route::put('/{id}', 'VeiculoController@update');
    Route::delete('/{id}', 'VeiculoController@destroy');
});

Route::group(['prefix' => 'visitante'], function () {
    Route::get('', 'VisitanteController@index');
    Route::get('/{id}', 'VisitanteController@show');
    Route::post('', 'VisitanteController@store');
    Route::put('/{id}', 'VisitanteController@update');
    Route::delete('/{id}', 'VisitanteController@destroy');
});

Route::group(['prefix' => 'morador'], function () {
    Route::get('', 'MoradorController@index');
    Route::get('/all', 'MoradorController@all');
    Route::get('/findByApartamento/{apartamento_id}', 'MoradorController@findByApartamento');    
    Route::get('/{id}', 'MoradorController@show');
    Route::post('', 'MoradorController@store');
    Route::put('/{id}', 'MoradorController@update');
    Route::delete('/{id}', 'MoradorController@destroy');
});

Route::group(['prefix' => 'parentesco'], function () {
    Route::get('', 'ParentescoController@index');
    Route::get('/{id}', 'ParentescoController@show');
});


Route::group(['prefix' => 'visitantemorador'], function () {
    Route::get('', 'VisitanteMoradorController@index');
    Route::get('/moradores/{id}', 'VisitanteMoradorController@showMoradores');
    Route::get('/visitantes/{id}', 'VisitanteMoradorController@showVisitantes');
    Route::get('/data', 'VisitanteMoradorController@findByDateMorador');    
    Route::post('', 'VisitanteMoradorController@store');
    Route::put('/{id}', 'VisitanteMoradorController@update');
    Route::delete('/{id}', 'VisitanteMoradorController@destroy');
});

Route::group(['prefix' => 'areamorador'], function () {
    Route::get('', 'AreaMoradorController@index');
    Route::get('/all', 'AreaMoradorController@all');
    Route::get('/moradores/{id}', 'AreaMoradorController@showMoradores');
    Route::get('/areas/{id}', 'AreaMoradorController@showAreas');
    Route::post('', 'AreaMoradorController@store');
    Route::put('/{id}', 'AreaMoradorController@update');
    Route::delete('/{id}', 'AreaMoradorController@destroy');
});
