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
                        <div class="row">
                          <div class="col-sm-6 left">
                            <h3 class="page-title">Deals & Steals</h3>
                          </div>
                          <div class="col-sm-6 right dashboard-container-1">
                              <div class="text-right">
                                  <a href="<?php echo url('sms_campaigns/add_sms_blast') ?>" class="btn btn-primary btn-md"><i class="fa fa-plus"></i> Create Deal</a><br />
                              </div>
                          </div>
                        </div>
                        <div class="alert alert-warning mt-2 mb-4" role="alert">
                            <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Listing the deals that are currently running.
                            </span>
                        </div>
                        <?php include viewPath('flash'); ?>
                        <!-- Main content -->
                        <section class="content">
                            <div class="tabs mt-2">
                                <ul class="clearfix ul-mobile" id="myTab" role="tablist">
                                        <li class="nav-item nav-all active">
                                            <a class="nav-link" id="c-all-tab" data-toggle="tab" href="#all-campaigns" role="tab" aria-controls="One" aria-selected="true">Active Deals <span class="sms-total-all sms-tab-counter"></span></a>
                                        </li>
                                        <li class="nav-item nav-scheduled">
                                            <a class="nav-link" id="c-scheduled-tab" data-toggle="tab" href="#scheduled-campaigns" role="tab" aria-controls="Two" aria-selected="false">Scheduled <span class="sms-total-scheduled sms-tab-counter"></span></a>
                                        </li>
                                        <li class="nav-item nav-closed">
                                            <a class="nav-link" id="c-closed-tab" data-toggle="tab" href="#closed-campaigns" role="tab" aria-controls="Three" aria-selected="false">Ended <span class="sms-total-closed sms-tab-counter"></span></a>
                                        </li>
                                        <li class="nav-item nav-draft">
                                            <a class="nav-link" id="c-draft-tab" data-toggle="tab" href="#draft-campaigns" role="tab" aria-controls="Three" aria-selected="false">Draft <span class="sms-total-draft sms-tab-counter"></span></a>
                                        </li>
                                </ul>
                            </div>
                            <div class="campaign-list-container"></div>
                        </section>
                        <!-- /.content -->
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end row -->

            <!-- Modal Close SMS  -->
            <div class="modal fade bd-example-modal-sm" id="modalCloseCampaign" tabindex="-1" role="dialog" aria-labelledby="modalCloseCampaignTitle" aria-hidden="true">
              <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-trash"></i> Close</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <?php echo form_open_multipart('', ['class' => 'form-validate', 'id' => 'form-close-campaign', 'autocomplete' => 'off' ]); ?>
                  <?php echo form_input(array('name' => 'smsid', 'type' => 'hidden', 'value' => '', 'id' => 'smsid'));?>
                  <div class="modal-body close-body-container">
                      <p>Are you sure you want close the campaign <b><span class="close-campaign-name"></span></b>?</p>
                  </div>
                  <div class="modal-footer close-modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-danger btn-close-campaign">Yes</button>
                  </div>
                  <?php echo form_close(); ?>
                </div>
              </div>
            </div>

            <!-- Modal Clone SMS  -->
            <div class="modal fade bd-example-modal-sm" id="modalCloneCampaign" tabindex="-1" role="dialog" aria-labelledby="modalCloneCampaignTitle" aria-hidden="true">
              <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-files-o icon"></i> Clone</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <?php echo form_open_multipart('', ['class' => 'form-validate', 'id' => 'form-clone-campaign', 'autocomplete' => 'off' ]); ?>
                  <?php echo form_input(array('name' => 'smsid', 'type' => 'hidden', 'value' => '', 'id' => 'clone-smsid'));?>
                  <div class="modal-body clone-body-container">
                      <p>Are you sure you want clone the campaign <b><span class="clone-campaign-name"></span></b>?</p>
                  </div>
                  <div class="modal-footer clone-modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary btn-clone-campaign">Yes</button>
                  </div>
                  <?php echo form_close(); ?>
                </div>
              </div>
            </div>

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
