<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >
<head>
    {{-- Required meta tags --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    {{-- CSRF Token --}}
    <meta name="_token" content="{{ csrf_token() }}">
    <meta name="Keywords" content=",Education,Online,Score,Tigray Web,Track result."/>
    <meta name="Description" content="Well optimized student management tool">

    {{--  Custom Icon --}}
    <link href="{{ asset('favicon.png') }}" rel="icon" type="icon"/>

    {{-- Fontfaces CSS --}}
    <link href="{{ asset('css/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css"/>

    {{-- Bootstrap and custom CSS compiled --}}
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sb.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sys.css') }}" rel="stylesheet">

    @if (Request::is('dashboard*'))
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/select2-bootstrap4.min.css') }}" rel="stylesheet">
    @endif

    <script src="{{ asset('js/jquery/jquery.min.js') }}"></script>
    @yield('links')

    {{-- Page Title --}}
    <title>{{ title() }}</title>
</head>

<body id="page-top" class="page-body-bg">

    {{-- Body Block --}}
    {{ $slot }}

    {{-- Scroll to top button --}}
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    {{-- Bootstrap core JavaScript --}}
    <script src="{{ asset('js/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>

    @if (Request::routeIs('dashboard'))
        <script src="{{ asset('js/chart-js/Chart.min.js') }}"></script>
        <script src="{{ asset('js/chart-statistics.js') }}"></script>
    @endif

    {{-- Custom scripts for all pages --}}
    <script src="{{ asset('js/ajax.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/sweetalert2.all.js') }}"></script>
    <script src="{{ asset('js/switch.js') }}"></script>


    {{-- Custom flash messages for all pages --}}
     <x-flash/>

</body>
</html>