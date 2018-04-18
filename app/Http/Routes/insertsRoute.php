<?php

Route::group(['prefix'=>'inserts'],function(){

	Route::get('/clients',[ 'uses'=>'Utilities\InsertsController@clients']);
	Route::get('/brands',['uses'=>'Utilities\InsertsController@brands']);
	Route::get('/models',['uses'=>'Utilities\InsertsController@models']);
	
});
