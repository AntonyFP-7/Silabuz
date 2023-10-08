<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $albunes = albums();
        if (isset($albunes["message"])) {
            if ($albunes["message"] == "token_expired") {
                generarToken();
                $albunes = albums();
            } else {
                $albunes = [];
            }
        }
        $select_albun = $albunes;
        return view('admin.albums.index', compact('albunes', 'select_albun'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.albums.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'body' =>  'required',
            'image' => 'nullable|image'
        ]);
        $data = $request->all();
        if ($request->file('image')) {
            $file_name = str_replace(' ', '_', $request->name) . '.' . $request->file('image')->getClientOriginalExtension();
            $data['image'] = $request->file('image')->storeAs('albums', $file_name);
        } else $data['image'] = "https://www.colombianosune.com/sites/default/files/asociaciones/NO_disponible-43_14.jpg";
        Album::create($data);
        session()->flash('swal', [
            'icon' => 'success',
            'text' => 'Album  creado',
            'title' =>  '!Buen trabajo!'
        ]);
        return redirect()->route('albums.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $album = Album::where('id', $id)->first();
        if (substr($album->image, 0, 8) !== 'https://') {
            $album->image = Storage::url($album->image);
        }
        return view('admin.albums.show', compact('album'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $album = album($id);
        if (isset($album["message"])) {
            if ($album["message"] == "token_expired") {
                generarToken();
                $album = album($id);
            } else {
                return redirect()->route('albums.index');
            }
        }
        $album = $album[0];
        return view('admin.albums.edit', compact('album'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'body' =>  'required',
            'image' => 'nullable|image'
        ]);
        $data = $request->all();
        $album = Album::find($id);
        if ($request->file('image')) {
            if (substr($album->image, 0, 8) !== 'https://') {
                //elimino si se cargo uma imagen
                Storage::delete($album->image);
            }
            //guardo la nueva imagen
            $file_name = str_replace(' ', '_', $album->name) . '.' . $request->file('image')->getClientOriginalExtension();
            $data['image'] = $request->file('image')->storeAs('albums', $file_name);
        }
        $album->update($data);
        session()->flash('swal', [
            'icon' => 'success',
            'text' => 'Album  actualizado',
            'title' =>  '!Buen trabajo!'
        ]);
        return redirect()->route('albums.edit', $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Song::where('album_id', $id)->exists()) {
            session()->flash('swal', [
                'icon' => 'warning',
                'text' => 'Album  no se peude eliminar porque tiene canciones',
                'title' =>  '!aviso!'
            ]);
            return redirect()->route('albums.edit', $id);
        }
        $album = Album::find($id);
        $album->delete();
        session()->flash('swal', [
            'icon' => 'success',
            'text' => 'Album  eliminado',
            'title' =>  '!buem trabajo!'
        ]);
        return redirect()->route('albums.index');
    }
}
