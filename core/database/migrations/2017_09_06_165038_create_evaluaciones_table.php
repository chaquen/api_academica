<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->enum("tipo_evaluacion",["examen","encuesta"]);
            $table->integer("fk_id_actividad")->unsigned();
            $table->foreign('fk_id_actividad')->references('id')->on('cursos')->onDelete('cascade');;
            $table->datetime("fecha_evaluacion_inicio");
            $table->datetime("fecha_evaluacion_fin");
            $table->enum("estado_evaluacion",["0","1"])->default("1");
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
        Schema::drop('evaluaciones');
    }
}
