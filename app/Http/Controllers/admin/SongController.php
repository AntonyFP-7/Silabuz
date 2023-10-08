<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Artist;
use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SongController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $songs  = songs();
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $artists = Artist::all()->toArray();
        $albums = Album::all()->toArray();
        return view('admin.songs.create', compact('artists', 'albums'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'album_id' =>  'required|exists:albums,id',
            'artist_id' => 'required|exists:artists,id',
        ]);
        $data = $request->all();
        Song::create($data);
        session()->flash('swal', [
            'icon' => 'success',
            'text' => 'Cancion  creada',
            'title' =>  '!Buen trabajo!'
        ]);
        return redirect()->route('songs.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $song = Song::where('id', $id)->first();
        $artists = Artist::all()->toArray();
        $albums = Album::all()->toArray();
        return view('admin.songs.edit', compact('song', 'artists', 'albums'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'album_id' =>  'required|exists:albums,id',
            'artist_id' => 'required|exists:artists,id',
        ]);
        $data = $request->all();
        $song = Song::find($id);
        $song->update($data);
        session()->flash('swal', [
            'icon' => 'success',
            'text' => 'Cancion  actualizada',
            'title' =>  '!Buen trabajo!'
        ]);
        return redirect()->route('songs.edit', $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $song = Song::find($id);
        $song->delete();
        session()->flash('swal', [
            'icon' => 'success',
            'text' => 'Cancion  eliminada',
            'title' =>  '!buem trabajo!'
        ]);
        return redirect()->route('songs.index');
    }
}
