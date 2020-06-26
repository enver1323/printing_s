@extends('layouts.app')
@section('header')
    <!-- Poster -->
    <div class="poster poster-job-details">
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
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2997.1559551951536!2d69.2660867154232!3d41.30547077927181!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38ae8bd324916cc3%3A0x14a9ab43066e67cd!2sIntach-Di!5e0!3m2!1sen!2s!4v1591966798358!5m2!1sen!2s"
                    width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false"
                    tabindex="0"></iframe>
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
                                                    {{__('frontend.send')}}
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

                            <a href="mailto:info@intach-di.com" class="text-white">
                                <i class="fa fa-envelope pr-3"></i>
                                info@intach-di.com
                            </a>
                            <br>
                            <a href="tel:+998712565354" class="text-white" target="_blank">
                                <i class="fa fa-phone pr-3"></i>+998712565354
                            </a>
                            <a href="https://t.me/IntachDi" class="text-white" target="_blank">
                                <i class="fa fa-telegram pr-3"></i>+998977277022
                            </a>
                        </div>
                    </div>
                    <!-- Contact Right -->
                </div>
            </div>
            <!-- /Contact Card -->
        </div>
    </div>
@endsection
