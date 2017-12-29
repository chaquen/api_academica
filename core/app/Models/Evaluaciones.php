<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluaciones extends Model
{
    //
    protected $fillable=['tipo_evaluacion','fk_id_actividad','fecha_evaluacion_inicio','fecha_evaluacion_fin','estado_evaluacion'];
}
