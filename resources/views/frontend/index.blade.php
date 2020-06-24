@extends('layouts.app')
@section('links')
    <link rel="stylesheet" href="{{mix('css/owlCarousel.css', 'build')}}">
@endsection
@section('header')
    <!-- Poster -->
    <div class="owl-carousel owl-theme" id="owl">
        @foreach($slides as $slide)
            <a href="{{$slide->link}}">
                <div class="poster poster-index item" style="background-image: url('{{$slide->photo->getUrl()}}')">
                    <div class="container">
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="text-center">
                                    <h1><strong>{!! $slide->description !!}</strong></h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    </div>

@endsection
@section('content')
    <section class="categories-wrapper">
        <div class="container">
            <div class="row categories">
                @foreach($categories as $category)
                    <div class="col-xl col-lg-6 col-md-6 col-12">
                        <div class="item-category">
                            <!-- Card -->
                            <div class="card">
                                <a href="{{route('products.category', $category)}}">
                                    <div class="text-white text-center card-content"
                                         @isset($category->photo)
                                         style="background-image: url({{$category->photo->getUrl()}})"
                                        @endisset>
                                        <h6 class="card-title">
                                            <strong>
                                                {{$category->name}}
                                            </strong>
                                        </h6>
                                        <p>
                                            (
                                            {{__('frontend.productNumber')}}: {{$category->products_count}}
                                            )
                                        </p>
                                    </div>
                                </a>
                            </div>
                            <!-- Card -->
                        </div>
                    </div>
                @endforeach
                <div class="col-xl col-lg-12 col-md-12 col-12">
                    <div class="item-category">
                        <!-- Card -->
                        <div class="card">
                            <a href="{{route('products.category')}}">

                                <div class="text-white text-center card-content-all gradient-blue">
                                    <div class="dashed-bordered">
                                        <h6 class="card-title">
                                            <strong>
                                                {{sprintf('%s %s',__('frontend.all'), __('frontend.categories'))}}
                                            </strong>
                                        </h6>
                                        @if($catCount)
                                            <small class="text-capitalize mt-4">
                                                ({{$catCount}}) {{__('adminPanel.categories')}}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        </div>
                        <!-- Card -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="jobs-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 candidate">
                    <div class="card">
                        <div class="owl-carousel owl-theme" id="articles">
                            @foreach($articles as $article)
                                <div class="row">
                                    <!-- Card image -->
                                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-5 card-image-wrapper">
                                        <div class="card-image">
                                            <img src="{{isset($article->photo) ? $article->photo->getUrl() : ''}}"
                                                 class="img-fluid" alt="">
                                        </div>
                                    </div>
                                    <div class="col-xl-9 col-lg-9 col-md-8 col-sm-7">
                                        <div class="card-body">

                                            <h5 class="card-title">
                                                <strong>
                                                    <a href="{{route('articles.show', $article)}}">{{$article->name}}</a>
                                                </strong>
                                            </h5>
                                            <h6 class="card-subtitle">{{date("d-m-Y", $article->created_at->timestamp)}}</h6>
                                            <p>
                                                {!! $article->description !!}
                                            </p>
                                            <h6 class="mb-2 mr-2 d-flex justify-content-between">
                                                <a href="{{route('articles.index')}}"
                                                   class="font-small pink-text">
                                                    {{mb_strtolower(sprintf("%s %s", __("frontend.all"), __("frontend.articles")))}}
                                                    <i class="fa fa-arrow-circle-right ml-2"></i>
                                                </a>
                                                <a href="{{route('articles.show', $article)}}"
                                                   class="pink-text font-small">
                                                    {{mb_strtolower(__("frontend.readMore"))}}
                                                    <i class="fa fa-arrow-circle-right ml-2"></i>
                                                </a>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{mix('js/owlCarousel.js', 'build')}}"></script>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            let options = {
                loop: true,
                margin: 10,
                items: 1,
                responsiveClass: true,
                autoplay: true,
                autoplayTimeout: 6000,
                autoplayHoverPause: true,
                autoplaySpeed: 3000,
                dotsSpeed: 1500,
                dragEndSpeed: 2000,
            };
            $('#owl').owlCarousel(options);
            $('#articles').owlCarousel(options);
        });
    </script>
@endpush
