<?php

namespace App\Http\Controllers\apis;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApiArtistController extends Controller
{
    public function __construct()
    {
        $this->middleware(['token']);
    }
    public function all_artists()
    {
        $artists =  Artist::get()->map(function ($value) {
            if (substr($value->image, 0, 8) !== 'https://') {
                $image = Storage::url($value->image);
            } else $image = $value->image;
            return [
                "id" => $value->id,
                "name" => $value->name,
                "image" =>  $image,
                "gender" => $value->gender->name,
                "gender_id" => $value->gender->id
            ];
        });
        return  response()->json($artists, 200);
    }
    public function one_artist(Request $request)
    {
        $id = $request->id;
        $artinst = Artist::when(!empty($id), function ($query) use ($id) {
            $query->where('id', $id);
        })->get()->map(function ($value) {
            if (substr($value["image"], 0, 8) !== 'https://') {
                $image = Storage::url($value["image"]);
            } else $image = $value["image"];
            return [
                "id" => $value["id"],
                "name" => $value["name"],
                "image" =>  $image,
                "gender" => $value->gender->name,
                "gender_id" => $value->gender->id
            ];
        });
        return  response()->json($artinst, 200);
    }
}
