<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header_accounting'); ?>
<div class="wrapper" role="wrapper">
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row" style="margin-left: 50px;padding-bottom: 20px;">
                    <div class="col-md-12 banking-tab-container">
                        <a href="<?php echo url('/accounting/expenses')?>" class="banking-tab" style="text-decoration: none">Expenses</a>
                        <a href="<?php echo url('/accounting/vendors')?>" class="banking-tab<?php echo ($this->uri->segment(1)=="vendors")?:'-active';?>">Vendors</a>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-md-12" style="padding: 0 70px 10px;">
                        <div class="row">
                            <div class="col-md-6">
                                <h2>Vendors</h2>
                            </div>
                            <div class="col-md-6" style="text-align: right">
                                <div class="dropdown" style="position: relative;float: right;display: inline-block;margin-left: 10px;">
                                    <button type="button" class="btn btn-success" style="border-radius: 20px 0 0 20px">New vendor</button>
                                    <button class="btn btn-success" type="button" data-toggle="dropdown" style="border-radius: 0 20px 20px 0;margin-left: -5px;">
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Import</a></li>
                                    </ul>
                                </div>
                                <div class="dropdown" style="position: relative;display: inline-block;">
                                    <button type="button" class="btn btn-default" style="border-radius: 20px 0 0 20px">Prepare 1099s</button>
                                    <button class="btn btn-default" type="button" data-toggle="dropdown" style="border-radius: 0 20px 20px 0;margin-left: -5px;">
                                        <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Order Checks</a></li>
                                        <li><a href="#">Pay Bills</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="tableContainer moneyBar">
                                    <div class="unpaid">
                                        <div class="header">Unpaid Least 365 Days</div>
                                        <div class="unpaid-content">

                                        </div>
                                    </div>
                                    <div class="paid">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px">
                            <div class="col-md-12" style="padding: 0 70px 10px;">
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
    <?php include viewPath('includes/sidebars/accounting/accounting'); ?>
</div>
<?php include viewPath('includes/footer_accounting'); ?>
<script>
    // DataTable JS
    $(document).ready(function() {
        $('#vendors_table').DataTable({
            "paging": false,
        });

    } );
</script>


