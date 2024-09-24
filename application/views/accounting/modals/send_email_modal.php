<!-- Modal for bank deposit-->
<div class="full-screen-modal">
    <div id="sendEmailModal" class="modal fade modal-fluid d-flex" role="dialog">
        <div class="modal-dialog" style="width: 90%; height: 90%; margin: auto">
            <!-- Modal content-->
            <div class="modal-content" style="height: 100%;">
                <div class="modal-header" style="background: #f4f5f8;border-bottom: 0">
                    <h4 class="modal-title">Send email</h4>
                    <!-- <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button> -->
                </div>
                <div class="modal-body">
                    <div class="row" style="min-height: 100%">
                        <div class="col">
                            <div class="card p-0 m-0" style="min-height: 100%">
                                <div class="card-body" style="padding-bottom: 1.25rem">
                                    <form action="<?= url('accounting/send-purchase-order-email/' . $purchaseOrder->id); ?>" id="send-email-form">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="email-address">To</label>
                                                    <input type="text" name="recipient_emai;" class="form-control" value="<?=$purchaseOrder->email?>" id="email-address" readonly="" disabled="">
                                                </div>
                                                <div class="form-group">
                                                    <label for="email-subject">Subject</label>
                                                    <input type="text" name="subject" class="form-control" value="Purchase Order from <?=$company->business_name?>" id="email-subject">
                                                </div>
                                                <div class="form-group">
                                                    <label for="email-body">Body</label>
                                                    <?php 
                                                        $msg = 'Dear '. $vendorName . "\r\n \r\n";
                                                        $msg .= "Please find our purchase order attached to this email. \r\n \r\n";
                                                        $msg .= "Thank you. \r\n";
                                                        $msg .= $company->business_name;
                                                    ?>
                                                    <textarea id="email-body" name="body" class="form-control" style="height: 265px;"><?= $msg; ?></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <iframe src="data:application/pdf;base64,<?=$pdf?>" type="application/pdf" frameborder="0" class="w-100" height="935px"></iframe>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="row w-100">
                        <div class="col-md-4">
                            <button type="button" class="nsm-button primary" data-dismiss="modal" onclick="closeModal()">Cancel</button>
                        </div>
                        <div class="col-md-4 d-flex"></div>
                        <div class="col-md-4">                           
                            <a href="javascript:void(0);" class="nsm-button primary float-right mr-1" id="send-and-new">Send and new</a>
                            <a href="javascript:void(0);" class="nsm-button primary float-right mr-1" id="print-pdf">Print</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--end of modal-->
</div>
<script>
    function closeModal() {
        $('#sendEmailModal').modal('hide'); 
    }
</script>