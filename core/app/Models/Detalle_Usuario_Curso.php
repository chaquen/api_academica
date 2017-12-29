<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detalle_Usuario_Curso extends Model
{
    //
    protected $fillable=['fk_id_curso','fk_id_usuario','rol'];
}
