<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateOperativosMesasUsersVotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('votos', function (Blueprint $table) {

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
        Schema::table('votos', function (Blueprint $table) {
            $table->integer('operativos_mesas_id');
        });
    }
}
