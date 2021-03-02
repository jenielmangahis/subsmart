<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style>
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
    <?php include viewPath('includes/sidebars/events'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title"><i class="fa fa-edit"></i> Edit Event Tag</h1>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card" style="min-height: 400px !important;">
                        <hr />
                        <?php include viewPath('flash'); ?>
                        <?php echo form_open_multipart('events/update_event_tag', [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
                          <input type="hidden" name="default_icon_id" id="default-icon-id" value="">
                          <input type="hidden" name="tid" value="<?= $eventTag->id; ?>">
                          <div class="form-group">
                              <label>Event Tag Name</label> <span class="form-required">*</span>
                              <input type="text" name="event_tag_name" value="<?= $eventTag->name; ?>"  class="form-control" required="" autocomplete="off" />
                          </div>
                          <div class="form-group">
                              <label>Icon / Marker</label> <span class="form-required">*</span><br />
                              <?php 

                              ?>
                              <input type="file" name="image" value=""  class="form-control" id="input-upload-image" style="width: 20%;display: inline-block;" autocomplete="off" />
                              <input type="text" name="default-icon-name" disabled="" value="<?= $eventTag->marker_icon; ?>" class="form-control" style="width: 20%;display: inline-block;" id="icon-pick-name"><br />
                              <div class="form-check" style="margin-top: 10px;">
                                <?php 
                                  $is_list = "";
                                  if( $eventTag->is_marker_icon_default_list == 1 ){
                                    $is_list = 'checked="checked"';
                                  }
                                ?>
                                <input class="form-check-input" <?= $is_list; ?> type="checkbox" name="is_default_icon" value="1" id="iconList">
                                <label class="form-check-label" for="iconList">
                                  Pick from list
                                </label>
                              </div>
                          </div>                          
                          <div class="" style="margin-top: 78px;">
                            <a class="btn btn-default" href="<?php echo base_url('events/event_tags'); ?>">Cancel</a>
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
  <?php if( $eventTag->is_marker_icon_default_list == 1 ){ ?>
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