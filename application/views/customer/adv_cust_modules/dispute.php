<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="dispute module_med ui-state-default"  data-id="<?= $id ?>" id="<?= $id ?>">
    <div class="col-sm-12 individual-module-big">
        <h6>Dispute</h6>
        <div class="row">
            <div class="statuscontent">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tbody><tr>
                        <td width="25%">&nbsp;</td>
                        <td width="22%" align="center" valign="middle">
                            <img alt="" src="https://app.creditrepaircloud.com/application/images/equifax.png" class="" style="height:16px;width: 63px;vertical-align:middle;">    </td>
                        <td width="22%" align="center" valign="middle">
                            <img alt="" src="https://app.creditrepaircloud.com/application/images/experian.png" class="" style="height:16px;width: 63px;vertical-align:middle;">    </td>
                        <td width="22%" align="center" valign="middle">
                            <img alt="" src="https://app.creditrepaircloud.com/application/images/trans_union.png" class="" style="height:16px;width: 63px;vertical-align:middle;">    </td>

                    </tr>
                    <tr>
                        <td height="10" align="left" valign="top"></td>
                        <td height="10" align="center" valign="top"></td>
                        <td height="10" align="center" valign="top"></td>
                        <td height="10" align="center" valign="top"></td>

                    </tr>

                    <tr>
                        <td height="20" align="left" valign="top" class="num8">Unspecified</td>
                        <td align="center" valign="top" class="num8">0</td>
                        <td align="center" valign="top" class="num8">0</td>
                        <td align="center" valign="top" class="num8">0</td>

                    </tr>
                    <tr>
                        <td height="20" align="left" valign="top" class="num1">Positive</td>
                        <td align="center" valign="top" class="num1">0</td>
                        <td align="center" valign="top" class="num1">0</td>
                        <td align="center" valign="top" class="num1">0</td>

                    </tr>
                    <tr>
                        <td height="20" align="left" valign="top" class="num1">Deleted</td>
                        <td align="center" valign="top" class="num1">0</td>
                        <td align="center" valign="top" class="num1">0</td>
                        <td align="center" valign="top" class="num1">0</td>

                    </tr>
                    <tr>
                        <td height="20" align="left" valign="top" class="num1">Repaired</td>
                        <td align="center" valign="top" class="num1">0</td>
                        <td align="center" valign="top" class="num1">0</td>
                        <td align="center" valign="top" class="num1">0</td>

                    </tr>
                    <tr>
                        <td height="20" align="left" valign="top" class="num4">In Dispute</td>
                        <td align="center" valign="top" class="num4">0</td>
                        <td align="center" valign="top" class="num4">0</td>
                        <td align="center" valign="top" class="num4">0</td>

                    </tr>
                    <tr>
                        <td height="20" align="left" valign="top" class="num6">Verified</td>
                        <td align="center" valign="top" class="num6">0</td>
                        <td align="center" valign="top" class="num6">0</td>
                        <td align="center" valign="top" class="num6">0</td>

                    </tr>
                    <tr>
                        <td height="20" align="left" valign="top" class="num6">Negative</td>
                        <td align="center" valign="top" class="num6">0</td>
                        <td align="center" valign="top" class="num6">0</td>
                        <td align="center" valign="top" class="num6">0</td>

                    </tr>
                    <tr>
                        <td height="20" align="left" valign="top" class="num1">Updated</td>
                        <td align="center" valign="top" class="num1">0</td>
                        <td align="center" valign="top" class="num1">0</td>
                        <td align="center" valign="top" class="num1">0</td>

                    </tr>

                    <tr class="num6" style="white-space: nowrap;">
                        <td height="30" align="left" valign="top" class="num7">Bureau Letters</td>

                        <td align="center" valign="top" class="num7">0</td>
                        <td align="center" valign="top" class="num7">0</td>
                        <td align="center" valign="top" class="num7">0</td>
                    </tr>
                    <tr>
                        <td height="20" style="border-top:1px solid #ccc;" colspan="4" align="center" valign="bottom" class="num7">Furnisher Letters : 0</td>
                    </tr>
                    </tbody></table>
                <div class="clear" style="height:10px;"></div>
                <div align="center">
                    <a class="btngreen js-qwynlraxz" href="#" style="color:#FFFFFF; text-decoration:none; width:87%; display:block; ">

                        View/Update All Dispute Items					</a>
                </div>
                <div class="clear" style="height:10px;"></div>
                <div>
                    <!-- updated by bhavik on 04-09-2015 Start (Display tool-tip to restriction to use import online credit report functionality outside USA) -->


                    <a class="btnsubmit js-qwynlraxz" href="" style="color:#FFFFFF; text-decoration:none; width:87%; display:block; ">
                        Import Online Credit Reports</a>
                    <!-- updated by bhavik on 04-09-2015 End -->
                </div>
            </div>
            <!--<div class="chart2">
                <div class="dropall" style="text-align:center;">
                    <select name="bureau_drop_down" id="bureau_drop_down" style="width:100px; margin:5px 0 0 0px;" class="dropdown" onchange="return drawPieChart('Doughnut2D', 'PieChartId', '140', '175', 'chart_div', this.value);">
                        <option value="">All</option>
                        <option value="1">Equifax</option>
                        <option value="2">Experian</option>
                        <option value="3">Transunion</option>

                    </select></div>

                <<div style="text-align:center; margin-top:-18px;"><span class="progressBar" id="pb1"><img id="pb1_pbImage" title=" 0.00%" alt=" 0.00%" src="https://app.creditrepaircloud.com/application/images/progressbar.gif" width="120" style="width: 120px; height: 12px; background-image: url(&quot;https://app.creditrepaircloud.com/application/images/progressbg_green.gif&quot;); background-position: -120px 50%; padding: 0px; margin: 5px 0px;"><span id="pb1_pbText"> 0.00%</span></span></div>

                <div class="breakline"></div>
                <div class="completetext" style="padding-right:0px; margin-top:1px;text-align:center;margin: 20px 0px;">

                    <a href="https://app.creditrepaircloud.com/userdesk/saved_letters/NTk=" id="my_save_letter_pp" class="js-qwynlraxz">
                        Client's Saved Letters</a>
                    <br>
                    <a href="javascript:void(0);" onclick="return viewImportPDFPopUp()" class="js-qwynlraxz">
                        Document Storage</a>
                    <br>
                </div>-->
        </div>
    </div>
    <div style="margin-left:50px;  padding-top:30px;" align="left" class="normaltext1">
        <a href="#" style="color:#58bc4f;">Last Letter Sent</a>&nbsp;&nbsp;
        <!--  <a href="javascript:void(0);">Action/Notes</a>-->
    </div>
</div>