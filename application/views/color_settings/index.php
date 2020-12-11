<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style>
.cell-active{
    background-color: #5bc0de;
}
.cell-inactive{
    background-color: #d9534f;
}
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/schedule'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title">Color Settings</h1>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card" style="min-height: 400px !important;">
                        <div class="row dashboard-container-1">
                            <div class="col-md-12 text-right">
                                <a class="btn btn-info" href="<?php echo base_url('color_settings/add_new_color_setting'); ?>"><i class="fa fa-file"></i> Add New</a>
                            </div>
                        </div>       
                        <hr />
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
