<?php

namespace App\Http\Controllers\Tecnica;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Tecnica\OrdersRepo;
use App\Http\Repositories\Tecnica\OrdersRepo as Repo;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;


class OrdersController extends Controller
{
    public function  __construct(Request $request, Repo $repo, Route $route)
    {

        $this->request  = $request;
        $this->repo     = $repo;
        $this->route    = $route;

        $this->section          = 'orders';
        $this->data['section']  = $this->section;
    }

    public function detail(){

    	$this->data['models'] = $this->repo->find($this->route->getParameter('id'));
    	
    	return view('admin.orders.detail')->with($this->data);

    }
  
}
