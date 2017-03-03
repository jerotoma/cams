<div class="panel panel-flat">
    <div class="panel-heading">

        <h5 class="panel-title text-center text-uppercase">Users Activity Details</h5>
    </div>

    <div class="panel-body">

        <table class="table datatable-basic table-hover">
            <thead>
            <tr>
                <th>Date</th>
                <th>Module</th>
                <th>Username</th>
                <th>Activity</th>
                <th>Related Page</th>
                <th>IP Address</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$log->activity_date}}</td>
                    <td>{{$log->module}}</td>
                    <td>{{$log->username}}</td>
                    <td>{{$log->activity}}</td>
                    <td>{{$log->page}}</td>
                    <td>{{$log->ip_address}}</td>
                </tr>
            <tr>
                <th colspan="6">Related Data</th>
            </tr>
                <tr>
                    <td colspan="6"><textarea readonly rows="10" class="form-control"><?php echo $log->data; ?></textarea></td>
                </tr>
            </tbody>

        </table>
    </div>
</div>

<div class="row">
    <div class="col-md-8 col-sm-8 pull-left" id="output">

    </div>
    <div class="col-md-4 col-sm-4 pull-right text-right">
        <button type="button" class="btn btn-success btn-block"  data-dismiss="modal">Close</button>
    </div>

</div>