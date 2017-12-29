<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Respuestas extends Model
{
    //
    protected $fillable=['argumento_respuesta', 'es_correcta','fk_id_pregunta'];
}
