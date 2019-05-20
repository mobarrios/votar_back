<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listas', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();

            $table->string('nombre');

            $table->integer('partidos_id')->unsigned();
            $table->foreign('partidos_id')->references('id')->on('partidos');

            $table->integer('tipo_operativos_id')->unsigned();
            $table->foreign('tipo_operativos_id')->references('id')->on('tipo_operativos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('listas');
    }
}
