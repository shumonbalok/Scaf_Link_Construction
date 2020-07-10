@if(!$workers->isEmpty())
<div id="home" class="tab-pane fade in active">
    <table class="table">
        <thead>
            <tr>
                <th>Present/Absent</th>
                <th>Name</th>
                <th>Company Id</th>
                <th>Department</th>
            </tr>
        </thead>
        <tbody>

        @foreach($workers as $wrkr)
            @foreach($wrkr as $worker)
                <tr class="{{$worker->attendance == 0 ? 'warning' : ''}}">
                    <td>{{$worker->attendance_status}}</td>
                    <td>{{$worker->worker->name}}</td>
                    <td>{{$worker->worker->company_id}}</td>                            
                    <td>{{$worker->department->name}}</td>                                 
                </tr>
            @endforeach
        @endforeach
        </tbody>
    </table>

</div>
@else
    <div class="alert alert-danger">No record found!</div>
@endif