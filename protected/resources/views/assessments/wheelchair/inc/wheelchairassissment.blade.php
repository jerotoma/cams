
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
                
				var postData = $('#assessmentClient').serializeArray();
                var formURL = $('#assessmentClient').attr("action");
			    submitAssessmentData(formURL, postData);
				
			});
	   
            $('#activate-step-3').on('click', function(e) {
                $('ul.setup-panel li:eq(2)').removeClass('disabled');
                $('ul.setup-panel li a[href="#step-3"]').trigger('click');
                $(this).remove();
               
				var postData = $('#assessmentinterview').serializeArray();
                var formURL = $('#assessmentinterview').attr("action");
			    submitAssessmentData(formURL, postData);
				return false;
			});

            $('#activate-step-4').on('click', function(e) {
                $('ul.setup-panel li:eq(3)').removeClass('disabled');
                $('ul.setup-panel li a[href="#step-4"]').trigger('click');
                $(this).remove();
               
				var postData = $('#physicalassessment').serializeArray();
                var formURL = $('#physicalassessment').attr("action");
			    submitAssessmentData(formURL, postData);
				return false;
			});

            
          function submitAssessmentData(formURL, postData){
			  console.log(formURL);
			  console.log(postData);
			   var errorsHtml = '<div class="alert alert-danger"><p class="text-uppercase text-bold">There are errors kindly check</p><ul>';
                           
			  $.ajax(
                {
                    url : formURL,
                    type: "POST",
                    data : postData,
                    dataType: "json",
                    success:function(response)
                    {
                        console.log(response);
                    },
                    error: function(xhr,status, response) {
                        if( xhr.status === 400 ) {
                            var errors = xhr.responseJSON.errors;
                            $.each(errors, function (key, value) {
                                errorsHtml += '<li>' + value[0] + '</li>'; //showing only the first error.
                            });
                            errorsHtml += '</ul></di>';
                            $('#inform_assessor').html(errorsHtml);
                        }
                        else
                        {
                            $('#inform_assessor').html("");
                        }

                    }
                });
			  
		  }
   
        
   
   
   
   
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