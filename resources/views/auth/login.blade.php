@extends('layouts.app')
@section('header')
    <!-- Poster -->
    <div class="poster poster-full poster-signin">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-6 col-md-10 col-sm-12">
                    <div class="card card-signin">
                        <h4 class="card-header">
                            <strong>Sign in</strong>
                        </h4>
                        <!--Card content-->
                        <div class="card-body px-lg-5 pt-0">
                            <!-- Form -->
                            <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <!-- Name -->
                                <div class="md-form">
                                    <i class="fa fa-user prefix d-flex"></i>
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <label for="name">{{ __('validation.attributes.email') }}</label>
                                </div>

                                <!-- Password -->
                                <div class="md-form">
                                    <i class="fa fa-lock prefix d-flex"></i>

                                    <input id="password" type="password" required autocomplete="current-password"
                                           class="form-control @error('password') is-invalid @enderror" name="password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <label for="password">{{ __('validation.attributes.password') }}</label>
                                </div>

                                <div class="d-flex justify-content-around">
                                    <div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember"
                                                   id="check-remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="check-remember">
                                                {{ __('validation.attributes.remember_me') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Sign in button -->
                                <button class="btn btn-outline-primary btn-rounded btn-block" type="submit">
                                    {{ __('auth.sign_in') }}
                                </button>

                                <!-- Register -->
                                <p>
                                    Not a member?
                                    <a href="{{route('register')}}">{{__('auth.sign_up')}}</a>
                                </p>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}">
                                        {{ __('validation.attributes.forgot') }}
                                    </a>
                                @endif
                            </form>
                            <!-- /Form -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
