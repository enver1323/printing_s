@extends('layouts.admin')
@section('content')
    @if(!$country->regions->isEmpty())
        <div class="row">
            <div class="col-lg-6">
                @endif
                <div class="card shadow">
                    <div class="card-header">
                        <div class="d-flex flex-row mb-4">
                            <a href="{{ route('admin.regions.create', $country) }}" class="btn btn-success mr-1">
                                {{__('adminPanel.new') .' '. __('adminPanel.region')}}
                            </a>
                            <a href="{{ route('admin.countries.edit', $country) }}" class="btn btn-primary mr-1">
                                {{__('adminPanel.edit')}}
                            </a>
                            <form action="{{route('admin.countries.destroy', $country)}}" method="POST" class="mr-1">
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
                                <span>{{$country->id}}</span>
                            </div>
                        </div>
                        <hr>
                        @if($country->getTranslations('name')->count())
                            <div class="row ml-1">
                                @isset($country->photo)
                                    <div class="image-resizable-container mr-3">
                                        <img src="{{$country->photo->getUrl()}}" class="img-thumbnail" alt="">
                                        <form action="{{route('admin.countries.photo.delete', $country)}}"
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
                                    @foreach($country->getTranslations('name') as $language => $entry)
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
                                <span>{{$country->slug}}</span>
                            </div>
                        </div>
                        <hr>
                        <div class="row mb-4">
                            <div class="col">
                                <strong>{{__('adminPanel.location')}}: </strong>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col">
                                <span>{{__('adminPanel.lat')}}: {{$country->lat}}</span>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col">
                                <span>{{__('adminPanel.lng')}}: {{$country->lng}}</span>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
                @if(!$country->regions->isEmpty())
            </div>
            <div class="col-lg-6">
                <div class="card shadow">
                    <div class="card-header">
                        <h4 class="text-primary">{{Str::plural(__('adminPanel.region'))}}</h4>
                    </div>
                    <div class="card-body">
                        @include('admin.regions.regionList', ['regions' => $country->regions])
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
