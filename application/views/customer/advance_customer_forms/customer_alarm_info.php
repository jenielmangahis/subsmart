<div class="card">
    <div class="card-header">
        <h6 ><span class="fa fa-user"></span>&nbsp; &nbsp;Alarm Information</h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <label for="">Monitoring Company</label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="monitor_comp" id="monitor_comp" value="<?php if(isset($alarm_info)){ echo $alarm_info->monitor_comp; } ?>"/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="">Monitoring ID</label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="monitor_id" id="monitor_id" value="<?php if(isset($alarm_info)){ echo $alarm_info->monitor_id != 0 ? $alarm_info->monitor_id : '' ; } ?>"/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="">Install Date</label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control date_picker" name="install_date" id="install_date" value="<?php if(isset($alarm_info)){ echo $alarm_info->install_date; } ?>"/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="">Credit Score</label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="credit_score_alarm" id="credit_score_alarm" value="<?php if(isset($alarm_info)){ echo $alarm_info->credit_score_alarm !=0 ?$alarm_info->credit_score_alarm : '' ; } ?>"/>
            </div>
        </div>
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
        <div class="row">
            <div class="col-md-4">
                <label for="">Account Information</label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="acct_info" id="acct_info" value="<?php if(isset($alarm_info)){ echo $alarm_info->acct_info; } ?>"/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="">Abort/Password Code</label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="passcode" id="passcode" value="<?php if(isset($alarm_info)){ echo $alarm_info->passcode; } ?>"/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="">Installer Code</label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="install_code" id="install_code" value="<?php if(isset($alarm_info)){ echo $alarm_info->install_code!=0 ?  $alarm_info->install_code : ''; } ?>"/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="">Monitoring Confirmation #</label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="mcn" id="mcn" value="<?php if(isset($alarm_info)){ echo $alarm_info->mcn !=0 ? $alarm_info->mcn : ''; } ?>"/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="">Signal Confirmation #</label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="scn" id="scn" value="<?php if(isset($alarm_info)){ echo $alarm_info->scn !=0 ? $alarm_info->scn : ''; } ?>"/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="">Contact Phone 1</label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="contact1" id="contact1" value="<?php if(isset($alarm_info)){ echo $alarm_info->contact1; } ?>"/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="">Contact Name 1</label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="contact_name1" id="contact_name1" value="<?php if(isset($alarm_info)){ echo $alarm_info->contact_name1; } ?>"/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="">Contact Phone 2</label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="contact2" id="contact2" value="<?php if(isset($alarm_info)){ echo $alarm_info->contact2; } ?>"/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="">Contact Name 2</label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="contact_name2" id="contact_name2" value="<?php if(isset($alarm_info)){ echo $alarm_info->contact_name2; } ?>"/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="">Contact Phone 3</label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="contact3" id="contact3" value="<?php if(isset($alarm_info)){ echo $alarm_info->contact3; } ?>"/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="">Contact Name 3</label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="contact_name3" id="contact_name3" value="<?php if(isset($alarm_info)){ echo $alarm_info->contact_name3; } ?>" />
            </div>
        </div>
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
        <div class="row">
            <div class="col-md-4">
                <label for="">System Type</label> <span class="required"> *</span>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="system_type" id="system_type" value="<?php if(isset($alarm_info)){ echo $alarm_info->system_type; } ?>" required/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="">Monitoring Waived</label>
            </div>
            <div class="col-md-8">
                <select name="mon_waived" id="mon_waived" class="input_select">
                    <option <?php if(isset($alarm_info)){ if($alarm_info->mon_waived == 'Yes'){echo "selected";} } ?> value="Yes">Yes</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->mon_waived == 'No'){echo "selected";} } ?> value="No">No</option>
                </select>
            </div>
        </div>

        <div class="card-header">
            <h6 ><span class="fa fa-user"></span>&nbsp; &nbsp;Access Information</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Portal Status (on/off)</label>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="radio" name="portal_status" value="1" id="portal_status1" <?php if(isset($access_info)){ echo $access_info->portal_status == 1 ? 'checked': ''; } ?> >
                            <label for="portal_status1"><span>On</span></label>
                        </div>
                        <div class="col-md-6">
                            <input type="radio" name="portal_status" value="0"  id="portal_status" <?php if(isset($access_info)){ echo $access_info->portal_status == 0 ? 'checked': ''; } ?>>
                            <label for="rebate"><span>Off</span></label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="">Reset Password (Button)</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="reset_password" id="reset_password" value="<?php if(isset($access_info)){ echo $access_info->reset_password; } ?>"/>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="">Login</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="login" id="login" value="<?php if(isset($access_info)){ echo $access_info->login; } ?>"/>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="">Password</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="password" id="password" value="<?php if(isset($access_info)){ echo $access_info->password; } ?>"/>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="">Custom Field 1</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="acs_custom_field1" id="acs_custom_field1" value="<?php if(isset($access_info)){ echo $access_info->acs_custom_field1; } ?>" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="">Custom Field 2</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="acs_custom_field2" id="acs_custom_field2" value="<?php if(isset($access_info)){ echo $access_info->acs_custom_field2; } ?>" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="">Cancellation Date</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control date_picker" name="acs_cancel_date" id="date_picker" value="<?php if(isset($access_info)){ echo $access_info->acs_cancel_date; } ?>" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="">Collection Date</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control date_picker" name="acs_collect_date" id="date_picker" value="<?php if(isset($access_info)){ echo $access_info->acs_collect_date; } ?>" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="">Cancellation Reason</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="acs_cancel_reason" id="acs_cancel_reason" value="<?php if(isset($access_info)){ echo $access_info->acs_cancel_reason; } ?>" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="">Collection Amount</label>
                </div>
                <div class="col-md-8">
                    <input type="number" class="form-control" name="collect_amount" id="collect_amount" value="<?php if(isset($access_info)){ echo $access_info->collect_amount; } ?>" />
                </div>
            </div>
        </div>


        <div class="card-header">
            <h6 ><span class="fa fa-user"></span>&nbsp; &nbsp;Notes</h6>
        </div>
        <div class="card-body">
            <div class="row form-line">
                <textarea type="text" class="form-controls" name="notes" id="notes" cols="100%" rows="5"> </textarea>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="">Status</label>
                </div>
                <div class="col-md-8">
                    <select id="status" name="status" data-customer-source="dropdown" class="input_select" >
                        <option <?php if(isset($profile_info)){ if($profile_info->status == 'Assigned'){ echo 'selected'; } } ?> value="Assigned">Assigned</option>
                        <option <?php if(isset($profile_info)){ if($profile_info->status == 'Not Assign'){ echo 'selected'; } } ?> value="Not Assign">Not Assign</option>
                        <option <?php if(isset($profile_info)){ if($profile_info->status == 'Converted'){ echo 'selected'; } } ?> value="Converted">Converted</option>
                        <option <?php if(isset($profile_info)){ if($profile_info->status == 'Not Converted'){ echo 'selected'; } } ?> value="Not Converted">Not Converted</option>
                        <option <?php if(isset($profile_info)){ if($profile_info->status == 'Scheduled'){ echo 'selected'; } } ?> value="Scheduled">Scheduled</option>
                        <option <?php if(isset($profile_info)){ if($profile_info->status == 'Installed'){ echo 'selected'; } } ?> value="Installed">Installed</option>
                        <option <?php if(isset($profile_info)){ if($profile_info->status == 'Completed '){ echo 'selected'; } } ?> value="Completed">Completed</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="card-header">
            <h6 ><span class="fa fa-user"></span>&nbsp; &nbsp;Devices</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div style="margin-right:15px; padding-top:1px;font-size: 10px !important;" align="left" class="normaltext1">
                    <a href="javascript:void(0);" id="moreFields" class="more_fields" style="color:#58bc4f;"><span class="fa fa-plus"></span> Add Device </a>&nbsp;&nbsp;
                    <!--  <a href="javascript:void(0);">Action/Notes</a>-->
                </div>
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