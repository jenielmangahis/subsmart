<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header_setting'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/setting'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title">Online Payments</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Please select the online preferred payment method. Once the setup is completed, your payment status will be tracked and updated automatically.</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card" style="min-height: 400px !important;">       
                        
                        <div class="card">
                            <table class="table table-hover table-to-list fix-reponsive-table" data-id="work_orders">
                                <thead>
                                    <tr>
                                        <th><strong>Payment Method</strong></th>
                                        <th><strong>Setup</strong></th>
                                        <th><strong>Active</strong></th>
                                        <th>-</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td data-title="Payment Method">
                                            <p>Paypal</p>
                                            <div class="text-ter">Online Transaction Fees: as set by PayPal </div>
                                        </td>
                                        <td data-title="Setup">
                                                            Not set
                                                        </td>
                                        <td data-title="Active">
                                                        Yes</td>
                                        <td class="text-right" data-title="">
                                            <a class="btn btn-primary btn-md" href="javascript:void(0);">Setup</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td data-title="Payment Method">
                                            <p>Square</p>
                                            <div class="text-ter">Online Transaction Fees: as set by Square, Instant Deposit is available </div>
                                        </td>
                                        <td data-title="Setup">
                                                            Not set
                                                        </td>
                                        <td data-title="Active">
                                                        Yes</td>
                                        <td class="text-right" data-title="">
                                            <a class="btn btn-primary btn-md" href="javascript:void(0);">Setup</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td data-title="Payment Method">
                                            <p>WePay</p>
                                            <div class="text-ter">Online Transaction Fees: 2.9% + $0.30 </div>
                                        </td>
                                        <td data-title="Setup">
                                                            Not set
                                                        </td>
                                        <td data-title="Active">
                                                        Yes</td>
                                        <td class="text-right" data-title="">
                                            <a class="btn btn-primary btn-md" href="javascript:void(0);">Setup</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>                                             

                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer'); ?>