<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>

    <title>{{config('app.name')}}</title>

    <link rel="stylesheet" href="{{mix('css/app.css', 'build')}}">
    <link rel="stylesheet" href="{{asset('js/bvi/css/bvi.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('js/bvi/css/bvi-font.min.css')}}" type="text/css">
    @yield('links')
</head>
<body>
<header>
    @include('frontend._nav')
    @yield('header')
</header>

<main>
    @yield('content')
</main>

@include('frontend.footer')
</body>
<script src="{{mix('js/app.js', 'build')}}"></script>
<script src="{{asset('js/bvi/js/js.cookie.min.js')}}"></script>
<script src="{{asset('js/bvi/js/responsivevoice.min.js')}}"></script>
<script src="{{asset('js/bvi/js/bvi.min.js')}}"></script>
<script src="{{asset('js/bvi/js/bvi-init.js')}}"></script>
@stack('scripts')
</html>
