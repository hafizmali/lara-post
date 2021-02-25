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


 Route::get('/', [App\Http\Controllers\HomeController::class, 'showIndex'])->name('/');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/create-post', [App\Http\Controllers\HomeController::class, 'getThreadPage'])->name('create-post');
Route::post('/create-post', [App\Http\Controllers\HomeController::class, 'saveThreadPage'])->name('create-post');
Route::get('show-post', [App\Http\Controllers\HomeController::class, 'showPost'])->name('show-post');
Route::get('delete-post/{id?}', [App\Http\Controllers\HomeController::class, 'destroy'])->name('delete-post');
Route::get('edit-post/{id?}', [App\Http\Controllers\HomeController::class, 'editPost'])->name('edit-post');
Route::post('post-update', [App\Http\Controllers\HomeController::class, 'updatePost'])->name('post-update');

