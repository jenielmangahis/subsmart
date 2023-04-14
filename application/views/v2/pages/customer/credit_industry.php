<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/estimate/estimate_modals'); ?>
<?php include viewPath('v2/includes/customer/customer_modals'); ?>

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

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/customer_module_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Here are all credit report items you've saved for this client.
                        </div>
                    </div>
                </div>
                <div class="h1-spacer">
                                        <a class="btn btn-primary btn-md btn-customer-create-message" onclick="window.open('<?= base_url('customer/add_dispute_item/'.$cus_id) ?>', '_blank','location=yes, height=650, width=1200, scrollbars=yes, status=yes');">
                                            <span class="fa fa-plus"></span> Add New Item
                                        </a>
                                        <a class="btn btn-primary btn-md btn-customer-add-note" onclick="window.open('<?= base_url('creditor_furnisher/list') ?>', '_blank','location=yes, height=650, width=1200, scrollbars=yes, status=yes');">
                                            <span class="fa fa-plus"></span> Manage Creditors / Furnishers
                                        </a>
                                    </div>
                                    <br>
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
                <!-- <table class="nsm-table">
                    <thead>
                        <tr>
                            <td class="table-icon"></td>
                            <td data-name="Item Name">Item Name</td>
                            <td data-name="Quantity">Quantity</td>
                            <td data-name="Price">Price</td>
                            <td data-name="Total">Total</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($inventory)) :
                        ?>
                            <?php
                            foreach ($inventory as $i) :
                            ?>
                                <tr>
                                    <td>
                                        <div class="table-row-icon">
                                            <i class='bx bx-user-pin'></i>
                                        </div>
                                    </td>
                                    <td class="nsm-text-primary" colspan="4">
                                        <label class="nsm-link default d-block fw-bold" onclick="location.href='<?= base_url('job/job_preview/' . $i['job']->id); ?>'"><?= $i['job']->job_number . ' - ' . $i['job']->job_description; ?></label>
                                    </td>
                                </tr>

                                <?php
                                $total_amount = 0;
                                foreach ($i['items'] as $item) :
                                    $total_row_price = $item->price * $item->qty;
                                    $total_amount += $total_row_price;
                                ?>
                                    <tr>
                                        <td>
                                            <div class="table-row-icon">
                                                <i class='bx bx-user-pin'></i>
                                            </div>
                                        </td>
                                        <td class="nsm-text-primary">
                                            <label class="nsm-link default d-block fw-bold"><?= $item->title; ?></label>
                                        </td>
                                        <td><?= $item->qty; ?></td>
                                        <td><?= number_format($item->price, 2); ?></td>
                                        <td><?= number_format($total_row_price, 2); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                <tr>
                                    <td>
                                        <div class="table-row-icon">
                                            <i class='bx bx-user-pin'></i>
                                        </div>
                                    </td>
                                    <td class="nsm-text-primary">
                                        <label class="nsm-link default d-block fw-bold">Total</label>
                                    </td>
                                    <td colspan="3"><?= number_format($total_amount,2); ?></td>
                                </tr>
                            <?php
                            endforeach;
                            ?>
                        <?php
                        else :
                        ?>
                            <tr>
                                <td colspan="5">
                                    <div class="nsm-empty">
                                        <span>No results found.</span>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        endif;
                        ?>
                    </tbody>
                </table> -->

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

                                    <!-- Modal Edit Dispute -->
                                    <div class="modal fade bd-example-modal-md" id="modal-edit-dispute" tabindex="-1" role="dialog" aria-labelledby="modalDeleteWorkorderTypeTitle" aria-hidden="true">
                                      <div class="modal-dialog modal-xl" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-pencil"></i> Edit Dispute</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <?php echo form_open_multipart('', ['class' => 'form-validate', 'id' => 'frm-update-dispute', 'autocomplete' => 'off' ]); ?>
                                          <?php echo form_input(array('name' => 'did', 'type' => 'hidden', 'value' => '', 'id' => 'editdid'));?>
                                          <div class="modal-body" style="overflow-y: scroll;max-height: 800px;"></div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary btn-update-dispute">Save</button>
                                          </div>
                                          <?php echo form_close(); ?>
                                        </div>
                                      </div>
                                    </div>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $(".nsm-table").nsmPagination();
    });
</script>


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
        var did = $(this).attr('data-id');
        var url = base_url + 'customer/_edit_dispute_item';

        $('#editdid').val(did);

        $('#modal-edit-dispute').modal('show');
        $("#modal-edit-dispute .modal-body").html('<span class="spinner-border spinner-border-sm m-0"></span>');

        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,   
             data: {did:did},
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

    $("#frm-update-dispute").submit(function(e){
        e.preventDefault();
        var url = base_url + 'customer/_update_customer_dispute';
        $(".btn-update-dispute").html('<span class="spinner-border spinner-border-sm m-0"></span>');

        var formData = new FormData($("#frm-update-dispute")[0]);   

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
                $("#modal-edit-dispute").modal('hide');

                if( o.is_success == 1 ){
                  Swal.fire({
                      title: 'Great!',
                      text: 'Dispute was successfully updated.',
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
                $(".btn-update-dispute").html('Save');
             }
          });
        }, 800);
    });
});
</script>

<?php include viewPath('v2/includes/footer'); ?>



