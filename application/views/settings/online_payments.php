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
                        <?php include viewPath('flash'); ?>
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
                                        <?php 
                                            if( $setting['is_active'] == 1 ){
                                                $is_active = 'YES';
                                                $is_setup = 'YES';
                                            }else{
                                                $is_active = 'NO';
                                                $is_setup = 'NOT SET';
                                            }
                                        ?>
                                        <td data-title="Payment Method">
                                            <img class="img-responsive" style="max-width: 200px;" data-fileupload="image-logo" src="<?php echo $url->assets ?>img/paypal-logo.png">
                                            <div class="text-ter">Online Transaction Fees: as set by PayPal </div>
                                        </td>
                                        <td><?= $is_setup; ?></td>
                                        <td><?= $is_active; ?></td>
                                        <td class="text-right" data-title="">
                                            <a class="btn btn-primary btn-md" href="#setupPaypalModal" data-toggle="modal" data-target="#setupPaypalModal">Setup</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td data-title="Payment Method">
                                            <img class="img-responsive" style="max-width: 200px;" data-fileupload="image-logo" src="<?php echo $url->assets ?>img/square-payment.png">
                                            <div class="text-ter">Online Transaction Fees: as set by Square, Instant Deposit is available </div>
                                        </td>
                                        <td data-title="Setup">NOT SET</td>
                                        <td data-title="Active">NO</td>
                                        <td class="text-right" data-title="">
                                            <a class="btn btn-primary btn-md" href="#setupSqaureModal" data-toggle="modal" data-target="#setupSqaureModal">Setup</a>
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
<?php include viewPath('includes/settings_modal'); ?>
<?php include viewPath('includes/footer'); ?>