<?php
 namespace App\Entities\Admin;


 
 use App\Entities\Entity;

 class Listas extends Entity
 {

     protected $table = 'listas';
     protected $fillable = ['nombre','partidos_id','tipo_operativos_id'];

     protected $section = 'listas';

     public function Partidos()
     {
         return $this->belongsTo(Partidos::class);
     }

     public function TipoOperativos()
     {
         return $this->belongsTo(TipoOperativos::class);
     }

    public function Votos()
    {
        return $this->hasMany(Votos::class);
    }    

    public function VotosOperativos($operativosId)
    {
        return $this->votos->where('operativos_id',$operativosId);
    }    
 }



