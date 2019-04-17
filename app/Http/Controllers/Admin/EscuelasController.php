<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Admin\EscuelasRepo as Repo;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;


class EscuelasController extends Controller
{
    public function  __construct(Request $request, Repo $repo, Route $route)
    {

        $this->request  = $request;
        $this->repo     = $repo;
        $this->route    = $route;

        $this->section          = 'escuelas';
        $this->data['section']  = $this->section;
    }

}
