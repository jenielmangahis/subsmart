<style>
.row-label, .row-value{
    font-size:19px;
    font-weight:bold;
}
</style>
<div class="nsm-card primary">
    <div class="nsm-card-content">
    <p>Record of payments for Invoice# <span><b><?php echo $invoice->invoice_number?></span></b></p>
    <!-- <div class="pbar-top">
        &nbsp;
    </div> -->
    <div class="form-group" style="margin-top:36px;">
        <div class="row">
            <table class="nsm-table">
                <tr>
                    <td data-name="Payment Date"><strong>Payment Date</strong></td>
                    <td data-name="Amount"><strong>Amount</strong></td>
                    <td data-name="Status"><strong>Is Void</strong></td>
                    <td data-name="Manage"></td>
                </tr>
            </thead>
            <tbody>
                <?php if($payment_records) { ?>
                    <?php foreach($payment_records as $payment_record){ ?>
                        <tr>
                            <td><?php echo get_format_date($payment_record->payment_date) ?></td>
                            <td><?php echo number_format($payment_record->invoice_amount,2) ?></td>
                            <td>
                            <?php if($payment_record->is_void == 0) { ?>
                                    No
                                <?php } else { ?>
                                    Yes
                                <?php } ?>                                
                            </td>
                            <td style="text-align: right">
                                <?php if($payment_record->is_void == 0) { ?>
                                    <a href="javascript:setAsVoidPayment(<?php echo $payment_record->id; ?>, <?php echo $payment_record->invoice_amount; ?> )" id="link-void-payment" class="nsm-button primary">Mark as Void</a>
                                <?php } else { ?>
                                    <!-- <a href="javascript:void(0)" id="link-void-payment" disabled="disabled" class="nsm-button">VOID</a> -->
                                <?php } ?>
                            </td>
                        </tr>   
                    <?php } ?>     
                <?php }else{ ?>
                        <tr>
                            <td colspan="4">No records available.</td>
                        </tr>                     
                <?php } ?>        
            </tbody>
            </table>
        </div>
    </div>

  
    </div>
</div>

<script>
    function setAsVoidPayment(payment_id, amount) {
        Swal.fire({
            title: 'Void Payment',
            html: `Are you sure you want to void this payment?`,
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: base_url + "invoice/_mark_payment_records_as_void",
                    data: {
                        payment_id: payment_id,
                        amount: amount
                    },
                    dataType:"json",
                    success: function(result) {
                        if( result.is_success == 1 ){
                            Swal.fire({
                                title: 'Void Payment',
                                text: "Payment was successfully mark as void",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonText: 'Okay'
                            }).then((result) => {
                                if (result.value) {
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
                });  
            }
            });        
    }

    $(document).ready(function() {

    });
</script>