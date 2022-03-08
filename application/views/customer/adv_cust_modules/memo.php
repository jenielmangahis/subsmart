<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="memos module ui-state-default" data-id="<?= $id ?>"    id="<?= $id ?>">
    <div class="col-sm-12 individual-module">
        <h6>Memo</h6>
        <div class="row">            
            <div id="memo_input_div">
                <div style=" width:100%; height:200px;">
                    <textarea disabled="" readonly="" name="memo_txt" id="memo_txt" style="width:400px; height:135px !important;" class="input form-control"><?= isset($profile_info) ? $profile_info->notes : ''; ?></textarea>
                    <div class="mt-2 memo-update-tools" style="display:none;">
                        <button class="btn btn-primary btn-sm" id="save_memo" style="color: #ffffff;"><span class="fa fa-save"></span> Save Memo</button>
                        <a class="btn btn-primary btn-sm" id="memo_cancel" href="javascript:void(0);" style="color: #ffffff;"><span class="fa fa-remove"></span> Cancel</a>
                    </div>
                    <div class="mt-2 memo-edit-tools">                        
                        <a href="javasacript:void(0);" class="btn btn-primary btn-sm" id="edit_memo" style="color: #ffffff;"><i class="fa fa-pencil"></i> Edit Memo</a>
                        <a href="javascript:void(0);" class="btn btn-primary btn-sm" id="clear_memo" name="clear_memo" style="color: #ffffff;"><i class="fa fa-eraser"></i> Clear Memo</a>
                    </div>
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