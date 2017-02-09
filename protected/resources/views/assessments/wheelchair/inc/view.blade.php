<?php $wca = new WheelChairAssessmentHelper(); ?>
<style>
    .form-control{
        width:100% !important;
    }
	.load_hidden-spinner{
            display: none;
            width:40px;
            height:40px;
            border: 2px solid #BB0F18;
            border-top-color:#68bc45;
            border-radius: 100%;
            position:absolute;
            left:400px;
            margin:auto;
            z-index: 9999;
            animation: round 2s linear infinite;
     }
	@keyframes round{
            from{transform: rotate(0deg)}
            to{transform: rotate(360deg)}  
     }
</style>
 <form id="wheelchairassessment-edit" action="{{url('assessments/wheelchair')}}/{{$wc_assessment->id}}/edit" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="row">
	<div class="col-xs-12">
         <div class="col-md-12 well">    
			 <div class="row">
				 <div class="col-md-6">
					 <div class="form-group form-inline">
                         <label>Assessor’s name: &nbsp;&nbsp;&nbsp; {{$assessor->full_name}}</label> 
						<!--	<input class="form-control" type="text" name="assessor_name" value="{{$assessor->full_name}}">  -->
			           </div>
			     </div>
			     <div class="col-md-6">
					 <div class="form-group form-inline">
                          <label>Date of assessment:  &nbsp;&nbsp;&nbsp; {{$wc_assessment->created_at}} </label> 
                          <!-- <input class="form-control" type="text" name="assessor_name" value="{{$wc_assessment->created_at}}">  -->
					</div>
				</div>
			 </div>
	   </div>
   </div>
</div>
<div class="row">
        <div class="col-xs-12">
            <div class="col-md-12 well text-center">
                <h1>Information about the wheelchair user</h1>
                    <div class="form-group">
                            <div class="row clearfix">
                                <div class="col-md-12 column">
                                      <table class="table table-bordered table-hover" id="tab_logic">
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
                                                    Age
                                                </th>
                                                <th class="text-center">
                                                   Phone
                                                </th>
                                                <th class="text-center">
                                                    Address
                                                </th>
										    </tr>
                                        </thead>
                                        <tbody>
											<?php $count = 1; ?>
										@if(!empty($assessedClient ))
												<tr id='addr0'>
													<td class="text-center">
														{{$wc_assessment->id}}
													</td>
													<td class="text-center">
														{{$assessedClient->client_number}}
													</td>
													<td class="text-center">
														{{$assessedClient->full_name}}
													</td>
													<td class="text-center">
														{{$assessedClient->sex}}
													</td>
												   <td class="text-center">
													   {{$assessedClient->age}}
													</td>
													<td class="text-center">
													   {{$assessedClient->phone}}
													</td>
													<td class="text-center">
													   {{$assessedClient->address}}
													</td>
												  </tr>
											@endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                   <div class="form-group form-inline">
                       <label>Goals : </label>
                       <input class="form-control" type="text" name="cliend_goal" value="{{$wc_assessment->id}}">  
                  </div>
              
              </div>
        </div>
    </div>
                                              
<div class="row">
        <div class="col-xs-12">
            <div class="col-md-12 well">
              
                <div class="form-group"> 
					<div class="row">
                          <div class="col-md-12">
                             <h3 class="text-center"> Physical</h3>
						  </div> 
					</div>
					 <hr>
                    <div class="row">
                          <div class="col-md-3">
                             <h3 class="text-left">Diagnosis : </h3>
                           </div> 
                           <div class="col-md-9">
                               <div class="row">
                                   <div class="col-md-4 col-md-pull-1">
                                      
                                       <div class="checkbox">
                                           <label class="checkbox text-left"><input type="checkbox" name="assess_interview_diagnosis_qn_1[]" <?php if($wca->isCheckedBox($assessInterview->assess_interview_diagnosis_qn_1,'Brain Injury')){ echo "checked"; } ?> value="Brain Injury">Brain Injury</label>
                                           <label class="checkbox text-left"><input type="checkbox" name="assess_interview_diagnosis_qn_1[]" <?php if($wca->isCheckedBox($assessInterview->assess_interview_diagnosis_qn_1,'Cerebral Palsy')){ echo "checked"; } ?> value="Cerebral Palsy">Cerebral Palsy </label>
                                           <label class="checkbox text-left"><input type="checkbox" name="assess_interview_diagnosis_qn_1[]" <?php if($wca->isCheckedBox($assessInterview->assess_interview_diagnosis_qn_1,'Muscular Dystrophy')){ echo "checked"; } ?> value="Muscular Dystrophy">Muscular Dystrophy</label> 
                                       </div>
                                   </div>
                                   <div class="col-md-4 col-md-pull-2">
                                      <div class="checkbox">
                                           <label class="checkbox text-left "><input type="checkbox"  name="assess_interview_diagnosis_qn_1[]" <?php if($wca->isCheckedBox($assessInterview->assess_interview_diagnosis_qn_1,'Polio')){ echo "checked"; } ?> value="Polio">Polio</label>
                                           <label class="checkbox text-left"><input type="checkbox"   name="assess_interview_diagnosis_qn_1[]" <?php if($wca->isCheckedBox($assessInterview->assess_interview_diagnosis_qn_1,'Spina Bifida')){ echo "checked"; } ?> value="Spina Bifida">Spina Bifida</label>
                                           <label class="checkbox text-left"><input type="checkbox"   name="assess_interview_diagnosis_qn_1[]" <?php if($wca->isCheckedBox($assessInterview->assess_interview_diagnosis_qn_1,'Spinal Cord Injury')){ echo "checked"; } ?> value="Spinal Cord Injury">Spinal Cord Injury </label> 
                                       </div>
                                   </div> 
                                   <div class="col-md-4 col-md-pull-3">
                                       <div class="checkbox">
                                           <label class="checkbox text-left "><input type="checkbox" name="assess_interview_diagnosis_qn_1[]" <?php if($wca->isCheckedBox($assessInterview->assess_interview_diagnosis_qn_1,'Stroke')){ echo "checked"; } ?> value="Stroke">Stroke</label>
                                           <label class="checkbox text-left"><input type="checkbox"  name="assess_interview_diagnosis_qn_1[]" <?php if($wca->isCheckedBox($assessInterview->assess_interview_diagnosis_qn_1,'Unknown')){ echo "checked"; } ?> value="Unknown">Unknown</label>
                                           <label class="checkbox text-left"><input type="checkbox"  name="assess_interview_diagnosis_qn_1[]" <?php if($wca->isCheckedBox($assessInterview->assess_interview_diagnosis_qn_1,'Other')){ echo "checked"; } ?> value="Other">Other</label> 
                                       </div>
                                   </div>
                               </div>
                               <div class="row">
                                 <div class="col-md-6 col-md-pull-1">
                                     <div class="checkbox">
                                          <p>Is the condition likely to become worse?</p>
                                     </div>  
                                   </div>
                                <div class="col-md-6 col-md-pull-2">
                                    <div class="checkbox">
                                      <label class="radio-inline"><input type="radio" name ="assess_interview_diagnosis_qn_2" <?php if($wca->isCheckedRadio($assessInterview->assess_interview_diagnosis_qn_2, 'Yes')){echo 'checked';}?> value="Yes">Yes</label>
                                      <label class="radio-inline"><input type="radio" name ="assess_interview_diagnosis_qn_2"  <?php if($wca->isCheckedRadio($assessInterview->assess_interview_diagnosis_qn_2, 'No')){echo 'checked';}?> value="No">No</label>
                                    </div>
                                </div>
                            </div> 
                          </div>
                    </div>
                    <hr>
                    <div class="row">
                          <div class="col-md-3 ">
                             <h3 class="text-left">Physical issues : </h3>
                           </div>
                           <div class="col-md-9">
                               <div class="row">
                                   <div class="col-md-12 col-md-pull-1">
                                       <div class="checkbox">
                                           <label class="checkbox-inline text-left move-left"><input type="checkbox" name ="assess_interview_physical_issues_qn_1[]" <?php if($wca->isCheckedBox($assessInterview->assess_interview_physical_issues_qn_1,'Frail')){ echo "checked"; } ?> value="Frail">Frail</label>
                                           <label class="checkbox-inline text-left move-left"><input type="checkbox" name ="assess_interview_physical_issues_qn_1[]" <?php if($wca->isCheckedBox($assessInterview->assess_interview_physical_issues_qn_1,'Spasms/uncontrolled movements')){ echo "checked"; } ?> value="Spasms/uncontrolled movements">Spasms/uncontrolled movements</label>
                                           <label class="checkbox-inline text-left move-left"><input type="checkbox" name ="assess_interview_physical_issues_qn_1[]" <?php if($wca->isCheckedBox($assessInterview->assess_interview_physical_issues_qn_1,'Muscle tone (high/low)')){ echo "checked"; } ?> value="Muscle tone (high/low)">Muscle tone (high/low)</label> 
                                      </div> 
                                   </div>
                               </div>
                               <div class="row">
                                   <div class="col-md-4 col-md-pull-1">
                                       <div class="checkbox">
                                          <p>Lower limb amputation: </p>
                                     </div>  
                                 </div>
                               </div>
                               <div class="row">
                                   <div class="col-md-4 col-md-pull-1">
                                    <div class="checkbox">
                                       <label class="checkbox"><input type="checkbox" name ="assess_interview_physical_issues_qn_2[]" <?php if($wca->isCheckedBox($assessInterview->assess_interview_physical_issues_qn_2,'R above knee')){ echo "checked"; } ?> value="R above knee">R above knee</label> 
                                       <label class="checkbox"><input type="checkbox" name ="assess_interview_physical_issues_qn_2[]" <?php if($wca->isCheckedBox($assessInterview->assess_interview_physical_issues_qn_2,'R below knee')){ echo "checked"; } ?> value="R below knee">R below knee</label>
                                       <label class="checkbox"><input type="checkbox" name ="assess_interview_physical_issues_qn_2[]" <?php if($wca->isCheckedBox($assessInterview->assess_interview_physical_issues_qn_2,'L above knee')){ echo "checked"; } ?> value="L above knee">L above knee</label>
                                    </div>
                                   </div>
                                   <div class="col-md-4 col-md-pull-1">
                                     <div class="checkbox">
                                       <label class="checkbox"><input type="checkbox" name ="assess_interview_physical_issues_qn_2[]" <?php if($wca->isCheckedBox($assessInterview->assess_interview_physical_issues_qn_2,'L above knee')){ echo "checked"; } ?> value="L above knee">L above knee</label>
                                       <label class="checkbox"><input type="checkbox" name ="assess_interview_physical_issues_qn_2[]" <?php if($wca->isCheckedBox($assessInterview->assess_interview_physical_issues_qn_2,'Fatigue')){ echo "checked"; } ?> value="Fatigue">Fatigue</label> 
                                       <label class="checkbox"><input type="checkbox" name ="assess_interview_physical_issues_qn_2[]" <?php if($wca->isCheckedBox($assessInterview->assess_interview_physical_issues_qn_2,'Hip dislocation')){ echo "checked"; } ?> value="Hip dislocation">Hip dislocation</label>
                                     </div>
                                   </div>
                                   <div class="col-md-4 col-md-pull-2">
                                       <div class="checkbox">
                                       <label class="checkbox"><input type="checkbox" name ="assess_interview_physical_issues_qn_2[]" <?php if($wca->isCheckedBox($assessInterview->assess_interview_physical_issues_qn_2,'Epilepsy')){ echo "checked"; } ?> value="Epilepsy">Epilepsy</label>
                                       </div>
                                   </div>
                               </div>
                               <div class="row">
                                 <div class="col-md-5 col-md-pull-1">
                                     <div class="checkbox">
                                          <p>Problems with eating, drinking and swallowing</p>
                                     </div>  
                                 </div>
                                 <div class="col-md-3 col-md-pull-1">
                                    <div class="checkbox">
                                      <label class="checkbox-inline"><input type="checkbox" name ="assess_interview_physical_issues_qn_3[]" <?php if($wca->isCheckedBox($assessInterview->assess_interview_physical_issues_qn_3,'Problems with eating, drinking and swallowing')){ echo "checked"; } ?> value="Problems with eating, drinking and swallowing"></label>
                                    </div>
                                 
                                 </div>
                                <div class="col-md-4 col-md-pull-2">
                                    <div clas="form-group"> 
                                        <input type="text" class="form-control"  placeholder="Describe" name ="assess_interview_physical_issues_qn_3_describe" value="">                                    
                                    </div>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-md-4 col-md-pull-1">
                                    <div class="checkbox">
                                      <label class="checkbox-inline"><input type="checkbox" name ="assess_interview_physical_issues_qn_4[]" <?php if($wca->isCheckedBox($assessInterview->assess_interview_physical_issues_qn_4,'Pain')){ echo "checked"; } ?> value="Pain">Pain</label>
                                    </div>
                                </div>
                                <div class="col-md-8 col-md-pull-3">
                                    <div clas="form-group"> 
                                       <input type="text" class="form-control"  placeholder="Describe location" name ="assess_interview_physical_issues_qn_4_describe" value="">                                    
                                    </div>
                                 </div>
                              </div> 
                              <div class="row">
                                 <div class="col-md-6 col-md-pull-1">
                                    <div class="checkbox">
                                      <label class="checkbox-inline"><input type="checkbox" name ="assess_interview_physical_issues_qn_5[]" <?php if($wca->isCheckedBox($assessInterview->assess_interview_physical_issues_qn_5,'Bladder problems')){ echo "checked"; } ?> value="Bladder problems">Bladder problems</label>
                                      <label class="checkbox-inline"><input type="checkbox" name ="assess_interview_physical_issues_qn_5[]" <?php if($wca->isCheckedBox($assessInterview->assess_interview_physical_issues_qn_5,'Bowel problems')){ echo "checked"; } ?> value="Bowel problems">Bowel problems</label>
                                     </div>
                                </div>
                              </div>
                               <div class="row">
                                 <div class="col-md-8 col-md-pull-1">
                                     <div class="checkbox">
                                          <p>If the wheelchair user has bladder or bowel problems, is this managed?</p>
                                     </div>  
                                   </div>
                                <div class="col-md-4 col-md-pull-1">
                                    <div class="checkbox">
                                      <label class="radio-inline"><input type="radio" name ="assess_interview_physical_issues_qn_6" <?php if($wca->isCheckedRadio($assessInterview->assess_interview_physical_issues_qn_6, 'Yes')){echo 'checked';}?> value="Yes">Yes</label>
                                      <label class="radio-inline"><input type="radio" name ="assess_interview_physical_issues_qn_6" <?php if($wca->isCheckedRadio($assessInterview->assess_interview_physical_issues_qn_6, 'No')){echo 'checked';}?> value="No">No</label>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
                    <hr>
					<div class="row">
                        <div class="col-md-12">
                             <h3 class="text-center">Lifestyle and environment :</h3>
						</div> 
					</div>
					 <hr>
                    <div class="row">
                            <div class="col-md-12">
                               <div class="row">
                                   <div class="col-md-12 col-md-pull-0">
                                       <div clas="form-group"> 
                                        <label for="describe1">Describe where the wheelchair user will use their wheelchair:</label>
                                        <input type="text" class="form-control" id="" placeholder="Describe" name ="assess_interview_lifestyle_env_qn_1_describe" value="">                                    
                                    </div>
                                   </div>
                               </div>
                               <div class="row">
                                 <div class="col-md-6 col-md-pull-0">
                                     <div class="radio">
                                          <p>Distance travelled per day</p>
                                     </div>  
                                   </div>
                                <div class="col-md-6 col-md-pull-0">
                                    <div class="radio">
                                      <label class="radio-inline"><input type="radio" name ="assess_interview_lifestyle_env_qn_1" <?php if($wca->isCheckedRadio($assessInterview->assess_interview_lifestyle_env_qn_1, 'Up to 1km')){echo 'checked';}?> value="Up to 1km">Up to 1km</label>
                                      <label class="radio-inline"><input type="radio" name ="assess_interview_lifestyle_env_qn_1" <?php if($wca->isCheckedRadio($assessInterview->assess_interview_lifestyle_env_qn_1, '1-5km')){echo 'checked';}?>  value="1-5km">1-5km</label>
                                      <label class="radio-inline"><input type="radio" name ="assess_interview_lifestyle_env_qn_1" <?php if($wca->isCheckedRadio($assessInterview->assess_interview_lifestyle_env_qn_1, 'Mor than 5km')){echo 'checked';}?> value="More than 5km">More than 5km</label>
                                    </div>
                                </div>
                               </div> 
                               <div class="row">
                                 <div class="col-md-6 col-md-pull-0">
                                     <div class="radio">
                                          <p>Hours per day using wheelchair</p>
                                     </div>  
                                   </div>
                                <div class="col-md-6 col-md-pull-0">
                                    <div class="radio">
                                      <label class="radio-inline"><input type="radio" name ="assess_interview_lifestyle_env_qn_2" <?php if($wca->isCheckedRadio($assessInterview->assess_interview_lifestyle_env_qn_2, 'Less than 1')){echo 'checked';}?> value="Less than 1">Less than 1 </label>
                                      <label class="radio-inline"><input type="radio" name ="assess_interview_lifestyle_env_qn_2" <?php if($wca->isCheckedRadio($assessInterview->assess_interview_lifestyle_env_qn_2, '1-3')){echo 'checked';}?>  value="1-3">1-3</label>
                                      <label class="radio-inline"><input type="radio" name ="assess_interview_lifestyle_env_qn_2" <?php if($wca->isCheckedRadio($assessInterview->assess_interview_lifestyle_env_qn_2, '3-5')){echo 'checked';}?> value="3-5">3-5</label>
                                      <label class="radio-inline"><input type="radio" name ="assess_interview_lifestyle_env_qn_2" <?php if($wca->isCheckedRadio($assessInterview->assess_interview_lifestyle_env_qn_2, '5-8')){echo 'checked';}?> value="5-8">5-8</label>
                                      <label class="radio-inline"><input type="radio" name ="assess_interview_lifestyle_env_qn_2" <?php if($wca->isCheckedRadio($assessInterview->assess_interview_lifestyle_env_qn_2, 'more than 8')){echo 'checked';}?> value="more than 8">more than 8</label>
                                    </div>
                                </div>
                               </div>
                               <div class="row">
                                   <div class="col-md-12 col-md-pull-0">
                                       <div clas="form-group"> 
                                        <label for="describe1">When out of the wheelchair, where does the wheelchair user sit or lie down and how (posture and surface)?</label>
                                        <input type="text" class="form-control"  placeholder="Describe" name ="assess_interview_lifestyle_env_qn_3" value="">                                    
                                    </div>
                                   </div>
                               </div>
                               <div class="row">
                                 <div class="col-md-4 col-md-pull-0">
                                     <div class="radio">
                                          <p>Transfer : </p>
                                     </div>  
                                   </div>
                                <div class="col-md-8 col-md-pull-0">
                                    <div class="radio">
                                      <label class="radio-inline"><input type="radio" name ="assess_interview_lifestyle_env_qn_4"  <?php if($wca->isCheckedRadio($assessInterview->assess_interview_lifestyle_env_qn_4, 'Independent')){echo 'checked';}?> value="Independent">Independent</label>
                                      <label class="radio-inline"><input type="radio" name ="assess_interview_lifestyle_env_qn_4"  <?php if($wca->isCheckedRadio($assessInterview->assess_interview_lifestyle_env_qn_4, 'Assisted')){echo 'checked';}?> value="Assisted">Assisted</label>
                                      <label class="radio-inline"><input type="radio" name ="assess_interview_lifestyle_env_qn_4"  <?php if($wca->isCheckedRadio($assessInterview->assess_interview_lifestyle_env_qn_4, 'Standing')){echo 'checked';}?> value="Standing">Standing</label>
                                      <label class="radio-inline"><input type="radio" name ="assess_interview_lifestyle_env_qn_4"  <?php if($wca->isCheckedRadio($assessInterview->assess_interview_lifestyle_env_qn_4, 'Non-standing')){echo 'checked';}?> value="Non-standing">Non-standing </label>
                                      <label class="radio-inline"><input type="radio" name ="assess_interview_lifestyle_env_qn_4"  <?php if($wca->isCheckedRadio($assessInterview->assess_interview_lifestyle_env_qn_4, 'Lifted')){echo 'checked';}?> value="Lifted">Lifted</label>
                                      <label class="radio-inline"><input type="radio" name ="assess_interview_lifestyle_env_qn_4"  <?php if($wca->isCheckedRadio($assessInterview->assess_interview_lifestyle_env_qn_4, 'Other')){echo 'checked';}?> value="Other">Other</label>
                                    </div>
                                </div>
                               </div>
                               <div class="row">
                                 <div class="col-md-6 col-md-pull-0">
                                     <div class="radio">
                                          <p>Type of toilet (if transferring to a toilet)</p>
                                     </div>  
                                   </div>
                                <div class="col-md-6 col-md-pull-1">
                                    <div class="radio">
                                      <label class="radio-inline"><input type="radio" name ="assess_interview_lifestyle_env_qn_5"   <?php if($wca->isCheckedRadio($assessInterview->assess_interview_lifestyle_env_qn_5, 'Squat')){echo 'checked';}?> value="Squat">Squat</label>
                                      <label class="radio-inline"><input type="radio" name ="assess_interview_lifestyle_env_qn_5"   <?php if($wca->isCheckedRadio($assessInterview->assess_interview_lifestyle_env_qn_5, 'Western')){echo 'checked';}?> value="Western">Western </label>
                                      <label class="radio-inline"><input type="radio" name ="assess_interview_lifestyle_env_qn_5"   <?php if($wca->isCheckedRadio($assessInterview->assess_interview_lifestyle_env_qn_5, 'Adapted')){echo 'checked';}?> value="Adapted">Adapted</label>
                                    </div>
                                </div>
                               </div>
                               <div class="row">
                                 <div class="col-md-6 col-md-pull-0">
                                     <div class="radio">
                                          <p>Does the wheelchair user often use public/private transport</p>
                                     </div>  
                                   </div>
                                <div class="col-md-6 col-md-pull-1">
                                    <div class="radio">
                                      <label class="radio-inline"><input type="radio" name ="assess_interview_lifestyle_env_qn_6" <?php if($wca->isCheckedRadio($assessInterview->assess_interview_lifestyle_env_qn_6, 'Yes')){echo 'checked';}?> value="Yes">Yes</label>
                                      <label class="radio-inline"><input type="radio" name ="assess_interview_lifestyle_env_qn_6" <?php if($wca->isCheckedRadio($assessInterview->assess_interview_lifestyle_env_qn_6, 'No')){echo 'checked';}?> value="No">No</label>
                                    </div>
                                </div>
                               </div>
                               <div class="row">
                                 <div class="col-md-6 col-md-pull-0">
                                     <div class="radio">
                                          <p>If yes, then what kind:</p>
                                     </div>  
                                   </div>
                                <div class="col-md-6 col-md-pull-2">
                                    <div class="radio">
                                      <label class="radio-inline"><input type="radio" name ="assess_interview_lifestyle_env_qn_7" <?php if($wca->isCheckedRadio($assessInterview->assess_interview_lifestyle_env_qn_7, 'Car')){echo 'checked';}?> value="Car">Car</label>
                                      <label class="radio-inline"><input type="radio" name ="assess_interview_lifestyle_env_qn_7" <?php if($wca->isCheckedRadio($assessInterview->assess_interview_lifestyle_env_qn_7, 'Tax')){echo 'checked';}?> value="Tax">Tax</label>
                                      <label class="radio-inline"><input type="radio" name ="assess_interview_lifestyle_env_qn_7" <?php if($wca->isCheckedRadio($assessInterview->assess_interview_lifestyle_env_qn_7, 'Bus')){echo 'checked';}?> value="Bus">Bus</label>
                                    </div>
                                    <div clas="form-group"> 
                                        <label for="describe1">Other</label>
                                        <input type="text" class="form-control" id="describe1" placeholder="Describe" name ="assess_interview_lifestyle_env_qn_7_describe" value="">                                    
                                    </div>
                                </div>
                               </div>
                               
                          </div>
                    </div>
                    <hr>
					<div class="row">
                          <div class="col-md-12">
                             <h3 class="text-center">Existing wheelchair (if a person already  has a wheelchair) :</h3>
						</div> 
					</div>
					 <hr>
                    <div class="row">
                           <div class="col-md-12">
                              <div class="row">
                                  <div class="col-md-6 col-md-pull-0">
                                     <div class="radio">
                                          <p>Does the wheelchair meet the user’s needs?</p>
                                     </div>  
                                   </div>
                                    <div class="col-md-6 col-md-pull-0">
                                        <div class="radio">
                                          <label class="radio-inline"><input type="radio" name ="assess_interview_existing_wheelchair_qn_1" <?php if($wca->isCheckedRadio($assessInterview->assess_interview_existing_wheelchair_qn_1, 'Yes')){echo 'checked';}?> value="Yes">Yes</label>
                                          <label class="radio-inline"><input type="radio" name ="assess_interview_existing_wheelchair_qn_1" <?php if($wca->isCheckedRadio($assessInterview->assess_interview_existing_wheelchair_qn_1, 'No')){echo 'checked';}?> value="No">No</label>
                                        </div>
                                    </div>
                               </div>
                            <div class="row">
                                  <div class="col-md-6 col-md-pull-0">
                                     <div class="radio">
                                          <p>Does the wheelchair meet the user’s environmental conditions?	</p>
                                     </div>  
                                   </div>
                                    <div class="col-md-6 col-md-pull-0">
                                        <div class="radio">
                                          <label class="radio-inline"><input type="radio" name ="assess_interview_existing_wheelchair_qn_2" <?php if($wca->isCheckedRadio($assessInterview->assess_interview_existing_wheelchair_qn_2, 'Yes')){echo 'checked';}?> value="Yes">Yes</label>
                                          <label class="radio-inline"><input type="radio" name ="assess_interview_existing_wheelchair_qn_2" <?php if($wca->isCheckedRadio($assessInterview->assess_interview_existing_wheelchair_qn_2, 'No')){echo 'checked';}?>  value="No">No</label>
                                        </div>
                                    </div>
                               </div>
                            <div class="row">
                                  <div class="col-md-6 col-md-pull-0">
                                     <div class="radio">
                                          <p>Does the wheelchair provide proper fit and postural support? </p>
                                     </div>  
                                   </div>
                                    <div class="col-md-6 col-md-pull-0">
                                        <div class="radio">
                                          <label class="radio-inline"><input type="radio" name ="assess_interview_existing_wheelchair_qn_3" <?php if($wca->isCheckedRadio($assessInterview->assess_interview_existing_wheelchair_qn_3, 'Yes')){echo 'checked';}?> value="Yes">Yes</label>
                                          <label class="radio-inline"><input type="radio" name ="assess_interview_existing_wheelchair_qn_3" <?php if($wca->isCheckedRadio($assessInterview->assess_interview_existing_wheelchair_qn_3, 'No')){echo 'checked';}?> value="No">No</label>
                                        </div>
                                    </div>
                               </div>
                            <div class="row">
                                  <div class="col-md-6 col-md-pull-0">
                                     <div class="radio">
                                          <p>Is the wheelchair safe and durable?	(Consider whether there is a cushion)</p>
                                     </div>  
                                   </div>
                                    <div class="col-md-6 col-md-pull-0">
                                        <div class="radio">
                                          <label class="radio-inline"><input type="radio" name ="assess_interview_existing_wheelchair_qn_4" <?php if($wca->isCheckedRadio($assessInterview->assess_interview_existing_wheelchair_qn_4, 'Yes')){echo 'checked';}?>  value="Yes">Yes</label>
                                          <label class="radio-inline"><input type="radio" name ="assess_interview_existing_wheelchair_qn_4" <?php if($wca->isCheckedRadio($assessInterview->assess_interview_existing_wheelchair_qn_4, 'No')){echo 'checked';}?> value="No">No</label>
                                        </div>
                                    </div>
                               </div>
                            <div class="row">
                                  <div class="col-md-6 col-md-pull-0">
                                     <div class="radio">
                                          <p>Does the cushion provide proper pressure relief (if user has pressure sore risk)? </p>
                                     </div>  
                                   </div>
                                    <div class="col-md-6 col-md-pull-0">
                                        <div class="radio">
                                          <label class="radio-inline"><input type="radio" name ="assess_interview_existing_wheelchair_qn_5" <?php if($wca->isCheckedRadio($assessInterview->assess_interview_existing_wheelchair_qn_5, 'Yes')){echo 'checked';}?>  value="Yes">Yes</label>
                                          <label class="radio-inline"><input type="radio" name ="assess_interview_existing_wheelchair_qn_5" <?php if($wca->isCheckedRadio($assessInterview->assess_interview_existing_wheelchair_qn_5, 'No')){echo 'checked';}?>  value="No">No</label>
                                        </div>
                                    </div>
                             </div>
                             <div class="row">
                                   <div class="col-md-12 col-md-pull-0">
                                       <div clas="form-group"> 
                                        <label for="describe1">Comments:</label>
                                        <input type="text" class="form-control" id="describe1" placeholder="Describe" name ="assess_interview_existing_wheelchair_qn_6" value="">                                    
                                        </div>
                                   </div>
                             </div>
                             <div class="row">
                                   <div class="col-md-12 col-md-pull-0">
                                       <div clas="form-group"> 
                                         <p>If yes to all questions, the user may not need a new wheelchair. If no to any of these questions, the user needs a different wheelchair or cushion; or the existing wheelchair or cushion needs repairs or modifications. </p>
                                       </div>
                                   </div>
                             </div>
                          </div>
                    </div>
                    <hr>
                    
                </div>
                
            </div>
        </div>
    </div>    

    <div class="row">
            <div class="col-xs-12">
                <div class="col-md-12 well">
                
                    <div class="form-group"> 
                        <div class="row">
                          <div class="col-md-12">
                             <h3 class="text-center">Presence, risk of or history of pressure sores :</h3>
                           </div> 
                         </div>
                          <hr/>
                          <div class="row">
                              <div class="col-md-12">
                                   <div class="row">
                                       <div class="col-md-6 col-md-pull-0">
                                          <p> <span>///</span> = does not feel  &nbsp;&nbsp;<i class="fa fa-genderless" aria-hidden="true"></i> = previous pressure sore</p>
                                           <p><i class="fa fa-circle" aria-hidden="true"></i> = existing pressure sore </p>
                                          <p><img src="{{url('protected/public/uploads/images/pressure_sore.png')}}" class="img-responsive"></p>
                                       </div>
                                       <div class="col-md-6">
                                           <div class="row">
                                                  <div class="col-md-6 col-md-pull-0">
                                                     <div class="radio">
                                                          <p>Can feel normally?</p>
                                                     </div>  
                                                   </div>
                                                  <div class="col-md-6 col-md-pull-0">
                                                        <div class="checkbox">
                                                          <label class="radio-inline"><input type="radio" name ="physical_assess_presence_risk_qn_1" <?php if($wca->isCheckedRadio($passessment->physical_assess_presence_risk_qn_1, 'Yes')){echo 'checked';}?>  value="Yes">Yes</label>
                                                          <label class="radio-inline"><input type="radio" name ="physical_assess_presence_risk_qn_1" <?php if($wca->isCheckedRadio($passessment->physical_assess_presence_risk_qn_1, 'No')){echo 'checked';}?> value="No">No</label>
                                                        </div>
                                                  </div>
                                            </div> 
                                            <div class="row">
                                                  <div class="col-md-6 col-md-pull-0">
                                                     <div class="radio">
                                                          <p>Previous pressure sore?</p>
                                                     </div>  
                                                   </div>
                                                  <div class="col-md-6 col-md-pull-0">
                                                        <div class="checkbox">
                                                          <label class="radio-inline"><input type="radio" name ="physical_assess_presence_risk_qn_2" <?php if($wca->isCheckedRadio($passessment->physical_assess_presence_risk_qn_2, 'Yes')){echo 'checked';}?> value="Yes">Yes</label>
                                                          <label class="radio-inline"><input type="radio" name ="physical_assess_presence_risk_qn_2" <?php if($wca->isCheckedRadio($passessment->physical_assess_presence_risk_qn_2, 'No')){echo 'checked';}?>  value="No">No</label>
                                                        </div>
                                                  </div>
                                            </div> 
                                            <div class="row">
                                                  <div class="col-md-6 col-md-pull-0">
                                                     <div class="radio">
                                                          <p>Current pressure sore?</p>
                                                     </div>  
                                                   </div>
                                                  <div class="col-md-6 col-md-pull-0">
                                                        <div class="checkbox">
                                                          <label class="radio-inline"><input type="radio" name ="physical_assess_presence_risk_qn_3" <?php if($wca->isCheckedRadio($passessment->physical_assess_presence_risk_qn_3, 'Yes')){echo 'checked';}?> value="Yes">Yes</label>
                                                          <label class="radio-inline"><input type="radio" name ="physical_assess_presence_risk_qn_3" <?php if($wca->isCheckedRadio($passessment->physical_assess_presence_risk_qn_3, 'No')){echo 'checked';}?> value="No">No</label>
                                                        </div>
                                                  </div>
                                            </div> 
                                            <div class="row">
                                                  <div class="col-md-6 col-md-pull-0">
                                                     <div class="radio">
                                                          <p>If yes, is it an open sore (stage 1–4)?</p>
                                                     </div>  
                                                   </div>
                                                  <div class="col-md-6 col-md-pull-0">
                                                        <div class="checkbox">
                                                          <label class="radio-inline"><input type="radio" name ="physical_assess_presence_risk_qn_4" <?php if($wca->isCheckedRadio($passessment->physical_assess_presence_risk_qn_4, 'Yes')){echo 'checked';}?> value="Yes">Yes</label>
                                                          <label class="radio-inline"><input type="radio" name ="physical_assess_presence_risk_qn_4" <?php if($wca->isCheckedRadio($passessment->physical_assess_presence_risk_qn_4, 'No')){echo 'checked';}?> value="No">No</label>
                                                        </div>
                                                  </div>
                                            </div>
                                            <div class="row">
                                               <div class="col-md-12 col-md-pull-0">
                                                   <div clas="form-group"> 
                                                    <label for="describe1">Duration and cause:</label>
                                                    <input type="text" class="form-control" id="describe1" placeholder="Describe" name ="physical_assess_presence_risk_qn_5" value="">                                    
                                                </div>
                                               </div>
                                          </div>
                                       </div>
                                   </div>
                                   <div class="row">
                                     <div class="col-md-9 col-md-pull-0">
                                         <div class="radio">
                                              <p>Is this person at risk* of a pressure sore? *A person who cannot feel or has 3 or more risk factors is at risk. Risk factors: cannot move, moisture, poor posture, previous / current pressure sore, poor diet, ageing, under or over weight.</p>
                                         </div>  
                                       </div>
                                    <div class="col-md-3 col-md-pull-0">
                                        <div class="checkbox">
                                          <label class="radio-inline"><input type="radio" name ="physical_assess_presence_risk_qn_6" <?php if($wca->isCheckedRadio($passessment->physical_assess_presence_risk_qn_6, 'Yes')){echo 'checked';}?> value="Yes">Yes</label>
                                          <label class="radio-inline"><input type="radio" name ="physical_assess_presence_risk_qn_6" <?php if($wca->isCheckedRadio($passessment->physical_assess_presence_risk_qn_6, 'No')){echo 'checked';}?> value="No">No</label>
                                        </div>
                                    </div>
                                </div> 
                              </div>
                            </div>
                            <hr/>
                            <div class="row">
                                  <div class="col-md-12">
                                     <h3 class="text-center">Method of pushing </h3>
                                  </div>
                            </div>
                           <hr/>
                            <div class="row">
                                 <div class="col-md-12">
                                       <div class="row">
                                           <div class="col-md-12">
                                             <p>How will the wheelchair user push their wheelchair</p> 
                                           </div>
                                        </div> 
                                       <div class="row">
                                              <div class="col-md-3">
                                                 <div class="radio">
                                                      <div class="radio">
                                                      <label class="radio"><input type="radio" name ="physical_assess_method_of_pushing_qn_1" <?php if($wca->isCheckedRadio($passessment->physical_assess_method_of_pushing_qn_1, 'Both arms')){echo 'checked';}?> value="Both arms">Both arms</label>
                                                      <label class="radio"><input type="radio" name ="physical_assess_method_of_pushing_qn_1" <?php if($wca->isCheckedRadio($passessment->physical_assess_method_of_pushing_qn_1, 'Left arm')){echo 'checked';}?> value="Left arm">Left arm</label>
                                                     </div>
                                                 </div>  
                                               </div>
                                              <div class="col-md-3 col-md-pull-0">
                                                 <div class="radio">
                                                      <label class="radio"><input type="radio" name ="physical_assess_method_of_pushing_qn_1" <?php if($wca->isCheckedRadio($passessment->physical_assess_method_of_pushing_qn_1, 'Right arm')){echo 'checked';}?> value="Right arm">Right arm</label>
                                                      <label class="radio"><input type="radio" name ="physical_assess_method_of_pushing_qn_1" <?php if($wca->isCheckedRadio($passessment->physical_assess_method_of_pushing_qn_1, 'Both legs')){echo 'checked';}?> value="Both legs">Both legs</label>
                                                  </div>
                                              </div>
                                             <div class="col-md-3 col-md-pull-0">
                                                    <div class="radio">
                                                      <label class="radio"><input type="radio" name ="physical_assess_method_of_pushing_qn_1" <?php if($wca->isCheckedRadio($passessment->physical_assess_method_of_pushing_qn_1, 'Left leg')){echo 'checked';}?>  value="Left leg">Left leg</label>
                                                      <label class="radio"><input type="radio" name ="physical_assess_method_of_pushing_qn_1" <?php if($wca->isCheckedRadio($passessment->physical_assess_method_of_pushing_qn_1, 'Right leg')){echo 'checked';}?>  value="Right leg">Right leg</label>
                                                    </div>
                                            </div>
                                           <div class="col-md-3 col-md-pull-0">
                                                    <div class="radio">
                                                      <label class="radio"><input type="radio" name ="physical_assess_method_of_pushing_qn_1" <?php if($wca->isCheckedRadio($passessment->physical_assess_method_of_pushing_qn_1, 'Pushed by helper')){echo 'checked';}?>  value="Pushed by helper">Pushed by helper</label>
                                                    </div>
                                            </div>
                                        </div>
                                       <div class="row">
                                           <div class="col-md-12">
                                             <div clas="form-group"> 
                                                    <label for="describe1">Comment:</label>
                                                    <input type="text" class="form-control" placeholder="Describe" name ="physical_assess_method_of_pushing_qn_2_describe" value="">                                    
                                                </div>
                                           </div>
                                        </div>
                                    </div>
                                 </div>
                                <hr/>
                                <div class="row">
                                  <div class="col-md-12">
                                     <h3 class="text-center">Sitting posture without support</h3>
                                  </div>
                                </div>
                                 <hr/>
                                <div class="row">
                                     <div class="col-md-12">
                                       <div class="row">
                                           <div class="col-md-12">
                                             <div clas="form-group"> 
                                                    <label for="describe1">Describe or draw sitting posture without support:</label>
                                                    <textarea row="5" class="form-control"  name ="physical_assess_sitting_posture_without_support_qn_1" value=""> </textarea>                                   
                                                </div>
                                           </div>
                                        </div>
                                    </div>
                                </div>
                                <hr/>
                                <div class="row">
                                  <div class="col-md-12">
                                     <h3 class="text-center">Pelvis and hip posture screen</h3>
                                  </div>
                                </div>
                                 <hr/>
                                <div class="row">
                                     <div class="col-md-12">
                                       <div class="row">
                                           <div class="col-md-12">
                                             <div clas="form-group"> 
                                                    <label for="describe1">Check if pelvis is level and hip flexion range when lying</label>
                                             </div>
                                           </div>
                                        </div>
                                         <div class="row">
                                            <div class="col-md-4">
                                                <div class="radio">
                                                     <p>Can pelvis be level?</p> 
                                               </div> 
                                            </div>
                                           <div class="col-md-4 col-md-pull-2">
                                                <div class="radio">
                                                      <label class="radio-inline"><input type="radio" name ="physical_assess_pelvis_hip_posture_screen_qn_1" <?php if($wca->isCheckedRadio($passessment->physical_assess_pelvis_hip_posture_screen_qn_1, 'Yes')){echo 'checked';}?> value="Yes">Yes</label>
                                                      <label class="radio-inline"><input type="radio" name ="physical_assess_pelvis_hip_posture_screen_qn_1" <?php if($wca->isCheckedRadio($passessment->physical_assess_pelvis_hip_posture_screen_qn_1, 'No')){echo 'checked';}?>  value="No">No</label>
                                                </div> 
                                           </div>
                                        </div>
                                       <div class="row">
                                           <div class="col-md-12">
                                             <p>Can hip bend to neutral sitting posture?</p> 
                                           </div>
                                        </div> 
                                        <div class="row">
                                              <div class="col-md-2"></div>
                                              <div class="col-md-3">
                                                 <div class="radio">
                                                         <span class="text-left">Right hip: </span>
                                                          <label class="radio-inline"><input type="radio" name ="physical_assess_pelvis_hip_posture_screen_qn_2" <?php if($wca->isCheckedRadio($passessment->physical_assess_pelvis_hip_posture_screen_qn_2, 'Yes')){echo 'checked';}?> value="Yes">Yes</label>
                                                          <label class="radio-inline"><input type="radio" name ="physical_assess_pelvis_hip_posture_screen_qn_2" <?php if($wca->isCheckedRadio($passessment->physical_assess_pelvis_hip_posture_screen_qn_2, 'No')){echo 'checked';}?> value="No">No</label>
                                                          <label class="radio">Angle <input type="text" name ="physical_assess_pelvis_hip_posture_screen_qn_2_angle" value=""class="form-control"></label>
                                                 </div>  
                                               </div>
                                              <div class="col-md-3 col-md-pull-0">
                                                 <div class="radio">
                                                      <span class="text-left" >Left hip: </span>
                                                      <label class="radio-inline"><input type="radio" name ="physical_assess_pelvis_hip_posture_screen_qn_3" <?php if($wca->isCheckedRadio($passessment->physical_assess_pelvis_hip_posture_screen_qn_3, 'Yes')){echo 'checked';}?> value="">Yes</label>
                                                      <label class="radio-inline"><input type="radio" name ="physical_assess_pelvis_hip_posture_screen_qn_3" <?php if($wca->isCheckedRadio($passessment->physical_assess_pelvis_hip_posture_screen_qn_3, 'No')){echo 'checked';}?> value="">No</label>
                                                      <label class="radio">Angle <input type="text" name ="physical_assess_pelvis_hip_posture_screen_qn_3_angle" class="form-control" value=""></label>
                                                  </div>
                                              </div>
                                        </div>
                                         <div class="row">
                                              <div class="col-md-12">
                                                   <div class="alert alert-info">
                                                      <strong>Note : </strong> If pelvis cannot be level or hips cannot bend to neutral sitting posture– accommodate with temporary support.
                                                    </div>
                                             </div>
                                         </div>
                                    </div>
                                </div>
                                 <hr/>
                                 <div class="row">
                                  <div class="col-md-12">
                                     <h3 class="text-center">Hand simulation: support needed to sit in neutral posture / as close to neutral posture as is comfortable</h3>
                                  </div>
                                </div>
                                 <hr/>
                                 <div class="row">
                                  <div class="row clearfix">
                                    <div class="col-md-12">
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                                <tr >
                                                    <th class="text-center" colspan="4">
                                                      <p>For each body part: If neutral sitting posture is possible with hand support, tick yes. If not, tick no. </p>
                                                    </th>
                                                </tr>
                                                <tr >
                                                    <th width="100px">Part</th>
                                                    <th>Yes</th>
                                                    <th>No</th>
                                                    <th class="text-center">
                                                       Describe or line draw final sitting posture achieved by the wheelchair user with hand support and describe or line draw the support provided to achieve that sitting posture.
                                                    </th>
                                               </tr> 
                                             </thead>
                                            <tbody>
                             
                                               <tr >
                                                    <td width="100px" >Perlvis</td>
                                                    <td><label><input type="radio" name ="perlvis" <?php if($wca->isCheckedRadio($hsimulation->perlvis, 'Yes')){echo 'checked';}?> value="Yes"></label></td>
                                                    <td><label><input type="radio" name ="perlvis" <?php if($wca->isCheckedRadio($hsimulation->perlvis, 'No')){echo 'checked';}?> value="No"></label></td>
                                                    <td class="text-center">
                                                         <input type="text" name="perlvis_0" class="form-control" id="pwd">
                                                    </td>
                                               </tr>
                                               <tr >
                                                    <td width="100px" >Truck</td>
                                                    <td><label><input type="radio" name ="truck" <?php if($wca->isCheckedRadio($hsimulation->truck, 'Yes')){echo 'checked';}?> value="Yes"></label></td>
                                                    <td><label><input type="radio" name ="truck" <?php if($wca->isCheckedRadio($hsimulation->truck, 'No')){echo 'checked';}?> value="No"></label></td>
                                                    <td class="text-center">
                                                         <input type="text" name="truck_1" class="form-control" id="pwd">
                                                    </td>
                                               </tr>
                                               <tr >
                                                    <td width="100px" >Head</td>
                                                    <td><label><input type="radio" name ="head" <?php if($wca->isCheckedRadio($hsimulation->head, 'Yes')){echo 'checked';}?> value="Yes"></label></td>
                                                    <td><label><input type="radio" name ="head" <?php if($wca->isCheckedRadio($hsimulation->head, 'No')){echo 'checked';}?> value="No"></label></td>
                                                    <td class="text-center">
                                                         <input type="text" name="head_2" class="form-control" id="pwd">
                                                    </td>
                                               </tr>
                                               <tr >
                                                    <td width="100px" >L Hip</td>
                                                    <td><label><input type="radio" name ="l_hip" <?php if($wca->isCheckedRadio($hsimulation->l_hip, 'Yes')){echo 'checked';}?> value="Yes"></label></td>
                                                    <td><label><input type="radio" name ="l_hip" <?php if($wca->isCheckedRadio($hsimulation->l_hip, 'No')){echo 'checked';}?> value="No"></label></td>
                                                    <td class="text-center">
                                                         <input type="text" name="l_hip_3" class="form-control" id="pwd">
                                                    </td>
                                               </tr>
                                               <tr >
                                                    <td width="100px" >R Hip</td>
                                                    <td><label><input type="radio" name ="r_hip" <?php if($wca->isCheckedRadio($hsimulation->r_hip, 'Yes')){echo 'checked';}?> value="Yes"></label></td>
                                                    <td><label><input type="radio" name ="r_hip" <?php if($wca->isCheckedRadio($hsimulation->r_hip, 'No')){echo 'checked';}?> value="No"></label></td>
                                                    <td class="text-center">
                                                         <input type="text" name="r_hip_4" class="form-control" id="pwd">
                                                    </td>
                                               </tr>
                                               <tr >
                                                    <td width="100px" >Thighs</td>
                                                    <td><label><input type="radio" name ="thighs" <?php if($wca->isCheckedRadio($hsimulation->thighs, 'Yes')){echo 'checked';}?> value="Yes"></label></td>
                                                    <td><label><input type="radio" name ="thighs" <?php if($wca->isCheckedRadio($hsimulation->thighs, 'No')){echo 'checked';}?> value="No"></label></td>
                                                    <td class="text-center">
                                                         <input type="text" name="thighs_5" class="form-control" id="pwd">
                                                    </td>
                                               </tr>
                                               <tr >
                                                    <td width="100px" >L Knee</td>
                                                    <td><label><input type="radio" name ="l_knee" <?php if($wca->isCheckedRadio($hsimulation->l_knee, 'Yes')){echo 'checked';}?> value="Yes"></label></td>
                                                    <td><label><input type="radio" name ="l_knee" <?php if($wca->isCheckedRadio($hsimulation->l_knee, 'No')){echo 'checked';}?> value="No"></label></td>
                                                    <td class="text-center">
                                                         <input type="text" name="l_knee_6" class="form-control" id="pwd">
                                                    </td>
                                               </tr>
                                               <tr >
                                                    <td width="100px" >R Knee</td>
                                                    <td><label><input type="radio" name ="r_knee" <?php if($wca->isCheckedRadio($hsimulation->r_knee, 'Yes')){echo 'checked';}?> value="Yes"></label></td>
                                                    <td><label><input type="radio" name ="r_knee" <?php if($wca->isCheckedRadio($hsimulation->r_knee, 'No')){echo 'checked';}?> value="No"></label></td>
                                                    <td class="text-center">
                                                         <input type="text" name="r_knee_7" class="form-control" id="pwd">
                                                    </td>
                                               </tr>
                                              <tr >
                                                    <td width="100px" >L Ankle</td>
                                                    <td><label><input type="radio" name ="l_ankle" <?php if($wca->isCheckedRadio($hsimulation->l_ankle, 'Yes')){echo 'checked';}?> value="Yes"></label></td>
                                                    <td><label><input type="radio" name ="l_ankle" <?php if($wca->isCheckedRadio($hsimulation->l_ankle, 'No')){echo 'checked';}?> value="No"></label></td>
                                                    <td class="text-center">
                                                         <input type="text" name="l_ankle_8" class="form-control" id="pwd">
                                                    </td>
                                               </tr>
                                               
                                               <tr >
                                                    <td width="100px" >R Ankle</td>
                                                    <td><label><input type="radio" name ="r_ankle" <?php if($wca->isCheckedRadio($hsimulation->r_ankle, 'Yes')){echo 'checked';}?> value="Yes"></label></td>
                                                    <td><label><input type="radio" name ="r_ankle" <?php if($wca->isCheckedRadio($hsimulation->r_ankle, 'No')){echo 'checked';}?> value="No"></label></td>
                                                    <td class="text-center">
                                                         <input type="text" name="r_ankle_9" class="form-control" id="pwd">
                                                    </td>
                                               </tr>
                                              
                                              
                                           </tbody>
                                        </table>
                                    </div>
                                </div>
                                </div>
                               <hr/>
                               <div class="row">
                                  <div class="col-md-12">
                                     <h3 class="text-center">Taking measurements</h3>
                                  </div>
                               </div>
                               <div class="row">
                                  <div class="col-md-12">
                                    <table class="table table-bordered table-hover">
                                            <thead>
                                                <tr >
                                                    <th class="text-center" colspan="4">
                                                     Body measurements (mm)
                                                    </th> 
                                                    <th class="text-center" colspan="3">
                                                      Wheelchair component measurements (mm)
                                                    </th>
                                                </tr>
                                                <tr >
                                                    <th class="text-center" colspan="7" >
                                                     Seat width, depth and footrest height
                                                    </th>
                                                </tr>
                                             </thead>
                                            <tbody>
                                                  <tr>
                                                        <td rowspan="2">A</td>
                                                        <td rowspan="2"  colspan="2" >Hip width</td>
                                                        <td rowspan="2"></td>
                                                        <td>= seat width OR</td>
                                                        <td>1</td>
                                                        <td></td>
                                                  </tr> 
                                                  <tr >
                                                        <td>= distance between pelvis side pads  </td>
                                                        <td>2</td>
                                                        <td></td>
                                                  </tr>
                                                  <tr >
                                                        <td rowspan="2">B</td>
                                                        <td rowspan="2">Seat depth (back of pelvis to back of the knee)</td>
                                                        <td>L</td>
                                                        <td></td>
                                                        <td rowspan="2">B less 30–50 mm = seat depth (if length is different, use shorter)</td>
                                                        <td rowspan="2">3</td>
                                                        <td></td>

                                                  </tr> 
                                                  <tr >
                                                        <td>R</td>
                                                        <td></td>
                                                        <td></td>
                                                  </tr>
                                                  <tr >
                                                        <td rowspan="2">C</td>
                                                        <td rowspan="2">Calf length</td>
                                                        <td>L</td>
                                                        <td></td>
                                                        <td rowspan="2">= distance between top of the seat to footrest OR <br>= distance between top of the seat to floor for foot propelling</td>
                                                        <td >4</td>
                                                        <td></td>
                                                  </tr> 
                                                  <tr >
                                                        <td>R</td>
                                                        <td></td>
                                                        <td>5</td>
                                                        <td></td>

                                                  </tr>
                                                <tr >
                                                    <th class="text-center" colspan="7" >
                                                        Backrest height
                                                    </th>
                                               </tr>
                                                <tr >
                                                        <td>D</td>
                                                        <td colspan="2">Seat* to bottom of rib cage</td>
                                                        <td></td>
                                                        <td rowspan="3" >= distance between top of the seat to top of backrest <br>(measure D, E or F –depending on the wheelchair user’s need)</td>
                                                        <td rowspan="3" >6</td>
                                                        <td rowspan="3" ></td>


                                                </tr>
                                                <tr >
                                                        <td>E</td>
                                                        <td colspan="2">Seat* to bottom of shoulder blade</td>
                                                        <td></td>


                                                </tr>
                                                <tr >
                                                        <td>F</td>
                                                        <td colspan="2">Seat* to top of shoulder</td>
                                                        <td></td>

                                                </tr>
                                                <tr >
                                                    <th class="text-center" colspan="7" >
                                                        Modifications and / or PSDs
                                                    </th>
                                               </tr>
                                                <tr >
                                                        <td>G</td>
                                                        <td  colspan="2">Trunk width</td>
                                                        <td></td>
                                                        <td>= distance between trunk side pads/wedges</td>
                                                        <td>7</td>
                                                        <td></td>
                                                </tr>
                                                <tr >
                                                        <td rowspan="2">H</td>
                                                        <td rowspan="2" >Seat* to axilla (armpit)</td>
                                                        <td>L</td>
                                                        <td></td>
                                                        <td rowspan="2" >H less 30 mm = maximum distance between the top of the seat and the top of trunk side pads/wedges (adjust according to hand simulation)</td>
                                                        <td rowspan="2">8</td>
                                                        <td></td>

                                                </tr>
                                                <tr >   <td>R</td>
                                                        <td></td>
                                                        <td></td>
                                                </tr>

                                                <tr >
                                                        <td>I</td>
                                                        <td colspan="2">Seat* to top of the pelvis (PSIS)</td>
                                                        <td></td>
                                                        <td>= distance between the top of the seat and mid-height of rear pelvis pad </td>
                                                        <td>9</td>
                                                        <td></td>

                                                </tr> 
                                                <tr >
                                                        <td>J</td>
                                                        <td colspan="2">Distance between knees </td>
                                                        <td></td>
                                                        <td>= width of knee separator pad </td>
                                                        <td>10</td>
                                                        <td></td>

                                                </tr> 
                                                <tr >
                                                        <td>K</td>
                                                        <td colspan="2">Seat* to base of skull</td>
                                                        <td></td>
                                                        <td>= distance between the top of seat to middle of headrest </td>
                                                        <td>11</td>
                                                        <td></td>

                                                </tr> 
                                                <tr >
                                                        <td>L</td>
                                                        <td colspan="2">Back of pelvis to seat bones</td>
                                                        <td></td>
                                                        <td>L plus 20–40 mm = distance from the backrest support to the beginning of the pre seat bone shelf. </td>
                                                        <td>12</td>
                                                        <td></td>

                                                </tr> 

                                           </tbody>
                                        </table>
                                  </div>
                               </div>
                            </div>
                        </div>
                   </div>
            </div>
           <div class="row">
            <div class="col-xs-12">
                <div class="col-md-12 well text-center">
                        <div class="form-group inform_assessor">
                        </div>
                        <div class="form-group">
							<button  type="submit" id="" class="btn btn-primary btn-md">Save Assessment Changes</button> <span class="load_hidden-spinner"></span>
                        </div>
               </div>
           </div>
      </div>
</form>
