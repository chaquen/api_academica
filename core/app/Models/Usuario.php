<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    //
    protected $fillable=[ 'nombre_usuario','apellido_usuario','fecha_nacimiento','correo_usuario','documento_usuario','telefono_usuario','direccion_usuario','fk_id_rol','red','id_rol','password','remember_token'];
}
