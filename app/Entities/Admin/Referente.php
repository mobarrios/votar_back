<?php
 namespace App\Entities\Admin;

 use App\Entities\Entity;

 class Referente extends Entity
 {

     protected $table = 'referentes';
     protected $fillable = ['nombre','apellido','domicilio','telefono','mail'];
     protected $section = 'referentes';
 }