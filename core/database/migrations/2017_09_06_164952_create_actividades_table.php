<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActividadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividades', function (Blueprint $table) {
            $table->increments('id');
            $table->string("nombre_actividad");
            $table->enum("tipo_actividad",["documento","video","evento","evaluacion"]);
            $table->datetime("activo_desde")->nullable();
            $table->datetime("activo_hasta")->nullable();
            $table->enum("estado_actividad",["0","1"])->default(1);
            $table->string("actividad_recurso");
            $table->integer("fk_id_modulo_curso")->unsigned();
            $table->foreign('fk_id_modulo_curso')->references('id')->on('modulos')->onDelete('cascade');;
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
        Schema::drop('actividades');
    }
}
