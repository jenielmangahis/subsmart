<div class="col-12 col-md-4" data-id="<?= $id ?>" id="<?= $id ?>">
    <div class="nsm-card nsm-grid">
        <div class="nsm-card-header d-block">
            <div class="nsm-card-title">
                <span>Ledger Invoice</span>
            </div>
        </div>
              
        <div class="nsm-card-content">
            <div id="widget-ledger-invoice"></div>  
            <hr />
            <div class="row g-3">
                <div class="col-12">
                    <div class="row g-2" style="">
                        <div class="col-12 col-md-3">
                            <div class="nsm-counter success h-100 p-3">
                                <label class="content-title">$<?= get_customer_invoice_amount('year', $cus_id); ?></label>
                                <label class="content-subtitle" style="font-size: 12px;">Total Invoiced</label>
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
                                <label class="content-title">$<?= get_customer_invoice_amount('outstanding', $cus_id); ?></label>
                                <label class="content-subtitle">Outstanding</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="nsm-counter error h-100 p-3">
                                <label class="content-title">$<?= get_customer_invoice_amount('due', $cus_id); ?></label>
                                <label class="content-subtitle">Past Due</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="nsm-counter error h-100 p-3">
                                <label class="content-title">$<?= get_customer_invoice_amount('pending', $cus_id); ?></label>
                                <label class="content-subtitle">Pending</label>
                            </div>
                        </div>
                    </div>

                    <div class="nsm-page-buttons primary page-button-container w-100 mt-1" style="text-align:right;">
                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button primary" data-bs-toggle="dropdown" style="width:122px;">
                                <span>More Action <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                
                                <li><a class="dropdown-item" href="javascript:void(0);" id="btn-send-email-customer-ledger"><i class='bx bx-envelope' ></i> Share</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="btn-print-customer-ledger"><i class='bx bx-printer'></i> Print</a></li>
                                <li><a class="dropdown-item" href="<?= url('customer/export_customer_ledger'); ?>"><i class='bx bx-spreadsheet'></i> Save as Excel</a></li>
                            </ul>     
                        </div>
                    </div>  

                </div>
                <div class="" id="ledger-invoice-container" style="overflow: auto;">
                    <table class="nsm-table" id="invoice-items-table" style="font-size: 12px !important; width:535px; overflow: auto;">
                        <thead>
                            <tr style="font-size: 12px !important;">
                                <td class="table-icon text-center sorting_disabled"></td>
                                <td data-name="Invoice Number">Invoice #</td>
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
                                        <td>
                                            <div class="table-row-icon"><i class='bx bx-receipt'></i></div>
                                        </td>
                                        <td class="fw-bold nsm-text-primary nsm-link default" onclick="location.href='<?php echo base_url('invoice/genview/' . $invoice->id) ?>'"><?php echo $invoice->invoice_number ?></td>
                                        <td class="nsm-text-primary show"><?php echo get_format_date($invoice->date_issued) ?></td>
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
                   <button class="nsm-button w-100 ms-0 mt-2" onclick="window.open('<?= base_url('invoice/add?cus_id='.$cus_id) ?>', '_blank', 'location=yes,height=1080,width=1500,scrollbars=yes,status=yes');">
                        <i class='bx bx-fw bx-list-plus'></i> Create Invoice
                    </button>
                </div>
                <div class="col-12 col-md-6">
                    <button class="nsm-button w-100 ms-0 mt-2 primary" onclick="window.open('<?= base_url('customer/invoice_list/'.$cus_id) ?>', '_blank', 'location=yes,height=1080,width=1500,scrollbars=yes,status=yes');">
                        <i class='bx bx-fw bx-receipt'></i> All Invoices
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(function(){
    customerLedger();
    function customerLedger(){
        var customer_id = "<?= $cus_id; ?>";
        $.ajax({
            type: "POST",
            url: base_url + "customer/_ledger_invoice",
            data: {customer_id:customer_id},
            success: function(result)
            {
                $('#widget-ledger-invoice').html(result);
            },
            beforeSend: function() {
                $('#widget-ledger-invoice').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    }
});
</script>