<?php
 namespace App\Entities\Admin;


 
 use App\Entities\Entity;
 use DB;


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

    public function VotosTipoOperativos($id,$tipoOPerativoId)
    {
        return DB::table('votos')
        ->select(DB::raw('sum(votos.total) as total'))
        ->join('listas','listas.id','=','votos.listas_id')
        ->join('tipo_operativos','tipo_operativos.id','=','listas.tipo_operativos_id')
        ->where('votos.operativos_id','=',$id)
        ->where('tipo_operativos.id','=',$tipoOPerativoId)
        ->groupBy('listas.tipo_operativos_id')
        ->first();   
     }    
 }



