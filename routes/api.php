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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::namespace('Api')
    ->group(function(){
        Route::get('doctors','UserController@index')->name('api.doctors');
        Route::get('cities','UserController@getCities')->name('api.cities');
        Route::get('doctors/{spec}/{city}','UserController@getDocWithSpec')->name('api.doctorsWithSpec');
        Route::get('doctors/specs','SpecController@index')->name('api.specs');
        Route::get('doctors/{id}','UserController@getDoctorById')->name('api.docId');
        Route::resource('message','MessageController');
    });
