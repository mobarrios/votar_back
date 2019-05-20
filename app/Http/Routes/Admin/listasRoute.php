<?php

Route::group(['prefix'=>'listas'],function(){

        $section =  'listas';

        Route::group(['prefix'=>'{partidosId?}'],function() use ($section)
        {    
            Route::get('/destroy/{id?}',    ['middleware'=>'permission:'.$section.'.destroy','as'=>'admin.listas.destroy','uses'=>'Admin\ListasController@destroy']);
            Route::get('/edit/{id?}',       ['middleware'=>'permission:'.$section.'.edit','as'=>'admin.listas.edit','uses'=>'Admin\ListasController@edit']);
            Route::post('/update/{id?}',    ['middleware'=>'permission:'.$section.'.edit','as'=>'admin.listas.update','uses'=>'Admin\ListasController@update']);

            Route::get('/create',           ['middleware'=>'permission:'.$section.'.create','as'=>'admin.listas.create','uses'=>'Admin\ListasController@create']);
            Route::post('/store',           ['middleware'=>'permission:'.$section.'.create','as'=>'admin.listas.store','uses'=>'Admin\ListasController@store']);
            Route::get('/show',             ['middleware'=>'permission:'.$section.'.show','as'=>'admin.listas.show','uses'=>'Admin\ListasController@show']);
            Route::get('/index/{search?}',  ['middleware'=>'permission:'.$section.'.list','as'=>'admin.listas.index','uses'=>'Admin\ListasController@index']);

            Route::get('/pdf',  ['middleware'=>'permission:'.$section.'.list','as'=>'admin.listas.pdf','uses'=>'Utilities\UtilitiesController@exportListToPdf']);
        });

});
