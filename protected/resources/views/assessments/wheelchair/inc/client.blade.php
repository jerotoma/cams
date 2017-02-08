<div class="row setup-content" id="step-1">
        <div class="col-xs-12">
            <div class="col-md-12 well text-center">
                <h1>Select client to assess</h1>
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
											<?php $count = 1; ?>
										@if(!empty($clients ))
											@foreach($clients as $key => $client)

												<tr id='addr0'>
													<td class="text-center">
														{{$count + $key }}
													</td>
													<td class="text-center">
														{{$client->client_number}}
													</td>
													<td class="text-center">
														{{$client->full_name}}
													</td>
													<td class="text-center">
														{{$client->sex}}
													</td>
												   <td class="text-center">
													   {{$client->origin}}
													</td>
													<td class="text-center">
													   {{$client->date_arrival}}
													</td>
													<td class="text-center">
														<label><input type="checkbox" name="client_id" value="{{$client->id}}"></label>
													</td>
												</tr>
											       											
												@endforeach
											@endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                            <!-- <a id="add_row" class="btn btn-success pull-left">Add Row</a><a id='delete_row' class="btn btn-danger pull-right">Delete Row</a> -->
                   <div class="form-group">
                    <button id="activate-step-2" class="btn btn-primary btn-md">Continue to Assessment Interview</button>
                  </div>
              
              </div>
        </div>
    </div>
                                              