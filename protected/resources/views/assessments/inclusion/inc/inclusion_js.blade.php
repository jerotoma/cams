<script>
	$(document).ready(function () {
    $('.inclusion-assessment fieldset:first-child').fadeIn('slow');

    $('.inclusion-assessment input[type="text"]').on('focus', function () {
        $(this).removeClass('input-error');
    });

    // next step
    $('.inclusion-assessment .btn-next').on('click', function () {
        var parent_fieldset = $(this).parents('fieldset');
        var next_step = true;

        parent_fieldset.find('input[type="text"],input[type="email"]').each(function () {
            if ($(this).val() == "s") {
                $(this).addClass('input-error');
                next_step = false;
            } else {
                $(this).removeClass('input-error');
            }
        });

        if (next_step) {
            parent_fieldset.fadeOut(400, function () {
                $(this).next().fadeIn();
            });
        }

    });

    // previous step
    $('.inclusion-assessment .btn-previous').on('click', function () {
        $(this).parents('fieldset').fadeOut(400, function () {
            $(this).prev().fadeIn();
        });
    });

        $('#inclusion-assessment').on('submit',function(){
                    $('.load_hidden-spinner').css('display', 'inline-block');
                    var postData = $(this).serializeArray();
                    var formURL = $(this).attr("action");
                    submitAssessmentData(formURL, postData);

                    return false;
                });
        $('#update-inclusion-assessment').on('submit',function(){
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
    
    // submit
  /*  $('.registration-form').on('submit', function (e) {

        $(this).find('input[type="text"],input[type="email"]').each(function () {
            if ($(this).val() == "s") {
                e.preventDefault();
                $(this).addClass('input-error');
            } else {
                $(this).removeClass('input-error');
            }
        });

    });*/
        

   </script>