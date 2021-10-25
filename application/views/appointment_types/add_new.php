<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style>
.page-title {
  font-family: Sarabun, sans-serif !important;
  font-size: 1.75rem !important;
  font-weight: 600 !important;
}
.pr-b10 {
  position: relative;
  bottom: 10px;
}
.p-40 {
  padding-top: 40px !important;
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
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/schedule'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid p-40">
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card mt-0" style="min-height: 400px !important;">
                        <div class="row">
                          <div class="col-sm-6 left">
                            <h3 class="page-title"><i class="fa fa-plus"></i> Add New Appointment Type</h3>
                          </div>
                          <div class="col-sm-6 right dashboard-container-1">
                            <div class="float-right d-none d-md-block">
                                <div class="dropdown">
                                        <a href="<?php echo url('appointment_types/index') ?>" class="btn btn-primary" aria-expanded="false">
                                            <i class="mdi mdi-settings mr-2"></i> Go Back to Appointment Type list
                                        </a>
                                </div>
                            </div>
                          </div>
                        </div>
                        <div class="alert alert-warning mt-2 mb-0" role="alert">
                            <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Create new appointment type.
                            </span>
                        </div>
                        <hr/>
                        <?php include viewPath('flash'); ?>
                        <?php echo form_open_multipart('appointment_types/create_appointment_type', [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>

                          <div class="form-group">
                              <label>Name</label> <span class="form-required">*</span>
                              <input type="text" name="appointment_type_name" value=""  class="form-control" required="" autocomplete="off" />
                          </div>
                          <div class="col-md-">
                            <a class="btn btn-default" href="<?php echo base_url('appointment_types/index'); ?>">Cancel</a>
                            <button type="submit" class="btn btn-primary">Submit</button>
                          </div>
                      </div>
                      <?php echo form_close(); ?>
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
