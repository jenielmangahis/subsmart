<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class=" module_ac" style="top: -610px;">
    <div class="row">
        <div class="col-md-12 module_header">
            <p class="module_title">Alarm Information</p>
        </div>
        <div class="col-sm-12" id="address_module">
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
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Monitoring Company</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="monitor_comp" id="monitor_comp" />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Monitoring ID</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="monitor_id" id="monitor_id" />
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
                    <label for="">Credit Score</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="credit_score_alarm" id="credit_score_alarm" />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Account Type</label>
                </div>
                <div class="col-md-8">
                    <select name="acct_type" id="acct_type" class="input_select">
                        <option value=""></option>
                        <option selected="selected" value="In-House">In-House</option>
                        <option value="Purchase">Purchase</option>

                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Account Information</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="acct_info" id="acct_info" />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Abort/Password Code</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="passcode" id="passcode" />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Installer Code</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="install_code" id="install_code" />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Monitoring Confirmation #</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="mcn" id="mcn" />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Signal Confirmation #</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="scn" id="scn" />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Contact Name #1 Phone</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="contact1" id="contact1" />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Contact Name #2 Phone</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="contact2" id="contact2" />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Contact Name #3 Phone</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="contact3" id="contact3" />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Contact Name #4 Phone</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="contact4" id="contact4" />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Contact Name #5 Phone</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="contact5" id="contact5" />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Panel Type</label>
                </div>
                <div class="col-md-8">
                    <select name="panel_type" id="panel_type" class="input_select">
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
                    <label for="">System Type</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="system_type" id="system_type" />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Monitoring Waived</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="mon_waived" id="mon_waived" />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                </div>
                <div class="col-md-8">
                </div>
            </div>
        </div>
    </div>
</div>