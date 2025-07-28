<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/invoice/invoice_modals'); ?>
<style>
.status-label {
    font-size:13px;
}    
.btn-nsm-custom {
    color: #ffffff; 
    background-color: #6a4a86; 
    margin-top: -2px;
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
                                    <h2 id="paid_total">
                                        <!-- $<?php //echo get_invoice_amount('paid') ?> -->
                                        $<?php echo get_total_invoice_amount('paid', logged('company_id'), 0); ?>
                                    </h2>
                                    <span>Paid</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" name="search" placeholder="Search Invoice" value="">
                        </div>
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
                                <li><a class="dropdown-item" data-id="filter_draft" href="<?php echo base_url('invoice/tab/draft') ?>">Draft</a></li>
                                <li><a class="dropdown-item" data-id="filter_partially_paid" href="<?php echo base_url('invoice/tab/partially_paid') ?>">Partially Paid</a></li>
                                <li><a class="dropdown-item" data-id="filter_paid" href="<?php echo base_url('invoice/tab/paid') ?>">Paid</a></li>
                                <li><a class="dropdown-item" data-id="filter_due" href="<?php echo base_url('invoice/tab/due') ?>">Due</a></li>
                                <li><a class="dropdown-item" data-id="filter_overdue" href="<?php echo base_url('invoice/tab/overdue') ?>">Overdue</a></li>
                                <li><a class="dropdown-item" data-id="filter_unpaid" href="<?php echo base_url('invoice/tab/unpaid') ?>">Unpaid</a></li>
                            </ul>
                        </div>

                        <div class="nsm-page-buttons page-button-container">                            
                            <?php if(checkRoleCanAccessModule('users', 'write')){ ?>
                            <div class="btn-group">
                                <button type="button" class="btn btn-nsm btn-nsm-custom" id="btn-add-new-invoice"><i class='bx bx-plus' style="position:relative;top:1px;"></i> Add Invoice</button>
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

                        <!-- <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button primary" onclick="location.href='<?php echo base_url('invoice/add') ?>'">
                                <i class='bx bx-fw bx-receipt'></i> Add New Invoice
                            </button>
                            <button type="button" class="nsm-button primary" id="archived-invoice-list">
                                <i class='bx bx-fw bx-trash'></i> Manage Archived
                            </button>
                        </div> -->
                    </div>
                </div>
                <form id="frm-with-selected">
                    <table class="nsm-table">
                        <thead>
                            <tr>
                                <?php if(checkRoleCanAccessModule('invoice', 'write')){ ?>
                                <td class="table-icon text-center sorting_disabled">
                                    <input class="form-check-input select-all table-select" type="checkbox" name="id_selector" value="0" id="select-all">
                                </td>
                                <?php } ?>
                                <td class="table-icon"></td>
                                <td data-name="Invoice Number">Invoice Number</td>
                                <td data-name="Job Number">Job Number</td>
                                <td data-name="Date Issued">Date Issued</td>
                                <td data-name="Date Due">Date Due</td>                            
                                <td data-name="Customer">Customer</td>
                                <td data-name="Status">Status</td>
                                <td data-name="Amount" style="text-align:right;">Amount</td>
                                <td data-name="Amount" style="text-align:right;">Balance</td>
                                <td data-name="Manage"></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($invoices)) :
                            ?>
                                <?php
                                foreach ($invoices as $invoice) :

                                    $late_fee_amount = $invoice->late_fee;
                                    $current_date    = date('Y-m-d');

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
                                        <td>
                                            <div class="table-row-icon">
                                                <i class='bx bx-receipt'></i>
                                            </div>
                                        </td>
                                        <td class="fw-bold nsm-text-primary nsm-link default" onclick="location.href='<?php echo base_url('invoice/genview/' . $invoice->id) ?>'"><?= formatInvoiceNumber($invoice->invoice_number) ?>
                                        </td>
                                        <td class="nsm-text-primary nsm-link default view-job-row" data-id="<?= $invoice->job_id; ?>">
                                                <?php echo $invoice->jobnumber != '' ? $invoice->jobnumber : '---';  ?>
                                        </td>
                                        <td><?php echo date('m/d/Y', strtotime($invoice->date_issued)); //get_format_date($invoice->date_issued) ?></td>
                                        <td><?php echo date('m/d/Y', strtotime($invoice->due_date)); //get_format_date($invoice->due_date) ?></td>
                                        <td class="nsm-text-primary">
                                            <label class="d-block">
                                            <?php 
                                                if( trim($invoice->first_name != '') || trim($invoice->last_name != '') ){
                                                    $customer_name = $invoice->first_name . ' ' . $invoice->last_name;
                                                }else{
                                                    $customer_name = '---';
                                                }
                                                
                                                echo $customer_name;
                                            ?>
                                            </label>
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
                                        <td style="text-align:right;">$<?php echo number_format((float)$invoice->grand_total,2); ?></td>
                                        <td style="text-align:right;">$<?php echo number_format((float)$invoice->balance,2); ?></td>
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
                                                        <a class="dropdown-item" id="resend-invoice-late-fee" href="javascript:void(0);" data-number="<?= $invoice->invoice_number; ?>" data-id="<?= $invoice->id; ?>" date-latefee="<?php echo number_format($late_fee_amount,2); ?>">Resend Invoice with Late Fee</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="<?php echo base_url('invoice/invoice_edit/' . $invoice->id) ?>">Edit</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item recordPaymentBtn" href="javascript:void(0);" data-status="<?= $invoice->status; ?>" data-id="<?php echo $invoice->id ?>">Record Payment</a>
                                                    </li>
                                                    <!-- <li>
                                                        <a class="dropdown-item voidPaymentBtn" href="javascript:void(0);" data-status="<?= $invoice->status; ?>" data-id="<?php echo $invoice->id ?>">Void Payments</a>
                                                    </li> -->
                                                    <li>
                                                        <a class="dropdown-item viewPaymentBtn" href="javascript:void(0);" data-status="<?= $invoice->status; ?>" data-id="<?php echo $invoice->id ?>">View Payments</a>
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
                                                        <a class="dropdown-item delete-item" href="javascript:void(0);" data-number="<?php echo $invoice->invoice_number ?>" data-id="<?php echo $invoice->id ?>">Delete</a>
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
                </form>
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

            <!-- Modal Void Payments -->
            <div class="modal fade nsm-modal fade" id="modalVoidPaymentForm" tabindex="-1" aria-labelledby="modalVoidPaymentForm_label" aria-hidden="true">
                <div class="modal-dialog modal-md modal-dialog-centered">
                    <form id="frm-record-payment" method="POST">
                        <input type="hidden" name="invoice_id" id="void_payment_invoice_id" value="" />
                        <div class="modal-content" style="width:560px;">
                            <div class="modal-header">
                                <span class="modal-title content-title">Void Payments</span>
                                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                            </div>
                            <div class="modal-body"></div>
                            <div class="modal-footer">                    
                                <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Modal Edit Payment -->
            <div class="modal fade nsm-modal fade" id="modalEditPaymentForm" tabindex="-1" aria-labelledby="modalEditPaymentForm_label" aria-hidden="true">
                <div class="modal-dialog modal-md modal-dialog-centered">
                    <form id="frm-update-payment" method="POST">
                        <input type="hidden" name="invoice_payment_id" id="invoice_payment_id" value="" />
                        <div class="modal-content" style="width:560px;">
                            <div class="modal-header">
                                <span class="modal-title content-title">Edit Payment</span>
                                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                            </div>
                            <div class="modal-body" id="edit-invoice-payment-container"></div>
                            <div class="modal-footer">                    
                                <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" id="btn-update-invoice-payment" class="nsm-button primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Modal View Payments -->
            <div class="modal fade nsm-modal fade" id="modalViewPaymentForm" tabindex="-1" aria-labelledby="modalViewPaymentForm_label" aria-hidden="true">
                <div class="modal-dialog modal-md modal-dialog-centered">
                    <form id="frm-record-payment" method="POST">
                        <input type="hidden" name="invoice_id" id="void_payment_invoice_id" value="" />
                        <div class="modal-content" style="width:560px;">
                            <div class="modal-header">
                                <span class="modal-title content-title">Invoice Payments</span>
                                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                            </div>
                            <div class="modal-body"></div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="modal fade nsm-modal fade" id="modal-quick-view-job" data-source="" tabindex="-1" aria-labelledby="modal-quick-view-upcoming-schedule-label" aria-hidden="true">
                <div class="modal-dialog modal-lg">        
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="modal-title content-title">View Job</span>
                            <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                        </div>
                        <div class="modal-body" style="max-height:700px; overflow: auto;">
                            <div class="view-schedule-container row"></div>
                        </div>                                    
                    </div>        
                </div>
            </div>

            <div class="modal fade nsm-modal fade" id="modal-archived-invoices" aria-labelledby="modal-archived-invoices-label" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <form method="post" id="quick-add-event-form">   
                        <div class="modal-content">
                            <div class="modal-header">
                                <span class="modal-title content-title">Archived Invoices</span>
                                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                            </div>
                            <div class="modal-body" id="invoices-archived-list-container" style="max-height: 800px; overflow: auto;"></div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {

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
        //For Achived Modal List - End        

        $(".nsm-table").nsmPagination();
        $("#search_field").on("input", debounce(function() {
            tableSearch($(this));        
        }, 1000));

        $(document).on('click', '.btn-edit-invoice-payment', function(){
            let payment_id = $(this).attr('data-id');
            $('#modalViewPaymentForm').modal('hide');
            $('#modalEditPaymentForm').modal('show');
            $('#invoice_payment_id').val(payment_id);

            $.ajax({
                type: "POST",
                url: base_url + 'invoice/_edit_invoice_payment_form',
                data: {payment_id:payment_id},
                success: function(html)
                {          
                    $("#edit-invoice-payment-container").html(html);
                }
            });
        });

        $('#modalEditPaymentForm').on('hidden.bs.modal', function () {
            $('#modalViewPaymentForm').modal('show');
        });

        $('.view-job-row').on('click', function(){
            var appointment_id = $(this).attr('data-id');
            var url = base_url + "job/_quick_view_details";  

            if( appointment_id > 0 ){
                $('#modal-quick-view-job').modal('show');
                showLoader($(".view-schedule-container")); 

                setTimeout(function () {
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {appointment_id:appointment_id},
                    success: function(o)
                    {          
                        $(".view-schedule-container").html(o);
                    }
                });
                }, 500);
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    html: 'Job number not found.'
                });
            }
            
        });

        $(document).on('click touchstart', '#resend-invoice-late-fee', function(){
            var invoice_id = $(this).attr('data-id');   
            var invoice_number  = $(this).attr('data-number');
            var late_fee_amount = $(this).attr('date-latefee');
            //var late_fee_amount = "<?= $invoiceSettings ? $invoiceSettings->late_fee_amount_per_day : 0; ?>"
            Swal.fire({
                title: 'Resend Invoice',
                html: `Are you sure you want to resend invoice number <b>${invoice_number}</b>? This will add late fee amount of $${late_fee_amount} per day.`,
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: base_url + "invoice/_send_invoice_email_with_late_fee",
                        data: {
                            invoice_id: invoice_id
                        },
                        dataType:"json",
                        success: function(result) {
                            if( result.is_success == 1 ){
                                Swal.fire({
                                    title: 'Resend Invoice',
                                    text: "Invoice was successfully sent to customer",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                }).then((result) => {
                                    if (result.value) {
                                        
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
                    });
                }
            });
            // $('#invoice-id').val(invoice_id);
            // $('#modal-resend-invoice-late-fee').modal('show');
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

        $(document).on('submit', '#frm-send-invoice-late-fee', function(e){
            e.preventDefault();
            var late_fee = $('#late-fee').val();

            Swal.fire({
                text: "Continue sending invoice to customer with late fee amounting of " + late_fee + "?",
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: base_url + "invoice/_send_invoice_email_with_late_fee",
                        data: $('#frm-send-invoice-late-fee').serialize(),
                        dataType:'json',
                        beforeSend: function(data) {
                            $('#modal-resend-invoice-late-fee').modal('hide');
                            $('#loading_modal').modal('show');
                            $('#loading_modal .modal-body').html('<span class="bx bx-loader bx-spin"></span> Sending email...');
                        },
                        success: function(result) {
                            if( result.is_success == 1 ){
                                Swal.fire({
                                    text: "Invoice was successfully sent to customer",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                }).then((result) => {
                                    if (result.value) {
                                        
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
                            $('#loading_modal').modal('hide');
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

        $(document).on('click touchstart', '.voidPaymentBtn', function(){

            var invoice_id = $(this).attr('data-id');
            var invoice_status = $(this).attr('data-status');

            $('#modalVoidPaymentForm').modal('show');
            showLoader($("#modalVoidPaymentForm .modal-body")); 
            $('#void_payment_invoice_id').val(invoice_id);

            $.ajax({
                url: base_url + "invoice/_load_void_payment_form",
                type: "POST",
                data: {
                    invoice_id: invoice_id
                },
                success: function (response) {
                    $("#modalVoidPaymentForm .modal-body").html(response);
                },
            });

        });

        $(document).on('click touchstart', '.viewPaymentBtn', function(){

            var invoice_id = $(this).attr('data-id');

            $('#modalViewPaymentForm').modal('show');
            showLoader($("#modalViewPaymentForm .modal-body")); 
            $('#void_payment_invoice_id').val(invoice_id);

            $.ajax({
                url: base_url + "invoice/_load_view_payments_form",
                type: "POST",
                data: {
                    invoice_id: invoice_id
                },
                success: function (response) {
                    $("#modalViewPaymentForm .modal-body").html(response);
                },
            });

        });

        $(document).on('submit', '#frm-update-payment', function(e){
            e.preventDefault();
            var url  = base_url + 'invoice/_update_invoice_payment';

            var formData = new FormData($('#frm-update-payment')[0]);
            formData.append('attachment',$('#edit-payment-attachment').get(0).files[0]);

            var form = $(this);
            $.ajax({
                type: "POST",
                url: url,
                dataType:'json',
                data: formData, 
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    if( data.is_success == 1 ){
                        $('#modalEditPaymentForm').modal('hide');
                        
                        Swal.fire({
                            text: 'Invoice payment was successfully updated',
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#6a4a86',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            //location.reload();
                        });    
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            html: data.msg
                        });
                    }
                    
                    $("#modalEditPaymentForm #btn-update-invoice-payment").html('Save');
                }, beforeSend: function() {
                    $("#modalEditPaymentForm #btn-update-invoice-payment").html('<span class="bx bx-loader bx-spin"></span>');
                }
            });
        });

        $(document).on('submit', '#frm-record-payment', function(e){
            e.preventDefault();
            var url  = base_url + 'invoice/_create_payment';

            var formData = new FormData($('#frm-record-payment')[0]);
            formData.append('attachment',$('#payment-attachment').get(0).files[0]);

            var form = $(this);
            $.ajax({
                type: "POST",
                url: url,
                dataType:'json',
                data: formData, 
                contentType: false,
                cache: false,
                processData: false,
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
                    
                    $("#modalRecordPaymentForm #btn-record-payment").html('Save');
                }, beforeSend: function() {
                    $("#modalRecordPaymentForm #btn-record-payment").html('<span class="bx bx-loader bx-spin"></span>');
                }
            });
        });

        $('#archived-invoice-list').on('click', function(){
            $('#modal-archived-invoices').modal('show');
            $.ajax({
                type: "POST",
                url: base_url + "invoice/_archived_list",  
                success: function(html) {    
                    $('#invoices-archived-list-container').html(html);                          
                },
                beforeSend: function() {
                    $('#invoices-archived-list-container').html('<span class="bx bx-loader bx-spin"></span>');
                }
            });
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
                            url: base_url + 'invoice/_delete_all_archived_invoices',
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

        $(document).on("click", "#btn-add-new-invoice", function(){
            let url = "<?php echo base_url('invoice/add'); ?>";
            location.href = url;            
        });

        $("#export-invoice-list").on("click", function() {
            location.href = "<?php echo base_url('invoice/export_list'); ?>";
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