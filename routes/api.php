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

Route::apiResources(['users' => 'API\UserController']);
Route::apiResources(['data_krani' => 'API\DataKraniController']);
Route::apiResources(['data_kendaraan' => 'API\DataKendaraanController']);
Route::apiResources(['data_supir' => 'API\DataSupirController']);

Route::post('input_bongkar_muat', 'API\LaporanController@inputBongkarMuat');
Route::get('data_bongkar_muat', 'API\LaporanController@dataBongkarMuat');
Route::get('data_bongkar_muat/{id}', 'API\LaporanController@detailBongkarMuat');
Route::post('data_bongkar_muat', 'API\LaporanController@filterBongkarMuat');

Route::get('bongkar_muat', 'API\LaporanController@bongkarMuat');
Route::post('update_bongkar_muat', 'API\LaporanController@updateBongkarMuat');
