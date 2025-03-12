<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('v2/includes/header'); ?>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/customer_module_tabs'); ?>
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
                <div class="row">
                    <div class="col-12 col-md-4 grid-mb">
                        <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" placeholder="Search">
                        </div>
                    </div>
                </div>

                <div class="tab-content mt-4">
                    <table class="nsm-table">
                        <thead>
                            <tr>
                                <td class="table-icon"></td>
                                <td data-name="Invoice Number" style="width:50%;">Invoice Number</td>                                        
                                <td data-name="Date Issued">Date Issued</td>
                                <td data-name="Date Due">Date Due</td>
                                <td data-name="Status">Status</td>
                                <td data-name="Amount">Amount</td>
                                <td data-name="Balance">Balance</td>
                                <td data-name="Manage"></td>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($invoices as $invoice) { ?>
                            <tr>
                                <td>
                                    <div class="table-row-icon">
                                        <i class='bx bx-receipt'></i>
                                    </div>
                                </td>
                                <td class="fw-bold nsm-text-primary" ><?php echo $invoice->invoice_number ?></td>
                                <td>
                                    <div class="table-nowrap">
                                        <label for=""><?php echo get_format_date($invoice->date_issued) ?></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="table-nowrap">
                                        <label for=""><?php echo get_format_date($invoice->due_date) ?></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="table-nowrap">
                                        <label><?php echo $invoice->status ?></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="table-nowrap">
                                        <label for="">$<?= number_format($invoice->grand_total,2); ?></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="table-nowrap">
                                        <label for="">$<?php echo number_format($invoice->balance,2); ?></label>
                                    </div>
                                </td>
                                <td class="text-right">
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
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <?php } ?>
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
</div>

<?php include viewPath('v2/includes/footer'); ?>
<script>
    $(document).ready(function() {
        $(".nsm-table").nsmPagination();
        $("#search_field").on("input", debounce(function() {
            tableSearch($(this));        
        }, 1000));
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
</script>