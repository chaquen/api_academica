<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreguntasEvaluacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preguntas_evaluacions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("fk_id_pregunta")->unsigned();
            $table->foreign('fk_id_pregunta')->references('id')->on('preguntas')->onDelete('cascade');;
            $table->integer("fk_id_evaluacion")->unsigned();
            $table->foreign('fk_id_evaluacion')->references('id')->on('evaluaciones')->onDelete('cascade');;
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
        Schema::drop('preguntas_evaluacions');
    }
}
