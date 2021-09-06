<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('fontawesome-free/css/all.css') }}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ url('assets/vendor/animate/animate.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ url('assets/vendor/animsition/css/animsition.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ url('assets/dashboard/css/icons.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/fonts/linearicons-v1.0.0/icon-font.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/vendor/select2/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/vendor/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/vendor/slick/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/vendor/MagnificPopup/magnific-popup.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/vendor/perfect-scrollbar/perfect-scrollbar.css') }}">
    {{-- mdb --}}
    @yield('page_css')
</head>

<body>
    <div id="app" class="animsition">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand text-dark" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <script src="{{ url('assets/dashboard/js/jquery.min.js') }}"></script>
    <script src="{{ url('assets/vendor/animsition/js/animsition.min.js') }}"></script>
    <script src="{{ url('assets/vendor/isotope/isotope.pkgd.min.js') }}"></script>
    <script src="{{ url('assets/vendor/slick/slick.min.js') }}"></script>
    <script src="{{ url('assets/js/slick-custom.js') }}"></script>
    <script src="{{ url('assets/vendor/parallax100/parallax100.js') }}"></script>
    <script src="{{ url('assets/vendor/jquery.countdown-2.2.0/jquery.countdown.min.js') }}"></script>
    <script>
        $('.parallax100').parallax100();

    </script>
    <script src="{{ url('assets/vendor/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script>
        $('.js-pscroll').each(function() {
            $(this).css('position', 'relative');
            $(this).css('overflow', 'hidden');
            var ps = new PerfectScrollbar(this, {
                wheelSpeed: 1,
                scrollingThreshold: 1000,
                wheelPropagation: false,
            });

            $(window).on('resize', function() {
                ps.update();
            })
        });

    </script>
    <script src="{{ url('assets/js/main.js') }}"></script>

    {{-- <script src="{{ asset('js/jquery-2.2.4.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/js/main.js') }}"></script> --}}
    <script src="{{ asset('js/custom.js') }}"></script>
    @yield('page_js')
    @stack('scripts')
</body>

</html>
