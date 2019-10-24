<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>

    <title>{{env('APP_NAME')}}</title>

    <link rel="stylesheet" href="{{mix('css/app.css', 'build')}}">
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
@stack('scripts')
</html>
