<?php
 namespace App\Entities\Admin;


 
 use App\Entities\Entity;

 class Candidatos extends Entity
 {

     protected $table = 'candidatos';
     protected $fillable = ['nombre','apellido','partidos_id'];

     protected $section = 'partidos';

     public function Partidos()
     {
         return $this->belongsTo(Partidos::class);
     }
 }



