@extends('layouts.admin')
@section('content')
    <div class="card shadow">
        <div class="card-header">
            <a href="{{route('admin.products.create')}}" class="btn btn-primary mr-1">{{__('adminPanel.create')}}</a>
            <a href="{{route('admin.products.data.keys.index')}}" class="btn btn-secondary mr-1">
                {{Str::plural(__('adminPanel.dataKey'))}}
            </a>
        </div>

        <div class="card-body">
            <form action="{{route('admin.products.index')}}" method="GET" class="form-inline">
                <div class="form-group mx-1 mb-1">
                    <label for="code" class="sr-only">{{__('adminPanel.id')}}</label>
                    <input type="number" class="form-control" id="id" name="id" placeholder="{{__('adminPanel.id')}}"
                           value="{{request('id')}}">
                </div>
                <div class="form-group mx-1 mb-1">
                    <label for="name" class="sr-only">{{__('adminPanel.name')}}</label>
                    <input type="text" class="form-control" id="name" name="name"
                           placeholder="{{__('adminPanel.name')}}"
                           value="{{request('name')}}">
                </div>
                <div class="form-group mx-1 mb-1">
                    <label for="slug" class="sr-only">{{__('adminPanel.slug')}}</label>
                    <input type="text" class="form-control" id="slug" name="slug"
                           placeholder="{{__('adminPanel.slug')}}"
                           value="{{request('slug')}}">
                </div>
                <div class="form-group mx-1 mb-1">
                    <label class="col-form-label" for="category">{{__('adminPanel.category')}}</label>
                    <select name="category_id" id="category" class="form-control">
                        <option value="">{{__('adminPanel.choose')}}</option>
                    </select>
                </div>
                <div class="form-group mx-1 mb-1">
                    <label class="col-form-label" for="brand">{{__('adminPanel.brand')}}</label>
                    <select name="brand_id" id="brand" class="form-control">
                        <option value="">{{__('adminPanel.choose')}}</option>
                    </select>
                </div>
                <div class="mx-1 mb-1">
                    <button class="btn btn-secondary" type="submit"><i
                            class="fa fa-search"></i> {{__('adminPanel.search')}}</button>
                </div>

            </form>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">{{__('adminPanel.id')}}</th>
                    <th scope="col">{{__('adminPanel.name')}}</th>
                    <th scope="col">{{__('adminPanel.brand')}}</th>
                    <th scope="col">{{__('adminPanel.category')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <th scope="row">{{ $product->id }}</th>
                        <td>
                            <a href="{{route('admin.products.show', $product)}}">{{ $product->name }}</a>
                        </td>
                        <td>
                            @if($product->brand)
                                <a href="{{route('admin.brands.show', $product->brand)}}">{{ $product->brand->name }}</a>
                            @endif
                        </td>
                        <td>
                            @if($product->category)
                                <a href="{{route('admin.categories.show', $product->category)}}">{{ $product->category->name }}</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex justify-content-between">
            {{$products->links()}}
            <span class="align-self-center">views: {{$products->count()}}, total: {{$products->total()}}</span>
        </div>
    </div>

@endsection
@push('scripts')
    <script type="text/javascript" src="{{mix('js/apiSelect.js', 'build')}}"></script>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            new APISelect("#brand", "{{route('ajax.brands')}}");
            new APISelect("#category", "{{route('ajax.categories')}}");
        });
    </script>
@endpush
