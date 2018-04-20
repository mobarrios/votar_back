<?php
	
Route::group(['prefix'=>'states'],function(){

	

        $section =  'states';

        Route::get('/destroy/{id?}',    ['as'=>'admin.states.destroy','uses'=>'Tecnica\StatesController@destroy']);
        Route::get('/edit/{id?}',       ['as'=>'admin.states.edit','uses'=>'Tecnica\StatesController@edit']);
        Route::post('/update/{id?}',    ['as'=>'admin.states.update','uses'=>'Tecnica\StatesController@update']);

        Route::get('/create',           ['as'=>'admin.states.create','uses'=>'Tecnica\StatesController@create']);
        Route::post('/store',           ['as'=>'admin.states.store','uses'=>'Tecnica\StatesController@store']);
        Route::get('/show',             ['as'=>'admin.states.show','uses'=>'Tecnica\StatesController@show']);
        Route::get('/index/{search?}',  ['as'=>'admin.states.index','uses'=>'Tecnica\StatesController@index']);
        Route::get('/pdf',              ['middleware'=>'permission:'.$section.'.list','as'=>'admin.states.pdf','uses'=>'Tecnica\StatesController@states']);
      
		/*
		Route::get('/destroy/{id?}',    ['middleware'=>'permission:'.$section.'.destroy','as'=>'admin.orders.destroy','uses'=>'Tecnica\OrdersController@destroy']);
        Route::get('/edit/{id?}',       ['middleware'=>'permission:'.$section.'.edit','as'=>'admin.orders.edit','uses'=>'Tecnica\OrdersController@edit']);
        Route::post('/update/{id?}',    ['middleware'=>'permission:'.$section.'.edit','as'=>'admin.orders.update','uses'=>'Tecnica\OrdersController@update']);

        Route::get('/create',           ['middleware'=>'permission:'.$section.'.create','as'=>'admin.orders.create','uses'=>'Tecnica\OrdersController@create']);
        Route::post('/store',           ['middleware'=>'permission:'.$section.'.create','as'=>'admin.orders.store','uses'=>'Tecnica\OrdersController@store']);
        Route::get('/show',             ['middleware'=>'permission:'.$section.'.show','as'=>'admin.orders.show','uses'=>'Tecnica\OrdersController@show']);
        Route::get('/index/{search?}',  ['middleware'=>'permission:'.$section.'.list','as'=>'admin.orders.index','uses'=>'Tecnica\OrdersController@index']);

		*/
});