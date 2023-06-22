<?php

use Illuminate\Database\Seeder;

class TipoOperativoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_operativos')->insert([
            [
                'id'   => 1,
                'nombre' => 'Presidente-Vice',
            ],
            [
                'id'   => 2,
                'nombre' => 'Gobernadores',
            ],
            [
                'id'   => 3,
                'nombre' => 'Legisladores',
            ],
            [
                'id'   => 4,
                'nombre' => 'Concejales',
            ],
            [
                'id'   => 5,
                'nombre' => 'Intendentes',
            ],

        ]);
    }
}
