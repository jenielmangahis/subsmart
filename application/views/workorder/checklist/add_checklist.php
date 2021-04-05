<?php include viewPath('includes/header'); ?>
<style>
.checklist-items{
    margin-top: 15px;
    margin-bottom: 51px;
}
.checklist-form .form-control{
    width: 50%;
}
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/workorder'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h3><i class="fa fa-plus"></i> Add Checklist</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Checklists</li>
                            <li class="breadcrumb-item active">Add</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card" style="min-height: 400px !important;">
                        <hr />
                        <?php include viewPath('flash'); ?>
                        <?php echo form_open_multipart('workorder/create_checklist', [ 'class' => 'form-validate checklist-form', 'autocomplete' => 'off' ]); ?>

                          <div class="form-group">
                              <label>Checklist Name</label> <span class="form-required">*</span>
                              <input type="text" name="checklist_name" value=""  class="form-control" required="" autocomplete="off" />
                          </div>
                          <br />
                          <div class="form-group">
                              <label>Attach this checklist to all Work Orders for</label> <span class="form-required">*</span><br />
                              <small>Optional, select from the options below if this checklist will be automatically attached when you create a new Work Order.</small><br /><br />
                              <select class="form-control" id="attach-to-work-order" name="attach_to_work_order" required="">
                                <?php foreach($checklistAttachType as $key => $value){ ?>
                                    <option value="<?= $key; ?>"><?= $value; ?></option>
                                <?php } ?>
                              </select>
                          </div>                      
                          <div class="col-md-5" style="padding: 0px;">
                            <a class="btn btn-default" href="<?php echo base_url('workorder/checklists'); ?>">Cancel</a>
                            <button type="submit" class="btn btn-primary">Continue</button>
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
    $(".btn-add-checklist-item").click(function(){

    });
});
</script>