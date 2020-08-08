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
            Cennik badań - TEST
        </div>
    </div>

@endsection

@section('content')
<div class= "ne-main-1 ne-overflow-y">

    <div id="content" class="jumbotron">
        <button id="btn0" class="ajax btn btn-primary" value="Pierwsze">First AJAX!</button>
        <button id="btn1" class="ajax btn btn-primary" value="Drugie">Second AJAX!</button>
        <button id="aqqek" class="ajax btn btn-primary" value="P-56">Third AJAX!</button>
    </div>
    <div class="alert">
    </div>

    <div class="h3 mb-3 text-info ml-4">Ceny badań</div>

    <div class="row justify-content-start mx-4"> 
        @csrf
        <table id="editable0" class="table table-hover table-sm table-dark">
            <thead>
                <tr>
                  <th scope="col" class="text-center">#</th>
                  <th scope="col"></th>
                  <th scope="col" class="">Badanie</th>
                  <th>Cena</th>
                </tr>
            </thead>
            <tbody>
                @foreach($examinations as $i=>$examination)
                    <tr class="tex">
                        <td class="text-center align-middle">{{ $i+1 }}</td>
                        <td class="align-middle">
                            <span class="icon text-warning text-bold">&#43;</span>
                        </td>
                        <td class="align-middle">{{ $examination->name }}</td>
                        <td class="align-middle" style="width: 6em">999,99</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <table id="editable1" class="table table-hover table-sm table-dark">
            <thead>
                <tr>
                  <th scope="col" class="text-center">#</th>
                  <th scope="col"></th>
                  <th scope="col" class="">Badanie</th>
                  <th>Cena</th>
                </tr>
            </thead>
            <tbody>
                @foreach($examinations as $i=>$examination)
                    <tr class="tex">
                        <td class="text-center align-middle">{{ $i+1 }}</td>
                        <td class="align-middle">
                            <span class="icon text-warning text-bold">&#43;</span>
                        </td>
                        <td class="align-middle">{{ $examination->name }}</td>
                        <td class="align-middle" style="width: 6em">999,99</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('page-js-files')

@endsection

@section('page-js-script')
    
    <script type="text/javascript">
        jQuery(document).ready(function($){

            var _token = $('input[name="_token"]').val();

            function getText() {
                $.ajax({
                    // the URL for the request
                    url: '{{ route("medical_reports.pricelist.actionGet") }}',
                    // whether this is a POST or GET request
                    type: 'GET',
                    // the type of data we expect back
                    dataType: 'text',
                    // function to call for success
                    success: successFunction,
                    // function to call on an error
                    error: errorFunction,

                    // code to run regardless of success or failure
                    complete: function (xhr, status) {
                        jQuery('.alert').append('<strong>Status: ' + status + '</strong>. ' + ' Your request is finished!');
                        jQuery('#click').addClass('disabled');
                    }
                });
            };

            function sendText() {
                var textq = $(this).text();
                $.ajax({
                    url: '{{ route("medical_reports.pricelist.action") }}',
                    type: 'POST',
                    data:{text: textq, _token: _token},
                    success: successFunction,
                    error: errorFunction,
                    
                    complete: function (xhr, status) {
                        jQuery('.alert').append('<strong>Status: ' + status + '</strong>. ' + ' Your request is finished!');
                        jQuery('#click').addClass('disabled');
                    }
                });
            }

            function successFunction(result) {
                jQuery('#content').append(result);
            }

            function errorFunction(xhr, status, strErr) {
                jQuery('#content').append(strErr);
            }

            // jQuery('#click').click(function() {
            //     getText();
            // });
            // jQuery('#click').click(function() {
            //     sendText();
            // });

            // jQuery('body').on('click', '.ajax', function() {
            //     sendText()
            // });
            
            jQuery('body').on('click', '.ajax', function() {
                var text = $(this).val();
                var thisId = this.id;
                $.ajax({
                    url: '{{ route("medical_reports.pricelist.action") }}',
                    type: 'POST',
                    data:{text: text, _token: _token},
                    success: successFunction,
                    error: errorFunction,
                    
                    complete: function (xhr, status) {
                        jQuery('.alert').append('<strong>Status: ' + status + '</strong>. ' + ' Your request is finished!');
                        $('#' + thisId).attr('disabled','disabled');
                    }
                });
            });

        });
    </script>

@endsection
