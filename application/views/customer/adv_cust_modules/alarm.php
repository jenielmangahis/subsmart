<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="alarm module_med ui-state-default" id="alarm">
    <h5></h5>
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-6">
                <div class="contacttext">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tbody>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >Monitoring Co :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($acs_alarm)){ echo $acs_alarm->monitor_comp; } ?></b> </label>

                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >Install Date :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($acs_alarm)){ echo $acs_alarm->install_date; } ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span > Account Type :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($acs_alarm)){ echo $acs_alarm->acct_type; } ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >Password :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"><b> <?php if(isset($acs_alarm)){ echo $acs_alarm->passcode; } ?></b> </label>
                            </td>
                        </tr>

                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >Contact #1 :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($acs_alarm)){ echo $acs_alarm->contact1; } ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >Contact #2 :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($acs_alarm)){ echo $acs_alarm->contact2; } ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >Contact #3 :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($acs_alarm)){ echo $acs_alarm->contact3; } ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >Panel Type :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($acs_alarm)){ echo $acs_alarm->panel_type; } ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span>$ Waived :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($acs_alarm)){ echo $acs_alarm->mon_waived; } ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >RebateCheck1 :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($acs_alarm)){ echo $acs_alarm->rebate_check1; } ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >Warranty Type :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($acs_alarm)){ echo $acs_alarm->warranty_type; } ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="40%" align="right" valign="top">
                                <label class="alarm_label" style="margin-right: 6px;"> <span >Monitoring Confirmation Number :</span> </label>

                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <br> <br><?php if(isset($acs_alarm)){ echo $acs_alarm->mcn; } ?></b> </label>
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
                                <label class="alarm_label"> <span >ID :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b><?php if(isset($acs_alarm)){ echo $acs_alarm->monitor_id; } ?></b> </label>

                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >Credit Score :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($acs_alarm)){ echo $acs_alarm->credit_score_alarm; } ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >Acct Info :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($acs_alarm)){ echo $acs_alarm->acct_info; } ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span > Installer Code :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($acs_alarm)){ echo $acs_alarm->install_code; } ?></b> </label>
                            </td>
                        </tr>

                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >Contact #4 :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($acs_alarm)){ echo $acs_alarm->contact4; } ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >Contact #5 :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($acs_alarm)){ echo $acs_alarm->contact5; } ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >Contact #6 :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($acs_alarm)){ echo $acs_alarm->contact6; } ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >System Type : </span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($acs_alarm)){ echo $acs_alarm->system_type; } ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >Rebate Offer :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($acs_alarm)){ echo $acs_alarm->rebate_offer; } ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >Verification :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($acs_alarm)){ echo $acs_alarm->verification; } ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >RebateCheck2 :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($acs_alarm)){ echo $acs_alarm->rebate_check2; } ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >CustomField 1 :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($acs_alarm)){ echo $acs_alarm->custom_field1_alarm; } ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label" style="margin-right: 7px;"> <span >Signal Confirmation Number :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b><br> <br> <?php if(isset($acs_alarm)){ echo $acs_alarm->scn; } ?></b> </label>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-sm-12">

            </div>

            <div style="margin-right:15px; padding-top:30px;" align="left" class="normaltext1">
                <a href="#" style="color:#58bc4f;">View/Edit Module</a>&nbsp;&nbsp;
                <!--  <a href="javascript:void(0);">Action/Notes</a>-->
            </div>
            <div style="margin-right:15px; padding-top:30px;" align="right" class="normaltext1">
                <a href="#" style="color:#58bc4f;">Website Url</a>&nbsp;&nbsp;
                <!--  <a href="javascript:void(0);">Action/Notes</a>-->
            </div>
            <div style="margin-right:15px; padding-top:30px;" align="right" class="normaltext1">
                <a href="#" style="color:#58bc4f;">Record Sheet</a>&nbsp;&nbsp;
                <!--  <a href="javascript:void(0);">Action/Notes</a>-->
            </div>
        </div>
    </div>
</div>