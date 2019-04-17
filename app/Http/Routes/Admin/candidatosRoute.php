<?php

Route::group(['prefix'=>'candidatos'],function(){

        $section =  'candidatos';

        Route::group(['prefix'=>'{partidosId?}'],function() use ($section)
        {    
            Route::get('/destroy/{id?}',    ['middleware'=>'permission:'.$section.'.destroy','as'=>'admin.candidatos.destroy','uses'=>'Admin\CandidatosController@destroy']);
            Route::get('/edit/{id?}',       ['middleware'=>'permission:'.$section.'.edit','as'=>'admin.candidatos.edit','uses'=>'Admin\CandidatosController@edit']);
            Route::post('/update/{id?}',    ['middleware'=>'permission:'.$section.'.edit','as'=>'admin.candidatos.update','uses'=>'Admin\CandidatosController@update']);

            Route::get('/create',           ['middleware'=>'permission:'.$section.'.create','as'=>'admin.candidatos.create','uses'=>'Admin\CandidatosController@create']);
            Route::post('/store',           ['middleware'=>'permission:'.$section.'.create','as'=>'admin.candidatos.store','uses'=>'Admin\CandidatosController@store']);
            Route::get('/show',             ['middleware'=>'permission:'.$section.'.show','as'=>'admin.candidatos.show','uses'=>'Admin\CandidatosController@show']);
            Route::get('/index/{search?}',  ['middleware'=>'permission:'.$section.'.list','as'=>'admin.candidatos.index','uses'=>'Admin\CandidatosController@index']);

            Route::get('/pdf',  ['middleware'=>'permission:'.$section.'.list','as'=>'admin.candidatos.pdf','uses'=>'Utilities\UtilitiesController@exportListToPdf']);
        });

});
