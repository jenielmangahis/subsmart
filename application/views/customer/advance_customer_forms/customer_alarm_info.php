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
                    <option value="ABT">ADT</option>
                    <option value="CMS">CMS</option>
                    <option value="CMS">COPS</option>
                    <option value="CMS">FrontPoint</option>
                    <option value="CMS">ProtectionOne</option>
                    <option value="CMS">Stanley</option>
                    <option value="CMS">Guardian</option>
                    <option value="CMS">Vector</option>
                    <option value="CMS">Central</option>
                    <option value="CMS">Brinks</option>
                    <option value="CMS">Equipment Funding</option>
                    <option value="CMS">Other</option>
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
                <label for="">Account Number</label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="acct_info" id="acct_info" value="<?php if(isset($alarm_info)){ echo $alarm_info->acct_info; } ?>"/>
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
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == ''){echo "selected";} } ?> value=""></option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'DIGI'){echo "selected";} } ?> value="DIGI">Landline</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'DW2W'){echo "selected";} } ?> value="DW2W">Landline W/ 2-Way</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'DWCB'){echo "selected";} } ?> value="DWCB">Landline W/ Cell Backup</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'D2CB'){echo "selected";} } ?> value="D2CB">Landline W/ 2-Way &amp; Cell Backup</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'CPDB'){echo "selected";} } ?> value="CPDB">Cell Primary</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'CP2W'){echo "selected";} } ?> value="CP2W">Cell Primary w/2Way</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'CP2W'){echo "selected";} } ?> value="CP2W">Wireless Signal Forwarding</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'CP2W'){echo "selected";} } ?> value="CP2W">Commercial</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'CP2W'){echo "selected";} } ?> value="CP2W">Commercial Plus</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'CP2W'){echo "selected";} } ?> value="CP2W">Interactive</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'CP2W'){echo "selected";} } ?> value="CP2W">Interactive Gold</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'CP2W'){echo "selected";} } ?> value="CP2W">Interactive Plus Automation</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'CP2W'){echo "selected";} } ?> value="CP2W">Interactive w/DVR</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'CP2W'){echo "selected";} } ?> value="CP2W">Interactive w/Dbell</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'CP2W'){echo "selected";} } ?> value="CP2W">Interactive w/Dbell & IP Camera</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'CP2W'){echo "selected";} } ?> value="CP2W">PERS</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'CP2W'){echo "selected";} } ?> value="CP2W">WIFI</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'CP2W'){echo "selected";} } ?> value="CP2W">Cell Primary w/WIFI</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'CP2W'){echo "selected";} } ?> value="CP2W">Cell Primary w/Access Control</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'CP2W'){echo "selected";} } ?> value="CP2W">Interactive w/Access Control</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'CP2W'){echo "selected";} } ?> value="CP2W">Interactive w/Access Control w/Automn</option>
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
                    <option <?php if(isset($office_info)){ if($office_info->warranty_type == ""){ echo 'selected'; } } ?> value="">Select</option>
                    <option <?php if(isset($office_info)){ if($office_info->warranty_type == "Limited. 90 Days"){ echo 'selected'; } } ?> value="Limited. 90 Days">Limited 90 Days</option>
                    <option <?php if(isset($office_info)){ if($office_info->warranty_type == "1 Year"){ echo 'selected'; } } ?>  value="1 Year">1 Year</option>
                    <option <?php if(isset($office_info)){ if($office_info->warranty_type == "$25 Trip"){ echo 'selected'; } } ?>  value="$25 Trip">$25 Trip</option>
                    <option <?php if(isset($office_info)){ if($office_info->warranty_type == "$50 Trip and $65 Deductible"){ echo 'selected'; } } ?>  value="$50 Trip and $65 Deductible">$50 Trip and $65 Deductible</option>
                    <option <?php if(isset($office_info)){ if($office_info->warranty_type == "Extended"){ echo 'selected'; } } ?>  value="Extended">Extended</option>
                    <option <?php if(isset($office_info)){ if($office_info->warranty_type == "None"){ echo 'selected'; } } ?>  value="None">None</option>
                </select>
            </div>
        </div>
        <hr>
        <div class="row form_line">
            <div class="col-md-4">
                <label for="">Dealer</label>
            </div>
            <div class="col-md-8">
                <select id="alarm_login" name="alarm_login" data-customer-source="dropdown" class="input_select" >
                    <option value="Alarm.com">Alarm.com</option>
                    <option value="AlarmNet">AlarmNet</option>
                </select>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-4">
                <label for=""> Login </label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="login" id="login" value="<?php if(isset($access_info)){ echo $access_info->login; } ?>"/>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-4">
                <label for="">Customer ID </label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="login" id="login" value="<?php if(isset($access_info)){ echo $access_info->login; } ?>"/>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-4">
                <label for="">CS Account</label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="login" id="login" value="<?php if(isset($access_info)){ echo $access_info->login; } ?>"/>
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
                    <input type="text" class="form-control" name="login" id="login" value="<?php if(isset($access_info)){ echo $access_info->login; } ?>"/>
                </div>
            </div>
            <div class="row form_line">
                <div class="col-md-6">
                    <label for="">Password</label>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="password" id="password" value="<?php if(isset($access_info)){ echo $access_info->password; } ?>"/>
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

            <h6 ><span class="fa fa-user"></span>&nbsp; &nbsp;Devices</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <!--<div style="margin-right:15px; padding-top:1px;font-size: 10px !important;" align="left" class="normaltext1">
                    <a href="javascript:void(0);" id="moreFields" class="more_fields" style="color:#58bc4f;"><span class="fa fa-plus"></span> Add Device </a>&nbsp;&nbsp;
                </div>-->
                <table cellpadding="0" cellspacing="3" style="width: 100%; border-color: #525759; border-style: solid; border-collapse: collapse; border-width: 1px;font-size: 10px !important;">
                    <thead>
                    <tr>
                        <td style="border-color: #525759; border-style: solid; border-collapse: collapse; border-width: 1px">
                            <b>Name</b>
                        </td>
                        <td style="border-color: #525759; border-style: solid; border-collapse: collapse; border-width: 1px">
                            <b>Sold By</b></td>
                        <td style="border-color: #525759; border-style: solid; border-collapse: collapse; border-width: 1px">
                            <b>Points</b></td>
                        <td style="border-color: #525759; border-style: solid; border-collapse: collapse; border-width: 1px">
                            <b>Retail Cost</b></td>
                        <td style="border-color: #525759; border-style: solid; border-collapse: collapse; border-width: 1px">
                            <b>Purchase Price</b></td>
                        <td style="border-color: #525759; border-style: solid; border-collapse: collapse; border-width: 1px">
                            <b>Qty</b></td>
                        <td style="border-color: #525759; border-style: solid; border-collapse: collapse; border-width: 1px">
                            <b>Tot Points</b></td>
                        <td style="border-color: #525759; border-style: solid; border-collapse: collapse; border-width: 1px">
                            <b>Tot Cost</b></td>
                        <td style="border-color: #525759; border-style: solid; border-collapse: collapse; border-width: 1px">
                            <b>Tot Purchase Price</b></td>
                        <td style="border-color: #525759; border-style: solid; border-collapse: collapse; border-width: 1px">
                            <b>Net</b></td>
                        <td style="border-color: #525759; border-style: solid; border-collapse: collapse; border-width: 1px">

                        </td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (isset($device_info)) : ?>
                        <?php foreach ($device_info as $device) { ?>
                            <tr>
                                <td style="text-align: left; border-color: #525759; border-style: solid; border-collapse: collapse; border-width: 1px">
                                    <?= $device->device_name; ?>
                                </td>
                                <td style="text-align: left; border-color: #525759; border-style: solid; border-collapse: collapse; border-width: 1px">
                                    <?= $device->sold_by; ?>
                                </td>
                                <td style="border-color: #525759; border-style: solid; border-collapse: collapse; border-width: 1px">
                                    <?= $device->device_points; ?>
                                </td>
                                <td style="border-color: #525759; border-style: solid; border-collapse: collapse; border-width: 1px; color: #336699; text-align: right">
                                    <?= '$'.$device->retail_cost; ?>
                                </td>
                                <td style="border-color: #525759; border-style: solid; border-collapse: collapse; border-width: 1px; color: #CC3300; text-align: right">
                                    <?= '$'.$device->purch_price; ?>
                                </td>
                                <td style="border-color: #525759; border-style: solid; border-collapse: collapse; border-width: 1px">
                                    <?= $device->device_qty; ?>
                                </td>
                                <td style="border-color: #525759; border-style: solid; border-collapse: collapse; border-width: 1px">
                                    <?= $device->total_points; ?>
                                </td>
                                <td style="border-color: #525759; border-style: solid; border-collapse: collapse; border-width: 1px; color: #336699; text-align: right">
                                    <?= '$'.$device->total_cost; ?>
                                </td>
                                <td style="border-color: #525759; border-style: solid; border-collapse: collapse; border-width: 1px; color: #CC3300; text-align: right">
                                    <?= '$'.$device->total_purch_price; ?>
                                </td>
                                <td style="border-color: #525759; border-style: solid; border-collapse: collapse; border-width: 1px; color: Green; text-align: right">
                                    <?= '$'.$device->device_net; ?>
                                </td>
                                <td style="border-color: #525759; border-style: solid; border-collapse: collapse; border-width: 1px; color: Green; text-align: right">
                                    <a id="<?= $device->dev_id; ?>" href="javascript:void(0);" class="remove_device" style="color:#58bc4f;"><span class="fa fa-trash-o"></span> </a>&nbsp;&nbsp;
                                </td>
                            </tr>
                        <?php } ?>
                    <?php endif ?>
                    </tbody>
                </table>
                <span id="writeroot"></span>
            </div>
            <br>
            <div class="row">
                <a href="<?php echo base_url('customer') ?>">
                    <button type="button" class="btn btn-primary btn-md "><span class="fa fa-remove"></span> Cancel </button> &nbsp;
                </a>
                <button type="submit" class="btn btn-primary btn-md" name="" id="" ><span class="fa fa-paper-plane-o"></span> Save </button>
            </div>
        </div>
    </div>
</div>