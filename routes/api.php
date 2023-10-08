<?php

use App\Http\Controllers\apis\ApiAlbunController;
use App\Http\Controllers\Apis\ApiArtistController;
use App\Http\Controllers\apis\ApiSongController;
use App\Http\Controllers\apis\ApiUserController;
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
Route::post("loginv2", [ApiUserController::class, 'login']);
Route::get("logoutv2", [ApiUserController::class, 'logout']);
Route::get("generarToken", [ApiUserController::class, 'generarToken']);
//album
Route::get("/albums", [ApiAlbunController::class, 'all_albums']);
Route::get("/album", [ApiAlbunController::class, 'one_album']);
//artistas
Route::get("/artist", [ApiArtistController::class, 'one_artist']);
Route::get('/artists', [ApiArtistController::class, 'all_artists']);
//songs
Route::get("/songs", [ApiSongController::class, 'search_songs']);
Route::get("/song", [ApiSongController::class, 'one_song']);
