<?php
namespace App\Entities\Admin;


 
use App\Entities\Entity;

class OperativosMesasPadron extends Entity
{

     protected $table = 'operativos_mesas_padron';
     protected $fillable = ['operativos_mesas_users_id','referentes_id','padrones_id','voto'];
     protected $section = 'operativos_mesas_padron';

     public function Padron()
     {
         return $this->belongsTo(Padron::class, 'padrones_id');
     }
}