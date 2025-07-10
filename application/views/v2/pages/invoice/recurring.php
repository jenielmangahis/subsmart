<?php include viewPath('v2/includes/header'); ?>
<style>
.custom-link, .custom-link:hover{
    text-decoration:none;
    color:inherit;
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
                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>Filter By Status: <?= $filter_status != '' ? ucwords($filter_status) : 'All'; ?></span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end select-filter">
                                <li><a class="dropdown-item" href="<?php echo base_url('invoice/recurring') ?>">All</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('invoice/recurring/paid') ?>">Paid</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('invoice/recurring/unpaid') ?>">Unpaid</a></li>
                                </ul>
                        </div>
                        <div class="nsm-page-buttons page-button-container">
                            <?php if (hasPermissions('WORKORDER_MASTER')) : ?>
                                <button type="button" class="nsm-button primary" onclick="location.href='<?php echo base_url('invoice/add') ?>'">
                                    <i class='bx bx-fw bx-receipt'></i> Add New Invoice
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <table class="nsm-table" id="tbl-invoice-recurring">
                    <thead>
                        <tr>
                            <td class="table-icon"></td>
                            <td data-name="Invoice Number">Invoice Number</td>
                            <td data-name="Customer">Customer</td>
                            <td data-name="Invoice Date">Invoice Date</td>
                            <td data-name="Start Date">Start Date</td>
                            <td data-name="End Date">End Date</td>                            
                            <td data-name="Status">Status</td>
                            <td data-name="Amount" style="text-align:right;">Amount</td>
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
                                    <td><div class="table-row-icon"><i class='bx bx-calendar-alt'></i></div></td>
                                    <td class="fw-bold nsm-text-primary nsm-link default" onclick="location.href='<?php echo base_url('invoice/genview/' . $invoice->id) ?>'"><?= formatInvoiceNumber($invoice->invoice_number) ?></td>
                                    <td class="nsm-text-primary"><?= $invoice->customer_name; ?></td>
                                    <td><?= date("m/d/Y", strtotime($invoice->date_issued)); ?></td>
                                    <td><?= $invoice->bill_start_date ?></td>
                                    <td><?= $invoice->bill_end_date ?></td>
                                    <td>
                                        <span class="status-label nsm-badge <?= $badge ?>" style="font-size: 13px;">
                                            <?= $invoice->status; ?>
                                        </span>
                                    </td>
                                    <td style="text-align:right;">$<?= number_format($invoice->grand_total,2,".",","); ?></td>
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
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>