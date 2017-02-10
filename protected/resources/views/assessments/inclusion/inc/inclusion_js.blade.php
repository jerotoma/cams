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
            $('#inclusion-activate-step-2').on('click', function(e) {
                $('ul.setup-panel li:eq(1)').removeClass('disabled');
                $('ul.setup-panel li a[href="#inclusion-step-2"]').trigger('click');
                //$(this).remove();
             return false;
			});
	   
            $('#inclusion-activate-step-3').on('click', function(e) {
                $('ul.setup-panel li:eq(2)').removeClass('disabled');
                $('ul.setup-panel li a[href="#inclusion-step-3"]').trigger('click');
                //$(this).remove();
            	return false;
			});

            $('#inclusion-activate-step-4').on('click', function(e) {
                $('ul.setup-panel li:eq(3)').removeClass('disabled');
                $('ul.setup-panel li a[href="#inclusion-step-4"]').trigger('click');
                //$(this).hide();
               	return false;
			});
           $('#inclusion-activate-step-5').on('click', function(e) {
                $('ul.setup-panel li:eq(4)').removeClass('disabled');
                $('ul.setup-panel li a[href="#inclusion-step-5"]').trigger('click');
                //$(this).hide();
               	return false;
			});
           $('#inclusion-activate-step-6').on('click', function(e) {
                $('ul.setup-panel li:eq(5)').removeClass('disabled');
                $('ul.setup-panel li a[href="#inclusion-step-6"]').trigger('click');
                //$(this).hide();
               	return false;
			});
            
	       $('#inclusion-go-back-step-1').on('click', function(e) {
                $('ul.setup-panel li:eq(1)').removeClass('disabled');
                $('ul.setup-panel li a[href="#inclusion-step-1"]').trigger('click');
                $('#inclusion-activate-step-2').show();
               	return false;
			});
           $('#inclusion-go-back-step-2').on('click', function(e) {
                $('ul.setup-panel li:eq(2)').removeClass('disabled');
                $('ul.setup-panel li a[href="#inclusion-step-2"]').trigger('click');
                $('#inclusion-activate-step-3').show();
               	return false;
			});
           $('#inclusion-go-back-step-3').on('click', function(e) {
                $('ul.setup-panel li:eq(2)').removeClass('disabled');
                $('ul.setup-panel li a[href="#inclusion-step-3"]').trigger('click');
                $('#inclusion-activate-step-4').show();
               	return false;
			});
           
	       $('#inclusionassessment').on('submit',function(){
                $('.load_hidden-spinner').css('display', 'inline-block');
                var postData = $(this).serializeArray();
                var formURL = $(this).attr("action");
			    submitAssessmentData(formURL, postData);
               
                return false;
            });
           $('#inclusionassessment-form-edit').on('submit',function(){
                $('.load_hidden-spinner').css('display', 'inline-block');
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
                            $('.load_hidden-spinner').css('display', 'none');
							
							if(response.success === true ){

								$('.inform_assessor').html(response.message);
								setTimeout(function(){ 
								         if(response.action != 'update'){
											$("form").trigger('reset');
											location.reload('/wheelchair/');
										}
                                  }, 3000);
								setTimeout(function(){ 
									 $('.remove-alert').hide();
									 $('.remove-alert').fadeOut('slow');
								  }, 5000);

							}else{
								$('.inform_assessor').html(response.message);
								setTimeout(function(){ 
									 $('.remove-alert').hide();
									 $('.remove-alert').fadeOut('slow');
								  }, 5000);
								
							}

						},
						error: function(xhr,status, response) {

							if( xhr.status === 400 ) {
								var errors = xhr.responseJSON.errors;
								$.each(errors, function (key, value) {
									errorsHtml += '<li>' + value[0] + '</li>'; //showing only the first error.
								});
								errorsHtml += '</ul></di>';
								$('.inform_assessor').html(errorsHtml); 
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