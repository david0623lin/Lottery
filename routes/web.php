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

Route::get('/game/history', 'GameHistoryController@run');
Route::get('/game/statistics', 'GameStatisticsController@run');
Route::get('/game/distribut', 'GameDistributController@run');
Route::get('/game/order', 'GameOrderController@run');
