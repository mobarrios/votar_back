<?php

Route::get('v2/getUsers/{user_name?}/{password?}', 'Api\ApiV2Controller@getUsers');
Route::get('v2/getEscuelas', 'Api\ApiV2Controller@getEscuelas');
Route::get('v2/getMesas/{id?}', 'Api\ApiV2Controller@getMesas');
Route::get('v2/getCandidatos/{id?}', 'Api\ApiV2Controller@getCandidatos');
Route::get('v2/getListas/{id?}', 'Api\ApiV2Controller@getListas');

Route::group(['prefix' => 'v2', 'middleware' => 'token'], function () {

    Route::post('getPadronByMesa','Api\ApiV2Controller@getPadronByMesa');
    Route::post('getOperativosByUser/{user_name?}', 'Api\ApiV2Controller@getOperativosByUser');
    Route::post('voto', 'Api\ApiV2Controller@voto');
   
});