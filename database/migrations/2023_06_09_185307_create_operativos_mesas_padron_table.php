<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOperativosMesasPadronTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operativos_mesas_padron', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->timestamps();
            $table->softDeletes();


            $table->integer('padrones_id')->unsigned();
            $table->foreign('padrones_id')->references('id')->on('padrones');

            $table->integer('referentes_id')->unsigned();
            $table->foreign('referentes_id')->references('id')->on('referentes');

            $table->boolean('voto')->nullable();

            $table->integer('operativos_mesas_id')->unsigned();
            $table->foreign('operativos_mesas_id')->references('id')->on('operativos_mesas');


        });    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('operativos_mesas_padron');
    }
}
