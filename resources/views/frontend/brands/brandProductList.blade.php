@extends('layouts.app')
@section('content')
    <section id="main-slider">
        <div class="container">
            <div class="main-slider">
                <h1>{{__('frontend.brands')}}</h1>
            </div>
        </div>
    </section>

    <section id="Tabs">
        <div class="container">
            <div class="brand_box">
                <ul class="nav nav-tabs">
                    @foreach($brands as $brandItem)
                        <li class="nav-item">
                            <a class="nav-link {{$brandItem->id === $brand->id ? 'active' : ''}} brand_tab"
                               href="">{{$brand->name}}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>
    <section id="Description">
        <div class="container">
            <div class="box">
                <div class="row">
                    <div class="col-md-3 p-0 img-button">
                        <img src="{{isset($brand->photo) ? $brand->photo->getUrl() : ''}}"/>
                    </div>
                    <div class="col-md-9">
                        <div class="center"><h3>Description:</h3></div>
                        <p>
                            {!! $brand->description !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @foreach($lines as $line)
        <section>
            <div class="container">
                <div class="box even center">
                    <h3>{{$line->name}}:</h3>
                    <div class="row">
                        @foreach($products[$line->id] as $product)
                            <div class="col-md-2 col-6 p-0 product-item">
                                <figure>
                                    <img src="{{$product->photo ? $product->photo->getUrl() : ''}}"/>
                                    <figcaption>{{$product->name}}</figcaption>
                                </figure>
                                <div class="product-item-mask">
                                    {!! $product->description !!}
                                    unicom-pro
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endforeach
@endsection
