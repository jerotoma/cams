 <?php $incAssHelper = new InclusionAssessmentHelper(); ?>
<form role="form" id="update-inclusion-assessment" class="inclusion-assessment" action="{{url('assessments/inclusion')}}/{{$incl_assessment->id}}/update-assessment" method="POST">
        <div class="form-group">
            <div class="row">
             <div class="col-md-12">
                       <div class="form-group" >
                         <div class="row">
                               <div class="col-md-3 first table-client">
                                 <span class="table-title">Client Name :</span>
                               </div>
                               <div class="col-md-3 table-client">
                                  {{$client->full_name}}
                               </div>
                               <div class="col-md-3 table-client">
                                <span class="table-title"> Ration Card No:</span>
                               </div>
                               <div class="col-md-3 last table-client">
                                  {{$client->client_number}}
                               </div>
                               </div>
                               <div class="row">
                               <div class="col-md-3 first table-client">
                                 <span class="table-title">Gender :</span>
                               </div>
                               <div class="col-md-3 table-client">
                                  {{$client->sex}}
                               </div>
                               <div class="col-md-3 table-client">
                                <span class="table-title">Age:</span>
                               </div>
                               <div class="col-md-3 last table-client">
                                  {{$client->age}}
                               </div>
                               </div>
                                  <div class="row">
                               <div class="col-md-3 first table-client">
                                 <span class="table-title">Camp :</span>
                               </div>
                               <div class="col-md-3 table-client">
                                  {{$client->present_address}}
                               </div>
                               <div class="col-md-3 table-client">
                                <span class="table-title">&nbsp;</span>
                               </div>
                               <div class="col-md-3 last table-client">
                                  5656
                               </div>
                               </div>
                                  <div class="row">
                               <div class="col-md-3 first table-client">
                                 <span class="table-title"> Address:</span>
                               </div>
                               <div class="col-md-3 table-client">
                                    {{$client->present_address}}
                               </div>
                               <div class="col-md-3 table-client">
                                <span class="table-title"> Unique No :</span>
                               </div>
                               <div class="col-md-3 last table-client">
                                    {{$client->present_address}}
                               </div>
                               </div>
                               <div class="row">
                               <div class="col-md-3 first table-client">
                                 <span class="table-title">Religion :</span>
                               </div>
                               <div class="col-md-3 table-client">
                                    {{$client->present_address}}
                               </div>
                               <div class="col-md-3 table-client">
                                <span class="table-title"> Country of Origin:</span>
                               </div>
                               <div class="col-md-3 last table-client">
                                    {{$client->present_address}}
                               </div>
                               </div>
                                  <div class="row">
                               <div class="col-md-3 first table-client">
                                 <span class="table-title">Gadian Name :</span>
                               </div>
                               <div class="col-md-3 table-client">
                                  {{$client->present_address}}
                               </div>
                               <div class="col-md-3 table-client">
                                <span class="table-title"> Age of Guardian:</span>
                               </div>
                               <div class="col-md-3 last table-client">
                                   {{$client->present_address}}
                               </div>
                               </div>
                                 <div class="row">
                               <div class="col-md-3 first table-client">
                                 <span class="table-title">Date of Assessment :</span>
                               </div>
                               <div class="col-md-3 table-client">
                                    Date
                               </div>
                               <div class="col-md-3 table-client">
                                <span class="table-title"> Assessor's Name:</span>
                               </div>
                               <div class="col-md-3 last table-client">
                                    {{Auth::user()->full_name}}
                               </div>
                               </div>
                       </div>
                </div>
             </div>
           </div>
           <hr>
           <div class="form-group">
                <h1 class="text-center title-info ">Case History</h1>
          </div>
          <div class="form-group">
             <label for="med_history_info_qn_1">Present Medical History : </label>
               <textarea rows="5" class="form-control" name="med_history_info_qn_1" id="med_history_info_qn_1">{{$incAssHelper->getTextFieldValue($imhistory->med_history_info_qn_1)}}</textarea>
          </div>
          <div class="form-group">
             <label for="med_history_info_qn_2">Other services/ therapy received (if the client has already receive or attend any rehabilitation services or any other services concern protection issues) : </label>
               <textarea rows="5" class="form-control" name="med_history_info_qn_2" id="med_history_info_qn_2">{{$incAssHelper->getTextFieldValue($imhistory->med_history_info_qn_2)}}</textarea>
          </div>
          <div class="form-group">
             <div class="row">
                 <div class="col-md-12">
                      <div class="row">
                             <div class="col-md-6 col-md-pull-0">
                               <label>General Observatory Checks</label>
                            </div>
                      </div>
                     <div class="row">
                           <div class="col-md-10">
                               <div class="row">
                                      <div class="col-md-6 col-md-pull-0">
                                         <div class="radio">
                                              <p>Respiratory difficulties</p>
                                         </div>
                                       </div>
                                      <div class="col-md-6 col-md-pull-0">
                                            <div class="checkbox">
                                              <label class="radio-inline"><input type="radio" name ="med_history_info_qn_3" {{ $incAssHelper->isChecked($imhistory->med_history_info_qn_3, 'Yes')}} value="Yes">Yes</label>
                                              <label class="radio-inline"><input type="radio" name ="med_history_info_qn_3" {{ $incAssHelper->isChecked($imhistory->med_history_info_qn_3, 'No')}} value="No">No</label>
                                            </div>
                                           <div clas="form-group">
                                             <input type="text" class="form-control" id="" placeholder="Remark:" name ="med_history_info_qn_3_remark" value="{{$incAssHelper->getTextFieldValue($imhistory->med_history_info_qn_3_remark)}}">
                                           </div>
                                      </div>
                                </div>
                                <div class="row">
                                      <div class="col-md-6 col-md-pull-0">
                                         <div class="radio">
                                              <p>Poor skin condition</p>
                                         </div>
                                       </div>
                                      <div class="col-md-6 col-md-pull-0">
                                            <div class="checkbox">
                                              <label class="radio-inline"><input type="radio" name ="med_history_info_qn_4" {{ $incAssHelper->isChecked($imhistory->med_history_info_qn_4, 'Yes')}} value="Yes">Yes</label>
                                              <label class="radio-inline"><input type="radio" name ="med_history_info_qn_4" {{ $incAssHelper->isChecked($imhistory->med_history_info_qn_4, 'No')}}  value="No">No</label>
                                            </div>
                                           <div clas="form-group">
                                             <input type="text" class="form-control" id="" placeholder="Remark:" name ="med_history_info_qn_4_remark" value="{{$incAssHelper->getTextFieldValue($imhistory->med_history_info_qn_4_remark)}}">
                                           </div>
                                      </div>
                                </div>
                                <div class="row">
                                      <div class="col-md-6 col-md-pull-0">
                                         <div class="radio">
                                              <p>Fever</p>
                                         </div>
                                       </div>
                                      <div class="col-md-6 col-md-pull-0">
                                            <div class="checkbox">
                                              <label class="radio-inline"><input type="radio" name ="med_history_info_qn_5"   value="Yes" {{ $incAssHelper->isChecked($imhistory->med_history_info_qn_5, 'Yes')}} >Yes</label>
                                              <label class="radio-inline"><input type="radio" name ="med_history_info_qn_5" value="No" {{ $incAssHelper->isChecked($imhistory->med_history_info_qn_5, 'No')}} >No</label>
                                            </div>
                                           <div clas="form-group">
                                              <input type="text" class="form-control" id="" placeholder="Remark:" name ="med_history_info_qn_5_remark" value="{{$incAssHelper->getTextFieldValue($imhistory->med_history_info_qn_5_remark)}}">
                                           </div>
                                      </div>
                                </div>
                                <div class="row">
                                      <div class="col-md-6 col-md-pull-0">
                                         <div class="radio">
                                              <p>Dehydration signs</p>
                                         </div>
                                       </div>
                                      <div class="col-md-6 col-md-pull-0">
                                            <div class="checkbox">
                                              <label class="radio-inline"><input type="radio" name ="med_history_info_qn_6" value="Yes" {{ $incAssHelper->isChecked($imhistory->med_history_info_qn_6, 'Yes')}} >Yes</label>
                                              <label class="radio-inline"><input type="radio" name ="med_history_info_qn_6" value="No" {{ $incAssHelper->isChecked($imhistory->med_history_info_qn_6, 'No')}} >No</label>
                                            </div>
                                            <div clas="form-group">
                                                <input type="text" class="form-control" id="" placeholder="Remark:" name ="med_history_info_qn_6_remark" value="{{$incAssHelper->getTextFieldValue($imhistory->med_history_info_qn_6_remark)}}">
                                            </div>
                                      </div>
                                </div>
                               <div class="row">
                                      <div class="col-md-6 col-md-pull-0">
                                         <div class="radio">
                                              <p>Malnutrition signs</p>
                                         </div>
                                       </div>
                                      <div class="col-md-6 col-md-pull-0">
                                            <div class="checkbox">
                                              <label class="radio-inline"><input type="radio" name ="med_history_info_qn_7" value="Yes" {{ $incAssHelper->isChecked($imhistory->med_history_info_qn_7, 'Yes')}} >Yes</label>
                                              <label class="radio-inline"><input type="radio" name ="med_history_info_qn_7" value="No" {{ $incAssHelper->isChecked($imhistory->med_history_info_qn_7, 'No')}}>No</label>
                                            </div>
                                       <div clas="form-group">
                                       <input type="text" class="form-control" id="" placeholder="Remark:" name ="med_history_info_qn_7_remark" value="{{$incAssHelper->getTextFieldValue($imhistory->med_history_info_qn_7_remark)}}">
                                     </div>
                                      </div>
                                </div>
                                <div class="row">
                                      <div class="col-md-6 col-md-pull-0">
                                         <div class="radio">
                                              <p>Seizures</p>
                                         </div>
                                       </div>
                                      <div class="col-md-6 col-md-pull-0">
                                            <div class="checkbox">
                                              <label class="radio-inline"><input type="radio" name ="med_history_info_qn_8" value="Yes" {{ $incAssHelper->isChecked($imhistory->med_history_info_qn_8, 'Yes')}} >Yes</label>
                                              <label class="radio-inline"><input type="radio" name ="med_history_info_qn_8" value="No" {{ $incAssHelper->isChecked($imhistory->med_history_info_qn_8, 'No')}} >No</label>
                                            </div>
                                            <div clas="form-group">
                                               <input type="text" class="form-control" id="" placeholder="Remark:" name ="med_history_info_qn_8_remark" value="{{$incAssHelper->getTextFieldValue($imhistory->med_history_info_qn_8_remark)}}">
                                           </div>
                                      </div>
                                </div>
                               <div class="row">
                                      <div class="col-md-6 col-md-pull-0">
                                         <div class="radio">
                                              <p>Poor body hygiene sign</p>
                                         </div>
                                       </div>
                                      <div class="col-md-6 col-md-pull-0">
                                            <div class="checkbox">
                                              <label class="radio-inline"><input type="radio" name ="med_history_info_qn_9" value="Yes" {{ $incAssHelper->isChecked($imhistory->med_history_info_qn_9, 'Yes')}} >Yes</label>
                                              <label class="radio-inline"><input type="radio" name ="med_history_info_qn_9" value="No" {{ $incAssHelper->isChecked($imhistory->med_history_info_qn_9, 'No')}} >No</label>
                                            </div>
                                           <div clas="form-group">
                                             <input type="text" class="form-control" id="" placeholder="Remark:" name ="med_history_info_qn_9_remark" value="{{$incAssHelper->getTextFieldValue($imhistory->med_history_info_qn_9_remark)}}">
                                           </div>
                                      </div>
                                </div>
                               <div class="row">
                                      <div class="col-md-6 col-md-pull-0">
                                         <div class="radio">
                                              <p>Does a child need to be reffered to medical care first?</p>
                                         </div>
                                       </div>
                                      <div class="col-md-6 col-md-pull-0">
                                            <div class="checkbox">
                                              <label class="radio-inline"><input type="radio" name ="med_history_info_qn_10" value="Yes" {{ $incAssHelper->isChecked($imhistory->med_history_info_qn_10, 'Yes')}} >Yes</label>
                                              <label class="radio-inline"><input type="radio" name ="med_history_info_qn_10" value="No"  {{ $incAssHelper->isChecked($imhistory->med_history_info_qn_10, 'No')}} >No</label>
                                            </div>
                                           <div clas="form-group">
                                                 <input type="text" class="form-control" id="describe1" placeholder="Remark:" name ="med_history_info_qn_10_remark" value="{{$incAssHelper->getTextFieldValue($imhistory->med_history_info_qn_10_remark)}}">
                                           </div>
                                      </div>
                            </div>
                         </div>
                  </div>
          </div>
      </div>
    </div>

      <div class="form-group">
       		<div class="row">
			 <div class="col-md-12">
                 <div class="form-group">
                     <label>A. Motor Skill</label>
                 </div>
				 <div class="form-group">
					 <div class="row">
						<div class="col-md-4 col-md-pull-0">
							 <div class="radio">
								  <p>Gross motor skills : </p>
							 </div>
						</div>
						<div class="col-md-8 col-md-pull-1">
							<div class="radio">
							  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_1" value="Level 1" {{ $incAssHelper->isChecked($mpc_part_a->mpc_qn_a_1, 'Level 1')}} >Level 1</label>
							  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_1" value="Level 2" {{ $incAssHelper->isChecked($mpc_part_a->mpc_qn_a_1, 'Level 2')}} >Level 2</label>
							  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_1" value="Level 3" {{ $incAssHelper->isChecked($mpc_part_a->mpc_qn_a_1, 'Level 3')}} >Level 3</label>
							  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_1" value="Level 4" {{ $incAssHelper->isChecked($mpc_part_a->mpc_qn_a_1, 'Level 4')}} >Level 4</label>
							  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_1" value="Level 5" {{ $incAssHelper->isChecked($mpc_part_a->mpc_qn_a_1, 'Level 5')}} >Level 5</label>
							</div>
							<div class="form-group">
							   <textarea rows="3" class="form-control" name="mpc_qn_a_1_remark" id="mpc_qn_a_1_remark" placeholder="Remark">{{$incAssHelper->getTextFieldValue($mpc_part_a->mpc_qn_a_1_remark)}}</textarea>
							</div>
						</div>
				     </div>
					  <div class="row">
						  <div class="col-md-6 col-md-pull-0">
							 <div class="radio">
								  <p>Moving limited in the Bed</p>
							 </div>
						   </div>
						  <div class="col-md-6 col-md-pull-2">
								<div class="checkbox">
								  <label class="checkbox-inline"><input type="checkbox" name ="mpc_qn_a_2" value="initial" {{ $incAssHelper->isChecked($mpc_part_a->mpc_qn_a_2,'initial')}}  >0</label>
								</div>
								<div clas="form-group">
									<input type="text" class="form-control" id="" placeholder="Remark:" name ="mpc_qn_a_2_remark" value="{{$incAssHelper->getTextFieldValue($mpc_part_a->mpc_qn_a_2_remark)}}">
								</div>
						  </div>
					   </div>
					   <div class="row">
						  <div class="col-md-6 col-md-pull-0">
							 <div class="radio">
								  <p>Moving out of the Bed</p>
							 </div>
						   </div>
						  <div class="col-md-6 col-md-pull-2">
								<div class="checkbox">
								  <label class="checkbox-inline"><input type="checkbox" name ="mpc_qn_a_3" value="1" {{ $incAssHelper->isChecked($mpc_part_a->mpc_qn_a_3, '1')}}  >1</label>
								</div>
						  </div>
					   </div>
					   <div class="row">
						  <div class="col-md-6 col-md-pull-0">
							 <div class="radio">
								  <p>Moving in the House</p>
							 </div>
						   </div>
						  <div class="col-md-6 col-md-pull-2">
								<div class="checkbox">
								  <label class="checkbox-inline"><input type="checkbox" name ="mpc_qn_a_4" value="2" {{ $incAssHelper->isChecked($mpc_part_a->mpc_qn_a_4, '2')}} >2</label>
								</div>
						 </div>
					   </div>
					   <div class="row">
						  <div class="col-md-6 col-md-pull-0">
							 <div class="radio">
								  <p>Moving Around the House</p>
							 </div>
						   </div>
						  <div class="col-md-6 col-md-pull-2">
								<div class="checkbox">
								  <label class="checkbox-inline"><input type="checkbox" name ="mpc_qn_a_5" value="3" {{ $incAssHelper->isChecked($mpc_part_a->mpc_qn_a_5, '3')}} >3</label>
								</div>
						  </div>
					   </div>
					   <div class="row">
						  <div class="col-md-6 col-md-pull-0">
							 <div class="radio">
								  <p>Moving in the village</p>
							 </div>
						   </div>
						  <div class="col-md-6 col-md-pull-2">
								<div class="checkbox">
								  <label class="checkbox-inline"><input type="checkbox" name ="mpc_qn_a_6" value="4" {{ $incAssHelper->isChecked($mpc_part_a->mpc_qn_a_6, '4')}}  >4</label>
								</div>
						</div>
					   </div>
					   <div class="row">
						  <div class="col-md-6 col-md-pull-0">
							 <div class="radio">
								  <p>Moving long distance</p>
							 </div>
						   </div>
						  <div class="col-md-6 col-md-pull-2">
								<div class="checkbox">
								  <label class="checkbox-inline"><input type="checkbox" name ="mpc_qn_a_7" value="5" {{ $incAssHelper->isChecked($mpc_part_a->mpc_qn_a_7, '5')}} >5</label>
								</div>
						  </div>
					   </div>
					   <div class="row">
						  <div class="col-md-10 col-md-push-2">
								<div clas="form-group">
									<textarea rows="3" class="form-control" name="mpc_qn_a_8_remark" id="mpc_qn_a_8_remark" placeholder="Remark">{{$incAssHelper->getTextFieldValue($mpc_part_a->mpc_qn_a_8_remark)}}</textarea>
								</div>
						  </div>
					   </div>
				 </div>
              
			     <div class="form-group">
                           <div class="row">
                              <div class="col-md-12">
                                  <div class="form-group">
                                    <label>Range of motion (ROM) & Muscle strength </label>
                                  </div>
                               </div>
                            </div>
                             <hr>
                            <div class="row">
                              <div class="row clearfix">
                                <div class="col-md-12">
                                    <label>1.  {{strtoupper("Lower Limb")}}</label>
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr >
                                                <th class="text-center" rowspan="3" colspan="2">
                                                  <p> </p>
                                                </th>
                                                <th class="text-center" colspan="6">
                                                  <p>Range of Motion</p>
                                                </th>
                                                <th class="text-center" colspan="6">
                                                  <p>Mascle Stregnth (St) or Spasticity (Sp) </p>
                                                </th>
                                            </tr>
                                            <tr >
                                                <th class="text-center" colspan="3">
                                                  <p>L</p>
                                                </th>
                                                <th class="text-center" colspan="3">
                                                  <p>R</p>
                                                </th>
                                                <th class="text-center" colspan="3">
                                                  <p>L</p>
                                                </th>
                                                <th class="text-center" colspan="3">
                                                  <p>R</p>
                                                </th>

                                           </tr>
                                           <tr >
                                                <th class="text-center">
                                                  Date
                                                </th>
                                                <th class="text-center">
                                                   Date
                                                </th>
                                                <th class="text-center">
                                                  Date
                                                </th>
                                                 <th class="text-center">
                                                  Date
                                                </th>
                                                <th class="text-center">
                                                   Date
                                                </th>
                                                <th class="text-center">
                                                   Date
                                                </th>
                                                 <th class="text-center">
                                                   Date
                                                </th>
                                                <th class="text-center">
                                                  Date
                                                </th>
                                                <th class="text-center">
                                                  Date
                                                </th>
                                                 <th class="text-center">
                                                   Date
                                                </th>
                                                <th class="text-center">
                                                   Date
                                                </th>
                                                <th class="text-center">
                                                  Date
                                                </th>

                                           </tr>
                                        </thead>
                                        <tbody>
                                            <?php echo  $incAssHelper ->getTableRow($incAssHelper->arrLowerLimb, $mpc_lower_limb->toArray()); ?>
                                        </tbody>
                                 </table>
                            </div>
                        </div>
                    </div>
                 </div>

				 <div class="form-group">

                            <div class="row">
                              <div class="row clearfix">
                                <div class="col-md-12">
                                    <label>2.  {{strtoupper("Upper Limb")}}</label>
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr >
                                                <th class="text-center" rowspan="3" colspan="2">
                                                  <p> </p>
                                                </th>
                                                <th class="text-center" colspan="6">
                                                  <p>Range of Motion</p>
                                                </th>
                                                <th class="text-center" colspan="6">
                                                  <p>Mascle Stregnth (St) or Spasticity (Sp)</p>
                                                </th>
                                            </tr>
                                            <tr >
                                                <th class="text-center" colspan="3">
                                                  <p>L</p>
                                                </th>
                                                <th class="text-center" colspan="3">
                                                  <p>R</p>
                                                </th>
                                                <th class="text-center" colspan="3">
                                                  <p>L</p>
                                                </th>
                                                <th class="text-center" colspan="3">
                                                  <p>R</p>
                                                </th>

                                           </tr>
                                           <tr >
                                                <th class="text-center">
                                                  Date
                                                </th>
                                                <th class="text-center">
                                                   Date
                                                </th>
                                                <th class="text-center">
                                                  Date
                                                </th>
                                                 <th class="text-center">
                                                  Date
                                                </th>
                                                <th class="text-center">
                                                   Date
                                                </th>
                                                <th class="text-center">
                                                   Date
                                                </th>
                                                 <th class="text-center">
                                                   Date
                                                </th>
                                                <th class="text-center">
                                                  Date
                                                </th>
                                                <th class="text-center">
                                                  Date
                                                </th>
                                                 <th class="text-center">
                                                   Date
                                                </th>
                                                <th class="text-center">
                                                   Date
                                                </th>
                                                <th class="text-center">
                                                  Date
                                                </th>

                                           </tr>
                                        </thead>
                                        <tbody>
                                            <?php echo  $incAssHelper->getTableRow($incAssHelper->arrUpperLimb, $mpc_upper_limb->toArray()); ?>
                                        </tbody>
                                 </table>
                            </div>
                        </div>
                    </div>
                 </div>
                 <div class="form-group">
                      <div class="row">
                          <div class="col-md-4 col-md-pull-0">
                             <div class="radio">
                                  <p>Muscle Strength: </p>
                             </div>
                          </div>
                          <div class="col-md-8 col-md-pull-2">
                                <div class="radio">
                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_9" value="Level 1" {{ $incAssHelper->isChecked($mpc_part_a->mpc_qn_a_9, 'Level 1')}} >Level 1</label>
                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_9" value="Level 2" {{ $incAssHelper->isChecked($mpc_part_a->mpc_qn_a_9, 'Level 2')}} >Level 2</label>
                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_9" value="Level 3" {{ $incAssHelper->isChecked($mpc_part_a->mpc_qn_a_9, 'Level 3')}} >Level 3</label>
                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_9" value="Level 4" {{ $incAssHelper->isChecked($mpc_part_a->mpc_qn_a_9, 'Level 4')}} >Level 4</label>
                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_9" value="Level 5" {{ $incAssHelper->isChecked($mpc_part_a->mpc_qn_a_9, 'Level 5')}} >Level 5</label>
                                </div>
                           </div>
				     </div>
                 </div>
                 <div class="form-group">
                      <div class="row">
                          <div class="col-md-4 col-md-pull-0">
                             <div class="radio">
                                  <p>Tone: </p>
                             </div>
                          </div>
                          <div class="col-md-8 col-md-pull-2">
                                <div class="radio">
                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_10" value="Level 1" {{ $incAssHelper->isChecked($mpc_part_a->mpc_qn_a_10, 'Level 1')}} >Level 1</label>
                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_10" value="Level 2" {{ $incAssHelper->isChecked($mpc_part_a->mpc_qn_a_10, 'Level 2')}} >Level 2</label>
                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_10" value="Level 3" {{ $incAssHelper->isChecked($mpc_part_a->mpc_qn_a_10, 'Level 3')}} >Level 3</label>
                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_10" value="Level 4" {{ $incAssHelper->isChecked($mpc_part_a->mpc_qn_a_10, 'Level 4')}} >Level 4</label>
                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_10" value="Level 5" {{ $incAssHelper->isChecked($mpc_part_a->mpc_qn_a_10, 'Level 5')}} >Level 5</label>
                                </div>
                          </div>
				     </div>
                 </div>
                 <div class="form-group">
                      <div class="row">
                          <div class="col-md-4 col-md-pull-0">
                             <div class="radio">
                                  <p>Endurance: </p>
                             </div>
                          </div>
                          <div class="col-md-8 col-md-pull-2">
                                <div class="radio">
                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_11" value="Level 1" {{ $incAssHelper->isChecked($mpc_part_a->mpc_qn_a_11, 'Level 1')}} >Level 1</label>
                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_11" value="Level 2" {{ $incAssHelper->isChecked($mpc_part_a->mpc_qn_a_11, 'Level 2')}} >Level 2</label>
                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_11" value="Level 3" {{ $incAssHelper->isChecked($mpc_part_a->mpc_qn_a_11, 'Level 3')}} >Level 3</label>
                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_11" value="Level 4" {{ $incAssHelper->isChecked($mpc_part_a->mpc_qn_a_11, 'Level 4')}} >Level 4</label>
                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_11" value="Level 5" {{ $incAssHelper->isChecked($mpc_part_a->mpc_qn_a_11, 'Level 5')}} >Level 5</label>
                                </div>
                          </div>
				     </div>
                 </div>
                 <div class="form-group">
                     <textarea rows="2" class="form-control" name="mpc_qn_a_10_remark" id="mpc_qn_a_10_remark" placeholder="Remark">{{$incAssHelper->getTextFieldValue($mpc_part_a->mpc_qn_a_10_remark)}}</textarea>
                  </div>
                 <div class="form-group">
                      <div class="row">
                          <div class="col-md-4 col-md-pull-0">
                             <div class="radio">
                                  <p>Balance: </p>
                             </div>
                          </div>
                          <div class="col-md-8 col-md-pull-1">
                                <div class="radio">
                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_12" value="Level 1" {{ $incAssHelper->isChecked($mpc_part_a->mpc_qn_a_12, 'Level 1')}} >Level 1</label>
                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_12" value="Level 2" {{ $incAssHelper->isChecked($mpc_part_a->mpc_qn_a_12, 'Level 2')}} >Level 2</label>
                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_12" value="Level 3" {{ $incAssHelper->isChecked($mpc_part_a->mpc_qn_a_12, 'Level 3')}} >Level 3</label>
                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_12" value="Level 4" {{ $incAssHelper->isChecked($mpc_part_a->mpc_qn_a_12, 'Level 4')}} >Level 4</label>
                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_12" value="Level 5" {{ $incAssHelper->isChecked($mpc_part_a->mpc_qn_a_12, 'Level 5')}} >Level 5</label>
                                </div>
                          </div>
				     </div>
                 </div>
                 <div class="form-group">
                      <div class="row">
                          <div class="col-md-4 col-md-pull-0">
                             <div class="radio">
                                  <p>Lying to sitting (prone/supine): </p>
                             </div>
                          </div>
                          <div class="col-md-8 col-md-pull-1">
                                <div class="radio">
                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_13" value="Level 1" {{ $incAssHelper->isChecked($mpc_part_a->mpc_qn_a_13, 'Level 1')}} >Level 1</label>
                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_13" value="Level 2" {{ $incAssHelper->isChecked($mpc_part_a->mpc_qn_a_13, 'Level 2')}} >Level 2</label>
                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_13" value="Level 3" {{ $incAssHelper->isChecked($mpc_part_a->mpc_qn_a_13, 'Level 3')}} >Level 3</label>
                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_13" value="Level 4" {{ $incAssHelper->isChecked($mpc_part_a->mpc_qn_a_13, 'Level 4')}} >Level 4</label>
                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_13" value="Level 5" {{ $incAssHelper->isChecked($mpc_part_a->mpc_qn_a_13, 'Level 5')}} >Level 5</label>
                                </div>
                          </div>
				     </div>
                 </div>
                 <div class="form-group">
                      <div class="row">
                          <div class="col-md-4 col-md-pull-0">
                             <div class="radio">
                                  <p>Sitting: </p>
                             </div>
                          </div>
                          <div class="col-md-8 col-md-pull-1">
                                <div class="radio">
                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_14" value="Level 1" {{ $incAssHelper->isChecked($mpc_part_a->mpc_qn_a_14, 'Level 1')}} >Level 1</label>
                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_14" value="Level 2" {{ $incAssHelper->isChecked($mpc_part_a->mpc_qn_a_14, 'Level 2')}} >Level 2</label>
                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_14" value="Level 3" {{ $incAssHelper->isChecked($mpc_part_a->mpc_qn_a_14, 'Level 3')}} >Level 3</label>
                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_14" value="Level 4" {{ $incAssHelper->isChecked($mpc_part_a->mpc_qn_a_14, 'Level 4')}} >Level 4</label>
                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_14" value="Level 5" {{ $incAssHelper->isChecked($mpc_part_a->mpc_qn_a_14, 'Level 5')}} >Level 5</label>
                                </div>
                          </div>
				     </div>
                 </div>
                  <div class="form-group">
                      <div class="row">
                          <div class="col-md-4 col-md-pull-0">
                             <div class="radio">
                                  <p>Squatting: </p>
                             </div>
                          </div>
                          <div class="col-md-8 col-md-pull-1">
                                <div class="radio">
                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_15" value="Level 1" {{ $incAssHelper->isChecked($mpc_part_a->mpc_qn_a_15, 'Level 1')}} >Level 1</label>
                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_15" value="Level 2" {{ $incAssHelper->isChecked($mpc_part_a->mpc_qn_a_15, 'Level 2')}} >Level 2</label>
                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_15" value="Level 3" {{ $incAssHelper->isChecked($mpc_part_a->mpc_qn_a_15, 'Level 3')}} >Level 3</label>
                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_15" value="Level 4" {{ $incAssHelper->isChecked($mpc_part_a->mpc_qn_a_15, 'Level 4')}} >Level 4</label>
                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_15" value="Level 5" {{ $incAssHelper->isChecked($mpc_part_a->mpc_qn_a_15, 'Level 5')}} >Level 5</label>
                                </div>
                          </div>
				     </div>
                 </div>
                  <div class="form-group">
                      <div class="row">
                          <div class="col-md-4 col-md-pull-0">
                             <div class="radio">
                                  <p>Standing: </p>
                             </div>
                          </div>
                          <div class="col-md-8 col-md-pull-1">
                                <div class="radio">
                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_16" value="Level 1" {{ $incAssHelper->isChecked($mpc_part_a->mpc_qn_a_16, 'Level 1')}} >Level 1</label>
                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_16" value="Level 2" {{ $incAssHelper->isChecked($mpc_part_a->mpc_qn_a_16, 'Level 2')}} >Level 2</label>
                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_16" value="Level 3" {{ $incAssHelper->isChecked($mpc_part_a->mpc_qn_a_16, 'Level 3')}} >Level 3</label>
                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_16" value="Level 4" {{ $incAssHelper->isChecked($mpc_part_a->mpc_qn_a_16, 'Level 4')}} >Level 4</label>
                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_16" value="Level 5" {{ $incAssHelper->isChecked($mpc_part_a->mpc_qn_a_16, 'Level 5')}} >Level 5</label>
                                </div>
                              </div>
				           </div>
                         </div>
                    </div>
                </div>
            </div>
           <div class="form-group">
              <div class="row">
                      <div class="col-md-12">
                              <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12 col-md-pull-0">
        							 <div class="radio">
        								  <p>Posture (Sitting, standing,prone and supine) : </p>
        							 </div>
        						</div>
        				  </div>
                  </div>
                  <div class="form-group">
        					 <div class="row">
        						<div class="col-md-12 col-md-pull-0">
        							 <label>1.  {{strtoupper("For Children")}}</label>
                                  <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center" >

                                                </th>
                                                <th class="text-center" >
                                                  <p>Good/Hands free and able to shift weight</p>
                                                </th>
                                                <th class="text-center" >
                                                  <p>Fair/Hands Free only</p>
                                                </th>
                                                <th class="text-center">
                                                  <p>Poor/Users hands support</p>
                                                </th>
                                                <th class="text-center">
                                                  <p>Dependent /Needs external support</p>
                                                </th>
                                           </tr>
                                        </thead>
                                        <tbody>
                                            <tr >
                                               <td class="text-center">Edge of Table</td>
                                                <td class="text-center">
                                                    <div class="checkbox">
                                                        <div class="">
                                                              Image goes here
                                                        </div>
                                                        <label class="checkbox-inline"><input type="checkbox" name ="mpc_qn_a_17" value="1" {{ $incAssHelper->isChecked($mpc_part_a_posture->mpc_qn_a_17, '1')}} ></label>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="checkbox">
                                                        <div class="">
                                                              Image goes here
                                                        </div>
                                                        <label class="checkbox-inline"><input type="checkbox" name ="mpc_qn_a_18" value="1" {{ $incAssHelper->isChecked($mpc_part_a_posture->mpc_qn_a_18, '1')}} ></label>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="checkbox">
                                                        <div class="">
                                                              Image goes here
                                                        </div>
                                                        <label class="checkbox-inline"><input type="checkbox" name ="mpc_qn_a_19" value="1" {{ $incAssHelper->isChecked($mpc_part_a_posture->mpc_qn_a_19, '1')}}  ></label>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="checkbox">
                                                        <div class="">
                                                              Image goes here
                                                        </div>
                                                        <label class="checkbox-inline"><input type="checkbox" name ="mpc_qn_a_20" value="1" {{ $incAssHelper->isChecked($mpc_part_a_posture->mpc_qn_a_20, '1')}}  ></label>
                                                    </div>
                                                </td>
                                           </tr>
                                           <tr >
                                                 <td class="text-center">Edge of Table</td>
                                                 <td class="text-center">
                                                        <div class="checkbox">
                                                            <div class="">
                                                                  Image goes here
                                                            </div>
                                                            <label class="checkbox-inline"><input type="checkbox" name ="mpc_qn_a_21" value="1" {{ $incAssHelper->isChecked($mpc_part_a_posture->mpc_qn_a_21, '1')}}  ></label>
                                                        </div>
                                                   </td>
                                                   <td class="text-center">
                                                        <div class="checkbox">
                                                            <div class="">
                                                                  Image goes here
                                                            </div>
                                                            <label class="checkbox-inline"><input type="checkbox" name ="mpc_qn_a_22" value="1" {{ $incAssHelper->isChecked($mpc_part_a_posture->mpc_qn_a_22, '1')}} ></label>
                                                        </div>
                                                    </td>
                                                   <td class="text-center">
                                                        <div class="checkbox">
                                                            <div class="">
                                                                  Image goes here
                                                            </div>
                                                            <label class="checkbox-inline"><input type="checkbox" name ="mpc_qn_a_23" value="1" {{ $incAssHelper->isChecked($mpc_part_a_posture->mpc_qn_a_23, '1')}} ></label>
                                                        </div>
                                                    </td>
                                                   <td class="text-center">
                                                        <div class="checkbox">
                                                            <div class="">
                                                                  Image goes here
                                                            </div>
                                                            <label class="checkbox-inline"><input type="checkbox" name ="mpc_qn_a_24" value="1" {{ $incAssHelper->isChecked($mpc_part_a_posture->mpc_qn_a_24, '1')}} ></label>
                                                        </div>
                                                    </td>
                                               </tr>
                                        </tbody>
                                 </table>
						</div>
				   </div>
                </div>
                <div class="form-group">
                     <label>FOR ADULT (Describe)</label>
                 </div>
                <div class="form-group">
                   <div class="row">
                      <div class="col-md-4 ">
                            <div class="form-group">
                                <p>Head Control</p>
                            </div>
                      </div>
                      <div class="col-md-6 col-md-pull-1">
                            <div class="form-group">
                                <input type="text" class="form-control" id="" placeholder="Describe" name ="mpc_qn_a_25_remark" value="{{$incAssHelper->getTextFieldValue($mpc_part_a_posture->mpc_qn_a_25_remark)}}">
                            </div>
                      </div>
                   </div>
                </div>
                <div class="form-group">
                   <div class="row">
                      <div class="col-md-4 col-md-pull-0">
                            <div class="form-group">
                                <pl>Trunk Control</p>
                            </div>
                      </div>
                      <div class="col-md-6 col-md-pull-1">
                            <div class="form-group">
                                 <input type="text" class="form-control" id="" placeholder="Describe" name ="mpc_qn_a_26_remark" value="{{$incAssHelper->getTextFieldValue($mpc_part_a_posture->mpc_qn_a_26_remark)}}">
                            </div>
                      </div>
                    </div>
                </div>
                <div class="form-group">
                     <div class="row">
                          <div class="col-md-4 col-md-pull-0">
                                <div class="form-group">
                                    <p>Spinal deformities</p>
                                </div>
                          </div>
                          <div class="col-md-6 col-md-pull-1">
                                <div class="form-group">
                                   <input type="text" class="form-control" id="" placeholder="Describe" name ="mpc_qn_a_27_remark" value="{{$incAssHelper->getTextFieldValue($mpc_part_a_posture->mpc_qn_a_27_remark)}}">
                                </div>
                          </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                          <div class="col-md-4 col-md-pull-0">
                                <div class="form-group">
                                    <p>Sysmmetry(equ)</p>
                                </div>
                          </div>
                          <div class="col-md-6 col-md-pull-1">
                                <div class="form-group">
                                     <input type="text" class="form-control" id="" placeholder="Describe" name ="mpc_qn_a_28_remark" value="{{$incAssHelper->getTextFieldValue($mpc_part_a_posture->mpc_qn_a_28_remark)}}">
                                </div>
                          </div>
                    </div>
                 </div>
                 <div class="form-group">
                    <textarea rows="2" class="form-control" name="mpc_qn_a_29_remark" id="mpc_qn_a_29_remark" placeholder="Remarks">{{$incAssHelper->getTextFieldValue($mpc_part_a_posture->mpc_qn_a_29_remark)}}</textarea>
                 </div>
                 <div clas="form-group">
                  <div class="row">
                          <div class="col-md-4 col-md-pull-0">
                                <div class="form-group">
                                     <p>Subluxation</p>
                                </div>
                          </div>
                          <div class="col-md-6 col-md-pull-1">
                                <div class="radio">
                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_30" value="Yes" {{ $incAssHelper->isChecked($mpc_part_a_posture->mpc_qn_a_30, 'Yes')}} >Yes</label>
                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_30" value="No" {{ $incAssHelper->isChecked($mpc_part_a_posture->mpc_qn_a_30, 'No')}} >No</label>
                               </div>
                          </div>
                    </div>
                   <div class="row">
                          <div class="col-md-4 col-md-pull-0">
                                 <div class="form-group">
                                   <p>Hand function</pp>
                               </div>
                          </div>
                          <div class="col-md-6 col-md-pull-1">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="" placeholder="Describe" name ="mpc_qn_a_31_remark" value="{{$incAssHelper->getTextFieldValue($mpc_part_a_posture->mpc_qn_a_31_remark)}}">
                                </div>
                          </div>
                    </div>
                     <div class="row">
                           <div class="col-md-4 col-md-pull-0">
                                <div class="form-group">
                                     <p>Coordination</p>
                                 </div>
                           </div>
                           <div class="col-md-6 col-md-pull-1">
                                <div class="radio">
                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_32" value="Yes" {{ $incAssHelper->isChecked($mpc_part_a_posture->mpc_qn_a_32, 'Yes')}} >Yes</label>
                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_32" value="No" {{ $incAssHelper->isChecked($mpc_part_a_posture->mpc_qn_a_32, 'No')}} >No</label>
                               </div>
                           </div>
                    </div>
                    <div class="row">
                           <div class="col-md-4 col-md-pull-0">
                                <div class="form-group">
                                    <p>Eye hand coordination</p>
                                 </div>
                          </div>
                          <div class="col-md-6 col-md-pull-1">
                                <div class="radio">
                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_33" value="Yes" {{ $incAssHelper->isChecked($mpc_part_a_posture->mpc_qn_a_33, 'Yes')}} >Yes</label>
                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_33" value="No" {{ $incAssHelper->isChecked($mpc_part_a_posture->mpc_qn_a_33, 'No')}} >No</label>
                               </div>
                          </div>
                    </div>
                     <div class="row">
                          <div class="col-md-4 col-md-pull-0">
                                <div class="form-group">
                                    <p>Hand to hand coordination</p>
                                </div>
                          </div>
                          <div class="col-md-6 col-md-pull-1">
                                <div class="radio">
                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_34" value="Yes" {{ $incAssHelper->isChecked($mpc_part_a_posture->mpc_qn_a_34, 'Yes')}} >Yes</label>
                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_34" value="No" {{ $incAssHelper->isChecked($mpc_part_a_posture->mpc_qn_a_34, 'No')}} >No</label>
                               </div>
                         </div>
                 </div>
                 <div class="form-group">
                    <textarea rows="2" class="form-control" name="mpc_qn_a_35_remark" id="mpc_qn_a_35_remark" placeholder="Remarks">{{$incAssHelper->getTextFieldValue($mpc_part_a_posture->mpc_qn_a_35_remark)}}</textarea>
                 </div>
                 <div class="form-group">
                     <label>Grasp</label>
                 </div>
                 <div class="form-group">
					 <div class="row">
						<div class="col-md-4 col-md-pull-0">
							 <div class="radio">
								  <p>Pincer grasp : </p>
							 </div>
						</div>
						<div class="col-md-8 col-md-pull-1">
							<div class="radio">
                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_35" value="Yes" {{ $incAssHelper->isChecked($mpc_part_a_posture->mpc_qn_a_35, 'Yes')}} >Yes</label>
                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_35" value="No" {{ $incAssHelper->isChecked($mpc_part_a_posture->mpc_qn_a_35, 'No')}} >No</label>
                            </div>
						</div>
				     </div>
                     <div class="row">
						<div class="col-md-4 col-md-pull-0">
							 <div class="radio">
								  <p>Tripod grasp : </p>
							 </div>
						</div>
						<div class="col-md-8 col-md-pull-1">
							<div class="radio">
                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_36" value="Yes" {{ $incAssHelper->isChecked($mpc_part_a_posture->mpc_qn_a_36, 'Yes')}} >Yes</label>
                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_36" value="No" {{ $incAssHelper->isChecked($mpc_part_a_posture->mpc_qn_a_36, 'No')}} >No</label>
                            </div>
						</div>
				     </div>
                     <div class="row">
						<div class="col-md-4 col-md-pull-0">
							 <div class="radio">
								  <p>Power grasp : </p>
							 </div>
						</div>
						<div class="col-md-8 col-md-pull-1">
							<div class="radio">
                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_37" value="Yes" {{ $incAssHelper->isChecked($mpc_part_a_posture->mpc_qn_a_37, 'Yes')}} >Yes</label>
                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_37" value="No" {{ $incAssHelper->isChecked($mpc_part_a_posture->mpc_qn_a_37, 'No')}} >No</label>
                            </div>
						</div>
				     </div>
                     <div class="row">
						<div class="col-md-4 col-md-pull-0">
							 <div class="radio">
								  <p>Cyndrical grasp : </p>
							 </div>
						</div>
						<div class="col-md-8 col-md-pull-1">
							<div class="radio">
                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_38" value="Yes" {{ $incAssHelper->isChecked($mpc_part_a_posture->mpc_qn_a_38, 'Yes')}} >Yes</label>
                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_38" value="No" {{ $incAssHelper->isChecked($mpc_part_a_posture->mpc_qn_a_38, 'No')}} >No</label>
                            </div>
						</div>
				    </div>
                    <div class="row">
						<div class="col-md-4 col-md-pull-0">
							 <div class="radio">
								  <p>Bilateral use of hands : </p>
							 </div>
						</div>
						<div class="col-md-8 col-md-pull-1">
							<div class="radio">
                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_39" value="Yes" {{ $incAssHelper->isChecked($mpc_part_a_posture->mpc_qn_a_39, 'Yes')}} >Yes</label>
                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_39" value="No" {{ $incAssHelper->isChecked($mpc_part_a_posture->mpc_qn_a_39, 'No')}} >No</label>
                            </div>
						</div>
				    </div>
                    <div class="row">
						<div class="col-md-4 col-md-pull-0">
							 <div class="radio">
								  <p>Hand dominance : </p>
							 </div>
						</div>
						<div class="col-md-8 col-md-pull-1">
							<div class="radio">
                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_40" value="Left hand" {{ $incAssHelper->isChecked($mpc_part_a_posture->mpc_qn_a_40, 'Left hand')}} >Left hand</label>
                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_40" value="Left hand" {{ $incAssHelper->isChecked($mpc_part_a_posture->mpc_qn_a_40, 'Right hand')}} >Right hand</label>
                            </div>
						</div>
				    </div>
                </div>
                <div class="form-group">
                    <textarea rows="2" class="form-control" name="mpc_qn_a_41_remark" id="mpc_qn_a_41_remark" placeholder="Comment">{{$incAssHelper->getTextFieldValue($mpc_part_a_posture->mpc_qn_a_41_remark)}}</textarea>
                </div>
                <hr>
                <div class="form-group">
				    <label>{{strtoupper("Moving Pattern")}}</label>

                </div>
                <hr>
                <div class="form-group">
				    <div class="row">
                         <div class="col-md-12 col-md-pull-0">
                              <div class="form-group">
                                  <textarea rows="2" class="form-control" name="mpc_qn_a_42_remark" id="mpc_qn_a_42_remark" placeholder="Description">{{$incAssHelper->getTextFieldValue($moving_pattern->mpc_qn_a_42_remark)}}</textarea>
                             </div>
                        </div>
                    </div>
					<div class="row">
						<div class="col-md-12 col-md-pull-0">

                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center" colspan="2" >
                                          GAIT
                                        </th>
                                        <th class="text-center" >
                                          Left leg <br>(Foot/Knee/hip)
                                        </th>
                                        <th class="text-center" >
                                           Right leg <br> (Foot/Knee/hip)
                                        </th>
                                        <th class="text-center">
                                          Trunk
                                        </th>

                                   </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                       <td class="text-center" rowspan="2">
                                            Stance <br>
                                           Need image
                                        </td>
                                        <td class="text-center">
                                           With Assistive Device
                                        </td>
                                        <td class="text-center">
                                            <div class="radio">
                                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_42" value="Yes" {{ $incAssHelper->isChecked($moving_pattern->mpc_qn_a_42, 'Yes')}} >Yes</label>
                                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_42" value="No" {{ $incAssHelper->isChecked($moving_pattern->mpc_qn_a_42, 'No')}} >No</label>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="radio">
                                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_43" value="Yes" {{ $incAssHelper->isChecked($moving_pattern->mpc_qn_a_43, 'Yes')}} >Yes</label>
                                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_43" value="No" {{ $incAssHelper->isChecked($moving_pattern->mpc_qn_a_43, 'No')}} >No</label>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="radio">
                                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_44" value="Yes" {{ $incAssHelper->isChecked($moving_pattern->mpc_qn_a_44, 'Yes')}} >Yes</label>
                                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_44" value="No" {{ $incAssHelper->isChecked($moving_pattern->mpc_qn_a_44, 'No')}} >No</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                           Without Assistive Device
                                        </td>
                                        <td class="text-center">
                                            <div class="radio">
                                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_45" value="Yes" {{ $incAssHelper->isChecked($moving_pattern->mpc_qn_a_45, 'Yes')}} >Yes</label>
                                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_45" value="No"  {{ $incAssHelper->isChecked($moving_pattern->mpc_qn_a_45, 'No')}} >No</label>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="radio">
                                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_46" value="Yes" {{ $incAssHelper->isChecked($moving_pattern->mpc_qn_a_46, 'Yes')}} >Yes</label>
                                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_46" value="No" {{ $incAssHelper->isChecked($moving_pattern->mpc_qn_a_46, 'No')}} >No</label>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="radio">
                                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_47" value="Yes" {{ $incAssHelper->isChecked($moving_pattern->mpc_qn_a_47, 'Yes')}} >Yes</label>
                                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_47" value="No" {{ $incAssHelper->isChecked($moving_pattern->mpc_qn_a_47, 'No')}} >No</label>
                                            </div>
                                        </td>
                                   </tr>
                                    <tr>
                                       <td class="text-center" rowspan="2">
                                            Swing <br>
                                           Need image
                                        </td>
                                        <td class="text-center">
                                           With Assistive Device
                                        </td>
                                        <td class="text-center">
                                            <div class="radio">
                                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_48" value="Yes" {{ $incAssHelper->isChecked($moving_pattern->mpc_qn_a_48, 'Yes')}} >Yes</label>
                                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_48" value="No" {{ $incAssHelper->isChecked($moving_pattern->mpc_qn_a_48, 'No')}}>No</label>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="radio">
                                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_49" value="Yes" {{ $incAssHelper->isChecked($moving_pattern->mpc_qn_a_49, 'Yes')}}>Yes</label>
                                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_49" value="No" {{ $incAssHelper->isChecked($moving_pattern->mpc_qn_a_49, 'No')}} >No</label>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="radio">
                                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_50" value="Yes" {{ $incAssHelper->isChecked($moving_pattern->mpc_qn_a_50, 'Yes')}} >Yes</label>
                                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_50" value="No" {{ $incAssHelper->isChecked($moving_pattern->mpc_qn_a_50, 'Yes')}}>No</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                           Without Assistive Device
                                        </td>
                                        <td class="text-center">
                                            <div class="radio">
                                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_51" value="Yes" {{ $incAssHelper->isChecked($moving_pattern->mpc_qn_a_51, 'Yes')}} >Yes</label>
                                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_51" value="No" {{ $incAssHelper->isChecked($moving_pattern->mpc_qn_a_51, 'No')}} >No</label>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="radio">
                                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_52" value="Yes" {{ $incAssHelper->isChecked($moving_pattern->mpc_qn_a_52, 'Yes')}}>Yes</label>
                                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_52" value="No" {{ $incAssHelper->isChecked($moving_pattern->mpc_qn_a_52, 'No')}}>No</label>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="radio">
                                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_53" value="Yes" {{ $incAssHelper->isChecked($moving_pattern->mpc_qn_a_53, 'Yes')}}>Yes</label>
                                                  <label class="radio-inline"><input type="radio" name ="mpc_qn_a_53" value="No" {{ $incAssHelper->isChecked($moving_pattern->mpc_qn_a_53, 'No')}}>No</label>
                                            </div>
                                        </td>
                                   </tr>
                               </tbody>
                         </table>
				    </div>
				</div>
                </div>
                </div>
	       </div>
      </div>
     <hr>
       <div class="row">
         <div class="col-md-12">
                 <div class="form-group">
					  <label>B.  {{strtoupper("Sensory Abilities")}}</label>
                 </div>
				<div class="form-group">
					 	 <label>Communication Means Assessment</label>
                </div>
                <div class="form-group">
                      <div class="row">
                          <div class="col-md-4 col-md-pull-0">
                                <div class="checkbox">
                                     <p>Vision : </p>
                                </div>
                          </div>
                          <div class="col-md-8 col-md-pull-1">
                                <div class="checkbox">
                                  <label class="checkbox-inline"><input type="checkbox" name ="mpc_qn_b_1[]"  value="Normal" {{ $incAssHelper->getCheckedBox($mpc_part_b->mpc_qn_b_1, 'Normal')}} >Normal</label>
                                  <label class="checkbox-inline"><input type="checkbox" name ="mpc_qn_b_1[]" value="Blind" {{ $incAssHelper->getCheckedBox($mpc_part_b->mpc_qn_b_1, 'Blind')}} >Blind</label>
                                  <label class="checkbox-inline"><input type="checkbox" name ="mpc_qn_b_1[]" value="Loss of part of vision field" {{ $incAssHelper->getCheckedBox($mpc_part_b->mpc_qn_b_1, 'Loss of part of vision field')}} >Loss of part of vision field</label>
                                  <label class="checkbox-inline"><input type="checkbox" name ="mpc_qn_b_1[]" value="Strabismus" {{ $incAssHelper->getCheckedBox($mpc_part_b->mpc_qn_b_1, 'Strabismus')}} >Strabismus</label>
                               </div>
                          </div>
                    </div>
                 </div>
                 <div class="form-group">
                     <textarea rows="2" class="form-control" name="mpc_qn_b_1_remark" id="mpc_qn_b_1_remark" placeholder="Other">{{$incAssHelper->getTextFieldValue($mpc_part_b->mpc_qn_b_1_remark)}}</textarea>
                 </div>
                 <div class="form-group">
                      <div class="row">
                          <div class="col-md-4 col-md-pull-0">
                                <div class="checkbox">
                                     <p>Hearing : </p>
                                </div>
                          </div>
                          <div class="col-md-8 col-md-pull-1">
                                <div class="checkbox">
                                  <label class="checkbox-inline"><input type="checkbox" name ="mpc_qn_b_2[]" value="Normal" {{ $incAssHelper->getCheckedBox($mpc_part_b->mpc_qn_b_2, 'Normal')}} >Normal</label>
                                  <label class="checkbox-inline"><input type="checkbox" name ="mpc_qn_b_2[]" value="Deaf" {{ $incAssHelper->getCheckedBox($mpc_part_b->mpc_qn_b_2, 'Deaf')}} >Deaf</label>
                                  <label class="checkbox-inline"><input type="checkbox" name ="mpc_qn_b_2[]" value="React to noise" {{ $incAssHelper->getCheckedBox($mpc_part_b->mpc_qn_b_2, 'React to noise')}} >React to noise</label>
                                </div>
                          </div>
                    </div>
                 </div>
                 <div class="form-group">
                     <textarea rows="2" class="form-control" name="mpc_qn_b_3_remark" id="mpc_qn_b_3_remark" placeholder="Other">{{$incAssHelper->getTextFieldValue($mpc_part_b->mpc_qn_b_3_remark)}}</textarea>
                </div>
                 <div class="form-group">
                      <div class="row">
                          <div class="col-md-3 col-md-pull-0">
                                <div class="checkbox">
                                     <p>Communication : </p>
                                </div>
                          </div>
                          <div class="col-md-9 col-md-pull-1">
                                <div class="checkbox">
                                  <label class="checkbox-inline"><input type="checkbox" name ="mpc_qn_b_4[]" value="With language" {{ $incAssHelper->getCheckedBox($mpc_part_b->mpc_qn_b_4, 'With language')}} >With language</label>
                                  <label class="checkbox-inline"><input type="checkbox" name ="mpc_qn_b_4[]" value="without language" {{ $incAssHelper->getCheckedBox($mpc_part_b->mpc_qn_b_4, 'without language')}} >Without language</label>
                                  <label class="checkbox-inline"><input type="checkbox" name ="mpc_qn_b_4[]" value="body language" {{ $incAssHelper->getCheckedBox($mpc_part_b->mpc_qn_b_4, 'body language')}} >Body language</label>
                                  <label class="checkbox-inline"><input type="checkbox" name ="mpc_qn_b_4[]" value="No communication" {{ $incAssHelper->getCheckedBox($mpc_part_b->mpc_qn_b_4, 'No communication')}} >No communication</label>
                                </div>
                          </div>
                    </div>
                 </div>
                 <hr>
                <div class="form-group">
                    <div class="row">
						<div class="col-md-12 col-md-pull-0">

                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center" >
                                                 Senses
                                                </th>
                                                <th class="text-center" >
                                                  Normal
                                                </th>
                                                <th class="text-center" >
                                                   Low
                                                </th>
                                                <th class="text-center">
                                                  High
                                                </th>
                                               <th class="text-center">
                                                 No reaction
                                                </th>

                                           </tr>
                                        </thead>
                                        <tbody>
                                            <tr>

                                                <td class="text-center">
                                                   Light touch
                                                </td>
                                                <td class="text-center">
                                                    <div class="radio">
                                                          <label class="radio-inline"><input type="radio" name ="mpc_qn_b_5" value="Yes" {{ $incAssHelper->isChecked($mpcbody_sense->mpc_qn_b_5, 'Yes')}} >Yes</label>
                                                          <label class="radio-inline"><input type="radio" name ="mpc_qn_b_5" value="No" {{ $incAssHelper->isChecked($mpcbody_sense->mpc_qn_b_5, 'No')}} >No</label>
                                                    </div>
                                                </td>
                                               <td class="text-center">
                                                    <div class="radio">
                                                          <label class="radio-inline"><input type="radio" name ="mpc_qn_b_6" value="Yes" {{ $incAssHelper->isChecked($mpcbody_sense->mpc_qn_b_6, 'Yes')}} >Yes</label>
                                                          <label class="radio-inline"><input type="radio" name ="mpc_qn_b_6" value="No" {{ $incAssHelper->isChecked($mpcbody_sense->mpc_qn_b_6, 'No')}} >No</label>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="radio">
                                                          <label class="radio-inline"><input type="radio" name ="mpc_qn_b_7" value="Yes" {{ $incAssHelper->isChecked($mpcbody_sense->mpc_qn_b_7, 'Yes')}} >Yes</label>
                                                          <label class="radio-inline"><input type="radio" name ="mpc_qn_b_7" value="No" {{ $incAssHelper->isChecked($mpcbody_sense->mpc_qn_b_7, 'No')}} >No</label>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="radio">
                                                          <label class="radio-inline"><input type="radio" name ="mpc_qn_b_8" value="Yes" {{ $incAssHelper->isChecked($mpcbody_sense->mpc_qn_b_8, 'Yes')}} >Yes</label>
                                                          <label class="radio-inline"><input type="radio" name ="mpc_qn_b_8" value="No" {{ $incAssHelper->isChecked($mpcbody_sense->mpc_qn_b_8, 'No')}} >No</label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>

                                                <td class="text-center">
                                                   Deep touch
                                                </td>
                                                <td class="text-center">
                                                    <div class="radio">
                                                          <label class="radio-inline"><input type="radio" name ="mpc_qn_b_9" value="Yes" {{ $incAssHelper->isChecked($mpcbody_sense->mpc_qn_b_9, 'Yes')}} >Yes</label>
                                                          <label class="radio-inline"><input type="radio" name ="mpc_qn_b_9" value="No" {{ $incAssHelper->isChecked($mpcbody_sense->mpc_qn_b_9, 'No')}} >No</label>
                                                    </div>
                                                </td>
                                               <td class="text-center">
                                                    <div class="radio">
                                                          <label class="radio-inline"><input type="radio" name ="mpc_qn_b_10" value="Yes" {{ $incAssHelper->isChecked($mpcbody_sense->mpc_qn_b_10, 'Yes')}} >Yes</label>
                                                          <label class="radio-inline"><input type="radio" name ="mpc_qn_b_10" value="No" {{ $incAssHelper->isChecked($mpcbody_sense->mpc_qn_b_10, 'No')}}>No</label>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="radio">
                                                          <label class="radio-inline"><input type="radio" name ="mpc_qn_b_11" value="Yes" {{ $incAssHelper->isChecked($mpcbody_sense->mpc_qn_b_11, 'Yes')}} >Yes</label>
                                                          <label class="radio-inline"><input type="radio" name ="mpc_qn_b_11" value="No" {{ $incAssHelper->isChecked($mpcbody_sense->mpc_qn_b_11, 'No')}} >No</label>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="radio">
                                                          <label class="radio-inline"><input type="radio" name ="mpc_qn_b_12" value="Yes" {{ $incAssHelper->isChecked($mpcbody_sense->mpc_qn_b_12, 'Yes')}} >Yes</label>
                                                          <label class="radio-inline"><input type="radio" name ="mpc_qn_b_12" value="No" {{ $incAssHelper->isChecked($mpcbody_sense->mpc_qn_b_12, 'No')}} >No</label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>

                                                <td class="text-center">
                                                   Proprioception
                                                </td>
                                                <td class="text-center">
                                                    <div class="radio">
                                                          <label class="radio-inline"><input type="radio" name ="mpc_qn_b_13" value="Yes" {{ $incAssHelper->isChecked($mpcbody_sense->mpc_qn_b_13, 'Yes')}} >Yes</label>
                                                          <label class="radio-inline"><input type="radio" name ="mpc_qn_b_13" value="No" {{ $incAssHelper->isChecked($mpcbody_sense->mpc_qn_b_13, 'No')}} >No</label>
                                                    </div>
                                                </td>
                                               <td class="text-center">
                                                    <div class="radio">
                                                          <label class="radio-inline"><input type="radio" name ="mpc_qn_b_14" value="Yes" {{ $incAssHelper->isChecked($mpcbody_sense->mpc_qn_b_14, 'Yes')}} >Yes</label>
                                                          <label class="radio-inline"><input type="radio" name ="mpc_qn_b_14" value="No" {{ $incAssHelper->isChecked($mpcbody_sense->mpc_qn_b_14, 'No')}}  >No</label>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="radio">
                                                          <label class="radio-inline"><input type="radio" name ="mpc_qn_b_16" value="Yes" {{ $incAssHelper->isChecked($mpcbody_sense->mpc_qn_b_16, 'Yes')}} >Yes</label>
                                                          <label class="radio-inline"><input type="radio" name ="mpc_qn_b_16" value="No" {{ $incAssHelper->isChecked($mpcbody_sense->mpc_qn_b_16, 'No')}} >No</label>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="radio">
                                                          <label class="radio-inline"><input type="radio" name ="mpc_qn_b_17" value="Yes" {{ $incAssHelper->isChecked($mpcbody_sense->mpc_qn_b_17, 'Yes')}} >Yes</label>
                                                          <label class="radio-inline"><input type="radio" name ="mpc_qn_b_17" value="No" {{ $incAssHelper->isChecked($mpcbody_sense->mpc_qn_b_17, 'No')}} >No</label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>

                                                <td class="text-center">
                                                   Heat
                                                </td>
                                                <td class="text-center">
                                                    <div class="radio">
                                                          <label class="radio-inline"><input type="radio" name ="mpc_qn_b_19" value="Yes" {{ $incAssHelper->isChecked($mpcbody_sense->mpc_qn_b_19, 'Yes')}} >Yes</label>
                                                          <label class="radio-inline"><input type="radio" name ="mpc_qn_b_19" value="No" {{ $incAssHelper->isChecked($mpcbody_sense->mpc_qn_b_19, 'No')}} >No</label>
                                                    </div>
                                                </td>
                                               <td class="text-center">
                                                    <div class="radio">
                                                          <label class="radio-inline"><input type="radio" name ="mpc_qn_b_20" value="Yes" {{ $incAssHelper->isChecked($mpcbody_sense->mpc_qn_b_20, 'Yes')}} >Yes</label>
                                                          <label class="radio-inline"><input type="radio" name ="mpc_qn_b_20" value="No" {{ $incAssHelper->isChecked($mpcbody_sense->mpc_qn_b_20, 'No')}} >No</label>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="radio">
                                                          <label class="radio-inline"><input type="radio" name ="mpc_qn_b_21" value="Yes" {{ $incAssHelper->isChecked($mpcbody_sense->mpc_qn_b_21, 'Yes')}} >Yes</label>
                                                          <label class="radio-inline"><input type="radio" name ="mpc_qn_b_21" value="No" {{ $incAssHelper->isChecked($mpcbody_sense->mpc_qn_b_21, 'No')}} >No</label>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="radio">
                                                          <label class="radio-inline"><input type="radio" name ="mpc_qn_b_22" value="Yes" {{ $incAssHelper->isChecked($mpcbody_sense->mpc_qn_b_22, 'Yes')}} >Yes</label>
                                                          <label class="radio-inline"><input type="radio" name ="mpc_qn_b_22" value="No" {{ $incAssHelper->isChecked($mpcbody_sense->mpc_qn_b_22, 'No')}} >No</label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>

                                                <td class="text-center">
                                                   Pin Prick
                                                </td>
                                                <td class="text-center">
                                                    <div class="radio">
                                                          <label class="radio-inline"><input type="radio" name ="mpc_qn_b_23" value="Yes" {{ $incAssHelper->isChecked($mpcbody_sense->mpc_qn_b_23, 'Yes')}} >Yes</label>
                                                          <label class="radio-inline"><input type="radio" name ="mpc_qn_b_23" value="No" {{ $incAssHelper->isChecked($mpcbody_sense->mpc_qn_b_23, 'No')}}>No</label>
                                                    </div>
                                                </td>
                                               <td class="text-center">
                                                    <div class="radio">
                                                          <label class="radio-inline"><input type="radio" name ="mpc_qn_b_24" value="Yes" {{ $incAssHelper->isChecked($mpcbody_sense->mpc_qn_b_24, 'Yes')}} >Yes</label>
                                                          <label class="radio-inline"><input type="radio" name ="mpc_qn_b_24" value="No" {{ $incAssHelper->isChecked($mpcbody_sense->mpc_qn_b_24, 'No')}} >No</label>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="radio">
                                                          <label class="radio-inline"><input type="radio" name ="mpc_qn_b_25" value="Yes" {{ $incAssHelper->isChecked($mpcbody_sense->mpc_qn_b_25, 'Yes')}} >Yes</label>
                                                          <label class="radio-inline"><input type="radio" name ="mpc_qn_b_25" value="No" {{ $incAssHelper->isChecked($mpcbody_sense->mpc_qn_b_25, 'No')}} >No</label>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="radio">
                                                          <label class="radio-inline"><input type="radio" name ="mpc_qn_b_26" value="Yes" {{ $incAssHelper->isChecked($mpcbody_sense->mpc_qn_b_26, 'Yes')}} >Yes</label>
                                                          <label class="radio-inline"><input type="radio" name ="mpc_qn_b_26" value="No" {{ $incAssHelper->isChecked($mpcbody_sense->mpc_qn_b_26, 'No')}} >No</label>
                                                    </div>
                                                </td>
                                            </tr>

                                        </tbody>
                                 </table>
						</div>
				   </div>
                </div>
             <div class="form-group">
                        <textarea rows="2" class="form-control" name="mpc_qn_b_27_remark" id="mpc_qn_b_27_remark" placeholder="Remarks">{{$incAssHelper->getTextFieldValue($mpc_part_b->mpc_qn_b_27_remark)}}</textarea>
             </div>
             <div class="form-group">
                  <div class="row">
                      <div class="col-md-1">
                            <div class="checkbox">
                                <p>Mood : </p>
                            </div>
                      </div>
                      <div class="col-md-11">
                            <div class="checkbox">
                              <label class="checkbox-inline"><input type="checkbox" name ="mpc_qn_b_28[]" value="Passive" {{ $incAssHelper->getCheckedBox($mpc_part_b->mpc_qn_b_28, 'Passive')}} >Passive</label>
                              <label class="checkbox-inline"><input type="checkbox" name ="mpc_qn_b_28[]" value="Active" {{ $incAssHelper->getCheckedBox($mpc_part_b->mpc_qn_b_28, 'Active')}} >Active</label>
                              <label class="checkbox-inline"><input type="checkbox" name ="mpc_qn_b_28[]" value="Happy" {{ $incAssHelper->getCheckedBox($mpc_part_b->mpc_qn_b_28, 'Happy')}} >Happy</label>
                              <label class="checkbox-inline"><input type="checkbox" name ="mpc_qn_b_28[]" value="Scared" {{ $incAssHelper->getCheckedBox($mpc_part_b->mpc_qn_b_28, 'Scared')}} >Scared</label>
                              <label class="checkbox-inline"><input type="checkbox" name ="mpc_qn_b_28[]" value="Irritable" {{ $incAssHelper->getCheckedBox($mpc_part_b->mpc_qn_b_28, 'Irritable')}} >Irritable</label>
                              <label class="checkbox-inline"><input type="checkbox" name ="mpc_qn_b_28[]" value="Crying" {{ $incAssHelper->getCheckedBox($mpc_part_b->mpc_qn_b_28, 'Crying')}} >Crying</label>
                              <label class="checkbox-inline"><input type="checkbox" name ="mpc_qn_b_28[]" value="Holds on to mother" {{ $incAssHelper->getCheckedBox($mpc_part_b->mpc_qn_b_28, 'Holds on to mother')}} >Holds on to mother</label>
                            </div>
                      </div>
                </div>
             </div>
             <div class="form-group">
					 	 <label>Cognition</label>
             </div>
             <div class="form-group">
                <div class="row">
                      <div class="col-md-4">
                            <div class="radio">
                                <p>Attention: </p>
                            </div>
                      </div>
                      <div class="col-md-8">
                            <div class="radio">
                              <label class="radio-inline"><input type="radio" name ="mpc_qn_c_1" value="Yes" {{ $incAssHelper->isChecked($mpc_part_c->mpc_qn_c_1, 'Yes')}} >Yes</label>
                              <label class="radio-inline"><input type="radio" name ="mpc_qn_c_1" value="No"  {{ $incAssHelper->isChecked($mpc_part_c->mpc_qn_c_1, 'No')}}  >No</label>
                            </div>
                      </div>
                </div>
                <div class="row">
                      <div class="col-md-4">
                            <div class="radio">
                                <p>Concentration: </p>
                            </div>
                      </div>
                      <div class="col-md-8">
                            <div class="radio">
                              <label class="radio-inline"><input type="radio" name ="mpc_qn_c_2" value="Yes" {{ $incAssHelper->isChecked($mpc_part_c->mpc_qn_c_2, 'Yes')}} >Yes</label>
                              <label class="radio-inline"><input type="radio" name ="mpc_qn_c_2" value="No" {{ $incAssHelper->isChecked($mpc_part_c->mpc_qn_c_2, 'No')}} >No</label>
                            </div>
                      </div>
                </div>
                <div class="row">
                      <div class="col-md-4">
                            <div class="radio">
                                <p>Problem solving: </p>
                            </div>
                      </div>
                      <div class="col-md-8">
                            <div class="radio">
                              <label class="radio-inline"><input type="radio" name ="mpc_qn_c_3" value="Yes" {{ $incAssHelper->isChecked($mpc_part_c->mpc_qn_c_3, 'Yes')}} >Yes</label>
                              <label class="radio-inline"><input type="radio" name ="mpc_qn_c_3" value="No" {{ $incAssHelper->isChecked($mpc_part_c->mpc_qn_c_3, 'No')}} >No</label>
                            </div>
                      </div>
                </div>
                <div class="row">
                      <div class="col-md-4">
                            <div class="radio">
                                <p>Orientation: </p>
                            </div>
                      </div>
                      <div class="col-md-8">
                            <div class="radio">
                             <label class="radio-inline"><input type="radio" name ="mpc_qn_c_5" value="Yes" {{ $incAssHelper->isChecked($mpc_part_c->mpc_qn_c_5, 'Yes')}} >Yes</label>
                              <label class="radio-inline"><input type="radio" name ="mpc_qn_c_5" value="No" {{ $incAssHelper->isChecked($mpc_part_c->mpc_qn_c_5, 'No')}} >No</label>
                            </div>
                      </div>
                </div>
                <div class="row">
                      <div class="col-md-4">
                            <div class="radio">
                                <p>Sequencing: </p>
                            </div>
                      </div>
                      <div class="col-md-8">
                            <div class="radio">
                              <label class="radio-inline"><input type="radio" name ="mpc_qn_c_6" value="Yes" {{ $incAssHelper->isChecked($mpc_part_c->mpc_qn_c_6, 'Yes')}} >Yes</label>
                              <label class="radio-inline"><input type="radio" name ="mpc_qn_c_6" value="No" {{ $incAssHelper->isChecked($mpc_part_c->mpc_qn_c_6, 'No')}} >No</label>
                            </div>
                      </div>
                </div>

             </div>
            <div class="form-group">
                        <textarea rows="2" class="form-control" name="mpc_qn_c_7_remark" id="mpc_qn_c_7_remark" placeholder="Remarks">{{$incAssHelper->getTextFieldValue($mpc_part_c->mpc_qn_c_7_remark)}}</textarea>
            </div>
             <div class="form-group">
					 	 <label>Memory (auditory/visual)</label>
             </div>
             <div class="form-group">
                <div class="row">
                      <div class="col-md-4">
                            <div class="radio">
                                <p>Short term: </p>
                            </div>
                      </div>
                      <div class="col-md-8">
                            <div class="radio">
                              <label class="radio-inline"><input type="radio" name ="mpc_qn_d_1" value="Yes" {{ $incAssHelper->isChecked($mpc_part_d->mpc_qn_d_1, 'Yes')}} >Yes</label>
                              <label class="radio-inline"><input type="radio" name ="mpc_qn_d_1" value="No" {{ $incAssHelper->isChecked($mpc_part_d->mpc_qn_d_1, 'No')}} >No</label>
                            </div>
                      </div>
                </div>
                <div class="row">
                      <div class="col-md-4">
                            <div class="radio">
                                <p>Long term: </p>
                            </div>
                      </div>
                      <div class="col-md-8">
                            <div class="radio">
                              <label class="radio-inline"><input type="radio" name ="mpc_qn_d_2" value="Yes" {{ $incAssHelper->isChecked($mpc_part_d->mpc_qn_d_2, 'Yes')}} >Yes</label>
                              <label class="radio-inline"><input type="radio" name ="mpc_qn_d_2" value="No" {{ $incAssHelper->isChecked($mpc_part_d->mpc_qn_d_2, 'No')}} >No</label>
                            </div>
                      </div>
                </div>
             </div>
             <div class="form-group">
					 	 <label>Perception</label>
             </div>
             <div class="form-group">
                <div class="row">
                      <div class="col-md-4">
                            <div class="radio">
                                <p>Topographical orientation : </p>
                            </div>
                      </div>
                      <div class="col-md-8">
                            <div class="radio">
                              <label class="radio-inline"><input type="radio" name ="mpc_qn_e_1" value="Yes" {{ $incAssHelper->isChecked($mpc_part_e->mpc_qn_e_1, 'Yes')}} >Yes</label>
                              <label class="radio-inline"><input type="radio" name ="mpc_qn_e_1" value="No"  {{ $incAssHelper->isChecked($mpc_part_e->mpc_qn_e_1, 'No')}} >No</label>
                            </div>
                      </div>
                </div>
                <div class="row">
                      <div class="col-md-4">
                            <div class="radio">
                                <p>Left/right discrimination: </p>
                            </div>
                      </div>
                      <div class="col-md-8">
                            <div class="radio">
                              <label class="radio-inline"><input type="radio" name ="mpc_qn_e_2" value="Yes" {{ $incAssHelper->isChecked($mpc_part_e->mpc_qn_e_2, 'Yes')}} >Yes</label>
                              <label class="radio-inline"><input type="radio" name ="mpc_qn_e_2" value="No" {{ $incAssHelper->isChecked($mpc_part_e->mpc_qn_e_2, 'No')}} >No</label>
                            </div>
                      </div>
                </div>
                <div class="row">
                      <div class="col-md-4">
                            <div class="radio">
                                <p>Body perception: </p>
                            </div>
                      </div>
                      <div class="col-md-8">
                            <div class="radio">
                              <label class="radio-inline"><input type="radio" name ="mpc_qn_e_5" value="Yes" {{ $incAssHelper->isChecked($mpc_part_e->mpc_qn_e_5, 'Yes')}} >Yes</label>
                              <label class="radio-inline"><input type="radio" name ="mpc_qn_e_5" value="No" {{ $incAssHelper->isChecked($mpc_part_e->mpc_qn_e_5, 'No')}} >No</label>
                            </div>
                      </div>
                </div>
                <div class="row">
                      <div class="col-md-4">
                            <div class="radio">
                                <p>Visual perception: </p>
                            </div>
                      </div>
                      <div class="col-md-8">
                            <div class="radio">
                              <label class="radio-inline"><input type="radio" name ="mpc_qn_e_6" value="Yes" {{ $incAssHelper->isChecked($mpc_part_e->mpc_qn_e_6, 'Yes')}} >Yes</label>
                              <label class="radio-inline"><input type="radio" name ="mpc_qn_e_6" value="No" {{ $incAssHelper->isChecked($mpc_part_e->mpc_qn_e_6, 'No')}} >No</label>
                            </div>
                      </div>
                 </div>
                 <div class="row">
                      <div class="col-md-4">
                            <div class="radio">
                                <p>Color: </p>
                            </div>
                      </div>
                      <div class="col-md-8">
                            <div class="radio">
                              <label class="radio-inline"><input type="radio" name ="mpc_qn_e_7" value="Yes" {{ $incAssHelper->isChecked($mpc_part_e->mpc_qn_e_7, 'Yes')}} >Yes</label>
                              <label class="radio-inline"><input type="radio" name ="mpc_qn_e_7" value="No" {{ $incAssHelper->isChecked($mpc_part_e->mpc_qn_e_7, 'No')}} >No</label>
                            </div>
                      </div>
                </div>
             </div>
            <div class="form-group">
                <textarea rows="2" class="form-control" name="mpc_qn_e_8_remark" id="mpc_qn_e_8_remark" placeholder="Remarks">{{$incAssHelper->getTextFieldValue($mpc_part_e->mpc_qn_e_8_remark)}}</textarea>
            </div>
             <div class="form-group">
					 	 <label>Language and Communication</label>
             </div>
             <div class="form-group">
                <div class="row">
                      <div class="col-md-4">
                            <div class="radio">
                                <p>Expressive : </p>
                            </div>
                      </div>
                      <div class="col-md-8">
                            <div class="radio">
                              <label class="radio-inline"><input type="radio" name ="mpc_qn_f_1" value="Yes" {{ $incAssHelper->isChecked($mpc_part_f->mpc_qn_f_1, 'Yes')}} >Yes</label>
                              <label class="radio-inline"><input type="radio" name ="mpc_qn_f_1" value="No" {{ $incAssHelper->isChecked($mpc_part_f->mpc_qn_f_1, 'No')}} >No</label>
                            </div>
                      </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <textarea rows="2" class="form-control" name="mpc_qn_f_2_remark" id="mpc_qn_f_2_remark" placeholder="Remarks">{{$incAssHelper->getTextFieldValue($mpc_part_f->mpc_qn_f_2_remark)}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                      <div class="col-md-4">
                            <div class="radio">
                                <p>Receptive : </p>
                            </div>
                      </div>
                      <div class="col-md-8">
                            <div class="radio">
                              <label class="radio-inline"><input type="radio" name ="mpc_qn_f_3" value="Yes" {{ $incAssHelper->isChecked($mpc_part_f->mpc_qn_f_3, 'Yes')}} >Yes</label>
                              <label class="radio-inline"><input type="radio" name ="mpc_qn_f_3" value="No" {{ $incAssHelper->isChecked($mpc_part_f->mpc_qn_f_3, 'No')}} >No</label>
                            </div>
                      </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <textarea rows="2" class="form-control" name="mpc_qn_f_4_remark" id="mpc_qn_f_4_remark" placeholder="Remarks">{{$incAssHelper->getTextFieldValue($mpc_part_f->mpc_qn_f_4_remark)}}</textarea>
                        </div>
                    </div>
                </div>

             </div>
             <div class="form-group">
					 	 <label>Psychosocial</label>
             </div>
             <div class="form-group">
                <div class="row">
                      <div class="col-md-4">
                            <div class="radio">
                                <p>Mood/affect : </p>
                            </div>
                      </div>
                      <div class="col-md-8">
                            <div class="radio">
                              <label class="radio-inline"><input type="radio" name ="mpc_qn_f_5" value="Yes" {{ $incAssHelper->isChecked($mpc_part_f->mpc_qn_f_5, 'Yes')}} >Yes</label>
                              <label class="radio-inline"><input type="radio" name ="mpc_qn_f_5" value="No" {{ $incAssHelper->isChecked($mpc_part_f->mpc_qn_f_5, 'No')}} >No</label>
                            </div>
                      </div>
                </div>
                 <div class="row">
                      <div class="col-md-4">
                            <div class="radio">
                                <p>Motivation : </p>
                            </div>
                      </div>
                      <div class="col-md-8">
                            <div class="radio">
                              <label class="radio-inline"><input type="radio" name ="mpc_qn_f_6" value="Yes" {{ $incAssHelper->isChecked($mpc_part_f->mpc_qn_f_6, 'Yes')}} >Yes</label>
                              <label class="radio-inline"><input type="radio" name ="mpc_qn_f_6" value="No" {{ $incAssHelper->isChecked($mpc_part_f->mpc_qn_f_6, 'No')}} >No</label>
                            </div>
                      </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <textarea rows="2" class="form-control" name="mpc_qn_f_7_remark" id="mpc_qn_f_7_remark" placeholder="Remarks">{{$incAssHelper->getTextFieldValue($mpc_part_f->mpc_qn_f_7_remark)}}</textarea>
                        </div>
                    </div>
                </div>
             </div>
              <div class="form-group">
					 <div class="row">
						<div class="col-md-12 col-md-pull-0">
                                   <p>Self-care and Activities of Daily Living (Ask for demonstrations where necessary)</p>
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center">

                                                </th>
                                                <th class="text-center" >
                                                  Ranges
                                                </th>
                                                <th class="text-center" >
                                                  1
                                                </th>
                                                <th class="text-center" >
                                                   2
                                                </th>
                                                <th class="text-center">
                                                  3
                                                </th>
                                               <th class="text-center">
                                                 4
                                                </th>
                                              <th class="text-center">
                                                 5
                                             </th>

                                           </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center">
                                                   Activities
                                                </td>
                                                <td class="text-center">
                                                    <div class="checkbox">
                                                          <label class="checkbox-inline"><input type="checkbox" name ="mpc_qn_perf_area_1[]" value="init" {{ $incAssHelper->getCheckedBox($mpc_perf_area->mpc_perf_area_1, 'init')}}></label>
                                                     </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="checkbox">
                                                          <label class="checkbox-inline"><input type="checkbox" name ="mpc_qn_perf_area_1[]" value="1" {{ $incAssHelper->getCheckedBox($mpc_perf_area->mpc_perf_area_1, '1')}} ></label>
                                                    </div>
                                                 </td>
                                                 <td class="text-center">
                                                    <div class="checkbox">
                                                          <label class="checkbox-inline"><input type="checkbox" name ="mpc_qn_perf_area_1[]" value="2" {{ $incAssHelper->getCheckedBox($mpc_perf_area->mpc_perf_area_1, '2')}} ></label>
                                                    </div>
                                                 </td>
                                                 <td class="text-center">
                                                    <div class="checkbox">
                                                          <label class="checkbox-inline"><input type="checkbox" name ="mpc_qn_perf_area_1[]" value="3" {{ $incAssHelper->getCheckedBox($mpc_perf_area->mpc_perf_area_1, '3')}} ></label>
                                                    </div>
                                                 </td>
                                                 <td class="text-center">
                                                    <div class="checkbox">
                                                          <label class="checkbox-inline"><input type="checkbox" name ="mpc_qn_perf_area_1[]" value="4" {{ $incAssHelper->getCheckedBox($mpc_perf_area->mpc_perf_area_1, '4')}} ></label>
                                                    </div>
                                                 </td>
                                                <td class="text-center">
                                                    <div class="checkbox">
                                                          <label class="checkbox-inline"><input type="checkbox" name ="mpc_qn_perf_area_1[]" value="5" {{ $incAssHelper->getCheckedBox($mpc_perf_area->mpc_perf_area_1, '5')}} ></label>
                                                    </div>
                                                 </td>
                                            </tr>
                                            <tr>
                                            <td class="text-center">
                                                 Feeding
                                                </td>
                                                <td class="text-center">
                                                    <div class="checkbox">
                                                          <label class="checkbox-inline"><input type="checkbox" name ="mpc_qn_perf_area_2[]" value="0" {{ $incAssHelper->getCheckedBox($mpc_perf_area->mpc_perf_area_2, '0')}} ></label>
                                                     </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="checkbox">
                                                          <label class="checkbox-inline"><input type="checkbox" name ="mpc_qn_perf_area_2[]" value="1" {{ $incAssHelper->getCheckedBox($mpc_perf_area->mpc_perf_area_2, '1')}} ></label>
                                                    </div>
                                                 </td>
                                                 <td class="text-center">
                                                    <div class="checkbox">
                                                          <label class="checkbox-inline"><input type="checkbox" name ="mpc_qn_perf_area_2[]" value="2" {{ $incAssHelper->getCheckedBox($mpc_perf_area->mpc_perf_area_2, '2')}} ></label>
                                                    </div>
                                                 </td>
                                                 <td class="text-center">
                                                    <div class="checkbox">
                                                          <label class="checkbox-inline"><input type="checkbox" name ="mpc_qn_perf_area_2[]" value="3" {{ $incAssHelper->getCheckedBox($mpc_perf_area->mpc_perf_area_2, '3')}} ></label>
                                                    </div>
                                                 </td>
                                                 <td class="text-center">
                                                    <div class="checkbox">
                                                          <label class="checkbox-inline"><input type="checkbox" name ="mpc_qn_perf_area_2[]" value="4" {{ $incAssHelper->getCheckedBox($mpc_perf_area->mpc_perf_area_2, '4')}} ></label>
                                                    </div>
                                                 </td>
                                                <td class="text-center">
                                                    <div class="checkbox">
                                                          <label class="checkbox-inline"><input type="checkbox" name ="mpc_qn_perf_area_2[]" value="5" {{ $incAssHelper->getCheckedBox($mpc_perf_area->mpc_perf_area_2, '5')}} ></label>
                                                    </div>
                                                 </td>
                                            </tr>
                                             <tr>
                                                <td class="text-center">
                                                   Dressing
                                                </td>
                                                 <td class="text-center">
                                                    <div class="checkbox">
                                                          <label class="checkbox-inline"><input type="checkbox" name ="mpc_qn_perf_area_3[]" value="0" {{ $incAssHelper->getCheckedBox($mpc_perf_area->mpc_perf_area_3, '0')}} ></label>
                                                    </div>
                                                 </td>
                                                <td class="text-center">
                                                    <div class="checkbox">
                                                          <label class="checkbox-inline"><input type="checkbox" name ="mpc_qn_perf_area_3[]" value="1" {{ $incAssHelper->getCheckedBox($mpc_perf_area->mpc_perf_area_3, '1')}} ></label>
                                                     </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="checkbox">
                                                          <label class="checkbox-inline"><input type="checkbox" name ="mpc_qn_perf_area_3[]" value="2" {{ $incAssHelper->getCheckedBox($mpc_perf_area->mpc_perf_area_3, '2')}} ></label>
                                                    </div>
                                                 </td>
                                                 <td class="text-center">
                                                    <div class="checkbox">
                                                          <label class="checkbox-inline"><input type="checkbox" name ="mpc_qn_perf_area_3[]" value="3" {{ $incAssHelper->getCheckedBox($mpc_perf_area->mpc_perf_area_3, '3')}} ></label>
                                                    </div>
                                                 </td>
                                                 <td class="text-center">
                                                    <div class="checkbox">
                                                          <label class="checkbox-inline"><input type="checkbox" name ="mpc_qn_perf_area_3[]" value="4" {{ $incAssHelper->getCheckedBox($mpc_perf_area->mpc_perf_area_3, '4')}} ></label>
                                                    </div>
                                                 </td>
                                                 <td class="text-center">
                                                    <div class="checkbox">
                                                          <label class="checkbox-inline"><input type="checkbox" name ="mpc_qn_perf_area_3[]" value="5" {{ $incAssHelper->getCheckedBox($mpc_perf_area->mpc_perf_area_3, '5')}}></label>
                                                    </div>
                                                 </td>
                                             </tr>
                                           <tr>
                                            <td class="text-center">
                                                   Bathing
                                                </td>
                                                <td class="text-center">
                                                    <div class="checkbox">
                                                          <label class="checkbox-inline"><input type="checkbox" name ="mpc_qn_perf_area_4[]" value="0" {{ $incAssHelper->getCheckedBox($mpc_perf_area->mpc_perf_area_4, '0')}} ></label>
                                                     </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="checkbox">
                                                          <label class="checkbox-inline"><input type="checkbox" name ="mpc_qn_perf_area_4[]" value="1" {{ $incAssHelper->getCheckedBox($mpc_perf_area->mpc_perf_area_4, '1')}} ></label>
                                                    </div>
                                                 </td>
                                                 <td class="text-center">
                                                    <div class="checkbox">
                                                          <label class="checkbox-inline"><input type="checkbox" name ="mpc_qn_perf_area_4[]" value="2" {{ $incAssHelper->getCheckedBox($mpc_perf_area->mpc_perf_area_4, '2')}} ></label>
                                                    </div>
                                                 </td>
                                                 <td class="text-center">
                                                    <div class="checkbox">
                                                          <label class="checkbox-inline"><input type="checkbox" name ="mpc_qn_perf_area_4[]" value="3" {{ $incAssHelper->getCheckedBox($mpc_perf_area->mpc_perf_area_4, '3')}} ></label>
                                                    </div>
                                                 </td>
                                                 <td class="text-center">
                                                    <div class="checkbox">
                                                          <label class="checkbox-inline"><input type="checkbox" name ="mpc_qn_perf_area_4[]" value="4" {{ $incAssHelper->getCheckedBox($mpc_perf_area->mpc_perf_area_4, '4')}} ></label>
                                                    </div>
                                                 </td>
                                                <td class="text-center">
                                                    <div class="checkbox">
                                                          <label class="checkbox-inline"><input type="checkbox" name ="mpc_qn_perf_area_4[]" value="5" {{ $incAssHelper->getCheckedBox($mpc_perf_area->mpc_perf_area_4, '5')}} ></label>
                                                    </div>
                                                 </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">
                                                   Toileting
                                                </td>
                                                <td class="text-center">
                                                    <div class="checkbox">
                                                          <label class="checkbox-inline"><input type="checkbox" name ="mpc_qn_perf_area_5[]" value="0" {{ $incAssHelper->getCheckedBox($mpc_perf_area->mpc_perf_area_5, '0')}} ></label>
                                                     </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="checkbox">
                                                          <label class="checkbox-inline"><input type="checkbox" name ="mpc_qn_perf_area_5[]" value="1" {{ $incAssHelper->getCheckedBox($mpc_perf_area->mpc_perf_area_5, '1')}} ></label>
                                                    </div>
                                                 </td>
                                                 <td class="text-center">
                                                    <div class="checkbox">
                                                          <label class="checkbox-inline"><input type="checkbox" name ="mpc_qn_perf_area_5[]" value="2" {{ $incAssHelper->getCheckedBox($mpc_perf_area->mpc_perf_area_5, '2')}} ></label>
                                                    </div>
                                                 </td>
                                                 <td class="text-center">
                                                    <div class="checkbox">
                                                          <label class="checkbox-inline"><input type="checkbox" name ="mpc_qn_perf_area_5[]" value="3" {{ $incAssHelper->getCheckedBox($mpc_perf_area->mpc_perf_area_5, '3')}} ></label>
                                                    </div>
                                                 </td>
                                                 <td class="text-center">
                                                    <div class="checkbox">
                                                          <label class="checkbox-inline"><input type="checkbox" name ="mpc_qn_perf_area_5[]" value="4" {{ $incAssHelper->getCheckedBox($mpc_perf_area->mpc_perf_area_5, '4')}}></label>
                                                    </div>
                                                 </td>
                                                <td class="text-center">
                                                    <div class="checkbox">
                                                          <label class="checkbox-inline"><input type="checkbox" name ="mpc_qn_perf_area_5[]" value="5" {{ $incAssHelper->getCheckedBox($mpc_perf_area->mpc_perf_area_5, '5')}} ></label>
                                                    </div>
                                                 </td>
                                            </tr>
                                            <tr>

                                                <td class="text-center">
                                                  Grooming <br>(brushing teeth, applying<br> oil and combing hair)
                                                </td>
                                                <td class="text-center">
                                                    <div class="checkbox">
                                                          <label class="checkbox-inline"><input type="checkbox" name ="mpc_qn_perf_area_6[]" value="0" {{ $incAssHelper->getCheckedBox($mpc_perf_area->mpc_perf_area_6, '0')}} ></label>
                                                    </div>
                                                 </td>
                                                <td class="text-center">
                                                    <div class="checkbox">
                                                          <label class="checkbox-inline"><input type="checkbox" name ="mpc_qn_perf_area_6[]" value="1" {{ $incAssHelper->getCheckedBox($mpc_perf_area->mpc_perf_area_6, '1')}} ></label>
                                                     </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="checkbox">
                                                          <label class="checkbox-inline"><input type="checkbox" name ="mpc_qn_perf_area_6[]" value="2" {{ $incAssHelper->getCheckedBox($mpc_perf_area->mpc_perf_area_6, '2')}} ></label>
                                                    </div>
                                                 </td>
                                                 <td class="text-center">
                                                    <div class="checkbox">
                                                          <label class="checkbox-inline"><input type="checkbox" name ="mpc_qn_perf_area_6[]" value="3" {{ $incAssHelper->getCheckedBox($mpc_perf_area->mpc_perf_area_6, '3')}} ></label>
                                                    </div>
                                                 </td>
                                                 <td class="text-center">
                                                    <div class="checkbox">
                                                          <label class="checkbox-inline"><input type="checkbox" name ="mpc_qn_perf_area_6[]" value="4" {{ $incAssHelper->getCheckedBox($mpc_perf_area->mpc_perf_area_6, '4')}} ></label>
                                                    </div>
                                                 </td>
                                                 <td class="text-center">
                                                    <div class="checkbox">
                                                          <label class="checkbox-inline"><input type="checkbox" name ="mpc_qn_perf_area_6[]" value="5" {{ $incAssHelper->getCheckedBox($mpc_perf_area->mpc_perf_area_6, '5')}} ></label>
                                                    </div>
                                                 </td>
                                             </tr>

                                        </tbody>
                                 </table>
						</div>
				   </div>
             </div>
          </div>
       </div>
     </div>

     <hr>
     <div class="form-group">
       <div class="row">
         <div class="col-md-12">
             <div class="form-group">
                  <div class="row">
                      <div class="col-md-4 col-md-pull-0">
                            <div class="form-group">
                                 <p>Physical : </p>
                            </div>
                      </div>
                      <div class="col-md-8 col-md-pull-1">
                            <div class="form-group">
                               <input type="text" class="form-control" name ="mpc_context_1" value="{{$incAssHelper->getTextFieldValue($mpc_context->mpc_context_1)}}">
                            </div>
                      </div>
                </div>
                <div class="row">
                      <div class="col-md-4 col-md-pull-0">
                            <div class="form-group">
                                 <p>Social : </p>
                            </div>
                      </div>
                      <div class="col-md-8 col-md-pull-1">
                            <div class="form-group">
                               <input type="text" class="form-control" name ="mpc_context_2" value="{{$incAssHelper->getTextFieldValue($mpc_context->mpc_context_2)}}">
                            </div>
                      </div>
                </div>
             </div>

             <div class="form-group">
                 <p>Cultural (Attitude, beliefs, Norms, traditionals)</p>
                 <textarea rows="2" class="form-control" name="mpc_context_3_remark" id="mpc_context_3_remark" placeholder="Other">{{$incAssHelper->getTextFieldValue($mpc_context->mpc_context_3_remark)}}</textarea>
             </div>
               <div class="form-group">
                     <label>CHILD'S BEHAVIOR</label>
            </div>
             <div class="form-group">
                  <div class="row">
                      <div class="col-md-6 col-md-pull-0">
                            <div class="checkbox">
                                 <p>Does the child show interest in his environment? : </p>
                            </div>
                      </div>
                      <div class="col-md-4 col-md-pull-1">
                            <div class="checkbox">
                                <label class="radio-inline"><input type="radio" name ="mpc_context_4" value="Yes" {{ $incAssHelper->isChecked($mpc_context->mpc_context_4, 'Yes')}} >Yes</label>
                                <label class="radio-inline"><input type="radio" name ="mpc_context_4" value="No" {{ $incAssHelper->isChecked($mpc_context->mpc_context_4, 'No')}} >No</label>
                           </div>
                      </div>
                </div>
             </div>
             <div class="form-group">
                <div class="row">
                      <div class="col-md-1">
                            <div class="checkbox">
                                <p>Mood : </p>
                            </div>
                      </div>
                      <div class="col-md-11">
                            <div class="checkbox">
                              <label class="checkbox-inline"><input type="checkbox" name ="mpc_context_5[]" value="Passive" {{ $incAssHelper->getCheckedBox($mpc_context->mpc_context_5, 'Passive')}} >Passive</label>
                              <label class="checkbox-inline"><input type="checkbox" name ="mpc_context_5[]" value="Active" {{ $incAssHelper->getCheckedBox($mpc_context->mpc_context_5, 'Active')}} >Active</label>
                              <label class="checkbox-inline"><input type="checkbox" name ="mpc_context_5[]" value="Happy" {{ $incAssHelper->getCheckedBox($mpc_context->mpc_context_5, 'Happy')}} >Happy</label>
                              <label class="checkbox-inline"><input type="checkbox" name ="mpc_context_5[]" value="Scared" {{ $incAssHelper->getCheckedBox($mpc_context->mpc_context_5, 'Scared')}} >Scared</label>
                              <label class="checkbox-inline"><input type="checkbox" name ="mpc_context_5[]" value="Irritable" {{ $incAssHelper->getCheckedBox($mpc_context->mpc_context_5, 'Irritable')}} >Irritable</label>
                              <label class="checkbox-inline"><input type="checkbox" name ="mpc_context_5[]" value="Crying" {{ $incAssHelper->getCheckedBox($mpc_context->mpc_context_5, 'Crying')}} >Crying</label>
                              <label class="checkbox-inline"><input type="checkbox" name ="mpc_context_5[]" value="Holds on to mother" {{ $incAssHelper->getCheckedBox($mpc_context->mpc_context_3, 'Holds on to mother')}} >Holds on to mother</label>
                            </div>
                      </div>
                    </div>
             </div>
            <div class="form-group">
                 <textarea rows="2" class="form-control" name="mpc_context_5_remark" id="mpc_context_5_remark" placeholder="Comment">{{$incAssHelper->getTextFieldValue($mpc_context->mpc_context_5_remark)}}</textarea>
            </div>
             <hr>
            <div class="form-group">
                  <div class="row">
                      <div class="col-md-4 col-md-pull-0">
                            <div class="checkbox">
                                 <p>Mother/Child relation </p>
                            </div>
                      </div>
                      <div class="col-md-8 col-md-pull-1">
                            <div class="checkbox">
                                <label class="radio-inline"><input type="radio" name ="mpc_context_6" value="Over protective" {{ $incAssHelper->isChecked($mpc_context->mpc_context_6, 'Over protective')}} >Over protective</label>
                                <label class="radio-inline"><input type="radio" name ="mpc_context_6" value="Neglect" {{ $incAssHelper->isChecked($mpc_context->mpc_context_6, 'Neglect')}} >Neglect</label>
                                <label class="radio-inline"><input type="radio" name ="mpc_context_6" value="Normal" {{ $incAssHelper->isChecked($mpc_context->mpc_context_6, 'Normal')}} >Normal</label>
                           </div>
                      </div>
                </div>
             </div>
             <div class="form-group">
                <textarea rows="2" class="form-control" name="mpc_context_6_remark" id="mpc_context_6_remark" placeholder="Comment">{{$incAssHelper->getTextFieldValue($mpc_context->mpc_context_6_remark)}}</textarea>
             </div>
             <div class="form-group">
                    <label>PARENTS' ATTITUDE :</label>
             </div>
             <div class="form-group">
                <div class="row">
                      <div class="col-md-4">
                            <div class="radio">
                                <p>Realistic understanding of the situation </p>
                            </div>
                      </div>
                      <div class="col-md-8">
                            <div class="radio">
                              <label class="radio-inline"><input type="radio" name ="mpc_context_7" value="Yes" {{ $incAssHelper->isChecked($mpc_context->mpc_context_7, 'Yes')}} >Yes</label>
                              <label class="radio-inline"><input type="radio" name ="mpc_context_7" value="No" {{ $incAssHelper->isChecked($mpc_context->mpc_context_7, 'No')}} >No</label>
                            </div>
                      </div>
                </div>
                <div class="row">
                      <div class="col-md-4">
                            <div class="radio">
                                <p>Realistic expectation: </p>
                            </div>
                      </div>
                      <div class="col-md-8">
                            <div class="radio">
                              <label class="radio-inline"><input type="radio" name ="mpc_context_8" value="Yes" {{ $incAssHelper->isChecked($mpc_context->mpc_context_8, 'Yes')}} >Yes</label>
                              <label class="radio-inline"><input type="radio" name ="mpc_context_8" value="No" {{ $incAssHelper->isChecked($mpc_context->mpc_context_8, 'No')}} >No</label>
                            </div>
                      </div>
                </div>
                <div class="row">
                      <div class="col-md-4">
                            <div class="radio">
                                <p>Cooperation/facilitator: </p>
                            </div>
                      </div>
                      <div class="col-md-8">
                            <div class="radio">
                              <label class="radio-inline"><input type="radio" name ="mpc_context_9" value="Yes" {{ $incAssHelper->isChecked($mpc_context->mpc_context_9, 'Yes')}} >Yes</label>
                              <label class="radio-inline"><input type="radio" name ="mpc_context_9" value="No" {{ $incAssHelper->isChecked($mpc_context->mpc_context_9, 'No')}} >No</label>
                            </div>
                      </div>
                 </div>
             </div>
             <div class="form-group">
                <textarea rows="2" class="form-control" name="mpc_context_9_remark" id="mpc_context_9_remark" placeholder="Comment">{{$incAssHelper->getTextFieldValue($mpc_context->mpc_context_9_remark)}}</textarea>
             </div>
             <div class="form-group">
                    <label>ACCESSIBILITIES TO FACILITIES:</label>
             </div>
             <div class="form-group">
                <div class="row">
                      <div class="col-md-4">
                            <div class="radio">
                                <p>Distance house / drinking water sources </p>
                            </div>
                      </div>
                      <div class="col-md-8">
                            <div class="radio">
                              <label class="radio-inline"><input type="radio" name ="mpc_context_10" value="-10m" {{ $incAssHelper->isChecked($mpc_context->mpc_context_10, '-10m')}} >-10m</label>
                              <label class="radio-inline"><input type="radio" name ="mpc_context_10" value="-50m" {{ $incAssHelper->isChecked($mpc_context->mpc_context_10, '-50m')}} >-50m</label>
                              <label class="radio-inline"><input type="radio" name ="mpc_context_10" value="+de 50m-500m" {{ $incAssHelper->isChecked($mpc_context->mpc_context_10, '+de 50m-500m')}} >+de 50m-500m</label>
                            </div>
                      </div>
                </div>
                <div class="row">
                      <div class="col-md-4">
                            <div class="radio">
                                <p>Distance house / school</p>
                            </div>
                      </div>
                      <div class="col-md-8">
                            <div class="radio">
                              <label class="radio-inline"><input type="radio" name ="mpc_context_11" value="-500m" {{ $incAssHelper->isChecked($mpc_context->mpc_context_11, '-500')}} >-500m</label>
                              <label class="radio-inline"><input type="radio" name ="mpc_context_11" value="-3km" {{ $incAssHelper->isChecked($mpc_context->mpc_context_11, '-3km')}} >-3km</label>
                              <label class="radio-inline"><input type="radio" name ="mpc_context_11" value="+de 3km" {{ $incAssHelper->isChecked($mpc_context->mpc_context_11, '+de 3km')}} >+de 3km</label>
                             </div>
                      </div>
                </div>
                <div class="row">
                      <div class="col-md-4">
                            <div class="radio">
                                <p>Distance house / location market</p>
                            </div>
                      </div>
                      <div class="col-md-8">
                            <div class="radio">
                              <label class="radio-inline"><input type="radio" name ="mpc_context_12" value="-500m" {{ $incAssHelper->isChecked($mpc_context->mpc_context_12, '-500m')}} >-500m</label>
                              <label class="radio-inline"><input type="radio" name ="mpc_context_12" value="-3km" {{ $incAssHelper->isChecked($mpc_context->mpc_context_12, '-3km')}} >-3km</label>
                              <label class="radio-inline"><input type="radio" name ="mpc_context_12" value="+de 3km" {{ $incAssHelper->isChecked($mpc_context->mpc_context_12, '+de 3km')}} >+de 3km</label>
                            </div>
                      </div>
                 </div>
                 <div class="row">
                      <div class="col-md-4">
                            <div class="radio">
                                <p>Distance house / transportation means</p>
                            </div>
                      </div>
                      <div class="col-md-8">
                            <div class="radio">
                              <label class="radio-inline"><input type="radio" name ="mpc_context_13" value="-500m" {{ $incAssHelper->isChecked($mpc_context->mpc_context_13, '-500m')}} >-500m</label>
                              <label class="radio-inline"><input type="radio" name ="mpc_context_13" value="-3km" {{ $incAssHelper->isChecked($mpc_context->mpc_context_13, '-3km')}} >-3km</label>
                              <label class="radio-inline"><input type="radio" name ="mpc_context_13" value="+de 3km" {{ $incAssHelper->isChecked($mpc_context->mpc_context_13, '+de 3km')}} >+de 3km</label>
                            </div>
                      </div>
                 </div>
                 <div class="row">
                      <div class="col-md-4">
                            <div class="radio">
                                <p>Distance house / health center</p>
                            </div>
                      </div>
                      <div class="col-md-8">
                            <div class="radio">
                              <label class="radio-inline"><input type="radio" name ="mpc_context_14" value="-500m" {{ $incAssHelper->isChecked($mpc_context->mpc_context_14, '-500m')}} >-500m</label>
                              <label class="radio-inline"><input type="radio" name ="mpc_context_14" value="-3km" {{ $incAssHelper->isChecked($mpc_context->mpc_context_14, '-3km')}} >-3km</label>
                              <label class="radio-inline"><input type="radio" name ="mpc_context_14" value="+de 3km" {{ $incAssHelper->isChecked($mpc_context->mpc_context_14, '+de 3km')}} >+de 3km</label>
                            </div>
                      </div>
                 </div>
             </div>
             <div class="form-group">
                    <label>HOUSE AND AROUND THE HOUSE CONDITION:</label>
             </div>
             <div class="form-group">
                 <labe>Living environment: (Describe the environment in relation to the condition of the client)</labe>
                <textarea rows="2" class="form-control" name="mpc_context_15_remark" id="mpc_context_15_remark" placeholder="Comment">{{$incAssHelper->getTextFieldValue($mpc_context->mpc_context_15_remark)}}</textarea>
             </div>
             <div class="form-group">
                <div class="row">
                      <div class="col-md-4">
                            <div class="radio">
                                <p>Describe the land around the house</p>
                            </div>
                      </div>
                      <div class="col-md-8">
                            <div class="radio">
                              <label class="radio-inline"><input type="radio" name ="mpc_context_16" value="Flooding area" {{ $incAssHelper->isChecked($mpc_context->mpc_context_16, 'Flooding area')}} >Flooding area</label>
                              <label class="radio-inline"><input type="radio" name ="mpc_context_16" value="Sand" {{ $incAssHelper->isChecked($mpc_context->mpc_context_16, 'Sand')}} >Sand</label>
                              <label class="radio-inline"><input type="radio" name ="mpc_context_16" value="Rocky field" {{ $incAssHelper->isChecked($mpc_context->mpc_context_16, 'Rocky field')}} >Rocky field</label>
                              <label class="radio-inline"><input type="radio" name ="mpc_context_16" value="Normal land" {{ $incAssHelper->isChecked($mpc_context->mpc_context_16, 'Normal land')}} >Normal land</label>
                              <label class="radio-inline"><input type="radio" name ="mpc_context_16" value="Grassy" {{ $incAssHelper->isChecked($mpc_context->mpc_context_16, 'Grassy')}} >Grassy</label>
                            </div>
                      </div>
                 </div>
             </div>
             <div class="form-group">
                <textarea rows="2" class="form-control" name="mpc_context_16_remark" id="mpc_context_16_remark" placeholder="Remarks">{{$incAssHelper->getTextFieldValue($mpc_part_a_posture->mpc_qn_a_25_remark)}}</textarea>
             </div>
              <div class="form-group">
                    <label>SWOT ANALYSIS</label>
             </div>
             <div class="form-group">
					 <div class="row">
						<div class="col-md-12 col-md-pull-0">
                        <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-left" width="50px">
                                                   Attribute
                                                </th>
                                                <th class="text-center" >
                                                   Description
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-left" width="50px" >
                                                    Strength
                                                </td>
                                                <td class="text-center">
                                                     <div class="form-group">
                                                        <textarea rows="2" class="form-control" name="mpc_qn_swot_1_remark" id="mpc_qn_swot_1_remark" placeholder="Remarks">{{$incAssHelper->getTextFieldValue($mpc_swot->mpc_swot_1_remark)}}</textarea>
                                                     </div>
                                                </td>
                                            </tr>
                                           <tr>
                                                <td class="text-left" width="50px">
                                                   Weakness 
                                                </td>
                                                <td class="text-center">
                                                     <div class="form-group">
                                                        <textarea rows="2" class="form-control" name="mpc_qn_swot_2_remark" id="mpc_qn_swot_2_remark" placeholder="Remarks">{{$incAssHelper->getTextFieldValue($mpc_swot->mpc_swot_2_remark)}}</textarea>
                                                     </div>
                                                </td>
                                            </tr>
                                           <tr>
                                                <td class="text-left" width="50px">
                                                   Opportunities
                                                </td>
                                                <td class="text-center">
                                                     <div class="form-group">
                                                        <textarea rows="2" class="form-control" name="mpc_qn_swot_3_remark" id="mpc_qn_swot_3_remark" placeholder="Remarks">{{$incAssHelper->getTextFieldValue($mpc_swot->mpc_swot_3_remark)}}</textarea>
                                                     </div>
                                                </td>
                                            </tr>
                                           <tr>
                                                <td class="text-left" width="50px">
                                                   Threats
                                                </td>
                                                <td class="text-center">
                                                     <div class="form-group">
                                                        <textarea rows="2" class="form-control" name="mpc_qn_swot_4_remark" id="mpc_qn_swot_4_remark" placeholder="Remarks">{{$incAssHelper->getTextFieldValue($mpc_swot->mpc_swot_4_remark)}}</textarea>
                                                     </div>
                                                </td>
                                            </tr>
                                       </tbody>
                                 </table>
						</div>
				   </div>
             </div>
             <div class="form-group">
                 <p>Main concerns of client</p>
                 <textarea rows="2" class="form-control" name="mpc_qn_swot_5_remark" id="mpc_qn_swot_5_remark" placeholder="Describe">{{$incAssHelper->getTextFieldValue($mpc_swot->mpc_swot_5_remark)}}</textarea>
             </div>
             <div class="form-group">
                 <p>Parents main concerns</p>
                 <textarea rows="2" class="form-control" name="mpc_qn_swot_6_remark" id="mpc_qn_swot_6_remark" placeholder="Describe">{{$incAssHelper->getTextFieldValue($mpc_swot->mpc_swot_6_remark)}}</textarea>
             </div>
             <div class="form-group">
                 <p>Prioritization of the functional problems:</p>
                 <textarea rows="2" class="form-control" name="mpc_qn_swot_7_remark" id="mpc_qn_swot_7_remark" placeholder="Describe">{{$incAssHelper->getTextFieldValue($mpc_swot->mpc_swot_7_remark)}}</textarea>
             </div>
             <div class="form-group">
                    <label>Short Term Rehabilitation/Protection Plan (3-4Months)</label>
             </div>
             <div class="form-group">
					 <div class="row">
						<div class="col-md-12 col-md-pull-0">
                              <table class="table table-bordered table-hover">
                                <tbody>
                                     <tr>
                                        <th class="text-center" width="30px" rowspan="7">
                                           1
                                        </th>
                                        <th class="text-left" width="80px">
                                          Functional problem
                                        </th>
                                        <td class="text-center">
                                           <div class="form-group">
                                                <textarea rows="2" class="form-control" name="mpc_qn_short_rehab_1_remark" id="mpc_qn_short_rehab_1_remark" placeholder="">{{$incAssHelper->getTextFieldValue($mpc_short_rehab->mpc_short_rehab_1_remark)}}</textarea>
                                            </div>
                                        </td>
                                     </tr>
                                     <tr>
                                        <th class="text-left" width="80px" >
                                           Aim
                                        </th>
                                        <td class="text-center">
                                           <div class="form-group">
                                                <textarea rows="2" class="form-control" name="mpc_qn_short_rehab_2_remark" id="mpc_qn_short_rehab_2_remark" placeholder="">{{$incAssHelper->getTextFieldValue($mpc_short_rehab->mpc_short_rehab_2_remark)}}</textarea>
                                            </div>
                                        </td>
                                      </tr>
                                      <tr>
                                         <th class="text-left" width="80px" >
                                           Objectives
                                        </th>
                                        <td class="text-center">
                                           <div class="form-group">
                                                <textarea rows="2" class="form-control" name="mpc_qn_short_rehab_3_remark" id="mpc_qn_short_rehab_3_remark" placeholder="">{{$incAssHelper->getTextFieldValue($mpc_short_rehab->mpc_short_rehab_3_remark)}}</textarea>
                                            </div>
                                        </td>
                                      </tr>
                                      <tr>
                                        <th class="text-left" width="80px" >
                                           Intervention
                                        </th>
                                        <td class="text-center">
                                           <div class="form-group">
                                                <textarea rows="2" class="form-control" name="mpc_qn_short_rehab_4_remark" id="mpc_qn_short_rehab_4_remark" placeholder="">{{$incAssHelper->getTextFieldValue($mpc_short_rehab->mpc_short_rehab_4_remark)}}</textarea>
                                            </div>
                                        </td>
                                      </tr>
                                      <tr>
                                         <th class="text-left" width="80px" >
                                           Rationale
                                         </th>
                                         <td class="text-center">
                                           <div class="form-group">
                                                <textarea rows="2" class="form-control" name="mpc_qn_short_rehab_5_remark" id="mpc_qn_short_rehab_5_remark" placeholder="">{{$incAssHelper->getTextFieldValue($mpc_short_rehab->mpc_short_rehab_5_remark)}}</textarea>
                                            </div>
                                        </td>
                                      </tr>
                                      <tr>
                                        <th class="text-left" width="80px" >
                                          BY who
                                        </th>
                                        <td class="text-center" >
                                           <div class="form-group">
                                                <textarea rows="2" class="form-control" name="mpc_qn_short_rehab_6_remark" id="mpc_qn_short_rehab_6_remark" placeholder="">{{$incAssHelper->getTextFieldValue($mpc_short_rehab->mpc_short_rehab_6_remark)}}</textarea>
                                            </div>
                                        </td>
                                      </tr>
                                      <tr>
                                        <th class="text-left" width="80px" >
                                         Duration
                                        </th>
                                        <td class="text-center">
                                           <div class="form-group">
                                                <textarea rows="2" class="form-control" name="mpc_qn_short_rehab_7_remark" id="mpc_qn_short_rehab_7_remark" placeholder="">{{$incAssHelper->getTextFieldValue($mpc_short_rehab->mpc_short_rehab_7_remark)}}</textarea>
                                            </div>
                                        </td>
                                    </tr>

                                  </tbody>
                            </table>
						</div>
				   </div>
             </div>
             <div class="form-group">
                    <label>Long Term Rehabilitation/Protection Plan (3-4Months)</label>
             </div>
             <div class="form-group">
					 <div class="row">
						<div class="col-md-12 col-md-pull-0">
                              <table class="table table-bordered table-hover">
                                <tbody>
                                     <tr>
                                        <th class="text-center" width="30px" rowspan="7">
                                           1
                                        </th>
                                        <th class="text-left" width="80px">
                                          Functional problem
                                        </th>
                                        <td class="text-center">
                                           <div class="form-group">
                                                <textarea rows="2" class="form-control" name="mpc_qn_long_rehab_1_remark" id="mpc_qn_long_rehab_1_remark" placeholder="">{{$incAssHelper->getTextFieldValue($mpc_long_rehab->mpc_long_rehab_1_remark)}}</textarea>
                                            </div>
                                        </td>
                                     </tr>
                                     <tr>
                                        <th class="text-left" width="80px" >
                                           Aim
                                        </th>
                                        <td class="text-center">
                                           <div class="form-group">
                                                <textarea rows="2" class="form-control" name="mpc_qn_long_rehab_2_remark" id="mpc_qn_long_rehab_2_remark" placeholder="">{{$incAssHelper->getTextFieldValue($mpc_long_rehab->mpc_long_rehab_2_remark)}}</textarea>
                                            </div>
                                        </td>
                                      </tr>
                                      <tr>
                                         <th class="text-left" width="80px" >
                                           Objectives
                                        </th>
                                        <td class="text-center">
                                           <div class="form-group">
                                                <textarea rows="2" class="form-control" name="mpc_qn_long_rehab_3_remark" id="mpc_qn_long_rehab_3_remark" placeholder="">{{$incAssHelper->getTextFieldValue($mpc_long_rehab->mpc_long_rehab_3_remark)}}</textarea>
                                            </div>
                                        </td>
                                      </tr>
                                      <tr>
                                        <th class="text-left" width="80px" >
                                           Intervention
                                        </th>
                                        <td class="text-center">
                                           <div class="form-group">
                                                <textarea rows="2" class="form-control" name="mpc_qn_long_rehab_4_remark" id="mpc_qn_long_rehab_4_remark" placeholder="">{{$incAssHelper->getTextFieldValue($mpc_long_rehab->mpc_long_rehab_4_remark)}}</textarea>
                                            </div>
                                        </td>
                                      </tr>
                                      <tr>
                                         <th class="text-left" width="80px" >
                                           Rationale
                                         </th>
                                         <td class="text-center">
                                           <div class="form-group">
                                                <textarea rows="2" class="form-control" name="mpc_qn_long_rehab_5_remark" id="mpc_qn_long_rehab_5_remark" placeholder="">{{$incAssHelper->getTextFieldValue($mpc_long_rehab->mpc_long_rehab_5_remark)}}</textarea>
                                            </div>
                                        </td>
                                      </tr>
                                      <tr>
                                        <th class="text-left" width="80px" >
                                          BY who
                                        </th>
                                        <td class="text-center" >
                                           <div class="form-group">
                                                <textarea rows="2" class="form-control" name="mpc_qn_long_rehab_6_remark" id="mpc_qn_long_rehab_6_remark" placeholder="Remarks">{{$incAssHelper->getTextFieldValue($mpc_long_rehab->mpc_long_rehab_6_remark)}}</textarea>
                                            </div>
                                        </td>
                                      </tr>
                                      <tr>
                                        <th class="text-left" width="80px" >
                                         Duration
                                        </th>
                                        <td class="text-center">
                                           <div class="form-group">
                                                <textarea rows="2" class="form-control" name="mpc_qn_long_rehab_7_remark" id="mpc_qn_long_rehab_7_remark" placeholder="Remarks">{{$incAssHelper->getTextFieldValue($mpc_long_rehab->mpc_long_rehab_7_remark)}}</textarea>
                                            </div>
                                        </td>
                                    </tr>

                                  </tbody>
                            </table>
						</div>
				   </div>
             </div>
             <div class="form-group">
                 <label>FRAME OF REFFERENCE (Biomechanical frame of reference, Neurodevelopmental approach, Bobath approach,etc) </label>
                <textarea rows="2" class="form-control" name="mpc_qn_long_rehab_8_remark" id="mpc_qn_long_rehab_8_remark" placeholder="Describe">{{$incAssHelper->getTextFieldValue($mpc_long_rehab->mpc_long_rehab_8_remark)}}</textarea>
             </div>
             <div class="form-group">
                 <label>Model </label>
                <textarea rows="2" class="form-control" name="mpc_qn_long_rehab_9_remark" id="mpc_qn_long_rehab_9_remark" placeholder="Describe">{{$incAssHelper->getTextFieldValue($mpc_long_rehab->mpc_long_rehab_9_remark)}}</textarea>
             </div>
             <div class="form-group">
                 <div class="row">
                      <div class="col-md-6 col-md-offset-3 inform_assessor">
                            {{ csrf_field() }}
                      </div>
                 </div>
            </div>
             <div class="form-group">
                   <button type="submit" class="btn">Submit</button> <span class="load_hidden-spinner"></span>
            </div>
          </div>
       </div>
         </form>
</div>
