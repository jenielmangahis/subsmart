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
.list-icon{
  list-style: none;
  height: 400px;
  overflow: auto;
  padding: 6px;
}
.col-lnc {
  width: auto;
}
.list-icon li{
  display: inline-block;
  /*width: 30%;*/
  height:100px;
  margin: 3px;
}
.icon-image{
  height: 50px;
  width: 50px;
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
                        <h3 class="page-title mb-0"><i class="fa fa-plus"></i> Add New Color</h3>
                        <hr/>
                        <?php include viewPath('flash'); ?>
                        <?php echo form_open_multipart('color_settings/create_color_setting', [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>

                          <div class="form-group">
                              <label>Name</label> <span class="form-required">*</span>
                              <input type="text" name="color_name" value=""  class="form-control" required="" autocomplete="off" />
                          </div>
                          <div class="form-group">
                              <label>Color Code</label> <span class="form-required">*</span>
                              <input type="text" name="color_code" class="form-control colorpicker" required="" autocomplete="off">
                          </div>

                          <div class="col-md-">
                            <a class="btn btn-default" href="<?php echo base_url('color_settings/index'); ?>">Cancel</a>
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
<script>
$(function(){
  $('.colorpicker').colorpicker();
});
</script>
