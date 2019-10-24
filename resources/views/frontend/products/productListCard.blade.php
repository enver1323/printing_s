<div class="card">
    <a href="{{route('products.show', $product)}}">
        <img class="card-img-top" alt="{{$product->name}}"
             src="{{isset($product->mainImage->photo) ? $product->mainImage->photo->getUrl() : ''}}">
    </a>
    <div class="card-body">
        <!-- Title -->
        <h4 class="card-title">
            <strong>
                <a href="{{route('products.show', $product)}}">
                    {{$product->name}}
                </a>
            </strong>
        </h4>
        <!-- Text -->
        <p class="card-text">
            {!! $product->description !!}
        </p>
        <!-- Button -->
        <a href="{{route('products.show', $product)}}">
            <button class="btn btn-rounded btn-primary btn-sm">
                {{__('frontend.readMore')}}
            </button>
        </a>
    </div>
</div>
