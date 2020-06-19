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

Route::get('/', 'UserController@home');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile/{user}', 'UserController@view')->name('profile.show');
Route::get('/account/created-success', 'UserController@show')->middleware('verified');
Route::get('/profile/{user}/edit', 'ProfileController@edit')->name('profile.edit')->middleware('auth');
Route::get('/servicefinder', 'UserController@index');
Route::get('/view/profile/{user}', 'ProfileController@view');
Route::get('/search/result', 'UserController@search');
Route::get('/find/user', 'UserController@find');
Route::get('/customer/register', 'CustomerController@register');
Route::get('/customer/login', 'CustomerController@login');
Route::get('/rate/service/{user}', 'ProfileController@save');
Route::get('/view/comments/{user}', 'UserController@comments');
Route::post('/profile/{user}/edit', 'ProfileController@store');
Route::post('/customer/registered', 'CustomerRegisterController@register');
Route::post('/login/success', 'CustomerController@redirect');
Route::post('/view/profile/{user}', 'UserController@post')->middleware('loggedin');
Route::patch('/profile/{user}', 'ProfileController@update')->name('profile.update');