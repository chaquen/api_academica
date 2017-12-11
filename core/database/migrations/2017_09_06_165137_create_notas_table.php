<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("fk_id_dt_curso_usuario")->unsigned();
            $table->foreign('fk_id_dt_curso_usuario')->references('id')->on('detalle__usuario__cursos')->onDelete('cascade');;
            $table->integer("fk_id_actividad")->unsigned();
            $table->foreign('fk_id_actividad')->references('id')->on('actividades')->onDelete('cascade');
            $table->integer("nota_esperada");
            $table->integer("nota_final");
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
        Schema::drop('notas');
    }
}
