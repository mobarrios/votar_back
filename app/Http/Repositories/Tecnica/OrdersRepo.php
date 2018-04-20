<?php
namespace App\Http\Repositories\Tecnica;


use App\Entities\Tecnica\Orders;
use App\Http\Repositories\BaseRepo;


class OrdersRepo extends BaseRepo {
    
    public function getModel()
    {
        return new Orders();
    }

}
