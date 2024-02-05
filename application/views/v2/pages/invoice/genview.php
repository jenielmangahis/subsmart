<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('includes/notifications'); ?>
<?php if($onlinePaymentAccount->stripe_publish_key != '' && $onlinePaymentAccount->stripe_secret_key != ''){ ?>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://checkout.stripe.com/checkout.js"></script>    
<?php } ?>
<script src="https://js.braintreegateway.com/web/dropin/1.36.0/js/dropin.min.js"></script>
<?php if($onlinePaymentAccount->paypal_client_id != '' && $onlinePaymentAccount->paypal_client_secret != ''){ ?>
<script src="https://www.paypal.com/sdk/js?client-id=<?= $onlinePaymentAccount->paypal_client_id; ?>&currency=USD"></script>
<?php } ?>
<?php if($onlinePaymentAccount->square_access_token != '' && $onlinePaymentAccount->square_refresh_token != ''){ ?>
    <link rel="stylesheet" href="/reference/sdks/web/static/styles/code-preview.css" preload>
    <script src="https://sandbox.web.squarecdn.com/v1/square.js"></script>
<?php } ?>
<style>
    .from-job-swal-actions {
        display: flex;
        flex-direction: column;
    }
    .from-job-swal-actions button.swal2-styled {
        width: 100%;
        max-width: 70%;
    }
</style>
<div class="row page-content g-0" role="wrapper">
    <?php //include viewPath('includes/sidebars/invoice'); ?>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/sales_tabs'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/invoice_subtabs'); ?>
    </div>    
    <div class="col-12">
        <?php if (!empty($invoice)) : ?>
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
                    <div class="container-fluid" style="font-size:16px;padding:10px;">
                        <div class="row">                                
                            <div class="row col-xl-12" data-id="invoices">                                    
                                <div class="col-xl-12 margin-bottom margin-top pr-0" style="text-align:right;">
                                    <input type="hidden" id="autoOpenModalRP" value="<?php echo $record_payment ?>">
                                    <input type="hidden" id="recordPaymentInvoiceId" value="<?php echo $invoice->id ?>">
                                    
                                    <div class="dropdown d-inline-block">
                                        <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown" style="width:122px;">
                                            <span>Action <i class='bx bx-fw bx-chevron-down'></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end select-filter">
                                        <li style="font-size:17px;">
                                            <a class="dropdown-item" href="<?php echo base_url('invoice/invoice_edit/' . $invoice->id) ?>"><i class="bx bx-edit"></i> Edit</a>
                                        </li>
                                        <?php if(strtolower($invoice->status) === 'paid') : ?>
                                            <li style="font-size:17px;">
                                                <a class="dropdown-item" href="<?php echo base_url('invoice/emailInvoice/'. $invoice->id) ?>"><i class="bx bxs-envelope"></i> Send Invoice</a>
                                            </li>
                                        <?php elseif(strtolower($invoice->status) === 'due') : ?>
                                            <li style="font-size:17px;">
                                                <a class="dropdown-item payNowBtn" href="javascript:void(0)" data-id="<?php echo $invoice->id ?>" data-invoice-number="<?php echo $invoice->invoice_number ?>"><i class='bx bxs-dollar-circle' ></i> Pay Now</a>
                                            </li>
                                            <li style="font-size:17px;">
                                                <a class="dropdown-item link-modal-open recordPaymentBtn" href="javascript:void(0)" data-id="<?php echo $invoice->id ?>"><i class='bx bx-list-ul' ></i> Record Payment</a>
                                            </li>
                                        <?php else : ?>
                                            <li style="font-size:17px;">
                                                <a class="dropdown-item btn-send-invoice" data-id="<?= $invoice->id; ?>" href="javascript:void(0);"><i class="bx bxs-envelope"></i> Send Invoice</a>
                                            </li>
                                            <li style="font-size:17px;">
                                                <a class="dropdown-item margin-right-sec" href="<?php echo base_url('invoice/send/'. $invoice->id .'?scheduled=1') ?>"><i class='bx bxs-calendar'></i> 
                                                    Schedule
                                                </a>
                                            </li>
                                            <li style="font-size:17px;">
                                                <a class="dropdown-item link-modal-open recordPaymentBtn" href="javascript:void(0)" data-id="<?php echo $invoice->id ?>"><i class='bx bx-list-ul' ></i> Record Payment</a>
                                            </li>
                                            <li style="font-size:17px;">
                                                <a class="dropdown-item payNowBtn" href="javascript:void(0)" data-id="<?php echo $invoice->id ?>" data-invoice-number="<?php echo $invoice->invoice_number ?>"><i class='bx bxs-dollar-circle' ></i> Pay Now</a>
                                            </li>
                                        <?php endif; ?> 
                                        <?php if(strtolower($invoice->status) === 'due') : ?>                                            
                                            <li style="font-size:17px;">
                                                <a class="dropdown-item" href="<?php echo base_url('invoice/emailInvoice/'. $invoice->id) ?>"><i class='bx bx-envelope' ></i> Resend Invoice</a>
                                            </li>
                                            <li style="font-size:17px;">
                                                <a class="dropdown-item btn-share-invoice-link" href="javascript:void(0);"><i class='bx bx-share-alt' ></i> Share Invoice Link</a>
                                            </li>
                                        <?php elseif(strtolower($invoice->status) === 'paid') : ?>
                                            <li style="font-size:17px;"> 
                                                <a class="dropdown-item" href="<?php echo base_url('invoice/emailInvoice/'. $invoice->id) ?>"><i class='bx bx-envelope' ></i> Resend Invoice</a>
                                            </li>
                                            <li style="font-size:17px;">
                                                <a class="dropdown-item" href="<?php echo base_url('invoice/emailInvoice/'. $invoice->id) ?>"><i class='bx bx-envelope' ></i> Send Receipt</a>
                                            </li>
                                        <?php else: ?>
                                            <li style="font-size:17px;">
                                                <a class="dropdown-item openMarkAsSent" href="javascript:void(0)" data-toggle="modal" data-invoice-number="<?php echo $invoice->invoice_number ?>" data-id="<?php echo $invoice->id ?>"><i class='bx bxs-check-circle' ></i> Mark as Due</a>
                                            </li>
                                        <?php endif; ?>    
                                        <li style="font-size:17px;">
                                            <a class="dropdown-item" href="javascript:void(0)" data-invoice-number="<?php echo $invoice->invoice_number ?>"
                                            data-id="<?php echo $invoice->id ?>" id="deleteInvoiceBtnNew"><i class='bx bxs-trash-alt' ></i> Delete
                                            </a>
                                        </li>
                                        <li><div class="dropdown-divider"></div></li>
                                        <li style="font-size:17px;">
                                            <a class="dropdown-item openCloneInvoice" href="javascript:void(0)" data-toggle="modal" data-invoice-number="<?php echo $invoice->invoice_number ?>" data-id="<?php echo $invoice->id ?>"><i class='bx bxs-copy-alt' ></i> Clone Invoice</a>
                                        </li>
                                        <li style="font-size:17px;">
                                            <a class="dropdown-item" href="<?php echo base_url('invoice/preview/'. $invoice->id . '?format=pdf') ?>" target="_blank"><i class='bx bxs-file-pdf' ></i> PDF</a>
                                        </li>          
                                        <li style="font-size:17px;">
                                            <a class="dropdown-item" href="<?php echo base_url('invoice/print/'. $invoice->id . '?format=print') ?>" target="_blank"><i class='bx bxs-printer' ></i> Print</a>
                                        </li>  
                                        </ul>
                                    </div>
                                    <a class="nsm-button primary" href="<?php echo base_url('invoice') ?>">BACK TO INVOCE LIST</a>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-5">
                            <div class="col-md-8">
                                <script>
                                    const $template = document.createElement("template");
                                    $template.innerHTML = `<?= $invoice_template; ?>`;

                                    class InvoicePreview extends HTMLElement {
                                        constructor() {
                                            super();
                                            const shadowRoot = this.attachShadow({ mode: "open" });
                                            shadowRoot.appendChild($template.content.cloneNode(true));
                                        }
                                    }

                                    try {
                                        window.customElements.define("invoice-preivew", InvoicePreview);
                                    } catch (error) {}
                                </script>
                                <invoice-preivew></invoice-preivew>
                            </div>
                            <div class="col-md-4">
                                <div class="panel-info margin-bottom">
                                    
                                </div>

                                <div class="nsm-card primary" style="max-height:400px;overflow-x:hidden;overflow-y:scroll;">
                                    <div class="nsm-card-content">
                                        <h3>Payments Received</h3>
                                        <?php if(empty($payments)){ ?>
                                        <p class="text-ter">No payments have been recorded</p>
                                        <?php }else{ ?>
                                        <table class="table">
                                            <tr>
                                                <td>Date</td>
                                                <td>Amount</td>
                                                <td>Balance</td>
                                                <td>Payment Method</td>
                                                <td>Notes</td>
                                            </tr>
                                            <?php foreach($payments as $p){ ?>
                                                <tr>
                                                    <td><?= date("m/d/Y", strtotime($p->payment_date)); ?></td>
                                                    <td>$<?= number_format($p->invoice_amount,2,'','.'); ?></td>
                                                    <td>$<?= number_format($p->balance,2,'','.'); ?></td>
                                                    <td><?= $p->payment_method; ?></td>
                                                    <td><?= $p->notes; ?></td>
                                                </tr>
                                            <?php } ?>
                                        </table>
                                        <?php } ?>
                                        <hr />
                                        <h3>Logs</h3>          
                                        <?php if($invoiceLogs){ ?>                          
                                        <table class="table">
                                            <?php foreach($invoiceLogs as $log){ ?>
                                                <tr>
                                                    <td style="width:1%;"><i class='bx bxs-calendar'></i></td>
                                                    <td style="width:130px;"><?= date("m/d/Y", strtotime($log->date_created)); ?></td>
                                                    <td><?= $log->remarks; ?></td>
                                                </tr>
                                            <?php } ?>
                                        </table>
                                        <?php } ?>
                                    </div>
                                </div>
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
                    <!-- Modal Pay Now -->                           
                    <div class="modal fade nsm-modal fade" id="modalPayNowForm" tabindex="-1" aria-labelledby="modalPayNowForm_label" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <!-- <form id="frm-record-payment" method="POST">                                 -->
                                <div class="modal-content" style="width:750px;">
                                    <div class="modal-header">
                                        <span class="modal-title content-title">Pay Now : <span id="modal-invoice-number"></span></span>
                                        <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                                    </div>
                                    <div class="modal-body"></div>
                                    <div class="modal-footer">                    
                                        <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                            <!-- </form> -->
                        </div>
                    </div>             
                    <div class="modal in" id="convertToWorkOrder" tabindex="-1" role="dialog">
                        <div class="modal-dialog" style="max-width:600px;">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    <h4 class="modal-title">Convert Invoice To Work Order</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="validation-error" style="display: none;"></div>
                                    <form name="convert-to-work-order-modal-form">
                                        <p>
                                            You are going create a new work order based on <b>Invoice# <span id='workOrderInvoiceId'"></span></b>.<br>
                                            The invoice items (e.g. materials, labour) will be copied to this work order.<br>
                                            You can always edit/delete work order items as you need.
                                        </p>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                                    <button class="btn btn-primary" type="button" data-convert-to-work-order-modal="submit">Convert To Work Order</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <div class="modal fade nsm-modal fade" id="loading_modal" tabindex="-1" aria-labelledby="loading_modal_label" aria-hidden="true" style="margin-top:10%;">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-body"></div>
            </div>
        </div>
    </div>

</div>


<?php include viewPath('v2/includes/footer'); ?>
<script>
$(function(){
    $('#modalPayNowForm').modal({backdrop: 'static', keyboard: false});
});

$(document).on('click touchstart', '.btn-send-invoice', function(){
    var invoice_id = $(this).attr('data-id');

    Swal.fire({
        text: "Send invoice to customer email?",
        icon: 'question',
        confirmButtonText: 'Proceed',
        showCancelButton: true,
        cancelButtonText: "Cancel"
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: 'POST',
                url: base_url + "invoice/_send_invoice_email",
                data: {
                    invoice_id: invoice_id
                },
                dataType:'json',
                beforeSend: function(data) {
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

$(document).on('click touchstart', '.openMarkAsSent', function(){
    var invoice_id = $(this).attr('data-id');
    var invoice_number = $(this).attr('data-invoice-number');
    
    Swal.fire({
        html: "Proceed with changing Invoice Number <b>"+ invoice_number +"</b> status to <b>due</b>?",
        icon: 'question',
        confirmButtonText: 'Proceed',
        showCancelButton: true,
        cancelButtonText: "Cancel"
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: 'POST',
                url: base_url + "invoice/_mark_as_due",
                data: {
                    invoice_id: invoice_id
                },
                dataType:'json',
                beforeSend: function(data) {
                    
                },
                success: function(result) {
                    if( result.is_success == 1 ){
                        Swal.fire({
                            text: "Invoice was successfully updated",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            //if (result.value) {
                                location.reload();
                            //}
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

$(document).on('click touchstart', '.openCloneInvoice', function(){
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

$(document).on('click touchstart', '#deleteInvoiceBtnNew', function(){
    var invoice_id = $(this).attr('data-id');
    var invoice_number = $(this).attr('data-invoice-number');

    Swal.fire({
        html: "Delete Invoice Number <b>"+ invoice_number +"</b>?",
        icon: 'question',
        confirmButtonText: 'Proceed',
        showCancelButton: true,
        cancelButtonText: "Cancel"
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: 'POST',
                url: base_url + "invoice/_delete_invoice",
                data: {
                    invoice_id: invoice_id
                },
                dataType:'json',
                beforeSend: function(data) {
                    
                },
                success: function(result) {
                    if( result.is_success == 1 ){
                        Swal.fire({
                            text: "Invoice was successfully deleted",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            //if (result.value) {
                                location.href = base_url  + "/invoice";
                            //}
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

$(document).on('click touchstart', '.btn-share-invoice-link', function(){
    var _shareableLink = $("<input>");
    $("body").append(_shareableLink);
    _shareableLink.val("<?php echo base_url('/invoice/preview/'.$invoice->id.'?format=print'); ?>").select();
    document.execCommand('copy');
    _shareableLink.remove();

    Swal.fire({
        text: "Shareable link has been copied to clipboard.",
        icon: 'success',
        showCancelButton: false,
        confirmButtonText: 'Okay'
    });
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

$(document).on('click touchstart', '.payNowBtn', function(){
    var invoice_id = $(this).attr('data-id');
    var invoice_number = $(this).attr('data-invoice-number');

    $('#modalPayNowForm').modal('show');
    $('#modal-invoice-number').html(invoice_number);
    $("#modalPayNowForm .modal-body").html('<div class="alert alert-info alert-purple" role="alert">Loading...</div>');

    $.ajax({
    url: base_url + "invoice/_load_pay_now_form",
    type: "POST",
    data: {
        invoice_id: invoice_id
    },
    success: function (response) {
        $("#modalPayNowForm .modal-body").html(response);
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

window.addEventListener('DOMContentLoaded', async (event) => {
    const params = new Proxy(new URLSearchParams(window.location.search), {
        get: (searchParams, prop) => searchParams.get(prop),
    });

    const invoiceId = "<?= $invoice->id ?>";
    const invoiceJobId = "<?= $invoice->job_id ?>";

    if (params.from && params.from === 'job') {
        const response = await Swal.fire({
            title: '',
            icon: 'info',
            text: 'Your invoice is now ready. What would you like to do next?',
            confirmButtonText: 'Update Invoice',
            showDenyButton: true,
            showCancelButton: true,
            denyButtonText: 'Collect Payment',
            cancelButtonText: 'Review',
            customClass: {
                actions: 'from-job-swal-actions',
            }
        })

        if (response.isConfirmed && invoiceId) {
            window.location.href = `/invoice/invoice_edit/${invoiceId}`;
            return;
        }

        if (response.isDenied && invoiceJobId) {
            window.location.href = `/job/billing/${invoiceJobId}`;
        }
    }
});
</script>