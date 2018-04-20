<?php
namespace App\Entities\Tecnica;


use App\Entities\Tecnica\Equipments;
use App\Entities\Entity;

class Equipments extends Entity
{

    protected $table = 'equipments';
    protected $fillable = ['name'];
    protected $section = 'equipments';

 
}


