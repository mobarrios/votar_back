<?php

Route::group(['prefix'=>'mesas'],function(){

        $section =  'mesas';

        Route::group(['prefix'=>'{escuelasId?}'],function() use ($section)
        {
            Route::get('/destroy/{id?}',    ['middleware'=>'permission:'.$section.'.destroy','as'=>'admin.mesas.destroy','uses'=>'Admin\MesasController@destroy']);
            Route::get('/edit/{id?}',       ['middleware'=>'permission:'.$section.'.edit','as'=>'admin.mesas.edit','uses'=>'Admin\MesasController@edit']);
            Route::post('/update/{id?}',    ['middleware'=>'permission:'.$section.'.edit','as'=>'admin.mesas.update','uses'=>'Admin\MesasController@update']);

            Route::get('/create',           ['middleware'=>'permission:'.$section.'.create','as'=>'admin.mesas.create','uses'=>'Admin\MesasController@create']);
            Route::post('/store',           ['middleware'=>'permission:'.$section.'.create','as'=>'admin.mesas.store','uses'=>'Admin\MesasController@store']);
            Route::get('/show',             ['middleware'=>'permission:'.$section.'.show','as'=>'admin.mesas.show','uses'=>'Admin\MesasController@show']);
            Route::get('/index/{search?}',  ['middleware'=>'permission:'.$section.'.list','as'=>'admin.mesas.index','uses'=>'Admin\MesasController@index']);

            Route::get('/pdf',  ['middleware'=>'permission:'.$section.'.list','as'=>'admin.mesas.pdf','uses'=>'Utilities\UtilitiesController@exportListToPdf']);
        });
});
