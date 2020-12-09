<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style type="text/css">
.loader
{
    display: none !important;
}
</style>
<!-- Add Check -->
    <div id="overlay-check-tx" class="overlay"></div>
    <div id="side-menu-check-tx" class="open-side-nav" style="width: 100%;overflow-x: hidden;overflow-y: auto;">
        <div style="background-color: #f4f5f8">
            <div class="side-title">
                <h4 id="memo_sc_nm"></h4>
                <a id="close-menu-check-tx" class="menuCloseButton" onclick="closeCheck()"><span id="side-menu-close-text">
                <i class="fa fa-times"></i></span></a>
            </div>
            <div style="margin-left: 20px;">
                <div class="row" style="margin-bottom:20px">
                    <div class="col-md-3">
                        <select name="check_payee_popup" id="check_payee_popup" class="form-control">
                            <option value="" disabled="" selected>Payee</option>
                            <?php
                            foreach($this->AccountingVendors_model->select() as $ro)
                            {
                            ?>
                            <option value="<?=$ro->id?>"><?php echo $ro->f_name." ".$ro->l_name?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-control" name="check_account_popup" id="check_account_popup">
                            <?php
                               $i=1;
                               foreach($this->chart_of_accounts_model->select() as $row)
                               {
                                ?>
                                <option <?php if($this->reconcile_model->checkexist($row->id) != $row->id): echo "disabled"; ?>
                                <?php endif ?> value="<?=$row->id?>"><?=$row->name?></option>
                              <?php
                              $i++;
                              }
                               ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <h6>Balance: $0.00</h6>
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <h6 id="checkamount">Amount:$0.00</h6>
                    </div>
                </div>
                <div class="row" style="margin-bottom:20px">
                    <div class="col-md-2">
                        <label>Mailing Address:</label>
                        <textarea name="check_mailing_add" id="check_mailing_add" rows="4"></textarea>
                    </div>
                    <div class="col-md-2">
                        <label>Payment date:</label>
                        <div class="col-xs-10 date_picker">
                            <input type="text" name="check_date_popup" id="check_date_popup" class="form-control" value=""/>
                        </div>
                    </div>
                    <div class="col-md-4"></div>
                    <div class="col-md-2">
                        <label>Check no.</label>
                        <input type="text" name="check_checkno" id="check_checkno" value="" class="form-control"/>
                        </br>
                        </br> 
                        <input type="checkbox" name="check_print_check" class="form-control">Print Later
                    </div>
                </div>
                <div class="row" style="margin-bottom:20px">
                    <div class="col-md-8"></div>
                    <div class="col-md-2">
                        <label>Permit no.</label>
                        <input type="text" name="check_permitno" value="" class="form-control" />
                    </div>
                </div>
            </div>
        </div>

        <div style="margin-left: 20px">
            <section class="table-wrapper">
                <div class="container">
                    <table class="table" id="participantCheckTable">
                        <thead>
                            <tr>
                               <th></th>
                               <th>#</th>
                               <th>Category</th>
                               <th>Description</th>
                               <th>Amount</th>
                               <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr onclick="trClickCheckMain()" style="display: none;">
                                <td><i class="fa fa-th"></i></td>
                                <td>1</td>
                                <td>
                                    <select name='check_expense_account' id='check_expense_account' class='' style="display: none;">
                                        <option value=""></option>
                                        <?php
                                        foreach ($this->account_sub_account_model->get() as $rw)
                                        {
                                            ?>
                                           <option value="<?=$rw->sub_acc_name?>"><?=$rw->sub_acc_name?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <div class="check_expense_account"></div>
                                </td>
                                <td>
                                    <input type="hidden" id="check_descp" name="check_descp" value="" placeholder="What did you paid for?">
                                    <div class="check_descp"></div>
                                </td>
                                <td>
                                     <input type="hidden" id="check_service_charge" name="check_service_charge" value="">
                                    <div class="check_service_charge"></div>
                                </td>
                                <td><a href="javascript:void(0);" class="remove_check"><i class="fa fa-trash"></i></a></td>
                            </tr>
                            <tr onclick="trClickCheck(2)">
                                <td><i class="fa fa-th"></i></td>
                                <td>1</td>
                                <td>
                                    <select name='check_expense_account_2' id='check_expense_account_2' class='' style="display: none;">
                                        <option value=""></option>
                                        <?php
                                        foreach ($this->account_sub_account_model->get() as $rw)
                                        {
                                            ?>
                                           <option value="<?=$rw->sub_acc_name?>"><?=$rw->sub_acc_name?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <div class="check_expense_account_2"></div>
                                </td>
                                <td>
                                    <input type="hidden" id="check_descp_2" name="check_descp_2" value="" placeholder="What did you paid for?">
                                    <div class="check_descp_2"></div>
                                </td>
                                <td>
                                     <input type="hidden" id="check_service_charge_2" name="check_service_charge_2" value="">
                                    <div class="check_service_charge_2"></div>
                                </td>
                                <td><a href="javascript:void(0);" class="remove_check"><i class="fa fa-trash"></i></a></td>
                            </tr>
                            <tr class="pr participantCheckRow Checkhide">
                                <td><i class="fa fa-th"></i></td>
                                <td>0</td>
                                <td>
                                    <select name='check_expense_account_' id='check_expense_account_' class='' style="display: none;">
                                        <option value=""></option>
                                        <?php
                                        foreach ($this->account_sub_account_model->get() as $rw)
                                        {
                                            ?>
                                           <option value="<?=$rw->sub_acc_name?>"><?=$rw->sub_acc_name?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <div class="check_expense_account_"></div>
                                </td>
                                <td>
                                    <input type="hidden" id="check_descp_" name="check_descp_" value="" placeholder="What did you paid for?">
                                    <div class="check_descp_"></div>
                                </td>
                                <td>
                                     <input type="hidden" id="check_service_charge_" name="check_service_charge_" value="">
                                    <div class="check_service_charge_"></div>
                                </td>
                                <td><a href="javascript:void(0);" class="remove_check"><i class="fa fa-trash"></i></a></td>
                            </tr>

                        </tbody>
                    </table>

                    <div class="btn-group">
                        <a href="javascript:void(0);" class="btn-add-bx add_check">Add Lines</a>
                        <a href="javascript:void(0);" class="btn-add-bx clear_check">Clear All Lines</a>
                    </div>
                    <div class="btn-group hidemecheck" style="display: none;">
                        <a href="javascript:void(0);" class="btn-add-bx"  onclick="rightclickCheck()">Save<i class="fa fa-check"></i></a>
                        <a href="javascript:void(0);" class="btn-add-bx"  onclick="crossClickCheck()">Cancel<i class="fa fa-close"></i>
                    </div>
                </div>
            </section>

            <div class="row" style="margin-bottom:20px">
                <div class="col-md-4">
                    <label>Memo</label>
                    </br>
                    <textarea name="check_memo_sc" id="check_memo_sc" rows="4"></textarea>
                </div>
                <div class="col-md-6"></div>
                <div class="col-md-2">
                    <h6 id="checktotal">Total : $0.00</h6>
                </div>
            </div>
            <div class="row" style="margin-bottom:20px">
                <div class="col-md-4">
                    <label><i class="fa fa-paperclip"></i>Attachment</label>
                    </br>
                    <iframe name="hiddenFramecheck" width="0" height="0" border="0" style="display: none;"></iframe>
                    <form action="<?php echo url('accounting/reconcile/do_upload/') ?><?=$rows[0]->chart_of_accounts_id?>" class="uploadmy" method="post" name="checkForm" enctype="multipart/form-data" target="hiddenFramecheck">
                    <div class="file-upload-block">
                        <div class="upload-btn-wrapper">
                            <button class="btn ubw">
                                <i class="fa fa-cloud-upload"></i>
                                <h6>Drag and drop files here or <span>browse to upload</span></h6>
                            </button>
                            <input type="file" name="userfile_newcheck" />
                            <input type="hidden" name="reconcile_id">
                            <input type="hidden" name="subfix" value="newcheck">
                        </div>
                    </div>
                    </br>
                    <button type="submit" class="form-control">Upload</button>
                    </form>
                    </br>
                    <a href="#" onclick="openSideNav()">Show existing</a>
                </div>
            </div>
        </div>
     
        <div class="save-act" style="position: unset !important;">
            <button type="button" class="btn-cmn" onclick="closeCheck()">Cancel</button>
            <a href="#" style="margin-left: 30%" onclick="openPrintNav()">Print check</a>
            <a href="#" style="margin-left: 30%" >Make recurring</a>
            <button type="button" class="savebtn" onclick="save_check()" >Save and close</button>
        </div>
    </div>
    <!-- End Add Check -->
<?php include viewPath('includes/footer_accounting'); ?>
<script type="text/javascript">
addCheck();
$(document).ready(function() {
        addCheck();
 });
function addCheck()
{
    closePrintNav();
    jQuery("#side-menu-check-tx").addClass("open-side-nav");
    jQuery("#side-menu-check-tx").css("width","100%");
    jQuery("#side-menu-check-tx").css("overflow-y","auto");
    jQuery("#side-menu-check-tx").css("overflow-x","hidden");
    jQuery("#overlay-check-tx").addClass("overlay");
}
function closeCheck() 
{
   
    jQuery("#side-menu-check-tx").removeClass("open-side-nav");
    jQuery("#side-menu-check-tx").css("width","0%");
    jQuery("#overlay-check-tx").removeClass("overlay");
}
</script>