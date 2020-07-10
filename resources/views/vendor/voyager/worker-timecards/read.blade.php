@extends('voyager::master')

@section('page_title', __('voyager::generic.view').' '.$dataType->getTranslatedAttribute('display_name_singular'))

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i> {{ __('voyager::generic.viewing') }} {{ ucfirst($dataType->getTranslatedAttribute('display_name_singular')) }} &nbsp;

        <a href="{{ route('voyager.'.$dataType->slug.'.index') }}" class="btn btn-warning">
            <span class="glyphicon glyphicon-list"></span>&nbsp;
            {{ __('voyager::generic.return_to_list') }}
        </a>
    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
    <div class="page-content read container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered" style="padding-bottom:5px;">
                    <!-- form start -->
                    <div class="panel-header">
                        @php $worker = \App\Models\Worker::findOrFail($dataTypeContent->worker_id) @endphp
                        <div class="panel-title">This running month time card: 
                            <a href="{{route('worker-timecards.all-records', ['worker_id' => $dataTypeContent->worker_id])}}" class="btn btn-info float-right">Show all records</a>
                            <h4>{{$worker->name}} ({{$worker->company_id}})</h4>                            
                        </div>
                    </div> 
                        <div class=" col-md-12">
                            <h4 class="panel-title"></h3>
                            <div class="panel-body" style="padding-top:0;">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Project</th>
                                            <th>Department</th>
                                            <th>Normal hours</th>
                                            <th>Over time</th>
                                        </tr>
                                    </thead>
                                    @foreach($dataTypeContent->workerTimeCardThisMonth() as $timecard)                                   
                                    <tbody>
                                        <tr>
                                            <th scope="row">{{\Carbon\Carbon::parse($timecard->created_at)->format('Y-m-d')}}</th>
                                            <td>{{\App\Models\Project::findOrFail($timecard->project_id)->name}}</td>
                                            <td>{{\App\Models\Department::findOrFail($timecard->department_id)->name}}</td>
                                            <td>{{$timecard->normal_hrs}}</td>
                                            <td>{{$timecard->ot_hrs}}</td>
                                        </tr>
                                    </tbody>
                                    @endforeach
                                </table>
                            </div><!-- panel-body -->
                        </div>
                    <!-- form end -->
                </div>
            </div>
        </div>

    </div>


@stop


