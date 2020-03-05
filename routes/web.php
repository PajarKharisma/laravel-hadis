<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/hadits', function () {
    return view('index');
});

Route::prefix('hadits')->group(function(){
    Route::get('pencarian/', 'PencarianController@index');
    AdvancedRoute::controllers([
        '/pencarian' => 'PencarianController',
    ]);
    Route::get('tentang/', function(){
        return view('etc.tentang');
    });
    Route::get('bantuan/', function(){
        return view('etc.bantuan');
    });
});
