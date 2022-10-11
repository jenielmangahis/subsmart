<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/invoice/invoice_modals'); ?>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?php echo base_url('invoice/add') ?>'">
        <i class="bx bx-receipt"></i>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/sales_tabs'); ?>
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
                                    <h2 id="total_this_year">$<?php echo get_invoice_amount('year') ?></h2>
                                    <span>This Year</span>
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
                                    <h2 id="pending_total">$<?php echo get_invoice_amount('pending') ?></h2>
                                    <span>Pending</span>
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
                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>Filter by Source</span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end select-filter">
                                <li><a class="dropdown-item" href="<?php echo base_url('customer') ?>">Source</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('customer?type=residential') ?>">Facebook</a></li>
                            </ul>
                        </div>
                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>Sort by Newest First</span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end select-filter">
                                <li><a class="dropdown-item" href="<?php echo (!empty($type)) ? base_url('invoice?type=' . $type . '&order=created_at-desc') : base_url('invoice?order=created_at-desc') ?>">Newest First</a></li>
                                <li><a class="dropdown-item" href="<?php echo (!empty($type)) ? base_url('invoice?type=' . $type . '&order=created_at-asc') : base_url('invoice?order=created_at-asc') ?>">Oldest First</a></li>
                                <li><a class="dropdown-item" href="<?php echo (!empty($type)) ? base_url('invoice?type=' . $type . '&order=last-invoice_number-asc') : base_url('invoice?order=last-invoice_number-asc') ?>">Number: Asc</a></li>
                                <li><a class="dropdown-item" href="<?php echo (!empty($type)) ? base_url('invoice?type=' . $type . '&order=last-invoice_number-desc') : base_url('invoice?order=last-invoice_number-desc') ?>">Number: Desc</a></li>
                                <li><a class="dropdown-item" href="<?php echo (!empty($type)) ? base_url('invoice?type=' . $type . '&order=amount-asc') : base_url('invoice?order=amount-desc') ?>">Amount: Lowest</a></li>
                                <li><a class="dropdown-item" href="<?php echo (!empty($type)) ? base_url('invoice?type=' . $type . '&order=amount-desc') : base_url('invoice?order=amount-asc') ?>">Amount: Highest</a></li>
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
                                    $status = "Paid";
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
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($invoices)) :
                        ?>
                            <?php
                            foreach ($invoices as $invoice) :
                                switch ($invoice->INV_status):
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
                                    default:
                                        $badge = "";
                                        break;
                                endswitch;
                            ?>
                                <tr>
                                    <td>
                                        <div class="table-row-icon">
                                            <i class='bx bx-receipt'></i>
                                        </div>
                                    </td>
                                    <td class="fw-bold nsm-text-primary nsm-link default" onclick="location.href='<?php echo base_url('invoice/genview/' . $invoice->id) ?>'"><?php echo $invoice->invoice_number ?></td>
                                    <td><?php echo get_format_date($invoice->date_issued) ?></td>
                                    <td><?php echo get_format_date($invoice->due_date) ?></td>
                                    <td>
                                        <label class="d-block"><?php echo $invoice->first_name . ' ' . $invoice->last_name; ?></label>
                                        <a class="nsm-link" href="<?php echo base_url('customer/genview/' . $invoice->customer_id) ?>">
                                            <?php echo $invoice->job_name ?>
                                        </a>
                                    </td>
                                    <td><span class="nsm-badge <?= $badge ?>"><?php echo $invoice->INV_status ?></span></td>
                                    <td>$<?php echo number_format($invoice->grand_total,2); ?></td>
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
                                                    <a class="dropdown-item" href="<?php echo base_url('invoice/genview/' . $invoice->id) . "?do=payment_add" ?>">Record Invoice</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="<?php echo base_url('workorder/invoice_workorder/' . $invoice->id) ?>">Convert to Workorder</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item clone-item" href="javascript:void(0);" data-invoice-number="<?php echo $invoice->invoice_number ?>" data-id="<?php echo $invoice->id ?>" data-bs-toggle="modal" data-bs-target="#clone_invoice_modal">Clone Invoice</a>
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

        $(document).on("click", ".clone-item", function(){
            let invoice_number = $(this).data("invoice-number");
            let id = $(this).data("id");

            $("#clone_invoice_id").text(invoice_number);
            $("#clone_invoice").attr("data-id", id);
        });

        $("#clone_invoice").on("click", function(){
            let url = "<?php echo base_url(); ?>invoice/clone/" + $(this).attr("data-id");
            location.href = url;
        });
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>