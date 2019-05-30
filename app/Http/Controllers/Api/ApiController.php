<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Repositories\Admin\EscuelasRepo;
use App\Http\Repositories\Admin\MesasRepo;
use App\Http\Repositories\Admin\OperativosRepo;
use Illuminate\Routing\Route;
use App\Entities\Admin\Votos;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Entities\Configs\User;
use Illuminate\Support\Str;




class ApiController extends Controller
{

    public function getUsers(Route $route)
    {


        if (Auth::once(['user_name' => $route->getParameter('user_name'), 'password' => $route->getParameter('password')]))
        {
                $user = User::find(Auth::id());
                $user->remember_token = Str::random(60);
                $user->save();
                
            return response()->json($user->remember_token,200);
        
        }else{

            return response()->json(false,401);
        }

        // $res =  $operativosRepo->getModel()
        // ->where('user_name',$route->getParameter('user_name'))
        // ->first();


        // $pass =  $operativosRepo->getModel()
        // ->where('user_name',$route->getParameter('user_name'))
        // ->first();


        
        return response()->json(['results'=>$res],200);

    }

    public function getOperativos(OperativosRepo $operativosRepo)
    {
        $res =  $operativosRepo->getModel()
        ->with('Escuelas')
        ->with('Escuelas.Mesas')
        ->with('Listas')
        ->with('Listas.Partidos')
        ->with('Listas.Partidos.Images')
        ->with('Listas.TipoOperativos')
        ->get();   
        
        return response()->json(['results'=>$res],200);
    }

    // public function getUsers()
    // {
    //     $res = collect();


    // $res->push([
    //     'nombre'=>'pepe',
    //     'apellido'=>'argento',
    //     'email' => 'mno@das.dcom'
    // ]);
    // $res->push([
    //     'nombre'=>'Juan',
    //     'apellido'=>'Perez',
    //     'email' => '1231@das.dcom'
    // ]);



        
    //     return response()->json(['results'=>$res],200);

    // }

    public function getEscuelas( EscuelasRepo $escuelasRepo)
    {
       $res =  $escuelasRepo->getModel()->with('Mesas')->get();
    
       return response()->json(['results'=>$res],200);
    } 

    public function getMesas( MesasRepo $mesasRepo, Route $route)
    {

       $res =  $mesasRepo->getModel()->with('Escuelas')->with('Escuelas.Operativos')->with('Escuelas.Operativos.Candidatos')->find($route->getParameter('id'));
    
       return response()->json(['results'=>$res],200);
    } 

    public function getCandidatos( OperativosRepo $operativosRepo, Route $route)
    {
       $res =  $operativosRepo->getModel()->with('Candidatos')->with('Candidatos.Partidos')->find($route->getParameter('id'));
    
       return response()->json(['results'=>$res],200);
    } 

     public function getListas( OperativosRepo $operativosRepo, Route $route)
    {
       $res =  $operativosRepo->getModel()->with('Listas')->with('Listas.Partidos')->with('Listas.Partidos.Images')->with('Listas.TipoOperativos')->find($route->getParameter('id'));
    
       return response()->json(['results'=>$res],200);
    } 


    public function postVotos(Route $route)
    {
        $votos = new Votos();

        $cantVotos = $route->getParameter('cantVotos');
        $idOperativos = $route->getParameter('idOperativos');
        $idMesas = $route->getParameter('idMesas');
        $idListas = $route->getParameter('idListas');


        $votos->total = $cantVotos;
        $votos->operativos_id = $idOperativos;
        $votos->listas_id = $idListas;
        $votos->mesas_id = $idMesas;

        $votos->save();

       return response()->json(true,200);
    }


}