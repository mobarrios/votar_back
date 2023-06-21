<?php
namespace App\Entities\Admin;


 
use App\Entities\Entity;

class OperativosPartidos extends Entity
{

     protected $table = 'operativos_partidos';
     protected $fillable = ['operativos_id','partidos_id'];
     protected $section = 'operativos_partidos';
}