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
                    <table class="nsm-table" id="invoice-items-table" style="font-size: 12px !important; overflow: auto;">
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
                                            <div class="dropdown table-management">
                                                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item" href="<?= base_url('invoice/send/' . $invoice->id); ?>" target="_blank">Email Invoice</a></li>
                                                    <li><a class="dropdown-item btn-ledger-record-payment" href="javascript:void(0);" data-status="<?= $invoice->status; ?>" data-id="<?php echo $invoice->id ?>">Record Payment</a></li>
                                                    <li><a class="dropdown-item btn-ledger-show-payments" href="avascript:void(0);" data-status="<?= $invoice->status; ?>" data-id="<?php echo $invoice->id ?>">View Payments</a></li>
                                                </ul>
                                            </div>
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

    <!-- Modal Record Payment -->
    <div class="modal fade nsm-modal fade" id="modalRecordPaymentForm" tabindex="-1" aria-labelledby="modalRecordPaymentForm_label" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">                    
            <div class="modal-content" style="width:580px;">
                <div class="modal-header">
                    <span class="modal-title content-title">Record Payment</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <form id="frm-record-payment" method="POST">
                        <input type="hidden" name="invoice_id" id="record_payment_invoice_id" value="" />
                        <div id="record-payment-container"></div>
                    </form>
                </div>
                <div class="modal-footer">                    
                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" id="btn-record-payment" class="nsm-button primary" form="frm-record-payment">Save</button>
                </div>
            </div>
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
    <div class="modal fade" id="modalViewPaymentForm" data-bs-backdrop="static" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title" style="font-size: 17px;">Invoice Payments</span>
                    <button class="border-0 rounded mx-1" data-bs-dismiss="modal" style="cursor: pointer;"><i class="fas fa-times m-0 text-muted"></i></button>
                </div>
                <div class="modal-body">
                    <form id="frm-record-payment" method="POST">       
                        <input type="hidden" name="invoice_id" id="void_payment_invoice_id" value="" />          
                        <div id="view-payments-container"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>


</div>
<script>
$(function(){
    customerLedger();

    $(document).on('click touchstart', '.btn-ledger-show-payments', function(){
        var invoice_id = $(this).attr('data-id');

        $('#modalViewPaymentForm').modal('show');
        showLoader($("#view-payments-container")); 
        $('#void_payment_invoice_id').val(invoice_id);

        $.ajax({
            url: base_url + "invoice/_load_view_payments_form",
            type: "POST",
            data: {
                invoice_id: invoice_id
            },
            success: function (response) {
                $("#view-payments-container").html(response);
            },
        });
    });

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

    $(document).on('click touchstart', '.btn-ledger-record-payment', function(){
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
            showLoader($("#modalRecordPaymentForm #record-payment-container")); 
            $('#record_payment_invoice_id').val(invoice_id);

            $.ajax({
                url: base_url + "invoice/_load_record_payment_form",
                type: "POST",
                data: {
                    invoice_id: invoice_id
                },
                success: function (response) {
                    $("#modalRecordPaymentForm #record-payment-container").html(response);
                },
            });
        }
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