<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="memos module ui-state-default" id="memo">
    <div class="col-sm-12">
        <div class="row">
            <div id="momo_edit_btn" class="pencil">
                			  	<!--<img width="16px" height="16px" src="https://app.creditrepaircloud.com/application/images/pencil.png">-->
            </div>
            <div id="memo_input_div" style="display:none;">
                <div style=" width:100%; height:200px;">
                    <textarea name="memo_txt" id="memo_txt" style="width:400px; height:93px;" class="input">jhghj</textarea> &nbsp;
                    <input name="memo_submit" type="button" value="Save Memo" class="btnsubmit" id="memo_submit" style="vertical-align:bottom;">
                    <input name="memo_cancel" type="button" value="Cancel" class="btnsubmit memo_cancel" id="memo_cancel" style="vertical-align:bottom;">
                </div>
                <div id="memo_txt_div" style="font-size:12px; padding:3px; height:120px;">jhghj</div>
                <div align="right" class="normaltext1" style="padding-right:15px;">
                    <a href="#" id="clear_memo" name="clear_memo" style="" class="js-qwynlraxz">Clear Memo</a>
                </div>
            </div>
            <div style="margin-right:15px; padding-top:1px;" align="right" class="normaltext1">
                <a href="#" style="color:#58bc4f;"><span class="fa fa-upload"></span> Upload File</a>&nbsp;&nbsp;
                <!--  <a href="javascript:void(0);">Action/Notes</a>-->
            </div>
        </div>
    </div>
</div>