<?php

Route::group(['prefix'=>'inserts'],function(){

	Route::get('/clients',[ 'uses'=>'Utilities\InsertsController@clients'

	]);
	
});
