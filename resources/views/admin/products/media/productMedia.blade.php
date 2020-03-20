@extends('layouts.admin')
@section('content')
    @if(isset($product->images) && !empty($product->images) && !$product->images->isEmpty())
        @include('admin.products.media.productPhotos', ['images' => $product->images, 'product' => $product])
    @endif
    <form action="{{route('admin.products.media.update', $product)}}" method="POST" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h4 class="text-primary">{{__('adminPanel.productMediaCreate')}}</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="col-form-label" for="photos">{{__('adminPanel.photo')}}</label>
                            <input name="photos[]" type="file" id="photos" value="{{ old('photos') }}" accept="image/*"
                                   class="form-control-file{{ $errors->has('photos') ? ' is-invalid': '' }}"
                                   multiple="multiple">
                            @if($errors->has('photos'))
                                <span class="invalid-feedback"><strong>{{ $errors->first('photos') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="manual">{{__('adminPanel.manual')}}</label>
                            <input name="manual" type="file" id="manual" value="{{ old('manual') }}"
                                   accept="application/pdf"
                                   class="form-control-file{{ $errors->has('manual') ? ' is-invalid': '' }}">
                            @if($errors->has('manual'))
                                <span class="invalid-feedback"><strong>{{ $errors->first('manual') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">{{__('adminPanel.update')}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
