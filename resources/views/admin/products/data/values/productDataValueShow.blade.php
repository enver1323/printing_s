<?php

use App\Domain\Product\Entities\Product;
use App\Domain\Product\Entities\ProductOption;

/** @var  Product|ProductOption $item */
$route = is_a($item, Product::class) ? route('admin.products.data.values.update', $item) : route('admin.products.options.data.values.update', $item)
?>
@extends('layouts.admin')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header">
            <h4 class="text-primary">{{ucfirst($item->name)}}</h4>
        </div>
        <div class="card-body">
            <form action="{{$route}}" method="post">
                @csrf
                <div id="container">
                </div>
                <div class="d-flex">
                    <input type="submit" class="btn btn-primary ml-auto" value="{{__('adminPanel.save')}}">
                </div>
            </form>
            <div class="row">
                <div class="col-12">
                    <span class="mr-3">{{__('adminPanel.addDataKey')}}</span>
                    <a href="{{route('admin.products.data.keys.create')}}" target="_blank">
                        <button class="btn btn-secondary">
                            {{__('adminPanel.add')}}
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{mix('js/dataValueList.js', 'build')}}"></script>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function (event) {
            let list = new DataValueList('values', 'container', "{{route('ajax.data.keys')}}", @json(config('laravellocalization.supportedLocales'), JSON_UNESCAPED_UNICODE));
            list.setEntries(@json($values))
        })
    </script>
@endpush
