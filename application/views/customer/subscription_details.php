<?php
defined('BASEPATH') or exit('No direct script access allowed');
add_css(array(
    'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css',
    'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css',
));
?>

<?php include viewPath('includes/header'); ?>
<?php include viewPath('customer/css/add_advance_css'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/customer'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid p-40">

            <div class="card">
                <div class="row pl-0 pr-0">
                    <div class="col-md-12 pl-0 pr-0">
                        <div class="col-md-12 pr-3" style="padding-left: 15px;">
                            <h3 class="page-title mt-0">Subscription Payment Details</h3>
                            <div class="pl-3 pr-3 mt-1 row">
                                <div class="col mb-4 left alert alert-warning mt-0 mb-2">
                                  <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">
                                      Make it easy for your customers by offering additional ways to pay.  The payments landscape is ever-changing.
                                      Simply select the payment method and hit the button to Pre-Auth Now or Capture Now  the payment.
                                      Each transaction will be saved in each customer history.
                                  </span>
                                </div>
                            </div>
                            <div class="row pl-0 pr-0">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <span style="position: absolute;right: 0;margin-right: 25px;font-size: 20px;padding-top:10px;" class="fa fa-ellipsis-v"></span>
                                            <h6 ><span class="fa fa-user"></span>&nbsp; &nbsp;Customer Information</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="row form_line">
                                                <div class="col-md-4">
                                                    <b>Account ID</b>
                                                </div>
                                                <div class="col-md-6">
                                                    <?= $alarm_data->monitor_id; ?>
                                                </div>
                                            </div>
                                            <div class="row form_line">
                                                <div class="col-md-4">
                                                    <b >Customer Name </b>
                                                </div>
                                                <div class="col-md-6">
                                                    <?= $profile_info->last_name. ', '.$profile_info->first_name ;  ?>
                                                </div>
                                            </div>
                                            <div class="row form_line">
                                                <div class="col-md-4">
                                                    <b>Address </b>
                                                </div>
                                                <div class="col-md-8">
                                                    <?= $profile_info->mail_add;  ?>
                                                </div>
                                            </div>
                                            <div class="row form_line">
                                                <div class="col-md-4">
                                                    <b>City State Zip</b>
                                                </div>
                                                <div class="col-md-8">
                                                    <?= $profile_info->city . ', '. $profile_info->state . ' ' .$profile_info->zip_code  ;  ?>
                                                </div>
                                            </div>
                                            <br><br>
                                            <div class="row form_line">
                                                <div class="col-md-4">
                                                    <?php $method = bill_methods($subscription_details->method); ?>
                                                    <input type="text" class="form-control" readonly value="<?= $method['description'];  ?>" />
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="text" class="form-control" readonly value="$<?= $subscription_details->total_amount;  ?>" />
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="text" class="form-control" readonly value="<?= $subscription_details->transaction_type;  ?>" />
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row form_line">
                                                <div class="col-md-4">
                                                    <b>Transaction Date</b>
                                                </div>
                                                <div class="col-md-6">
                                                    <?= date("d-m-Y h:i A",strtotime($subscription_details->datetime)); ?>
                                                </div>
                                            </div>
                                            <div class="row form_line">
                                                <div class="col-md-4">
                                                    <b>Transaction Id</b>
                                                </div>
                                                <div class="col-md-6">
                                                    <?= $subscription_details->id; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h6 ><span class="fa fa-money"></span>&nbsp; &nbsp;Transaction Information</h6>
                                        </div>
                                        <div class="card-body">
                                            <form id="pay_billing" method="post">
                                                <div class="row form_line">
                                                    <div class="col-md-4"> <b>Billing Method</b> </div>
                                                    <div class="col-md-8">
                                                        <?= $method['description'];  ?>
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-4"> <b>Transaction Type</b> </div>
                                                    <div class="col-md-8">
                                                        <?= $subscription_details->transaction_type;  ?>
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-4"> <b>Billing Frequency</b> </div>
                                                    <div class="col-md-8">
                                                        <?= $subscription_details->frequency;  ?>
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-4"> <b>Billing Category</b> </div>
                                                    <div class="col-md-8">
                                                        <?php $transaction_category = transaction_categories($subscription_details->category); ?>
                                                        <?= $transaction_category['description'];  ?>
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-4"> <b>Transaction Amount</b> </div>
                                                    <div class="col-md-8">
                                                        <?= $subscription_details->total_amount;  ?>
                                                    </div>
                                                </div>

                                                <div class="row form_line">
                                                    <div class="col-md-4"> <b>Note</b> </div>
                                                    <div class="col-md-8">
                                                        <?= $subscription_details->notes;  ?>
                                                    </div>
                                                </div>
                                                <br><br>
                                                <button type="button" class="btn btn-primary">Refund Transaction</button>
                                                <button type="button" class="btn btn-primary">Void Transaction</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end container-fluid -->
        <?php include viewPath('includes/footer'); ?>