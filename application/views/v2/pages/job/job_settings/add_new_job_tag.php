<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('v2/includes/header'); ?>

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
                            Add New Job Type
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 grid-mb">
        <?php include viewPath('flash'); ?>
        <!-- <?php //echo form_open_multipart('job/save_job_tag', [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?> -->
          <form method="post" id="tags_form">
            <input type="hidden" name="default_icon_id" id="default-icon-id" value="">
            <div class="form-group">
                <label>Job Tag Name</label> <span class="form-required">*</span>
                <input type="text" name="job_tag_name" value=""  class="form-control" required="" autocomplete="off" />
            </div>
            <div class="form-group">
                <label>Icon / Marker</label> <span class="form-required">*</span><br />
                <input type="file" name="image" value=""  class="form-control" id="input-upload-image" style="width: 20%;display: inline-block;" autocomplete="off" />
                <input type="text" name="default-icon-name" disabled="" value="" class="form-control" style="width: 20%;display: inline-block;" id="icon-pick-name"><br />
                <div class="form-check" style="margin-top: 10px;">
                <input class="form-check-input" type="checkbox" name="is_default_icon" value="1" id="iconList">
                <label class="form-check-label">
                    Pick from list
                </label>
                </div>
            </div>
            <div class="" style="margin-top: 78px;">
            <a class="nsm-button" href="<?php echo base_url('job/job_tags'); ?>">Cancel</a>
            <button type="submit" class="nsm-button primary">Submit</button>
            </div>
          </form>
        <!-- <?php //echo form_close(); ?> -->
    </div>
</div>
<?php include viewPath('v2/includes/footer'); ?>
<script>
  
$(function(){
  $("#tags_form").submit(function(e) {
    // const fd = new FormData();
    if(!$('#input-upload-image').val() && !$('#iconList').is(':checked')){
      e.preventDefault();
      info_alert('', 'Please attach file!', 'warning');
    }else{
      $.ajax({
          url:'<?php echo base_url();?>/job/save_job_tag',
          type:"post",
          data:new FormData(this),
          processData:false,
          contentType:false,
          cache:false,
          async:false,
          success: function(data){
              info_alert('', 'Upload Image Successful!', 'success', 1);
        }
      });
    }
  })
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
function info_alert(head, message, info, reload){
    Swal.fire({
        title: head,
        text: message,
        icon: info,
        showCancelButton: false,
        confirmButtonColor: '#32243d',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ok'
    })
    if(reload == 1){
      window.location.href='<?= base_url(); ?>job/job_tags';
    }
}

</script>
