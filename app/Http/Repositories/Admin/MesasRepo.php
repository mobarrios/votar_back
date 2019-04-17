<?php
namespace App\Http\Repositories\Admin;

use App\Entities\Admin\Mesas;
use App\Http\Repositories\BaseRepo;


class MesasRepo extends BaseRepo {
    
    public function getModel()
    {
        return new Mesas;
    }


}