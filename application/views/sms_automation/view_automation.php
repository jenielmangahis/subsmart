<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style>
.cell-active{
    background-color: #5bc0de;
}
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
img.event-marker {
    display: block;
    margin: 0 auto;
}
tr.odd {
    background: #f1f1f1 !important;
}
table.table tbody tr td {
    width: 15%;
    text-align: right;
}
table.table tbody tr td:first-child {
    width: 85%;
    text-align: left;
}
table.dataTable {
    border-collapse: collapse;
    margin-top: 5px;
}
table.dataTable thead tr th {
    border: 1px solid black !important;
}
table.dataTable tbody tr td {
    border: 1px solid black !important;
}
@media only screen and (max-width: 600px) {
  .p-40 {
    padding-top: 0px !important;
  }
  .pr-b10 {
    position: relative;
    bottom: 0px;
  }
}
.event-marker{
  height: 50px;
  width: 50px;
  border: 1px solid #dee2e6;
}
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/marketing'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid p-40">
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card mt-0" style="min-height: 400px !important;">
                        <!-- Main content -->
                        <section class="content">
                            <div class="row">
                          <div class="col-sm-6 left">
                            <h3 class="page-title">View SMS Automation</h3>
                          </div>
                          <div class="col-sm-6 right dashboard-container-1">
                            <div class="float-right d-none d-md-block">
                                <div class="dropdown">
                                  <a class="btn btn-primary" href="<?= url('sms_automation'); ?>">Back to list</a>
                                  <!-- <a class="btn btn-primary" href="<?= url('sms_automation/view_payment/' . $orderPayments->id); ?>">View Payment</a> -->
                                </div>
                            </div>
                          </div>
                        </div>
                        <div class="alert alert-warning mt-2 mb-0" role="alert">
                            <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">SMS automation details</span>
                        </div>
                        <br />
                        <div class="card-body">
                            <div class="row">
                              <div class="col-md-8 pl-0 pr-0 left" style="background-color: #ffffff !important;">
                                <div class="box">
                                  <div style="font-size:18px; font-weight: bold;margin-bottom: 10px;">Order Number</div>
                                  <input type="text" class="form-control" readonly="" disabled="" value="<?= $smsAutomation->order_number == '' ? '-' : $smsAutomation->order_number; ?>">
                                  <div style="font-size:18px; font-weight: bold;margin-bottom: 10px;">Automation Name</div>
                                  <input type="text" class="form-control" readonly="" disabled="" value="<?= $smsAutomation->automation_name; ?>">
                                  <div style="font-size:18px; font-weight: bold;margin-bottom: 10px;">Status</div>
                                  <input type="text" class="form-control" readonly="" disabled="" value="<?= $statusOptions[$smsAutomation->status]; ?>">
                                  <div style="font-size:18px; font-weight: bold;margin-bottom: 10px;">Customer Type</div>
                                  <input type="text" class="form-control" readonly="" disabled="" value="<?= $customerTypeOptions[$smsAutomation->business_customer_type_service]; ?>">
                                  <div style="font-size:18px; font-weight: bold;margin-bottom: 10px;">Rule Event</div>
                                  <input type="text" class="form-control" readonly="" disabled="" value="<?= $ruleNotifyOptions[$smsAutomation->rule_event] . " - " . $ruleNotifyAtOptions[$smsAutomation->rule_notify_at]; ?>">
                                  <div style="font-size:18px; font-weight: bold; margin-top: 30px;margin-bottom: 10px;">SMS Message</div>
                                  <textarea class="form-control" readonly="" disabled="" style="height: 100px;"><?= $smsAutomation->sms_text; ?></textarea> 
                                </div>
                              </div>
                            </div>
                        </div>
                      </section>
                        <!-- /.content -->
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
