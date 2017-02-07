
	<div class="row form-group">
        <div class="col-xs-12">
            <ul class="nav nav-pills nav-justified thumbnail setup-panel">
                <li class="active">
                    <a href="#step-1">
                        <h4 class="list-group-item-heading">Step 1</h4>
                        <p class="list-group-item-text">Select Client</p>
                    </a>
                </li>
                <li class="disabled">
                    <a href="#step-2">
                        <h4 class="list-group-item-heading">Step 2</h4>
                        <p class="list-group-item-text">Assessment Interview</p>
                    </a>
                </li>
                <li class="disabled">
                    <a href="#step-3">
                        <h4 class="list-group-item-heading">Step 3</h4>
                        <p class="list-group-item-text">Physical Assessment</p>
                    </a>
                </li>
                <li class="disabled">
                    <a href="#step-4">
                        <h4 class="list-group-item-heading">Step 4</h4>
                        <p class="list-group-item-text">Finish</p>
                    </a>
                </li>
             </ul>
        </div>
	</div>
    @include('assessments.wheelchair.inc.client')
    @include('assessments.wheelchair.inc.assessmentinterview')
    @include('assessments.wheelchair.inc.physicalassessment')
<script>
   $(document).ready(function() {
    
            var navListItems = $('ul.setup-panel li a'),
                allWells     = $('.setup-content');

                allWells.hide();

            navListItems.click(function(e){

                e.preventDefault();
                var $target = $($(this).attr('href')),
                    $item   = $(this).closest('li');

                if (!$item.hasClass('disabled')) {
                    navListItems.closest('li').removeClass('active');
                    $item.addClass('active');
                    allWells.hide();
                    $target.show();
                }
              });

            $('ul.setup-panel li.active a').trigger('click');

            // DEMO ONLY //
            $('#activate-step-2').on('click', function(e) {
                $('ul.setup-panel li:eq(1)').removeClass('disabled');
                $('ul.setup-panel li a[href="#step-2"]').trigger('click');
                $(this).remove();
            })
            $('#activate-step-3').on('click', function(e) {
                $('ul.setup-panel li:eq(2)').removeClass('disabled');
                $('ul.setup-panel li a[href="#step-3"]').trigger('click');
                $(this).remove();
            });

            $('#activate-step-4').on('click', function(e) {
                $('ul.setup-panel li:eq(3)').removeClass('disabled');
                $('ul.setup-panel li a[href="#step-4"]').trigger('click');
                $(this).remove();
            });

            
       });


        // Add , Dlelete row dynamically

         $(document).ready(function(){
              var i=1;
             $("#add_row").click(function(){
              $('#addr'+i).html("<td>"+ (i+1) +"</td><td><input name='name"+i+"' type='text' placeholder='Name' class='form-control input-md'  /> </td><td><input  name='sur"+i+"' type='text' placeholder='Surname'  class='form-control input-md'></td><td><input  name='email"+i+"' type='text' placeholder='Email'  class='form-control input-md'></td>");

              $('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
              i++; 
          });
             $("#delete_row").click(function(){
                 if(i>1){
                 $("#addr"+(i-1)).html('');
                 i--;
                 }
             });

        });
   </script>