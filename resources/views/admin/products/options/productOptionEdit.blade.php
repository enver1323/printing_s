@extends('layouts.admin')
@section('content')
    <form action="{{route('admin.products.options.update', $option)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method("PATCH")
        <div class="row">
            <div class="col-lg-6">
                @include('admin.translations.editEntriesList', [
                    'item' => $option,
                    'translatableField' => 'name',
                    'translatableFieldName' => __('adminPanel.name'),
                    'languages' => $languages
                ])
            </div>
            <div class="col-lg-6">
                @include('admin.translations.editEntriesList', [
                    'item' => $option,
                    'translatableField' => 'description',
                    'translatableFieldName' => __('adminPanel.description'),
                    'languages' => $languages,
                    'inputType' => 'textarea'
                ])
            </div>
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h4 class="text-primary">{{__('adminPanel.optionCreate')}}</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="col-form-label" for="product">{{__('adminPanel.product')}}</label>
                            <select name="product_id" id="product" required
                                    class="form-control{{ $errors->has('product_id') ? ' is-invalid': '' }}">
                                <option value="{{$option->product_id}}" selected="selected">{{($option->product->name)}}</option>
                            </select>
                            @if($errors->has('product_id'))
                                <span class="invalid-feedback"><strong>{{ $errors->first('product_id') }}</strong></span>
                            @endif
                        </div>
                        <input type="submit" value="{{__('adminPanel.update')}}" class="btn btn-primary">
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{asset('js/admin/addEntries.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/admin/apiSelect.js')}}"></script>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            new APISelect("#product", "{{route('ajax.products')}}");
        });
    </script>
@endsection
