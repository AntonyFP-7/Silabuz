<x-admin-layout>
    @php
        $ruta = route('songs.store');
        if (substr($ruta, 0, strlen('http://localhost/')) == 'http://localhost/') {
            $ruta = str_replace('http://localhost/', 'http://127.0.0.1:8000/', $ruta);
        }
    @endphp
    <form action="{{  $ruta }}" method="post" class="bg-white rounded-lg p-6 shadow-lg">
        @csrf
        <x-validation-errors class="mb-4"></x-validation-errors>

        <div class="mb-4">
            <x-label class="mb-3">Nombre</x-label>
            <x-input class="w-full" value="{{ old('name') }}" name="name"
                placeholder="escriba el nombre de la cancion"></x-input>
        </div>
        <div class="mb-4">
            <x-label class="mb-1">Artista</x-label>
            <select class="tags-multiple" name="artist_id" style="width: 100%">
                <option value="">Selecina un artista</option>
                @foreach ($artists as $artist)
                    <option value="{{ $artist['id'] }}"@selected(old('artist_id') == $artist['id'])>{{ $artist['name'] }}</option>
                @endforeach
            </select>

        </div>
        <div class="mb-4">
            <x-label class="mb-1">Album</x-label>
            <select class="tags-multiple" name="album_id" style="width: 100%">
                <option value="">Selecina un album</option>
                @foreach ($albums as $album)
                    <option value="{{ $album['id'] }}"@selected(old('album_id') == $album['id'])>{{ $album['name'] }}</option>
                @endforeach
            </select>

        </div>
        <div>
            <x-button class="flex justify-end">
                Crear artista
            </x-button>
        </div>
    </form>

    @push('js')
        <script>
            $(document).ready(function() {
                $('.tags-multiple').select2();
            });
        </script>
    @endpush
</x-admin-layout>
