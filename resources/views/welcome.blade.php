<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/adminlte/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/welcome-page.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/dashboard/plugins/fontawesome-free/css/all.min.css') }}">
</head>

<body>
    <div class="">
        @include('partials.landing.navbar')

    </div>

    <div class="">
        @include('partials.landing.banner')
    </div>

    <div class="">
        @include('partials.landing.about')
    </div>

    @include('partials.landing.teachers')
    @include('partials.landing.services')
    @include('partials.landing.contact')

    <footer class="bg-warning py-5">
        <div class="text-center font-weight-bold">
            <b>
                ©️ 2021. All Rights Reserved. | Design By

            </b>
        </div>
    </footer>

    {{-- !important --}}
    <script src="{{ asset('js/welcome-page.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ url('assets/dashboard/js/jquery.min.js') }}"></script>
</body>

</html>
