<?php
namespace App\Entities\Admin;


use App\Entities\Entity;

class EstadosMesas extends Entity{

     protected $table = 'estados_mesas';
     protected $fillable = ['descripcion'];
     protected $section = 'estados_mesas';
}