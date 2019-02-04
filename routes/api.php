<?php

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

Route::get('cities', 'CityController@index');
Route::get('cities/{city}', 'CityController@show');
Route::post('cities', 'CityController@store');
Route::put('cities/{city}', 'CityController@update');
Route::delete('cities/{city}', 'CityController@delete');

Route::get('developers', 'DeveloperController@index');
Route::get('developers/{developer}', 'DeveloperController@show');
Route::post('developers', 'DeveloperController@store');
Route::put('developers/{developer}', 'DeveloperController@update');
Route::delete('developers/{developer}', 'DeveloperController@delete');

Route::get('listings', 'ListingController@index');
Route::get('listings/{listing}', 'ListingController@show');
Route::post('listings', 'ListingController@store');
Route::put('listings/{listing}', 'ListingController@update');
Route::delete('listings/{listing}', 'ListingController@delete');
