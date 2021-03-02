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
<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/events'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid p-40">
            <!--
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title"><i class="fa fa-plus"></i> Add New Event Type</h1>
                    </div>
                </div>
            </div> -->
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card p-20" style="min-height: 400px !important;">
                        <h3 class="page-title mb-0"><i class="fa fa-plus"></i> Add New Event Type</h3>
                        <hr />
                        <?php include viewPath('flash'); ?>
                        <?php echo form_open_multipart('event_types/save', [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>

                          <div class="form-group">
                              <label>Event Type Name</label> <span class="form-required">*</span>
                              <input type="text" name="title" value=""  class="form-control" required="" autocomplete="off" />
                          </div>
                          <div class="form-group">
                              <img src="" />
                              <label>Icon / Marker</label> <span class="form-required">*</span>
                              <input type="file" name="image" value=""  class="form-control" required="" autocomplete="off" />
                          </div>
                          <div class="col-md-">
                            <a class="btn btn-default" href="<?php echo base_url('event_types/index'); ?>">Cancel</a>
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
