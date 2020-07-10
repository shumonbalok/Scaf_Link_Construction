<table class="table table-borderless ajax-data">
    <thead>
        <tr>
            <th>Date</th>
            <th>Project</th>
            <th>Department</th>
            <th>Normal hours</th>
            <th>Over time</th>
            <th>Remark</th>
        </tr>
    </thead>                                 
    <tbody>
        @php 
            $normal_hrs = 0;
            $ot_hrs = 0;
        @endphp
        @foreach($records as $record)
        <tr>
            <td>{{$record->created_at}}</td>
            <td>{{$record->project->name}}</td>
            <td>{{$record->department->name}}</td>
            <td>{{$record->normal_hrs}}</td>
            <td>{{$record->ot_hrs}}</td>
            <td>{{$record->remark}}</td>
        </tr>
        @php 
            $normal_hrs += $record->normal_hrs;
            $ot_hrs += $record->ot_hrs;
        @endphp
        @endforeach
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>Total hours: {{$normal_hrs}}</td>
            <td>Over time hrs: {{$ot_hrs}}</td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>Salary per day: {{$daySalary}}</td>
            <td>Over time rate: {{setting('admin.overtime_rate')}}</td>
            <td>Total hours: S$ {{ $hr_money = ($daySalary/8)*$normal_hrs}}</td>
            <td>Over time: S$ {{ $ot_money = ($daySalary/8*setting('admin.overtime_rate')) * $ot_hrs}}</td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>Total: S$ </td>
            <th>{{$hr_money + $ot_money}}</th>
            <td></td>
        </tr>
        <tr><td></td><td></td><td></td><td></td><td></td><td></td>
        </tr>
        <tr><td></td><td></td><td></td><td></td><td></td><td></td>
        </tr>
        <tr><td></td><td></td><td></td><td></td><td></td><td></td>
        </tr>
        <tr><td>_____________</td><td></td><td></td><td></td><td>____________</td><td></td>
        </tr>
        <tr><td>Payment Approved By</td><td></td><td></td><td></td><td>Received By</td>
        </tr>
    </tbody>
</table>