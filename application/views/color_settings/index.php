<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style>
.cell-active{
    background-color: #5bc0de;
}
.page-title {
  font-family: Sarabun, sans-serif !important;
  font-size: 1.75rem !important;
  font-weight: 600 !important;
}
.cell-inactive{
    background-color: #d9534f;
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
    <?php include viewPath('includes/sidebars/schedule'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid p-40">
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card" style="min-height: 400px !important;">
                      <div class="row">
                        <div class="col-sm-6 left">
                          <h3 class="page-title mt-0">Color Settings</h3>
                        </div>
                        <div class="col-sm-6 right dashboard-container-1">
                            <div class="text-right">
                                <a class="btn btn-info" href="<?php echo base_url('color_settings/add_new_color_setting'); ?>"><i class="fa fa-file"></i> Add New</a>
                            </div>
                        </div>
                      </div>
                      <div class="alert alert-warning mt-1 mb-4" role="alert">
                          <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Make scheduling appointments simple and streamlined with the CRM color setting. Now, with just a few clicks, users can add and assign colors to employees, events, and job types.
                          </span>
                      </div>
                        <?php include viewPath('flash'); ?>
                        <table class="table table-hover" data-id="coupons">
                            <thead>
                                <tr>
                                    <th style="width: 40%;">Name</th>
                                    <th style="width: 10%;">Color Code</th>
                                    <th style="width: 10%;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($colorSettings as $c){ ?>
                                    <tr>
                                        <td><?= $c->color_name; ?></td>
                                        <td style="text-align: center;color:#ffffff;"><div style="background-color: <?= $c->color_code; ?>;"><?= $c->color_code; ?></td>
                                        <td>
                                            <a class="btn btn-info btn-sm" href="<?php echo base_url('color_settings/edit_color_setting/'.$c->id); ?>"><i class="fa fa-pencil"></i> Edit</a>
                                            <a class="btn btn-sm btn-danger btn-delete-color" href="javascript:void(0);" data-id="<?= $c->id; ?>"><i class="fa fa-trash"></i> Delete</a>
                                        </td>
                                    </tr>
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

        <!-- Modal Delete Addon  -->
        <div class="modal fade bd-example-modal-sm" id="modalDeleteColor" tabindex="-1" role="dialog" aria-labelledby="modalDeleteColorTitle" aria-hidden="true">
          <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-trash"></i> Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <?php echo form_open_multipart('color_settings/delete_color', ['class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
              <?php echo form_input(array('name' => 'cid', 'type' => 'hidden', 'value' => '', 'id' => 'cid'));?>
              <div class="modal-body">
                  <p>Delete selected color?</p>
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
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer'); ?>

<script type="text/javascript">
$(function(){
    $(".btn-delete-color").click(function(){
        var addon_id = $(this).attr("data-id");
        $("#cid").val(addon_id);

        $("#modalDeleteColor").modal("show");
    });
});
</script>
