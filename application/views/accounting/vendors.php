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
                        <a href="<?php echo url('/accounting/expenses')?>" class="banking-tab" style="text-decoration: none">Expenses</a>
                        <a href="<?php echo url('/accounting/vendors')?>" class="banking-tab<?php echo ($this->uri->segment(1)=="vendors")?:'-active';?>">Vendors</a>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-md-12" >
                        <div class="row">
                            <div class="col-md-6">
                                <h2>Vendors</h2>
                            </div>
                            <div class="col-md-6" style="text-align: right">
                                <div class="dropdown" style="position: relative;display: inline-block;">
                                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#pay-bills-modal" style="border-radius: 20px 0 0 20px">Pay bills</button>
                                    <button class="btn btn-default" type="button" data-toggle="dropdown" style="border-radius: 0 20px 20px 0;margin-left: -5px;">
                                        <span class="fa fa-caret-down"></span></button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="#">Prepare 1099s</a></li>
                                        <li><a href="#">Order Checks</a></li>
                                    </ul>
                                </div>
                                <div class="dropdown" style="position: relative;display: inline-block;">
                                    <button type="button" class="btn btn-success" style="border-radius: 20px 0 0 20px">New vendor</button>
                                    <button class="btn btn-success" type="button" data-toggle="dropdown" style="border-radius: 0 20px 20px 0;margin-left: -5px;">
                                        <span class="fa fa-caret-down"></span>
                                    </button>
                                    <ul class="dropdown-menu pull-left">
                                        <li><a href="#">Import vendors</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="tableContainer moneyBar">

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" >
                                <!--                        DataTables-->
                                <table id="vendors_table" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th><input type="checkbox"></th>
                                        <th>Vendor/Company</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Open Balance</th>
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
                                        <td><a href="">Create bill</a> <span class="caret"></span></td>
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
    <!-- Modal for Pay Bills-->
    <div class="full-screen-modal">
        <div id="pay-bills-modal" class="modal fade modal-fluid" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title">
                            <a href=""><i class="fa fa-history fa-lg" style="margin-right: 10px"></i></a>
                            Pay Bills
                        </div>
                        <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-2x"></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="">Payment account</label>
                                <select name="" id="" class="form-control">
                                    <option selected>Cash on hand</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <div class="col-md-2" style="line-height: 45px">
                                <span style="font-weight: bold">Balance</span>
                                <span>$111,111.00</span>
                            </div>
                            <div class="col-md-2">
                                <label for="">Payment date</label>
                                <input type="text" class="form-control" placeholder="" value="07/09/2020">
                            </div>
                            <div class="col-md-2">
                                <label for="">Starting check no.</label>
                                <input type="text" class="form-control" value="1">
                            </div>
                            <div class="col-md-2">
                                <input type="checkbox">
                                <label for="">Print later</label>
                            </div>
                            <div class="col-md-2" style="text-align: right">
                                <div>TOTAL PAYMENT AMOUNT</div>
                                <div><h1>$0.00</h1></div>
                            </div>
                        </div>
                        <div class="table-container">
                            <div class="dropdown" style="margin-top: 20px">
                                <button class="btn btn-default" type="button" data-toggle="dropdown" style="border-radius: 20px 20px 20px 20px">Filter
                                    <span class="fa fa-caret-down"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li style="padding: 30px 30px 30px 30px">
                                        <form action="" method="" class="">
                                            <div class="" style="position: relative; display: inline-block;">
                                                <label for="duedate">Due Date</label>
                                                <select name="type" id="duedate" class="form-control">
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
                                                <label for="">From</label>
                                                <input type="text" class="form-control">
                                            </div>
                                            <div style="position:relative; display: inline-block;margin-left: 10px">
                                                <label for="">To</label>
                                                <input type="text" class="form-control">
                                            </div>
                                            <div class="">
                                                <label for="">Payee</label>
                                                <select name="" id="" class="form-control">
                                                    <option value="" selected>All</option>
                                                    <option value="" >Test1</option>
                                                    <option value="" >Test2</option>
                                                </select>
                                            </div>
                                            <div class="">
                                                <input type="checkbox" >
                                                <label for="">Overdue status only</label>
                                            </div>
                                            <div class="">
                                                <button class="btn btn-default" type="reset" style="border-radius: 20px 20px 20px 20px">Reset</button>
                                                <button class="btn btn-success" type="submit" style="border-radius: 20px 20px 20px 20px; float: right;">Apply</button>
                                            </div>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                            <!--                        DataTables-->
                            <table id="payBillsTable" class="table table-striped table-bordered" style="width:100%;margin-top: 20px;">
                                <thead>
                                <tr>
                                    <th><input type="checkbox"></th>
                                    <th>PAYEE</th>
                                    <th>REF NO.</th>
                                    <th>DUE DATE</th>
                                    <th>OPEN BALANCE</th>
                                    <th>CREDIT APPLIED</th>
                                    <th>PAYMENT</th>
                                    <th>TOTAL AMOUNT</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td>Test</td>
                                    <td>Test</td>
                                    <td>Test</td>
                                    <td>Test</td>
                                    <td>Test</td>
                                    <td>Test</td>
                                    <td>Test</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="modal-footer-print">
                        <div class="row">
                            <div class="col-md-3">
                                <button class="btn btn-dark cancel-button" type="button">Cancel</button>
                            </div>
                            <div class="col-md-3">
                            </div>
                            <div class="col-md-3">
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-success print-button">Schedule payment online</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!--end of modal-->
    <?php include viewPath('includes/sidebars/accounting/accounting'); ?>
</div>
<?php include viewPath('includes/footer_accounting'); ?>
<script>
    // DataTable JS
    $(document).ready(function() {
        $('#vendors_table').DataTable({
            "paging": false,
        });
        $(document).ready(function() {
            $('#payBillsTable').DataTable({
                "paging": false,
                "filter":false
            });
        } );
    } );
</script>


