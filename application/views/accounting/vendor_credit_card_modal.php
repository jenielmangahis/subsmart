<style>
#modal-dialog2 {
  position: absolute;
  top: 50px;
  right: 100px;
  bottom: 0;
  left: 10%;
  z-index: 10040;
  overflow: auto;
  overflow-y: auto;
}
</style>

<!-- Modal for add account-->
<div class="full-screen-modal">
   <div id="addvendorcreditcardModal" class="modal fade modal-fluid" role="dialog">
      <div class="modal-dialog">
         <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header">
               <div class="modal-title">
                  <a href=""><i class="fa fa-history fa-lg" style="margin-right: 10px"></i></a>
                  Credit Card Credit
               </div>
               <button type="button" class="close" id="closeModalInvoice" data-dismiss="modal" aria-label="Close"><i class="fa fa-times fa-lg"></i></button>
            </div>
                <div class="modal-body">
                    <form action="<?php echo site_url()?>accounting/addInvoice" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-3">
                                        Payee
                                        <select class="form-control" name="payee">
                                            <option></option>
                                            <option>Add New</option>
                                            <option>John Doe</option>
                                            <option>Alpha</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        Bank/Credit account
                                        <select class="form-control" name="credit_acc">
                                            <option></option>
                                            <option>A</option>
                                            <option>B</option>
                                            <option>C</option>
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-3">
                                        Payment date<br>
                                        <input type="text" class="form-control" name="payment_date">
                                    </div>
                                    <div class="col-md-3">
                                    </div>
                                    <div class="col-md-3">
                                        Ref no.<br>
                                        <input type="text" class="form-control" name="ref_no"><br>
                                        Permit no.<br>
                                        <input type="text" class="form-control" name="permit_no">
                                    </div>
                                    
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        Tags <a href="#" style="float:right">Manage tags</a>
                                        <input type="text" class="form-control" name="tags">
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
                                    <tr id="tableLine-expense">
                                    <td></td>
                                    <td><span id="line-counter-expense">1</span></td>
                                    <td>
                                        <div id="" style="display:;">
                                            <select name="category[]" id="" class="form-control expenseCategory select2-expense-category">
                                            <option></option>
                                            <?php foreach ($list_categories as $list): ?>
                                            <option value="<?php echo $list->id?>"><?php echo $list->category_name;?></option>
                                            <?php endforeach;?>
                                            </select>
                                        </div>
                                    </td>
                                    <td><input type="text" name="description[]" class="form-control expenseDescription" id="" style="display: ;"></td>
                                    <td><input type="text" name="amount[]" class="form-control expenseAmount" id="" style="display: ;"></td>
                                    <td style="text-align: center"><a href="#" id="delete-row-expense"><i class="fa fa-trash"></i></a></td>
                                </tr>
                                </tr>
                                <tr id="tableLine-expense">
                                    <td></td>
                                    <td><span id="line-counter-expense">2</span></td>
                                    <td>
                                        <div id="" style="display:;">
                                            <select name="category[]" id="" class="form-control expenseCategory select2-expense-category">
                                            <option></option>
                                            <?php foreach ($list_categories as $list): ?>
                                            <option value="<?php echo $list->id?>"><?php echo $list->category_name;?></option>
                                            <?php endforeach;?>
                                            </select>
                                        </div>
                                    </td>
                                    <td><input type="text" name="description[]" class="form-control expenseDescription" id="" style="display: ;"></td>
                                    <td><input type="text" name="amount[]" class="form-control expenseAmount" id="" style="display: ;"></td>
                                    <td style="text-align: center"><a href="#" id="delete-row-expense"><i class="fa fa-trash"></i></a></td>
                                </tr>
                            </table>
                        <div>
                    </div>
                    <hr>
                    <div class="table-custom">
                           <div id="headingTwo">
                              <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                              <i class="fa fa-caret-right mr-2 " aria-hidden="true"></i> Item details
                              </button>
                           </div>
                           <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                              <table id="expensesCheckTable" class="table table-striped table-bordered" style="width:100%;margin-top: 20px;">
                                 <thead>
                                    <tr>
                                       <th></th>
                                       <th>#</th>
                                       <th>PRODUCT/SERVICES</th>
                                       <th>DESCRIPTION</th>
                                       <th>QTY</th>
                                       <th>RATE</th>
                                       <th>AMOUNT</th>
                                       <th></th>
                                    </tr>
                                 </thead>
                                 <tbody id="line-container-expense">
                                    <tr id="tableLine-expense">
                                       <td></td>
                                       <td><span id="line-counter-expense">1</span></td>
                                       <td>
                                          <div id="" style="display:;">
                                             <select name="category[]" id="" class="form-control expenseCategory select2-expense-category">
                                                <option></option>
                                                <?php foreach ($list_categories as $list): ?>
                                                <option value="<?php echo $list->id?>"><?php echo $list->category_name;?></option>
                                                <?php endforeach;?>
                                             </select>
                                          </div>
                                       </td>
                                       <td><input type="text" name="description[]" class="form-control expenseDescription" id="" style="display: ;"></td>
                                       <td><input type="text" name="amount[]" class="form-control expenseAmount" id="" style="display: ;"></td>
                                       <td><input type="text" name="amount[]" class="form-control expenseAmount" id="" style="display: ;"></td>
                                       <td><input type="text" name="amount[]" class="form-control expenseAmount" id="" style="display: ;"></td>
                                       <td style="text-align: center"><a href="#" id="delete-row-expense"><i class="fa fa-trash"></i></a></td>
                                    </tr>
                                    <tr id="tableLine-expense">
                                       <td></td>
                                       <td><span id="line-counter-expense">1</span></td>
                                       <td>
                                          <div id="" style="display:;">
                                             <select name="category[]" id="" class="form-control expenseCategory select2-expense-category">
                                                <option></option>
                                                <?php foreach ($list_categories as $list): ?>
                                                <option value="<?php echo $list->id?>"><?php echo $list->category_name;?></option>
                                                <?php endforeach;?>
                                             </select>
                                          </div>
                                       </td>
                                       <td><input type="text" name="description[]" class="form-control expenseDescription" id="" style="display: ;"></td>
                                       <td><input type="text" name="amount[]" class="form-control expenseAmount" id="" style="display: ;"></td>
                                       <td><input type="text" name="amount[]" class="form-control expenseAmount" id="" style="display: ;"></td>
                                       <td><input type="text" name="amount[]" class="form-control expenseAmount" id="" style="display: ;"></td>
                                       <td style="text-align: center"><a href="#" id="delete-row-expense"><i class="fa fa-trash"></i></a></td>
                                    </tr>
                                    
                                 </tbody>
                              </table>
                           </div>
                        </div>
                        <hr>
                    
                        <div class="row">
                            <div class="col-md-1">
                            <button class="btn1">Add lines</button>
                            </div>
                            <div class="col-md-1">
                            <button class="btn1">Clear all lines</button>
                            </div>
                            <div class="col-md-1">
                            <button class="btn1">Add subtotal</button>
                            </div>
                            <div class="col-md-7">
                            </div>
                            <div class="col-md-1">
                                <b>Subtotal</b>
                            </div>
                            <div class="col-md-1">
                                <b>$0.00</b>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-2">
                                Memo<br>
                                <textarea style="height:100px;width:100%;" name="memo"></textarea><br>
                            </div>
                            <div class="col-md-8"></div>
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
                                        <input class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*" name="file_name/>
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
                        <div class="modal-footer-check">
                            <div class="row">
                                <div class="col-md-4">
                                    <button class="btn btn-dark cancel-button" id="closeCheckModal" type="button">Cancel</button>
                                    
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
                                        <button type="button" class="btn btn-success" data-dismiss="modal" id="checkSaved" style="border-radius: 20px 0 0 20px">Save and new</button>
                                        <button class="btn btn-success" type="button" data-toggle="dropdown" style="border-radius: 0 20px 20px 0;margin-left: -5px;">
                                            <span class="fa fa-caret-down"></span></button>
                                        <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                            <li><a href="#" data-dismiss="modal" id="checkSaved" >Save and close</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

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

<?php include viewPath('accounting/add_new_term'); ?>