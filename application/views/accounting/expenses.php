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
                                        <li><a href="#">Bill</a></li>
                                        <li><a href="#">Expenses</a></li>
                                        <li><a href="#">Check</a></li>
                                        <li><a href="#">Vendor Credit</a></li>
                                        <li><a href="#">Pay down credit card</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="container-wrapper">
                            <div class="row">
                                <div class="col-md-12" style="padding: 0 30px 10px;">
                                    <div class="dropdown filter-btn" style="margin-top: 20px;margin-right:8px;display: inline-block;">
                                        <button class="btn btn-default" type="button" data-toggle="dropdown" style="border-radius: 20px 20px 20px 20px">Filter
                                            <span class="fa fa-caret-down"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li style="padding: 30px 30px 30px 30px">
                                                <form action="" method="" class="">
                                                    <div class="">
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
                                                    <div style="position: relative; display: inline-block;">
                                                        <label for="">Status</label>
                                                        <select name="status" id="type" class="form-control">
                                                            <option value="">All statuses</option>
                                                            <option value="">Open</option>
                                                            <option value="">Overdue</option>
                                                            <option value="">Paid</option>
                                                        </select>
                                                    </div>
                                                    <div style="position:relative; display: inline-block;margin-left: 10px">
                                                        <label for="">Delivery Method</label>
                                                        <select name="status" id="type" class="form-control">
                                                            <option value="">Any</option>
                                                            <option value="">Print later</option>
                                                        </select>
                                                    </div>
                                                    <div class="">
                                                        <div style="position: relative; display: inline-block;">
                                                            <label for="">Date</label>
                                                            <select name="status" id="type" class="form-control" style="width: 100%">
                                                                <option value="">All statuses</option>
                                                                <option value="">Open</option>
                                                                <option value="">Overdue</option>
                                                                <option value="">Paid</option>
                                                            </select>
                                                        </div>
                                                        <div style="position:relative; display: inline-block;float: right;margin-left: 10px">
                                                            <label for="">From</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div style="position:relative; display: inline-block;float: right;margin-left: 10px">
                                                            <label for="">To</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="">
                                                        <label for="">Payee</label>
                                                        <select name="status" id="type" class="form-control" style="width: 100%">
                                                            <option value="">All statuses</option>
                                                            <option value="">Open</option>
                                                            <option value="">Overdue</option>
                                                            <option value="">Paid</option>
                                                        </select>
                                                    </div>
                                                    <div class="">
                                                        <label for="">Category</label>
                                                        <select name="status" id="type" class="form-control" style="width: 100%">
                                                            <option value="">All statuses</option>
                                                            <option value="">Open</option>
                                                            <option value="">Overdue</option>
                                                            <option value="">Paid</option>
                                                        </select>
                                                    </div>
                                                    <div class="">
                                                        <button class="btn btn-default" type="reset" style="border-radius: 36px">Reset</button>
                                                        <button class="btn btn-success" type="submit" style="border-radius: 36px; float: right;">Apply</button>
                                                    </div>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="display-filterDate">
                                        Last 365 Days
                                    </div>
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
                                        <tr style="cursor: pointer;" data-toggle="modal" data-target="#edit-expensesCheck">
                                            <td><input type="checkbox"></td>
                                            <td>Test</td>
                                            <td>Test</td>
                                            <td>Test</td>
                                            <td></td>
                                            <td>Test</td>
                                            <td></td>
                                            <td><a href="">View</a></td>
                                        </tr>
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
                            <div class="col-md-3">
                                <a href="#" class="footer-links">Print setup</a>
                            </div>
                            <div class="col-md-3">
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

    </div>  <!--end of modal-->
    <div class="full-screen-modal">
        <div id="edit-expensesCheck" class="modal fade modal-fluid" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title">
                            <a href=""><i class="fa fa-history fa-lg" style="margin-right: 10px"></i></a>
                            Check #2714
                        </div>
                        <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-2x"></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="">Payee</label>
                                <input type="text" list="payee-dropdown" class="select-text-dp">
                                <datalist id="payee-dropdown">
                                    <option selected>Tyler Nguyen</option>
                                    <option>Tyler Nguyen</option>
                                    <option>Tyler Nguyen</option>
                                </datalist>
                            </div>
                            <div class="col-md-3">
                                <label for="">Bank Account</label>
                                <input type="text" list="bankAccountDp" class="select-text-dp">
                                <datalist id="bankAccountDp">
                                    <option>Cash on hand</option>
                                    <option>Corporate Account(XXXXXX 5850)</option>
                                    <option>Corporate Account(XXXXXX 5850)Te</option>
                                </datalist>
                            </div>
                            <div class="col-md-3" style="line-height: 100px">
                                <span style="font-weight: bold">Balance</span>
                                <span>$-79,005.33</span>
                            </div>
                            <div class="col-md-3" style="text-align: right">
                                <div>AMOUNT</div>
                                <div><h1>$500.00</h1></div>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px">
                            <div class="col-md-3">
                                <label for="">Mailing address</label>
                                <textarea name="" id="memo" cols="30" rows="4" placeholder="" style="resize: none;">Tyler Nguyen</textarea>
                            </div>
                            <div class="col-md-2">
                                <label for="">Payment date</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-md-3"></div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Check no.</label>
                                    <input type="text" class="form-control" value="2714">
                                </div>
                                <div class="form-group">
                                    <input type="checkbox">
                                    <label for="">Print later</label>
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
                                <tbody>
                                <tr>
                                    <td></td>
                                    <td>1</td>
                                    <td>Commission & fees</td>
                                    <td>What did you pay for?</td>
                                    <td></td>
                                    <td><i class="fa fa-trash"></i></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>2</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><i class="fa fa-trash"></i></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="addAndRemoveRow">
                            <button type="button" class="add-remove-line">Add lines</button>
                            <button type="button" class="add-remove-line">Clear all lines</button>
                        </div>
                        <div class="form-group">
                            <label for="">Memo</label>
                            <textarea name="" id="memo" cols="30" rows="3" placeholder="" style="width: 350px;resize: none;" ></textarea>
                        </div>
                        <div class="form-group">
                            <label for=""><i class="fa fa-paperclip"></i>&nbsp;Attachment</label>
                            <span>Maximum size: 20MB</span>
                            <form action="/file-upload" class="dropzone" method="post" enctype="multipart/form-data" style="width: 423px;">
                                <div class="fallback">
                                    <input name="file" type="file" multiple />
                                </div>
                            </form>
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

            </div>
        </div>
    </div>
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
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-5">
                                   <table class="form-inline-group">
                                       <tr>
                                           <td><label for="">Date</label></td>
                                           <td>
                                               <input type="text" class="form-inline">
                                           </td>
                                       </tr>
                                       <tr>
                                           <td><label for="">Name</label></td>
                                           <td>
                                               <input type="text" class="form-inline">
                                           </td>
                                       </tr>
                                       <tr>
                                           <td><label for="">Customer</label></td>
                                           <td>
                                               <input type="text" class="form-inline">
                                           </td>
                                       </tr>
                                       <tr>
                                           <td></td>
                                           <td>
                                               <input type="checkbox">
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
                                            <input type="checkbox">
                                            <span>Enter Start and End Times</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="">Time</label></td>
                                        <td>
                                            <input type="text" class="form-inline" placeholder="hh:mm">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="">Description</label></td>
                                        <td>
                                            <textarea name="" id="" cols="60" rows="5"></textarea>
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
                                    <button class="btn btn-default btn-transparent" style="display: inline-block">Save</button>
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
                </div>

            </div>
        </div>
    </div>
<!--    end of modal-->
    <?php include viewPath('includes/sidebars/accounting/accounting'); ?>
<?php include viewPath('includes/footer_accounting'); ?>
<script>
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
</script>


