<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('v2/includes/header'); ?>
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
    margin: 0px;
    margin-bottom: 10px;
    border: 1px solid lightgray;
    padding: 10px;
    border-radius: 10px;
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
.JOB_EDIT_LABEL{
    margin-bottom: 5px;
    }
    .JOB_EDIT_FORM_GROUP{
    margin-bottom: 10px;
    }
    .form-required {
    color: red;
    }
    #input-upload-image, #icon-pick-name {
        width: 300px;
        display: inline-block;
    }
</style>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/sales_tabs'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/job_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Edit Job Type
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <?php echo form_open_multipart('job/update_job_type', [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
                <input type="hidden" name="eid" value="<?= $jobType->id; ?>">
                <input type="hidden" name="default_icon_id" id="default-icon-id" value="">
                <div class="form-group JOB_EDIT_FORM_GROUP">
                    <label class="JOB_EDIT_LABEL">Name</label> <span class="form-required">*</span>
                    <input type="text" name="job_type_name" value="<?= $jobType->title; ?>"  class="form-control" required="" autocomplete="off" />
                </div>
                <div class="form-group">
                    <label class="JOB_EDIT_LABEL">Icon / Marker</label> <span class="form-required">*</span><br />
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
                    <img src="<?= $image_url; ?>" class="marker-icon" /><br>
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
                <hr>
                <div class="btn-group">
                    <a class="nsm-button" href="<?php echo base_url('job/job_types'); ?>">Cancel</a>
                    <button type="submit" class="nsm-button primary">Submit</button>
                </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<div class="modal fade" id="modalIconList" tabindex="-1" role="dialog" aria-labelledby="modalIconListLabel" aria-hidden="true">
    <div style="max-width: 1000px;" class="modal-dialog modal-lg" role="document">
        <form id="form_add_tag">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="modal-title content-title" id="exampleModalLongTitle">Add New Item</span>
                        <i onclick='$("#iconList").prop("checked", false);' class="bx bx-fw bx-x m-0 close" data-bs-dismiss="modal" aria-label="Close" style="cursor: pointer;"></i>
                        <!-- <button onclick='$("#iconList").prop("checked", false);' type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-fw bx-x m-0"></i></button> -->
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12">
                            <div class="row">
                                <ul class="list-icon">
                                    <?php foreach($icons as $i){ ?>
                                        <li> <a href="javascript:void(0);" data-name="<?= $i->image; ?>" data-id="<?= $i->id; ?>" class="a-icon hvr-float-shadow hvr-icon-bounce"><img src="<?= base_url('uploads/icons/' . $i->image); ?>" class="icon-image hvr-icon"></a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer modal-footer-detail">
                        <div class="button-modal-list">
                            <button onclick='$("#iconList").prop("checked", false);' type="button" class="nsm-button" data-bs-dismiss="modal"><span class="fa fa-remove"></span> Close</button>
                        </div>
                    </div>
                </div>
        </form>
        </div>
    </div>
<?php include viewPath('v2/includes/footer'); ?>
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