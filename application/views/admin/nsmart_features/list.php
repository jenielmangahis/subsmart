<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/admin_header'); ?>
<style>
.cell-active{
    background-color: #5bc0de;
}
.cell-inactive{
    background-color: #d9534f;
}
.btn{
    border-radius: 0px !important;
}
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/admin/nsmart_plans'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">            
            <div class="row">
                <div class="col-xl-12">
                    <div class="card" style="min-height: 400px !important;">
                        <div class="row align-items-center">
                            <div class="col-sm-12">
                                <h3 class="page-title" style="margin-top: 5px;margin-bottom:10px;">Features</h3>
                            </div>
                        </div>
                        <div class="pl-3 pr-3 mt-0 row">
                            <div class="col mb-4 left alert alert-warning mt-0 mb-2">
                                <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Create plan features.</span>
                            </div>
                        </div>
                        <br />
                        <div class="row dashboard-container-1">
                            <div class="col-md-12 text-right">
                                <a class="btn btn-primary" href="<?php echo base_url('admin/add_new_plan_headings'); ?>"><i class="fa fa-file"></i> Create Heading</a>
                                <a class="btn btn-primary" href="<?php echo base_url('admin/add_new_feature'); ?>"><i class="fa fa-file"></i> Create Feature</a>
                            </div>
                        </div>       
                        <hr />
                        <?php include viewPath('flash'); ?>
                        <table class="table table-bordered table-striped default-datatable">
                            <thead>
                                <tr style="background-color: #45a73c; color:#ffffff;">
                                    <th style="width: 20%;">Features</th>
                                    <th style="width: 30%;">Plans</th>
                                    <th style="width: 5%;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach( $data_features as $heading => $data ){ ?>
                                    <tr>
                                        <td colspan="3" style="background-color: #32243d; color:#ffffff;"><b><?= $heading; ?></b></td>
                                    </tr>
                                    <?php foreach( $data as $modules ){ ?>
                                        <tr>
                                            <td><?= $modules['feature_name']; ?></td>
                                            <td>
                                                <?php 
                                                    echo implode(",", $modules['plans']);
                                                ?>
                                            </td>
                                            <td>
                                                <a class="btn btn-primary btn-sm" href="<?php echo base_url('admin/edit_nsmart_feature/'.$modules['feature_id']); ?>"><i class="fa fa-edit"></i> Edit</a>
                                                <a class="btn btn-sm btn-primary btn-delete-feature" data-name="<?= $modules['feature_name']; ?>" href="javascript:void(0);" data-id="<?= $modules['feature_id']; ?>"><i class="fa fa-trash"></i> Delete</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->

    <div class="modal fade bd-example-modal-sm" id="modalDeleteFeature" tabindex="-1" role="dialog" aria-labelledby="modalDeletePlanTitle" aria-hidden="true">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-trash"></i> Delete</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <?php echo form_open_multipart('admin/delete_nsmart_plan_feature', ['class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
          <?php echo form_input(array('name' => 'fid', 'type' => 'hidden', 'value' => '', 'id' => 'fid'));?>
          <div class="modal-body">        
              <p>Are you sure you want to delete plan feature <span class="delete-feature-name"></span></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            <button type="submit" class="btn btn-danger">Yes</button>
          </div>
          <?php echo form_close(); ?>
        </div>
      </div>
    </div>
</div>
<?php include viewPath('includes/plan_builder_modals'); ?> 
<?php include viewPath('includes/admin_footer'); ?>
<script>
$(document).ready(function() {
    $('.default-datatable').DataTable({
        "searching": false,
        "sort": false
    });
});
$(document).on('click', '.btn-delete-feature', function(){
    var feature_id   = $(this).attr("data-id");
    var feature_name = $(this).attr("data-name");

    $("#fid").val(feature_id);
    $(".delete-feature-name").html("<b>" + feature_name + "</b>");
    $("#modalDeleteFeature").modal('show');
});
</script>