<div class="full-screen-modal">
   <div id="addvendorcreditModal" class="modal fade modal-fluid" role="dialog">
      <div class="modal-dialog">
         <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header">
               <div class="modal-title">
                  <a href=""><i class="fa fa-history fa-lg" style="margin-right: 10px"></i></a>
                  Vendor Credit
               </div>
               <button type="button" class="close" id="closeModalExpense" data-dismiss="modal" aria-label="Close"><i class="fa fa-times fa-lg"></i></button>
            </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3">
                                    Vendor
                                    <select class="form-control">
                                        <option></option>
                                        <option>Add New</option>
                                        <option>John Doe</option>
                                        <option>Alpha</option>
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    Mailing address
                                    <textarea style="height:100px;width:100%;"></textarea>
                                </div>
                                <div class="col-md-3">
                                    Payment date<br>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-md-3">
                                </div>
                                <div class="col-md-3">
                                    Ref no.<br>
                                    <input type="text" class="form-control"><br>
                                    Permit no.<br>
                                    <input type="text" class="form-control">
                                </div>
                                
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    Tags <a href="#" style="float:right">Manage tags</a>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-md-6" align="right">
                            AMOUNT<h2>$0.00</h2>
                        </div>
                    </div>
                    <hr>
                    <h3>Category details</h3><br>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered" id="reportstable">
                                <thead>
                                    <th></th>
                                    <th>#</th>
                                    <th>CATEGORY</th>
                                    <th>DESCRIPTION</th>
                                    <th>AMOUNT</th>
                                    <th></th>
                                </thead>
                                <tr>
                                    <td></td>
                                    <td>1</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>2</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </table>
                        <div>
                    </div>
                    <hr>
                    <h3>Item details</h3><br>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered" id="reportstable">
                                <thead>
                                    <th></th>
                                    <th>#</th>
                                    <th>PRODUCT/SERVICE</th>
                                    <th>DESCRIPTION</th>
                                    <th>QTY</th>
                                    <th>RATE</th>
                                    <th>AMOUNT</th>
                                    <th></th>
                                </thead>
                                <tr>
                                    <td></td>
                                    <td>1</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>2</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </table>
                        <div>
                    </div>
                    <hr>
                
                    <div class="row">
                        <div class="col-md-1">
                           <button class="btn1">Add lines</button>
                        </div>
                        <div class="col-md-1">
                           <button class="btn1">Clear all lines</button>
                        </div>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-md-2">
                            Memo<br>
                            <textarea style="height:100px;width:100%;"></textarea><br>
                        </div>
                        <div class="col-md-8">
                        </div>
                        <div class="col-md-2">
                            Total <b>$0.00</b>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="file-upload">
                                <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Attachements</button>

                                <div class="image-upload-wrap">
                                    <input class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*" />
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
                        <div class="col-md-8">
                        </div>
                    </div>
                    <hr>


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