<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Atlas Travel')</title>

    <link rel="icon" type="image/png" href="{{ asset('images/airplane.svg') }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    {{-- Bootstrap + Tema --}}
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>

    <div id="app">

        <nav class="navbar navbar-expand-lg navbar-dark shadow-sm">

            <div class="container">

              @if (!auth()->check() || auth()->user()->role->name !== 'admin')

                <a
                    class="navbar-brand fw-bold"
                    href="{{ url('/') }}">
                    Atlas Travel
                </a>

            @else

                <a
                    class="navbar-brand fw-bold"
                    href="{{ route('chat.support.index') }}">
                    Atlas Travel
                </a>

            @endif
                @auth
                @if (auth()->user()->role->name !== 'admin')
                <a class="navbar-brand fs-6" href="{{ route('trip.index', Auth::user()->user_id) }}">
                    Mis Viajes
                </a>
                 <a class="navbar-brand fs-6" href="{{ route('nearby.index')}}">
                    Cerca de mi
                </a>
                <a class="navbar-brand fs-6" href="{{ route('forum.index', Auth::user()->user_id)}}">
                    Foros
                </a>
                <a class="navbar-brand fs-6" href="{{ route('wishlist.index', Auth::user()->user_id) }}">
                    Wishlist
                </a>
                @endif
                
                 @endauth

                <button class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent">

                    <span class="navbar-toggler-icon"></span>

                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <ul class="navbar-nav me-auto">
                    </ul>

                    <ul class="navbar-nav ms-auto">

                        @guest

                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link fw-semibold"
                                        href="{{ route('login') }}">
                                        Iniciar Sesión
                                    </a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link fw-semibold"
                                        href="{{ route('register') }}">
                                        Registrarse
                                    </a>
                                </li>
                            @endif

                        @else

                            <li class="nav-item dropdown">

                                <a id="navbarDropdown"
                                    class="nav-link dropdown-toggle fw-semibold"
                                    href="#"
                                    role="button"
                                    data-bs-toggle="dropdown">

                                    {{ Auth::user()->name }}

                                </a>

                                <div class="dropdown-menu dropdown-menu-end">

                                  @if (
                                    auth()->check()
                                    &&
                                    auth()->user()->role->name !== 'admin'
                                )

                                    <a class="dropdown-item"
                                    href="{{ route('user.show', Auth::user()->user_id) }}">
                                        Mi Perfil
                                    </a>

                                    <hr class="dropdown-divider">

                                    <a class="dropdown-item"
                                    href="{{ route('chat.index', Auth::user()->user_id) }}">
                                        Soporte técnico
                                    </a>

                                    <hr class="dropdown-divider">

                                    <a class="dropdown-item"
                                    href="{{ route('offline.index') }}">
                                        Modo offline
                                    </a>

                                    <hr class="dropdown-divider">

                                @endif

                                    <a class="dropdown-item"
                                        href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">

                                        Cerrar Sesión

                                    </a>

                                    <form id="logout-form"
                                        action="{{ route('logout') }}"
                                        method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>

                                </div>

                            </li>

                        @endguest

                    </ul>

                </div>

            </div>

        </nav>

        <main class="py-5">
            @yield('content')
        </main>

    </div>

</body>

</html>