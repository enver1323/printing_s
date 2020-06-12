@extends('layouts.app')
@section('header')
    <!-- Poster -->
    <div class="poster poster-jobs-listing">
        <div class="container">
            <div class="row page-title">
                <h1>
                    {{__('frontend.categories')}}
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
                    <div class="card row">
                        <div class="col-md-8 tabs-container mb-4">
                            <ul class="nav md-tabs nav-justified custom-tabs">
                                @foreach($categories as $categoryItem)
                                    <li class="nav-item">
                                        <a class="nav-link {{$categoryItem->id === $category->id ? 'active' : ''}}"
                                           href="{{route('products.category', $categoryItem)}}">
                                            {{$categoryItem->name}}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <img src="{{$category->photo ? $category->photo->getUrl() : ''}}" alt=""
                                 class="float-left mb-3 mr-3 w-25">
                            {!! $category->description !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-9">
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
                                                        {!! $product->description !!}
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
                <div class="col-12 col-sm-6 col-md-3 d-none d-sm-block">
                    <div class="job-sidebar" id="sidebar" style="display: none">
                        <div class="sidebar-details">
                            <hr/>
                            <div class="employer-logo">
                                <img src='' alt="" class="img-fluid" id="product-image">
                            </div>
                            <hr/>
                            <span id="product-description">

                            </span>
                            <hr/>
                            <a href="" id="product-link" class="green-text font-weight-bold font-small">
                                {{__("frontend.readMore")}} <i class="fa fa-arrow-circle-right green-text ml-2"></i>
                            </a>
                        </div>
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
