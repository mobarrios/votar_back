<?php
 namespace App\Entities\Admin;


 use App\Entities\Entity;

 class Votos extends Entity
 {

     protected $table = 'votos';
     protected $fillable = ['total','operativos_id','listas_id','mesas_id','total_blancos','total_recurridos','total_nulos','total_impugnados'];

     protected $section = 'votos';


  public function Listas()
     {
        return $this->belongsTo(Listas::class,'listas_id');
     }
      public function Mesas()
     {
        return $this->belongsTo(Mesas::class,'mesas_id');
     }
 }


