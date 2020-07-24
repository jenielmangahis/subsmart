<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header_accounting'); ?>
<div class="wrapper" role="wrapper">
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row" style="padding-bottom: 20px;">
                    <div class="col-md-12 banking-tab-container">
                        <a href="<?php echo url('/accounting/expenses')?>" class="banking-tab<?php echo ($this->uri->segment(1)=="expenses")?:'-active';?>" style="text-decoration: none">Expenses</a>
                        <a href="<?php echo url('/accounting/vendors')?>" class="banking-tab">Vendors</a>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-md-12" style="padding: 0 30px 10px;">
                        <div class="row">
                            <div class="col-md-6">
                                <h2>Expense Transactions</h2>
                            </div>
                            <div class="col-md-6" style="text-align: right">
                                <div class="dropdown" style="position: relative;display: inline;">
                                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#print-checks-modal"  style="border-radius: 20px 0 0 20px">Print Checks</button>
                                    <button class="btn btn-default" type="button" data-toggle="dropdown" style="border-radius: 0 20px 20px 0;margin-left: -5px;">
                                        <span class="fa fa-caret-down"></span></button>
                                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                        <li><a href="#">Order Checks</a></li>
                                        <li><a href="#">Pay Bills</a></li>
                                    </ul>
                                </div>
                                <div class="dropdown" style="display: inline-block;margin-left: 10px;">
                                    <button class="btn btn-success" type="button" data-toggle="dropdown" style="border-radius: 20px">New transaction
                                        <span class="fa fa-caret-down"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#" data-toggle="modal" data-target="#timeActivity-modal">Time Activity</a></li>
                                        <li><a href="#" data-toggle="modal" data-target="#bill-modal">Bill</a></li>
                                        <li><a href="#" data-toggle="modal" data-target="#expense-modal">Expense</a></li>
                                        <li><a href="#" data-toggle="modal" data-target="#edit-expensesCheck" id="addCheck">Check</a></li>
                                        <li><a href="#" data-toggle="modal" data-target="#vendorCredit-modal">Vendor Credit</a></li>
                                        <li><a href="#" data-toggle="modal" data-target="#payDown-modal">Pay down credit card</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="container-wrapper">
                            <div class="row">
                                <div class="col-md-12" style="padding: 0 30px 10px;">
                                    <div class="dropdown filter-btn">
                                        <button class="btn btn-default" type="button" data-toggle="dropdown">Filter
                                            <span class="fa fa-caret-down"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li style="padding: 30px 30px 30px 30px">
                                                <form action="" method="" class="">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label for="type">Type</label>
                                                            <select name="type" id="type" class="form-control">
                                                                <option value="">All transaction</option>
                                                                <option value="">Expenses</option>
                                                                <option value="">Bill</option>
                                                                <option value="">Bill payments</option>
                                                                <option value="">Check</option>
                                                                <option value="">Recently paid</option>
                                                                <option value="">Vendor credit</option>
                                                                <option value="">Credit Card Payment</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <label for="">Status</label>
                                                            <select name="status" id="type" class="form-control">
                                                                <option value="">All statuses</option>
                                                                <option value="">Open</option>
                                                                <option value="">Overdue</option>
                                                                <option value="">Paid</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="">Delivery Method</label>
                                                            <select name="status" id="type" class="form-control">
                                                                <option value="">Any</option>
                                                                <option value="">Print later</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label for="">Date</label>
                                                            <select name="status" id="type" class="form-control" style="width: 100%">
                                                                <option value="">All statuses</option>
                                                                <option value="">Open</option>
                                                                <option value="">Overdue</option>
                                                                <option value="">Paid</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="">From</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="">To</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <label for="">Payee</label>
                                                            <select name="payee" id="type" class="form-control" style="width: 100%">
                                                                <option value="">All statuses</option>
                                                                <option value="">Open</option>
                                                                <option value="">Overdue</option>
                                                                <option value="">Paid</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <label for="">Category</label>
                                                            <select name="category" id="type" class="form-control" style="width: 100%">
                                                                <option value="">All statuses</option>
                                                                <option value="">Open</option>
                                                                <option value="">Overdue</option>
                                                                <option value="">Paid</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div style="margin-top: 12px">
                                                        <button class="btn btn-default" type="reset" style="border-radius: 36px">Reset</button>
                                                        <button class="btn btn-success" type="submit" style="border-radius: 36px; float: right;">Apply</button>
                                                    </div>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                    <span class="display-filterDate">365 Days</span>
                                </div>
                            </div>
                            <div class="arrow-level-down">
                                <i class="fa fa-level-down fa-flip-horizontal fa-2x icon-arrow"></i>
                            </div>
                            <div class="dropdown batch-action-btn" style="display: inline-block;position: relative">
                                <button class="btn btn-default" type="button" data-toggle="dropdown" style="border-radius: 20px">Batch Action
                                    <span class="fa fa-caret-down"></span></button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Print Transaction</a></li>
                                    <li><a href="#">Categorized selected</a></li>
                                </ul>
                            </div>
                            <div class="icon-settings-container">
                                <i class="fa fa-print"></i>
                                <i class="fa fa-upload"></i>
                                <i class="fa fa-cog"></i>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <!--DataTables-->
                                    <table id="expenses_table" class="table table-striped table-bordered" style="width:100%;margin-top: 20px;">
                                        <thead>
                                        <tr>
                                            <th><input type="checkbox"></th>
                                            <th>Date</th>
                                            <th>Type</th>
                                            <th>No.</th>
                                            <th>Payee</th>
                                            <th>Category</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($vendors as $vendor): ?>
                                        <?php foreach ($checks as $check):?>
                                            <?php if ($vendor->vendor_id == $check->vendor_id):?>
                                        <tr>
                                            <td><input type="checkbox"></td>
                                            <td data-toggle="modal" data-target="#edit-expensesCheck" id="editCheck" data-id="<?php echo $vendor->vendor_id;?>"></td>
                                            <td data-toggle="modal" data-target="#edit-expensesCheck" id="editCheck" data-id="<?php echo $vendor->vendor_id;?>"><?php echo 'Check'?></td>
                                            <td data-toggle="modal" data-target="#edit-expensesCheck" id="editCheck" data-id="<?php echo $vendor->vendor_id;?>"><?php echo $check->id; ?></td>
                                            <td data-toggle="modal" data-target="#edit-expensesCheck" id="editCheck" data-id="<?php echo $vendor->vendor_id;?>"><?php echo $vendor->f_name.'&nbsp;'.$vendor->l_name; ?></td>
                                            <td>
                                                <select name="category" id="" class="form-control select2">
                                                    <option>test1</option>
                                                    <option>test2</option>
                                                    <option>test3</option>
                                                </select>
                                            </td>
                                            <td data-toggle="modal" data-target="#edit-expensesCheck" id="editCheck" data-id="<?php echo $vendor->vendor_id;?>"></td>
                                            <td style="text-align: right;">
                                                <a href="#" data-toggle="modal" data-target="#edit-expensesCheck" id="editCheck" data-id="<?php echo $vendor->vendor_id;?>" style="margin-right: 10px;color: #0077c5;font-weight: 600;">View/Edit</a>
                                                <div class="dropdown" style="display: inline-block;position: relative;cursor: pointer;">
                                                    <span class="fa fa-caret-down" data-toggle="dropdown"></span>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a href="#">Copy</a></li>
                                                        <li>
                                                            <a href="#" type="submit" id="deleteCheck" data-id="<?php echo $check->id;?>">Delete</a>
                                                        </li>
                                                        <li><a href="#">Void</a></li>
                                                    </ul>
                                                </div>&nbsp;
                                            </td>
                                        </tr>
                                            <?php endif;?>
                                        <?php endforeach;?>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row"></div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
    <!-- Modal for Print Checks-->
    <div class="full-screen-modal">
        <div id="print-checks-modal" class="modal fade modal-fluid" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title">Print Checks</div>
                        <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-2x"></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-2">
                                <select name="" id="" class="form-control">
                                    <option selected>Cash on hand</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <span style="font-weight: bold">Balance</span>
                                <span>$111,111.00</span>
                            </div>
                            <div class="col-md-2">
                                <span style="font-weight: bold">0 checked selected</span>
                                <span>$0.00</span>
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-default" style="float: right;border-radius: 36px">Add check</button>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px">
                            <div class="action-bar">
                                <span class="batchAction">
                                    <i class="fa fa-level-down fa-flip-horizontal fa-2x icon-arrow"></i>
                                    <button class="btn btn-default remove-button">Remove from list</button>
                                </span>
                                <div class="select-sort">
                                    <select name="" id="" class="form-control">
                                        <option value="">Sort by Payee</option>
                                        <option value="">Sort by Order created</option>
                                        <option value="">Sort by Date/Payee</option>
                                        <option value="">Sort by Date/Order created</option>
                                    </select>
                                </div>
                                <div class="select-sort">
                                    <select name="" id="" class="form-control">
                                        <option value="">Show all checks</option>
                                        <option value="">Show regular checks</option>
                                        <option value="">Show bill payment checks</option>
                                    </select>
                                </div>
                                <div class="labeled-input">
                                    <div><label for="">Starting check no.</label></div>
                                    <div>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="labeled-input">
                                    <div><label for="">On first page print</label></div>
                                    <div>
                                        <select name="" id="" class="form-control">
                                            <option value="">1 checks</option>
                                            <option value="">2 checks</option>
                                            <option value="">3 checks</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <span class="print-settings">
                                <a href=""><i class="fa fa-print fa-lg"></i></a>
                                <a href=""><i class="fa fa-cog fa-lg"></i></a>
                            </span>
                        </div>
<!--                        DataTables-->
                        <table id="printChecktbl" class="table table-striped table-bordered" style="width:100%;margin-top: 20px;">
                            <thead>
                            <tr>
                                <th><input type="checkbox"></th>
                                <th>Date</th>
                                <th>Type</th>
                                <th>Payee</th>
                                <th>Amount</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><input type="checkbox"></td>
                                <td>Test</td>
                                <td>Test</td>
                                <td>Test</td>
                                <td>Test</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer-print">
                        <div class="row">
                            <div class="col-md-3">
                                <button class="btn btn-dark cancel-button" type="button">Cancel</button>
                            </div>
                            <div class="col-md-3" style="text-align: center;">
                                <a href="#" class="footer-links">Print setup</a>
                            </div>
                            <div class="col-md-3" style="text-align: center;">
                                <a href="#" class="footer-links">Order checks</a>
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-success print-button">Preview and print</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <!--end of modal-->
<!--    Add/Edit Checks Modal-->
    <div class="full-screen-modal">
        <div id="edit-expensesCheck" class="modal fade modal-fluid" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title">
                            <a href=""><i class="fa fa-history fa-lg" style="margin-right: 10px"></i></a>
                            Check #1
                        </div>
                        <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
                    </div>
                    <form action="" method="post" id="addEditCheckmodal">
                        <input type="hidden" id="site_url" value="<?php echo site_url(); ?>">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="">Payee</label>
                                <input type="hidden" name="check_id" id="checkID" value="">
                                <select name="vendor_id" id="vendorID" class="form-control">
                                    <option selected disabled>Select a payee</option>
                                    <?php foreach ($vendors as $vendor):?>
                                    <option value="<?php echo $vendor->vendor_id?>"><?php echo $vendor->f_name."&nbsp;".$vendor->l_name;?> </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="">Bank Account</label>
                                <select name="bank_id"  class="form-control select2">
                                    <option value="1" selected>Cash on hand</option>
                                    <option value="2">Corporate Account(XXXXXX 5850)</option>
                                    <option value="3">Corporate Account(XXXXXX 5850)Te</option>
                                </select>
                            </div>
                            <div class="col-md-3" style="line-height: 100px">
                                <span style="font-weight: bold">Balance</span>
                                <span>$113,101.00</span>
                            </div>
                            <div class="col-md-3" style="text-align: right">
                                <div>AMOUNT</div>
                                <div><h1>$0.00</h1></div>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px">
                            <div class="col-md-3">
                                <label for="">Mailing address</label>
                                <textarea name="mailing_address" id="mailing_address" cols="30" rows="4" placeholder="" style="resize: none;"></textarea>
                            </div>
                            <div class="col-md-2">
                                <label for="">Payment date</label>
                                <input type="date" name="payment_date" id="payment_date" class="form-control">
                            </div>
                            <div class="col-md-3"></div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Check no.</label>
                                    <input type="text" name="check_num" id="check_number" class="form-control" value="1">
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" name="print_later" id="print_later" value="1">
                                    <label for="">Print later</label>
                                </div>
                                <div class="form-group">
                                    <label for="">Permit no.</label>
                                    <input type="text" name="permit_num" id="permit_number" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                        <div class="table-container">
                            <!--                        DataTables-->
                            <table id="expensesCheckTable" class="table table-striped table-bordered" style="width:100%;margin-top: 20px;">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>#</th>
                                    <th>CATEGORY</th>
                                    <th>DESCRIPTION</th>
                                    <th>AMOUNT</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody id="line-container">
                                <tr>
                                    <td></td>
                                    <td>1</td>
                                    <td>Commission & fees</td>
                                    <td>What did you pay for?</td>
                                    <td></td>
                                    <td style="text-align: center"><i class="fa fa-trash"></i></td>
                                </tr>
                                <tr id="tableLine">
                                    <td></td>
                                    <td><span id="line-counter">2</span></td>
                                    <td><input type="text" class="form-control" id="tbl-input" style="display: none;"></td>
                                    <td><input type="text" class="form-control" id="tbl-input" style="display: none;"></td>
                                    <td><input type="text" class="form-control" id="tbl-input" style="display: none;"></td>
                                    <td style="text-align: center"><a href="#" id="delete-line-row"><i class="fa fa-trash"></i></a></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="addAndRemoveRow">
                            <button type="button" class="add-remove-line" id="add-four-line">Add lines</button>
                            <button type="button" class="add-remove-line" id="clear-all-line">Clear all lines</button>
                        </div>
                        <div class="form-group">
                            <label for="">Memo</label>
                            <textarea name="" id="memo" cols="30" rows="3" placeholder="" style="width: 350px;resize: none;" ></textarea>
                        </div>
                        <div class="form-group">
                            <label for=""><i class="fa fa-paperclip"></i>&nbsp;Attachment</label>
                            <span>Maximum size: 20MB</span>
<!--                            <form action="/file-upload" class="dropzone" method="post" enctype="multipart/form-data" style="width: 423px;">-->
                                <div class="fallback">
                                    <input name="file" type="file" multiple />
                                </div>
<!--                            </form>-->
                        </div>
                    </div>
                    <div class="modal-footer-check">
                        <div class="row">
                            <div class="col-md-4">
                                <button class="btn btn-dark cancel-button" type="button">Cancel</button>
                                <button class="btn btn-dark cancel-button" type="reset">Revert</button>
                            </div>
                            <div class="col-md-5">
                                <div class="middle-links">
                                    <a href="">Print check</a>
                                </div>
                                <div class="middle-links">
                                    <a href="">Order checks</a>
                                </div>
                                <div class="middle-links">
                                    <a href="">Make recurring</a>
                                </div>
                                <div class="middle-links end">
                                    <a href="">More</a>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="dropdown" style="float: right">
                                    <button type="submit" class="btn btn-success" style="border-radius: 20px 0 0 20px">Save and new</button>
                                    <button class="btn btn-success" type="button" data-toggle="dropdown" style="border-radius: 0 20px 20px 0;margin-left: -5px;">
                                        <span class="fa fa-caret-down"></span></button>
                                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                        <li><a href="#">Save and close</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <?php if ($this->session->flashdata('checked')){?>
        <div class="alert alert-success alert-dismissible col-md-4" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo $this->session->flashdata('checked');?>
        </div>
    <?php }elseif ($this->session->flashdata('check_failed')){?>
        <div class="alert alert-danger alert-dismissible col-md-4" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo $this->session->flashdata('check_failed');?>
        </div>
    <?php }elseif ($this->session->flashdata('checked_updated')){?>
        <div class="alert alert-info alert-dismissible col-md-4" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo $this->session->flashdata('checked_updated');?>
        </div>
    <?php }elseif ($this->session->flashdata('checked_up_failed')){?>
        <div class="alert alert-danger alert-dismissible col-md-4" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo $this->session->flashdata('checked_up_failed');?>
        </div>
    <?php }?>
<!--    end of modal-->
<!--    Time Activity modal-->
    <div class="full-screen-modal">
        <div id="timeActivity-modal" class="modal fade modal-fluid" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title">
                            <a href=""><i class="fa fa-history fa-lg" style="margin-right: 10px"></i></a>
                            Time Activity
                        </div>
                        <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
                    </div>
                    <form action="<?php echo site_url()?>accounting/timeActivity" method="post">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-5">
                                   <table class="form-inline-group">
                                       <tr>
                                           <td><label for="">Date</label></td>
                                           <td>
                                               <input type="date" name="date" class="form-inline">
                                           </td>
                                       </tr>
                                       <tr>
                                           <td><label for="">Name</label></td>
                                           <td>
                                               <input type="text" name="name" class="form-inline">
                                           </td>
                                       </tr>
                                       <tr>
                                           <td><label for="">Customer</label></td>
                                           <td>
                                               <input type="text" name="customer" class="form-inline">
                                           </td>
                                       </tr>
                                       <tr>
                                           <td><label for="">Service</label></td>
                                           <td>
                                               <select name="service" id="" class="form-inline">
                                                   <option disabled selected>Chose the service worked on</option>
                                                   <option>Credit</option>
                                                   <option>Discount</option>
                                                   <option>Hours</option>
                                                   <option>Installation</option>
                                                   <option>Labor</option>
                                                   <option>Material</option>
                                               </select>
                                           </td>
                                       </tr>
                                       <tr>
                                           <td></td>
                                           <td>
                                               <input type="checkbox" name="billable" value="1">
                                               <span>Billable (/hr)</span>
                                           </td>
                                       </tr>
                                   </table>
                            </div>
                            <div class="col-md-5">
                                <table class="form-inline-group">
                                    <tr>
                                        <td></td>
                                        <td>
                                            <input type="checkbox" name="start_end_times" value="1">
                                            <span>Enter Start and End Times</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="">Time</label></td>
                                        <td>
                                            <input type="time" name="time" class="form-inline" placeholder="hh:mm">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="">Description</label></td>
                                        <td>
                                            <textarea name="description" id="" cols="60" rows="5"></textarea>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                    </div>
                    <div class="modal-footer-activity">
                        <div class="row">
                            <div class="col-md-6">
                                <button class="btn btn-default btn-transparent">Cancel</button>
                            </div>
                            <div class="col-md-6">
                                <div style="right: 0;float: right;">
                                    <button class="btn btn-default btn-transparent" type="submit" style="display: inline-block">Save</button>
                                    <div class="dropdown" style="display: inline-block">
                                        <button type="button" class="btn btn-success" style="border-radius: 20px 0 0 20px">Save and new</button>
                                        <button class="btn btn-success" type="button" data-toggle="dropdown" style="border-radius: 0 20px 20px 0;margin-left: -5px;">
                                            <span class="fa fa-caret-down"></span></button>
                                        <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                            <li><a href="#">Save and close</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
<!--end of modal-->
<!--    Bill modal-->
    <div class="full-screen-modal">
        <div id="bill-modal" class="modal fade modal-fluid" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title">
                            <a href=""><i class="fa fa-history fa-lg" style="margin-right: 10px"></i></a>
                            Bill
                        </div>
                        <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
                    </div>
                    <form action="<?php echo site_url()?>accounting/addBill" method="post">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="">Vendor</label>
                                <select name="vendor_id" id="" class="form-control select2">
                                    <option value="1">Abacus Accounting</option>
                                    <option value="2">Absolute Power</option>
                                    <option value="3">ADSC</option>
                                </select>
                            </div>
                            <div class="col-md-9" style="text-align: right">
                                <div>Balance Due</div>
                                <div><h1>$0.00</h1></div>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px;width: 80%;">
                            <div class="col-md-3">
                                <label for="">Mailing address</label>
                                <textarea name="mailing_address" id="memo" cols="30" rows="4" placeholder="" style="resize: none;"></textarea>
                            </div>
                            <div class="col-md-3">
                                <label for="">Terms</label>
                                <select name="terms" id="" class="form-control select2">
                                    <option>Due on receipt</option>
                                    <option>Net 15</option>
                                    <option>Net 30</option>
                                    <option>Net 60</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="">Bill date</label>
                                <input type="date" name="bill_date" class="form-control">
                            </div>
                            <div class="col-md-2">
                                <label for="">Due date</label>
                                <input type="date" name="due_date" class="form-control">
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Bill no.</label>
                                    <input type="text" name="bill_num" class="form-control" value="">
                                </div>
                                <div class="form-group">
                                    <label for="">Permit no.</label>
                                    <input type="text" name="permit_num" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="table-container">
                            <!--                        DataTables-->
                            <table id="expensesCheckTable" class="table table-striped table-bordered" style="width:100%;margin-top: 20px;">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>#</th>
                                    <th>CATEGORY</th>
                                    <th>DESCRIPTION</th>
                                    <th>AMOUNT</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody id="line-container-bill">
                                <tr>
                                    <td></td>
                                    <td>1</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td style="text-align: center"><i class="fa fa-trash"></i></td>
                                </tr>
                                <tr id="tableLine-bill">
                                    <td></td>
                                    <td><span id="line-counter-bill">2</span></td>
                                    <td><input type="text" class="form-control" id="tbl-input-bill" style="display: none;"></td>
                                    <td><input type="text" class="form-control" id="tbl-input-bill" style="display: none;"></td>
                                    <td><input type="text" class="form-control" id="tbl-input-bill" style="display: none;"></td>
                                    <td style="text-align: center"><a href="#" id="delete-row-bill"><i class="fa fa-trash"></i></a></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="addAndRemoveRow">
                            <button type="button" class="add-remove-line" id="add-four-line-bill">Add lines</button>
                            <button type="button" class="add-remove-line" id="clear-all-line-bill">Clear all lines</button>
                        </div>
                        <div class="form-group">
                            <label for="">Memo</label>
                            <textarea name="" id="memo" cols="30" rows="3" placeholder="" style="width: 350px;resize: none;" ></textarea>
                        </div>
                        <div class="form-group">
                            <label for=""><i class="fa fa-paperclip"></i>&nbsp;Attachment</label>
                            <span>Maximum size: 20MB</span>
<!--                            <form action="/file-upload" class="dropzone" method="post" enctype="multipart/form-data" style="width: 423px;">-->
                                <div class="fallback">
                                    <input name="file" type="file" multiple />
                                </div>
<!--                            </form>-->
                        </div>
                    </div>
                    <div class="modal-footer-check">
                        <div class="row">
                            <div class="col-md-5">
                                <button class="btn btn-dark cancel-button" type="button">Cancel</button>
                            </div>
                            <div class="col-md-2" style="text-align: center;">
                                <div>
                                    <a href="#" style="color: #ffffff;">Make recurring</a>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="dropdown" style="float: right;display: inline-block;position: relative;">
                                    <button type="button" class="btn btn-success" style="border-radius: 20px 0 0 20px">Save and schedule payment</button>
                                    <button class="btn btn-success" type="button" data-toggle="dropdown" style="border-radius: 0 20px 20px 0;margin-left: -5px;">
                                        <span class="fa fa-caret-down"></span></button>
                                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                        <li><a href="#">Save and new</a></li>
                                        <li><a href="#">Save and close</a></li>
                                    </ul>
                                </div>
                                <div class="" style="display: inline-block;float: right;margin-right: 10px;">
                                    <button class="btn btn-transparent" type="submit">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!--    end of modal-->
<!--    Expense modal-->
    <div class="full-screen-modal">
        <div id="expense-modal" class="modal fade modal-fluid" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title">
                            <a href=""><i class="fa fa-history fa-lg" style="margin-right: 10px"></i></a>
                            Expense
                        </div>
                        <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
                    </div>
                    <form action="<?php echo site_url()?>accounting/addExpense" method="post">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="">Payee</label>
                                <select name="vendor_id" id="" class="form-control select2" required>
                                    <option value="" disabled selected>Who did you pay?</option>
                                    <option value="1">Abacus Accounting</option>
                                    <option value="2">Absolute Power</option>
                                    <option value="3">ADSC</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="">Payment account <i class="fa fa-question-circle"></i></label>
                                <select name="payment_account" id="" class="form-control select2" required>
                                    <option value="" disabled selected>Who did you pay?</option>
                                    <option>Cash on hand</option>
                                    <option value="1">Cash on hand:Cash on hand</option>
                                    <option value="2">Corporate Account (XXXXXX 5850)</option>
                                    <option value="3">Corporate Account (XXXXXX 5850)Te</option>
                                    <option >Investment Asset</option>
                                    <option >Payroll Refunds</option>
                                    <option >Uncategorized Asset</option>
                                    <option >Undeposited Funds</option>
                                </select>
                            </div>
                            <div class="col-md-3" style="line-height: 100px">
                                <span style="font-weight: bold">Balance</span>
                                <span>$133,101.00</span>
                            </div>
                            <div class="col-md-3" style="text-align: right">
                                <div>AMOUNT</div>
                                <div><h1>$0.00</h1></div>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px;width: 80%;">
                            <div class="col-md-3">
                                <label for="">Payment date</label>
                                <input type="date" name="payment_date" class="form-control" required>
                            </div>
                            <div class="col-md-2">

                            </div>
                            <div class="col-md-3">
                                <label for="">Payment method</label>
                                <select name="payment_method" id="" class="form-control select2" required>
                                    <option value="" disabled selected>What did you pay?</option>
                                    <option>Cash</option>
                                    <option>Check</option>
                                    <option>Credit Card</option>
                                </select>
                            </div>
                            <div class="col-md-2"></div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Ref no.</label>
                                    <input type="text" name="ref_num" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Permit no.</label>
                                    <input type="text" name="permit_num" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="table-container">
                            <!--                        DataTables-->
                            <table id="expensesCheckTable" class="table table-striped table-bordered" style="width:100%;margin-top: 20px;">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>#</th>
                                    <th>CATEGORY</th>
                                    <th>DESCRIPTION</th>
                                    <th>AMOUNT</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody id="line-container-expense">
                                <tr>
                                    <td></td>
                                    <td>1</td>
                                    <td>Commission & fees</td>
                                    <td>What did you pay for?</td>
                                    <td></td>
                                    <td style="text-align: center"><i class="fa fa-trash"></i></td>
                                </tr>
                                <tr id="tableLine-expense">
                                    <td></td>
                                    <td><span id="line-counter-expense">2</span></td>
                                    <td><input type="text" class="form-control" id="tbl-input-expense" style="display: none;"></td>
                                    <td><input type="text" class="form-control" id="tbl-input-expense" style="display: none;"></td>
                                    <td><input type="text" class="form-control" id="tbl-input-expense" style="display: none;"></td>
                                    <td style="text-align: center"><a href="#" id="delete-row-expense"><i class="fa fa-trash"></i></a></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="addAndRemoveRow">
                            <button type="button" class="add-remove-line" id="add-four-line-expense">Add lines</button>
                            <button type="button" class="add-remove-line" id="clear-all-line-expense">Clear all lines</button>
                        </div>
                        <div class="form-group">
                            <label for="">Memo</label>
                            <textarea name="" id="memo" cols="30" rows="3" placeholder="" style="width: 350px;resize: none;" ></textarea>
                        </div>
                        <div class="form-group">
                            <label for=""><i class="fa fa-paperclip"></i>&nbsp;Attachment</label>
                            <span>Maximum size: 20MB</span>
<!--                            <form action="/file-upload" class="dropzone" method="post" enctype="multipart/form-data" style="width: 423px;">-->
                                <div class="fallback">
                                    <input name="file" type="file" multiple />
                                </div>
<!--                            </form>-->
                        </div>
                    </div>
                    <div class="modal-footer-check">
                        <div class="row">
                            <div class="col-md-5">
                                <button class="btn btn-dark cancel-button" type="button">Cancel</button>
                            </div>
                            <div class="col-md-2" style="text-align: center;">
                                <div>
                                    <a href="#" style="color: #ffffff;">Make recurring</a>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="dropdown" style="float: right;display: inline-block;position: relative;">
                                    <button type="submit" class="btn btn-success" style="border-radius: 20px 0 0 20px">Save and new</button>
                                    <button class="btn btn-success" type="button" data-toggle="dropdown" style="border-radius: 0 20px 20px 0;margin-left: -5px;">
                                        <span class="fa fa-caret-down"></span></button>
                                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                        <li><a href="#">Save and close</a></li>
                                    </ul>
                                </div>
                                <div class="" style="display: inline-block;float: right;margin-right: 10px;">
                                    <button class="btn btn-transparent" type="submit">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
<!--    end of modal-->
<!--    Vendor Credit-->
    <div class="full-screen-modal">
        <div id="vendorCredit-modal" class="modal fade modal-fluid" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title">
                            <a href=""><i class="fa fa-history fa-lg" style="margin-right: 10px"></i></a>
                            Vendor Credit
                        </div>
                        <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
                    </div>
                    <form action="<?php echo site_url()?>accounting/vendorCredit" method="post" id="formVendorCredit">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="">Vendor</label>
                                <select name="vendor_id" id="" class="form-control select2" required>
                                    <option value="" disabled selected>Who did you pay?</option>
                                    <option value="1">Abacus Accounting</option>
                                    <option value="2">Absolute Power</option>
                                    <option value="3">ADSC</option>
                                </select>
                            </div>
                            <div class="col-md-9" style="text-align: right">
                                <div>CREDIT AMOUNT</div>
                                <div><h1>$0.00</h1></div>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px;width: 80%;">
                            <div class="col-md-3">
                                <label for="">Mailing address</label>
                                <textarea name="mailing_address" id="memo" cols="30" rows="4" placeholder="" style="resize: none;" required></textarea>
                            </div>
                            <div class="col-md-3">
                                <label for="">Payment date</label>
                                <input type="date" name="payment_date" class="form-control" required>
                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Ref no.</label>
                                    <input type="text" name="ref_num" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Permit no.</label>
                                    <input type="text" name="permit_num" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="table-container">
                            <!--                        DataTables-->
                            <table id="expensesCheckTable" class="table table-striped table-bordered" style="width:100%;margin-top: 20px;">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>#</th>
                                    <th>CATEGORY</th>
                                    <th>DESCRIPTION</th>
                                    <th>AMOUNT</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody id="line-container-vendorCredit">
                                <tr>
                                    <td></td>
                                    <td>1</td>
                                    <td>Commission & fees</td>
                                    <td>What did you pay for?</td>
                                    <td></td>
                                    <td style="text-align: center"><i class="fa fa-trash"></i></td>
                                </tr>
                                <tr id="tableLine-vendorCredit">
                                    <td></td>
                                    <td><span id="line-counter-vendorCredit">2</span></td>
                                    <td><input type="text" class="form-control" id="tbl-input-vendorCredit" style="display: none;"></td>
                                    <td><input type="text" class="form-control" id="tbl-input-vendorCredit" style="display: none;"></td>
                                    <td><input type="text" class="form-control" id="tbl-input-vendorCredit" style="display: none;"></td>
                                    <td style="text-align: center"><a href="#" id="delete-row-vendorCredit"><i class="fa fa-trash"></i></a></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="addAndRemoveRow">
                            <button type="button" class="add-remove-line" id="add-four-line-vendorCredit">Add lines</button>
                            <button type="button" class="add-remove-line" id="clear-all-line-vendorCredit">Clear all lines</button>
                        </div>
                        <div class="form-group">
                            <label for="">Memo</label>
                            <textarea name="" id="memo" cols="30" rows="3" placeholder="" style="width: 350px;resize: none;" ></textarea>
                        </div>
                        <div class="form-group">
                            <label for=""><i class="fa fa-paperclip"></i>&nbsp;Attachment</label>
                            <span>Maximum size: 20MB</span>
<!--                            <form action="/file-upload" class="dropzone" method="post" enctype="multipart/form-data" style="width: 423px;">-->
                                <div class="fallback">
                                    <input name="file" type="file" multiple />
                                </div>
<!--                            </form>-->
                        </div>
                    </div>
                    <div class="modal-footer-check">
                        <div class="row">
                            <div class="col-md-5">
                                <button class="btn btn-dark cancel-button" type="button">Cancel</button>
                            </div>
                            <div class="col-md-2" style="text-align: center;">
                                <div>
                                    <a href="#" style="color: #ffffff;">Make recurring</a>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="dropdown" style="float: right;">
                                    <button type="submit" class="btn btn-success" style="border-radius: 20px 0 0 20px">Save and new</button>
                                    <button class="btn btn-success" type="button" data-toggle="dropdown" style="border-radius: 0 20px 20px 0;margin-left: -5px;">
                                        <span class="fa fa-caret-down"></span></button>
                                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                        <li><a href="#" onclick="document.getElementById('formVendorCredit').submit();">Save and close</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
<!--    end of modal-->
<!--    Paydown credit card modal-->
    <div class="full-screen-modal">
        <div id="payDown-modal" class="modal fade modal-fluid" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title">
                            <a href=""><i class="fa fa-history fa-lg" style="margin-right: 10px"></i></a>
                            Pay down credit card
                        </div>
                        <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
                    </div>
                    <form action="<?php echo site_url()?>accounting/payDown" method="post">
                    <div class="modal-body">
                        <div class="row" style="margin-left: 20px;">
                            <div class="col-md-6">
                                <div class="header-form">
                                    Record payments made to your balance
                                </div>
                                <div class="form-group">
                                    <label for="">Which credit card did you pay?</label>
                                    <select name="credit_card_id" id="" class="form-control select2" required>
                                        <option value="" disabled selected>Select credit card</option>
                                        <option value=""><a href="#">&plus; Add new</a></option>
                                        <option value="1">Sample credit card</option>
                                        <option value="2">Sample credit card 2</option>
                                    </select>
                                </div>
                                <div class="form-group inline">
                                    <label for="">How much did you pay?</label>
                                    <input type="text" name="amount" class="form-control" id="amountSelector" placeholder="Enter the amount" required>
                                </div>
                                <div class="form-group inline">
                                    <label for="">Date of payment</label>
                                    <input type="date" name="date_payment" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="">What did you use to make this payment?</label>
                                    <select name="payment_account" id="" class="form-control select2" required>
                                        <option value="" disabled selected>Select bank account</option>
                                        <option value=""><a href="#">&plus; Add new</a></option>
                                        <option value="1">Cash on hand</option>
                                        <option value="2">Cash on hand:Cash on hand</option>
                                        <option value="3">Corporate Account (XXXXXX 5850)</option>
                                        <option value="4">Corporate Account (XXXXXX 5850)Te</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" id="showHiddenOption">
                                    <span style="margin-left: 8px;vertical-align: 3px;">I made a payment with a check</span>
                                </div>
                                <div class="form-group" id="hiddenOption" style="display: none;">
                                    <label for="checkNumber">Check no.</label>
                                    <input type="number" name="check_num" class="form-control" id="checkNumber" style="height:36px!important;width: 80px;display: inline-block;">
                                    <input type="checkbox" id="printLater">
                                    <span>Print Later</span>
                                </div>
                                <div class="form-group">
                                    <a href="#"><i class="fa fa-caret-right" style="color: #333333;"></i> Memo and attachments</a>
                                </div>
                            </div>
                            <div class="col-md-6" style="padding-right: 20px">
                                <div style="float: right;">
                                    <div class="amount-title">Total paid</div>
                                    <div class="amount-data"><h2>$0.00</h2></div>
                                </div>
                            </div>
                        </div>
                        <div class="privacy">
                            <a href="#">Privacy</a>
                        </div>
                    </div>
                    <div class="modal-footer-check">
                        <div class="row">
                            <div class="col-md-5">
                                <button class="btn btn-dark cancel-button" type="button">Cancel</button>
                            </div>
                            <div class="col-md-2"></div>
                            <div class="col-md-5">
                                <div class="dropdown" style="float: right;display: inline-block;">
                                    <button type="submit" class="btn btn-success" style="border-radius: 20px 0 0 20px">Save and close</button>
                                    <button class="btn btn-success" type="button" data-toggle="dropdown" style="border-radius: 0 20px 20px 0;margin-left: -5px;">
                                        <span class="fa fa-caret-down"></span></button>
                                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                        <li><a href="#">Save and new</a></li>
                                        <li><a href="#">Save and close</a></li>
                                    </ul>
                                </div>
                                <div class="" style="display: inline-block;float: right;margin-right: 10px;">
                                    <button class="btn btn-transparent" type="submit">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
<!--    end of modal-->
    <?php include viewPath('includes/sidebars/accounting/accounting'); ?>
<?php include viewPath('includes/footer_accounting'); ?>
<script>
    // select option
    $('.select2').select2()
    // DataTable JS
    $(document).ready(function() {
        $('#expenses_table').DataTable({
            "paging": false,
            "filter":false
        });
    } );
    $(document).ready(function() {
        $('#printChecktbl').DataTable({
            "paging": false,
            "filter":false
        });
        $('#expensesCheckTable').DataTable({
            "paging": false,
            "filter":false,
            "info":false
        });
    } );
    // Add & Remove line in dataTable Check modal
    $(document).ready(function () {
        jQuery(document).ready(function() {
            $("#add-four-line").click(function() {
                var id = $('#line-container > tr').length;
                for (var x = 1;x <= 4;x++){
                    id++;
                    var row = $('#tableLine').clone(true);
                    row.find("#line-counter").html(id);
                    row.appendTo('#line-container');
                }
            });
        });
            // Clear Lines
        $('#clear-all-line').click(function (e) {
            var num = $('#line-container > tr').length;
            if (num == 2){
                e.preventDefault();
            }else{
                for (var x = 1;x <= num-2;x++){
                    $("#tableLine").last().remove();
                    $('#line-counter').html(2);
                }
            }
        });
        //Delete Line
        $(document).on("click","#delete-line-row",function (e) {
            var count = $('#line-container > tr').length;
            if (count > 2){
                $('#tableLine').last().remove();
            }else{
                e.preventDefault();
            }

        });

        //Table input text show
        $(document).on("click","#tableLine",function () {
            $('#tableLine > td >input').hide();
            $('td > input', this).show();
        });

    });
    // Bill modal js
    $(document).ready(function () {
        jQuery(document).ready(function() {
            $("#add-four-line-bill").click(function() {
                var id = $('#line-container-bill > tr').length;
                for (var x = 1;x <= 4;x++){
                    id++;
                    var row = $('#tableLine-bill').clone(true);
                    row.find("#line-counter-bill").html(id);
                    row.appendTo('#line-container-bill');
                }
            });
        });
        // Clear Lines
        $('#clear-all-line-bill').click(function (e) {
            var num = $('#line-container-bill > tr').length;
            if (num == 2){
                e.preventDefault();
            }else{
                for (var x = 1;x <= num-2;x++){
                    $("#tableLine-bill").last().remove();
                    $('#line-counter-bill').html(2);
                }
            }
        });
        //Delete Line
        $(document).on("click","#delete-row-bill",function (e) {
            var count = $('#line-container-bill > tr').length;
            if (count > 2){
                $('#tableLine-bill').last().remove();
            }else{
                e.preventDefault();
            }

        });

        //Table input text show
        $(document).on("click","#tableLine-bill",function () {
            $('#tableLine-bill > td >input').hide();
            $('td > input', this).show();
        });

    });
    // Expense modal js
    $(document).ready(function () {
        jQuery(document).ready(function() {
            $("#add-four-line-expense").click(function() {
                var id = $('#line-container-expense > tr').length;
                for (var x = 1;x <= 4;x++){
                    id++;
                    var row = $('#tableLine-expense').clone(true);
                    row.find("#line-counter-expense").html(id);
                    row.appendTo('#line-container-expense');
                }
            });
        });
        // Clear Lines
        $('#clear-all-line-expense').click(function (e) {
            var num = $('#line-container-expense > tr').length;
            if (num == 2){
                e.preventDefault();
            }else{
                for (var x = 1;x <= num-2;x++){
                    $("#tableLine-expense").last().remove();
                    $('#line-counter-expense').html(2);
                }
            }
        });
        //Delete Line
        $(document).on("click","#delete-row-expense",function (e) {
            var count = $('#line-container-expense > tr').length;
            if (count > 2){
                $('#tableLine-expense').last().remove();
            }else{
                e.preventDefault();
            }

        });

        //Table input text show
        $(document).on("click","#tableLine-expense",function () {
            $('#tableLine-expense > td >input').hide();
            $('td > input', this).show();
        });

    });
    // Vendor Credit modal js
    $(document).ready(function () {
        jQuery(document).ready(function() {
            $("#add-four-line-vendorCredit").click(function() {
                var id = $('#line-container-vendorCredit > tr').length;
                for (var x = 1;x <= 4;x++){
                    id++;
                    var row = $('#tableLine-vendorCredit').clone(true);
                    row.find("#line-counter-vendorCredit").html(id);
                    row.appendTo('#line-container-vendorCredit');
                }
            });
        });
        // Clear Lines
        $('#clear-all-line-vendorCredit').click(function (e) {
            var num = $('#line-container-vendorCredit > tr').length;
            if (num == 2){
                e.preventDefault();
            }else{
                for (var x = 1;x <= num-2;x++){
                    $("#tableLine-vendorCredit").last().remove();
                    $('#line-counter-vendorCredit').html(2);
                }
            }
        });
        //Delete Line
        $(document).on("click","#delete-row-vendorCredit",function (e) {
            var count = $('#line-container-vendorCredit > tr').length;
            if (count > 2){
                $('#tableLine-vendorCredit').last().remove();
            }else{
                e.preventDefault();
            }

        });

        //Table input text show
        $(document).on("click","#tableLine-vendorCredit",function () {
            $('#tableLine-vendorCredit > td >input').hide();
            $('td > input', this).show();
        });

    });

    //Pay Down
    $(document).ready(function () {
       $('#showHiddenOption').click(function () {
          $('#hiddenOption').toggle(this.checked);
       });
       $('#printLater').click(function () {
          $('#checkNumber').prop("disabled",this.checked);
       });

        $("#amountSelector").change(function () {
            if (!$.isNumeric($(this).val()))
                $(this).val('0').trigger('change');
            $(this).val(parseFloat($(this).val(),10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());
        });
    });
</script>


