<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Usuario;

class UsuarioController extends Controller
{
    public function index(){
        $usuario =Usuario::join('tipos_usuarios','usuarios.idtipo_usuario','=','tipos_usuarios.id')
       ->select('usuarios.id','usuarios.nombre','usuarios.passwd','usuarios.idtipo_usuario',
       'tipos_usuarios.nombre as idtipo_usuario')->get();

       return $usuario;
        //$usuario =Usuario::orderBy('id','DESC')->get();
        //return $usuario;
  
    }

    public function store(Request $request)
    {
        $usuario = new Usuario();
        $usuario->nombre = $request->nombre;        
        $usuario->passwd = $request->passwd; 
        $usuario->idtipo_usuario ="1";
        $usuario->save();
    }

    public function update(Request $request)
    {
        $usuario =Usuario::findOrfail($request->id);
        $usuario->nombre = $request->nombre;
        $usuario->passwd = $request->passwd; 
        $usuario->idtipo_usuario ="1";
        $usuario->save();
    }

    public function delete(Request $request)
    {
        $usuario =Usuario::findOrfail($request->id);
        $usuario->delete();
        
    }

    public function getById(){
        $requisito=Usuario::where("idtipo_usuario",1)->get();
        return $requisito;
    }
}
