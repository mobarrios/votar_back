<?php
namespace App\Entities\Tecnica;

use App\Entities\Tecnica\Orders;
use App\Entities\Entity;

class States extends Entity
{

    protected $table = 'states';
    protected $fillable = ['description', 'text_email','color'];
    protected $section = 'states';

}


