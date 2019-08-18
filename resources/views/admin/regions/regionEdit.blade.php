@extends('layouts.admin')
@section('content')
    <form action="{{route('admin.regions.update', $region)}}" method="POST">
        @method('PATCH')
        <div class="row">
            <div class="col-lg-6">
                @include('admin.translations.editEntriesList', [
                    'item' => $region,
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
                                <option value="{{ $region->country_id }}" selected="selected">
                                    {{$region->country->name}}
                                </option>
                            </select>
                            @if($errors->has('country_id'))
                                <span class="invalid-feedback"><strong>{{ $errors->first('country_id') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="parent">{{__('adminPanel.parent')}}</label>
                            <select name="parent_id" id="parent"
                                    class="form-control{{ $errors->has('parent_id') ? ' is-invalid': '' }}">
                                <option value="">{{__('adminPanel.choose')}}</option>
                                @isset($regin->parent_id)
                                    <option value="{{ $region->parent->id}}" selected>
                                        {{$region->parent->name}}
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
                                   value="{{$region->lat}}" required type="number" step="0.00001">
                            @if($errors->has('lat'))
                                <span class="invalid-feedback"><strong>{{ $errors->first('lat') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="lng">{{__('adminPanel.lng')}}</label>
                            <input name="lng" class="form-control{{ $errors->has('lng') ? ' is-invalid': '' }}" id="lng"
                                   value="{{$region->lng}}" type="number" step="0.00001" required>
                            @if($errors->has('lng'))
                                <span class="invalid-feedback"><strong>{{ $errors->first('lng') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">{{__('adminPanel.update')}}</button>
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
