<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;


class ApiController extends Controller
{

    public function getUsers()
    {
        $resultado['results'] = [];
            array_push($resultado['results'],['das'=>'dasd','dadasdas'=>'xss']);

        
        return response()->json($resultado,200);

    }


}