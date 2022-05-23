<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="billings module_med ui-state-default"  data-id="<?= $id ?>" id="<?= $id ?>">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-6">
                <div class="contacttext">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tbody>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >MMR Method :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($billing_info)){ echo $billing_info->mmr; }; ?></b> </label>

                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >Full Name :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($billing_info)){ echo $billing_info->card_fname; }; ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span > Address :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($billing_info)){ echo $billing_info->card_address; }; ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span > City/State/Zip :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"><b> <?php if(isset($billing_info)){ echo $billing_info->city; }; ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >Account # :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($billing_info)){ echo $billing_info->acct_num; }; ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >Routing # :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($billing_info)){ echo $billing_info->routing_num; }; ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >Credit Card # :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($billing_info)){ echo $billing_info->credit_card_num; }; ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >CC Exp :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($billing_info)){ echo $billing_info->credit_card_exp; }; ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >CCN CCV :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($billing_info)){ echo $billing_info->credit_card_exp_mm_yyyy; }; ?></b> </label>
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
<!--                        <tr>-->
<!--                            <td width="50%" align="right" valign="top">-->
<!--                                <label class="alarm_label"> <span >1-Time Method :</span> </label>-->
<!--                            </td>-->
<!--                            <td width="50%" align="right" valign="top">-->
<!--                                <label class="alarm_answer"><b>Recuring</b> </label>-->
<!---->
<!--                            </td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <td width="50%" align="right" valign="top">-->
<!--                                <label class="alarm_label"> <span >One Time Amt :</span> </label>-->
<!--                            </td>-->
<!--                            <td width="50%" align="right" valign="top">-->
<!--                                <label class="alarm_answer"><b> 1123</b> </label>-->
<!--                            </td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <td width="50%" align="right" valign="top">-->
<!--                                <label class="alarm_label"> <span > Activation :</span> </label>-->
<!--                            </td>-->
<!--                            <td width="50%" align="right" valign="top">-->
<!--                                <label class="alarm_answer"><b> AC</b> </label>-->
<!--                            </td>-->
<!--                        </tr>-->
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >MMR :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($billing_info)){ echo $billing_info->mmr; }; ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span > Billing Freq. :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($billing_info)){ echo $billing_info->bill_freq; }; ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >Billing Date :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($billing_info)){ echo $billing_info->bill_day; }; ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >Contract Term :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($billing_info)){ echo $billing_info->contract_term; }; ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >Start Date :</span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($billing_info)){ echo $billing_info->bill_start_date; }; ?></b> </label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_label"> <span >End Date : </span> </label>
                            </td>
                            <td width="50%" align="right" valign="top">
                                <label class="alarm_answer"><b> <?php if(isset($billing_info)){ echo $billing_info->bill_end_date; }; ?></b> </label>
                            </td>
                        </tr>
<!--                        <tr>-->
<!--                            <td width="50%" align="right" valign="top">-->
<!--                                <label class="alarm_label"> <span >Ext. Date :</span> </label>-->
<!--                            </td>-->
<!--                            <td width="50%" align="right" valign="top">-->
<!--                                <label class="alarm_answer"><b> --><?php //if(isset($billing_info)){ echo $billing_info->contract_ext_date; }; ?><!--</b> </label>-->
<!--                            </td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <td width="50%" align="right" valign="top">-->
<!--                                <label class="alarm_label"> <span >Tot Equip Rev :</span> </label>-->
<!--                            </td>-->
<!--                            <td width="50%" align="right" valign="top">-->
<!--                                <label class="alarm_answer"><b> AC</b> </label>-->
<!--                            </td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <td width="50%" align="right" valign="top">-->
<!--                                <label class="alarm_label"> <span >CustomField4 :</span> </label>-->
<!--                            </td>-->
<!--                            <td width="50%" align="right" valign="top">-->
<!--                                <label class="alarm_answer"><b> AC</b> </label>-->
<!--                            </td>-->
<!--                        </tr>-->

                        </tbody>
                    </table>
                </div>
            </div>

            <div style="margin-left:30px;  padding-top:160px;" align="left" class="normaltext1">
                <a href="#" style="color:#58bc4f;">View/Edit Module</a>&nbsp;&nbsp;
                <!--  <a href="javascript:void(0);">Action/Notes</a>-->
            </div>

        </div>
    </div>
</div>