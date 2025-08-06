<?php include viewPath('v2/includes/header'); ?>
<style>
.custom-link, .custom-link:hover{
    text-decoration:none;
    color:inherit;
}
.btn-nsm-custom {
    color: #ffffff; 
    background-color: #6a4a86; 
    margin-top: -2px;
}
</style>
<?php if (hasPermissions('WORKORDER_MASTER')) : ?>
    <div class="nsm-fab-container">
        <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?php echo url('invoice/recurring/add') ?>'">
            <i class="bx bx-repeat"></i>
        </div>
    </div>
<?php endif; ?>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
    <?php include viewPath('v2/includes/page_navigations/invoce_tabs_v2'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/invoice_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Invoices that business sends to a customer at regular intervals, such as weekly, monthly, or annually. Recurring invoices are useful for businesses with repeat clients who pay the same amount each interval.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4" style="">
                        <div class="nsm-counter primary h-100 mb-2" style="">
                            <a class="custom-link" href="<?= base_url('invoice/recurring/paid') ?>">
                            <div class="row h-100">
                                <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                    <i class='bx bx-receipt'></i>
                                </div>
                                <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                    <h2>$<?= number_format($totalRecurringInvoices->total_amount,2,".",","); ?></h2>
                                    <span>Total Recurring Invoice</span>
                                </div>
                            </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="nsm-counter secondary h-100 mb-2" style="">
                            <a class="custom-link" href="<?= base_url('invoice/recurring/unpaid') ?>">
                            <div class="row h-100">
                                <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                    <i class='bx bx-receipt'></i>
                                </div>
                                <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                    <h2>$<?= number_format($totalUnPaidInvoices->total_amount,2,".",","); ?></h2>
                                    <span>Total Unpaid</span>
                                </div>
                            </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-12 col-md-4" style="">
                        <div class="nsm-counter primary success h-100 mb-2" style="">
                            <a class="custom-link" href="<?= base_url('invoice/recurring/paid') ?>">
                            <div class="row h-100">
                                <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                    <i class='bx bx-receipt'></i>
                                </div>
                                <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                    <?php if($totalPaidInvoicesV2->total_amount > 0) { ?>
                                        <h2>$<?= number_format($totalPaidInvoicesV2->total_amount,2,".",","); ?></h2>
                                    <?php } else { ?>
                                        <h2>$<?= number_format($totalPaidInvoices->total_amount,2,".",","); ?></h2>
                                    <?php } ?>
                                    <span>Total Paid</span>
                                </div>
                            </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row mt-5 mb-2">
                    <div class="col-12 col-md-4">
                        <form action="<?php echo base_url('invoice') ?>" method="get">
                            <div class="nsm-field-group search">
                                <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" for="tbl-invoice-recurring" placeholder="Search">
                            </div>
                        </form>
                    </div>
                    <div class="col-12 col-md-8 grid-mb text-end">

                        <?php if(checkRoleCanAccessModule('invoice', 'write')){ ?>
                            <div class="dropdown d-inline-block">
                                <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                    <span id="num-checked"></span> With Selected  <i class='bx bx-fw bx-chevron-down'></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end select-filter"> 
                                    <li><a class="dropdown-item btn-with-selected" id="with-selected-delete" href="javascript:void(0);" data-action="delete">Delete</a></li>                                
                                </ul>
                            </div>   
                        <?php } ?>   

                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>Filter By Status: <?= $filter_status != '' ? ucwords($filter_status) : 'All'; ?></span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end select-filter">
                                <li><a class="dropdown-item" href="<?php echo base_url('invoice/recurring') ?>">All</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('invoice/recurring/paid') ?>">Paid</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('invoice/recurring/unpaid') ?>">Unpaid</a></li>

                                <li><a class="dropdown-item" href="<?php echo base_url('invoice/recurring/draft') ?>">Draft</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('invoice/recurring/partially_paid') ?>">Partially Paid</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('invoice/recurring/due') ?>">Due</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('invoice/recurring/overdue') ?>">Overdue</a></li>
                            </ul>
                        </div>

                        <!-- <div class="nsm-page-buttons page-button-container">
                            <?php if (hasPermissions('WORKORDER_MASTER')) : ?>
                                <button type="button" class="nsm-button primary" onclick="location.href='<?php echo base_url('invoice/add') ?>'">
                                    <i class='bx bx-fw bx-receipt'></i> Add New Invoice
                                </button>
                            <?php endif; ?>
                        </div> -->

                        <div class="nsm-page-buttons page-button-container">                            
                            <?php if(checkRoleCanAccessModule('invoice', 'write')){ ?>
                            <div class="btn-group">
                                <button type="button" class="btn btn-nsm btn-nsm-custom" id="btn-add-new-invoice"><i class='bx bx-plus' style="position:relative;top:1px;"></i> Add Recurring Invoice</button>
                                <button type="button" class="btn btn-nsm dropdown-toggle dropdown-toggle-split btn-nsm-custom" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class=""><i class='bx bx-chevron-down' ></i></span>
                                </button>
                                <ul class="dropdown-menu">                                
                                    <li><a class="dropdown-item" id="export-invoice-list" href="javascript:void(0);">Export</a></li>                               
                                    <li><a class="dropdown-item" id="archived-invoice-list" href="javascript:void(0);">Archived</a></li>                               
                                </ul>
                            </div>
                            <?php } ?>
                        </div>  
                    </div>
                </div>
                <form id="frm-with-selected">
                <table class="nsm-table" id="tbl-invoice-recurring">
                    <thead>
                        <tr>
                            <?php if(checkRoleCanAccessModule('invoice', 'write')){ ?>
                            <td class="table-icon text-center sorting_disabled">
                                <input class="form-check-input select-all table-select" type="checkbox" name="id_selector" value="0" id="select-all">
                            </td>
                            <?php } ?>                            
                            <td class="table-icon"></td>
                            <td data-name="Invoice Number" class="show">Invoice Number</td>
                            <td data-name="Customer">Customer</td>
                            <td data-name="Invoice Date">Invoice Date</td>
                            <td data-name="Start Date">Start Date</td>
                            <td data-name="End Date">End Date</td>                            
                            <td data-name="Status" class="show">Status</td>
                            <td data-name="Amount" class="show" style="text-align:right;">Amount</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if( $invoices ){ ?>
                            <?php foreach($invoices as $invoice){ ?>
                                <?php 
                                    switch ($invoice->status):
                                        case "Partially Paid":
                                            $badge = "secondary";
                                            break;
                                        case "Paid":
                                            $badge = "success";
                                            break;
                                        case "Due":
                                            $badge = "secondary";
                                            break;
                                        case "Overdue":
                                            $badge = "error";
                                            break;
                                        case "Submitted":
                                            $badge = "success";
                                            break;
                                        case "Approved":
                                            $badge = "success";
                                            break;
                                        case "Declined":
                                            $badge = "error";
                                            break;
                                        case "Scheduled":
                                            $badge = "primary";
                                            break;
                                        case "Draft":
                                            $badge = "error";
                                            break;
                                        default:
                                            $badge = "error";
                                            break;
                                    endswitch;                                    
                                ?>
                                <tr>
                                    <?php if(checkRoleCanAccessModule('invoice', 'write')){ ?>
                                    <td>
                                        <input class="form-check-input row-select table-select" name="invoice[]" type="checkbox" value="<?= $invoice->id; ?>">
                                    </td>
                                    <?php } ?>                                      
                                    <td><div class="table-row-icon"><i class='bx bx-calendar-alt'></i></div></td>
                                    <td class="fw-bold nsm-text-primary nsm-link default show" onclick="location.href='<?php echo base_url('invoice/genview/' . $invoice->id) ?>'"><?= formatInvoiceNumber($invoice->invoice_number) ?></td>
                                    <td class="nsm-text-primary"><?= $invoice->customer_name; ?></td>
                                    <td><?= date("m/d/Y", strtotime($invoice->date_issued)); ?></td>
                                    <td><?= $invoice->bill_start_date ?></td>
                                    <td><?= $invoice->bill_end_date ?></td>
                                    <td class="show">
                                        <span class="status-label nsm-badge <?= $badge ?>" style="font-size: 13px;">
                                            <?= $invoice->status; ?>
                                        </span>
                                    </td>
                                    <td class="show" style="text-align:right;">$<?= number_format($invoice->grand_total,2,".",","); ?></td>
                                    <td>
                                        <div class="dropdown table-management">
                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item" href="<?php echo base_url('invoice/genview/' . $invoice->id) ?>">View</a>
                                                </li>
                                                <?php if($invoice->status != 'Paid') { ?>
                                                    <li>
                                                        <a class="dropdown-item btn-mark-as-paid" href="javascript:void(0);" href="javascript:void(0);" data-number="<?php echo $invoice->invoice_number ?>" data-id="<?php echo $invoice->id ?>">Mark as Paid</a>
                                                    </li>
                                                <?php } ?>
                                                <li>
                                                    <a class="dropdown-item recordPaymentBtn" href="javascript:void(0);" data-status="<?= $invoice->status; ?>" data-id="<?php echo $invoice->id ?>">Record Payment</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="<?php echo base_url('invoice/send/' . $invoice->id) ?>">Send Invoice</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item delete-item" href="javascript:void(0);" data-number="<?php echo $invoice->invoice_number ?>" data-id="<?php echo $invoice->id ?>">Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php }else{ ?>
                            <tr>
                                <td colspan="8">
                                    <div class="nsm-empty">
                                        <span>No results found.</span>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Record Payment -->
    <div class="modal fade nsm-modal fade" id="modalRecordPaymentForm" tabindex="-1" aria-labelledby="modalRecordPaymentForm_label" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <form id="frm-record-payment" method="POST">
                <input type="hidden" name="invoice_id" id="record_payment_invoice_id" value="" />
                <div class="modal-content" style="width:560px;">
                    <div class="modal-header">
                        <span class="modal-title content-title">Record Payment</span>
                        <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                    </div>
                    <div class="modal-body"></div>
                    <div class="modal-footer">                    
                        <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" id="btn-record-payment" class="nsm-button primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade nsm-modal fade" id="modal-archived-invoices" aria-labelledby="modal-archived-invoices-label" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form method="post" id="quick-add-event-form">   
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="modal-title content-title">Archived Recurring Invoices</span>
                        <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                    </div>
                    <div class="modal-body" id="invoices-archived-list-container" style="max-height: 800px; overflow: auto;"></div>
                </div>
            </form>
        </div>
    </div>    

</div>

<script type="text/javascript">
    $(document).ready(function() {
        $(".nsm-table").nsmPagination();
        $("#search_field").on("input", debounce(function() {
            tableSearch($(this));        
        }, 1000));

        $(document).on('click touchstart', '.recordPaymentBtn', function(){
            var invoice_id = $(this).attr('data-id');
            var invoice_status = $(this).attr('data-status');

            if( invoice_status == 'Paid' ){
                Swal.fire({
                    text: 'Invoice already paid. Cannot make any more payment.',
                    icon: 'warning',
                    showCancelButton: false,
                    confirmButtonColor: '#6a4a86',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    //location.reload();
                });   
            }else{
                $('#modalRecordPaymentForm').modal('show');
                showLoader($("#modalRecordPaymentForm .modal-body")); 
                $('#record_payment_invoice_id').val(invoice_id);

                $.ajax({
                    url: base_url + "invoice/_load_record_payment_form",
                    type: "POST",
                    data: {
                        invoice_id: invoice_id
                    },
                    success: function (response) {
                        $("#modalRecordPaymentForm .modal-body").html(response);
                    },
                });
            }
        });

        $(document).on('click', '.btn-mark-as-paid', function(){
            var invoice_id = $(this).attr('data-id');
            var invoice_number = $(this).attr('data-number');
            Swal.fire({
                title: 'Update Invoice',
                html: `Proceed with changing invoice number <b>${invoice_number}</b> status to <b>paid</b>?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: base_url + 'invoice/_update_status/paid',
                        data: {invoice_id:invoice_id},
                        dataType:'json',
                        success: function(result) {
                            if( result.is_success == 1 ) {
                                Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                title: 'Update Invoice',
                                text: 'Data was successfully updated',
                                }).then((result) => {
                                    window.location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: result.msg,
                                });
                            }
                        }
                    });
                }
            });
        });

        $(document).on("click", ".delete-item", function(){
            let id = $(this).attr('data-id');
            let invoice_number = $(this).attr('data-number');

            Swal.fire({
                title: 'Delete Invoice',
                html: `Are you sure you want to delete invoice number <b>${invoice_number}</b>?`,
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: "<?php echo base_url(); ?>invoice/deleteInvoiceBtnNew",
                        data: {
                            id: id
                        },
                        success: function(result) {
                            Swal.fire({
                                title: 'Delete Invoice',
                                text: "Data deleted successfully",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonText: 'Okay'
                            }).then((result) => {
                                if (result.value) {
                                    location.reload();
                                }
                            });
                        },
                    });
                }
            });
        });

        $(document).on('submit', '#frm-record-payment', function(e){
            e.preventDefault();
            var url  = base_url + 'invoice/_create_payment';
            var form = $(this);
            $.ajax({
                type: "POST",
                url: url,
                dataType:'json',
                data: form.serialize(), 
                success: function(data) {
                    if( data.is_success == 1 ){
                        $('#modalRecordPaymentForm').modal('hide');
                        
                        Swal.fire({
                            text: 'Invoice payment was successfully created',
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#6a4a86',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            location.reload();
                        });    
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            html: data.msg
                        });
                    }
                    
                    $("#btn-record-payment").html('Save');
                }, beforeSend: function() {
                    $("#btn-record-payment").html('<span class="bx bx-loader bx-spin"></span>');
                }
            });
        });

        $(document).on("click", "#btn-add-new-invoice", function(){
            let url = "<?php echo base_url('invoice/add'); ?>";
            location.href = url;            
        });
        
        $("#export-invoice-list").on("click", function() {
            location.href = "<?php echo base_url('invoice/export_list?is_recurring=1'); ?>";
        });   
        
        $('#archived-invoice-list').on('click', function(){
            $('#modal-archived-invoices').modal('show');
            $.ajax({
                type: "POST",
                url: base_url + "invoice/_recurring_archived_list",  
                success: function(html) {    
                    $('#invoices-archived-list-container').html(html);                          
                },
                beforeSend: function() {
                    $('#invoices-archived-list-container').html('<span class="bx bx-loader bx-spin"></span>');
                }
            });
        }); 
        
        $(document).on('change', '#select-all', function(){
            $('.row-select:checkbox').prop('checked', this.checked);  
            let total= $('input[name="invoice[]"]:checked').length;
            if( total > 0 ){
                $('#num-checked').text(`(${total})`);
            }else{
                $('#num-checked').text('');
            }
        });

        $(document).on('change', '.row-select', function(){
            let total= $('input[name="invoice[]"]:checked').length;
            if( total > 0 ){
                $('#num-checked').text(`(${total})`);
            }else{
                $('#num-checked').text('');
            }
        });   
        
        $(document).on('click', '#with-selected-delete', function(){
            let total= $('input[name="invoice[]"]:checked').length;
            if( total <= 0 ){
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Please select rows',
                });
            }else{
                Swal.fire({
                    title: 'Delete Invoice',
                    html: `Are you sure you want to delete selected invoices?<br /><br /><small>Deleted data can be restored via archived list.</small>`,
                    icon: 'question',
                    confirmButtonText: 'Proceed',
                    showCancelButton: true,
                    cancelButtonText: "Cancel"
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            method: 'POST',
                            url: base_url + 'invoice/_archive_selected_invoices',
                            dataType: 'json',
                            data: $('#frm-with-selected').serialize(),
                            success: function(result) {                        
                                if( result.is_success == 1 ) {
                                    Swal.fire({
                                        title: 'Delete Invoice',
                                        text: "Data deleted successfully!",
                                        icon: 'success',
                                        showCancelButton: false,
                                        confirmButtonText: 'Okay'
                                    }).then((result) => {
                                        //if (result.value) {
                                            location.reload();
                                        //}
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: result.msg,
                                    });
                                }
                            },
                        });

                    }
                });
            }        
        });           

        //For Achived Modal List - Start
        $(document).on('change', '#select-all-archived', function(){
            $('.row-select-archived:checkbox').prop('checked', this.checked);  
            let total= $('input[name="invoice[]"]:checked').length;
            if( total > 0 ){
                $('#num-checked-arhived').text(`(${total})`);
            }else{
                $('#num-checked-arhived').text('');
            }
        });

        $(document).on('change', '.row-select-archived', function(){
            let total= $('input[name="invoice[]"]:checked').length;
            if( total > 0 ){
                $('#num-checked-arhived').text(`(${total})`);
            }else{
                $('#num-checked-arhived').text('');
            }
        });
        
        $(document).on('click', '#with-selected-restore', function(){
            let total= $('input[name="invoice[]"]:checked').length;
            if( total <= 0 ){
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Please select rows',
                });
            }else{
                Swal.fire({
                    title: 'Restore Invoices',
                    html: `Are you sure you want to restore the selected invoices?`,
                    icon: 'question',
                    confirmButtonText: 'Proceed',
                    showCancelButton: true,
                    cancelButtonText: "Cancel"
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            method: 'POST',
                            url: base_url + 'invoice/_restore_selected_invoices',
                            dataType: 'json',
                            data: $('#frm-with-selected-archived').serialize(),
                            success: function(result) {                        
                                if( result.is_success == 1 ) {
                                    Swal.fire({
                                        title: 'Restore Invoice',
                                        text: "Data restore successfully!",
                                        icon: 'success',
                                        showCancelButton: false,
                                        confirmButtonText: 'Okay'
                                    }).then((result) => {
                                        //if (result.value) {
                                            location.reload();
                                        //}
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: result.msg,
                                    });
                                }
                            },
                        });

                    }
                });
            }        
        }); 

        $(document).on('click', '#with-selected-permanent-delete', function(){
            let total= $('input[name="invoice[]"]:checked').length;
            if( total <= 0 ){
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Please select rows',
                });
            }else{
                Swal.fire({
                    title: 'Delete Invoices Permanently',
                    html: `Would you like to permanently delete the selected invoices? You will no longer recover this data.`,
                    icon: 'question',
                    confirmButtonText: 'Proceed',
                    showCancelButton: true,
                    cancelButtonText: "Cancel"
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            method: 'POST',
                            url: base_url + 'invoice/_delete_permanent_selected_invoices',
                            dataType: 'json',
                            data: $('#frm-with-selected-archived').serialize(),
                            success: function(result) {                        
                                if( result.is_success == 1 ) {
                                    Swal.fire({
                                        title: 'Permanently Delete Invoice',
                                        text: "Data permanently delete successfully!",
                                        icon: 'success',
                                        showCancelButton: false,
                                        confirmButtonText: 'Okay'
                                    }).then((result) => {
                                        //if (result.value) {
                                            location.reload();
                                        //}
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: result.msg,
                                    });
                                }
                            },
                        });

                    }
                });
            }        
        }); 

        $(document).on('click', '.btn-restore-invoice', function(){
            var invoice_id = $(this).attr('data-id');
            var invoice_number = $(this).attr('data-invoicenumber');

            Swal.fire({
                title: 'Restore Invoice Data',
                html: `Proceed with restoring invoice data <b>${invoice_number}</b>?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {                    
                    $.ajax({
                        type: "POST",
                        url: base_url + "invoice/_restore_archived",
                        data: {invoice_id:invoice_id},
                        dataType:'json',
                        success: function(result) {                            
                            if( result.is_success == 1 ) {
                                $('#modal-archived-invoices').modal('hide');
                                Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Invoice data was successfully restored.',
                                }).then((result) => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: result.msg,
                                });
                            }
                        }
                    });
                }
            });
        });

        $(document).on('click', '.btn-permanent-delete-invoice', function(){
            var invoice_id     = $(this).attr('data-id');
            var invoice_number = $(this).attr('data-invoicenumber');

            Swal.fire({
                title: 'Permanent Delete Invoice Data',
                html: `Would you like to permanently delete the invoice <b>#${invoice_number}</b>? You will no longer recover this data.`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {                    
                    $.ajax({
                        type: "POST",
                        url: base_url + "invoice/_permanent_delete",
                        data: {invoice_id:invoice_id},
                        dataType:'json',
                        success: function(result) {                            
                            if( result.is_success == 1 ) {
                                $('#modal-archived-invoices').modal('hide');
                                Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Invoice data was successfully deleted permanently.',
                                }).then((result) => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: result.msg,
                                });
                            }
                        }
                    });
                }
            });
        });        

        $(document).on('click', '#btn-empty-invoice-archives', function(){        
            let total_records = $('#archived-invoices input[name="invoice[]"]').length;                           
            if( total_records > 0 ){
                Swal.fire({
                    title: 'Empty Archived',
                    html: `Are you sure you want to <b>permanently delete</b> <b>${total_records}</b> archived invoices? <br/><br/>Note : This cannot be undone.`,
                    icon: 'question',
                    confirmButtonText: 'Proceed',
                    showCancelButton: true,
                    cancelButtonText: "Cancel"
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            method: 'POST',
                            url: base_url + 'invoice/_delete_all_recurring_archived_invoices',
                            dataType: 'json',
                            data: $('#frm-with-selected-archived').serialize(),
                            success: function(result) {                        
                                if( result.is_success == 1 ) {
                                    $('#modal-archived-invoices').modal('hide');
                                    Swal.fire({
                                        title: 'Empty Archived',
                                        text: "Data deleted successfully!",
                                        icon: 'success',
                                        showCancelButton: false,
                                        confirmButtonText: 'Okay'
                                    }).then((result) => {
                                        //if (result.value) {
                                            //location.reload();
                                        //}
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: result.msg,
                                    });
                                }
                            },
                        });

                    }
                });
            }else{
                Swal.fire({                
                    icon: 'error',
                    title: 'Error',              
                    html: 'Archived is empty',
                });
            }        
        });           
        //For Achived Modal List - End          
            
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>