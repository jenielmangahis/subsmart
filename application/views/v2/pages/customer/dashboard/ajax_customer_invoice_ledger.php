<style>
table.table-fit {
  width: 135% !important;
  table-layout: auto !important;
}
table.table-fit thead th,
table.table-fit tbody td,
table.table-fit tfoot th,
table.table-fit tfoot td {
  width: auto !important;
}
</style>
<div class="row">
    <div class="col-7">
        <span class="fw-bold" style="font-size:15px;"><?= $customer_address; ?></span>
    </div>
    <div class="col-5 text-end">        
        <span class="fw-bold" style="font-size:15px;">BALANCE : $<?= number_format($balance, 2, '.', ','); ?></span>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="modal-print-customer-ledger" tabindex="-1" aria-labelledby="modal-print-customer-ledger_label" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <input type="hidden" id="customer-esign" value="" />
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="edit_cc_label">Print</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body" id="print-customer-ledger-container"></div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="nsm-button primary" id="btn-modal-print-customer-ledger">Print</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="modal-customer-ledger-send-to-email" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modal-customer-ledger-send-to-email_label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">        
        <div class="modal-content">
            <form method="POST" id="frm-customer-ledger-send-email">
                <div class="modal-header">
                    <span class="modal-title content-title">Customer Ledger : Send to email</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">                        
                        <div class="col-12">
                            <label>Email</label>
                            <input type="email" placeholder="Email" name="recipient_email" value="<?= $default_email; ?>" id="recipient_email" class="nsm-field form-control mb-2" required />
                        </div>
                        <div class="col-12">
                            <label>Subject</label>
                            <input type="text" placeholder="Subject" value="Customer Ledger" name="email_subject" id="email_subject" class="nsm-field form-control mb-2" required />
                        </div>
                        <div class="col-12">
                            <label>Body</label>
                            <textarea class="form-control" name="email_body" style="height:200px;"></textarea>                            
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="nsm-button primary" id="btn-modal-customer-ledger-send-email">Send</button>
                </div>
            </form>
        </div>        
    </div>
</div>

<script src="<?= base_url("assets/js/v2/printThis.js") ?>"></script>
<script>
    $(document).ready(function() {
        //$(".nsm-table").nsmPagination({itemsPerPage:15});
        $('#btn-print-customer-ledger').on('click', function(){
            $('#modal-print-customer-ledger').modal('show');

            $.ajax({
                type: "POST",
                url: base_url + "customer/_print_ledger",
                success: function(result)
                {
                    $('#print-customer-ledger-container').html(result);
                },
                beforeSend: function() {
                    $('#print-customer-ledger-container').html('<span class="bx bx-loader bx-spin"></span>');
                }
            });
        });

        $(document).on('click', '#btn-modal-print-customer-ledger', function(){
            $("#tbl-print-customer-ledger").printThis();
        });

        $('#btn-send-email-customer-ledger').on('click', function(){
            $('#modal-customer-ledger-send-to-email').modal('show');
        });

        $('#frm-customer-ledger-send-email').on('submit', function(e){
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: base_url + "customer/_send_email_ledger",
                dataType: 'json',
                data: $('#frm-customer-ledger-send-email').serialize(),
                dataType:'json',
                success: function(data) {    
                    $('#btn-modal-customer-ledger-send-email').html('Send');                   
                    if (data.is_success == 1) {
                        $('#modal-customer-ledger-send-to-email').modal('hide');
                        Swal.fire({
                            text: "Email was successfully sent",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            //if (result.value) {
                                
                            //}
                        });                    
                    }else{
                        Swal.fire({
                            title: 'Error',
                            text: data.msg,
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            
                        });
                    }
                },
                beforeSend: function() {
                    $('#btn-modal-customer-ledger-send-email').html('<span class="bx bx-loader bx-spin"></span>');
                }
            });
        });
    });
</script>