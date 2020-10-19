<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="tasks module ui-state-default" id="tasks">
    <div class="col-sm-12">
        <div class="row">
            <div class="normaltext1" id="client_reminders_div" style="margin-left: -7px;">
                <!--Added by akshay on 05-10-2016 end-->
                <!-- Updated by akshay 05-10-2016 -->

                <div class="task-tab">
                    <ul class="tab">
                        <li><a href="#" class="tablinks active js-qwynlraxz" >Team tasks</a></li>
                        <li><a href="#" class="tablinks js-qwynlraxz">Client's tasks</a></li>
                    </ul>

                    <div id="internal" class="tabcontent" style="display: block; width: 412px;">
                        <div style="width: 100%;; overflow-y: scroll; height: 91px;">

                            <table class="table_all" width="100%" border="1" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td colspan="4" width="100%">
                                        <strong style="vertical-align: super;">Due Today</strong>
                                    </td>
                                </tr>
                                <tbody>
                                    <?php if(isset($task_info)) : ?>
                                        <?php foreach ($task_info as $task) : ?>
                                            <tr class="gridrow1" id="reminder_35" >
                                                <td height="15" width="03%" class="" align="left" valign="top" style="padding:1px 2px 1px 2px; line-height:17px!important;  ">
                                                    <input type="checkbox" name="todo_chk_client[]" value="35" id="todo_chk_client35">
                                                </td>
                                                <td height="15" width="27%" class="" align="left" valign="top" style="padding:1px 2px 1px 2px; line-height:17px!important;  ">
                                                    <?= $task->subject; ?>
                                                <td height="15" align="left" valign="top" class="normaltext1" width="30%" style="padding:1px 2px 1px 2px; line-height:17px!important;  ">
                                                    10/17/2020 12:00 AM
                                                </td>
                                                <td height="15" align="right" valign="top" width="13%" style="padding:1px 2px 1px 2px; line-height:17px!important;  ">
                                                    <a href="" onclick="return deleteReminder('35');" class="js-qwynlraxz">
                                                        <img src="https://app.creditrepaircloud.com/application/images/cross.png" width="16" height="16">
                                                    </a>
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
                                            <a href="#" style="color:#58bc4f;">View completed tasks</a>&nbsp;&nbsp;

                                            <!--  <a href="javascript:void(0);">Action/Notes</a>-->
                                        </div></td>
                                    <td align="right" valign="top" class="normaltext1">
                                        <div style="margin-right:15px; padding-top:20px;" align="left" class="normaltext1">
                                            <a id="add_task" title="Add Task" href="javascript:void(0);"  style="color:#58bc4f;">Add task</a>&nbsp;&nbsp;

                                            <!--  <a href="javascript:void(0);">Action/Notes</a>-->
                                        </div>
                                    </td>

                                    <td align="right" valign="top" class="normaltext1">
                                        <div style="margin-right:15px; padding-top:20px;" align="right" class="normaltext1">
                                            <a href="#" style="color:#bc1440;"><?= isset($task_info) ? count($task_info) : '0'; ?> task(s)</a>&nbsp;&nbsp;

                                            <!--  <a href="javascript:void(0);">Action/Notes</a>-->
                                        </div>
                                    </td>
                                </tr>
                                </tbody></table>
                        </div>
                    </div>

                    <div id="client-portal" class="tabcontent" style="display: ;width: 432px;">
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

