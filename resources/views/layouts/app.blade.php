<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ env('APP_NAME') }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <link href="{{ mix('css/app.css','build') }}" rel="stylesheet">
</head>
<body id="app">
<header>
    @include('frontend._nav')
</header>
<main class="app-content">
    {{--        @section('breadcrumbs',Breadcrumbs::render())--}}
    {{--        @yield('breadcrumbs')--}}
    @include('layouts.partials.flash')
    @yield('content')
</main>
@include('frontend.footer')
<script src="{{ mix('js/app.js','build') }}" defer></script>
</body>
</html>
