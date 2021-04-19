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

Route::post('register','UserController@register');
Route::post('login','UserController@login');

Route::middleware('auth:sanctum')->group(function (){
    Route::get('user','UserController@user');
    Route::post('logout','UserController@logout');
});

Route::get('product','ProductController@index');
Route::get('product/{id}','ProductController@show');
Route::post('product','ProductController@store');
Route::put('product/{id}','ProductController@update');
Route::delete('product/{id}','ProductController@delete');

Route::get('transaksi','TransaksiController@index');
Route::get('transaksi/{id}','TransaksiController@show');
Route::post('transaksi','TransaksiController@store');
Route::delete('transaksi/{id}','TransaksiController@delete');