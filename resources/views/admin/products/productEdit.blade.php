@extends('layouts.admin')
@section('content')
    <form action="{{route('admin.products.update', $product)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method("PATCH")
        <div class="row">
            <div class="col-lg-6">
                @widget('translatable', ['entries' => $product->getTranslations('name'), 'translation' =>
                __('adminPanel.name')])
            </div>
            <div class="col-lg-6">
                @widget('translatable', ['name' => 'description', 'input' => 'textarea',
                'entries' => $product->getTranslations('description'), 'translation' => __('adminPanel.description')
                ])
            </div>

            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h4 class="text-primary">{{__('adminPanel.productCreate')}}</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="col-form-label" for="category">{{__('adminPanel.category')}}</label>
                            <select name="category_id" id="category" required
                                    class="form-control{{ $errors->has('category_id') ? ' is-invalid': '' }}">
                                @if($product->category)
                                    <option value="{{$product->category_id}}"
                                            selected="selected">
                                        {{($product->category->name)}}
                                    </option>
                                @endif
                            </select>
                            @if($errors->has('category_id'))
                                <span
                                    class="invalid-feedback"><strong>{{ $errors->first('category_id') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="brand">{{__('adminPanel.brand')}}</label>
                            <select name="brand_id" id="brand" required
                                    class="form-control{{ $errors->has('category_id') ? ' is-invalid': '' }}">
                                @if($product->brand)
                                    <option value="{{$product->brand_id}}" selected="selected">
                                        {{($product->brand->name)}}
                                    </option>
                                @endif
                            </select>
                            @if($errors->has('brand_id'))
                                <span class="invalid-feedback"><strong>{{ $errors->first('brand_id') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="line">{{__('adminPanel.line')}}</label>
                            <select name="line_id" id="line" required
                                    class="form-control{{ $errors->has('line_id') ? ' is-invalid': '' }}">
                                @if($product->line)
                                    <option value="{{$product->line_id}}" selected="selected">
                                        {{($product->line->name)}}
                                    </option>
                                @endif
                            </select>
                            @if($errors->has('line_id'))
                                <span class="invalid-feedback"><strong>{{ $errors->first('line_id') }}</strong></span>
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
    <script type="text/javascript" src="{{mix('js/apiSelect.js', 'build')}}"></script>
    <script type="text/javascript" src="{{asset('js/ckeditor/ckeditor.js')}}"></script>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            new APISelect("#category", "{{route('ajax.categories')}}");
            new APISelect("#brand", "{{route('ajax.brands')}}");
            new APISelect("#line", "{{route('ajax.lines')}}");
        });
    </script>
@endpush
