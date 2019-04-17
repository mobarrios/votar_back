<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMesasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mesas', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->string('numero');
        

            $table->integer('escuelas_id')->unsigned();
            $table->foreign('escuelas_id')->references('id')->on('escuelas');

            $table->integer('users_id')->unsigned();
            $table->foreign('users_id')->references('id')->on('users');
        });    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('mesas');
    }
}
