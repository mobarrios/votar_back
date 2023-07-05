<?php

Route::post('v2/getUsers', 'Api\ApiV2Controller@getUsers');
Route::get('v2/getEscuelas', 'Api\ApiV2Controller@getEscuelas');
Route::get('v2/getMesas/{id?}', 'Api\ApiV2Controller@getMesas');
Route::get('v2/getCandidatos/{id?}', 'Api\ApiV2Controller@getCandidatos');
Route::post('v2/getListas', 'Api\ApiV2Controller@getListas');

Route::group(['prefix' => 'v2', 'middleware' => 'token'], function () {

    Route::post('getPadronByMesa','Api\ApiV2Controller@getPadronByMesa');
    Route::post('getOperativosByUser/{user_name?}', 'Api\ApiV2Controller@getOperativosByUser');
    Route::post('voto', 'Api\ApiV2Controller@voto');
    Route::post('votoByMesa', 'Api\ApiV2Controller@votoByMesa');
    Route::post('votoByLista', 'Api\ApiV2Controller@votoByLista');
    Route::post('votoPadron', 'Api\ApiV2Controller@votoPadron');
    
    Route::post('getVotosByMesa', 'Api\ApiV2Controller@getVotosByMesa');
    Route::post('getVotosByLista', 'Api\ApiV2Controller@getVotosByLista');
    
   
});