<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\Admin\AlbumController;
use App\Http\Controllers\Admin\ArtistController;
use App\Http\Controllers\Admin\SongController;
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

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->name('dashboard');
Route::post('/busquedaAlbun', [AdminController::class, 'buscar_albun'])->name('albums.busquedaAlbun');
Route::post('/busquedaArtista', [AdminController::class, 'busquedaArtista'])->name('artists.busquedaArtista');
Route::post('/busquedaCancion', [AdminController::class, 'busquedaCancion'])->name('songs.busquedaCancion');
Route::resource('/albums', AlbumController::class);
Route::resource('/artists', ArtistController::class);
Route::resource('/songs', SongController::class);
