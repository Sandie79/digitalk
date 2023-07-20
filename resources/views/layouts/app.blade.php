<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/app.css'])
</head>

<body style="background-image: url({{ asset('images/fond.jpg') }}); background-attachment:fixed; background-size:cover"
    class="mt-5 pt-5">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm bg-primary fixed-top" style="height:80px">
            <div class="container bg-primary">
                <div class="img-fluid"> <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="{{ asset('images\logo_digitalk.png') }}" alt="logo_digitalk" style="height:60px">
                    </a>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse p-3" id="navbarSupportedContent">

                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link text-white fs-4 me-5" href="{{ route('login') }}">Connexion</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link text-white fs-4 me-5" href="{{ route('register') }}">Inscription</a>
                                </li>
                            @endif
                        @else
                            <form action="{{ route('search') }}" method="GET">
                                @csrf
                                <div class="form-group">
                                    <div class="row me-auto">
                                        <div class=col-md-8>
                                            <input required type="text" class="form-control"
                                                placeholder="Rechercher sur Digitalk" name="search" id="search">
                                        </div>

                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-secondary">Rechercher</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    v-pre>
                                    {{ Auth::user()->pseudo }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end text-center" aria-labelledby="navbarDropdown">
                                    <a href="{{ route('users.edit', $user = Auth::user()) }}">Mon compte</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Déconnexion
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main>

            <div class="container-fluid text-center">
                @if (session()->has('message'))
                    <p class="alert alert-success">{{ session()->get('message') }}</p>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            @yield('content')
        </main>

        <footer class="bg-primary" style="height:80px; margin-top:290px">
            <div class="container">
                <div class="img-fluid text-center"> <a href="{{ url('/') }}">
                        <img src="{{ asset('images\logo_digitalk.png') }}" alt="logo_digitalk" style="height:80px">
                    </a>
                </div>
            </div>
        </footer>
       
    </div>
    
</body>

</html>
