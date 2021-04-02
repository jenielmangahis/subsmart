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
.pr-b10 {
  position: relative;
  bottom: 10px;
}
.p-40 {
  padding-top: 40px !important;
}
.p-20 {
  padding-top: 30px !important;
  padding-bottom: 25px !important;
  padding-right: 20px !important;
  padding-left: 20px !important;
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
.card-help {
    padding-left: 45px;
    padding-top: 10px;
}
.text-ter {
    color: #888888;
}
.card-type.visa {
    background-position: 0 0;
}
.card-type {
    display: inline-block;
    width: 30px;
    height: 20px;
    background: url(<?= base_url("/assets/img/credit_cards.png"); ?>) no-repeat 0 0;
    background-size: cover;
    vertical-align: middle;
    margin-right: 10px;
}
.card-type.americanexpress {
    background-position: -83px 0;
}
.expired{
  color:red;
}
.card-type.discover {
    background-position: -125px 0;
}
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/job'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid p-40">
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card p-20" style="min-height: 400px !important;">
                      <div class="row">
                        <div class="col-sm-6 left">
                          <h3 class="page-title mt-0">Checklists</h3>
                        </div>
                        <div class="col-sm-6 right dashboard-container-1">
                            <div class="text-right">
                                <a class="btn btn-primary" href="<?php echo base_url('job_checklists/add_new'); ?>"><i class="fa fa-plus"></i> Add New</a>
                            </div>
                        </div>
                      </div>
                      <div class="alert alert-warning mt-1 mb-4" role="alert">
                          <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Create great check list for employees or subcontractor to follow a series of item listings to meet all of your company’s requirements, expectations or reminders. This can be attached to estimate, workorder, invoices. A powerful addition to your forms.
                          </span>
                      </div>
                        <?php include viewPath('flash'); ?>
                        <table class="table table-hover" data-id="coupons">
                            <thead>
                                <tr>
                                    <th style="width: 40%;">Name</th>
                                    <th style="width: 10%;"></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->

        <!-- Modal Delete Addon  -->
        <div class="modal fade bd-example-modal-sm" id="modalDeleteCard" tabindex="-1" role="dialog" aria-labelledby="modalDeleteCardTitle" aria-hidden="true">
          <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-trash"></i> Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <?php echo form_open_multipart('cards_file/delete_card', ['id' => 'delete-card', 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
              <?php echo form_input(array('name' => 'cid', 'type' => 'hidden', 'value' => '', 'id' => 'cid'));?>
              <div class="modal-body">
                  <p>Delete selected card?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <button type="submit" class="btn btn-danger btn-delete-card">Yes</button>
              </div>
              <?php echo form_close(); ?>
            </div>
          </div>
        </div>

    </div>
    <!-- page wrapper end -->
</div>


<script type="text/javascript">
$(function(){
    
});
</script>
<?php include viewPath('includes/footer'); ?>
