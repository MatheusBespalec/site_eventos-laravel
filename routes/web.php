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

use \App\Http\Controllers\EventController;

Route::get('/', [EventController::class,'index'])->name('events');
Route::get('/events', [EventController::class,'index'])->name('events');

Route::get('/evento/novo', [EventController::class,'create'])->name('event.new')->middleware('auth');
Route::post('/evento/novo', [EventController::class,'store'])->name('event.new.form');

Route::get('/evento/{id}', [EventController::class,'show'])->name('event.single');

Route::delete('/evento/{id}', [EventController::class,'destroy'])->name('event.delete')->middleware('auth');

Route::get('/evento/editar/{id}', [EventController::class,'edit'])->name('event.edit')->middleware('auth');
Route::put('/evento/update/{id}', [EventController::class,'update'])->name('event.update')->middleware('auth');

Route::post('/evento/entrar/{id}', [EventController::class,'join'])->name('event.join')->middleware('auth');

Route::delete('/evento/sair/{id}', [EventController::class,'leave'])->name('event.leave')->middleware('auth');

Route::get('/dashboard', [EventController::class,'dashboard'])->name('dashboard')->middleware('auth');
