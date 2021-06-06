{{-- <div class="fixed-top" style="margin-bottom: 10rem !important"> --}}
<!-- top bar -->
<div class="container-fluid bg-primary-y p-1 fixed text-white">
    <div class="">
        <div class="text- ml-5 mr-5">
            <span class="none col-lg-">
                <i class="fas fa-phone-alt"></i> +234 802 412 3370, +234 706 556
                6268
            </span>
            <!-- <br class="d-none d-lg-inline-block d-sm-block" /> -->
            <span class="ml-3">
                <i class="fas fa-envelope"></i>
                <a href="mailto:stchris@gmail.com" class="text-white font-weight-bold">
                    stchris@gmail.com</a>
            </span>
        </div>
    </div>
</div>
{{-- </div> --}}

<nav class="navbar navbar-expand-lg navbar-white navbar-light" id="navbar">
    <a class="navbar-brand" href="{{ route('welcome') }}"><i class="fas fa-school"></i> {{ config('app.name') }}</a>
    <button class="navbar-toggler ml-auto float-right" type="button" data-toggle="collapse"
        data-target="#navbarContent1" aria-controls="navbarContent1" aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarContent1">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a href="{{ route('welcome') }}"
                    class="nav-link {{ request()->routeIs('welcome') ? 'active' : '' }}">Home</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">About Us</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">Our Services</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">Contact</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownComponent" href="#" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                <div class="dropdown-menu dropdown-menu-right py-0" aria-labelledby="navbarDropdownComponent">
                    <div class="bg-white rounded-soft py-2">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
            </li>

            @auth
                <li class="nav-item ">
                    <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
                </li>
            @endauth

            @guest
                <li class="nav-item d-lg-none">
                    <a href="{{ route('login') }}" class="nav-link">Login</a>
                </li>
            @endguest
        </ul>
    </div>
    <!-- Left navbar links -->
    {{-- <ul class="navbar-nav">
        <li class="nav-item d-lg-none d-sm-inline ">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('welcome') }}"
                class="nav-link {{ request()->routeIs('welcome') ? 'active' : '' }}">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">About Us</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Our Services</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Contact</a>
        </li>
    </ul> --}}


    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

        @auth
            <li class="nav-item d-none d-lg-inline-block">
                <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
            </li>
        @endauth

        @guest
            <li class="nav-item d-none d-lg-inline-block">
                <a href="{{ route('login') }}" class="nav-link">Login</a>
            </li>
        @endguest
        {{-- <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Contact</a>
        </li>
        <!-- Navbar Search -->
        <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" data-target="#navbar-search2" href="#" role="button">
                <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block" id="navbar-search2">
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li> --}}

        {{-- <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li> --}}

    </ul>
</nav>
