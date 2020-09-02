<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="tab-pane fade standard-accordion" id="access">
    <form id="access_form">
        <div class="row">
            <div class="col-sm-12">
                <div class="col-sm-12 text-right-sm" style="align:right;">
                    <span class="text-ter" style="position: absolute; right: 83px !important; top: 8px;">Customize</span>
                    <div class="onoffswitch grid-onoffswitch" style="position: relative; margin-top: 7px;">
                        <input type="checkbox" name="access_switch" class="onoffswitch-checkbox" data-customize="open" id="onoff-access">
                        <label class="onoffswitch-label" for="onoff-access">
                            <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span>
                        </label>
                    </div>
                </div>
            </div>
        <div class="col-md-6">
            <label for="">Portal Status (on/off)</label><br/>
            <div class="row">
                <div class="col-md-3">
                    <div class="checkbox checkbox-sec margin-right">
                        <input type="radio" name="portal_status[]" value="1" id="portal_status1" checked required>
                        <label for="portal_status1"><span>On</span></label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="checkbox checkbox-sec margin-right">
                        <input type="radio" name="portal_status[]" value="0"  id="portal_status">
                        <label for="rebate"><span>Off</span></label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group" id="customer_type_group">
                <label for="">Reset Password (Button)</label><br/>
                <input type="text" class="form-control" name="reset_password" id="reset_password" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group" id="customer_type_group">
                <label for="">Login</label><br/>
                <input type="text" class="form-control" name="login" id="login" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group" id="customer_type_group">
                <label for="">Password</label><br/>
                <input type="text" class="form-control" name="password" id="password" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group" id="customer_type_group">
                <label for="">Custom Field 1</label><br/>
                <input type="text" class="form-control" name="custom_field1" id="custom_field1" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group" id="customer_type_group">
                <label for="">Custom Field 2</label><br/>
                <input type="text" class="form-control" name="custom_field2" id="custom_field2" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group" id="customer_type_group">
                <label for="">Cancellation Date</label><br/>
                <input type="text" class="form-control date_picker" name="cancel_date" id="cancel_date" required/>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group" id="customer_type_group">
                <label for="">Collection Date</label><br/>
                <input type="text" class="form-control date_picker" name="collect_date" id="collect_date" required/>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group" id="customer_type_group">
                <label for="">Cancellation Reason</label><br/>
                <input type="text" class="form-control" name="cancel_reason" id="cancel_reason" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group" id="customer_type_group">
                <label for="">Collection Amount</label><br/>
                <input type="number" class="form-control" name="collect_amount" id="collect_amount" />
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