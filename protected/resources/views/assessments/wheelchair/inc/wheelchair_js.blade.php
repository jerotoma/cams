  <script type="text/javascript">
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
             return false;
			});
	   
            $('#activate-step-3').on('click', function(e) {
                $('ul.setup-panel li:eq(2)').removeClass('disabled');
                $('ul.setup-panel li a[href="#step-3"]').trigger('click');
                $(this).remove();
            	return false;
			});

            $('#activate-step-4').on('click', function(e) {
                $('ul.setup-panel li:eq(3)').removeClass('disabled');
                $('ul.setup-panel li a[href="#step-4"]').trigger('click');
                $(this).remove();
               	return false;
			});
            $('#wheelchairassessment').on('submit',function(){
                
                var postData = $(this).serializeArray();
                var formURL = $(this).attr("action");
			    submitAssessmentData(formURL, postData);
               
                return false;
            });
          function submitAssessmentData(formURL, postData){
			  
				  console.log(formURL);
				  console.log(postData);
				  var errorsHtml = '<div class="alert alert-danger"><p class="text-uppercase text-bold">There are errors kindly check</p><ul>';

				  $.ajax({
						url : formURL,
						type: "POST",
						data : postData,
						dataType: "JSON",
						success:function(response){

							if(response.success === true ){

								$('.inform_assessor').html(response.message);
								$("form").trigger('reset');

							}else{
								$('.inform_assessor').html(response.message);
							}

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

   </script>