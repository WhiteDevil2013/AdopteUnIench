<?php

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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile','ProfileController@index')->name('profile');

Route::get('/profile/{id}', 'ProfileController@show')->name('profileShow');

Route::get('/profile/edit/{id}', 'ProfileController@edit');

Route::get('/preference', 'PreferenceController@index')->name('preference');
Route::post('/preference/create', 'PreferenceController@create')->name('preferenceCreate');
Route::post('/preference/update', 'PreferenceController@update')->name('preferenceUpdate');
