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
                    <input type="text" class="form-control" name="monitor_comp" id="monitor_comp" value="<?php if(isset($alarm_info)){ echo $alarm_info->monitor_comp; } ?>"/>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Monitoring ID</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="monitor_id" id="monitor_id" value="<?php if(isset($alarm_info)){ echo $alarm_info->monitor_id != 0 ? $alarm_info->monitor_id : '' ; } ?>"/>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Install Date</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control date_picker" name="install_date" id="install_date" value="<?php if(isset($alarm_info)){ echo $alarm_info->install_date; } ?>"/>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Credit Score</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="credit_score_alarm" id="credit_score_alarm" value="<?php if(isset($alarm_info)){ echo $alarm_info->credit_score_alarm !=0 ?$alarm_info->credit_score_alarm : '' ; } ?>"/>
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
                        <option <?php if(isset($alarm_info)){ if($alarm_info->acct_type == ''){echo "selected";} } ?> value=""></option>
                        <option <?php if(isset($alarm_info)){ if($alarm_info->acct_type == 'In-House'){echo "selected";} } ?> value="In-House">In-House</option>
                        <option <?php if(isset($alarm_info)){ if($alarm_info->acct_type == 'Purchase'){echo "selected";} } ?> value="Purchase">Purchase</option>

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
                    <input type="text" class="form-control" name="acct_info" id="acct_info" value="<?php if(isset($alarm_info)){ echo $alarm_info->acct_info; } ?>"/>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Abort/Password Code</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="passcode" id="passcode" value="<?php if(isset($alarm_info)){ echo $alarm_info->passcode; } ?>"/>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Installer Code</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="install_code" id="install_code" value="<?php if(isset($alarm_info)){ echo $alarm_info->install_code!=0 ?  $alarm_info->install_code : ''; } ?>"/>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Monitoring Confirmation #</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="mcn" id="mcn" value="<?php if(isset($alarm_info)){ echo $alarm_info->mcn !=0 ? $alarm_info->mcn : ''; } ?>"/>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Signal Confirmation #</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="scn" id="scn" value="<?php if(isset($alarm_info)){ echo $alarm_info->scn !=0 ? $alarm_info->scn : ''; } ?>"/>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Contact Phone 1</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="contact1" id="contact1" value="<?php if(isset($alarm_info)){ echo $alarm_info->contact1; } ?>"/>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Contact Name 1</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="contact_name1" id="contact_name1" value="<?php if(isset($alarm_info)){ echo $alarm_info->contact_name1; } ?>"/>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Contact Phone 2</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="contact2" id="contact2" value="<?php if(isset($alarm_info)){ echo $alarm_info->contact2; } ?>"/>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Contact Name 2</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="contact_name2" id="contact_name2" value="<?php if(isset($alarm_info)){ echo $alarm_info->contact_name2; } ?>"/>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Contact Phone 3</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="contact3" id="contact3" value="<?php if(isset($alarm_info)){ echo $alarm_info->contact3; } ?>"/>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Contact Name 3</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="contact_name3" id="contact_name3" value="<?php if(isset($alarm_info)){ echo $alarm_info->contact_name3; } ?>" />
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
                        <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == ''){echo "selected";} } ?> value=""></option>
                        <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'DIGI'){echo "selected";} } ?> value="DIGI">Landline</option>
                        <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'DW2W'){echo "selected";} } ?> value="DW2W">Landline W/ 2-Way</option>
                        <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'DWCB'){echo "selected";} } ?> value="DWCB">Landline W/ Cell Backup</option>
                        <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'D2CB'){echo "selected";} } ?> value="D2CB">Landline W/ 2-Way &amp; Cell Backup</option>
                        <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'CPDB'){echo "selected";} } ?> value="CPDB">Cell Primary</option>
                        <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'CP2W'){echo "selected";} } ?> value="CP2W">Cell Primary w/2Way</option>
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
                    <input type="text" class="form-control" name="system_type" id="system_type" value="<?php if(isset($alarm_info)){ echo $alarm_info->system_type; } ?>" required/>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Monitoring Waived</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="mon_waived" id="mon_waived" value="<?php if(isset($alarm_info)){ echo $alarm_info->mon_waived; } ?>"/>
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