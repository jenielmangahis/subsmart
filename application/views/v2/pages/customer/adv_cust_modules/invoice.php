<div class="col-12 col-md-4" data-id="<?= $id ?>" id="<?= $id ?>">
    <div class="nsm-card nsm-grid">
        <div class="nsm-card-header d-block">
            <div class="nsm-card-title">
                <span>Invoice</span>
            </div>
        </div>
        <div class="nsm-card-content">
            <div class="row g-3">
                <div class="col-12">
                    <div class="row g-2">
                        <div class="col-12 col-md-3">
                            <div class="nsm-counter success h-100 p-3">
                                <label class="content-title">$<?= get_customer_invoice_amount('year', $cus_id); ?></label>
                                <label class="content-subtitle">Total Invoiced</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="nsm-counter primary h-100 p-3">
                                <label class="content-title">$<?= get_customer_invoice_amount('paid', $cus_id); ?></label>
                                <label class="content-subtitle">Received</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="nsm-counter h-100 p-3">
                                <label class="content-title">$<?= get_customer_invoice_amount('pending', $cus_id); ?></label>
                                <label class="content-subtitle">Outstanding</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="nsm-counter error h-100 p-3">
                                <label class="content-title">$0</label>
                                <label class="content-subtitle">Past Due</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <table class="nsm-table">
                        <thead>
                            <tr>
                                <td data-name="Invoice Number">Invoice Number</td>
                                <td data-name="Date Issued">Date Issued</td>
                                <td data-name="Status">Status</td>
                                <td data-name="Amount">Amount</td>
                                <td data-name="Manage"></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($cust_invoices)) :
                                foreach ($cust_invoices as $invoice) :
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
                                        <td class="fw-bold nsm-text-primary nsm-link default" onclick="location.href='<?php echo base_url('invoice/genview/' . $invoice->id) ?>'"><?php echo $invoice->invoice_number ?></td>
                                        <td><?php echo get_format_date($invoice->date_issued) ?></td>
                                        <td><span class="nsm-badge <?= $badge ?>"><?php echo $invoice->INV_status ?></span></td>
                                        <td>$<?php echo ($invoice->grand_total); ?></td>
                                        <td class="text-end">
                                            <a role="button" class="nsm-button btn-sm" href="<?= base_url('invoice/send/' . $invoice->id); ?>" target="_blank">Email Invoice</a>
                                        </td>
                                    </tr>
                                <?php
                                endforeach;
                            else :
                                ?>
                                <tr>
                                    <td colspan="5">
                                        <div class="nsm-empty">
                                            <span>No results found.</span>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-12 col-md-6">
                    <a href="<?= base_url('invoice/add?cus_id='.$cus_id); ?>" target="_blank">
                        <button class="nsm-button w-100 ms-0 mt-2" >
                            <i class='bx bx-fw bx-list-plus'></i> Create Invoice
                        </button>
                    </a>
                </div>
                <div class="col-12 col-md-6">
                    <a href="<?= base_url('customer/invoice_list/'.$cus_id); ?>" target="_blank">
                        <button class="nsm-button w-100 ms-0 mt-2 primary">
                            <i class='bx bx-fw bx-receipt'></i> All Invoices
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>