<?php

use App\Http\Controllers\artist\ArtistController;
use App\Http\Controllers\User\UserController;
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

Route::get('/', [UserController::class, 'index'])->name('home');
Route::post('Loginv2', [UserController::class, 'loginv2'])->name('loginv2');
Route::post('logoutv2', [UserController::class, 'logoutv2'])->name('logoutv2');

