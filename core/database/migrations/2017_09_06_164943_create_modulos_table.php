<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modulos', function (Blueprint $table) {
            $table->increments('id');
            $table->string("nombre_modulo");
            $table->string("descripcion_modulo");
            $table->integer("fk_id_curso")->unsigned();
            $table->foreign('fk_id_curso')->references('id')->on('cursos')->onDelete('cascade');;
            $table->datetime("fecha_inicio_modulo");
            $table->datetime("fecha_fin_modulo");
            $table->integer("numero_de_modulo");
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
        Schema::drop('modulos');
    }
}
