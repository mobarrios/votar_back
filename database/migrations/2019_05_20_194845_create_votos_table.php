<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votos', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->integer('total');

            $table->integer('operativos_id')->unsigned();
            $table->foreign('operativos_id')->references('id')->on('operativos');

            $table->integer('listas_id')->nullable()->unsigned();
            $table->foreign('listas_id')->references('id')->on('listas');

            $table->integer('mesas_id')->unsigned();
            $table->foreign('mesas_id')->references('id')->on('mesas');
        });    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('votos');
    }
}
