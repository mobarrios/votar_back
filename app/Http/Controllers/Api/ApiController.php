<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Repositories\Admin\EscuelasRepo;
use App\Http\Repositories\Admin\OperativosRepo;



class ApiController extends Controller
{

    public function getOperativos(OperativosRepo $operativosRepo)
    {
        $res =  $operativosRepo->getModel()->with('Escuelas')->with('Escuelas.Mesas')->get();
    
        return response()->json(['results'=>$res],200);
    }

    public function getUsers()
    {
        $res = collect();


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



        
        return response()->json(['results'=>$res],200);

    }

    public function getEscuelas( EscuelasRepo $escuelasRepo)
    {
       $res =  $escuelasRepo->getModel()->with('Mesas')->get();
    
       return response()->json(['results'=>$res],200);
    } 



}