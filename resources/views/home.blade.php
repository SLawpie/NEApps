@extends('layouts.app')

@section('application-module-name')
    <div class="text-white mb-0 ">
        
    </div>
@endsection

@section('content')

<h1 class="mt-0">
    {{ __('home.welcome') }}!
</h1>

<div>

</div>

{{-- <div class="container"> --}}
    {{-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-secondary text-light">Dashboard</div>

                <div class="card-body bg-dark text-light">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div> --}}
{{-- </div> --}}
@endsection
