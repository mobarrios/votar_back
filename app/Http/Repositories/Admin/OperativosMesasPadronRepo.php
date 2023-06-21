<?php
namespace App\Http\Repositories\Admin;

use App\Entities\Admin\OperativosMesasPadron;
use App\Http\Repositories\BaseRepo;


class OperativosMesasPadronRepo extends BaseRepo {
    
    public function getModel()
    {
        return new OperativosMesasPadron;
    }


}