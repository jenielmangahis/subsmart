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
               <button type="button" class="close" id="closeModalInvoice" data-dismiss="modal" aria-label="Close"><i class="fa fa-times fa-lg"></i></button>
            </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3">
                                    Customer
                                    <select class="form-control" name="customer_id">
                                        <option></option>
                                        <option>Add New</option>
                                        <option>John Doe</option>
                                        <option>Alpha</option>
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
                                    <input type="text" class="form-control" name="payment_date">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    Payment method<br>
                                    <select class="form-control" name="payment_method">
                                        <option></option>
                                        <option>Add New</option>
                                        <option>John Doe</option>
                                        <option>Alpha</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    Reference no.
                                    <input type="text" class="form-control" name="ref_number">
                                </div>
                                <div class="col-md-3">
                                    Deposit to
                                    <select class="form-control" name="deposit_to">
                                        <option>Cash on hand</option>
                                        <option>AAA</option>
                                        <option>AAA</option>
                                        <option>AAA</option>
                                    </select>
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-md-6" align="right">
                            AMOUNT RECEIVED<h2>$0.00</h2><br>
                            Amount received<br>
                            <input type="text" class="form-control" style="width:200px;" name="amount_received">
                        </div>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-md-2">
                            Memo<br>
                            <textarea style="height:100px;width:100%;" name="memo"></textarea><br>
                            <div class="file-upload">
                                <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Attachements</button>

                                <div class="image-upload-wrap">
                                    <input class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*" name="attachments"/>
                                    <div class="drag-text">
                                    <i>Drag and drop files here or click the icon</i>
                                    </div>
                                </div>
                                <div class="file-upload-content">
                                    <img class="file-upload-image" src="#" alt="your image" />
                                    <div class="image-title-wrap">
                                    <button type="button" onclick="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded File</span></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                
                <div style="margin: auto;">
                    <span style="font-size: 14px"><i class="fa fa-lock fa-lg" style="color: rgb(225,226,227);margin-right: 15px"></i>At nSmartrac, the privacy and security of your information are top priorities.</span>
                </div>
                <div style="margin: auto">
                    <a href="" style="text-align: center">Privacy</a>
                </div>
            </div>

        </div>
    </div>
    <!--end of modal-->
</div>