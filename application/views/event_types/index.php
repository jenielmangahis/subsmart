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
            <div class="page-title-box pb-2">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title">Event Types</h1>
                    </div>
                </div>
            </div>
            <div class="alert alert-warning mt-1 mb-4" role="alert">
                <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Schedule adds the ability to create and track events in CRM; An event can be scheduled for single or multiple days; Staff, venue and equipment resources can all be schedule for a given event; The visual event calendar lets you see events by type and venue. <br/><br/>
                To create a new event type. Click Add New; To edit an existing event type simply click edit.
                </span>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card" style="min-height: 400px !important;">
                        <div class="row dashboard-container-1">
                            <div class="col-md-12 text-right">
                                <a class="btn btn-info" href="<?php echo base_url('event_types/add_new'); ?>"><i class="fa fa-file"></i> Add New</a>
                            </div>
                        </div>       
                        <hr />
                        <?php include viewPath('flash'); ?>
                        <table class="table table-hover" data-id="coupons">
                            <thead>
                                <tr>
                                    <th style="width: 80%;">Event Type Name</th>
                                    <th style="width: 10%;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($eventTypes as $et){ ?>
                                    <tr>
                                        <td><?= $et->event_type_name; ?></td>
                                        <td>
                                            <a class="btn btn-info btn-sm" href="<?php echo base_url('event_types/edit/'.$et->id); ?>"><i class="fa fa-pencil"></i> Edit</a>
                                            <a class="btn btn-sm btn-danger btn-delete-event-type" href="javascript:void(0);" data-id="<?= $et->id; ?>"><i class="fa fa-trash"></i> Delete</a>
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
    $(".btn-delete-event-type").click(function(){
        var event_type_id = $(this).attr("data-id");
        $("#eid").val(event_type_id);

        $("#modalDeleteEventType").modal("show");
    });
});
</script>
