<?php

use Illuminate\Database\Seeder;
use App\Entities\Admin\Padron as Padrones;

class PadronFakeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
       
        for ($i = 1; $i < 200; $i++){
            DB::table('padrones')->insert([
                [
                    'id' => $i,
                    'nombre' => $faker->firstName,
                    'apellido' => $faker->lastName,
                    'dni' => rand(11111111,99999999),
                    'domicilio' => $faker->address,
                    'nro_orden' => rand(111111,999999),
                    'nro_afiliado' => rand(111111,999999),
                ]

            ]);
        }

        for ($i = 1; $i < 200; $i++){
            DB::table('referentes')->insert([
                [
                    'id' => $i,
                    'nombre' => $faker->firstName,
                    'apellido' => $faker->lastName,
                    'domicilio' => $faker->address,
                    'telefono' => $faker->phoneNumber,
                    'mail' => 'prueba@gmail.com'
                ]

            ]);
        }
        
        $padron = Padrones::all();
       
        foreach($padron as $p){
            DB::table('operativos_mesas_padron')->insert([
                [
                 
                    'padrones_id' => $p->id,
                    'referentes_id' => 1,
                    'voto' => '',
                    'operativos_mesas_id' => 1
                   
                ]

            ]);
        }
    }
}
