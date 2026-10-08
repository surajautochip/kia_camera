<div class="color-container1 pt-4 px-5 pb-2 text-white" style="height:100%">
    <h4 class="mb-3">Applicant Details:</h4>
    <input type="hidden" name="company_id" id="company_id"  value="<?= $jsondata['school_id']?>">
    <div class="input-group mb-3">
        <span class="input-label">Student Name <span class="req">*</span></span>
        <div class="input-group-prepend">
            <div class="input-group-text"><i class="zmdi zmdi-face zmdi-hc-lg"></i></div>
        </div>
        <input type="text" required id="name" name="name" class="form-control capital border-0" placeholder="Student Name*" value="<?php echo set_value('name'); ?>">
        <?php if (form_error('name')):?>
            <div class="input-group error-field mb-0"></div>
        <?php endif; ?>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="input-group mb-3">
                <span class="input-label">Gender <span class="req">*</span></span>
                <select required name="gender" id="gender" class="form-control custom-select border-0 " value="<?php echo set_value('gender'); ?>">
                   <option selected="selected" value=""> Select Gender* </option>
                   <option value="m" <?php echo set_select('gender', 'm');?>> Male </option>
                   <option value="f" <?php echo set_select('gender', 'f');?>> Female </option>
                   <option value="o" <?php echo set_select('gender', 'o');?>> Other </option>
                </select>
                <?php if (form_error('gender')):?>
                    <div class="input-group error-field mb-0"></div>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="input-group mb-3">
                <span class="input-label">D.O.B <span class="req">*</span></span>
                <input type="text" required id="datepicker" name="datepicker" class="form-control border-0" placeholder="Date of Birth*" value="<?php echo set_value('datepicker',$this->input->post('datepicker'),FALSE); ?>">
                <?php if (form_error('datepicker')):?>
                    <div class="input-group error-field mb-0"></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="input-group mb-3">
                <span class="input-label">Class <span class="req">*</span></span>
                <select name="course_id" required id="course_id" class="form-control custom-select border-0 " value="<?php echo set_value('course_id'); ?>">
                <option selected="selected" value=""> Class*
                </option>                               
                    <?php
                        foreach($json_data['school_details'] as $jsonval) {
                                foreach($jsonval['class'] as $jsonvals) {?>
                                    <option value="<?= $jsonvals['class_id'] ?>" <?php echo set_select('course_id', $jsonvals['class_id']);?>> <?= $jsonvals['class_name'] ?> </option>
                                <?php  }?>
                    <?php }?>
                </select>
                <?php if (form_error('course_id')):?>
                    <div class="input-group error-field mb-0"></div>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="input-group mb-3">
                <span class="input-label">Blood Group</span>
                <select name="bloodgroup" id="bloodgroup" class="form-control custom-select border-0">
                   <option value="" <?php echo set_select('bloodgroup', '');?>>Blood Group </option>
                   <option value="A+" <?php echo set_select('bloodgroup', 'A+');?>> A+ve </option>
                   <option value="B+" <?php echo set_select('bloodgroup', 'B+');?>> B+ve </option>
                   <option value="O+" <?php echo set_select('bloodgroup', 'O+');?>> O+ve </option>
                   <option value="AB+" <?php echo set_select('bloodgroup', 'AB+');?>> AB+ve </option>
                   <option value="A-" <?php echo set_select('bloodgroup', 'A-');?>> A-ve </option>
                   <option value="B-" <?php echo set_select('bloodgroup', 'B-');?>> B-ve </option>
                   <option value="O-" <?php echo set_select('bloodgroup', 'O-');?>> O-ve </option>
                   <option value="AB-" <?php echo set_select('bloodgroup', 'AB-');?>> AB-ve </option>
                </select>
                <?php if (form_error('bloodgroup')):?>
                    <div class="input-group error-field mb-0"></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
           <div class="input-group mb-3">
                <span class="input-label">Religion <span class="req">*</span></span>
                <select name="religion_id" required id="religion_id" class="form-control custom-select border-0 " value="<?php echo set_value('religion_id'); ?>">
                    <option value=""> Select Religion* </option>       
                    <?php
                        foreach($json_data['religion'] as $jsonval) { ?>                  
                            <option value="<?= $jsonval['religion_id'] ?>" <?php echo set_select('religion_id',$jsonval['religion_id']);?>> <?= $jsonval['religion_name'] ?> </option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="input-group mb-3">
                <span class="input-label">Caste <span class="req">*</span></span>
                <select id="caste_id" name="caste_id" required class="form-control custom-select border-0 " value="<?php echo set_value('caste_id'); ?>">
                   <option selected="selected" value=""> Select Caste* </option>
                   <option value="General" <?php echo set_select('caste_id', 'General');?>> General </option>
                   <option value="SC" <?php echo set_select('caste_id', 'SC');?>> SC </option>
                   <option value="ST" <?php echo set_select('caste_id', 'ST');?>> ST </option>
                   <option value="OBC" <?php echo set_select('caste_id', 'OBC');?>> OBC </option>
                </select>
                <?php if (form_error('caste_id')):?>
                    <div class="input-group error-field mb-0"></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="row">
        
        <div class="col-md-6">
            <div class="input-group  mb-3">
                <span class="input-label">Nationality <span class="req">*</span></span>
                <select name="country_id" id="country_id" class="form-control custom-select rounded-0" required value="<?php echo set_value('country_id'); ?>">
                    <option disabled="disabled" value=""> Nationality* </option>
                    <option value="India" selected="selected"> India </option>
                </select>                
            </div>
        </div>
        <div class="col-md-6">
            <div class="input-group  mb-3">
                <span class="input-label">Aadhar Number</span>
              <input type="text" id="aadhar_number" name="aadhar_number" class="form-control  border-0" placeholder="Aadhar Number" value="<?php echo set_value('aadhar_number'); ?>">
              <?php if (form_error('aadhar_number')):?>
                  <div class="input-group error-field mb-0"></div>
              <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="input-group  mb-3">
                <span class="input-label">Last School Studied</span>
                <input type="text" id="last_studied_school" name="last_studied_school" class="form-control capital border-0"  placeholder="Last School Studied" value="<?php echo set_value('aadhar_number'); ?>">
                <?php if (form_error('last_studied_school')):?>
                <div class="input-group error-field mb-0"></div>
                <?php endif; ?>
            </div>
            
        </div>
        <div class="col-md-6">
            <div class="input-group  mb-3">
              <span class="input-label">Injections Taken</span>
              <select id="injections" name="injections[]" class="form-control custom-select border-0 chosen-select" data-placeholder="Injections Taken" multiple>
                   <option value="Polio" <?php echo set_select('injections[]', 'Polio');?>> Polio </option>
                   <option value="Typhoid" <?php echo set_select('injections[]', 'Typhoid');?>> Typhoid </option>
                   <option value="Tetanus" <?php echo set_select('injections[]', 'Tetanus');?>> Tetanus </option>
                   <option value="T.B" <?php echo set_select('injections[]', 'T.B');?>> T.B </option>
                </select>
                <?php if (form_error('injections')):?>
                    <div class="input-group error-field mb-0"></div>
                <?php endif; ?>
            </div>
            
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6">
            <div>
                <div class="input-group mb-3">
                    <span class="input-label">Sibling 1: Name</span>
                    <input type="text" data-toggle="tooltip" data-placement="top" title="Details of Sibling studying in the school" id="sibling1" name="sibling1" class="form-control border-0 capital" placeholder="Sibling 1" value="<?php echo set_value('sibling1'); ?>">
                </div>
            </div>
            <div>
                <div class="input-group mb-3">
                    <span class="input-label">Class</span>
                    <input type="text" id="sibling1_class" data-toggle="tooltip" data-placement="top" title="Sibling1 Class" name="sibling1_class" class="form-control border-0 capital" placeholder="Class" value="<?php echo set_value('sibling1_class'); ?>">
                </div>
                <div class="input-group mb-3">
                    <span class="input-label">Section</span>
                    <input type="text" id="sibling1_section" name="sibling1_section" class="form-control border-0 capital" data-toggle="tooltip" data-placement="top" title="Sibling1 Section" placeholder="Section" value="<?php echo set_value('sibling1_section'); ?>">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div>
                <div class="input-group mb-3">
                    <span class="input-label">Sibling 2: Name</span>
                    <input type="text" id="sibling2" data-toggle="tooltip" data-placement="top" title="Details of Sibling studying in the school" name="sibling2" class="form-control border-0 capital" placeholder="Sibling 2" value="<?php echo set_value('sibling2'); ?>">
                </div>
            </div>
            <div>
                <div class="input-group mb-3">
                    <span class="input-label">Class</span>
                    <input type="text" id="sibling2_class" data-toggle="tooltip" data-placement="top" title="Sibling2 Class" name="sibling2_class" class="form-control border-0 capital" placeholder="Class" value="<?php echo set_value('sibling2_class'); ?>">
                </div>
            </div>
            <div>
                <div class="input-group mb-3">
                    <span class="input-label">Section</span>
                    <input type="text" id="sibling2_section" data-toggle="tooltip" data-placement="top" title="Sibling2 Section" name="sibling2_section" class="form-control border-0 capital" placeholder="Section" value="<?php echo set_value('sibling2_section'); ?>">
                </div>
            </div>
        </div>     
    </div>

    <!-- <div class="input-group  mb-3">
        <div class="input-group">
           <input type="text" name="file" id="file" class="form-control border-0  file-upload-text" disabled placeholder="Attach a certificate copy if any" value="<?php //echo set_value('file'); ?>"/>
           <span class="input-group-btn">
              <button type="button" class="btn btn-default border-0    file-upload-btn">
              Browse...
              <input type="file" id="file" class="file-upload" name="upload_file" value="<?php //echo set_value('file'); ?>" />
              </button>
           </span>
        </div>
    </div> -->
    <div class="mb-4">
       <!-- <button class="btn btn-gray   py-2 text-info">Upload</button> -->
    </div>                                
</div>