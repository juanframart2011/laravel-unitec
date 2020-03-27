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

Route::get( '/', [ 'as' => 'home', 'uses' => 'UserController@home' ] );
Route::get( 'login', [ 'as' => 'login', 'uses' => 'UserController@login' ] );

Route::post( 'login', [ 'as' => 'login', 'uses' => 'UserController@validate_login' ] );
Route::post( 'search-career', [ 'as' => 'search-career', 'uses' => 'UserController@search_career' ] );
Route::post( 'save', [ 'as' => 'save', 'uses' => 'UserController@save' ] );

Route::group(['prefix' => 'user', 'middleware' => 'userVerify'], function(){#Middlware de User

	Route::get( 'home', [ 'as' => 'home', 'uses' => 'UserController@dashboard' ] );
	Route::get( 'logout', [ 'as' => 'logout', 'uses' => 'UserController@logout' ] );#Logout
});