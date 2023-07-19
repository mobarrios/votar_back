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
use App\Http\Helpers\ImagesHelper;

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
            ->select('escuelas.nombre','escuelas.id','escuelas.direccion','escuelas.latitud','escuelas.longitud')
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
                        'direccion' => $escuela->direccion,
                        'latitud' => $escuela->latitud,
                        'longitud' => $escuela->longitud,
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
        
        if($request->image){
            $voto->images()->create(['path' => $request->image]);
        }

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
            //->leftJoin('images', 'images.imageable_id', '=', 'partidos.id')
            ->leftJoin('images', function ($q) {
                $q->on('images.imageable_id', '=', 'partidos.id')
                    ->where('images.imageable_type', 'like', '%Partidos%');
            })
            ->where('votos_listas.operativos_mesas_id', $operativoMesa->id)
            ->get();

        return response()->json(['results'=>$result],200);
        
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
        ->first();    
        
        /*
        if(count($cantidad) == 0){
            
            $cantidad = [
                'total' => 0, 
                'total_blancos' => 0,
                'total_nulos' => 0,
                'total_recurridos' => 0,
                'total_impugnados' => 0,

            ];    
            
            
        }
        */
        return response()->json(['results'=>$cantidad],200);
        
    }

    // public function getVotosByLista(Request $request){

    //     $idOperativos = $request->operativos_id;
    //     $idMesa = $request->mesas_id;
     
    //     if (! $idOperativos || !$idMesa)
    //         return response()->json(['resp' => 'ERROR' ,'msg' => 'Datos vacios'], 403);

    //     $operativoMesa = OperativosMesas::where('operativos_id',$idOperativos)->where('mesas_id',$idMesa)->first(); 
        
    //     if(!$operativoMesa)
    //         return response()->json(['resp' => 'ERROR' ,'msg' => 'El operativo mesa no existe'], 403);

    // }

    public function escuelas(){

        $escuelas = DB::table('escuelas')
            ->select('escuelas.id','escuelas.nombre', 'escuelas.direccion', 'escuelas.latitud','escuelas.longitud', 
            'escuelas.provincias_id', 
            'escuelas.municipios_id',
            'escuelas.localidades_id', 
            //'escuelas.provincia', 
            //'escuelas.localidad', 
            DB::raw("COUNT(mesas.id) as cantidad_mesas")
            )
            ->leftJoin('mesas', 'escuelas.id', '=', 'mesas.escuelas_id')
            ->groupBy('escuelas.id')
            ->get();

        return response()->json(['results'=>$escuelas],200);
        
    }

    public function mesas(){

        $mesas = DB::table('operativos_mesas_users')
            ->select('mesas.id', 'mesas.numero', 'mesas.escuelas_id')
            ->join('mesas', 'operativos_mesas_users.mesas_id', '=', 'mesas.id')
            ->groupBy('operativos_mesas_users.mesas_id')
            ->get();

        $resultado['results']['mesas'] = [];

        foreach ($mesas as $mesa){
            
            $mesas = DB::table('operativos_mesas_users')
                    ->select('users.user_name as user_name', 'users.name as nombre', 
                    'users.last_name as apellido', 
                    'operativos_mesas_users.operativos_id',
                    'operativos.nombre as nombre_operativo'
                    )
                    ->join('users', 'operativos_mesas_users.users_id', '=', 'users.id')
                    ->join('operativos', 'operativos.id', '=', 'operativos_mesas_users.operativos_id')
                    ->where('operativos_mesas_users.mesas_id', $mesa->id)
                    ->get();
          
            array_push($resultado['results']['mesas'], [

                'id'        => $mesa->id,
                'numero'    => $mesa->numero,
                'escuelas_id' => $mesa->escuelas_id,
                'fiscales'  => $mesas
               
            ]);

        }

        return response()->json($resultado,200);
        
    }

    public function fiscal(){

        $users = DB::table('users')
        ->select('users.id', 'users.name as nombre', 'users.last_name as apellido')
        ->get();

        return response()->json(['results'=>$users],200);

    }

    public function candidatos(){

        $candidatos = DB::table('partidos')
        ->select('id', 'nombre')
        ->get();

        return response()->json(['results'=>$candidatos],200);
    }

    public function padron(){

        $padron = DB::table('padrones')
            ->select('id', 'nombre', 'apellido', 'domicilio', 'dni', 'nro_orden', 'nro_afiliado')
            ->get();

        /*
        $padron = DB::table('operativos_mesas_padron')
            ->select( 
                'operativos_mesas_padron.id',
                'padrones.nombre',
                'padrones.apellido',
                'padrones.dni',
                'padrones.nro_orden',
                'padrones.nro_afiliado'
            )
            ->join('padrones', 'operativos_mesas_padron.padrones_id', '=', 'padrones.id' )
            ->join('referentes','operativos_mesas_padron.referentes_id','=','referentes.id')
            ->get();
        */

        return response()->json(['results'=>$padron],200);
    }

    public function listas(){

        $listas = DB::table('listas')
            ->select('listas.id', 'listas.nombre', 'listas.partidos_id')
            ->get();

        return response()->json(['results'=>$listas],200);
        
    }

    public function voto(){

        $voto = DB::table('operativos_mesas_padron')
            ->select('padrones_id', 'voto', 'operativos_mesas.mesas_id', 'operativos_mesas_padron.created_at as fecha_creado', 'operativos_mesas_padron.updated_at as fecha_update')
            ->join('operativos_mesas', 'operativos_mesas_padron.operativos_mesas_id', '=', 'operativos_mesas.id')
            ->get();

        return response()->json(['results'=>$voto],200);

    }
    
    public function resultado(){

        $votos = DB::table('votos')
            ->select('votos.total', 'votos.total_blancos','votos.total_nulos','votos.total_recurridos','votos.total_impugnados', 'votos.created_at as fecha_creado', 'votos.updated_at as fecha_update', 'operativos_mesas.mesas_id', 'operativos_mesas.operativos_id')
            ->join('operativos_mesas', 'votos.operativos_mesas_id', '=', 'operativos_mesas.id')
            ->get();

        return response()->json(['results'=>$votos],200);

    }

    public function resultadosListas(){

        $listas = DB::table('votos_listas')
            ->select('operativos_mesas.mesas_id', 'operativos_mesas.operativos_id', 'votos_listas.cantidad_votos', 'votos_listas.listas_id', 'votos_listas.created_at as fecha_creado', 'votos_listas.updated_at as fecha_update')
            ->join('operativos_mesas', 'votos_listas.operativos_mesas_id', '=', 'operativos_mesas.id')
            ->get();

        return response()->json(['results'=>$listas],200);

    }

    public function operativos(){

        $operativos = DB::table('operativos')
            ->select('id', 'nombre', 'fecha')
            ->get();

        return response()->json(['results'=>$operativos],200);

    }
    

}