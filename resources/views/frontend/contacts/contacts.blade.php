@extends('layouts.app')
@section('header')
    <!-- Poster -->
    <div class="poster poster-sm poster-contact">
        <div class="container">
            <div class="row page-title">
                <h1>
                    {{__('frontend.contacts')}}
                </h1>
            </div>
        </div>
    </div>
    <!-- /Poster -->
@endsection
@section('content')
    <div class="container">
        <div class="row contact-card-wrapper">
            <div class="col-12">
                <div class="section-title section-title-blue">
                    <div>
                        <h2>
                            {{__('frontend.location')}}
                        </h2>
                        <hr/>
                    </div>
                </div>
            </div>

            <!-- MAP -->
            <div id="map-container" class="z-depth-1-half map-container col-12" style="min-height: 400px">
                <iframe frameborder="0" scrolling="no" allowfullscreen marginheight="0" marginwidth="0" width="100%" height="400px"
                        src="https://maps.google.com/maps?q=tashkent%2C%20smart%20market&t=&z=13&ie=UTF8&iwloc=&output=embed">
                </iframe>
            </div>

            <!-- /MAP -->

            <hr class="my-4"/>

            <!-- Contact Card -->
            <div class="card contact-card col-12">
                <div class="row">
                    <!-- Contact Left -->
                    <div class="col-lg-8">
                        <div class="card-body contact-card-left">
                            <!-- Header -->
                            <h3 class="contact-header">
                                <i class="fa fa-envelope pr-3"></i>{{strtoupper(__('frontend.keepInTouch'))}}:
                            </h3>

                            <form action="{{route('comment.create')}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="md-form">
                                            <input type="text" id="name" name="name"
                                                   class="form-control"/>
                                            <label for="name" class="">{{__('frontend.name')}}</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="md-form">
                                            <input type="email" id="email" name="email"
                                                   class="form-control"/>
                                            <label for="email" class="">{{__('adminPanel.email')}}</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="md-form">
                        <textarea type="text" id="form-contact-message" name="message"
                                  class="form-control md-textarea" rows="3"></textarea>
                                            <label for="form-contact-message">Your message</label>

                                            <div class="btn-contact-wrapper">
                                                <button class="btn btn-outline-primary btn-rounded" type="submit">
                                                    {{__('adminPanel.save')}}
                                                    <i class="fa fa-paper-plane pl-2"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Contact Left -->

                    <!-- Contact Right -->
                    <div class="col-lg-4">
                        <div class="card-body contact-card-right">
                            <h3 class="contact-header">{{__('frontend.contacts')}}</h3>

                            <p><i class="fa fa-envelope pr-3"></i>printing@mail.com</p>

                            <p><i class="fa fa-phone pr-3"></i>+998 (90) 123 45 67</p>
                        </div>
                    </div>
                    <!-- Contact Right -->
                </div>
            </div>
            <!-- /Contact Card -->
        </div>
    </div>
@endsection
