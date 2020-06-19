@extends('layouts.app')
@section('header')
    <!-- Poster -->
    <div class="poster poster-jobs-listing">
        <div class="container">
            <div class="row page-title">
                <h1>
                    {{__('frontend.brands')}}
                </h1>
            </div>
        </div>
    </div>
    <!-- /Poster -->
@endsection
@section('content')
    <section class="jobs-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <ul class="nav md-tabs nav-justified custom-tabs">
                        @foreach($brands as $brandItem)
                            <li class="nav-item">
                                <a class="nav-link {{$brandItem->id === $brand->id ? 'active' : ''}}"
                                   href="{{route('products.brand', $brandItem)}}">
                                    {{$brandItem->name}}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3 order-md-last">
                    <div class="job-sidebar" id="sidebar">
                        <div class="sidebar-details">
                            <hr/>
                            <div class="employer-logo">
                                <img src='{{$brand->photo ? $brand->photo->getUrl() : ''}}' alt="" class="img-fluid"
                                     id="product-image">
                            </div>
                            <hr/>
                            <span id="product-description">
                                {!! $brand->shortDescription !!}
                            </span>
                            <hr/>
                            <a href="" id="product-link" class="green-text font-weight-bold font-small">
                                {{__("frontend.readMore")}} <i class="fa fa-arrow-circle-right green-text ml-2"></i>
                            </a>
                        </div>
                    </div>

                </div>
                <div class="col-12 col-md-9 order-md-first">
                    <div class="row">
                        @foreach($lines as $line)
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="section-title section-title-blue">
                                        <h4>{{$line->name}}</h4>
                                        <hr>
                                    </div>
                                </div>
                                <div class="row">
                                    @foreach($line->products as $product)
                                        <div class="col-12 job d-flex align-items-stretch mb-3">
                                            <div class="card w-100">
                                                <a href="{{route('products.show', $product)}}"
                                                   class="d-block d-md-none">
                                                    <img class="card-img-top" alt="{{$product->name}}"
                                                         id="product-{{$product->id}}-image"
                                                         src="{{isset($product->mainImage->photo) ? $product->mainImage->photo->getUrl() : ''}}">
                                                </a>
                                                <div
                                                    class="card-body p-2 d-flex flex-column flex-md-row justify-content-between"
                                                    data-id="{{$product->id}}">
                                                    <h5 class="card-title m-0 float-left my-auto">
                                                        <strong>
                                                            <a href="{{route('products.show', $product)}}">
                                                                {{$product->name}}
                                                            </a>
                                                        </strong>
                                                    </h5>
                                                    <div class="card-text d-block d-md-none"
                                                         id="product-{{$product->id}}-description">
                                                        {!! $product->shortDescription !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- /Panel Recent Jobs -->
        <div class="d-flex justify-content-center">
            {{$lines->links()}}
        </div>
    </section>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{mix('js/productListSidebar.js', 'build')}}"></script>
@endpush
