<?php
namespace App\Http\Repositories\Admin;

use App\Entities\Admin\OperativosMesas;
use App\Http\Repositories\BaseRepo;


class OperativosMesasRepo extends BaseRepo {
    
    public function getModel()
    {
        return new OperativosMesas;
    }


    


}