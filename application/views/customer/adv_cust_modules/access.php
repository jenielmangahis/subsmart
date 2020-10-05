<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="access module ui-state-default" id="access">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-6">
                <div class="contacttext">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tbody>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >Portal Status :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b><?php if(isset($access_info)){  if($access_info->portal_status == 1){echo "On";}else{echo "Off";}; }; ?></b> </label>

                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >Login :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($access_info)){ echo $access_info->login; }; ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span>CustomFld1 :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($access_info)){ echo $access_info->acs_custom_field1; }; ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >Cancel Date :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"><b> <?php if(isset($access_info)){ echo $access_info->acs_cancel_date; }; ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >Cancel Reason :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($access_info)){ echo $access_info->acs_cancel_reason; }; ?></b> </label>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <!--<label > <span >Monitoring Co:</span> <b class="pull-right">Guardian</b></label>
                    <label>Install Date: <b>Guardian</b></label>-->
                </div>
            </div>

            <div class="col-sm-6">
                <div class="contacttext">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tbody>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >CustomFld2 :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b><?php if(isset($access_info)){ echo $access_info->acs_custom_field2; }; ?></b> </label>

                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >Collection Date :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($access_info)){ echo $access_info->acs_collect_date; }; ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >Collection Amt :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($access_info)){ echo $access_info->collect_amount; }; ?></b> </label>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div style="margin-left:30px; padding-top:35px;" align="left" class="normaltext1">
                <a href="#" style="color:#58bc4f;">Send Link Reset Password</a>&nbsp;&nbsp;
                <!--  <a href="javascript:void(0);">Action/Notes</a>-->
            </div>

        </div>
    </div>
</div>