<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVotosListasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('votos_listas', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->timestamps();
            $table->softDeletes();


            $table->integer('listas_id')->unsigned();
            $table->foreign('listas_id')->references('id')->on('listas');

            $table->integer('cantidad_votos');

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
        //
    }
}
