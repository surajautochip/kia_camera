<div class="p-3">
	<div class="other-info-wrapper">
    	<h5 class="mb-3 mt-2 font-weight-semi-bold">Other Info:</h5>

    	<div class="row">
    	<!-- Address Details -->
	        <div class="col-md-6">

	        	<div>
	        		<div class="input-group mb-3">
	        			<span class="input-label">Email Address</span>
		                <div class="input-group-prepend border-new">
		                    <div class="input-group-text"><i class="zmdi zmdi-email zmdi-hc-lg"></i></div>
		                </div>
		                <input type="text" id="email" name="email" class="form-control  rounded-0" placeholder="Email Address" value="<?php echo set_value('email'); ?>">
		                <?php if (form_error('email')):?>
		                    <div class="input-group error-field mb-0"></div>
		                <?php endif; ?>
		            </div>
	        	</div>
	        	<div>
	        		<div class="input-group mb-3">
	        			<span class="input-label">Address <span class="req">*</span></span>
		                <div class="input-group-prepend border-new">
		                    <div class="input-group-text"><i class="zmdi zmdi-pin zmdi-hc-lg"></i></div>
		                </div>
		                <input type="text" id="street1" name="street1" class="form-control  rounded-0 capital" placeholder="Address*" required value="<?php echo set_value('street1'); ?>">
		                <?php if (form_error('street1')):?>
		                    <div class="input-group error-field mb-0"></div>
		                <?php endif; ?>
		            </div>
	        	</div>
	        	<div>
	        		<div class="edu-ocol-left">
	        			<div class="input-group mb-3">
	        				<span class="input-label">City <span class="req">*</span></span>
			                <div class="input-group-prepend border-new">
			                    <div class="input-group-text"><i class="zmdi zmdi-pin-drop zmdi-hc-lg"></i></div>
			                </div>
			                <input type="text" id="street2" name="street2" class="form-control capital rounded-0" required placeholder="City*" value="<?php echo set_value('street2'); ?>">
			                <?php if (form_error('street2')):?>
			                    <div class="input-group error-field mb-0"></div>
			                <?php endif; ?>
			            </div>
	        		</div>
	        		<div class="edu-ocol-right">
	        			<div class="input-group mb-3">
	        				<span class="input-label">State <span class="req">*</span></span>
			                <select name="state_id" id="state_id" class="form-control custom-select  rounded-0" required value="<?php echo set_value('state_id'); ?>">
			                    <option selected="selected" value="" > State* </option>
			                    <option value="Delhi" <?php echo set_select('state_id', 'Delhi');?>> Delhi </option>
			                    <option value="Haryana" <?php echo set_select('state_id', 'Haryana');?>> Haryana </option>
			                    <option value="Punjab" <?php echo set_select('state_id', 'Punjab');?>> Punjab </option>
			                    <option value="Rajasthan" <?php echo set_select('state_id', 'Rajasthan');?>> Rajasthan </option>
			                </select>
			                <?php if (form_error('state_id')):?>
			                    <div class="input-group error-field mb-0"></div>
			                <?php endif; ?>
		            	</div>
	        		</div>
	        	</div>
	        	<div>
	        		<div class="edu-ocol-left">
	        			<div class="input-group mb-3">
	        				<span class="input-label">Pincode <span class="req">*</span></span>
			            	<div class="input-group-prepend border-new">
			                    <div class="input-group-text"><i class="zmdi zmdi-gps-dot zmdi-hc-lg"></i></div>
			                </div>
			                <input type="text" id="zipcode" name="zipcode" class="form-control rounded-0" maxlength="6" required placeholder="Pincode*" value="<?php echo set_value('zipcode'); ?>">
			                <?php if (form_error('zipcode')):?>
			                    <div class="input-group error-field mb-0"></div>
			                <?php endif; ?>
		            	</div>
	        		</div>
	        		<div class="edu-ocol-right">
	        			<div class="input-group mb-3 check-inter-state" style="border: 1px solid #CBD3D9;height:73%;">
		            		<label style="margin-top: 8px;"><span class="radio-span"></span>
		                	<input type="checkbox" id="is_interstate" name="is_interstate" class="form-control icheck" value="1" <?php echo set_checkbox('is_interstate', "1"); ?>>
		            		<span class="radio-span-inner"> Is an Inter State Transfer?</span></label>

		            	</div>
	        		</div>	        		
	        	</div>
	        	<div>
	        		<div class="edu-ocol-left">
	        			<div class="input-group mb-3">
	        				<span class="input-label">Dist. From Home (in KM) <span class="req">*</span></span>
				    		<div class="input-group-prepend border-new">
			                    <div class="input-group-text"><i class="zmdi zmdi-turning-sign zmdi-hc-lg"></i></div>
			                </div>
			                <input type="text" id="distance" name="distance" class="form-control rounded-0" required placeholder="Dist. From Home* (in KM)" maxlength="2" value="<?php echo set_value('distance'); ?>">
			                <?php if (form_error('distance')):?>
			                    <div class="input-group error-field mb-0"></div>
			                <?php endif; ?>	
			            </div>
	        		</div>
	        		<div class="edu-ocol-right">
	        			<div class="input-group mb-3">
	        				<span class="input-label">Transport <span class="req">*</span></span>
							<select id="transport" name="transport" class="form-control custom-select rounded-0" required value="<?php echo set_value('transport'); ?>">
								<option selected="selected" value=""> Select Transport* </option>
								<option value="Brought By Attendant" <?php echo set_select('transport', 'Brought By Attendant');?>> Brought By Attendant </option>
								<option value="Rickshaw" <?php echo set_select('transport', 'Rickshaw');?>> Rickshaw </option>
								<option value="Bus" <?php echo set_select('transport', 'Bus');?>> Bus </option>
								<option value="By Foot" <?php echo set_select('transport', 'By Foot');?>> By Foot </option>
								<option value="Any Other Means" <?php echo set_select('transport', 'Any Other Means');?>> Any Other Means </option>
							</select>
			                <?php if (form_error('transport')):?>
			                    <div class="input-group error-field mb-0"></div>
			                <?php endif; ?>
			            </div>
	        		</div>
	        	</div>

	        </div>
	    <!-- Guardian Details -->
	        <div class="col-md-6">

	        	<div>
	        		<div class="input-group mb-3">
	        			<span class="input-label">Name of Guardian</span>
		                <div class="input-group-prepend border-new">
		                    <div class="input-group-text"><i class="zmdi zmdi-account-circle zmdi-hc-lg"></i></div>
		                </div>
		                <input type="text" id="local_guardian" name="local_guardian" class="form-control capital rounded-0" placeholder="Guardian Name" value="<?php echo set_value('local_guardian'); ?>">
		                <?php if (form_error('local_guardian')):?>
		                    <div class="input-group error-field mb-0"></div>
		                <?php endif; ?>
		            </div>
	        	</div>
	        	<div>
	        		<div class="edu-ocol-left">
	        			<div class="input-group mb-3">
	        				<span class="input-label">Relation</span>
	        				<div class="input-group-prepend border-new">
			                    <div class="input-group-text"><i class="zmdi zmdi-accounts-alt zmdi-hc-lg"></i></div>
			                </div>
			                <input type="text" id="local_relation" name="local_relation" class="form-control capital rounded-0" placeholder="Relation" value="<?php echo set_value('local_relation'); ?>">
			                <?php if (form_error('local_relation')):?>
			                    <div class="input-group error-field mb-0"></div>
			                <?php endif; ?>
	        			</div>
	        		</div>
	        		<div class="edu-ocol-right">
	        			<div class="input-group mb-3">
	        				<span class="input-label">Contact No.</span>
	        				<div class="input-group-prepend border-new">
			                    <div class="input-group-text"><i class="zmdi zmdi-phone zmdi-hc-lg"></i></div>
			                </div>
			                <input type="text" id="local_phone" name="local_phone" class="form-control rounded-0" placeholder="Phone" value="<?php echo set_value('local_phone'); ?>">
			                <?php if (form_error('local_phone')):?>
			                    <div class="input-group error-field mb-0"></div>
			                <?php endif; ?>
	        			</div>
	        		</div>	        		
	        	</div>
	        	<div>
	        		<div class="edu-ocol-left">
	        			<div class="input-group mb-3">
	        				<span class="input-label">Address</span>
			            	<div class="input-group-prepend border-new">
			                    <div class="input-group-text"><i class="zmdi zmdi-pin zmdi-hc-lg"></i></div>
			                </div>
			                <input type="text" id="local_street1" name="local_street1" class="form-control capital rounded-0" placeholder="Address" value="<?php echo set_value('local_street1'); ?>">
			                <?php if (form_error('local_street1')):?>
			                    <div class="input-group error-field mb-0"></div>
			                <?php endif; ?>
			            </div>
	        		</div>
	        		<div class="edu-ocol-right">
	        			<div class="input-group mb-3">
	        				<span class="input-label">City</span>
			            	<div class="input-group-prepend border-new">
			                    <div class="input-group-text"><i class="zmdi zmdi-pin-drop zmdi-hc-lg"></i></div>
			                </div>
			                <input type="text" id="local_street2" name="local_street2" class="form-control capital rounded-0" placeholder="City" value="<?php echo set_value('local_street2'); ?>">
			                <?php if (form_error('local_street2')):?>
			                    <div class="input-group error-field mb-0"></div>
			                <?php endif; ?>
		            	</div>
	        		</div>	        		
	        	</div>
	        	<div>
	        		<div class="edu-ocol-left">
	        			<div class="input-group mb-3">
	        				<span class="input-label">Pincode</span>
			            	<div class="input-group-prepend border-new">
			                    <div class="input-group-text"><i class="zmdi zmdi-gps-dot zmdi-hc-lg"></i></div>
			                </div>
			                <input type="text" id="local_zipcode" name="local_zipcode" class="form-control rounded-0" placeholder="Pincode" maxlength="6" value="<?php echo set_value('local_zipcode'); ?>">
			                <?php if (form_error('local_zipcode')):?>
			                    <div class="input-group error-field mb-0"></div>
			                <?php endif; ?>
		            	</div>
	        		</div>
	        		<div class="edu-ocol-right">
	        			<div class="input-group mb-3">
	        				<span class="input-label">State</span>
			                <select name="local_state_id" id="local_state_id" class="form-control custom-select rounded-0" value="<?php echo set_value('local_state_id'); ?>">
			                    <option selected="selected" value="" > State</option>
			                    <option value="Delhi" <?php echo set_select('state_id', 'Delhi');?>> Delhi </option>
			                    <option value="Haryana" <?php echo set_select('state_id', 'Haryana');?>> Haryana </option>
			                    <option value="Punjab" <?php echo set_select('state_id', 'Punjab');?>> Punjab </option>
			                    <option value="Rajasthan" <?php echo set_select('state_id', 'Rajasthan');?>> Rajasthan </option>
			                </select>
			                <?php if (form_error('local_state_id')):?>
			                    <div class="input-group error-field mb-0"></div>
			                <?php endif; ?>
			            </div>
	        		</div>
	        	</div>

	        </div>
	    </div>
	</div>
</div>