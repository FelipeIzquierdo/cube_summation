<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('cubes', 'CubeSummationController@index');
Route::post('cubes/init_test_cases', 'CubeSummationController@initTestCases')->name('cube.init_test_cases');
