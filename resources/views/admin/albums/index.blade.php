<x-admin-layout>
    <div class="flex justify-end mb-4">
        @php
            $rutacreate = route('albums.create');
            if (substr($rutacreate, 0, strlen('http://localhost/')) == 'http://localhost/') {
                $rutacreate = str_replace('http://localhost/', 'http://127.0.0.1:8000/', $rutacreate);
            }
        @endphp
        <a class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700"
            href="{{ $rutacreate }}">Nuevo album</a>
    </div>
    <div class="mb-4">
        @php
            $rutabuscar = route('albums.busquedaAlbun');
            if (substr($rutabuscar, 0, strlen('http://localhost/')) == 'http://localhost/') {
                $rutabuscar = str_replace('http://localhost/', 'http://127.0.0.1:8000/', $rutabuscar);
            }
        @endphp

        <form method="POST" action="{{ $rutabuscar }}">
            @csrf
            <x-label class="mb-2">Albunes</x-label>
            <select class="tags-multiple" name="albunes" style="width: 80%">
                <option value="">Selecina un albun</option>
                @foreach ($select_albun as $all)
                    <option value="{{ $all['id'] }}">{{ $all['name'] }}</option>
                @endforeach
            </select>
            <button type="submit"
                class="text-white right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Buscar</button>
        </form>
    </div>
    <ul class="space-y-8">
        <strong>Lista de albunes</strong>
        @if (count($albunes) == 0)
            <div class="flex items-center p-4 mb-4 text-sm text-yellow-800 border border-yellow-300 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300 dark:border-yellow-800"
                role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-medium">No se encontraron resultados</span> intente nuevamente.
                </div>
            </div>
        @else
            <div class="flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800"
                role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-medium">se encontraton </span>{{ count($albunes) }} resultados.
                </div>
            </div>
            @foreach ($albunes as $albun)
                <li class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <img class="aspect-[16/9] object-cover object-center w-full" src="{{ $albun['image'] }}"
                            alt="">

                    </div>
                    <div>
                        <h1 class="text-xl font-semibold">{{ $albun['name'] }}</h1>

                        <hr class="mt-1 mb-2">
                        <p class="text-gray-700 mt-2">{{ Str::limit($albun['body'], 100) }}</p>
                        <div class="flex  mt-4">
                            @php
                                $rutashow = route('albums.show', $albun['id']);
                                if (substr($rutashow, 0, strlen('http://localhost/')) == 'http://localhost/') {
                                    $rutashow = str_replace('http://localhost/', 'http://127.0.0.1:8000/', $rutashow);
                                }
                            @endphp
                            <a href="{{ $rutashow }}"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                Detalle</a>
                            @php
                                $rutaedit = route('albums.edit', $albun['id']);
                                if (substr($rutaedit, 0, strlen('http://localhost/')) == 'http://localhost/') {
                                    $rutaedit = str_replace('http://localhost/', 'http://127.0.0.1:8000/', $rutaedit);
                                }
                            @endphp
                            <a href="{{ $rutaedit }}"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                Editar</a>
                        </div>
                    </div>
                </li>
            @endforeach
        @endif
    </ul>

    @push('js')
        <script>
            $(document).ready(function() {
                $('.tags-multiple').select2();
            });
        </script>
    @endpush
</x-admin-layout>
