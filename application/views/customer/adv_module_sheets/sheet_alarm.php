<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="tab-pane fade standard-accordion" id="alarm">
    <form id="alarm_form">
        <div class="row">
        <div class="col-sm-12">
            <div class="col-sm-12 text-right-sm" style="align:right;">
                <span class="text-ter" style="position: absolute; right: 83px !important; top: 8px;">Customize</span>
                <div class="onoffswitch grid-onoffswitch" style="position: relative; margin-top: 7px;">
                    <input type="checkbox" name="alarm_switch" class="onoffswitch-checkbox" data-customize="open" id="onoff-alarm">
                    <label class="onoffswitch-label" for="onoff-alarm">
                        <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Monitoring Company</label><br/>
                <input type="text" class="form-control" name="monitor_comp" id="monitor_comp" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Monitoring ID</label><br/>
                <input type="text" class="form-control" name="monitor_id" id="monitor_id" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Install Date</label><br/>
                <input type="text" class="form-control date_picker" name="install_date" id="install_date" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Credit Score</label><br/>
                <input type="text" class="form-control" name="credit_score" id="credit_score" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Account Type</label><br/>
                <input type="text" class="form-control" name="acct_type" id="acct_type" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Account Information</label><br/>
                <input type="text" class="form-control" name="acct_info" id="acct_info" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Abort/Password Code</label><br/>
                <input type="text" class="form-control" name="passcode" id="passcode" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Installer Code</label><br/>
                <input type="text" class="form-control" name="install_code" id="install_code" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Monitoring confirmation number</label><br/>
                <input type="text" class="form-control" name="mcn" id="mcn" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Signal confirmation number</label><br/>
                <input type="text" class="form-control" name="scn" id="scn" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Contact Name #1</label><br/>
                <input type="text" class="form-control" name="contact1" id="contact1" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Contact Name #2</label><br/>
                <input type="text" class="form-control" name="contact2" id="contact2" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Contact Name #3</label><br/>
                <input type="text" class="form-control" name="contact3" id="contact3" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Contact Name #4</label><br/>
                <input type="text" class="form-control" name="contact4" id="contact4" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Contact Name #5</label><br/>
                <input type="text" class="form-control" name="contact5" id="contact5" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Contact Name #6</label><br/>
                <input type="text" class="form-control" name="contact6" id="contact6" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Panel Type</label><br/>
                <input type="text" class="form-control" name="panel_type" id="panel_type" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">System Type</label><br/>
                <input type="text" class="form-control" name="system_type" id="system_type" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Monitoring Waived</label><br/>
                <input type="text" class="form-control" name="mon_waived" id="mon_waived" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Rebate Offered:</label><br/>
                <input type="text" class="form-control" name="rebate_offer" id="rebate_offer" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Verification:</label><br/>
                <select id="verification" name="verification" data-customer-source="dropdown" class="form-control searchable-dropdown" >
                    <option value="TrunsUnion">TrunsUnion</option>
                    <option value="Experian">Experian </option>
                    <option value="Equifax ">Equifax  </option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Rebate Check 1</label><br/>
                <input type="number" class="form-control" name="rebate_check1" id="rebate_check1" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Rebate Check 2</label><br/>
                <input type="number" class="form-control" name="rebate_check2" id="rebate_check2" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Warranty Type</label><br/>
                <input type="text" class="form-control" name="warranty_type" id="warranty_type" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Custom Field 1</label><br/>
                <input type="text" class="form-control" name="custom_field1" id="custom_field1" />
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