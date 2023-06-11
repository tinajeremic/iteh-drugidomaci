<?php

use App\Http\Controllers\API\AuthController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

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

//registracija i login
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

//grupne rute, zasticene sanctumom
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function(Request $request) {
        return auth()->user();
    });
    //parcijalne rute
    Route::resource('books', BookController::class)->only(['update','store','destroy']);

    // API route for logout user
    Route::post('/logout', [AuthController::class, 'logout']);
});