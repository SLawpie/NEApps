@extends('layouts.app')

@section('content')

<h1 class="mt-4">
    {{ __('home.welcome') }} {{ Auth::user()->name }}
</h1>

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
