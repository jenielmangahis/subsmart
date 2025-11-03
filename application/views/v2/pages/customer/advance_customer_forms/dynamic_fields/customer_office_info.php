<div class="nsm-card primary">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span><i class='bx bx-fw bx-buildings'></i> Office Use Information</span>
        </div>
    </div>
    <div class="nsm-card-content"><hr>
        <div class="row form_line" <?= isCustomerFieldEnabled($companyFormSetting, 'office-use-information', 'entered_by') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'office-use-information', 'entered_by'); ?></div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="entered_by" id="entered_by" value="<?php if(isset($office_info) && $office_info->entered_by){ echo  $office_info->entered_by; } else { echo $logged_in_user->FName.' '. $logged_in_user->LName;} ?>"/>
            </div>
        </div>
        <div class="row form_line" <?= isCustomerFieldEnabled($companyFormSetting, 'office-use-information', 'time_entered') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'office-use-information', 'time_entered'); ?></div>
            <div class="col-md-6">
                <?php 
                    $time_entered = date("H:i");
                    if( $profile_info && strtotime($profile_info->created_at) > 0 ){
                        $time_entered = date("H:i", strtotime($profile_info->created_at));
                    }
                ?>
                <input type="time" class="form-control" name="time_entered" id="time_entered" value="<?= $time_entered; ?>" />
            </div>
        </div>
        <div class="row form_line" <?= isCustomerFieldEnabled($companyFormSetting, 'office-use-information', 'sales_date') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'office-use-information', 'sales_date'); ?></div>
            <div class="col-md-6">
                <?php 
                    $sales_date = '';
                    if( $office_info && strtotime($office_info->sales_date) > 0 ){
                        $sales_date = date("m/d/Y", strtotime($office_info->sales_date));
                    }
                ?>
                <input data-type="office_info_sales_date" type="text" class="form-control date_picker" name="sales_date" id="" value="<?php echo $sales_date ?>"/>
            </div>
        </div>
        <div class="row form_line" <?= isCustomerFieldEnabled($companyFormSetting, 'office-use-information', 'credit_score') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'office-use-information', 'credit_score'); ?></div>
            <div class="col-md-6">
                <select id="credit_score" name="credit_score" data-customer-source="dropdown" class="input_select" >
                    <option <?= isset($office_info) && $office_info->credit_score == 'A' ?  'selected' : '';?> value="A">A</option>
                    <option <?= isset($office_info) && $office_info->credit_score == 'B' ?  'selected' : '';?> value="B">B</option>
                    <option <?= isset($office_info) && $office_info->credit_score == 'C' ?  'selected' : '';?> value="C">C</option>
                    <option <?= isset($office_info) && $office_info->credit_score == 'D' ?  'selected' : '';?> value="D">D</option>
                    <option <?= isset($office_info) && $office_info->credit_score == 'F' ?  'selected' : '';?> value="F">F</option>
                </select>
            </div>
        </div>
        <div class="row form_line" <?= isCustomerFieldEnabled($companyFormSetting, 'office-use-information', 'verification') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'office-use-information', 'verification'); ?></div>
            <div class="col-md-6">
                <select id="verification" name="verification" data-customer-source="dropdown" class="input_select" >
                    <option <?php if(isset($office_info)){ if($office_info->verification == "TrunsUnion"){ echo 'selected'; } } ?> value="TransUnion">TransUnion</option>
                    <option <?php if(isset($office_info)){ if($office_info->verification == "Experian"){ echo 'selected'; } } ?>  value="Experian">Experian </option>
                    <option <?php if(isset($office_info)){ if($office_info->verification == "Equifax"){ echo 'selected'; } } ?>  value="Equifax">Equifax  </option>
                    <option <?php if(isset($office_info)){ if($office_info->verification == "Others"){ echo 'selected'; } } ?>  value="Others">Others  </option>
                </select>
            </div>
        </div>     
        <div class="row form_line" <?= isCustomerFieldEnabled($companyFormSetting, 'office-use-information', 'pay_history') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'office-use-information', 'pay_history'); ?></div>
            <div class="col-md-6">
                <select id="pay_history" name="pay_history" class="input_select searchable-dropdown">
                    <option <?php if(isset($office_info)){ if($office_info->pay_history == 1){ echo 'selected'; } } ?> value="1">1 - Excellent</option>
                    <option <?php if(isset($office_info)){ if($office_info->pay_history == 2){ echo 'selected'; } } ?> value="2">2 - Good</option>
                    <option <?php if(isset($office_info)){ if($office_info->pay_history == 3){ echo 'selected'; } } ?> value="3">3 - Fair</option>
                    <option <?php if(isset($office_info)){ if($office_info->pay_history == 4){ echo 'selected'; } } ?> value="4">4 - Poor</option>
                    <option <?php if(isset($office_info)){ if($office_info->pay_history == 5){ echo 'selected'; } } ?> value="5">5 - Very Poor</option>
                </select>
            </div>
        </div>

        <div class="row form_line" <?= isCustomerFieldEnabled($companyFormSetting, 'office-use-information', 'fk_sales_rep_office') == 0 ? 'style="display:none;"' : ''; ?>> 
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'office-use-information', 'fk_sales_rep_office'); ?></div>
            <div class="col-md-6">
                <?php 
                    $fk_sales_rep_office = $office_info->fk_sales_rep_office ?? 0;
                    if( $fk_sales_rep_office == 0 && $woSubmittedLatest ){
                        $fk_sales_rep_office = $woSubmittedLatest->employee_id;
                    } 
                ?>
                <select id="fk_sales_rep_office" name="fk_sales_rep_office" data-customer-source="dropdown" class="input_select" >
                    <option value="">Select</option>
                    <?php foreach ($users as $user): ?>
                        <option <?= $user->id == $fk_sales_rep_office ? 'selected="selected"' : ''; ?> value="<?= $user->id; ?>"><?= $user->FName.' '.$user->LName; ?></option>
                        <?= $user->id ?>    
                    <?php endforeach ?>
                </select>
            </div>
        </div>
        <div class="row form_line" <?= isCustomerFieldEnabled($companyFormSetting, 'office-use-information', 'technician') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'office-use-information', 'technician'); ?></div>
            <div class="col-md-6">
                <select id="technician" name="technician"  class="input_select" data-value="<?= isset($office_info->technician) ? $office_info->technician : "" ?>">
                    <option value="">Select</option>
                    <?php foreach ($technicians as $user): ?>
                        <option <?php if(isset($office_info)){ if($office_info->technician == $user->id ){ echo 'selected'; } } ?> value="<?= $user->id ?>"><?= $user->FName.' '.$user->LName; ?></option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>        
        <div class="row form_line" <?= isCustomerFieldEnabled($companyFormSetting, 'office-use-information', 'install_date') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'office-use-information', 'install_date'); ?></div>
            <div class="col-md-6">
                <?php 
                    $install_date = '';            
                    if( $office_info && strtotime($office_info->install_date) > 0 ){
                        $install_date = date("m/d/Y", strtotime($office_info->install_date));
                    }else{
                        if( $woSubmittedLatest && strtotime($woSubmittedLatest->install_date) > 0 ){
                            $install_date = date("m/d/Y",strtotime($woSubmittedLatest->install_date));
                        }
                    }
                ?>
                <input data-type="office_info_install_date" type="text" class="form-control date_picker" name="install_date" id="" value="<?= $install_date; ?>"/>
            </div>
        </div>
        <div class="row form_line" <?= isCustomerFieldEnabled($companyFormSetting, 'office-use-information', 'tech_arrive_time') == 0 || trim($office_info->tech_arrive_time) == '' ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'office-use-information', 'tech_arrive_time'); ?></div>
            <div class="col-md-6">
                <div class="input-group bootstrap-timepicker">
                    <input id="tech_arrive_time" class="form-control" value="<?php if(isset($office_info)){ echo  date("H:i:s",strtotime($office_info->tech_arrive_time)); } ?>" name="tech_arrive_time" data-provide="timepicker" type="time"/>
                </div>
            </div>
        </div>
        <div class="row form_line" <?= isCustomerFieldEnabled($companyFormSetting, 'office-use-information', 'tech_depart_time') == 0 || $office_info->tech_depart_time == '' ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'office-use-information', 'tech_depart_time'); ?></div>
            <div class="col-md-6">
                <div class="input-group bootstrap-timepicker">
                    <input id="tech_depart_time" class="form-control" value="<?php if(isset($office_info)){ echo  $office_info->tech_depart_time; } ?>" name="tech_depart_time" type="time"/>
                </div>
            </div>
        </div>
        <div class="row form_line" <?= isCustomerFieldEnabled($companyFormSetting, 'office-use-information', 'lead_source') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'office-use-information', 'lead_source'); ?></div>
            <div class="col-md-6">
                <select id="lead_source" name="lead_source" data-customer-source="dropdown" class="input_select" required=""> 
                    <?php
                        foreach($LEAD_SOURCE_OPTION as $lead_source) {
                            if ($lead_source->ls_name == $office_info->lead_source) {
                                echo "<option value='$lead_source->ls_name' selected>$lead_source->ls_name</option>";
                            } else {
                                echo "<option value='$lead_source->ls_name'>$lead_source->ls_name</option>";
                            }
                        }
                    ?>
                </select>
            </div>
        </div>           
        <!--<div class="row">
            <div class="col-md-6">
                Rep Tiered Upfront Bonus
            </div>
            <div class="col-md-6">
                <label>$0.00
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                Rep Tiered Holdfund Bonus
            </div>
            <div class="col-md-6">
                <label>$0.00
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                Rep Deductions Total
            </div>
            <div class="col-md-6">
                <label>$0.00
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                Tech Deductions Total
            </div>
            <div class="col-md-6">
                <label>$0.00
            </div>
        </div>-->

        <div class="row form_line" <?= isCustomerFieldEnabled($companyFormSetting, 'office-use-information', 'language') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'office-use-information', 'language'); ?></div>
            <div class="col-md-6">
                <select id="language" name="language" data-customer-source="dropdown" class="input_select">
                    <option <?php if(isset($office_info)){ if($office_info->language == "English"){ echo 'selected'; } } ?> value="English">English</option>
                    <option <?php if(isset($office_info)){ if($office_info->language == "Spanish"){ echo 'selected'; } } ?> value="Spanish">Spanish</option>
                    <option <?php if(isset($office_info)){ if($office_info->language == "Mandarin Chinese"){ echo 'selected'; } } ?> value="Mandarin Chinese">Mandarin Chinese</option>
                    <option <?php if(isset($office_info)){ if($office_info->language == "French"){ echo 'selected'; } } ?> value="French">French</option>
                </select>
            </div>
        </div>
        <?php if(logged('industry_type') != 'Alarm Industry'){ ?>
        <div class="row form_line" <?= isCustomerFieldEnabled($companyFormSetting, 'office-use-information', 'system_type') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'office-use-information', 'system_type'); ?></div>
            <div class="col-md-6">
                <select data-value="<?= isset($alarm_info) ? $alarm_info->system_type : "" ?>" name="system_type" id="system-type" data-type="alarm_info_system_type" class="form-control">
                    <option><?= isset($alarm_info) ? $alarm_info->system_type : "" ?></option>
                </select>
                <a href="javascript:void(0);" class="nsm-button btn-small" id="btn-quick-add-system-package-type"><span class="fa fa-plus"></span> Add System Package Type</a>
            </div>
        </div>
        <?php } ?>
    </div>
</div>