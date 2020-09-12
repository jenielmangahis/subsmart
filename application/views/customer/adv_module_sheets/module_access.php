<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class=" module_ac" >
    <div class="row">
        <div class="col-md-12 module_header">
            <p class="module_title">Access Information</p>
        </div>
        <div class="col-sm-12" id="access_module">
            <div class="col-sm-12 text-right-sm" style="align:right;">
                <span class="text-ter" style="position: absolute; right: 83px !important; top: 8px;">Customize</span>
                <div class="onoffswitch grid-onoffswitch" style="position: relative; margin-top: 7px;">
                    <input type="checkbox" name="tech_switch" class="onoffswitch-checkbox" data-customize="open" id="onoff-access">
                    <label class="onoffswitch-label" for="onoff-access">
                        <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Portal Status (on/off)</label>
                </div>
                <div class="col-md-8">
                    <input type="radio" name="portal_status" value="1" id="portal_status1" checked >
                    <label for="portal_status1"><span>On</span></label>

                    <input type="radio" name="portal_status" value="0"  id="portal_status">
                    <label for="rebate"><span>Off</span></label>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Reset Password (Button)</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="reset_password" id="reset_password" />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Login</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="login" id="login" />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Password</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="password" id="password" />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Custom Field 1</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="acs_custom_field1" id="acs_custom_field1" />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Custom Field 2</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="acs_custom_field2" id="acs_custom_field2" />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Cancellation Date</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control date_picker" name="acs_cancel_date" id="acs_cancel_date" />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Collection Date</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control date_picker" name="acs_collect_date" id="acs_collect_date" />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Cancellation Reason</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="acs_cancel_reason" id="acs_cancel_reason" />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Collection Amount</label>
                </div>
                <div class="col-md-8">
                    <input type="number" class="form-control" name="collect_amount" id="collect_amount" />
                </div>
            </div>
        </div>
    </div>
</div>