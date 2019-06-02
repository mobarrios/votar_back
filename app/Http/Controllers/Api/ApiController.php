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
use Illuminate\Support\Facades\DB;




class ApiController extends Controller
{

    public function getMesasByUsers(Route $route)
    {   
        //$res = User::with('Mesas')->with('Mesas.Escuelas')->with('Mesas.Escuelas.Operativos')->where('user_name', $route->getParameter('user_name'))->first();

        $res = DB::table('users')
        ->join('operativos_mesas_users','operativos_mesas_users.users_id','=','users.id')
        ->join('mesas','mesas.id','=','operativos_mesas_users.mesas_id')
        ->join('escuelas','escuelas.id','=','mesas.escuelas_id')
        ->join('operativos','operativos.id','=','operativos_mesas_users.operativos_id')
        ->join('niveles_operativos','niveles_operativos.id','=','operativos.niveles_operativos_id')
        ->where('users.user_name','=',$route->getParameter('user_name'))
        ->select('operativos.id as operativos_id',
            'operativos.nombre as operativos_nombre',
            'mesas.id as mesas_id',
            'mesas.numero as mesas_numero',
            'escuelas.id as escuelas_id',
            'escuelas.nombre as escuelas_nombre',
            'niveles_operativos.id as niveles_operativos_id',
            'niveles_operativos.nombre as niveles_operativos_nombre'
        )
        ->get();


      return response()->json(['results'=>$res],200);
    }

    public function getUsers(Route $route)
    {


        if (Auth::once(['user_name' => $route->getParameter('user_name'), 'password' => $route->getParameter('password')]))
        {
                $user = User::find(Auth::id());
                $user->remember_token = Str::random(60);
                $user->save();

            return response()->json($user,200);
        
        }else{

            return response()->json(false,401);
        }
    }

    public function getOperativos(Route $route,OperativosRepo $operativosRepo)
    {
        $userId = $route->getParameter('userId');

        // $res =  $operativosRepo->getModel()
        // ->with('Escuelas')
        // ->with('Escuelas.Mesas')
        // ->with('Listas')
        // ->with('Listas.Partidos')
        // ->with('Listas.Partidos.Images')
        // ->with('Listas.TipoOperativos')
        // ->with('Escuelas.Mesas.User')
        // // ->whereHas('Escuelas.Mesas.User',function($q) use ($userId) {
        // //     $q->where('users_id',$userId);
        // // })
        // ->get();   
        // 
        $res = DB::table('users')
        ->join('operativos_mesas_users','operativos_mesas_users.users_id','=','users.id')
        ->join('mesas','mesas.id','=','operativos_mesas_users.mesas_id')
        ->join('escuelas','escuelas.id','=','mesas.escuelas_id')
        ->join('operativos','operativos.id','=','operativos_mesas_users.operativos_id')
        ->join('niveles_operativos','niveles_operativos.id','=','operativos.niveles_operativos_id')
        ->where('users.id','=',$route->getParameter('userId'))
        ->select('operativos.id as operativos_id',
            'operativos.nombre as operativos_nombre',
            'mesas.id as mesas_id',
            'mesas.numero as mesas_numero',
            'escuelas.id as escuelas_id',
            'escuelas.nombre as escuelas_nombre',
            'niveles_operativos.id as niveles_operativos_id',
            'niveles_operativos.nombre as niveles_operativos_nombre'
        )
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

        $cantVotosRecurridos = $route->getParameter('total_recurridos');
        $cantVotosNulos = $route->getParameter('total_nulos');
        $cantVotosImpugnados = $route->getParameter('total_impugnados');
        $cantVotosBlancos = $route->getParameter('total_blancos');

        $votos->total = $cantVotos;
        $votos->operativos_id = $idOperativos;
        $votos->listas_id = $idListas;
        $votos->mesas_id = $idMesas;
        $votos->total_blancos = $cantVotosBlancos;
        $votos->total_impugnados = $cantVotosImpugnados;
        $votos->total_nulos = $cantVotosNulos;
        $votos->total_recurridos = $cantVotosRecurridos;


        $votos->save();

       return response()->json(true,200);
    }


}