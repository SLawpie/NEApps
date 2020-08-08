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
            Cennik badań
        </div>
    </div>

@endsection

@section('content')
<div class= "ne-main-1 ne-overflow-y">
    <div class="h3 mb-3 text-info ml-4">Ceny badań</div>
    <div class="h5 alert"></div>

    <div class="row justify-content-start mx-4"> 
        @csrf
        <table class="table table-hover table-sm table-dark">
            <thead>
                <tr>
                  <th scope="col" class="text-center">#</th>
                  <th scope="col"></th>
                  <th scope="col" class="">Badanie</th>
                </tr>
            </thead>
            <tbody>
                @foreach($examinations as $i=>$examination)
                    <tr class="collapsible"  style="cursor: pointer;">
                        <th scope="row" class="text-center">
                            <span>{{ $i+1 }}</span>
                        </th>
                        <td>
                            <span class="icon text-warning text-bold">&#43;</span>
                        </td>
                        <td>
                            <span>{{ $examination->name }}</span>
                        </td>
                    </tr>
                    <tr class="content" style="display: none;">
                        <td colspan="2"></td>
                        <td>
                            <table class="table-borderless">
                                <thead>
                                    <tr style="border-bottom: 1px solid #454d55; background-color: inherit;">
                                      <th scope="col"></th>
                                      <th scope="col" class="text-center">Cena</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($facilities as $i=>$facility)
                                        <tr class="align-middle" style="background-color: inherit;">
                                            <td class="align-middle">
                                                <span>
                                                @if ($facility->name == "Others")
                                                    cena dla przychodni
                                                @else
                                                    {{ $facility->name }}
                                                @endif
                                                </span>
                                            </td>
                                            <td class="pl-4 text-right align-middle">
                                                @php
                                                    if ($priceList->where('examination_id', $examination->id)->firstWhere('facility_id', $facility->id)){
                                                        $price = $priceList->where('examination_id', $examination->id)->firstWhere('facility_id', $facility->id)->price;
                                                        $price = number_format($price, 2, ',', '');
                                                    } else {
                                                        $price = '0,00';
                                                    }
                                                @endphp
                                                <span class="price">
                                                        {{ $price }}
                                                </span>
                                                <input class="input-form form-control input-sm" type="text" 
                                                        value="{{ $price }}" 
                                                        style="display: none;">
                                            </td>
                                            <td class="align-middle">
                                                <div class="btn-group btn-group-sm">
                                                    <a class="edit-btn btn btn-sm py-0">
                                                        <span class="fas fa-pen text-warning" style="font-size:16px"></span>
                                                    </a>
                                                    <a id="{{ $facility->id }}-{{ $examination->id }}" class="confirm-btn btn btn-sm py-0" style="display:none">
                                                        <span class="fas fa-check" style="font-size:16px;color:#0f0"></span>
                                                    </a>
                                                    <a class="cancel-btn btn btn-sm py-0" style="display:none">
                                                        <span class="fas fa-times" style="font-size:16px;color:#f00"></span>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </td>
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
    
<script>
    jQuery(document).ready(function($){
        var _token = $('input[name="_token"]').val();
        $('.alert').hide();

        jQuery('body').on('click', '.collapsible', function() {
            var x = $(this).next().is(':visible');
            resetAllViews();
            if (!x) {
                $(this).next().toggle();
                jQuery(this).find('.icon').html('&#45;');
            } else {
                jQuery(this).find('.icon').html('&#43;');
            }
        });

        jQuery('body').on('click', '.edit-btn', function() {
            var x = $(this).parentsUntil('table');
            resetView(x);
            $(this).hide();
            $(this).nextAll().toggle();
            x = $(this).parentsUntil('tbody');
            jQuery(x).find('.input-form').show().focus();
            jQuery(x).find('.price').hide();
        });

        jQuery('body').on('click', '.cancel-btn', function(){
            var x = $(this).parentsUntil('tbody');
            resetView(x);
        })

        jQuery('body').on('click', '.confirm-btn', function(){
            var x = $(this).parentsUntil('tbody');
            var price = jQuery(x).find('.input-form').val();
            $.ajax({
                url: '{{ route("medical_reports.pricelist.action") }}',
                type: 'POST',
                dataType: 'json',
                data:{id: this.id, price: price, _token: _token},
                success: function(result) {
                    jQuery(x).find('.price').text(result.price)
                    resetView(x);
                },

                error: errorFunction,
                
                complete: function (xhr, status) {
                    resetView(x);
                }
            });
        })

        function errorFunction(xhr, status, strErr) {
            //jQuery('.alert').append(strErr);
        }

        function resetView(x) {
            jQuery(x).find('.input-form').hide();
            jQuery(x).find('.price').show();
            jQuery(x).find('.confirm-btn').hide();
            jQuery(x).find('.cancel-btn').hide();
            jQuery(x).find('.edit-btn').show();
        }

        function resetAllViews() {
            $('.content').hide();
            $('.edit-btn').show();
            $('.confirm-btn').hide();
            $('.cancel-btn').hide();
            $('.icon').html('&#43;');
            $('.input-form').hide();
            $('.price').show();
        };
    })
</script>

@endsection
