<?php

namespace App\Http\Controllers\apis;

use App\Http\Controllers\Controller;
use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApiSongController extends Controller
{
    public function __construct()
    {
        $this->middleware(['token']);
    }
    public function search_songs()
    {
        $songs = Song::get()->map(function ($value) {
            $artista = $value->artist->name;
            $images = $value->artist->image;;
            $album = $value->album->name;
            if (substr($images, 0, 8) !== 'https://') {
                $image = Storage::url($images);
            } else $image = $images;
            return [
                "id" => $value->id,
                "name" => $value->name,
                "artist" =>  $artista,
                "album" =>  $album,
                "image" => $image
            ];
        });
        return  response()->json($songs, 200);
    }
    public function one_song(Request $request)
    {
        $name = $request->descipcion;
        $songs = Song::when(!empty($name), function ($query) use ($name) {
            $query->where('name', 'like', "%$name%");
        })->get()
            ->map(function ($value) {
                $artista = $value->artist->name;
                $images = $value->artist->image;;
                $album = $value->album->name;
                if (substr($images, 0, 8) !== 'https://') {
                    $image = Storage::url($images);
                } else $image = $images;
                return [
                    "id" => $value->id,
                    "name" => $value->name,
                    "artist" =>  $artista,
                    "album" =>  $album,
                    "image" => $image
                ];
            });
        return  response()->json($songs, 200);
    }
}
