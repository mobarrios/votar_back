<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEscuelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('escuelas', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->string('nombre');
            $table->string('direccion');
            $table->text('observaciones')->nullable();
        });    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('escuelas');

    }
}
