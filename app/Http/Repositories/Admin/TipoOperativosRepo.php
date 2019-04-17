<?php
namespace App\Http\Repositories\Admin;

use App\Entities\Admin\TipoOperativos;
use App\Http\Repositories\BaseRepo;


class TipoOperativosRepo extends BaseRepo {
    
    public function getModel()
    {
        return new TipoOperativos;
    }


}