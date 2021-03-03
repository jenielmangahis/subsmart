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
                          <input type="hidden" name="default_icon_id" id="default-icon-id" value="">
                          <div class="form-group">
                              <label>Event Type Name</label> <span class="form-required">*</span>
                              <input type="text" name="title" value=""  class="form-control" required="" autocomplete="off" />
                          </div>
                          <div class="form-group">
                              <label>Icon / Marker</label> <span class="form-required">*</span><br />
                              <input type="file" name="image" value=""  class="form-control" id="input-upload-image" style="width: 20%;display: inline-block;" autocomplete="off" />
                              <input type="text" name="default-icon-name" disabled="" value="" class="form-control" style="width: 20%;display: inline-block;" id="icon-pick-name"><br />
                              <div class="form-check" style="margin-top: 10px;">
                                <input class="form-check-input" type="checkbox" name="is_default_icon" value="1" id="iconList">
                                <label class="form-check-label" for="iconList">
                                  Pick from list
                                </label>
                              </div>
                          </div>
                          <div class="col-md-">
                            <a class="btn btn-default" href="<?php echo base_url('event_types/index'); ?>">Cancel</a>
                            <button type="submit" class="btn btn-primary">Submit</button>
                          </div>
                      </div>
                      <?php echo form_close(); ?>
                    </div>

                    <div class="modal fade" id="modalIconList" tabindex="-1" role="dialog" aria-labelledby="modalIconListLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
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
                      </div>
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
  $("#icon-pick-name").hide();
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
