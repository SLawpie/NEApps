@extends('layouts.app')

@section('application-module-name')
    <div class="text-white mb-0 ">
        Historia logowań
    </div>
@endsection

@section('content')
<div class= "ne-main-1 ne-overflow-y">
<div class="col">
    <table class="table table-sm table-hover table-dark">
        <thead>
        <tr class="text-white-50">
            <th scope="col" class="text-center">LP</th>
            <th scope="col" class="">DATA</th>
            <th scope="col" class="">PRZEGLĄDARKA</th>
            <th scope="col" class="">SYSTEM</th>
            <th scope="col" class="">IP</th>
            <th scope="col" class="text-right pr-3">STATUS</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($loginAttempts as $i=>$loginAttempt)
                <tr>
                    <th scope="row" class="text-center">
                        {{ $i+1 }}
                    </th>
                    <td>
                        {{ $loginAttempt['myDate'] }}
                    </td>
                    <td>
                        {{ $loginAttempt['browser'] }}
                    </td>
                    <td>
                        {{ $loginAttempt['system'] }}
                    </td>
                    <td>
                        {{ $loginAttempt['ip'] }}
                    </td>
                    <td class="text-right pr-3">
                        @if ($loginAttempt['success'])
                            <div class="text-success font-weight-bold">Zalogowano</div>
                        @else
                            <div class="text-danger font-weight-bold">Błąd logowania</div>
                        @endif
                    </td>
                </tr>
                
            @endforeach

        </tbody>
    </table>
</div>
</div>
@endsection