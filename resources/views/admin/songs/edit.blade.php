<x-admin-layout>
    @php
        $ruta = route('songs.update', $song['id']);
        if (substr($ruta, 0, strlen('http://localhost/')) == 'http://localhost/') {
            $ruta = str_replace('http://localhost/', 'http://127.0.0.1:8000/', $ruta);
        }
    @endphp
    <form action="{{ $ruta }}" method="post" class="bg-white rounded-lg p-6 shadow-lg">
        @csrf
        @method('PUT')
        <x-validation-errors class="mb-4"></x-validation-errors>
        <div class="mb-4">
            <x-label class="mb-3">Nombre</x-label>
            <x-input class="w-full" value="{{ old('name', $song->name) }}" name="name"
                placeholder="escriba el nombre de la cancion"></x-input>
        </div>
        <div class="mb-4">
            <x-label class="mb-1">Artista</x-label>
            <select class="tags-multiple" name="artist_id" style="width: 100%">
                <option value="">Selecina un artista</option>
                @foreach ($artists as $artist)
                    <option value="{{ $artist['id'] }}"@selected(old('artist_id', $song['artist_id']) == $artist['id'])>{{ $artist['name'] }}</option>
                @endforeach
            </select>

        </div>
        <div class="mb-4">
            <x-label class="mb-1">Album</x-label>
            <select class="tags-multiple" name="album_id" style="width: 100%">
                <option value="">Selecina un album</option>
                @foreach ($albums as $album)
                    <option value="{{ $album['id'] }}"@selected(old('album_id', $song['album_id']) == $album['id'])>{{ $album['name'] }}</option>
                @endforeach
            </select>

        </div>
        <div>
            <x-danger-button class="mr-2" onclick="deleteCategory()">Eliminar</x-danger-button>
            <x-button class="flex
                        justify-end">
                Actualizar cancion
            </x-button>
        </div>
    </form>
    @php
        $rutadelete = route('songs.destroy', $song['id']);
        if (substr($rutadelete, 0, strlen('http://localhost/')) == 'http://localhost/') {
            $rutadelete = str_replace('http://localhost/', 'http://127.0.0.1:8000/', $rutadelete);
        }
    @endphp
    <form id="formDelete" action="{{ $rutadelete }}" method="post">
        @csrf
        @method('DELETE')
    </form>
    @push('js')
        <script>
            $(document).ready(function() {
                $('.tags-multiple').select2();
            });

            function deleteCategory() {
                let form = document.getElementById('formDelete');
                form.submit();
            }
        </script>
    @endpush
</x-admin-layout>
