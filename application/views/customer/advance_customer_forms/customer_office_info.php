<div class="card">
    <div class="card-header">
        <span style="position: absolute;right: 0;margin-right: 25px;font-size: 20px;padding-top:10px;" class="fa fa-ellipsis-v"></span>
        <h6 ><span class="fa fa-user"></span>&nbsp; &nbsp;Office Use Information</h6>
    </div>
    <div class="card-body">
        <div class="row form_line">
            <div class="col-md-6">
                Entered By
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="entered_by" id="entered_by" value="<?php if(isset($office_info) && $office_info->entered_by){ echo  $office_info->entered_by; } else { echo $logged_in_user->FName.' '. $logged_in_user->LName;} ?>"/>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Time Entered
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control timepicker" name="time_entered" id="time_entered" value="<?php if(isset($office_info)){ echo  $office_info->time_entered; } ?>" />
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Sales Date
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control date_picker" name="sales_date" id="" value="<?php if(isset($office_info)){ echo  $office_info->sales_date; } ?>"/>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Credit Score 
            </div>
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

        <div class="row form_line">
            <div class="col-md-6">
                <label class="alarm_label"> <span >Pay History </span>
            </div>
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

        <div class="row form_line">
            <div class="col-md-6">
                Sales Rep
            </div>
            <div class="col-md-6">
                <select id="fk_sales_rep_office" name="fk_sales_rep_office" data-customer-source="dropdown" class="input_select" >
                    <option value="">Select</option>
                    <?php foreach ($users as $user): ?>
                        <option <?php if(isset($office_info)){ echo $office_info->fk_sales_rep_office ==  $user->id ? 'selected' : ''; } ?> value="<?= $user->id; ?>"><?= $user->FName.' '.$user->LName; ?></option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Technician
            </div>
            <div class="col-md-6">
                <select id="technician" name="technician"  class="input_select">
                    <option value="">Select</option>
                    <?php foreach ($users as $user): ?>
                        <option <?php if(isset($office_info)){ if($office_info->technician == $user->FName.' '.$user->LName){ echo 'selected'; } } ?> value="<?= $user->FName.' '.$user->LName; ?>"><?= $user->FName.' '.$user->LName; ?></option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Install Date
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control date_picker" name="install_date" id="" value="<?php if(isset($office_info)){ echo  $office_info->install_date; } ?>"/>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Tech Arrival Time
            </div>
            <div class="col-md-6">
                <div class="input-group bootstrap-timepicker timepicker">
                    <input id="tech_arrive_time" class="form-control timepicker" value="<?php if(isset($office_info)){ echo  $office_info->tech_arrive_time; } ?>" name="tech_arrive_time" data-provide="timepicker" data-template="modal" data-minute-step="1" data-modal-backdrop="true" type="text"/>
                </div>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Tech Depart Time
            </div>
            <div class="col-md-6">
                <div class="input-group bootstrap-timepicker timepicker">
                    <input id="tech_depart_time" class="form-control" value="<?php if(isset($office_info)){ echo  $office_info->tech_depart_time; } ?>" name="tech_depart_time" data-provide="timepicker" data-template="modal" data-minute-step="1" data-modal-backdrop="true" type="text"/>
                </div>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Lead Source
            </div>
            <div class="col-md-6">
                <select id="lead_source" name="lead_source" data-customer-source="dropdown" class="input_select">
                    <option <?php if(isset($office_info)){ if($office_info->lead_source == ""){ echo 'selected'; } } ?> value="">Select</option>
                    <option <?php if(isset($office_info)){ if($office_info->lead_source == "Customer Referral"){ echo 'selected'; } } ?> value="Customer Referral">Customer Referral</option>
                    <option <?php if(isset($office_info)){ if($office_info->lead_source == "Door"){ echo 'selected'; } } ?> value="Door">Door</option>
                    <option <?php if(isset($office_info)){ if($office_info->lead_source == "Door Hanger"){ echo 'selected'; } } ?> value="Door Hanger">Door Hanger</option>
                    <option <?php if(isset($office_info)){ if($office_info->lead_source == "Flyer Mail Outs"){ echo 'selected'; } } ?> value="Flyer Mail Outs">Flyer Mail Outs</option>
                    <option <?php if(isset($office_info)){ if($office_info->lead_source == "Outbound Calls"){ echo 'selected'; } } ?> value="Outbound Calls">Outbound Calls</option>
                    <option <?php if(isset($office_info)){ if($office_info->lead_source == "Phone"){ echo 'selected'; } } ?> value="Phone">Phone</option>
                    <option <?php if(isset($office_info)){ if($office_info->lead_source == "Radio Ad"){ echo 'selected'; } } ?> value="Radio Ad">Radio Ad</option>
                    <option <?php if(isset($office_info)){ if($office_info->lead_source == "Social Media"){ echo 'selected'; } } ?> value="Social Media">Social Media</option>
                    <option <?php if(isset($office_info)){ if($office_info->lead_source == "TV Ad"){ echo 'selected'; } } ?> value="TV Ad">TV Ad</option>
                    <option <?php if(isset($office_info)){ if($office_info->lead_source == "Unknown"){ echo 'selected'; } } ?>value="Unknown">Unknown</option>
                    <option <?php if(isset($office_info)){ if($office_info->lead_source == "Website"){ echo 'selected'; } } ?> value="Website">Website</option>
                    <option <?php if(isset($office_info)){ if($office_info->lead_source == "Yard Sign"){ echo 'selected'; } } ?> value="Yard Sign">Yard Sign</option>
                    <option <?php if(isset($office_info)){ if($office_info->lead_source == "Affiliates"){ echo 'selected'; } } ?> value="Affiliates">Affiliates</option>
                </select>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Verification:
            </div>
            <div class="col-md-6">
                <select id="verification" name="verification" data-customer-source="dropdown" class="input_select" >
                    <option <?php if(isset($office_info)){ if($office_info->verification == "TrunsUnion"){ echo 'selected'; } } ?> value="TransUnion">TransUnion</option>
                    <option <?php if(isset($office_info)){ if($office_info->verification == "Experian"){ echo 'selected'; } } ?>  value="Experian">Experian </option>
                    <option <?php if(isset($office_info)){ if($office_info->verification == "Equifax"){ echo 'selected'; } } ?>  value="Equifax">Equifax  </option>
                    <option <?php if(isset($office_info)){ if($office_info->verification == "Others"){ echo 'selected'; } } ?>  value="Others">Others  </option>
                </select>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Cancel Date
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control date_picker" name="cancel_date" id="date_picker" value="<?php if(isset($office_info)){ echo  $office_info->cancel_date; } ?>" />
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Cancel Reason
            </div>
            <div class="col-md-6">
                <select id="cancel_reason" name="cancel_reason" data-customer-source="dropdown" class="input_select" >
                    <option <?php if(isset($office_info)){ if($office_info->cancel_reason == ""){ echo 'selected'; } } ?> value="">Select</option>
                    <option <?php if(isset($office_info)){ if($office_info->cancel_reason == 'DS'){ echo 'selected'; } } ?> value="DS">Dissatisfied with Service</option>
                    <option <?php if(isset($office_info)){ if($office_info->cancel_reason == 'FH'){ echo 'selected'; } } ?> value="FH">Financial Hardship</option>
                    <option <?php if(isset($office_info)){ if($office_info->cancel_reason == 'FC'){ echo 'selected'; } } ?> value="FC">Fulfilled Contract</option>
                    <option <?php if(isset($office_info)){ if($office_info->cancel_reason == 'Moving'){ echo 'selected'; } } ?> value="Moving">Moving</option>
                    <option <?php if(isset($office_info)){ if($office_info->cancel_reason == 'NP'){ echo 'selected'; } } ?> value="NP">Non-Payment</option>
                    <option <?php if(isset($office_info)){ if($office_info->cancel_reason == 'Paid BOC'){ echo 'selected'; } } ?> value="Paid BOC">Paid BOC</option>
                    <option <?php if(isset($office_info)){ if($office_info->cancel_reason == 'PA'){ echo 'selected'; } } ?> value="PA">Passed Away</option>
                    <option <?php if(isset($office_info)){ if($office_info->cancel_reason == 'SUC'){ echo 'selected'; } } ?> value="SUC">Still Under Contruct</option>
                </select>
            </div>
        </div>

        <div class="row form_line">
            <div class="col-md-6">
                <label>Collections
            </div>
            <div class="col-md-6">
                <select id="collections" name="collections" data-customer-source="dropdown" class="form-controls input_select">
                    <option value=""></option>
                    <option <?= isset($alarm_info) && $alarm_info->collections == 'In Process' ?  'selected' : '';?> value="In Process">In Process</option>
                    <option <?= isset($alarm_info) && $alarm_info->collections == 'Sent' ?  'selected' : '';?> value="Sent">Sent</option>
                    <option <?= isset($alarm_info) && $alarm_info->collections == 'None Collectable' ?  'selected' : '';?> value="None Collectable">None Collectable</option>
                    <option <?= isset($alarm_info) && $alarm_info->collections == 'In Collections' ?  'selected' : '';?> value="In Collections">In Collection</option>
                    <option <?= isset($alarm_info) && $alarm_info->collections == 'Civil Suit' ?  'selected' : '';?> value="Civil Suit">Civil Suit</option>
                    <option <?= isset($alarm_info) && $alarm_info->collections == 'Taken Action' ?  'selected' : '';?> value="Taken Action">Taken Action</option>
                </select>
            </div>
        </div>

        <div class="row form_line">
            <div class="col-md-6">
                Collection Date
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control date_picker" name="collect_date" id="date_picker" value="<?php if(isset($office_info)){ echo $office_info->collect_date; } ?>" />
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Collection Amount
            </div>
            <div class="col-md-6">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">$</span>
                    </div>
                    <input type="number" class="form-control input_select" name="collect_amount" value="<?php if(isset($office_info)){ echo $office_info->collect_amount; } ?>">
                </div>
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

        <div class="row form_line">
            <div class="col-md-6">
                Language
            </div>
            <div class="col-md-6">
                <select id="language" name="language" data-customer-source="dropdown" class="input_select">
                    <option <?php if(isset($office_info)){ if($office_info->language == "English"){ echo 'selected'; } } ?> value="English">English</option>
                    <option <?php if(isset($office_info)){ if($office_info->language == "Spanish"){ echo 'selected'; } } ?> value="Spanish">Spanish</option>
                    <option <?php if(isset($office_info)){ if($office_info->language == "Mandarin Chinese"){ echo 'selected'; } } ?> value="Mandarin Chinese">Mandarin Chinese</option>
                    <option <?php if(isset($office_info)){ if($office_info->language == "French"){ echo 'selected'; } } ?> value="French">French</option>
                </select>
            </div>
        </div>
    </div>

        <div class="card-header">
            <span style="position: absolute;right: 0;margin-right: 25px;font-size: 20px;padding-top:10px;" class="fa fa-ellipsis-v"></span>
            <h6 ><span class="fa fa-user"></span>&nbsp; &nbsp;Funding Information</h6>
        </div>
    <div class="card-body">
        <div class="row form_line">
            <div class="col-md-7">
                Pre-Install Survey
            </div>
            <div class="col-md-5">
                <select id="pre_install_survey" name="pre_install_survey" data-customer-source="dropdown" class="input_select" >
                    <option <?php if(isset($office_info)){ if($office_info->pre_install_survey == ""){ echo 'selected'; } } ?> value=""></option>
                    <option <?php if(isset($office_info)){ if($office_info->pre_install_survey == "Pass"){ echo 'selected'; } } ?> value="Pass">Pass</option>
                    <option <?php if(isset($office_info)){ if($office_info->pre_install_survey == "Fail"){ echo 'selected'; } } ?>value="Fail">Fail</option>
                    <option  <?php if(isset($office_info)){ if($office_info->pre_install_survey == "Pending"){ echo 'selected'; } } ?> value="Pending">Pending</option>
                </select>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-7">
                Post-Install Survey
            </div>
            <div class="col-md-5">
                <select id="post_install_survey" name="post_install_survey" data-customer-source="dropdown" class="input_select" >
                    <option <?php if(isset($office_info)){ if($office_info->post_install_survey == ""){ echo 'selected'; } } ?> value="">Select</option>
                    <option <?php if(isset($office_info)){ if($office_info->post_install_survey == "Pass"){ echo 'selected'; } } ?> value="Pass">Pass</option>
                    <option <?php if(isset($office_info)){ if($office_info->post_install_survey == "Fail"){ echo 'selected'; } } ?> value="Fail">Fail</option>
                    <option <?php if(isset($office_info)){ if($office_info->post_install_survey == "Pending"){ echo 'selected'; } } ?> value="Pending">Pending</option>
                </select>
            </div>
        </div>
        <hr>
        <div class="row form_line">
            <div class="col-md-7">
                Monitoring Waived
            </div>
            <div class="col-md-5">
                <select id="monitoring_waived" name="monitoring_waived" data-customer-source="dropdown" class="input_select" >
                    <option  value=""></option>
                    <option <?= isset($office_info) && $office_info->monitoring_waived == 1 ?  'selected' : '';?> value="1">1 month</option>
                    <option <?= isset($office_info) && $office_info->monitoring_waived == 2 ?  'selected' : '';?> value="2">2 months</option>
                    <option <?= isset($office_info) && $office_info->monitoring_waived == 3 ?  'selected' : '';?> value="3">3 months</option>
                    <option <?= isset($office_info) && $office_info->monitoring_waived == 4 ?  'selected' : '';?> value="4">4 months</option>
                    <option <?= isset($office_info) && $office_info->monitoring_waived == 5 ?  'selected' : '';?> value="5">5 months</option>
                    <option <?= isset($office_info) && $office_info->monitoring_waived == 6 ?  'selected' : '';?> value="6">6 months</option>
                    <option <?= isset($office_info) && $office_info->monitoring_waived == 7 ?  'selected' : '';?> value="7">7 months</option>
                    <option <?= isset($office_info) && $office_info->monitoring_waived == 8 ?  'selected' : '';?> value="8">8 months</option>
                    <option <?= isset($office_info) && $office_info->monitoring_waived == 9 ?  'selected' : '';?> value="8">9 months</option>
                    <option <?= isset($office_info) && $office_info->monitoring_waived == 10 ?  'selected' : '';?> value="10">10 months</option>
                    <option <?= isset($office_info) && $office_info->monitoring_waived == 11 ?  'selected' : '';?> value="11">11 months</option>
                    <option <?= isset($office_info) && $office_info->monitoring_waived == 12 ?  'selected' : '';?> value="12">12 months</option>
                </select>
            </div>
        </div>

        <div class="row form_line">
            <div class="col-md-7">
                <label for="rebate_offer"><span>Rebate Offered</span>
            </div>
            <div class="col-md-5">
                <input type="checkbox" name="rebate_offer" class="form-controls" value="1"  id="rebate_offer" <?php if(isset($office_info)){ echo $office_info->rebate_offer == 1 ? 'checked': ''; } ?> >
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-7">
                Rebate Check # 1
            </div>
            <div class="col-md-5">
                <input type="number" class="form-control" name="rebate_check1" id="rebate_check1" value="<?php if(isset($office_info)){ echo  $office_info->rebate_check1; } ?>"/>
            </div>
            <div class="col-md-7">
                Amount $
            </div>
            <div class="col-md-5">
                <input type="number" step="0.01" class="form-control" name="rebate_check1_amt" id="rebate_check1_amt" value="<?php if(isset($office_info)){ echo  $office_info->rebate_check1_amt; } ?>"/>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-7">
                Rebate Check # 2
            </div>
            <div class="col-md-5">
                <input type="number" class="form-control" name="rebate_check2" id="rebate_check2" value="<?php if(isset($office_info)){ echo  $office_info->rebate_check2; } ?>"/>
            </div>
            <div class="col-md-7">
                Amount $
            </div>
            <div class="col-md-5">
                <input type="number" step="0.01" class="form-control" name="rebate_check2_amt" id="rebate_check2_amt" value="<?php if(isset($office_info)){ echo  $office_info->rebate_check2_amt; } ?>" />
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-7">
                Activation Fee
            </div>
            <div class="col-md-5">
                <select id="activation_fee" name="activation_fee" data-customer-source="dropdown" class="input_select">
                    <option value="0.00">0.00</option>
                    <?php foreach($activation_fees as $activation_fee): ?>
                        <option <?= isset($activation_fee->activation_fee) ? 'selected' : ''; ?> value="<?= $activation_fee->amount; ?>"><?= $activation_fee->amount; ?></option>
                    <?php endforeach; ?>
                </select>
                <a href="<?= base_url() ?>customer/settings/activationFee" target="_blank"  style="color:#58bc4f;font-size: 10px;"><span class="fa fa-plus"></span> Manage Fee</a>&nbsp;&nbsp;
            </div>
            <div class="col-md-12">
                <input type="radio" class="form-controls" name="way_of_pay" value="None" <?php if(isset($office_info)){ echo $office_info->way_of_pay == 'None' || $office_info->way_of_pay == '' || $office_info->way_of_pay == 'Email' ? 'checked': ''; }else {echo 'checked'; } ?>  id="way_of_pay_none">
                <span>None</span>

                <input type="radio" class="form-controls" name="way_of_pay" value="Check" <?php if(isset($office_info)){ echo $office_info->way_of_pay == 'Check'? 'checked': ''; } ?>  id="way_of_pay_check">
                <span>Check</span>

                <input type="radio" class="form-controls" name="way_of_pay" value="Credit" <?php if(isset($office_info)){ echo $office_info->way_of_pay == 'Credit'? 'checked': ''; } ?>  id="way_of_pay_credit">
                <span>Credit</span>

                <input type="radio" class="form-controls" name="way_of_pay" value="Paid" <?php if(isset($office_info)){ echo $office_info->way_of_pay == 'Paid'? 'checked': ''; } ?> id="way_of_pay_paid">
                <span>Paid</span>
            </div>
        </div>
        <hr>
        <div class="row form_line">
            <div class="col-md-7">
                Commision Scheme Override
            </div>
            <div class="col-md-5">
                <input type="radio" name="commision_scheme[]" class="form-controls" value="1" id="commision_scheme1" <?php if(isset($office_info)){ echo $office_info->commision_scheme == 1 ? 'checked': ''; } ?> >
                <span >On</span> &nbsp;&nbsp;
                <input type="radio" name="commision_scheme[]" class="form-controls" value="0" id="commision_scheme" <?php if(isset($office_info)){ echo $office_info->commision_scheme == 0 ? 'checked': ''; } ?>>
                <span>Off</span>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-7">
                Rep Commission 
            </div>
            <div class="col-md-5">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">$</span>
                    </div>
                    <input type="number" step="0.01" class="form-control input_select" id="rep_comm" name="rep_comm" value="<?php if(isset($office_info)){ echo $office_info->rep_comm; } ?>">
                </div>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-7">
                Rep Upfront Pay
            </div>
            <div class="col-md-5">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">$</span>
                    </div>
                    <input type="number" step="0.01" class="form-control input_select" name="rep_upfront_pay" value="<?php if(isset($office_info)){ echo $office_info->rep_upfront_pay; } ?>">
                </div>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-7">
                Rep Tiered Upront Bonus
            </div>
            <div class="col-md-5">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">$</span>
                    </div>
                    <input type="number" step="0.01" class="form-control input_select" name="rep_tiered_bonus" value="<?php if(isset($office_info)){ echo $office_info->rep_tiered_bonus; } ?>">
                </div>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-7">
                Rep Tiered Holdfund Bonus
            </div>
            <div class="col-md-5">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">$</span>
                    </div>
                    <input type="number" step="0.01" class="form-control input_select" name="rep_holdfund_bonus" value="<?php if(isset($office_info)){ echo $office_info->rep_holdfund_bonus; } ?>">
                </div>
            </div>
        </div>

        <div class="row form_line">
            <div class="col-md-7">
                Rep Deduction Total
            </div>
            <div class="col-md-5">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">$</span>
                    </div>
                    <input type="number" step="0.01" class="form-control input_select" name="rep_deduction" value="<?php if(isset($office_info)){ echo $office_info->rep_deduction; } ?>">
                </div>
            </div>
        </div>

        <div class="row form_line">
            <div class="col-md-7">
                Tech Commission 
            </div>
            <div class="col-md-5">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">$</span>
                    </div>
                    <input type="number" step="0.01" class="form-control input_select" id="tech_comm" name="tech_comm" value="<?php if(isset($office_info)){ echo $office_info->tech_comm; } ?>">
                </div>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-7">
                <label for="tech_upfront_pay">Tech Upfront Pay 
            </div>
            <div class="col-md-5">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">$</span>
                    </div>
                    <input type="number" step="0.01" class="form-control input_select" name="tech_upfront_pay" value="<?php if(isset($office_info)){ echo $office_info->tech_upfront_pay; } ?>">
                </div>
            </div>
        </div>

        <div class="row form_line">
            <div class="col-md-7">
                Tech Deduction Total
            </div>
            <div class="col-md-5">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">$</span>
                    </div>
                    <input type="number" step="0.01" class="form-control input_select" name="tech_deduction" value="<?php if(isset($office_info)){ echo $office_info->tech_deduction; } ?>">
                </div>
            </div>
        </div>

        <hr>

        <div class="row form_line">
            <div class="col-md-7">
                Rep Hold Fund Charge Back 
            </div>
            <div class="col-md-5">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">$</span>
                    </div>
                    <input type="number" step="0.01" class="form-control input_select" name="rep_charge_back" value="<?php if(isset($office_info)){ echo $office_info->rep_charge_back; } ?>">
                </div>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-7">
                Rep Payroll Charge Back 
            </div>
            <div class="col-md-5">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">$</span>
                    </div>
                    <input type="number" step="0.01" class="form-control input_select" name="rep_payroll_charge_back" value="<?php if(isset($office_info)){ echo $office_info->rep_payroll_charge_back; } ?>">
                </div>
            </div>
        </div>
        <hr>
        <div class="row form_line">
            <div class="col-md-7">
                Points Scheme Override
            </div>
            <div class="col-md-5">
                <input type="radio" name="pso[]" class="form-controls" value="1" id="pso1" <?php if(isset($office_info)){ echo $office_info->pso == 1 ? 'checked': ''; } ?> >
                <span>On</span>
                &nbsp;&nbsp;
                <input type="radio" name="pso[]" class="form-controls" value="0" id="pso" <?php if(isset($office_info)){ echo $office_info->pso == 0 ? 'checked': ''; } ?> >
                <span>Off</span>
                </div>
        </div>

        <div class="row form_line">
            <div class="col-md-7">
                Points Included
            </div>
            <div class="col-md-5">
                <input type="number" step="0.01" class="form-control" name="points_include" id="points_include" value="<?php if(isset($office_info)){ echo $office_info->points_include !=0 ? $office_info->points_include : '';  } ?>"  />
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-7">
                Price Per Point 
            </div>
            <div class="col-md-5">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">$</span>
                    </div>
                    <input type="number" step="0.01" class="form-control input_select" name="price_per_point" value="<?php if(isset($office_info)){ echo $office_info->price_per_point; } ?>">
                </div>
            </div>
        </div>
        <hr>
        <div class="row form_line">
            <div class="col-md-7">
                Purchase Price 
            </div>
            <div class="col-md-5">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">$</span>
                    </div>
                    <input type="number" step="0.01" class="form-control input_select" name="purchase_price" value="<?php if(isset($office_info)){ echo $office_info->purchase_price; } ?>">
                </div>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-7">
                Purchase Multiple
            </div>
            <div class="col-md-5">
                <select id="purchase_multiple" name="purchase_multiple" data-customer-source="dropdown" class="input_select ">
                    <option <?php if(isset($office_info)){ if($office_info->purchase_multiple == ""){ echo 'selected'; } } ?> value="">Select</option>
                    <?php
                    for($pm=12;$pm<76;$pm++){
                        ?>
                            <option <?php if(isset($office_info)){ if($office_info->purchase_multiple == $pm.'x'){ echo 'selected'; } } ?> value="<?= $pm.'x'; ?>"><?= $pm.'x'; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-7">
                Purchase Discount 
            </div>
            <div class="col-md-5">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">$</span>
                    </div>
                    <input type="number" step="0.01" class="form-control input_select" name="purchase_discount" value="<?php if(isset($office_info)){ echo $office_info->purchase_discount; } ?>">
                </div>
            </div>
        </div>
        <hr>
        <div class="row form_line">
            <div class="col-md-7">
                Equipment Cost
            </div>
            <div class="col-md-5">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">$</span>
                    </div>
                    <input type="number" step="0.01" class="form-control input_select" name="equipment_cost" value="<?php if(isset($office_info)){ echo $office_info->equipment_cost; } ?>">
                </div>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-7">
                Labor Cost
            </div>
            <div class="col-md-5">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">$</span>
                    </div>
                    <input type="number" step="0.01" class="form-control input_select" id="labor_cost" name="labor_cost" value="<?php if(isset($office_info)){ echo $office_info->labor_cost; } ?>">
                </div>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-7">
                Job Profit
            </div>
            <div class="col-md-5">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">$</span>
                    </div>
                    <input type="number" step="0.01" class="form-control input_select" name="job_profit" value="<?php if(isset($office_info)){ echo $office_info->job_profit; } ?>">
                </div>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-12">
                Customer Shareable Link
            </div>
            <div class="col-md-12">
                <input type="url" placeholder="https://sample.com" class="form-control" name="url" id="url" value="<?php if(isset($office_info)){ echo  $office_info->url; } ?>" />
            </div>
        </div>
    </div>
</div>