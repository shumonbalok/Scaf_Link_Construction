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
                                <div class="btn-group-vertical" role="group" aria-label="Basic example"
                                    style="margin-top:20px;">
                                    @if($period)
                                    @foreach($period->take(12) as $dt)
                                    <a data-href="{{route('worker-timecards.records-by-month', 
                                                        ['worker_id' => $worker_id,
                                                         'month' => \Carbon\Carbon::parse($dt)->format('m'),
                                                          'year' => \Carbon\Carbon::parse($dt)->format('Y')])}}"
                                        class="btn btn-default get_data_by_click_btn">{{\Carbon\Carbon::parse($dt)->format('Y, F')}}</a>
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-10" id="printableArea">
                                @php $worker = \App\Models\Worker::findOrFail($worker_id) @endphp
                                <div class="panel-title">
                                    <h4>{{$worker->name}} ({{$worker->company_id}}) <small style="margin-left:10px">
                                            Salary Per Day: {{$worker->perday_salary}}</small></h4>
                                </div>
                                <div class="ajax-data">
                                    <div class="alert alert-info" role="alert">
                                        Click month to show worker time card lists
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div><!-- panel-body -->
                </div>
                <!-- form end -->
            </div>
        </div>
    </div>

</div>
<script>
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
   
        document.body.innerHTML = printContents;
   
        window.print();
   
        document.body.innerHTML = originalContents;
   }
</script>

@stop

@section('scripts')

@stop