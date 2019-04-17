<?php
 namespace App\Entities\Admin;


 
 use App\Entities\Entity;

 class Mesas extends Entity
 {

     protected $table = 'mesas';
     protected $fillable = ['numero','escuelas_id','users_id'];

     protected $section = 'mesas';
 }


