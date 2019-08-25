@extends('layouts.admin')
@section('content')
    <form action="{{route('admin.users.store')}}" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-6">
                <div class="card shadow">
                    <div class="card-header">
                        <h4 class="text-primary">{{__('adminPanel.userCreate')}}</h4>
                    </div>
                    <div class="card-body">
                        @csrf
                        <div class="form-group">
                            <label class="col-form-label" for="name">{{__('adminPanel.name')}}</label>
                            <input name="name" class="form-control{{ $errors->has('name') ? ' is-invalid': '' }}"
                                   id="name"
                                   value="{{ old('name') }}" required>
                            @if($errors->has('name'))
                                <span class="invalid-feedback"><strong>{{ $errors->first('name') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="email">{{__('adminPanel.email')}}</label>
                            <input name="email" type="email" id="email"
                                   class="form-control{{ $errors->has('name') ? ' is-invalid': '' }}"
                                   value="{{ old('email') }}" required>
                            @if($errors->has('email'))
                                <span class="invalid-feedback"><strong>{{ $errors->first('email') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="password">{{__('adminPanel.password')}}</label>
                            <input name="password" type="password" id="password"
                                   class="form-control{{ $errors->has('password') ? ' is-invalid': '' }}"
                                   value="{{ old('password') }}" required>
                            @if($errors->has('password'))
                                <span class="invalid-feedback"><strong>{{ $errors->first('password') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="password_confirmation">{{__('adminPanel.passwordConfirm')}}</label>
                            <input name="password_confirmation" type="password" id="password_confirmation"
                                   class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid': '' }}"
                                   value="{{ old('password_confirmation') }}" required>
                            @if($errors->has('password_confirmation'))
                                <span class="invalid-feedback"><strong>{{ $errors->first('password_confirmation') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="role">{{__('adminPanel.role')}}</label>
                            <select name="role" type="text" id="role" required
                                   class="form-control{{ $errors->has('name') ? ' is-invalid': '' }}">
                                @foreach($roles as $role)
                                    <option value="{{$role}}">
                                        {{ucfirst($role)}}
                                    </option>
                                @endforeach
                            </select>
                            @if($errors->has('role'))
                                <span class="invalid-feedback"><strong>{{ $errors->first('role') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="status">{{__('adminPanel.status')}}</label>
                            <select name="status" type="text" id="status" required
                                   class="form-control{{ $errors->has('status') ? ' is-invalid': '' }}">
                                @foreach($statuses as $status)
                                    <option value="{{$status}}">
                                        {{ucfirst($status)}}
                                    </option>
                                @endforeach
                            </select>
                            @if($errors->has('status'))
                                <span class="invalid-feedback"><strong>{{ $errors->first('status') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">{{__('adminPanel.save')}}</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                @include('admin.profiles.profileCreate')
            </div>
        </div>
    </form>
@endsection

@section('scripts')
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {
            jQuery("#birthDate").datepicker({
                dateFormat: "yy-mm-dd"
            });
        });
    </script>
@endsection
