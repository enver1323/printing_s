@extends('layouts.admin')
@section('content')
    <div class="card shadow">
        <div class="card-header">
            <div class="d-flex flex-row mb-4">
                <a href="{{ route('admin.products.options.edit', $option) }}" class="btn btn-primary mr-1">
                    {{__('adminPanel.edit')}}
                </a>
                <form action="{{route('admin.products.options.destroy', $option)}}" method="POST" class="mr-1">
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
                    <span>{{$option->id}}</span>
                </div>
            </div>
            <hr>
            @if($option->getTranslations('name')->count())
                <div class="row ml-1">
                    <div>
                        <div class="mb-4">
                            <strong>{{__('adminPanel.names')}}: </strong>
                        </div>
                        @foreach($option->getTranslations('name') as $language => $entry)
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
                @foreach($option->getTranslations('description') as $language => $entry)
                    <div class="mb-4">
                        <span>{{ucfirst($language)}}  {{__('adminPanel.language')}}: </span>
                        <span>{{$entry}}</span>
                    </div>
                @endforeach
            </div>
            <hr>
            <div class="row mb-4">
                <div class="col">
                    <strong>{{__('adminPanel.product')}}:</strong>
                    <a href="{{route('admin.products.options.show', $option->product_id)}}"> {{$option->product->name}}</a>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <strong>{{__('adminPanel.author')}}:</strong>
                    <a href="{{route('admin.users.show', $option->author)}}"> {{$option->author->name}}</a>
                </div>
            </div>
            <hr>
        </div>
    </div>
@endsection
