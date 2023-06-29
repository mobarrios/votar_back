<?php
namespace App\Entities\Admin;
use App\Entities\Entity;

class VotosListas extends Entity{

    protected $table = 'votos_listas';
    protected $fillable = ['listas_id', 'cantidad_votos', 'operativos_mesas_id'];
    protected $section = 'votos listas';

    public function Listas(){
        return $this->belongsTo(Listas::class,'listas_id');
    }

}