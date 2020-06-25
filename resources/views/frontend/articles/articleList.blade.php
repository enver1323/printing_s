@extends('layouts.app')
@section('seo.title', __('frontend.articles'))
@section('header')
    <!-- Poster -->
    <div class="poster poster-jobs-listing">
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
            <div class="row">
                <div class="col-lg-12 col-md-12 candidate">
                    <div class="card">
                        @include('frontend.articles.articleItem', ['article' => $article])
                    </div>
                </div>
            </div>
        @endforeach
        {{$articles->links()}}
    </div>
@endsection
