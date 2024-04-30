<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/invoice/invoice_modals'); ?>
<style>
.status-label{
 font-size:13px;
}    
</style>
<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?php echo base_url('invoice/add') ?>'">
        <i class="bx bx-receipt"></i>
    </div>
</div>

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
                            <button name="button"><i class='bx bx-x'></i></button>
                            An invoice provides customers with a detailed description and cost of the products or services that you have provided. Invoices are required for sales where the customers do not pay you immediately. Our invoices are tracked so that you know how much each customer owes you and when payment is due. This listing and our dashboard widget will help you keep your eyes on your money.
                        </div>
                    </div>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-12 col-md-4">
                        <div class="nsm-counter primary h-100 mb-2">
                            <div class="row h-100">
                                <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                    <i class='bx bx-receipt'></i>
                                </div>
                                <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                    <h2 id="total_this_year">$<?php echo get_invoice_amount('total') ?></h2>
                                    <span>Total Invoice</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="nsm-counter secondary h-100 mb-2">
                            <div class="row h-100">
                                <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                    <i class='bx bx-receipt'></i>
                                </div>
                                <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                    <h2 id="pending_total">$<?php echo get_invoice_amount('unpaid') ?></h2>
                                    <span>Unpaid</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="nsm-counter success h-100 mb-2">
                            <div class="row h-100">
                                <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                    <i class='bx bx-receipt'></i>
                                </div>
                                <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                    <h2 id="paid_total">$<?php echo get_invoice_amount('paid') ?></h2>
                                    <span>Paid</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <form action="<?php echo base_url('invoice') ?>" method="get">
                            <div class="nsm-field-group search">
                                <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" name="search" placeholder="Search Invoice" value="<?php echo (!empty($search)) ? $search : '' ?>">
                            </div>
                        </form>
                    </div>
                    <div class="col-12 col-md-8 grid-mb text-end">
                        <!-- <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>Filter by Source</span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end select-filter">
                                <li><a class="dropdown-item" href="<?php echo base_url('customer') ?>">Source</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('customer?type=residential') ?>">Residential</a></li>
                            </ul>
                        </div> -->
                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>Sort by <?= $sort_by; ?></span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end select-filter">
                                <li><a class="dropdown-item" href="<?php echo (!empty($type)) ? base_url('invoice?type=' . $type . '&order=date_created-desc') : base_url('invoice?order=date_created-desc') ?>">Newest First</a></li>
                                <li><a class="dropdown-item" href="<?php echo (!empty($type)) ? base_url('invoice?type=' . $type . '&order=date_created-asc') : base_url('invoice?order=date_created-asc') ?>">Oldest First</a></li>
                                <li><a class="dropdown-item" href="<?php echo (!empty($type)) ? base_url('invoice?type=' . $type . '&order=invoice_number-asc') : base_url('invoice?order=invoice_number-asc') ?>">Invoice Number: Asc</a></li>
                                <li><a class="dropdown-item" href="<?php echo (!empty($type)) ? base_url('invoice?type=' . $type . '&order=invoice_number-desc') : base_url('invoice?order=invoice_number-desc') ?>">Invoice Number: Desc</a></li>                                
                                <li><a class="dropdown-item" href="<?php echo (!empty($type)) ? base_url('invoice?type=' . $type . '&order=grand_total-desc') : base_url('invoice?order=grand_total-asc') ?>">Amount: Lowest</a></li>
                                <li><a class="dropdown-item" href="<?php echo (!empty($type)) ? base_url('invoice?type=' . $type . '&order=grand_total-asc') : base_url('invoice?order=grand_total-desc') ?>">Amount: Highest</a></li>
                            </ul>
                        </div>
                        <div class="dropdown d-inline-block">
                            <?php
                            switch ($tab) {
                                case 2:
                                    $status = "Due";
                                    break;
                                case 3:
                                    $status = "Overdue";
                                    break;
                                case 4:
                                    $status = "Partially Paid";
                                    break;
                                case 5:
                                    $status = "Paid";
                                    break;
                                case 6:
                                    $status = "Draft";
                                    break;
                                default:
                                    $status = "All";
                                    break;
                            }
                            ?>
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>Filter by <?= $status ?></span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end select-filter">
                                <li><a class="dropdown-item" data-id="filter_all" href="<?php echo base_url('invoice') ?>">All</a></li>
                                <li><a class="dropdown-item" data-id="filter_due" href="<?php echo base_url('invoice/tab/2') ?>">Due</a></li>
                                <li><a class="dropdown-item" data-id="filter_overdue" href="<?php echo base_url('invoice/tab/3') ?>">Overdue</a></li>
                                <li><a class="dropdown-item" data-id="filter_partial" href="<?php echo base_url('invoice/tab/4') ?>">Partially Paid</a></li>
                                <li><a class="dropdown-item" data-id="filter_paid" href="<?php echo base_url('invoice/tab/5') ?>">Paid</a></li>
                                <li><a class="dropdown-item" data-id="filter_draft" href="<?php echo base_url('invoice/tab/6') ?>">Draft</a></li>
                            </ul>
                        </div>
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button primary" onclick="location.href='<?php echo base_url('invoice/add') ?>'">
                                <i class='bx bx-fw bx-receipt'></i> Add New Invoice
                            </button>
                        </div>
                    </div>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td class="table-icon"></td>
                            <td data-name="Invoice Number">Invoice Number</td>
                            <td data-name="Date Issued">Date Issued</td>
                            <td data-name="Date Due">Date Due</td>
                            <td data-name="Job & Customer">Job & Customer</td>
                            <td data-name="Status">Status</td>
                            <td data-name="Amount">Amount</td>
                            <td data-name="Amount">Balance</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($invoices)) :
                        ?>
                            <?php
                            foreach ($invoices as $invoice) :
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
                                    <td>
                                        <div class="table-row-icon">
                                            <i class='bx bx-receipt'></i>
                                        </div>
                                    </td>
                                    <td class="fw-bold nsm-text-primary nsm-link default" onclick="location.href='<?php echo base_url('invoice/genview/' . $invoice->id) ?>'"><?= formatInvoiceNumber($invoice->invoice_number) ?></td>
                                    <td><?php echo get_format_date($invoice->date_issued) ?></td>
                                    <td><?php echo get_format_date($invoice->due_date) ?></td>
                                    <td>
                                        <label class="d-block"><?php echo $invoice->first_name . ' ' . $invoice->last_name; ?></label>
                                        <a class="nsm-link" href="<?php echo base_url('customer/genview/' . $invoice->customer_id) ?>">
                                            <?php echo $invoice->job_name ?>
                                        </a>
                                    </td>
                                    <td>
                                        <span class="status-label nsm-badge <?= $badge ?>">
                                            <?php 
                                                if( $invoice->status == '' ){
                                                    echo 'Draft';
                                                }else{
                                                    echo $invoice->status;
                                                }
                                            ?>                                            
                                        </span>
                                    </td>
                                    <td>$<?php echo number_format((float)$invoice->grand_total,2); ?></td>
                                    <td>$<?php echo number_format((float)$invoice->balance,2); ?></td>
                                    <td>
                                        <div class="dropdown table-management">
                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item" href="<?php echo base_url('invoice/genview/' . $invoice->id) ?>">View Invoice</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="<?php echo base_url('invoice/send/' . $invoice->id) ?>">Send Invoice</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="<?php echo base_url('invoice/invoice_edit/' . $invoice->id) ?>">Edit</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item recordPaymentBtn" href="javascript:void(0);" data-id="<?php echo $invoice->id ?>">Record Payment</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="<?php echo base_url('workorder/invoice_workorder/' . $invoice->id) ?>">Convert to Workorder</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item clone-item" href="javascript:void(0);" data-invoice-number="<?php echo $invoice->invoice_number ?>" data-id="<?php echo $invoice->id ?>" data-bs-toggle="modal">Clone Invoice</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="<?php echo base_url('invoice/preview/'. $invoice->id . '?format=pdf') ?>" target="_blank">Invoice PDF</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="<?php echo base_url('invoice/preview/'. $invoice->id . '?format=print') ?>" target="_blank">Print Invoice</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="<?= base_url('job/invoice_job/'. $invoice->id); ?>">Convert to Job</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item delete-item" href="javascript:void(0);" data-invoice-number="<?php echo $invoice->invoice_number ?>" data-id="<?php echo $invoice->id ?>">Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            endforeach;
                            ?>
                        <?php
                        else :
                        ?>
                            <tr>
                                <td colspan="11">
                                    <div class="nsm-empty">
                                        <span>No results found.</span>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        endif;
                        ?>
                    </tbody>
                </table>
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

        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $(".nsm-table").nsmPagination();

        $("#search_field").on("input", debounce(function() {
            let _form = $(this).closest("form");

            _form.submit();
        }, 1500));

        $(document).on("click", ".delete-item", function(){
            let id = $(this).attr('data-id');

            Swal.fire({
                title: 'Delete Invoice',
                text: "Are you sure you want to delete this Invoice?",
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
                                title: 'Good job!',
                                text: "Data Deleted Successfully!",
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

        $(document).on('click touchstart', '.clone-item', function(){
            var invoice_id = $(this).attr('data-id');
            var invoice_number = $(this).attr('data-invoice-number');

            Swal.fire({
                html: "You are going create a new invoice based on invoice number <b>"+ invoice_number +"</b>.<br/><br /><small style='font-size:13px;'>The new invoice will contain the same items (e.g. materials, labour).Cloned invoice will have status as <b>draft</b>. You will be able to edit and remove the invoice items as you need.</small><br /><br />Do you wish to proceed with selected action?",
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: base_url + "invoice/_clone_invoice",
                        data: {
                            invoice_id: invoice_id
                        },
                        dataType:'json',
                        beforeSend: function(data) {
                            
                        },
                        success: function(result) {
                            if( result.is_success == 1 ){
                                var edit_invoice_url = base_url + 'invoice/invoice_edit/' + result.invoice_id;                        
                                Swal.fire({
                                    html: 'Invoice was Invoice was successfully cloned.',
                                    icon: 'success',
                                    showCancelButton: false,
                                    showDenyButton: true,
                                    confirmButtonText: 'Okay',
                                    denyButtonText: `Edit Invoice`,
                                    denyButtonColor: '#7367f0'
                                }).then((result) => {
                                    if (result.isDenied) {
                                        location.href = edit_invoice_url;
                                    }else{
                                        location.reload();
                                    }                            
                                });
                            }else{
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    html: result.msg
                                });
                            }
                        },
                        complete : function(){
                            
                        },
                    });
                }
            });
        });

        $(document).on('click touchstart', '.recordPaymentBtn', function(){
            var invoice_id = $(this).attr('data-id');

            $('#modalRecordPaymentForm').modal('show');
            $("#modalRecordPaymentForm .modal-body").html('<div class="alert alert-info alert-purple" role="alert">Loading...</div>');

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

        // $(document).on("click", ".clone-item", function(){
        //     let invoice_number = $(this).data("invoice-number");
        //     let id = $(this).data("id");

        //     $("#clone_invoice_id").text(invoice_number);
        //     $("#clone_invoice").attr("data-id", id);
        // });

        // $("#clone_invoice").on("click", function(){
        //     let url = "<?php echo base_url(); ?>invoice/clone/" + $(this).attr("data-id");
        //     location.href = url;
        // });
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>