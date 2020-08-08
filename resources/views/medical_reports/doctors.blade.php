@extends('layouts.app')

@section('application-module-name')
    <div class="d-flex flex-row font-weight-light">
        <a class="text-decoration-none" href="{{ route('medical_reports.index') }}">
        <div class="text-white-50 mb-0 ">
            {{ __('medical_reports.reports') }}
            &nbsp;/&nbsp;
        </div>
        </a>
        <div class="text-light mb-0 ml-1">
            Raport wg. lekarza
        </div>
    </div>

@endsection

@section('content')
    <div class="row justify-content-start mt-3 ml-1">
        <div class="h4 mb-0 mr-2 font-weight-light">
            {{ __('medical_reports.file') }}
        </div>
        <div class="h4 text-light mb-0 ml-1 font-weight-light">
            {{ $file}}
        </div>
    </div>

    <h2 class="mt-5 ml-1 font-weight-light"> {{ __('medical_reports.doctors') }} </h2>

    <div class="row justify-content-start">
        
        @foreach ($sheetNames as $i => $sheetName)
        <div class="card text-white text-center bg-transparent mb-3 mr-0" style="width: 16rem;">
            <div class="card-body my-0">
                @php
                    $string = $i . '-' . $sheetName;                
                @endphp
                <a href="{{ route('medical_reports.import.sheet', Crypt::encryptString($string)) }}" 
                    class="btn btn-primary" style="width: 14rem">
                    {{ $sheetName }}
                </a>
            </div>
          </div>

        @endforeach
    </div>

    @endsection
