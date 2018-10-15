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

//Route::get('/', function () {
//    return route('match.gaddteam');
//});

Route::post('/', [
    'uses' => 'MatchController@addteam',
    'as' => 'match.addteam'
]);

Route::get('/', [
    'uses' => 'MatchController@gaddteam',
    'as' => 'match.gaddteam'
]);

Route::get('/delete', [
    'uses' => 'MatchController@clear',
    'as' => 'clear'
]);
