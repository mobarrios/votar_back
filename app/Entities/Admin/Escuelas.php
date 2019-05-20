<?php
 namespace App\Entities\Admin;


 
 use App\Entities\Entity;

 class Escuelas extends Entity
 {

     protected $table = 'escuelas';
     protected $fillable = ['nombre','direccion','observaciones','provincias_id','municipios_id','localidades_id','latitud','longitud'];

     protected $section = 'escuelas';

     public function Mesas()
     {
         return $this->hasMany(Mesas::class);
     }

     public function Operativos()
     {
         return $this->belongsToMany(Operativos::class,'operativos_escuelas','operativos_id','escuelas_id');
     }
 }


