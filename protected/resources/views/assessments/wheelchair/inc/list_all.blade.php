<div class="row">
       <div class="col-md-12 well text-center">
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
                                                    Client Name
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
                                                    Assessed by
                                                </th>
												<th class="text-center">
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php if(!empty($table_rows)) : ?>
											
											          <?php echo $table_rows; ?>
											
											<?php else : ?>
														 <tr>
															 <td colspan="8">
																<label> No Wheelchair Assessment has been submitted yet.</label>
															 </td>
														 </tr>
											<?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                </div>
       </div>