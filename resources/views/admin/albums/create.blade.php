<x-admin-layout>
    @php
        $ruta = route('albums.store');
        if (substr($ruta, 0, strlen('http://localhost/')) == 'http://localhost/') {
            $ruta = str_replace('http://localhost/', 'http://127.0.0.1:8000/', $ruta);
        }
    @endphp
    <form action="{{ $ruta}}" method="post" enctype="multipart/form-data"
        class="bg-white rounded-lg p-6 shadow-lg">
        @csrf
        <x-validation-errors class="mb-4"></x-validation-errors>
        <div class="mb-6 relative">
            <figure>
                <img id="imgPreview" class="aspect-[16/9] object-cover object-center w-full"
                    src="https://www.colombianosune.com/sites/default/files/asociaciones/NO_disponible-43_14.jpg"
                    alt="">
            </figure>
            <div class="absolute top-8 right-8">
                <label class="bg-white px-4 py-2 rounded-lg cursor-pointer">
                    <i class="fa-solid fa-camera mr-2"></i>
                    Agregar imagen
                    <input type="file" onchange="previewImage(event, '#imgPreview')" class="hidden" name="image"
                        accept="image/*">
                </label>
            </div>
        </div>
        <div class="mb-4">
            <x-label class="mb-3">Nombre</x-label>
            <x-input class="w-full" value="{{ old('name') }}" name="name"
                placeholder="escriba el nombre de la album"></x-input>
        </div>
        <div class="mb-4">
            <x-label class="mb-1">Body</x-label>
            <x-textarea name="body" rows="5" class="w-full">{{ old('body') }}</x-textarea>
        </div>
        <div>
            <x-button class="flex justify-end">
                Crear album
            </x-button>
        </div>
    </form>

    @push('js')
        <script>
            function previewImage(event, querySelector) {

                //Recuperamos el input que desencadeno la acción
                const input = event.target;

                //Recuperamos la etiqueta img donde cargaremos la imagen
                $imgPreview = document.querySelector(querySelector);

                // Verificamos si existe una imagen seleccionada
                if (!input.files.length) return

                //Recuperamos el archivo subido
                file = input.files[0];

                //Creamos la url
                objectURL = URL.createObjectURL(file);

                //Modificamos el atributo src de la etiqueta img
                $imgPreview.src = objectURL;

            }
        </script>
    @endpush
</x-admin-layout>
