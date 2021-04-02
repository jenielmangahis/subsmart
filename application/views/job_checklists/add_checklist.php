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
                        <h3 class="page-title mb-0"><i class="fa fa-plus"></i> Add New</h3>
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
                        <?php echo form_open_multipart('job_checklists/create_checklist', [ 'class' => 'form-validate checklist-form', 'autocomplete' => 'off' ]); ?>
                          <div class="form-group">
                              <label>Checklist Name</label> <span class="form-required">*</span>
                              <input type="text" name="checklist_name" value=""  class="form-control" required="" autocomplete="off" />
                          </div>
                          <br />
                          <div class="form-group">
                              <label>Attach this checklist to all Job Orders for</label> <span class="form-required">*</span><br />
                              <small>Optional, select from the options below if this checklist will be automatically attached when you create a new Work Order.</small><br /><br />
                              <select class="form-control" id="attach-to-work-order" name="attach_to_job_order" required="">
                                <?php foreach($checklistAttachType as $key => $value){ ?>
                                    <option value="<?= $key; ?>"><?= $value; ?></option>
                                <?php } ?>
                              </select>
                          </div>                                                
                          <hr />
                          <div class="col-md-">
                            <a class="btn btn-default" href="<?php echo base_url('job_checklists/list'); ?>">Cancel</a>
                            <button type="submit" class="btn btn-primary">Save</button>
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
    $(".btn-add-checklist-item").click(function(){

    });
});
</script>