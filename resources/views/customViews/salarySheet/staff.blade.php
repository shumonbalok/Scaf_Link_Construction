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
                    <div class="pannel-header">
                        <div class="panel-title">
                            <a class="btn btn-success create-staff-salary-list" data-href="{{route('salary-sheets.staff')}}">Create Salary Sheet for all staff by one click</a>                                                                               
                        </div>
                    </div>
                    <div class="panel-body" >
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>SL No</th>
                                        <th>Name</th>
                                        <th>ID</th>
                                        <th>Salary Per Month</th>
                                        <th>Position</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>                                 
                                <tbody>
                                    @foreach($staffs as $staff)
                                        @foreach($staff as $key => $stf)
                                        <tr>
                                            <td>{{$key}}</td>
                                            <td>{{$stf->name}}</td>
                                            <td>{{$stf->company_id}}</td>
                                            <td>{{$stf->salary}}</td>
                                            <td>{{ucfirst($stf->role->name)}}</td>
                                            <td><a href="{{route('salary-sheets.staff-list', ['staff_id' => $stf->id])}}" 
                                                class="btn btn-info">Show Salary Sheet</a></td>
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
