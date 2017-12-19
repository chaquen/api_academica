<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRespuestasDelUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('respuestas_del_usuarios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("fk_id_usuario")->unsigned();
            $table->foreign('fk_id_usuario')->references('id')->on('usuarios')->onDelete('cascade');
            $table->integer("fk_id_evaluaciones")->unsigned();
            $table->foreign('fk_id_evaluaciones')->references('id')->on('evaluaciones')->onDelete('cascade');
            $table->integer("fk_id_det_pre_evaluacion")->unsigned();
            $table->foreign('fk_id_det_pre_evaluacion')->references('id')->on('preguntas_evaluacions')->onDelete('cascade');
            $table->integer("fk_id_respuestas")->unsigned();
            $table->foreign('fk_id_respuestas')->references('id')->on('respuestas')->onDelete('cascade');;
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
        Schema::drop('respuestas_del_usuarios');
    }
}
