<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Admin\EscuelasRepo;
use App\Http\Repositories\Admin\MesasRepo;
use App\Http\Repositories\Admin\OperativosRepo;
use App\Entities\Admin\OperativosMesasPadron;
use Illuminate\Routing\Route;
use App\Entities\Admin\Votos;
use App\Entities\Admin\VotosListas;
use App\Entities\Admin\OperativosMesas;
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
        
        $mesaId         = $request->mesas_id;
        $operativoId    = $request->operativos_id;
        
        if (! $mesaId || ! $operativoId)
            return response()->json(['resp' => 'ERROR' ,'msg' => 'Datos vacios'], 403);

        $res = DB::table('operativos_mesas')
            
            ->select( 
                'operativos_mesas_padron.id',
                'padrones.nombre',
                'padrones.apellido',
                'padrones.dni',
                'padrones.nro_afiliado',
                'padrones.domicilio',
                'padrones.nro_orden',
                'operativos_mesas_padron.voto',
                DB::raw("CONCAT(referentes.nombre, ' ', referentes.apellido) AS referente")
            )
            ->join('operativos_mesas_padron','operativos_mesas_padron.operativos_mesas_id','=','operativos_mesas.id')
            ->join('padrones', 'operativos_mesas_padron.padrones_id', '=', 'padrones.id' )
            ->join('referentes','operativos_mesas_padron.referentes_id','=','referentes.id')
            ->where('operativos_mesas.mesas_id','=', $mesaId)
            ->where('operativos_mesas.operativos_id','=', $operativoId)
            ->orderBy('padrones.apellido', 'asc')
            ->get();

        
        return response()->json(['results'=>$res],200);


    }

    public function getOperativosByUser(Request $request){
      
        $userId = $request->users_id;

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

    public function votoByLista(Request $request)
    {
        $idVotoLista = $request->votos_listas_id;
     
        if (! $idVotoLista )
            return response()->json(['resp' => 'ERROR' ,'msg' => 'Datos vacios'], 403);
        
        $votoLista = VotosListas::find($idVotoLista);

        if(!$votoLista)
            return response()->json(['resp' => 'ERROR' ,'msg' => 'El voto lista no existe'], 403);
        
        $votoLista->cantidad_votos = $request->cantidad_votos;
        $votoLista->save();

        return response()->json(true,200);
    }

    public function votoByMesa(Request $request)
    {   
        $idOperativos = $request->operativos_id;
        $idMesa = $request->mesas_id;
     
        if (! $idOperativos || !$idMesa)
            return response()->json(['resp' => 'ERROR' ,'msg' => 'Datos vacios'], 403);
        
        $operativoMesa = OperativosMesas::where('operativos_id',$idOperativos)->where('mesas_id',$idMesa)->first(); 
       
        if(!$operativoMesa)
            return response()->json(['resp' => 'ERROR' ,'msg' => 'El operativo mesa no existe'], 403);

        if($operativoMesa->VotoMesa){
            $voto = $operativoMesa->VotoMesa;
        }else{
            $voto = new Votos();
        }   
        
        $voto->operativos_mesas_id = $operativoMesa->id;
        $voto->total_blancos = $request->total_blancos;
        $voto->total_impugnados = $request->total_impugnados;
        $voto->total_nulos = $request->total_nulos;
        $voto->total_recurridos = $request->total_recurridos;
        $voto->total = $request->total;
     
        $voto->save();

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
        $idMesas = $request->mesas_id;
        
        if (! $idOperativos)
            return response()->json(['resp' => 'ERROR' ,'msg' => 'Datos vacios'], 403);

        $operativoMesa = OperativosMesas::where('operativos_id',$idOperativos)->where('mesas_id',$idMesas)->first(); 
        
        $result = $partidos = DB::table('votos_listas')
            ->select('partidos.nombre as partido', 'listas.nombre as lista', 'votos_listas.cantidad_votos', 'listas.id as listas_id', 'votos_listas.operativos_mesas_id as operativos_mesas_id', 'images.path as url', 'votos_listas.id as votos_listas_id' )
            ->join('listas', 'votos_listas.listas_id', '=', 'listas.id')
            ->join('partidos', 'listas.partidos_id', '=', 'partidos.id')
            ->leftJoin('images', 'images.imageable_id', '=', 'partidos.id')
            ->where('operativos_mesas_id', $operativoMesa->id)
            ->get();

        return response()->json(['results'=>$result],200);
        
        
        // agrupo por partidos
        /*
        $partidos = DB::table('operativos_listas')
        ->select('partidos.nombre', 'partidos.id', 'images.path')
        ->join('listas', 'operativos_listas.listas_id', '=', 'listas.id')
        ->join('partidos', 'listas.partidos_id', '=', 'partidos.id')
        ->leftJoin('images', 'images.imageable_id', '=', 'partidos.id')
        ->groupBy('listas.partidos_id')
        ->where('operativos_listas.operativos_id', $idOperativos)
        ->get();
        
        $resultado['results']['partidos'] = [];

        foreach ($partidos as $partido){

            $listas = DB::table('listas')
            ->join('operativos_listas', 'operativos_listas.listas_id', '=', 'listas.id' )
            //->join('operativos_mesas', 'operativos_listas.operativos_id','=','operativos_mesas.operativos_id')
            //->join('votos_listas', 'votos_listas.operativos_mesas_id','=','operativos_mesas.id')
            ->select('listas.nombre','listas.id')
            ->where('listas.partidos_id', '=', $partido->id)
            ->where('operativos_listas.operativos_id', '=', $idOperativos)
            //->where('operativos_mesas.mesas_id', '=', $idMesas)
            //->groupBy('votos_listas.listas_id')
            ->get();
            


            array_push($resultado['results']['partidos'], [

                'id'        => $partido->id,
                'nombre'    => $partido->nombre,
                'url' => $partido->path,
                'listas'    => $listas
                
            ]);
           
        }
         */
  
       
    } 

    public function getVotosByMesa(Request $request){

        $idOperativos = $request->operativos_id;
        $idMesa = $request->mesas_id;
     
        if (! $idOperativos || !$idMesa)
            return response()->json(['resp' => 'ERROR' ,'msg' => 'Datos vacios'], 403);
        
        $operativoMesa = OperativosMesas::where('operativos_id',$idOperativos)->where('mesas_id',$idMesa)->first(); 
       
        if(!$operativoMesa)
            return response()->json(['resp' => 'ERROR' ,'msg' => 'El operativo mesa no existe'], 403);

        $cantidad = DB::table('votos')
        ->where('votos.operativos_mesas_id', $operativoMesa->id)
        ->get();    

        return response()->json(['results'=>$cantidad],200);
        
    }

    public function getVotosByLista(){

        $idOperativos = $request->operativos_id;
        $idMesa = $request->mesas_id;
     
        if (! $idOperativos || !$idMesa)
            return response()->json(['resp' => 'ERROR' ,'msg' => 'Datos vacios'], 403);

        $operativoMesa = OperativosMesas::where('operativos_id',$idOperativos)->where('mesas_id',$idMesa)->first(); 
        
        if(!$operativoMesa)
            return response()->json(['resp' => 'ERROR' ,'msg' => 'El operativo mesa no existe'], 403);

    }

    

}