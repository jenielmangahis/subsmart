<?php
if (!is_null($dynamic_load) && $dynamic_load == true):
    echo '<div class="col-12 col-lg-4">';
endif;
?>
<style>
    .widget-tile-unpaid-invoice-row:hover {
        cursor: pointer;
    }


    .overdue-invoices-container .overdue-invoices-items {
        margin: 0 20px;
        color: rgb(47 43 61 / 0.9);
        border-radius: 6px;
        background-image: none;
        padding: 10px;
        position: relative;
        height: 100%;
        display: flex;
        align-items: center;
    }

    .overdue-invoices-container .overdue-invoices-items .nsm-widget-table {
        width: 100% !important;
        display: block;
        box-sizing: border-box;
        box-shadow: 0px 3px 12px #38747859;
        padding: 20px;
        border-radius: 10px;
        background: #fff;
        height: unset;
    }

    .overdue-invoices-container .overdue-invoices-items .nsm-widget-table .badge-section .nsm-badge {
        border-radius: 25px;
        font-weight: bold;
        font-size: 16px;
        background: unset;
        padding: unset;
    }

    .content-title {
        font-size: 15px;
        font-weight: bold;
        line-height: 1.3;
        display: block;
    }

    #nsm-table-overdue-invoices .unpaid-invoices-items .nsm-widget-table .badge-section .nsm-badge {
        padding: 1px 20px;
        border-radius: 25px;
        font-weight: bold;
        color: #fff;
        font-size: 12px;
    }


    #nsm-table-overdue-invoices .nsm-table-pagination .pagination li a.prev,
    #nsm-table-overdue-invoices .nsm-table-pagination .pagination li a.next {
        border: none;
    }

    #nsm-table-overdue-invoices .nsm-table-pagination .pagination {
        gap: 10px;
    }

    #nsm-table-overdue-invoices .nsm-table-pagination .pagination li a {
        border-radius: 50%;
    }

    #nsm-table-overdue-invoices .nsm-table-pagination .pagination li a.active {
        background: #d9a1a0;
        border: 1px solid #BEAFC2;
    }

    #nsm-table-overdue-invoices tbody tr td {
        width: 200px;
    }


    @media screen and (max-width: 1366px) {
        #nsm-table-overdue-invoices {
            width: 500px;
        }

        .overdue-invoices-container .overdue-invoices-items {
            margin: auto;
        }
    }

    @media screen and (max-width: 991px) {
        #nsm-table-overdue-invoices {
            width: 100%;
        }
    }
</style>

<div class="<?= $class ?>" data-id="<?= $id ?>" id="widget_<?= $id ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span>Overdue Invoices</span>
        </div>
        <div class="nsm-card-controls">
            <a role="button" class="nsm-button btn-sm m-0 me-2" href="<?= base_url('accounting/invoices') ?>">
                See More
            </a>
            <div class="dropdown">
                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#"
                            onclick="addToMain('<?= $id ?>',<?php echo $isMain ? '1' : '0'; ?>,'<?= $isGlobal ?>' )"><?php echo $isMain ? 'Remove From Main' : 'Add to Main'; ?></a>
                    </li>
                    <li><a class="dropdown-item" href="#" onclick="removeWidget('<?= $id ?>');">Remove Widget</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="nsm-card-content">
        <div class="col-md-12">
            <div class="banner">
                <img src="./assets/img/overdue-invoices-banner3.svg" alt="">
            </div>
            <div class="overdue-invoices-container">
                <div class="overdue-invoices-items">
                    <div class="nsm-widget-table table-responsive">
                        <table class="nsm-table" id="nsm-table-overdue-invoices">
                            <thead style="display:none;">
                                <tr>
                                    <td data-name="EstimateNumber">Estimate Number</td>
                                    <td data-name="TotalDue"></td>
                                    <td data-name="Status"></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($currentOverdueInvoices)) { ?>
                                <?php foreach ($currentOverdueInvoices as $invoice) { ?>
                                <?php
                                $invoiceAvatar = userProfilePicture($invoice->user_id);
                                $invoiceInitial = getLoggedNameInitials($invoice->user_id);
                                
                                $statusBadgeColor = '';
                                switch ($invoice->status) {
                                    case 'Partially Paid':
                                        $statusBadgeColor = '#FEA303';
                                        break;
                                    case 'Paid':
                                        $statusBadgeColor = '#d9a1a0';
                                        break;
                                    case 'Due':
                                        $statusBadgeColor = '#d9a1a0';
                                        break;
                                    case 'Overdue':
                                        $statusBadgeColor = '#EFB6C8';
                                        break;
                                    case 'Submitted':
                                        $statusBadgeColor = '#FEA303';
                                        break;
                                    case 'Approved':
                                        $statusBadgeColor = '#EFB6C8';
                                        break;
                                    case 'Declined':
                                        $statusBadgeColor = '#d9a1a0';
                                        break;
                                    case 'Scheduled':
                                        $statusBadgeColor = '#A888B5';
                                        break;
                                    default:
                                        $statusBadgeColor = '#A888B5';
                                        break;
                                }
                                ?>
                                <?php $initials = ucwords($invoice->first_name[0]) . ucwords($invoice->last_name[0]); ?>
                                <tr>
                                    <td class="widget-tile-upcoming-estimate-row" data-id="<?= $invoice->id ?>">
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="nsm-profile"
                                                style="width: 40px;background-color: <?= $statusBadgeColor ?> !important">
                                                <span><?= $initials ?></span>
                                            </div>
                                            <div class="details">
                                                <span
                                                    class="content-title"><?= formatInvoiceNumber($invoice->invoice_number) ?></span>
                                                <span
                                                    class="content-subtitle d-block"><?= $invoice->first_name . ' ' . $invoice->last_name ?></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="content-subtitle  fw-bold" >
                                            $<?= number_format($invoice->balance, 2) ?>
                                        </span>
                                        <span class="content-subtitle d-block">total due</span>
                                    </td>
                                    <td style="width:25%;text-align:right;">
                                        <div class="controls badge-section mb-2">
                                            <span class="nsm-badge ">
                                                <?= $invoice->status ?>
                                            </span>
                                            <span class="content-subtitle d-block mt-2">
                                                <?= $invoice->due_date ? get_format_date($invoice->due_date) : '' ?>
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                                <?php } ?>
                                <?php }else { ?>
                                <tr>
                                    <td colspan="4">
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
        </div>
    </div>
</div>


<?php
if (!is_null($dynamic_load) && $dynamic_load == true):
    echo '</div>';
endif;
?>

<script>
    $(function() {
        $("#nsm-table-overdue-invoices").nsmPagination({
            itemsPerPage: 5
        });
        $('.widget-tile-upcoming-estimate-row').on('click', function() {
            var invoice_id = $(this).attr('data-id');
            location.href = base_url + 'invoice/genview/' + invoice_id;
        });
    });
</script>
