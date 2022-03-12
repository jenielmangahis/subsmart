<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('includes/header'); ?>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<style>
    #draggable { width: 150px; height: 150px; padding: 0.5em; }
</style>
<style>
    label>input {
      visibility: initial !important;
      position: initial !important; 
    }
</style>

<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/customer'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <?php include viewPath('includes/notifications'); ?>
        <div class="container-fluid">
            <div class="page-title-box">
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body hid-desk" >
                            <div class="row margin-bottom-ter align-items-center">
                                <!-- Nav tabs -->
                                <div class="col-auto">
                                    <h2 class="page-title" style="display:inline-block;">Internal Notes </h2>
                                    <span style="display:inline-block;color:#4a4a4a;font-size: 28px;margin-left: 9px;">(<i><?= $customer->first_name . ' ' . $customer->last_name; ?></i>)</span>
                                </div>
                                <div class="col-auto">
                                    <div class="h1-spacer">
                                        <a class="btn btn-primary btn-md btn-customer-add-note" href="javascript:void(0);">
                                            <span class="fa fa-plus"></span> Add Internal Note
                                        </a>
                                    </div>
                                </div>
                                <div class="alert alert-warning col-md-12 mt-4 mb-4" role="alert">
                                    <span style="color:black;">
                                        Internal notes saved here are not seen by the client.
                                    </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="banking-tab-container mb-5">
                                        <div class="rb-01">
                                            <?php include_once('cus_module_tabs.php'); ?>
                                        </div>
                                    </div>
                                    <div class="tab-content mt-4" >
                                        <table class="table table-hover table-to-list" id="internalNotesTable">
                                            <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Note</th>
                                                <th>Added By</th>
                                                <th class="text-center"></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($internalNotes as $i){ ?>
                                                    <td><?= date("m/d/Y", strtotime($i->note_date)); ?></td>
                                                    <td><?= $i->notes; ?></td>
                                                    <td><?= $i->user_name; ?></td>
                                                    <td class="text-right">
                                                        <div class="dropdown dropdown-btn">
                                                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdown-edit" data-toggle="dropdown" aria-expanded="true">
                                                                <span class="btn-label">Manage</span><span class="caret-holder"><span class="caret"></span></span>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdown-edit">
                                                                <li role="presentation">
                                                                    <a role="menuitem" class="edit-internal-note" href="javascript:void(0);" data-id="<?= $i->id; ?>">
                                                                        <span class="fa fa-pencil-square-o icon"></span> Edit
                                                                    </a>
                                                                </li>
                                                                <li role="presentation">
                                                                    <a role="menuitem" class="delete-internal-note" href="javascript:void(0);" data-id="<?= $i->id; ?>">
                                                                        <span class="fa fa-trash-o icon"></span> Delete
                                                                    </a>
                                                                </li>                                                                
                                                            </ul>
                                                        </div>
                                                    </td>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal create notes -->
                        <div class="modal fade modal-enhanced" id="modal-create-internal-note" role="dialog" aria-labelledby="addLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" style="display:inline-block;">Add Internal Notes: not seen by client</h5>
                                        <span style="display:inline-block;color:#4a4a4a;font-size: 22px;margin-left: 9px;">(<i><?= $customer->first_name . ' ' . $customer->last_name; ?></i>)</span>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <form id="frm-create-internal-note" method="post">
                                        <input type="hidden" name="customer_id" value="<?= $customer->prof_id; ?>">
                                        <div class="modal-body" style="padding:1.5rem;margin-bottom: 50px;">
                                            <div class="row">
                                                <div class="col-12">
                                                    <p style="font-size: 16px;margin-bottom: 55px;"><i class="fa fa-info-circle" style="font-size:30px;margin-right: 15px;"></i> <b>Note:</b> Write any comment or keep record of all conversations and correspondance with Creditors and Credit Bureaus.</p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                              <label for="" style="width:100%;text-align: left;"><i class="fa fa-calendar"></i> Date</label>
                                              <div class="row g-3">
                                                <div class="col-sm-8">
                                                  <input type="text" name="note_date" value="<?= date("m/d/Y"); ?>" class="form-control edit-note-datepicker note-date field-popover" placeholder="Date" aria-label="Date" data-trigger="hover" data-original-title="When" data-container="body" data-placement="right" autocomplete="off" data-content="">
                                                </div>
                                              </div>
                                            </div>                                            
                                            <div class="form-group">
                                                <label for="" style="width:100%;text-align: left;"><i class="fa fa-list"></i> Note</label>
                                                <div class="row g-3">
                                                    <div class="col-sm-12">
                                                    <textarea class="form-control" name="interal_notes" id="editor1" style="height: 200px;"></textarea>
                                                    </div>
                                                </div>
                                            </div>  
                                            <div class="modal-footer custom-modal-footer" style="margin-top:-2.5rem;">
                                                <button type="button" style="" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary btn-create-internal-note" name="action" value="create_appointment">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>                                
                            </div>   
                        </div>

                        <!-- Modal edit notes -->
                        <div class="modal fade modal-enhanced" id="modal-edit-internal-note" role="dialog" aria-labelledby="addLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" style="display:inline-block;">Edit Internal notes: not seen by client</h5>
                                        <span style="display:inline-block;color:#4a4a4a;font-size: 22px;margin-left: 9px;">(<i><?= $customer->first_name . ' ' . $customer->last_name; ?></i>)</span>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <form id="frm-update-internal-note" method="post">
                                        <input type="hidden" name="customer_id" value="<?= $customer->prof_id; ?>">
                                        <input type="hidden" name="nid" value="" id="edit-nid">
                                        <div class="modal-body edit-internal-notes" style="padding:1.5rem;margin-bottom: 50px;"></div>
                                        <div class="modal-footer custom-modal-footer" style="margin-top:-2.5rem;">
                                            <button type="button" style="" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary btn-update-internal-note" name="action" value="create_appointment">Save</button>
                                        </div>
                                    </form>
                                </div>                                
                            </div>   
                        </div>

                        <!-- Modal delete note  -->
                        <div class="modal fade bd-example-modal-md" id="modal-delete-internal-note" tabindex="-1" role="dialog" aria-labelledby="modalDeleteCreditNoteTitle" aria-hidden="true">
                            <div class="modal-dialog modal-md" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-trash"></i> Delete</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form id="frm-delete-internal-note" method="post">
                                        <input type="hidden" name="customer_id" value="<?= $customer->prof_id; ?>">
                                        <input type="hidden" name="nid" id="nid" value="">
                                        <div class="modal-body">
                                            <p>Are you sure you want to delete selected note?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                            <button type="submit" class="btn btn-danger btn-delete-internal-note">Yes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- page wrapper end -->
<?php include viewPath('includes/footer'); ?>
<script>
$(document).ready(function () {
    $('#internalNotesTable').DataTable({
        "lengthChange": true,
        "searching": true,
        "pageLength": 10,
        "order": [],
    });

    $('.note-datepicker').datepicker({
        //format: 'yyyy-mm-dd',
        format: 'mm/dd/yyyy',
        autoclose: true,
    });

    $(document).on('click', '.btn-customer-add-note', function(){
        $('#modal-create-internal-note').modal('show');
    });

    $(document).on('click', '.delete-internal-note', function(){
        var nid = $(this).attr('data-id');

        $('#nid').val(nid);
        $('#modal-delete-internal-note').modal('show');
    });

    $(document).on('click', '.edit-internal-note', function(){
        var nid = $(this).attr('data-id');

        $('#edit-nid').val(nid);
        $('#modal-edit-internal-note').modal('show');

        var url = base_url + 'customer/_load_edit_internal_note';
        $(".edit-internal-notes").html('<span class="spinner-border spinner-border-sm m-0"></span>');
        setTimeout(function () {
            $.ajax({
               type: "POST",
               url: url,
               data: {nid:nid},
               success: function(o)
               {
                  $(".edit-internal-notes").html(o);
               }
            });
        }, 1000);


    });

    $("#frm-create-internal-note").submit(function(e){
        e.preventDefault();

        var url = base_url + 'customer/_create_internal_notes';
        $(".btn-create-internal-note").html('<span class="spinner-border spinner-border-sm m-0"></span> Saving');
        setTimeout(function () {
            $.ajax({
               type: "POST",
               url: url,
               dataType: "json",
               data: $("#frm-create-internal-note").serialize(),
               success: function(o)
               {
                  if( o.is_success ){
                      $("#modal-create-internal-note").modal('hide');
                      Swal.fire({
                          title: 'Success',
                          text: 'Internal note was successfully created.',
                          icon: 'success',
                          showCancelButton: false,
                          confirmButtonColor: '#32243d',
                          cancelButtonColor: '#d33',
                          confirmButtonText: 'Ok'
                      }).then((result) => {
                          //if (result.value) {
                            location.reload();
                          //}
                      });
                  }else{
                      Swal.fire({
                        icon: 'error',
                        title: 'Cannot save data.',
                        text: o.msg
                      });
                  }

                  $(".btn-create-internal-note").html('Save');
               }
            });
        }, 1000);
    });

    $("#frm-update-internal-note").submit(function(e){
        e.preventDefault();

        var url = base_url + 'customer/_update_internal_notes';
        $(".btn-update-internal-note").html('<span class="spinner-border spinner-border-sm m-0"></span> Saving');
        setTimeout(function () {
            $.ajax({
               type: "POST",
               url: url,
               dataType: "json",
               data: $("#frm-update-internal-note").serialize(),
               success: function(o)
               {
                  if( o.is_success ){
                      $("#modal-edit-internal-note").modal('hide');
                      Swal.fire({
                          title: 'Success',
                          text: 'Internal note was successfully updated.',
                          icon: 'success',
                          showCancelButton: false,
                          confirmButtonColor: '#32243d',
                          cancelButtonColor: '#d33',
                          confirmButtonText: 'Ok'
                      }).then((result) => {
                          //if (result.value) {
                            location.reload();
                          //}
                      });
                  }else{
                      Swal.fire({
                        icon: 'error',
                        title: 'Cannot save data.',
                        text: o.msg
                      });
                  }

                  $(".btn-update-internal-note").html('Save');
               }
            });
        }, 1000);
    });

    $("#frm-delete-internal-note").submit(function(e){
        e.preventDefault();

        var url = base_url + 'customer/_delete_internal_notes';
        $(".btn-delete-internal-note").html('<span class="spinner-border spinner-border-sm m-0"></span>');
        setTimeout(function () {
            $.ajax({
               type: "POST",
               url: url,
               dataType: "json",
               data: $("#frm-delete-internal-note").serialize(),
               success: function(o)
               {
                  if( o.is_success ){
                      $("#modal-delete-internal-note").modal('hide');
                      Swal.fire({
                          title: 'Success',
                          text: 'Internal note was successfully deleted.',
                          icon: 'success',
                          showCancelButton: false,
                          confirmButtonColor: '#32243d',
                          cancelButtonColor: '#d33',
                          confirmButtonText: 'Ok'
                      }).then((result) => {
                          //if (result.value) {
                            location.reload();
                          //}
                      });
                  }else{
                      Swal.fire({
                        icon: 'error',
                        title: 'Cannot find data.',
                        text: o.msg
                      });
                  }

                  $(".btn-delete-internal-note").html('Yes');
               }
            });
        }, 1000);
    });
});
</script>
