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
    {{-- carousel --}}
    <link rel="stylesheet" href="{{ asset('assets/carousel/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/carousel/css/owl.theme.default.min.css') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/dashboard/plugins/fontawesome-free/css/all.min.css') }}">

    <!-- Animations -->
    {{-- <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" /> --}}
    <link rel="stylesheet" href="{{ asset('assets/animes/anime.css') }}">

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
    {{-- carousel --}}
    <script src="{{ asset('assets/carousel/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/carousel/js/main.js') }}"></script>
    {{-- animations --}}
    {{-- <script src="https://unpkg.com/aos@next/dist/aos.js"></script> --}}
    <script src="{{ asset('assets/animes/anime.js') }}"></script>
    <script>
        AOS.init();

        // You can also pass an optional settings object
        // below listed default settings
        AOS.init({
            // Global settings:
            disable: false, // accepts following values: 'phone', 'tablet', 'mobile', boolean, expression or function
            startEvent: 'DOMContentLoaded', // name of the event dispatched on the document, that AOS should initialize on
            initClassName: 'aos-init', // class applied after initialization
            animatedClassName: 'aos-animate', // class applied on animation
            useClassNames: false, // if true, will add content of `data-aos` as classes on scroll
            disableMutationObserver: false, // disables automatic mutations' detections (advanced)
            debounceDelay: 50, // the delay on debounce used while resizing window (advanced)
            throttleDelay: 99, // the delay on throttle used while scrolling the page (advanced)


            // Settings that can be overridden on per-element basis, by `data-aos-*` attributes:
            offset: 120, // offset (in px) from the original trigger point
            delay: 0, // values from 0 to 3000, with step 50ms
            duration: 800, // values from 0 to 3000, with step 50ms
            easing: 'ease', // default easing for AOS animations
            once: false, // whether animation should happen only once - while scrolling down
            mirror: false, // whether elements should animate out while scrolling past them
            anchorPlacement: 'top-bottom', // defines which position of the element regarding to window should trigger the animation

        });

    </script>
</body>

</html>
