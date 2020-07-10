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
                                        <li><a href="#">Time Activity</a></li>
                                        <li><a href="#">Bill</a></li>
                                        <li><a href="#">Expenses</a></li>
                                        <li><a href="#">Check</a></li>
                                        <li><a href="#">Vendor Credit</a></li>
                                        <li><a href="#">Pay down credit card</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px;background-color: #ffffff">
                            <div class="col-md-12" style="padding: 0 30px 10px;">
                                <div class="dropdown" style="margin-top: 20px">
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
                                                    <button class="btn btn-default" type="reset" style="border-radius: 20px 20px 20px 20px">Reset</button>
                                                    <button class="btn btn-success" type="submit" style="border-radius: 20px 20px 20px 20px; float: right;">Apply</button>
                                                </div>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                                <!--DataTables-->
                                <table id="expenses_table" class="table table-striped table-bordered" style="width:100%;margin-top: 20px;">
                                    <thead>
                                    <tr>
                                        <th></th>
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
                                    <tr>
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
                                <a href=""><i class="fa fa-cog fa-lg"></a></i>
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
        <!--end of modal-->
    </div>
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
    } );
</script>


