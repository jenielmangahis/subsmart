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
svg#svg-sprite-menu-close {
    position: relative;
    bottom: 52px !important;
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
    <?php include viewPath('includes/sidebars/events'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid p-40">
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card mt-0" style="min-height: 400px !important;">
                        <div class="row">
                          <div class="col-sm-6 left">
                            <h3 class="page-title">Event Types</h3>
                          </div>
                          <div class="col-sm-6 right dashboard-container-1">
                              <div class="text-right">
                                  <a class="btn btn-primary btn-sm" href="<?php echo base_url('event_types/add_new'); ?>"><i class="fa fa-file"></i> Add New</a>
                              </div>
                          </div>
                        </div>
                        <div class="alert alert-warning mt-2 mb-4" role="alert">
                            <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Event types can be separated into seminars, conference, trade show, work shop, corporate, private, or charity. Event types can also be track for categories where an invoice will not be submit like estimates, tasks, demos and reminders. With our Crm you can choose, create or delete the appropriate classification for your business model.
                            </span>
                        </div>
                        <?php include viewPath('flash'); ?>
                        <table class="" id="eventTypeTable">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Event Type Name</th>
                                    <th>Manage</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($eventTypes as $et){ ?>
                                    <tr>
                                        <td width="10%">
                                          <?php
                                              if( $et->icon_marker != '' ){
                                                  if($et->is_marker_icon_default_list == 1){
                                                      $marker = base_url("uploads/icons/" . $et->icon_marker);
                                                  }else{
                                                      $marker = base_url("uploads/event_types/" . $et->company_id . "/" . $et->icon_marker);
                                                  }
                                              }else{
                                                  $marker = base_url("uploads/event_types/default_no_image.jpg");
                                              }
                                          ?>
                                          <img src="<?= $marker; ?>" class="event-marker">
                                        </td>
                                        <td width="65%"><?= $et->title; ?></td>
                                        <td width="25%">
                                            <a class="btn btn-primary btn-sm" href="<?php echo base_url('event_types/edit/'.$et->id); ?>"><i class="fa fa-edit"></i> Edit</a>
                                            <a class="btn btn-primary btn-sm btn-delete-event-type" href="javascript:void(0);" data-id="<?= $et->id; ?>"><i class="fa fa-trash"></i> Delete</a>
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
        <div class="modal fade bd-example-modal-sm" id="modalDeleteEventType" tabindex="-1" role="dialog" aria-labelledby="modalDeleteEventTypeTitle" aria-hidden="true">
          <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-trash"></i> Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <?php echo form_open_multipart('event_types/delete', ['class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
              <?php echo form_input(array('name' => 'eid', 'type' => 'hidden', 'value' => '', 'id' => 'eid'));?>
              <div class="modal-body">
                  <p>Delete selected event type?</p>
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
    $('#eventTypeTable').DataTable({
        "lengthChange": true,
        "searching" : false,
        "pageLength": 10,
        "order": [],
         "aoColumnDefs": [
          { "sWidth": "5%", "aTargets": [ 0 ] },
          { "sWidth": "80%", "aTargets": [ 1 ] },
          { "sWidth": "10%", "aTargets": [ 2 ] }
        ]
    });
    /*$(".btn-delete-event-type").click(function(){
        var event_type_id = $(this).attr("data-id");
        $("#eid").val(event_type_id);

        $("#modalDeleteEventType").modal("show");
    });*/

    $(".btn-delete-event-type").on( "click", function( event ) {
        var eid = $(this).attr("data-id");
        Swal.fire({
            title: 'Delete selected Event Type?',
            text: "",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#32243d',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: base_url + "/event_types/delete",
                    data: {eid : eid}, // serializes the form's elements.
                    success: function(data)
                    {
                        /*Swal.fire(
                          'Deleted!',
                          'Your file has been deleted.',
                          'success'
                        );*/
                        window.location.reload();
                    }
                });
            }
        });
    });
});
</script>
