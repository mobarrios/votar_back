<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;


class ApiController extends Controller
{

    public function getUsers()
    {
        $res = collect('results');


    $res->push([
        'nombre'=>'pepe',
        'apellido'=>'argento',
        'email' => 'mno@das.dcom'
    ]);
    $res->push([
        'nombre'=>'Juan',
        'apellido'=>'Perez',
        'email' => '1231@das.dcom'
    ]);


       

        
        return response()->json($res,200);

    }


}