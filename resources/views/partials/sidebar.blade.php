<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('welcome') }}" class="brand-link">
        {{-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8"> --}}
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset(Auth::user()->profile_picture) }}" class="img-circle elevation-2"
                    alt="{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
                <li class="nav-item menu-closed">
                    <a href="#" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                    </ul>
                </li>

                @role('Admin')
                <li class="nav-item">
                    <a href="{{ route('teachers.index') }}"
                        class="nav-link {{ request()->routeIs('teachers*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chalkboard-teacher"></i>
                        <p>
                            Teachers
                        </p>
                    </a>
                </li>

                {{-- parents --}}
                <li class="nav-item">
                    <a href="{{ route('parents.index') }}"
                        class="nav-link {{ request()->routeIs('parents*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-tie"></i>
                        <p>
                            Parents
                        </p>
                    </a>
                </li>

                {{-- students --}}
                <li class="nav-item">
                    <a href="{{ route('students.index') }}"
                        class="nav-link {{ request()->routeIs('students*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-graduate"></i>
                        <p>
                            Students
                        </p>
                    </a>
                </li>

                {{-- classes --}}
                <li class="nav-item">
                    <a href="{{ route('classes.index') }}"
                        class="nav-link {{ request()->routeIs('classes*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-th-list"></i>
                        <p>
                            Classes
                        </p>
                    </a>
                </li>

                {{-- subjects --}}
                <li class="nav-item">
                    <a href="{{ route('subjects.index') }}"
                        class="nav-link {{ request()->routeIs('subjects*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-align-center"></i>
                        <p>
                            Subjects
                        </p>
                    </a>
                </li>
                @endrole


                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-search"></i>
                        <p>
                            Search
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="pages/search/simple.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Simple Search</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/search/enhanced.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Enhanced</p>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
