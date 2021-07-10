<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('password',function (){
    return bcrypt('wira');
});

Route::get('/resepsionis', 'API\ResepsionisController@index');
Route::get('/resepsionis/{resepsionis}', 'API\ResepsionisController@show');
Route::delete('/resepsionis/{resepsionis}', 'API\ResepsionisController@destroy');
Route::post('/resepsionis/', 'API\ResepsionisController@store');
Route::patch('/resepsionis/{resepsionis}', 'API\ResepsionisController@update');

Route::get('/tamu', 'API\TamuController@index');
Route::get('/tamu/{tamus}', 'API\TamuController@show');
Route::delete('/tamu/{tamus}', 'API\TamuController@destroy');
Route::post('/tamu/', 'API\TamuController@store');
Route::patch('/tamu/{tamus}', 'API\TamuController@update');

Route::get('/room', 'API\RoomController@index');
Route::get('/room/{room}', 'API\RoomController@show');
Route::delete('/room/{room}', 'API\RoomController@destroy');
Route::post('/room/', 'API\RoomController@store');
Route::patch('/room/{room}', 'API\RoomController@update');

Route::get('/booking', 'API\BookingController@index');
Route::get('/booking/{booking}', 'API\BookingController@show');
Route::delete('/booking/{booking}', 'API\BookingController@destroy');
Route::post('/booking/', 'API\BookingController@store');
Route::patch('/booking/{booking}', 'API\BookingController@update');

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::get('me', 'AuthController@me');
});