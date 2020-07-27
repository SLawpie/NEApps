@extends('layouts.app')

@section('application-module-name')
    <div class="d-flex flex-row font-weight-light">
        <a class="text-decoration-none" href="{{ route('medical_reports.index') }}">
            <div class="text-white-50 mb-0 ">
                {{ __('medical_reports.reports') }}
                &nbsp;/&nbsp;
            </div>
        </a>
        <a class="text-decoration-none" href="{{ route('medical_reports.import.file') }}">
            <div class="text-white-50 mb-0 ml-1">
                Raport wg. lekarza
                &nbsp;/&nbsp;
            </div>
        </a>
        <div class="text-light mb-0 ml-1">
            Badania USG
        </div>
    </div>
@endsection

@section('content')

    <div class="ne-second-navbar">
        <div class="d-flex flex-row mt-3">
            <div class="h3 font-weight-light mr-3">
                Lekarz:
            </div>
            <div class="h3 font-weight-light text-light">
                {{ $doctorName}}
            </div>
            <div class="h3 font-weight-light mx-3">
                Ilość badań:
            </div>
            <div class="h3 font-weight-light text-light">
                {{ $count}}
            </div>
        </div>
    </div>
<div class="ne-main-2 ne-overflow-y">
    <div class="bg-white text-dark p-2 user-select-all">
        <samp>
            <strong><b>
            Kędziezyn-Koźle, 
            @php
                echo(date('d.m.yy').'r.')
            @endphp
            <br><br>
            {{ $doctorName}}
            <br>
            </strong></b>
            Ilość badań USG:
            <strong><b>
            {{ $count}}
            <br><br>
            </strong></b>
            @foreach ($examinations as $key=>$examination)
                @if ($report[$examination->name]['All'] > 0)
                    <strong><b>{{ $report[$examination->name]['All'] }} x {{ $examination->name }}</b></strong><br>
                    @foreach ($reportables as $reportable)
                        @if( $report[$examination->name][$reportable->name] > 0)
                            @php
                                echo(str_repeat('&nbsp;',5));
                            @endphp
                            {{ $reportable->name }}:
                            @php
                                // echo(str_repeat('&nbsp;',2));
                            @endphp
                            {{ $report[$examination->name][$reportable->name] }}x       
                            0,00                     
                            <br>
                        @endif
                    @endforeach
                    @if ($report[$examination->name]['Others'] > 0)
                        @php
                            echo(str_repeat('&nbsp;',5));
                        @endphp
                        wg. cennika przychodni:
                        @php
                            // echo(str_repeat('&nbsp;',2));
                        @endphp
                        {{ $report[$examination->name]['Others'] }}x
                        0,00                     
                        <br>
                    @endif
                @endif
            @endforeach
        </samp>
    </div>
</div>

@endsection