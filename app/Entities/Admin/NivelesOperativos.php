<?php
 namespace App\Entities\Admin;


 
 use App\Entities\Entity;

 class NivelesOperativos extends Entity
 {

     protected $table = 'niveles_operativos';
     protected $fillable = ['nombre'];

     protected $section = 'niveles_operativos';
 }


