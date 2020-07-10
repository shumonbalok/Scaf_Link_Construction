@extends('voyager::master')


@section('page_header')

@include('voyager::multilingual.language-selector')
@stop

@section('content')
<div class="page-content read container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-bordered" style="padding-bottom:5px;">
                <div class="panel-heading" style="border-bottom:0;">
                    <h3 class="panel-title">Workers Attendance List</h3>
                </div>

                <div class="panel-body custom-panel-body">
                    <ul class="nav nav-tabs custon-nav-tabs">
                        <li class="active"><a data-toggle="pill" data-href="{{route('attendance.list')}}"
                                class="get-data-by-click" data-value="{{today()}}">Today</a></li>
                        <li><a data-toggle="pill" data-href="{{route('attendance.list')}}" class="get-data-by-click"
                                data-value="{{today()->subDays(1)}}">Yesterday</a></li>
                        <li class="pull-right">
                            <form class="navbar-form navbar-left">
                                <label for="date" class="">Select Date:</label>
                                <input type="date" name="date" class="form-control get-data-by-change" value=""
                                    data-href="{{route('attendance.list')}}">
                            </form>
                        </li>
                    </ul>


                    <div class="tab-content ajax-data">
                        @include('customViews.attendance.listTable', compact('workers'))
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop