<?php
if (!is_null($dynamic_load) && $dynamic_load == true):
    echo '<div class="col-12 col-lg-4">';
endif;
?>
<style>
    .widget-tile-unpaid-invoice-row:hover {
        cursor: pointer;
    }


    .unpaid-invoices-container .unpaid-invoices-items {
        color: rgb(47 43 61 / 0.9);
        border-radius: 6px;
        background-image: none;
        padding: 10px;
        position: relative;
        z-index: 2;
        height: 100%;
        display: flex;
        align-items: center;
    }

    .unpaid-invoices-container .unpaid-invoices-items .nsm-widget-table {
        width: 100% !important;
        display: block;
        box-sizing: border-box;
        box-shadow: 0px 3px 12px #38747859;
        padding: 20px;
        border-radius: 10px;
        background: #fff;
        height: unset;
    }

    .unpaid-invoices-container .unpaid-invoices-items .nsm-widget-table .badge-section .nsm-badge {
        padding: 1px 20px;
        border-radius: 25px;
        font-weight: bold;
        color: #fff;
        font-size: 12px;
    }

    .content-title {
        font-size: 15px;
        font-weight: bold;
        line-height: 1.3;
        display: block;
    }

    #dashboard_unpaid_invoices .nsm-table-pagination .pagination li a.prev,
    #dashboard_unpaid_invoices .nsm-table-pagination .pagination li a.next {
        border: none;
    }

    #dashboard_unpaid_invoices .nsm-table-pagination .pagination {
        gap: 10px;
    }

    #dashboard_unpaid_invoices .nsm-table-pagination .pagination li a {
        border-radius: 50%;
    }

    #dashboard_unpaid_invoices .nsm-table-pagination .pagination li a.active {
        background: #d9a1a0;
        border: 1px solid #BEAFC2;
    }

    #dashboard_unpaid_invoices .nsm-badge2 {
        background-color: #EFB6C8;
        color: #fff;
        display: block;
        width: 175px;
        margin-top: 10px;
        text-wrap: auto;
    }

    #dashboard_unpaid_invoices tbody tr td {
        width: 200px;
    }


    @media screen and (max-width: 1366px) {
        #dashboard_unpaid_invoices {
            width: 500px;
        }
    }

    @media screen and (max-width: 991px) {
        #dashboard_unpaid_invoices {
            width: 100%;
        }
    }

    @media screen and (max-width: 567px) {
        #dashboard_unpaid_invoices .nsm-badge2 {
            width: 100%;
        }

        .unpaid-invoices-container .unpaid-invoices-items {
            margin: unset;
        }

    }
</style>
<div class="<?= $class ?>" data-id="<?= $id ?>" id="widget_<?= $id ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span>Unpaid Invoices</span>
        </div>
        <div class="nsm-card-controls">
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
            <div class="banner mb-5">
                <img src="./assets/img/open-invoices-banner2.svg" alt="">
            </div>
            <div class="unpaid-invoices-container">
                <div class="unpaid-invoices-items">
                    <div class="nsm-widget-table table-responsive">
                        <table class="nsm-table" id="dashboard_unpaid_invoices">
                            <thead style="display:none;">
                                <tr>
                                    <td data-name="UnpaidInvoicesProfile" style="width:59%;"></td>
                                    <td data-name="UnpaidInvoicesBalance">Balance</td>
                                    <td data-name="UnpaidInvoicesDueDate" style="text-align:right;">Due Date</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($upcomingInvoice as $invoice){ ?>
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
                                
                                $datetime1 = new DateTime(date('Y-m-d', strtotime($invoice->date_updated)));
                                $datetime2 = new DateTime(date('Y-m-d'));
                                $difference = $datetime1->diff($datetime2);
                                
                                $show_no_movement_notice = 0;
                                if ($difference->d >= 14 && $invoice->status != 'Paid') {
                                    $show_no_movement_notice = 1;
                                }
                                ?>
                                <tr>
                                    <td>
                                        <div class="widget-item widget-tile-unpaid-invoice-row"
                                            data-id="<?= $invoice->id ?>">
                                            <div class="content">
                                                <div class="details" style="width:100% !important;">
                                                    <?php $customer_name = $invoice->first_name . ' ' . $invoice->last_name; ?>
                                                    <span class="content-title"><?= $invoice->invoice_number ?></span>
                                                    <span class="content-subtitle d-block" style="margin-top:7px;"><i
                                                            class='bx bxs-user-circle'
                                                            style="font-size: 14px;position: relative;top: 2px;"></i>
                                                        <?= trim($customer_name) != '' ? $customer_name : '---' ?></span>
                                                    <?php if( $show_no_movement_notice == 1 ){  ?>
                                                    <a style="text-decoration:none;margin-top:5px;"
                                                        href="<?= base_url('invoice/invoice_edit/' . $invoice->id) ?>"><span
                                                            class="nsm-badge nsm-badge2">Last update was
                                                            <b><?= $difference->d . ' days ago' ?></b> - Needs
                                                            update</span></a>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="content-subtitle fw-bold"
                                            style="font-size:12px;color:#FEA303">$<?= number_format($invoice->grand_total, 2) ?></span>
                                        <span class="content-subtitle d-block">Total Due</span>
                                    </td>
                                    <td style="text-align:right;" class="badge-section">
                                        <span class="nsm-badge"
                                            style="background-color: <?= $statusBadgeColor ?>"><?= $invoice->status ?></span>
                                        <span class="content-subtitle d-block mt-2">
                                            <?= $invoice->due_date ? get_format_date($invoice->due_date) : '---' ?>
                                        </span>
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
<script>
    $(function() {
        $("#dashboard_unpaid_invoices").nsmPagination({
            itemsPerPage: 5
        });
        resizeSidebar();

        $('.widget-tile-unpaid-invoice-row').on('click', function() {
            var invoice_id = $(this).attr('data-id');
            location.href = base_url + 'invoice/genview/' + invoice_id;
        });
    });
</script>
<?php
if (!is_null($dynamic_load) && $dynamic_load == true):
    echo '</div>';
endif;
?>
