@extends('layouts.app')
@section('seo.description', $article->description)
@section('seo.title', sprintf("%s: %s", __('frontend.article'),$article->name))
@section('seo.image', isset($article) ? $article->photo->getUrl() : null)
@section('header')
    <!-- Poster -->
    <div class="poster poster-job-details">
        <div class="container">
            <div class="row page-title">
                <h1>
                    {{$article->name}}
                </h1>
            </div>
        </div>
    </div>
    <!-- /Poster -->
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <!--Main listing-->
            <div class="col-12 px-lg-4">
                <div class="main-info">
                    <div id="aboutme">
                        <div class="row">
                            <div class="col-12">
                                <div class="section-title section-title-blue">
                                    <div>
                                        <h2>
                                            {{__('frontend.article')}}
                                        </h2>
                                        <hr/>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <p class="text-justify">
                            {!! $article->description !!}
                        </p>
                    </div>
                </div>
                <hr class="my-5"/>
            </div>
        </div>
    </div>
@endsection
