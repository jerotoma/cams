
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
    <div class="row setup-content" id="step-1">
        <div class="col-xs-12">
            <div class="col-md-12 well text-center">
                <h1> STEP 1</h1>
                
                        <form>                
                        <div class="form-group">
                            <div class="row clearfix">
                                <div class="col-md-12 column">
                                    <a id="add_row" class="btn btn-success pull-left">Add Row</a><a id='delete_row' class="btn btn-danger pull-right">Delete Row</a>
                                    <br /><br /><br />

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
                                                    Nationality
                                                </th>
                                                <th class="text-center">
                                                   Date of Arrival
                                                </th>
                                                <th class="text-center">
                                                    Check client
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr id='addr0'>
                                                <td class="text-center">
                                                    1
                                                </td>
                                                <td class="text-center">
                                                    HP67T
                                                </td>
                                                <td class="text-center">
                                                    Otoman Nkomanya
                                                </td>
                                                <td class="text-center">
                                                    Male
                                                </td>
                                               <td class="text-center">
                                                   Tanzanian
                                                </td>
                                                <td class="text-center">
                                                   January 2nd, 2017
                                                </td>
                                                <td class="text-center">
                                                    <label><input type="radio" name="optradio"></label>
                                                </td>
                                            </tr>
                                            <tr id='addr1'></tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                            <!-- <a id="add_row" class="btn btn-success pull-left">Add Row</a><a id='delete_row' class="btn btn-danger pull-right">Delete Row</a> -->
                   <div class="form-group">
                    <button id="activate-step-2" class="btn btn-primary btn-md">Activate Step 2</button>
                  </div>
               </form>
              </div>
        </div>
    </div>
    <div class="row setup-content" id="step-2">
        <div class="col-xs-12">
            <div class="col-md-12 well">
                <h1 class="text-center"> Physical</h1>
                <form class="well" action="upload.php" method="post" enctype="multipart/form-data">
                <div class="form-group"> 
                    <div class="row">
                          <div class="col-md-3">
                             <h3 class="text-left">Diagnosis : </h3>
                           </div> 
                           <div class="col-md-9">
                               <div class="row">
                                   <div class="col-md-4 col-md-pull-1">
                                      
                                       <div class="checkbox">
                                           <label class="checkbox text-left"><input type="checkbox" value="">Brain Injury</label>
                                           <label class="checkbox text-left"><input type="checkbox" value="">Cerebral Palsy </label>
                                           <label class="checkbox text-left"><input type="checkbox" value="">Muscular Dystrophy</label> 
                                       </div>
                                   </div>
                                   <div class="col-md-4 col-md-pull-2">
                                      <div class="checkbox">
                                           <label class="checkbox text-left "><input type="checkbox" value="">Polio</label>
                                           <label class="checkbox text-left"><input type="checkbox" value="">Spina Bifida</label>
                                           <label class="checkbox text-left"><input type="checkbox" value="">Spinal Cord Injury </label> 
                                       </div>
                                   </div> 
                                   <div class="col-md-4 col-md-pull-3">
                                       <div class="checkbox">
                                           <label class="checkbox text-left "><input type="checkbox" value="">Stroke</label>
                                           <label class="checkbox text-left"><input type="checkbox" value="">Unknown</label>
                                           <label class="checkbox text-left"><input type="checkbox" value="">Other</label> 
                                       </div>
                                   </div>
                               </div>
                               <div class="row">
                                 <div class="col-md-6 col-md-pull-1">
                                     <div class="checkbox">
                                          <p>Is the condition likely to become worse?</p>
                                     </div>  
                                   </div>
                                <div class="col-md-6 col-md-pull-3">
                                    <div class="checkbox">
                                      <label class="radio-inline"><input type="radio" name ="d" value="">Yes</label>
                                      <label class="radio-inline"><input type="radio" name ="d" value="">No</label>
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
                                           <label class="checkbox-inline text-left move-left"><input type="checkbox" value="">Frail</label>
                                           <label class="checkbox-inline text-left move-left"><input type="checkbox" value="">Spasms/uncontrolled movements</label>
                                           <label class="checkbox-inline text-left move-left"><input type="checkbox" value="">Muscle tone (high/low)</label> 
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
                                       <label class="checkbox"><input type="checkbox" value="">R above knee</label> 
                                       <label class="checkbox"><input type="checkbox" value="">R below knee</label>
                                       <label class="checkbox"><input type="checkbox" value="">L above knee</label>
                                    </div>
                                   </div>
                                   <div class="col-md-4 col-md-pull-1">
                                     <div class="checkbox">
                                       <label class="checkbox"><input type="checkbox" value="">L above knee</label>
                                       <label class="checkbox"><input type="checkbox" value="">Fatigue</label> 
                                       <label class="checkbox"><input type="checkbox" value="">Hip dislocation</label>
                                     </div>
                                   </div>
                                   <div class="col-md-4 col-md-pull-2">
                                       <div class="checkbox">
                                       <label class="checkbox"><input type="checkbox" value="">Epilepsy</label>
                                       </div>
                                   </div>
                               </div>
                               <div class="row">
                                 <div class="col-md-6 col-md-pull-1">
                                     <div class="checkbox">
                                          <p>Problems with eating, drinking and swallowing</p>
                                     </div>  
                                 </div>
                                 <div class="col-md-6 col-md-pull-2">
                                    <div class="checkbox">
                                      <label class="checkbox-inline"><input type="checkbox" name ="d" value=""></label>
                                    </div>
                                    <div clas="form-group"> 
                                        <label for="describe1">Describe</label>
                                        <input type="text" class="form-control" id="describe1" placeholder="Describe" name ="d" value="">                                    
                                    </div>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-md-6 col-md-pull-1">
                                    <div class="checkbox">
                                      <label class="checkbox-inline"><input type="checkbox" name ="d" value="">Pain</label>
                                    </div>
                                    <div clas="form-group"> 
                                        <label for="describe1">Describe location</label>
                                        <input type="text" class="form-control" id="describe1" placeholder="Describe" name ="d" value="">                                    
                                    </div>
                                 </div>
                              </div> 
                              <div class="row">
                                 <div class="col-md-6 col-md-pull-1">
                                    <div class="checkbox">
                                      <label class="checkbox-inline"><input type="checkbox" name ="d" value="">Bladder problems</label>
                                      <label class="checkbox-inline"><input type="checkbox" name ="d" value="">Bowel problems</label>
                                     </div>
                                </div>
                              </div>
                               <div class="row">
                                 <div class="col-md-8 col-md-pull-1">
                                     <div class="checkbox">
                                          <p>If the wheelchair user has bladder or bowel problems, is this managed?</p>
                                     </div>  
                                   </div>
                                <div class="col-md-4 col-md-pull-2">
                                    <div class="checkbox">
                                      <label class="radio-inline"><input type="radio" name ="d" value="">Yes</label>
                                      <label class="radio-inline"><input type="radio" name ="d" value="">No</label>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                          <div class="col-md-3 ">
                             <h3 class="text-left">Lifestyle and environment : </h3>
                           </div>
                           <div class="col-md-9">
                               <div class="row">
                                   <div class="col-md-12 col-md-pull-1">
                                       <div clas="form-group"> 
                                        <label for="describe1">Describe where the wheelchair user will use their wheelchair:</label>
                                        <input type="text" class="form-control" id="describe1" placeholder="Describe" name ="d" value="">                                    
                                    </div>
                                   </div>
                               </div>
                               <div class="row">
                                 <div class="col-md-4 col-md-pull-1">
                                     <div class="radio">
                                          <p>Distance travelled per day</p>
                                     </div>  
                                   </div>
                                <div class="col-md-8 col-md-pull-1">
                                    <div class="radio">
                                      <label class="radio-inline"><input type="radio" name ="d" value="">Up to 1km</label>
                                      <label class="radio-inline"><input type="radio" name ="d" value="">1-5km</label>
                                      <label class="radio-inline"><input type="radio" name ="d" value="">More than 5km</label>
                                    </div>
                                </div>
                               </div> 
                               <div class="row">
                                 <div class="col-md-4 col-md-pull-1">
                                     <div class="radio">
                                          <p>Hours per day using wheelchair</p>
                                     </div>  
                                   </div>
                                <div class="col-md-8 col-md-pull-1">
                                    <div class="radio">
                                      <label class="radio-inline"><input type="radio" name ="d" value="">Less than 1 </label>
                                      <label class="radio-inline"><input type="radio" name ="d" value="">1-3</label>
                                      <label class="radio-inline"><input type="radio" name ="d" value="">3-5</label>
                                      <label class="radio-inline"><input type="radio" name ="d" value="">5-8</label>
                                      <label class="radio-inline"><input type="radio" name ="d" value="">more than 8</label>
                                    </div>
                                </div>
                               </div>
                               <div class="row">
                                   <div class="col-md-12 col-md-pull-1">
                                       <div clas="form-group"> 
                                        <label for="describe1">When out of the wheelchair, where does the wheelchair user sit or lie down and how (posture and surface)?</label>
                                        <input type="text" class="form-control" id="describe1" placeholder="Describe" name ="d" value="">                                    
                                    </div>
                                   </div>
                               </div>
                               <div class="row">
                                 <div class="col-md-2 col-md-pull-1">
                                     <div class="radio">
                                          <p>Transfer : </p>
                                     </div>  
                                   </div>
                                <div class="col-md-10 col-md-pull-1">
                                    <div class="radio">
                                      <label class="radio-inline"><input type="radio" name ="d" value="">Independent</label>
                                      <label class="radio-inline"><input type="radio" name ="d" value="">Assisted</label>
                                      <label class="radio-inline"><input type="radio" name ="d" value="">Standing</label>
                                      <label class="radio-inline"><input type="radio" name ="d" value="">Non-standing </label>
                                      <label class="radio-inline"><input type="radio" name ="d" value="">Lifted</label>
                                      <label class="radio-inline"><input type="radio" name ="d" value="">Other</label>
                                    </div>
                                </div>
                               </div>
                               <div class="row">
                                 <div class="col-md-4 col-md-pull-1">
                                     <div class="radio">
                                          <p>Type of toilet (if transferring to a toilet)</p>
                                     </div>  
                                   </div>
                                <div class="col-md-8 col-md-pull-1">
                                    <div class="radio">
                                      <label class="radio-inline"><input type="radio" name ="d" value="">Squat</label>
                                      <label class="radio-inline"><input type="radio" name ="d" value="">Western </label>
                                      <label class="radio-inline"><input type="radio" name ="d" value="">Adapted</label>
                                    </div>
                                </div>
                               </div>
                               <div class="row">
                                 <div class="col-md-4 col-md-pull-1">
                                     <div class="radio">
                                          <p>Does the wheelchair user often use public/private transport</p>
                                     </div>  
                                   </div>
                                <div class="col-md-8 col-md-pull-1">
                                    <div class="radio">
                                      <label class="radio-inline"><input type="radio" name ="d" value="">Yes</label>
                                      <label class="radio-inline"><input type="radio" name ="d" value="">No</label>
                                    </div>
                                </div>
                               </div>
                               <div class="row">
                                 <div class="col-md-4 col-md-pull-1">
                                     <div class="radio">
                                          <p>If yes, then what kind:</p>
                                     </div>  
                                   </div>
                                <div class="col-md-8 col-md-pull-1">
                                    <div class="radio">
                                      <label class="radio-inline"><input type="radio" name ="d" value="">Car</label>
                                      <label class="radio-inline"><input type="radio" name ="d" value="">Tax</label>
                                      <label class="radio-inline"><input type="radio" name ="d" value="">Bus</label>
                                    </div>
                                    <div clas="form-group"> 
                                        <label for="describe1">Other</label>
                                        <input type="text" class="form-control" id="describe1" placeholder="Describe" name ="d" value="">                                    
                                    </div>
                                </div>
                               </div>
                               
                          </div>
                    </div>
                    <hr>
                    <div class="row">
                          <div class="col-md-3 ">
                             <h4 class="text-left">Existing wheelchair : </h4>
                              <p class="text-cnter">(if a person already <br/> has a wheelchair) </p>
                           </div>
                           <div class="col-md-9">
                              <div class="row">
                                  <div class="col-md-4 col-md-pull-1">
                                     <div class="radio">
                                          <p>Does the wheelchair meet the user’s needs?</p>
                                     </div>  
                                   </div>
                                    <div class="col-md-8 col-md-pull-1">
                                        <div class="radio">
                                          <label class="radio-inline"><input type="radio" name ="d" value="">Yes</label>
                                          <label class="radio-inline"><input type="radio" name ="d" value="">No</label>
                                        </div>
                                    </div>
                               </div>
                            <div class="row">
                                  <div class="col-md-4 col-md-pull-1">
                                     <div class="radio">
                                          <p>Does the wheelchair meet the user’s environmental conditions?	</p>
                                     </div>  
                                   </div>
                                    <div class="col-md-8 col-md-pull-1">
                                        <div class="radio">
                                          <label class="radio-inline"><input type="radio" name ="d" value="">Yes</label>
                                          <label class="radio-inline"><input type="radio" name ="d" value="">No</label>
                                        </div>
                                    </div>
                               </div>
                            <div class="row">
                                  <div class="col-md-4 col-md-pull-1">
                                     <div class="radio">
                                          <p>Does the wheelchair provide proper fit and postural support? </p>
                                     </div>  
                                   </div>
                                    <div class="col-md-8 col-md-pull-1">
                                        <div class="radio">
                                          <label class="radio-inline"><input type="radio" name ="d" value="">Yes</label>
                                          <label class="radio-inline"><input type="radio" name ="d" value="">No</label>
                                        </div>
                                    </div>
                               </div>
                            <div class="row">
                                  <div class="col-md-4 col-md-pull-1">
                                     <div class="radio">
                                          <p>Is the wheelchair safe and durable?	(Consider whether there is a cushion)</p>
                                     </div>  
                                   </div>
                                    <div class="col-md-8 col-md-pull-1">
                                        <div class="radio">
                                          <label class="radio-inline"><input type="radio" name ="d" value="">Yes</label>
                                          <label class="radio-inline"><input type="radio" name ="d" value="">No</label>
                                        </div>
                                    </div>
                               </div>
                            <div class="row">
                                  <div class="col-md-4 col-md-pull-1">
                                     <div class="radio">
                                          <p>Does the cushion provide proper pressure relief (if user has pressure sore risk)? </p>
                                     </div>  
                                   </div>
                                    <div class="col-md-8 col-md-pull-1">
                                        <div class="radio">
                                          <label class="radio-inline"><input type="radio" name ="d" value="">Yes</label>
                                          <label class="radio-inline"><input type="radio" name ="d" value="">No</label>
                                        </div>
                                    </div>
                               </div>
                              <div class="row">
                                   <div class="col-md-12 col-md-pull-1">
                                       <div clas="form-group"> 
                                        <label for="describe1">Comments:</label>
                                        <input type="text" class="form-control" id="describe1" placeholder="Describe" name ="d" value="">                                    
                                    </div>
                                   </div>
                             </div>
                               <div class="row">
                                   <div class="col-md-12 col-md-pull-1">
                                       <div clas="form-group"> 
                                         <p>If yes to all questions, the user may not need a new wheelchair. If no to any of these questions, the user needs a different wheelchair or cushion; or the existing wheelchair or cushion needs repairs or modifications. </p>
                                                                       
                                    </div>
                                   </div>
                             </div>
                          </div>
                    </div>
                    <hr>
                    
                </div>
                <div class="form-group"> 
                 <button id="activate-step-3" class="btn btn-primary btn-md">Activate Step 3</button>
               </div>
             </form>
            </div>
        </div>
    </div>
    <div class="row setup-content" id="step-3">
        <div class="col-xs-12">
            <div class="col-md-12 well">
                <h1 class="text-center"> STEP 3</h1>
                 <form class="well" action="upload.php" method="post" enctype="multipart/form-data">
                <div class="form-group"> 
                    <div class="row">
                          <div class="col-md-3">
                             <h3 class="text-left">Presence, risk of or history of pressure sores : </h3>
                           </div> 
                           <div class="col-md-9">
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
                                                      <label class="radio-inline"><input type="radio" name ="d" value="">Yes</label>
                                                      <label class="radio-inline"><input type="radio" name ="d" value="">No</label>
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
                                                      <label class="radio-inline"><input type="radio" name ="d" value="">Yes</label>
                                                      <label class="radio-inline"><input type="radio" name ="d" value="">No</label>
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
                                                      <label class="radio-inline"><input type="radio" name ="d" value="">Yes</label>
                                                      <label class="radio-inline"><input type="radio" name ="d" value="">No</label>
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
                                                      <label class="radio-inline"><input type="radio" name ="d" value="">Yes</label>
                                                      <label class="radio-inline"><input type="radio" name ="d" value="">No</label>
                                                    </div>
                                              </div>
                                        </div>
                                        <div class="row">
                                           <div class="col-md-12 col-md-pull-0">
                                               <div clas="form-group"> 
                                                <label for="describe1">Duration and cause:</label>
                                                <input type="text" class="form-control" id="describe1" placeholder="Describe" name ="d" value="">                                    
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
                                      <label class="radio-inline"><input type="radio" name ="d" value="">Yes</label>
                                      <label class="radio-inline"><input type="radio" name ="d" value="">No</label>
                                    </div>
                                </div>
                            </div> 
                          </div>
                        </div>
                      <hr/>
                        <div class="row">
                              <div class="col-md-3">
                                 <h3 class="text-left">Method of pushing </h3>
                               </div> 
                               <div class="col-md-9">
                                   <div class="row">
                                       <div class="col-md-12">
                                         <p>How will the wheelchair user push their wheelchair</p> 
                                       </div>
                                    </div> 
                                   <div class="row">
                                          <div class="col-md-3">
                                             <div class="radio">
                                                  <div class="radio">
                                                  <label class="radio"><input type="radio" name ="d" value="">Both arms</label>
                                                  <label class="radio"><input type="radio" name ="d" value="">Left arm</label>
                                                 </div>
                                             </div>  
                                           </div>
                                          <div class="col-md-3 col-md-pull-0">
                                             <div class="radio">
                                                  <label class="radio"><input type="radio" name ="d" value="">Right arm</label>
                                                  <label class="radio"><input type="radio" name ="d" value="">Both legs</label>
                                              </div>
                                          </div>
                                         <div class="col-md-3 col-md-pull-0">
                                                <div class="radio">
                                                  <label class="radio"><input type="radio" name ="d" value="">Left leg</label>
                                                  <label class="radio"><input type="radio" name ="d" value="">Right leg</label>
                                                </div>
                                        </div>
                                       <div class="col-md-3 col-md-pull-0">
                                                <div class="radio">
                                                  <label class="radio"><input type="radio" name ="d" value="">Pushed bt helper</label>
                                                </div>
                                        </div>
                                    </div>
                                   <div class="row">
                                       <div class="col-md-12">
                                         <div clas="form-group"> 
                                                <label for="describe1">Comment:</label>
                                                <input type="text" class="form-control" id="describe1" placeholder="Describe" name ="d" value="">                                    
                                            </div>
                                       </div>
                                    </div>
                                </div>
                             </div>
                        </div>
                    </div>
                    <div class="form-group">
                         <button id="activate-step-4" class="btn btn-primary btn-md">Activate Step 4</button>
                    </div>
                    </form>
                
                 </div>
        </div>
    </div>
    
    <div class="row setup-content" id="step-4">
        <div class="col-xs-12">
            <div class="col-md-12 well text-center">
                <h1 class="text-center"> STEP 4</h1>
                
                 <form></form>
                
            </div>
        </div>
    </div>
