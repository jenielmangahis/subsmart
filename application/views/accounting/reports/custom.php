<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style type="text/css">
    
</style>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/accounting/accounting'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <?php include viewPath('includes/notifications'); ?>
        <div class="container-fluid">
            <div class="page-title-box">

            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body hid-desk" style="padding-bottom:0px;">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3 class="page-title" style="margin: 0 !important">Reports</h3>
                                </div>
                                <div class="col-sm-12">
                                    <div class="alert alert-warning mt-4 mb-4" role="alert">
                                        <span style="color:black;">CRM reporting helps businesses in a few key ways: It can helps you distill what is happening in your business, a key advantage of deploying a CRM. Your data will help provides different ways to make strategic business decisions. Your management team can track performance and make tactical changes where necessary.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row pb-3">
                                <div class="col-md-12 banking-tab-container">
                                    <a href="<?php echo url('/accounting/reports')?>" class="banking-tab">Standard</a>
                                    <a href="<?php echo url('/accounting/reports/custom')?>" class="banking-tab-active text-decoration-none">Custom Reports</a>
                                    <a href="<?php echo url('/accounting/reports/management')?>" class="banking-tab">Management Reports</a>
                                    <a href="<?php echo url('/accounting/reports/activities')?>" class="banking-tab">Activities Reports</a>
                                    <a href="<?php echo url('/accounting/reports/analytics')?>" class="banking-tab">Analytics</a>
                                    <a href="<?php echo url('/accounting/reports/payscale')?>" class="banking-tab">PayScale</a>
                                </div>
                            </div>
                        </div>

                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">
                                <div class="px-4 pb-4">
                                    <table id="all_sales_table"
                                        class="table table-striped table-bordered w-100">
                                        <thead>
                                            <tr>
                                                <th>NAME</th>
                                                <th>CREATED</th>
                                                <th>DATE RANGE</th>
                                                <th>EMAIL</th>
                                                <th>ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>John Doe</td>
                                                <td>01-01-01</td>
                                                <td>09-09-09</td>
                                                <td>test@gmail.com</td>
                                                <td><a href="">View</a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
</div>


<!-- page wrapper end -->
<?php include viewPath('includes/footer_accounting'); ?>