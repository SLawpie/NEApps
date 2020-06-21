@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card shadow-lg border-0 rounted-sm mt-5">
                <div class="card-header bg-secondary text-white-50">
                    <h3 class="text-center my-2">{{ __('auth.register.create') }}</h3>
                </div>
                <div class="card-body bg-dark text-white-50">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-row">
                            <div class="col-md">
           
                                <div class="form-group">
                                    <label class="small mb-1" for="name">
                                        {{ __('auth.register.name') }}
                                    </label>
                                    <input id="name" type="text" 
                                        name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                                        class="bg-dark text-white-50 form-control py-4 @error('name') is-invalid @enderror" 
                                        placeholder=" {{ __('auth.register.enter.name') }}"
                                        >

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="small mb-1" for="email">
                                        {{ __('auth.email.address') }}
                                    </label>
                                    <input id="email" type="text" 
                                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                        class="bg-dark text-white-50 form-control py-4 @error('email') is-invalid @enderror" 
                                        placeholder=" {{ __('auth.email.enter') }}"
                                        >

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="small mb-1" for="password">
                                                {{ __('auth.password.password') }}
                                            </label>
                                            <input id="password" type="password"
                                                name="password"
                                                class="bg-dark text-white-50 form-control py-4 @error('password') is-invalid @enderror"
                                                required autocomplete="new-password"
                                                placeholder="{{ __('auth.password.enter') }}"
                                                >

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="small mb-1" for="password-confirm">
                                                {{ __('auth.password.confirm') }}
                                            </label>
                                            
                                            <input class="bg-dark text-white-50 form-control py-4" 
                                                name="password_confirmation"
                                                id="password-confirm" type="password"
                                                required autocomplete="new-password" 
                                                placeholder="{{ __('auth.password.confirm') }}" />
  
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mt-4 mb-0">
                                    <button type="submit" class="btn btn-primary col-md">
                                        {{ __('auth.register.register') }}
                                    </button>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center bg-secondary text-white-50 p-1">
                    <div class="small">
                        <a href="{{ route('login') }}">
                            {{ __('auth.register.goto') }}
                        </a>
                    </div>
                </div>
            </div>
            {{-- <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div> --}}
        </div>
    </div>
</div>
@endsection
