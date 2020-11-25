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

Route::get('/song/find/{song_id}', [App\Http\Controllers\SongController::class, 'find']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/relation', [App\Http\Controllers\SongController::class, 'relate']);
Route::get('/index', [App\Http\Controllers\SongController::class, 'index'])->name('index');
Route::get('/find/song', [App\Http\Controllers\SongController::class, 'check']);
Route::get('/view/playlist', [App\Http\Controllers\SongController::class, 'view']);
Route::get('/songs', [App\Http\Controllers\SongController::class, 'get']);
Route::get('/song/{name}', [App\Http\Controllers\SongController::class, 'show'])->name('song');
Route::get('/playlist/{playlist}', [App\Http\Controllers\SongController::class, 'playlist']);
Route::post('/playlist/create', [App\Http\Controllers\SongController::class, 'create']);
Route::post('/playlist/add', [App\Http\Controllers\SongController::class, 'add']);


