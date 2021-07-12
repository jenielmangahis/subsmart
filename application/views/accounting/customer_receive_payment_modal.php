<style>
    #add_new_payment_method {
        position: absolute;
        top: 50px;
        /* right: 100px; */
        bottom: 0;
        left: -15%;
        z-index: 10040;
        overflow: auto;
        overflow-y: auto;
        max-height: calc(100vh - 200px);
        overflow-y: auto;
    }
</style>

<?php include viewPath('accounting/customer_includes/receive_payment/receive_payment_modal'); ?>
<!-- Modal for add account-->
<div class="full-screen-modal">
    <div id="addreceivepaymentModal" class="modal fade modal-fluid" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title">
                        <a href=""><i class="fa fa-history fa-lg" style="margin-right: 10px"></i></a>
                        Receive Payment
                    </div>
                    <button type="button" class="close" id="closeModalInvoice" data-dismiss="modal"
                        aria-label="Close"><i class="fa fa-times fa-lg"></i></button>
                </div>
                <form
                    action="<?php echo site_url()?>accounting/addReceivePayment"
                    method="post">
                    <div class="modal-body" style="height:1000px;">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-3">
                                        Customer
                                        <select class="form-control" name="customer_id">
                                            <option></option>
                                            <?php foreach ($customers as $customer) : ?>
                                            <option
                                                value="<?php echo $customer->prof_id; ?>">
                                                <?php echo $customer->first_name . ' ' . $customer->last_name; ?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <br>
                                        <input type="button" class="form-control" value="Find by invoice no.">
                                        Don't have an invoice? Create a new sale
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-3">
                                        Payment date
                                        <input type="text" class="form-control" name="payment_date"
                                            id="rp_payment_date">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        Payment method<br>
                                        <select class="form-control" name="payment_method" id="rp_payment_method">
                                            <option></option>
                                            <option value="0">Add New</option>
                                            <?php foreach ($paymethods as $paymethod) { ?>
                                            <option
                                                value="<?php echo $paymethod->payment_method_id ; ?>">
                                                <?php echo $paymethod->quick_name; ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        Reference no.
                                        <input type="text" class="form-control" name="ref_number">
                                    </div>
                                    <div class="col-md-3">
                                        Deposit to
                                        <select class="form-control" name="deposit_to">
                                            <option></option>
                                            <option value="1">Cash on hand</option>
                                            <option value="2">Cash</option>
                                            <option value="3">Credit</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6" align="right">
                                AMOUNT RECEIVED<h2>$0.00</h2><br>
                                <p style="margin-top:100px;">Amount received</p><br>
                                <input type="text" class="form-control" style="width:200px;text-align:right;"
                                    name="amount" placeholder="0.00">
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-2">
                                Memo<br>
                                <textarea style="height:200px;width:100%;" name="memo"></textarea><br>
                                <div class="file-upload">
                                    <button class="file-upload-btn" type="button"
                                        onclick="$('.file-upload-input').trigger( 'click' )">Attachments</button>

                                    <div class="image-upload-wrap">
                                        <input class="file-upload-input" type='file' onchange="readURL(this);"
                                            accept="image/*" name="attachments" />
                                        <div class="drag-text">
                                            <i>Drag and drop files here or click the icon</i>
                                        </div>
                                    </div>
                                    <div class="file-upload-content">
                                        <img class="file-upload-image" src="#" alt="your image" />
                                        <div class="image-title-wrap">
                                            <button type="button" onclick="removeUpload()" class="remove-image">Remove
                                                <span class="image-title">Uploaded File</span></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <hr>
                    <div class="modal-footer-check">
                        <div class="row">
                            <div class="col-md-4">
                                <button class="btn btn-dark cancel-button" id="closeCheckModal"
                                    type="button">Cancel</button>

                            </div>
                            <div class="col-md-5" align="center">
                                <div class="middle-links">
                                    <a href="">Print or Preview</a>
                                </div>
                                <div class="middle-links end">
                                    <a href="">Make recurring</a>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="dropdown" style="float: right">
                                    <button class="btn btn-dark cancel-button px-4" type="submit">Save</button>
                                    <button type="button" class="btn btn-success" data-dismiss="modal" id="checkSaved"
                                        style="border-radius: 20px 0 0 20px">Save and new</button>
                                    <button class="btn btn-success" type="button" data-toggle="dropdown"
                                        style="border-radius: 0 20px 20px 0;margin-left: -5px;">
                                        <span class="fa fa-caret-down"></span></button>
                                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                        <li><a href="#" data-dismiss="modal" id="checkSaved">Save and close</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <div style="margin: auto;">
                    <span style="font-size: 14px"><i class="fa fa-lock fa-lg"
                            style="color: rgb(225,226,227);margin-right: 15px"></i>At nSmartrac, the privacy and
                        security of your information are top priorities.</span>
                </div>
                <div style="margin: auto">
                    <a href="" style="text-align: center">Privacy</a>
                </div>
            </div>

        </div>
    </div>
    <!--end of modal-->
</div>

<?php include viewPath('accounting/add_new_payment_method');
