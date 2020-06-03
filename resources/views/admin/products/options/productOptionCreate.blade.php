@extends('layouts.admin')
@section('content')
    <form action="{{route('admin.products.options.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-6">
                @widget('translatable', ['translation' => __('adminPanel.name')])
            </div>
            <div class="col-lg-6">
                @widget('translatable', ['name' => 'description', 'input' => 'textarea', 'translation' => __('adminPanel.description')])
            </div>
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h4 class="text-primary">{{__('adminPanel.productCreate')}}</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="col-form-label" for="product">{{__('adminPanel.product')}}</label>
                            <select name="product_id" id="product" required
                                    class="form-control{{ $errors->has('product_id') ? ' is-invalid': '' }}">
                                <option value="{{$product->id}}">{{ $product->name }}</option>
                            </select>
                            @if($errors->has('product_id'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('product_id') }}</strong>
                                </span>
                            @endif
                        </div>
                        <input type="submit" value="{{__('adminPanel.save')}}" class="btn btn-primary">
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{asset('js/admin/apiSelect.js')}}"></script>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            new APISelect("#product", "{{route('ajax.products')}}");
        });
    </script>
@endpush
