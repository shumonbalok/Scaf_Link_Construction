@extends('voyager::master')


@section('page_header')
    <h1 class="page-title">
        <i class="voyager-credit-cards"></i> Viewing Worker Timecard &nbsp;

        <a href="{{ route('voyager.worker-timecards.index') }}" class="btn btn-warning">
            <span class="glyphicon glyphicon-list"></span>&nbsp;
            Return to List
        </a>
        <button class="btn btn-danger" type="button" onclick="printDiv('printableArea')">Print!</button>
    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
    <div class="page-content read container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered" style="padding-bottom:5px;">
                    <!-- form start -->
                        <div class=" col-md-12">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                        @if($salaries)
                                        @php $firstrow = ''; @endphp
                                        @foreach($salaries as $salary)
                                            @foreach($salary as $key => $slry)
                                                @php $date = \Carbon\Carbon::parse($slry->created_at); @endphp
                                                @php if($key == 0) $firstrow = $slry @endphp
                                            
                                                <a data-href="{{route('salary-sheets.staff-list', 
                                                        ['user_id' => $slry->user_id, 'created_at' => $slry->created_at])}}" 
                                                    class="btn btn-default get_data_by_click_btn {{$key==0 ? 'worker-timecard-active' : ''}}"
                                                    >{{$date->format('M Y')}}</a>
                                            @endforeach
                                        @endforeach
                                        @endif
                                        </div>
                                    </div>
                                    <div class="col-md-10 ajax-data" id="printableArea">
                                        @include('ajaxRequestData.staffSalaryTable', ['firstrow' => $firstrow])                                        
                                    </div>
                                </div>
                                
                            </div><!-- panel-body -->
                        </div>
                    <!-- form end -->
                </div>
            </div>
        </div>

    </div>

@stop

@section('javascript')
    <script>
        
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;
    
            document.body.innerHTML = printContents;
    
            window.print();
    
            document.body.innerHTML = originalContents;
        }

        $('document').ready(function () {

            $(window).load(function(){
                var salary = parseInt($('.salary').text()),
                    incentive = parseInt($('.incentive').val()),
                    deduction = parseInt($('.deduction').val());
                $('.total').text(salary+incentive-deduction);
                console.log(incentive+'-'+deduction)
            });
        });

    </script>
@stop
