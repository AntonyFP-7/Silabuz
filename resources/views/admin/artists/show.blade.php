<x-admin-layout>
    <strong class="flex justify-center">Artista: {{ $artist['name'] }}</strong>
    <div class="mb-2">
        <img class="aspect-[10/3] object-cover object-center w-full" src="{{ $artist['image'] }}" alt="">
    </div>

    <div class="mt-4">

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <strong class="my-3"> Lista de canciones</strong>
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Artista
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Genero
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Album
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Cancion
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($artist->songs as $item)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                            <th scope="row"
                                class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                <img class="w-10 h-10 rounded-full" src="{{ $artist->image }}" alt="Jese image">
                                <div class="pl-3">
                                    <div class="text-base font-semibold">{{ $artist->name }}</div>
                                </div>
                            </th>
                            <th class="px-6 py-4">
                                @empty($artist->gender->name)
                                    No tiene genero
                                @else
                                    {{ $artist->gender->name }}
                                @endempty
                            </th>
                            <th class="px-6 py-4">
                                {{ $item->album->name }}
                            </th>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="h-2.5 w-2.5 rounded-full bg-green-500 mr-2"></div> {{ $item->name }}
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</x-admin-layout>
