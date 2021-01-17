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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::group([
    'middileware'=>'api',
    'namespace'=>'App\Http\Controllers',
    'prefix'=>'auth'
],function($router){
    Route::post('login','AuthController@login');
    Route::post('register','AuthController@register');
    Route::post('logout','AuthController@logout');
    Route::get('profile','AuthController@profile');
    Route::post('refresh','AuthController@refresh');
});

Route::group([
    'middileware'=>'api',
    'namespace'=>'App\Http\Controllers'
  
],function($router){
    Route::resource('posts','PostsController');
    
});
Route::group([
    'middileware'=>'api',
    'namespace'=>'App\Http\Controllers'
    
],function($router){
    Route::resource('todos','TodoController');
   
});

Route::group([
    'middileware'=>'api',
    'namespace'=>'App\Http\Controllers'
    
],function($router){
    Route::resource('categories','CategoriesController');
   
});
Route::group([
    'middileware'=>'api',
    'namespace'=>'App\Http\Controllers'
    
],function($router){
    Route::resource('bycategory','ShowByCategoryController');
   
});
//Route::apiResource('/bycategory', 'ShowByCategoryController');
//Route::apiResource('/bycategory/{id}', 'ShowByCategoryController');