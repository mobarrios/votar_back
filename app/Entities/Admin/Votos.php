<?php
 namespace App\Entities\Admin;


 use App\Entities\Entity;

 class Votos extends Entity
 {

     protected $table = 'votos';
     protected $fillable = ['total','operativos_id','listas_id','mesas_id'];

     protected $section = 'votos';


     
 }


