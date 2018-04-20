<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo_orden');
            $table->date('fecha_inicio');
            $table->date('fecha_final');
            $table->integer('presupuesto_id');
            $table->integer('importe_total');
            $table->integer('dto');


            $table->integer('numero_serie'); 
            $table->integer('serie_partes');
            $table->string('falla_declarada'); 
            $table->string('observaciones'); 
            $table->string('observaciones_tecnicas'); 
            $table->integer('presupuesto_estimado'); 
            $table->integer('states_id'); 
            $table->integer('total'); 
            $table->integer('pagado'); 
            $table->integer('orden_manual'); 
            $table->string('observaciones_internas'); 
            
            /*
            Relations
            */

            $table->integer('users_id');
            $table->integer('equipments_id'); 
            $table->integer('brands_id');
            $table->integer('models_id'); 
            $table->integer('clients_id'); 
            
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('orders');
    }
}
