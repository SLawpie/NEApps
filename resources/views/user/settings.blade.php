@extends('layouts.app')

@section('application-module-name')
    <div class="text-white mb-0 ">
        Ustawienia profilu oraz aplikacji
    </div>
@endsection

@section('content')

    @can('plasma-costs')
        <div class="">
            <div class="h3 mb-3 text-info ml-4">Koszt palenia</div>
            <div class="row justify-content-start mx-4">   
                <div class="col-md-6 col-lg-4 col-xl-2 mb-3">
                    <a href="{{ route('plasma-costs.settings') }}" 
                            class="btn btn-primary btn-block">
                        Ceny i parametry
                    </a>
                </div>
            </div>
        </div>
    @endcan

    <div class="mt-4">
        <div class="h3 mb-3 text-info ml-4">Bezpieczeństwo</div>
            <div class="row justify-content-start mx-4">
                <div class="col-md-6 col-lg-4 col-xl-2 text-nowrap mb-3">
                    <a href="{{ route('password.change.form') }}" 
                            class="btn btn-primary btn-block">
                        Zmiana hasła
                    </a>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-2 mb-3">
                    <a href="{{ route('user.history') }}" 
                            class="btn btn-primary btn-block text-nowrap">
                        Historia logowań
                    </a>
                </div>
            </div>
        </div>
        {{-- </div> --}}
    </div>

@endsection