<div class="card">
    <div class="tab-pane active standard-accordion" id="widget1A">
        <div class="banking-tab-container">
            <div class="rb-01">
                <ul class="nav nav-tabs border-0">
                    <li class="nav-item">
                        <a class="h6 mb-0 nav-link banking-sub-tab active" data-toggle="tab" href="#1">Import Credit Report</a>
                    </li>
                    <li class="nav-item">
                        <a class="h6 mb-0 nav-link banking-sub-tab" data-toggle="tab" href="#2">Simple Audit (credit analysis)</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="tab-content mt-4" >
            <div class="tab-pane active standard-accordion" id="1">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body hid-desk" style="padding-bottom:0px;" >
                                <div class="new-left" style="text-align: center !important;">
                                    <div class="new-title" >Credit Report</div>
                                    <p style="font-size: 14px;">Last imported 9 days ago</p>
                                    <center><img class="new-left-img" src="https://app.creditrepaircloud.com/application/images/credit-report-done-img.png"></center>
                                    <br>
                                    <button class="btn btn-primary btn-md" id="import_audit" value="Import Updated Credit Report" style="margin: 0 0 10px; width: 250px;">Reimport Credit Report</button>
                                </div>
                            </div>
                            <br><br>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body hid-desk" style="padding-bottom:0px;" >
                                <div class="new-left">
                                    <h6 style="display:inline-block;">Import Log</h6>
                                    <div style="float: right; margin-top: 9px; font-size:16px;">Report provider: IdentityIQ</div>
                                    <table id="import_audit" class="table table-bordered table-striped">
                                        <tbody>
                                        <tr>
                                            <td width="50%" align="left" valign="middle" class="gridheader">Date imported </td>
                                            <td width="50%" align="left" valign="middle" class="gridheader">Team member</td>
                                        </tr>
                                        <tr class="gridrow">
                                            <td align="left" valign="middle"> Oct 09 2020 05:09 AM </td>
                                            <td align="left" valign="middle">Tommy</td>
                                        </tr>
                                        <tr class="gridrow1">
                                            <td align="left" valign="middle">Jul 15 2020 04:15 PM</td>
                                            <td align="left" valign="middle">Tommy</td>
                                        </tr>
                                        <tr class="gridrow">
                                            <td align="left" valign="middle">Feb 25 2020 03:42 PM</td>
                                            <td align="left" valign="middle">Tommy</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <h6 class="new-title">Pending Report</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body hid-desk" style="padding-bottom:0;" >
                                <div class="rptacsbox" style="height:268px;margin:10px;">

                                    <form name="frm_report_access_detail" id="frm_report_access_detail" action="" method="post">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tbody><tr>
                                                <td width="70%" align="left" height="35"><strong>Client's credit report access details:</strong></td>
                                                <td align="right" height="40">
                                            <span class="normaltext1">
                                                <a id="edit_all_fields" href="javascript:void(0);" onclick="return edit_save_all_fields('edit');">Edit details</a>
                                            </span>
                                                </td>
                                            </tr>
                                            </tbody></table>
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tbody><tr>
                                                <td width="30%" align="left" height="32">Report Provider:</td>
                                                <td width="70%" align="left">
                                                    <span class="report_provider_lbl">IdentityIQ</span>
                                                    <span class="report_provider_txt" style="display:none;">
                                                <input type="text" value="IdentityIQ" style="width: 187px;" name="report_provider_txt" id="report_provider_txt" class="input">
                                            </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="left" height="32">Username:</td>
                                                <td align="left">
                                                    <span class="username_lbl">ericshepard0102@gmail.com</span>
                                                    <span class="username_txt" style="display:none;">
                                                <input type="text" value="ericshepard0102@gmail.com" style="width: 187px;" name="username_txt" id="username_txt" class="input" onkeyup="checkForScript('username_txt')">
                                            </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="left" height="32">Password:</td>
                                                <td align="left">
                                                    <span class="password_lbl">Credit@2019</span>
                                                    <span class="password_txt" style="display:none;">
                                                <input type="text" value="Credit@2019" style="width: 160px; padding-right: 30px;" name="password_txt" id="password_txt" class="input" onkeyup="checkForScript('password_txt')">
                                                <i class="fa fa-eye" id="password_toggle" style="margin-left: -30px;cursor: pointer;" onclick="showPassword('password_txt','#password_toggle')"></i>
                                            </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="left" height="32">Phone Number: </td>
                                                <td align="left">
                                                    <span class="phonenumber_lbl">(903) 701-5632</span>
                                                    <span class="phonenumber_txt" style="display:none;">
                                                <input type="text" value="(903) 701-5632" name="phonenumber_txt" id="phonenumber_txt" class="input" style="width: 187px;" onkeyup="javascript:backspacerUP(this, event);" onkeydown="javascript:backspacerDOWN(this, event);">
                                            </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="left" height="32">Security Word: </td>
                                                <td align="left">
                                            <span class="securitywork_lbl">
                                                                                                                                                <table border="0" cellspacing="0" cellpadding="0" style="font-size:10px;">
                                                    <tbody><tr>
                                                                                                                <td align="center" style="font-size:15px;">&nbsp;5&nbsp;</td>
                                                                                                                <td align="center" style="font-size:15px;">&nbsp;2&nbsp;</td>
                                                                                                                <td align="center" style="font-size:15px;">&nbsp;6&nbsp;</td>
                                                                                                                <td align="center" style="font-size:15px;">&nbsp;3&nbsp;</td>
                                                                                                            </tr>
                                                    <tr>
                                                                                                                    <td align="center" style="background-color:#f6f6f6; border:#ddd solid 1px;">&nbsp;1&nbsp;</td>
                                                                                                                        <td align="center" style="background-color:#FFFFCC; border:#ddd solid 1px;">&nbsp;2&nbsp;</td>
                                                                                                                        <td align="center" style="background-color:#f6f6f6; border:#ddd solid 1px;">&nbsp;3&nbsp;</td>
                                                                                                                        <td align="center" style="background-color:#FFFFCC; border:#ddd solid 1px;">&nbsp;4&nbsp;</td>
                                                                                                                </tr>
                                                </tbody></table>
                                                                                            </span>
                                                    <!-- <span class="securitywork_lbl">CREDITREPORTS</span> -->
                                                    <span class="securitywork_txt" style="display:none;">
                                                <input type="text" value="5263" name="securitywork_txt" id="securitywork_txt" class="input" maxlength="20" style="width: 187px;">
                                            </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="left" height="32">Notes: </td>
                                                <td align="left">
                                                    <span class="note_lbl"></span>
                                                    <span class="note_txt" style="display:none;">
                                                <input type="text" value="" name="notes_txt" style="width: 187px;" id="notes_txt" class="input">
                                            </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="left" height="35"><strong> </strong></td>
                                                <td align="left" height="40">
                                           <span class="normaltext1">
                                       <input type="button" value="Save" id="save_all_fields" class="btnsubmit" href="javascript:void(0);" onclick="return edit_save_all_fields('save');" style="display:none;">
                                       &nbsp; &nbsp;
                                               <a id="cancel_all_fields" href="javascript:void(0);" onclick="return edit_save_all_fields('cancel');" style="display:none;">Cancel</a>
                                           </span>
                                                </td>
                                            </tr>
                                            </tbody></table>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body hid-desk" style="padding-bottom:0px;">
            <div class="col-md-12">
                <div id="tab-1" class="tab-content">
                    <div class="accordion" style="display: inline-block; width: 100%; margin: 30px 1% 10px;">
                        <div class="accordion-head normaltext1 close">
                            Having trouble with importing? <a href="javascript:void(0);">View importing help.</a><div class="arrow down"></div>
                        </div>
                        <div class="accordion-body" style="font-size: 12px !important; display: none;">
                            <div class="content1">
                                Import Online Credit Reports
                                <span class="clientName"> (Eric Shepard) </span>                        </div>
                            <div class="clear" style="height:10px;">
                            </div>
                            <div style="margin-left:10px; margin-right:10px;">
                                <div align="center" class="normaltext1">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tbody><tr>
                                            <td width="70%" valign="top" align="left" style="padding-right:15px;">
                                                <div class="chbox normaltext1" style="width:auto;">
                                                    Credit Report Import will only work with reports from these 5 providers. Practice it first with your <a href="https://app.creditrepaircloud.com/userdesk/index/MQ==">Sample Client</a> and <a href="https://app.creditrepaircloud.com/samples/samplereport" rel="nofollow" target="_blank">Sample Report</a> and NOT yourself or a live client.
                                                    We recommend becoming an <a href="https://app.creditrepaircloud.com/mycompany/credit_monitoring_service">affiliate with IdentityIQ and SmartCredit</a> so you can earn commissions and get  special links for your clients and to set up your client onboarding (<a href="http://support.creditrepaircloud.com/knowledge-base/using-identityiq-in-credit-repair-cloud/" target="_blank">a full guide is here</a>).  To import IdentityIQ, SmartCredit and our Sample Report no special plugins or extensions are required. But for PrivacyGuard and the others, there are extra steps and Chrome extensions to install first so that adds complication. Other providers not listed are NOT compatible and will not import.
                                                </div>
                                                <div class="clear" style="height:10px;">
                                                </div>
                                                <p style="margin-top:0px;"> <strong>Watch this video to learn about Importing from IdentityIQ or SmartCredit (they pay affiliates)</strong></p>
                                                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                    <tbody><tr>
                                                        <td width="30%" valign="top">
                                                            <a class="vediopopup imgeffect2" href="https://www.youtube.com/embed/9nhn6aieFtc?wmode=transparent&amp;feature=oembed;autoplay=1;rel=0;autohide=1;">
                                                                <div align="center" style="width:200px;height:119px;">
                                                                    <img src="https://app.creditrepaircloud.com/application/images/watch_video2.png" width="100%">
                                                                </div>
                                                            </a>
                                                        </td>
                                                        <td width="70%" valign="top" style="padding: 0 0 0 15px;">
                                                            <p style="margin-top:0px">
                                                                1. Become an affiliate, then follow the steps to set provider for or your CRC and in your client onboarding. <span class="normaltext1"><a href="http://support.creditrepaircloud.com/knowledge-base/using-identityiq-in-credit-repair-cloud/" target="_blank">Click here for all steps</a></span>.<br>
                                                                2. Use Chrome or Firefox. No extensions or plugins are needed.<br>
                                                                3. Open the client's report in the credit monitoring site.<br>
                                                                4. Click the button to download the report.<br>
                                                                5. Open the new report that you just downloaded to your computer<br>
                                                                6. Right-click in that new report and view the source code <br>
                                                                7. Copy and paste that source code into CRC (like in this video). <br>
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    </tbody></table>
                                                <!--  <p class="normaltext1">*Remember: We're not affiliated with any report providers, so we cant assist you in their sites. Most of these services give instant 3-bureau reports and scores for a $1 trial. Remember, <u>you are not their customer</u>. These are <u>consumer services</u> and your clients should order their own reports. Most users have the client sign up and provide login details. *Important: Never import more than 1 time per client, <a id="vediopopup" href="https://www.youtube.com/embed/PUyONx6pMH4?wmode=transparent&feature=oembed;autoplay=1;rel=0;autohide=1;" >to update items later click here.</a>. </p>-->
                                                <p style="margin-top:0px;"> <strong>Importing from PrivacyGuard and other providers listed (they do not have affiliates)</strong></p>
                                                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                    <tbody><tr>
                                                        <td width="30%" valign="top">
                                                            <a class="vediopopup imgeffect2" href="https://www.youtube.com/embed/L0NK_mdc3zI?wmode=transparent&amp;feature=oembed;autoplay=1;rel=0;autohide=1;">
                                                                <div align="center" style="width:200px;height:119px;">
                                                                    <img src="https://app.creditrepaircloud.com/application/images/watch_video.png" width="100%">
                                                                </div>
                                                            </a>
                                                        </td>
                                                        <td width="70%" valign="top" style="padding: 0 0 0 15px;">
                                                            <p style="margin-top:0px">
                                                                1. Use <a href="https://www.google.com/chrome/browser/" target="_blank">Google Chrome</a> and install <a href="https://chrome.google.com/webstore/detail/enable-right-click/hhojmcideegachlhfgfdhailpfhgknjm?hl=en-US" target="_blank">Enable Right Click Extension</a>.<br>
                                                                2. Open the report in Chrome, then click "View Full Report."<br>
                                                                3. Right-click in the middle of the report and choose "View Frame Source." <br>
                                                                4. Highlight all frame source code (on Windows use Control + A). <br>
                                                                5. Copy all frame source code (on Windows use Control + C). <br>
                                                                6. Click "Import Code Now" and paste the code into the field (Control + V).<br>
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    </tbody></table>

                                                <p class="chbox-blue normaltext1">
                                                    <img src="https://app.creditrepaircloud.com/application/images/blue_icon.png" width="30px" style="vertical-align:middle;margin-right: 5px">
                                                    Need to import a credit report from a non-supported provider or a PDF? <a target="_blank" href="https://www.creditrepaircloud.com/support/knowledge-base/importing-vs-manual/">Click here</a>.
                                                </p>
                                                <p style="margin:20px 0 0 0;">
                                                    <strong>IMPORTANT: </strong><br>
                                                </p><ul style="padding:0 0 0 17px;line-height: 21px;">
                                                    <li>If you want to earn commissions, sign up with IdentityIQ and SmartCredit so you will get your special affiliate links (Visit MY COMPANY&gt;CREDIT MONITORING SERVICE for details and Steps.  And then be sure to and change settings in your MY COMPANY&gt;CLIENT PORTAL&gt;CLIENT ONBOARDING OPTIONS. <span class="normaltext1"><a target="_blank" href="http://support.creditrepaircloud.com/knowledge-base/using-identityiq-in-credit-repair-cloud/">Click here for a full guide.</a></span> </li>
                                                    <li> Never learn with a live client or live report. Learn first with your <a href="https://app.creditrepaircloud.com/userdesk/index/MQ==">Sample Client</a> and <a href="https://app.creditrepaircloud.com/samples/samplereport" rel="nofollow" target="_blank">Sample Report</a>. </li>
                                                    <li> Most credit monitoring services give 3-bureau reports and scores for a $1 trial. Remember, you are <u>not</u> their
                                                        customer. These are <u>consumer</u> services and your clients should order <u>their own</u> reports. </li>
                                                    <li> Most credit repair companies have their client sign up and provide login details. How you handle this is between
                                                        you and your client. We're not affiliated with report providers and we cannot assist you in their sites.</li>
                                                    <li> Never import more than <u>once</u> per client, to "update" items later <a class="vediopopup" href="https://www.youtube.com/embed/PUyONx6pMH4?wmode=transparent&amp;feature=oembed;autoplay=1;rel=0;autohide=1;">click here</a>. </li>
                                                </ul>
                                                <p></p>
                                                <p style="margin:0px 0;">
                                                    <strong>Troubleshooting (common issues): </strong><br>
                                                </p><ul style="padding:0 0 0 17px;line-height: 21px;">
                                                    <li>Not using our 5 listed providers. </li>
                                                    <li>Not using <a href="https://www.google.com/chrome/browser/" target="_blank">Google Chrome</a> and the <a href="https://chrome.google.com/webstore/detail/enable-right-click/hhojmcideegachlhfgfdhailpfhgknjm?hl=en-US" target="_blank">Enable Right Click Extension</a>.</li>
                                                    <li>Not clicking VIEW FULL REPORT" in the report.</li>
                                                    <li>Not copying the correct frame source code.</li>
                                                    <li>Not learning first with <a href="https://app.creditrepaircloud.com/userdesk/index/MQ==">Sample Client</a> and <a href="https://app.creditrepaircloud.com/samples/samplereport" rel="nofollow" target="_blank">Sample Report</a>.</li>
                                                </ul>
                                                <p></p>


                                                <div id="auto_report_back_save" title="You have unsaved changes">
                                                    <p>Are you sure you want to leave this page without saving your credit report access details? </p>
                                                </div>
                                                <style type="text/css">
                                                    .ui-widget-overlay{
                                                        width: 1210px;
                                                        height: 1160px;
                                                        z-index: 1001;
                                                        background: rgb(0, 0, 0);
                                                        opacity: 0.8;
                                                    }
                                                </style>
                                            </td>
                                            <td valign="top" align="center" width="30%">
                                                <style type="text/css">
                                                    .videolist img { opacity:0.7; width:40px; }
                                                    .videolist img:hover { opacity:1; }
                                                </style>
                                                <div style="width:auto; padding:20px 20px; background:#6dcff6; border-radius:5px; margin-top:0px;">
                                                    <h2 style="margin:0px;">Credit Import Resources</h2>
                                                    <div style="text-align:left;">
                                                        <p><img src="https://app.creditrepaircloud.com/application/images/1_small.png" height="30" alt=" " style="vertical-align:middle;">You <u>must</u> use Google Chrome</p>
                                                        <div style="padding-left:15px;">
                                                            <a href="https://www.google.com/chrome/browser/" class="imgeffect1" target="_blank">
                                                                <img src="https://app.creditrepaircloud.com/application/images/chrome_logo.png" alt=" " style="vertical-align:middle;"> </a>
                                                        </div>
                                                        <p><img src="https://app.creditrepaircloud.com/application/images/2_small.png" height="30" alt=" " style="vertical-align:middle;"> Install "Allow Right Click" Extension</p>
                                                        <div style="padding-left:15px;">
                                                            <a href="https://chrome.google.com/webstore/detail/enable-right-click/hhojmcideegachlhfgfdhailpfhgknjm?hl=en-USThis tool will import online reports from these 6 provide" target="_blank" class="imgeffect1">
                                                                <img src="https://app.creditrepaircloud.com/application/images/add-right-click-sm.png">
                                                            </a>
                                                        </div>
                                                        <p><img src="https://app.creditrepaircloud.com/application/images/3_small.png" height="30" alt=" " style="vertical-align:middle;"> Learn with Sample Client &amp; Report</p>
                                                        <div style="padding-left:15px;">
                                                            <a href="https://app.creditrepaircloud.com/samples/samplereport" rel="nofollow" target="_blank" class="imgeffect1">
                                                                <img src="https://app.creditrepaircloud.com/application/images/sample_report.png" alt=" " style="vertical-align:middle;">
                                                            </a>
                                                        </div>
                                                        <p><img src="https://app.creditrepaircloud.com/application/images/4.png" height="30" alt=" " style="vertical-align:middle;"> Need help? Schedule a session. </p></div><p></p>
                                                    <div style="padding-left:15px; text-align:left;">
                                                        <a href="https://app.creditrepaircloud.com/expert" class="imgeffect1" style="background:url(https://app.creditrepaircloud.com/application/images/tifarrah_img_help_hover) no-repeat;"><img src="https://app.creditrepaircloud.com/application/images/issac_help.png" alt=" " style="vertical-align:middle;"></a>
                                                    </div>
                                                    <p style="text-align:left;margin-top: 30px;">
                                                        <strong>On a Mac?</strong><br>
                                                        Use "Command" instead of "Control".
                                                        Highlight All = Command + A<br>
                                                        Copy = Command + C<br>
                                                        Paste = Command + V<br>
                                                    </p>
                                                    <p style="text-align:left;margin-top:20px;">
                                                        <strong>Additional Right-Click Extensions:</strong><br>
                                                        <a target="_blank" href="https://chrome.google.com/webstore/detail/enable-right-click/hhojmcideegachlhfgfdhailpfhgknjm">Enable Right Click for Chrome</a><br>
                                                        <a target="_blank" href="https://chrome.google.com/webstore/detail/righttocopy/plmcimdddlobkphnofejmeidjblideca">Right to Copy for Chrome</a>
                                                    </p>
                                                    <p style="text-align:left;margin-top:20px;">
                                                        <strong>Got a PDF or a different provider?</strong><br>
                                                        <a target="_blank" href="https://www.creditrepaircloud.com/support/knowledge-base/importing-vs-manual/">Click here</a><br>
                                                    </p>
                                                </div></td>
                                        </tr>
                                        </tbody></table>
                                    <p class="redfont" align="left">*We are not affiliated with any credit monitoring services and we do not provide support for their services. Your client is signing up to receive instant reports and scores, but you or the client must remember to cancel with that company before the end of the free trial if they do not want to be billed for credit monitoring services.
                                    </p>
                                </div>
                                <div class="tips" style="width:97%; border:#b4b4b4 solid 1px;">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tbody>
                                        <tr>
                                            <td width="5%" valign="top"><img src="https://app.creditrepaircloud.com/application/images/light_bulb.png" alt=" "></td>
                                            <td width="95%" align="left" valign="middle" class="normaltext1">
                                                We recommend that the client sign up for the credit monitoring services and give the login details to you. Then they will be responsible for their own service and
                                                can cancel anytime they like. We recommend credit monitoring as the best way for the client to see the success of your work and monthly changes to the score.
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div>
                                <br><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>