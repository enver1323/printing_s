@extends('layouts.app')
@section('header')
    <!-- Poster -->
    <div class="poster poster-sm poster-job-details">
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
                            <img
                                src="{{$product->mainImage && $product->mainImage->photo ? $product->mainImage->photo->getUrl() : ''}}"
                                alt=""
                                class="img-fluid"/>
                        </div>
                        <hr/>
                        <ul class="nav md-pills pills-primary flex-column" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#overView" role="tab">
                                    {{__('frontend.overview')}}<i class="fa fa-info ml-2"></i>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#techData" role="tab">
                                    {{__('frontend.techData')}}<i class="fa fa-list ml-2"></i>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#gallery" role="tab">
                                    {{__('frontend.gallery')}}<i class="fa fa-image ml-2"></i>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#related" role="tab">
                                    {{__('frontend.related')}}<i class="fa fa-share-alt ml-2"></i>
                                </a>
                            </li>
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
                                    {{$product->description}}
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
                        <div class="job-detail-info">
                            <ul>
                                @foreach($product->dataValues  as $value)
                                    <li class="salary">
                                        <div class="content-inner">
                                            <div class="inner-left">
                                                <span class="detail-title">{{$value->dataKey->name}}:</span>
                                            </div>
                                            <div class="inner-right">
                                                {{$value->value}}
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!-- Panel 2 -->
                    <!-- Panel 3 -->
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
                            <div class="col-md-12">
                                <div id="mdb-lightbox-ui"></div>
                                <div class="mdb-lightbox">
                                    @foreach($product->images as $image)
                                        <figure class="col-md-4">
                                            <a href="{{$image->photo->getUrl()}}"
                                               data-size="1600x1067">
                                                <img
                                                    src="{{$image->photo->getUrl()}}"
                                                    alt="placeholder"
                                                    class="img-fluid">
                                            </a>
                                        </figure>
                                    @endforeach
                                </div>
                            </div>
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
                                                <button data-id="{{$option->id}}"
                                                        class="btn btn-primary float-right job-detail-button">
                                                    <i class="fa fa-search" data-id="{{$option->id}}"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-none">
                                        <div id="product-{{$option->id}}-description">
                                            {!! $option->description !!}
                                            <hr>
                                            <table class="table table-striped">
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
                            <div class="col-md-6 sidebar-details" id="sidebar" style="display: none">
                                <div id="product-description"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Main listing-->
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{mix('js/productListSidebar.js', 'build')}}"></script>
@endpush
