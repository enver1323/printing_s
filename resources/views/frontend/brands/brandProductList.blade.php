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
            @foreach($lines as $line)
                <div class="row">
                    <div class="col-12">
                        <div class="section-title section-title-blue">
                            <div>
                                <h2>
                                    {{$line->name}}
                                </h2>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                @foreach($line->products as $product)
                    <!-- Card -->
                        <div class="col-lg-4 col-md-4 job d-flex align-items-stretch">
                            @include('frontend.products.productListCard', $product)
                        </div>
                        <!-- /Card -->
                    @endforeach
                </div>
            @endforeach
        </div>
        <!-- /Panel Recent Jobs -->
        {{$lines->links()}}
    </section>
@endsection
