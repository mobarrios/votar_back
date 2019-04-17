<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOperativosEscuelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operativos_escuelas', function (Blueprint $table) {

            $table->increments('id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->integer('operativos_id')->unsigned();
            $table->foreign('operativos_id')->references('id')->on('operativos');

            $table->integer('escuelas_id')->unsigned();
            $table->foreign('escuelas_id')->references('id')->on('escuelas');
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
