@extends('layouts.app')
@section('content')
    <section id="main-slider">
        <div class="container">
            <div class="main-slider">
                <div class="row">
                    <div class="col-md-6">
                        <img src="storage/slider/slider_photo_1.jpg" width="450" height="350"/>
                    </div>
                    <div class="col-md-6">
                        <h1>
                            Company<br/>
                            <p class="tab">Brand new<br/></p>
                            <p class="double-tab">Product</p>
                            <br/>
                        </h1>
                        <h2>.!. Laser jet .!. Paper formate</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="Categories">
        <div class="container">
            <div class="box box-first center">
                <h2>Categories</h2>
                <div class="row">
                    @foreach($categories as $category)
                        <div class="col-md-3 col-6 p-0 img-button cat-item">
                            <img src="{{$category->photo ? $category->photo->getUrl(): ''}}"/>
                            <div class="cat-item-mask">
                                <h5>{{$category->name}}</h5>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section id="Top_products">
        <div class="container">
            <div class="box even center">
                <h2>Top Products</h2>
                <div class="row">
                    @foreach($products as $product)
                        <div class="col-md-2 col-6 p-0">
                            <figure>
                                <img src="{{isset($product->mainImage->photo) ? $product->mainImage->photo->getUrl(): ''}}"/>
                                <figcaption>{{$product->name}}</figcaption>
                            </figure>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section id="Brands">
        <div class="container">
            <div class="box">
                <div class="center">
                    <h2>Brands</h2>
                </div>
                <div class="row">
                    @foreach($brands as $brand)
                        <div class="col-md-2 col-6 p-0 img-button">
                            <img src="{{$brand->photo ? $brand->photo->getUrl() : 'test'}}"/>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section id="Contact_us">
        <div class="container">
            <div class="box even">
                <div class="center">
                    <h2>Contact_us</h2>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="center">
                            <a href="" title="Our Telegram public channel">
                                <img
                                    class="button"
                                    src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/82/Telegram_logo.svg/512px-Telegram_logo.svg.png"
                                    width="30%"
                                />
                            </a>
                        </div>
                    </div>
                    <div class="contact-form col-md-6">
                        <form>
                            <div class="form-group">
                                <input
                                    type="text"
                                    class="form-control form-control-lg w-1000"
                                    placeholder="Name"
                                    name=""
                                />
                            </div>
                            <div class="form-group">
                                <input
                                    type="email"
                                    class="form-control form-control-lg w-1000"
                                    placeholder="E-mail"
                                    name="email"
                                />
                            </div>
                            <div class="form-group">
                  <textarea
                      class="form-control form-control-lg w-1000"
                  ></textarea>
                            </div>
                            <input
                                type="submit"
                                class="btn btn-secondary btn-block"
                                value="Submit"
                                name=""
                            />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
