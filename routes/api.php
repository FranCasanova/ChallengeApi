<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/topsecret', 'App\Http\Controllers\TransmissionController@store');

Route::get('/topsecret_split', 'App\Http\Controllers\TransmissionController@get_split');

Route::post('/topsecret_split/{satellite_name}', 'App\Http\Controllers\TransmissionController@store_split');



