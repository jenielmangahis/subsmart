<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="memos module ui-state-default" id="memo">
    <div class="col-sm-12">
        <div class="row">
            <div id="momo_edit_btn" class="pencil" >
                <?= isset($profile_info) ? $profile_info->notes : ''; ?>
            </div>
            <div id="memo_input_div" style="display:none;">
                <div style=" width:100%; height:200px;">
                    <textarea name="memo_txt" id="memo_txt" style="width:400px; height:135px;" class="input"><?= isset($profile_info) ? $profile_info->notes : ''; ?></textarea>
                    <button class="btn btn-primary btn-sm" id="save_memo" style="color: #ffffff;"><span class="fa fa-save"></span> Save Memo</button>
                    <a class="btn btn-primary btn-sm" id="memo_cancel" href="javascript:void(0);" style="color: #ffffff;"><span class="fa fa-remove"></span> Cancel</a>
                </div>
                <div align="right" class="normaltext1" style="padding-right:15px;">
                    <a href="#" id="clear_memo" name="clear_memo" style="" class="js-qwynlraxz">Clear Memo</a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    #momo_edit_btn {
       background: url('/assets/img/customer/images/pencil_big.png') center no-repeat;
        width: 440px;
        height: 150px;
        float: left;
        margin-right: 10px;
        cursor: pointer;
        overflow: auto;
        font-size: 13px;
    }
</style>