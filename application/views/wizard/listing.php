<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>

<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/upgrades'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid p-40">
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card p-20" style="min-height: 400px !important;">
                      <div class="row">
                        <div class="col-sm-6 left">
                          <h3 class="page-title mt-0">Work Space</h3>
                        </div>
                        <div class="col-sm-6 right dashboard-container-1">
                            <div class="text-right">
                                <a class="btn btn-primary" href="<?php echo base_url('wizard/add_new_workspace'); ?>"><i class="fa fa-plus"></i> Add New</a>
                            </div>
                        </div>
                      </div>
                      <div class="alert alert-warning mt-1 mb-4" role="alert">
                          <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                          </span>
                      </div>
                        <?php include viewPath('flash'); ?>
                        <table class="table table-hover" data-id="coupons">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th style="width: 10%;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($wizards_workspace as $key => $value)  { ?>
                                    <tr>
                                        <td><?= $value->name; ?></td>
                                        <td>
                                            <div class="dropdown dropdown-btn">
                                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdown-edit" data-toggle="dropdown" aria-expanded="true">
                                                    <span class="btn-label">Manage</span><span class="caret-holder"><span class="caret"></span></span>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdown-edit">
                                                    
                                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url('wizard/edit_workspace/'.$value->id); ?>"><span class="fa fa-pencil-square-o icon"></span> Edit</a>
                                                    </li>
                                                    <li role="presentation">
                                                        <a role="menuitem" class="btn-delete-workspace" href="javascript:void(0);" data-id="<?= $value->id; ?>"><span class="fa fa-trash-o icon"></span> Delete</a>
                                                </ul>
                                            </div>
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

        <!-- Modal Delete Workspace  -->
        <div class="modal fade bd-example-modal-md" id="modalDeleteWorkspace" tabindex="-1" role="dialog" aria-labelledby="modalDeleteWorkspaceTitle" aria-hidden="true">
          <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-trash"></i> Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <?php echo form_open_multipart('wizard/delete_workspace', ['class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
              <?php echo form_input(array('name' => 'wsid', 'type' => 'hidden', 'value' => '', 'id' => 'wsid'));?>
              <div class="modal-body">
                  <p>Delete selected work space?</p>
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
    $(".btn-delete-workspace").click(function(){
        var wsid = $(this).attr("data-id");
        $("#wsid").val(wsid);

        $("#modalDeleteWorkspace").modal("show");
    });
});
</script>
