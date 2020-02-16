@extends('layouts.app')
@section('links')
    <link rel="stylesheet" href="{{mix('css/owlCarousel.css', 'build')}}">
@endsection
@section('header')
    <!-- Poster -->
    <div class="owl-carousel owl-theme" id="owl">
        @foreach($slides as $slide)
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
                                    <div class="text-white text-center card-content">
                                        <h6 class="card-title">
                                            <strong>
                                                {{$category->name}}
                                            </strong>
                                        </h6>
                                        <p>
                                            (
                                            {{sprintf('%s %s', $category->products_count, Str::plural(__('frontend.product')))}}
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
                <div class="owl-carousel owl-theme" id="articles">
                    @foreach($articles as $article)
                        <div class="col-lg-12 col-md-12 job item">
                            <div class="card">
                                <div class="row">
                                    <div class="col-4 card-image-wrapper">
                                        <div class="card-image text-center">
                                            <img src="{{$article->photo->getUrl()}}" class="img-fluid" alt="">
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <strong>
                                                    <a href="{{route('articles.show', $article)}}">
                                                        {{$article->name}}
                                                    </a>
                                                </strong>
                                            </h5>
                                            <p>
                                                {!! $article->description !!}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </section>


    {{--    <section class="employers-wrapper">--}}
    {{--        <div class="container-fluid d-flex justify-content-center">--}}
    {{--            <div class="container">--}}
    {{--                <div class="row">--}}
    {{--                    <div class="col-12">--}}
    {{--                        <div class="section-title section-title-white">--}}
    {{--                            <div>--}}
    {{--                                <h2>--}}
    {{--                                    {{__('frontend.topProducts')}}--}}
    {{--                                </h2>--}}
    {{--                                <hr>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}

    {{--                <div class="row">--}}
    {{--                    @foreach($products as $product)--}}
    {{--                        <div class="col-12 col-md-4 d-flex align-items-stretch">--}}
    {{--                            @include('frontend.products.productListCard', $product)--}}
    {{--                        </div>--}}
    {{--                    @endforeach--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </section>--}}


    {{--    <section class="instructions-wrapper">--}}
    {{--        <div class="container">--}}
    {{--            <div class="row">--}}
    {{--                <div class="col-12">--}}
    {{--                    <div class="section-title section-title-blue">--}}
    {{--                        <div>--}}
    {{--                            <h2>--}}
    {{--                                {{__('frontend.brands')}}--}}
    {{--                            </h2>--}}
    {{--                            <hr>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}

    {{--            <div class="row">--}}
    {{--                @foreach($brands as $brand)--}}
    {{--                    <div class="col-xl-3 col-lg-3 col-md-12">--}}
    {{--                        <div class="instruction">--}}

    {{--                            <div class="item-category">--}}
    {{--                                <!-- Card -->--}}
    {{--                                <div class="card">--}}
    {{--                                    <div class="text-white text-center card-content">--}}
    {{--                                        <h6 class="card-title">--}}
    {{--                                            <strong>--}}
    {{--                                                <a href="{{route('products.brand', $brand)}}">{{$brand->name}}</a>--}}
    {{--                                            </strong>--}}
    {{--                                        </h6>--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                                <!-- Card -->--}}
    {{--                            </div>--}}
    {{--                            <hr>--}}
    {{--                            <p class="instruction-desc">--}}
    {{--                                {{$brand->description}}--}}
    {{--                            </p>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                @endforeach--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </section>--}}

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
                autoplayTimeout: 3000
            };
            $('#owl').owlCarousel(options);
            $('#articles').owlCarousel(options);
        });
    </script>
@endpush
