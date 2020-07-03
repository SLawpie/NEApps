@extends('layouts.auth')

@section('content')

<div class="auth-center">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-sm-12 col-md-5 col-lg-4 offset-lg-1">
                <div class="auth-title m-b-md">
                    <a href="{{ url('/') }}" class="text-decoration-none text-reset">
                        {{config('app.name')}}
                    </a>
                </div>
            </div>
            <div class="col-md-1 d-none d-md-block">   
                <div class="auth-border-login"></div>
            </div>
            <div class="col-sm-12 col-xs-12 col-md-5 col-lg-4 ml-4">
                
                <div class="h3 text-center mb-4">{{ __('auth.login.login') }}</div>
                
                @if($errors->any())
                    <div class="alert alert-danger text-center" role="alert">
                        <strong>{{ implode('', $errors->all(':message')) }}</strong>
                    </div>
                @endif


                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">

                        <label class="mb-1 h5" for="username">{{ __('auth.username-email.label') }}</label>
                        <input id="username" type="username" 
                                    class="bg-dark text-white-50 form-control py-4 @error('username') is-invalid @enderror" 
                                    name="username" value="{{ old('username') }}" 
                                    required autofocus 
                                    placeholder="{{ __('auth.username-email.enter') }}">

                        {{-- @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror --}}
                    </div>

                    <div class="form-group">
                        <label class="mt-3 mb-1 h5" for="password">{{ __('auth.password.password') }}</label>
                        <input id="password" type="password" 
                            class="bg-dark text-white-50 form-control py-4 @error('username') is-invalid @enderror" 
                            name="password"
                            required autocomplete="current-password"
                            placeholder="{{ __('auth.password.enter') }}">

                        {{-- @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror --}}
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
