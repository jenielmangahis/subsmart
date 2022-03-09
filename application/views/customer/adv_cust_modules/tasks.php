<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="tasks module ui-state-default"  data-id="<?= $id ?>"  id="<?= $id ?>">
    <div class="col-sm-12 individual-module">
        <h6>Tasks</h6>
        <div class="row">
            <div class="normaltext1" id="client_reminders_div" style="margin-left: -7px;">
                <!--Added by akshay on 05-10-2016 end-->
                <!-- Updated by akshay 05-10-2016 -->

                <div class="task-tab">
                    <div id="internal" class="tabcontent" style="display: block; width: 412px;">
                        <div style="width: 100%;; overflow-y: scroll; height: 91px;">
                            <table class="table table-bordered table-striped" width="100%" border="1" cellspacing="0" cellpadding="0" style="font-size:12px;">
                                <thead>                                
                                <tr>
                                    <th style="width:60%;background-color: #34203f; color:#ffffff;padding:2px;">Subject</th>
                                    <th style="width:60%;background-color: #34203f; color:#ffffff;padding:2px;">Date to Complete</th>
                                    <th style="width:60%;background-color: #34203f; color:#ffffff;padding:2px;">Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php if(isset($task_info)) : ?>
                                        <?php foreach ($task_info as $task) : ?>
                                            <tr class="gridrow1" id="reminder_35" >                                                
                                                <td height="15" width="27%" class="" align="left" valign="top" style="padding:1px 2px 1px 2px; line-height:17px!important;  ">
                                                    <?= $task->subject; ?>
                                                </td>
                                                <td height="15" align="left" valign="top" class="normaltext1" width="30%" style="padding:1px 2px 1px 2px; line-height:17px!important;  ">
                                                    <?= $task->estimated_date_complete; ?>
                                                </td>
                                                <td height="15" align="right" valign="top" width="13%" style="padding:1px 2px 1px 2px; line-height:17px!important;  ">
                                                    <span class="badge badge-info" style="background-color: <?php echo $task->status_color; ?>"><?php echo $task->status_text; ?></span>
                                                </td>
                                            </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                </tbody>
                            </table>


                        </div>
                        <div style="padding-top:10px;">
                            <table width="90%" border="0" cellspacing="0" cellpadding="0">
                                <tbody>
                                <tr>
                                    <td>
                                        <div style="margin-right:15px; padding-top:20px;" align="left" class="normaltext1">                                            
                                            <a href="#" style="color:#bc1440;"><?= isset($task_info) ? count($task_info) : '0'; ?> task(s)</a>
                                            <!--  <a href="javascript:void(0);">Action/Notes</a>-->
                                        </div>
                                    </td>
                                    <td align="right" valign="top" class="normaltext1">
                                        <div style="margin-right:15px; padding-top:20px;" align="left" class="normaltext1">
                                            <!-- <a id="add_task" title="Add Task" href="javascript:void(0);"  style="color:#58bc4f;">Add task</a>&nbsp;&nbsp; -->
                                            <a href="<?= base_url('taskhub?status=6'); ?>" class="btn btn-sm btn-primary" style="color:#ffffff;">View completed tasks</a>
                                            <a class="btn btn-sm btn-primary" title="Add Task" href="<?= base_url('taskhub/entry'); ?>"  style="color:#ffffff;">Add task</a>
                                        </div>
                                    </td>
                                </tr>
                                </tbody></table>
                        </div>
                    </div>

                    <div id="client-portal" class="tabcontent" style="width: 432px;">
                        <div style=" overflow-y: auto; height: 91px; width: 100%;">
                            <table class="odd-even-table" width="100%" border="0" cellspacing="0" cellpadding="0">

                                <tbody><tr style="background-color: transparent !important;">
                                    <td height="100" align="center" valign="middle" class="normaltext1"><span style="font-size: 18px;color:#999999;">No pending client portal tasks for this client</span></td>
                                </tr>

                                </tbody></table>
                        </div>
                        <div style="padding-top:10px;">
                            <table width="97%" border="0" cellspacing="0" cellpadding="0">
                                <tbody><tr>
                                    <td align="left" valign="top" class="normaltext1" >
                                        <a  href="#" class="js-qwynlraxz">View completed client tasks</a>
                                    </td>
                                    <td align="right" valign="top" class="normaltext1">
                                        <a href="#"  class="js-qwynlraxz"><img src="https://app.creditrepaircloud.com/application/images/plus-small.png" style="vertical-align:middle;margin-right: 3px;"> Add task</a>
                                    </td>
                                </tr>
                                </tbody></table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

