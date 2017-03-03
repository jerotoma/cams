<table>
    <thead>
    <tr>
        <th colspan="7"><h5> <strong>List of All Users Activities @if($request != "" ) from {{$request->start_date}} to {{$request->end_date}} @endif</strong></h5></th>
    </tr>
    <tr>
        <th>No</th>
        <th>Date</th>
        <th>Module</th>
        <th>Activity</th>
        <th>Related Page</th>
        <th>IP Address</th>
        <th>Related Data</th>
    </tr>
    </thead>
    <tbody>
    <?php $count = 1; ?>
    @foreach($logs as $log)
        <tr>
            <td>{{$count}}</td>
            <td>{{$log->activity_date}}</td>
            <td>{{$log->module}}</td>
            <td>{{$log->activity}}</td>
            <td>{{$log->page}}</td>
            <td>{{$log->ip_address}}</td>
            <td>{{$log->data}}</td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <td>No</td>
        <td>Date</td>
        <td>Module</td>
        <td>Activity</td>
        <td>Related Page</td>
        <td>IP Address</td>
        <td>Related Data</td>
    </tr>
    </tfoot>

</table>