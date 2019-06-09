<?php
 namespace App\Entities\Admin;


 use App\Entities\Entity;

 class Imgs extends Entity
 {

     protected $table = 'imgs';
     protected $fillable = ['operativos_id','mesas_id','img'];
     protected $section = 'imgs';

 }