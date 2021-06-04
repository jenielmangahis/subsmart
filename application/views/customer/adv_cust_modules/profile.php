<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="module ui-state-default" data-id="<?= $id ?>" id="<?= $id ?>">
    <div class="col-sm-12 individual-module">
        <h6>Profile</h6>
        <div class="row">
            <div class="col-sm-6">
                <table class="widget_client" width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tbody>
                        <tr>
                            <td width="50%" align="left" valign="top">
                                <div class="contacttext">
                                    <h3 style="font-size: 15px; margin-bottom: 10px;"><?php if (isset($profile_info)) {echo $profile_info->first_name . ' ' . $profile_info->last_name;} ?></h3>
                                </div>
                                <div class="contacttext">
                                    <div><?php if (isset($profile_info)) {echo $profile_info->phone_h;}; ?>
                                        <a id="email-confirm" href="#" style="display:block;margin-top: 5px;width:180px;" title="kylenguyenmailbox@gmail.com" class="js-qwynlraxz">
                                        <?php if (isset($profile_info)) {echo $profile_info->email;}; ?></a>
                                        <input type="hidden" name="email-confirm-hidden" id="email-confirm-hidden" value="kylenguyenmailbox@gmail.com">
                                    </div>
                                    <div style="margin-top:7px;"><span>---</span>
                                    </div>
                                    <div style="margin-top:7px;">
                                        Status:
                                        <span class="active" style="color:#0b62a4;"><?= $profile_info->status; ?></span>
                                        <img src="https://app.creditrepaircloud.com/application/images/cancel_icon.png" id="status_cancel"  title="cancel" style="display:none;cursor:pointer; vertical-align:middle;" border="0" width="16" height="16">
                                        <img src="https://app.creditrepaircloud.com/application/images/ajax-loader.gif" id="status_loading" style="display:none; vertical-align:middle;" border="0" width="16" height="16">
                                        <br>
                                    </div>
                                </div>
                                <div style="margin-right:15px; margin-top:6px;" align="left" class="normaltext1">
                                    <a href="<?php if (isset($profile_info)) { echo url('/customer/preview/' . $profile_info->prof_id);} ?>" class="normaltext1" style="color:#58bc4f;">
                                        View &nbsp;&nbsp;
                                    </a>
                                    <a href="<?php if (isset($profile_info)) { echo url('/customer/add_advance/' . $profile_info->prof_id);} ?>" class="normaltext1" style="color:#58bc4f;">
                                        Edit Profile
                                    </a>
                                </div>
                            </td>
                            <td width="50%" valign="middle">
                                <div class="contactrighttab" style="margin-top:1px;">
                                    <div class="widget_tab">
                                        <div class="contactrightimg">
                                            <img src="<?= base_url() ?>/assets/img/customer/images/dashboard-new.png" alt="1-click-import" width="25" height="35" style="padding-left: 2px;margin-top: -4px;">
                                        </div>
                                        <div class="contactrighttxt">
                                            <a href="<?= isset($profile_info) ? '/customer/index/tab3/' . $profile_info->prof_id . '/mt2' : '#' ?>" class="js-qwynlraxz">
                                                1-Click Import and Audit<br>
                                                Pull reports &amp; create audit
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="contactrighttab" >
                                    <div class="widget_tab">
                                        <div class="contactrightimg">
                                            <img src="<?= base_url() ?>/assets/img/customer/images/dashboard1.png" alt="wzardimg">
                                        </div>
                                        <div class="contactrighttxt" >
                                            <a href="<?= isset($profile_info) ? '/customer/index/tab3/' . $profile_info->prof_id . '/mt3' : '#' ?>" class="js-qwynlraxz">
                                                Run Dispute Wizard
                                                <br>
                                                Create letters/correct errors
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="contactrighttab" style="position:relative">
                                    <div class="widget_tab">
                                        <div class="contactrightimg">
                                            <img src="<?= base_url() ?>/assets/img/customer/images/dashboard2.png" alt="securemailimg" style="height:33px;">
                                        </div>
                                        <div class="contactrighttxt">
                                            <a href="#" class="js-qwynlraxz">Send Secure Message<br>
                                                Via Client Portal
                                            </a>
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
                                <div class="float-left mt-2" style="margin-left: 5px !important;">
                                    <input type="checkbox" name="notify_by" value="Email" checked id="notify_by_email" >
                                    <label for="notify_by_email"><span>Notify by SMS</span></label><br>

                                    <input type="checkbox" name="notify_by" value="Email" checked id="notify_by_email">
                                    <label for="notify_by_email"><span> Notify by Email</span></label>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>


        </div>
    </div>
</div>
<style>
    #notify_by_email{
        background-color: #0b62a4 !important;
    }
</style>