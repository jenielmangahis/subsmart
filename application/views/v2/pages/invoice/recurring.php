<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/invoice/invoice_modals'); ?>

<?php if (hasPermissions('WORKORDER_MASTER')) : ?>
    <div class="nsm-fab-container">
        <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?php echo url('invoice/recurring/add') ?>'">
            <i class="bx bx-repeat"></i>
        </div>
    </div>
<?php endif; ?>

<div class="row">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/invoice_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Listing all recurring invoices.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 grid-mb text-end">
                        <?php 
                            switch($page->tab):
                                case 2: 
                                    $status = "Active";
                                    break;
                                case 3:
                                    $status = "Stopped";
                                    break;
                                default:
                                    $status = "All";
                                    break;
                            endswitch
                        ?>
                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>Filter By Status: <?= $status ?></span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end select-filter">
                                <li><a class="dropdown-item" href="<?php echo base_url('invoice/recurring') ?>">All</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('invoice/recurring/2') ?>">Active</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('invoice/recurring/3') ?>">Stopped</a></li>
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
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td class="table-icon"></td>
                            <td data-name="Start On">Start On</td>
                            <td data-name="End Date">End Date</td>
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
                                    default:
                                        $badge = "";
                                        break;
                                endswitch;
                            ?>
                                <tr>
                                    <td>
                                        <div class="table-row-icon">
                                            <i class='bx bx-calendar-alt'></i>
                                        </div>
                                    </td>
                                    <td class="fw-bold nsm-text-primary nsm-link default"><?php echo get_format_date($invoice->start_on) ?></td>
                                    <td><?php echo strtoupper($invoice->end_date) ?></td>
                                    <td>
                                        <label class="d-block"><?php echo get_customer_by_id($invoice->customer_id)->contact_name ?></label>
                                        <a class="nsm-link" href="<?php echo base_url('customer/genview/' . $invoice->customer_id) ?>">
                                            <?php echo $invoice->job_name ?>
                                        </a>
                                    </td>
                                    <td><span class="nsm-badge <?= $badge ?>"><?php echo $invoice->status ?></span></td>
                                    <td>$<?php echo number_format(unserialize($invoice->invoice_totals)['grand_total'], 2, '.', ','); ?></td>
                                    <td>
                                        <div class="dropdown table-management">
                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item" href="<?php echo base_url('invoice/view/' . $invoice->id) ?>">View</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="<?php echo base_url('invoice/edit/' . $invoice->id) ?>">Edit</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="javascript:void(0);">Mark as inactive</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item delete-item" href="javascript:void(0);" data-id="<?php echo $invoice->id; ?>">Delete Invoice</a>
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
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>