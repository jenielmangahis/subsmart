<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="profile module ui-state-default client" id="profile">
    <div class="col-sm-12">
        <div class="col-sm-6">
            <table class="widget_client" width="100%" border="0" cellspacing="0" cellpadding="0">
                <tbody>
                <tr>
                    <td width="50%" align="left" valign="top">
                        <div class="contacttext">
                            <h3 style="font-size: 15px; margin-bottom: 10px;"><?php if(isset($profile_info)){ echo $profile_info->first_name.' '.$profile_info->last_name; } ?></h3>
                        </div>

                        <div class="contacttext">
                            <div>
                                <?php if(isset($profile_info)){ echo $profile_info->phone_h; }; ?>
                                <a id="email-confirm" href="#" style="display:block;margin-top: 5px;width:180px;" title="kylenguyenmailbox@gmail.com" class="js-qwynlraxz"><?php if(isset($profile_info)){ echo $profile_info->email; }; ?></a>
                                <input type="hidden" name="email-confirm-hidden" id="email-confirm-hidden" value="kylenguyenmailbox@gmail.com">

                            </div>
                            <div style="margin-top:7px;"><span>---</span>
                            </div>
                            <div style="margin-top:7px;">
                                Status:
                                <span class="active">Client</span>

                                <img src="https://app.creditrepaircloud.com/application/images/cancel_icon.png" id="status_cancel"  title="cancel" style="display:none;cursor:pointer; vertical-align:middle;" border="0" width="16" height="16">
                                <img src="https://app.creditrepaircloud.com/application/images/ajax-loader.gif" id="status_loading" style="display:none; vertical-align:middle;" border="0" width="16" height="16">
                                <br>
                            </div>
                        </div>
                        <div style="margin-right:15px; margin-top:6px;" align="left" class="normaltext1">
                            <!--<a href="<?php echo url('/customer/index/tab2/'.$profile_info->prof_id).'/mt5'; ?>" class="normaltext1" style="color:#58bc4f;">-->
                            <a href="<?php echo url('/customer/add_advance/'.$profile_info->prof_id).'/tab1'; ?>" class="normaltext1" style="color:#58bc4f;">
                                View/Edit Profile
                            </a>&nbsp;&nbsp;
                        </div>
                    </td>
                    <td width="50%" valign="middle">
                        <div class="contactrighttab" style="margin-top:1px;">
                            <div class="widget_tab">

                                <div class="contactrightimg">
                                    <img src="https://app.creditrepaircloud.com/application/images/dashboard-new.png" alt="1-click-import" width="25" height="35" style="padding-left: 2px;margin-top: -4px;">
                                </div>
                                <div class="contactrighttxt">
                                    <a href="https://app.creditrepaircloud.com/importcreditreport/simple_audit/NTk=?from=quick_import" class="js-qwynlraxz">
                                        1-Click Import and Audit</a><br>
                                    Pull reports &amp; create audit
                                </div>
                            </div>
                        </div>

                        <div class="contactrighttab" >

                            <div class="widget_tab">
                                <div class="contactrightimg">
                                    <img src="https://app.creditrepaircloud.com/application/images/dashboard1.png" alt="wzardimg">
                                </div>
                                <div class="contactrighttxt" >
                                    <a href="https://app.creditrepaircloud.com/wizard/index/NTk=" class="js-qwynlraxz">
                                        Run Dispute Wizard</a>
                                    <br>
                                    Create letters/correct errors
                                </div>
                            </div>
                        </div>
                        <div class="contactrighttab" style="position:relative">
                            <div class="widget_tab">
                                <div class="contactrightimg">
                                    <img src="https://app.creditrepaircloud.com/application/images/dashboard2.png" alt="securemailimg" style="height:33px;">
                                </div>
                                <div class="contactrighttxt">
                                    <a href="#" class="js-qwynlraxz">Send Secure Message</a><br>
                                    Via Client Portal
                                </div>
                            </div>
                            <div id="portal_tip" class="tooltipbox" style="top: 3em; margin-left: -10px ; width: 225px; line-height: 18px; display: none;">
                                <p class="normaltext1" style="margin:0px; font-weight:normal;">
                                    This client doesn't have portal access, so you can't send a message.
                                </p>
                                <div id="tail1-bottom"></div>
                                <div id="tail2-bottom"></div>
                            </div>
                        </div>
                        <div class="">

                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="form-group col-sm-12">
                                        <div class="checkbox checkbox-sec">
                                            <input type="checkbox" name="notify_by" value="Email" checked
                                                   id="notify_by_email">
                                            <label for="notify_by_email"><span>Notify by SMS</span></label><br>

                                            <input type="checkbox" name="notify_by" value="Email" checked
                                                   id="notify_by_email">
                                            <label for="notify_by_email"><span> Notify by Email</span></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>