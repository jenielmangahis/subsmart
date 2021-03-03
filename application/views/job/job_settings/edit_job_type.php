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
.marker-icon{
  height: 100px;
  margin: 30px 0px;
  border: 1px solid #363636;
  padding: 10px;
} 
.list-icon{
  list-style: none;
  height: 400px;
  overflow: auto;
  padding: 6px;
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
    <?php include viewPath('includes/sidebars/job'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <!-- <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title"><i class="fa fa-edit"></i> Edit Job Type</h1>
                    </div>
                </div>
            </div> -->
            <!-- end row -->
           <div class="row">
                <div class="col-xl-12">
                    <div class="card p-20" style="min-height: 400px !important;">
                        <h3 class="page-title mb-0"><i class="fa fa-edit"></i> Edit Job Type</h3>
                        <hr />
                        <?php include viewPath('flash'); ?>
                        <?php echo form_open_multipart('job/update_job_type', [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
                          <input type="hidden" name="eid" value="<?= $jobType->id; ?>">
                          <input type="hidden" name="default_icon_id" id="default-icon-id" value="">
                          <div class="form-group">
                              <label>Name</label> <span class="form-required">*</span>
                              <input type="text" name="job_type_name" value="<?= $jobType->title; ?>"  class="form-control" required="" autocomplete="off" />
                          </div>
                          <div class="form-group">
                              <label>Icon / Marker</label> <span class="form-required">*</span><br />
                              <?php 
                                if( $jobType->icon_marker != '' ){
                                  if( $jobType->is_marker_icon_default_list == 1 ){
                                    $image_url = base_url('uploads/icons/'. $jobType->icon_marker);
                                  }else{
                                    $image_url = base_url('uploads/job_types/' . $jobType->company_id . '/' . $jobType->icon_marker);
                                  }
                                }else{
                                  $image_url = base_url('uploads/job_types/no_file.png');
                                }
                              ?>
                              <img src="<?= $image_url; ?>" class="marker-icon" />

                              <input type="file" name="image" value=""  class="form-control" id="input-upload-image" style="width: 20%;display: inline-block;" autocomplete="off" />
                              <input type="text" name="default-icon-name" disabled="" value="<?= $jobType->icon_marker; ?>" class="form-control" style="width: 20%;display: inline-block;" id="icon-pick-name"><br />
                              <div class="form-check" style="margin-top: 10px;">
                                <?php 
                                  $is_list = "";
                                  if( $jobType->is_marker_icon_default_list == 1 ){
                                    $is_list = 'checked="checked"';
                                  }
                                ?>
                                <input class="form-check-input" <?= $is_list; ?> type="checkbox" name="is_default_icon" value="1" id="iconList">
                                <label class="form-check-label" for="iconList">
                                  Pick from list
                                </label>
                              </div>
                          </div>  
                          <div class="col-md-">
                            <a class="btn btn-default" href="<?php echo base_url('job/job_types'); ?>">Cancel</a>
                            <button type="submit" class="btn btn-primary">Submit</button>
                          </div>
                      </div>
                      <?php echo form_close(); ?>
                    </div>
                    <!-- end card -->

                    <div class="modal fade" id="modalIconList" tabindex="-1" role="dialog" aria-labelledby="modalIconListLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                          <form id="form_add_tag">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Icon List</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                      </button>
                                  </div>
                                  <div class="modal-body">
                                      <div class="col-md-12">
                                          <div class="row">
                                              <ul class="list-icon">
                                                <?php foreach($icons as $i){ ?>
                                                  <li>
                                                    <a href="javascript:void(0);" data-name="<?= $i->image; ?>" data-id="<?= $i->id; ?>" class="a-icon hvr-float-shadow hvr-icon-bounce">
                                                      <img src="<?= base_url('uploads/icons/' . $i->image); ?>" class="icon-image hvr-icon">
                                                    </a>
                                                  </li>
                                                <?php } ?>
                                              </ul>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </form>
                      </div>
                  </div>

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
  <?php if( $jobType->is_marker_icon_default_list == 1 ){ ?>
    $("#input-upload-image").hide();
  <?php }else{ ?>
    $("#icon-pick-name").hide();
  <?php } ?>
  
  $(".a-icon").click(function(){
    var icon_name = $(this).attr("data-name");
    var icon_id   = $(this).attr("data-id");

    $("#input-upload-image").hide();
    $("#icon-pick-name").show();
    $("#icon-pick-name").val(icon_name);
    $("#modalIconList").modal('hide');
    $("#default-icon-id").val(icon_id);
  });

  $("#iconList").change(function(){
    if ($(this).is(':checked')) {
      $("#modalIconList").modal('show');
    }else{
      $("#input-upload-image").show();
      $("#icon-pick-name").hide();
      $("#default-icon-id").val("");
    }
  });
});
</script>