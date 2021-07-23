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
    return view('guest.index');
});

Auth::routes();
<<<<<<< HEAD
<<<<<<< HEAD


Route::get('/dashboard', 'HomeController@index')->name('home');
/* Route::delete('/dashboard/{user}','Admin\UserController@destroy')->middleware('auth')->name('user.destroy'); */
Route::namespace('Admin')
    ->middleware('auth')
    ->group(function(){
        Route::resource('/user','UserController');
    });
Route::get('{any?}', 'PageController@index')->where('any','.*');
=======
=======
>>>>>>> 7a2e4f814360b2a3a142bc7d72ff329f1a14d676

Route::get('/dashboard', 'HomeController@index')->name('home');
Route::delete('/dashboard/{user}','Admin\UserController@destroy')->middleware('auth')->name('user.destroy');
Route::get('{any?}', 'PageController@index')->where('any','.*');
<<<<<<< HEAD
>>>>>>> 7a2e4f814360b2a3a142bc7d72ff329f1a14d676
=======
>>>>>>> 7a2e4f814360b2a3a142bc7d72ff329f1a14d676
