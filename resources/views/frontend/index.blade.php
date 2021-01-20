@extends('layouts.app')
@section('links')
    <link rel="stylesheet" href="{{mix('css/owlCarousel.css', 'build')}}">
@endsection
@section('header')
    <!-- Poster -->
    <div class="owl-carousel owl-theme relative" id="owl">
        @foreach($slides as $slide)
            @if($slide->video)
                <div class="item-video poster-index" style="overflow: hidden;">
                    <video autoplay loop id="video-background" muted
                           poster="{{isset($slide->photo) ? $slide->photo->getUrl() : ''}}" width="100%">
                        <source src="{{$slide->video}}" type="video/mp4">
                    </video>
                    <div class="d-flex slider-btn-container">
                        <a href="{{$slide->video}}" class="btn btn-danger video-slide" data-rebox-template="video">
                            {{__('adminPanel.watchSlide')}}
                        </a>
                        @if($slide->link)
                            <a class="btn btn-primary" href="{{$slide->link}}">{{__('adminPanel.followSlide')}}</a>
                        @endif
                    </div>
                </div>
            @else
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
                    <div class="d-flex slider-btn-container">
                        @if($slide->link)
                            <a class="btn btn-primary" href="{{$slide->link}}">{{__('adminPanel.followSlide')}}</a>
                        @endif
                    </div>
                </div>
            @endif
        @endforeach
    </div>

@endsection
@section('content')
    <section class="jobs-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 candidate">
                    <div class="card">
                        <div class="owl-carousel owl-theme" id="articles">
                            @foreach($articles as $article)
                                @include('frontend.articles.articleItem', ['article' => $article])
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


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
@endsection
@push('scripts')
    <script type="text/javascript" src="{{mix('js/owlCarousel.js', 'build')}}"></script>
    <script type="text/javascript" src="{{asset('js/chocolat/js/chocolat.js')}}"></script>
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
                video: true
            };
            $('#owl').owlCarousel(options);
            $('#articles').owlCarousel(options);

            $('.video-slide').rebox({
                templates:{
                    video: function($item, settings, callback){
                        var url = $item.attr('href').replace(/\.\w+$/,'');
                        return $('<video class="'+ settings.theme +'-content" controls preload="metadata">'+
                            '<source src="'+url+'.webm" type="video/webm" />'+
                            '<source src="'+url+'.mp4" type="video/mp4" />'+
                            'Your browser does not support the HTML5 video tag'+
                            '</video>').on('loadeddata', callback);
                    }
                }
            });
        });
    </script>
@endpush
