<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/schedule'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title"><i class="fa fa-plus"></i> Edit Color</h1>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card" style="min-height: 400px !important;">
                        <hr />
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