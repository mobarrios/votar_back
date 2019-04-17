<?php
namespace App\Http\Repositories\Admin;

use App\Entities\Admin\NivelesOperativos;
use App\Http\Repositories\BaseRepo;


class NivelesOperativosRepo extends BaseRepo {
    
    public function getModel()
    {
        return new NivelesOperativos;
    }


}