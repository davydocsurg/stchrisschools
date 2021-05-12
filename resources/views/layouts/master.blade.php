<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>

    {{-- css --}}
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/adminlte/adminlte.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('assets/dashboard/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('assets/dashboard/plugins/summernote/summernote-bs4.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/dashboard/plugins/fontawesome-free/css/all.min.css') }}">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="Welcome" height="60" width="60">
        </div>

        {{-- navbar --}}
        @include('partials.navbar')
        {{-- end navbar --}}

        {{-- sidebar --}}
        @include('partials.sidebar')
        {{-- end sidebar --}}

        {{-- views --}}
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->

            @yield('page_header')

        </div>
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
    {{--  --}}

    <script src="{{ asset('assets/dashboard/js/adminlte/js/adminlte.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/adminlte/js/pages/dashboard.js') }}"></script>
    {{-- <script src="{{ asset('assets/dashboard/plugins/jquery/jquery.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/dashboard/plugins/jquery-ui/jquery-ui.min.js') }}"></script> --}}
    <script>
        $.widget.bridge('uibutton', $.ui.button)

    </script>
    <script src="{{ asset('assets/dashboard/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ url('assets/js/main.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    @stack('scripts')

</body>

</html>
