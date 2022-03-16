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
                                    <h2 class="page-title" style="display:inline-block;">Customer Messages List </h2>
                                    <span style="display:inline-block;color:#4a4a4a;font-size: 28px;margin-left: 9px;">(<i><?= $customer->first_name . ' ' . $customer->last_name; ?></i>)</span>
                                </div>
                                <div class="col-auto">
                                    <div class="h1-spacer">
                                        <a class="btn btn-primary btn-md btn-customer-create-message" href="javascript:void(0);">
                                            <span class="fa fa-plus"></span> Create Message
                                        </a>
                                        <a class="btn btn-primary btn-md btn-customer-add-note" href="<?= base_url('quick_notes/list') ?>">
                                            <span class="fa fa-plus"></span> Manage Quick Notes
                                        </a>
                                    </div>
                                </div>
                                <div class="alert alert-warning col-md-12 mt-4 mb-4" role="alert">
                                    <span style="color:black;">
                                        Send email messages to client.
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
                                        <table class="table table-hover" id="messagesListTable">
                                            <thead>
                                            <tr>
                                                <th style="width:20%;">Subject</th>
                                                <th style="width:20%;">To</th>
                                                <th style="width:10%;">Date</th>
                                                <th style="width:60%;">Message</th>
                                                <th style="width:10%;"></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($messages as $m){ ?>
                                                    <tr>
                                                        <td style="vertical-align: top;"><?= $m->subject; ?></td>
                                                        <td style="vertical-align: top;"><?= $m->customer_email; ?></td>
                                                        <td style="vertical-align: top;"><?= date("m/d/Y",strtotime($m->date_sent)); ?></td>
                                                        <td><?= $m->message; ?></td>
                                                        <td class="text-right" style="vertical-align: top;">
                                                            <div class="dropdown dropdown-btn">
                                                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdown-edit" data-toggle="dropdown" aria-expanded="true">
                                                                    <span class="btn-label">Manage</span><span class="caret-holder"><span class="caret"></span></span>
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdown-edit">
                                                                    <li role="presentation">
                                                                        <a role="menuitem" class="delete-customer-message" href="javascript:void(0);" data-id="<?= $m->id; ?>">
                                                                            <span class="fa fa-trash-o icon"></span> Delete
                                                                        </a>
                                                                    </li>                                                                
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal create message -->
                            <div class="modal fade modal-enhanced" id="modal-create-message" role="dialog" aria-labelledby="addLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" style="display:inline-block;">Send Message</h5>
                                            <span style="display:inline-block;color:#4a4a4a;font-size: 22px;margin-left: 9px;">(<i><?= $customer->first_name . ' ' . $customer->last_name; ?></i>)</span>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <form id="frm-send-message" method="post">
                                            <input type="hidden" id="" name="cid" value="<?= $customer->prof_id; ?>">
                                            <div class="modal-body" style="padding:1.5rem;margin-bottom: 50px;">
                                                <div class="form-group">                                                  
                                                    <div class="row">
                                                        <div class="col-sm-8">
                                                            <label for="" style="width:100%;text-align: left;">To</label>
                                                            <input type="text" class="form-control" name="message_recipient" readonly="" id="message-recipient" value="<?= $customer->email; ?>">
                                                        </div>
                                                    </div>
                                                </div> 
                                                <div class="send-message-container">                                                    
                                                    <div class="form-group">                                                  
                                                        <div class="row">
                                                            <div class="col-sm-8">
                                                                <label for="" style="width:100%;text-align: left;">Subject</label>
                                                                <input type="text" class="form-control" name="message_subject" id="message-subject" value="">
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label for="" style="width:66%;text-align: left;display: inline-block;">Use Quick Note</label>
                                                                <a class="btn btn-sm  btn-primary" href="<?= base_url('quick_notes/add_new'); ?>" style="font-size: 12px;display: inline-block;margin-bottom: 5px;">Add Quick Note</a>
                                                                <select class="form-control" name="use_quick_notes" id="use-quick-note">
                                                                    <option value="">-Select Quick Note-</option>
                                                                    <?php foreach($quickNotes as $qn){ ?>
                                                                        <option value="<?= $qn->id; ?>"><?= $qn->subject; ?></option>
                                                                    <?php } ?>
                                                                </select>                                                                
                                                            </div>
                                                        </div>
                                                    </div>                                            
                                                    <div class="form-group">
                                                        <label for="" style="width:100%;text-align: left;">Message</label>
                                                        <div class="row g-3">
                                                            <div class="col-sm-12">
                                                            <textarea class="form-control" name="message_body" id="editor1" style="height: 200px;"></textarea>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                </div> 
                                                <div class="modal-footer custom-modal-footer" style="margin-top:-2.5rem;">
                                                    <button type="button" style="" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary btn-send-message" name="action" value="create_appointment">Send</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>                                
                                </div>   
                            </div>

                            <!-- Modal delete message  -->
                            <div class="modal fade bd-example-modal-md" id="modal-delete-message" tabindex="-1" role="dialog" aria-labelledby="modalDeleteCreditNoteTitle" aria-hidden="true">
                                <div class="modal-dialog modal-md" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-trash"></i> Delete</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form id="frm-delete-message" method="post">
                                            <input type="hidden" name="customer_id" value="<?= $customer->prof_id; ?>">
                                            <input type="hidden" name="mid" id="mid" value="">
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete selected note?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                                <button type="submit" class="btn btn-danger btn-delete-message">Yes</button>
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
    </div>
</div>
<!-- page wrapper end -->
<?php include viewPath('includes/footer'); ?>
<?php include viewPath('customer/adv_cust/css_list'); ?>
<?php include viewPath('customer/adv_cust/js_list'); ?>
<script>
$(document).ready(function () {
    $('#messagesListTable').DataTable({
        "lengthChange": true,
        "searching": true,
        "pageLength": 10,
        "order": [],
    });

    $(document).on('click', '.btn-customer-create-message', function(){
        $('#modal-create-message').modal('show');
    });

    $(document).on('change', '#use-quick-note', function(){
        var qnid = $(this).val();

        var url = base_url + 'customer/_use_quick_note';
        $('.send-message-container').html('<span class="spinner-border spinner-border-sm m-0"></span>');
        setTimeout(function () {
            $.ajax({
               type: "POST",
               url: url,
               data: {qnid:qnid},
               success: function(o)
               {
                  $('.send-message-container').html(o);
               }
            });
        }, 300);
    });

    $(document).on('click', '.delete-customer-message', function(){
        var mid = $(this).attr('data-id');
        $('#mid').val(mid);
        $('#modal-delete-message').modal('show');
    });

    $("#frm-send-message").submit(function(e){
      e.preventDefault();
      var url = base_url + '/customer/_send_message';
      $(".btn-send-message").html('<span class="spinner-border spinner-border-sm m-0"></span>');

      for (instance in CKEDITOR.instances) {
        CKEDITOR.instances[instance].updateElement();
      }

      var formData = new FormData($("#frm-send-message")[0]);   

      setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             dataType: 'json',
             contentType: false,
             cache: false,
             processData:false,
             data: formData,
             success: function(o)
             {       
                $('#modal-create-message').modal('hide');

                if( o.is_success == 1 ){
                  Swal.fire({
                      text: 'Customer message was successfully sent',
                      icon: 'success',
                      showCancelButton: false,
                      confirmButtonColor: '#32243d',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Ok'
                  }).then((result) => {
                      location.reload();
                  });
                }else{
                  
                  Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    confirmButtonColor: '#32243d',
                    html: o.msg
                  });
                } 
                $(".btn-send-message").html('Save');
             }
          });
      }, 800);
    });

    $("#frm-delete-message").submit(function(e){
        e.preventDefault();

        var url = base_url + 'customer/_delete_customer_message';
        $(".btn-delete-message").html('<span class="spinner-border spinner-border-sm m-0"></span>');
        setTimeout(function () {
            $.ajax({
               type: "POST",
               url: url,
               dataType: "json",
               data: $("#frm-delete-message").serialize(),
               success: function(o)
               {
                  if( o.is_success ){
                      $("#modal-delete-message").modal('hide');
                      Swal.fire({
                          title: 'Success',
                          text: 'Customer message was successfully deleted.',
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

                  $(".btn-delete-message").html('Yes');
               }
            });
        }, 1000);
    });
});
</script>
