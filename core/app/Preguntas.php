<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Preguntas extends Model
{
    //
    protected $fillable= ['argumento_pregunta', 'tipo_pregunta','estado_pregunta'];
}
