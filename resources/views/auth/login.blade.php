@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card shadow-lg border-0 rounted-sm mt-5">
                <div class="card-header bg-secondary text-white-50">
                    <h3 class="text-center my-2">{{ __('auth.login.login') }}</h3>
                </div>
                <div class="card-body bg-dark text-white-50">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            <label class="small mb-1" for="email">{{ __('auth.email.address') }}</label>
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
                        </div>

                        <div class="form-group">
                            <label class="small mb-1" for="password">{{ __('auth.password.password') }}</label>
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

                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <div class="form-check p-0">
                                    <input class="form-check-input" name="remember" id="remember" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                                    
                                    <label class="form-check-label" for="remember">
                                        {{ __('auth.remember') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                            @if (Route::has('password.request'))
                                <a class="small" href="{{ route('password.request') }}">
                                    {{ __('auth.password.forgot') }}
                                </a>
                            @else
                                &nbsp;
                            @endif
                            
                            <button type="submit" class="btn btn-primary col-6">
                                {{ __('auth.login.button') }}
                            </button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center bg-secondary text-white-50 p-1">
                    <div class="small">
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">
                                {{ __('auth.login.need') }}
                            </a>
                        @else 
                            &nbsp;
                        @endif
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
