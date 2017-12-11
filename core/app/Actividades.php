<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actividades extends Model
{
    //
    protected $fillable=['nombre_actividad','tipo_actividad','activo_desde','activo_hasta','estado_actividad','actividad_recurso','fk_id_modulo_curso'];
}
