@extends('layouts.app')
@section('header')
    <!-- Poster -->
    <div class="poster poster-sm poster-candidate-listing">
        <div class="container">
            <div class="row page-title">
                <h1>
                    {{__('frontend.articles')}}
                </h1>
            </div>
        </div>
    </div>
    <!-- /Poster -->
@endsection
@section('content')
    <div class="container mt-4">
        @foreach($articles as $article)
            @include('frontend.articles.articleItem', ['article' => $article])
        @endforeach
        {{$articles->links()}}
    </div>
@endsection
