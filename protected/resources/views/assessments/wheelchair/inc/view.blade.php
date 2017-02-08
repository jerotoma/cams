<div class="row">
	<div class="col-xs-12">
         <div class="col-md-12 well">    
			 <div class="row">
				 <div class="col-md-6">
					 <div class="form-group form-inline">
			                <label>Assessor’s name:  <label> 
							<input class="form-control" type="text" name="assessor_name" value="{{$assessor->full_name}}">  
			           </div>
			     </div>
			     <div class="col-md-6">
					 <div class="form-group form-inline">
					       <label>Date of assessment:  <label> 
						   <input class="form-control" type="text" name="assessor_name" value="{{$wc_assessment->created_at}}">  
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
                            <!-- <a id="add_row" class="btn btn-success pull-left">Add Row</a><a id='delete_row' class="btn btn-danger pull-right">Delete Row</a> -->
                   <div class="form-group">
                   <label>Goals : <label> <input class="form-control" type="text" name="cliend_goal" value="{{$wc_assessment->id}}">  
	
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
                                           <label class="checkbox text-left"><input type="checkbox" name="assess_interview_diagnosis_qn_1[]" value="Brain Injury">Brain Injury</label>
                                           <label class="checkbox text-left"><input type="checkbox" name="assess_interview_diagnosis_qn_1[]" value="Cerebral Palsy">Cerebral Palsy </label>
                                           <label class="checkbox text-left"><input type="checkbox" name="assess_interview_diagnosis_qn_1[]" value="Muscular Dystrophy">Muscular Dystrophy</label> 
                                       </div>
                                   </div>
                                   <div class="col-md-4 col-md-pull-2">
                                      <div class="checkbox">
                                           <label class="checkbox text-left "><input type="checkbox"  name="assess_interview_diagnosis_qn_1[]" value="Polio">Polio</label>
                                           <label class="checkbox text-left"><input type="checkbox"   name="assess_interview_diagnosis_qn_1[]" value="Spina Bifida">Spina Bifida</label>
                                           <label class="checkbox text-left"><input type="checkbox"   name="assess_interview_diagnosis_qn_1[]" value="Spinal Cord Injury">Spinal Cord Injury </label> 
                                       </div>
                                   </div> 
                                   <div class="col-md-4 col-md-pull-3">
                                       <div class="checkbox">
                                           <label class="checkbox text-left "><input type="checkbox" name="assess_interview_diagnosis_qn_1[]" value="">Stroke</label>
                                           <label class="checkbox text-left"><input type="checkbox"  name="assess_interview_diagnosis_qn_1[]" value="">Unknown</label>
                                           <label class="checkbox text-left"><input type="checkbox"  name="assess_interview_diagnosis_qn_1[]" value="">Other</label> 
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
                                      <label class="radio-inline"><input type="radio" name ="assess_interview_diagnosis_qn_2" value="Yes">Yes</label>
                                      <label class="radio-inline"><input type="radio" name ="assess_interview_diagnosis_qn_2" value="No">No</label>
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
                                           <label class="checkbox-inline text-left move-left"><input type="checkbox" name ="assess_interview_physical_issues_qn_1[]" value="Frail">Frail</label>
                                           <label class="checkbox-inline text-left move-left"><input type="checkbox" name ="assess_interview_physical_issues_qn_1[]" value="Spasms/uncontrolled movements">Spasms/uncontrolled movements</label>
                                           <label class="checkbox-inline text-left move-left"><input type="checkbox" name ="assess_interview_physical_issues_qn_1[]" value="Muscle tone (high/low)">Muscle tone (high/low)</label> 
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
                                       <label class="checkbox"><input type="checkbox" name ="assess_interview_physical_issues_qn_2[]" value="R above knee">R above knee</label> 
                                       <label class="checkbox"><input type="checkbox" name ="assess_interview_physical_issues_qn_2[]" value="R below knee">R below knee</label>
                                       <label class="checkbox"><input type="checkbox" name ="assess_interview_physical_issues_qn_2[]" value="L above knee">L above knee</label>
                                    </div>
                                   </div>
                                   <div class="col-md-4 col-md-pull-1">
                                     <div class="checkbox">
                                       <label class="checkbox"><input type="checkbox" name ="assess_interview_physical_issues_qn_2[]" value="L above knee">L above knee</label>
                                       <label class="checkbox"><input type="checkbox" name ="assess_interview_physical_issues_qn_2[]" value="Fatigue">Fatigue</label> 
                                       <label class="checkbox"><input type="checkbox" name ="assess_interview_physical_issues_qn_2[]" value="Hip dislocation">Hip dislocation</label>
                                     </div>
                                   </div>
                                   <div class="col-md-4 col-md-pull-2">
                                       <div class="checkbox">
                                       <label class="checkbox"><input type="checkbox" name ="assess_interview_physical_issues_qn_2[]" value="">Epilepsy</label>
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
                                      <label class="checkbox-inline"><input type="checkbox" name ="assess_interview_physical_issues_qn_3[]" value="Problems with eating, drinking and swallowing"></label>
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
                                      <label class="checkbox-inline"><input type="checkbox" name ="assess_interview_physical_issues_qn_4[]" value="Pain">Pain</label>
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
                                      <label class="checkbox-inline"><input type="checkbox" name ="assess_interview_physical_issues_qn_5[]" value="Bladder problems">Bladder problems</label>
                                      <label class="checkbox-inline"><input type="checkbox" name ="assess_interview_physical_issues_qn_5[]" value="Bowel problems">Bowel problems</label>
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
                                      <label class="radio-inline"><input type="radio" name ="assess_interview_physical_issues_qn_6" value="Yes">Yes</label>
                                      <label class="radio-inline"><input type="radio" name ="assess_interview_physical_issues_qn_6" value="No">No</label>
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
                                      <label class="radio-inline"><input type="radio" name ="assess_interview_lifestyle_env_qn_1" value="Up to 1km">Up to 1km</label>
                                      <label class="radio-inline"><input type="radio" name ="assess_interview_lifestyle_env_qn_1" value="1-5km">1-5km</label>
                                      <label class="radio-inline"><input type="radio" name ="assess_interview_lifestyle_env_qn_1" value="More than 5km">More than 5km</label>
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
                                      <label class="radio-inline"><input type="radio" name ="assess_interview_lifestyle_env_qn_2" value="Less than 1">Less than 1 </label>
                                      <label class="radio-inline"><input type="radio" name ="assess_interview_lifestyle_env_qn_2" value="1-3">1-3</label>
                                      <label class="radio-inline"><input type="radio" name ="assess_interview_lifestyle_env_qn_2" value="3-5">3-5</label>
                                      <label class="radio-inline"><input type="radio" name ="assess_interview_lifestyle_env_qn_2" value="5-8">5-8</label>
                                      <label class="radio-inline"><input type="radio" name ="assess_interview_lifestyle_env_qn_2" value="more than 8">more than 8</label>
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
                                      <label class="radio-inline"><input type="radio" name ="assess_interview_lifestyle_env_qn_4" value="Independent">Independent</label>
                                      <label class="radio-inline"><input type="radio" name ="assess_interview_lifestyle_env_qn_4" value="Assisted">Assisted</label>
                                      <label class="radio-inline"><input type="radio" name ="assess_interview_lifestyle_env_qn_4" value="Standing">Standing</label>
                                      <label class="radio-inline"><input type="radio" name ="assess_interview_lifestyle_env_qn_4" value="Non-standing">Non-standing </label>
                                      <label class="radio-inline"><input type="radio" name ="assess_interview_lifestyle_env_qn_4" value="Lifted">Lifted</label>
                                      <label class="radio-inline"><input type="radio" name ="assess_interview_lifestyle_env_qn_4" value="Other">Other</label>
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
                                      <label class="radio-inline"><input type="radio" name ="assess_interview_lifestyle_env_qn_5" value="Squat">Squat</label>
                                      <label class="radio-inline"><input type="radio" name ="assess_interview_lifestyle_env_qn_5" value="Western">Western </label>
                                      <label class="radio-inline"><input type="radio" name ="assess_interview_lifestyle_env_qn_5" value="Adapted">Adapted</label>
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
                                      <label class="radio-inline"><input type="radio" name ="assess_interview_lifestyle_env_qn_6" value="Yes">Yes</label>
                                      <label class="radio-inline"><input type="radio" name ="assess_interview_lifestyle_env_qn_6" value="No">No</label>
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
                                      <label class="radio-inline"><input type="radio" name ="assess_interview_lifestyle_env_qn_7" value="Car">Car</label>
                                      <label class="radio-inline"><input type="radio" name ="assess_interview_lifestyle_env_qn_7" value="Tax">Tax</label>
                                      <label class="radio-inline"><input type="radio" name ="assess_interview_lifestyle_env_qn_7" value="Bus">Bus</label>
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
                                          <label class="radio-inline"><input type="radio" name ="assess_interview_existing_wheelchair_qn_1" value="Yes">Yes</label>
                                          <label class="radio-inline"><input type="radio" name ="assess_interview_existing_wheelchair_qn_1" value="No">No</label>
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
                                          <label class="radio-inline"><input type="radio" name ="assess_interview_existing_wheelchair_qn_2" value="Yes">Yes</label>
                                          <label class="radio-inline"><input type="radio" name ="assess_interview_existing_wheelchair_qn_2" value="No">No</label>
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
                                          <label class="radio-inline"><input type="radio" name ="assess_interview_existing_wheelchair_qn_3" value="Yes">Yes</label>
                                          <label class="radio-inline"><input type="radio" name ="assess_interview_existing_wheelchair_qn_3" value="No">No</label>
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
                                          <label class="radio-inline"><input type="radio" name ="assess_interview_existing_wheelchair_qn_4" value="Yes">Yes</label>
                                          <label class="radio-inline"><input type="radio" name ="assess_interview_existing_wheelchair_qn_4" value="No">No</label>
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
                                          <label class="radio-inline"><input type="radio" name ="assess_interview_existing_wheelchair_qn_5" value="Yes">Yes</label>
                                          <label class="radio-inline"><input type="radio" name ="assess_interview_existing_wheelchair_qn_5" value="No">No</label>
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
                                                          <label class="radio-inline"><input type="radio" name ="physical_assess_presence_risk_qn_1" value="Yes">Yes</label>
                                                          <label class="radio-inline"><input type="radio" name ="physical_assess_presence_risk_qn_1" value="No">No</label>
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
                                                          <label class="radio-inline"><input type="radio" name ="physical_assess_presence_risk_qn_2" value="Yes">Yes</label>
                                                          <label class="radio-inline"><input type="radio" name ="physical_assess_presence_risk_qn_2" value="No">No</label>
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
                                                          <label class="radio-inline"><input type="radio" name ="physical_assess_presence_risk_qn_3" value="Yes">Yes</label>
                                                          <label class="radio-inline"><input type="radio" name ="physical_assess_presence_risk_qn_3" value="No">No</label>
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
                                                          <label class="radio-inline"><input type="radio" name ="physical_assess_presence_risk_qn_4" value="Yes">Yes</label>
                                                          <label class="radio-inline"><input type="radio" name ="physical_assess_presence_risk_qn_4" value="No">No</label>
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
                                          <label class="radio-inline"><input type="radio" name ="physical_assess_presence_risk_qn_6" value="Yes">Yes</label>
                                          <label class="radio-inline"><input type="radio" name ="physical_assess_presence_risk_qn_6" value="No">No</label>
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
                                                      <label class="radio"><input type="radio" name ="physical_assess_method_of_pushing_qn_1" value="Both arms">Both arms</label>
                                                      <label class="radio"><input type="radio" name ="physical_assess_method_of_pushing_qn_1" value="Left arm">Left arm</label>
                                                     </div>
                                                 </div>  
                                               </div>
                                              <div class="col-md-3 col-md-pull-0">
                                                 <div class="radio">
                                                      <label class="radio"><input type="radio" name ="physical_assess_method_of_pushing_qn_2" value="Right arm">Right arm</label>
                                                      <label class="radio"><input type="radio" name ="physical_assess_method_of_pushing_qn_2" value="Both legs">Both legs</label>
                                                  </div>
                                              </div>
                                             <div class="col-md-3 col-md-pull-0">
                                                    <div class="radio">
                                                      <label class="radio"><input type="radio" name ="physical_assess_method_of_pushing_qn_2" value="Left leg">Left leg</label>
                                                      <label class="radio"><input type="radio" name ="physical_assess_method_of_pushing_qn_2" value="Right leg">Right leg</label>
                                                    </div>
                                            </div>
                                           <div class="col-md-3 col-md-pull-0">
                                                    <div class="radio">
                                                      <label class="radio"><input type="radio" name ="physical_assess_method_of_pushing_qn_2" value="Pushed by helpe">Pushed by helper</label>
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
                                                      <label class="radio-inline"><input type="radio" name ="physical_assess_pelvis_hip_posture_screen_qn_1" value="Yes">Yes</label>
                                                      <label class="radio-inline"><input type="radio" name ="physical_assess_pelvis_hip_posture_screen_qn_1" value="No">No</label>
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
                                                          <label class="radio-inline"><input type="radio" name ="physical_assess_pelvis_hip_posture_screen_qn_2" value="Yes">Yes</label>
                                                          <label class="radio-inline"><input type="radio" name ="physical_assess_pelvis_hip_posture_screen_qn_2" value="No">No</label>
                                                          <label class="radio">Angle <input type="text" name ="physical_assess_pelvis_hip_posture_screen_qn_2_angle" value=""class="form-control"></label>
                                                 </div>  
                                               </div>
                                              <div class="col-md-3 col-md-pull-0">
                                                 <div class="radio">
                                                      <span class="text-left" >Left hip: </span>
                                                      <label class="radio-inline"><input type="radio" name ="physical_assess_pelvis_hip_posture_screen_qn_3" value="">Yes</label>
                                                      <label class="radio-inline"><input type="radio" name ="physical_assess_pelvis_hip_posture_screen_qn_3" value="">No</label>
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

                                                <?php $count = 0; ?>
                                                @while( $count < count($parts) )
                                                <tr >
                                                    <td width="100px" >{{$parts[$count]['name']}}</td>
                                                    <td><label><input type="radio" name ="{{$parts[$count]['slug']}}" value="Yes"></label></td>
                                                    <td><label><input type="radio" name ="{{$parts[$count]['slug']}}" value="No"></label></td>
                                                    <td class="text-center">
                                                         <input type="text" name="{{$parts[$count]['slug']}}_{{$count}}" class="form-control" id="pwd">
                                                    </td>
                                               </tr>
                                               <?php $count++; ?>
                                             @endwhile
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
                                                        <td rowspan="3" >6</td>


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
                             <button  type="submit" id="" class="btn btn-primary btn-md">Save Assessment</button>
                        </div>
               </div>
           </div>
      </div>