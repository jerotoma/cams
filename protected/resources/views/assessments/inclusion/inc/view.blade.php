<div class="well">
<div class="form-group">
  <div class="row">
     <div class="col-md-12">
               <div class="form-group" id="client-particulars-info" >
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
</div>

<div class="well">
		<div class="form-top-left">
			<h3 class="text-center section-info"></span>Section <span class="section">3</span> out of <span class="section">7</span> sections </h3>
			<h1 class="text-center section-title ">Case History</h1>
		</div>
		<div class="row">
			<div class="row">
			 <div class="col-md-12 well">
				 <div class="form-group">
						<label for="med_history_info_qn_1">Present Medical History : </label>
					    <textarea rows="5" class="form-control" name="med_history_info_qn_1" id="med_history_info_qn_1"></textarea>
				 </div>
				 <div class="form-group">
						<label for="med_history_info_qn_2">Other services/ therapy received (if the client has already receive or attend any rehabilitation services or any other services concern protection issues) : </label>
					    <textarea rows="5" class="form-control" name="med_history_info_qn_2" id="med_history_info_qn_2"></textarea>
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
                                                          <label class="radio-inline"><input type="radio" name ="med_history_info_qn_3" value="Yes">Yes</label>
                                                          <label class="radio-inline"><input type="radio" name ="med_history_info_qn_3" value="No">No</label>
                                                        </div>
													     <div clas="form-group">
															<input type="text" class="form-control" id="" placeholder="Remark:" name ="med_history_info_qn_3_remark" value="">
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
                                                          <label class="radio-inline"><input type="radio" name ="med_history_info_qn_4" value="Yes">Yes</label>
                                                          <label class="radio-inline"><input type="radio" name ="med_history_info_qn_4" value="No">No</label>
                                                        </div>
													     <div clas="form-group">
															<input type="text" class="form-control" id="" placeholder="Remark:" name ="med_history_info_qn_4_remark" value="">
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
                                                          <label class="radio-inline"><input type="radio" name ="med_history_info_qn_5" value="Yes">Yes</label>
                                                          <label class="radio-inline"><input type="radio" name ="med_history_info_qn_5" value="No">No</label>
                                                        </div>
													     <div clas="form-group">
															<input type="text" class="form-control" id="" placeholder="Remark:" name ="med_history_info_qn_5_remark" value="">
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
                                                          <label class="radio-inline"><input type="radio" name ="med_history_info_qn_6" value="Yes">Yes</label>
                                                          <label class="radio-inline"><input type="radio" name ="med_history_info_qn_6" value="No">No</label>
                                                        </div>
													   <div clas="form-group">
															<input type="text" class="form-control" id="" placeholder="Remark:" name ="med_history_info_qn_6_remark" value="">
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
                                                          <label class="radio-inline"><input type="radio" name ="med_history_info_qn_7" value="Yes">Yes</label>
                                                          <label class="radio-inline"><input type="radio" name ="med_history_info_qn_7" value="No">No</label>
                                                        </div>
													    <div clas="form-group">
															<input type="text" class="form-control" id="" placeholder="Remark:" name ="med_history_info_qn_7_remark" value="">
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
                                                          <label class="radio-inline"><input type="radio" name ="med_history_info_qn_8" value="Yes">Yes</label>
                                                          <label class="radio-inline"><input type="radio" name ="med_history_info_qn_8" value="No">No</label>
                                                        </div>
													    <div clas="form-group">
															<input type="text" class="form-control" id="" placeholder="Remark:" name ="med_history_info_qn_8_remark" value="">
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
                                                          <label class="radio-inline"><input type="radio" name ="med_history_info_qn_9" value="Yes">Yes</label>
                                                          <label class="radio-inline"><input type="radio" name ="med_history_info_qn_9" value="No">No</label>
                                                        </div>
													  	<div clas="form-group">
															<input type="text" class="form-control" id="" placeholder="Remark:" name ="med_history_info_qn_9_remark" value="">
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
                                                          <label class="radio-inline"><input type="radio" name ="med_history_info_qn_10" value="Yes">Yes</label>
                                                          <label class="radio-inline"><input type="radio" name ="med_history_info_qn_10" value="No">No</label>
                                                        </div>
													    <div clas="form-group">
															<input type="text" class="form-control" id="describe1" placeholder="Remark:" name ="med_history_info_qn_10_remark" value="">
														</div>
                                                  </div>
                                        </div>
                                 </div>
                            </div>
				        </div>
				   </div>
				 </div>
				 <div class="form-group text-center">
					<button type="button" class="btn btn-previous">Previous</button>
					<button type="button" class="btn btn-next">Next</button>
				</div>
		      </div>
		</div>
     </div>
