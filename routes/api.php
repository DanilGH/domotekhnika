<?php

/*
|----------------
|   DGH   |  test
|----------------
|   v1 Api. for Domotekhnika.ru
*/

Route::group(['prefix' => 'v1'], function (){
    Route::apiResource('/news', 'NewsController');
});

