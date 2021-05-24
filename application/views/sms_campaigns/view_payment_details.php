<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style>
.page-title {
  font-family: Sarabun, sans-serif !important;
  font-size: 1.75rem !important;
  font-weight: 600 !important;
}
.cell-inactive{
    background-color: #d9534f;
}
.left {
  float: left;
}
.pr-b10 {
  position: relative;
  bottom: 10px;
}
.p-40 {
  padding-top: 40px !important;
}
.tabs-menu {
    margin-bottom: 20px;
    padding: 0;
    margin-top: 20px;
}
.tabs-menu ul {
    list-style: none;
    margin: 0;
    padding: 0;
}
.md-right {
  float: right;
  width: max-content;
  display: block;
  padding-right: 0px;
}
.tabs-menu .active, .tabs-menu .active a {
    color: #2ab363;
}
.tabs-menu li {
    float: left;
    margin: 0;
    padding: 0px 83px 0px 0px;
    font-weight: 600;
    font-size: 17px;
}
.input-group-addon {
    padding: 13px 13px;
    font-size: 14px;
    font-weight: 400;
    line-height: 1;
    color: #555;
    text-align: center;
    background-color: #eee;
    border: 1px solid #ccc;
    border-radius: 4px;
}
.input-group-addon, .input-group-btn {
    /*width: 1%;*/
    white-space: nowrap;
    vertical-align: middle;
}
.input-group .form-control, .input-group-addon, .input-group-btn {
    display: table-cell;
}
.table-payment-details{
  font-size: 18px;
}
.table-payment-details td{
  padding: 6px 8px !important;
}
.table-no-border{
  border: none;
}
.table-no-border td{
  border: none;
}
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/marketing'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid p-40">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card mt-0">
                        <section class="content">
                            <div class="row">
                          <div class="col-sm-6 left">
                            <h3 class="page-title">SMS Campaign Payment</h3>
                          </div>
                          <div class="col-sm-6 right dashboard-container-1">
                            <div class="float-right d-none d-md-block">
                                <div class="dropdown">
                                  <a class="btn btn-primary" href="<?php echo url('sms_campaigns/order_pdf/' . $smsCampaign->id) ?>" target="_new" style="margin-right: 10px;">PDF Order</a>
                                    <a class="btn btn-primary" href="<?php echo url('sms_campaigns/invoice_pdf/' . $smsCampaign->id) ?>" target="_new" style="margin-right: 10px;">PDF Invoice</a>
                                    <a class="btn btn-primary" href="<?php echo url('sms_campaigns') ?>" style="margin-right: 10px;">Back to list</a>
                                </div>
                            </div>
                          </div>
                        </div>
                        <div class="alert alert-warning mt-2 mb-0" role="alert">
                            <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">SMS campaign payment details</span>
                        </div>
                        <br />

                        <div class="card-body">
                            <table class="table table-no-border table-payment-details">
                              <tr>
                                <td colspan="2"><h4 style="font-size: 31px;margin-bottom: 37px;">Order # <?= $smsCampaign->order_number; ?></h4></td>
                              </tr>
                              <tr>
                                <td style="width:200px;">Date:</td>
                                <td><?= date("d-M-Y H:i", strtotime($orderPayments->date_paid)); ?></td>
                              </tr>
                              <tr>
                                <td style="width:200px;">Status:</td>
                                <td><?= $orderPayments->status; ?></td>
                              </tr>
                              <tr>
                                <td style="width:200px;">Payment Method:</td>
                                <td><?= $orderPayments->payment_method; ?></td>
                              </tr>
                              <tr>
                                <td style="width:200px;">Customer:</td>
                                <td><?= $company->business_name; ?></td>
                              </tr>
                            </table>
                            <table class="table table-payment-details">
                              <tr>
                                <td style="width:100px;font-weight: bold;">Item</td>
                                <td style="width:50px;font-weight: bold;">Qty</td>
                                <td style="width:300px;font-weight: bold;">Details</td>
                                <td style="width:50px;font-weight: bold;text-align: right;">Subtotal</td>
                              </tr>
                              <tr>
                                <td>SMS Campaign</td>
                                <td>1</td>
                                <td>
                                  <span>Campaign Name : <?= $smsCampaign->campaign_name; ?></span><br />
                                  <span>Send Date : <?= date("d-M-Y g:i A",strtotime($smsCampaign->send_date . ' ' . $smsCampaign->send_time)); ?></span>
                                </td>
                                <td style="text-align: right;">
                                  $<?= number_format($smsCampaign->total_price, 2); ?>
                                </td>
                              </tr>
                              <tr>
                                <td colspan="3" style="text-align: right;"><b>TOTAL</b></td>
                                <td colspan="3" style="text-align: right;"><b>$<?= number_format($smsCampaign->total_price, 2); ?></b></td>
                              </tr>
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
<script>
$(function(){
    
});
</script>
