<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="tech module ui-state-default" id="tech">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-6">
                <div class="contacttext">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tbody>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >Arrival Time :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b><?php if(isset($office_info)){ echo $office_info->tech_arrive_time; }; ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span>Tech Assign :</span> </label>
                           </td>
                           <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($office_info)){ echo $office_info->technician; }; ?></b> </label>
                            </td>
                       </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >CustomField1 :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"><b> <?php if(isset($office_info)){ echo $office_info->office_custom_field1; }; ?></b> </label>
                            </td>
                        </tr>
<!--                        <tr>-->
<!--                            <td width="50%" align="right" valign="top">-->
<!--                                <label class="alarm_label"> <span >CustomField2 :</span> </label>-->
<!--                            </td>-->
<!--                            <td width="50%" align="right" valign="top">-->
<!--                                <label class="alarm_label"><b> --><?php //if(isset($tech_info)){ echo $tech_info->custom_field2_tech; }; ?><!--</b> </label>-->
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
                                <label class="alarm_label"> <span >Departure Time :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b><?php if(isset($office_info)){ echo $office_info->tech_depart_time; }; ?></b> </label>

                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >Date Given :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($office_info)){ echo $office_info->save_date; }; ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >Link :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($office_info)){ echo string_max_length($office_info->url,20); }; ?></b> </label>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div style="margin-left:30px; padding-top:1px;" align="left" class="normaltext1">
                <?php if(isset($profile_info)): ?>
                    <img alt="" src="<?php echo base_url()."assets/img/customer/qr/".$profile_info->prof_id.".png"?>" width="80" />
                <?php endif; ?>
                <a target="_blank" href="/customer/send_qr/<?= $profile_info->prof_id; ?>" style="color:#58bc4f;">Send QR</a>&nbsp;&nbsp
            </div>

        </div>
    </div>
</div>