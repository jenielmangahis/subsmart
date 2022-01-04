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
.p-20 {
  padding-top: 30px !important;
  padding-bottom: 25px !important;
  padding-right: 20px !important;
  padding-left: 20px !important;
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
label>input {
  visibility: initial !important;
  position: initial !important; 
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
                    <div class="card p-20" style="min-height: 400px !important;">
                      <div class="row">
                        <div class="col-sm-6 left">
                          <h3 class="page-title mt-0">Appointment Types</h3>
                        </div>
                        <div class="col-sm-6 right dashboard-container-1">
                            <div class="text-right">
                                <a class="btn btn-primary" href="<?php echo base_url('appointment_types/add_new_type'); ?>"><i class="fa fa-file"></i> Add New</a>
                            </div>
                        </div>
                      </div>
                      <div class="alert alert-warning mt-1 mb-4" role="alert">
                          <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Make scheduling appointments simple and streamlined with the CRM color setting. Now, with just a few clicks, users can add and assign colors to employees, events, and job types.
                          </span>
                      </div>
                        <?php include viewPath('flash'); ?>
                        <table class="table table-hover" id="dtSettings">
                            <thead>
                                <tr>
                                    <th style="width: 40%;">Name</th>
                                    <th style="width: 10%;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($appointmentTypes as $a){ ?>
                                    <tr>
                                        <td><?= $a->name; ?></td>
                                        <td>
                                            <div class="dropdown dropdown-btn">
                                                <?php $eid = hashids_encrypt($ch->id, '', 15); ?>
                                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdown-edit" data-toggle="dropdown" aria-expanded="true">
                                                    <span class="btn-label">Manage</span><span class="caret-holder"><span class="caret"></span></span>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdown-edit">
                                                    <li role="presentation">
                                                        <a role="menuitem" tabindex="-1" href="<?php echo base_url('appointment_types/edit/'.$a->id); ?>">
                                                            <span class="fa fa-pencil-square-o icon"></span> Edit</a>
                                                    </li>
                                                    <li role="presentation">
                                                        <a role="menuitem" class="btn-delete-appointment-type" href="javascript:void(0);" data-name="<?php echo $a->name; ?>" data-id="<?php echo $a->id; ?>"><span class="fa fa-trash-o"></span> Delete</a>
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

        <!-- Modal Delete  -->
        <div class="modal fade bd-example-modal-sm" id="modalDeleteAppointmentType" tabindex="-1" role="dialog" aria-labelledby="modalDeleteColorTitle" aria-hidden="true">
          <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-trash"></i> Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <?php echo form_open_multipart('appointment_types/delete', ['class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
              <?php echo form_input(array('name' => 'aid', 'type' => 'hidden', 'value' => '', 'id' => 'aid'));?>
              <div class="modal-body">
                  <p>Delete selected appointment type?</p>
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
    var table = $('#dtSettings').DataTable({
        "searching" : true,
        "pageLength": 10,
        "order": [],
         "aoColumnDefs": [
          { "sWidth": "70%", "aTargets": [ 0 ] },
          { "sWidth": "10%", "aTargets": [ 1 ] },          
        ]
    });

    $(".btn-delete-appointment-type").click(function(){
        var aid = $(this).attr("data-id");
        $("#aid").val(aid);

        $("#modalDeleteAppointmentType").modal("show");
    });
});
</script>
