@extends('voyager::master')

@section('page_title', 'Workers Salary Sheet')

@section('page_header')
<h1 class="page-title">
    <i class="voyager-wallet"></i> {{ __('voyager::generic.viewing') }} Workers Salary Sheet &nbsp;
</h1>
@include('voyager::multilingual.language-selector')
@stop

@section('content')
<div class="page-content read container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-bordered" style="padding-bottom:5px;">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>SL No</th>
                                    <th>Name</th>
                                    <th>ID</th>
                                    <th>Salary Per Day</th>
                                    <th>Position</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($workers as $worker)
                                @foreach($worker as $key => $wrk)
                                <tr>
                                    <td>{{$key}}</td>
                                    <td>{{$wrk->name}}</td>
                                    <td>{{$wrk->company_id}}</td>
                                    <td>{{$wrk->perday_salary}}</td>
                                    <td>{{$wrk->position}}</td>
                                    <td><a href="{{route('worker-timecards.all-records', ['worker_id' => $wrk->id])}}"
                                            class="btn btn-info">Timecards/Salary Sheets</a></td>
                                </tr>
                                @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div><!-- panel-body -->
            </div>
        </div>
    </div>

</div>


@stop

@section('javascript')
<script src="{{ voyager_asset('lib/js/dataTables.responsive.min.js') }}"></script>

<script>
    $(document).ready(function () {
         $('#dataTable').DataTable();
     });
</script>
@stop