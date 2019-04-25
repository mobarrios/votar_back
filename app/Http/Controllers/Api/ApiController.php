<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;


class ApiController extends Controller
{

    public function getUsers()
    {
        $resultado['results'] = [];
            array_push($resultado['results'],['nombre'=>'pepe','nombre'=>'argento']);

        
        return response()->json($resultado,200);

    }


}