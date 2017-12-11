<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleUsuarioCursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle__usuario__cursos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("fk_id_curso")->unsigned();
            $table->foreign('fk_id_curso')->references('id')->on('cursos')->onDelete('cascade');;
            $table->integer("fk_id_usuario")->unsigned();
            $table->foreign('fk_id_usuario')->references('id')->on('usuarios')->onDelete('cascade');;
            $table->enum("rol",["profesor","alumno"]);           
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
        Schema::drop('detalle__usuario__cursos');
    }
}
