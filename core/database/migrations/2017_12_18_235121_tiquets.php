<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Tiquets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pines', function (Blueprint $table) {
            $table->increments('id');            
            $table->integer('fk_id_curso')->unsigned();
            $table->foreign('fk_id_curso')->references('id')->on('cursos')->onDelete('cascade');
            $table->string("pin");
            $table->enum("estado",["activo","redimido","cancelado"]);
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
