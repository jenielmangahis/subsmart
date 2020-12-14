<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<style type="text/css">
.loader
{
    display: none !important;
}
.upload-btn-wrapper,.ubw
{
    height: 150px !important;
}
.Checkhide
{
    display: none;
}
</style>
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
                        <select name="check_payee_popup" id="check_payee_popup" class="form-control fa">
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
                        <select class="form-control fa" name="check_account_popup" id="check_account_popup">
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
                               <option value="fa fa-plus">&#xf067; Add new</option>
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
                    <form action="<?php echo url('accounting/check/do_upload') ?>" class="uploadmy" method="post" name="checkForm" enctype="multipart/form-data" target="hiddenFramecheck">
                    <div class="file-upload-block">
                        <div class="upload-btn-wrapper">
                            <button class="btn ubw">
                                <i class="fa fa-cloud-upload"></i>
                                <h6>Drag and drop files here or <span>browse to upload</span></h6>
                            </button>
                            <input type="file" name="userfile_check" />
                            <input type="hidden" name="subfix" value="check">
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
            <button type="button" class="btn-cmn" onclick="closeCheck()">Cancel</button>
            <a href="#" style="margin-left: 30%" onclick="openPrintNav()">Print check</a>
            <a href="#" style="margin-left: 30%" >Make recurring</a>
            <button type="button" class="savebtn" onclick="save_check()" >Save and close</button>
        </div>
    </div>
    <!-- End Add Check -->

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
                    <form action="<?php echo url('accounting/check/do_upload') ?>" class="uploadmy" method="post" name="vendorForm" enctype="multipart/form-data" target="hiddenFramevendor">
                    <div class="file-upload-block">
                        <div class="upload-btn-wrapper">
                            <button class="btn ubw">
                                <i class="fa fa-cloud-upload"></i>
                                <h6>Drag and drop files here or <span>browse to upload</span></h6>
                            </button>
                            <input type="file" name="userfile_vendor" />
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
                            <form action="<?php echo url('accounting/check/do_upload') ?>" class="uploadmy" method="post" name="cusForm" enctype="multipart/form-data" target="hiddenFramecus">
                            <div class="file-upload-block">
                                <div class="upload-btn-wrapper">
                                    <button class="btn ubw">
                                        <i class="fa fa-cloud-upload"></i>
                                        <h6>Drag and drop files here or <span>browse to upload</span></h6>
                                    </button>
                                    <input type="file" name="userfile_cus" />
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
                    <!-- <div class="dropdown">
                        <button class="btn-exisitng dropdown-toggle" type="button" data-toggle="dropdown">Unliked
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                            <li><a href="#">All</a></li>
                            <li><a href="#">Unliked</a></li>
                        </ul>
                    </div> -->
                </div>

                <div id="ajax_upload_data"></div>
            </div>
        </div>
    </div>
    <!-- End Add Agency Sidebar -->

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

<?php include viewPath('includes/footer_accounting'); ?>
<script type="text/javascript">
addCheck();
$(document).ready(function() {
        addCheck();
 });
function addCheck()
{
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
    $('#check_account_popup').on('change', function (e) {
          if($('#check_account_popup').val() == 'fa fa-plus')
          {
           openAddAccount();
          } 
      });
    $('#check_payee_popup').on('change', function (e) {
          if($('#check_payee_popup').val() == 'fa fa-plus')
          {
           openPayee();
          } 
      });
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
    $(function(){
        $('.date_picker input').datepicker({
           format: "dd.mm.yyyy",
           todayBtn: "linked",
           language: "de"
        });
    });
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
        url:"<?php echo url('accounting/check/view/showData') ?>",
        method: "POST",
        success:function(data)
        {
            $('#ajax_upload_data').html(data);
        }
    })
}
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