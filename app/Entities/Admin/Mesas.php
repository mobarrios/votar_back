<?php
 namespace App\Entities\Admin;


 
 use App\Entities\Entity;
 use App\Entities\Configs\User;


 class Mesas extends Entity
 {

     protected $table = 'mesas';
     protected $fillable = ['numero','escuelas_id','users_id'];

     protected $section = 'mesas';



     public function Escuelas()
     {
         return $this->belongsTo(Escuelas::class);
     }

     public function Operativos()
     {
     	return $this->belongsToMany(Operativos::class,'operativos_mesas_users','mesas_id','operativos_id');
     }


     public function User()
     {
     	return $this->belongsToMany(User::class,'operativos_mesas_users','mesas_id','operativos_id');						
     }

 }


