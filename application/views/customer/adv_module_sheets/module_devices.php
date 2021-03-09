<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="module_ac">
    <div class="row">
        <div class="col-md-12 module_header">
            <p class="module_title">Devices</p>
        </div>
        <div class="col-sm-12" id="access_module">
            <div class="col-sm-12 text-right-sm" style="align:right;">
                <span class="text-ter" style="position: absolute; right: 83px !important; top: 8px;">Customize</span>
                <div class="onoffswitch grid-onoffswitch" style="position: relative; margin-top: 7px;">
                    <input type="checkbox" name="device_switch" class="onoffswitch-checkbox" data-customize="open" id="onoff-device">
                    <label class="onoffswitch-label" for="onoff-device">
                        <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span>
                    </label>
                </div>
            </div>
        </div>

        <div class="col-md-12">
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
    </div>
</div>

<style>
    .device{
        display : inline-block;
    }
</style>

<script>


</script>