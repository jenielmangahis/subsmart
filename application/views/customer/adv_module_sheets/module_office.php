<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class=" module_ac" >
    <div class="row">
        <div class="col-md-12 module_header">
            <p class="module_title">Office Use Information</p>
        </div>
        <div class="col-sm-12" id="address_module">
            <div class="col-sm-12 text-right-sm" style="align:right;">
                <span class="text-ter" style="position: absolute; right: 83px !important; top: 8px;">Customize</span>
                <div class="onoffswitch grid-onoffswitch" style="position: relative; margin-top: 7px;">
                    <input type="checkbox" name="office_switch" class="onoffswitch-checkbox" data-customize="open" id="onoff-office">
                    <label class="onoffswitch-label" for="onoff-office">
                        <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="welcome_sent"><span>Welcome kit Sent</span>
                </div>
                <div class="col-md-8">
                    <input type="checkbox" name="welcome_sent" value="1" id="welcome_sent" <?php if(isset($office_info)){ echo $office_info->welcome_sent == 1 ? 'checked': ''; } ?>>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="rebate1"><span>Rebate Received</span>
                </div>
                <div class="col-md-4">
                    <input type="radio" name="rebate[]" value="1" id="rebate1" <?php if(isset($office_info)){ echo $office_info->rebate == 1 ? 'checked': ''; } ?> >
                <!-- </div>
                <div class="col-md-3"> -->
                    <label for="rebate"><span>Rebate Paid</span>
                </div>
                <div class="col-md-1">
                    <input type="radio" name="rebate[]" value="0"  id="rebate" <?php if(isset($office_info)){ echo $office_info->rebate == 0 ? 'checked': ''; } ?>>
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Commision Scheme Override</label>
                </div>
                <div class="col-md-7">
                    <input type="radio" name="commision_scheme[]" value="1" id="commision_scheme1" <?php if(isset($office_info)){ echo $office_info->commision_scheme == 1 ? 'checked': ''; } ?> >
                    <label for="commision_scheme1"><span>On</span></label>

                    <input type="radio" name="commision_scheme[]" value="0" id="commision_scheme" <?php if(isset($office_info)){ echo $office_info->commision_scheme == 0 ? 'checked': ''; } ?>>
                    <label for="commision_scheme"><span>Off</span></label>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Rep Commission $</label>
                </div>
                <div class="col-md-8">
                    <input type="number" class="form-control" name="rep_comm" id="rep_comm" value="<?php if(isset($office_info)){ echo $office_info->rep_comm; } ?>" />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Rep Upfront Pay</label>
                </div>
                <div class="col-md-8">
                    <input type="number" class="form-control" name="rep_upfront_pay" id="rep_upfront_pay" value="<?php if(isset($office_info)){ echo $office_info->rep_upfront_pay; } ?>" />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Tech Commission $</label>
                </div>
                <div class="col-md-8">
                    <input type="number" class="form-control" name="tech_comm" id="tech_comm" value="<?php if(isset($office_info)){ echo $office_info->tech_comm; } ?>" />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="tech_upfront_pay">Tech Upfront Pay $</label>
                </div>
                <div class="col-md-8">
                    <input type="number" class="form-control" name="tech_upfront_pay" id="tech_upfront_pay" value="<?php if(isset($office_info)){ echo $office_info->tech_upfront_pay; } ?>" />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Rep Tiered Upfront Bonus</label>
                </div>
                <div class="col-md-8">
                    <label>$0.00</label>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Rep Tiered Holdfund Bonus</label>
                </div>
                <div class="col-md-8">
                    <label>$0.00</label>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Rep Deductions Total</label>
                </div>
                <div class="col-md-8">
                    <label>$0.00</label>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Tech Deductions Total</label>
                </div>
                <div class="col-md-8">
                    <label>$0.00</label>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">RepHold Fund Charge Back $</label>
                </div>
                <div class="col-md-8">
                    <input type="number" class="form-control" name="rep_charge_back" id="rep_charge_back" value="<?php if(isset($office_info)){ echo $office_info->rep_charge_back; } ?>"   />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Rep Payroll Charge Back $</label>
                </div>
                <div class="col-md-8">
                    <input type="number" class="form-control" name="rep_payroll_charge_back" id="rep_payroll_charge_back" value="<?php if(isset($office_info)){ echo $office_info->rep_payroll_charge_back; } ?>" />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Points Scheme Override</label>
                </div>
                <div class="col-md-8">
                    <input type="radio" name="pso[]" value="1" id="pso1" <?php if(isset($office_info)){ echo $office_info->pso == 1 ? 'checked': ''; } ?> >
                    <label for="pso1"><span>On</span></label>

                    <input type="radio" name="pso[]" value="0" id="pso" <?php if(isset($office_info)){ echo $office_info->pso == 0 ? 'checked': ''; } ?> >
                    <label for="pso"><span>Off</span></label>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Assign To</label>
                </div>
                <div class="col-md-8">
                    <select id="assign_to" name="assign_to"  class="input_select">
                        <option value="">Select</option>
                        <?php foreach ($users as $user): ?>
                            <option <?php if(isset($office_info)){ echo $office_info->assign_to ==  $user->id ? 'selected' : ''; } ?> value="<?= $user->id; ?>"><?= $user->FName.' '.$user->LName; ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Points Included</label>
                </div>
                <div class="col-md-8">
                    <input type="number" class="form-control" name="points_include" id="points_include" value="<?php if(isset($office_info)){ echo $office_info->points_include !=0 ? $office_info->points_include : '';  } ?>"  />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Price Per Point $</label>
                </div>
                <div class="col-md-8">
                    <input type="number" class="form-control" name="price_per_point" id="price_per_point" value="<?php if(isset($office_info)){ echo $office_info->price_per_point !=0 ? $office_info->price_per_point : ''; } ?>" />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Purchase Price $</label>
                </div>
                <div class="col-md-8">
                    <input type="number" class="form-control" name="purchase_price" id="purchase_price" />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Purchase Multiple</label>
                </div>
                <div class="col-md-8">
                    <select id="purchase_multiple" name="purchase_multiple" data-customer-source="dropdown" class="input_select">
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
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Purchase Discount $</label>
                </div>
                <div class="col-md-8">
                    <input type="number" class="form-control" name="purchase_discount" id="purchase_discount" value="<?php if(isset($office_info)){ echo  $office_info->purchase_discount; } ?>"/>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Entered By</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="entered_by" id="entered_by" value="<?php if(isset($office_info)){ echo  $office_info->entered_by; } ?>"/>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Time Entered</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="time_entered" id="time_entered" value="<?php if(isset($office_info)){ echo  $office_info->time_entered; } ?>"/>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Sales Date</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control date_picker" name="sales_date" id="" value="<?php if(isset($office_info)){ echo  $office_info->sales_date; } ?>"/>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Credit Score </label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="credit_score" id="credit_score" value="<?php if(isset($office_info)){ echo  $office_info->credit_score; } ?>"/>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Language</label>
                </div>
                <div class="col-md-8">
                    <select id="language" name="language" data-customer-source="dropdown" class="input_select">
                        <option <?php if(isset($office_info)){ if($office_info->language == ""){ echo 'selected'; } } ?> value="">Select</option>
                        <option <?php if(isset($office_info)){ if($office_info->language == "English"){ echo 'selected'; } } ?> value="English">English</option>
                        <option <?php if(isset($office_info)){ if($office_info->language == "Spanish"){ echo 'selected'; } } ?> value="Spanish">Spanish</option>
                        <option <?php if(isset($office_info)){ if($office_info->language == "Mandarin Chinese"){ echo 'selected'; } } ?> value="Mandarin Chinese">Mandarin Chinese</option>
                        <option <?php if(isset($office_info)){ if($office_info->language == "French"){ echo 'selected'; } } ?> value="French">French</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Sales Rep</label>
                </div>
                <div class="col-md-8">
                    <select id="fk_sales_rep_office" name="fk_sales_rep_office" data-customer-source="dropdown" class="input_select" >
                        <option value="">Select</option>
                        <?php foreach ($users as $user): ?>
                            <option <?php if(isset($office_info)){ echo $office_info->assign_to ==  $user->id ? 'selected' : ''; } ?> value="<?= $user->id; ?>"><?= $user->FName.' '.$user->LName; ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Technician</label>
                </div>
                <div class="col-md-8">
                    <select id="technician" name="technician"  class="input_select">
                        <option value="">Select</option>
                        <?php foreach ($users as $user): ?>
                            <option <?php if(isset($office_info)){ if($office_info->fk_sales_rep_office == $user->FName.' '.$user->LName){ echo 'selected'; } } ?> value="<?= $user->FName.' '.$user->LName; ?>"><?= $user->FName.' '.$user->LName; ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Save Date</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control date_picker" name="save_date" id="" value="<?php if(isset($office_info)){ echo  $office_info->save_date; } ?>" />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Save By</label>
                </div>
                <div class="col-md-8">
                    <select id="save_by" name="save_by" data-customer-source="dropdown" class="input_select" >
                        <option value="">- Select -</option>
                        <?php foreach ($users as $user): ?>
                            <option <?php if(isset($office_info)){ if($office_info->save_by == $user->id){ echo 'selected'; } } ?> value="<?= $user->id; ?>"><?= $user->FName.' '.$user->LName; ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Cancellation Date</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="cancel_date" id="date_picker" value="<?php if(isset($office_info)){ echo  $office_info->cancel_date; } ?>" />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Cancellation Reason</label>
                </div>
                <div class="col-md-8">
                    <select id="cancel_reason" name="cancel_reason" data-customer-source="dropdown" class="input_select" >
                        <option <?php if(isset($office_info)){ if($office_info->save_by == ""){ echo 'selected'; } } ?> value="">Select</option>
                        <option <?php if(isset($office_info)){ if($office_info->save_by == 'DS'){ echo 'selected'; } } ?> value="DS">Dissatisfied with Service</option>
                        <option <?php if(isset($office_info)){ if($office_info->save_by == 'DS'){ echo 'selected'; } } ?> value="FH">Financial Hardship</option>
                        <option <?php if(isset($office_info)){ if($office_info->save_by == 'DS'){ echo 'selected'; } } ?> value="FC">Fulfilled Contract</option>
                        <option <?php if(isset($office_info)){ if($office_info->save_by == 'DS'){ echo 'selected'; } } ?> value="Moving">Moving</option>
                        <option <?php if(isset($office_info)){ if($office_info->save_by == 'DS'){ echo 'selected'; } } ?> value="NP">Non-Payment</option>
                        <option <?php if(isset($office_info)){ if($office_info->save_by == 'DS'){ echo 'selected'; } } ?> value="Paid BOC">Paid BOC</option>
                        <option <?php if(isset($office_info)){ if($office_info->save_by == 'DS'){ echo 'selected'; } } ?> value="PA">Passed Away</option>
                        <option <?php if(isset($office_info)){ if($office_info->save_by == 'DS'){ echo 'selected'; } } ?> value="SUC">Still Under Contruct</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-5">
                    <label for="sched_conflict"><span>Check for Schedule Conflict</span></label>
                </div>
                <div class="col-md-7">
                    <input type="checkbox" name="sched_conflict" value="1" id="sched_conflict" <?php if(isset($office_info)){ echo $office_info->sched_conflict == 1 ? 'checked': ''; } ?>>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Install Date</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control date_picker" name="install_date" id="" value="<?php if(isset($office_info)){ echo  $office_info->install_date; } ?>"/>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Tech Arrival Time</label>
                </div>
                <div class="col-md-8">
                    <div class="input-group bootstrap-timepicker timepicker">
                        <input id="tech_arrive_time" class="form-control timepicker" value="<?php if(isset($office_info)){ echo  $office_info->tech_arrive_time; } ?>" name="tech_arrive_time" data-provide="timepicker" data-template="modal" data-minute-step="1" data-modal-backdrop="true" type="text"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Tech Departure Time</label>
                </div>
                <div class="col-md-8">
                    <div class="input-group bootstrap-timepicker timepicker">
                        <input id="tech_depart_time" class="form-control timepicker" value="<?php if(isset($office_info)){ echo  $office_info->tech_depart_time; } ?>" name="tech_depart_time" data-provide="timepicker" data-template="modal" data-minute-step="1" data-modal-backdrop="true" type="text"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Pre-Install Survey</label>
                </div>
                <div class="col-md-8">
                    <select id="pre_install_survey" name="pre_install_survey" data-customer-source="dropdown" class="input_select" >
                        <option <?php if(isset($office_info)){ if($office_info->pre_install_survey == ""){ echo 'selected'; } } ?> value=""></option>
                        <option <?php if(isset($office_info)){ if($office_info->pre_install_survey == "Pass"){ echo 'selected'; } } ?> value="Pass">Pass</option>
                        <option <?php if(isset($office_info)){ if($office_info->pre_install_survey == "Fail"){ echo 'selected'; } } ?>value="Fail">Fail</option>
                        <option  <?php if(isset($office_info)){ if($office_info->pre_install_survey == "Pending"){ echo 'selected'; } } ?> value="Pending">Pending</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Post-Install Survey</label>
                </div>
                <div class="col-md-8">
                    <select id="post_install_survey" name="post_install_survey" data-customer-source="dropdown" class="input_select" >
                        <option <?php if(isset($office_info)){ if($office_info->post_install_survey == ""){ echo 'selected'; } } ?> value="">Select</option>
                        <option <?php if(isset($office_info)){ if($office_info->post_install_survey == "Pass"){ echo 'selected'; } } ?> value="Pass">Pass</option>
                        <option <?php if(isset($office_info)){ if($office_info->post_install_survey == "Fail"){ echo 'selected'; } } ?> value="Fail">Fail</option>
                        <option <?php if(isset($office_info)){ if($office_info->post_install_survey == "Pending"){ echo 'selected'; } } ?> value="Pending">Pending</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="rebate_offer"><span>Rebate Offered</span>
                </div>
                <div class="col-md-8">
                    <input type="checkbox" name="rebate_offer" value="1"  id="rebate_offer" <?php if(isset($office_info)){ echo $office_info->rebate_offer == 1 ? 'checked': ''; } ?>>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-3">
                    <label for="">Rebate Check # 1</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" name="rebate_check1" id="rebate_check1" value="<?php if(isset($office_info)){ echo  $office_info->rebate_check1; } ?>"/>
                </div>
                <div class="col-md-2">
                    <label for="">Amount $</label>
                </div>
                <div class="col-md-4">
                    <input type="number" class="form-control" name="rebate_check1_amt" id="rebate_check1_amt" value="<?php if(isset($office_info)){ echo  $office_info->rebate_check1_amt; } ?>"/>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-3">
                    <label for="">Rebate Check # 2</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" name="rebate_check2" id="rebate_check2" value="<?php if(isset($office_info)){ echo  $office_info->rebate_check2; } ?>"/>
                </div>
                <div class="col-md-2">
                    <label for="">Amount $</label>
                </div>
                <div class="col-md-4">
                    <input type="number" class="form-control" name="rebate_check2_amt" id="rebate_check2_amt" value="<?php if(isset($office_info)){ echo  $office_info->rebate_check2_amt; } ?>" />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Activation Fee</label>
                </div>
                <div class="col-md-8">
                    <select id="activation_fee" name="activation_fee" data-customer-source="dropdown" class="input_select">
                        <option selected="selected" value="0.000000">0.0000</option>
                        <option value="0.0000">0.00</option>
                        <option value="49.0000">49.00</option>
                        <option value="49.9500">49.95</option>
                        <option value="49.9900">49.99</option>
                        <option value="69.0000">69.00</option>
                        <option value="75.0000">75.00</option>
                        <option value="88.0000">88.00</option>
                        <option value="90.0000">90.00</option>
                        <option value="99.0000">99.00</option>
                        <option value="99.9900">99.99</option>
                        <option value="100.0000">100.00</option>
                        <option value="140.9900">140.99</option>
                        <option value="149.0000">149.00</option>
                        <option value="150.0000">150.00</option>
                        <option value="180.0000">180.00</option>
                        <option value="199.0000">199.00</option>
                        <option value="249.0000">249.00</option>
                        <option value="291.0000">291.00</option>
                        <option value="299.0000">299.00</option>
                        <option value="329.0000">329.00</option>
                        <option value="349.0000">349.00</option>
                        <option value="349.0100">349.01</option>
                        <option value="351.0100">351.01</option>
                        <option value="369.0000">369.00</option>
                        <option value="379.0000">379.00</option>
                        <option value="399.0000">399.00</option>
                        <option value="424.0000">424.00</option>
                        <option value="449.0000">449.00</option>
                        <option value="450.0000">450.00</option>
                        <option value="463.0000">463.00</option>
                        <option value="499.0000">499.00</option>
                        <option value="599.0000">599.00</option>
                        <option value="647.9900">647.99</option>
                        <option value="699.0000">699.00</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                </div>
                <div class="col-md-8">
                    <input type="radio" name="way_of_pay" value="None" <?php if(isset($office_info)){ echo $office_info->way_of_pay == 'None' || $office_info->way_of_pay == '' || $office_info->way_of_pay == 'Email' ? 'checked': ''; }else {echo 'checked'; } ?>  id="way_of_pay_none">
                    <label for="way_of_pay_none"><span>None</span></label>

                    <input type="radio" name="way_of_pay" value="Check" <?php if(isset($office_info)){ echo $office_info->way_of_pay == 'Check'? 'checked': ''; } ?>  id="way_of_pay_check">
                    <label for="way_of_pay_check"><span>Check</span></label>

                    <input type="radio" name="way_of_pay" value="Credit" <?php if(isset($office_info)){ echo $office_info->way_of_pay == 'Credit'? 'checked': ''; } ?>  id="way_of_pay_credit">
                    <label for="way_of_pay_credit"><span>Credit</span></label>

                    <input type="radio" name="way_of_pay" value="Paid" <?php if(isset($office_info)){ echo $office_info->way_of_pay == 'Paid'? 'checked': ''; } ?> id="way_of_pay_paid">
                    <label for="way_of_pay_paid"><span>Paid</span></label>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Lead Source</label>
                </div>
                <div class="col-md-8">
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
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">URL</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="url" id="url" value="<?php if(isset($office_info)){ echo  $office_info->url; } ?>" />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Verification:</label>
                </div>
                <div class="col-md-8">
                    <select id="verification" name="verification" data-customer-source="dropdown" class="input_select" >
                        <option <?php if(isset($office_info)){ if($office_info->verification == "TrunsUnion"){ echo 'selected'; } } ?> value="TrunsUnion">TrunsUnion</option>
                        <option <?php if(isset($office_info)){ if($office_info->verification == "Experian"){ echo 'selected'; } } ?>  value="Experian">Experian </option>
                        <option <?php if(isset($office_info)){ if($office_info->verification == "Equifax"){ echo 'selected'; } } ?>  value="Equifax ">Equifax  </option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Warranty Type</label>
                </div>
                <div class="col-md-8">
                    <select id="warranty_type" name="warranty_type" data-customer-source="dropdown" class="input_select" >
                        <option <?php if(isset($office_info)){ if($office_info->warranty_type == ""){ echo 'selected'; } } ?> value="">Select</option>
                        <option <?php if(isset($office_info)){ if($office_info->warranty_type == "Limited. 90 Days"){ echo 'selected'; } } ?> value="Limited. 90 Days">Limited. 90 Days</option>
                        <option <?php if(isset($office_info)){ if($office_info->warranty_type == "1 Year"){ echo 'selected'; } } ?>  value="1 Year">1 Year</option>
                        <option <?php if(isset($office_info)){ if($office_info->warranty_type == "$25 Trip"){ echo 'selected'; } } ?>  value="$25 Trip">$25 Trip</option>
                        <option <?php if(isset($office_info)){ if($office_info->warranty_type == "$50 Trip and $65 Deductible"){ echo 'selected'; } } ?>  value="$50 Trip and $65 Deductible">$50 Trip and $65 Deductible</option>
                        <option <?php if(isset($office_info)){ if($office_info->warranty_type == "Extended"){ echo 'selected'; } } ?>  value="Extended">Extended</option>
                        <option <?php if(isset($office_info)){ if($office_info->warranty_type == "None"){ echo 'selected'; } } ?>  value="None">None</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Custom Field 1</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="office_custom_field1" id="office_custom_field1" value="<?php if(isset($office_info)){ echo  $office_info->office_custom_field1; } ?>" />
                </div>
            </div>
        </div>
    </div>
</div>