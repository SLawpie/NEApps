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
            <div class="card text-white text-center bg-transparent border-0 mb-3 mr-0 col-2" >    
                <div class="card-body my-0">
                    <a href="{{ route('plasma-costs.settings') }}" 
                            class="btn btn-primary" style="width: 14rem">
                        Ceny i parametry
                    </a>
                </div>
            </div>
        </div>
    @endcan

    <div class="">
        <div class="h3 mb-3 text-info ml-4">Bezpieczeństwo</div>
        <div class="card text-white text-center bg-transparent border-0 mb-3 mr-0 float-left col-2">    
            <div class="card-body my-0">
                <a href="{{ route('password.change.form') }}" 
                        class="btn btn-primary" style="width: 14rem">
                    Zmiana hasła
                </a>
            </div>
        </div>
        <div class="card text-white text-center bg-transparent border-0 mb-3 mr-0 float-left col-2">    
            <div class="card-body my-0">
                <a href="{{ route('user.history') }}" 
                        class="btn btn-primary" style="width: 14rem">
                    Historia logowań
                </a>
            </div>
        </div>
    </div>

@endsection