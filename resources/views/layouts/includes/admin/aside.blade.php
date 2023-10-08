@php
    $rutaDashboard = route('dashboard');
    if (substr($rutaDashboard, 0, strlen('http://localhost/')) == 'http://localhost/') {
        $rutaDashboard = str_replace('http://localhost/', 'http://127.0.0.1:8000/', $rutaDashboard);
    }
    $rutaalbums = route('albums.index');
    if (substr($rutaalbums, 0, strlen('http://localhost/')) == 'http://localhost/') {
        $rutaalbums = str_replace('http://localhost/', 'http://127.0.0.1:8000/', $rutaalbums);
    }
    $rutaartists = route('artists.index');
    if (substr($rutaartists, 0, strlen('http://localhost/')) == 'http://localhost/') {
        $rutaartists = str_replace('http://localhost/', 'http://127.0.0.1:8000/', $rutaartists);
    }
    $rutasongs = route('songs.index');
    if (substr($rutasongs, 0, strlen('http://localhost/')) == 'http://localhost/') {
        $rutasongs = str_replace('http://localhost/', 'http://127.0.0.1:8000/', $rutasongs);
    }
    $links = [
        [
            'name' => 'Dashboard',
            'url' => $rutaDashboard,
            'active' => request()->routeIs('dashboard'),
            'icon' => 'fa-solid fa-gauge-high',
        ],
        [
            'name' => 'Albunes',
            'url' => $rutaalbums,
            'active' => request()->routeIs('albums.*'),
            'icon' => 'fa-solid fa-gauge-high',
        ],
        [
            'name' => 'Artistas',
            'url' => $rutaartists,
            'active' => request()->routeIs('artists.*'),
            'icon' => 'fa-solid fa-inbox',
        ],
        [
            'name' => 'Canciones',
            'url' => $rutasongs,
            'active' => request()->routeIs('songs.*'),
            'icon' => 'fa-solid fa-blog',
        ],
    ];
@endphp
<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
    :class="{
        '-translate-x-full': !open,
        'transform-none': open
    }" aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-medium">
            @foreach ($links as $link)
                <li>
                    <a href="{{ $link['url'] }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ $link['active'] ? 'bg-gray-100' : '' }}">
                        <i class="{{ $link['icon'] }} text-gray-500"></i>
                        <span class="ml-3">{{ $link['name'] }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</aside>
