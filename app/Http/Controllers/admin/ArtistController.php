<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use App\Models\Gender;
use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $artinsts = artists();
        if (isset($artinsts["message"])) {
            if ($artinsts["message"] == "token_expired") {
                generarToken();
                $artinsts = artists();
            } else {
                $artinsts = [];
            }
        }
        $select_artista = $artinsts;
        return view('admin.artists.index', compact('artinsts', 'select_artista'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genders = Gender::all()->toArray();
        return view('admin.artists.create', compact('genders'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'gender_id' => 'required|exists:genders,id',
            'image' => 'nullable|image'
        ]);
        $data = $request->all();
        if ($request->file('image')) {
            $file_name = str_replace(' ', '_', $request->name) . '.' . $request->file('image')->getClientOriginalExtension();
            $data['image'] = $request->file('image')->storeAs('albums', $file_name);
        } else $data['image'] = "https://www.colombianosune.com/sites/default/files/asociaciones/NO_disponible-43_14.jpg";
        Artist::create($data);
        session()->flash('swal', [
            'icon' => 'success',
            'text' => 'Artista  creado',
            'title' =>  '!Buen trabajo!'
        ]);
        return redirect()->route('artists.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $artist = Artist::where('id', $id)->first();
        if (substr($artist->image, 0, 8) !== 'https://') {
            $artist->image = Storage::url($artist->image);
        }
        return view('admin.artists.show', compact('artist'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $artist = artist($id);
        if (isset($artist["message"])) {
            if ($artist["message"] == "token_expired") {
                generarToken();
                $artist = artist($id);
            } else {
                $artist = [];
            }
        }
        $artist = $artist[0];
        $genders = Gender::all()->toArray();
        return view('admin.artists.edit', compact('artist', 'genders'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'gender_id' => 'required|exists:genders,id',
            'image' => 'nullable|image'
        ]);
        $data = $request->all();
        $artist = Artist::find($id);
        if ($request->file('image')) {
            if (substr($artist->image, 0, 8) !== 'https://') {
                Storage::delete($artist->image);
            }
            $file_name = str_replace(' ', '_', $artist->name) . '.' . $request->file('image')->getClientOriginalExtension();
            $data['image'] = $request->file('image')->storeAs('albums', $file_name);
        }
        $artist->update($data);
        session()->flash('swal', [
            'icon' => 'success',
            'text' => 'Artista  actualizado',
            'title' =>  '!Buen trabajo!'
        ]);
        return redirect()->route('artists.edit', $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Song::where('artist_id', $id)->exists()) {
            session()->flash('swal', [
                'icon' => 'warning',
                'text' => 'Artista  no se peude eliminar porque tiene canciones',
                'title' =>  '!aviso!'
            ]);
            return redirect()->route('artists.edit', $id);
        }
        $album = Artist::find($id);
        $album->delete();
        session()->flash('swal', [
            'icon' => 'success',
            'text' => 'Artista  eliminado',
            'title' =>  '!buem trabajo!'
        ]);
        return redirect()->route('artists.index');
    }
}
