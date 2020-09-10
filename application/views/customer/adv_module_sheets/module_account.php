<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class=" module_ac">
    <div class="row">
        <div class="col-md-12 module_header">
            <p class="module_title">Account Information</p>
        </div>
        <div class="col-sm-12" id="account_module">
            <div class="col-sm-12 text-right-sm" style="align:right;">
                <span class="text-ter" style="position: absolute; right: 83px !important; top: 8px;">Customize</span>
                <div class="onoffswitch grid-onoffswitch" style="position: relative; margin-top: 7px;">
                    <input type="checkbox" name="office_switch" class="onoffswitch-checkbox" data-customize="open" id="onoff-acct">
                    <label class="onoffswitch-label" for="onoff-acct">
                        <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span>
                    </label>
                </div>
            </div>
            <div class="col-md-12 form-line">
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Entered By</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="entered_by" id="entered_by" />
                    </div>
                </div>
            </div>
            <div class="col-md-12 form-line">
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Time Entered</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="time_entered" id="time_entered" />
                    </div>
                </div>
            </div>
            <div class="col-md-12 form-line">
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Sales Date</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control date_picker" name="sales_date" id="sales_date" />
                    </div>
                </div>
            </div>
            <div class="col-md-12 form-line">
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Credit Score </label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="credit_score" id="credit_score" />
                    </div>
                </div>
            </div>
            <div class="col-md-12 form-line">
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Monitoring Company </label>
                    </div>
                    <div class="col-md-8">
                        <select id="mon_comp" name="mon_comp" data-customer-source="dropdown" class="form-control searchable-dropdown" >
                            <option value=""></option>
                            <option value="1">Brinks Home Security</option>
                            <option value="0">CCTV ONLY</option>
                            <option value="1101">CMS</option>
                            <option selected="selected" value="1102">Other</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-12 form-line">
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Account Type </label>
                    </div>
                    <div class="col-md-8">
                        <select id="acct_type" name="acct_type" data-customer-source="dropdown" class="form-control searchable-dropdown" >
                            <option value="">Select</option>
                            <option value="In-House">In-House</option>
                            <option value="Purchase">Purchase</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-12 form-line">
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Monitoring ID</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="mon_id" id="mon_id" />
                    </div>
                </div>
            </div>
            <div class="col-md-12 form-line">
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Language</label>
                    </div>
                    <div class="col-md-8">
                        <select id="language" name="language" data-customer-source="dropdown" class="form-control searchable-dropdown">
                            <option value="">Select</option>
                            <option value="English">English</option>
                            <option value="Spanish">Spanish</option>
                            <option value="Mandarin Chinese">Mandarin Chinese</option>
                            <option value="French">French</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-12 form-line">
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Signal Confirmation #</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="signal_confirm_num" id="signal_confirm_num" />
                    </div>
                </div>
            </div>
            <div class="col-md-12 form-line">
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Monitoring Confirmation </label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="mon_confirmation" id="mon_confirmation" />
                    </div>
                </div>
            </div>
            <div class="col-md-12 form-line">
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Abort Code</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="abort_code" id="abort_code" />
                    </div>
                </div>
            </div>
            <div class="col-md-12 form-line">
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Sales Rep</label>
                    </div>
                    <div class="col-md-8">
                        <select id="sales_rep" name="sales_rep" data-customer-source="dropdown" class="form-control searchable-dropdown" >
                            <option value="">Select</option>
                            <?php foreach ($sales_area as $sa): ?>
                                <option value="<?= $sa->sa_id; ?>"><?= $sa->sa_name; ?></option>
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
                        <select id="technician" name="technician" data-customer-source="dropdown" class="form-control searchable-dropdown" >
                            <option value="">- Select -</option>
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
                        <input type="text" class="form-control date_picker" name="save_date" id="save_date" />
                    </div>
                </div>
            </div>
            <div class="col-md-12 form-line">
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Save By</label>
                    </div>
                    <div class="col-md-8">
                        <select id="save_by" name="save_by" data-customer-source="dropdown" class="form-control searchable-dropdown" >
                            <option value="">- Select -</option>
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
                        <input type="text" class="form-control date_picker" name="cancel_date" id="cancel_date" />
                    </div>
                </div>
            </div>
            <div class="col-md-12 form-line">
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Cancellation Reason</label>
                    </div>
                    <div class="col-md-8">
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
            </div>
            <div class="col-md-12 form-line">
                <div class="row">
                    <div class="col-md-5">
                        <label for="sched_conflict"><span>Check for Schedule Conflict</span></label>
                    </div>
                    <div class="col-md-7">
                        <input type="checkbox" name="sched_conflict" value="Email" checked id="sched_conflict">
                    </div>
                </div>
            </div>
            <div class="col-md-12 form-line">
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Install Date</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control date_picker" name="install_date" id="install_date" />
                    </div>
                </div>
            </div>
            <div class="col-md-12 form-line">
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Tech Arrival Time</label>
                    </div>
                    <div class="col-md-8">
                        <select id="tech_arrive_time" name="tech_arrive_time" data-customer-source="dropdown" class="form-control searchable-dropdown">
                            <option value=""></option>
                            <option value="7AM">7:00 AM</option>
                            <option value="7.5AM">7:30 AM</option>
                            <option selected="selected" value="8AM">8:00 AM</option>
                            <option value="8.5AM">8:30 AM</option>
                            <option value="9AM">9:00 AM</option>
                            <option value="9.5AM">9:30 AM</option>
                            <option value="10AM">10:00 AM</option>
                            <option value="10.5AM" disabled="disabled">10:30 AM</option>
                            <option value="11AM" disabled="disabled">11:00 AM</option>
                            <option value="11.5AM" disabled="disabled">11:30 AM</option>
                            <option value="12PM" disabled="disabled">12:00 PM</option>
                            <option value="12.5PM" disabled="disabled">12:30 PM</option>
                            <option value="1PM" disabled="disabled">1:00 PM</option>
                            <option value="1.5PM" disabled="disabled">1:30 PM</option>
                            <option value="2PM" disabled="disabled">2:00 PM</option>
                            <option value="2.5PM" disabled="disabled">2:30 PM</option>
                            <option value="3PM" disabled="disabled">3:00 PM</option>
                            <option value="3.5PM" disabled="disabled">3:30 PM</option>
                            <option value="4PM" disabled="disabled">4:00 PM</option>
                            <option value="4.5PM" disabled="disabled">4:30 PM</option>
                            <option value="5PM" disabled="disabled">5:00 PM</option>
                            <option value="5.5PM" disabled="disabled">5:30 PM</option>
                            <option value="6PM" disabled="disabled">6:00 PM</option>
                            <option value="6.5PM" disabled="disabled">6:30 PM</option>
                            <option value="7PM" disabled="disabled">7:00 PM</option>
                            <option value="7.5PM" disabled="disabled">7:30 PM</option>
                            <option value="8PM" disabled="disabled">8:00 PM</option>
                            <option value="8.5PM" disabled="disabled">8:30 PM</option>
                            <option value="9PM" disabled="disabled">9:00 PM</option>
                            <option value="9.5PM" disabled="disabled">9:30 PM</option>
                            <option value="10PM" disabled="disabled">10:00 PM</option>
                            <option value="10.5PM" disabled="disabled">10:30 PM</option>
                            <option value="11PM" disabled="disabled">11:00 PM</option>
                            <option value="11.5PM" disabled="disabled">11:30 PM</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-12 form-line">
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Tech Departure Time</label>
                    </div>
                    <div class="col-md-8">
                        <select id="tech_depart_time" name="tech_depart_time" data-customer-source="dropdown" class="form-control searchable-dropdown">
                            <option value=""></option>
                            <option value="7AM">7:00 AM</option>
                            <option value="7.5AM">7:30 AM</option>
                            <option selected="selected" value="8AM">8:00 AM</option>
                            <option value="8.5AM">8:30 AM</option>
                            <option value="9AM">9:00 AM</option>
                            <option value="9.5AM">9:30 AM</option>
                            <option value="10AM">10:00 AM</option>
                            <option value="10.5AM" disabled="disabled">10:30 AM</option>
                            <option value="11AM" disabled="disabled">11:00 AM</option>
                            <option value="11.5AM" disabled="disabled">11:30 AM</option>
                            <option value="12PM" disabled="disabled">12:00 PM</option>
                            <option value="12.5PM" disabled="disabled">12:30 PM</option>
                            <option value="1PM" disabled="disabled">1:00 PM</option>
                            <option value="1.5PM" disabled="disabled">1:30 PM</option>
                            <option value="2PM" disabled="disabled">2:00 PM</option>
                            <option value="2.5PM" disabled="disabled">2:30 PM</option>
                            <option value="3PM" disabled="disabled">3:00 PM</option>
                            <option value="3.5PM" disabled="disabled">3:30 PM</option>
                            <option value="4PM" disabled="disabled">4:00 PM</option>
                            <option value="4.5PM" disabled="disabled">4:30 PM</option>
                            <option value="5PM" disabled="disabled">5:00 PM</option>
                            <option value="5.5PM" disabled="disabled">5:30 PM</option>
                            <option value="6PM" disabled="disabled">6:00 PM</option>
                            <option value="6.5PM" disabled="disabled">6:30 PM</option>
                            <option value="7PM" disabled="disabled">7:00 PM</option>
                            <option value="7.5PM" disabled="disabled">7:30 PM</option>
                            <option value="8PM" disabled="disabled">8:00 PM</option>
                            <option value="8.5PM" disabled="disabled">8:30 PM</option>
                            <option value="9PM" disabled="disabled">9:00 PM</option>
                            <option value="9.5PM" disabled="disabled">9:30 PM</option>
                            <option value="10PM" disabled="disabled">10:00 PM</option>
                            <option value="10.5PM" disabled="disabled">10:30 PM</option>
                            <option value="11PM" disabled="disabled">11:00 PM</option>
                            <option value="11.5PM" disabled="disabled">11:30 PM</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-12 form-line">
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Panel Type </label>
                    </div>
                    <div class="col-md-8">
                        <select id="panel_type" name="panel_type" data-customer-source="dropdown" class="form-control searchable-dropdown">
                            <option value=""></option>
                            <option selected="selected" value="DIGI">Landline</option>
                            <option value="DW2W">Landline W/ 2-Way</option>
                            <option value="DWCB">Landline W/ Cell Backup</option>
                            <option value="D2CB">Landline W/ 2-Way &amp; Cell Backup</option>
                            <option value="CPDB">Cell Primary</option>
                            <option value="CP2W">Cell Primary w/2Way</option>

                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-12 form-line">
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Pre-Install Survey</label>
                    </div>
                    <div class="col-md-8">
                        <select id="pre_install_survey" name="pre_install_survey" data-customer-source="dropdown" class="form-control searchable-dropdown" >
                            <option value=""></option>
                            <option value="Pass">Pass</option>
                            <option value="Fail">Fail</option>
                            <option value="Pending">Pending</option>
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
                        <select id="post_install_survey" name="post_install_survey" data-customer-source="dropdown" class="form-control searchable-dropdown" >
                            <option value="">Select</option>
                            <option value="Pass">Pass</option>
                            <option value="Fail">Fail</option>
                            <option value="Pending">Pending</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-12 form-line">
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Monitoring Waived</label>
                    </div>
                    <div class="col-md-8">
                        <select id="mon_waived" name="mon_waived" data-customer-source="dropdown" class="form-control searchable-dropdown" >
                            <option selected="selected" value="0"></option>
                            <option value="1">1 Month</option>
                            <option value="2">2 Months</option>
                            <option value="3">3 Months</option>
                            <option value="4">4 Month</option>
                            <option value="5">5 Months</option>
                            <option value="6">6 Months</option>
                            <option value="7">7 Month</option>
                            <option value="8">8 Months</option>
                            <option value="9">9 Months</option>
                            <option value="10">10 Month</option>
                            <option value="11">11 Months</option>
                            <option value="12">12 Months</option>
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
                        <input type="checkbox" name="rebate_offer" value="1" id="rebate_offer">
                    </div>
                </div>
            </div>
            <div class="col-md-12 form-line">
                <div class="row">
                    <div class="col-md-3">
                        <label for="">Rebate Check # 1</label>
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="rebate_check1" id="rebate_check1" />
                    </div>
                    <div class="col-md-2">
                        <label for="">Amount $</label>
                    </div>
                    <div class="col-md-4">
                        <input type="number" class="form-control" name="amount1" id="amount1" />
                    </div>
                </div>
            </div>
            <div class="col-md-12 form-line">
                <div class="row">
                    <div class="col-md-3">
                        <label for="">Rebate Check # 2</label>
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="rebate_check2" id="rebate_check2" />
                    </div>
                    <div class="col-md-2">
                        <label for="">Amount $</label>
                    </div>
                    <div class="col-md-4">
                        <input type="number" class="form-control" name="amount2" id="amount2" />
                    </div>
                </div>
            </div>
            <div class="col-md-12 form-line">
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Activation Fee</label>
                    </div>
                    <div class="col-md-8">
                        <select id="activation_fee" name="activation_fee" data-customer-source="dropdown" class="form-control searchable-dropdown">
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
                        <input type="radio" name="way_of_pay[]" value="Email" checked  id="way_of_pay_none">
                        <label for="way_of_pay_none"><span>None</span></label>

                        <input type="radio" name="way_of_pay[]" value="Check"  id="way_of_pay_check">
                        <label for="way_of_pay_check"><span>Check</span></label>

                        <input type="radio" name="way_of_pay[]" value="Credit"  id="way_of_pay_credit">
                        <label for="way_of_pay_credit"><span>Credit</span></label>

                        <input type="radio" name="way_of_pay[]" value="Paid" id="way_of_pay_paid">
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
            </div>
        </div>

    </div>
</div>