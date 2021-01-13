<div class="full-screen-modal">
   <div id="expense-modal-popup" class="modal fade modal-fluid" role="dialog">
      <div class="modal-dialog">
         <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header">
               <div class="modal-title">
                  <a href=""><i class="fa fa-history fa-lg" style="margin-right: 10px"></i></a>
                  Expense
               </div>
               <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
            </div>
            <form action="<?php echo base_url('accounting/addExpenseModel'); ?>" method="post" enctype="multipart/form-data">
               <div class="modal-body" style="margin-bottom: 50px">
                  <div class="row">
                     <div class="col-md-3">
                        <label for="">Payee</label>
                        <select name="vendor_id" class="form-control" required>
                           <option value=""></option>
                           
                           <?php foreach ($vendors as $vendor):?>
                           <option value="<?php echo $vendor->vendor_id?>"><?php echo $vendor->f_name."&nbsp;".$vendor->l_name;?> </option>
                           <?php endforeach; ?>
                        </select>
                     </div>
                     <div class="col-md-3">
                        <label for="">Payment account <i class="fa fa-question-circle"></i></label>
                        <select name="payment_account" class="form-control" required>
                           <option value=""></option>
                           <option value="1">Cash on hand:Cash on hand</option>
                           <option value="2">Corporate Account (XXXXXX 5850)</option>
                           <option value="3">Investment Asset</option>
                           <option value="4">Payroll Refunds</option>
                           <option value="5">Uncategorized Asset</option>
                           <option value="6">Undeposited Funds</option>
                           <option value="7">Cash on hand</option>
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
                              <h1>$0.00</h1>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row" style="margin-top: 20px;">
                     <div class="col-md-3">
                        <label for="">Payment date</label>
                        <input type="date" name="payment_date" class="form-control" required>
                     </div>
                     <div class="col-md-3">
                        <label for="">Payment method</label>
                        <select name="payment_method" class="form-control select2-method" required>
                           <option value=""></option>
                           <option>Cash</option>
                           <option>Check</option>
                           <option>Credit Card</option>
                        </select>
                     </div>
                     <div class="col-md-3">
                        <div class="form-group">
                           <label for="">Ref no.</label>
                           <input type="text" name="referance_num" class="form-control" required>
                        </div>
                     </div>
                     <div class="col-md-3">
                        <div class="form-group">
                           <label for="">Permit no.</label>
                           <input type="text" name="per_num" class="form-control" required>
                        </div>
                     </div>
                  </div>
                  <div class="table-container">
                     <div class="table-loader">
                        <p class="loading-text">Loading records</p>
                     </div>
                     <!--                        DataTables-->
                     <table id="expensesTable" class="table table-striped table-bordered" style="width:100%;margin-top: 20px;">
                        <thead>
                           <tr>
                              
                              <th>#</th>
                              <th>CATEGORY</th>
                              <th>DESCRIPTION</th>
                              <th>AMOUNT</th>
                              <th></th>
                           </tr>
                        </thead>
                        <tbody id="line-container-expense">
                           <tr>
                              <td><span id="line-counter-expense">1</span></td>
                              <td>
                                 <div>
                                    <select name="category[]" class="form-control expenseCategory select2-expense-category">
                                       <option value="">Select Category</option>
                                       <?php foreach ($list_categories as $list): ?>
                                       <option value="<?php echo $list->id?>"><?php echo $list->category_name;?></option>
                                       <?php endforeach;?>
                                    </select>
                                 </div>
                              </td>
                              <td><input type="text" name="description[]" class="form-control expenseDescription"></td>
                              <td><input type="text" name="amount[]" class="form-control expenseAmount"  value="0"></td>
                              <td style="text-align: center"><a href="#" class="remove-row"><i class="fa fa-trash"></i></a></td>
                           </tr>
                           <tr>
                              <td><span id="line-counter-expense">2</span></td>
                              <td>
                                 <div>
                                    <select name="category[]" id="" class="form-control expenseCategory select2-expense-category">
                                       <option value="">Select Category</option>
                                       <?php foreach ($list_categories as $list): ?>
                                       <option value="<?php echo $list->id?>"><?php echo $list->category_name;?></option>
                                       <?php endforeach;?>
                                    </select>
                                 </div>
                              </td>
                              <td><input type="text" name="description[]" class="form-control expenseDescription" id=""></td>
                              <td><input type="text" name="amount[]" class="form-control expenseAmount"  value="0"></td>
                              <td style="text-align: center"><a href="#" class="remove-row"><i class="fa fa-trash"></i></a></td>
                           </tr>
                        </tbody>
                        <tfoot>
                           <tr>
                              <td colspan="3" style="text-align: right; font-weight: bold; font-size: 25px;">Total</td>
                              <td style="font-weight: bold; font-size: 25px;">
                                 $ <span id="total-amount-expense">0.00</span>
                                 <input type="hidden" name="expense_total" id="expense_total" value="0">
                              </td>
                              <td></td>
                           </tr>
                        </tfoot>
                     </table>
                  </div>
                  <div class="addAndRemoveRow">
                     
                     <button type="button" class="add-line">Add line</button>
                     <button type="button" class="remove-line">Clear line</button>
                  </div>
                  <!-- <div class="addAndRemoveRow">
                     <div class="total-amount-container">
                        <span style="margin-right: 200px;font-size: 17px">Total</span>
                        $<span id="total-amount-expense">0.00</span>
                        <input type="hidden" name="expense_total" id="expense_total" value="0">
                     </div>
                     
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
                        <!-- <div class="col-md-8" style="padding-top: 30px;">
                           <div class="file-container-list" id="file-list-expense"></div>
                        </div>
                        <div class="form-group">
                           <div class="show-existing-file">
                              <a href="#" id="showExistingFile">Show existing file</a>
                           </div>
                        </div> -->
                     </div>
                  </div>
                  <div class="privacy">
                     <a href="#">Privacy</a> 
                  </div>
               </div>
               <div class="modal-footer-check">
                  <div class="row">
                     <div class="col-md-5">
                        <button class="btn btn-dark cancel-button" data-dismiss="modal" type="button">Cancel</button>
                     </div>
                     <div class="col-md-2" style="text-align: center;">
                        <div>
                           <a href="#" style="color: #ffffff;">Make recurring</a>
                        </div>
                     </div>
                     <div class="col-md-5">
                        <!-- <div class="dropdown" style="float: right;display: inline-block;position: relative;">
                           <button type="button" data-dismiss="modal" id="expenseSaved" class="btn btn-success" style="border-radius: 20px 0 0 20px">Save and new</button>
                           <button class="btn btn-success" type="button" data-toggle="dropdown" style="border-radius: 0 20px 20px 0;margin-left: -5px;">
                           <span class="fa fa-caret-down"></span></button>
                           <ul class="dropdown-menu dropdown-menu-right" role="menu">
                              <li><a href="#">Save and close</a></li>
                           </ul>
                        </div> -->
                        
                        <div class="" style="display: inline-block;float: right;margin-right: 10px;">
                           <button class="btn btn-success" type="submit">Save</button>
                        </div>
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script> 
$(document).ready(function(){
   
   $(document).on('click', '.add-line', function() {
      var rowCount = $('#expensesTable >tbody >tr').length;
      rowCount++;
      $.ajax({
         url : "<?php echo base_url('accounting/get_data');?>",
         type : "GET",
         dataType : 'json',
         success: function(data){
            var html = '<option value="">Select Category</option>';
            var i;
            for(i=0; i<data.list_categories.length; i++){
               html += '<option value='+data.list_categories[i].id+'>'+data.list_categories[i].category_name+'</option>';
            }
            var row = '<tr><td><span id="line-counter-expense">'+rowCount+'</span></td><td><div><select name="category[]" class="form-control expenseCategory select2-expense-category">'+html+'</select></div></td><td><input type="text" name="description[]" class="form-control expenseDescription"></td><td><input type="text" name="amount[]" class="form-control expenseAmount" value="0"></td><td style="text-align: center"><a href="#" class="remove-row"><i class="fa fa-trash"></i></a></td></tr>';
            $("#expensesTable tbody").append(row);
         },
         
      });
   });
   $(document).on('click', '.remove-row', function() {
      $(this).parent().parent().remove();
      category_amount_total();
   });
   
   $(document).on('click', '.remove-line', function() {
      $('#expensesTable tbody tr:last').remove();
      category_amount_total();
   });

   $(document).on('keyup', '.expenseAmount', function() {
      category_amount_total();
   });

   function category_amount_total(){
      var total = 0;
      var inputs = $(".expenseAmount");
      
      for(var i = 0; i < inputs.length; i++){
         if($(inputs[i]).val() != '')
         {
            total = parseFloat(total) + parseFloat($(inputs[i]).val());
         }
         $("#total-amount-expense").text(total.toFixed(2));
         $("#expense_total").val(total.toFixed(2));
      }
   }
});        
</script> 