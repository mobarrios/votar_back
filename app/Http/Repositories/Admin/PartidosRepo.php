<?php
namespace App\Http\Repositories\Admin;

use App\Entities\Admin\Partidos;
use App\Http\Repositories\BaseRepo;


class PartidosRepo extends BaseRepo {
    
    public function getModel()
    {
        return new Partidos;
    }


}