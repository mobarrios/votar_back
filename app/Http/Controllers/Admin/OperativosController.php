<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Admin\OperativosRepo as Repo;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

use App\Http\Repositories\Admin\TipoOperativosRepo as Tipo;
use App\Http\Repositories\Admin\NivelesOperativosRepo as Niveles;
use App\Http\Repositories\Admin\EscuelasRepo as Escuelas;
use App\Http\Repositories\Admin\ListasRepo as Listas;
use App\Http\Repositories\Configs\UsersRepo as Usuarios;
use App\Entities\Admin\OperativosMesasUsers ;
use Auth;
use App\Http\Repositories\Admin\OperativosMesasRepo;
use DB;

class OperativosController extends Controller
{
    public function  __construct(Request $request, Repo $repo, Route $route, Tipo $tipo, Niveles $niveles, Escuelas $escuelas, Listas $listas, Usuarios $usuarios, OperativosMesasRepo $operativosMesasRepo)
    {
        $this->request  = $request;
        $this->repo     = $repo;
        $this->route    = $route;

        $this->section          = 'operativos';
        $this->data['section']  = $this->section;

        $this->data['tipos']    = $tipo->ListsData('nombre','id');
        $this->data['niveles']  = $niveles->ListsData('nombre','id');
        $this->data['escuelas'] = $escuelas->ListsData('nombre','id');
        $this->data['listas'] = $listas->getModel()->all();
        $this->data['usuarios'] = $usuarios->getModel()->all();
        $this->operativosMesasRepo = $operativosMesasRepo;


    }

    public function index()
    {   
        
        //breadcrumb activo
        $this->data['activeBread'] = 'Listar';

        //si request de busqueda
        if( isset($this->request->search) && !is_null($this->request->filter))
        {
            $model = $this->repo->search($this->request);

            if(is_null($model) || $model->count() == 0)
                //si paso la seccion
                $model = $this->repo->listAll($this->section);
        }
        else
        {
            $model  = $this->repo->listAll($this->section);
        }
        
        //pagina el query
        $user = Auth::user();
        
        if($user->is('admin')){

            $this->data['models'] = OperativosMesasUsers::select('operativos.id', 'operativos.nombre', 'niveles_operativos.nombre as nivel')
            ->join('operativos','operativos.id','=','operativos_mesas_users.operativos_id')
            ->join('niveles_operativos','operativos.niveles_operativos_id','=','niveles_operativos.id')
            ->where('operativos_mesas_users.users_id','=',$user->id)
            ->groupBy('operativos.id')
            ->paginate(config('models.'.$this->section.'.paginate'));
          
        }else{
            $this->data['models'] = $model->paginate(config('models.'.$this->section.'.paginate'));
        }
        
       
        return view(config('models.'.$this->section.'.indexRoute'))->with($this->data);
    }


    public function store()
    {
        //validar los campos
        $this->validate($this->request,config('models.'.$this->section.'.validationsStore'));

        //crea a traves del repo con el request
        $data = $this->request;
        $model = $this->repo->create($data);

        //asigna los escuelas
        $model->escuelas()->attach($this->request->escuelas_id);

        //asigna los listas
        $model->listas()->attach($this->request->listas_id);
        
        // mesas operativs
        $this->repo->crearOperavosMesas($model);
        
        return redirect()->route(config('models.'.$this->section.'.postStoreRoute'),$model->id)->withErrors(['Regitro Agregado Correctamente']);
    }

    public function update()
    {
        //validar los campos
        $this->validate($this->request,config('models.'.$this->section.'.validationsUpdate'));

        $id = $this->route->getParameter('id');
        //edita a traves del repo
        $model = $this->repo->update($id,$this->request);

        //asigna los escuelas
        $model->escuelas()->sync($this->request->escuelas_id);
        //asigna los listas
        $model->listas()->sync($this->request->listas_id);


        return redirect()->route(config('models.'.$this->section.'.postUpdateRoute'),$model->id)->withErrors(['Regitro Editado Correctamente']);
    }


    public function show()
    {
        //breadcrumb activo
        $this->data['activeBread'] = 'Detalle';

        // id desde route
        $id = $this->route->getParameter('id');

        $this->data['models'] = $this->repo->find($id);
        $this->data['total'] = $this->repo->find($id)->Votos->sum('total') ;


        $totales = DB::table('votos')
        ->join('listas','listas.id','=','votos.listas_id')
        ->where('votos.operativos_id','=',$id)
        ->where('listas.id','!=',99)
        ->select('listas.nombre as nombre','votos.total as total')
        ->get();


        $this->data['tipo2']  = DB::table('votos')
        ->join('listas','listas.id','=','votos.listas_id')
        ->where('votos.operativos_id','=',$id)
        ->where('listas.id','!=',99)
        ->where('listas.tipo_operativos_id' ,'=',2)
        ->select('listas.nombre as nombre',DB::raw('sum( votos.total) as total'))
        ->groupBy('listas.id')
        ->get();

        $this->data['tipo3']  = DB::table('votos')
        ->join('listas','listas.id','=','votos.listas_id')
        ->where('votos.operativos_id','=',$id)
        ->where('listas.id','!=',99)
        ->where('listas.tipo_operativos_id' ,'=',3)
        ->select('listas.nombre as nombre',DB::raw('sum( votos.total) as total'))
        ->groupBy('listas.id')
        ->get();

        $this->data['tipo4']  = DB::table('votos')
        ->join('listas','listas.id','=','votos.listas_id')
        ->where('votos.operativos_id','=',$id)
        ->where('listas.id','!=',99)
        ->where('listas.tipo_operativos_id' ,'=',4)
       ->select('listas.nombre as nombre',DB::raw('sum( votos.total) as total'))
        ->groupBy('listas.id')
        ->get();

        $this->data['tipo5']  = DB::table('votos')
        ->join('listas','listas.id','=','votos.listas_id')
        ->where('votos.operativos_id','=',$id)
        ->where('listas.id','!=',99)
        ->where('listas.tipo_operativos_id' ,'=',5)
        ->select('listas.nombre as nombre',DB::raw('sum( votos.total) as total'))
        ->groupBy('listas.id')
        ->get();



        $this->data['totales'] = $totales;

        $muni = DB::table('operativos')
        ->join('operativos_mesas_users','operativos_mesas_users.operativos_id','=','operativos.id')
        ->join('mesas','mesas.id','=','operativos_mesas_users.mesas_id')
        ->join('escuelas','escuelas.id','=','mesas.escuelas_id')
        ->join('votos','votos.operativos_id','=','operativos.id')
        ->where('operativos.id',$id)
        ->select(DB::raw('sum(DISTINCT votos.total) as total'),'escuelas.municipios_id')
        ->groupBy('escuelas.municipios_id')
        ->get();

        $d =[];

        foreach ($muni as $key) {

            $muniNombre = 
           array_push($d, ['total'=>$key->total, 'municipio'=>'mm']);
        }

     

        $this->data['municipios'] = $muni;


        return view(config('models.'.$this->section.'.showView'))->with($this->data);
    }

    public function mesasUsuarios()
    {
        //breadcrumb activo
        $this->data['activeBread'] = 'Mesas Usuarios';

        // id desde route
        $id = $this->route->getParameter('id');
        
        $user = Auth::user();

        if($user->is('root')){
            $this->data['models'] = $this->repo->find($id);
        }else{
            $this->data['models'] = OperativosMesasUsers::where('operativos_id', $id)->where('users_id',$user->id)->get();
        }

        return view('admin.operativos.mesasUsuarios')->with($this->data);
    }


    public function postMesasUsuarios(OperativosMesasUsers $operativosMesasUsers)
    {
        
        // id desde route
        $id = $this->route->getParameter('id');
        //dd($id, $this->request->all());
         
        foreach($this->request->mesas as $mesa)
        {
            $a =  explode('_', $mesa);
            $mesa = $a[0];
            $user = $a[1];

            // borrar usuario
          
            $opRestore  = $operativosMesasUsers->where('operativos_id',$this->request->operativos_id)->where('mesas_id',$mesa)->where('users_id',$user)->withTrashed()->first();
            
            if($opRestore){
               $opRestore->restore();
            }
         
            
            $op  = $operativosMesasUsers->where('operativos_id',$this->request->operativos_id)->where('mesas_id',$mesa)->where('users_id',$user)->get();
           
            // crear usuario
            if($op->count() == 0 ){
                $operativosMesasUsers->create(['operativos_id'=>$this->request->operativos_id ,'mesas_id'=>$mesa,'users_id'=>$user])->save();
            }
            


        }

        return redirect()->back();


    }

    public function mesasUsuariosEdit(OperativosMesasUsers $operativosMesasUsers, Usuarios $usersRepo){

        //breadcrumb activo
        $this->data['activeBread'] = 'Mesas Usuarios';

        // id desde route
        $this->data['operativoId'] = $this->route->getParameter('id');
        $this->data['mesaId'] = $this->route->getParameter('mesaId');
       
        $user = Auth::user();

        //$this->data['usuarios'] = $operativosMesasUsers->where('operativos_id', $id)->where('mesas_id',$mesaId)->get();
        $this->data['usuarios'] = $usersRepo->getModel()->get();
        

        return view('admin.operativos.mesasUsuariosEdit')->with($this->data);

    }


}
