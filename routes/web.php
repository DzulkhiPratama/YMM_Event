<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;

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

// Route::get('/', function () {
//     return view('dashboard');
// });

Route::get('/', [EventController::class, 'index']);

// Route::resource('/event', EventController::class)->middleware('auth');
Route::get('/event/{event}', [EventController::class, 'show']);
Route::post('/event', [EventController::class, 'store'])->middleware('auth');
Route::put('/event/{event_id}', [EventController::class, 'update'])->middleware('auth');
Route::get('/event/{event_id}/download', [EventController::class, 'download']);
Route::delete('/event/{event_id}', [EventController::class, 'destroy'])->middleware('auth');


Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);

Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/user', [UserController::class, 'index'])->middleware('auth');
// Route::post('/user', [UserController::class, 'store'])->middleware('auth');
Route::put('/user/{userid}', [UserController::class, 'update'])->middleware('auth');
Route::delete('/user/{userid}', [UserController::class, 'destroy'])->middleware('auth');
