<?php
namespace App\Http\Repositories\Admin;

use App\Entities\Admin\Listas;
use App\Http\Repositories\BaseRepo;


class ListasRepo extends BaseRepo {
    
    public function getModel()
    {
        return new Listas;
    }


}