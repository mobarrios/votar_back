<?php

Route::group(['prefix'=>'escuelas'],function(){

        $section =  'escuelas';

        Route::get('/destroy/{id?}',    ['middleware'=>'permission:'.$section.'.destroy','as'=>'admin.escuelas.destroy','uses'=>'Admin\EscuelasController@destroy']);
        Route::get('/edit/{id?}',       ['middleware'=>'permission:'.$section.'.edit','as'=>'admin.escuelas.edit','uses'=>'Admin\EscuelasController@edit']);
        Route::post('/update/{id?}',    ['middleware'=>'permission:'.$section.'.edit','as'=>'admin.escuelas.update','uses'=>'Admin\EscuelasController@update']);

        Route::get('/create',           ['middleware'=>'permission:'.$section.'.create','as'=>'admin.escuelas.create','uses'=>'Admin\EscuelasController@create']);
        Route::post('/store',           ['middleware'=>'permission:'.$section.'.create','as'=>'admin.escuelas.store','uses'=>'Admin\EscuelasController@store']);
        Route::get('/show',             ['middleware'=>'permission:'.$section.'.show','as'=>'admin.escuelas.show','uses'=>'Admin\EscuelasController@show']);
        Route::get('/index/{search?}',  ['middleware'=>'permission:'.$section.'.list','as'=>'admin.escuelas.index','uses'=>'Admin\EscuelasController@index']);

    Route::get('/pdf',  ['middleware'=>'permission:'.$section.'.list','as'=>'admin.escuelas.pdf','uses'=>'Utilities\UtilitiesController@exportListToPdf']);

});
