<?php
namespace App\Http\Repositories;


use App\Entities\Tecnica\States;
use App\Http\Repositories\Tecnica\StatesRepo;


class StatesRepo extends BaseRepo {
    
    public function getModel()
    {
        return new States();
    }

}
