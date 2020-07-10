<div class="row ajax-data">
    <div class="col-md-12">
        <div class="panel panel-bordered" style="padding-bottom:5px;">
            <div class="panel-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Present/Absent</th>
                            <th>Name</th>
                            <th>Company Id</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($workers as $worker)
                        <tr>
                            <td>
                                <form action="{{route('attendance.addAttendance')}}" method="post">
                                    <input name="worker_id" type="hidden" value="{{$worker->worker_id}}">
                                    <input type="hidden" name="department_id" value="{{ $worker->department_id }}">
                                    <input type="hidden" name="project_id" value="{{ $project_id }}">
                                    @if(($worker->attendance == 1 && $worker->remark == null) || ($worker->attendance ==
                                    0 && $worker->remark != null) )
                                    <input type="checkbox" name="attend" class="add_record_on_change" checked="checked"
                                        disabled="disabled">
                                    <input type="text" name="remark" class="form-control add_record_on_change"
                                        placeholder="Attendance already inserted" disabled="disabled"
                                        style="max-width:85%;float:right">
                                    @else
                                    <input type="checkbox" name="attend" class="add_record_on_change">
                                    <input type="text" name="remark" class="form-control add_record_on_change"
                                        placeholder="If absent, Please write the reason"
                                        style="max-width:85%;float:right">
                                    @endif
                                </form>
                            </td>
                            <td scope="row">{{$worker->worker->name}}</td>
                            <td scope="row">{{$worker->worker->company_id}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>