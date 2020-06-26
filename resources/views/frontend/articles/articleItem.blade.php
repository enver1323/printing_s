<div class="row">
    <!-- Card image -->
    <div class="col-xl-4 col-lg-4 col-md-5 col-sm-6 card-image-wrapper">
        <div class="card-image">
            <img src="{{isset($article->photo) ? $article->photo->getUrl() : ''}}"
                 class="img-fluid" alt="">
        </div>
    </div>
    <div class="col-xl-8 col-lg-8 col-md-7 col-sm-6">
        <div class="card-body h-100 d-flex flex-column">
            <div class="card-title d-block">
                <h5 class='d-inline'>
                    <a href="{{route('articles.index')}}">
                        {{__('frontend.articles')}}
                    </a>
                </h5>
                <small>
                    {{$article->created_at->format("d-m-Y")}}
                </small>
            </div>
            <div class="my-auto">
                <h6 class="card-subtitle">
                    <a href="{{route('articles.show', $article)}}">{{$article->name}}</a>
                </h6>
                <p>
                    {!! $article->description !!}
                </p>
            </div>
            <h6 class="mb-2 mr-2 d-flex justify-content-between">
                <a href="{{route('articles.index')}}"
                   class="font-small pink-text">
                    {{mb_strtolower(sprintf("%s %s", __("frontend.all"), __("frontend.articles")))}}
                    <i class="fa fa-arrow-circle-right ml-2"></i>
                </a>
                <a href="{{route('articles.show', $article)}}"
                   class="pink-text font-small">
                    {{mb_strtolower(__("frontend.readMore"))}}
                    <i class="fa fa-arrow-circle-right ml-2"></i>
                </a>
            </h6>
        </div>
    </div>
</div>
