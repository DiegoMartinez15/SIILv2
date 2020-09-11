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
    return view('index');
});

Route::get('/requisitos/all', 'RequisitoController@index');

Route::get('/requisitos', 'RequisitoController@obtenerform');

Route::get('/oferta', 'OfertaController@index');

Route::get('/areas', 'AreaController@index');
Route::post('/areas/save', 'AreaController@store');
Route::put('/areas/update', 'AreaController@update');

Route::put('/areas/delete', 'AreaController@delete');
