@extends('layouts.app')
@section('seo.description', $offer->description)
@section('seo.title', sprintf("%s: %s", __('frontend.offer'),$offer->name))
@section('seo.image', isset($offer) ? $offer->photo->getUrl() : null)
@section('links')
    <link rel="stylesheet" href="{{mix('css/owlCarousel.css', 'build')}}">
    <link rel="stylesheet" href="{{asset('js/chocolat/css/chocolat.css')}}">
@endsection
@section('header')
    <!-- Poster -->
    <div class="poster poster-job-details">
        <div class="container">
            <div class="row page-title">
                <h1>
                    {{$offer->name}}
                </h1>
            </div>
        </div>
    </div>
    <!-- /Poster -->
@endsection
@section('content')
    <div class="container">
        <div class="row flex-lg-row-reverse">
            <!--Sidebar-->
            <div class="col-lg-4 col-12">
                <div class="job-sidebar">
                    <div class="sidebar-details">
                        <hr/>
                        <div class="employer-logo">
                            <div class="owl-carousel owl-theme" id="owl">
                                @foreach($offer->product->images as $image)
                                    <a class="chocolat-image" href="{{$image->photo->getUrl()}}">
                                        <img src="{{$image->photo->getUrl()}}" class="img-responsive">
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        <hr/>
                        <ul class="nav md-pills pills-primary flex-column p-0" role="tablist">
                            <li class="nav-item p-0">
                                <a class="nav-link active" href="{{route('products.show', $offer->product)}}">
                                    {{$offer->product->name}}<i class="fa fa-info ml-2"></i>
                                </a>
                            </li>
                            <li class="nav-item p-0">
                                <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                                    <a class="a2a_dd" href="https://www.addtoany.com/share"></a>
                                    <a class="a2a_button_facebook"></a>
                                    <a class="a2a_button_twitter"></a>
                                    <a class="a2a_button_email"></a>
                                    <a class="a2a_button_telegram"></a>
                                    <a class="a2a_button_whatsapp"></a>
                                    <a class="a2a_button_linkedin"></a>
                                </div>
                            </li>
                        </ul>
                        <hr/>
                    </div>
                </div>
            </div>
            <!--Sidebar-->
            <!--Main listing-->
            <div class="col-lg-8 col-12">
                <div class="main-info">
                    <div id="aboutme">
                        <div class="row">
                            <div class="col-12">
                                <div class="section-title section-title-blue">
                                    <div>
                                        <h2>
                                            {{__('frontend.offer')}}
                                        </h2>
                                        <hr/>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-justify">
                            {!! $offer->description !!}
                        </div>
                    </div>
                </div>
                <hr class="my-5"/>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script async src="https://static.addtoany.com/menu/page.js"></script>
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
            };
            $('#owl').owlCarousel(options);
            Chocolat(document.querySelectorAll('.chocolat-image'), {
                // options here
            })

        });
    </script>
@endpush
