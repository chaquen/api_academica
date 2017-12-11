<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RespuestasDelUsuario extends Model
{
    //
    protected $fillable=['fk_id_det_pre_evaluacion','fk_id_respuestas','comentario_respuesta'];
}
