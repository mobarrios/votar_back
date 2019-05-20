<?php
 namespace App\Entities\Admin;


 
 use App\Entities\Entity;

 class Operativos extends Entity
 {

     protected $table = 'operativos';
     protected $fillable = ['nombre','fecha','tipo_operativos_id','niveles_operativos_id'];

     protected $section = 'operativos';

    
     public function getFechaAttribute($value)
     {
         return date('d-m-Y',strtotime($value));
     }

     public function setFechaAttribute($value)
     {
         $this->attributes['fecha'] = date('Y-m-d',strtotime($value));
     }

     public function getEscuelasIdAttribute()
     {
         return $this->Escuelas()->lists('escuelas_id')->toArray();
     }

     public function Escuelas()
     {
        return $this->belongsToMany(Escuelas::class,'operativos_escuelas','operativos_id','escuelas_id');
     }

     public function Tipos()
     {
         return $this->belongsTo(TipoOperativos::class,'tipo_operativos_id');
     }

     public function Niveles()
     {
         return $this->belongsTo(NivelesOperativos::class,'niveles_operativos_id');
     }

     public function Candidatos()
     {
        return $this->belongsToMany(Candidatos::class,'operativos_candidatos','operativos_id','candidatos_id');
     }

      public function Listas()
     {
        return $this->belongsToMany(Listas::class,'operativos_listas','operativos_id','listas_id');
     }
 }


