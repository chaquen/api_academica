<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    //
    protected $fillable=['nombre_modulo', 'descripcion_modulo',"objetivos_modulo","fk_id_curso",'fecha_inicio_modulo','fecha_fin_modulo','numero_de_modulo'];
}
