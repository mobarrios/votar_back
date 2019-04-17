<?php

$model = 'escuelas';

return [

    'paginate'      => '50',

    //nombre de la seccion
    'sectionName'   => 'Escuelas',

    //routes
    'indexRoute'    => 'admin.'.$model.'.index',
    'storeRoute'    => 'admin.'.$model.'.store',
    'createRoute'   => 'admin.'.$model.'.create',
    'showRoute'     => 'admin.'.$model.'.show',
    'editRoute'     => 'admin.'.$model.'.edit',
    'updateRoute'   => 'admin.'.$model.'.update',
    'destroyRoute'  => 'admin.'.$model.'.destroy',

    'postStoreRoute'  => 'admin.'.$model.'.index',
    'postUpdateRoute' => 'admin.'.$model.'.index',

    //urls
    'destroyUrl' => 'admin/'.$model.'/destroy/',

    //views
    'storeView' =>  'admin.'.$model.'.form',
    'editView'  =>  'admin.'.$model.'.form',

    //path
    'imagesPath' => 'uploads/'.$model.'/images/',

    //polymorphic
    'is_logueable'      => true,
    'is_imageable'      => true,
    'is_brancheable'    => false,
    

    //column search
    'search' => [
        
            'Nombre'    => 'nombre',
            //'Direccion'  => 'address' ,
            //'Email'     => 'email'
    ],

    'validationsStore' => [

            'nombre'          => 'required',
            'direccion'          => 'required',

           // 'address'     => 'required',

    ],

    'validationsUpdate' => [

            'nombre'          => 'required',
            'direccion'          => 'required',

            //'address'     => 'required',

    ],

    'export' => [
        'nombre' => 'name'
    ]

];
