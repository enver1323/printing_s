@extends('layouts.admin')
@section('content')
    <form action="{{route('admin.regions.store')}}" method="POST">
        @csrf
        <div class="row">
            <div class="col-lg-6">
                @include('admin.translations.addEntriesSelect', [
                    'translatableField' => 'name',
                    'translatableFieldName' => __('adminPanel.name'),
                    'languages' => $languages
                ])
            </div>
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h4 class="text-primary">{{__('adminPanel.regionCreate')}}</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="col-form-label" for="country">{{__('adminPanel.country')}}</label>
                            <select name="country_id" id="country" required
                                    class="form-control{{ $errors->has('country_id') ? ' is-invalid': '' }}">
                                <option value="{{ $country->id }}" selected="selected">{{$country->name}}</option>
                            </select>
                            @if($errors->has('country_id'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('country_id') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="parent">{{__('adminPanel.parent')}}</label>
                            <select name="parent_id" id="parent"
                                    class="form-control{{ $errors->has('parent_id') ? ' is-invalid': '' }}">
                                <option value="">{{__('adminPanel.choose')}}</option>
                                @isset($region)
                                    <option value="{{ $region->id}}" selected>
                                        {{$region->name}}
                                    </option>
                                @endisset
                            </select>
                            @if($errors->has('parent_id'))
                                <span class="invalid-feedback"><strong>{{ $errors->first('parent_id') }}</strong></span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h4 class="text-primary">{{__('adminPanel.location')}}</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="col-form-label" for="lat">{{__('adminPanel.lat')}}</label>
                            <input name="lat" class="form-control{{ $errors->has('lat') ? ' is-invalid': '' }}" id="lat"
                                   value="{{ old('lat') }}" required>
                            @if($errors->has('lat'))
                                <span class="invalid-feedback"><strong>{{ $errors->first('lat') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="lng">{{__('adminPanel.lng')}}</label>
                            <input name="lng" class="form-control{{ $errors->has('lng') ? ' is-invalid': '' }}" id="lng"
                                   value="{{ old('lng') }}" required>
                            @if($errors->has('lng'))
                                <span class="invalid-feedback"><strong>{{ $errors->first('lng') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">{{__('adminPanel.save')}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{asset('js/admin/addEntries.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/admin/apiSelect.js')}}"></script>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            new APISelect("#country", "{{route('ajax.countries')}}");
            new APISelect("#parent", "{{route('ajax.regions')}}");
        });
    </script>
@endsection
