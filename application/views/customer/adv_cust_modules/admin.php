<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="admin module ui-state-default" id="admin">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-6">
                <div class="contacttext">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tbody>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >Entered by :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b><?php if(isset($office_info)){ echo $office_info->entered_by; }; ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >Time Entered :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b><?php if(isset($office_info)){ echo $office_info->time_entered; }; ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span>Assign To :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($office_info)){ echo $office_info->assign_to; }; ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >Pre Survey :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"><b> <?php if(isset($office_info)){ echo $office_info->pre_install_survey; }; ?></b> </label>
                            </td>
                        </tr>
<!--                        <tr>-->
<!--                            <td width="50%" align="right" valign="top">-->
<!--                                <label class="alarm_label"> <span >CustomFld1 :</span> </label>-->
<!--                            </td>-->
<!--                            <td width="50%" align="right" valign="top">-->
<!--                                <label class="alarm_answer"><b> --><?php //if(isset($admin_info)){ echo $admin_info->custom_field1_admin; }; ?><!--</b> </label>-->
<!--                            </td>-->
<!--                        </tr>-->
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
                                <label class="alarm_label"> <span >Language :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b><?php if(isset($office_info)){ echo $office_info->language; }; ?></b> </label>

                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >Date Enter :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($office_info)){ echo $office_info->sales_date; }; ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >Sales Rep :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($office_info)){ echo $office_info->fk_sales_rep_office; }; ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >Post Survey:</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($office_info)){ echo $office_info->post_install_survey; }; ?></b> </label>
                            </td>
                        </tr>
<!--                        <tr>-->
<!--                            <td width="50%" align="right" valign="top">-->
<!--                                <label class="alarm_label"> <span >CustomField2 :</span> </label>-->
<!--                            </td>-->
<!--                            <td width="50%" align="right" valign="top">-->
<!--                                <label class="alarm_answer"><b> --><?php //if(isset($admin_info)){ echo $admin_info->custom_field2_admin	; }; ?><!--</b> </label>-->
<!--                            </td>-->
<!--                        </tr>-->
                        </tbody>
                    </table>
                </div>
            </div>

            <div style="margin-right:15px; padding-top:70px;" align="left" class="normaltext1">
                <a href="#" style="color:#58bc4f;">View/Edit Module</a>&nbsp;&nbsp;

                <!--  <a href="javascript:void(0);">Action/Notes</a>-->
            </div>

        </div>
    </div>
</div>