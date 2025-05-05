<style>
.row-label, .row-value{
    font-size:19px;
    font-weight:bold;
}
</style>
<div class="nsm-card primary">
    <div class="nsm-card-content">
        <p>Recorded payments for Invoice number <span><b><?php echo $invoice->invoice_number?></span></b></p>
        <div class="form-group" style="margin-top:36px;">
            <div class="row">
                <table class="nsm-table">
                    <tr>
                        <td data-name="Payment Date"><strong>Payment Date</strong></td>
                        <td data-name="Amount"><strong>Amount</strong></td>
                        <td data-name="Status"><strong>Payment Method</strong></td>
                        <td data-name="Status"><strong>Status</strong></td>
                        <td data-name="Manage"></td>
                    </tr>
                </thead>
                <tbody>
                    <?php if($payment_records) { ?>
                        <?php foreach($payment_records as $payment_record){ ?>
                            <tr>
                                <td><?= get_format_date($payment_record->payment_date) ?></td>
                                <td><?= number_format($payment_record->invoice_amount,2) ?></td>
                                <td><?= $payment_record->payment_method == 'cc' ? 'Credit Card' : ucwords($payment_record->payment_method); ?></td>
                                <td><?= $payment_record->is_void == 0 ? 'Paid' : 'Void'; ?></td>
                                <td style="text-align: right">
                                    <div class="dropdown table-management">
                                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                            <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a class="dropdown-item btn-edit-invoice-payment" data-id="<?= $payment_record->id; ?>" href="javascript:void(0);">Edit</a>
                                            </li>
                                            <?php if($payment_record->attachment != '' ) { ?>
                                            <li>
                                                <?php 
                                                    $attachment = base_url('uploads/invoice/attachments/'.$payment_record->company_id.'/'.$payment_record->attachment);
                                                ?>
                                                <a class="dropdown-item btn-edit-invoice-payment" href="<?= $attachment; ?>" download>Download Attachment</a>
                                            </li>
                                            <?php } ?>
                                            <?php if($payment_record->is_void == 0) { ?>
                                            <li>
                                                <a class="dropdown-item btn-void-invoice-payment" data-id="<?= $payment_record->id; ?>" href="javascript:void(0);">Void Payment</a>
                                            </li>
                                            <?php } ?>                                        
                                        </ul>
                                    </div>
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
    $(document).ready(function() {
        $('.btn-void-invoice-payment').on('click', function(){
            let payment_id = $(this).attr('data-id');

            Swal.fire({
                title: 'Void Payment',
                html: `Are you sure you want to void selected payment?`,
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: base_url + "invoice/_mark_payment_records_as_void",
                        data: {payment_id: payment_id},
                        dataType:"json",
                        success: function(result) {
                            if( result.is_success == 1 ){
                                $('#modalViewPaymentForm').modal('hide');
                                Swal.fire({
                                    title: 'Void Payment',
                                    text: "Payment was successfully voided",
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
                    });  
                }
            });  
        });
    });
</script>