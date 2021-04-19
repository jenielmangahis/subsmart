<div class="card">
    <div class="card-header">
        <span style="position: absolute;right: 0;margin-right: 25px;font-size: 20px;padding-top:10px;" class="fa fa-ellipsis-v"></span>
        <h6 ><span class="fa fa-user"></span>&nbsp; &nbsp;Alarm Information</h6>
    </div>
    <div class="card-body">
        <div class="row form_line">
            <div class="col-md-4">
                <label for="">Monitoring Company</label>
            </div>
            <div class="col-md-8">
                <select id="monitor_comp" name="monitor_comp" data-customer-source="dropdown" class="input_select" >
                    <option value=""></option>
                    <option <?= isset($alarm_info) && $alarm_info->monitor_comp == 'ADT' ?  'selected' : '';?> value="ABT">ADT</option>
                    <option <?= isset($alarm_info) && $alarm_info->monitor_comp == 'CMS' ?  'selected' : '';?> value="CMS">CMS</option>
                    <option <?= isset($alarm_info) && $alarm_info->monitor_comp == 'COPS' ?  'selected' : '';?> value="COPS">COPS</option>
                    <option <?= isset($alarm_info) && $alarm_info->monitor_comp == 'FrontPoint' ?  'selected' : '';?> value="FrontPoint">FrontPoint</option>
                    <option <?= isset($alarm_info) && $alarm_info->monitor_comp == 'ProtectionOne' ?  'selected' : '';?> value="ProtectionOne">ProtectionOne</option>
                    <option <?= isset($alarm_info) && $alarm_info->monitor_comp == 'Stanley' ?  'selected' : '';?> value="Stanley">Stanley</option>
                    <option <?= isset($alarm_info) && $alarm_info->monitor_comp == 'Guardian' ?  'selected' : '';?> value="Guardian">Guardian</option>
                    <option <?= isset($alarm_info) && $alarm_info->monitor_comp == 'Vector' ?  'selected' : '';?> value="Vector">Vector</option>
                    <option <?= isset($alarm_info) && $alarm_info->monitor_comp == 'Central' ?  'selected' : '';?> value="Central">Central</option>
                    <option <?= isset($alarm_info) && $alarm_info->monitor_comp == 'Brinks' ?  'selected' : '';?> value="Brinks">Brinks</option>
                    <option <?= isset($alarm_info) && $alarm_info->monitor_comp == 'Equipment Funding' ?  'selected' : '';?> value="Equipment Funding">Equipment Funding</option>
                    <option <?= isset($alarm_info) && $alarm_info->monitor_comp == 'Other' ?  'selected' : '';?> value="Other">Other</option>
                </select>

            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-4">
                <label for="">Monitoring ID</label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="monitor_id" id="monitor_id" value="<?php if(isset($alarm_info)){ echo $alarm_info->monitor_id != 0 ? $alarm_info->monitor_id : '' ; } ?>"/>
            </div>
        </div>

        <div class="row form_line">
            <div class="col-md-4">
                <label for="">Account Type</label>
            </div>
            <div class="col-md-8">
                <select name="acct_type" id="acct_type" class="input_select">
                    <option <?php if(isset($alarm_info)){ if($alarm_info->acct_type == ''){echo "selected";} } ?> value=""></option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->acct_type == 'In-House'){echo "selected";} } ?> value="In-House">In-House</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->acct_type == 'Purchase'){echo "selected";} } ?> value="Purchase">Purchase</option>
                </select>
                <a href="<?= base_url() ?>customer/settings" target="_blank"  style="color:#58bc4f;font-size: 10px;"><span class="fa fa-plus"></span> Manage Type</a>&nbsp;&nbsp;
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-4">
                <label>Online</label>
            </div>
            <div class="col-md-8">
                <select id="online" name="online" data-customer-source="dropdown" class="form-controls input_select">
                    <option <?= isset($alarm_info) && $alarm_info->online == 'Yes' ?  'selected' : '';?> value="Yes">Yes</option>
                    <option <?= isset($alarm_info) && $alarm_info->online == 'No' ?  'selected' : '';?> value="No">No</option>
                </select>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-4">
                <label>In Service</label>
            </div>
            <div class="col-md-8">
                <select id="in_service" name="in_service" data-customer-source="dropdown" class="form-controls input_select">
                    <option <?= isset($alarm_info) && $alarm_info->in_service == 'Yes' ?  'selected' : '';?> value="Yes">Yes</option>
                    <option <?= isset($alarm_info) && $alarm_info->in_service == 'No' ?  'selected' : '';?> value="No">No</option>
                </select>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-4">
                <label>Equipment</label>
            </div>
            <div class="col-md-8">
                <select id="equipment" name="equipment" data-customer-source="dropdown" class="form-controls input_select">
                    <option value=""></option>
                    <option <?= isset($alarm_info) && $alarm_info->equipment == 'Not Installed' ?  'selected' : '';?> value="Not Installed">Not Installed</option>
                    <option <?= isset($alarm_info) && $alarm_info->equipment == 'Installed' ?  'selected' : '';?> value="Installed">Installed</option>
                    <option <?= isset($alarm_info) && $alarm_info->equipment == 'System Pulled' ?  'selected' : '';?> value="System Pulled">System Pulled</option>
                </select>
            </div>
        </div>

        <div class="row form_line">
            <div class="col-md-4">
                <label for="">Abort Code</label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="passcode" id="passcode" value="<?php if(isset($alarm_info)){ echo $alarm_info->passcode; } ?>"/>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-4">
                <label for="">Installer Code</label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="install_code" id="install_code" value="<?php if(isset($alarm_info)){ echo $alarm_info->install_code!=0 ?  $alarm_info->install_code : ''; } ?>"/>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-4">
                <label for="">Monitoring Confirm#</label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="mcn" id="mcn" value="<?php if(isset($alarm_info)){ echo $alarm_info->mcn !=0 ? $alarm_info->mcn : ''; } ?>"/>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-4">
                <label for="">Signal Confirm#</label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="scn" id="scn" value="<?php if(isset($alarm_info)){ echo $alarm_info->scn !=0 ? $alarm_info->scn : ''; } ?>"/>
            </div>
        </div>

        <div class="row form_line">
            <div class="col-md-4">
                <label for="">Panel Type</label>
            </div>
            <div class="col-md-8">
                <select name="panel_type" id="panel_type" class="input_select">
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == ''){echo "selected";} } ?> value=""></option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'AERIONICS'){echo "selected";} } ?> value="AERIONICS">AERIONICS</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'AlarmNet'){echo "selected";} } ?> value="AlarmNet">AlarmNet</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Alarm.com'){echo "selected";} } ?> value="Alarm.com">Alarm.com</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Alula'){echo "selected";} } ?> value="Alula">Alula</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Bosch'){echo "selected";} } ?> value="Bosch">Bosch</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'DSC'){echo "selected";} } ?> value="DSC">DSC</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'ELK'){echo "selected";} } ?> value="ELK">ELK</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'FBI'){echo "selected";} } ?> value="FBI">FBI</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'GRI'){echo "selected";} } ?> value="GRI">GRI</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'GE'){echo "selected";} } ?> value="GE">GE</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Honeywell'){echo "selected";} } ?> value="Honeywell">Honeywell</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Honeywell'){echo "selected";} } ?> value="Honeywell Touch">Honeywell Touch</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Honeywell'){echo "selected";} } ?> value="Honeywell 3000">Honeywell 3000</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Honeywell'){echo "selected";} } ?> value="Honeywell Vista">Honeywell Vista</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Honeywell'){echo "selected";} } ?> value="Honeywell Vista with Sim">Honeywell Vista with Sim</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Honeywell'){echo "selected";} } ?> value="Honeywell Lyric">Honeywell Lyric</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'IEI'){echo "selected";} } ?> value="IEI">IEI</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'MIER'){echo "selected";} } ?> value="MIER">MIER</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == '2 GIG'){echo "selected";} } ?> value="2 GIG">2 GIG</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == '2 GIG'){echo "selected";} } ?> value="2 GIG Go Panel 2">2 GIG Go Panel 2</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == '2 GIG'){echo "selected";} } ?> value="2 GIG Go Panel 3">2 GIG Go Panel 3</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Qolsys'){echo "selected";} } ?> value="Qolsyx">Qolsys</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Qolsys'){echo "selected";} } ?> value="Qolsyx">Qolsys IQ Panel 2</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'QIP2P'){echo "selected";} } ?> value="QIP2P">Qolsys IQ Panel 2 Plus</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Qolsys'){echo "selected";} } ?> value="">Qolsys IQ Panel 3</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Custom'){echo "selected";} } ?> value="Custom">Custom</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'DIGI'){echo "selected";} } ?> value="Other">Other</option>
                </select>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-4">
                <label for="">System Package Type</label>
            </div>
            <div class="col-md-8">
                <select name="system_type" id="system_type" class="input_select">
                    <option <?php if(isset($alarm_info)){ if($alarm_info->system_type == ''){echo "selected";} } ?> value=""></option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->system_type == 'DIGI'){echo "selected";} } ?> value="DIGI">Landline</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->system_type == 'DW2W'){echo "selected";} } ?> value="DW2W">Landline W/ 2-Way</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->system_type == 'DWCB'){echo "selected";} } ?> value="DWCB">Landline W/ Cell Backup</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->system_type == 'D2CB'){echo "selected";} } ?> value="D2CB">Landline W/ 2-Way &amp; Cell Backup</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->system_type == 'CPDB'){echo "selected";} } ?> value="CPDB">Cell Primary</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->system_type == 'CP2W'){echo "selected";} } ?> value="CP2W">Cell Primary w/2Way</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->system_type == 'WSF'){echo "selected";} } ?> value="WSF">Wireless Signal Forwarding</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->system_type == 'C'){echo "selected";} } ?> value="C">Commercial</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->system_type == 'CP'){echo "selected";} } ?> value="CP">Commercial Plus</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->system_type == 'I'){echo "selected";} } ?> value="I">Interactive</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->system_type == 'IG'){echo "selected";} } ?> value="IG">Interactive Gold</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->system_type == 'IPA'){echo "selected";} } ?> value="IPA">Interactive Plus Automation</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->system_type == 'IwDVR'){echo "selected";} } ?> value="IwDVR">Interactive w/DVR</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->system_type == 'IwDB'){echo "selected";} } ?> value="IwDB">Interactive w/Dbell</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->system_type == 'IwDBIP'){echo "selected";} } ?> value="IwDBIP">Interactive w/Dbell & IP Camera</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->system_type == 'PERS'){echo "selected";} } ?> value="PERS">PERS</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->system_type == 'WIFI'){echo "selected";} } ?> value="WIFI">WIFI</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->system_type == 'CPwWIFI'){echo "selected";} } ?> value="CPwWIFI">Cell Primary w/WIFI</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->system_type == 'CPwAC'){echo "selected";} } ?> value="CPwAC">Cell Primary w/Access Control</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->system_type == 'IwAC'){echo "selected";} } ?> value="IwAC">Interactive w/Access Control</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->system_type == 'IwACwA'){echo "selected";} } ?> value="IwACwA">Interactive w/Access Control w/Automn</option>
                </select>
                <a href="<?= base_url() ?>customer/settings" target="_blank"  style="color:#58bc4f;font-size: 10px;"><span class="fa fa-plus"></span> Manage System Type</a>&nbsp;&nbsp;
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-4">
                <label for="">Warranty Type</label>
            </div>
            <div class="col-md-8">
                <select id="warranty_type" name="warranty_type" data-customer-source="dropdown" class="input_select" >
                    <option <?php if(isset($alarm_info)){ if($alarm_info->warranty_type == ""){ echo 'selected'; } } ?> value="">Select</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->warranty_type == "Limited. 90 Days"){ echo 'selected'; } } ?> value="Limited. 90 Days">Limited 90 Days</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->warranty_type == "1 Year"){ echo 'selected'; } } ?>  value="1 Year">1 Year</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->warranty_type == "$25 Trip"){ echo 'selected'; } } ?>  value="$25 Trip">$25 Trip</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->warranty_type == "$50 Trip and $65 Deductible"){ echo 'selected'; } } ?>  value="$50 Trip and $65 Deductible">$50 Trip and $65 Deductible</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->warranty_type == "Extended"){ echo 'selected'; } } ?>  value="Extended">Extended</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->warranty_type == "None"){ echo 'selected'; } } ?>  value="None">None</option>
                </select>
            </div>
        </div>
        <hr>
        <div class="row form_line">
            <div class="col-md-4">
                <label for="">Dealer</label>
            </div>
            <div class="col-md-8">
                <select id="dealer" name="dealer" data-customer-source="dropdown" class="input_select" >
                    <option value=""></option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->dealer == "Alarm.com"){ echo 'selected'; } } ?> value="Alarm.com">Alarm.com</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->dealer == "AlarmNet"){ echo 'selected'; } } ?> value="AlarmNet">AlarmNet</option>
                </select>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-4">
                <label for=""> Login </label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="alarm_login" id="alarm_login" value="<?php if(isset($alarm_info)){ echo $alarm_info->alarm_login; } ?>"/>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-4">
                <label for="">Customer ID </label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="alarm_customer_id" id="alarm_customer_id" value="<?php if(isset($alarm_info)){ echo $alarm_info->alarm_customer_id; } ?>"/>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-4">
                <label for="">CS Account</label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="alarm_cs_account" id="alarm_cs_account" value="<?php if(isset($alarm_info)){ echo $alarm_info->alarm_cs_account; } ?>"/>
            </div>
        </div>
    </div>

        <div class="card-header">
            <span style="position: absolute;right: 0;margin-right: 25px;font-size: 20px;padding-top:10px;" class="fa fa-ellipsis-v"></span>

            <h6 ><span class="fa fa-user"></span>&nbsp; &nbsp;Access Information</h6>
        </div>
        <div class="card-body">
            <div class="row form_line">
                <div class="col-md-6">
                    <label for="">Portal Status (on/off)</label>
                </div>
                <div class="col-md-6">
                    <input type="radio" name="portal_status" value="1" id="portal_status1" <?php if(isset($access_info)){ echo $access_info->portal_status == 1 ? 'checked': ''; } ?> >
                    <span>On</span>
                    &nbsp;&nbsp;
                    <input type="radio" name="portal_status" value="0"  id="portal_status" <?php if(isset($access_info)){ echo $access_info->portal_status == 0 ? 'checked': ''; } ?>>
                    <span>Off</span>
                </div>
            </div>

            <div class="row form_line">
                <div class="col-md-6">
                    <label for="">Reset Password </label>
                </div>
                <div class="col-md-6">
                    <button type="button" class="btn btn-primary btn-md" name="reset_password" id="reset_password" >Send Email Reset </button>
                </div>
            </div>
            <div class="row form_line">
                <div class="col-md-6">
                    <label for="">Login</label>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="access_login" id="login" value="<?php if(isset($access_info)){ echo $access_info->access_login; } ?>"/>
                </div>
            </div>
            <div class="row form_line">
                <div class="col-md-6">
                    <label for="">Password</label>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="access_password" id="password" value="<?php if(isset($access_info)){ echo $access_info->access_password; } ?>"/>
                </div>
            </div>
        </div>

        <div class="card-header">
            <span style="position: absolute;right: 0;margin-right: 25px;font-size: 20px;padding-top:10px;" class="fa fa-ellipsis-v"></span>

            <h6 ><span class="fa fa-user"></span>&nbsp; &nbsp;Custom Field</h6>
        </div>
        <div class="card-body">
            <div class="row form_line">
                <div class="col-md-4">
                    <label for="">Custom Field 1</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="office_custom_field1" id="office_custom_field1" value="<?php if(isset($office_info)){ echo  $office_info->office_custom_field1; } ?>" />
                </div>
            </div>
            <div class="row form_line">
                <div class="col-md-4">
                    <label for="">Custom Field 2</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="office_custom_field1" id="office_custom_field1" value="<?php if(isset($office_info)){ echo  $office_info->office_custom_field1; } ?>" />
                </div>
            </div>
            <div class="row form_line">
                <div class="col-md-4">
                    <label for="">Custom Field 3</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="office_custom_field1" id="office_custom_field1" value="<?php if(isset($office_info)){ echo  $office_info->office_custom_field1; } ?>" />
                </div>
            </div>
            <div class="row form_line">
                <div class="col-md-4">
                    <label for="">Custom Field 4</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="office_custom_field1" id="office_custom_field1" value="<?php if(isset($office_info)){ echo  $office_info->office_custom_field1; } ?>" />
                </div>
            </div>
        </div>

        <div class="card-header">
            <span style="position: absolute;right: 0;margin-right: 25px;font-size: 20px;padding-top:10px;" class="fa fa-ellipsis-v"></span>

            <h6 ><span class="fa fa-user"></span>&nbsp; &nbsp;Notes</h6>
        </div>
        <div class="card-body">
            <div class="row form-line">
                <textarea type="text" class="form-controls" name="notes" id="notes" cols="100%" rows="5"> </textarea>
            </div>
        </div>
        <div class="card-header">
            <span style="position: absolute;right: 0;margin-right: 25px;font-size: 20px;padding-top:10px;" class="fa fa-ellipsis-v"></span>

            <h6 ><span class="fa fa-user"></span>&nbsp; Existing&nbsp;Notes</h6>
        </div>
        <div class="card-body">
            <?php if(isset($customer_notes)) :?>
                <div class="row">
                    <table width="100%" cellpadding="0" cellspacing="0">
                        <tbody>
                        <?php foreach ($customer_notes as $note) : ?>
                            <tr>
                                <td style="width: 880px; text-align: left; vertical-align: top; font-size: 11px; color: #336699">
                                    <?= $note->datetime; ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: left; border: 1px; border-style: solid; border-color: #999999; background-color: #FFFF71; font-size: 11px">
                                    <?= $note->note; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
        <div class="row" style="margin: 0 0 0 5px;">
            <a href="<?php echo base_url('customer') ?>">
                <button type="button" class="btn btn-primary"><span class="fa fa-remove"></span> Cancel </button> &nbsp;
            </a>
            <button type="submit" class="btn btn-primary" name="" id="" ><span class="fa fa-paper-plane-o"></span> <?=isset($profile_info) ? 'Save Changes' : 'Save'; ?> </button>
        </div>
    </div>
