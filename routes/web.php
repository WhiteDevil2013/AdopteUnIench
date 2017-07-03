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
Route::get('/profile/edit/{id}', 'ProfileController@edit')->name('profile.edit');
Route::post('/profile/match/{id}', 'ProfileController@match')->name('profileMatch');
Route::post('/profile/deleteMatch/{id}', 'ProfileController@deleteMatch')->name('deleteMatch');

Route::get('/preference', 'PreferenceController@index')->name('preference');
Route::post('/preference/create', 'PreferenceController@create')->name('preferenceCreate');
Route::post('/preference/update', 'PreferenceController@update')->name('preferenceUpdate');

Route::get('/message', 'MessageController@index')->name('message');
Route::get('/message/discuss', 'MessageController@discuss')->name('discuss');
Route::post('/message/sendMessage', 'MessageController@sendMessage')->name('sendMessage');
Route::post('/message/delete', 'MessageController@delete')->name('delete');
