<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style>
.page-title, .box-title {
  font-family: Sarabun, sans-serif !important;
  font-size: 1.75rem !important;
  font-weight: 600 !important;
  padding-top: 5px;
}
.pr-b10 {
  position: relative;
  bottom: 10px;
}
.p-40 {
  padding-top: 40px !important;
}
.p-20 {
  padding-top: 5px !important;
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
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/schedule'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid p-40">
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card p-20" style="min-height: 400px !important;">
                      <div class="row">
                        <div class="col-sm-6 left">
                          <h3 class="page-title mt-0"><i class="fa fa-edit"></i> Edit Color</h3>
                        </div>
                      </div>
                      <div class="alert alert-warning mt-1 mb-4" role="alert">
                          <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">
                            Edit color for your events and job types
                          </span>
                      </div>
                      <br />
                      <?php include viewPath('flash'); ?>
                      <?php echo form_open_multipart('color_settings/update_color_setting', [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
                        <input type="hidden" name="cid" value="<?= $colorSetting->id; ?>">
                        <div class="form-group">
                            <label>Name</label> <span class="form-required">*</span>
                            <input type="text" name="color_name" value="<?= $colorSetting->color_name; ?>"  class="form-control" required="" autocomplete="off" />
                        </div>
                        <div class="form-group">
                            <label>Color Code</label> <span class="form-required">*</span>
                            <input type="text" name="color_code" value="<?= $colorSetting->color_code; ?>" class="form-control colorpicker" required="" autocomplete="off">
                        </div>

                        <div class="col-md-">                          
                          <button type="submit" class="btn btn-primary">Save</button>
                          <a class="btn btn-default" href="<?php echo base_url('color_settings/index'); ?>">Cancel</a>
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
<script>
$(function(){
  $('.colorpicker').colorpicker();
});
</script>
