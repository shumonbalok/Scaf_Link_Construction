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
                    <h3 class="panel-title">Workers Attendance</h3>
                </div>
                <x-department-project-form action="{{ route('attendance.workers') }}" btnText="Show People" />
            </div>
        </div>
    </div>
</div> @stop