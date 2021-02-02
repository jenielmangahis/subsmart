<!-- End New Popup -->
<!--    Expense modal-->
<div class="full-screen-modal">
   <div id="expense-modal" class="modal fade modal-fluid" role="dialog">
      <div class="modal-dialog">
         <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header">
               <div class="modal-title">
                  <a href=""><i class="fa fa-history fa-lg" style="margin-right: 10px"></i></a>
                  Expense
               </div>
               <button type="button" class="close" id="closeModalExpense"><i class="fa fa-times fa-lg"></i></button>
            </div>
            <form action="" method="post" id="expenseForm">
               <div class="modal-body" style="margin-bottom: 100px">
                  <div class="row">
                     <div class="col-md-3">
                        <label for="">Payee</label>
                        <input type="hidden" id="expenseTransId" class="transaction_id">
                        <input type="hidden" id="expenseId">
                        <input type="hidden" id="exType" class="" value="Expense" data-id="">
                        <select name="vendor_id" id="expenseVendorId" class="form-control select2-payee" required>
                           <option value=""></option>
                           <option disabled>&plus;&nbsp;Add new</option>
                           <?php foreach ($vendors as $vendor):?>
                           <option value="<?php echo $vendor->vendor_id?>"><?php echo $vendor->f_name."&nbsp;".$vendor->l_name;?> </option>
                           <?php endforeach; ?>
                        </select>
                     </div>
                     <div class="col-md-3">
                        <label for="">Payment account <i class="fa fa-question-circle"></i></label>
                        <select name="payment_account" id="expensePaymentAccount" class="form-control select2-account" required>
                           <option>Cash on hand</option>
                           <option value="1">Cash on hand:Cash on hand</option>
                           <option value="2">Corporate Account (XXXXXX 5850)</option>
                           <option value="3">Corporate Account (XXXXXX 5850)Te</option>
                           <option >Investment Asset</option>
                           <option >Payroll Refunds</option>
                           <option >Uncategorized Asset</option>
                           <option >Undeposited Funds</option>
                        </select>
                     </div>
                     <div class="col-md-3" style="line-height: 100px">
                        <span style="font-weight: bold">Balance</span>
                        <span>$133,101.00</span>
                     </div>
                     <div class="col-md-3" style="text-align: right">
                        <div class="d-flex align-items-center mt-2 justify-content-end">
                           <div class="mr-4">AMOUNT</div>
                           <div>
                              <h1 id="h1_amount-expense">$0.00</h1>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row" style="margin-top: 20px;">
                     <div class="col-md-3">
                        <label for="">Payment date</label>
                        <input type="date" name="payment_date" id="expensePaymentDate" class="form-control" required>
                     </div>
                     <!-- <div class="col-md-2">
                        </div> -->
                     <div class="col-md-3">
                        <label for="">Payment method</label>
                        <select name="payment_method" id="expensePaymentMethod" class="form-control select2-method" required>
                           <option value=""></option>
                           <option>Cash</option>
                           <option>Check</option>
                           <option>Credit Card</option>
                        </select>
                     </div>
                     <!-- <div class="col-md-2"></div> -->
                     <div class="col-md-3">
                        <div class="form-group">
                           <label for="">Ref no.</label>
                           <input type="text" name="ref_num" id="expenseRefNumber" class="form-control" required>
                        </div>
                        <!-- <div class="form-group">
                           <label for="">Permit no.</label>
                           <input type="text" name="permit_num" id="expensePermitNumber" class="form-control" required>
                           </div> -->
                     </div>
                     <div class="col-md-3">
                        <div class="form-group">
                           <label for="">Permit no.</label>
                           <input type="text" name="permit_num" id="expensePermitNumber" class="form-control" required>
                        </div>
                     </div>
                  </div>
                  <div class="table-container">
                     <div class="table-loader">
                        <p class="loading-text">Loading records</p>
                     </div>
                     <!--                        DataTables-->
                     <table id="expensesCheckTable" class="table table-striped table-bordered" style="width:100%;margin-top: 20px;">
                        <thead>
                           <tr>
                              <th></th>
                              <th>#</th>
                              <th>CATEGORY</th>
                              <th>DESCRIPTION</th>
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
                              <td style="text-align: center"><a href="#" id="delete-row-expense"><i class="fa fa-trash"></i></a></td>
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
                        </tbody>
                     </table>
                  </div>
                  <div class="addAndRemoveRow">
                     <div class="total-amount-container">
                        <span style="margin-right: 200px;font-size: 17px">Total</span>
                        $<span id="total-amount-expense">0.00</span>
                     </div>
                     <button type="button" class="add-remove-line" id="add-four-line-expense">Add lines</button>
                     <button type="button" class="add-remove-line" id="clear-all-line-expense">Clear all lines</button>
                  </div>
                  <!-- <div class="form-group">
                     <label for="">Memo</label>
                     <textarea name="memo" id="expenseMemo" cols="30" rows="3" placeholder="" style="width: 350px;resize: none;" ></textarea>
                     </div> -->
                  <div class="row">
                     <div class="col-md-4">
                        <div class="form-group">
                           <label for="">Memo</label>
                           <textarea name="memo" id="expenseMemo" cols="30" rows="3" placeholder="" style="width: 100%;resize: none;" ></textarea>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group">
                           <label for=""><i class="fa fa-paperclip"></i>&nbsp;Attachment</label>
                           <span>Maximum size: 20MB</span>
                           <div id="expenseAttachment" class="dropzone" style="border: 1px solid #e1e2e3;background: #ffffff;width: 423px;">
                              <div class="dz-message" style="margin: 20px;border">
                                 <span style="font-size: 16px;color: rgb(180,132,132);font-style: italic;">Drag and drop files here or</span>
                                 <a href="#" style="font-size: 16px;color: #0b97c4">browse to upload</a>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-8" style="padding-top: 30px;">
                           <div class="file-container-list" id="file-list-expense"></div>
                        </div>
                        <div class="form-group">
                           <div class="show-existing-file">
                              <a href="#" id="showExistingFile">Show existing file</a>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- <div class="form-group">
                     <div class="show-existing-file">
                         <a href="#" id="showExistingFile">Show existing file</a>
                     </div>
                     </div> -->
                  <div class="privacy">
                     <a href="#">Privacy</a> 
                  </div>
               </div>
               <div class="modal-footer-check">
                  <div class="row">
                     <div class="col-md-5">
                        <button class="btn btn-dark cancel-button" id="closeModalExpense" type="button">Cancel</button>
                     </div>
                     <div class="col-md-2" style="text-align: center;">
                        <div>
                           <a href="#" style="color: #ffffff;">Make recurring</a>
                        </div>
                     </div>
                     <div class="col-md-5">
                        <div class="dropdown" style="float: right;display: inline-block;position: relative;">
                           <button type="button" data-dismiss="modal" id="expenseSaved" class="btn btn-success" style="border-radius: 20px 0 0 20px">Save and new</button>
                           <button class="btn btn-success" type="button" data-toggle="dropdown" style="border-radius: 0 20px 20px 0;margin-left: -5px;">
                           <span class="fa fa-caret-down"></span></button>
                           <ul class="dropdown-menu dropdown-menu-right" role="menu">
                              <li><a href="#">Save and close</a></li>
                           </ul>
                        </div>
                        <div class="" style="display: inline-block;float: right;margin-right: 10px;">
                           <button class="btn btn-transparent" data-dismiss="modal" id="expenseSaved" type="button">Save</button>
                        </div>
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<!--    end of modal-->
<!--    Bill modal-->
<div class="full-screen-modal">
   <div id="bill-modal" class="modal fade modal-fluid" role="dialog">
      <div class="modal-dialog">
         <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header">
               <div class="modal-title">
                  <a href=""><i class="fa fa-history fa-lg" style="margin-right: 10px"></i></a>
                  Bill
               </div>
               <!-- <button type="button" class="close" id="closeBillModal"><i class="fa fa-times fa-lg"></i></button> -->
               <button type="button" class="close" id="closeModalExpense" data-dismiss="modal" aria-label="Close"><i class="fa fa-times fa-lg"></i></button>
            </div>
            <!-- <form action="" method="post" id="billForm"> -->
            <form action="<?php echo site_url()?>accounting/addBill" method="post" id="billForm">
               <div class="modal-body" style="margin-bottom: 100px">
                  <div class="row">
                     <div class="col-md-3">
                        <label for="">Vendor</label>
                        <input type="hidden" name="bill_id" id="billID">
                        <input type="hidden" name="transaction_id" id="billTransId" class="transaction_id">
                        <input type="hidden" id="billType" class="expenseType" value="Bill">
                        <select name="vendor_id" id="billVendorID" class="form-control select2-vendor">
                           <option></option>
                           <option disabled>&plus;&nbsp;Add new</option>
                           <?php foreach ($vendors as $vendor):?>
                           <option value="<?php echo $vendor->vendor_id?>"><?php echo $vendor->f_name."&nbsp;".$vendor->l_name;?> </option>
                           <?php endforeach; ?>
                        </select>
                     </div>
                     <div class="col-md-9" style="text-align: right">
                        <div class="d-flex align-items-center mt-2 justify-content-end">
                           <div class="mr-4">Balance Due</div>
                           <div>
                              <h1 id="h1_amount-bill">$0.00</h1>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row" style="margin-top: 20px;width: 100%;margin-bottom: 20px;">
                     <div class="col">
                        <label for="">Mailing address</label>
                        <textarea name="mailing_address" id="billMailingAddress" cols="30" rows="4" placeholder="" style="resize: none;"></textarea>
                     </div>
                     <div class="col">
                        <label for="">Terms</label>
                        <select name="terms" id="addNewTerms" class="form-control select2-bill-terms">
                           <option></option>
                           <option value="0">+ New</option>
                           <option>Due on receipt</option>
                           <!-- <option>Net 15</option>
                           <option>Net 30</option>
                           <option>Net 60</option> -->
                           <?php foreach($terms as $term) : ?>
                           <option value="<?php echo $term->id; ?>"><?php echo $term->description . ' ' . $term->day; ?></option>
                           <?php endforeach; ?>
                        </select>
                     </div>
                     <div class="col">
                        <label for="">Bill date</label>
                        <input type="date" name="bill_date" id="billDate" class="form-control">
                     </div>
                     <div class="col">
                        <label for="">Due date</label>
                        <input type="date" name="due_date" id="billDueDate" class="form-control">
                     </div>
                     <div class="col">
                        <div class="form-group">
                           <label for="">Bill no.</label>
                           <input type="text" name="bill_number" id="billNumber" class="form-control" value="">
                        </div>
                        <!-- <div class="form-group">
                           <label for="">Permit no.</label>
                           <input type="text" name="permit_num" id="billPermitNumber" class="form-control">
                           </div> -->
                     </div>
                     <div class="col col-md-2">
                        <!-- <div class="form-group">
                           <label for="">Bill no.</label>
                           <input type="text" name="bill_num" id="billNumber" class="form-control" value="">
                           </div> -->
                        <div class="form-group">
                           <label for="">Permit no.</label>
                           <input type="text" name="permit_number" id="billPermitNumber" class="form-control">
                        </div>
                     </div>
                  </div>
                  <div class="table-container">
                     <div class="table-loader">
                        <p class="loading-text">Loading records</p>
                     </div>
                     <!--                        DataTables-->
                     <table id="expensesCheckTable" class="table table-striped table-bordered" style="width:100%;margin-top: 20px;">
                        <thead>
                           <tr>
                              <th></th>
                              <th>#</th>
                              <th>CATEGORY</th>
                              <th>DESCRIPTION</th>
                              <th>AMOUNT</th>
                              <th></th>
                           </tr>
                        </thead>
                        <tbody id="line-container-bill">
                           <tr id="tableLine-bill">
                              <td></td>
                              <td><span id="line-counter-bill">1</span></td>
                              <td>
                                 <div id="" style="display:;">
                                    <select name="category[]" id="" class="form-control billCategory select2-bill-category">
                                       <option></option>
                                       <?php foreach ($list_categories as $list): ?>
                                       <option value="<?php echo $list->id?>"><?php echo $list->category_name;?></option>
                                       <?php endforeach;?>
                                    </select>
                                 </div>
                              </td>
                              <td><input type="text" name="description[]" class="form-control billDescription" id="tbl-input-bill" style="display: ;"></td>
                              <td><input type="text" name="amount[]" class="form-control billAmount" id="tbl-input-bill" style="display: ;"></td>
                              <td style="text-align: center"><a href="#" id="delete-row-bill"><i class="fa fa-trash"></i></a></td>
                           </tr>
                           <tr id="tableLine-bill">
                              <td></td>
                              <td><span id="line-counter-bill">2</span></td>
                              <td>
                                 <div id="" style="display:;">
                                    <select name="category[]" id="" class="form-control billCategory select2-bill-category">
                                       <option></option>
                                       <?php foreach ($list_categories as $list): ?>
                                       <option value="<?php echo $list->id?>"><?php echo $list->category_name;?></option>
                                       <?php endforeach;?>
                                    </select>
                                 </div>
                              </td>
                              <td><input type="text" name="description[]" class="form-control billDescription" id="tbl-input-bill" style="display: ;"></td>
                              <td><input type="text" name="amount[]" class="form-control billAmount" id="tbl-input-bill" style="display: ;"></td>
                              <td style="text-align: center"><a href="#" id="delete-row-bill"><i class="fa fa-trash"></i></a></td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
                  <div class="addAndRemoveRow">
                     <div class="total-amount-container">
                        <span style="margin-right: 200px;font-size: 17px">Total</span>
                        $<span id="total-amount-bill">0.00</span>
                     </div>
                     <button type="button" class="add-remove-line" id="add-four-line-bill">Add lines</button>
                     <button type="button" class="add-remove-line" id="clear-all-line-bill">Clear all lines</button>
                  </div>
                  <!-- <div class="form-group">
                     <label for="">Memo</label>
                     <textarea name="memo" id="billMemo" cols="30" rows="3" placeholder="" style="width: 350px;resize: none;" ></textarea>
                     </div> -->
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="">Memo</label>
                              <textarea name="memo" id="billMemo" cols="30" rows="3" placeholder="" style="width: 100%;resize: none;" ></textarea>
                           </div>
                        </div>
                        <div class="col-md-4">
                           <label for=""><i class="fa fa-paperclip"></i>&nbsp;Attachment</label>
                           <span>Maximum size: 20MB</span>
                           <div id="billAttachment" class="dropzone" style="border: 1px solid #e1e2e3;background: #ffffff;width: 423px;">
                              <div class="dz-message" style="margin: 20px;border">
                                 <span style="font-size: 16px;color: rgb(180,132,132);font-style: italic;">Drag and drop files here or</span>
                                 <a href="#" style="font-size: 16px;color: #0b97c4">browse to upload</a>
                              </div>
                           </div>
                           <div class="col-md-8" style="padding-top: 30px;">
                              <div class="file-container-list" id="file-list-bill"></div>
                           </div>
                           <div class="form-group">
                              <div class="show-existing-file">
                                 <a href="#" id="showExistingFile">Show existing file</a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- <div class="form-group">
                     <div class="show-existing-file">
                         <a href="#" id="showExistingFile">Show existing file</a>
                     </div>
                     </div> -->
                  <div class="privacy">
                     <a href="#">Privacy</a>
                  </div>
               </div>
               <div class="modal-footer-check">
                  <div class="row">
                     <div class="col-md-5">
                        <button class="btn btn-dark cancel-button" id="closeBillModal" type="button">Cancel</button>
                     </div>
                     <div class="col-md-2" style="text-align: center;">
                        <div>
                           <a href="#" style="color: #ffffff;">Make recurring</a>
                        </div>
                     </div>
                     <div class="col-md-5">
                        <div class="dropdown" style="float: right;display: inline-block;position: relative;">
                           <button type="button" class="btn btn-success" data-dismiss="modal" id="billSaved" style="border-radius: 20px 0 0 20px">Save and schedule payment</button>
                           <button class="btn btn-success" type="button" data-toggle="dropdown" style="border-radius: 0 20px 20px 0;margin-left: -5px;">
                           <span class="fa fa-caret-down"></span></button>
                           <ul class="dropdown-menu dropdown-menu-right" role="menu">
                              <li><a href="#">Save and new</a></li>
                              <li><a href="#">Save and close</a></li>
                           </ul>
                        </div>
                        <div class="" style="display: inline-block;float: right;margin-right: 10px;">
                           <button class="btn btn-transparent" id="billSaved" data-dismiss="modal" type="button">Save</button>
                        </div>
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<!--    end of modal-->
<!--    Add/Edit Checks Modal-->
<div class="full-screen-modal">
   <div id="edit-expensesCheck" class="modal fade modal-fluid" role="dialog">
      <div class="modal-dialog">
         <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header">
               <div class="modal-title">
                  <a href=""><i class="fa fa-history fa-lg" style="margin-right: 10px"></i></a>
                  Check #<span id="checkNUmberHeader"></span>
               </div>
               <button type="button" class="close" id="closeCheckModal"><i class="fa fa-times fa-lg"></i></button>
            </div>
            <form action="" method="post" id="addEditCheckmodal">
               <div class="modal-body" style="margin-bottom: 100px">
                  <div class="row">
                     <div class="col-md-3">
                        <label for="">Payee</label>
                        <input type="hidden" name="check_id" id="checkID" value="">
                        <input type="hidden" name="transaction_id" class="transaction_id" id="checktransID">
                        <input type="hidden" id="checkType" class="expenseType" value="Check">
                        <select name="vendor_id" id="checkVendorID" class="form-control select2-payee">
                           <option></option>
                           <?php foreach ($vendors as $vendor):?>
                           <option value="<?php echo $vendor->vendor_id?>"><?php echo $vendor->f_name."&nbsp;".$vendor->l_name;?> </option>
                           <?php endforeach; ?>
                        </select>
                     </div>
                     <div class="col-md-3">
                        <label for="">Bank Account</label>
                        <select name="bank_id" id="bank_account" class="form-control select2-account">
                           <option></option>
                           <option value="1">Cash on hand</option>
                           <option value="2">Corporate Account(XXXXXX 5850)</option>
                           <option value="3">Corporate Account(XXXXXX 5850)Te</option>
                        </select>
                     </div>
                     <div class="col-md-3" style="line-height: 100px">
                        <span style="font-weight: bold">Balance</span>
                        <span>$113,101.00</span>
                     </div>
                     <div class="col-md-3" style="text-align: right">
                        <div class="d-flex align-items-center mt-2 justify-content-end">
                           <div class="mr-4">AMOUNT</div>
                           <div>
                              <h1 id="h1_amount-check">$0.00</h1>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row" style="margin-top: 20px">
                     <div class="col-md-3">
                        <label for="">Mailing address</label>
                        <textarea name="mailing_address" id="check_mailing_address" cols="30" rows="4" placeholder="" style="resize: none;"></textarea>
                     </div>
                     <div class="col-md-3">
                        <label for="">Payment date</label>
                        <input type="date" name="payment_date" id="payment_date" class="form-control">
                     </div>
                     <!-- <div class="col-md-3"></div> -->
                     <div class="col-md-3">
                        <div class="form-group">
                           <label for="">Check no.</label>
                           <input type="text" name="check_num" id="check_number" class="form-control" value="1">
                        </div>
                        <div class="form-group">
                           <input type="checkbox" name="print_later" id="print_later" value="1">
                           <label for="">Print later</label>
                        </div>
                        <!-- <div class="form-group">
                           <label for="">Permit no.</label>
                           <input type="text" name="permit_num" id="permit_number" class="form-control">
                           </div> -->
                     </div>
                     <div class="col-md-3">
                        <div class="form-group">
                           <label for="">Permit no.</label>
                           <input type="text" name="permit_num" id="permit_number" class="form-control">
                        </div>
                     </div>
                  </div>
                  <div class="table-container">
                     <div class="table-loader">
                        <p class="loading-text">Loading records</p>
                     </div>
                     <!--                        DataTables-->
                     <table id="expensesCheckTable" class="table table-striped table-bordered" style="width:100%;margin-top: 20px;">
                        <thead>
                           <tr>
                              <th></th>
                              <th>#</th>
                              <th>CATEGORY</th>
                              <th>DESCRIPTION</th>
                              <th>AMOUNT</th>
                              <th></th>
                           </tr>
                        </thead>
                        <tbody id="line-container-check">
                           <tr id="tableLine">
                              <td></td>
                              <td><span id="line-counter">1</span></td>
                              <td>
                                 <div id="" style="display:none;">
                                    <input type="hidden" id="prevent_process" value="true">
                                    <select name="category[]" id="" class="form-control checkCategory select2-check-category">
                                       <option></option>
                                       <?php foreach ($list_categories as $list): ?>
                                       <option value="<?php echo $list->id?>"><?php echo $list->category_name;?></option>
                                       <?php endforeach;?>
                                    </select>
                                 </div>
                              </td>
                              <td><input type="text" name="description[]" class="form-control checkDescription" id="tbl-input" style="display: none;"></td>
                              <td><input type="text" name="amount[]" class="form-control checkAmount" id="tbl-input" style="display: none;"></td>
                              <td style="text-align: center"><a href="#" id="delete-line-row"><i class="fa fa-trash"></i></a></td>
                           </tr>
                           <tr id="tableLine">
                              <td></td>
                              <td><span id="line-counter">2</span></td>
                              <td>
                                 <div id="" style="display:none;">
                                    <input type="hidden" id="prevent_process" value="true">
                                    <select name="category[]" id="" class="form-control checkCategory select2-check-category">
                                       <option></option>
                                       <?php foreach ($list_categories as $list): ?>
                                       <option value="<?php echo $list->id?>"><?php echo $list->category_name;?></option>
                                       <?php endforeach;?>
                                    </select>
                                 </div>
                              </td>
                              <td><input type="text" name="description[]" class="form-control checkDescription" id="tbl-input" style="display: none;"></td>
                              <td><input type="text" name="amount[]" class="form-control checkAmount" id="tbl-input" style="display: none;"></td>
                              <td style="text-align: center"><a href="#" id="delete-line-row"><i class="fa fa-trash"></i></a></td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
                  <div class="addAndRemoveRow">
                     <div class="total-amount-container">
                        <span style="margin-right: 200px;font-size: 17px">Total</span>
                        $<span id="total-amount-check">0.00</span>
                     </div>
                     <button type="button" class="add-remove-line" id="add-four-line">Add lines</button>
                     <button type="button" class="add-remove-line" id="clear-all-line">Clear all lines</button>
                  </div>
                  <!-- <div class="form-group">
                     <label for="">Memo</label>
                     <textarea name="name" id="checkMemo" cols="30" rows="3" placeholder="" style="width: 350px;resize: none;" ></textarea>
                     </div> -->
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="">Memo</label>
                              <textarea name="name" id="checkMemo" cols="30" rows="3" placeholder="" style="width: 100%;resize: none;" ></textarea>
                           </div>
                        </div>
                        <div class="col-md-4">
                           <label for=""><i class="fa fa-paperclip"></i>&nbsp;Attachment</label>
                           <span>Maximum size: 20MB</span>
                           <div id="checkAttachment" class="dropzone" style="border: 1px solid #e1e2e3;background: #ffffff;width: 423px;overflow: inherit">
                              <div class="dz-message" style="margin: 20px;">
                                 <span style="font-size: 16px;color: rgb(180,132,132);font-style: italic;">Drag and drop files here or</span>
                                 <span style="font-size: 16px;color: #0b97c4">browse to upload</span>
                              </div>
                           </div>
                           <div class="col-md-8" style="padding-top: 30px;">
                              <div class="file-container-list" id="file-list-check"></div>
                           </div>
                           <div class="form-group">
                              <div class="show-existing-file">
                                 <a href="#" id="showExistingFile">Show existing file</a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- <div class="form-group">
                     <div class="show-existing-file">
                         <a href="#" id="showExistingFile">Show existing file</a>
                     </div>
                     </div> -->
                  <div class="privacy">
                     <a href="#">Privacy</a>
                  </div>
               </div>
               <div class="modal-footer-check">
                  <div class="row">
                     <div class="col-md-4">
                        <button class="btn btn-dark cancel-button" id="closeCheckModal" type="button">Cancel</button>
                        <button class="btn btn-dark cancel-button" type="reset">Revert</button>
                     </div>
                     <div class="col-md-5">
                        <div class="middle-links">
                           <a href="">Print check</a>
                        </div>
                        <div class="middle-links">
                           <a href="">Order checks</a>
                        </div>
                        <div class="middle-links">
                           <a href="">Make recurring</a>
                        </div>
                        <div class="middle-links end">
                           <a href="">More</a>
                        </div>
                     </div>
                     <div class="col-md-3">
                        <div class="dropdown" style="float: right">
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
      </div>
   </div>
</div>
<!--    end of modal-->
<!--    Add/Edit Checks Modal-->
<div class="full-screen-modal">
   <div id="pay-bills" class="modal fade modal-fluid" role="dialog">
      <div class="modal-dialog">
         <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header">
               <div class="modal-title">
                  <a href=""><i class="fa fa-history fa-lg" style="margin-right: 10px"></i></a>
                  Pay Bills<span id="checkNUmberHeader"></span>
               </div>
               <!-- <button type="button" class="close" id="closeCheckModal"><i class="fa fa-times fa-lg"></i></button> -->
               <button type="button" class="close" id="closeModalInvoice" data-dismiss="modal" aria-label="Close"><i class="fa fa-times fa-lg"></i></button>
            </div>
            <form action="" method="post" id="addEditCheckmodal">
               <div class="modal-body" style="margin-bottom: 100px">
                  <div class="row">
                     <div class="col-md-3">
                        <label for="">Payment Account</label>
                        <select name="bank_id" id="bank_account" class="form-control select2-account">
                           <option></option>
                           <option value="1">Cash on hand</option>
                           <option value="2">Corporate Account(XXXXXX 5850)</option>
                           <option value="3">Corporate Account(XXXXXX 5850)Te</option>
                        </select>
                     </div>
                     <div class="col-md-2" style="line-height: 100px">
                        <span style="font-weight: bold">Balance</span>
                        <span>$113,101.00</span>
                     </div>
                     <div class="col-md-2">
                        <label for="">Payment date</label>
                        <input type="date" name="payment_date" id="payment_date" class="form-control">
                     </div>
                     <div class="col-md-2">
                        <div class="form-group">
                           <label for="">Check no.</label>
                           <input type="text" name="check_num" id="check_number" class="form-control" value="1">
                        </div>
                        <div class="form-group">
                           <input type="checkbox" name="print_later" id="print_later" value="1">
                           <label for="">Print later</label>
                        </div>
                     </div>
                     <div class="col-md-3" style="text-align: right">
                        <div class="d-flex align-items-center mt-2 justify-content-end">
                           <div class="mr-4">TOTAL PAYMENT AMOUNT</div>
                           <div>
                              <h1 id="h1_pay_amount-check">$0.00</h1>
                           </div>
                        </div>
                     </div>
                  </div>
                  <style type="text/css">
                     .zero-state-content {
                     margin-top: 120px;
                     text-align: center;
                     align-items: center;
                     flex-direction: column;
                     display: flex;
                     }
                     .zero-state-content .envelope {
                     width: 64px;
                     height: 64px;
                     margin-bottom: 30px;
                     background-image: url(data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjQiIGhlaWdodD0iNjMiIHZpZXdCb3g9IjAgMCA2NCA2MyIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayI+CjxyZWN0IHdpZHRoPSI2NCIgaGVpZ2h0PSI2Mi42NjY3IiBmaWxsPSJ1cmwoI3BhdHRlcm4wKSIvPgo8ZGVmcz4KPHBhdHRlcm4gaWQ9InBhdHRlcm4wIiBwYXR0ZXJuQ29udGVudFVuaXRzPSJvYmplY3RCb3VuZGluZ0JveCIgd2lkdGg9IjEiIGhlaWdodD0iMSI+Cjx1c2UgeGxpbms6aHJlZj0iI2ltYWdlMCIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMCAtMC4wMDE1MTk3NSkgc2NhbGUoMC4wMTc4NTcxIDAuMDE4MjM3MSkiLz4KPC9wYXR0ZXJuPgo8aW1hZ2UgaWQ9ImltYWdlMCIgd2lkdGg9IjU2IiBoZWlnaHQ9IjU1IiB4bGluazpocmVmPSJkYXRhOmltYWdlL3BuZztiYXNlNjQsaVZCT1J3MEtHZ29BQUFBTlNVaEVVZ0FBQURnQUFBQTNDQVlBQUFCWjBJbkxBQUFGb2tsRVFWUm9CZDJhKzA5YlZSekFxekhSUDhINEgvaWIwUmg2U3pSVE56T3p4R2dXcHlPaU14cGpab0tTK1p4VHpqbVZzTEdGRFRaRVdQU0hnVXdqQTB6bVkzTnAyYUJRb0ZCNUY4ZWpQRllFU25tWGxqNis1bnUzVS91a0xiZTN2ZlVrMzV4NzdqM25udS9uZnMvM2U4NDk5NnBVTzZROWhEd2dVUHFjaHRJRGFSY3RlUmI3MzBFOTZaZlVsRlFJakVDbVJNM0k5VDJFUENTZEpNWWQxSXhlenhRYzcxZFdTQTc0Y3ZrNTZKNllTSXVVL3ZacnRCRnpUUlpMY3NDOHFtOGdYZWxIWTBjMFFEeVhla2lGQWFZZVVvR0FDUG5IQ3hVVkQ4WUlHOG1kVmloZzZpQVZESmdheUV3QS90UnBST1VURWpVanRjbU55YkRhQWlOL1ltZDVWWlhwQ3FKZ3NkbGcvK25TUkFIbndsUk9yaWd3YWtYQXZhZE9oZ0J1ZUR4d3JMTVRDam82RXBJYWl5V2tmYnlDYm5nWVBycGNEeC9VMVVhVnZhZEs3ajRBTFhVbFJ4UldXMkRVam9CUEYzOGRvcE1mQVBSek5yZzJPNXVRREMwdmg3U1hXbmlwL0t3SXFHYkVGNlp5Y3NWWWdGSVZsTm8rSllDNWhEd2lNTElWellKU0ZaVGFuZ01LV3VyWEVQSlljbVpUcVZScXJmWlJnWkVwaEVONXZqVFVCNlVxS0xYOW16WFZRVUdJcnVWUXVpOWh5RnpHbmhJWWRYQTR6QStuTVlvbUF2L2xsWVlnUURRQzNkWlFtaDhYTW9mU2czeFlJaGkrUldBZXZ0ajIrTGJoNmtnTk5BNVV5QzZ0azAwUnpCd1FvMm11bHQyRHBYNkJGWDBXRTFMRFNBRkdKUVRTTUFxNHFpK291eFFWME9WeHd2ZmRKK0JiNDhleVMvTlE1QnpNQVErVW5ZRzJ2MGZobVpMaWdFWFZqRlNxQ0xrL0dQUStnWkpTQkVQQktlSEcwS0Q0MUdJQlJqelNOSjhJQnNTdUIyZG5ZZitaNE1VQmJReThQd3FVWE9CdyswcFBnbm5LR2xBM1d3QlI0ZW1sSlRoNHZqeklrbFFuV3BIUGRTK2VMWU9KaFlVQUhCNWtFeURxNjlqWWdDTVgvNHV3VHhMeXNFcGdaQmt0cVAwbDBwbXpEUkFoZjJnM0JLeUljL211QUwxK1B6Uk1Ua0w5K0xqc29yUFpRa1lWRnNKOU1MaENVb0NGOVhYaTA4aXZyZ3ErQnppOVhpanArd3RvYjYvczh0M29hRWpmV0NCTlYwUzkwSzNDVTF6QUxhOFhjREdOU1Q4eURLOWNxSUFtaytuZUdXVmtYUlBqY0tqeVBGd3l0QVVVMnZSNHdPLzN4eCtpMU53cnZncDFMUzRHR2l2NVlHeHRGVkRudDF0YndlWDF4Z2RjY3JtZzJqSUNoL1Y2T0c0eXdZRERvVWcrMitZbWxBME93S3M2SFRDekdVejJ4Y1FBT1kzTjZZUnpnNFBpRGJSbU05eGVYZVdYTXBvNzNHNjRhTEdJQnZqQ1pBSWNhUWlMa3BBRnc3V2ZYRitIa3I0K09LVFR3ZW4rZnBqWjJBaXZrcFl5K3RqbDhYSEl2OWtDaFVZamRDNHN3SXJiSFlEYk5TRFhmbVJsQllwNmUrQTF2UTRxaDRkaGZtdUxYNUkxMy9iNTRPcjB0T2hqN3hrTWNPUE9IZkQ1L1JGd2tnRTVoZGx1aDArN3V5QlByd2NNNGN0dU43K1UwaHdqZWN2Y0hCeHROOEJidDI1Qjg1UVYzRDZmMkVlNDVTUU4wV2hhWStmdDgvUHdvYkZESERJNDRlTkdWS3FTYVhGUmpPU3Z0N1JBM2RoWXlMMWp3YVhNZ3NFUU9GUndwWEhVY1BjcE4xcXRvcU1IMTBubWVIUmxCYjdxUVRmUVE5WElDTmhkcnBEbU84SEpBc2g3NTM3eVRtc3J2TnZXQnIvUHpJREh6NWNMdkZic0hBTlhhWDkvSUpETmJtNUdWSTRISnlzZzF3WlhRYmhHUFhMckpyemYzaTV1TGFLVll5VzBFRm9LTFlZQmJIUjFKV3JWUk9EU0FzaTFXOXZlaHRxeDI0QStWTmhwQkdQWWE5aDYwSFhjUU82eDIzblRpRHhSdUxRQ2NpMGRMbGRnVXY2OHV4dDY3WFpvdGxyRnFJZ1d4aWdaMjc0UWRTcEFrRml5cTRtZUt5c2wvOGZwaElxaElYRlZoR3RHbk5mUWIzZEt5VmlPQTJjTWtJUE1PWjNnVEdBNjJRMWNSb1lvQjBzbTN5MWNWZ0JLZ1ZNOG9GUTRSUU9tQWs2eGdLbUNVeVJnS3VFVUI1aHFPRVVCeWdHbkdFQzU0QlFCS0NkY3hnRnh1d0czTitRVWo4OFhlMS8wUk1QUFlGOWZ6M3FwMXV2Q1A3NVFDLzgrK1AvS3FWUDhLMUZnNUEyQjRmZnR4UDRQeTVaNitFays4QmxiWFV3ZTEyanBNVFVyK2lUYkJUbHlHSHVDdy8wTEVHd21EdTRHRmVnQUFBQUFTVVZPUks1Q1lJST0iLz4KPC9kZWZzPgo8L3N2Zz4K);
                     background-size: cover;
                     background-repeat: no-repeat;
                     backface-visibility: hidden;
                     }
                     .zero-state-content .title {
                     font-size: 24px;
                     font-weight: 500;
                     margin-bottom: .4rem;
                     }
                     .zero-state-content .sub-title {
                     font-size: 16px;
                     margin-bottom: 30px;
                     }
                     .button.primary, [type=button].primary {
                     background-image: none;
                     background-color: #2CA01C;
                     color: #FFFFFF;
                     border-radius: 36px;
                     box-shadow: none;
                     border: 1px solid #2CA01C;
                     padding: 0 20px;
                     }
                     .zero-state-content .learn-more-text {
                     margin-top: 30px;
                     font-size: 14px;
                     flex-direction: row;
                     display: flex;
                     justify-content: center;
                     }
                  </style>
                  <div class="zero-state-content" data-qbo-bind="visible: nobills" style="">
                     <div class="envelope"></div>
                     <div class="title">Looks like you don't have any bills to pay.</div>
                     <div class="sub-title">Enter a bill to schedule a payment.</div>
                     <button type="button" class="primary lighter" data-dojo-attach-event="onclick:navigateToBilling" data-toggle="modal" data-target="#new-bill" id="newBill">Enter new bill</button>
                     <div class="learn-more-text">
                        Want to learn more?
                        <a class="video-link" target="_blank" href="https://www.youtube.com/watch?v=p4FPKQ8Bf5M&amp;feature=youtu.be">Watch this video</a>
                        <div class="time-stamp">(3:39s) or</div>
                        <a class="guide-link" target="_blank" href="https://quickbooks.intuit.com/learn-support/en-us/pay-bills/enter-and-pay-bills/00/186102">visit our guide</a>
                     </div>
                  </div>
               </div>
               <div class="modal-footer-check">
                  <div class="row">
                     <div class="col-md-4">
                        <button class="btn btn-dark cancel-button" id="closeCheckModal" type="button">Cancel</button>
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<div class="full-screen-modal">
   <div id="new-bill" class="modal fade modal-fluid" role="dialog">
      <div class="modal-dialog">
         <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header">
               <div class="modal-title">
                  <a href=""><i class="fa fa-history fa-lg" style="margin-right: 10px"></i></a>
                  Bill
               </div>
               <!-- <button type="button" class="close" id="closeModalExpense1"><i class="fa fa-times fa-lg"></i></button> -->
               <button type="button" class="close" id="closeModalInvoice" data-dismiss="modal" aria-label="Close"><i class="fa fa-times fa-lg"></i></button>
            </div>
            <form action="" method="post" id="expenseForm">
               <div class="modal-body" style="margin-bottom: 100px">
                  <div class="row">
                     <div class="col-md-3">
                        <label for="">Vendor</label>
                        <input type="hidden" id="expenseTransId" class="transaction_id">
                        <input type="hidden" id="expenseId">
                        <input type="hidden" id="exType" class="" value="Expense" data-id="">
                        <select name="vendor_id" id="expenseVendorId" class="form-control select2-payee" required>
                           <option value=""></option>
                           <option disabled>&plus;&nbsp;Add new</option>
                           <?php foreach ($vendors as $vendor):?>
                           <option value="<?php echo $vendor->vendor_id?>"><?php echo $vendor->f_name."&nbsp;".$vendor->l_name;?> </option>
                           <?php endforeach; ?>
                        </select>
                     </div>
                     <!-- <div class="col-md-3">
                        <label for="">Payment account <i class="fa fa-question-circle"></i></label>
                        <select name="payment_account" id="expensePaymentAccount" class="form-control select2-account" required>
                            <option>Cash on hand</option>
                            <option value="1">Cash on hand:Cash on hand</option>
                            <option value="2">Corporate Account (XXXXXX 5850)</option>
                            <option value="3">Corporate Account (XXXXXX 5850)Te</option>
                            <option >Investment Asset</option>
                            <option >Payroll Refunds</option>
                            <option >Uncategorized Asset</option>
                            <option >Undeposited Funds</option>
                        </select>
                        </div>
                        <div class="col-md-3" style="line-height: 100px">
                        <span style="font-weight: bold">Balance</span>
                        <span>$133,101.00</span>
                        </div> -->
                     <div class="col-md-9" style="text-align: right">
                        <div class="d-flex align-items-center mt-2 justify-content-end">
                           <div class="mr-4">BALANCE DUE</div>
                           <div>
                              <h1 id="h1_amount-expense">$0.00</h1>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row" style="margin-top: 20px;">
                     <div class="col-md-2">
                        <label for="">Mailing address</label>
                        <textarea name="mailing_address" id="billMailingAddress" cols="30" rows="4" placeholder="" style="resize: none;" style="width: 100%;"></textarea>
                     </div>
                     <div class="col-md-2">
                        <label for="">Terms</label>
                        <input type="hidden" id="expenseTransId" class="transaction_id">
                        <input type="hidden" id="expenseId">
                        <input type="hidden" id="exType" class="" value="Expense" data-id="">
                           <select name="terms" id="addNewTerms" class="form-control select2-bill-terms">
                              <option></option>
                              <option value="0">+ New</option>
                              <!-- <option>Net 15</option>
                              <option>Net 30</option>
                              <option>Net 60</option> -->
                              <?php foreach($terms as $term) : ?>
                              <option value="<?php echo $term->id; ?>"><?php echo $term->description . ' ' . $term->day; ?></option>
                              <?php endforeach; ?>
                           </select>
                     </div>
                     <div class="col-md-2">
                        <label for="">Bill date</label>
                        <input type="date" name="payment_date" id="expensePaymentDate" class="form-control" required>
                     </div>
                     <div class="col-md-2">
                        <label for="">Due date</label>
                        <input type="date" name="payment_date" id="expensePaymentDate" class="form-control" required>
                     </div>
                     <div class="col-md-2">
                        <div class="form-group">
                           <label for="">Bill no.</label>
                           <input type="text" name="permit_num" id="expensePermitNumber" class="form-control" required>
                        </div> 
                     </div>
                     <div class="col-md-2">
                        <div class="form-group">
                           <label for="">Permit no.</label>
                           <input type="text" name="permit_num" id="expensePermitNumber" class="form-control" required>
                        </div>
                     </div>
                  </div>
                  <div class="row" style="margin-top: 20px;">
                     <div class="col-md-4">
                        <label for="">Tags</label>
                        <input type="text" class="form-control" required>
                     </div>
                 </div>
                  <div class="table-container">
                     <div class="table-loader">
                        <p class="loading-text">Loading records</p>
                     </div>
                     <div class="accordion" id="accordionExample">
                        <div class="table-custom">
                           <div id="headingOne">
                              <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                              <i class="fa fa-caret-right mr-2" aria-hidden="true"></i> Category details
                              </button>
                           </div>
                           <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                              <table id="expensesCheckTable" class="table table-striped table-bordered" style="width:100%;margin-top: 20px;">
                                 <thead>
                                    <tr>
                                       <th></th>
                                       <th>#</th>
                                       <th>CATEGORY</th>
                                       <th>DESCRIPTION</th>
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
                                       <td style="text-align: center"><a href="#" id="delete-row-expense"><i class="fa fa-trash"></i></a></td>
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
                                 </tbody>
                              </table>
                           </div>
                        </div>
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
                                    
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="addAndRemoveRow">
                     <div class="total-amount-container">
                        <span style="margin-right: 200px;font-size: 17px">Total</span>
                        $<span id="total-amount-expense">0.00</span>
                     </div>
                     <button type="button" class="add-remove-line" id="add-four-line-expense">Add lines</button>
                     <button type="button" class="add-remove-line" id="clear-all-line-expense">Clear all lines</button>
                  </div>
                  <!-- <div class="form-group">
                     <label for="">Memo</label>
                     <textarea name="memo" id="expenseMemo" cols="30" rows="3" placeholder="" style="width: 350px;resize: none;" ></textarea>
                     </div> -->
                  <div class="row">
                     <div class="col-md-4">
                        <div class="form-group">
                           <label for="">Memo</label>
                           <textarea name="memo" id="expenseMemo" cols="30" rows="3" placeholder="" style="width: 100%;resize: none;" ></textarea>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group">
                           <label for=""><i class="fa fa-paperclip"></i>&nbsp;Attachment</label>
                           <span>Maximum size: 20MB</span>
                           <div id="expenseAttachment" class="dropzone" style="border: 1px solid #e1e2e3;background: #ffffff;width: 423px;">
                              <div class="dz-message" style="margin: 20px;border">
                                 <span style="font-size: 16px;color: rgb(180,132,132);font-style: italic;">Drag and drop files here or</span>
                                 <a href="#" style="font-size: 16px;color: #0b97c4">browse to upload</a>
                              </div>
                           </div>
                        </div>
                        <div class="form-group">
                           <div class="show-existing-file">
                              <a href="#" id="showExistingFile">Show existing file</a>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- <div class="form-group">
                     <div class="show-existing-file">
                         <a href="#" id="showExistingFile">Show existing file</a>
                     </div>
                     </div> -->
                  <div class="privacy">
                     <a href="#">Privacy</a> 
                  </div>
               </div>
               <div class="modal-footer-check">
                  <div class="row">
                     <div class="col-md-5">
                        <button class="btn btn-dark cancel-button" id="closeModalExpense" type="button">Cancel</button>
                     </div>
                     <div class="col-md-2" style="text-align: center;">
                        <div>
                           <a href="#" style="color: #ffffff;">Make recurring</a>
                        </div>
                     </div>
                     <div class="col-md-5">
                        <div class="dropdown" style="float: right;display: inline-block;position: relative;">
                           <button type="button" data-dismiss="modal" id="expenseSaved" class="btn btn-success" style="border-radius: 20px 0 0 20px">Save and schedule payment</button>
                           <button class="btn btn-success" type="button" data-toggle="dropdown" style="border-radius: 0 20px 20px 0;margin-left: -5px;">
                           <span class="fa fa-caret-down"></span></button>
                           <ul class="dropdown-menu dropdown-menu-right" role="menu">
                              <li><a href="#">Save and close</a></li>
                           </ul>
                        </div>
                        <div class="" style="display: inline-block;float: right;margin-right: 10px;">
                           <button class="btn btn-transparent" data-dismiss="modal" id="expenseSaved" type="button">Save</button>
                        </div>
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<!--    end of modal-->
<div class="full-screen-modal">
   <div id="purchase-order" class="modal fade modal-fluid" role="dialog">
      <div class="modal-dialog">
         <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header">
               <div class="modal-title">
                  <a href=""><i class="fa fa-history fa-lg" style="margin-right: 10px"></i></a>
                  Purchase Order
               </div>
               <!-- <button type="button" class="close" id="closeModalExpense1"><i class="fa fa-times fa-lg"></i></button> -->
               <button type="button" class="close" id="closeModalInvoice" data-dismiss="modal" aria-label="Close"><i class="fa fa-times fa-lg"></i></button>
            </div>
            <!-- <form action="" method="post" id="expenseForm"> -->
            <form action="<?php echo site_url()?>accounting/addpurchaseOrder" method="post">
               <div class="modal-body" style="margin-bottom: 100px">
                  <div class="row">
                     <div class="col-md-3">
                        <label for="">Vendor</label>
                        <input type="hidden" id="expenseTransId" class="transaction_id">
                        <input type="hidden" id="expenseId">
                        <input type="hidden" id="exType" class="" value="Expense" data-id="">
                        <select name="vendor_id" id="expenseVendorId" class="form-control select2-payee" required>
                           <option value=""></option>
                           <option disabled>&plus;&nbsp;Add new</option>
                           <?php foreach ($vendors as $vendor):?>
                           <option value="<?php echo $vendor->vendor_id?>"><?php echo $vendor->f_name."&nbsp;".$vendor->l_name;?> </option>
                           <?php endforeach; ?>
                        </select>
                     </div>
                     <div class="col-md-3">
                        <div class="form-group">
                           <label for="">Email</label>
                           <input type="email" name="email" class="form-control" required>
                           <span>Cc/Bcc</span>
                        </div>
                     </div>
                     <!-- <div class="col-md-3">
                        <label for="">Payment account <i class="fa fa-question-circle"></i></label>
                        <select name="payment_account" id="expensePaymentAccount" class="form-control select2-account" required>
                            <option>Cash on hand</option>
                            <option value="1">Cash on hand:Cash on hand</option>
                            <option value="2">Corporate Account (XXXXXX 5850)</option>
                            <option value="3">Corporate Account (XXXXXX 5850)Te</option>
                            <option >Investment Asset</option>
                            <option >Payroll Refunds</option>
                            <option >Uncategorized Asset</option>
                            <option >Undeposited Funds</option>
                        </select>
                        </div>
                        <div class="col-md-3" style="line-height: 100px">
                        <span style="font-weight: bold">Balance</span>
                        <span>$133,101.00</span>
                        </div> -->
                     <div class="col-md-9" style="text-align: right">
                        <div class="d-flex align-items-center mt-2 justify-content-end">
                           <div class="mr-4">BALANCE DUE</div>
                           <div>
                              <h1 id="h1_amount-expense">$0.00</h1>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row" style="margin-top: 20px;">
                     <div class="col-md-2">
                        <label for="">Mailing address</label>
                        <textarea name="mailing_address" id="billMailingAddress" cols="30" rows="4" placeholder="" style="resize: none;" style="width: 100%;"></textarea>
                     </div>
                     <div class="col-md-2">
                        <label for="">Ship to</label>
                        <select name="vendor_id" id="expenseVendorId" class="form-control select2-payee" required>
                           <option value=""></option>
                           <option disabled>&plus;&nbsp;Add new</option>
                           <?php foreach ($vendors as $vendor):?>
                           <option value="<?php echo $vendor->vendor_id?>"><?php echo $vendor->f_name."&nbsp;".$vendor->l_name;?> </option>
                           <?php endforeach; ?>
                        </select>
                     </div>
                     <div class="col-md-2">
                        <label for="">Shipping address</label>
                        <textarea name="mailing_address" id="billMailingAddress" cols="30" rows="4" placeholder="" style="resize: none;" style="width: 100%;"></textarea>
                     </div>
                     <div class="col-md-2">
                        <label for="">Purchase Order date</label>
                        <input type="date" name="payment_date" id="expensePaymentDate" class="form-control" required>
                     </div>
                     <div class="col-md-2">
                        <div class="form-group">
                           <label for="">Ship via</label>
                           <input type="text" name="ship_via" id="expensePermitNumber" class="form-control" required>
                        </div> 
                     </div>
                     <div class="col-md-2">
                        <div class="form-group">
                           <label for="">Permit no.</label>
                           <input type="text" name="permit_num" id="expensePermitNumber" class="form-control" required>
                        </div>
                     </div>
                  </div>
                  <div class="row" style="margin-top: 20px;">
                     <div class="col-md-4">
                        <label for="">Tags</label>
                        <input type="text" class="form-control" name="tags" required>
                     </div>
                 </div>
                  <div class="table-container">
                     <div class="table-loader">
                        <p class="loading-text">Loading records</p>
                     </div>
                     <div class="accordion" id="accordionExample">
                        <div class="table-custom">
                           <div id="headingOne">
                              <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                              <i class="fa fa-caret-right mr-2" aria-hidden="true"></i> Category details
                              </button>
                           </div>
                           <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                              <table id="expensesCheckTable" class="table table-striped table-bordered" style="width:100%;margin-top: 20px;">
                                 <thead>
                                    <tr>
                                       <th></th>
                                       <th>#</th>
                                       <th>CATEGORY</th>
                                       <th>DESCRIPTION</th>
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
                                       <td style="text-align: center"><a href="#" id="delete-row-expense"><i class="fa fa-trash"></i></a></td>
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
                                 </tbody>
                              </table>
                           </div>
                        </div>
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
                                    
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="addAndRemoveRow">
                     <div class="total-amount-container">
                        <span style="margin-right: 200px;font-size: 17px">Total</span>
                        $<span id="total-amount-expense">0.00</span>
                     </div>
                     <button type="button" class="add-remove-line" id="add-four-line-expense">Add lines</button>
                     <button type="button" class="add-remove-line" id="clear-all-line-expense">Clear all lines</button>
                  </div>
                  <!-- <div class="form-group">
                     <label for="">Memo</label>
                     <textarea name="memo" id="expenseMemo" cols="30" rows="3" placeholder="" style="width: 350px;resize: none;" ></textarea>
                     </div> -->
                  <div class="row" style="margin-top: 25px;">
                     <div class="col-md-3">
                        <div class="form-group">
                           <label for="">Your message to vendor</label>
                           <textarea name="message" id="expenseMemo" cols="30" rows="3" placeholder="" style="width: 100%;resize: none;" ></textarea>
                        </div>
                     </div>
                     <div class="col-md-3">
                        <div class="form-group">
                           <label for="">Memo</label>
                           <textarea name="memo" id="expenseMemo" cols="30" rows="3" placeholder="" style="width: 100%;resize: none;" ></textarea>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group">
                           <label for=""><i class="fa fa-paperclip"></i>&nbsp;Attachment</label>
                           <span>Maximum size: 20MB</span>
                           <div id="expenseAttachment" class="dropzone" style="border: 1px solid #e1e2e3;background: #ffffff;width: 423px;">
                              <div class="dz-message" style="margin: 20px;border">
                                 <span style="font-size: 16px;color: rgb(180,132,132);font-style: italic;">Drag and drop files here or</span>
                                 <a href="#" style="font-size: 16px;color: #0b97c4">browse to upload</a>
                              </div>
                           </div>
                        </div>
                        <div class="form-group">
                           <div class="show-existing-file">
                              <a href="#" id="showExistingFile">Show existing file</a>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- <div class="form-group">
                     <div class="show-existing-file">
                         <a href="#" id="showExistingFile">Show existing file</a>
                     </div>
                     </div> -->
                  <div class="privacy">
                     <a href="#">Privacy</a> 
                  </div>
               </div>
               <div class="modal-footer-check">
                  <div class="row">
                     <div class="col-md-5">
                        <button class="btn btn-dark cancel-button" id="closeModalExpense" type="button">Cancel</button>
                     </div>
                     <div class="col-md-2" style="text-align: center;">
                        <div>
                           <a href="#" style="color: #ffffff;">Make recurring</a>
                        </div>
                     </div>
                     <div class="col-md-5">
                        <div class="dropdown" style="float: right;display: inline-block;position: relative;">
                           <button type="button" data-dismiss="modal" id="expenseSaved" class="btn btn-success" style="border-radius: 20px 0 0 20px">Save and send</button>
                           <button class="btn btn-success" type="button" data-toggle="dropdown" style="border-radius: 0 20px 20px 0;margin-left: -5px;">
                           <span class="fa fa-caret-down"></span></button>
                           <ul class="dropdown-menu dropdown-menu-right" role="menu">
                              <li><a href="#">Save and close</a></li>
                           </ul>
                        </div>
                        <div class="" style="display: inline-block;float: right;margin-right: 10px;">
                           <button class="btn btn-transparent" data-dismiss="modal" id="expenseSaved" type="button">Save</button>
                        </div>
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
    <!-- End New Popup -->`

    <?php include viewPath('accounting/add_new_term'); ?>