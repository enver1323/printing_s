@extends('layouts.admin')
@section('content')
    <div class="card shadow">
        <div class="card-header">
            <div class="d-flex flex-row mb-4">
                <a href="{{ route('admin.products.data.keys.edit', $key) }}" class="btn btn-primary mr-1">
                    {{__('adminPanel.edit')}}
                </a>
                <form action="{{route('admin.products.data.keys.destroy', $key)}}" method="POST" class="mr-1">
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
                    <span>{{$key->id}}</span>
                </div>
            </div>
            <hr>
            @if($key->getTranslations('name')->count())
                <div class="row ml-1">
                    <div>
                        <div class="mb-4">
                            <strong>{{__('adminPanel.names')}}: </strong>
                        </div>
                        @foreach($key->getTranslations('name') as $language => $entry)
                            <div class="mb-4">
                                <span>{{ucfirst($language)}}  {{__('adminPanel.language')}}: </span>
                                <span>{{$entry}}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            <hr>
        </div>
    </div>
@endsection
