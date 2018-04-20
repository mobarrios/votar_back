<?php
namespace App\Entities\Tecnica;


use App\Entities\Tecnica\Orders;
use App\Entities\Entity;

class Orders extends Entity
{

    protected $table = 'orders';
    protected $fillable = ['codigo_orden', 'fecha_inicio','fecha_final','presupuesto_id','importe_total','dto','numero_serie','falla_declarada','observaciones', 'observaciones_tecnicas', 'presupuesto_estimado', 'states_id', 'total', 'pagado','orden_manual','observaciones_internas', 'users_id', 'equipments_id', 'brands_id', 'models_id', 'clients_id' ];
    protected $section = 'orders';

}


