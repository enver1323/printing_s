<div class="row">
    <!-- Card -->
    <div class="col-lg-12 col-md-12 candidate">
        <div class="card">
            <div class="row">
                <!-- Card image -->
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-5 card-image-wrapper">
                    <div class="card-image">
                        <img src="{{isset($offer->photo) ? $offer->photo->getUrl() : ''}}" class="img-fluid" alt="">
                    </div>
                </div>
                <!--Card image -->

                <div class="col-xl-9 col-lg-9 col-md-8 col-sm-7">
                    <div class="card-body">

                        <h5 class="card-title">
                            <strong>
                                <a href="{{route('offers.show', $offer)}}">{{$offer->name}}</a>
                            </strong>
                        </h5>
                        <h6 class="card-subtitle">{{$offer->product->name}}</h6>

                        <p>
                            {!! $offer->description !!}
                        </p>

                        <h6 class="mt-2 mb-0 d-flex justify-content-end">
                            <a href="{{route('offers.show', $offer)}}"
                               class="green-text font-weight-bold font-small">
                                {{__("frontend.readMore")}} <i class="fa fa-arrow-circle-right green-text ml-2"></i>
                            </a>
                        </h6>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Card -->
</div>
