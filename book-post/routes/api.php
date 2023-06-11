<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\UserBookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WriterBookController;
use App\Http\Controllers\WriterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//api rute
Route::resource('users', UserController::class);
Route::resource('books', BookController::class);
Route::resource('writers', WriterController::class);

//Ugnjezdeni resursi:

//sve knjige koje je objavio jedan user
Route::get('/users/{id}/books', [UserBookController::class, 'index'])
->name('users.books.index');

//sve knjige koje je napisao jedan pisac
Route::get('/writers/{id}/books', [WriterBookController::class, 'index'])
->name('writers.books.index');

