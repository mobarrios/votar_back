<?php

namespace App\Http\Controllers\Admin;

use App\Entities\Admin\PurchasesListsPricesItems;
use App\Http\Controllers\Controller;
use App\Http\Repositories\Admin\PurchasesListsPricesItemsRepo;
use App\Http\Repositories\Admin\PurchasesListsPricesRepo as Repo;
use App\Http\Repositories\Admin\ModelsRepo;
use App\Http\Repositories\Admin\ProvidersRepo;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Session;


class PurchasesListsPricesController extends Controller
{
    protected $modelsRepo;


    public function  __construct(Request $request, Repo $repo, Route $route, ProvidersRepo $providersRepo, ModelsRepo $modelsRepo, PurchasesListsPricesItemsRepo $purchasesListsPricesItemsRepo)
    {

        $this->request  = $request;
        $this->repo     = $repo;
        $this->route    = $route;

        $this->section          = 'purchasesListsPrices';
        $this->data['section']  = $this->section;

        //data
        $this->data['providers'] = $providersRepo->ListsData('name','id');
        $this->data['models_lists'] = $modelsRepo->ListsData('name','id');

        $this->modelsRepo =  $modelsRepo;
        $this->purchasesListsPricesItemsRepo = $purchasesListsPricesItemsRepo;
    }

    public function edit()
    {
        return parent::edit(); // TODO: Change the autogenerated stub
    }

    public function addItems(PurchasesListsPricesItemsRepo $purchasesListsPricesItemsRepo)
    {
        $purchasesListsPricesItemsRepo->create($this->request);

        return redirect()->route('moto.purchasesListsPrices.edit',$this->request->purchases_lists_prices_id);
    }

    public function editItems(PurchasesListsPricesItems $purchasesListsPricesItems)
    {
        $this->data['modelItems'] = $purchasesListsPricesItems->find($this->route->getParameter('item'));

        return parent::edit();
    }

    public function updateItems(PurchasesListsPricesItems $purchasesListsPricesItems,$id)
    {
        $item = $purchasesListsPricesItems->find($id);

        $item->update($this->request->all());

        return parent::edit();
    }

    public function deleteItems(PurchasesListsPricesItemsRepo $purchasesListsPricesItems)
    {
        $purchasesListsPricesItems->destroy($this->route->getParameter('item'));

        return parent::edit();
    }

    /*
    public function addItems()
    {
        $data   = $this->request;
        if(empty($data))
            return ["error" => "Debes completar los campos"];
        else{

            $model  = $this->modelsRepo->find($data->models_id);

            $arr =  session()->has($this->section.'Items') ? session($this->section.'Items') : [];

            $newItem =
            [
                'models_id' => $data->models_id,
                'price_list' => $data->price_list,
                'price_net' => $data->price_net,
                'max_discount' => $data->max_discount,
                'obs'=> $data->obs
            ];

            array_push($arr, $newItem);

            session()->put($this->section.'Items',$arr);

            return [
                    'error' => 'Se agregó correctamente el item',
                    'success' => [
                        'models_name' => $model->name,
                        'models_id' => $model->id,
                        'price_list' => $data->price_list,
                        'price_net' => $data->price_net,
                        'max_discount' => $data->max_discount
                    ]
            ];
        }
    }

    public function editItems()
    {
        $data   = $this->request;
        if(empty($data))
            return ["error" => "Debes completar los campos"];

        else{

            $model  = $this->modelsRepo->find($data->models_id);

            $arr =  session()->has($this->section.'Items') ? session($this->section.'Items') : [];

            $newItem =
            [
                'models_id' => $data->models_id,
                'price_list' => $data->price_list,
                'price_net' => $data->price_net,
                'max_discount' => $data->max_discount,
                'obs'=> $data->obs
            ];

//            array_push($arr, $newItem);

            foreach($arr as $ind => $val){
                if($val["models_id"] == $data->id){
                    $arr[$ind] = $newItem;
                }
            }

            session()->put($this->section.'Items',$arr);

            return [
                    'error' => 'Se editó correctamente el item',
                    'success' => [
                        'models_name' => $model->name,
                        'models_id' => $model->id,
                        'price_list' => $data->price_list,
                        'price_net' => $data->price_net,
                        'max_discount' => $data->max_discount
                    ]
            ];
        }
    }

    public function deleteItems()
    {
        $data   = $this->request;
        $arr =  session()->has($this->section.'Items') ? session($this->section.'Items') : [];

        foreach($arr as $ind => $val){
            if($val["models_id"] == $data->id){
                unset($arr[$ind]);
            }
        }

        session()->put($this->section.'Items',$arr);

        return "Se eliminó correctamente el item";
    }
    */
}
