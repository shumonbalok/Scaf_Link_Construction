@extends('voyager::master')

@section('page_title', 'Workers')

@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title">
            <i class=""></i>Workers Those Permit will be Expired Soon
        </h1>
        
    </div>
@stop

@section('content')
<div class="page-content read container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered" style="padding-bottom:5px;">
                    <div class="panel-body" >
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>SL No</th>
                                        <th>Name</th>
                                        <th>ID</th>
                                        <th>Permit Start</th>
                                        <th>Permit End</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>                                 
                                <tbody>
                                    @foreach($workers as $key => $worker)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$worker->name}}</td>
                                        <td>{{$worker->company_id}}</td>
                                        <td>{{$worker->permit_start}}</td>
                                        <td>{{$worker->permit_end}}</td>
                                        <td><a href="{{route('voyager.workers.show', $worker->id)}}" 
                                            class="btn btn-info">Show Details</a></td>
                                    </tr>
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

