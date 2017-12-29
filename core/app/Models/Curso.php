<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    //
    protected $fillable=['nombre_curso', 'descripcion_curso','duracion_curso','fecha_inicio_curso','fecha_fin_curso','fk_id_categoria_curso','tipo_curso'];
}
