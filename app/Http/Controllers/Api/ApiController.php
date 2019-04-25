<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;


class CandidatosController extends Controller
{

    public function getUsers()
    {
            $result = ['0'=>'edadsa','1'=>'dadas'];
        
        return response()->json($result,200);

    }


}