<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Artist;
use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{

    public function buscar_albun(Request $request)
    {
        $album_id = $request->albunes;

        $select_albun = albums();
        if (isset($select_albun["message"])) {
            if ($select_albun["message"] == "token_expired") {
                generarToken();
                $select_albun = albums();
            } else {
                $select_albun = [];
            }
        }
        $albunes = album($album_id);
        if (isset($albunes["message"])) {
            if ($albunes["message"] == "token_expired") {
                generarToken();
                $albunes = album($album_id);
            } else {
                $albunes = [];
            }
        }

        return view('admin.albums.index', compact('albunes', 'select_albun'));
    }
    public function busquedaArtista(Request $request)
    {
        $id = $request->artist_id;
        $select_artista = artists();
        if (isset($select_artista["message"])) {
            if ($select_artista["message"] == "token_expired") {
                generarToken();
                $select_artista = artists();
            } else {
                $select_artista = [];
            }
        }

        $artinsts = artist($id);
        if (isset($artinsts["message"])) {
            if ($artinsts["message"] == "token_expired") {
                generarToken();
                $artinsts = artist($id);
            } else {
                $artinsts = [];
            }
        }
        return view('admin.artists.index', compact('artinsts', 'select_artista'));
    }
    public function busquedaCancion(Request $request)
    {
        $name = $request->descipcion;
        $songs = search_songs($name);
        if (isset($songs["message"])) {
            if ($songs["message"] == "token_expired") {
                generarToken();
                $songs = songs();
            } else {
                $songs = [];
            }
        }
        return view('admin.songs.index', compact('songs'));
    }
}
