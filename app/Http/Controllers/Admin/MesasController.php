<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Admin\MesasRepo as Repo;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use App\Http\Repositories\Admin\EscuelasRepo as EscuelasRepo;


class MesasController extends Controller
{

    public function  __construct(Request $request, Repo $repo, Route $route, EscuelasRepo $escuelasRepo)
    {

        $this->request  = $request;
        $this->repo     = $repo;
        $this->route    = $route;

        $this->section          = 'mesas';
        $this->data['section']  = $this->section;
        $this->data['escuelas_id']  = $this->route->getParameter('escuelasId');
        $this->data['escuela'] = $escuelasRepo->find($this->route->getParameter('escuelasId'));
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
        $this->data['models'] = $model->where('escuelas_id', $this->data['escuelas_id'] )->paginate(config('models.'.$this->section.'.paginate'));

        //return view($this->getConfig()->indexRoute)->with($this->data);
        return view(config('models.'.$this->section.'.indexRoute'))->with($this->data);
    }

    public function store()
    {
        //validar los campos
        $this->validate($this->request,config('models.'.$this->section.'.validationsStore'));

        //crea a traves del repo con el request
        $model = $this->repo->create($this->request);

        return redirect()->route(config('models.'.$this->section.'.postStoreRoute'),[$this->data['escuelas_id'], $model->id])->withErrors(['Regitro Agregado Correctamente']);
    }

    public function update()
    {
        //validar los campos
        $this->validate($this->request,config('models.'.$this->section.'.validationsUpdate'));

        $id = $this->route->getParameter('id');

        //edita a traves del repo
        $model = $this->repo->update($id,$this->request);

        return redirect()->route(config('models.'.$this->section.'.postUpdateRoute'),[$this->data['escuelas_id'], $model->id])->withErrors(['Regitro Editado Correctamente']);
    }



}
