<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="owner module ui-state-default"  id="<?= $id ?>">
    <div class="col-sm-12 individual-module">
        <h6>Owner</h6>
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
                                <label class="alarm_answer"><b><?php if(isset($profile_info)){ echo $profile_info->ssn; }; ?></b> </label>

                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >Firstname :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($profile_info)){ echo $profile_info->first_name; }; ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span>Lastname :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($profile_info)){ echo $profile_info->last_name; }; ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >Address :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"><b> <?php if(isset($profile_info)){ echo $profile_info->country; }; ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >State :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($profile_info)){ echo $profile_info->state; }; ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >Pay History :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($profile_info)){ echo $profile_info->pay_history; }; ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >DOB :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($profile_info)){ echo $profile_info->date_of_birth; }; ?></b> </label>
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

            <div style="margin-left:38px;  padding-top:10px;" align="left" class="normaltext1">
                <!--  <a href="javascript:void(0);">Action/Notes</a>-->
                <a href="#" style="text-decoration:none; display:inline-block;" >
                    <img src="/assets/img/customer/actions/ac_sms.png" width="16px" height="16px" border="0" title="Send SMS">
                </a>
                <a href="mailto:" style="text-decoration:none; display:inline-block;" >
                    <img src="/assets/img/customer/actions/ac_email.png" width="16px" height="16px" border="0" title="Send Email">
                </a>
                <a href="#" style="text-decoration:none; display:inline-block;" >
                    <img src="/assets/img/customer/actions/ac_call.png" width="16px" height="16px" border="0" title="Call Customer">
                </a>
            </div>


        </div>
    </div>
</div>