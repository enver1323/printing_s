@extends('layouts.admin')
@section('content')
    @if(!$product->options->isEmpty())
        <div class="row">
            <div class="col-lg-6">
                @endif
                <div class="card shadow">
                    <div class="card-header">
                        <div class="d-flex flex-row mb-4">
                            <a href="{{ route('admin.products.options.create', $product) }}" class="btn btn-success mr-1">
                                {{__('adminPanel.new') .' '. __('adminPanel.option')}}
                            </a>
                            <a href="{{ route('admin.products.data.values.show', $product) }}" class="btn btn-secondary mr-1">
                                {{__('adminPanel.dataValue')}}
                            </a>
                            <a href="{{route('admin.products.media.show', $product)}}" class="btn btn-secondary mr-1">
                                {{__('adminPanel.media')}}
                            </a>
                            <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-primary mr-1">
                                {{__('adminPanel.edit')}}
                            </a>
                            <form action="{{route('admin.products.destroy', $product)}}" method="POST" class="mr-1">
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
                                <span>{{$product->id}}</span>
                            </div>
                        </div>
                        <hr>
                        @if($product->getTranslations('name')->count())
                            <div class="row ml-1">
                                @isset($product->photo)
                                    <div class="image-resizable-container mr-3">
                                        <img src="{{$product->photo->getUrl()}}" class="img-thumbnail" alt="">
                                        <form action="{{route('admin.products.photo.delete', $product)}}"
                                              method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <input type="submit" class="btn btn-block btn-danger"
                                                   value="{{__('adminPanel.delete')}}">
                                        </form>
                                    </div>
                                @endisset
                                <div>
                                    <div class="mb-4">
                                        <strong>{{__('adminPanel.names')}}: </strong>
                                    </div>
                                    @foreach($product->getTranslations('name') as $language => $entry)
                                        <div class="mb-4">
                                            <span>{{ucfirst($language)}}  {{__('adminPanel.language')}}: </span>
                                            <span>{{$entry}}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        <hr>
                        <div>
                            <div class="mb-4">
                                <strong>{{__('adminPanel.description')}}: </strong>
                            </div>
                            @foreach($product->getTranslations('description') as $language => $entry)
                                <div class="mb-4">
                                    <span>{{ucfirst($language)}}  {{__('adminPanel.language')}}: </span>
                                    <span>{{$entry}}</span>
                                </div>
                            @endforeach
                        </div>
                        <div class="row mb-4">
                            <div class="col">
                                <strong>{{__('adminPanel.slug')}}: </strong>
                                <span>{{$product->slug}}</span>
                            </div>
                        </div>
                        <hr>
                        <div class="row mb-4">
                            <div class="col">
                                <strong>{{__('adminPanel.brand')}}:</strong>
                                <a href="{{route('admin.brands.show', $product->brand)}}"> {{$product->brand->name}}</a>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col">
                                <strong>{{__('adminPanel.category')}}:</strong>
                                <a href="{{route('admin.categories.show', $product->category)}}"> {{$product->category->name}}</a>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col">
                                <strong>{{__('adminPanel.line')}}:</strong>
                                <a href="{{route('admin.lines.show', $product->line)}}"> {{$product->line->name}}</a>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col">
                                <strong>{{__('adminPanel.author')}}:</strong>
                                <a href="{{route('admin.users.show', $product->author)}}"> {{$product->author->name}}</a>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
                @if(!$product->options->isEmpty())
            </div>
            <div class="col-lg-6">
                <div class="card shadow">
                    <div class="card-header">
                        <h4 class="text-primary">{{Str::plural(__('adminPanel.option'))}}</h4>
                    </div>
                    <div class="card-body">
                        @include('admin.products.options.productOptionTable', ['options' => $product->options])
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
