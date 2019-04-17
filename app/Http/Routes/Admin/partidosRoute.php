<?php

Route::group(['prefix'=>'partidos'],function(){

        $section =  'partidos';

        Route::get('/destroy/{id?}',    ['middleware'=>'permission:'.$section.'.destroy','as'=>'admin.partidos.destroy','uses'=>'Admin\PartidosController@destroy']);
        Route::get('/edit/{id?}',       ['middleware'=>'permission:'.$section.'.edit','as'=>'admin.partidos.edit','uses'=>'Admin\PartidosController@edit']);
        Route::post('/update/{id?}',    ['middleware'=>'permission:'.$section.'.edit','as'=>'admin.partidos.update','uses'=>'Admin\PartidosController@update']);

        Route::get('/create',           ['middleware'=>'permission:'.$section.'.create','as'=>'admin.partidos.create','uses'=>'Admin\PartidosController@create']);
        Route::post('/store',           ['middleware'=>'permission:'.$section.'.create','as'=>'admin.partidos.store','uses'=>'Admin\PartidosController@store']);
        Route::get('/show',             ['middleware'=>'permission:'.$section.'.show','as'=>'admin.partidos.show','uses'=>'Admin\PartidosController@show']);
        Route::get('/index/{search?}',  ['middleware'=>'permission:'.$section.'.list','as'=>'admin.partidos.index','uses'=>'Admin\PartidosController@index']);

    Route::get('/pdf',  ['middleware'=>'permission:'.$section.'.list','as'=>'admin.partidos.pdf','uses'=>'Utilities\UtilitiesController@exportListToPdf']);

});
