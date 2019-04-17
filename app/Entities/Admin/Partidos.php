<?php
 namespace App\Entities\Admin;


 
 use App\Entities\Entity;

 class Partidos extends Entity
 {

     protected $table = 'partidos';
     protected $fillable = ['nombre'];

     protected $section = 'partidos';
 }


