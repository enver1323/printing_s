@extends('layouts.admin')
@section('content')
    <div class="card shadow">
        <div class="card-header">
            <h4 class="text-primary">{{__('adminPanel.languageCreate')}}</h4>
        </div>
        <div class="card-body">
            <form action="{{route('admin.languages.store')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="col-form-label" for="code">{{__('adminPanel.code')}}</label>
                    <input name="code" class="form-control{{ $errors->has('code') ? ' is-invalid': '' }}" id="code"
                           value="{{ old('code') }}" required>
                    @if($errors->has('code'))
                        <span class="invalid-feedback"><strong>{{ $errors->first('code') }}</strong></span>
                    @endif
                </div>

                <div class="form-group">
                    <label class="col-form-label" for="name">{{__('adminPanel.name')}}</label>
                    <input name="name" class="form-control{{ $errors->has('name') ? ' is-invalid': '' }}" id="name"
                           value="{{ old('name') }}" required>
                    @if($errors->has('name'))
                        <span class="invalid-feedback"><strong>{{ $errors->first('name') }}</strong></span>
                    @endif
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">{{__('adminPanel.save')}}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
