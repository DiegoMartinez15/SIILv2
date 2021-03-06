<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\RequisitosOferta;
class RequisitoController extends Controller
{

    public function index(){
        $requisito = RequisitosOferta::orderBy('id','DESC')->get();
        return $requisito;
  
    }
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function obtenerform(Request $request)
    {   

        $requisito =RequisitosOferta::join('empresas','requisitos.idempresa','=','empresas.id')
        ->select('requisitos.*',
        'empresas.nombre as idempresa')
        ->Where("requisitos.id",$request->id)->get();

        return $requisito;

        //$requisito=RequisitosOferta::where("id",$request->id)->get();
        //return $requisito;
    }
}
