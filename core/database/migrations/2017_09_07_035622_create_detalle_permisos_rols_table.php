<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetallePermisosRolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_permisos_rols', function (Blueprint $table) {
            $table->increments('id');
             $table->integer('fk_id_rol')->unsigned();
            $table->foreign('fk_id_rol')->references('id')->on('roles')->onDelete('cascade');;
            $table->integer('fk_id_permiso')->unsigned();
            $table->foreign('fk_id_permiso')->references('id')->on('permisos')->onDelete('cascade');;
            $table->enum('consultar',['0','1'])->default('0');
            $table->enum('editar',['0','1'])->default('0');
            $table->enum('crear',['0','1'])->default('0');
            $table->enum('eliminar',['0','1'])->default('0');
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
        Schema::drop('detalle_permisos_rols');
    }
}
