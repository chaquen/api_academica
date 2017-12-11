<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notas extends Model
{
    //
    protected $fillable=['fk_id_dt_curso_usuario','fk_id_actividad','nota_esperada','nota_final'];
}
