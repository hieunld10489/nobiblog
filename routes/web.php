<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return Redirect::route('home/yogoit');
});

/* Home routes */

Route::group(['prefix' => 'home/'], function () {
    Route::get('/', ['as' => 'home/index', 'uses' => 'HomeController@index']);
    Route::get('/corona', ['as' => 'home/corona', 'uses' => 'HomeController@corona']);
    Route::get('/yogoit', ['as' => 'home/yogoit', 'uses' => 'HomeController@yogoit']);
    Route::get('/yogo-result/{typeid?}', [
        'as' => 'home/yogo-result',
        'uses' => 'HomeController@yogoResult'
    ]);
    Route::get('/yogosupoutsu', ['as' => 'home/yogosupoutsu', 'uses' => 'HomeController@yogosupoutsu']);

    //Route::post('/yogoit', array('as' => 'p_home/yogoit', 'uses' => 'HomeController@yogoit'));
    Route::post('/load-page', array('as' => 'p_home/load-page', 'uses' => 'HomeController@loadPage'));
});

Route::group(['prefix' => 'yogo/'], function () {
    Route::get('/{name?}', array('as' => 'yogo', 'uses' => 'HomeController@yogo'));
});
