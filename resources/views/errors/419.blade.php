@extends('layouts.error')

@section('content')

<div class="auth-center">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-sm-12 col-md-5 col-lg-4 offset-lg-1 mr-4">
                <div class="auth-title m-b-md">
                    <a href="{{ url('/') }}" class="text-decoration-none text-reset">
                        {{config('app.name')}}
                    </a>
                </div>
            </div>
            <div class="col-md-1 d-none d-md-block">   
                <div class="auth-border-login mr-4 "></div>
            </div>
            <div class="col-sm-12 col-xs-12 col-md-5 col-lg-4">
                
                <div class="auth-title text-center mb-4">419</div>

                <div class="h3 text-center">
                    Twoja sesja wygasła.
                </div>
                <a href="{{ url('/') }}" class="btn mt-5 auth-btn btn-primary btn-block">
                    Strona startowa
                </a>
        </div>
        </div>
    </div>
</div>
@endsection
