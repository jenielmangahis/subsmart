<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="tab-pane fade standard-accordion" id="account">
    <div class="row">
        <div class="col-sm-12">
            <div class="col-sm-12 text-right-sm" style="align:right;">
                <span class="text-ter" style="position: absolute; right: 83px !important; top: 8px;">Customize</span>
                <div class="onoffswitch grid-onoffswitch" style="position: relative; margin-top: 7px;">
                    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" data-customize="open" id="onoff-customize">
                    <label class="onoffswitch-label" for="onoff-customize">
                        <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span>
                    </label>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Entered By</label><br/>
                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Time Entered</label><br/>
                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Sales Date</label><br/>
                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Credit Score *</label><br/>
                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Monitoring Company *</label><br/>
                <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                    <option value="0">- none -</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Account Type *</label><br/>
                <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                    <option value="0">Select</option>
                    <option value="0">In-House</option>
                    <option value="0">Purchase</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Monitoring ID</label><br/>
                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Language</label><br/>
                <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                    <option value="0">Select</option>
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
                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Monitoring Confirmation </label><br/>
                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Abort Code</label><br/>
                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Sales Rep</label><br/>
                <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                    <option value="0">- none -</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Technician</label><br/>
                <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                    <option value="0">- none -</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Save Date</label><br/>
                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Save By</label><br/>
                <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                    <option value="0">- none -</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Cancellation Date</label><br/>
                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Cancellation Reason</label><br/>
                <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                    <option value="0">Select</option>
                    <option value="0">Dissatisfied with Service</option>
                    <option value="0">Financial Hardship</option>
                    <option value="0">Fulfilled Contract</option>
                    <option value="0">Moving</option>
                    <option value="0">Non-Payment</option>
                    <option value="0">Paid BOC</option>
                    <option value="0">Passed Away</option>
                    <option value="0">Still Under Contruct</option>
                </select>
            </div>
        </div>
        <div class="col-md-9"></div>
        <div class="col-md-3">
            <div class="checkbox checkbox-sec margin-right">
                <input type="checkbox" name="notify_by" value="Email" checked id="notify_by_email">
                <label for="notify_by_email"><span>Check for Schedule Conflict</span></label>
            </div>
        </div>
        <div class="col-md-9"></div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Install Date</label><br/>
                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Tech Arrival Time</label><br/>
                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Tech Departure Time</label><br/>
                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Panel Type *</label><br/>
                <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                    <option value="0">- none -</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Pre-Install Survey</label><br/>
                <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                    <option value="0">Select</option>
                    <option value="0">Pass</option>
                    <option value="0">Fail</option>
                    <option value="0">Pending</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Post-Install Survey</label><br/>
                <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                    <option value="0">Select</option>
                    <option value="0">Pass</option>
                    <option value="0">Fail</option>
                    <option value="0">Pending</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Monitoring Waived</label><br/>
                <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                    <option value="0">- none -</option>
                </select>
            </div>
        </div>
        <div class="col-md-3"></div>
        <div class="col-md-3">
            <div class="checkbox checkbox-sec margin-right">
                <input type="checkbox" name="notify_by" value="Email" checked id="notify_by_email">
                <label for="notify_by_email"><span>Rebate Offered</span></label>
            </div>
        </div>
        <div class="col-md-9"></div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Rebate Check # 1</label><br/>
                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Amount $</label><br/>
                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Rebate Check # 2</label><br/>
                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Amount $</label><br/>
                <input type="text" class="form-control" name="contact_name" id="contact_name" required/>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Activation Fee</label><br/>
                <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown">
                    <option value="0">- none -</option>
                </select>
            </div>
        </div>
        <div class="col-md-9">
            <div class="form-group" id="customer_type_group">
                <div class="checkbox checkbox-sec margin-right">
                    <input type="checkbox" name="notify_by" value="Email" checked id="notify_by_email">
                    <label for="notify_by_email"><span>None</span></label>
                </div>
                <div class="checkbox checkbox-sec margin-right">
                    <input type="checkbox" name="notify_by" value="Email" checked id="notify_by_email">
                    <label for="notify_by_email"><span>Check</span></label>
                </div>
                <div class="checkbox checkbox-sec margin-right">
                    <input type="checkbox" name="notify_by" value="Email" checked id="notify_by_email">
                    <label for="notify_by_email"><span>Credit</span></label>
                </div>
                <div class="checkbox checkbox-sec margin-right">
                    <input type="checkbox" name="notify_by" value="Email" checked id="notify_by_email">
                    <label for="notify_by_email"><span>Paid</span></label>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group" id="customer_type_group">
                <label for="">Lead Source</label><br/>
                <select id="customer_types" name="customer_types_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                    <option value="0">Select</option>
                    <option value="0">Customer Referral</option>
                    <option value="0">Door</option>
                    <option value="0">Door Hanger</option>
                    <option value="0">Flyer Mail Outs</option>
                    <option value="0">Outbound Calls</option>
                    <option value="0">Phone</option>
                    <option value="0">Radio Ad</option>
                    <option value="0">Social Media</option>
                    <option value="0">TV Ad</option>
                    <option value="0">Unknown</option>
                    <option value="0">Website</option>
                    <option value="0">Yard Sign</option>
                </select>
            </div>
        </div>

        <hr>
        <div class="col-sm-12">
            <div class="col-sm-12 text-right-sm" style="align:right;">
                <button type="submit" class="btn btn-flat btn-primary"><span class="fa fa-remove"></span> Cancel</button>
                <button type="submit" class="btn btn-flat btn-primary"><span class="fa fa-send"></span> Save</button>
            </div>
        </div>
    </div>
</div>