<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('v2/includes/header'); ?>
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
                            <button name="button"><i class='bx bx-x'></i></button>
                            Manage and track your customer lending history and creditors.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 grid-mb">
                        <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" placeholder="Search">
                        </div>
                    </div>
                    <div class="col-6 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button primary" onclick="location.href='<?= base_url('customer/add_dispute_item/'.$cus_id) ?>'">
                                <i class='bx bx-plus'></i> Add New
                            </button>
                            <?php if(checkRoleCanAccessModule('customer-settings', 'write')){ ?>
                                <button type="button" class="nsm-button primary" id="btn-manage-creditors-furnishers">
                                    <i class='bx bx-fw bx-briefcase'></i> Manage Creditors / Furnishers
                                </button>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <div class="tab-content mt-4">
                    <table class="nsm-table" id="credit-industry-list-table">
                        <thead>
                        <tr>
                            <td class="table-icon"></td>
                            <td data-name="Creditor Furnisher">Creditor / Furnisher</td>
                            <td data-name="Account Number">Account Number</td>                    
                            <td data-name="Dispute Items">Dispute Items</td>                                
                            <?php foreach($creditBureaus as $cb){ ?>
                                <td data-name="<?= $cb->name; ?>">
                                    <img style="width:97px;" src="<?= base_url('uploads/credit_bureaus/'.$cb->logo); ?>" alt="<?= $cb->name; ?>" />
                                </td>
                            <?php } ?>    
                            <td data-name="Manage" style="width:3%;"></td>
                        </tr>
                        </thead>
                        <tbody>
                            <?php foreach($companyDispute as $cd){ ?>
                                <tr>
                                    <td><div class="table-row-icon"><i class='bx bx-briefcase'></i></div></td>
                                    <td class="fw-bold nsm-text-primary"><?= $cd->furnisher_name; ?></td>
                                    <td class="nsm-text-primary">
                                        <ul class="cb-account-numbers">
                                        <?php foreach($cd->disputeItems as $item ){ ?>
                                            <li><?= $item->cb_name; ?> : <?= $item->account_number; ?></li>
                                        <?php } ?>
                                        </ul>
                                    </td>
                                    <td><?= $cd->instruction; ?></td>
                                    <?php foreach($creditBureaus as $cb){ ?>
                                        <td>
                                            <?php if( isset($cbStatus[$cd->id][$cb->id]) ){ ?>
                                                <span class="cb-status">
                                                    <?= $cbStatus[$cd->id][$cb->id]['status']; ?>              
                                                </span>
                                            <?php }else{ ?>
                                                <span class="cb-status">---</span>
                                            <?php } ?>
                                        </td>
                                    <?php } ?>
                                    <td>
                                        <div class="dropdown table-management">
                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <?php if(checkRoleCanAccessModule('customer-settings', 'write')){ ?>
                                                <li><a class="dropdown-item edit-dispute" href="javascript:void(0);" data-id="<?= $cd->id ?>">Edit</a></li>                                            
                                                <?php } ?>
                                                <?php if(checkRoleCanAccessModule('customer-settings', 'delete')){ ?>
                                                <li><a class="dropdown-item delete-dispute" href="javascript:void(0);" data-id="<?= $cd->id; ?>">Delete</a></li>                                            
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <div class="modal fade nsm-modal fade" id="modal-edit-dispute" tabindex="-1" aria-labelledby="modal-edit-dispute_label" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                        <form method="POST" id="frm-update-dispute" class="modal-content">
                            <input type="hidden" name="did" id="editdid" />
                            <div class="modal-header">
                                <span class="modal-title content-title">Edit Dispute Item</span>
                                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                            </div>
                            <div class="modal-body"></div>
                            <div class="modal-footer">
                                <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="nsm-button primary" id="btn-update-dispute">Save</button>
                            </div>  
                        </form>       
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php include viewPath('v2/includes/footer'); ?>
<script>
    $(document).ready(function() {
        $(".nsm-table").nsmPagination();
        $("#search_field").on("input", debounce(function() {
            tableSearch($(this));        
        }, 1000));

        $('#btn-manage-creditors-furnishers').on('click', function(){
            var url = base_url + 'creditor_furnisher/list';
            window.open(url, '_blank').focus();
        });

        $(document).on('click', '.delete-dispute', function(){
            var did  = $(this).attr('data-id');   
            var cdid = "<?= $cid; ?>";         

            Swal.fire({
                title: 'Delete',
                html: `Proceed with deleting selected item?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: base_url + 'customer/_delete_customer_dispute',
                        dataType: 'json',
                        data: {did:did,cdid:cdid},
                        success: function(o){  
                            if( o.is_success == 1 ){
                                Swal.fire({
                                    title: 'Delete',
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
                        }
                    });
                }
            });
        });

        $(document).on('click', '.edit-dispute', function(){
            var did = $(this).attr('data-id');
            var url = base_url + 'customer/_edit_dispute_item';

            $('#editdid').val(did);
            $('#modal-edit-dispute').modal('show');
            
            $.ajax({
                type: "POST",
                url: url,   
                data: {did:did},
                success: function(o)
                {  
                    $("#modal-edit-dispute .modal-body").html(o);
                },
                beforeSend: function()
                {
                    $("#modal-edit-dispute .modal-body").html('<span class="spinner-border spinner-border-sm m-0"></span>');
                }
            });

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

            var formData = new FormData($("#frm-update-dispute")[0]);   
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
                        title: 'Edit Dispute Item',
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
                },
                beforeSend: function(){
                    $(".btn-update-dispute").html('<span class="spinner-border spinner-border-sm m-0"></span>');
                }
            });
        });
    });
</script>