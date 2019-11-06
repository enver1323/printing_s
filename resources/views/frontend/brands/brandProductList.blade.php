@extends('layouts.app')
@section('header')
    <!-- Poster -->
    <div class="poster poster-sm poster-jobs-listing">
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
                    <div class="card row">
                        <div class="col-md-8 tabs-container mb-4">
                            <ul class="nav md-tabs nav-justified gradient-blue">
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
                        <div class="col-md-12">
                            <img src="{{$brand->photo ? $brand->photo->getUrl() : ''}}" alt=""
                                 class="float-left mb-3 mr-3 w-25">
                            {{$brand->description}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6 col-md-9">
                    <div class="row">
                        @foreach($lines as $line)
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="section-title section-title-blue">
                                        <h2>{{$line->name}}</h2>
                                        <hr>
                                    </div>
                                </div>
                                <div class="row">
                                    @foreach($line->products as $product)
                                        <div class="col-12 job d-flex align-items-stretch mb-3">
                                            <div class="card w-100">
                                                <div class="card-body p-2 d-flex justify-content-between"
                                                     data-id="{{$product->id}}">
                                                    <h5 class="card-title m-0 float-left my-auto">
                                                        <strong>
                                                            <a href="{{route('products.show', $product)}}">
                                                                {{$product->name}}
                                                            </a>
                                                        </strong>
                                                    </h5>
                                                    <button data-id="{{$product->id}}"
                                                            class="btn btn-primary float-right job-detail-button">
                                                        <i class="fa fa-search" data-id="{{$product->id}}"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-none">
                                            @php $image = $product->mainImage; @endphp
                                            <img src="{{$image && $image->photo? $image->photo->getUrl() : ''}}"
                                                 alt="" id="product-{{$product->id}}-image">
                                            <div id="product-{{$product->id}}-description">
                                                {!! $product->description !!}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-6 col-md-3">
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
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- /Panel Recent Jobs -->
        {{$lines->links()}}
    </section>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{mix('js/productListSidebar.js', 'build')}}"></script>
@endpush
