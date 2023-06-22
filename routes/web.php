<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MessageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');

Route::get('/search', [App\Http\Controllers\PostController::class, 'search'])->name('search');

Route::resource('/users', App\Http\Controllers\UserController::class)->except('index', 'create', 'store');

Route::resource('/posts', App\Http\Controllers\PostController::class)->except('index', 'create');

Route::resource('/comments', App\Http\Controllers\CommentController::class)->except('index', 'create');