<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;


class ApiController extends Controller
{

    public function getUsers()
    {
        $resultado['results'] = [];
            array_push($resultado['results'],[
                [
                    'nombre'=>'pepe',
                    'apellido'=>'argento',
                    'email' => 'mno@das.dcom'
                ] ,
                [
                    'nombre'=>'Juan',
                    'apellido'=>'Perez',
                    'email' => '1231@das.dcom'
                ] 
                ]);

        
        return response()->json($resultado,200);

    }


}