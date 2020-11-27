<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<style type="text/css">
    .hide-toggle::after {
        display: none;
    }
    .show>.btn-primary.dropdown-toggle {
    background-color: #32243D;
    border: 1px solid #32243D;
}
    .p-padding{
        padding-left: 10%;
    }
    .dropdown-menu[x-placement^=top] {
    margin-left: -50px;
}
.nav-pills .nav-link.active, .nav-pills .show>.nav-link {
    background: #32243D;
}
.loader
{
    display: none !important;
}
.upload-btn-wrapper,.ubw
{
    height: 150px !important;
}
.hide,.Checkhide,.Recurrhide,.hideint,.hidemefinal,.RecurrhideInt,.hidemefinal_int
{
    display: none;
}
.gmail:not(.show) {
    display: none;
}
@media print {
    .print_disnone {
        display: none;
    }
    .print_disshow{
        display: block !important;
    }
}
</style>
<?php 
$accBalance = $this->chart_of_accounts_model->getBalance($rows[0]->chart_of_accounts_id);
?>
    <!-- Popup -->
    <div class="modal fade" id="popup-opn" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="reconciliblock">
                    <div class="error-block">
                        <div class="error-ic">
                            <i class="fa fa-info-circle"></i>
                        </div>
                        <div class="error-dt">
                            <h4>Reconciliation saved for later.</h4>
                            <p>You can upload statements to this reconcilation to find it when you come back later.</p>
                        </div>
                    </div>

                    <div class="action-popup">
                        <a href="#" class="btn-main uplobtn" id="menuButton" onclick="openSideNav3()">Upload statement</a>
                        <a href="#" class="btn-main">Done</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Popup -->

    <!-- Close Popup -->
    <div class="modal fade" id="popup-cls" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="reconciliblock">
                    <div class="error-block">
                        <div class="error-ic">
                            <i class="fa fa-info-circle"></i>
                        </div>
                        <div class="error-dt">
                            <h4>We'll remove all of your changes</h4>
                            <p>If you close without saving your work, we reset all the transactions to their original state when you opened this reconciliation session. We also remove the statement info that you entered.</p>
                        </div>
                    </div>

                    <div class="action-popup">
                        <a href="#" class="btn-main uplobtn" id="menuButton" onclick="closedelete(<?=$rows[0]->id?>)">Close without saving</a>
                        <a href="#" class="btn-main">Go back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Close Popup -->

    <!-- Finish Popup -->
    <div class="modal fade" id="popup-finish" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="reconciliblock">
                    <div class="error-block">
                        <div class="error-ic">
                            <i class="fa fa-check-circle"></i>
                        </div>
                        <div class="error-dt">
                            <h4>You reconciled this account</h4>
                            <p>To see a report of this reconcilation, click <a href= "<?=url('accounting/reconcile/view/report/'.$rows[0]->chart_of_accounts_id.'')?>">view reconilation report<a>.Otherwise, you're done!</p>
                        </div>
                    </div>

                    <div class="action-popup">
                        <a href="#" class="btn-main uplobtn" id="menuButton">Attach statement</a>
                        <a href="#" class="btn-main">Done</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Finish Popup -->

    <!-- Hold Popup -->
    <div class="modal fade" id="popup-hold" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="reconciliblock">
                    <div class="error-block">
                        <div class="error-ic">
                            <i class="fa fa-info-circle"></i>
                        </div>
                        <div class="error-dt">
                            <h4>Hold on! Your difference isn't $0.00 yet.</h4>
                            <p>You aren't ready to reconcile yet because your transactions in QuickBooks don't match your statement. When they match, you'll have a difference of $0.00. Help me find the problem</p>
                            <p>If you'd still like to proceed, confirm the following below, and then click Add adjustment and finish.</p>
                            <p>
                                <label>Adjustment Date*</label>
                                <div class="row">
                                    <div class="col-xs-1 date_picker">
                                        <input type="text" required="required" id="adjustment_date" name="adjustment_date" class="form-control">
                                    </div>
                                </div>
                            </p>
                        </div>
                    </div>

                    <div class="action-popup">
                        <a href="#" class="btn-main uplobtn" id="menuButton" onclick="openFinishpop(<?=$rows[0]->id?>)">Add adjustment and finish</a>
                        <a href="#" class="btn-main">Go back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hold Popup -->

    <!-- Preview Popup -->
    <div id="overlay-preview-tx" class=""></div>
    <div id="side-menu-preview-tx" class="main-side-nav">
        <div class="side-title">
            <a id="close-menu-preview-tx" class="menuCloseButton" onclick="closePreview()"><span id="side-menu-close-text">
            <i class="fa fa-times"></i></span></a>
        </div>
        
        <div class="mainMenu nav">
            <img src="" name="previewImage" class="img-responsive" id="previewImage">
        </div>
    </div>
    <!-- End Preview Popup -->


    <!-- Add Custom Tax Sidebar -->
    <div id="overlay-cus-tx" class=""></div>
    <div id="side-menu-cus-tx" class="main-side-nav">
        <div class="side-title">
            <h4>Statement attachments - Cash on hand</h4>
            <a id="close-menu-cus-tx" class="menuCloseButton" onclick="closeSideNav3()"><span id="side-menu-close-text">
            <i class="fa fa-times"></i></span></a>
        </div>
        
        <?php echo form_open_multipart('accounting/reconcile/do_upload/'.$rows[0]->chart_of_accounts_id);?>
        <div class="mainMenu nav">
            <div class="file-upload-block">
                <div class="upload-btn-wrapper">
                    <button class="btn ubw">
                        <i class="fa fa-cloud-upload"></i>
                        <h6>Drag and drop files here or <span>browse to upload</span></h6>
                    </button>
                    <input type="file" name="userfile_sidebar" />
                    <input type="hidden" name="reconcile_id" value="<?=$rows[0]->id?>">
                    <input type="hidden" name="subfix" value="sidebar">
                </div>
            </div>
        </div>

        <div class="save-act">
            <button type="button" class="btn-cmn" onclick="closeSideNav3()">Cancel</button>
            <button type="submit" class="savebtn">Done</button>
        </div>
        <?php echo form_close(); ?>
    </div>
    <!-- End Add Custom Tax Sidebar -->

    <!-- Edit New -->
    <div id="overlay-full-tx" class=""></div>
    <div id="side-menu-full-tx" class="main-side-nav">
        <div style="background-color: #f4f5f8">
            <div class="side-title">
                <h4 id="memo_sc_nm"></h4>
                <a id="close-menu-full-tx" class="menuCloseButton" onclick="closeFullNav()"><span id="side-menu-close-text">
                <i class="fa fa-times"></i></span></a>
            </div>
            <div style="margin-left: 20px;">
                <div class="row" style="margin-bottom:20px">
                    <div class="col-md-3">
                        <select name="payee_popup" class="form-control">
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
                        <select class="form-control" id="account_popup">
                            <?php
                               $i=1;
                               foreach($this->chart_of_accounts_model->select() as $row)
                               {
                                ?>
                                <option <?php if($this->reconcile_model->checkexist($row->id) != $row->id): echo "disabled"; ?>
                                <?php endif ?> <?php if($row->id == $rows[0]->chart_of_accounts_id): echo "selected"; endif?> value="<?=$row->id?>"><?=$row->name?></option>
                              <?php
                              $i++;
                              }
                               ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <h6>Balance:<?=number_format($this->chart_of_accounts_model->getBalance($rows[0]->chart_of_accounts_id),2);?></h6>
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <h6 id="amount">Amount:$<?=number_format($rows[0]->service_charge,2);?></h6>
                    </div>
                </div>
                <div class="row" style="margin-bottom:20px">
                    <div class="col-md-2">
                        <label>Mailing Address:</label>
                        <textarea name="mailing_add" id="mailing_add" rows="4"><?=$rows[0]->mailing_address?></textarea>
                    </div>
                    <div class="col-md-2">
                        <label>Payment date:</label>
                        <div class="col-xs-10 date_picker">
                            <input type="text" name="date_popup" id="date_popup" class="form-control" value="<?=$rows[0]->first_date?>"/>
                        </div>
                    </div>
                    <div class="col-md-4"></div>
                    <div class="col-md-2">
                        <label>Check no.</label>
                        <input type="text" name="checkno" id="checkno" class="form-control" value="<?=$rows[0]->checkno?>"/>
                        </br>
                        </br>
                        <input type="checkbox" class="form-control" name="print_check" id="print_check">Print Later
                    </div>
                </div>
                <div class="row" style="margin-bottom:20px">
                    <div class="col-md-8"></div>
                    <div class="col-md-2">
                        <label>Permit no.</label>
                        <input type="text" name="permitno" id="permitno" class="form-control" value=""/>
                    </div>
                </div>
            </div>
        </div>

        <div style="margin-left: 20px">
            <section class="table-wrapper">
                <div class="container">
                    <table class="table" id="participantTable">
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
                            <tr onclick="trClickEditMain()">
                                <td><i class="fa fa-th"></i></td>
                                <td>1</td>
                                <td>
                                    <select name='edit_expense_account' id='edit_expense_account' class='' style="display: none;">
                                        <?php
                                        foreach ($this->account_sub_account_model->get() as $rw)
                                        {
                                            ?>
                                           <option <?php if($rows[0]->expense_account == $rw->sub_acc_name){ echo "selected"; } ?> value="<?=$rw->sub_acc_name?>"><?=$rw->sub_acc_name?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <div class="edit_expense_account"><?=$rows[0]->expense_account?></div>
                                </td>
                                <td>
                                    <input type="hidden" id="edit_descp" name="edit_descp" value="" placeholder="What did you paid for?" value="<?=$rows[0]->descp_sc?>">
                                    <div class="edit_descp"><?=$rows[0]->descp_sc?></div>
                                </td>
                                <td>
                                     <input type="hidden" id="edit_service_charge" name="edit_service_charge" value="<?=number_format($rows[0]->service_charge,2)?>">
                                    <div class="edit_service_charge"><?=number_format($rows[0]->service_charge,2)?></div>
                                </td>
                                <td><a href="javascript:void(0);" class="remove"><i class="fa fa-trash"></i></a></td>
                            </tr>
                            <?php 
                            $servicechargecount =0;
                            if(!empty($this->reconcile_model->select_service($rows[0]->id,$rows[0]->chart_of_accounts_id)))
                            {
                            $editrowcount =2;
                            foreach($this->reconcile_model->select_service($rows[0]->id,$rows[0]->chart_of_accounts_id) as $editrowtab)
                            {
                                $servicechargecount+=$editrowtab->service_charge_sub;
                            ?>
                            <tr onclick="trClickEdit(<?=$editrowcount?>)">
                                <td data-id="<?=$editrowtab->id?>"><i class="fa fa-th"></i></td>
                                <td><?=$editrowcount?></td>
                                <td>
                                    <select name='edit_expense_account_<?=$editrowcount?>' id='edit_expense_account_<?=$editrowcount?>' data-id='<?=$editrowtab->id?>' class='up_row' style="display: none;">
                                        <option value=""></option>
                                        <?php
                                        foreach ($this->account_sub_account_model->get() as $rw)
                                        {
                                            ?>
                                           <option <?php if($editrowtab->expense_account_sub == $rw->sub_acc_name){ echo "selected"; } ?> value="<?=$rw->sub_acc_name?>"><?=$rw->sub_acc_name?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <div class="edit_expense_account_<?=$editrowcount?>"><?=$editrowtab->expense_account_sub?></div>
                                </td>
                                <td>
                                    <input type="hidden" id="edit_descp_<?=$editrowcount?>" name="edit_descp_<?=$editrowcount?>" value="<?=$editrowtab->descp_sc_sub?>" placeholder="What did you paid for?" value="<?=$editrowtab->descp_sc_sub?>">
                                    <div class="edit_descp_<?=$editrowcount?>"><?=$editrowtab->descp_sc_sub?></div>
                                </td>
                                <td>
                                     <input type="hidden" id="edit_service_charge_<?=$editrowcount?>" name="edit_service_charge_<?=$editrowcount?>" value="<?=number_format($editrowtab->service_charge_sub,2)?>">
                                    <div class="edit_service_charge_<?=$editrowcount?>"><?=number_format($editrowtab->service_charge_sub,2)?></div>
                                </td>
                                <td><a href="javascript:void(0);" class="remove"><i class="fa fa-trash"></i></a></td>
                            </tr>
                            <?php $editrowcount++; }}else{ ?>
                            <tr onclick="trClickEdit(2)">
                                <td><i class="fa fa-th"></i></td>
                                <td>2</td>
                                <td>
                                    <select name='edit_expense_account_2' id='edit_expense_account_2' class='' style="display: none;">
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
                                    <div class="edit_expense_account_2"></div>
                                </td>
                                <td>
                                    <input type="hidden" id="edit_descp_2" name="edit_descp_2" value="" placeholder="">
                                    <div class="edit_descp_2"></div>
                                </td>
                                <td>
                                    <input type="hidden" id="edit_service_charge_2" name="edit_service_charge_2" value="">
                                    <div class="edit_service_charge_2"></div>
                                </td>
                                <td><a href="javascript:void(0);" class="remove"><i class="fa fa-trash"></i></a></td>
                            </tr>
                            <?php } ?>
                            <input type="hidden" name="servicechargecount" id="servicechargecount" value="<?=$servicechargecount?>">
                            <tr class="pr participantRow hide">
                                <td><i class="fa fa-th"></i></td>
                                <td>0</td>
                                <td>
                                    <select name='edit_expense_account_' id='edit_expense_account_' class='' style="display: none;">
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
                                    <div class="edit_expense_account_"></div>
                                </td>
                                <td>
                                    <input type="hidden" id="edit_descp_" name="edit_descp_" value="" placeholder="">
                                    <div class="edit_descp_"></div>
                                </td>
                                <td>
                                    <input type="hidden" id="edit_service_charge_" name="edit_service_charge_" value="">
                                    <div class="edit_service_charge_"></div>
                                </td>
                                <td><a href="javascript:void(0);" class="remove"><i class="fa fa-trash"></i></a></td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="btn-group">
                        <a href="javascript:void(0);" class="btn-add-bx add">Add Lines</a>
                        <a href="javascript:void(0);" class="btn-add-bx clear">Clear All Lines</a>
                    </div>
                    <div class="btn-group hideme" style="display: none;">
                        <a href="javascript:void(0);" class="btn-add-bx" onclick="rightclick()">Save<i class="fa fa-check"></i></a>
                        <a href="javascript:void(0);" class="btn-add-bx"  onclick="crossClickEdit()">Cancel<i class="fa fa-close"></i>
                    </div>
                </div>
            </section>

            <div class="row" style="margin-bottom:20px">
                <div class="col-md-4">
                    <label>Memo</label>
                    </br>
                    <textarea name="memo_sc" id="memo_sc" rows="4"><?=$rows[0]->memo_sc?></textarea>
                </div>
                <div class="col-md-6"></div>
                <div class="col-md-2">
                    <h6 id="total">Total : $<?=number_format($rows[0]->service_charge,2)?></h6>
                </div>
            </div>
            <div class="row" style="margin-bottom:20px">
                <div class="col-md-4">
                    <label><i class="fa fa-paperclip"></i>Attachment</label>
                    </br>
                    <iframe name="hiddenFrame" width="0" height="0" border="0" style="display: none;"></iframe>
                    <form action="<?php echo url('accounting/reconcile/do_upload/') ?><?=$rows[0]->chart_of_accounts_id?>" class="uploadmy" method="post" name="myForm" enctype="multipart/form-data" target="hiddenFrame">
                    
                    <div class="file-upload-block">
                        <div class="upload-btn-wrapper">
                            <button class="btn ubw">
                                <i class="fa fa-cloud-upload"></i>
                                <h6>Drag and drop files here or <span>browse to upload</span></h6>
                            </button>
                            <input type="file" name="userfile_editpopup" />
                            <input type="hidden" name="reconcile_id" value="<?=$rows[0]->id?>">
                            <input type="hidden" name="subfix" value="editpopup">
                        </div>
                    </div>
                    </br>
                    <button type="submit" class="form-control">Upload</button>
                    </form>
                    </br>
                    <a href="#" onclick="showData()">Show existing</a>
                </div>
            </div>
        </div>
     
        <div class="save-act" style="position: unset !important;">
            <button type="button" class="btn-cmn" onclick="closeFullNav()">Cancel</button>
            <a href="#" style="margin-left: 20%" onclick="openPrintNav()">Print check</a>
            <a href="#" style="margin-left: 5%" onclick="OpenRecurr()">Make Recurring</a>
            <a href="#" style="margin-left: 5%" onclick="Delete(<?=$rows[0]->id?>,<?=$rows[0]->chart_of_accounts_id?>)">Delete</a>
            <a style="margin-left: 5%" href="<?php echo url('/accounting/reconcile/journal-report/'.$rows[0]->id.'/sc') ?>">Transaction Journal</a>
            <a style="margin-left: 5%" href="<?php echo url('/accounting/reconcile/audit-history/'.$rows[0]->chart_of_accounts_id."/sc") ?>">Audit History</a>
            <button type="button" onclick="save_close_edit(<?=$rows[0]->id?>,<?=$rows[0]->chart_of_accounts_id?>)" class="savebtn">Save and close</button>
        </div>
    </div>
    <!-- End Edit New -->

    <!-- Edit New Int -->
    <div id="overlay-fullint-tx" class=""></div>
    <div id="side-menu-fullint-tx" class="main-side-nav">
        <div style="background-color: #f4f5f8">
            <div class="side-title">
                <h4 id="memo_int_nm"></h4>
                <a id="close-menu-fullint-tx" class="menuCloseButton" onclick="closeFullNav_int()"><span id="side-menu-close-text">
                <i class="fa fa-times"></i></span></a>
            </div>
            <div style="margin-left: 20px;">
                <div class="row" style="margin-bottom:20px">
                    <div class="col-md-3">
                        <select class="form-control" id="int_account_popup">
                            <?php
                               $i=1;
                               foreach($this->chart_of_accounts_model->select() as $row)
                               {
                                ?>
                                <option <?php if($this->reconcile_model->checkexist($row->id) != $row->id): echo "disabled"; ?>
                                <?php endif ?> <?php if($row->id == $rows[0]->chart_of_accounts_id): echo "selected"; endif?> value="<?=$row->id?>"><?=$row->name?></option>
                              <?php
                              $i++;
                              }
                               ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <h6>Balance:<?=number_format($this->chart_of_accounts_model->getBalance($rows[0]->chart_of_accounts_id),2);?></h6>
                    </div>
                    <div class="col-md-2">
                        <label>Payment date:</label>
                        <div class="col-xs-10 date_picker">
                            <input type="text" name="int_date_popup" id="int_date_popup" class="form-control" value="<?=$rows[0]->second_date?>"/>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <h6 id="intamount">Amount:$<?=number_format($rows[0]->interest_earned,2);?></h6>
                    </div>
                </div>
            </div>
        </div>

        <div style="margin-left: 20px">
            <section class="table-wrapper">
                <div class="container">
                    <table class="table" id="participantIntTable">
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
                            <tr onclick="trClickEditMain_int()">
                                <td><i class="fa fa-th"></i></td>
                                <td>1</td>
                                <td>
                                    <select name='edit_income_account' id='edit_income_account' class='' style="display: none;">
                                        <?php
                                        foreach ($this->account_sub_account_model->get() as $rw)
                                        {
                                            ?>
                                           <option <?php if($rows[0]->income_account == $rw->sub_acc_name){ echo "selected"; } ?> value="<?=$rw->sub_acc_name?>"><?=$rw->sub_acc_name?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <div class="edit_income_account"><?=$rows[0]->income_account?></div>
                                </td>
                                <td>
                                    <input type="hidden" id="edit_descp_it" name="edit_descp_it" value="" placeholder="What did you paid for?" value="<?=$rows[0]->descp_it?>">
                                    <div class="edit_descp_it"><?=$rows[0]->descp_sc?></div>
                                </td>
                                <td>
                                     <input type="hidden" id="edit_interest_earned" name="edit_interest_earned" value="<?=number_format($rows[0]->interest_earned,2)?>">
                                    <div class="edit_interest_earned"><?=number_format($rows[0]->interest_earned,2)?></div>
                                </td>
                                <td><a href="javascript:void(0);" class="remove_int"><i class="fa fa-trash"></i></a></td>
                            </tr>
                            <?php 
                            $interestearnedcount =0;
                            if(!empty($this->reconcile_model->select_interest($rows[0]->id,$rows[0]->chart_of_accounts_id)))
                            {
                            $editrowcount =2;
                            foreach($this->reconcile_model->select_interest($rows[0]->id,$rows[0]->chart_of_accounts_id) as $editrowtab)
                            {
                                $interestearnedcount+=$editrowtab->interest_earned_sub;
                            ?>
                            <tr onclick="trClickEdit_int(<?=$editrowcount?>)">
                                <td data-id="<?=$editrowtab->id?>"><i class="fa fa-th"></i></td>
                                <td><?=$editrowcount?></td>
                                <td>
                                    <select name='edit_income_account_<?=$editrowcount?>' id='edit_income_account_<?=$editrowcount?>' data-id='<?=$editrowtab->id?>' class='up_row' style="display: none;">
                                        <option value=""></option>
                                        <?php
                                        foreach ($this->account_sub_account_model->get() as $rw)
                                        {
                                            ?>
                                           <option <?php if($editrowtab->income_account_sub == $rw->sub_acc_name){ echo "selected"; } ?> value="<?=$rw->sub_acc_name?>"><?=$rw->sub_acc_name?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <div class="edit_income_account_<?=$editrowcount?>"><?=$editrowtab->income_account_sub?></div>
                                </td>
                                <td>
                                    <input type="hidden" id="edit_descp_it_<?=$editrowcount?>" name="edit_descp_it_<?=$editrowcount?>" value="<?=$editrowtab->descp_it_sub?>" placeholder="What did you paid for?" value="<?=$editrowtab->descp_it_sub?>">
                                    <div class="edit_descp_it_<?=$editrowcount?>"><?=$editrowtab->descp_it_sub?></div>
                                </td>
                                <td>
                                     <input type="hidden" id="edit_interest_earned_<?=$editrowcount?>" name="edit_interest_earned_<?=$editrowcount?>" value="<?=number_format($editrowtab->interest_earned_sub,2)?>">
                                    <div class="edit_interest_earned_<?=$editrowcount?>"><?=number_format($editrowtab->interest_earned_sub,2)?></div>
                                </td>
                                <td><a href="javascript:void(0);" class="remove_int"><i class="fa fa-trash"></i></a></td>
                            </tr>
                            <?php $editrowcount++; }}else{ ?>
                            <tr onclick="trClickEdit_int(2)">
                                <td><i class="fa fa-th"></i></td>
                                <td>2</td>
                                <td>
                                    <select name='edit_income_account_2' id='edit_income_account_2' class='' style="display: none;">
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
                                    <div class="edit_income_account_2"></div>
                                </td>
                                <td>
                                    <input type="hidden" id="edit_descp_it_2" name="edit_descp_it_2" value="" placeholder="">
                                    <div class="edit_descp_it_2"></div>
                                </td>
                                <td>
                                    <input type="hidden" id="edit_interest_earned_2" name="edit_interest_earned_2" value="">
                                    <div class="edit_interest_earned_2"></div>
                                </td>
                                <td><a href="javascript:void(0);" class="remove_int"><i class="fa fa-trash"></i></a></td>
                            </tr>
                            <?php } ?>
                            <input type="hidden" name="interestearnedcount" id="interestearnedcount" value="<?=$interestearnedcount?>">
                            <tr class="pr participantIntRow hideint">
                                <td><i class="fa fa-th"></i></td>
                                <td>0</td>
                                <td>
                                    <select name='edit_income_account_' id='edit_income_account_' class='' style="display: none;">
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
                                    <div class="edit_income_account_"></div>
                                </td>
                                <td>
                                    <input type="hidden" id="edit_descp_it_" name="edit_descp_it_" value="" placeholder="">
                                    <div class="edit_descp_it_"></div>
                                </td>
                                <td>
                                    <input type="hidden" id="edit_interest_earned_" name="edit_interest_earned_" value="">
                                    <div class="edit_interest_earned_"></div>
                                </td>
                                <td><a href="javascript:void(0);" class="remove_int"><i class="fa fa-trash"></i></a></td>
                            </tr>
                        </tbody>
                    </table>

                    
                    <div class="row" style="margin-bottom:20px">
                        <div class="col-md-10">
                            <div class="btn-group">
                                <a href="javascript:void(0);" class="btn-add-bx add_int">Add Lines</a>
                                <a href="javascript:void(0);" class="btn-add-bx clear_int">Clear All Lines</a>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <h6 id="inttotal">Other Fund Total : $<?=number_format($rows[0]->interest_earned,2)?></h6>
                        </div>
                    </div>
                    <div class="btn-group hideme" style="display: none;">
                        <a href="javascript:void(0);" class="btn-add-bx" onclick="rightclick_int()">Save<i class="fa fa-check"></i></a>
                        <a href="javascript:void(0);" class="btn-add-bx"  onclick="crossClickEdit_int()">Cancel<i class="fa fa-close"></i></a>
                    </div>
                </div>
            </section>

            
            <div class="row" style="margin-bottom:20px">
                <div class="col-md-2">
                    <label>Memo</label>
                    </br>
                    <textarea name="memo_it" id="memo_it" rows="4"><?=$rows[0]->memo_it?></textarea>
                </div>
                 <div class="col-md-3">
                    <label>Cash back goes to</label>
                    </br>
                    <select class="form-control" id="int_cashback_popup">
                        <?php
                           $i=1;
                           foreach($this->chart_of_accounts_model->select() as $row)
                           {
                            ?>
                            <option <?php if($this->reconcile_model->checkexist($row->id) != $row->id): echo "disabled"; ?>
                            <?php endif ?> <?php if($row->id == $rows[0]->cash_back_account): echo "selected"; endif?> value="<?=$row->id?>"><?=$row->name?></option>
                          <?php
                          $i++;
                          }
                           ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <label>Cash back memo</label>
                    </br>
                    <textarea name="cash_back_memo" id="cash_back_memo" rows="4">
                        <?=$rows[0]->cash_back_memo?>
                    </textarea>
                </div>
                <div class="col-md-3">
                    <label>Cash back amount</label>
                    </br>
                    <input type="number" name="cash_back_amount" id="cash_back_amount" class="form-control" value="<?=$rows[0]->cash_back_amount?>">
                </div>
                <div class="col-md-2">
                    <h6 id="inttotal_final">Total : $<?=number_format($rows[0]->interest_earned,2)?></h6>
                </div>
            </div>
            <div class="row" style="margin-bottom:20px">
                <div class="col-md-8"></div>
                <div class="col-md-4">
                    <div class="btn-group hidemefinal" style="display: none;">
                        <a href="javascript:void(0);" class="btn-add-bx" onclick="rightclick_int_final()">Save<i class="fa fa-check"></i></a>
                        <a href="javascript:void(0);" class="btn-add-bx"  onclick="crossClickEdit_int_final()">Cancel<i class="fa fa-close"></i></a>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-bottom:20px">
                <div class="col-md-4">
                    <label><i class="fa fa-paperclip"></i>Attachment</label>
                    </br>
                    <iframe name="hiddenFrame" width="0" height="0" border="0" style="display: none;"></iframe>
                    <form action="<?php echo url('accounting/reconcile/do_upload/') ?><?=$rows[0]->chart_of_accounts_id?>" class="uploadmy" method="post" name="myForm" enctype="multipart/form-data" target="hiddenFrame">
                    
                    <div class="file-upload-block">
                        <div class="upload-btn-wrapper">
                            <button class="btn ubw">
                                <i class="fa fa-cloud-upload"></i>
                                <h6>Drag and drop files here or <span>browse to upload</span></h6>
                            </button>
                            <input type="file" name="userfile_editpopupit" />
                            <input type="hidden" name="reconcile_id" value="<?=$rows[0]->id?>">
                            <input type="hidden" name="subfix" value="editpopupit">
                        </div>
                    </div>
                    </br>
                    <button type="submit" class="form-control">Upload</button>
                    </form>
                    </br>
                    <a href="#" onclick="showData()">Show existing</a>
                </div>
            </div>
        </div>
     
        <div class="save-act" style="position: unset !important;">
            <button type="button" class="btn-cmn" onclick="closeFullNav_int()">Cancel</button>
            <a style="margin-left: 20%" class="hide-toggle dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Print </a>
            <ul class="dropdown-menu">
                <li><a href="#" onclick="print_this('to_print_both')">Print Deposit Slip & Summary</a>
                </li>
                <li><a href="#" onclick="print_this('to_print_summary')">Print Summary only</a>
                </li>
            </ul>
            <a href="#" style="margin-left: 5%" onclick="OpenRecurrInt()">Make Recurring</a>
            <a href="#" style="margin-left: 5%" onclick="DeleteInt(<?=$rows[0]->id?>,<?=$rows[0]->chart_of_accounts_id?>)">Delete</a>
            <a style="margin-left: 5%" href="<?php echo url('/accounting/reconcile/journal-report/'.$rows[0]->id.'/int') ?>">Transaction Journal</a>
            <a style="margin-left: 5%" href="<?php echo url('/accounting/reconcile/audit-history/'.$rows[0]->chart_of_accounts_id."/it") ?>">Audit History</a>
            <button type="button" onclick="save_close_edit_int(<?=$rows[0]->id?>,<?=$rows[0]->chart_of_accounts_id?>)" class="savebtn">Save and close</button>
        </div>
        <div id="to_print_both" style="display: none;">
            <div class="container">
                <center>
                    <?=number_format($rows[0]->interest_earned,2)?>
                    </br>
                    <?php 
                    if(!empty($this->reconcile_model->select_interest($rows[0]->id,$rows[0]->chart_of_accounts_id)))
                    {
                    foreach($this->reconcile_model->select_interest($rows[0]->id,$rows[0]->chart_of_accounts_id) as $editrowtab)
                    {
                    ?>
                    <tr>
                        <td><?=$editrowtab->income_account_sub?></td>
                        <td><?=$editrowtab->descp_it_sub?></td>
                        <td><?=number_format($editrowtab->interest_earned_sub,2)?></td>
                    </tr>
                    <?php
                    }}
                    ?>
                    <?php
                    for ($i=2; $i < 20 ; $i++) { 
                    ?>
                        <div class="print_interest_earned_<?=$i?>"></div>
                    <?php
                    }
                    ?>
                </center>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><?=date("Y-m-d")?></div>
                </div>
                <div class="row">
                    <div class="col-md-10"></div>
                    <div class="col-md-2">
                        <h6 id="getsubtotal_print_both"></h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10"></div>
                    <div class="col-md-2">
                        <h6 id="getdeduct_print_both"></h6>
                    </div>
                </div>
                <div class="row" style="margin-top:20px">
                    <div class="col-md-10"></div>
                    <div class="col-md-2">
                        <h6 id="gettotal_print_both"></h6>
                    </div>
                </div>
            </div>
        
            <div id="to_print_summary" style="display: none;">
                <div class="container">
                    <center><h2>Deposit Summary</h2></center>
                    <p style="margin-left: 90%"><?=date("Y-m-d")?></p>
                    <p>Summary of Deposit to <?php
                                       foreach($this->chart_of_accounts_model->select() as $row)
                                       {
                                         if($row->id == $rows[0]->chart_of_accounts_id)
                                         { echo $row->name;}
                                      }
                                       ?> on <?=$rows[0]->second_date?>
                    </p>
                    <section class="table-wrapper">
                        <div class="container">
                            <table class="table" style="width: 100%">
                                <thead>
                                    <th>Category</th>
                                    <th>Descp</th>
                                    <th>Amount</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td><?=number_format($rows[0]->interest_earned,2)?></td>
                                    </tr>
                                    <?php 
                                    if(!empty($this->reconcile_model->select_interest($rows[0]->id,$rows[0]->chart_of_accounts_id)))
                                    {
                                    foreach($this->reconcile_model->select_interest($rows[0]->id,$rows[0]->chart_of_accounts_id) as $editrowtab)
                                    {
                                    ?>
                                    <tr>
                                        <td><?=$editrowtab->income_account_sub?></td>
                                        <td><?=$editrowtab->descp_it_sub?></td>
                                        <td><?=number_format($editrowtab->interest_earned_sub,2)?></td>
                                    </tr>
                                    <?php
                                    }}
                                    ?>
                                    <?php
                                    for ($i=2; $i < 20 ; $i++) { 
                                    ?>
                                    <tr>
                                        <td class="print_income_account_<?=$i?>"></td>
                                        <td class="print_descp_it_<?=$i?>"></td>
                                        <td class="print_interest_earned_<?=$i?>"></td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <div class="row" style="margin-bottom:20px">
                                <div class="col-md-10"></div>
                                <div class="col-md-2">
                                    <h6 id="getsubtotal_print"></h6>
                                </div>
                            </div>
                            <div class="row" style="margin-bottom:20px">
                                <div class="col-md-10"></div>
                                <div class="col-md-2">
                                    <h6 id="getdeduct_print"></h6>
                                </div>
                            </div>
                            <div class="row" style="margin-bottom:20px">
                                <div class="col-md-10"></div>
                                <div class="col-md-2">
                                    <h6 id="gettotal_print"></h6>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <!-- End Edit New Int -->

    <!-- Print popup -->
    <div id="overlay-print-tx" class=""></div>
    <div id="side-menu-print-tx" class="main-side-nav" style="background-color: #f4f5f8">
        <div class="side-title print_disnone">
            <h4>Print Checks</h4>
            <a id="close-menu-print-tx" class="menuCloseButton" onclick="closePrintNav()"><span id="side-menu-close-text">
            <i class="fa fa-times"></i></span></a>
        </div>
        <div style="margin-left: 20px;">
            <div class="row print_disnone">
                <div class="col-md-3">
                    <select class="form-control" id="account_printpopup">
                        <?php
                           $i=1;
                           foreach($this->chart_of_accounts_model->select() as $row)
                           {
                            ?>
                            <option <?php if($this->reconcile_model->checkexist($row->id) != $row->id): echo "disabled"; ?>
                            <?php endif ?> <?php if($row->id == $rows[0]->chart_of_accounts_id): echo "selected"; endif?> value="<?=$row->id?>"><?=$row->name?></option>
                          <?php
                          $i++;
                          }
                           ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <h6>Balance:<?=number_format($this->chart_of_accounts_model->getBalance($rows[0]->chart_of_accounts_id),2);?></h6>
                </div>
                <div class="col-md-4">
                    <h6 id="check_count">1 Checks selected</h6><div id="check_amount">$<?=number_format($rows[0]->service_charge,2)?></div>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-2">
                    <button type="button" class="form-control" onclick="addCheck()">Add checks</button>
                </div>
            </div>
            <div class="row print_disnone">
                <div class="col-md-2">
                    <button type="button" class="form-control">Remove from list</button>
                </div>
                <div class="col-md-2">
                   <!--  <select name="sort_print" class="form-control">
                        <option>Sort by Payee</option>
                        <option>Sort by Order created</option>
                        <option>Sort by Date/ Payee</option>
                        <option selected>Sort by Date/ Order created</option>
                    </select> -->
                </div>
                <div class="col-md-2">
                    <select name="showall_print" class="form-control">
                        <option>Show all checks</option>
                        <option>Show regular checks</option>
                        <option>Show bill payment checks</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label>Starting check no.</label>
                    <input type="text" name="starting_check_no" class="form-control">
                </div>
                <div class="col-md-2">
                    <label>On first page print</label>
                    <select name="checks_print" class="form-control">
                        <option>1 checks</option>
                        <option>2 checks</option>
                        <option>3 checks</option>
                    </select>
                </div>
                 <div class="col-md-2">
                    <i class="fa fa-print" onclick="window.print()"></i>
                    <a class="hide-toggle dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-cog"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        Columns<br/>
                        <p class="p-padding"><input type="checkbox" checked="checked" onchange="col_date_print()" name="chk_date_print" id="chk_date_print"> Date</p>
                        <p class="p-padding"><input type="checkbox" checked="checked" onchange="col_type_print()" name="chk_type_print" id="chk_type_print"> Type</p>
                        <p class="p-padding"><input type="checkbox" checked="checked" onchange="col_payee_print()" name="chk_payee_print" id="chk_payee_print"> Payee Type</p>
                        <p class="p-padding"><input type="checkbox" checked="checked" onchange="col_amount_print()" name="chk_amount_print" id="chk_amount_print"> Amount</p>
                        <br/>
                    </div>
                </div>
            </div>
            <div class="row print_disnone">
                <section class="table-wrapper">
                    <div class="container">
                        <table class="table" id="print_table">
                            <thead>
                                <tr>
                                   <th></th>
                                   <th class="date_print">Date</th>
                                   <th class="type_print">Type</th>
                                   <th class="payee_print">Payee</th>
                                   <th class="amount_print">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="checkbox" checked name="print_service_charge_checkbox" id="print_service_charge_checkbox" onclick="Changecheck()"></td>
                                    <td class="date_print"><?=$rows[0]->first_date?></td>
                                    <td class="type_print">Check</td>
                                    <td class="payee_print"></td>
                                    <td class="amount_print">
                                        $<div id="print_service_charge"><?=number_format($rows[0]->service_charge,2)?></div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
            <div style="display: none;" class="print_disshow">
                <?php
                function AmountInWords(float $amount)
                {
                   $amount_after_decimal = round($amount - ($num = floor($amount)), 2) * 100;
                   // Check if there is any number after decimal
                   $amt_hundred = null;
                   $count_length = strlen($num);
                   $x = 0;
                   $string = array();
                   $change_words = array(0 => '', 1 => 'One', 2 => 'Two',
                     3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
                     7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
                     10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
                     13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
                     16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
                     19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
                     40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
                     70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
                    $here_digits = array('', 'Hundred','Thousand','Lakh', 'Crore');
                    while( $x < $count_length ) {
                      $get_divider = ($x == 2) ? 10 : 100;
                      $amount = floor($num % $get_divider);
                      $num = floor($num / $get_divider);
                      $x += $get_divider == 10 ? 1 : 2;
                      if ($amount) {
                       $add_plural = (($counter = count($string)) && $amount > 9) ? 's' : null;
                       $amt_hundred = ($counter == 1 && $string[0]) ? ' and ' : null;
                       $string [] = ($amount < 21) ? $change_words[$amount].' '. $here_digits[$counter]. $add_plural.' 
                       '.$amt_hundred:$change_words[floor($amount / 10) * 10].' '.$change_words[$amount % 10]. ' 
                       '.$here_digits[$counter].$add_plural.' '.$amt_hundred;
                        }
                   else $string[] = null;
                   }
                   $implode_to_Rupees = implode('', array_reverse($string));
                   $get_paise = ($amount_after_decimal > 0) ? "And " . ($change_words[$amount_after_decimal / 10] . " 
                   " . $change_words[$amount_after_decimal % 10]) . ' Paise' : '';
                   return ($implode_to_Rupees ? $implode_to_Rupees . 'Rupees ' : '') . $get_paise;
                }
                ?>
                <p>
                    <?=$rows[0]->first_date?><br>
                    **<?=number_format($rows[0]->service_charge,2)?><br>
                    <?php echo AmountInWords(number_format($rows[0]->service_charge,2));?> <br>*********************************************************************************************
                    Service Charge edit
                </p>
            </div>
        </div>
    

        <div class="save-act print_disnone" style="position: unset !important;">
            <button type="button" class="btn-cmn" onclick="closePrintNav()">Cancel</button>
            <button type="button" class="savebtn" onclick="window.print()">Preview and print</button>
        </div>
    </div>
    <!-- End Print popup -->

    <!-- Add Check -->
    <div id="overlay-check-tx" class=""></div>
    <div id="side-menu-check-tx" class="main-side-nav">
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
                                <?php endif ?> <?php if($row->id == $rows[0]->chart_of_accounts_id): echo "selected"; endif?> value="<?=$row->id?>"><?=$row->name?></option>
                              <?php
                              $i++;
                              }
                               ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <h6>Balance:<?=number_format($this->chart_of_accounts_model->getBalance($rows[0]->chart_of_accounts_id),2);?></h6>
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <h6 id="checkamount">Amount:$0.00</h6>
                    </div>
                </div>
                <div class="row" style="margin-bottom:20px">
                    <div class="col-md-2">
                        <label>Mailing Address:</label>
                        <textarea name="check_mailing_add" id="check_mailing_add" rows="4"><?=$rows[0]->mailing_address?></textarea>
                    </div>
                    <div class="col-md-2">
                        <label>Payment date:</label>
                        <div class="col-xs-10 date_picker">
                            <input type="text" name="check_date_popup" id="check_date_popup" class="form-control" value="<?=$rows[0]->first_date?>"/>
                        </div>
                    </div>
                    <div class="col-md-4"></div>
                    <div class="col-md-2">
                        <label>Check no.</label>
                        <input type="text" name="check_checkno" id="check_checkno" value="<?=$rows[0]->checkno?>" class="form-control"/>
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
                            <input type="hidden" name="reconcile_id" value="<?=$rows[0]->id?>">
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
            <button type="button" class="savebtn" onclick="save_check(<?=$rows[0]->id?>,<?=$rows[0]->chart_of_accounts_id?>)" >Done</button>
        </div>
    </div>
    <!-- End Add Check -->

    <!-- Make recurring -->
    <div id="overlay-recurr-tx" class=""></div>
    <div id="side-menu-recurr-tx" class="main-side-nav">
        <div style="background-color: #f4f5f8">
            <div class="side-title">
                <a id="close-menu-recurr-tx" class="menuCloseButton" onclick="closeRecurr()"><span id="side-menu-close-text">
                <i class="fa fa-times"></i></span></a>
            </div>
            <div style="margin-left: 20px;">
                <div class="row" style="margin-bottom:20px">
                    <h2>Recurring Check</h2>
                </div>
            </div>
            <div style="margin-left: 20px;">
                <div class="row" style="margin-bottom:20px">
                    <div class="col-md-2">
                        <label>Template name</label>
                        <input type="text" name="template_name" id="template_name" class="form-control" required="required">
                    </div>
                    <div class="col-md-2">
                        <label>Type</label>
                        <select name="type_scheduled" id="type_scheduled" class="form-control">
                            <option value="scheduled">Scheduled</option>
                            <option value="reminder">Reminder</option>
                            <option value="unscheduled">Unscheduled</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <div id="sched_">Create<input type="number" name="create_days" id="create_days" class="form-control">days in advance</div>
                        <div id="remine_" style="display: none;">Remind<input type="number" name="remine_days" id="remine_days" class="form-control">days before the transaction date</div>
                        <div id="unsched_" style="display: none;">Unscheduled transactions don’t have timetables; you use them as needed from the Recurring Transactions list.</div>
                    </div>
                </div>
            </div>
            <div style="margin-left: 20px;" id="sched_section">
                <div class="row" style="margin-bottom:20px">
                    <div class="col-md-1">
                        <label>Interval</label>
                        <select name="interval" id="interval" class="form-control" style="width: 120% !important;">
                            <option value="daily">Daily</option>
                            <option value="weekly">Weekly</option>
                            <option value="monthly" selected>Monthly</option>
                            <option value="yearly">Yearly</option>
                        </select>
                    </div>
                    <div class="col-md-6" style="display: flex;">
                        <div id="daily" style="display: none;">every<input type="number" name="daily_days" id="daily_days" class="form-control" style="width: 15% !important;display: inline;">day(s)</div>
                        <div id="weekly" style="display: none;">
                            every<input type="number" name="daily_weeks" id="daily_weeks" class="form-control" style="width: 10% !important;display: inline;">week(s) on
                            <select name="weekly_option" id="weekly_option" class="form-control" style="width: 30% !important;">
                                <option value="monday">Monday</option>
                                <option value="tuesday">Tuesday</option>
                                <option value="wednesday">Wednesday</option>
                                <option value="thursday">Thursday</option>
                                <option value="friday">Friday</option>
                                <option value="saturday">Saturday</option>
                                <option value="sunday">Sunday</option>
                            </select>
                        </div>
                        <div id="monthly">
                            on
                            <select name="monthlymain_option" id="monthlymain_option" class="form-control" style="width: 15% !important;">
                                <option value="day">day</option>
                                <option value="first">first</option>
                                <option value="second">second</option>
                                <option value="third">third</option>
                                <option value="fourth">fourth</option>
                                <option value="last">last</option>
                            </select>
                            <select name="monthlyday_option" id="monthlyday_option" class="form-control" style="width: 12% !important;">
                                <option value="1st">1st</option>
                                <option value="2nd">2nd</option>
                                <option value="3rd">3rd</option>
                                <option value="4th">4th</option>
                                <option value="5th">5th</option>
                                <option value="6th">6th</option>
                                <option value="7th">7th</option>
                                <option value="8th">8th</option>
                                <option value="9th">9th</option>
                                <option value="10th">10th</option>
                                <option value="11th">11th</option>
                                <option value="12th">12th</option>
                                <option value="13th">13th</option>
                                <option value="14th">14th</option>
                                <option value="15th">15th</option>
                                <option value="16th">16th</option>
                                <option value="17th">17th</op1tion>
                                <option value="18th">18th</option>
                                <option value="19th">19th</option>
                                <option value="20th">20th</option>
                                <option value="21th">21th</option>
                                <option value="22th">22th</option>
                                <option value="23th">23th</option>
                                <option value="24th">24th</option>
                                <option value="25th">25th</option>
                                <option value="26th">26th</option>
                                <option value="27th">27th</option>
                                <option value="28th">28th</option>
                                <option value="last">Last</option>
                            </select>
                            <select name="monthlyweek_option" id="monthlyweek_option" class="form-control" style="display: none;width: 20% !important;">
                                <option value="monday">Monday</option>
                                <option value="tuesday">Tuesday</option>
                                <option value="wednesday">Wednesday</option>
                                <option value="thursday">Thursday</option>
                                <option value="friday">Friday</option>
                                <option value="saturday">Saturday</option>
                                <option value="sunday">Sunday</option>
                            </select>
                            of every<input type="number" name="monthly_days" id="monthly_days" size="1" class="form-control" style="width: 8% !important;display: inline;">month(s)
                        </div>
                        <div id="yearly" style="display: none;">
                            every
                            <select name="yearlymonth_option" id="yearlymonth_option" class="form-control">
                                <option value="january">January</option>
                                <option value="february">February</option>
                                <option value="march">March</option>
                                <option value="april">April</option>
                                <option value="may">May</option>
                                <option value="june">June</option>
                                <option value="july">July</option>
                                <option value="august">August</option>
                                <option value="september">September</option>
                                <option value="october">October</option>
                                <option value="november">November</option>
                                <option value="december">December</option>
                            </select>
                            <select name="yearlyday_option" id="yearlyday_option" class="form-control">
                                <option value="1st">1st</option>
                                <option value="2nd">2nd</option>
                                <option value="3rd">3rd</option>
                                <option value="4th">4th</option>
                                <option value="5th">5th</option>
                                <option value="6th">6th</option>
                                <option value="7th">7th</option>
                                <option value="8th">8th</option>
                                <option value="9th">9th</option>
                                <option value="10th">10th</option>
                                <option value="11th">11th</option>
                                <option value="12th">12th</option>
                                <option value="13th">13th</option>
                                <option value="14th">14th</option>
                                <option value="15th">15th</option>
                                <option value="16th">16th</option>
                                <option value="17th">17th</op1tion>
                                <option value="18th">18th</option>
                                <option value="19th">19th</option>
                                <option value="20th">20th</option>
                                <option value="21th">21th</option>
                                <option value="22th">22th</option>
                                <option value="23th">23th</option>
                                <option value="24th">24th</option>
                                <option value="25th">25th</option>
                                <option value="26th">26th</option>
                                <option value="27th">27th</option>
                                <option value="28th">28th</option>
                                <option value="last">Last</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3" style="display: flex;">
                        <label>StartDate</label>
                        <div class="col-xs-10 date_picker">
                            <input type="text" name="recurr_start_date" id="recurr_start_date" class="form-control" style="width: 103%!important;">
                        </div>
                        <select class="form-control" name="recurr_select" id="recurr_select" style="width: 35%!important">
                            <option value="none">None</option>
                            <option value="by">By</option>
                            <option value="after">After</option>
                        </select>
                        <div id="recurr_by" style="display: none;">
                            <div class="col-xs-10 date_picker">
                                <input type="text" name="recurr_end_date" id="recurr_end_date" class="form-control">
                            </div>
                        </div>
                        <div id="recurr_after" style="display: none;"><input type="text" name="recurr_after_occurrences" id="recurr_after_occurrences" class="form-control" maxlength="3"></div>
                    </div>
                </div>
            </div>
            <div style="margin-left: 20px;">
                <div class="row" style="margin-bottom:20px">
                    <div class="col-md-3">
                        <select name="recurr_payee_popup" id="recurr_payee_popup" class="form-control fa">
                            <option value="" disabled="" selected>Payee</option>
                            <?php
                            foreach($this->AccountingVendors_model->select() as $ro)
                            {
                            ?>
                            <option value="<?=$ro->id?>"><?php echo $ro->f_name." ".$ro->l_name?></option>
                            <?php
                            }
                            ?>
                            <option value="fa fa-plus">&#xf067; Add new</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-control fa" name="recurr_account_popup" id="recurr_account_popup">
                            <?php
                               $i=1;
                               foreach($this->chart_of_accounts_model->select() as $row)
                               {
                                ?>
                                <option <?php if($this->reconcile_model->checkexist($row->id) != $row->id): echo "disabled"; ?>
                                <?php endif ?>value="<?=$row->id?>"><?=$row->name?></option>
                              <?php
                              $i++;
                              }
                               ?>
                            <option value="fa fa-plus">&#xf067; Add new</option>
                        </select>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <div class="row" style="margin-bottom:20px">
                    <div class="col-md-2">
                        <label>Mailing Address:</label>
                        <textarea name="recurr_mailing_add" id="recurr_mailing_add" class="form-control" rows="4"><?=$rows[0]->mailing_address?></textarea>
                    </div>
                    <div class="col-md-2">
                        <label>Payment date:</label>
                        <div class="col-xs-10 date_picker">
                            <input type="text" name="recurr_date_popup" id="recurr_date_popup" class="form-control" value="<?=$rows[0]->first_date?>"/>
                        </div>
                    </div>
                    <div class="col-md-4"></div>
                    <div class="col-md-2">
                        <label>Check no.</label>
                        <input type="text" name="recurr_checkno" id="recurr_checkno" class="form-control" value="<?=$rows[0]->checkno?>"/>
                        </br>
                        </br>
                        <input type="checkbox" class="form-control" name="recurr_print_check">Print Later
                    </div>
                </div>
                <div class="row" style="margin-bottom:20px">
                    <div class="col-md-8"></div>
                    <div class="col-md-2">
                        <label>Permit no.</label>
                        <input type="text" name="recurr_permitno" id="recurr_permitno" class="form-control" value=""/>
                    </div>
                </div>
            </div>
        </div>

        <div style="margin-left: 20px">
            <section class="table-wrapper">
                <div class="container">
                    <table class="table" id="participantRecurrTable">
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
                            <tr onclick="trClickRecurrMain()">
                                <td><i class="fa fa-th"></i></td>
                                <td>1</td>
                                <td>
                                    <select name='recurr_expense_account' id='recurr_expense_account' class='' style="display: none;">
                                        <?php
                                        foreach ($this->account_sub_account_model->get() as $rw)
                                        {
                                            ?>
                                           <option <?php if($rows[0]->expense_account == $rw->sub_acc_name){ echo "selected"; } ?> value="<?=$rw->sub_acc_name?>"><?=$rw->sub_acc_name?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <div class="recurr_expense_account"><?=$rows[0]->expense_account?></div>
                                </td>
                                <td>
                                    <input type="hidden" id="recurr_descp" name="recurr_descp" value="" placeholder="What did you paid for?">
                                    <div class="recurr_descp"></div>
                                </td>
                                <td>
                                     <input type="hidden" id="recurr_service_charge" name="recurr_service_charge" value="<?=number_format($rows[0]->service_charge,2)?>">
                                    <div class="recurr_service_charge"><?=number_format($rows[0]->service_charge,2)?></div>
                                </td>
                                <td><a href="javascript:void(0);" class="remove_recurr"><i class="fa fa-trash"></i></a></td>
                            </tr>
                            <?php 
                            $recurrservicechargecount =0;
                            if(!empty($this->reconcile_model->select_recurr_service($rows[0]->id,$rows[0]->chart_of_accounts_id)))
                            {
                            $recurrrowcount =2;
                            foreach($this->reconcile_model->select_recurr_service($rows[0]->id,$rows[0]->chart_of_accounts_id) as $recurrrowtab)
                            {
                                $recurrservicechargecount+=$recurrrowtab->service_charge_sub;
                            ?>
                            <tr onclick="trClickRecurr(<?=$recurrrowcount?>)">
                                <td data-id="<?=$recurrrowtab->id?>"><i class="fa fa-th"></i></td>
                                <td><?=$recurrrowcount?></td>
                                <td>
                                    <select name='recurr_expense_account_<?=$recurrrowcount?>' id='recurr_expense_account_<?=$recurrrowcount?>' data-id='<?=$recurrrowtab->id?>' class='up_row' style="display: none;">
                                        <option value=""></option>
                                        <?php
                                        foreach ($this->account_sub_account_model->get() as $rw)
                                        {
                                            ?>
                                           <option <?php if($recurrrowtab->expense_account_sub == $rw->sub_acc_name){ echo "selected"; } ?> value="<?=$rw->sub_acc_name?>"><?=$rw->sub_acc_name?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <div class="recurr_expense_account_<?=$recurrrowcount?>"><?=$recurrrowtab->expense_account_sub?></div>
                                </td>
                                <td>
                                    <input type="hidden" id="recurr_descp_<?=$recurrrowcount?>" name="recurr_descp_<?=$recurrrowcount?>" value="<?=$recurrrowtab->descp_sc_sub?>" placeholder="What did you paid for?" value="<?=$recurrrowtab->descp_sc_sub?>">
                                    <div class="recurr_descp_<?=$recurrrowcount?>"><?=$recurrrowtab->descp_sc_sub?></div>
                                </td>
                                <td>
                                     <input type="hidden" id="recurr_service_charge_<?=$recurrrowcount?>" name="recurr_service_charge_<?=$recurrrowcount?>" value="<?=number_format($recurrrowtab->service_charge_sub,2)?>">
                                    <div class="recurr_service_charge_<?=$recurrrowcount?>"><?=number_format($recurrrowtab->service_charge_sub,2)?></div>
                                </td>
                                <td><a href="javascript:void(0);" class="remove_recurr"><i class="fa fa-trash"></i></a></td>
                            </tr>
                            <?php $recurrrowcount++; }}else{ ?>
                            <tr onclick="trClickRecurr(2)">
                                <td><i class="fa fa-th"></i></td>
                                <td>2</td>
                                <td>
                                    <select name='recurr_expense_account_2' id='recurr_expense_account_2' class='' style="display: none;">
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
                                    <div class="recurr_expense_account_2"></div>
                                </td>
                                <td>
                                    <input type="hidden" id="recurr_descp_2" name="recurr_descp_2" value="" placeholder="What did you paid for?">
                                    <div class="recurr_descp_2"></div>
                                </td>
                                <td>
                                     <input type="hidden" id="recurr_service_charge_2" name="recurr_service_charge_2" value="">
                                    <div class="recurr_service_charge_2"></div>
                                </td>
                                <td><a href="javascript:void(0);" class="remove_recurr"><i class="fa fa-trash"></i></a></td>
                            </tr>
                            <?php } ?>
                            <input type="hidden" name="recurrservicechargecount" id="recurrservicechargecount" value="<?=$recurrservicechargecount?>">
                            <tr class="pr participantRecurrRow Recurrhide">
                                <td><i class="fa fa-th"></i></td>
                                <td>0</td>
                                <td>
                                    <select name='recurr_expense_account_' id='recurr_expense_account_' class='' style="display: none;">
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
                                    <div class="recurr_expense_account_"></div>
                                </td>
                                <td>
                                    <input type="hidden" id="recurr_descp_" name="recurr_descp_" value="" placeholder="What did you paid for?">
                                    <div class="recurr_descp_"></div>
                                </td>
                                <td>
                                     <input type="hidden" id="recurr_service_charge_" name="recurr_service_charge_" value="">
                                    <div class="recurr_service_charge_"></div>
                                </td>
                                <td><a href="javascript:void(0);" class="remove_recurr"><i class="fa fa-trash"></i></a></td>
                            </tr>

                        </tbody>
                    </table>

                    <div class="btn-group">
                        <a href="javascript:void(0);" class="btn-add-bx add_recurr">Add Lines</a>
                        <a href="javascript:void(0);" class="btn-add-bx clear_recurr">Clear All Lines</a>
                    </div>
                    <div class="btn-group hidemerecurr" style="display: none;">
                        <a href="javascript:void(0);" class="btn-add-bx"  onclick="rightclickRecurr()">Save<i class="fa fa-check"></i></a>
                        <a href="javascript:void(0);" class="btn-add-bx"  onclick="crossClickRecurr()">Cancel<i class="fa fa-close"></i>
                    </div>
                </div>
            </section>

            <div class="row" style="margin-bottom:20px">
                <div class="col-md-4">
                    <label>Memo</label>
                    </br>
                    <textarea name="recurr_memo_sc" id="recurr_memo_sc" rows="4"><?=$rows[0]->memo_sc?></textarea>
                </div>
                <div class="col-md-6"></div>
                <div class="col-md-2">
                    <h6 id="recurrtotal">Total : $<?=number_format($rows[0]->service_charge,2)?></h6>
                </div>
            </div>
            <div class="row" style="margin-bottom:20px">
                <div class="col-md-4">
                    <label><i class="fa fa-paperclip"></i>Attachment</label>
                    </br>
                    <iframe name="hiddenFramerecurr" width="0" height="0" border="0" style="display: none;"></iframe>
                    <form action="<?php echo url('accounting/reconcile/do_upload/') ?><?=$rows[0]->chart_of_accounts_id?>" class="uploadmy" method="post" name="recurrForm" enctype="multipart/form-data" target="hiddenFramerecurr">
                    <div class="file-upload-block">
                        <div class="upload-btn-wrapper">
                            <button class="btn ubw">
                                <i class="fa fa-cloud-upload"></i>
                                <h6>Drag and drop files here or <span>browse to upload</span></h6>
                            </button>
                            <input type="file" name="userfile_recurr" />
                            <input type="hidden" name="reconcile_id" value="<?=$rows[0]->id?>">
                            <input type="hidden" name="subfix" value="recurr">
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
            <button type="button" class="btn-cmn" onclick="closeRecurr()">Cancel</button>
            <button type="button" class="btn-cmn" onclick="openRecurr()" style="margin-left: 5% ">Revert</button>
            <button type="button" class="savebtn" onclick="save_recurr(<?=$rows[0]->id?>,<?=$rows[0]->chart_of_accounts_id?>)">Save template</button>
        </div>
    </div>
    <!-- End Make recurring -->

    <!-- Make recurring Int-->
    <div id="overlay-recurrint-tx" class=""></div>
    <div id="side-menu-recurrint-tx" class="main-side-nav" style="display: none;">
        <div style="background-color: #f4f5f8">
            <div class="side-title">
                <a id="close-menu-recurrint-tx" class="menuCloseButton" onclick="closeRecurrInt()"><span id="side-menu-close-text">
                <i class="fa fa-times"></i></span></a>
            </div>
            <div style="margin-left: 20px;">
                <div class="row" style="margin-bottom:20px">
                    <h2>Recurring Check</h2>
                </div>
            </div>
            <div style="margin-left: 20px;">
                <div class="row" style="margin-bottom:20px">
                    <div class="col-md-2">
                        <label>Template name</label>
                        <input type="text" name="template_name_int" id="template_name_int" class="form-control" required="required">
                    </div>
                    <div class="col-md-2">
                        <label>Type</label>
                        <select name="type_scheduled_int" id="type_scheduled_int" class="form-control">
                            <option value="scheduled">Scheduled</option>
                            <option value="reminder">Reminder</option>
                            <option value="unscheduled">Unscheduled</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <div id="sched_int_">Create<input type="number" name="create_days_int" id="create_days_int" class="form-control">days in advance</div>
                        <div id="remine_int_" style="display: none;">Remind<input type="number" name="remine_days_int" id="remine_days_int" class="form-control">days before the transaction date</div>
                        <div id="unsched_int_" style="display: none;">Unscheduled transactions don’t have timetables; you use them as needed from the Recurring Transactions list.</div>
                    </div>
                </div>
            </div>
            <div style="margin-left: 20px;" id="sched_section_int">
                <div class="row" style="margin-bottom:20px">
                    <div class="col-md-1">
                        <label>Interval</label>
                        <select name="interval_int" id="interval_int" class="form-control" style="width: 120% !important;">
                            <option value="daily">Daily</option>
                            <option value="weekly">Weekly</option>
                            <option value="monthly" selected>Monthly</option>
                            <option value="yearly">Yearly</option>
                        </select>
                    </div>
                    <div class="col-md-6" style="display: flex;">
                        <div id="daily_int" style="display: none;">every<input type="number" name="daily_days_int" id="daily_days_int" class="form-control" style="width: 15% !important;display: inline;">day(s)</div>
                        <div id="weekly_int" style="display: none;">
                            every<input type="number" name="daily_weeks_int" id="daily_weeks_int" class="form-control" style="width: 10% !important;display: inline;">week(s) on
                            <select name="weekly_option_int" id="weekly_option_int" class="form-control" style="width: 30% !important;">
                                <option value="monday">Monday</option>
                                <option value="tuesday">Tuesday</option>
                                <option value="wednesday">Wednesday</option>
                                <option value="thursday">Thursday</option>
                                <option value="friday">Friday</option>
                                <option value="saturday">Saturday</option>
                                <option value="sunday">Sunday</option>
                            </select>
                        </div>
                        <div id="monthly_int">
                            on
                            <select name="monthlymain_option_int" id="monthlymain_option_int" class="form-control" style="width: 15% !important;">
                                <option value="day">day</option>
                                <option value="first">first</option>
                                <option value="second">second</option>
                                <option value="third">third</option>
                                <option value="fourth">fourth</option>
                                <option value="last">last</option>
                            </select>
                            <select name="monthlyday_option_int" id="monthlyday_option_int" class="form-control" style="width: 12% !important;">
                                <option value="1st">1st</option>
                                <option value="2nd">2nd</option>
                                <option value="3rd">3rd</option>
                                <option value="4th">4th</option>
                                <option value="5th">5th</option>
                                <option value="6th">6th</option>
                                <option value="7th">7th</option>
                                <option value="8th">8th</option>
                                <option value="9th">9th</option>
                                <option value="10th">10th</option>
                                <option value="11th">11th</option>
                                <option value="12th">12th</option>
                                <option value="13th">13th</option>
                                <option value="14th">14th</option>
                                <option value="15th">15th</option>
                                <option value="16th">16th</option>
                                <option value="17th">17th</op1tion>
                                <option value="18th">18th</option>
                                <option value="19th">19th</option>
                                <option value="20th">20th</option>
                                <option value="21th">21th</option>
                                <option value="22th">22th</option>
                                <option value="23th">23th</option>
                                <option value="24th">24th</option>
                                <option value="25th">25th</option>
                                <option value="26th">26th</option>
                                <option value="27th">27th</option>
                                <option value="28th">28th</option>
                                <option value="last">Last</option>
                            </select>
                            <select name="monthlyweek_option_int" id="monthlyweek_option_int" class="form-control" style="display: none;width: 20% !important;">
                                <option value="monday">Monday</option>
                                <option value="tuesday">Tuesday</option>
                                <option value="wednesday">Wednesday</option>
                                <option value="thursday">Thursday</option>
                                <option value="friday">Friday</option>
                                <option value="saturday">Saturday</option>
                                <option value="sunday">Sunday</option>
                            </select>
                            of every<input type="number" name="monthly_days_int" id="monthly_days_int" size="1" class="form-control" style="width: 8% !important;display: inline;">month(s)
                        </div>
                        <div id="yearly_int" style="display: none;">
                            every
                            <select name="yearlymonth_option_int" id="yearlymonth_option_int" class="form-control">
                                <option value="january">January</option>
                                <option value="february">February</option>
                                <option value="march">March</option>
                                <option value="april">April</option>
                                <option value="may">May</option>
                                <option value="june">June</option>
                                <option value="july">July</option>
                                <option value="august">August</option>
                                <option value="september">September</option>
                                <option value="october">October</option>
                                <option value="november">November</option>
                                <option value="december">December</option>
                            </select>
                            <select name="yearlyday_option_int" id="yearlyday_option_int" class="form-control">
                                <option value="1st">1st</option>
                                <option value="2nd">2nd</option>
                                <option value="3rd">3rd</option>
                                <option value="4th">4th</option>
                                <option value="5th">5th</option>
                                <option value="6th">6th</option>
                                <option value="7th">7th</option>
                                <option value="8th">8th</option>
                                <option value="9th">9th</option>
                                <option value="10th">10th</option>
                                <option value="11th">11th</option>
                                <option value="12th">12th</option>
                                <option value="13th">13th</option>
                                <option value="14th">14th</option>
                                <option value="15th">15th</option>
                                <option value="16th">16th</option>
                                <option value="17th">17th</op1tion>
                                <option value="18th">18th</option>
                                <option value="19th">19th</option>
                                <option value="20th">20th</option>
                                <option value="21th">21th</option>
                                <option value="22th">22th</option>
                                <option value="23th">23th</option>
                                <option value="24th">24th</option>
                                <option value="25th">25th</option>
                                <option value="26th">26th</option>
                                <option value="27th">27th</option>
                                <option value="28th">28th</option>
                                <option value="last">Last</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3" style="display: flex;">
                        <label>StartDate</label>
                        <div class="col-xs-10 date_picker">
                            <input type="text" name="recurr_start_date_int" id="recurr_start_date_int" class="form-control" style="width: 103%!important;">
                        </div>
                        <select class="form-control" name="recurr_select_int" id="recurr_select_int" style="width: 35%!important">
                            <option value="none">None</option>
                            <option value="by">By</option>
                            <option value="after">After</option>
                        </select>
                        <div id="recurr_by_int" style="display: none;">
                            <div class="col-xs-10 date_picker">
                                <input type="text" name="recurr_end_date_int" id="recurr_end_date_int" class="form-control">
                            </div>
                        </div>
                        <div id="recurr_after_int" style="display: none;"><input type="text" name="recurr_after_occurrences_int" id="recurr_after_occurrences_int" class="form-control" maxlength="3"></div>
                    </div>
                </div>
            </div>
            <div style="margin-left: 20px;">
                <div class="row" style="margin-bottom:20px">
                    <div class="col-md-3">
                        <select class="form-control fa" name="recurr_account_popup_int" id="recurr_account_popup_int">
                            <?php
                               $i=1;
                               foreach($this->chart_of_accounts_model->select() as $row)
                               {
                                ?>
                                <option <?php if($this->reconcile_model->checkexist($row->id) != $row->id): echo "disabled"; ?>
                                <?php endif ?>value="<?=$row->id?>"><?=$row->name?></option>
                              <?php
                              $i++;
                              }
                               ?>
                            <option value="fa fa-plus">&#xf067; Add new</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div style="margin-left: 20px">
            <section class="table-wrapper">
                <div class="container">
                    <table class="table" id="participantRecurrIntTable">
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
                            <tr onclick="trClickRecurrMain_Int()">
                                <td><i class="fa fa-th"></i></td>
                                <td>1</td>
                                <td>
                                    <select name='recurr_income_account' id='recurr_income_account' class='' style="display: none;">
                                        <?php
                                        foreach ($this->account_sub_account_model->get() as $rw)
                                        {
                                            ?>
                                           <option <?php if($rows[0]->income_account == $rw->sub_acc_name){ echo "selected"; } ?> value="<?=$rw->sub_acc_name?>"><?=$rw->sub_acc_name?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <div class="recurr_income_account"><?=$rows[0]->income_account?></div>
                                </td>
                                <td>
                                    <input type="hidden" id="recurr_descp_it" name="recurr_descp_it" value="" placeholder="What did you paid for?">
                                    <div class="recurr_descp_it"></div>
                                </td>
                                <td>
                                     <input type="hidden" id="recurr_interest_earned" name="recurr_interest_earned" value="<?=number_format($rows[0]->interest_earned,2)?>">
                                    <div class="recurr_interest_earned"><?=number_format($rows[0]->interest_earned,2)?></div>
                                </td>
                                <td><a href="javascript:void(0);" class="remove_recurr_int"><i class="fa fa-trash"></i></a></td>
                            </tr>
                            <?php 
                            $recurrinterestearnedcount_int =0;
                            if(!empty($this->reconcile_model->select_interest($rows[0]->id,$rows[0]->chart_of_accounts_id)))
                            {
                            $recurrrowcount_int =2;
                            foreach($this->reconcile_model->select_interest($rows[0]->id,$rows[0]->chart_of_accounts_id) as $recurrrowtabint)
                            {
                                $recurrinterestearnedcount_int+=$recurrrowtabint->interest_earned_sub;
                            ?>
                            <tr onclick="trClickRecurr_Int(<?=$recurrrowcount_int?>)">
                                <td data-id="<?=$recurrrowtabint->id?>"><i class="fa fa-th"></i></td>
                                <td><?=$recurrrowcount_int?></td>
                                <td>
                                    <select name='recurr_income_account_<?=$recurrrowcount_int?>' id='recurr_income_account_<?=$recurrrowcount_int?>' data-id='<?=$recurrrowtabint->id?>' class='up_row' style="display: none;">
                                        <option value=""></option>
                                        <?php
                                        foreach ($this->account_sub_account_model->get() as $rw)
                                        {
                                            ?>
                                           <option <?php if($recurrrowtabint->income_account_sub == $rw->sub_acc_name){ echo "selected"; } ?> value="<?=$rw->sub_acc_name?>"><?=$rw->sub_acc_name?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <div class="recurr_income_account_<?=$recurrrowcount_int?>"><?=$recurrrowtabint->income_account_sub?></div>
                                </td>
                                <td>
                                    <input type="hidden" id="recurr_descp_it_<?=$recurrrowcount_int?>" name="recurr_descp_it_<?=$recurrrowcount_int?>" value="<?=$recurrrowtabint->descp_it_sub?>" placeholder="What did you paid for?" value="<?=$recurrrowtabint->descp_it_sub?>">
                                    <div class="recurr_descp_it_<?=$recurrrowcount_int?>"><?=$recurrrowtabint->descp_it_sub?></div>
                                </td>
                                <td>
                                     <input type="hidden" id="recurr_interest_earned_<?=$recurrrowcount_int?>" name="recurr_interest_earned_<?=$recurrrowcount_int?>" value="<?=number_format($recurrrowtabint->interest_earned_sub,2)?>">
                                    <div class="recurr_interest_earned_<?=$recurrrowcount_int?>"><?=number_format($recurrrowtabint->interest_earned_sub,2)?></div>
                                </td>
                                <td><a href="javascript:void(0);" class="remove_recurr_int"><i class="fa fa-trash"></i></a></td>
                            </tr>
                            <?php $recurrrowcount_int++; }}else{ ?>
                            <tr onclick="trClickRecurr_Int(2)">
                                <td><i class="fa fa-th"></i></td>
                                <td>2</td>
                                <td>
                                    <select name='recurr_income_account_2' id='recurr_income_account_2' class='' style="display: none;">
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
                                    <div class="recurr_income_account_2"></div>
                                </td>
                                <td>
                                    <input type="hidden" id="recurr_descp_it_2" name="recurr_descp_it_2" value="" placeholder="What did you paid for?">
                                    <div class="recurr_descp_it_2"></div>
                                </td>
                                <td>
                                     <input type="hidden" id="recurr_interest_earned_2" name="recurr_interest_earned_2" value="">
                                    <div class="recurr_interest_earned_2"></div>
                                </td>
                                <td><a href="javascript:void(0);" class="remove_recurr_int"><i class="fa fa-trash"></i></a></td>
                            </tr>
                            <?php } ?>
                            <input type="hidden" name="recurrinterestearnedcount_int" id="recurrinterestearnedcount_int" value="<?=$recurrinterestearnedcount_int?>">
                            <tr class="pr participantRecurrIntRow RecurrhideInt">
                                <td><i class="fa fa-th"></i></td>
                                <td>0</td>
                                <td>
                                    <select name='recurr_income_account_' id='recurr_income_account_' class='' style="display: none;">
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
                                    <div class="recurr_income_account_"></div>
                                </td>
                                <td>
                                    <input type="hidden" id="recurr_descp_it_" name="recurr_descp_it_" value="" placeholder="What did you paid for?">
                                    <div class="recurr_descp_it_"></div>
                                </td>
                                <td>
                                     <input type="hidden" id="recurr_interest_earned_" name="recurr_interest_earned_" value="">
                                    <div class="recurr_interest_earned_"></div>
                                </td>
                                <td><a href="javascript:void(0);" class="remove_recurr_int"><i class="fa fa-trash"></i></a></td>
                            </tr>

                        </tbody>
                    </table>

                    <div class="row" style="margin-bottom:20px">
                        <div class="col-md-10">
                            <div class="btn-group">
                                <a href="javascript:void(0);" class="btn-add-bx add_recurr_int">Add Lines</a>
                                <a href="javascript:void(0);" class="btn-add-bx clear_recurr_int">Clear All Lines</a>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <h6 id="intrecurrtotal">Other Fund Total : $<?=number_format($rows[0]->interest_earned,2)?></h6>
                        </div>
                    </div>
                    <div class="btn-group hidemerecurr_int" style="display: none;">
                        <a href="javascript:void(0);" class="btn-add-bx"  onclick="rightclickRecurr_Int()">Save<i class="fa fa-check"></i></a>
                        <a href="javascript:void(0);" class="btn-add-bx"  onclick="crossClickRecurr_Int()">Cancel<i class="fa fa-close"></i></a>
                    </div>
                </div>
            </section>

            <div class="row" style="margin-bottom:20px">
                <div class="col-md-2">
                    <label>Memo</label>
                    </br>
                    <textarea name="recurr_memo_it" id="recurr_memo_it" rows="4"><?=$rows[0]->memo_it?></textarea>
                </div>
                <div class="col-md-3">
                    <label>Cash back goes to</label>
                    </br>
                    <select class="form-control" id="cashback_popup_recurr">
                        <?php
                           $i=1;
                           foreach($this->chart_of_accounts_model->select() as $row)
                           {
                            ?>
                            <option <?php if($this->reconcile_model->checkexist($row->id) != $row->id): echo "disabled"; ?>
                            <?php endif ?> <?php if($row->id == $rows[0]->cash_back_account): echo "selected"; endif?> value="<?=$row->id?>"><?=$row->name?></option>
                          <?php
                          $i++;
                          }
                           ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <label>Cash back memo</label>
                    </br>
                    <textarea name="cash_back_memo_recurr" id="cash_back_memo_recurr" rows="4"><?=$rows[0]->cash_back_memo?></textarea>
                </div>
                <div class="col-md-3">
                    <label>Cash back amount</label>
                    </br>
                    <input type="number" name="cash_back_amount_recurr" id="cash_back_amount_recurr" class="form-control" value="<?=$rows[0]->cash_back_amount?>">
                </div>
                <div class="col-md-2">
                    <h6 id="intrecurrtotal_final">Total : $<?=number_format($rows[0]->interest_earned,2)?></h6>
                </div>
            </div>
            <div class="row" style="margin-bottom:20px">
                <div class="col-md-8"></div>
                <div class="col-md-4">
                    <div class="btn-group hidemefinal_int" style="display: none;">
                        <a href="javascript:void(0);" class="btn-add-bx" onclick="rightclickRecurr_int_final()">Save<i class="fa fa-check"></i></a>
                        <a href="javascript:void(0);" class="btn-add-bx"  onclick="crossClickRecurr_int_final()">Cancel<i class="fa fa-close"></i></a>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-bottom:20px">
                <div class="col-md-4">
                    <label><i class="fa fa-paperclip"></i>Attachment</label>
                    </br>
                    <iframe name="hiddenFramerecurr" width="0" height="0" border="0" style="display: none;"></iframe>
                    <form action="<?php echo url('accounting/reconcile/do_upload/') ?><?=$rows[0]->chart_of_accounts_id?>" class="uploadmy" method="post" name="recurrForm" enctype="multipart/form-data" target="hiddenFramerecurr">
                    <div class="file-upload-block">
                        <div class="upload-btn-wrapper">
                            <button class="btn ubw">
                                <i class="fa fa-cloud-upload"></i>
                                <h6>Drag and drop files here or <span>browse to upload</span></h6>
                            </button>
                            <input type="file" name="userfile_recurrint" />
                            <input type="hidden" name="reconcile_id" value="<?=$rows[0]->id?>">
                            <input type="hidden" name="subfix" value="recurrint">
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
            <button type="button" class="btn-cmn" onclick="closeRecurrInt()">Cancel</button>
            <button type="button" class="btn-cmn" onclick="OpenRecurrInt()" style="margin-left: 5% ">Revert</button>
            <button type="button" class="savebtn" onclick="save_recurr_int(<?=$rows[0]->id?>,<?=$rows[0]->chart_of_accounts_id?>)">Save template</button>
        </div>
    </div>
    <!-- End Make recurring Int-->

    <!-- Make account -->
    <div id="overlay-account-tx" class=""></div>
    <div id="side-menu-account-tx" class="main-side-nav" style="display: none;">
        <?php echo form_open_multipart('accounting/chart_of_accounts/add', ['class' => 'form-validate', 'autocomplete' => 'off']); ?>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mt-0 header-title mb-5">New Chart of account</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>Account</h3>
                                </div>
                                <div class="col-md-4 form-group">
                                     <label for="account_type">Account Type</label>
                                    <select name="account_type" id="account_type" class="form-control " required>
                                        <option value="">Select Account Type</option>
                                        <?php foreach ($this->account_model->get() as $row): ?>
                                            <option value="<?php echo $row->id ?>"><?php echo $row->account_name ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                 <div class="col-md-4 form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" name="name" id="name" required
                                           placeholder="Enter Name"
                                           autofocus/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label for="detail_type">Detail Type</label>
                                    <select name="detail_type" id="detail_type" class="form-control " onchange="showOptions(this)" required>
                                        <?php foreach ($this->account_detail_model->get() as $row_detail): ?>
                                            <option value="<?php echo $row_detail->acc_detail_id ?>" ><?php echo $row_detail->acc_detail_name ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="description">Description</label>
                                    <textarea type="text" class="form-control" name="description" id="description"
                                              placeholder="Enter Description" rows="3" required></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group">
                                          Use <b>Rents held in trust</b> to track deposits and rent held on behalf of the property owners. <br><br>
                                          <p>Typically only property managers use this type of account.</p>
                                </div>
                                <div class="col-md-4 form-group">
                                    <input type="checkbox" name="sub_account" class="js-switch" id="check_sub" onchange="check()"/>
                                    <label for="formClient-Status">Is sub account</label>
                                    <select name="sub_account_type" id="sub_account_type" class="form-control " required disabled="disabled">
                                          <?php foreach ($this->account_sub_account_model->get() as $row_sub): ?>
                                            <option value="<?php echo $row_sub->sub_acc_id ?>" ><?php echo $row_sub->sub_acc_name ?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <br>
                                    <label for="choose_time">When do you want to start tracking your finances from this account in Nsmartrac?</label>
                                    <span></span>
                                    <select name="choose_time" id="choose_time" class="form-control " required onchange="showdiv()">
                                            <option selected="selected" disabled="disabled">Choose one</option>
                                            <option value="Beginning of this year">Beginning of this year</option>
                                            <option value="Beginning of this month">Beginning of this month</option>
                                            <option value="Today">Today</option>
                                            <option value="Other" onclick="hidediv()">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group"></div>
                                <div class="col-md-4 form-group hide-div" style="display: none;">
                                     <label for="balance">Balance</label>
                                    <input type="text" class="form-control" name="balance" id="balance" required
                                           placeholder="Enter Balance"
                                           autofocus/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group"></div>
                                <div class="col-md-4 form-group hide-date" style="display: none;">
                                     <label for="time_date">Date</label>
                                     <div class="col-xs-10 date_picker">
                                        <input type="text" class="form-control" name="time_date" id="time_date"
                                           placeholder="Enter Date" onchange="showdiv2()" autofocus/>
                                     </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <button type="submit"  name="save" class="btn btn-flat btn-primary">Submit</button>
                                </div>
                                <div class="col-md-4 form-group">
                                    <a href="#" class="btn btn-flat btn-primary" onclick="closeAddaccount()">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <?php echo form_close(); ?>
    </div>
    
    <!-- End Make account -->

    <!-- Add payee -->
    <div id="overlay-payee-tx" class=""></div>
    <div id="side-menu-payee-tx" class="main-side-nav">
        <div>
            <div class="side-title">
                <h4>New Name</h4>
                <a id="close-menu-payee-tx" class="menuCloseButton" onclick="closePayee()"><span id="side-menu-close-text">
                <i class="fa fa-times"></i></span></a>
            </div>
            <div style="margin-left: 20px;">
                <div class="row" style="margin-bottom:20px">
                    <div class="col-md-6">
                        <label>Name</label>
                        <input type="text" name="paypop_name" id="paypop_name" class="form-control">
                    </div>
                </div>
                <div class="row" style="margin-bottom:20px">
                    <div class="col-md-6">
                        <label>Type</label>
                        <select name="paypop_type" id="paypop_type" class="form-control">
                            <option value="vendor">Vendor</option>
                            <option value="customer">Customer</option>
                        </select>
                    </div>
                </div>
                <div class="row" style="margin-bottom:20px">
                    <div class="col-md-6">
                        <a href="#" onclick="opendetails()"><i class="fa fa-plus"></i>Details</a>
                    </div>
                    <div class="col-md-6 save-act">
                        <button type="submit" class="savebtn">Save</button>
                    </div>
                </div>
                <hr>
                <div class="row" style="margin-bottom:20px">
                    <div class="col-md-12">
                        <p><a href="#" data-toggle="collapse" data-target="#gmailExample" aria-expanded="false" aria-controls="gmailExample">
                            <i class="fa fa-chevron-down"></i>Got a gmail account?
                        </a></p>
                        <div class="gmail" id="gmailExample">
                            <div class="card card-body">
                                <button type="button" class="savebtn">Connect your gmail account</button>
                                <p>After you connect, your contacts will appear in a holding list.You can then choose which ones to add to nSmartrac.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Add payee -->

    <!-- Add Vendor -->
    <div id="overlay-vendor-tx" class=""></div>
    <div id="side-menu-vendor-tx" class="main-side-nav">
        <div class="side-title">
            <h4>Vendor Information</h4>
            <a id="close-menu-vendor-tx" class="menuCloseButton" onclick="closeVendor()"><span id="side-menu-close-text">
            <i class="fa fa-times"></i></span></a>
        </div>
        <div style="margin-left: 20px;">
            <div class="row" style="margin-bottom:20px">
                <div class="col-md-2">
                    <label>Title</label><br>
                    <input type="text" name="ven_title" id="ven_title" class="form-control">
                </div>
                <div class="col-md-1">
                    <label>First Name</label><br>
                    <input type="text" name="ven_firstname" id="ven_firstname" class="form-control">
                </div>
                <div class="col-md-1">
                    <label>Middle Name</label><br>
                    <input type="text" name="ven_midname" id="ven_midname" class="form-control">
                </div>
                <div class="col-md-1">
                    <label>Last Name</label><br>
                    <input type="text" name="ven_lastname" id="ven_lastname" class="form-control">
                </div>
                <div class="col-md-1">
                    <label>Suffix</label><br>
                    <input type="text" name="ven_suffix" id="ven_suffix" class="form-control">
                </div>
                <div class="col-md-6">
                    <label>Email</label><br>
                    <input type="text" name="ven_email" id="ven_email" class="form-control">
                </div>
            </div>
            <div class="row" style="margin-bottom:20px">
                <div class="col-md-6">
                    <label>Company</label><br>
                    <input type="text" name="ven_company" id="ven_company" class="form-control">
                </div>
                <div class="col-md-2">
                    <label>Phone</label><br>
                    <input type="text" name="ven_phone" id="ven_phone" class="form-control">
                </div>
                <div class="col-md-2">
                    <label>Mobile</label><br>
                    <input type="text" name="ven_mobile" id="ven_mobile" class="form-control">
                </div>
                <div class="col-md-2">
                    <label>Fax</label><br>
                    <input type="text" name="ven_fax" id="ven_fax" class="form-control">
                </div>
            </div>
            <div class="row" style="margin-bottom:20px">
                <div class="col-md-6">
                    <label>Display name as</label><br>
                    <input type="text" name="ven_disname" id="ven_disname" class="form-control">
                </div>
                <div class="col-md-3">
                    <label>Other</label><br>
                    <input type="text" name="ven_other" id="ven_other" class="form-control">
                </div>
                <div class="col-md-3">
                    <label>Website</label><br>
                    <input type="text" name="ven_website" id="ven_website" class="form-control">
                </div>
            </div>
            <div class="row" style="margin-bottom:20px">
                <div class="col-md-6">
                    <label>Print on check as</label>
                    <input type="checkbox" name="ven_print" id="ven_print">Use display name<br>
                    <input type="text" name="ven_printtext" id="ven_printtext" class="form-control">
                </div>
                <div class="col-md-6">
                    <label>Billing rate (/hr)</label><br>
                    <input type="text" name="ven_billing" id="ven_billing" class="form-control">
                </div>
            </div>
            <div class="row" style="margin-bottom:20px">
                <div class="col-md-6">
                    <label>Address<a href="#">map</a></label><br>
                    <textarea name="ven_address" id="ven_address" class="form-control"></textarea>
                </div>
                <div class="col-md-6">
                    <label>Terms</label><br>
                    <select name="ven_term" id="ven_term" class="form-control fa">
                        <option></option>
                        <option value="fa fa-plus">&#xf067; Add new</option>
                    </select>
                </div>
            </div>
            <div class="row" style="margin-bottom:20px">
                <div class="col-md-3">
                    <label>City</label><br>
                    <input type="text" name="ven_city" id="ven_city" class="form-control" placeholder="city">
                </div>
                <div class="col-md-3">
                    <label>State</label><br>
                    <input type="text" name="ven_state" id="ven_state" class="form-control" placeholder="state">
                </div>
                <div class="col-md-3">
                    <label>Opening Balance</label>
                    <input type="text" name="ven_bal" id="ven_bal" class="form-control">
                </div>
                <div class="col-md-3">
                    <label>as of</label>
                    <div class="col-xs-1 date_picker">
                        <input type="text" name="ven_date" id="ven_date" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row" style="margin-bottom:20px">
                <div class="col-md-3">
                    <label>Zip code</label><br>
                    <input type="text" name="ven_zip" id="ven_zip" class="form-control" placeholder="zipcode">
                </div>
                <div class="col-md-3">
                    <label>Country</label><br>
                    <input type="text" name="ven_country" id="ven_country" class="form-control" placeholder="country">
                </div>
                <div class="col-md-6">
                    <label>Account no.</label><br>
                    <input type="text" name="ven_acc" id="ven_acc" class="form-control" placeholder="Appears in the memo of all payment">
                </div>
            </div>
            <div class="row" style="margin-bottom:20px">
                <div class="col-md-6">
                    <label>Notes</label><br>
                    <textarea name="ven_notes" id="ven_notes" class="form-control"></textarea>
                </div>
                <div class="col-md-6">
                    <label>Business ID No.</label><br>
                    <input type="text" name="ven_bid" id="ven_bid" class="form-control">
                    <input type="checkbox" name="ven_bid_check" id="ven_bid_check" class="form-control">Track payments for 1099
                </div>
            </div>
            <div class="row" style="margin-bottom:20px">
                <div class="col-md-6">
                    <label>Attachment</label>
                    </br>
                    <iframe name="hiddenFramevendor" width="0" height="0" border="0" style="display: none;"></iframe>
                    <form action="<?php echo url('accounting/reconcile/do_upload/') ?><?=$rows[0]->chart_of_accounts_id?>" class="uploadmy" method="post" name="vendorForm" enctype="multipart/form-data" target="hiddenFramevendor">
                    <div class="file-upload-block">
                        <div class="upload-btn-wrapper">
                            <button class="btn ubw">
                                <i class="fa fa-cloud-upload"></i>
                                <h6>Drag and drop files here or <span>browse to upload</span></h6>
                            </button>
                            <input type="file" name="userfile_vendor" />
                            <input type="hidden" name="reconcile_id" value="<?=$rows[0]->id?>">
                            <input type="hidden" name="subfix" value="vendor">
                        </div>
                    </div>
                    </br>
                    <button type="submit" class="form-control">Upload</button>
                    </form>
                    </br>
                </div>
                <div class="col-md-6">
                    <label>Default expense account</label><br>
                    <select name="ven_expenseacc" id="ven_expenseacc" class="form-control fa">
                        <?php
                           $i=1;
                           foreach($this->chart_of_accounts_model->select() as $row)
                           {
                            ?>
                            <option <?php if($this->reconcile_model->checkexist($row->id) != $row->id): echo "disabled"; ?>
                            <?php endif ?>value="<?=$row->id?>"><?=$row->name?></option>
                          <?php
                          $i++;
                          }
                        ?>
                        <option value="fa fa-plus">&#xf067; Add new</option>
                    </select>
                </div>
            </div>
            <div class="row" style="margin-bottom:20px">
                <div class="col-md-6">
                    <h4>Get custom fields with Advanced</h4>
                    <p>Custom fields let you add more detailed info about your customers and transactions.</p>
                    <p>Sort, track, and report info that's important to you.</p>
                </div>
            </div>
            <hr>
            <div class="save-act" style="position: unset !important;">
            <button type="button" class="btn-cmn" onclick="closeVendor()">Cancel</button>
            <button type="button" class="btn-cmn" style="margin-left: 30%">Make In-active</button>
            <button type="submit" class="savebtn">Save</button>
        </div>
        </div>
    </div>
    <!-- End Add Vendor -->

    <!-- Add Customer -->
    <div id="overlay-customer-tx" class=""></div>
    <div id="side-menu-customer-tx" class="main-side-nav">
        <div class="side-title">
            <h4>Customer Information</h4>
            <a id="close-menu-customer-tx" class="menuCloseButton" onclick="closeCustomer()"><span id="side-menu-close-text">
            <i class="fa fa-times"></i></span></a>
        </div>
        <div style="margin-left: 20px;">
            <div class="row" style="margin-bottom:20px">
                <div class="col-md-2">
                    <label>Title</label><br>
                    <input type="text" name="cus_title" id="cus_title" class="form-control">
                </div>
                <div class="col-md-1">
                    <label>First Name</label><br>
                    <input type="text" name="cus_firstname" id="cus_firstname" class="form-control">
                </div>
                <div class="col-md-1">
                    <label>Middle Name</label><br>
                    <input type="text" name="cus_midname" id="cus_midname" class="form-control">
                </div>
                <div class="col-md-1">
                    <label>Last Name</label><br>
                    <input type="text" name="cus_lastname" id="cus_lastname" class="form-control">
                </div>
                <div class="col-md-1">
                    <label>Suffix</label><br>
                    <input type="text" name="cus_suffix" id="cus_suffix" class="form-control">
                </div>
                <div class="col-md-6">
                    <label>Email</label><br>
                    <input type="text" name="cus_email" id="cus_email" class="form-control">
                </div>
            </div>
            <div class="row" style="margin-bottom:20px">
                <div class="col-md-6">
                    <label>Company</label><br>
                    <input type="text" name="cus_company" id="cus_company" class="form-control">
                </div>
                <div class="col-md-2">
                    <label>Phone</label><br>
                    <input type="text" name="cus_phone" id="cus_phone" class="form-control">
                </div>
                <div class="col-md-2">
                    <label>Mobile</label><br>
                    <input type="text" name="cus_mobile" id="cus_mobile" class="form-control">
                </div>
                <div class="col-md-2">
                    <label>Fax</label><br>
                    <input type="text" name="cus_fax" id="cus_fax" class="form-control">
                </div>
            </div>
            <div class="row" style="margin-bottom:20px">
                <div class="col-md-6">
                    <label>Display name as</label><br>
                    <input type="text" name="cus_disname" id="cus_disname" class="form-control">
                </div>
                <div class="col-md-3">
                    <label>Other</label><br>
                    <input type="text" name="cus_other" id="cus_other" class="form-control">
                </div>
                <div class="col-md-3">
                    <label>Website</label><br>
                    <input type="text" name="cus_website" id="cus_website" class="form-control">
                </div>
            </div>
            <div class="row" style="margin-bottom:20px">
                <div class="col-md-6">
                    <label>Print on check as</label>
                    <input type="checkbox" name="cus_print" id="cus_print">Use display name<br>
                    <input type="text" name="cus_printtext" id="cus_printtext" class="form-control">
                </div>
                <div class="col-md-3">
                    <input type="checkbox" name="cus_sub_check" id="cus_sub_check" class="form-control">Is sub-customer<br>
                    <select class="form-control" name="cus_subcus" id="cus_subcus">
                        <option value=""></option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-control" name="cus_billthis" id="cus_billthis">
                        <option value="bill_customer">Bill this with customer</option>
                        <option value="bill_parent">Bill this with parent</option>
                    </select>
                </div>
            </div>
            <div class="row" style="margin-bottom:20px;margin-left: 20px">
                <div class="container">
                  <!-- Nav tabs -->
                  <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" data-toggle="tab" href="#nav_address">Address</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#nav_note">Notes</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#nav_tax">Tax info</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#nav_paybill">Payment & Billing</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#nav_language">Language</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#nav_attachment">Attachments</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#nav_custom">Custom fields</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#nav_additional">Additional Info.</a>
                    </li>
                  </ul>

                  <!-- Tab panes -->
                  <div class="tab-content">
                    <div id="nav_address" class="container tab-pane active"><br>
                      <h3>Address</h3>
                      <div class="row">
                          <div class="col-md-6">
                            <label>Billing Address<a href="#">map</a></label><br>
                            <textarea name="cus_bill_address" id="cus_bill_address" class="form-control"></textarea>
                           </div>
                           <div class="col-md-6">
                            <label>Shipping Address<a href="#">map</a></label><br>
                            <textarea name="cus_ship_address" id="cus_ship_address" class="form-control"></textarea>
                           </div>
                      </div>
                      <div class="row">
                          <div class="col-md-3">
                                <label>City</label><br>
                                <input type="text" name="cus_bill_city" id="cus_bill_city" class="form-control" placeholder="city">
                            </div>
                            <div class="col-md-3">
                                <label>State</label><br>
                                <input type="text" name="cus_bill_state" id="cus_bill_state" class="form-control" placeholder="state">
                            </div>
                            <div class="col-md-3">
                                <label>City</label><br>
                                <input type="text" name="cus_ship_city" id="cus_ship_city" class="form-control" placeholder="city">
                            </div>
                            <div class="col-md-3">
                                <label>State</label><br>
                                <input type="text" name="cus_ship_state" id="cus_ship_state" class="form-control" placeholder="state">
                            </div>
                      </div>
                      <div class="row">
                          <div class="col-md-3">
                                <label>Zip code</label><br>
                                <input type="text" name="cus_bill_zip" id="cus_bill_zip" class="form-control" placeholder="zipcode">
                            </div>
                            <div class="col-md-3">
                                <label>Country</label><br>
                                <input type="text" name="cus_bill_country" id="cus_bill_country" class="form-control" placeholder="country">
                            </div>
                            <div class="col-md-3">
                                <label>Zip code</label><br>
                                <input type="text" name="cus_ship_zip" id="cus_ship_zip" class="form-control" placeholder="zipcode">
                            </div>
                            <div class="col-md-3">
                                <label>Country</label><br>
                                <input type="text" name="cus_ship_country" id="cus_ship_country" class="form-control" placeholder="country">
                            </div>
                      </div>
                    </div>
                    <div id="nav_note" class="container tab-pane fade"><br>
                      <h3>Notes</h3>
                      <div class="row" style="margin-bottom:20px">
                            <div class="col-md-12">
                                <label>Notes</label><br>
                                <textarea name="cus_notes" id="cus_notes" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div id="nav_tax" class="container tab-pane fade"><br>
                      <div class="row">
                          <div class="col-md-3">
                              <input type="checkbox" name="check_tax" id="check_tax" class="form-control">This customer is tax exempt
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-md-3">
                              <label>Reason for exemption*</label><br>
                              <select class="form-control" name="select_tax" id="select_tax">
                                  <option value=""></option>
                              </select>
                          </div>
                          <div class="col-md-3">
                              <label>Exemption Detail</label><br>
                              <input type="text" name="detail_tax" id="detail_tax" class="form-control">
                          </div>
                      </div>
                    </div>
                    <div id="nav_paybill" class="container tab-pane fade"><br>
                        <div class="row">
                            <div class="col-md-3">
                                <label>Prefer payment method</label><br>
                                <select class="form-control fa" name="cus_pay_method" id="cus_pay_method">
                                    <option value=""></option>
                                    <option value="fa fa-plus">&#xf067; Add new</option>
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>Terms</label><br>
                                <select name="cus_term" id="cus_term" class="form-control fa">
                                    <option></option>
                                    <option value="fa fa-plus">&#xf067; Add new</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Preferred delivery method</label><br>
                                    <select class="form-control" name="cus_deli_method" id="cus_deli_method">
                                        <option value="printlater">Print later</option>
                                        <option value="savelater">Save later</option>
                                        <option value="none">None</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Opening Balance</label>
                                    <input type="text" name="cus_bal" id="cus_bal" class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <label>as of</label>
                                    <div class="col-xs-1 date_picker">
                                        <input type="text" name="cus_date" id="cus_date" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="nav_language" class="container tab-pane fade"><br>
                        <div class="row">
                            <div class="col-md-3">
                                <label>Send invoices to this customer in</label><br>
                                <select class="form-control" name="cus_language" id="cus_language">
                                        <option value="eng">English</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div id="nav_attachment" class="container tab-pane fade"><br>
                        <div class="col-md-6">
                            <label>Attachment</label>
                            </br>
                            <iframe name="hiddenFramecus" width="0" height="0" border="0" style="display: none;"></iframe>
                            <form action="<?php echo url('accounting/reconcile/do_upload/') ?><?=$rows[0]->chart_of_accounts_id?>" class="uploadmy" method="post" name="cusForm" enctype="multipart/form-data" target="hiddenFramecus">
                            <div class="file-upload-block">
                                <div class="upload-btn-wrapper">
                                    <button class="btn ubw">
                                        <i class="fa fa-cloud-upload"></i>
                                        <h6>Drag and drop files here or <span>browse to upload</span></h6>
                                    </button>
                                    <input type="file" name="userfile_cus" />
                                    <input type="hidden" name="reconcile_id" value="<?=$rows[0]->id?>">
                                    <input type="hidden" name="subfix" value="cus">
                                </div>
                            </div>
                            </br>
                            <button type="submit" class="form-control">Upload</button>
                            </form>
                            </br>
                        </div>
                    </div>
                    <div id="nav_custom" class="container tab-pane fade"><br>
                        <div class="col-md-6">
                            <h4>Get custom fields with Advanced</h4>
                            <p>Custom fields let you add more detailed info about your customers and transactions.</p>
                            <p>Sort, track, and report info that's important to you.</p>
                        </div>
                    </div>
                    <div id="nav_additional" class="container tab-pane fade"><br>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Customer Type</label><br>
                                <select class="form-control" name="cus_custype" id="cus_custype">
                                </select>
                            </div>
                        </div>
                    </div>
                  </div>

                </div>
            </div>
            <hr>
            <div class="save-act" style="position: unset !important;">
            <button type="button" class="btn-cmn" onclick="closeCustomer()">Cancel</button>
            <button type="submit" class="savebtn">Save</button>
        </div>
        </div>
    </div>
    <!-- End Add Customer -->

    <!-- Add Agency Sidebar -->
    <div id="overlay" class=""></div>
    <div id="side-menu" class="main-side-nav">
        <div class="side-title">
            <h4>Add to Bank Deposit</h4>
            <a id="close-menu" class="menuCloseButton" onclick="closeSideNav()"><span id="side-menu-close-text">
            <i class="fa fa-times"></i></span></a>
        </div>
        <div class="mainMenu nav">
            <div class="existing-listing">
                <div class="inner-like">
                    <div class="dropdown">
                        <button class="btn-exisitng dropdown-toggle" type="button" data-toggle="dropdown">Unliked
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                            <li><a href="#">All</a></li>
                            <li><a href="#">Unliked</a></li>
                        </ul>
                    </div>
                </div>

                <div id="ajax_upload_data"></div>
            </div>
        </div>
    </div>
    <!-- End Add Agency Sidebar -->

    <!-- Add Terms -->
    <div id="overlay-term-tx" class=""></div>
    <div id="side-menu-term-tx" class="main-side-nav">
        <div class="side-title">
            <h4>New Term</h4>
            <a id="close-menu-term-tx" class="menuCloseButton" onclick="closeTerm()"><span id="side-menu-close-text">
            <i class="fa fa-times"></i></span></a>
        </div>
        <div style="margin-left: 20px;">
            <div class="row" style="margin-bottom:20px">
                <div class="col-md-12">
                    <label>Name</label>
                    <input type="text" name="term_name" id="term_name" class="form-control">
                </div>
            </div>
            <div class="row" style="margin-bottom:20px">
                <div class="col-md-12">
                    <input type="radio" name="term_radio" id="term_radio"> <label>Due in fix number of days</label><br>
                    <input type="number" name="term_fixdays" id="term_fixdays" class="form-control">Days
                </div>
            </div>
            <div class="row" style="margin-bottom:20px">
                <div class="col-md-12">
                    <input type="radio" name="term_radio" id="term_radio"> <label>Due by certain day of the month</label><br>
                    <input type="number" name="term_daymonth" id="term_daymonth" class="form-control">Day of months
                </div>
            </div> 
            <div class="row" style="margin-bottom:20px">
                <div class="col-md-12">
                    <label>Due the next month if issued within</label><br>
                    <input type="number" name="term_duedate" id="term_duedate" class="form-control">Day of due date
                </div>
            </div>
            <hr>
            <div class="save-act" style="position: unset !important;">
            <button type="button" class="btn-cmn" onclick="closeTerm()">Cancel</button>
            <button type="submit" class="savebtn">Save</button>
        </div>
        </div>
    </div>
    <!-- End Add Terms -->

<div class="wrapper" role="wrapper">
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-2">
                        <h1 class="page-title">Reconcile</h1>
                    </div>
                    <div class="col-md-3">
                        <h4><?=$this->chart_of_accounts_model->getName($rows[0]->chart_of_accounts_id)?></h4>
                    </div>
                    <div class="col-md-1 hide-col"><h4>$<?=$rows[0]->service_charge?></h4></div>
                    <div class="col-md-1 hide-col"><h4>$<?=$rows[0]->interest_earned?></h4></div>
                    <div class="col-md-1 hide-col"><h4>$<?=$rows[0]->ending_balance-(($accBalance-$rows[0]->service_charge)+$rows[0]->interest_earned)?></h4></div>
                    <div class="diff" style="display: none;"><?=$rows[0]->ending_balance-(($accBalance-$rows[0]->service_charge)+$rows[0]->interest_earned)?></div>
                    <div class="col-sm-4">
                        <div class="float-right d-none d-md-block">
                            <div class="dropdown show">
                            <a href="<?php echo url('accounting/reconcile/edit/')?><?=$rows[0]->id?>" class="btn btn-primary"
                                   aria-expanded="false">
                                    Edit Info
                            </a>
                             <a href="#" class="btn btn-primary"
                                   aria-expanded="false">
                                    Save for later
                              </a>
                              <a class="btn btn-primary hide-toggle dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-chevron-down"></i>
                              </a>

                              <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="#" data-toggle="modal"  onclick="getDiff()" >Finish Now</a>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#popup-opn">Save for later</a>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#popup-cls">Close without saving</a>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2">Statement ending date:</div>
                    <div class="col-md-3"><?=date("d.m.Y", strtotime($rows[0]->ending_date));?></div>
                    <div class="col-md-1 hide-col">1PAYMENT</div>
                    <div class="col-md-1 hide-col">1DEPOSIT</div>
                    <div class="col-md-1 hide-col">DIFFERENCE</div>
                    <div class="col-sm-4"></div>
                </div>
                <div class="row">
                    <p>
                      <button class="btn btn-primary ex-button" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        <i class="fa fa-chevron-down"></i>
                      </button>
                    </p>
                    <div class="collapse" id="collapseExample">
                      <div class="card card-body">
                       <p style="color: #ffff"> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.</p>
                         <div class="row">
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-4"><h3 id="ending_balance">$<?=$rows[0]->ending_balance?>.00</h3></div>
                                    <div class="col-md-1"><h4>-</h4></div>
                                    <div class="col-md-4"><h3>$<?=($accBalance-$rows[0]->service_charge)+$rows[0]->interest_earned?>.00</h3></div>
                                </div>
                                 <div class="row">
                                    <div class="col-md-4">STATEMENT ENDING BALANCE</div>
                                    <div class="col-md-1"></div>
                                    <div class="col-md-4">CLEARED BALANCE</div>
                                </div>
                                 <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-3"><h4>$<?=$accBalance?>.00</h4></div>
                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col-md-5"><h4>$<?=$rows[0]->service_charge?></h4></div>
                                            <div class="col-md-2"><h4>+</h4></div>
                                            <div class="col-md-5"><h4>$<?=$rows[0]->interest_earned?></h4></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-3">BEGINNING BALANCE</div>
                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col-md-5">1 PAYMENT</div>
                                            <div class="col-md-2"></div>
                                            <div class="col-md-5">1 DEPOSIT</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="row">
                                    <div class="col-md-12"><h3>$<?=$rows[0]->ending_balance-(($accBalance-$rows[0]->service_charge)+$rows[0]->interest_earned)?>.00</h3></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">DIFFERENCE</div>
                                </div>
                            </div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
           <div id="chart_of_accounts_id" style="display: none;"><?=$rows[0]->chart_of_accounts_id?></div>
             <?php echo form_open_multipart('users/save', ['class' => 'form-validate', 'autocomplete' => 'off']); ?>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-10"></div>
                                <div class="col-md-2"><a href="">Show me around</a></div>
                            </div>
                             <div class="row">
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <ul class="nav nav-pills nav-fill" style="border: 5;">
                                      <li class="nav-item">
                                        <a class="nav-link" href="#" onclick="payments()">Payments</a>
                                      </li>
                                      <li class="nav-item">
                                        <a class="nav-link" href="#" onclick="deposites()">Deposites</a>
                                      </li>
                                      <li class="nav-item">
                                        <a class="nav-link active" href="#" onclick="displayall()">All</a>
                                      </li>
                                    </ul>
                                </div>
                                <div class="col-md-3"></div>
                                <div class="col-md-1 form-group">
                                     <div class="dropdown">
                                       <a href="#" onclick = "window.print()"><i class="fa fa-print"></i></a>
                                       <a class="hide-toggle dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-cog"></i>
                                       </a>
                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        Edit Columns<br/>
                                        <p class="p-padding"><input type="checkbox" name="chk_type" id="chk_type" checked="checked" onchange="col_type()"> Type</p>
                                        <p class="p-padding"><input type="checkbox" name="chk_refno" id="chk_refno" checked="checked" onchange="col_refno()"> Ref. no</p>
                                        <p class="p-padding"><input type="checkbox" name="chk_account" id="chk_account" checked="checked" onchange="col_account()"> Account</p>
                                        <p class="p-padding"><input type="checkbox" name="chk_payee" id="chk_payee" checked="checked" onchange="col_payee()"> Payee</p>
                                        <p class="p-padding"><input type="checkbox" name="chk_memo" id="chk_memo" checked="checked" onchange="col_memo()"> Memo</p>
                                        <!-- <p class="p-padding"><input type="checkbox" name="chk_status" id="chk_status" checked="checked" onchange="col_status()"> Banking Status</p> -->
                                        <br/>
                                        Display Density
                                        <p class="p-padding"><input type="radio" name="" id=""> Regular</p>
                                        <p class="p-padding"><input type="radio" name="" id=""> Compact</p>
                                        <p class="p-padding"><input type="radio" name="" id=""> Ultra compact</p>
                                      </div>
                                    </div>
                                 </div>
                             </div>
                             <div class="row">
                                 <div class="col-md-7">
                                    <section class="filter-wrp">
                                        <div class="container">
                                            <div class="filter-box dropdown">
                                                <a href="javascript:void(0);" class="dropopenbx"><i class="fa fa-filter"></i></a>

                                                <div class="dropdown-menu">
                                                    <div class="inner-filter-list">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label>Find</label>
                                                                    <input type="search" id="find" size="20" maxlength="524288" minlength="0" class="form-control" placeholder="Memo, Ref. no, $amt, >$amt, <$amt" aria-controls="reconcile_table">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 col-sm-4">
                                                                <div class="form-group">
                                                                    <label>Cleared status</label>
                                                                    <select id="cleardrop" name="cleardrop" class="form-control">
                                                                        <option>All</option>
                                                                        <option>Cleared</option>
                                                                        <option>Not Cleared</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 col-sm-4">
                                                                <div class="form-group">
                                                                    <label>Transaction type</label>
                                                                    <select id="transaction_type" class="form-control">
                                                                        <option>All</option>
                                                                        <option>Bill</option>
                                                                        <option>Bill Payment</option>
                                                                        <option>CC Bill Payment</option>
                                                                        <option>Cash Expense</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 col-sm-4">
                                                                <div class="form-group">
                                                                    <label>Payee</label>
                                                                    <select name='payee_drop' class='form-control select2'>
                                                                        <option value='' disabled selected>All</option>
                                                                        <?php
                                                                        foreach($this->AccountingVendors_model->select() as $ro)
                                                                        {
                                                                            echo "<option value='".$ro->id."'>".$ro->f_name." ".$ro->l_name."</option>";
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 col-sm-4">
                                                                <div class="form-group">
                                                                    <label>Date</label>
                                                                    <select id="dropdate" name="dropdate" class="form-control" onchange="myfunc();">
                                                                        <option>All</option>
                                                                        <option>Custome Date</option>
                                                                        <option>Statement Ending Date</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 col-sm-4">
                                                                <div class="form-group">
                                                                    <label>From</label>
                                                                    <div class="col-xs-10 date_picker">
                                                                    <input type="text" id="from_date" name="from_date" class="form-control disableFuturedate">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 col-sm-4">
                                                                <div class="form-group">
                                                                    <label>To</label>
                                                                    <div class="col-xs-10 date_picker">
                                                                    <input type="text" id="to_date" name="to_date" class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="btn-group">
                                                            <a href="#" class="btn-main">Reset</a>
                                                            <a href="#" id="apply-btn" class="btn-main apply-btn" onclick="applybtn()">Apply</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                 </div>
                                 <div class="col-md-3"><!-- <a href="#"><i class="fa fa-close"></i>Statment ending date</a> --></div>
                                 <div class="col-md-2"><a href="#">Clear All / View All</a></div>
                             </div>
                             <?php
                             foreach($rows as $row)
                              {
                                echo "<input id='ending_date' type='hidden' value='".date("d.m.Y", strtotime($rows[0]->ending_date))."'/>";
                              }
                             ?>
                             <div class="row" id="filtername" style="margin-bottom: 20px">
                                 
                             </div>

                            <div id="XYZ_id" style="display: none;"><?=$rows[0]->id?></div>
                            <table id="reconcile_table" class="table table-striped table-bordered accordion" style="width:100%;cursor: pointer;">
                                <thead>
                                <tr>
                                    <th>DATE</th>
                                    <th class="type">TYPE</th>
                                    <th class="refno">REF. NO</th>
                                    <th class="account">ACCOUNT</th>
                                    <th class="payee">PAYEE</th>
                                    <th class="memo">MEMO</th>
                                    <!-- <th class="status">status</th> -->
                                    <th>PAYMENT(USD)</th>
                                    <th>DEPOSIT(USD)</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody id="tbody">
                            <?php
                              $i=1;
                              $o=1;
                              foreach($rows as $row)
                              {
                                echo "<input style='display:none' type='text' id='id' value='".$row->id."'/>";
                                if($row->service_charge !=0 && $row->expense_account!='')
                                {
                                echo "<tr id='payments' onclick='trClick(".$o.")'>";
                                echo "<td >".$row->first_date."</td>";
                                echo "<td class='type'>".$this->chart_of_accounts_model->getName($row->chart_of_accounts_id)."</td>";
                                echo "<td class='refno' >".$row->checkno."</td>";
                                echo "<td class='account'>".$row->expense_account."</td>";
                                echo "<td name='payee' class='payee' >";
                                    echo "<select name='payee' class='form-control select2'>";
                                    echo "<option value='' disabled selected>Payee</option>";
                                    foreach($this->AccountingVendors_model->select() as $ro)
                                    {
                                        echo "<option value='".$ro->id."'>".$ro->f_name." ".$ro->l_name."</option>";
                                    }
                                    echo  "</select>";
                                echo "</td>";
                                echo "<td class='memo' >".$row->memo_sc."</td>";
                                /*echo  "<td class='status'></td>";*/
                                echo  "<td >".$row->service_charge."</td>";
                                echo  "<td></td>";
                                echo "<td><input type='checkbox'></td>";
                                echo "</tr>";
                                echo "<tr class='tr_class_".$o."' style='display:none'>";
                                echo "<td><div class='col-xs-10 date_picker'><input type='text' name='first_date' id='first_date' value='".$row->first_date."' class='form-control'></div></td>";
                                echo "<td id='type'>".$this->chart_of_accounts_model->getName($row->chart_of_accounts_id)."</td>";
                                echo "<td><input type='text' name='SVCCHRG' id='SVCCHRG' value='".$row->checkno."' class='form-control'></td>";
                                echo "<td><select name='expense_account' id='expense_account' class='form-control'>";
                                        foreach ($this->account_sub_account_model->get() as $rw)
                                        {
                                           echo "<option ";
                                           if($row->expense_account == $rw->sub_acc_name){
                                            echo "selected";
                                            }
                                            echo " value='".$rw->sub_acc_name."'>".$rw->sub_acc_name."</option>";
                                        }
                                echo "</select></td>";
                                echo "<td><select name='payee_name' id='payee_name' class='form-control'>
                                        <option value='' disabled selected>Payee</option>";
                                        foreach($this->AccountingVendors_model->select() as $ro)
                                        {
                                        echo "<option value='".$ro->id."'>".$ro->f_name." ".$ro->l_name."</option>";
                                        }
                                echo "</select></td>";
                                echo "<td><input type='text' name='sc' id='sc' value='".$row->memo_sc."' class='form-control'></td>";
                                echo "<td><input type='text' name='service_charge' id='service_charge' value='".$row->service_charge."' class='form-control'></td>";   
                                echo "<td></td>";                                
                                echo "<td><i class='fa fa-times' onclick='crossClick(".$o.")'></i></td>";    
                                echo "</tr>";
                                echo "<tr class='tr_class_".$o."' style='display:none'>";
                                echo "<td><a href='#' class='btn-ed' onclick='crossClick(".$o.")'>Cancel</a></td>";
                                echo "<td><a href='#' class='btn-ed' onclick='openFullNav()'>Edit</a></td>";
                                echo "<td><a href='#' class='btn-ed savebt1'>Save</a></td>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "</tr>";
                                }
                                $o++;
                                if($row->interest_earned !=0 && $row->income_account!='')
                                {
                                echo "<tr id='deposites' onclick='trClick(".$o.")'>";
                                echo "<td contenteditable='true'>".$row->second_date."</td>";
                                echo "<td class='type'>".$this->chart_of_accounts_model->getName($row->chart_of_accounts_id)."</td>";
                                echo "<td class='refno' contenteditable='true'>INTEREST</td>";
                                echo "<td class='account'>".$row->income_account."</td>";
                                echo "<td class='payee' contenteditable='true'>";
                                    echo "<select name='payee' class='form-control select2'>";
                                    echo "<option value='' disabled selected>Payee</option>";
                                    foreach($this->AccountingVendors_model->select() as $ro)
                                    {
                                        echo "<option value='".$ro->id."'>".$ro->f_name." ".$ro->l_name."</option>";
                                    }
                                    echo  "</select>";
                                echo "</td>";
                                echo "<td class='memo' contenteditable='true'>".$row->memo_it."</td>";
                                /*echo  "<td class='status'></td>";*/
                                echo  "<td contenteditable='true'></td>";
                                echo  "<td>".$row->interest_earned."</td>";
                                echo "<td><input type='checkbox'></td>";
                                echo "</tr>";
                                echo "<tr class='tr_class_".$o."' style='display:none'>";
                                echo "<td><div class='col-xs-10 date_picker'><input type='text' name='second_date' id='second_date' value='".$row->second_date."' class='form-control'></div></td>";
                                echo "<td id='type'>".$this->chart_of_accounts_model->getName($row->chart_of_accounts_id)."</td>";
                                echo "<td><input disabled type='text' name='INTEREST' id='INTEREST' value='INTEREST' class='form-control'></td>";
                                echo "<td><select name='income_account' id='income_account' class='form-control'>";
                                        foreach ($this->account_sub_account_model->get() as $rw)
                                        {
                                           echo "<option ";
                                           if($row->income_account == $rw->sub_acc_name){
                                            echo "selected";
                                            }
                                            echo " value='".$rw->sub_acc_name."'>".$rw->sub_acc_name."</option>";
                                        }
                                echo "</select></td>";
                                 echo "<td><select disabled name='' id='' class='form-control'>
                                        <option value='' disabled selected>Payee</option>";
                                        foreach($this->AccountingVendors_model->select() as $ro)
                                        {
                                        echo "<option value='".$ro->id."'>".$ro->f_name." ".$ro->l_name."</option>";
                                        }
                                echo "</select></td>";
                                echo "<td><input type='text' name='it' id='it' value='".$row->memo_it."' class='form-control'></td>";
                                echo "<td></td>";                                
                                echo "<td><input type='text' name='interest_earned' id='interest_earned' value='".$row->interest_earned."' class='form-control'></td>";
                                echo "<td><i class='fa fa-times' onclick='crossClick(".$o.")'></i></td>";    
                                echo "</tr>";
                                echo "<tr class='tr_class_".$o."' style='display:none'>";
                                echo "<td><a href='#' class='btn-ed'>Cancel</a></td>";
                                echo "<td><a href='#' class='btn-ed' onclick='openFullNav_int()'>Edit</a></td>";
                                echo "<td><a href='#' class='btn-ed savebt2'>Save</a></td>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "</tr>";
                                }
                              $i++;
                              $o++;
                              }
                               ?>
                               <?php
                                $osc= 1;
                               if(!empty($this->reconcile_model->select_service($rows[0]->id,$rows[0]->chart_of_accounts_id)))
                                {
                                    foreach ($this->reconcile_model->select_service($rows[0]->id,$rows[0]->chart_of_accounts_id) as $row_sc) 
                                    {
                                        echo "<input type='text' name='scid_".$osc."' id='scid_".$osc."' value='".$row_sc->id."' style='display:none'>";
                                        echo "<tr id='payments' onclick='trClickSC(".$osc.")'>";
                                        echo "<td >".$rows[0]->first_date."</td>";
                                        echo "<td class='type'>".$this->chart_of_accounts_model->getName($rows[0]->chart_of_accounts_id)."</td>";
                                        echo "<td class='refno' >".$rows[0]->CHRG."</td>";
                                        echo "<td class='account expense_account_sub_".$osc."'>".$row_sc->expense_account_sub."</td>";
                                        echo "<td name='payee' class='payee' >";
                                            echo "<select name='payee' class='form-control select2'>";
                                            echo "<option value='' disabled selected>Payee</option>";
                                            foreach($this->AccountingVendors_model->select() as $ro)
                                            {
                                                echo "<option value='".$ro->id."'>".$ro->f_name." ".$ro->l_name."</option>";
                                            }
                                            echo  "</select>";
                                        echo "</td>";
                                        echo "<td class='memo descp_sc_sub_".$osc."' >".$row_sc->descp_sc_sub."</td>";
                                        /*echo  "<td class='status'></td>";*/
                                        echo  "<td class='service_charge_sub_".$osc."' >".$row_sc->service_charge_sub."</td>";
                                        echo  "<td></td>";
                                        echo "<td><input type='checkbox'></td>";
                                        echo "</tr>";
                                         echo "<tr class='tr_sc_class_".$osc."' style='display:none'>";
                                        echo "<td><div class='col-xs-10 date_picker'><input type='text' name='first_date' id='first_date' value='".$rows[0]->first_date."' class='form-control'></div></td>";
                                        echo "<td id='type'>".$this->chart_of_accounts_model->getName($rows[0]->chart_of_accounts_id)."</td>";
                                        echo "<td><input type='text' name='SVCCHRG_".$osc."' id='SVCCHRG_".$osc."' value='".$rows[0]->checkno."' class='form-control'></td>";
                                        echo "<td><select name='expense_account_sub_".$osc."' id='expense_account_sub_".$osc."' class='form-control' disabled>";
                                                foreach ($this->account_sub_account_model->get() as $rw)
                                                {
                                                   echo "<option ";
                                                   if($row_sc->expense_account_sub == $rw->sub_acc_name){
                                                    echo "selected";
                                                    }
                                                    echo " value='".$rw->sub_acc_name."'>".$rw->sub_acc_name."</option>";
                                                }
                                        echo "</select></td>";
                                        echo "<td><select name='payee_name' id='payee_name' class='form-control'>
                                                <option value='' disabled selected>Payee</option>";
                                                foreach($this->AccountingVendors_model->select() as $ro)
                                                {
                                                echo "<option value='".$ro->id."'>".$ro->f_name." ".$ro->l_name."</option>";
                                                }
                                        echo "</select></td>";
                                        echo "<td><input type='text' name='descp_sc_sub_".$osc."' id='descp_sc_sub_".$osc."' value='".$row_sc->descp_sc_sub."' class='form-control'></td>";
                                        echo "<td><input type='text' name='service_charge_sub_".$osc."' id='service_charge_sub_".$osc."' value='".$row_sc->service_charge_sub."' class='form-control' disabled></td>";   
                                        echo "<td></td>";                                
                                        echo "<td><i class='fa fa-times' onclick='crossClickSC(".$osc.")'></i></td>";    
                                        echo "</tr>";
                                        echo "<tr class='tr_sc_class_".$osc."' style='display:none'>";
                                        echo "<td><a href='#' class='btn-ed' onclick='crossClickSC(".$osc.")'>Cancel</a></td>";
                                        echo "<td><a href='#' class='btn-ed' onclick='openFullNav()'>Edit</a></td>";
                                        echo "<td><a href='#' class='btn-ed savebtsc' onclick='savebtsc(".$osc.")'>Save</a></td>";
                                        echo "<td></td>";
                                        echo "<td></td>";
                                        echo "<td></td>";
                                        echo "<td></td>";
                                        echo "<td></td>";
                                        echo "<td></td>";
                                        echo "</tr>";
                                    $osc++;
                                    }
                                }
                               ?>
                                </tbody>
                            </table>
                            <div id="textContent"></div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <?php echo form_close(); ?>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
    <?php include viewPath('includes/sidebars/accounting/accounting'); ?>
</div>
<?php /*include viewPath('includes/footer');*/ ?>
<?php include viewPath('includes/footer_accounting'); ?>
<script>
    function convertDate(inputFormat) {
      function pad(s) { return (s < 10) ? '0' + s : s; }
      var d = new Date(inputFormat)
      return [pad(d.getDate()), pad(d.getMonth()), d.getFullYear()].join('.')
    }
    $(document).ready(function() {
        $('.date_picker input').datepicker({
           format: "dd.mm.yyyy",
           todayBtn: "linked",
           language: "de"
        });
        $('.select2').select2();
        $('#from_date').attr("disabled", "disabled" );
        $('#to_date').attr("disabled", "disabled" );
    } );

    var table = $('#reconcile_table').DataTable({sDom: 'lrtip',"iDisplayLength": 12});

    function applybtn(){
        var filtername = document.getElementById('filtername').innerHTML;
        var find = $('#find').val();
        if(find!='')
        {
            table.search( find ).draw();
            if(filtername.includes("findtag")  == false)
            {
            var findtag ="<button type='button' id='findTag' class='btn btn-info' onclick='removeTag(this)' style='margin-right: 20px'>"+find+"<i class='fa fa-close'></i></button>";
            document.getElementById('filtername').innerHTML+=findtag;
            }
        }
        else
        {
            table.search( '' ).columns().search( '' ).draw();
        }
        var selectBox = document.getElementById("cleardrop");
        var selectedValue = selectBox.options[selectBox.selectedIndex].value;
        if(selectedValue == 'Not Cleared')
        {
            $("#tbody").hide();
            let ele = document.getElementById('textContent');
            ele.innerHTML = "There are no transactions showing for this account in this time period. If you're filtering transactions, they may be hiding.";
            if(filtername.includes("clear_drop") == false)
            {
            var cleardroptag ="<button type='button' id='clear_drop' class='btn btn-success' onclick='removeCleardrop(this)' style='margin-right: 20px'>"+selectedValue+"<i class='fa fa-close'></i></button>";
            document.getElementById('filtername').innerHTML+=cleardroptag;
            }
        }
        else if(selectedValue == 'Cleared')
        {
            $("#tbody").show();
            let ele = document.getElementById('textContent');
            ele.innerHTML = "";

            if(filtername.includes("clear_drop") == false)
            {
            var cleardroptag ="<button type='button' id='clear_drop' class='btn btn-success' onclick='removeCleardrop(this)' style='margin-right: 20px'>"+selectedValue+"<i class='fa fa-close'></i></button>";
            document.getElementById('filtername').innerHTML+=cleardroptag;
            }
        }
        

        var selectBox1 = document.getElementById("dropdate");
        var selectedValue1 = selectBox1.options[selectBox1.selectedIndex].value;
       if(selectedValue1 == 'Custome Date')
       {
        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();
        var temp_date = from_date.split(".");
        var temp_date2 = to_date.split(".");
        var xxx = "";
        for (var d = new Date(temp_date[2],temp_date[1],temp_date[0]); d <= new Date(temp_date2[2],temp_date2[1],temp_date2[0]); d.setDate(d.getDate() + 1)) {
            if(xxx == '')
            {
                xxx =convertDate(d);
            }
            else
            {
                xxx = xxx+'|'+convertDate(d);
            }
        }
        table.search(xxx,true,false).draw();

        if(filtername.includes("drop_date") == false)
        {
        var dropdate ="<button type='button' id='drop_date' class='btn btn-warning' onclick='removeDropdate(this)' style='margin-right: 20px'>"+selectedValue1+"<i class='fa fa-close'></i></button>";
        document.getElementById('filtername').innerHTML+=dropdate;
        }
       }
       else if (selectedValue1 == 'Statement Ending Date')
       {
        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();
        //table.search( to_date ).draw();
        var temp_date = from_date.split(".");
        var temp_date2 = to_date.split(".");
        var xxx = "";
        for (var d = new Date(temp_date[2],temp_date[1],temp_date[0]); d <= new Date(temp_date2[2],temp_date2[1],temp_date2[0]); d.setDate(d.getDate() + 1)) {
            if(xxx == '')
            {
                xxx =convertDate(d);
            }
            else
            {
                xxx = xxx+'|'+convertDate(d);
            }
        }
        table.search(xxx,true,false).draw();

        if(filtername.includes("drop_date") == false)
        {
        var dropdate ="<button type='button' id='drop_date' class='btn btn-warning' onclick='removeDropdate(this)' style='margin-right: 20px'>"+selectedValue1+"<i class='fa fa-close'></i></button>";
        document.getElementById('filtername').innerHTML+=dropdate;
        }
       }
       else if(selectedValue1 == 'All')
       {
        //table.search( '' ).columns().search( '' ).draw();
       }
       var selectBox2 = document.getElementById("transaction_type");
       var selectedValue2 = selectBox2.options[selectBox2.selectedIndex].value;
       if(selectedValue2 == 'Bill' | selectedValue2 == 'Bill Payment' | selectedValue2 == 'CC Bill Payment' | selectedValue2 == 'Cash Expense')
       {
         $("#tbody").hide();
          let ele = document.getElementById('textContent');
          ele.innerHTML = "There are no transactions showing for this account in this time period. If you're filtering transactions, they may be hiding.";

          if(filtername.includes("tran_type") == false)
         {
          var trantype ="<button type='button' id='tran_type' class='btn btn-danger' onclick='removeTranstype(this)' style='margin-right: 20px'>"+selectedValue2+"<i class='fa fa-close'></i></button>";
          document.getElementById('filtername').innerHTML+=trantype;
         }
       }
       else
       {
         $("#tbody").show();
         let ele = document.getElementById('textContent');
          ele.innerHTML = "";
       }
    }

    function myfunc() {
    var selectBox = document.getElementById("dropdate");
    var selectedValue = selectBox.options[selectBox.selectedIndex].value;
       if(selectedValue == 'Custome Date')
       {
        $('#from_date'). removeAttr("disabled","disabled");
        $('#to_date'). removeAttr("disabled","disabled");
        $('#from_date').val(null);
        $('#to_date').val(null);
       }
       else if (selectedValue == 'Statement Ending Date')
       {
        $('#from_date'). removeAttr("disabled","disabled");
        $('#from_date').val(null);
        var ending_date = $("#ending_date").val();
        $('#to_date').val(ending_date);
        $('#to_date'). attr("disabled","disabled");
        $('.disableFuturedate').datepicker().datepicker('setEndDate',ending_date);
        
       }
       else
       {

        $('#from_date').val(null);
        $('#to_date').val(null);
        $('#from_date').attr("disabled", "disabled" );
        $('#to_date').attr("disabled", "disabled" );
       }
   }

   /* $(".ex-button").click(function() {
        $('.ex-button').html('<i class="fa fa-chevron-up"></i>');
        $('.hide-col').css('color','#dddddd');
    });
    $(".ex-button").click(function() {
    if($( ".collapse" ).hasClass( "show" ))
    {
        $('.ex-button').html('<i class="fa fa-chevron-down"></i>');
        $('.hide-col').css('color','black');
    }
    });*/

    function payments()
    {
        $("#deposites").hide();
        $("#payments").show();
    }
    function deposites()
    {
        $("#deposites").show();
        $("#payments").hide();
    }
    function displayall()
    {
        $("#deposites").show();
        $("#payments").show();
    }
</script>

<!-- filter -->
<script type="text/javascript">
function col_type()
{
    if($('#chk_type').attr('checked'))
    {
        $('#chk_type').removeAttr('checked');
        $('.type').css('display','none');

    }
    else
    {
        $('#chk_type').attr('checked',"checked");
        $('.type').css('display','');
    }
}
function col_refno()
{
    if($('#chk_refno').attr('checked'))
    {
        $('#chk_refno').removeAttr('checked');
        $('.refno').css('display','none');

    }
    else
    {
        $('#chk_refno').attr('checked',"checked");
        $('.refno').css('display','');
    }
}
function col_account()
{
    if($('#chk_account').attr('checked'))
    {
        $('#chk_account').removeAttr('checked');
        $('.account').css('display','none');

    }
    else
    {
        $('#chk_account').attr('checked',"checked");
        $('.account').css('display','');
    }
}
function col_payee()
{
    if($('#chk_payee').attr('checked'))
    {
        $('#chk_payee').removeAttr('checked');
        $('.payee').css('display','none');

    }
    else
    {
        $('#chk_payee').attr('checked',"checked");
        $('.payee').css('display','');
    }
}  
function col_memo()
{
    if($('#chk_memo').attr('checked'))
    {
        $('#chk_memo').removeAttr('checked');
        $('.memo').css('display','none');

    }
    else
    {
        $('#chk_memo').attr('checked',"checked");
        $('.memo').css('display','');
    }
}  
function col_status()
{
    if($('#chk_status').attr('checked'))
    {
        $('#chk_status').removeAttr('checked');
        $('.status').css('display','none');

    }
    else
    {
        $('#chk_status').attr('checked',"checked");
        $('.status').css('display','');
    }
}    

$('.dropopenbx').on('click', function(){
  $('.dropdown-menu').toggleClass('dropopn');
});
</script>
<script type="text/javascript">
    function trClick(o)
    {
        $(".tr_class_"+o).show();
    }
    function crossClick(o)
    {
        $(".tr_class_"+o).hide();
    }
    function trClickSC(o)
    {
        $(".tr_sc_class_"+o).show();
    }
    function crossClickSC(o)
    {
        $(".tr_sc_class_"+o).hide();
    }
    function removeTag(val)
    {
        val.remove();
        $('#find').val('');
        applybtn();
    }
    function removeCleardrop(val)
    {
        val.remove();
        document.getElementById("cleardrop").selectedIndex = 0;
        applybtn();
    }
    function removeDropdate(val)
    {
        val.remove();
        document.getElementById("dropdate").selectedIndex = 0;
        applybtn();
    }
    function removeTranstype(val)
    {
        val.remove();
        document.getElementById("transaction_type").selectedIndex = 0;
        applybtn();
    }
</script>
<script type="text/javascript">
function openSideNav3() {
     
    jQuery("#side-menu-cus-tx").addClass("open-side-nav");
    jQuery("#overlay-cus-tx").addClass("overlay");
}

function closeSideNav3() {
   
    jQuery("#side-menu-cus-tx").removeClass("open-side-nav");
    jQuery("#overlay-cus-tx").removeClass("overlay");
}
</script>
<script type="text/javascript">
function closedelete(val) {
  var id = val;
  if(id!='')
  {
    $.ajax({
        url:"<?php echo url('accounting/reconcile/delete/reconcile') ?>",
        method: "POST",
        data: {id:id},
        success:function(data)
        {
            sweetAlert(
                            'Deleted!',
                            'Reconcile has been deleted.',
                            'success'
                        );
            location.href="<?php echo url('accounting/reconcile') ?>";
        }
    })
  }
}
</script>
<script type="text/javascript">
    function getDiff()
    {
        var diff = $('.diff').text();
        if(diff == 0)
        {
            $("#popup-hold").modal('hide');
            $("#popup-finish").modal('show');
        }
        else
        {
            $("#popup-finish").modal('hide');
            $("#popup-hold").modal('show');
        }
    }

    function openFinishpop(id)
    {
        $("#popup-hold").modal('hide');
        $("#popup-finish").modal('show');
        var id = id;
        var adjustment_date = $("#adjustment_date").val();
        if(adjustment_date!='')
        {
            $.ajax({
            url:"<?php echo url('accounting/reconcile/updatesingle/adjustment_date') ?>",
            method: "POST",
            data: {id:id,adjustment_date:adjustment_date},
            success:function(data)
            {
            }
        })
            $.ajax({
            url:"<?php echo url('accounting/reconcile/delete/reconcile') ?>",
            method: "POST",
            data: {id:id},
            success:function(data)
            {
                sweetAlert(
                            'Deleted!',
                            'Reconcile has been deleted.',
                            'success'
                        );
            }
        })
        }
    }

    $("#adjustment_date").click(function() {
        var minDate = $('#ending_date').val();
        $(this).datepicker().datepicker('setEndDate',minDate)
    });
</script>
<script type="text/javascript">
$('.savebt1').on('click', function() {
  var id = $('#id').val();
  var first_date = $('#first_date').val();
  var SVCCHRG = $('#SVCCHRG').val();
  var expense_account = $('#expense_account').val();
  var payee_name = $('#payee_name').val();
  var memo_sc = $('#sc').val();
  var service_charge = $('#service_charge').val();
  if(id!='')
  {
    $.ajax({
        url:"<?php echo url('accounting/reconcile/update_pg/') ?>"+id,
        method: "POST",
        data: {first_date:first_date,SVCCHRG:SVCCHRG,expense_account:expense_account,payee_name:payee_name,memo_sc:memo_sc,service_charge:service_charge},
        success:function(data)
        {
            sweetAlert(
                            'Updated!',
                            'Reconcile has been updated.',
                            'success'
                        );
        }
    })
  }
  var chart_of_accounts_id = $("#chart_of_accounts_id").text();
  var action = 'updated';
  callhistory(chart_of_accounts_id,action);
});
$('.savebt2').on('click', function() {
  var id = $('#id').val();
  var second_date = $('#second_date').val();
  var income_account = $('#income_account').val();
  var memo_it = $('#it').val();
  var interest_earned = $('#interest_earned').val();
  if(id!='')
  {
    $.ajax({
        url:"<?php echo url('accounting/reconcile/update_pg2/') ?>"+id,
        method: "POST",
        data: {second_date:second_date,income_account:income_account,memo_it:memo_it,interest_earned:interest_earned},
        success:function(data)
        {
            sweetAlert(
                            'Updated!',
                            'Reconcile has been updated.',
                            'success'
                        );
        }
    })
  }
  var chart_of_accounts_id = $("#chart_of_accounts_id").text();
  var action = 'updated';
  callhistory(chart_of_accounts_id,action);
});
function savebtsc(i) {
  var id = $('#id').val();
  var first_date = $('#first_date').val();
  var checkno = $('#SVCCHRG').val();
  var payee_name = $('#payee_name').val();
 
    var scid = $('#scid_'+i).val();
    var expense_account_sub = $('#expense_account_sub_'+i).val();
    var service_charge_sub = $('#service_charge_sub_'+i).val();
    var descp_sc_sub = $('#descp_sc_sub_'+i).val();

    if(scid != '' && scid != 'undefined' && id!='' && id != 'undefined')
    {$.ajax({
            url:"<?php echo url('accounting/reconcile/update_pg_sc/') ?>"+id,
            method: "POST",
            data: {scid:scid,first_date:first_date,checkno:checkno,payee_name:payee_name,descp_sc_sub:descp_sc_sub,expense_account_sub:expense_account_sub,service_charge_sub:service_charge_sub},
            success:function(data)
            {
                $('.expense_account_sub_'+i).text($('#expense_account_sub_'+i).val());
                $('.service_charge_sub_'+i).text($('#service_charge_sub_'+i).val());
                $('.descp_sc_sub_'+i).text($('#descp_sc_sub_'+i).val());
                sweetAlert(
                    'Updated!',
                    'Reconcile has been updated.',
                    'success'
                );
            }
        })}
  var chart_of_accounts_id = $("#chart_of_accounts_id").text();
  callschistory(reconcile_id,chart_of_accounts_id);
  var action = 'updated';
  callhistory(chart_of_accounts_id,action);
}
</script>
<script type="text/javascript">
function openFullNav() {
    jQuery("#side-menu-full-tx").addClass("open-side-nav");
    jQuery("#side-menu-full-tx").css("width","100%");
    jQuery("#side-menu-full-tx").css("overflow-y","auto");
    jQuery("#side-menu-full-tx").css("overflow-x","hidden");
    jQuery("#overlay-full-tx").addClass("overlay");
    $("#memo_sc_nm").text("Check - #"+$("#SVCCHRG").val());
}

function closeFullNav() {
   
    jQuery("#side-menu-full-tx").removeClass("open-side-nav");
    jQuery("#side-menu-full-tx").css("width","0%");
    jQuery("#overlay-full-tx").removeClass("overlay");
}

function openFullNav_int() {
    jQuery("#side-menu-fullint-tx").addClass("open-side-nav");
    jQuery("#side-menu-fullint-tx").css("width","100%");
    jQuery("#side-menu-fullint-tx").css("overflow-y","auto");
    jQuery("#side-menu-fullint-tx").css("overflow-x","hidden");
    jQuery("#overlay-fullint-tx").addClass("overlay");
    $("#memo_int_nm").text("Check - #"+$("#INTEREST").val());
}

function closeFullNav_int() {
   
    jQuery("#side-menu-fullint-tx").removeClass("open-side-nav");
    jQuery("#side-menu-fullint-tx").css("width","0%");
    jQuery("#overlay-fullint-tx").removeClass("overlay");
}
</script>
<script type="text/javascript">
    /* Variables */
    var p = $("#participants").val();
    var p = 1;
    var row = $(".participantRow");

    /* Functions */
    function getP(){
      p = $("#participants").val();
    }

    function addRow() {
      row.clone(true, true).removeClass('hide table-line').appendTo("#participantTable");
      var index =$('#participantTable tr').length -1;
      var final_index = index-1;
      $('#participantTable tr:eq('+index+')').attr("onclick","trClickEdit("+final_index+")");
      $('#participantTable tr:eq('+index+') td:eq(1)').text(index-1);
      $('#participantTable tr:eq('+index+') td:eq(2)').find('select').attr("id","edit_expense_account_"+final_index);
      $('#participantTable tr:eq('+index+') td:eq(2)').find('select').attr("name","edit_expense_account_"+final_index);
      $('#participantTable tr:eq('+index+') td:eq(2)').find('div').attr("class","edit_expense_account_"+final_index);
      $('#participantTable tr:eq('+index+') td:eq(3)').find('input').attr("id","edit_descp_"+final_index);
      $('#participantTable tr:eq('+index+') td:eq(3)').find('input').attr("name","edit_descp_"+final_index);
      $('#participantTable tr:eq('+index+') td:eq(3)').find('div').attr("class","edit_descp_"+final_index);
      $('#participantTable tr:eq('+index+') td:eq(4)').find('input').attr("id","edit_service_charge_"+final_index);
      $('#participantTable tr:eq('+index+') td:eq(4)').find('input').attr("name","edit_service_charge_"+final_index);
      $('#participantTable tr:eq('+index+') td:eq(4)').find('div').attr("class","edit_service_charge_"+final_index);
    }

    function removeRow(button) {
        console.log(button.closest("tr").text());
      button.closest("tr").remove();
      var tot = $('#total').text().substr(9)-button.closest("tr").find('td:eq(4)').text().trim();
      $('#total').text('Total : $'+tot.toFixed(2));
      $('#amount').text('Amount : $'+tot.toFixed(2));
      if(button.closest("tr").find('td:eq(2)').find('select').hasClass("up_row"))
        {
            var id_to_remove =button.closest("tr").find('td:eq(0)').attr("data-id");
            remove_func(id_to_remove);
        }
    }
    /* Doc ready */
    $(".add").on('click', function () {
      getP();
      if($("#participantTable tr").length < 17) {
        addRow();
        var i = Number(p)+1;
        $("#participants").val(i);
      }
      $(this).closest("tr").appendTo("#participantTable");
      if ($("#participantTable tr").length === 3) {
        $(".remove").hide();
      } else {
        $(".remove").show();
      }
    });
    $(".remove").on('click', function () {
      getP();
      if($("#participantTable tr").length === 3) {
        //alert("Can't remove row.");
        $(".remove").hide();
      } else if($("#participantTable tr").length - 1 ==3) {
        $(".remove").hide();
        removeRow($(this));
        var i = Number(p)-1;
        $("#participants").val(i);
      } else {
        removeRow($(this));
        var i = Number(p)-1;
        $("#participants").val(i);
      }
    });
    $("#participants").change(function () {
      var i = 0;
      p = $("#participants").val();
      var rowCount = $("#participantTable tr").length - 2;
      if(p > rowCount) {
        for(i=rowCount; i<p; i+=1){
          addRow();
        }
        $("#participantTable #addButtonRow").appendTo("#participantTable");
      } else if(p < rowCount) {
      }
    });
    $(".clear").on('click', function () {
      if($("#participantTable tr").length - 1 >3) {
        x = 1;
        $('#participantTable > tbody  > tr').each(function() {
            if(x >3)
            {
                $(this).remove();
                var tot_clear = $('#total').text().substr(9)-$(this).closest("tr").find('td:eq(4)').text().trim();
                $('#total').text('Total : $'+tot_clear.toFixed(2));
                $('#amount').text('Amount : $'+tot_clear.toFixed(2));
            }
            x = x+1;
        });
      }
    });
</script>
<script type="text/javascript">
    /* Variables */
    var p = 1;
    var row_int = $(".participantIntRow");

    function addRowInt() {
      row_int.clone(true, true).removeClass('hideint table-line').appendTo("#participantIntTable");
      var index_int =$('#participantIntTable tr').length -1;
      var final_index_int = index_int-1;
      $('#participantIntTable tr:eq('+index_int+')').attr("onclick","trClickEdit_int("+final_index_int+")");
      $('#participantIntTable tr:eq('+index_int+') td:eq(1)').text(index_int-1);
      $('#participantIntTable tr:eq('+index_int+') td:eq(2)').find('select').attr("id","edit_income_account_"+final_index_int);
      $('#participantIntTable tr:eq('+index_int+') td:eq(2)').find('select').attr("name","edit_income_account_"+final_index_int);
      $('#participantIntTable tr:eq('+index_int+') td:eq(2)').find('div').attr("class","edit_income_account_"+final_index_int);
      $('#participantIntTable tr:eq('+index_int+') td:eq(3)').find('input').attr("id","edit_descp_it_"+final_index_int);
      $('#participantIntTable tr:eq('+index_int+') td:eq(3)').find('input').attr("name","edit_descp_it_"+final_index_int);
      $('#participantIntTable tr:eq('+index_int+') td:eq(3)').find('div').attr("class","edit_descp_it_"+final_index_int);
      $('#participantIntTable tr:eq('+index_int+') td:eq(4)').find('input').attr("id","edit_interest_earned_"+final_index_int);
      $('#participantIntTable tr:eq('+index_int+') td:eq(4)').find('input').attr("name","edit_interest_earned_"+final_index_int);
      $('#participantIntTable tr:eq('+index_int+') td:eq(4)').find('div').attr("class","edit_interest_earned_"+final_index_int);
    }

    function removeRowInt(buttonint) {
        console.log(buttonint.closest("tr").text());
      buttonint.closest("tr").remove();
      var totint = $('#inttotal').text().substr(20)-buttonint.closest("tr").find('td:eq(4)').text().trim();
      var totint_final = $('#inttotal_final').text().substr(9)-buttonint.closest("tr").find('td:eq(4)').text().trim();
      $('#inttotal').text('Other Fund Total : $'+totint.toFixed(2));
      $('#inttotal_final').text('Total : $'+totint_final.toFixed(2));
      $('#intamount').text('Amount : $'+totint.toFixed(2));
      if(buttonint.closest("tr").find('td:eq(2)').find('select').hasClass("up_row"))
        {
            var id_to_remove =buttonint.closest("tr").find('td:eq(0)').attr("data-id");
            remove_func_int(id_to_remove);
        }
    }
    /* Doc ready */
    $(".add_int").on('click', function () {
      getP();
      if($("#participantIntTable tr").length < 17) {
        addRowInt();
        var i = Number(p)+1;
        $("#participants").val(i);
      }
      $(this).closest("tr").appendTo("#participantIntTable");
      if ($("#participantIntTable tr").length === 3) {
        $(".remove_int").hide();
      } else {
        $(".remove_int").show();
      }
    });
    $(".remove_int").on('click', function () {
      getP();
      if($("#participantIntTable tr").length === 3) {
        //alert("Can't remove row.");
        $(".remove_int").hide();
      } else if($("#participantIntTable tr").length - 1 ==3) {
        $(".remove_int").hide();
        removeRowInt($(this));
        var i = Number(p)-1;
        $("#participants").val(i);
      } else {
        removeRowInt($(this));
        var i = Number(p)-1;
        $("#participants").val(i);
      }
    });
    $("#participants").change(function () {
      var i = 0;
      p = $("#participants").val();
      var rowCount = $("#participantIntTable tr").length - 2;
      if(p > rowCount) {
        for(i=rowCount; i<p; i+=1){
          addRowInt();
        }
        $("#participantIntTable #addButtonRow").appendTo("#participantIntTable");
      } else if(p < rowCount) {
      }
    });
    $(".clear_int").on('click', function () {
      if($("#participantIntTable tr").length - 1 >3) {
        x = 1;
        $('#participantIntTable > tbody  > tr').each(function() {
            if(x >3)
            {
                $(this).remove();
                var totint_clear = $('#inttotal').text().substr(20)-$(this).closest("tr").find('td:eq(4)').text().trim();
                $('#inttotal').text('Other Fund Total : $'+totint_clear.toFixed(2));
                $('#inttotal_final').text('Total : $'+totint_clear.toFixed(2));
                $('#intamount').text('Amount : $'+totint_clear.toFixed(2));
            }
            x = x+1;
        });
      }
    });
</script>
<script type="text/javascript">
function openSideNav() {
     
    jQuery("#side-menu").addClass("open-side-nav");
    jQuery("#overlay").addClass("overlay");
}
function closeSideNav() {
   
    jQuery("#side-menu").removeClass("open-side-nav");
    jQuery("#overlay").removeClass("overlay");
}
</script>
<script type="text/javascript">
function showData() {
    jQuery("#side-menu").addClass("open-side-nav");
    jQuery("#overlay").addClass("overlay");
    $.ajax({
        url:"<?php echo url('accounting/reconcile/view/showData') ?>",
        method: "POST",
        success:function(data)
        {
            $('#ajax_upload_data').html(data);
        }
    })
}
</script>
<script type="text/javascript">
    function trClickEditMain()
    {
        if($('#edit_expense_account').css("display")== 'none')
        {
            $('.edit_expense_account').css('display','none');
            $('#edit_expense_account').show();
            $('.hideme').show();
        }
        if($('#edit_service_charge').attr("type")== 'hidden')
        {
            $('.edit_service_charge').css('display','none');
            $('#edit_service_charge').removeAttr('type','hidden');
            $('#edit_service_charge').attr('type','number');
            $('.hideme').show();
        }
        if($('#edit_descp').attr("type")== 'hidden')
        {
            $('.edit_descp').css('display','none');
            $('#edit_descp').removeAttr('type','hidden');
            $('.hideme').show();
        }
    }
    function trClickEdit(index)
    {
        if($('#edit_expense_account_'+index).css("display")== 'none')
        {
            $('.edit_expense_account_'+index).css('display','none');
            $('#edit_expense_account_'+index).show();
            $('.hideme').show();
        }
        if($('#edit_service_charge_'+index).attr("type")== 'hidden')
        {
            $('.edit_service_charge_'+index).css('display','none');
            $('#edit_service_charge_'+index).removeAttr('type','hidden');
            $('#edit_service_charge_'+index).attr('type','number');
            $('.hideme').show();
        }
        if($('#edit_descp_'+index).attr("type")== 'hidden')
        {
            $('.edit_descp_'+index).css('display','none');
            $('#edit_descp_'+index).removeAttr('type','hidden');
            $('.hideme').show();
        }
    }
    function rightclick()
    {
        length =$('#participantTable tr').length -2;
        $('.edit_expense_account').show();
        $('.edit_expense_account').text($('#edit_expense_account').val());
        $('#edit_expense_account').css('display','none');
        $('.edit_service_charge').show();
        $('.edit_service_charge').text($('#edit_service_charge').val());
        $('#edit_service_charge').attr('type','hidden');
        $('.edit_descp').show();
        $('.edit_descp').text($('#edit_descp').val());
        $('#edit_descp').attr('type','hidden');
        $('.hideme').hide();

        for(var i = 2 ; i <= length ; i++)
        {
            $('.edit_expense_account_'+i).show();
            $('.edit_expense_account_'+i).text($('#edit_expense_account_'+i).val());
            $('#edit_expense_account_'+i).css('display','none');
            $('.edit_service_charge_'+i).show();
            $('.edit_service_charge_'+i).text($('#edit_service_charge_'+i).val());
            $('#edit_service_charge_'+i).attr('type','hidden');
            $('.edit_descp_'+i).show();
            $('.edit_descp_'+i).text($('#edit_descp_'+i).val());
            $('#edit_descp_'+i).attr('type','hidden');
        }

        var total = 0;
        total += parseInt($('.edit_service_charge').text());
        for(var i = 2 ; i <= length ; i++)
        {
            if($('.edit_service_charge_'+i).text() != '')
            {total += parseInt($('.edit_service_charge_'+i).text());}
        }
        $('#total').text('Total : $'+total.toFixed(2));
        $('#amount').text('Amount : $'+total.toFixed(2));
        
    }
    function crossClickEdit()
    {
        $('.edit_expense_account').show();
        $('#edit_expense_account').css('display','none');
        $('.edit_service_charge').show();
        $('#edit_service_charge').attr('type','hidden');
        $('.edit_descp').show();
        $('#edit_descp').attr('type','hidden');
        $('.hideme').hide();
        for(var i = 2 ; i <= length ; i++)
        {
            $('.edit_expense_account_'+i).show();
            $('#edit_expense_account_'+i).css('display','none');
            $('.edit_service_charge_'+i).show();
            $('#edit_service_charge_'+i).attr('type','hidden');
            $('.edit_descp_'+i).show();
            $('#edit_descp_'+i).attr('type','hidden');
        }
    }
</script>
<script type="text/javascript">
    function trClickEditMain_int()
    {
        if($('#edit_income_account').css("display")== 'none')
        {
            $('.edit_income_account').css('display','none');
            $('#edit_income_account').show();
            $('.hideme').show();
        }
        if($('#edit_interest_earned').attr("type")== 'hidden')
        {
            $('.edit_interest_earned').css('display','none');
            $('#edit_interest_earned').removeAttr('type','hidden');
            $('#edit_interest_earned').attr('type','number');
            $('.hideme').show();
        }
        if($('#edit_descp_it').attr("type")== 'hidden')
        {
            $('.edit_descp_it').css('display','none');
            $('#edit_descp_it').removeAttr('type','hidden');
            $('.hideme').show();
        }
    }
    function trClickEdit_int(index)
    {
        if($('#edit_income_account_'+index).css("display")== 'none')
        {
            $('.edit_income_account_'+index).css('display','none');
            $('#edit_income_account_'+index).show();
            $('.hideme').show();
        }
        if($('#edit_interest_earned_'+index).attr("type")== 'hidden')
        {
            $('.edit_interest_earned_'+index).css('display','none');
            $('#edit_interest_earned_'+index).removeAttr('type','hidden');
            $('#edit_interest_earned_'+index).attr('type','number');
            $('.hideme').show();
        }
        if($('#edit_descp_it_'+index).attr("type")== 'hidden')
        {
            $('.edit_descp_it_'+index).css('display','none');
            $('#edit_descp_it_'+index).removeAttr('type','hidden');
            $('.hideme').show();
        }
    }
    function rightclick_int()
    {
        length =$('#participantIntTable tr').length -2;
        $('.edit_income_account').show();
        $('.edit_income_account').text($('#edit_income_account').val());
        $('#edit_income_account').css('display','none');
        $('.edit_interest_earned').show();
        $('.edit_interest_earned').text($('#edit_interest_earned').val());
        $('#edit_interest_earned').attr('type','hidden');
        $('.edit_descp_it').show();
        $('.edit_descp_it').text($('#edit_descp_it').val());
        $('#edit_descp_it').attr('type','hidden');
        $('.hideme').hide();

        for(var i = 2 ; i <= length ; i++)
        {
            $('.edit_income_account_'+i).show();
            $('.edit_income_account_'+i).text($('#edit_income_account_'+i).val());
            $('#edit_income_account_'+i).css('display','none');
            $('.edit_interest_earned_'+i).show();
            $('.edit_interest_earned_'+i).text($('#edit_interest_earned_'+i).val());
            $('#edit_interest_earned_'+i).attr('type','hidden');
            $('.edit_descp_it_'+i).show();
            $('.edit_descp_it_'+i).text($('#edit_descp_it_'+i).val());
            $('#edit_descp_it_'+i).attr('type','hidden');
        }

        var total = 0;
        total += parseInt($('.edit_interest_earned').text());
        for(var i = 2 ; i <= length ; i++)
        {
            if($('.edit_interest_earned_'+i).text() != '')
            {total += parseInt($('.edit_interest_earned_'+i).text());}
        }
        $('#inttotal').text('Other Fund Total : $'+total.toFixed(2));
        $('#intamount').text('Amount : $'+total.toFixed(2));
        if($('#cash_back_amount').val()!='')
        {
            var sub = parseInt($('#cash_back_amount').val());
            var total = total - sub;
        }
        $('#inttotal_final').text('Total : $'+total.toFixed(2));
        update_print();
        
    }
    function crossClickEdit_int()
    {
        length =$('#participantIntTable tr').length -2;
        $('.edit_income_account').show();
        $('#edit_income_account').css('display','none');
        $('.edit_interest_earned').show();
        $('#edit_interest_earned').attr('type','hidden');
        $('.edit_descp_it').show();
        $('#edit_descp_it').attr('type','hidden');
        $('.hideme').hide();
        for(var i = 2 ; i <= length ; i++)
        {
            $('.edit_income_account_'+i).show();
            $('#edit_income_account_'+i).css('display','none');
            $('.edit_interest_earned_'+i).show();
            $('#edit_interest_earned_'+i).attr('type','hidden');
            $('.edit_descp_it_'+i).show();
            $('#edit_descp_it_'+i).attr('type','hidden');
        }
        update_print()
    }
    $("#cash_back_amount").focus(function(){
        $('.hidemefinal').show();
    });
    function rightclick_int_final()
    {
        $('.hidemefinal').hide();

        var totalfinal = parseInt($('#inttotal').text().substr(20));
        var sub = parseInt($('#cash_back_amount').val());
        if($('#cash_back_amount').val()!='')
        {var ftotal = totalfinal - sub;}
        else
        {var ftotal = totalfinal - 0;}
        $('#inttotal_final').text('Total : $'+ftotal.toFixed(2));
        update_print()
    }
    function crossClickEdit_int_final()
    {
       // $('#cash_back_amount').val('');
        $('.hidemefinal').hide();
        update_print()
    }
</script>
<script type="text/javascript">
    /* Variables */
    var p = 1;
    var row_check = $(".participantCheckRow");

    function addRowCheck() {
      row_check.clone(true, true).removeClass('Checkhide table-line').appendTo("#participantCheckTable");
      var index_check =$('#participantCheckTable tr').length -1;
      var final_index_check = index_check-1;
      $('#participantCheckTable tr:eq('+index_check+')').attr("onclick","trClickCheck("+final_index_check+")");
      $('#participantCheckTable tr:eq('+index_check+') td:eq(1)').text(index_check-2);
      $('#participantCheckTable tr:eq('+index_check+') td:eq(2)').find('select').attr("id","check_expense_account_"+final_index_check);
      $('#participantCheckTable tr:eq('+index_check+') td:eq(2)').find('select').attr("name","check_expense_account_"+final_index_check);
      $('#participantCheckTable tr:eq('+index_check+') td:eq(2)').find('div').attr("class","check_expense_account_"+final_index_check);
      $('#participantCheckTable tr:eq('+index_check+') td:eq(3)').find('input').attr("id","check_descp_"+final_index_check);
      $('#participantCheckTable tr:eq('+index_check+') td:eq(3)').find('input').attr("name","check_descp_"+final_index_check);
      $('#participantCheckTable tr:eq('+index_check+') td:eq(3)').find('div').attr("class","check_descp_"+final_index_check);
      $('#participantCheckTable tr:eq('+index_check+') td:eq(4)').find('input').attr("id","check_service_charge_"+final_index_check);
      $('#participantCheckTable tr:eq('+index_check+') td:eq(4)').find('input').attr("name","check_service_charge_"+final_index_check);
      $('#participantCheckTable tr:eq('+index_check+') td:eq(4)').find('div').attr("class","check_service_charge_"+final_index_check);
    }

    function removeRowCheck(buttoncheck) {
        console.log(buttoncheck.closest("tr").text());
      buttoncheck.closest("tr").remove();
      var totcheck = $('#checktotal').text().substr(9)-buttoncheck.closest("tr").find('td:eq(4)').text().trim();
      $('#checktotal').text('Total : $'+totcheck.toFixed(2));
      $('#checkamount').text('Amount : $'+totcheck.toFixed(2));
      if(buttoncheck.closest("tr").find('td:eq(2)').find('select').hasClass("up_row"))
        {
            var id_to_remove =buttoncheck.closest("tr").find('td:eq(0)').attr("data-id");
            remove_func_check(id_to_remove);
        }
    }
    /* Doc ready */
    $(".add_check").on('click', function () {
      getP();
      if($("#participantCheckTable tr").length < 17) {
        addRowCheck();
        var i = Number(p)+1;
        $("#participants").val(i);
      }
      $(this).closest("tr").appendTo("#participantCheckTable");
      if ($("#participantCheckTable tr").length === 3) {
        $(".remove_check").hide();
      } else {
        $(".remove_check").show();
      }
    });
    $(".remove_check").on('click', function () {
      getP();
      if($("#participantCheckTable tr").length === 3) {
        //alert("Can't remove row.");
        $(".remove_check").hide();
      } else if($("#participantCheckTable tr").length - 1 ==3) {
        $(".remove_check").hide();
        removeRowCheck($(this));
        var i = Number(p)-1;
        $("#participants").val(i);
      } else {
        removeRowCheck($(this));
        var i = Number(p)-1;
        $("#participants").val(i);
      }
    });
    $("#participants").change(function () {
      var i = 0;
      p = $("#participants").val();
      var rowCount = $("#participantCheckTable tr").length - 2;
      if(p > rowCount) {
        for(i=rowCount; i<p; i+=1){
          addRowCheck();
        }
        $("#participantCheckTable #addButtonRow").appendTo("#participantCheckTable");
      } else if(p < rowCount) {
      }
    });
    $(".clear_check").on('click', function () {
      if($("#participantCheckTable tr").length - 1 >3) {
        x = 1;
        $('#participantCheckTable > tbody  > tr').each(function() {
            if(x >3)
            {
                $(this).remove();
                var totcheck_clear = $('#checktotal').text().substr(9)-$(this).closest("tr").find('td:eq(4)').text().trim();
                $('#checktotal').text('Total : $'+totcheck_clear.toFixed(2));
                $('#checkamount').text('Amount : $'+totcheck_clear.toFixed(2));
            }
            x = x+1;
        });
      }
    });
</script>
<script type="text/javascript">
    function trClickCheckMain()
    {
        if($('#check_expense_account').css("display")== 'none')
        {
            $('.check_expense_account').css('display','none');
            $('#check_expense_account').show();
            $('.hidemecheck').show();
        }
        if($('#check_service_charge').attr("type")== 'hidden')
        {
            $('.check_service_charge').css('display','none');
            $('#check_service_charge').removeAttr('type','hidden');
            $('#check_service_charge').attr('type','number');
            $('.hidemecheck').show();
        }
        if($('#check_descp').attr("type")== 'hidden')
        {
            $('.check_descp').css('display','none');
            $('#check_descp').removeAttr('type','hidden');
            $('.hidemecheck').show();
        }
    }

    function trClickCheck(index_check)
    {
        if($('#check_expense_account_'+index_check).css("display")== 'none')
        {
            $('.check_expense_account_'+index_check).css('display','none');
            $('#check_expense_account_'+index_check).show();
            $('.hidemecheck').show();
        }
        if($('#check_service_charge_'+index_check).attr("type")== 'hidden')
        {
            $('.check_service_charge_'+index_check).css('display','none');
            $('#check_service_charge_'+index_check).removeAttr('type','hidden');
            $('#check_service_charge_'+index_check).attr('type','number');
            $('.hidemecheck').show();
        }
        if($('#check_descp_'+index_check).attr("type")== 'hidden')
        {
            $('.check_descp_'+index_check).css('display','none');
            $('#check_descp_'+index_check).removeAttr('type','hidden');
            $('.hidemecheck').show();
        }
    }
    function rightclickCheck()
    {
        length_check =$('#participantCheckTable tr').length -2;
        $('.check_expense_account').show();
        $('.check_expense_account').text($('#check_expense_account').val());
        $('#check_expense_account').css('display','none');
        $('.check_service_charge').show();
        $('.check_service_charge').text($('#check_service_charge').val());
        $('#check_service_charge').attr('type','hidden');
        $('.check_descp').show();
        $('.check_descp').text($('#check_descp').val());
        $('#check_descp').attr('type','hidden');
        $('.hidemecheck').hide();

        for(var i = 2 ; i <= length_check ; i++)
        {
            $('.check_expense_account_'+i).show();
            $('.check_expense_account_'+i).text($('#check_expense_account_'+i).val());
            $('#check_expense_account_'+i).css('display','none');
            $('.check_service_charge_'+i).show();
            $('.check_service_charge_'+i).text($('#check_service_charge_'+i).val());
            $('#check_service_charge_'+i).attr('type','hidden');
            $('.check_descp_'+i).show();
            $('.check_descp_'+i).text($('#check_descp_'+i).val());
            $('#check_descp_'+i).attr('type','hidden');
        }

        var total_check = 0;
       // total_check += parseInt($('.check_service_charge').text());
        for(var i = 2 ; i <= length_check ; i++)
        {
            if($('.check_service_charge_'+i).text() != '')
            {total_check += parseInt($('.check_service_charge_'+i).text());}
        }
        $('#checktotal').text('Total : $'+total_check.toFixed(2));
        $('#checkamount').text('Amount : $'+total_check.toFixed(2));
    }
    function crossClickCheck()
    {
        length_check =$('#participantCheckTable tr').length -2;
        $('.check_expense_account').show();
        $('#check_expense_account').css('display','none');
        $('.check_service_charge').show();
        $('#check_service_charge').attr('type','hidden');
        $('.check_descp').show();
        $('#check_descp').attr('type','hidden');
        $('.hidemecheck').hide();
        for(var i = 2 ; i <= length_check ; i++)
        {
            $('.check_expense_account_'+i).show();
            $('#check_expense_account_'+i).css('display','none');
            $('.check_service_charge_'+i).show();
            $('#check_service_charge_'+i).attr('type','hidden');
            $('.check_descp_'+i).show();
            $('#check_descp_'+i).attr('type','hidden');
        }
    }
</script>
<script type="text/javascript">
function openPrintNav()
{
    closeFullNav()
    jQuery("#side-menu-print-tx").addClass("open-side-nav");
    jQuery("#side-menu-print-tx").css("width","100%");
    jQuery("#side-menu-print-tx").css("overflow-y","auto");
    jQuery("#side-menu-print-tx").css("overflow-x","hidden");
    jQuery("#overlay-print-tx").addClass("overlay");
}
function closePrintNav() 
{
   
    jQuery("#side-menu-print-tx").removeClass("open-side-nav");
    jQuery("#side-menu-print-tx").css("width","0%");
    jQuery("#overlay-print-tx").removeClass("overlay");
}
</script>
<script type="text/javascript">
function Changecheck()
{
    if($('#print_service_charge_checkbox').prop("checked") == true)
    {
        $('#check_count').text('1 Checks selected');
        $('#check_amount').text('$'+$('#print_service_charge').text());
    }
    else
    {
        $('#check_count').text('0 Checks selected');
        $('#check_amount').text('$0.00');
    }
}
</script>
<script type="text/javascript">
    function col_date_print()
    {
        if($('#chk_date_print').attr('checked'))
        {
            $('#chk_date_print').removeAttr('checked');
            $('.date_print').css('display','none');

        }
        else
        {
            $('#chk_date_print').attr('checked',"checked");
            $('.date_print').css('display','');
        }
    }
    function col_type_print()
    {
        if($('#chk_type_print').attr('checked'))
        {
            $('#chk_type_print').removeAttr('checked');
            $('.type_print').css('display','none');

        }
        else
        {
            $('#chk_type_print').attr('checked',"checked");
            $('.type_print').css('display','');
        }
    }
    function col_payee_print()
    {
        if($('#chk_payee_print').attr('checked'))
        {
            $('#chk_payee_print').removeAttr('checked');
            $('.payee_print').css('display','none');

        }
        else
        {
            $('#chk_payee_print').attr('checked',"checked");
            $('.payee_print').css('display','');
        }
    }
    function col_amount_print()
    {
        if($('#chk_amount_print').attr('checked'))
        {
            $('#chk_amount_print').removeAttr('checked');
            $('.amount_print').css('display','none');

        }
        else
        {
            $('#chk_amount_print').attr('checked',"checked");
            $('.amount_print').css('display','');
        }
    }
</script>
<script type="text/javascript">
    $('#print_table').DataTable();
</script>
<script type="text/javascript">
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
<script type="text/javascript">
function OpenRecurr()
{
    closeFullNav();
    jQuery("#side-menu-recurr-tx").addClass("open-side-nav");
    jQuery("#side-menu-recurr-tx").css("width","100%");
    jQuery("#side-menu-recurr-tx").css("overflow-y","auto");
    jQuery("#side-menu-recurr-tx").css("overflow-x","hidden");
    jQuery("#overlay-recurr-tx").addClass("overlay");
}
function closeRecurr() 
{
    jQuery("#side-menu-recurr-tx").removeClass("open-side-nav");
    jQuery("#side-menu-recurr-tx").css("width","0%");
    jQuery("#overlay-recurr-tx").removeClass("overlay");
}
</script>
<script type="text/javascript">
function OpenRecurrInt()
{
    jQuery("#side-menu-recurrint-tx").css("display","");
    closeFullNav_int();
    jQuery("#side-menu-recurrint-tx").addClass("open-side-nav");
    jQuery("#side-menu-recurrint-tx").css("width","100%");
    jQuery("#side-menu-recurrint-tx").css("overflow-y","auto");
    jQuery("#side-menu-recurrint-tx").css("overflow-x","hidden");
    jQuery("#overlay-recurrint-tx").addClass("overlay");
}
function closeRecurrInt() 
{
    jQuery("#side-menu-recurrint-tx").removeClass("open-side-nav");
    jQuery("#side-menu-recurrint-tx").css("width","0%");
    jQuery("#overlay-recurrint-tx").removeClass("overlay");
}
</script>
<script type="text/javascript">
    /* Variables */
    var p = 1;
    var row_recurr = $(".participantRecurrRow");

    function addRowRecurr() {
      row_recurr.clone(true, true).removeClass('Recurrhide table-line').appendTo("#participantRecurrTable");
      var index_recurr =$('#participantRecurrTable tr').length -1;
      var final_index_recurr = index_recurr-1;
      $('#participantRecurrTable tr:eq('+index_recurr+')').attr("onclick","trClickRecurr("+final_index_recurr+")");
      $('#participantRecurrTable tr:eq('+index_recurr+') td:eq(1)').text(index_recurr-1);
      $('#participantRecurrTable tr:eq('+index_recurr+') td:eq(2)').find('select').attr("id","recurr_expense_account_"+final_index_recurr);
      $('#participantRecurrTable tr:eq('+index_recurr+') td:eq(2)').find('select').attr("name","recurr_expense_account_"+final_index_recurr);
      $('#participantRecurrTable tr:eq('+index_recurr+') td:eq(2)').find('div').attr("class","recurr_expense_account_"+final_index_recurr);
      $('#participantRecurrTable tr:eq('+index_recurr+') td:eq(3)').find('input').attr("id","recurr_descp_"+final_index_recurr);
      $('#participantRecurrTable tr:eq('+index_recurr+') td:eq(3)').find('input').attr("name","recurr_descp_"+final_index_recurr);
      $('#participantRecurrTable tr:eq('+index_recurr+') td:eq(3)').find('div').attr("class","recurr_descp_"+final_index_recurr);
      $('#participantRecurrTable tr:eq('+index_recurr+') td:eq(4)').find('input').attr("id","recurr_service_charge_"+final_index_recurr);
      $('#participantRecurrTable tr:eq('+index_recurr+') td:eq(4)').find('input').attr("name","recurr_service_charge_"+final_index_recurr);
      $('#participantRecurrTable tr:eq('+index_recurr+') td:eq(4)').find('div').attr("class","recurr_service_charge_"+final_index_recurr);
    }

    function removeRowRecurr(buttonrecurr) {
        console.log(buttonrecurr.closest("tr").text());
      buttonrecurr.closest("tr").remove();
      //var totrecurr = $('#recurrtotal').text().substr(9)-buttonrecurr.closest("tr").find('td:eq(4)').text().trim();
      var totrecurr = $('#recurrtotal').text().substr(9);
      $('#recurrtotal').text('Total : $'+totrecurr);
      if(buttonrecurr.closest("tr").find('td:eq(2)').find('select').hasClass("up_row"))
        {
            var id_to_remove =buttonrecurr.closest("tr").find('td:eq(0)').attr("data-id");
            remove_func_recurr(id_to_remove);
        }
    }
    /* Doc ready */
    $(".add_recurr").on('click', function () {
      getP();
      if($("#participantRecurrTable tr").length < 17) {
        addRowRecurr();
        var i = Number(p)+1;
        $("#participants").val(i);
      }
      $(this).closest("tr").appendTo("#participantRecurrTable");
      if ($("#participantRecurrTable tr").length === 3) {
        $(".remove_recurr").hide();
      } else {
        $(".remove_recurr").show();
      }
    });
    $(".remove_recurr").on('click', function () {
      getP();
      if($("#participantRecurrTable tr").length === 3) {
        //alert("Can't remove row.");
        $(".remove_recurr").hide();
      } else if($("#participantRecurrTable tr").length - 1 ==3) {
        $(".remove_recurr").hide();
        removeRowRecurr($(this));
        var i = Number(p)-1;
        $("#participants").val(i);
      } else {
        removeRowRecurr($(this));
        var i = Number(p)-1;
        $("#participants").val(i);
      }
    });
    $("#participants").change(function () {
      var i = 0;
      p = $("#participants").val();
      var rowCount = $("#participantRecurrTable tr").length - 2;
      if(p > rowCount) {
        for(i=rowCount; i<p; i+=1){
          addRowRecurr();
        }
        $("#participantRecurrTable #addButtonRow").appendTo("#participantRecurrTable");
      } else if(p < rowCount) {
      }
    });
    $(".clear_recurr").on('click', function () {
      if($("#participantRecurrTable tr").length - 1 >3) {
        x = 1;
        $('#participantRecurrTable > tbody  > tr').each(function() {
            if(x >3)
            {
                $(this).remove();
                var totrecurr_clear = $('#recurrtotal').text().substr(9)-$(this).closest("tr").find('td:eq(4)').text().trim();
                $('#recurrtotal').text('Total : $'+totrecurr_clear.toFixed(2));
            }
            x = x+1;
        });
      }
    });
</script>
<script type="text/javascript">
    function trClickRecurrMain()
    {
        if($('#recurr_expense_account').css("display")== 'none')
        {
            $('.recurr_expense_account').css('display','none');
            $('#recurr_expense_account').show();
            $('.hidemerecurr').show();
        }
        if($('#recurr_service_charge').attr("type")== 'hidden')
        {
            $('.recurr_service_charge').css('display','none');
            $('#recurr_service_charge').removeAttr('type','hidden');
            $('#recurr_service_charge').attr('type','number');
            $('.hidemerecurr').show();
        }
        if($('#recurr_descp').attr("type")== 'hidden')
        {
            $('.recurr_descp').css('display','none');
            $('#recurr_descp').removeAttr('type','hidden');
            $('.hidemerecurr').show();
        }
    }

    function trClickRecurr(index_recurr)
    {
        if($('#recurr_expense_account_'+index_recurr).css("display")== 'none')
        {
            $('.recurr_expense_account_'+index_recurr).css('display','none');
            $('#recurr_expense_account_'+index_recurr).show();
            $('.hidemerecurr').show();
        }
        if($('#recurr_service_charge_'+index_recurr).attr("type")== 'hidden')
        {
            $('.recurr_service_charge_'+index_recurr).css('display','none');
            $('#recurr_service_charge_'+index_recurr).removeAttr('type','hidden');
            $('#recurr_service_charge_'+index_recurr).attr('type','number');
            $('.hidemerecurr').show();
        }
        if($('#recurr_descp_'+index_recurr).attr("type")== 'hidden')
        {
            $('.recurr_descp_'+index_recurr).css('display','none');
            $('#recurr_descp_'+index_recurr).removeAttr('type','hidden');
            $('.hidemerecurr').show();
        }
    }
    function rightclickRecurr()
    {
        length_recurr =$('#participantRecurrTable tr').length -2;
        $('.recurr_expense_account').show();
        $('.recurr_expense_account').text($('#recurr_expense_account').val());
        $('#recurr_expense_account').css('display','none');
        $('.recurr_service_charge').show();
        $('.recurr_service_charge').text($('#recurr_service_charge').val());
        $('#recurr_service_charge').attr('type','hidden');
        $('.recurr_descp').show();
        $('.recurr_descp').text($('#recurr_descp').val());
        $('#recurr_descp').attr('type','hidden');
        $('.hidemerecurr').hide();

        for(var i = 2 ; i <= length_recurr ; i++)
        {
            $('.recurr_expense_account_'+i).show();
            $('.recurr_expense_account_'+i).text($('#recurr_expense_account_'+i).val());
            $('#recurr_expense_account_'+i).css('display','none');
            $('.recurr_service_charge_'+i).show();
            $('.recurr_service_charge_'+i).text($('#recurr_service_charge_'+i).val());
            $('#recurr_service_charge_'+i).attr('type','hidden');
            $('.recurr_descp_'+i).show();
            $('.recurr_descp_'+i).text($('#recurr_descp_'+i).val());
            $('#recurr_descp_'+i).attr('type','hidden');
        }

        var total_recurr = 0;
        total_recurr += parseInt($('.recurr_service_charge').text());
        for(var i = 2 ; i <= length_recurr ; i++)
        {
            if($('.recurr_service_charge_'+i).text() != '')
            {total_recurr += parseInt($('.recurr_service_charge_'+i).text());}
        }
        $('#recurrtotal').text('Total : $'+total_recurr.toFixed(2));
    }
    function crossClickRecurr()
    {
        length_recurr =$('#participantRecurrTable tr').length -2;
        $('.recurr_expense_account').show();
        $('#recurr_expense_account').css('display','none');
        $('.recurr_service_charge').show();
        $('#recurr_service_charge').attr('type','hidden');
        $('.recurr_descp').show();
        $('#recurr_descp').attr('type','hidden');
        $('.hidemerecurr').hide();
        for(var i = 2 ; i <= length_recurr ; i++)
        {
            $('.recurr_expense_account_'+i).show();
            $('#recurr_expense_account_'+i).css('display','none');
            $('.recurr_service_charge_'+i).show();
            $('#recurr_service_charge_'+i).attr('type','hidden');
            $('.recurr_descp_'+i).show();
            $('#recurr_descp_'+i).attr('type','hidden');
        }
    }
</script>
<script type="text/javascript">
     $('#interval').on('change', function (e) {
          if($('#interval').val() == 'daily')
          {
            $('#daily').show();
            $('#weekly').hide();
            $('#monthly').hide();
            $('#yearly').hide();
          }
          else if($('#interval').val() == 'weekly')
          {
            $('#daily').hide();
            $('#weekly').show();
            $('#monthly').hide();
            $('#yearly').hide();
          }
          else if($('#interval').val() == 'monthly')
          {
            $('#daily').hide();
            $('#weekly').hide();
            $('#monthly').show();
            $('#yearly').hide();
          }
          else if($('#interval').val() == 'yearly')
          {
            $('#daily').hide();
            $('#weekly').hide();
            $('#monthly').hide();
            $('#yearly').show();
          }
        });
</script>
<script type="text/javascript">
    $('#type_scheduled').on('change', function (e) {
          if($('#type_scheduled').val() == 'scheduled')
          {
            $('#sched_').show();
            $('#unsched_').hide();
            $('#remine_').hide();
            $('#sched_section').show();
          }
          else if($('#type_scheduled').val() == 'unscheduled')
          {
            $('#sched_').hide();
            $('#unsched_').show();
            $('#remine_').hide();
            $('#sched_section').hide();
          }
          else if($('#type_scheduled').val() == 'reminder')
          {
            $('#sched_').hide();
            $('#unsched_').hide();
            $('#remine_').show();
            $('#sched_section').show();
          }
        });
</script>
<script type="text/javascript">
    $('#recurr_select').on('change', function (e) {
          if($('#recurr_select').val() == 'none')
          {
            $('#recurr_by').hide();
            $('#recurr_after').hide();
          }
          else if($('#recurr_select').val() == 'by')
          {
            $('#recurr_by').show();
            $('#recurr_after').hide();
          }
          else if($('#recurr_select').val() == 'after')
          {
            $('#recurr_by').hide();
            $('#recurr_after').show();
          }
        });
</script>
<script type="text/javascript">
    $('#recurr_account_popup').on('change', function (e) {
          if($('#recurr_account_popup').val() == 'fa fa-plus')
          {
           openAddAccount();
          } 
      });
    $('#recurr_payee_popup').on('change', function (e) {
          if($('#recurr_payee_popup').val() == 'fa fa-plus')
          {
           openPayee();
          } 
      });
</script>
<script type="text/javascript">
function openAddAccount()
{
    jQuery("#side-menu-account-tx").show();
    jQuery("#side-menu-account-tx").addClass("open-side-nav");
    jQuery("#side-menu-account-tx").css("width","50%");
    jQuery("#side-menu-account-tx").css("overflow-y","auto");
    jQuery("#side-menu-account-tx").css("overflow-x","hidden");
    jQuery("#overlay-account-tx").addClass("overlay");
}
function closeAddaccount() 
{
    jQuery("#side-menu-account-tx").removeClass("open-side-nav");
    jQuery("#side-menu-account-tx").css("width","0%");
    jQuery("#overlay-account-tx").removeClass("overlay");
}
</script>
<!-- int start-->
<script type="text/javascript">
     $('#interval_int').on('change', function (e) {
          if($('#interval_int').val() == 'daily')
          {
            $('#daily_int').show();
            $('#weekly_int').hide();
            $('#monthly_int').hide();
            $('#yearly_int').hide();
          }
          else if($('#interval_int').val() == 'weekly')
          {
            $('#daily_int').hide();
            $('#weekly_int').show();
            $('#monthly_int').hide();
            $('#yearly_int').hide();
          }
          else if($('#interval_int').val() == 'monthly')
          {
            $('#daily_int').hide();
            $('#weekly_int').hide();
            $('#monthly_int').show();
            $('#yearly_int').hide();
          }
          else if($('#interval_int').val() == 'yearly')
          {
            $('#daily_int').hide();
            $('#weekly_int').hide();
            $('#monthly_int').hide();
            $('#yearly_int').show();
          }
        });
</script>
<script type="text/javascript">
    $('#type_scheduled_int').on('change', function (e) {
          if($('#type_scheduled_int').val() == 'scheduled')
          {
            $('#sched_int_').show();
            $('#unsched_int_').hide();
            $('#remine_int_').hide();
            $('#sched_section_int').show();
          }
          else if($('#type_scheduled_int').val() == 'unscheduled')
          {
            $('#sched_int_').hide();
            $('#unsched_int_').show();
            $('#remine_int_').hide();
            $('#sched_section_int').hide();
          }
          else if($('#type_scheduled_int').val() == 'reminder')
          {
            $('#sched_int_').hide();
            $('#unsched_int_').hide();
            $('#remine_int_').show();
            $('#sched_section_int').show();
          }
        });
</script>
<script type="text/javascript">
    $('#recurr_select_int').on('change', function (e) {
          if($('#recurr_select_int').val() == 'none')
          {
            $('#recurr_by_int').hide();
            $('#recurr_after_int').hide();
          }
          else if($('#recurr_select_int').val() == 'by')
          {
            $('#recurr_by_int').show();
            $('#recurr_after_int').hide();
          }
          else if($('#recurr_select_int').val() == 'after')
          {
            $('#recurr_by_int').hide();
            $('#recurr_after_int').show();
          }
        });
</script>
<script type="text/javascript">
    $('#recurr_account_popup_int').on('change', function (e) {
          if($('#recurr_account_popup_int').val() == 'fa fa-plus')
          {
           openAddAccount();
          } 
      });
</script>
<!-- int end-->
<script type="text/javascript">
    $(document).ready(function () {

        $('.form-validate').validate();

        //Initialize Select2 Elements

        $('.select2').select2()

        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

        elems.forEach(function (html) {
            var switchery = new Switchery(html, {size: 'small'});
        });

    })
    $('#account_type').on('change', function() {
      var account_id = this.value;
      if(account_id!='')
      {
        $.ajax({
            url:"<?php echo url('accounting/chart_of_accounts/fetch_acc_detail') ?>",
            method: "POST",
            data: {account_id:account_id},
            success:function(data)
            {
                $("#detail_type").html(data);
            }
        })
      }
    });
       
    function showOptions(s) {
        var option_text = document.getElementById(s[s.selectedIndex].id).innerHTML;
        $('#name').val(option_text);
    }

    function check() {
      var x = document.getElementById("check_sub").checked;
      if(x == true)
      {
        $('#sub_account_type').removeAttr('disabled','disabled');
      }
      else
      {
        $('#sub_account_type').attr('disabled','disabled');
      }
    }

    function showdiv() {
        $('.hide-div').css('display','block');
        if($('#choose_time').find(":selected").text()=='Other')
        {
            $('.hide-div').css('display','none');
            $('.hide-date').css('display','block');
        }
        else
        {
            $('.hide-date').css('display','none');
        }
    }
    function showdiv2() {
        if($('.day').hasClass('active'))
        {
            $('.hide-div').css('display','block');
        }
        else
        {
            $('.hide-div').css('display','none');
        }
    }
</script>
<script type="text/javascript">
    function openPayee()
    {
        jQuery("#side-menu-payee-tx").show();
        jQuery("#side-menu-payee-tx").addClass("open-side-nav");
        jQuery("#side-menu-payee-tx").css("width","30%");
        jQuery("#side-menu-payee-tx").css("overflow-y","auto");
        jQuery("#side-menu-payee-tx").css("overflow-x","hidden");
        jQuery("#overlay-payee-tx").addClass("overlay");
    }
    function closePayee() 
    {
        jQuery("#side-menu-payee-tx").removeClass("open-side-nav");
        jQuery("#side-menu-payee-tx").css("width","0%");
        jQuery("#overlay-payee-tx").removeClass("overlay");
    }
</script>
<script type="text/javascript">
    function openVendor()
    {
        jQuery("#side-menu-vendor-tx").show();
        jQuery("#side-menu-vendor-tx").addClass("open-side-nav");
        jQuery("#side-menu-vendor-tx").css("width","60%");
        jQuery("#side-menu-vendor-tx").css("overflow-y","auto");
        jQuery("#side-menu-vendor-tx").css("overflow-x","hidden");
        jQuery("#overlay-vendor-tx").addClass("overlay");
    }
    function closeVendor() 
    {
        jQuery("#side-menu-vendor-tx").removeClass("open-side-nav");
        jQuery("#side-menu-vendor-tx").css("width","0%");
        jQuery("#overlay-vendor-tx").removeClass("overlay");
    }
    function openCustomer()
    {
        jQuery("#side-menu-customer-tx").show();
        jQuery("#side-menu-customer-tx").addClass("open-side-nav");
        jQuery("#side-menu-customer-tx").css("width","80%");
        jQuery("#side-menu-customer-tx").css("overflow-y","auto");
        jQuery("#side-menu-customer-tx").css("overflow-x","hidden");
        jQuery("#overlay-customer-tx").addClass("overlay");
    }
    function closeCustomer() 
    {
        jQuery("#side-menu-customer-tx").removeClass("open-side-nav");
        jQuery("#side-menu-customer-tx").css("width","0%");
        jQuery("#overlay-customer-tx").removeClass("overlay");
    }
    function openTerm()
    {
        jQuery("#side-menu-term-tx").show();
        jQuery("#side-menu-term-tx").addClass("open-side-nav");
        jQuery("#side-menu-term-tx").css("width","30%");
        jQuery("#side-menu-term-tx").css("overflow-y","auto");
        jQuery("#side-menu-term-tx").css("overflow-x","hidden");
        jQuery("#overlay-term-tx").addClass("overlay");
    }
    function closeTerm() 
    {
        jQuery("#side-menu-term-tx").removeClass("open-side-nav");
        jQuery("#side-menu-term-tx").css("width","0%");
        jQuery("#overlay-term-tx").removeClass("overlay");
    }
</script>
<script type="text/javascript">
    function opendetails()
    {
        if($('#paypop_type').val() == 'vendor')
        {
            openVendor();
        }
        else if($('#paypop_type').val() == 'customer')
        {
            openCustomer();
        }
        else
        {
            closeVendor();
            closeCustomer();
        }
    }
</script>
<script type="text/javascript">
    $('#ven_term').on('change', function (e) {
          if($('#ven_term').val() == 'fa fa-plus')
          {
           openTerm();
          } 
      });
    $('#ven_expenseacc').on('change', function (e) {
          if($('#ven_expenseacc').val() == 'fa fa-plus')
          {
           openAddAccount();
          } 
      });
</script>
<script type="text/javascript">
    function save_close_edit(id,chart_of_accounts_id)
    {
      var reconcile_id = id;
      var chart_of_accounts_id = chart_of_accounts_id;
      var mailing_address = $('#mailing_add').val();
      var date_popup = $('#date_popup').val();
      var checkno = $('#checkno').val();
      var memo_sc = $('#memo_sc').val();
      var descp_sc = $('.edit_descp').text();
      var expense_account=$('.edit_expense_account').text();
      //var service_charge=$('.edit_service_charge').text();
      var service_charge=$('#total').text().substr(9);

      var tablelength = $('#participantTable tr').length -2;
      datatab=[];

      for(var i = 2 ; i <= tablelength ; i++)
        {

            var expense_account_sub = $('.edit_expense_account_'+i).text();
            var service_charge_sub = $('.edit_service_charge_'+i).text();
            var descp_sc_sub = $('.edit_descp_'+i).text();

          if(expense_account_sub!='' || descp_sc_sub!='' || service_charge_sub!='')
          {
            if(service_charge_sub!='')
            {
                if($('#edit_expense_account_'+i).hasClass('up_row'))
                {
                    var id = $('#edit_expense_account_'+i).data('id');
                    $.ajax({
                        url:"<?php echo url('accounting/reconcile/change/servicecharge') ?>",
                        method: "POST",
                        data: {id:id,expense_account_sub:expense_account_sub,service_charge_sub:service_charge_sub,descp_sc_sub:descp_sc_sub},
                        success:function(data)
                        {
                        }
                    })
                }
                else
                {
                    $.ajax({
                        url:"<?php echo url('accounting/reconcile/add/servicecharge') ?>",
                        method: "POST",
                        data: {reconcile_id:reconcile_id,chart_of_accounts_id:chart_of_accounts_id,expense_account_sub:expense_account_sub,service_charge_sub:service_charge_sub,descp_sc_sub:descp_sc_sub},
                        success:function(data)
                        {
                        }
                    })
                }
            }
          }
        }

      if(reconcile_id!='')
      {
        $.ajax({
            url:"<?php echo url('accounting/reconcile/servicecharge/update_sc') ?>",
            method: "POST",
            data: {reconcile_id:reconcile_id,mailing_address:mailing_address,date_popup:date_popup,checkno:checkno,memo_sc:memo_sc,descp_sc:descp_sc,expense_account:expense_account,service_charge:service_charge},
            success:function(data)
            {
                closeFullNav();
                callschistory(reconcile_id,chart_of_accounts_id);
                var action = 'updated';
                callhistory(chart_of_accounts_id,action);
                location.href="<?php echo url('accounting/reconcile/') ?>"+chart_of_accounts_id;
            }
        })
      }
      
            /*datatab['edit_expense_account_'+i]=$('.edit_expense_account_'+i).text();
            datatab['edit_service_charge_'+i]=$('.edit_service_charge_'+i).text();
            datatab['edit_descp_'+i]=$('.edit_descp_'+i).text();*/

      /*  var data_tab=Object.assign({}, datatab); 
      if(reconcile_id!='')
      {
        $.ajax({
            url:"<?php echo url('accounting/reconcile/add/servicecharge') ?>",
            method: "POST",
            data: {reconcile_id:reconcile_id,chart_of_accounts_id:chart_of_accounts_id,data_tab:JSON.stringify(data_tab)},
            success:function(data)
            {
            }
        })
      }*/
    }
    function remove_func(id)
    {
        var id = id;
      var reconcile_id = $('#XYZ_id').text();
      var mailing_address = $('#mailing_add').val();
      var date_popup = $('#date_popup').val();
      var checkno = $('#checkno').val();
      var memo_sc = $('#memo_sc').val();
      var descp_sc = $('.edit_descp').text();
      var expense_account=$('.edit_expense_account').text();
      var service_charge=$('#total').text().substr(9);
        if(id!='')
        {
            $.ajax({
                    url:"<?php echo url('accounting/reconcile/servicecharge/remove_sc') ?>",
                    method: "POST",
                    data: {id:id},
                    success:function(data)
                    {
                        if(reconcile_id!='')
                          {
                            $.ajax({
                                url:"<?php echo url('accounting/reconcile/servicecharge/update_sc') ?>",
                                method: "POST",
                                data: {reconcile_id:reconcile_id,mailing_address:mailing_address,date_popup:date_popup,checkno:checkno,memo_sc:memo_sc,descp_sc:descp_sc,expense_account:expense_account,service_charge:service_charge},
                                success:function(data)
                                {
                                    sweetAlert(
                                            'Deleted!',
                                            'Item has been deleted.',
                                            'success'
                                        );
                                }
                            })
                          }
                    }
                })
        }
        var chart_of_accounts_id = $('#chart_of_accounts_id').text();
      callschistory(id,chart_of_accounts_id);
      var action = 'deleted';
      callhistory(chart_of_accounts_id,action);
    }
</script>
<script type="text/javascript">
    function save_close_edit_int(id,chart_of_accounts_id)
    {
      var reconcile_id = id;
      var chart_of_accounts_id = chart_of_accounts_id;
      var date_popup = $('#int_date_popup').val();
      var memo_it = $('#memo_it').val();
      var cash_back_amount = $('#cash_back_amount').val();
      var cash_back_account='';
      var cash_back_memo='';
      if(cash_back_amount!='')
      {  
       cash_back_account = $('#int_cashback_popup').val();
       cash_back_memo = $('#cash_back_memo').val();
      }
      var descp_it = $('.edit_descp_it').text();
      var income_account=$('.edit_income_account').text();
      //var interest_earned=$('#inttotal_final').text().substr(9);
      var interest_earned=$('.edit_interest_earned').text();

      var tablelength = $('#participantIntTable tr').length -2;

      for(var i = 2 ; i <= tablelength ; i++)
        {

            var income_account_sub = $('.edit_income_account_'+i).text();
            var interest_earned_sub = $('.edit_interest_earned_'+i).text();
            var descp_it_sub = $('.edit_descp_it_'+i).text();

          if(income_account_sub!='' || descp_it_sub!='' || interest_earned_sub!='')
          {
            if(interest_earned_sub!='')
            {
                if($('#edit_income_account_'+i).hasClass('up_row'))
                {
                    var id = $('#edit_income_account_'+i).data('id');
                    $.ajax({
                        url:"<?php echo url('accounting/reconcile/change/interestearned') ?>",
                        method: "POST",
                        data: {id:id,income_account_sub:income_account_sub,interest_earned_sub:interest_earned_sub,descp_it_sub:descp_it_sub},
                        success:function(data)
                        {
                        }
                    })
                }
                else
                {
                    $.ajax({
                        url:"<?php echo url('accounting/reconcile/add/interestearned') ?>",
                        method: "POST",
                        data: {reconcile_id:reconcile_id,chart_of_accounts_id:chart_of_accounts_id,income_account_sub:income_account_sub,interest_earned_sub:interest_earned_sub,descp_it_sub:descp_it_sub},
                        success:function(data)
                        {
                        }
                    })
                }
            }
          }
        }
        
      if(reconcile_id!='')
      {
        $.ajax({
            url:"<?php echo url('accounting/reconcile/interestearned/update_it') ?>",
            method: "POST",
            data: {reconcile_id:reconcile_id,date_popup:date_popup,memo_it:memo_it,descp_it:descp_it,income_account:income_account,interest_earned:interest_earned,cash_back_account:cash_back_account,cash_back_memo:cash_back_memo,cash_back_amount:cash_back_amount},
            success:function(data)
            {
                closeFullNav_int();
                location.href="<?php echo url('accounting/reconcile/') ?>"+chart_of_accounts_id;
                callithistory(reconcile_id,chart_of_accounts_id);
                var action = 'updated';
                callhistory(chart_of_accounts_id,action);
            }
        })
      }

    }
    function remove_func_int(id)
    {
        var id = id;
      var reconcile_id = $('#XYZ_id').text();
      var date_popup = $('#int_date_popup').val();
      var memo_it = $('#memo_it').val();
      var descp_it = $('.edit_descp_it').text();
      var income_account=$('.edit_income_account').text();
      var interest_earned=$('#inttotal_final').text().substr(9);
      var cash_back_amount = $('#cash_back_amount').val();
      var cash_back_account='';
      var cash_back_memo='';
      if(cash_back_amount!='')
      {  
       cash_back_account = $('#int_cashback_popup').val();
       cash_back_memo = $('#cash_back_memo').val();
      }
        if(id!='')
        {
            $.ajax({
                    url:"<?php echo url('accounting/reconcile/interestearned/remove_it') ?>",
                    method: "POST",
                    data: {id:id},
                    success:function(data)
                    {
                        if(reconcile_id!='')
                          {
                            $.ajax({
                                url:"<?php echo url('accounting/reconcile/interestearned/update_it') ?>",
                                method: "POST",
                                data: {reconcile_id:reconcile_id,date_popup:date_popup,memo_it:memo_it,descp_it:descp_it,income_account:income_account,interest_earned:interest_earned,cash_back_account:cash_back_account,cash_back_memo:cash_back_memo,cash_back_amount:cash_back_amount},
                                success:function(data)
                                {
                                    sweetAlert(
                                            'Deleted!',
                                            'Item has been deleted.',
                                            'success'
                                        );
                                }
                            })
                          }
                    }
                })
        }
        var chart_of_accounts_id = $("#chart_of_accounts_id").text();
        callithistory(reconcile_id,chart_of_accounts_id);
        var action = 'deleted';
      callhistory(chart_of_accounts_id,action);
    }
</script>
<script type="text/javascript">
    function save_recurr(id,chart_of_accounts_id)
    {
      var reconcile_id = id;
      var chart_of_accounts_id = chart_of_accounts_id;
      var mailing_address = $('#recurr_mailing_add').val();
      var date_popup = $('#recurr_date_popup').val();
      var checkno = $('#recurr_checkno').val();
      var memo_sc = $('#recurr_memo_sc').val();
      var descp_sc = $('.recurr_descp').text();
      var expense_account=$('.recurr_expense_account').text();
      //var service_charge=$('.recurr_service_charge').text();
      var service_charge=$('#recurrtotal').text().substr(9);

      var tablelength = $('#participantRecurrTable tr').length -2;

      

      var template_name = $('#template_name').val();
      var template_type = $('#type_scheduled').val();
      var template_interval = $('#interval').val();
      var advanced_day='';
      if($('#create_days').val()!='')
      { advanced_day = $('#create_days').val();}
      if($('#remine_days').val()!='')
      { advanced_day = $('#remine_days').val();}

      var day =$('#daily_days').val();
      var dayname =$('#monthlymain_option').val();

      var daynum='';
      if($('#monthlyday_option').val()!='')
      {var daynum =$('#monthlyday_option').val();}
      if($('#yearlyday_option').val()!='')
      {var daynum =$('#yearlyday_option').val();}

      var weekday =$('#daily_weeks').val();

      var weekname='';
      if($('#weekly_option').val()!='')
      {var weekname =$('#weekly_option').val();}
      if($('#monthlyweek_option').val()!='')
      {var weekname =$('#weekly_option').val();}

      var monthday =$('#monthly_days').val();
      var monthname =$('yearlymonth_option').val();

      var startdate =$('#recurr_start_date').val();
      var endtype =$('#recurr_select').val();
      var enddate =$('#recurr_end_date').val();
      var occurrence =$('#recurr_after_occurrences').val();
      var payeename =$('#recurr_payee_popup').val();
      var account_type =$('#recurr_account_popup').val();
      var payment_date =$('#recurr_date_popup').val();
      var mailing_address =$('#recurr_mailing_add').val();
      var checkno =$('#recurr_checkno').val();
      var permitno =$('#recurr_permitno').val();
      var memo_recurr_sc =$('#recurr_memo_sc').val();

      if(template_name!='')
      {
        $.ajax({
            url:"<?php echo url('accounting/reconcile/recurr/save') ?>",
            method: "POST",
            data: {reconcile_id:reconcile_id,chart_of_accounts_id:chart_of_accounts_id,template_name:template_name,template_type:template_type,template_interval:template_interval,advanced_day:advanced_day,day:day,dayname:dayname,daynum:daynum,weekday:weekday,weekname:weekname,monthday:monthday,monthname:monthname,startdate:startdate,endtype:endtype,enddate:enddate,occurrence:occurrence,payeename:payeename,account_type:account_type,payment_date:payment_date,mailing_address:mailing_address,checkno:checkno,permitno:permitno,memo_recurr_sc:memo_recurr_sc},
            success:function(data)
            {
                var mainid = data;
                for(var i = 2 ; i <= tablelength ; i++)
                {

                    var expense_account_sub = $('.recurr_expense_account_'+i).text();
                    var service_charge_sub = $('.recurr_service_charge_'+i).text();
                    var descp_sc_sub = $('.recurr_descp_'+i).text();

                  if(expense_account_sub!='' || descp_sc_sub!='' || service_charge_sub!='')
                  {
                    if(service_charge_sub!='')
                    {
                        if($('#recurr_expense_account_'+i).hasClass('up_row'))
                        {
                            var id = $('#recurr_expense_account_'+i).data('id');
                            $.ajax({
                                url:"<?php echo url('accounting/reconcile/changerecurr/servicecharge') ?>",
                                method: "POST",
                                data: {id:id,expense_account_sub:expense_account_sub,service_charge_sub:service_charge_sub,descp_sc_sub:descp_sc_sub},
                                success:function(data)
                                {
                                }
                            })
                        }
                        else
                        {
                            $.ajax({
                                url:"<?php echo url('accounting/reconcile/addrecurr/servicecharge') ?>",
                                method: "POST",
                                data: {mainid:mainid,reconcile_id:reconcile_id,chart_of_accounts_id:chart_of_accounts_id,expense_account_sub:expense_account_sub,service_charge_sub:service_charge_sub,descp_sc_sub:descp_sc_sub},
                                success:function(data)
                                {
                                }
                            })
                        }
                    }
                  }
                }
                sweetAlert(
                                            'Saved!',
                                            'Recurring has been saved.',
                                            'success'
                                        );
                closeRecurr();
            }
        })
      }
    }
    function remove_func_recurr(id)
    {
        var id = id;
      var reconcile_id = $('#XYZ_id').text();
      var mailing_address = $('#recurr_mailing_add').val();
      var date_popup = $('#recurr_date_popup').val();
      var checkno = $('#recurr_checkno').val();
      var memo_sc = $('#recurr_memo_sc').val();
      var descp_sc = $('.recurr_descp').text();
      var expense_account=$('.recurr_expense_account').text();
      var service_charge=$('#recurrtotal').text().substr(9);
        if(id!='')
        {
            $.ajax({
                    url:"<?php echo url('accounting/reconcile/servicecharge/remove_sc_recurr') ?>",
                    method: "POST",
                    data: {id:id},
                    success:function(data)
                    {
                        sweetAlert(
                                            'Deleted!',
                                            'Item has been deleted.',
                                            'success'
                                        );
                    }
                })
        }

    }
</script>
<script type="text/javascript">
    function save_check(id,chart_of_accounts_id)
    {
      var reconcile_id = id;
      var chart_of_accounts_id = chart_of_accounts_id;
      var check_payee_popup = $('#check_payee_popup').val();
      var check_account_popup = $('#check_account_popup').val();
      var mailing_address = $('#check_mailing_add').val();
      var date_popup = $('#check_date_popup').val();
      var checkno = $('#check_checkno').val();
      var permitno = $('#check_permitno').val();
      var memo_sc = $('#check_memo_sc').val();
      var descp_sc = $('.check_descp').text();
      var expense_account=$('.check_expense_account').text();
      //var service_charge=$('.check_service_charge').text();
      var service_charge=$('#checktotal').text().substr(9);

      var tablelength = $('#participantCheckTable tr').length -2;

      $.ajax({
            url:"<?php echo url('accounting/reconcile/check/save') ?>",
            method: "POST",
            data: {reconcile_id:reconcile_id,chart_of_accounts_id:chart_of_accounts_id,check_payee_popup:check_payee_popup,check_account_popup:check_account_popup,mailing_address:mailing_address,date_popup:date_popup,checkno:checkno,permitno:permitno,memo_sc:memo_sc},
            success:function(data)
            {
                var mainid = data;
                for(var i = 2 ; i <= tablelength ; i++)
                {

                    var expense_account_sub = $('.check_expense_account_'+i).text();
                    var service_charge_sub = $('.check_service_charge_'+i).text();
                    var descp_sc_sub = $('.check_descp_'+i).text();

                  if(expense_account_sub!='' || descp_sc_sub!='' || service_charge_sub!='')
                  {
                    if(service_charge_sub!='')
                    {
                        
                        $.ajax({
                            url:"<?php echo url('accounting/reconcile/addcheck/servicecharge') ?>",
                            method: "POST",
                            data: {mainid:mainid,reconcile_id:reconcile_id,chart_of_accounts_id:chart_of_accounts_id,expense_account_sub:expense_account_sub,service_charge_sub:service_charge_sub,descp_sc_sub:descp_sc_sub},
                            success:function(data)
                            {
                            }
                        })
                    }
                  }
                }
                sweetAlert(
                                'Saved!',
                                'New check has been saved.',
                                'success'
                            );
                closeCheck();
            }
        })
        
    }
    function remove_func_check(id)
    {
        var id = id;
        if(id!='')
        {
            $.ajax({
                    url:"<?php echo url('accounting/reconcile/servicecharge/remove_sc_check') ?>",
                    method: "POST",
                    data: {id:id},
                    success:function(data)
                    {
                        sweetAlert(
                                            'Deleted!',
                                            'Item has been deleted.',
                                            'success'
                                        );
                    }
                })
        }

    }
</script>
<!-- save recurr int start -->
<script type="text/javascript">
    function save_recurr_int(id,chart_of_accounts_id)
    {
      var reconcile_id = id;
      var chart_of_accounts_id = chart_of_accounts_id;
      var memo_it = $('#recurr_memo_it').val();
      var descp_it = $('.recurr_descp_it').text();
      var income_account=$('.recurr_income_account').text();
      //var service_charge=$('.recurr_service_charge').text();
      var interest_earned=$('#intrecurrtotal').text().substr(9);

      var tablelength = $('#participantRecurrIntTable tr').length -2;

      

      var template_name_int = $('#template_name_int').val();
      var template_type_int = $('#type_scheduled_int').val();
      var template_interval_int = $('#interval_int').val();
      var advanced_day_int='';
      if($('#create_days_int').val()!='')
      { advanced_day_int = $('#create_days_int').val();}
      if($('#remine_days').val()!='')
      { advanced_day_int = $('#remine_days_int').val();}

      var day_int =$('#daily_days_int').val();
      var dayname_int =$('#monthlymain_option_int').val();

      var daynum_int='';
      if($('#monthlyday_option_int').val()!='')
      {var daynum_int =$('#monthlyday_option_int').val();}
      if($('#yearlyday_option').val()!='')
      {var daynum_int =$('#yearlyday_option_int').val();}

      var weekday_int =$('#daily_weeks_int').val();

      var weekname_int='';
      if($('#weekly_option_int').val()!='')
      {var weekname_int =$('#weekly_option_int').val();}
      if($('#monthlyweek_option').val()!='')
      {var weekname_int =$('#weekly_option_int').val();}

      var monthday_int =$('#monthly_days_int').val();
      var monthname_int =$('yearlymonth_option_int').val();

      var startdate_int =$('#recurr_start_date_int').val();
      var endtype_int =$('#recurr_select_int').val();
      var enddate_int =$('#recurr_end_date_int').val();
      var occurrence_int =$('#recurr_after_occurrences_int').val();
      var account_type_int =$('#recurr_account_popup_int').val();
      var memo_recurr_it =$('#recurr_memo_it').val();
      var cash_back_account_recurr = $('#cashback_popup_recurr').val();
      var cash_back_amount_recurr = $('#cash_back_amount_recurr').val();
      var cash_back_memo_recurr = $('#cash_back_memo_recurr').val();

      if(template_name_int!='')
      {
        $.ajax({
            url:"<?php echo url('accounting/reconcile/recurrint/save') ?>",
            method: "POST",
            data: {reconcile_id:reconcile_id,chart_of_accounts_id:chart_of_accounts_id,template_name_int:template_name_int,template_type_int:template_type_int,template_interval_int:template_interval_int,advanced_day_int:advanced_day_int,day_int:day_int,dayname_int:dayname_int,daynum_int:daynum_int,weekday_int:weekday_int,weekname_int:weekname_int,monthday_int:monthday_int,monthname_int:monthname_int,startdate_int:startdate_int,endtype_int:endtype_int,enddate_int:enddate_int,occurrence_int:occurrence_int,account_type_int:account_type_int,memo_recurr_it:memo_recurr_it,cash_back_account_recurr:cash_back_account_recurr,cash_back_amount_recurr:cash_back_amount_recurr,cash_back_memo_recurr:cash_back_memo_recurr},
            success:function(data)
            {
                var mainid = data;
                for(var i = 2 ; i <= tablelength ; i++)
                {

                    var income_account_sub = $('.recurr_income_account_'+i).text();
                    var interest_earned_sub = $('.recurr_interest_earned_'+i).text();
                    var descp_it_sub = $('.recurr_descp_it_'+i).text();

                  if(income_account_sub!='' || descp_it_sub!='' || interest_earned_sub!='')
                  {
                    if(interest_earned_sub!='')
                    {
                        if($('#recurr_income_account_'+i).hasClass('up_row'))
                        {
                            var id = $('#recurr_income_account_'+i).data('id');
                            $.ajax({
                                url:"<?php echo url('accounting/reconcile/changerecurr/interestearned') ?>",
                                method: "POST",
                                data: {id:id,income_account_sub:income_account_sub,interest_earned_sub:interest_earned_sub,descp_it_sub:descp_it_sub},
                                success:function(data)
                                {
                                }
                            })
                        }
                        else
                        {
                            $.ajax({
                                url:"<?php echo url('accounting/reconcile/addrecurr/interestearned') ?>",
                                method: "POST",
                                data: {mainid:mainid,reconcile_id:reconcile_id,chart_of_accounts_id:chart_of_accounts_id,income_account_sub:income_account_sub,interest_earned_sub:interest_earned_sub,descp_it_sub:descp_it_sub},
                                success:function(data)
                                {
                                }
                            })
                        }
                    }
                  }
                }
                sweetAlert(
                                            'Saved!',
                                            'Recurring has been saved.',
                                            'success'
                                        );
                closeRecurrInt();
            }
        })
      }
    }
</script>
<!-- save recurr int end -->
<script type="text/javascript">
    $( document ).ready(function() {
       var main = $(".edit_service_charge").text();
       if(main!=0)
       {
        var maintot = main - $("#servicechargecount").val();
        $(".edit_service_charge").text(maintot.toFixed(2));
        $("#edit_service_charge").val(maintot.toFixed(2));
       }
       else{var maintot=$("#servicechargecount").val();}
       if(main==0)
       {
        $('#total').text('Total : $'+$("#servicechargecount").val());
        $('#amount').text('Amount : $'+$("#servicechargecount").val());
       }
       

       var main_int = $(".edit_interest_earned").text();
       var maintot_int = parseInt(main_int) + parseInt($("#interestearnedcount").val());
       $("#inttotal").text("Other Fund Total : $"+maintot_int.toFixed(2));
       if($('#cash_back_amount').val()!='')
       {
        maintot_int = maintot_int - $('#cash_back_amount').val();
       }
       $("#inttotal_final").text("Total : $"+maintot_int.toFixed(2));

       var main_int_recurr = $(".recurr_interest_earned").text();

       var maintot_int_recurr = parseInt(main_int_recurr) + parseInt($("#recurrinterestearnedcount_int").val());
       $("#intrecurrtotal").text("Other Fund Total : $"+maintot_int_recurr.toFixed(2));
       if($('#cash_back_amount_recurr').val()!='')
       {
        maintot_int_recurr = maintot_int_recurr - $('#cash_back_amount_recurr').val();
       }
       $("#intrecurrtotal_final").text("Total : $"+maintot_int_recurr.toFixed(2));
    });
</script>
<script type="text/javascript">
    function show_preview(id)
    {
        var image=$('#previewid_'+id).data('image');
        $("#previewImage").attr('src','<?php echo base_url()?>uploads/'+image);
        openPreview();
    }
    function openPreview() {
     
    jQuery("#side-menu-preview-tx").addClass("open-side-nav");
    jQuery("#side-menu-preview-tx").css("width","100%");
    jQuery("#side-menu-preview-tx").css("overflow-y","auto");
    jQuery("#side-menu-preview-tx").css("overflow-x","hidden");
    jQuery("#overlay-preview-tx").addClass("overlay");
    }

    function closePreview() {
       
        jQuery("#side-menu-preview-tx").removeClass("open-side-nav");
        jQuery("#side-menu-preview-tx").css("width","0%");
        jQuery("#overlay-preview-tx").removeClass("overlay");
    }

    $( ".uploadmy" ).submit(function(e) {
        e.preventDefault();
        this.submit();
        setTimeout(function () { 
                    sweetAlert(
                            'Uploaded!',
                            'File has been uploaded.',
                            'success'
                        );
                    showData();
                }, 100); 
    });
</script>
<script type="text/javascript">
    window.print_this = function(id) {
        if(id== 'to_print_both')
        {
            $('#to_print_summary').show();
        }
    var prtContent = document.getElementById(id);
    var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
    
    //WinPrint.document.write('<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">');
    
    // To keep styling
    /*var file = WinPrint.document.createElement("link");
    file.setAttribute("rel", "stylesheet");
    file.setAttribute("type", "text/css");
    file.setAttribute("href", 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css');
    WinPrint.document.head.appendChild(file);*/

    
    WinPrint.document.write(prtContent.innerHTML);
    WinPrint.document.close();
    WinPrint.print();
    $('#to_print_summary').hide();
}
</script>
<script type="text/javascript">
    function update_print()
    {

        $('#getsubtotal_print').text('Deposit Subtotal: $'+$('#inttotal').text().substr(20));
        $('#getdeduct_print').text('Less Cash back: $'+$('#cash_back_amount').val());
        $('#gettotal_print').text('Deposit total: $'+$('#inttotal_final').text().substr(9));
        $('#getsubtotal_print_both').text($('#inttotal').text().substr(20));
        $('#getdeduct_print_both').text($('#cash_back_amount').val());
        $('#gettotal_print_both').text($('#inttotal_final').text().substr(9));
        
        length =$('#participantIntTable tr').length -2;
        for(var i = 2 ; i <= length ; i++)
        {
            $('.print_income_account_'+i).text($('#edit_income_account_'+i).val());
            $('.print_interest_earned_'+i).text($('#edit_interest_earned_'+i).val());
            $('.print_descp_it_'+i).text($('#edit_descp_it_'+i).val());
        }
    }
</script>
<script type="text/javascript">
    $( document ).ready(function() {
        update_print();
    });
</script>
<!-- recurr int start-->
<script type="text/javascript">
    /* Variables */
    var p = 1;
    var row_recurr_int = $(".participantRecurrIntRow");

    function addRowRecurrInt() {
      row_recurr_int.clone(true, true).removeClass('RecurrhideInt table-line').appendTo("#participantRecurrIntTable");
      var index_recurr_int =$('#participantRecurrIntTable tr').length -1;
      var final_index_recurr_int = index_recurr_int-1;
      $('#participantRecurrIntTable tr:eq('+index_recurr_int+')').attr("onclick","trClickRecurr_Int("+final_index_recurr_int+")");
      $('#participantRecurrIntTable tr:eq('+index_recurr_int+') td:eq(1)').text(index_recurr_int-1);
      $('#participantRecurrIntTable tr:eq('+index_recurr_int+') td:eq(2)').find('select').attr("id","recurr_income_account_"+final_index_recurr_int);
      $('#participantRecurrIntTable tr:eq('+index_recurr_int+') td:eq(2)').find('select').attr("name","recurr_income_account_"+final_index_recurr_int);
      $('#participantRecurrIntTable tr:eq('+index_recurr_int+') td:eq(2)').find('div').attr("class","recurr_income_account_"+final_index_recurr_int);
      $('#participantRecurrIntTable tr:eq('+index_recurr_int+') td:eq(3)').find('input').attr("id","recurr_descp_it_"+final_index_recurr_int);
      $('#participantRecurrIntTable tr:eq('+index_recurr_int+') td:eq(3)').find('input').attr("name","recurr_descp_it_"+final_index_recurr_int);
      $('#participantRecurrIntTable tr:eq('+index_recurr_int+') td:eq(3)').find('div').attr("class","recurr_descp_it_"+final_index_recurr_int);
      $('#participantRecurrIntTable tr:eq('+index_recurr_int+') td:eq(4)').find('input').attr("id","recurr_interest_earned_"+final_index_recurr_int);
      $('#participantRecurrIntTable tr:eq('+index_recurr_int+') td:eq(4)').find('input').attr("name","recurr_interest_earned_"+final_index_recurr_int);
      $('#participantRecurrIntTable tr:eq('+index_recurr_int+') td:eq(4)').find('div').attr("class","recurr_interest_earned_"+final_index_recurr_int);
    }

    function removeRowRecurrInt(buttonrecurrint) {
        console.log(buttonrecurrint.closest("tr").text());
      buttonrecurrint.closest("tr").remove();
      //var totrecurrint = $('#intrecurrtotal').text().substr(9)-buttonrecurrint.closest("tr").find('td:eq(4)').text().trim();
      var totrecurrint_final = $('#inttotal').text().substr(20);
      var totrecurrint = $('#intrecurrtotal').text().substr(9);
      $('#intrecurrtotal').text('Other Fund Total : $'+totrecurrint.toFixed(2));
      $('#intrecurrtotal_final').text('Total : $'+totrecurrint_final.toFixed(2));
      if(buttonrecurrint.closest("tr").find('td:eq(2)').find('select').hasClass("up_row"))
        {
            var id_to_remove =buttonrecurrint.closest("tr").find('td:eq(0)').attr("data-id");
            remove_func_recurr_int(id_to_remove);
        }
    }
    /* Doc ready */
    $(".add_recurr_int").on('click', function () {
      getP();
      if($("#participantRecurrIntTable tr").length < 17) {
        addRowRecurrInt();
        var i = Number(p)+1;
        $("#participants").val(i);
      }
      $(this).closest("tr").appendTo("#participantRecurrIntTable");
      if ($("#participantRecurrIntTable tr").length === 3) {
        $(".remove_recurr_int").hide();
      } else {
        $(".remove_recurr_int").show();
      }
    });
    $(".remove_recurr_int").on('click', function () {
      getP();
      if($("#participantRecurrIntTable tr").length === 3) {
        //alert("Can't remove row.");
        $(".remove_recurr_int").hide();
      } else if($("#participantRecurrIntTable tr").length - 1 ==3) {
        $(".remove_recurr_int").hide();
        removeRowRecurrInt($(this));
        var i = Number(p)-1;
        $("#participants").val(i);
      } else {
        removeRowRecurrInt($(this));
        var i = Number(p)-1;
        $("#participants").val(i);
      }
    });
    $("#participants").change(function () {
      var i = 0;
      p = $("#participants").val();
      var rowCount = $("#participantRecurrIntTable tr").length - 2;
      if(p > rowCount) {
        for(i=rowCount; i<p; i+=1){
          addRowRecurrInt();
        }
        $("#participantRecurrIntTable #addButtonRow").appendTo("#participantRecurrIntTable");
      } else if(p < rowCount) {
      }
    });
    $(".clear_recurr_int").on('click', function () {
      if($("#participantRecurrIntTable tr").length - 1 >3) {
        x = 1;
        $('#participantRecurrIntTable > tbody  > tr').each(function() {
            if(x >3)
            {
                $(this).remove();
                var totrecurr_clear_int = $('#intrecurrtotal').text().substr(9)-$(this).closest("tr").find('td:eq(4)').text().trim();
                $('#intrecurrtotal').text('Other Fund Total : $'+totrecurr_clear_int.toFixed(2));
                $('#intrecurrtotal_final').text('Total : $'+totint_clear.toFixed(2));
            }
            x = x+1;
        });
      }
    });
</script>
<script type="text/javascript">
    function trClickRecurrMain_Int()
    {
        if($('#recurr_income_account').css("display")== 'none')
        {
            $('.recurr_income_account').css('display','none');
            $('#recurr_income_account').show();
            $('.hidemerecurr_int').show();
        }
        if($('#recurr_interest_earned').attr("type")== 'hidden')
        {
            $('.recurr_interest_earned').css('display','none');
            $('#recurr_interest_earned').removeAttr('type','hidden');
            $('#recurr_interest_earned').attr('type','number');
            $('.hidemerecurr_int').show();
        }
        if($('#recurr_descp_it').attr("type")== 'hidden')
        {
            $('.recurr_descp_it').css('display','none');
            $('#recurr_descp_it').removeAttr('type','hidden');
            $('.hidemerecurr_int').show();
        }
    }

    function trClickRecurr_Int(index_recurr_int)
    {
        if($('#recurr_income_account_'+index_recurr_int).css("display")== 'none')
        {
            $('.recurr_income_account_'+index_recurr_int).css('display','none');
            $('#recurr_income_account_'+index_recurr_int).show();
            $('.hidemerecurr_int').show();
        }
        if($('#recurr_interest_earned_'+index_recurr_int).attr("type")== 'hidden')
        {
            $('.recurr_interest_earned_'+index_recurr_int).css('display','none');
            $('#recurr_interest_earned_'+index_recurr_int).removeAttr('type','hidden');
            $('#recurr_interest_earned_'+index_recurr_int).attr('type','number');
            $('.hidemerecurr_int').show();
        }
        if($('#recurr_descp_it_'+index_recurr_int).attr("type")== 'hidden')
        {
            $('.recurr_descp_it_'+index_recurr_int).css('display','none');
            $('#recurr_descp_it_'+index_recurr_int).removeAttr('type','hidden');
            $('.hidemerecurr_int').show();
        }
    }
    function rightclickRecurr_Int()
    {
        length_recurr_int =$('#participantRecurrIntTable tr').length -2;
        $('.recurr_income_account').show();
        $('.recurr_income_account').text($('#recurr_income_account').val());
        $('#recurr_income_account').css('display','none');
        $('.recurr_interest_earned').show();
        $('.recurr_interest_earned').text($('#recurr_interest_earned').val());
        $('#recurr_interest_earned').attr('type','hidden');
        $('.recurr_descp_it').show();
        $('.recurr_descp_it').text($('#recurr_descp_it').val());
        $('#recurr_descp_it').attr('type','hidden');
        $('.hidemerecurr_int').hide();

        for(var i = 2 ; i <= length_recurr_int ; i++)
        {
            $('.recurr_income_account_'+i).show();
            $('.recurr_income_account_'+i).text($('#recurr_income_account_'+i).val());
            $('#recurr_income_account_'+i).css('display','none');
            $('.recurr_interest_earned_'+i).show();
            $('.recurr_interest_earned_'+i).text($('#recurr_interest_earned_'+i).val());
            $('#recurr_interest_earned_'+i).attr('type','hidden');
            $('.recurr_descp_it_'+i).show();
            $('.recurr_descp_it_'+i).text($('#recurr_descp_it_'+i).val());
            $('#recurr_descp_it_'+i).attr('type','hidden');
        }

        var total_recurr_int = 0;
        total_recurr_int += parseInt($('.recurr_interest_earned').text());
        for(var i = 2 ; i <= length_recurr_int ; i++)
        {
            if($('.recurr_interest_earned_'+i).text() != '')
            {total_recurr_int += parseInt($('.recurr_interest_earned_'+i).text());}
        }
        $('#intrecurrtotal').text('Other Fund Total : $'+total_recurr_int.toFixed(2));
        if($('#cash_back_amount_recurr').val()!='')
        {
            var sub = parseInt($('#cash_back_amount_recurr').val());
            var total_recurr_int = total_recurr_int - sub;
        }
        $('#intrecurrtotal_final').text('Total : $'+total_recurr_int.toFixed(2));
    }
    function crossClickRecurr_Int()
    {
        length_recurr_int =$('#participantRecurrIntTable tr').length -2;
        $('.recurr_income_account').show();
        $('#recurr_income_account').css('display','none');
        $('.recurr_interest_earned').show();
        $('#recurr_interest_earned').attr('type','hidden');
        $('.recurr_descp_it').show();
        $('#recurr_descp_it').attr('type','hidden');
        $('.hidemerecurr_int').hide();
        for(var i = 2 ; i <= length_recurr_int ; i++)
        {
            $('.recurr_income_account_'+i).show();
            $('#recurr_income_account_'+i).css('display','none');
            $('.recurr_interest_earned_'+i).show();
            $('#recurr_interest_earned_'+i).attr('type','hidden');
            $('.recurr_descp_it_'+i).show();
            $('#recurr_descp_it_'+i).attr('type','hidden');
        }
    }
    $("#cash_back_amount_recurr").focus(function(){
        $('.hidemefinal_int').show();
    });
    function rightclickRecurr_int_final()
    {
        $('.hidemefinal_int').hide();

        var totalfinal_recurr = parseInt($('#intrecurrtotal').text().substr(20));
        var sub_recurr = parseInt($('#cash_back_amount_recurr').val());
        if($('#cash_back_amount_recurr').val()!='')
        {var ftotal_recurr = totalfinal_recurr - sub_recurr;}
        else
        {var ftotal_recurr = totalfinalrecurr - 0;}
        $('#intrecurrtotal_final').text('Total : $'+ftotal_recurr.toFixed(2));
    }
    function crossClickRecurr_int_final()
    {
       // $('#cash_back_amount_recurr').val('');
        $('.hidemefinal_int').hide();
    }
</script>
<script type="text/javascript">
    function DeleteInt(id,chart_of_accounts_id)
    {
        if(id!='')
        {
            $.ajax({
                    url:"<?php echo url('accounting/reconcile/delete/delete_int') ?>",
                    method: "POST",
                    data: {id:id},
                    success:function(data)
                    {
                        sweetAlert(
                                            'Deleted!',
                                            'Interest has been deleted.',
                                            'success'
                                        );
                        closeFullNav_int();
                        callithistory(reconcile_id,chart_of_accounts_id);
                        var action = 'deleted';
                        callhistory(chart_of_accounts_id,action);
                        location.href="<?php echo url('accounting/reconcile/') ?>"+chart_of_accounts_id;
                    }
                });
        }
         
         
    }
    function Delete(id,chart_of_accounts_id)
    {
        if(id!='')
        {
            $.ajax({
                    url:"<?php echo url('accounting/reconcile/delete/delete_sc') ?>",
                    method: "POST",
                    data: {id:id},
                    success:function(data)
                    {
                        sweetAlert(
                                            'Deleted!',
                                            'Service has been deleted.',
                                            'success'
                                        );
                        closeFullNav();
                        callschistory(reconcile_id,chart_of_accounts_id);
                        var action = 'updated';
                        callhistory(chart_of_accounts_id,action);
                        location.href="<?php echo url('accounting/reconcile/') ?>"+chart_of_accounts_id;
                    }
                });
        }
    }
</script>
<!-- recurr int end-->

<!-- history -->
<script type="text/javascript">
    function callschistory(id,chart_of_accounts_id)
    {
        var reconcile_id =id;
        var chart_of_accounts_id = chart_of_accounts_id;
        var tablelength = $('#participantTable tr').length -2;
        for(var i = 2 ; i <= tablelength ; i++)
        {

                var expense_account_sub = $('.edit_expense_account_'+i).text();
                var service_charge_sub = $('.edit_service_charge_'+i).text();
                var descp_sc_sub = $('.edit_descp_'+i).text();

              if(expense_account_sub!='' || descp_sc_sub!='' || service_charge_sub!='')
              {
                if(service_charge_sub!='')
                {
                    
                        $.ajax({
                            url:"<?php echo url('accounting/reconcile/add/servicecharge/history') ?>",
                            method: "POST",
                            data: {reconcile_id:reconcile_id,chart_of_accounts_id:chart_of_accounts_id,expense_account_sub:expense_account_sub,service_charge_sub:service_charge_sub,descp_sc_sub:descp_sc_sub},
                            success:function(data)
                            {
                            }
                        })
                }
              }
            }
    }
    function callithistory(id,chart_of_accounts_id)
    {
        var reconcile_id =id;
        var chart_of_accounts_id = chart_of_accounts_id;
        var tablelength = $('#participantTable tr').length -2;
        for(var i = 2 ; i <= tablelength ; i++)
        {

                var income_account_sub = $('.edit_income_account_'+i).text();
                var interest_earned_sub = $('.edit_interest_earned_'+i).text();
                var descp_it_sub = $('.edit_descp_it_'+i).text();

              if(income_account_sub!='' || descp_it_sub!='' || interest_earned_sub!='')
              {
                if(interest_earned_sub!='')
                {
                    
                        $.ajax({
                            url:"<?php echo url('accounting/reconcile/add/interestearned/history') ?>",
                            method: "POST",
                            data: {reconcile_id:reconcile_id,chart_of_accounts_id:chart_of_accounts_id,income_account_sub:income_account_sub,interest_earned_sub:interest_earned_sub,descp_it_sub:descp_it_sub},
                            success:function(data)
                            {
                            }
                        })
                }
              }
            }
    }
    function callhistory(chart_of_accounts_id,action)
    {
          var action = action;
          var ending_balance = $('#ending_balance').text().substr(1);
          var ending_date = $('#ending_date').val();
          var first_date = $('#first_date').val();
          var service_charge = $('#service_charge').val();
          var expense_account = $('#expense_account').val();
          var second_date = $('#second_date').val();
          var interest_earned = $('#interest_earned').val();
          var income_account = $('#income_account').val();
          if(chart_of_accounts_id!='')
          {
            $.ajax({
                url:"<?php echo url('accounting/reconcile/save/history') ?>",
                method: "POST",
                data: {chart_of_accounts_id:chart_of_accounts_id,ending_balance:ending_balance,ending_date:ending_date,first_date:first_date,service_charge:service_charge,expense_account:expense_account,second_date:second_date,interest_earned:interest_earned,income_account:income_account,action:action},
                success:function(data)
                {
                }
            })
          }
    }
</script>
