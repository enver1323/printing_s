@extends('layouts.admin')
@section('content')
    <form action="{{route('admin.products.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-6">
                @include('admin.translations.addEntriesSelect', [
                    'translatableField' => 'name',
                    'translatableFieldName' => __('adminPanel.name'),
                    'languages' => $languages,
                ])
            </div>
            <div class="col-lg-6">
                @include('admin.translations.addEntriesSelect', [
                    'translatableField' => 'description',
                    'translatableFieldName' => __('adminPanel.description'),
                    'languages' => $languages,
                    'inputType' => 'textarea'
                ])
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
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h4 class="text-primary">{{__('adminPanel.productCreate')}}</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="col-form-label" for="photo">{{__('adminPanel.photo')}}</label>
                            <input name="photo" type="file" id="photo" value="{{ old('photo') }}" accept="image/*"
                                   class="form-control-file{{ $errors->has('photo') ? ' is-invalid': '' }}">
                            @if($errors->has('photo'))
                                <span class="invalid-feedback"><strong>{{ $errors->first('photo') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="category">{{__('adminPanel.category')}}</label>
                            <select name="category_id" id="category" required
                                    class="form-control{{ $errors->has('category_id') ? ' is-invalid': '' }}">
                                <option value="">{{__('adminPanel.choose')}}</option>
                            </select>
                            @if($errors->has('category_id'))
                                <span
                                    class="invalid-feedback"><strong>{{ $errors->first('category_id') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="brand">{{__('adminPanel.brand')}}</label>
                            <select name="brand_id" id="brand" required
                                    class="form-control{{ $errors->has('category_id') ? ' is-invalid': '' }}">
                                <option value="">{{__('adminPanel.choose')}}</option>
                            </select>
                            @if($errors->has('brand_id'))
                                <span class="invalid-feedback"><strong>{{ $errors->first('brand_id') }}</strong></span>
                            @endif
                        </div>
                        <input type="submit" value="{{__('adminPanel.save')}}" class="btn btn-primary">
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
            new APISelect("#category", "{{route('ajax.categories')}}");
            new APISelect("#brand", "{{route('ajax.brands')}}");
            $("#icon").iconpicker();
        });
    </script>
@endsection
