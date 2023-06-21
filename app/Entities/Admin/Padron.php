<?php
 namespace App\Entities\Admin;

 use App\Entities\Entity;

 class Padron extends Entity
 {

     protected $table = 'padrones';
     protected $fillable = ['dni','nombre','apellido','domicilio','dni','nro_orden','nro_afiliado'];
     protected $section = 'padrones';
 }