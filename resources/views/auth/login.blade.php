@extends('layouts.auth')

@section('content')

<div class="auth-center">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-sm-12 col-md-5 col-lg-4 offset-lg-1">
                <div class="auth-title m-b-md">
                    {{config('app.name')}}
                </div>
            </div>
            <div class="col-md-1 d-none d-md-block">   
                <div class="auth-border-login"></div>
            </div>
            <div class="col-sm-12 col-xs-12 col-md-5 col-lg-4 ml-4">

                <div class="h3 text-center mb-4">{{ __('auth.login.login') }}</div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <label class="mb-1 h5" for="email">{{ __('auth.email.address') }}</label>
                    <input id="email" type="email" 
                                class="bg-dark text-white-50 form-control py-4 @error('email') is-invalid @enderror" 
                                name="email" value="{{ old('email') }}" 
                                required autocomplete="email" autofocus 
                                placeholder="{{ __('auth.email.enter') }}">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                     @enderror

                     <div class="form-group">
                        <label class="mt-4 mb-1 h5" for="password">{{ __('auth.password.password') }}</label>
                        <input id="password" type="password" 
                            class="bg-dark text-white-50 form-control py-4" 
                            name="password"
                            required autocomplete="current-password"
                            placeholder="{{ __('auth.password.enter') }}">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong> aaa {{ $message }}</strong>
                            </span>
                        @enderror
                    </div>    

                    <button type="submit" class="mt-4 auth-btn btn-primary btn-block">
                        {{ __('auth.login.button') }}
                    </button>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
