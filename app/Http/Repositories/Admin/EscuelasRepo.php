<?php
namespace App\Http\Repositories\Admin;

use App\Entities\Admin\Escuelas;
use App\Http\Repositories\BaseRepo;


class EscuelasRepo extends BaseRepo {
    
    public function getModel()
    {
        return new Escuelas;
    }


}