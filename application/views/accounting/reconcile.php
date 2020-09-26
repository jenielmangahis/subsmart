<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header_accounting'); ?>
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
.hide,.Checkhide
{
    display: none;
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
                    <input type="file" name="userfile" />
                </div>
            </div>
        </div>

        <div class="save-act">
            <button type="button" class="btn-cmn" onclick="closeSideNav3()">Cancel</button>
            <button type="submit" class="savebtn">Done</button>
        </div>
    </div>
    <!-- End Add Custom Tax Sidebar -->

    <!-- Add New -->
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
                        <h6 id="amount">Amount:<?=number_format($rows[0]->service_charge,2);?></h6>
                    </div>
                </div>
                <div class="row" style="margin-bottom:20px">
                    <div class="col-md-2">
                        <label>Mailing Address:</label>
                        <textarea name="mailing_add" rows="4"></textarea>
                    </div>
                    <div class="col-md-2">
                        <label>Payment date:</label>
                        <div class="col-xs-10 date_picker">
                            <input type="text" name="date_popup" class="form-control" value="<?=$rows[0]->ending_date?>"/>
                        </div>
                    </div>
                    <div class="col-md-4"></div>
                    <div class="col-md-2">
                        <label>Check no.</label>
                        <input type="text" name="checkno" value="<?=$rows[0]->CHRG?>"/>
                        </br>
                        </br>
                        <input type="checkbox" name="print_check">Print Later
                    </div>
                </div>
                <div class="row" style="margin-bottom:20px">
                    <div class="col-md-8"></div>
                    <div class="col-md-2">
                        <label>Check no.</label>
                        <input type="text" name="checkno" value="<?=$rows[0]->CHRG?>"/>
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
                                    <input type="hidden" id="edit_descp" name="edit_descp" value="" placeholder="What did you paid for?">
                                    <div class="edit_descp"></div>
                                </td>
                                <td>
                                     <input type="hidden" id="edit_service_charge" name="edit_service_charge" value="<?=number_format($rows[0]->service_charge,2)?>">
                                    <div class="edit_service_charge"><?=number_format($rows[0]->service_charge,2)?></div>
                                </td>
                                <td><a href="javascript:void(0);" class="remove"><i class="fa fa-trash"></i></a></td>
                            </tr>
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
                    <textarea name="memo" rows="4"><?=$rows[0]->memo_sc?></textarea>
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
                    <?php echo form_open_multipart('accounting/reconcile/do_upload/'.$rows[0]->chart_of_accounts_id);?>
                    <div class="file-upload-block">
                        <div class="upload-btn-wrapper">
                            <button class="btn ubw">
                                <i class="fa fa-cloud-upload"></i>
                                <h6>Drag and drop files here or <span>browse to upload</span></h6>
                            </button>
                            <input type="file" name="userfile" />
                        </div>
                    </div>
                    </br>
                    <a href="#" onclick="openSideNav()">Show existing</a>
                </div>
            </div>
        </div>
     
        <div class="save-act" style="position: unset !important;">
            <button type="button" class="btn-cmn" onclick="closeFullNav()">Cancel</button>
            <a href="#" style="margin-left: 30%" onclick="openPrintNav()">Print check</a>
            <button type="submit" class="savebtn">Done</button>
        </div>
    </div>
    <!-- End Add New -->

    <!-- Print popup -->
    <div id="overlay-print-tx" class=""></div>
    <div id="side-menu-print-tx" class="main-side-nav" style="background-color: #f4f5f8">
        <div class="side-title">
            <h4>Print Checks</h4>
            <a id="close-menu-print-tx" class="menuCloseButton" onclick="closePrintNav()"><span id="side-menu-close-text">
            <i class="fa fa-times"></i></span></a>
        </div>
        <div style="margin-left: 20px;">
            <div class="row">
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
            <div class="row">
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
            <div class="row">
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
        </div>
    

        <div class="save-act" style="position: unset !important;">
            <button type="button" class="btn-cmn" onclick="closePrintNav()">Cancel</button>
            <button type="submit" class="savebtn">Done</button>
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
                        <select name="check_payee_popup" class="form-control">
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
                        <select class="form-control" id="check_account_popup">
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
                        <textarea name="check_mailing_add" rows="4"></textarea>
                    </div>
                    <div class="col-md-2">
                        <label>Payment date:</label>
                        <div class="col-xs-10 date_picker">
                            <input type="text" name="check_date_popup" class="form-control" value="<?=$rows[0]->ending_date?>"/>
                        </div>
                    </div>
                    <div class="col-md-4"></div>
                    <div class="col-md-2">
                        <label>Check no.</label>
                        <input type="text" name="check_checkno" value=""/>
                        </br>
                        </br>
                        <input type="checkbox" name="check_print_check">Print Later
                    </div>
                </div>
                <div class="row" style="margin-bottom:20px">
                    <div class="col-md-8"></div>
                    <div class="col-md-2">
                        <label>Check no.</label>
                        <input type="text" name="check_checkno" value=""/>
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
                            <tr onclick="trClickCheckMain()">
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
                                <td>2</td>
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
                    <textarea name="check_memo" rows="4"></textarea>
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
                    <?php echo form_open_multipart('accounting/reconcile/do_upload/'.$rows[0]->chart_of_accounts_id);?>
                    <div class="file-upload-block">
                        <div class="upload-btn-wrapper">
                            <button class="btn ubw">
                                <i class="fa fa-cloud-upload"></i>
                                <h6>Drag and drop files here or <span>browse to upload</span></h6>
                            </button>
                            <input type="file" name="userfile" />
                        </div>
                    </div>
                    </br>
                    <a href="#" onclick="openSideNav()">Show existing</a>
                </div>
            </div>
        </div>
     
        <div class="save-act" style="position: unset !important;">
            <button type="button" class="btn-cmn" onclick="closeCheck()">Cancel</button>
            <a href="#" style="margin-left: 30%" onclick="openPrintNav()">Print check</a>
            <button type="submit" class="savebtn">Done</button>
        </div>
    </div>
    <!-- End Add Check -->

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

                <div class="existing-box">
                    <h4>data_entry.docx <span>08/12/2020</span></h4>

                    <div class="priview-img">
                        <img src="img/download.svg" alt="">
                    </div>

                    <div class="act-br">
                        <a href="#" class="txbtn">Add</a>
                        <a href="#" class="txbtn previewbtn">Preview</a>
                    </div>
                </div>

                <div class="existing-box">
                    <h4>data_entry.docx <span>08/12/2020</span></h4>

                    <div class="priview-img">
                        <img src="img/download.svg" alt="">
                    </div>

                    <div class="act-br">
                        <a href="#" class="txbtn">Add</a>
                        <a href="#" class="txbtn previewbtn">Preview</a>
                    </div>
                </div>

                <div class="existing-box">
                    <h4>data_entry.docx <span>08/12/2020</span></h4>

                    <div class="priview-img">
                        <img src="img/download.svg" alt="">
                    </div>

                    <div class="act-br">
                        <a href="#" class="txbtn">Add</a>
                        <a href="#" class="txbtn previewbtn">Preview</a>
                    </div>
                </div>

                <div class="existing-box">
                    <h4>data_entry.docx <span>08/12/2020</span></h4>

                    <div class="priview-img">
                        <img src="img/download.svg" alt="">
                    </div>

                    <div class="act-br">
                        <a href="#" class="txbtn">Add</a>
                        <a href="#" class="txbtn previewbtn">Preview</a>
                    </div>
                </div>

                <div class="existing-box">
                    <h4>data_entry.docx <span>08/12/2020</span></h4>

                    <div class="priview-img">
                        <img src="img/download.svg" alt="">
                    </div>

                    <div class="act-br">
                        <a href="#" class="txbtn">Add</a>
                        <a href="#" class="txbtn previewbtn">Preview</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Add Agency Sidebar -->

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
                    <div class="col-md-1 hide-col"><h4>$<?=$rows[0]->service_charge?>.00</h4></div>
                    <div class="col-md-1 hide-col"><h4>$<?=$rows[0]->interest_earned?>.00</h4></div>
                    <div class="col-md-1 hide-col"><h4>$<?=$rows[0]->ending_balance-(($accBalance-$rows[0]->service_charge)+$rows[0]->interest_earned)?>.00</h4></div>
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
                                    <div class="col-md-4"><h3>$<?=$rows[0]->ending_balance?>.00</h3></div>
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
                                echo "<tr id='payments' onclick='trClick(".$o.")'>";
                                echo "<td >".$row->first_date."</td>";
                                echo "<td class='type'>".$this->chart_of_accounts_model->getName($row->chart_of_accounts_id)."</td>";
                                echo "<td class='refno' >".$row->CHRG."</td>";
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
                                echo "<td><input type='text' name='SVCCHRG' id='SVCCHRG' value='".$row->CHRG."' class='form-control'></td>";
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
                                $o++;
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
                                echo "<td><a href='#' class='btn-ed' onclick='openFullNav()'>Edit</a></td>";
                                echo "<td><a href='#' class='btn-ed savebt2'>Save</a></td>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "</tr>";
                              $i++;
                              $o++;
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

    var table = $('#reconcile_table').DataTable({sDom: 'lrtip'});

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
});
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
    $.ajax({
        url:"<?php echo url('accounting/reconcile/view/showData') ?>",
        method: "POST",
        success:function(data)
        {
            
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
</script>
<script type="text/javascript">
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
    /* Variables */
    var p = 1;
    var row_check = $(".participantCheckRow");

    function addRowCheck() {
      row_check.clone(true, true).removeClass('Checkhide table-line').appendTo("#participantCheckTable");
      var index_check =$('#participantCheckTable tr').length -1;
      var final_index_check = index_check-1;
      $('#participantCheckTable tr:eq('+index_check+')').attr("onclick","trClickCheck("+final_index_check+")");
      $('#participantCheckTable tr:eq('+index_check+') td:eq(1)').text(index_check-1);
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
      alert(buttoncheck.closest("tr").find('td:eq(4)').text().trim());
      $('#checktotal').text('Total : $'+totcheck.toFixed(2));
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
        total_check += parseInt($('.check_service_charge').text());
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