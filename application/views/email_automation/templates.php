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
.left {
  float: left;
}
.pr-b10 {
  position: relative;
  bottom: 10px;
}
.p-40 {
  padding-top: 40px !important;
}
img.event-marker {
    display: block;
    margin: 0 auto;
}
tr.odd {
    background: #f1f1f1 !important;
}
table.table tbody tr td {
    text-align: left;
}
table.table tbody tr td:first-child {
    text-align: left;
}
table.dataTable {
    border-collapse: collapse;
    margin-top: 5px;
}
table.dataTable thead tr th {
    border: 1px solid black !important;
}
table.dataTable tbody tr td {
    border: 1px solid black !important;
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
.event-marker{
  height: 50px;
  width: 50px;
  border: 1px solid #dee2e6;
}
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/marketing'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid p-40">
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card mt-0" style="min-height: 400px !important;">
                        <div class="row">
                          <div class="col-sm-6 left">
                            <h3 class="page-title">Email Automation - Default Templates</h3>
                          </div>
                          <div class="col-sm-6 right dashboard-container-1">
                              <div class="text-right">
                                  <a href="<?php echo url('email_automation/add_template') ?>" class="btn btn-primary btn-md"><i class="fa fa-plus"></i> Add Template</a>
                                  <a href="<?php echo url('email_automation') ?>" class="btn btn-primary btn-md"><i class="fa fa-cube"></i> Return to Automation</a>
                              </div>
                          </div>
                        </div>
                        <div class="alert alert-warning mt-2 mb-4" role="alert">
                            <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">
                              Set your own email templates and select them when building an automation.
                            </span>
                        </div>
                        <?php include viewPath('flash'); ?>
                        <!-- Main content -->
                        <section class="content">
                            <table class="table" id="dtAutomationTemplate">
                            <thead>
                            <tr>
                                <th><strong>Name</strong></th>
                                <th>&nbsp;</th>

                            </tr>
                            </thead>
                                <?php if(!empty($emailAutomationTemplates)) { ?>
                                  <?php foreach($emailAutomationTemplates as $template) { ?>
                                    <tr class="">
                                      <td><?php echo $template->name; ?></td>
                                      <td>
                                        <div class="dropdown dropdown-btn text-center">
                                            <button class="btn btn-default" type="button" id="dropdown-edit" data-toggle="dropdown" aria-expanded="true">
                                                <span class="btn-label">Manage <i class="fa fa-caret-down fa-sm" style="margin-left:10px;"></i></span></span>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdown-edit">
                                                <li role="presentation">
                                                  <a class="template-edit editItemBtn" href="<?= base_url("email_automation/edit_template/" . $template->id) ?>">
                                                      <span class="fa fa-pencil-square-o icon"></span> Edit
                                                  </a>
                                                </li>
                                                <li role="separator" class="divider"></li>
                                                <li role="presentation">
                                                  <a class="template-delete" data-id="<?php echo $template->id; ?>" href="javascript:void(0);" data-name="<?php echo $template->name; ?>">
                                                      <span class="fa fa-trash-o icon"></span> Delete
                                                  </a>   
                                                </li>
                                            </ul>
                                        </div>                              
                                      </td>
                                    </tr>
                                  <?php } ?>
                                <?php }else{ ?>
                                  <tr>
                                    <td colspan="3">No Default Template Yet</td>
                                  </tr>
                                <?php } ?>
                            <tbody>
                            </tbody>
                        </table> 
                        </section>
                        <!-- /.content -->
                    </div>
                    <!-- end card -->
                </div>

                <!-- Modal Delete  -->
                <div class="modal fade bd-example-modal-sm" id="modalDeleteTemplate" tabindex="-1" role="dialog" aria-labelledby="modalDeleteTemplateTitle" aria-hidden="true">
                  <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-trash"></i> Delete</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <?php echo form_open_multipart('email_automation/delete_template', ['class' => 'form-validate', 'id' => 'form-delete-automation', 'autocomplete' => 'off' ]); ?>
                      <?php echo form_input(array('name' => 'tid', 'type' => 'hidden', 'value' => '', 'id' => 'automationtemplateid'));?>
                      <div class="modal-body delete-body-container">
                          <p>Are you sure you want delete template <b><span class="delete-automation-template-name"></span></b>?</p>
                      </div>
                      <div class="modal-footer delete-modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-danger btn-delete-automation">Yes</button>
                      </div>
                      <?php echo form_close(); ?>
                    </div>
                  </div>
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
    $(document).on('click', '.template-delete', function(){
      var tid = $(this).attr('data-id');
      var template_name = $(this).attr('data-name');

      $('#automationtemplateid').val(tid);
      $('.delete-automation-template-name').html(template_name);
      $('#modalDeleteTemplate').modal('show');

    });

    var table = $('#dtAutomationTemplate').DataTable({
        "searching" : false,
        "pageLength": 10,
        "order": [],
         "aoColumnDefs": [
          { "sWidth": "90%", "aTargets": [ 0 ] },
          { "sWidth": "10%", "aTargets": [ 1 ] }
        ]
    });
});

</script>
