@extends('layouts.admin')
@section('content')
    @if(!$region->children->isEmpty())
        <div class="row">
            <div class="col-lg-6">
                @endif
                <div class="card shadow">
                    <div class="card-header">
                        <div class="d-flex flex-row mb-4">
                            <a href="{{ route('admin.regions.create', [$region->country, $region]) }}" class="btn btn-success mr-1">
                                {{__('adminPanel.new') .' '. __('adminPanel.region')}}
                            </a>
                            <a href="{{ route('admin.regions.edit', $region) }}" class="btn btn-primary mr-1">
                                {{__('adminPanel.edit')}}
                            </a>
                            <form action="{{route('admin.regions.destroy', $region)}}" method="POST" class="mr-1">
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
                                <span>{{$region->id}}</span>
                            </div>
                        </div>
                        <hr>
                        @if($region->getTranslations('name')->count())
                            <div class="row ml-1">
                                <div>
                                    <div class="mb-4">
                                        <strong>{{__('adminPanel.names')}}: </strong>
                                    </div>
                                    @foreach($region->getTranslations('name') as $language => $entry)
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
                                <span>{{$region->slug}}</span>
                            </div>
                        </div>
                        @isset($region->parent)
                            <div class="row mb-4">
                                <div class="col">
                                    <strong>{{__('adminPanel.parent')}}: </strong>
                                    <a href="{{route('admin.regions.show', $region->parent)}}">
                                        <span>{{$region->parent->name}}</span>
                                    </a>
                                </div>
                            </div>
                        @endisset
                        @isset($region->parent)
                            <div class="row mb-4">
                                <div class="col">
                                    <strong>{{__('adminPanel.country')}}: </strong>
                                    <a href="{{route('admin.countries.show', $region->country)}}">
                                        <span>{{$region->country->name}}</span>
                                    </a>
                                </div>
                            </div>
                        @endisset
                        <hr>
                        <div class="row mb-4">
                            <div class="col">
                                <strong>{{__('adminPanel.location')}}: </strong>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col">
                                <span>{{__('adminPanel.lat')}}: {{$region->lat}}</span>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col">
                                <span>{{__('adminPanel.lng')}}: {{$region->lng}}</span>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
                @if(!$region->children->isEmpty())
            </div>
            <div class="col-lg-6">
                <div class="card shadow">
                    <div class="card-header">
                        <h4 class="text-primary">{{Str::plural(__('adminPanel.region'))}}</h4>
                    </div>
                    <div class="card-body">
                        @include('admin.regions.regionTable', ['regions' => $region->children])
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
