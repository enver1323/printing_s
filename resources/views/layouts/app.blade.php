<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>

    <link rel="stylesheet" href="{{mix('css/app.css', 'build')}}">
    <link rel="stylesheet" href="{{asset('js/bvi/css/bvi.min.css')}}" type="text/css">
    @yield('links')

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield("seo.title") | {{ config('app.name') }}</title>

    <meta property="og:url" content="{{url()->current()}}"/>
    <meta property="og:title" content="@yield('seo.title') | {{config('app.name')}}"/>
    <meta property="og:locale" content="{{ str_replace('_', '-', app()->getLocale()) }}"/>
    <meta property="og:locale:alternate" content="{{app()->getLocale()}}"/>
    <meta name="description" content="@yield('seo.description', __('frontend.siteDescription'))"/>
    <meta property="og:description" content="@yield('seo.description', __('frontend.siteDescription'))"/>
    <meta property="og:site_name" content="{{config('app.name')}}"/>

    <meta name='description' itemprop='description' content='@yield('seo.description')'/>
    <meta name='keywords' content='@yield('seo.description', __('frontend.siteDescription'))'/>

    <meta property="og:image" content="@yield('seo.image', asset('images/logo.png'))"/>

    <meta name="twitter:card" content="@yield('seo.description', __('frontend.siteDescription'))"/>
    <meta name="twitter:title" content="@yield("seo.title") | {{ config('app.name') }}"/>
    @yield('head')

</head>
<body>
<header>
    @include('frontend._nav')
    @yield('header')
</header>

<main>
    @yield('content')
</main>
@stack('modals')
@include('frontend.footer')
</body>

<script src="{{mix('js/app.js', 'build')}}"></script>
<script src="{{asset('js/bvi/js/js.cookie.min.js')}}"></script>
<script src="{{asset('js/bvi/js/bvi.min.js')}}"></script>
<script src="{{asset('js/bvi/js/bvi-init.js')}}"></script>
@stack('scripts')
</html>
