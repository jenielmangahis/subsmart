<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<!-- page wrapper start -->
<style>
label>input {
      visibility: initial !important;
      position: initial !important; 
    }
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/workorder'); ?>
    <div wrapper__section>
        <?php include viewPath('includes/notifications'); ?>
        <div class="card"> 
            <div class="container-fluid" style="font-size:14px;">
                <div class="row">
                    <div class="col">
                        <h3 class="m-0">Checklists</h3>
                    </div>
                    <div style="background-color:#fdeac3;padding:.5%;margin-bottom:5px;margin-top:5px;margin-bottom:10px; width:100%;">
                        Create great check list for employees or subcontractor to follow a series of item listings to meet all of your company’s requirements, expectations or reminders.  This can be attached to estimate, workorder, invoices.  A powerful addition to your forms.    
                    </div>
                </div>

                <div class="row" style="margin-bottom:20px;">
                    <div class="col">
                        <!-- <h1 class="m-0">Work Orders</h1> -->
                    </div>
                    <div class="col-auto">
                        <div class="h1-spacer">
                            <a class="btn btn-primary btn-md" href="<?php echo base_url('/workorder/add_checklist') ?>">
                                <span class="fa fa-plus"></span> &nbsp; Add Checklist
                            </a>
                        </div>
                    </div>
                </div>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">

                        <?php if (!empty($checklists)) { ?>
                            <table class="table table-hover table-to-list" id="workorder-checklist">
                                <thead>
                                <tr>
                                    <th>Checklist Name</th>
                                    <th style="width: 10%;"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($checklists as $ch) { ?>
                                    <tr>
                                        <td><?= $ch->checklist_name; ?></td>
                                        <td>
                                            <div class="dropdown dropdown-btn">
                                                <?php $eid = hashids_encrypt($ch->id, '', 15); ?>
                                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdown-edit" data-toggle="dropdown" aria-expanded="true">
                                                    <span class="btn-label">Manage</span><span class="caret-holder"><span class="caret"></span></span>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdown-edit">
                                                    <li role="presentation">
                                                        <a role="menuitem" tabindex="-1" href="<?php echo base_url('/workorder/edit_checklist/' . $ch->id); ?>">
                                                            <span class="fa fa-pencil-square-o icon"></span> Edit</a>
                                                    </li>
                                                    <li role="presentation">
                                                        <a role="menuitem" class="delete-check-list" href="javascript:void(0);" data-name="<?php echo $ch->checklist_name; ?>" data-id="<?php echo $ch->id; ?>"><span class="fa fa-trash-o icon"></span> Delete</a>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>

                                </tbody>

                            </table>
                        <?php } else { ?>
                            <div class="page-empty-container">
                                <h5 class="page-empty-header">You haven't yet added your checklist</h5>
                                <p class="text-ter margin-bottom">Manage your checklist.</p>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <!-- Modal Delete Checklist -->
                <div class="modal fade bd-example-modal-md" id="modalDeleteChecklist" tabindex="-1" role="dialog" aria-labelledby="modalDeleteChecklistTitle" aria-hidden="true">
                  <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-trash"></i> Delete</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <?php echo form_open_multipart('workorder/delete_checklist', ['class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
                      <?php echo form_input(array('name' => 'cid', 'type' => 'hidden', 'value' => '', 'id' => 'cid'));?>
                      <div class="modal-body">
                          <p>Are you sure you want to delete checklist <span class="checklist-name"></span>?</p>
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
        </div>
    </div>
    <!-- page wrapper end -->
    <?php include viewPath('includes/footer'); ?>
</div>
<script>
$(function(){
    $('#workorder-checklist').DataTable({
        "ordering": false
    });

    $(".delete-check-list").click(function(){
        var chk_name = $(this).attr('data-name');
        var cid = $(this).attr('data-id');

        $("#cid").val(cid);
        $(".checklist-name").html('<b>'+chk_name+'</b>');
        $("#modalDeleteChecklist").modal('show');
    });
});
</script>