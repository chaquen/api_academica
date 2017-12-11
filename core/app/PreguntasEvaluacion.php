<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PreguntasEvaluacion extends Model
{
    //
    protected $fillable=['fk_id_pregunta', 'fk_id_evaluacion'];
}
