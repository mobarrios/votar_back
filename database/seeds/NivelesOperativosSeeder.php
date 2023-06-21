<?php

use Illuminate\Database\Seeder;

class NivelesOperativosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('niveles_operativos')->insert([
            [
                'id'   => 1,
                'descripcion' => 'Nacional',
            ],
            [
                'id'   => 2,
                'descripcion' => 'Provincial',
            ],
            [
                'id'   => 3,
                'descripcion' => 'Municipal',
            ],

        ]);
    }
}
