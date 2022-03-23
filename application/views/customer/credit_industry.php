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
    .cb-account-numbers{
        list-style: none;
        padding: 0px;
        margin: 0px;
    }
    .cb-account-numbers li{
        display: block;
        width: 100%;
        margin: 5px;
    }
    .cb-status-icon{
        font-size: 28px;
        margin-bottom: 8px;
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
                                    <h2 class="page-title" style="display:inline-block;">Credit Industry </h2>
                                    <span style="display:inline-block;color:#4a4a4a;font-size: 28px;margin-left: 9px;">(<i><?= $customer->first_name . ' ' . $customer->last_name; ?></i>)</span>
                                </div>
                                <div class="col-auto">
                                    <div class="h1-spacer">
                                        <a class="btn btn-primary btn-md btn-customer-create-message" href="<?= base_url('customer/add_dispute_item/'.$cus_id) ?>">
                                            <span class="fa fa-plus"></span> Add New Item
                                        </a>
                                        <a class="btn btn-primary btn-md btn-customer-add-note" href="<?= base_url('creditor_furnisher/list') ?>">
                                            <span class="fa fa-plus"></span> Manage Creditors / Furnishers
                                        </a>
                                    </div>
                                </div>
                                <div class="alert alert-warning col-md-12 mt-4 mb-4" role="alert">
                                    <span style="color:black;">
                                        Here are all credit report items you've saved for this client.
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
                                                <th style="width:20%;">Creditor/Furnisher</th>
                                                <th style="width:20%;">Account #</th>
                                                <th style="width:20%;">Dispute Items</th>
                                                <?php foreach($creditBureaus as $cb){ ?>
                                                    <th style="width:10%;">
                                                        <img style="width:97px;" src="<?= base_url('uploads/credit_bureaus/'.$cb->logo); ?>" alt="<?= $cb->name; ?>" />
                                                    </th>
                                                <?php } ?>
                                                <th style="width:10%;"></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($companyDispute as $cd){ ?>
                                                    <tr>
                                                        <td><?= $cd->furnisher_name; ?></td>
                                                        <td>
                                                            <ul class="cb-account-numbers">
                                                            <?php foreach($cd->disputeItems as $item ){ ?>
                                                                <li><?= $item->cb_name; ?> : <?= $item->account_number; ?></li>
                                                            <?php } ?>
                                                            </ul>
                                                        </td>
                                                        <td><?= $cd->instruction; ?></td>
                                                        <?php foreach($creditBureaus as $cb){ ?>
                                                            <td style="text-align:center;">
                                                                <?php if( isset($cbStatus[$cd->id][$cb->id]) ){ ?>
                                                                    <span class="cb-status">
                                                                        <i class="cb-status-icon fa <?= $cbStatus[$cd->id][$cb->id]['icon']; ?>"></i><br />
                                                                        <?= $cbStatus[$cd->id][$cb->id]['status']; ?>              
                                                                    </span>
                                                                <?php }else{ ?>
                                                                    <span class="cb-status">---</span>
                                                                <?php } ?>
                                                            </td>
                                                        <?php } ?>
                                                        <td class="text-right" style="vertical-align:top;">
                                                            <div class="dropdown dropdown-btn">
                                                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdown-edit" data-toggle="dropdown" aria-expanded="true">
                                                                    <span class="btn-label">Manage</span><span class="caret-holder"><span class="caret"></span></span>
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdown-edit">
                                                                    <li role="presentation">
                                                                        <a role="menuitem" class="edit-dispute" href="javascript:void(0);" data-id="<?= $cd->id ?>">
                                                                            <span class="fa fa-pencil-square-o icon"></span> Edit
                                                                        </a>
                                                                    </li>
                                                                    <li role="presentation">
                                                                        <a role="menuitem" class="delete-dispute" href="javascript:void(0);" data-id="<?= $cd->id; ?>">
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

                                    <!-- Modal Delete Dispute -->
                                    <div class="modal fade bd-example-modal-md" id="modal-delete-dispute" tabindex="-1" role="dialog" aria-labelledby="modalDeleteWorkorderTypeTitle" aria-hidden="true">
                                      <div class="modal-dialog modal-md" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-trash"></i> Delete</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <?php echo form_open_multipart('', ['class' => 'form-validate', 'id' => 'frm-delete-dispute', 'autocomplete' => 'off' ]); ?>
                                          <?php echo form_input(array('name' => 'did', 'type' => 'hidden', 'value' => '', 'id' => 'did'));?>
                                          <?php echo form_input(array('name' => 'cdid', 'type' => 'hidden', 'value' => $cus_id, 'id' => 'cdid'));?>
                                          <div class="modal-body">
                                              <p>Are you sure you want to delete selected dispute?</p>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                            <button type="submit" class="btn btn-danger btn-delete-dispute">Yes</button>
                                          </div>
                                          <?php echo form_close(); ?>
                                        </div>
                                      </div>
                                    </div>

                                    <!-- Modal Delete Dispute -->
                                    <div class="modal fade bd-example-modal-md" id="modal-edit-dispute" tabindex="-1" role="dialog" aria-labelledby="modalDeleteWorkorderTypeTitle" aria-hidden="true">
                                      <div class="modal-dialog modal-md" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-trash"></i> Edit</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <?php echo form_open_multipart('', ['class' => 'form-validate', 'id' => 'frm-delete-dispute', 'autocomplete' => 'off' ]); ?>
                                          <?php echo form_input(array('name' => 'did', 'type' => 'hidden', 'value' => '', 'id' => 'did'));?>
                                          <div class="modal-body"></div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-danger btn-delete-dispute">Save</button>
                                          </div>
                                          <?php echo form_close(); ?>
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

    $(document).on('click', '.delete-dispute', function(){
        var did = $(this).attr('data-id');            

        $("#did").val(did);
        $("#modal-delete-dispute").modal('show');
    });

    $(document).on('click', '.edit-dispute', function(){
        var url = base_url + 'customer/_edit_dispute_item';

        $('#modal-edit-dispute').modal('show');
        $("#modal-edit-dispute .modal-body").html('<span class="spinner-border spinner-border-sm m-0"></span>');

        var formData = new FormData($("#frm-delete-dispute")[0]);   

        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,             
             contentType: false,
             cache: false,
             processData:false,
             data: formData,
             success: function(o)
             {  
                $("#modal-edit-dispute .modal-body").html(o);
             }
          });
        }, 800);

    });

    $("#frm-delete-dispute").submit(function(e){
        e.preventDefault();
        var url = base_url + 'customer/_delete_customer_dispute';
        $(".btn-delete-dispute").html('<span class="spinner-border spinner-border-sm m-0"></span>');

        var formData = new FormData($("#frm-delete-dispute")[0]);   

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
                $("#modal-delete-dispute").modal('hide');

                if( o.is_success == 1 ){
                  Swal.fire({
                      title: 'Great!',
                      text: 'Dispute was successfully deleted.',
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
                $(".btn-delete-dispute").html('Delete');
             }
          });
        }, 800);
    });
});
</script>
