<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

//Юзеры
Route::middleware('guest')->group(function () {
    Route::post('user/login', [UserController::class, 'login'])->name('user.login');
    Route::post('user/register', [UserController::class, 'register'])->name('user.register');

    Route::get('user/login', function () {
        return view('user.login');
    });
    Route::get('user/register', function () {
        return view('user.register');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('user/profile', [UserController::class, 'profile'])->name('user.profile');
});


