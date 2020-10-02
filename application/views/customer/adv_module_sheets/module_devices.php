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
                <a href="javascript:void(0);" data-toggle="modal" data-target="#modal_devices" style="color:#58bc4f;"><span class="fa fa-plus"></span> Add Device </a>&nbsp;&nbsp;
                <!--  <a href="javascript:void(0);">Action/Notes</a>-->
            </div>
            <table cellpadding="0" cellspacing="3" style="width: 860px; border-color: #525759; border-style: solid; border-collapse: collapse; border-width: 1px;font-size: 10px !important;">
                <tbody>
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
                </tr>



                <tr><td style="text-align: left; border-color: #525759; border-style: solid; border-collapse: collapse; border-width: 1px">
                        6165EX ALPHA LCD KEYPAD(FOR PROGRAMMING)</td>
                    <td style="text-align: left; border-color: #525759; border-style: solid; border-collapse: collapse; border-width: 1px">
                        Sales</td>
                    <td style="border-color: #525759; border-style: solid; border-collapse: collapse; border-width: 1px">
                        0.0</td>
                    <td style="border-color: #525759; border-style: solid; border-collapse: collapse; border-width: 1px; color: #336699; text-align: right">
                        $0.00&nbsp;</td>
                    <td style="border-color: #525759; border-style: solid; border-collapse: collapse; border-width: 1px; color: #CC3300; text-align: right">
                        $0.00&nbsp;</td>
                    <td style="border-color: #525759; border-style: solid; border-collapse: collapse; border-width: 1px">
                        1</td>
                    <td style="border-color: #525759; border-style: solid; border-collapse: collapse; border-width: 1px">
                        0.0</td>
                    <td style="border-color: #525759; border-style: solid; border-collapse: collapse; border-width: 1px; color: #336699; text-align: right">
                        $0.00&nbsp;</td>
                    <td style="border-color: #525759; border-style: solid; border-collapse: collapse; border-width: 1px; color: #CC3300; text-align: right">
                        $0.00&nbsp;</td>
                    <td style="border-color: #525759; border-style: solid; border-collapse: collapse; border-width: 1px; color: Green; text-align: right">
                        $0.00</td>
                </tr>



                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Lead Type Modal -->
<div class="modal fade" id="modal_devices" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title" id="exampleModalLabel" style="font-size: 14px !important;">Add Device</span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="modal_form_assign">
                <div class="modal-body">
                    <div class="col-md-12 form-line">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Device Name</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="device_name" id="device_name" value="<?php //if(isset($alarm_info)){ echo $alarm_info->monitor_comp; } ?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 form-line">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Sold By</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="sold_by" id="sold_by" value="<?php //if(isset($alarm_info)){ echo $alarm_info->monitor_comp; } ?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 form-line">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Points</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="device_points" id="device_points" value="<?php //if(isset($alarm_info)){ echo $alarm_info->monitor_comp; } ?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 form-line">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Retail Cost</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="retail_cost" id="retail_cost" value="<?php //if(isset($alarm_info)){ echo $alarm_info->monitor_comp; } ?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 form-line">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Purchase Price</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="purch_price" id="purch_price" value="<?php //if(isset($alarm_info)){ echo $alarm_info->monitor_comp; } ?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 form-line">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Qty</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="device_qty" id="device_qty" value="<?php //if(isset($alarm_info)){ echo $alarm_info->monitor_comp; } ?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 form-line">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Total Points</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="total_points" id="total_points" value="<?php //if(isset($alarm_info)){ echo $alarm_info->monitor_comp; } ?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 form-line">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Total Cost</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="total_cost" id="total_cost" value="<?php //if(isset($alarm_info)){ echo $alarm_info->monitor_comp; } ?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 form-line">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Total Purchase Price</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="total_purch_price" id="total_purch_price" value="<?php //if(isset($alarm_info)){ echo $alarm_info->monitor_comp; } ?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 form-line">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Net</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="device_net" id="device_net" value="<?php //if(isset($alarm_info)){ echo $alarm_info->monitor_comp; } ?>"/>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>