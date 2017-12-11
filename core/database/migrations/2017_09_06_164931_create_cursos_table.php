<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cursos', function (Blueprint $table) {
            $table->increments('id');
            $table->string("nombre_curso");
            $table->string("descripcion_curso");
            $table->decimal("valor_curso",10,2)->nullable();
            $table->datetime("fecha_inicio_curso");
            $table->datetime("fecha_fin_curso");
            $table->integer("fk_id_categoria_curso")->unsigned();
            $table->foreign('fk_id_categoria_curso')->references('id')->on('categorias_cursos')->onDelete('cascade');;
            $table->enum("tipo_curso",["pago","gratis","otro"]);
            $table->enum("estado_curso",["0","1"])->default(1);
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
        Schema::drop('cursos');
    }
}
