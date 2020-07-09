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
                                <div class="dropdown" style="position: relative;float: right;display: inline-block;margin-left: 10px;">
                                    <button class="btn btn-success" type="button" data-toggle="dropdown" style="border-radius: 20px 20px 20px 20px">New transaction
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
                                <div class="dropdown" style="position: relative;display: inline;">
                                    <button type="button" class="btn btn-default"  style="border-radius: 20px 0 0 20px">Print Checks</button>
                                    <button class="btn btn-default" type="button" data-toggle="dropdown" style="border-radius: 0 20px 20px 0;margin-left: -5px;">
                                        <span class="fa fa-caret-down"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Order Checks</a></li>
                                        <li><a href="#">Pay Bills</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px">
                            <div class="col-md-12" style="padding: 0 70px 10px;">
                                <div class="dropdown">
                                    <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" style="border-radius: 20px 20px 20px 20px">Filter
                                        <span class="fa fa-caret-down"></span></button>
                                    <ul class="dropdown-menu">
                                        <li style="padding: 30px 30px 30px 30px">
                                            <form action="" class="form-horizontal">
                                                <div class="form-group">
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
                                                <div class="form-group">
                                                    <div style="position: relative; display: inline-block;">
                                                        <label for="">Status</label>
                                                        <select name="status" id="type" class="form-control">
                                                            <option value="">All statuses</option>
                                                            <option value="">Open</option>
                                                            <option value="">Overdue</option>
                                                            <option value="">Paid</option>
                                                        </select>
                                                    </div>
                                                    <div style="position:relative; display: inline-block;float: right;margin-left: 10px">
                                                        <label for="">Delivery Method</label>
                                                        <select name="status" id="type" class="form-control">
                                                            <option value="">Any</option>
                                                            <option value="">Print later</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
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
                                                <div class="form-group">
                                                    <label for="">Payee</label>
                                                    <select name="status" id="type" class="form-control" style="width: 100%">
                                                        <option value="">All statuses</option>
                                                        <option value="">Open</option>
                                                        <option value="">Overdue</option>
                                                        <option value="">Paid</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Category</label>
                                                    <select name="status" id="type" class="form-control" style="width: 100%">
                                                        <option value="">All statuses</option>
                                                        <option value="">Open</option>
                                                        <option value="">Overdue</option>
                                                        <option value="">Paid</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <button class="btn btn-default" type="reset" style="border-radius: 20px 20px 20px 20px">Reset</button>
                                                    <button class="btn btn-success" type="submit" style="border-radius: 20px 20px 20px 20px; float: right;">Apply</button>
                                                </div>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                                <!--DataTables-->
                                <table id="expenses_table" class="table table-striped table-bordered" style="width:100%">
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

    <!-- Modal -->
    <div class="modal fade" id="addBtnModal" tabindex="-1" role="dialog" aria-labelledby="addBtnModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h1>Hello World</h1>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <?php include viewPath('includes/sidebars/accounting/accounting'); ?>
<?php include viewPath('includes/footer_accounting'); ?>
<script>
    // DataTable JS
    $(document).ready(function() {
        $('#expenses_table').DataTable({
            "paging": false,
        });
    } );
</script>


