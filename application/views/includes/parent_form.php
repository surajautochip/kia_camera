<div class="p-3">
    <h5 class="mb-3 mt-2 font-weight-semi-bold">Parent's Details:</h5>
    <div class="row">
    <!-- Father Details -->
        <div class="col-md-6">

            <div>
                <div class="input-group mb-3">
                    <span class="input-label">Father's Name <span class="req">*</span></span>
                    <div class="input-group-prepend border-new">
                        <div class="input-group-text"><i class="zmdi zmdi-account-circle zmdi-hc-lg"></i></div>
                    </div>
                    <input type="text" id="father" name="father" class="form-control rounded-0 capital" placeholder="Father's Name*" required value="<?php echo set_value('father'); ?>">
                    <?php if (form_error('father')):?>
                        <div class="input-group error-field mb-0"></div>
                    <?php endif; ?>
                </div>
            </div>
            <div>
                <div class="input-group mb-3">
                    <span class="input-label">Father's Occupation <span class="req">*</span></span>
                    <div class="input-group-prepend border-new">
                        <div class="input-group-text"><i class="zmdi zmdi-case-check zmdi-hc-lg"></i></div>
                    </div>
                    <select name="fatheroccupation" id="fatheroccupation" class="form-control rounded-0" required>
                        <option value="">Select Occupation*</option>
                        <option value="Force" <?php echo set_select('fatheroccupation', 'Force');?>>Armed Force/Para Military</option>
                        <option value="Government" <?php echo set_select('fatheroccupation', 'Government');?>>Govt. Service/Judiciary</option>
                        <option value="Private" <?php echo set_select('fatheroccupation', 'Private');?>>Pvt. Service/Agriculture</option>
                    </select>
                </div>
            </div>
            <div>
                <div class="input-group mb-3">
                    <span class="input-label">Father's Annual Income <span class="req">*</span></span>
                    <div class="input-group-prepend border-new">
                        <div class="input-group-text"><i class="zmdi zmdi-money-box zmdi-hc-lg"></i></div>
                    </div>
                    <input type="text" id="father_income" maxlength="9" required name="father_income" class="form-control rounded-0 income" placeholder="Annual Income*" value="<?php echo set_value('father_income'); ?>">
                </div>
            </div>
            <div>
                <div class="input-group mb-3">
                    <span class="input-label">Educational Qualification <span class="req">*</span></span>
                    <div class="input-group-prepend border-new">
                        <div class="input-group-text"><i class="zmdi zmdi-graduation-cap zmdi-hc-lg"></i></div>
                    </div>
                    <input type="text" id="father_qualification" required name="father_qualification" class="form-control rounded-0" placeholder="Educational Qualification*" value="<?php echo set_value('father_qualification'); ?>">
                    <?php if (form_error('father_qualification')):?>
                        <div class="input-group error-field mb-0"></div>
                    <?php endif; ?>
                </div>
            </div>
            <div>
                <div class="input-group mb-3">
                    <span class="input-label">Languages Spoken <span class="req">*</span></span>
                    <div class="ft-lg langbox-list">
                        <select id="father_languages" name="father_languages[]" class="form-control custom-select rounded-0 chosen-select" multiple data-placeholder="Languages Spoken*">
                            <option value="Hindi" <?php echo set_select('father_languages[]', 'Hindi');?>> Hindi </option>
                            <option value="Punjabi" <?php echo set_select('father_languages[]', 'Punjabi');?>> Punjabi </option>
                            <option value="English" <?php echo set_select('father_languages[]', 'English');?>> English </option>
                            <option value="Other" <?php echo set_select('father_languages[]', 'Other');?>> Other </option>
                        </select>
                        <?php if (form_error('father_languages')):?>
                            <div class="input-group error-field mb-0"></div>
                        <?php endif; ?>
                    </div>
                    <div class="hidden ft-lg1 langbox-other">
                        <input type="text" id="ft_other_languages" name="ft_other_languages" class="form-control rounded-0" placeholder="Please Specify" value="<?php echo set_value('ft_other_languages'); ?>">
                    </div>
                </div>
            </div>
            <div>
                <div class="input-group mb-3">
                    <span class="input-label">Awards Won</span>
                    <div class="input-group-prepend border-new">
                        <div class="input-group-text"><i class="zmdi zmdi-star-circle zmdi-hc-lg"></i></div>
                    </div>
                    <select id="ft_awards_won" name="ft_awards_won" class="form-control custom-select rounded-0">
                        <option selected="selected" value=""> Select Awards Won </option>
                        <option value="Gallantry" <?php echo set_select('ft_awards_won', 'Gallantry');?>> Gallantry Award </option>
                        <option value="National" <?php echo set_select('ft_awards_won', 'National');?>> National Sport Award </option>
                        <option value="State" <?php echo set_select('ft_awards_won', 'State');?>> State Sport Award </option>
                    </select>
                </div>
            </div>
            <div>
                <div class="input-group mb-3">
                    <span class="input-label">An Alumni?</span>
                    <div class="edu-col-left">
                        <select id="father_alumni" name="father_alumni" class="form-control custom-select rounded-0" value="<?php echo set_value('father_alumni'); ?>">
                            <option selected="selected" value=""> An Alumni? </option>
                            <option value="Yes" <?php echo set_select('father_alumni', 'Yes');?>> Yes </option>
                            <option value="No" <?php echo set_select('father_alumni', 'No');?>> No </option>
                        </select>
                    </div>
                    <div class="edu-col-right">
                        <input type="text" id="father_alumni_year" name="father_alumni_year" maxlength="4" class="form-control rounded-0" placeholder="Year Passed Out" value="<?php echo set_value('father_alumni_year'); ?>">
                    </div>
                </div>
            </div>
            <div>
                <div class="input-group mb-3">
                    <span class="input-label">Father's Mobile No. <span class="req">*</span></span>
                    <div class="input-group-prepend border-new">
                        <div class="input-group-text"><i class="zmdi zmdi-phone-msg zmdi-hc-lg"></i></div>
                    </div>
                    <input type="text" id="primary" name="primary" required class="form-control rounded-0" maxlength="10" placeholder="Father's mobile number*" value="<?php echo set_value('primary'); ?>">
                    <?php if (form_error('primary')):?>
                        <div class="input-group error-field mb-0"></div>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    <!-- Mother Details -->
        <div class="col-md-6">

            <div>
                <div class="input-group mb-3">
                    <span class="input-label">Mother's Name <span class="req">*</span></span>
                    <div class="input-group-prepend border-new">
                        <div class="input-group-text"><i class="zmdi zmdi-account-circle zmdi-hc-lg"></i></div>
                    </div>
                    <input type="text" id="mother" name="mother" class="form-control rounded-0 capital" placeholder="Mother's Name*" required value="<?php echo set_value('mother'); ?>">
                    <?php if (form_error('mother')):?>
                        <div class="input-group error-field mb-0"></div>
                    <?php endif; ?>
                </div>
            </div>
            <div>
                <div class="input-group mb-3">
                    <span class="input-label">Mother's Occupation</span>
                    <div class="input-group-prepend border-new">
                        <div class="input-group-text"><i class="zmdi zmdi-case-check zmdi-hc-lg"></i></div>
                    </div>
                    <select name="motheroccupation" id="motheroccupation" class="form-control rounded-0 ">
                        <option value="">Select Occupation</option>
                        <option value="Force" <?php echo set_select('motheroccupation', 'Force');?>>Armed Force/Para Military</option>
                        <option value="Government" <?php echo set_select('motheroccupation', 'Government');?>>Govt. Service/Judiciary</option>
                        <option value="Private" <?php echo set_select('motheroccupation', 'Private');?>>Pvt. Service/Agriculture</option>
                    </select>
                </div>
            </div>
            <div>
                <div class="input-group mb-3">
                    <span class="input-label">Mother's Annual Income</span>
                    <div class="input-group-prepend border-new">
                        <div class="input-group-text"><i class="zmdi zmdi-money-box zmdi-hc-lg"></i></div>
                    </div>
                    <input type="text" id="mother_income" maxlength="9" name="mother_income" class="form-control rounded-0 income" placeholder="Annual Income" value="<?php echo set_value('mother_income'); ?>">
                </div>
            </div>
            <div>
                <div class="input-group mb-3">
                    <span class="input-label">Educational Qualification <span class="req">*</span></span>
                    <div class="input-group-prepend border-new">
                        <div class="input-group-text"><i class="zmdi zmdi-graduation-cap zmdi-hc-lg"></i></div>
                    </div>
                    <input type="text" id="mother_qualification" required name="mother_qualification" class="form-control rounded-0" placeholder="Educational Qualification*" value="<?php echo set_value('mother_qualification'); ?>">
                    <?php if (form_error('mother_qualification')):?>
                        <div class="input-group error-field mb-0"></div>
                    <?php endif; ?>
                </div>
            </div>
            <div>
                <div class="input-group mb-3">
                    <span class="input-label">Languages Spoken <span class="req">*</span></span>
                    <div class="mt-lg langbox-list">
                        <select id="mother_languages" name="mother_languages[]" class="form-control custom-select rounded-0 chosen-select" multiple data-placeholder="Languages Spoken*">
                            <option value="Hindi" <?php echo set_select('mother_languages[]', 'Hindi');?>> Hindi </option>
                            <option value="Punjabi" <?php echo set_select('mother_languages[]', 'Punjabi');?>> Punjabi </option>
                            <option value="English" <?php echo set_select('mother_languages[]', 'English');?>> English </option>
                            <option value="Other" <?php echo set_select('mother_languages[]', 'Other');?>> Other </option>
                        </select>
                        <?php if (form_error('mother_languages')):?>
                        <div class="input-group error-field mb-0"></div>
                        <?php endif; ?>
                    </div>
                    <div class="hidden mt-lg1 langbox-other">
                        <input type="text" id="mt_other_languages" name="mt_other_languages" class="form-control rounded-0" placeholder="Please Specify" value="<?php echo set_value('mt_other_languages'); ?>">
                    </div>
                </div>                
            </div>
            <div>
                <div class="input-group mb-3">
                    <span class="input-label">Awards Won</span>
                    <div class="input-group-prepend border-new">
                        <div class="input-group-text"><i class="zmdi zmdi-star-circle zmdi-hc-lg"></i></div>
                    </div>
                    <select id="mt_awards_won" name="mt_awards_won" class="form-control custom-select rounded-0" data-placeholder="">
                        <option selected="selected" value=""> Select Awards Won </option>
                        <option value="Gallantry" <?php echo set_select('ft_awards_won', 'Gallantry');?>> Gallantry Award </option>
                        <option value="National" <?php echo set_select('ft_awards_won', 'National');?>> National Sport Award </option>
                        <option value="State" <?php echo set_select('ft_awards_won', 'State');?>> State Sport Award </option>
                    </select>
                </div>
            </div>
            <div>
                <div class="input-group mb-3">
                    <span class="input-label">An Alumni?</span>
                    <div class="edu-col-left">
                        <select id="mother_alumni" name="mother_alumni" class="form-control custom-select rounded-0" value="<?php echo set_value('mother_alumni'); ?>">
                            <option selected="selected" value=""> An Alumni? </option>
                            <option value="Yes" <?php echo set_select('mother_alumni', 'Yes');?>> Yes </option>
                            <option value="No" <?php echo set_select('mother_alumni', 'No');?>> No </option>
                        </select>
                    </div>
                    <div class="edu-col-right">
                        <input type="text" id="mother_alumni_year" name="mother_alumni_year" class="form-control rounded-0" placeholder="Year Passed Out" maxlength="4" value="<?php echo set_value('mother_alumni_year'); ?>">
                    </div>
                </div>
            </div>
            <div>
                <div class="input-group mb-3">
                    <span class="input-label">Mother's Mobile No.</span>
                    <div class="input-group-prepend border-new">
                        <div class="input-group-text"><i class="zmdi zmdi-phone zmdi-hc-lg"></i></div>
                    </div>
                    <input type="text" maxlength="10" id="secondary" name="secondary" class="form-control rounded-0" placeholder=" Mother's mobile number" value="<?php echo set_value('secondary'); ?>">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="input-group mb-3" style="border:1px solid #CBD3D9;height:90%">
                <span class="radio-span">Receive SMS on </span>
                <input type="radio" class="form-control icheck" name="sms_phone" id="Father" value="Father" checked <?php echo  set_radio('sms_phone', 'Father'); ?>> <span class="radio-span-inner">Father's Mobile</span>  
                <input type="radio" class="form-control icheck" name="sms_phone" id="Mother" value="Mother" <?php echo  set_radio('sms_phone', 'Mother'); ?>> <span class="radio-span-inner">Mother's Mobile</span>
            </div>
        </div>   
        <div class="col-md-4 hidden">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text" style="background-color: none !important;
                    border: 1px solid #CCC !important;">&#x20b9;</i>
                    </div>
                </div>
                <input type="text" id="amount" name="amount" class="form-control rounded-0" placeholder="Application Fee" readonly="1" value="<?php echo set_value('amount'); ?>">
            </div>
        </div>
    </div>
</div>