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

Route::get('/', 'CubeSummationController@index');

Route::get('test_cases', 'CubeSummationController@index');
Route::get('test_cases/show/{test_case}', 'CubeSummationController@showTest')->name('test_cases.show');
Route::get('test_cases/{test_case}/cubes', 'CubeSummationController@cubesResult')->name('cubes.result');

Route::post('test_cases/create', 'CubeSummationController@createTestCase')->name('test_cases.create');

Route::post('test_cases/{test_case}/cubes/create',['as'=> 'cube.create', 'uses' =>'CubeSummationController@createCube']);

Route::post('test_cases/{test_case}/cubes/queries',['as'=> 'cube.queries', 'uses' =>'CubeSummationController@queriesCubes']);
