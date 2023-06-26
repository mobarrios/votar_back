<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Admin\EscuelasRepo;
use App\Http\Repositories\Admin\MesasRepo;
use App\Http\Repositories\Admin\OperativosRepo;
use App\Entities\Admin\OperativosMesasPadron;
use Illuminate\Routing\Route;
use App\Entities\Admin\Votos;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Entities\Configs\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Entities\Admin\Imgs;
use Illuminate\Http\Request;
use JWTAuth;

class ApiV2Controller extends Controller{


    public function getUsers(Request $request){
       
        $username  = $request->user_name;
        $pass   = $request->password;
       
        if (! $username || ! $pass)
            return response()->json(['resp' => 'ERROR' ,'msg' => 'Datos vacios'], 403);

       
        if (Auth::once(['user_name' => $username, 'password' => $pass ]))
        {
            $user = User::find(Auth::id());
            $user->remember_token = Str::random(60);
            $user->save();

            return response()->json($user,200);
        
        }else{

            return response()->json(false,401);
        }
    }

    public function getPadronByMesa(Request $request){
        
        $mesaId         = $request->mesa_id;
        $operativoId    = $request->operativo_id;
        
        if (! $mesaId || ! $operativoId)
            return response()->json(['resp' => 'ERROR' ,'msg' => 'Datos vacios'], 403);

        $res = DB::table('operativos_mesas')
            ->join('operativos_mesas_padron','operativos_mesas_padron.operativos_mesas_id','=','operativos_mesas.id')
            ->join('padrones', 'operativos_mesas_padron.padrones_id', '=', 'padrones.id' )
            ->where('operativos_mesas.mesas_id','=', $mesaId)
            ->where('operativos_mesas.operativos_id','=', $operativoId)
            ->get();

        
        return response()->json(['results'=>$res],200);


    }

    public function getOperativosByUser(Request $request){
      
        $userId = $request->user_id;

        if (! $userId)
            return response()->json(['resp' => 'ERROR' ,'msg' => 'Datos vacios'], 403);

            $operativos = DB::table('users')
            ->select('operativos.id','operativos.nombre')
            ->join('operativos_mesas_users','operativos_mesas_users.users_id','=','users.id')
            ->join('operativos','operativos.id','=','operativos_mesas_users.operativos_id')
            ->where('users.id','=',$userId)
            ->groupBy('operativos.id')
            ->get();
        
        $resultado['results']['operativos'] = [];

        foreach ($operativos as $o){
            
            
            $escuelas = DB::table('operativos_escuelas')
            ->select('escuelas.nombre','escuelas.id')
            ->join('escuelas', 'operativos_escuelas.escuelas_id', '=', 'escuelas.id')
            ->where('operativos_escuelas.operativos_id', '=', $o->id)
            ->get();
            //dd($escuelas);
            $result= [];
           
            foreach($escuelas as $escuela){
                
                $mesas = DB::table('mesas')
                ->select('mesas.id','mesas.numero')
                ->join('operativos_mesas_users', 'operativos_mesas_users.mesas_id', '=', 'mesas.id')
                ->where('mesas.escuelas_id', $escuela->id)
                ->where('operativos_mesas_users.users_id', $userId)
                ->where('operativos_mesas_users.operativos_id', $o->id)
                ->get();
                
                if(count($mesas) > 0){
                    array_push($result, [
                        'nombre' => $escuela->nombre,
                        'mesas'  => $mesas,
                    ]); 
                }

            }
            

            array_push($resultado['results']['operativos'], [

                'id'        => $o->id,
                'nombre'    => $o->nombre,
                'escuelas'  => $result
                
               
            ]);
            

        }
    

        return response()->json($resultado,200);

    }

    public function voto(Request $request)
    {
        $idOperativos = $request->idOperativos;
        
        if (! $idOperativos)
            return response()->json(['resp' => 'ERROR' ,'msg' => 'Datos vacios'], 403);

        $votos = new Votos();
        
        $cantVotos = $request->cantVotos;
        $idOperativos = $request->idOperativos;
        $idMesas = $request->idMesas;
        $idListas = $request->idListas;
        $cantVotosRecurridos = $request->total_recurridos;
        $cantVotosNulos = $request->total_nulos;
        $cantVotosImpugnados = $request->total_impugnados;
        $cantVotosBlancos = $request->total_blancos;
        $operativosMesasId = $request->operativos_mesas_id;
  
        $votos->total = $cantVotos;
        $votos->operativos_id = $idOperativos;
        $votos->listas_id = $idListas;
        $votos->mesas_id = $idMesas;
        $votos->total_blancos = $cantVotosBlancos;
        $votos->total_impugnados = $cantVotosImpugnados;
        $votos->total_nulos = $cantVotosNulos;
        $votos->total_recurridos = $cantVotosRecurridos;
        $votos->operativos_mesas_id = $operativosMesasId;


        $votos->save();

       return response()->json(true,200);
    }

    public function votoPadron(Request $request){

        $id = $request->operativos_mesas_padron_id;
        
        $op = OperativosMesasPadron::find($id);
        $op->voto = $request->voto;
        $op->save();
        
        return response()->json(true,200);
     
    }

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

     public function getListas( OperativosRepo $operativosRepo, Request $request)
    {
        $idOperativos = $request->operativos_id;
        
        if (! $idOperativos)
            return response()->json(['resp' => 'ERROR' ,'msg' => 'Datos vacios'], 403);

        $res =  $operativosRepo->getModel()->with('Listas')->with('Listas.Partidos')->with('Listas.Partidos.Images')->with('Listas.TipoOperativos')
            ->whereHas('Listas',function($q){
            $q->orderBy('tipo_operativos_id','ASC');
        })->find($idOperativos);

       return response()->json(['results'=>$res],200);
    } 

    

}