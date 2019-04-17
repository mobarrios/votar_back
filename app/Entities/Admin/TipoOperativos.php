<?php
 namespace App\Entities\Admin;


 
 use App\Entities\Entity;

 class TipoOperativos extends Entity
 {

     protected $table = 'tipo_operativos';
     protected $fillable = ['nombre'];

     protected $section = 'tipo_operativos';
 }


