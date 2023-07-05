<?php
namespace App\Http\Repositories\Admin;

use App\Entities\Admin\Operativos;
use App\Entities\Admin\VotosListas;
use App\Http\Repositories\BaseRepo;
use App\Entities\Admin\OperativosMesas;


class OperativosRepo extends BaseRepo {
    
    public function getModel()
    {
        return new Operativos;
    }

    public function crearOperavosMesas($model){
      
        foreach($model->escuelas as $escuela){
            
            // creo operativos mesas
            foreach($escuela->Mesas as $mesas){

                $operativoMesa = new OperativosMesas();
                $operativoMesa->mesas_id = $mesas->id;
                $operativoMesa->operativos_id = $model->id;
                $operativoMesa->estados_mesas_id = 1;
                $operativoMesa->save();

                // creo voto listas por operativo
                foreach($model->listas as $lista){
                    $votoLista = new VotosListas();
                    $votoLista->listas_id = $lista->id;
                    $votoLista->cantidad_votos = 0;
                    $votoLista->operativos_mesas_id = $operativoMesa->id;
                    $votoLista->save();
                } 

            }



        }

    }


    


}