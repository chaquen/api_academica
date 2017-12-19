<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRespuestasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('respuestas', function (Blueprint $table) {
            $table->increments('id');
            $table->string("argumento_respuesta");
            $table->enum("es_correcta",["0","1"]);
            $table->integer("valor_respuesta");
            $table->integer("fk_id_pregunta")->unsigned();
            $table->foreign('fk_id_pregunta')->references('id')->on('preguntas')->onDelete('cascade');;
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
        Schema::drop('respuestas');
    }
}
