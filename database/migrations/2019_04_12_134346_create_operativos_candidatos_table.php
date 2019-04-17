<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOperativosCandidatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operativos_candidatos', function (Blueprint $table) {

            $table->increments('id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->integer('operativos_id')->unsigned();
            $table->foreign('operativos_id')->references('id')->on('operativos');

            $table->integer('candidatos_id')->unsigned();
            $table->foreign('candidatos_id')->references('id')->on('candidatos');
        });    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('operativos_candidatos');
    }
}
