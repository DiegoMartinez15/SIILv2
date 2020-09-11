<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = "usuarios";
    protected $fillable=['nombre','passwd','idtipo_usuario'];

    public function coordinador(){
        return $this->hasMany('App/Coordinador');
    }
}
