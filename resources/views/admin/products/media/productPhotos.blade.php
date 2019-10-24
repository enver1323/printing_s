<div class="card shadow mb-4">
    <div class="card-header">
        <h4 class="text-primary">{{Str::plural(__('adminPanel.photo'))}}</h4>
    </div>
    <div class="card-body">
        <div class="row">
            @foreach($images as $image)
                <div class="col-md-2 col-6">
                    <div class="d-flex justify-content-around">
                        <div class="product-image-buttons">
                            @if($loop->index)
                                <a href="{{route('admin.products.media.image.toLeft', [$product, $image])}}"
                                   class="btn btn-secondary">
                                    <i class="fa fa-arrow-left"></i>
                                </a>
                            @endif
                            <a href="{{route('admin.products.media.image.delete', [$product, $image])}}" class="btn btn-warning">
                                <i class="fa fa-trash"></i>
                            </a>
                            @if($loop->remaining)
                                <a href="{{route('admin.products.media.image.toRight', [$product, $image])}}"
                                   class="btn btn-secondary">
                                    <i class="fa fa-arrow-right"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="">
                        <img src="{{$image->photo->getUrl()}}" alt="" class="img-thumbnail">
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</div>
