@extends('layouts.app')

@section('application-module-name')

  <p class="text-light mb-0 font-weight-light">
    {{ __('medical_reports.reports') }}
  </p>

@endsection

@section('content')

  <div class="mt-3">
    <div class="card bg-dark text-white" style="width: 18rem;">
      <div class="card-header text-center">
          <p class="h5 card-title">USG</p>
      </div>
      <div class="card-body">
        <p class="card-text text-center">Wykaz przeprowadzonych badań dla konkretnego lekarza.</p>
      </div>
      <div class="card-footer text-center">
          <a href="{{ route('medical_reports.import.file') }}" class="btn btn-primary">Generuj</a>
      </div>
    </div>
  </div>
@endsection