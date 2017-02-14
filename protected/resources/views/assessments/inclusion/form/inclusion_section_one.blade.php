
<fieldset>
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
            ajax: '{{url('get-inclass-clientsjson')}}', //this url load JSON Client details to reduce loading time
            "fnDrawCallback": function (oSettings) {
            }
        });
    });

</script>
     <div class="well">
	<div class="form-top">
		<div class="form-top-left">
			<h3 class="text-center section-info"></span>Section <span class="section">1</span> out of <span class="section">7</span> sections </h3>
			<h1 class="text-center section-title ">Select client to assess </h1>
		</div>
	</div>
	<div class="form-bottom">
		<div class="row">
			 <div class="col-md-12 text-center">
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
                                                    Client Number
                                                </th>
                                                <th class="text-center">
                                                    Full Name
                                                </th>
                                                <th class="text-center">
                                                    Gender
                                                </th>
                                               <th class="text-center">
                                                    Nationality
                                                </th>
                                                <th class="text-center">
                                                   Date of Arrival
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
				<div class="form-group text-center">
					  <button type="button" class="btn btn-next">Next</button>
				</div>
		   </div>
		</div>
	</div>
</div>
</fieldset>



