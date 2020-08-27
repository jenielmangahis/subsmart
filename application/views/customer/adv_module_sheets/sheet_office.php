<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="tab-pane fade standard-accordion" id="office">
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
            <div class="checkbox checkbox-sec margin-right">
                <input type="checkbox" name="notify_by" value="SMS" id="notify_by_sms">
                <label for="notify_by_sms"><span>Welcome kit Sent</span></label>
            </div>
        </div>
        <div class="col-md-9"></div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-3">
                    <div class="checkbox checkbox-sec margin-right">
                        <input type="checkbox" name="notify_by" value="SMS" id="notify_by_sms">
                        <label for="notify_by_sms"><span>Rebate Received</span></label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="checkbox checkbox-sec margin-right">
                        <input type="checkbox" name="notify_by" value="SMS" id="notify_by_sms">
                        <label for="notify_by_sms"><span>Rebate Paid</span></label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <label for="">Commision Scheme Override</label><br/>
            <div class="checkbox checkbox-sec margin-right">
                <input type="checkbox" name="notify_by" value="SMS" id="notify_by_sms">
                <label for="notify_by_sms"><span>On</span></label>
            </div>
            <div class="checkbox checkbox-sec margin-right">
                <input type="checkbox" name="notify_by" value="SMS" id="notify_by_sms">
                <label for="notify_by_sms"><span>Off</span></label>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Rep Commission $</label><br/>
                <input type="number" class="form-control" name="contact_name" id="contact_name" required/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Rep Upfront Pay</label><br/>
                <input type="number" class="form-control" name="contact_name" id="contact_name" required/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Tech Commission $</label><br/>
                <input type="number" class="form-control" name="contact_name" id="contact_name" required/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Tech Upfront Pay $</label><br/>
                <input type="number" class="form-control" name="contact_name" id="contact_name" required/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Rep Tiered Upfront Bonus</label><br/>
                <i>$0.00</i>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Rep Tiered Holdfund Bonus</label><br/>
                <i>$0.00</i>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Rep Deductions Total</label><br/>
                <i>$0.00</i>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Tech Deductions Total</label><br/>
                <i>$0.00</i>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Rep Hold Fund Charge Back $</label><br/>
                <input type="number" class="form-control" name="contact_name" id="contact_name" required/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Rep Payroll Charge Back $</label><br/>
                <input type="number" class="form-control" name="contact_name" id="contact_name" required/>
            </div>
        </div>
        <div class="col-md-6"></div>
        <div class="col-md-12">
            <label for="">Points Scheme Override</label><br/>
            <div class="checkbox checkbox-sec margin-right">
                <input type="checkbox" name="notify_by" value="SMS" id="notify_by_sms">
                <label for="notify_by_sms"><span>On</span></label>
            </div>
            <div class="checkbox checkbox-sec margin-right">
                <input type="checkbox" name="notify_by" value="SMS" id="notify_by_sms">
                <label for="notify_by_sms"><span>Off</span></label>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Points Included</label><br/>
                <input type="number" class="form-control" name="contact_name" id="contact_name" required/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Price Per Point $</label><br/>
                <input type="number" class="form-control" name="contact_name" id="contact_name" required/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Purchase Price $</label><br/>
                <input type="number" class="form-control" name="contact_name" id="contact_name" required/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Purchase Multiple</label><br/>
                <input type="number" class="form-control" name="contact_name" id="contact_name" required/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Purchase Discount $</label><br/>
                <input type="number" class="form-control" name="contact_name" id="contact_name" required/>
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