<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="owner module ui-state-default" id="owner">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-6">
                <div class="contacttext">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tbody>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >SSN :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b><?php if(isset($owner_info)){ echo $owner_info->own_ssn; }; ?></b> </label>

                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >Firstname :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($owner_info)){ echo $owner_info->own_fname; }; ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span>Lastname :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($owner_info)){ echo $owner_info->own_lname; }; ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >Address :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"><b> <?php if(isset($owner_info)){ echo $owner_info->own_address; }; ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >State :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($owner_info)){ echo $owner_info->own_state; }; ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >Pay History :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($owner_info)){ echo $owner_info->own_pay_history; }; ?></b> </label>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <!--<label > <span >Monitoring Co:</span> <b class="pull-right">Guardian</b></label>
                    <label>Install Date: <b>Guardian</b></label>-->
                </div>
            </div>
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-auto form-group"><br>
                        <div class="checkbox checkbox-sec margin-right my-0 mr-3">
                            <input type="checkbox" name="notify_by" value="Email" checked
                                   id="notify_by_email">
                            <label for="notify_by_email"><span>Sign Guarantee</span></label>
                        </div>
                    </div>
                </div>
            </div>

            <div style="margin-right:15px; padding-top:20px;" align="left" class="normaltext1">
                <a href="#" style="color:#58bc4f;">Best Contact</a>&nbsp;&nbsp;
                <!--  <a href="javascript:void(0);">Action/Notes</a>-->
            </div>

        </div>
    </div>
</div>