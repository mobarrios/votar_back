<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateVotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('votos', function (Blueprint $table) {

            $table->integer('total_blancos');
            $table->integer('total_nulos');
            $table->integer('total_recurridos');
            $table->integer('total_impugnados');

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
            
            $table->integer('total_blancos');
            $table->integer('total_nulos');
            $table->integer('total_recurridos');
            $table->integer('total_impugnados');       
         });
    }
}
