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
    width: 15%;
    text-align: right;
}
table.table tbody tr td:first-child {
    width: 85%;
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
                            <h3 class="page-title">Email Automation</h3>
                          </div>
                          <div class="col-sm-6 right dashboard-container-1">
                              <div class="text-right">
                                  <a href="<?php echo url('email_automation/add_email_automation') ?>" class="btn btn-primary btn-md"><i class="fa fa-plus"></i> Add Email Automation</a>
                                  <a href="<?php echo url('email_automation/templates') ?>" class="btn btn-primary btn-md"><i class="fa fa-file"></i> Manage Default Templates</a>
                              </div>
                          </div>
                        </div>
                        <div class="alert alert-warning mt-2 mb-4" role="alert">
                            <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">List all automations.
                            </span>
                        </div>
                        <?php include viewPath('flash'); ?>
                        <!-- Main content -->
                        <section class="content">
                            <div class="automation-list-container"></div>
                        </section>
                        <!-- /.content -->
                    </div>
                    <!-- end card -->
                </div>

                <!-- Modal Delete Email Automation  -->
                <div class="modal fade bd-example-modal-sm" id="modalDeleteAutomation" tabindex="-1" role="dialog" aria-labelledby="modalDeleteAutomationTitle" aria-hidden="true">
                  <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-trash"></i> Delete</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <?php echo form_open_multipart('', ['class' => 'form-validate', 'id' => 'form-delete-automation', 'autocomplete' => 'off' ]); ?>
                      <?php echo form_input(array('name' => 'automationid', 'type' => 'hidden', 'value' => '', 'id' => 'automationid'));?>
                      <div class="modal-body delete-body-container">
                          <p>Are you sure you want delete the email automation <b><span class="delete-automation-name"></span></b>?</p>
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
    load_load_automation_list();
    function load_load_automation_list(){
      var url = base_url + 'email_automation/_load_automation_list';
      $(".automation-list-container").html('<span class="spinner-border spinner-border-sm m-0"></span>');
      setTimeout(function () {
        $.ajax({
           type: "POST",
           url: url,
           //data: ,
           success: function(o)
           {
              $(".automation-list-container").html(o);
              //table.destroy();
              var table = $('#dataTableAutomation').DataTable({
                  "searching" : false,
                  "pageLength": 10,
                  "order": [],
                   "aoColumnDefs": [
                    { "sWidth": "40%", "aTargets": [ 0 ] },
                    { "sWidth": "20%", "aTargets": [ 1 ] },
                    { "sWidth": "20%", "aTargets": [ 2 ] },
                    { "sWidth": "20%", "aTargets": [ 3 ] },
                    { "sWidth": "10%", "aTargets": [ 4 ] }
                  ]
              });     

              $(document).on('click', '.delete-email-automation', function(){
                var automation_name = $(this).attr("data-name");
                var automation_id = $(this).attr("data-id");
                $("#automationid").val(automation_id);
                $(".delete-modal-footer").show();
                $(".delete-body-container").html('<p>Are you sure you want delete the email automation <b><span class="delete-automation-name"></span></b>?</p>');
                $(".delete-automation-name").html(automation_name);
                $("#modalDeleteAutomation").modal('show');
                $(".btn-delete-automation").html('Yes');
              });

              $(document).on('change', '.automation-toggle', function(){
                var automation_id = $(this).attr("data-id");

                if ($(this).prop('checked')) {
                  var is_active = 1;
                }else{
                  var is_active = 0;
                }

                var url = base_url + 'email_automation/_update_automation_is_active';
                $.ajax({
                   type: "POST",
                   url: url,
                   data : {automation_id:automation_id, is_active:is_active},
                   dataType:"json",
                   success: function(o)
                   {
                     

                   }
                });
              });
           }
        });
      }, 1000);      
    }

    $("#form-delete-automation").submit(function(e){
      e.preventDefault();
      var url = base_url + 'email_automation/_delete_automation';
      $(".btn-delete-automation").html('<span class="spinner-border spinner-border-sm m-0"></span>');
      setTimeout(function () {
        $.ajax({
           type: "POST",
           url: url,
           data : $("#form-delete-automation").serialize(),
           dataType:"json",
           success: function(o)
           {
              $("#modalDeleteAutomation").modal('hide');
              if( o.is_success ){
                Swal.fire({
                  title: 'Delete',
                  text: 'Email automation was successfully deleted!',
                  icon: 'success',
                  showCancelButton: false,
                  confirmButtonColor: '#32243d',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Ok'
              }).then((result) => {
                  if (result.value) {
                      location.reload();
                  }
              });
              }else{
                Swal.fire({
                    title: 'Warning!',
                    text: o.msg,
                    icon: 'warning',
                    showCancelButton: false,
                    confirmButtonColor: '#32243d',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ok'
                }).then((result) => {

                });
              }
           }
        });                    
      }, 800);
    });
});

</script>
