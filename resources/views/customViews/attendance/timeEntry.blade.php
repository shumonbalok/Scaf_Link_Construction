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
                    <h3 class="panel-title">Workers timecard record entry</h3>
                </div>
                <form action="{{ route('attendance.time-entry') }}" method="post" class="submit_data">
                    @csrf()
                    <div class="panel-body custom-panel-body">

                        <x-select col="col-md-3" name="department" :model="\App\Models\Department::all()" />

                        <x-select col="col-md-3" name="project" :model="\App\Models\Project::all()" />

                        <x-input col="col-md-3" name="date" type="date" class="" value="" />

                        <x-input col="col-md-2" name="" type="button" class="btn btn-info get_data_by_form_submit"
                            value="Show People" />



                    </div>
                </form>
            </div>
        </div>
    </div>
</div> @stop