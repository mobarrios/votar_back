<?php
namespace App\Http\Repositories\Tecnica;


use App\Entities\Tecnica\Equipments;
use App\Http\Repositories\BaseRepo;


class EquipmentsRepo extends BaseRepo {
    
    public function getModel()
    {
        return new Equipments();
    }

}
