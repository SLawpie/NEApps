@extends('layouts.app')

@section('application-module-name')
    <div class="text-white mb-0 ">
        Ustawienia profilu
    </div>
@endsection

@section('content')

    <div class="h3 mb-3 text-info ml-4">Bezpieczeństwo</div>
        <div class="card text-white text-center bg-transparent mb-3 mr-0"  style="width: 16rem;">    
            <div class="card-body my-0">
                <a href="{{ route('password.change.form') }}" 
                        class="btn btn-primary" style="width: 14rem">
                    Zmiana hasła
                </a>
            </div>
        </div>
    </div>

@endsection