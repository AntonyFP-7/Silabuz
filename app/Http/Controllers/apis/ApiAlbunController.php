<?php

namespace App\Http\Controllers\apis;

use App\Http\Controllers\Controller;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApiAlbunController extends Controller
{

    public function __construct()
    {
        $this->middleware(['token']);
    }
    public function all_albums()
    {
        $albunes =  Album::orderBy('id','desc')->get()->map(function ($value) {
            if (substr($value->image, 0, 8) !== 'https://') {
                $image = Storage::url($value->image);
            } else $image = $value->image;
            return [
                "id" => $value->id,
                "name" => $value->name,
                "image" =>  $image,
                "body" =>  $value->body
            ];
        });
        return  response()->json($albunes, 200);
    }
    public function one_album(Request $request)
    {
        $id_albun = $request->id;
        $albunes = Album::when(!empty($id_albun), function ($query) use ($id_albun) {
            $query->where('albums.id', $id_albun);
        })->get()->map(function ($value) {
            if (substr($value->image, 0, 8) !== 'https://') {
                $image = Storage::url($value->image);
            } else $image = $value->image;
            return [
                "id" => $value->id,
                "name" => $value->name,
                "image" =>  $image,
                "body" =>  $value->body
            ];
        });;
        return  response()->json($albunes, 200);
    }

}
