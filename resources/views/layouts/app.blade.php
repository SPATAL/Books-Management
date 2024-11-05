<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="{{ session('theme', 'light') }}">
    <div id="app">
        <div class="admin-layout">
            <!-- Side Navigation -->
            <div id="mySidenav" class="sidenav side-nav">
                @if(Str::startsWith(request()->path(), 'admin') && auth()->check() && auth()->user()->role === 'admin')
                    @include('book.admin.side_nav')
                @endif
            </div>

            <!-- Main Navigation and Content -->
   
            <div class="main-content" id="main-content">
                <nav class="nav navbar-expand-md navbar-light" >

                        <div class=" mx-5 form-check form-switch toggle-btn">
                                <input class="form-check-input" type="checkbox" id="darkModeSwitch">
                                <label class="form-check-label" for="darkModeSwitch">Dark Mode</label>
                        </div>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class=" mx-4 mt-1 collapse navbar-collapse" id="navbarSupportedContent">
                                <!-- Left Side Of Navbar -->
                                <ul class="navbar-nav me-auto">

                                </ul>

                                <!-- Right Side Of Navbar -->
                                <ul class="navbar-nav ms-auto">
                                    <!-- Authentication Links -->
                                    @guest
                                        @if (Route::has('login'))
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                            </li>
                                        @endif

                                        @if (Route::has('register'))
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                            </li>
                                        @endif
                                    @else
                                        <li class="nav-item dropdown">
                                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                {{ Auth::user()->name }}
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                                <a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                                document.getElementById('logout-form').submit();">
                                                    {{ __('Logout') }}
                                                </a>

                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                    @csrf
                                                </form>
                                            </div>
                                        </li>
                                    @endguest
                                </ul>
                            </div>

                </nav>
                    

                <main class="container-fluid">
                        @yield('content')
                </main>
            </div>
        </div>
    </div>
    <script>
        
        // Dark Mode Logic
        const darkModeSwitch = document.getElementById('darkModeSwitch');
        const currentTheme = localStorage.getItem('theme');

        if (currentTheme === 'dark') {
            document.body.classList.add('dark-theme');
            darkModeSwitch.checked = true;
        }

        darkModeSwitch.addEventListener('change', function () {
            if (this.checked) {
                document.body.classList.add('dark-theme');
                localStorage.setItem('theme', 'dark');
            } else {
                document.body.classList.remove('dark-theme');
                localStorage.setItem('theme', 'light');
            }
        });
        // Sidebar Toggle Logic


        document.addEventListener('DOMContentLoaded', function () {
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');
        const toggleSidebar = document.getElementById('toggleSidebar');
        const toggleIcon = toggleSidebar.querySelector('i');
    
        const isCollapsed = localStorage.getItem('sidebar-collapsed');

        if (isCollapsed === 'true') {
            sidebar.classList.add('collapsed');
            mainContent.style.marginLeft = '60px';
            toggleIcon.classList.remove('bi-caret-left-fill');
            toggleIcon.classList.add('bi-caret-right-fill');
        } else {
            sidebar.classList.remove('collapsed');
            mainContent.style.marginLeft = '250px';
            toggleIcon.classList.remove('bi-caret-right-fill');
            toggleIcon.classList.add('bi-caret-left-fill');
        }
        

        toggleSidebar.addEventListener('click', function () {
        sidebar.classList.toggle('collapsed');
        if (sidebar.classList.contains('collapsed')) {
            mainContent.style.marginLeft = '60px';
            toggleIcon.classList.remove('bi-caret-left-fill');
            toggleIcon.classList.add('bi-caret-right-fill');
            localStorage.setItem('sidebar-collapsed', 'true');
        } else {
            mainContent.style.marginLeft = '250px';
            toggleIcon.classList.remove('bi-caret-right-fill');
            toggleIcon.classList.add('bi-caret-left-fill');
            localStorage.setItem('sidebar-collapsed', 'false');
        }
        });
    });
    </script>


    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
