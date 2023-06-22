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
                'nombre' => 'Nacional',
            ],
            [
                'id'   => 2,
                'nombre' => 'Provincial',
            ],
            [
                'id'   => 3,
                'nombre' => 'Municipal',
            ],

        ]);
    }
}
