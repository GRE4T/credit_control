<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="{{ asset('js/app.js') }}"></script>
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">
    <link id="gull-theme" rel="stylesheet" href="{{ asset('assets/styles/css/custom.css') }}">
    @yield('before-css')
    {{-- theme css --}}

    @if (Session::get('layout') == 'vertical')
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome-free-5.10.1-web/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/metisMenu.min.css') }}">

    @endif
    <link id="gull-theme" rel="stylesheet" href="{{ asset('assets\fonts\iconsmind\iconsmind.css') }}">
    <link id="gull-theme" rel="stylesheet" href="{{ asset('assets/styles/css/themes/lite-purple.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/perfect-scrollbar.css') }}">
    {{-- page specific css --}}
    @yield('page-css')
</head>

<body class="text-left">

    <!-- Pre Loader Strat  -->
    <div class='loadscreen' id="preloader">

        <div class="loader spinner-bubble spinner-bubble-primary">


        </div>
    </div>
    <!-- Pre Loader end  -->

    <!-- ============Deafult  Large SIdebar Layout start ============= -->
    @include('layouts.large-vertical-sidebar.master')
    <!-- ============ Large Sidebar Layout End ============= -->


    @yield('page-js')

    {{-- common js --}}
    <script src="{{ asset('assets/js/common-bundle-script.js') }}"></script>
    {{-- page specific javascript --}}

    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="{{ asset('assets/js/sidebar.large.script.js') }}"></script>
    <script src="{{ asset('assets/js/customizer.script.js') }}"></script>
    <script src="{{asset('assets/js/vendor/echarts.min.js')}}"></script>
    <script src="{{asset('assets/js/es5/echart.options.min.js')}}"></script>

    @yield('bottom-js')
</body>

</html>
