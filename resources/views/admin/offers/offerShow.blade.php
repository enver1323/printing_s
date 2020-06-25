@extends('layouts.admin')
@section('content')
    <div class="card shadow">
        <div class="card-header">
            <div class="d-flex flex-row mb-4">
                <a href="{{ route('admin.offers.edit', $offer) }}" class="btn btn-primary mr-1">
                    {{__('adminPanel.edit')}}
                </a>
                <form action="{{route('admin.offers.destroy', $offer)}}" method="POST" class="mr-1">
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
                    <span>{{$offer->id}}</span>
                </div>
            </div>
            <hr>
            <div class="row ml-1">
                @isset($offer->photo)
                    <div class="image-resizable-container mr-3">
                        <img src="{{$offer->photo->getUrl()}}" class="img-thumbnail" alt="">
                    </div>
                @endisset
                <div>
                    <div class="mb-4">
                        <strong>{{__('adminPanel.names')}}: </strong>
                    </div>
                    @foreach($offer->getTranslations('name') as $language => $entry)
                        <div class="mb-4">
                            <span>{{ucfirst($language)}}  {{__('adminPanel.language')}}: </span>
                            <span>{{$entry}}</span>
                        </div>
                    @endforeach
                </div>
            </div>
            <hr>
            <div>
                <div class="mb-4">
                    <strong>{{__('adminPanel.description')}}: </strong>
                </div>
                @foreach($offer->getTranslations('description') as $language => $entry)
                    <div class="mb-4">
                        <span>{{ucfirst($language)}}  {{__('adminPanel.language')}}: </span>
                        <span>{{$entry}}</span>
                    </div>
                @endforeach
            </div>
            <div class="row mb-4">
                <div class="col">
                    <strong>{{__('adminPanel.slug')}}: </strong>
                    <span>{{$offer->slug}}</span>
                </div>
            </div>
            <hr>
        </div>
    </div>
@endsection
