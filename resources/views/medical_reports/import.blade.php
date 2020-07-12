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

    <h2 class="py-3 font-weight-light"> {{ __('medical_reports.import') }} </h2>

    <form action="{{ route('medical_reports.import.file') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <div class="input-group col-lg-6 col-xl-5">
                <div class="input-group-prepend">
                    <button class="btn btn-primary" id="inputFile" type="submit">Wczytaj plik</button>
                </div>
                <div class="custom-file">
                    <input type="file" name="file" id="file" class="@error('file') is-invalid @enderror" >
                    <label class="custom-file-label" for="file" aria-describedby="inputFile">Nie wybrano pliku</label>
                </div>
            </div>
        </div>

    </form>

    <br>
    
    @error('file')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <script type="application/javascript">
        $('input[type="file"]').change(function(e){
            var fileName = e.target.files[0].name;
            $('.custom-file-label').html(fileName);
        });
    </script>

@endsection
