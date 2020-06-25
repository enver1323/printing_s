@extends('layouts.app')
@section('seo.title', __('frontend.offers'))
@section('header')
    <!-- Poster -->
    <div class="poster poster-jobs-listing">
        <div class="container">
            <div class="row page-title">
                <h1>
                    {{__('frontend.offers')}}
                </h1>
            </div>
        </div>
    </div>
    <!-- /Poster -->
@endsection
@section('content')
    <div class="container mt-4">
        @foreach($offers as $offer)
            @include('frontend.offers.offerItem', ['offer' => $offer])
        @endforeach
        {{$offers->links()}}
    </div>
@endsection
