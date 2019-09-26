@extends('layouts.admin')
@section('content')
    <div class="card shadow">
        <div class="card-header">
            <div class="d-flex flex-row mb-4">
                <a href="{{ route('admin.brands.edit', $brand) }}" class="btn btn-primary mr-1">
                    {{__('adminPanel.edit')}}
                </a>
                <form action="{{route('admin.brands.destroy', $brand)}}" method="POST" class="mr-1">
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
                    <span>{{$brand->id}}</span>
                </div>
            </div>
            <hr>
            <div class="row ml-1">
                @isset($brand->photo)
                    <div class="image-resizable-container mr-3">
                        <img src="{{$brand->photo->getUrl()}}" class="img-thumbnail" alt="">
                        <form action="{{route('admin.brands.photo.delete', $brand)}}"
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
                    @foreach($brand->getTranslations('name') as $language => $entry)
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
                @foreach($brand->getTranslations('description') as $language => $entry)
                    <div class="mb-4">
                        <span>{{ucfirst($language)}}  {{__('adminPanel.language')}}: </span>
                        <span>{{$entry}}</span>
                    </div>
                @endforeach
            </div>
            <div class="row mb-4">
                <div class="col">
                    <strong>{{__('adminPanel.slug')}}: </strong>
                    <span>{{$brand->slug}}</span>
                </div>
            </div>
            <hr>
        </div>
    </div>
@endsection
