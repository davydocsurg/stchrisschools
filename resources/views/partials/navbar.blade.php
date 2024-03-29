@role('Admin')
<nav class="main-header navbar navbar-expand navbar-dark navbar-dark">
    @endrole

    @role('Teacher')
    <nav class="main-header navbar navbar-expand navbar-info navbar-light">
        @endrole

        @role('Parent')
        <nav class="main-header navbar navbar-expand navbar-secondary navbar-light">
            @endrole

            @role('Student')
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                @endrole
                {{-- <nav
    class="main-header navbar navbar-expand {{ Auth::user()->role('Admin') ? 'navbar-dark  navbar-dark' : 'navbar-light navbar-white' }}"> --}}
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                                class="fas fa-bars"></i></a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="{{ route('welcome') }}" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="#" class="nav-link">Contact</a>
                    </li>
                </ul>

                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">
                    <!-- Navbar Search -->
                    <li class="nav-item">
                        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                            <i class="fas fa-search"></i>
                        </a>
                        <div class="navbar-search-block">
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
                    </li>


                    <!-- Notifications Dropdown Menu -->
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <div class="image">
                                <img src="{{ url('storage/users/profile/' . Auth::user()->profile_picture) }}"
                                    class="img-circle elevation-2"
                                    alt="{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}" width="25">
                            </div>
                            {{-- <span>{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</span> --}}
                            {{-- <span class="badge badge-warning navbar-badge">15</span> --}}
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <span class="dropdown-item dropdown-header">Manage Your Profile</span>
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('profile') }}" class="dropdown-item text-center">
                                <i class="fas fa-user-edit mr-2"></i> My Profile
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('logout') }}" class="dropdown-item text-danger text-center" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt mr-2"></i> Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                            <div class="dropdown-divider"></div>
                            {{-- <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a> --}}
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                            <i class="fas fa-expand-arrows-alt"></i>
                        </a>
                    </li>
                    {{-- <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                <i class="fas fa-th-large"></i>
            </a>
        </li> --}}
                </ul>
            </nav>
