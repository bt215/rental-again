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
//petugas
Route::post('login','Controllerpetugas@login');
Route::post('register','Controllerpetugas@register');
//peminjam
Route::post('tambahpeminjam','Controllerpeminjam@tambah')->middleware('jwt.verify');
Route::post('updatepeminjam/{id}','Controllerpeminjam@update')->middleware('jwt.verify');;
Route::get('datapeminjam','Controllerpeminjam@show')->middleware('jwt.verify');;
Route::post('deletepeminjam/{id}','Controllerpeminjam@destroy')->middleware('jwt.verify');
//jenis
Route::post('tambahjenis','Controllerjenis@tambah')->middleware('jwt.verify');
Route::post('updatejenis/{id}','Controllerjenis@update')->middleware('jwt.verify');;
Route::get('datajenis','Controllerjenis@show')->middleware('jwt.verify');;
Route::post('deletejenis/{id}','Controllerjenis@destroy')->middleware('jwt.verify');
//datamobil
Route::post('tambahmobil','Controllerdatamobil@tambah')->middleware('jwt.verify');
Route::post('updatemobil/{id}','Controllerdatamobil@update')->middleware('jwt.verify');;
Route::get('datamobil','Controllerdatamobil@show')->middleware('jwt.verify');;
Route::post('deletemobil/{id}','Controllerdatamobil@destroy')->middleware('jwt.verify');