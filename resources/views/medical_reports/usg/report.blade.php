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
    <div class="ne-sticky pt-3">
        <div class="d-flex flex-row">
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
        <div class="ne-progress-container">
            <div class="ne-progress-bar" id="myBar"></div>
        </div>
    </div>


    <div class="ne-content">
        <div class="row justify-content-md-left">
            <div class="col-md-8 mt-3">
                <table class="ne-table">
                    @foreach ($examinations as $key=>$examination)
                        <tr class="ne-main-row">
                            <td class="ne-cell px-2 text-center">
                                <i class="fa fa-caret-right" aria-hidden="true"></i>
                            </td>
                            <td class="ne-cell pr-2">
                                {{ $report[$examination->name]['All'] }} x
                            </td>
                            <td class="ne-cell" colspan="4">
                                {{ $examination->name }}
                            </td>
                        </tr>
                       
                        @foreach ($reportables as $reportable)
                            @if( $report[$examination->name][$reportable->name] > 0)
                                <tr class="ne-row">
                                    <td class="ne-cell"></td>
                                    <td class="ne-cell"></td>
                                    <td class="ne-cell pl-3">
                                        {{ $reportable->name }}
                                    </td>
                                    <td class="ne-cell pr-2">
                                        {{ $report[$examination->name][$reportable->name] }} x
                                    </td>
                                    <td class="ne-cell">
                                    0,00
                                    </td>
                                    <td class="ne-cell">
                                        &nbsp;
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                  
                        @if ($report[$examination->name]['Others'] > 0)
                            <tr class="ne-row">
                                <td class="ne-cell"></td>
                                <td class="ne-cell"></td>
                                <td class="ne-cell pl-3">
                                    wg. cennika przechodni
                                </td>
                                <td class="ne-cell pr-2">
                                    {{ $report[$examination->name]['Others'] }} x
                                </td>
                                <td class="ne-cell">
                                0,00
                                </td>
                                <td class="ne-cell">
                                    &nbsp;
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <div class="mt-5"></div>

<script>

    $(window).scroll(function(){
        var sticky = $('.ne-sticky'),
            scroll = $(window).scrollTop();
      
        if (scroll >= 0) sticky.addClass('ne-fixed');
        else sticky.removeClass('ne-fixed');
        
        var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        var scrolled = (scroll / height) * 100;
        document.getElementById("myBar").style.width = scrolled + "%";

      });
</script>
    @endsection