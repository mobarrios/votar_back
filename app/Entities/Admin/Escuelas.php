<?php
 namespace App\Entities\Admin;


 
 use App\Entities\Entity;

 class Escuelas extends Entity
 {

     protected $table = 'escuelas';
     protected $fillable = ['nombre','direccion','observaciones'];

     protected $section = 'escuelas';
 }


