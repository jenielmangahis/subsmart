<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="customizable module_med ui-state-default" id="cim">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-12">
                <div class="contacttext">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tbody>
                        <?php if(isset($profile_info)) : ?>
                            <?php
                                $custom_fields = json_decode($profile_info->custom_fields);
                                if (!empty($custom_fields)) {
                                    foreach ($custom_fields as $key => $custom) {
                                        ?>
                                        <tr>
                                            <td width="40%" align="left" valign="top">
                                                <label class="alarm_label"> <span ><?= !empty($custom->field_name) ? $custom->field_name : '' ; ?> :</span> </label>
                                            </td>
                                            <td width="60%" align="left" valign="top">
                                                <label class="alarm_answer"><?= !empty($custom->field_value) ? $custom->field_value : '' ; ?> </label>
                                                <a href="<?php echo url('customer/index/tab3/'.$profile_info->prof_id.'/mt12') ?>" class=""><span class="fa fa-pencil"></span></a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                            ?>
                        <?php endif; ?>
                        </tbody>
                    </table>
                    <!--<label > <span >Monitoring Co:</span> <b class="pull-right">Guardian</b></label>
                    <label>Install Date: <b>Guardian</b></label>-->
                </div>
            </div>
            <div style="margin-left:325px;  padding-top: <?= !empty($profile_info->custom_fields) ? '50':'330'; ?>px; text-align: right !important;" class="normaltext1">
                <?php if(isset($profile_info)) : ?>
                    <a href="/customer/index/tab3/<?= $profile_info->prof_id  ?>/mt12" style="color:#58bc4f;">View/Edit Fields</a>
                <?php endif; ?>
            </div>

        </div>
    </div>
</div>