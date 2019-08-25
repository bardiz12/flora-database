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
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/
Route::get('families', 'FrontDataController@families');
Route::get('family/{name}','FrontDataController@floraByFamily');
Route::get('family/{family_name}/flora/{scientific_name}','FrontDataController@flora');
Route::post('search','FrontDataController@search');