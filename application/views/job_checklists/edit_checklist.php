<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style>
.page-title {
    font-family: Sarabun, sans-serif !important;
    font-size: 1.75rem !important;
    font-weight: 600 !important;
}
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/job'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h3 class="page-title mb-0"><i class="fa fa-pencil"></i> Edit Checklist</h3>
                    </div>
                </div>
            </div>
            <div class="alert alert-warning mt-1 mb-4" role="alert">
                <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam</span>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card" style="min-height: 400px !important;">
                        <?php include viewPath('flash'); ?>
                        <?php echo form_open_multipart('job_checklists/update_checklist', [ 'class' => 'form-validate checklist-form', 'autocomplete' => 'off' ]); ?>
                            <input type="hidden" value="<?= $checklist->id; ?>" name="cid" id="checklist-cid" />
                            <div class="form-group">
                                <label>Checklist Name</label> <span class="form-required">*</span>
                                <input type="text" name="checklist_name" value="<?= $checklist->checklist_name; ?>"  class="form-control" required="" autocomplete="off" />
                            </div>
                            <br />
                            <div class="form-group">
                                <label>Attach this checklist to all Work Orders for</label> <span class="form-required">*</span><br />
                                <small>Optional, select from the options below if this checklist will be automatically attached when you create a new Work Order.</small><br /><br />
                                <select class="form-control" id="attach-to-work-order" name="attach_to_job_id" required="">
                                  <?php foreach($checklistAttachType as $key => $value){ ?>
                                      <option <?= $checklist->attach_to_job_id == $key ? 'selected="selected"' : ''; ?> value="<?= $key; ?>"><?= $value; ?></option>
                                  <?php } ?>
                                </select>
                            </div>
                            <br />
                            <div class="checklist-items">
                              <h5>Checklist Items</h5>
                              <a href="javascript:void(0);" class="btn-add-checklist-item"><span class="fa fa-plus-square fa-margin-right"></span> Add Item</a>
                              <div class="checklist-items-container"></div>
                            </div>                                                      
                            <div class="col-md-5" style="margin-top: 40px;padding-left: 0px;">
                              <a class="btn btn-default" href="<?php echo base_url('job_checklists/list'); ?>">Cancel</a>
                              <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        <?php echo form_close(); ?>

                        <!-- Modal Add Checklist Item --> 
                        <div class="modal fade bd-example-modal-lg" id="modalAddChecklistItem" tabindex="-1" role="dialog" aria-labelledby="modalAddChecklistItemTitle" aria-hidden="true">
                          <?php echo form_open_multipart('', [ 'class' => 'form-validate', 'id' => 'frm-add-checklist-item', 'autocomplete' => 'off' ]); ?>
                          <input type="hidden" value="<?= $checklist->id; ?>" name="cid" />
                          <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Add New Item</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <div class="row">
                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <label>Item Name</label>
                                      <input type="text" name="item_name" id="item_name" value="" class="form-control" autocomplete="off" required="">
                                    </div>
                                  </div>          
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add</button>
                              </div>
                            </div>
                          </div>
                          <?php echo form_close(); ?>
                        </div>

                        <!-- Modal Edit Checklist Item --> 
                        <div class="modal fade bd-example-modal-lg" id="modalEditChecklistItem" tabindex="-1" role="dialog" aria-labelledby="modalEditChecklistItemTitle" aria-hidden="true">
                          <?php echo form_open_multipart('', [ 'class' => 'form-validate', 'id' => 'frm-edit-checklist-item', 'autocomplete' => 'off' ]); ?>
                          <input type="hidden" value="<?= $checklist->id; ?>" name="cid" />
                          <input type="hidden" value="" name="edit_cheklist_item" id="chk-list-id">
                          <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Edit Item</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <div class="row">
                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <label>Item Name</label>
                                      <input type="text" name="edit_item_name" id="edit-item-name" value="" class="form-control" autocomplete="off" required="">
                                    </div>
                                  </div>          
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                              </div>
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
  
  load_checklist_items();

  $(".btn-add-checklist-item").click(function(){
    $("#modalAddChecklistItem").modal("show");
  });

  $("#modalAddChecklistItem").submit(function(e){
      e.preventDefault();
      var url = base_url + 'job_checklists/_create_checklist_item';
      setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             data: $("#frm-add-checklist-item").serialize(),
             dataType: 'json',
             success: function(o)
             {
                $("#item_name").val("");
                $("#modalAddChecklistItem").modal("hide");

                load_checklist_items();
             }
          });
      }, 300);
  });

  function load_checklist_items(){
      var msg = '<div class="alert alert-info" role="alert"><img src="'+base_url+'/assets/img/spinner.gif" style="display:inline-block;" /> Loading...</div>';
      var url = base_url + 'job_checklists/_load_checklist_items';
      var cid = $("#checklist-cid").val();

      $(".checklist-items-container").html(msg);

      setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             data: {cid:cid},
             success: function(o)
             {
                $(".checklist-items-container").html(o);

                $(".btn-edit-checklist-item").click(function(){                  
                  var eid = $(this).attr("data-id");
                  var item_name = $(this).attr("data-name");

                  $("#modalEditChecklistItem").modal("show");

                  $("#chk-list-id").val(eid);
                  $("#edit-item-name").val(item_name);
                });
                  
                /*$(".btn-delete-checklist-item").click(function(){
                  var url = base_url + 'job_checklists/_delete_checklist_items';
                  var eid = $(this).attr("data-id");
                  
                  setTimeout(function () {
                      $.ajax({
                         type: "POST",
                         url: url,
                         data: {eid:eid},
                         success: function(o)
                         {
                            load_checklist_items();
                         }
                      });
                  }, 1000);
                });*/

                $("#frm-edit-checklist-item").submit(function(e){
                  e.preventDefault();

                  var url = base_url + 'job_checklists/_update_checklist_item';
                  setTimeout(function () {
                      $.ajax({
                         type: "POST",
                         url: url,
                         data: $("#frm-edit-checklist-item").serialize(),
                         dataType: 'json',
                         success: function(o)
                         {
                            $("#modalEditChecklistItem").modal("hide");

                            load_checklist_items();
                         }
                      });
                  }, 300);

                });
             }
          });
      }, 500);
  }
  
  $(document).on('click', '.btn-delete-checklist-item', function(){
    var url = base_url + 'job_checklists/_delete_checklist_items';
      var eid = $(this).attr("data-id");
      
      setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             data: {eid:eid},
             success: function(o)
             {
                load_checklist_items();
             }
          });
      }, 1000);
  });
  
});
</script>