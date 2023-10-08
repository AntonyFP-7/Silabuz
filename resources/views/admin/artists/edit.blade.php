<x-admin-layout>
    @php
        $ruta = route('artists.update', $artist['id']);
        if (substr($ruta, 0, strlen('http://localhost/')) == 'http://localhost/') {
            $ruta = str_replace('http://localhost/', 'http://127.0.0.1:8000/', $ruta);
        }
    @endphp
    <form action="{{ $ruta }}" method="post" enctype="multipart/form-data"
        class="bg-white rounded-lg p-6 shadow-lg">
        @csrf
        @method('PUT')
        <x-validation-errors class="mb-4"></x-validation-errors>
        <div class="mb-6 relative">
            <figure>
                <img id="imgPreview" class="aspect-[16/9] object-cover object-center w-full" src="{{ $artist['image'] }}"
                    alt="">
            </figure>
            <div class="absolute top-8 right-8">
                <label class="bg-white px-4 py-2 rounded-lg cursor-pointer">
                    <i class="fa-solid fa-camera mr-2"></i>
                    Actualizar imagen
                    <input type="file" onchange="previewImage(event, '#imgPreview')" class="hidden" name="image"
                        accept="image/*">
                </label>
            </div>
        </div>
        <div class="mb-4">
            <x-label class="mb-3">Nombre</x-label>
            <x-input class="w-full" value="{{ old('name', $artist['name']) }}" name="name"
                placeholder="escriba el nombre de la artista"></x-input>
        </div>
        <div class="mb-4">
            <x-label class="mb-1">Genero</x-label>
            <select class="tags-multiple" name="gender_id" style="width: 100%">
                <option value="">Selecina un genero</option>
                @foreach ($genders as $gender)
                    <option value="{{ $gender['id'] }}" @selected(old('gender_id', $artist['gender_id']) == $gender['id'])>{{ $gender['name'] }}</option>
                @endforeach
            </select>

        </div>
        <div>
            <x-danger-button class="mr-2" onclick="deleteCategory()">Eliminar</x-danger-button>
            <x-button class="flex
                        justify-end">
                Actualizar artista
            </x-button>
        </div>
    </form>
    @php
        $rutadelete = route('artists.destroy', $artist['id']);
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
