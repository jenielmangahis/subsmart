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

                            <table class="table_all" width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tbody><tr>
                                    <td height="100" align="center" valign="middle" class="normaltext1"><span style="font-size: 18px;color:#999999;">No internal tasks for this client</span></td>
                                </tr>

                                </tbody></table>


                        </div>
                        <div style="padding-top:10px;">
                            <table width="90%" border="0" cellspacing="0" cellpadding="0">

                                <tbody><tr>
                                    <td>
                                        <div style="margin-right:15px; padding-top:20px;" align="left" class="normaltext1">
                                            <a href="#" style="color:#58bc4f;">View completed tasks</a>&nbsp;&nbsp;

                                            <!--  <a href="javascript:void(0);">Action/Notes</a>-->
                                        </div></td>
                                    <td align="right" valign="top" class="normaltext1">
                                        <div style="margin-right:15px; padding-top:20px;" align="left" class="normaltext1">
                                            <a href="#" style="color:#58bc4f;">Add task</a>&nbsp;&nbsp;

                                            <!--  <a href="javascript:void(0);">Action/Notes</a>-->
                                        </div>
                                    </td>

                                    <td align="right" valign="top" class="normaltext1">
                                        <div style="margin-right:15px; padding-top:20px;" align="right" class="normaltext1">
                                            <a href="#" style="color:#bc1440;">7 tasks</a>&nbsp;&nbsp;

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
                                        <a href="#"  class="js-qwynlraxz"><img src="https://app.creditrepaircloud.com/application/images/plus-small.png" style="vertical-align:middle;margin-right: 3px;"> Add task for client</a>
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