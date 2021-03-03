<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style>
.marker-icon{
  height: 100px;
  margin: 30px 0px;
}
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
    <?php include viewPath('includes/sidebars/events'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid p-40">
          <!--
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title"><i class="fa fa-edit"></i> Edit Event Type</h1>
                    </div>
                </div>
            </div>
          -->
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card p-20" style="min-height: 400px !important;">
                        <h3 class="page-title mb-0"><i class="fa fa-edit"></i> Edit Event Type</h3>
                        <hr />
                        <?php include viewPath('flash'); ?>
                        <?php echo form_open_multipart('event_types/update', [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
                          <input type="hidden" name="eid" value="<?= $eventType->id; ?>">
                          <div class="form-group">
                              <label>Name</label> <span class="form-required">*</span>
                              <input type="text" name="title" value="<?= $eventType->title; ?>"  class="form-control" required="" autocomplete="off" />
                          </div>
                          <div class="form-group">
                              <?php
                                if( $eventType->icon_marker != '' ){
                                  $url = base_url('uploads/event_types/' . $eventType->company_id . '/' . $eventType->icon_marker);
                                }else{
                                  $url = base_url('uploads/event_types/no_file.png');
                                }
                              ?>

                              <label>Icon / Marker</label> <span class="form-required"></span>
                              <img src="<?= $url; ?>" class="marker-icon" />
                              <input type="file" name="image" value=""  class="form-control"  autocomplete="off" />
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
<script>
$(function(){
  $('.colorpicker').colorpicker();
});
</script>
