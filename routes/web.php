<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::post('signup', 'AuthController@register');
 
Route::post('login', 'AuthController@login');

Route::group(['middleware' => 'jwt.auth'], function(){
    Route::get('auth/user', 'AuthController@user');
    Route::post('auth/logout', 'AuthController@logout');
    Route::post('products', 'AuthController@postproduto');
    Route::put('products/:productId', 'AuthController@putproduto');
    Route::delete('products/:productId', 'AuthController@deleteproduto');
    Route::get('products/:productId', 'AuthController@getprodutosid');
    Route::get('products', 'AuthController@getproduto');

  });

  Route::middleware('jwt.refresh')->get('/token/refresh', 'AuthController@refresh');