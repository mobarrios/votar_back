<?php
namespace App\Http\Repositories\Admin;

use App\Entities\Admin\Candidatos;
use App\Http\Repositories\BaseRepo;


class CandidatosRepo extends BaseRepo {
    
    public function getModel()
    {
        return new Candidatos;
    }


}