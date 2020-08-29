<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="tab-pane fade standard-accordion" id="account">
    <form id="account_form">
    <div class="row">
        <div class="col-sm-12">
            <div class="col-sm-12 text-right-sm" style="align:right;">
                <span class="text-ter" style="position: absolute; right: 83px !important; top: 8px;">Customize</span>
                <div class="onoffswitch grid-onoffswitch" style="position: relative; margin-top: 7px;">
                    <input type="checkbox" name="account_switch" class="onoffswitch-checkbox" data-customize="open" id="onoff-account">
                    <label class="onoffswitch-label" for="onoff-account">
            <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span>
            </label>
        </div>
    </div>
</div>

<div class="col-md-3">
    <div class="form-group" id="customer_type_group">
        <label for="">Entered By</label><br/>
        <input type="text" class="form-control" name="entered_by" id="entered_by" required/>
    </div>
</div>
<div class="col-md-3">
    <div class="form-group" id="customer_type_group">
        <label for="">Time Entered</label><br/>
        <input type="text" class="form-control" name="time_entered" id="time_entered" required/>
    </div>
</div>
<div class="col-md-3">
    <div class="form-group" id="customer_type_group">
        <label for="">Sales Date</label><br/>
        <input type="text" class="form-control date_picker" name="sales_date" id="sales_date" required/>
            </div>
        </div>
        <div class="col-md-3">
                    <div class="form-group" id="customer_type_group">
                        <label for="">Credit Score </label><br/>
                        <input type="text" class="form-control" name="credit_score" id="credit_score" />
                    </div>
            </div>
            <div class="col-md-3">
                <div class="form-group" id="customer_type_group">
                    <label for="">Monitoring Company </label><br/>
                    <select id="mon_comp" name="mon_comp" data-customer-source="dropdown" class="form-control searchable-dropdown" >
                        <option value=""></option>
                        <option value="1">Brinks Home Security</option>
                        <option value="0">CCTV ONLY</option>
                        <option value="1101">CMS</option>
                        <option selected="selected" value="1102">Other</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group" id="customer_type_group">
                    <label for="">Account Type </label><br/>
                    <select id="acct_type" name="acct_type" data-customer-source="dropdown" class="form-control searchable-dropdown" >
                        <option value="">Select</option>
                        <option value="In-House">In-House</option>
                    <option value="Purchase">Purchase</option>
                </select>
            </div>-
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Monitoring ID</label><br/>
                <input type="text" class="form-control" name="mon_id" id="mon_id" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Language</label><br/>
                <select id="language" name="language" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                    <option value="">Select</option>
                    <option value="English">English</option>
                    <option value="Spanish">Spanish</option>
                    <option value="Mandarin Chinese">Mandarin Chinese</option>
                    <option value="French">French</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Signal Confirmation Number</label><br/>
                <input type="text" class="form-control" name="signal_confirm_num" id="signal_confirm_num" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Monitoring Confirmation </label><br/>
                <input type="text" class="form-control" name="mon_confirmation" id="mon_confirmation" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Abort Code</label><br/>
                <input type="text" class="form-control" name="abort_code" id="abort_code" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Sales Rep</label><br/>
                <select id="sales_rep" name="sales_rep" data-customer-source="dropdown" class="form-control searchable-dropdown" >
                    <option value="">Select</option>
                    <?php foreach ($sales_area as $sa): ?>
                        <option value="<?= $sa->sa_id; ?>"><?= $sa->sa_name; ?></option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Technician</label><br/>
                <select id="technician" name="technician" data-customer-source="dropdown" class="form-control searchable-dropdown" >
                    <option value="">- Select -</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Save Date</label><br/>
                <input type="text" class="form-control date_picker" name="save_date" id="save_date" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Save By</label><br/>
                <select id="save_by" name="save_by" data-customer-source="dropdown" class="form-control searchable-dropdown" >
                    <option value="">- Select -</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Cancellation Date</label><br/>
                <input type="text" class="form-control date_picker" name="cancel_date" id="cancel_date" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Cancellation Reason</label><br/>
                <select id="cancel_reason" name="cancel_reason" data-customer-source="dropdown" class="form-control searchable-dropdown" >
                    <option value="">Select</option>
                    <option value="Dissatisfied with Service">Dissatisfied with Service</option>
                    <option value="Financial Hardship">Financial Hardship</option>
                    <option value="Fulfilled Contract">Fulfilled Contract</option>
                    <option value="Moving">Moving</option>
                    <option value="Non-Payment">Non-Payment</option>
                    <option value="Paid BOC">Paid BOC</option>
                    <option value="Passed Away">Passed Away</option>
                    <option value="Still Under Contruct">Still Under Contruct</option>
                </select>
            </div>
        </div>
        <div class="col-md-9"></div>
        <div class="col-md-3">
            <div class="checkbox checkbox-sec margin-right">
                <input type="checkbox" name="sched_conflict" value="Email" checked id="sched_conflict">
                <label for="sched_conflict"><span>Check for Schedule Conflict</span></label>
            </div>
        </div>
        <div class="col-md-9"></div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Install Date</label><br/>
                <input type="text" class="form-control date_picker" name="install_date" id="install_date" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Tech Arrival Time</label><br/>
                <input type="text" class="form-control" name="tech_arrive_time" id="tech_arrive_time" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Tech Departure Time</label><br/>
                <input type="text" class="form-control" name="tech_depart_time" id="tech_depart_time" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Panel Type </label><br/>
                <select id="panel_type" name="panel_type" data-customer-source="dropdown" class="form-control searchable-dropdown">
                    <option value="">- Select -</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Pre-Install Survey</label><br/>
                <select id="pre_install_survey" name="pre_install_survey" data-customer-source="dropdown" class="form-control searchable-dropdown" >
                    <option value="">Select</option>
                    <option value="Pass">Pass</option>
                    <option value="Fail">Fail</option>
                    <option value="Pending">Pending</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Post-Install Survey</label><br/>
                <select id="post_install_survey" name="post_install_survey" data-customer-source="dropdown" class="form-control searchable-dropdown" >
                    <option value="">Select</option>
                    <option value="Pass">Pass</option>
                    <option value="Fail">Fail</option>
                    <option value="Pending">Pending</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Monitoring Waived</label><br/>
                <select id="mon_waived" name="mon_waived" data-customer-source="dropdown" class="form-control searchable-dropdown" >
                    <option value="0">- Select -</option>
                </select>
            </div>
        </div>
        <div class="col-md-3"></div>
        <div class="col-md-3">
            <div class="checkbox checkbox-sec margin-right">
                <input type="checkbox" name="rebate_offer" value="Email" checked id="rebate_offer">
                <label for="rebate_offer"><span>Rebate Offered</span></label>
            </div>
        </div>
        <div class="col-md-9"></div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Rebate Check # 1</label><br/>
                <input type="text" class="form-control" name="rebate_check1" id="rebate_check1" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Amount $</label><br/>
                <input type="number" class="form-control" name="amount1" id="amount1" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Rebate Check # 2</label><br/>
                <input type="text" class="form-control" name="rebate_check2" id="rebate_check2" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Amount $</label><br/>
                <input type="number" class="form-control" name="amount2" id="amount2" />
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Activation Fee</label><br/>
                <select id="activation_fee" name="activation_fee" data-customer-source="dropdown" class="form-control searchable-dropdown">
                    <option value="">- Select -</option>
                </select>
            </div>
        </div>
        <div class="col-md-9">
            <div class="form-group" id="customer_type_group">
                <div class="checkbox checkbox-sec margin-right">
                    <input type="radio" name="way_of_pay[]" value="Email" checked id="way_of_pay_none">
                    <label for="way_of_pay_none"><span>None</span></label>
                </div>
                <div class="checkbox checkbox-sec margin-right">
                    <input type="radio" name="way_of_pay[]" value="Check" checked id="way_of_pay_check">
                    <label for="way_of_pay_check"><span>Check</span></label>
                </div>
                <div class="checkbox checkbox-sec margin-right">
                    <input type="radio" name="way_of_pay[]" value="Credit" checked id="way_of_pay_credit">
                    <label for="way_of_pay_credit"><span>Credit</span></label>
                </div>
                <div class="checkbox checkbox-sec margin-right">
                    <input type="radio" name="way_of_pay[]" value="Paid" id="way_of_pay_paid">
                    <label for="way_of_pay_paid"><span>Paid</span></label>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group" id="customer_type_group">
                <label for="">Lead Source</label><br/>
                <select id="lead_source" name="lead_source" data-customer-source="dropdown" class="form-control searchable-dropdown">
                    <option value="">Select</option>
                    <option value="Customer Referral">Customer Referral</option>
                    <option value="Door">Door</option>
                    <option value="Door Hanger">Door Hanger</option>
                    <option value="Flyer Mail Outs">Flyer Mail Outs</option>
                    <option value="Outbound Calls">Outbound Calls</option>
                    <option value="Phone">Phone</option>
                    <option value="Radio Ad">Radio Ad</option>
                    <option value="Social Media">Social Media</option>
                    <option value="TV Ad">TV Ad</option>
                    <option value="Unknown">Unknown</option>
                    <option value="Website">Website</option>
                    <option value="Yard Sign">Yard Sign</option>
                </select>
            </div>
        </div>
        <hr>
        <div class="col-sm-12">
            <div class="col-md-1" style="display: none;">
                <div class="form-group" id="customer_type_group">
                    <input type="text" class="form-control" name="fk_prof_id" id="fk_prof_id" value="<?php if(isset($profile_info->prof_id)){ echo $profile_info->prof_id; } ?>">
                </div>
            </div>
            <div class="col-sm-12 text-right-sm" style="align:right;">
                <button type="submit" class="btn btn-flat btn-primary"><span class="fa fa-send"></span> Save</button>
            </div>
        </div>
    </div>
    </form>
</div>