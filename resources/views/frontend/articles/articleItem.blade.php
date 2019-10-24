<div class="row">
    <!-- Card -->
    <div class="col-lg-12 col-md-12 candidate">
        <div class="card">
            <div class="row">
                <!-- Card image -->
                <div class="col-xl-2 col-lg-2 col-md-3 col-sm-4 card-image-wrapper">
                    <div class="card-image">
                        <img src="{{isset($article->photo) ? $article->photo->getUrl() : ''}}" class="img-fluid" alt="">
                    </div>
                </div>
                <!--Card image -->

                <div class="col-xl-10 col-lg-10 col-md-9 col-sm-8">
                    <!-- Card content -->
                    <div class="card-body">

                        <h5 class="card-title">
                            <strong>
                                <a href="{{route('articles.show', $article)}}">{{$article->name}}</a>
                            </strong>
                        </h5>
                        <h6 class="card-subtitle">{{date("d-m-Y", $article->created_at->timestamp)}}</h6>

                        <p>
                            {!! $article->description !!}
                        </p>

                        <h6 class="mt-2 mb-0 d-flex justify-content-end">
                            <a href="{{route('articles.show', $article)}}"
                               class="green-text font-weight-bold font-small">
                                {{__("frontend.readMore")}} <i class="fa fa-arrow-circle-right green-text ml-2"></i>
                            </a>
                        </h6>

                    </div>
                    <!-- /Card content -->
                </div>
            </div>
        </div>
    </div>
    <!-- /Card -->
</div>
