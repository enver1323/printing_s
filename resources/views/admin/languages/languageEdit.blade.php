@extends('layouts.admin')
@section('content')
    <div class="card shadow">
        <div class="card-body">
            <form action="{{route('admin.languages.update', $language)}}" method="POST">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label class="col-form-label" for="name">{{__('adminPanel.name')}}</label>
                    <input name="name" class="form-control{{ $errors->has('name') ? ' is-invalid': '' }}" id="name"
                           value="{{ old('name', $language->name) }}" required>
                    @if($errors->has('name'))
                        <span class="invalid-feedback"><strong>{{ $errors->first('name') }}</strong></span>
                    @endif
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">{{__('adminPanel.update')}}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
