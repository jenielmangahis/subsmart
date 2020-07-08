<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row" style="margin-left: 50px;padding-bottom: 20px;">
                    <div class="col-md-12 banking-tab-container">
                        <a href="<?php echo url('/accounting/link_bank')?>" class="banking-tab<?php echo ($this->uri->segment(1)=="link_bank")?:'-active';?>" style="text-decoration: none">Banking</a>
                        <a href="<?php echo url('/accounting/rules')?>" class="banking-tab">Rules</a>
                        <a href="<?php echo url('/accounting/receipts')?>" class="banking-tab">Receipts</a>
                    </div>
                </div>
                <div class="row" style="margin-left: 50px;padding-bottom: 20px;">
                    <div class="col-md-4">
                        <h2>Bank and Credit Cards</h2>
                    </div>
                    <div class="col-md-4" style="border-left:1px dimgrey dotted;">
                        <div class="dropdown">
                            <button class="btn btn-default" type="button" data-toggle="dropdown" style="text-decoration: none; color: #393a3d;font-size: 20px;background-color: transparent;border: 0;">
                                <i class="fa fa-credit-card"></i> Corporate Account (XXXXXX 5850) <i class="fa fa-chevron-down"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#">Order Checks</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4" style="text-align: right">
                        <div class="dropdown" style="position: relative;display: inline-block;">
                            <button type="button" class="btn btn-default" style="border-radius: 20px 0 0 20px">Update</button>
                            <button class="btn btn-default" type="button" data-toggle="dropdown" style="border-radius: 0 20px 20px 0;margin-left: -5px;">
                                <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li><a href="#">Order Checks</a></li>
                                <li><a href="#">Pay Bills</a></li>
                            </ul>
                        </div>
                        <button class="btn btn-success" style="border-radius: 20px 20px 20px 20px">Add account</button>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-md-12" style="padding: 0 70px 10px;">
                        <ul class="nav nav-tabs banking-tab-container">
                            <li class="banking-sub-active"><a data-toggle="tab" href="#forReview" class="banking-sub-tab">For Review</a></li>
                            <li><a data-toggle="tab" href="#reviewed" class="banking-sub-tab">Reviewed</a></li>
                            <li><a data-toggle="tab" href="#excluded" class="banking-sub-tab">Excluded</a></li>
                        </ul>
                        <div class="tab-content" style="padding-top: 20px">
                            <div id="forReview" class="tab-pane fade in active">
                                <table id="banking_table" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Date</th>
                                        <th>Description</th>
                                        <th>Payee</th>
                                        <th>Category or Match</th>
                                        <th>Spent</th>
                                        <th>Received</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><input type="checkbox"></td>
                                        <td>06/29/2020</td>
                                        <td>CHECK #2701 2701</td>
                                        <td>Mike Bell Jr</td>
                                        <td></td>
                                        <td>$320</td>
                                        <td></td>
                                        <td><a href="">View</a></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div id="reviewed" class="tab-pane fade">
                                <h3>Menu 1</h3>
                                <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                            </div>
                            <div id="excluded" class="tab-pane fade">
                                <h3>Menu 2</h3>
                                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
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
        $('#banking_table').DataTable();
    } );
    $('.banking-sub-tab').click(function(){
        $(this).parent().addClass('banking-sub-active').siblings().removeClass('banking-sub-active')
    });

    $(document).ready(function(){
        $(".nav-tabs a").click(function(){
            $(this).tab('show');
        });
    });

</script>


