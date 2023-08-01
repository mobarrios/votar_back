<?php
namespace App\Entities\Admin;


 
use App\Entities\Entity;

class OperativosMesas extends Entity
{

     protected $table = 'operativos_mesas';
     protected $fillable = ['operativos_id','mesas_id','estados_mesas_id'];
     protected $section = 'operativos_mesas';

     public function Padrones()
     {
         return $this->hasMany(OperativosMesasPadron::class);
     }

     public function Mesa()
     {
         return $this->belongsTo(Mesas::class, 'mesas_id');
     }
    
    public function VotoMesa(){
        return $this->hasOne(Votos::class);
    }

    public function VotoLista(){
        return $this->hasMany(VotosListas::class);
    }

     public function getEstadoAttribute()
    {
        if ($this->attributes['estados_mesas_id'] == 1)
            return 'Pendiente';

        if ($this->attributes['estados_mesas_id'] == 2)
            return 'Validado';

        if ($this->attributes['estados_mesas_id'] == 3)
            return 'Impugnado';

        if ($this->attributes['estados_mesas_id'] == 4)
            return 'Estimado';
        
    }

    public function getEstadoTypeAttribute()
    {
        switch ($this->attributes['estados_mesas_id']) {
            case 1:
                return 'warning';
                break;

            case 2:
                return 'success';
                break;

            case 3:
                return 'primary';
                break;
                
            default:
                return 'default';
        }
    }

}