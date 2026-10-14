</html>
<!DOCTYPE html>
<html lang="id" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description"
        content="Sistem Magang PT PLN UP3 Jambi - Ajukan proposal dan surat magang anda secara online.">
    <title>@yield('title') | PT PLN UP3 Jambi</title>
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <style>
        #leaflet-map {
            height: 200px;
            width: 100%;
            border-radius: 1rem;
            z-index: 10;
        }
    </style>
</head>

<body class="bg-white text-gray-800 antialiased selection:bg-teal-500 selection:text-white">
    {{-- ========== NAVBAR ========== --}}
    <nav id="navbar"
        class="fixed top-0 left-0 right-0 z-50 bg-white/90 backdrop-blur-md border-b border-gray-100 transition-shadow duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                @if (request()->routeIs(['form-pengajuan', 'check-status', 'check-status']))
                    <button onclick="history.back()"
                        class="flex items-center gap-1.5 text-xs font-semibold text-teal-800 hover:text-teal-950 p-1 -ml-1 rounded-lg transition-colors">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                        </svg>
                        <span>Kembali</span>
                    </button>
                @else
                    {{-- Logo PLN --}}
                    <a href="{{ route('homepage') }}" class="flex items-center gap-3 group">
                        <div>
                            <img src="{{ asset('img/logo_pln.png') }}" alt="" class="w-22">
                        </div>
                    </a>
                @endif

                {{-- Action --}}
                @guest
                    <div class="flex flex-row gap-3 items-center">
                        <a href="{{ route('login') }}"
                            class="border border-emerald-600/60 bg-linear-to-r from-emerald-500/80 to-emerald-600/80 px-4 py-1.5 rounded-2xl font-semibold text-white shadow-md shadow-emerald-500/30 transition-all duration-300 hover:bg-emerald-700 active:scale-95 will-change-transform transform-gpu">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}"
                            class="bg-gray-300 px-4 py-1.5 rounded-2xl font-semibold shadow-lg border border-gray-500/20 hover:bg-gray-400 transition-all duration-300 active:scale-95">Buat
                            Akun</a>
                    </div>
                @endguest
                @auth
                    <div class="dropdown dropdown-end">
                        <div tabindex="0" role="button"
                            class="btn btn-ghost btn-circle avatar transition-transform duration-300 hover:scale-110">
                            <div class="w-10 rounded-full ring-2 ring-primary/50 ring-offset-base-100 ring-offset-2">
                                <img src="{{ Auth::user()->foto_profil ? Storage::url(Auth::user()->foto_profil) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=201E43&color=fff&size=128' }}"
                                    alt="" class="object-cover" />
                            </div>
                        </div>
                        <ul tabindex="0"
                            class="menu dropdown-content bg-base-100/85 backdrop-blur-md rounded-box z-1 mt-4 w-64 p-2 shadow-xl border border-base-200/50">
                            {{-- Header Dropdown --}}
                            <li class="px-2 pt-2 pb-1">
                                <div class="flex flex-col pointer-events-none">
                                    <p class="font-bold truncate">
                                        {{ Auth::user()->name }}
                                    </p>
                                    <p class="text-xs text-base-content/60 truncate">{{ Auth::user()->email }}</p>
                                </div>
                            </li>
                            <div class="divider my-1"></div>

                            {{-- Menu Items --}}
                            @if (Auth::user()->role == 'intern')
                                <li>
                                    <a href="{{ route('profile-intern') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Profile
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('dashboard-intern') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path
                                                d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                                        </svg>
                                        Dashboard
                                    </a>
                                </li>
                            @elseif (Auth::user()->role == 'mentor')
                                <li>
                                    <a href="{{ route('profile-mentor') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Profile
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('dashboard-mentor') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path
                                                d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                                        </svg>
                                        Dashboard
                                    </a>
                                </li>
                            @endif

                            <div class="divider my-1"></div>

                            {{-- Tombol Logout --}}
                            <li>
                                <form method="POST" action="{{ route('logout') }}" class="flex w-full p-0">
                                    @csrf
                                    <button type="submit"
                                        class="flex w-full p-2 px-3 gap-2 text-left text-error hover:bg-error/20">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        Keluar
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endauth
            </div>
        </div>
    </nav>
    <div class="pt-16">
        @yield('content')
    </div>

    {{-- ========== FOOTER ========== --}}
    @auth
        @if(auth()->user()->role == 'intern')
            @include('layouts.partials.footer')
        @endif
    @endauth
    @guest
        @include('layouts.partials.footer')
    @endguest

    @yield('modals')
    @stack('scripts')
    @vite('resources/js/app.js')
</body>

</html>
