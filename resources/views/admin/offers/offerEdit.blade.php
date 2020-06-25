@extends('layouts.admin')
@section('content')
    <form action="{{route('admin.offers.update', $offer)}}" method="POST" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <div class="row">
            <div class="col-lg-6">
                @widget('translatable', ['entries' => $offer->getTranslations('name'), 'translation' =>
                __('adminPanel.name')])
            </div>
            <div class="col-lg-6">
                @widget('translatable', ['name' => 'description', 'input' => 'textarea', 'entries' =>
                $offer->getTranslations('description'), 'translation' => __('adminPanel.description')])
            </div>
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h4 class="text-primary">{{__('adminPanel.offerCreate')}}</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="col-form-label" for="product">{{__('adminPanel.product')}}</label>
                            <select name="product_id" id="product" required
                                    class="form-control{{ $errors->has('product_id') ? ' is-invalid': '' }}">
                                <option value="{{$offer->product_id}}" selected="selected">
                                    {{($offer->product->name)}}
                                </option>
                            </select>
                            @if($errors->has('product_id'))
                                <span
                                    class="invalid-feedback"><strong>{{ $errors->first('product_id') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="photo">{{__('adminPanel.photo')}}</label>
                            <input name="photo" type="file" id="photo" value="{{ old('photo') }}" accept="image/*"
                                   class="form-control-file{{ $errors->has('photo') ? ' is-invalid': '' }}">
                            @if($errors->has('photo'))
                                <span class="invalid-feedback"><strong>{{ $errors->first('photo') }}</strong></span>
                            @endif
                        </div>
                        <input type="submit" value="{{__('adminPanel.update')}}" class="btn btn-primary">
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@push('scripts')
    <script src="{{mix('js/apiSelect.js', 'build')}}" type="text/javascript"></script>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            new APISelect("#product", "{{route('ajax.products')}}");
        });
    </script>
@endpush
