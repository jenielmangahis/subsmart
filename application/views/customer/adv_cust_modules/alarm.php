<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="alarm module_med ui-state-default"  data-id="<?= $id ?>"  id="<?= $id ?>">
    <div class="col-sm-12">
        <h6></h6>
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
                                <label class="alarm_answer"><b> <?php if(isset($alarm_info)){ echo $alarm_info->monitor_comp; } ?></b> </label>

                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >Install Date :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($office_info)){ echo $office_info->install_date; } ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span > Account Type :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($alarm_info)){ echo $alarm_info->acct_type; } ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >Password :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"><b> <?php if(isset($alarm_info)){ echo $alarm_info->passcode; } ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >Panel Type :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($alarm_info)){ echo $alarm_info->panel_type; } ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span>Mon. Waived :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($office_info)){ echo $office_info->monitoring_waived; } ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >RebateCheck1 :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($office_info)){ echo $office_info->rebate_check1; } ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >Warranty Type :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($alarm_info)){ echo $alarm_info->warranty_type; } ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="40%" align="right" valign="top">
                                <label class="alarm_label" style="margin-right: 6px;"> <span >Monitoring Confirmation Number :</span> </label>

                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <br> <br><?php if(isset($alarm_info)){ echo $alarm_info->mcn; } ?></b> </label>
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
                                <label class="alarm_answer"><b><?php if(isset($alarm_info)){ echo $alarm_info->monitor_id; } ?></b> </label>

                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >Credit Score :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($alarm_info)){ echo $alarm_info->credit_score_alarm; } ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >Acct Info :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($alarm_info)){ echo $alarm_info->acct_info; } ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span > Installer Code :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($alarm_info)){ echo $alarm_info->install_code; } ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >System Type : </span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($alarm_info)){ echo $alarm_info->system_type; } ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >Rebate Offer :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($office_info)){ echo $office_info->rebate_offer; } ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >Verification :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($office_info)){ echo $office_info->verification; } ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >RebateCheck2 :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($office_info)){ echo $office_info->rebate_check2; } ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label" style="margin-right: 7px;"> <span >Signal Confirmation Number :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b><br> <br> <?php if(isset($alarm_info)){ echo $alarm_info->scn; } ?></b> </label>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-sm-12">

            </div>

            <div style="margin-left:30px;  padding-top:30px;" align="left" class="normaltext1">
                <a href="#" style="color:#58bc4f;">Account On Test</a>&nbsp;&nbsp;
                <!--  <a href="javascript:void(0);">Action/Notes</a>-->
            </div>
            <div style="margin-left:30px;  padding-top:30px;" align="right" class="normaltext1">
                <a href="#" style="color:#58bc4f;">Website Url</a>&nbsp;&nbsp;
                <!--  <a href="javascript:void(0);">Action/Notes</a>-->
            </div>
            <div style="margin-left:30px;  padding-top:30px;" align="right" class="normaltext1">
                <a href="#" style="color:#58bc4f;">Record Sheet</a>&nbsp;&nbsp;
                <!--  <a href="javascript:void(0);">Action/Notes</a>-->
            </div>
        </div>
    </div>
</div>