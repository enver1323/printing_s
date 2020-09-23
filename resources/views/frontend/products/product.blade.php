@extends('layouts.app')
@section('seo.description', $product->description ?? null)
@section('seo.title', sprintf("%s: %s", __('frontend.product'), $product->name))
@section('seo.image', $product->mainImage && $product->mainImage->photo ? $product->mainImage->photo->getUrl() : null)
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
                    {{$product->name}}
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
                                @foreach($product->images as $image)
                                    <a class="chocolat-image" href="{{$image->photo->getUrl()}}">
                                        <img src="{{$image->photo->getUrl()}}" class="img-responsive">
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        <hr/>
                        <ul class="nav md-pills pills-primary flex-column p-0" role="tablist">
                            <li class="nav-item p-0">
                                <a class="nav-link active" data-toggle="tab" href="#overView" role="tab">
                                    {{__('frontend.overview')}}<i class="fa fa-info ml-2"></i>
                                </a>
                            </li>
                            <li class="nav-item p-0">
                                <a class="nav-link" data-toggle="tab" href="#techData" role="tab">
                                    {{__('frontend.techData')}}<i class="fa fa-list ml-2"></i>
                                </a>
                            </li>
                            <li class="nav-item p-0">
                                <a class="nav-link" data-toggle="tab" href="#gallery" role="tab">
                                    {{__('frontend.gallery')}}<i class="fa fa-image ml-2"></i>
                                </a>
                            </li>
                            <li class="nav-item p-0">
                                <a class="nav-link" data-toggle="tab" href="#related" role="tab">
                                    {{__('frontend.related')}}<i class="fa fa-share-alt ml-2"></i>
                                </a>
                            </li>
                            @isset($product->manual)
                                <li class="nav-item p-0">
                                    <a class="nav-link" href="{{$product->manual->getUrl()}}">
                                        {{__('frontend.manual')}}<i class="fa fa-paperclip ml-2"></i>
                                    </a>
                                </li>
                            @endisset
                            @if(count($product->offers))
                                <li class="nav-item p-0">
                                    <a class="nav-link pink-text" data-toggle="tab" href="#offers" role="tab">
                                        {{__('frontend.offers')}}<i class="fa fa-gift ml-2"></i>
                                    </a>
                                </li>
                            @endif
                        </ul>
                        <hr/>
                    </div>
                </div>
            </div>
            <!--Sidebar-->
            <!--Main listing-->
            <div class="col-lg-8 col-12">
                <div class="job-detail-content tab-content vertical">

                    <!-- Panel 1 -->
                    <div class="tab-pane fade in show active" id="overView" role="tabpanel">
                        <div class="row">
                            <div class="col-12">
                                <div class="section-title section-title-blue">
                                    <div>
                                        <h2>
                                            {{strtoupper(__('frontend.overview'))}}
                                        </h2>
                                        <hr/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="job-info">
                            <div class="job-description">
                                <p>
                                    <strong class="job-description-title">{{__('frontend.description')}}:</strong>
                                </p>
                                <p>
                                    {!! $product->description !!}
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- Panel 1 -->
                    <!-- Panel 2 -->
                    <div class="tab-pane fade" id="techData" role="tabpanel">
                        <div class="row">
                            <div class="col-12">
                                <div class="section-title section-title-blue">
                                    <div>
                                        <h2>
                                            {{strtoupper(__('frontend.techData'))}}
                                        </h2>
                                        <hr/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="product-{{$product->id}}-description">
                            <table class="table table-striped table-hover table-bordered table-sm">
                                @foreach($product->dataValues  as $value)
                                    <tr>
                                        <td>
                                            {{$value->dataKey->name}}
                                        </td>
                                        <td>
                                            {{$value->value}}
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="gallery" role="tabpanel">
                        <div class="row">
                            <div class="col-12">
                                <div class="section-title section-title-blue">
                                    <div>
                                        <h2>
                                            {{strtoupper(__('frontend.gallery'))}}
                                        </h2>
                                        <hr/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @foreach($product->images as $image)
                                <div class="col-md-4">
                                    <div class="img-thumbnail">
                                        <a class="chocolat-image" href="{{$image->photo->getUrl()}}">
                                            <img src="{{$image->photo->getUrl()}}" class="img-responsive w-100">
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane fade" id="related" role="tabpanel">
                        <div class="row">
                            <div class="col-12">
                                <div class="section-title section-title-blue">
                                    <div>
                                        <h2>
                                            {{strtoupper(__('frontend.related'))}}
                                        </h2>
                                        <hr/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                @foreach($product->options as $option)
                                    <div class="col-12 job d-flex align-items-stretch mb-3">
                                        <div class="card w-100">
                                            <div class="card-body p-2 justify-content-between d-flex"
                                                 data-id="{{$option->id}}">
                                                <h5 class="card-title m-0 float-left my-auto">
                                                    <strong>
                                                        {{$option->name}}
                                                    </strong>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-none">
                                        <div id="product-{{$option->id}}-description">
                                            {!! $option->description !!}
                                            <hr>
                                            <table class="table table-striped table-hover table-sm">
                                                @foreach($option->dataValues  as $value)
                                                    <tr>
                                                        <td>
                                                            {{$value->dataKey->name}}
                                                        </td>
                                                        <td>
                                                            {{$value->value}}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="col-md-6 sidebar-details mt-0" id="sidebar" style="display: none">
                                <div id="product-description"></div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="offers" role="tabpanel">
                        <div class="row">
                            <div class="col-12">
                                <div class="section-title section-title-blue">
                                    <div>
                                        <h2>
                                            {{strtoupper(__('frontend.offers'))}}
                                        </h2>
                                        <hr/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @foreach($product->offers as $offer)
                                <div class="col-md-4">
                                    <div class="img-thumbnail">
                                        <a class="" href="{{route('offers.show', $offer)}}">
                                            <img
                                                src="{{isset($offer->photo) ? $offer->photo->getUrl() : (isset($product->mainImage->photo) ? $product->mainImage->photo->getUrl() : '')}}"
                                                class="img-responsive w-100">
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{mix('js/productListSidebar.js', 'build')}}"></script>
    <script type="text/javascript" src="{{mix('js/owlCarousel.js', 'build')}}"></script>
    <script type="text/javascript" src="{{asset('js/chocolat/js/chocolat.js')}}"></script>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            let options = {
                loop: true,
                center: true,
                items: 1,
                responsiveClass: true,
                autoplay: false,
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
