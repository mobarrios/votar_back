<?php

use Illuminate\Database\Seeder;

class EstadosMesasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estados_mesas')->insert([
            
            [
                'id'   => 1,
                'descripcion' => 'Pendiente',
            ],
            [
                'id'   => 2,
                'descripcion' => 'Validado',
            ],
            [
                'id'   => 3,
                'descripcion' => 'Impugnado',
            ],
         
            [
                'id'   => 4,
                'descripcion' => 'Estimado',
            ]
        ]);
    }
}
