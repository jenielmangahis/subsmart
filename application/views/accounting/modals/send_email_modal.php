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
                                    <form action="/accounting/send-purchase-order-email/<?=$purchaseOrder->id?>" id="send-email-form">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="email-address">To</label>
                                                    <p class="m-0" id="email-address"><?=$purchaseOrder->email?></p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="email-subject">Subject</label>
                                                    <input type="text" name="subject" class="form-control" value="Purchase Order from <?=$company->business_name?>" id="email-subject">
                                                </div>
                                                <div class="form-group">
                                                    <label for="email-body">Body</label>
                                                    <textarea id="email-body" name="body" class="form-control" style="height: 20%">
                                                    Dear <?=$vendorName?>,

                                                    Please find our purchase order attached to this email.

                                                    Thank You
                                                    <?=$company->business_name?></textarea>
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
                            <button type="button" class="btn btn-secondary btn-rounded border" data-dismiss="modal" onclick="closeModal()">Cancel</button>
                        </div>
                        <div class="col-md-4 d-flex"></div>
                        <div class="col-md-4">
                            <div class="btn-group dropup float-right">
                                <button type="button" class="btn btn-success" id="send-and-close">
                                    Send and close
                                </button>
                                <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#" id="send-and-new">Send and new</a>
                                </div>
                            </div>
                            <a href="#" class="btn btn-secondary float-right mr-1" id="print-pdf">
                                Print
                            </a>
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