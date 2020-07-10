<div class="row ajax-data">
    <div class="col-md-12">
        <div class="panel panel-bordered" style="padding-bottom:5px;">
            <div class="panel-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>
                                <div class="pull-left">Normal Hours</div>
                                <div class="pull-left" style="margin-left:13%;">Over Time</div>
                                <div class="pull-right" style="margin-right:33%;">Remark</div>
                            </th>
                            <th>Name</th>
                            <th>Company Id</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($workers as $worker)
                        <tr>
                            <td>
                                <form action="{{route('attendance.save-work-time')}}" method="post">
                                    <input name="worker_id" type="hidden" value="{{$worker->worker_id}}">
                                    <input type="hidden" name="project_id" value="{{ $worker->project_id }}">
                                    <input type="hidden" name="department_id" value="{{ $worker->department_id }}">
                                    <input type="hidden" name="created_at" value="{{ $worker->created_at }}">
                                    <input type="number" name="normal_hrs" value="{{$worker->normal_hrs}}"
                                        class="form-control add_record_on_change" style="max-width:20%;float:left"
                                        {{empty($worker->normal_hrs) && (\Carbon\Carbon::parse($worker->created_at)->format('Y-m-d') != today()) ? '' : 'disabled="disabled"'}}>
                                    <input type="number" name="ot_hrs" value="{{$worker->ot_hrs}}"
                                        class="form-control add_record_on_change" placeholder=""
                                        style="max-width:20%;display:inline;margin-left:5%"
                                        {{empty($worker->normal_hrs)  && (\Carbon\Carbon::parse($worker->created_at)->format('Y-m-d') != today()) ? '' : 'disabled="disabled"'}}>

                                    <input type="text" name="remark" value="{{$worker->remark}}"
                                        class="form-control add_record_on_change" placeholder=""
                                        style="max-width:40%;float:right"
                                        {{empty($worker->normal_hrs) ? '' : 'disabled="disabled"'}}>

                                </form>
                            </td>
                            <td scope="row">
                                {{$worker->worker->name}}
                            </td>
                            <td scope="row">{{$worker->worker->company_id}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>