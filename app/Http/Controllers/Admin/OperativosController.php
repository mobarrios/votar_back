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





class OperativosController extends Controller
{
    public function  __construct(Request $request, Repo $repo, Route $route, Tipo $tipo, Niveles $niveles, Escuelas $escuelas, Listas $listas)
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
    }


    public function store()
    {
        //validar los campos
        $this->validate($this->request,config('models.'.$this->section.'.validationsStore'));

        //crea a traves del repo con el request
        $model = $this->repo->create($this->request);

        //asigna los escuelas
        $model->escuelas()->attach($this->request->escuelas_id);
        //asigna los candidatos
        $model->listas()->attach($this->request->listas_id);
        

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
        //asigna los candidatos
        $model->candidatos()->attach($this->request->candidatos_id);


        return redirect()->route(config('models.'.$this->section.'.postUpdateRoute'),$model->id)->withErrors(['Regitro Editado Correctamente']);
    }


}
