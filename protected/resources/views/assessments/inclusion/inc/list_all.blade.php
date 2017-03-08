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
    $('.inclusion-all-client').DataTable({
        "scrollX": false,
        ajax: '{{url('inclusion-get-assessed-clients')}}', //this url load JSON Client details to reduce loading time
        "fnDrawCallback": function (oSettings) {
        }
    });
});

</script>
<table class="table inclusion-all-client table-hover">
      <thead>
          <tr >
              <th>
                  #
              </th>
              <th>
                  Client Number
              </th>
              <th>
                  Full Name
              </th>
              <th>
                  Gender
              </th>
             <th>
                  Nationality
              </th>
              <th>
                 Date of Assessment
              </th>
              <th>
                 Assessed by
              </th>
              <th>
                Action
              </th>
          </tr>
      </thead>

 </table>
