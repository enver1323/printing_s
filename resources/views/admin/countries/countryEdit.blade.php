@extends('layouts.admin')
@section('content')
    <form action="{{route('admin.countries.update', $country)}}" method="POST">
        @method('PATCH')
        <div class="row">
            <div class="col-lg-6">
                @include('admin.translations.editEntriesList', [
                    'item' => $country,
                    'translatableField' => 'name',
                    'translatableFieldName' => __('adminPanel.name'),
                    'languages' => $languages
                ])
            </div>
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h4 class="text-primary">{{__('adminPanel.countryCreate')}}</h4>
                    </div>
                    <div class="card-body">+
                        <div class="form-group">
                            <label class="col-form-label" for="code">{{__('adminPanel.code')}}</label>
                            <input name="code" class="form-control{{ $errors->has('code') ? ' is-invalid': '' }}"
                                   id="code" maxlength="2" value="{{ $country->code }}">
                            @if($errors->has('code'))
                                <span class="invalid-feedback"><strong>{{ $errors->first('code') }}</strong></span>
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
                                   value="{{$country->lat}}" required type="number" step="0.00001">
                            @if($errors->has('lat'))
                                <span class="invalid-feedback"><strong>{{ $errors->first('lat') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="lng">{{__('adminPanel.lng')}}</label>
                            <input name="lng" class="form-control{{ $errors->has('lng') ? ' is-invalid': '' }}" id="lng"
                                   value="{{$country->lng}}" type="number" step="0.00001" required>
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
@endsection
