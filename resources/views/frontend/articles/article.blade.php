@extends('layouts.app')
@section('header')
    <!-- Poster -->
    <div class="poster poster-candidate-details">
        <div class="container">
            <div class="info-top">
                <div class="info-inner">
                    <div class="title-headline">
                        <h2 class="candidate-name">
                            {{$article->name}}
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Poster -->
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <!--Main listing-->
            <div class="col-lg-8 col-12 px-lg-4">
                <div class="main-info">
                    <div id="aboutme">
                        <div class="row">
                            <div class="col-12">
                                <div class="section-title section-title-blue">
                                    <div>
                                        <h2>
                                            {{__('frontend.article')}}
                                        </h2>
                                        <hr/>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <p class="text-justify">
                            {!! $article->description !!}
                        </p>
                    </div>
                </div>
                <hr class="my-5"/>

{{--                <!-- Comments -->--}}
{{--                <div>--}}
{{--                    <div>--}}
{{--                        <!-- Comment -->--}}
{{--                        <div class="row comment">--}}
{{--                            <div class="col-sm-2 col-12 comment-avatar-wrapper">--}}
{{--                                <img src="img/users/candidate1.jpg" class="comment-avatar img-fluid"/>--}}
{{--                            </div>--}}
{{--                            <div class="col-sm-10 col-12">--}}
{{--                                <a>--}}
{{--                                    <h4 class="comment-username">Komroniddin Soliev</h4>--}}
{{--                                </a>--}}
{{--                                <div class="mt-2">--}}
{{--                                    <ul class="list-unstyled">--}}
{{--                                        <li><i class="far fa-clock mr-2"></i> 05/10/2019</li>--}}
{{--                                    </ul>--}}
{{--                                </div>--}}
{{--                                <p class="comment-text">--}}
{{--                                    Ut enim ad minim veniam, quis nostrud exercitation ullamco--}}
{{--                                    laboris nisi ut aliquip ex ea commodo consequat. Duis aute--}}
{{--                                    irure dolor in reprehenderit in voluptate velit esse--}}
{{--                                    cillum dolore eu fugiat nulla pariatur. Excepteur sint--}}
{{--                                    occaecat cupidatat non proident.--}}
{{--                                </p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!-- Comment -->--}}

{{--                        <!-- Leave comment -->--}}
{{--                        <div>--}}
{{--                            <form action="">--}}
{{--                                <div class="row">--}}
{{--                                    <div class="col-sm-2 col-12 comment-avatar-wrapper">--}}
{{--                                        <img src="img/users/candidate1.jpg" alt="" class="comment-avatar img-fluid"/>--}}
{{--                                    </div>--}}

{{--                                    <div class="col-sm-10 col-12">--}}
{{--                                        <div class="md-form">--}}
{{--                                            <textarea type="text" id="form-text" class="md-textarea form-control"--}}
{{--                                                      rows="3"></textarea>--}}
{{--                                            <label for="form-text">Your message</label>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="row">--}}
{{--                                    <div class="col-md-12 btn-comment">--}}
{{--                                        <button class="btn btn-primary btn-rounded">--}}
{{--                                            Comment--}}
{{--                                        </button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                        <!-- /Leave comment -->--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <!-- Comments-->--}}
            </div>
            <!--Main listing-->

            <!--Sidebar-->
            <div class="col-lg-4 col-12 mb-3 order-xl-last order-lg-last order-md-first order-first">
                <div class="sidebar-details">
                    <hr class=""/>
                    <p>
                        <i class="fas fa-user-graduate pr-3 purple-text"></i>
                        <strong>{{__('frontend.author')}}:</strong><br/>
                        <span>{{$article->author->name}}</span><br/>
                        <i class="fas fa-award pr-3 pink-text"></i><strong>{{__('frontend.createdAt')}} :</strong>
                        <br/><span>{{date('d-m-Y', $article->created_at->timestamp)}}</span><br/>
                    </p>
                    <hr/>
                </div>
            </div>
            <!--Sidebar-->
        </div>
    </div>
@endsection
