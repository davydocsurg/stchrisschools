<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        @yield('page_title') - {{ config('app.name') }}
    </title>

    <!-- Fonts -->
    {{-- <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet"> --}}

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/adminlte/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/welcome-page.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/dashboard/plugins/fontawesome-free/css/all.min.css') }}">

    <!-- Animations -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

</head>

<body>

    @include('partials.landing.navbar')

    @yield('content')

    <footer class="bg-primary-y py-5 mb-0">
        <div class="text-center text-white font-weight-bold">
            <p>
                ©️ 2021. All Rights Reserved. | Developed By <b class="font-weight-bold"
                    style="font-weight: bolder !important">Information Capital</b>

            </p>
        </div>
    </footer>

    {{-- !important --}}
    <script src="{{ asset('js/welcome-page.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ url('assets/dashboard/js/jquery.min.js') }}"></script>

    {{-- animations --}}
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
</body>

</html>
