@extends('layouts.admin')
@section('content')
    @if(!$category->descendants->isEmpty())
        <div class="row">
            <div class="col-lg-6">
                @endif
                <div class="card shadow">
                    <div class="card-header">
                        <div class="d-flex flex-row mb-4">
                            <a href="{{ route('admin.categories.create', $category) }}" class="btn btn-success mr-1">
                                {{__('adminPanel.new') .' '. __('adminPanel.category')}}
                            </a>
                            <a href="{{ route('admin.products.data.keys.create', $category) }}" class="btn btn-outline-success mr-1">
                                {{__('adminPanel.new') .' '. __('adminPanel.dataKey')}}
                            </a>
                            <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-primary mr-1">
                                {{__('adminPanel.edit')}}
                            </a>
                            <form action="{{route('admin.categories.destroy', $category)}}" method="POST" class="mr-1">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger">{{__('adminPanel.delete')}}</button>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col">
                                <strong>{{__('adminPanel.id')}}: </strong>
                                <span>{{$category->id}}</span>
                            </div>
                        </div>
                        <hr>
                        @if($category->getTranslations('name')->count())
                            <div class="row ml-1">
                                <div class="">
                                    <div class="mb-4">
                                        <strong>{{__('adminPanel.names')}}: </strong>
                                    </div>
                                    @foreach($category->getTranslations('name') as $language => $entry)
                                        <div class="mb-4">
                                            <span>{{ucfirst($language)}}  {{__('adminPanel.language')}}: </span>
                                            <span>{{$entry}}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        <hr>
                        <div class="row mb-4">
                            <div class="col">
                                <strong>{{__('adminPanel.slug')}}: </strong>
                                <span>{{$category->slug}}</span>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
                @if(!$category->descendants->isEmpty())
            </div>
            <div class="col-lg-6">
                <div class="card shadow">
                    <div class="card-header">
                        <h4 class="text-primary">{{Str::plural(__('adminPanel.category'))}}</h4>
                    </div>
                    <div class="card-body">
                        @include('admin.categories._categoryTable', ['categories' => $descendants])
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
