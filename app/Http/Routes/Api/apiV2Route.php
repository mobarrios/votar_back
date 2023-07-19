<?php

Route::post('v2/getUsers', 'Api\ApiV2Controller@getUsers');
Route::get('v2/getEscuelas', 'Api\ApiV2Controller@getEscuelas');
Route::get('v2/getMesas/{id?}', 'Api\ApiV2Controller@getMesas');
Route::get('v2/getCandidatos/{id?}', 'Api\ApiV2Controller@getCandidatos');
Route::post('v2/getListas', 'Api\ApiV2Controller@getListas');

// reportes
Route::get('v2/escuelas', 'Api\ApiV2Controller@escuelas');
Route::get('v2/mesas', 'Api\ApiV2Controller@mesas');
Route::get('v2/fiscal', 'Api\ApiV2Controller@fiscal');
Route::get('v2/padron', 'Api\ApiV2Controller@padron');
Route::get('v2/candidatos', 'Api\ApiV2Controller@candidatos');
Route::get('v2/listas', 'Api\ApiV2Controller@listas');
Route::get('v2/voto', 'Api\ApiV2Controller@voto');
Route::get('v2/resultado', 'Api\ApiV2Controller@resultado');
Route::get('v2/resultadosListas', 'Api\ApiV2Controller@resultadosListas');
Route::get('v2/operativos', 'Api\ApiV2Controller@operativos');

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

