@extends('layouts.app')

@section('header')
    <!-- Poster -->
    <div class="poster poster-full poster-signup">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-6 col-md-10 col-sm-12">
                    <div class="card card-signup">
                        <h4 class="card-header">
                            <strong>{{__('auth.sign_up')}}</strong>
                        </h4>

                        <!--Card content-->
                        <div class="card-body px-lg-5 pt-0">
                            <!-- Form -->
                            <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <!-- Name -->
                                <div class="md-form">
                                    <input type="text" id="name" name="name" value="{{old('name')}}" required
                                           class="form-control form-control @error('name') is-invalid @enderror"/>
                                    <label for="name">{{__('frontend.name')}}</label>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="md-form">
                                    <input type="email" id="email" name="email" value="{{old('email')}}" required
                                           class="form-control form-control @error('name') is-invalid @enderror"/>
                                    <label for="email">{{__('validation.email')}}</label>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <!-- Password -->
                                <div class="md-form">
                                    <input type="password" id="password" name="password" value="{{old('password')}}" required
                                           class="form-control form-control @error('password') is-invalid @enderror"/>
                                    <label for="password">{{__('passwords.password')}}</label>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <!-- Confirm Password -->
                                <div class="md-form">
                                    <input type="password" id="confirm-password" name="password_confirmation"
                                           class="form-control" required/>
                                    <label for="confirm-password">{{__('adminPanel.passwordConfirm')}}</label>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <!-- Sign up button -->
                                <button class="btn btn-outline-primary btn-rounded btn-block" type="submit">
                                    {{__('auth.sign_up')}}
                                </button>
                            </form>
                            <!-- Form -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Poster -->
@endsection
