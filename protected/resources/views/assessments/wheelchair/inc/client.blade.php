
<script>
    $(function() {
        $.extend( $.fn.dataTable.defaults, {
            autoWidth: false,
            dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
            language: {
                search: '<span>Filter:</span> _INPUT_',
                lengthMenu: '<span>Show:</span> _MENU_',
                paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' }
            },
            drawCallback: function () {
                $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
            },
            preDrawCallback: function() {
                $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
            }
        });


        // Basic datatable
        $('.datatable-basic').DataTable({
            "scrollX": false,
            ajax: '{{url('getwaclientsjson')}}', //this url load JSON Client details to reduce loading time
            "fnDrawCallback": function (oSettings) {
            }
        });
    });

</script>
<div class="row setup-content" id="step-1">
        <div class="col-xs-12">
            <div class="col-md-12 well text-center">
                <h1>Select client to assess</h1>
                    <div class="form-group">
                            <div class="row clearfix">
                                <div class="col-md-12 column">
                                      <table class="table datatable-basic table-bordered table-hover" id="tab_logic">
                                        <thead>
                                        <tr >
                                            <th class="text-center">
                                                #
                                            </th>
                                            <th class="text-center">
                                                HAI REG NO
                                            </th>
                                            <th class="text-center">
                                                Unique ID
                                            </th>
                                            <th class="text-center">
                                                Full Name
                                            </th>
                                            <th class="text-center">
                                                Sex
                                            </th>
                                            <th class="text-center">
                                                Age
                                            </th>
                                            <th class="text-center">
                                                Ration Card No
                                            </th>
                                            <th class="text-center">
                                                Camp
                                            </th>
                                            <th class="text-center">
                                                Check client
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                            <!-- <a id="add_row" class="btn btn-success pull-left">Add Row</a><a id='delete_row' class="btn btn-danger pull-right">Delete Row</a> -->
                   <div class="form-group">
                    <button id="activate-step-2" class="btn btn-info btn-md">Continue to Assessment Interview</button>
                  </div>
              
              </div>
        </div>
    </div>
                                              