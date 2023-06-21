<?php
 namespace App\Entities\Admin;


 
 use App\Entities\Entity;

 class OperativosMesasUsers extends Entity
 {

    protected $table = 'operativos_mesas_users';
    protected $fillable = ['operativos_id','mesas_id','users_id'];
    protected $section = 'operativos_mesas_users';

    public function Padrones()
    {
        return $this->hasMany(OperativosMesasPadron::class);
    }

 }


