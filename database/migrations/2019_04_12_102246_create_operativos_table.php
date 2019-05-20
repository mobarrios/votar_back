<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOperativosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operativos', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->string('nombre');
            $table->date('fecha');


            // $table->integer('tipo_operativos_id')->unsigned();
            // $table->foreign('tipo_operativos_id')->references('id')->on('tipo_operativos');

            $table->integer('niveles_operativos_id')->unsigned();
            $table->foreign('niveles_operativos_id')->references('id')->on('niveles_operativos');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('operativos');
    }
}
