<?php

Route::group(['prefix'=>'operativos'],function(){

        $section =  'operativos';

        Route::get('/destroy/{id?}',    ['middleware'=>'permission:'.$section.'.destroy','as'=>'admin.operativos.destroy','uses'=>'Admin\OperativosController@destroy']);
        Route::get('/edit/{id?}',       ['middleware'=>'permission:'.$section.'.edit','as'=>'admin.operativos.edit','uses'=>'Admin\OperativosController@edit']);
        Route::post('/update/{id?}',    ['middleware'=>'permission:'.$section.'.edit','as'=>'admin.operativos.update','uses'=>'Admin\OperativosController@update']);

        Route::get('/create',           ['middleware'=>'permission:'.$section.'.create','as'=>'admin.operativos.create','uses'=>'Admin\OperativosController@create']);
        Route::post('/store',           ['middleware'=>'permission:'.$section.'.create','as'=>'admin.operativos.store','uses'=>'Admin\OperativosController@store']);
        Route::get('/show/{id?}',       ['middleware'=>'permission:'.$section.'.show','as'=>'admin.operativos.show','uses'=>'Admin\OperativosController@show']);
        Route::get('/index/{search?}',  ['middleware'=>'permission:'.$section.'.list','as'=>'admin.operativos.index','uses'=>'Admin\OperativosController@index']);
        Route::get('/mesasUsuarios/{id?}',['middleware'=>'permission:'.$section.'.show','as'=>'admin.operativos.mesasUsuarios','uses'=>'Admin\OperativosController@mesasUsuarios']);
        Route::get('/mesasUsuarios/edit/{id?}/{mesaId?}',['middleware'=>'permission:'.$section.'.show','as'=>'admin.operativos.mesasUsuarios.edit','uses'=>'Admin\OperativosController@mesasUsuariosEdit']);

        Route::post('/mesasUsuarios/{id?}',    ['middleware'=>'permission:'.$section.'.edit','as'=>'admin.operativos.post.mesasUsuarios','uses'=>'Admin\OperativosController@postMesasUsuarios']);


    Route::get('/pdf',  ['middleware'=>'permission:'.$section.'.list','as'=>'admin.operativos.pdf','uses'=>'Utilities\UtilitiesController@exportListToPdf']);

});
