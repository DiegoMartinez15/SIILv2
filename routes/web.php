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

//Usuarios
Route::get('/usuarios', 'UsuarioController@index');
Route::get('/usuarios/getId', 'UsuarioController@getById');
Route::post('/usuarios/save', 'UsuarioController@store');
Route::put('/usuarios/update', 'UsuarioController@update');
Route::put('/usuarios/delete', 'UsuarioController@delete');
//coordinadores
Route::get('/coordinadores', 'CoordinadorController@index');

Route::post('/coordinadores/save', 'CoordinadorController@store');
Route::put('/coordinadores/update', 'CoordinadorController@update');
Route::put('/coordinadores/delete', 'CoordinadorController@delete');

//empresa
Route::get('/empresas', 'EmpresaController@index');
Route::post('/empresas/save', 'EmpresaController@store');
Route::put('/empresas/update', 'EmpresaController@update');
Route::put('/empresas/delete', 'EmpresaController@delete');
