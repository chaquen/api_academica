<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->increments('id');
            $table->string("nombre_usuario");
            $table->string("apellido_usuario");
            $table->date("fecha_nacimiento")->nullable();
            $table->string("correo_usuario");
            $table->string("documento_usuario")->nullable();
            $table->string("direccion_usuario")->nullable();
            $table->string("telefono_usuario")->nullable();
            $table->enum("estado_usuario",["0","1"]);
            $table->integer("fk_id_rol")->unsigned();
            $table->foreign('fk_id_rol')->references('id')->on('roles')->onDelete('cascade');;
            $table->string("password");
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('usuarios');
    }
}
