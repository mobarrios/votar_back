<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOpearativosMesasUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operativos_mesas_users', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->timestamps();
            $table->softDeletes();


            $table->integer('operativos_id')->unsigned();
            $table->foreign('operativos_id')->references('id')->on('operativos');

            $table->integer('mesas_id')->unsigned();
            $table->foreign('mesas_id')->references('id')->on('mesas');

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
        Schema::drop('operativos_mesas_users');
    }
}
