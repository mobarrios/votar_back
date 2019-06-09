<?php
namespace App\Http\Repositories\Admin;

use App\Entities\Admin\Operativos;
use App\Http\Repositories\BaseRepo;


class OperativosRepo extends BaseRepo {
    
    public function getModel()
    {
        return new Operativos;
    }


    


}