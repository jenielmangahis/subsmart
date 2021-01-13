<!--    Add Checks Modal-->
<div class="full-screen-modal">
   <div id="expensesCheck-popup" class="modal fade modal-fluid" role="dialog">
      <div class="modal-dialog">
         <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header">
               <div class="modal-title">
                  <a href="#"><i class="fa fa-history fa-lg" style="margin-right: 10px"></i></a>
                  Check 
               </div>
               <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
            </div>
            <form action="" method="post">
               <div class="modal-body" style="margin-bottom: 100px">
                  <div class="row">
                     <div class="col-md-3">
                        <label for="">Payee</label>
                        <select name="vendor_id" id="vendor_id" class="form-control" required>
                           <option value=""></option>
                           <?php foreach ($vendors as $vendor):?>
                           <option value="<?php echo $vendor->vendor_id?>"><?php echo $vendor->f_name."&nbsp;".$vendor->l_name;?> </option>
                           <?php endforeach; ?>
                        </select>
                     </div>
                     <div class="col-md-3">
                        <label for="">Bank Account</label>
                        <select name="bank_id" id="bank_account" class="form-control" required>
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
                        <span>$113,101.00</span>
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
                  <div class="row" style="margin-top: 20px">
                     <div class="col-md-3">
                        <label for="">Mailing address</label>
                        <textarea name="mailing_address" id="mailing_address" cols="40" rows="4" placeholder="" style="resize: none;"></textarea>
                     </div>
                     <div class="col-md-3">
                        <label for="">Payment date</label>
                        <input type="date" name="payment_date" id="payment_date" class="form-control">
                     </div>
                     <div class="col-md-3">
                        <div class="form-group">
                           <label for="">Check no.</label>
                           <input type="text" name="check_num" id="check_num" class="form-control" value="1">
                        </div>
                        <div class="form-group">
                           <input type="checkbox" name="print_later" id="print_later" checked>
                           <label for="">Print later</label>
                        </div>
                     </div>
                     <div class="col-md-3">
                        <div class="form-group">
                           <label for="">Permit no.</label>
                           <input type="text" name="permit_num" id="permit_number" class="form-control">
                        </div>
                     </div>
                  </div>
                  <div class="row" style="margin-top: 20px">
                     <div class="col-md-7">
                        <label for="">Tags</label>
                        <input type="text" name="tag" id="tag" class="form-control" data-role="tagsinput">
                     </div>
                  </div>
                  <div class="table-container">
                     <div class="table-loader">
                        <p class="loading-text">Loading records</p>
                     </div>
                     <!--                        DataTables-->
                     <table id="expensesCheckTableModel" class="table table-striped table-bordered" style="width:100%;margin-top: 20px;">
                        <thead>
                           <tr>
                              <th>#</th>
                              <th>CATEGORY</th>
                              <th>DESCRIPTION</th>
                              <th>AMOUNT</th>
                              <th></th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td>1</td>
                              <td>
                                 <div>
                                    <select name="check_category[]" id="" class="form-control checkCategory select2-check-category">
                                       <option value="">Select Category</option>
                                       <?php foreach ($list_categories as $list): ?>
                                       <option value="<?php echo $list->id?>"><?php echo $list->category_name;?></option>
                                       <?php endforeach;?>
                                    </select>
                                 </div>
                              </td>
                              <td><input type="text" name="check_description[]" class="form-control checkDescription"></td>
                              <td><input type="text" name="check_amount[]" class="form-control checkModelAmount" value="0"></td>
                              <td style="text-align: center"><a href="#" class="remove-check-row"><i class="fa fa-trash"></i></a></td>
                           </tr>
                           <tr>
                              <td>2</td>
                              <td>
                                 <div>
                                    <select name="check_category[]" id="" class="form-control checkCategory select2-check-category">
                                       <option value="">Select Category</option>
                                       <?php foreach ($list_categories as $list): ?>
                                       <option value="<?php echo $list->id?>"><?php echo $list->category_name;?></option>
                                       <?php endforeach;?>
                                    </select>
                                 </div>
                              </td>
                              <td><input type="text" name="check_description[]" class="form-control checkDescription"></td>
                              <td><input type="text" name="check_amount[]" class="form-control checkModelAmount" value="0"></td>
                              <td style="text-align: center"><a href="#" class="remove-check-row"><i class="fa fa-trash"></i></a></td>
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
                     <button type="button" class="add-check-line">Add line</button>
                     <button type="button" class="remove-check-line">Clear line</button>
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
                           <!-- <div class="col-md-8" style="padding-top: 30px;">
                              <div class="file-container-list" id="file-list-check"></div>
                           </div>
                           <div class="form-group">
                              <div class="show-existing-file">
                                 <a href="#" id="showExistingFile">Show existing file</a>
                              </div>
                           </div> -->
                        </div>
                     </div>
                  </div>
                  
                  <div class="privacy">
                     <a href="#">Privacy</a>
                  </div>
               </div>
               <div class="modal-footer-check">
                  <div class="row">
                     <div class="col-md-4">
                        <button class="btn btn-dark cancel-button" data-dismiss="modal" type="button">Cancel</button>
                        <!-- <button class="btn btn-dark cancel-button" type="reset">Revert</button> -->
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
                           <button type="button" class="btn btn-success" data-dismiss="modal" style="border-radius: 20px 0 0 20px">Save and new</button>
                           <button class="btn btn-success" type="button" data-toggle="dropdown" style="border-radius: 0 20px 20px 0;margin-left: -5px;">
                           <span class="fa fa-caret-down"></span></button>
                           <ul class="dropdown-menu dropdown-menu-right" role="menu">
                              <li><a href="#" data-dismiss="modal">Save and close</a></li>
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
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
<script> 
$(document).ready(function(){
   
   $(document).on('click', '.add-check-line', function() {
      var rowCount = $('#expensesCheckTableModel >tbody >tr').length;
      console.log(rowCount);
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
            var row = '<tr><td>'+rowCount+'</td><td><div><select name="check_category[]" class="form-control checkCategory">'+html+'</select></div></td><td><input type="text" name="check_description[]" class="form-control checkDescription"></td><td><input type="text" name="check_amount[]" class="form-control checkModelAmount" value="0"></td><td style="text-align: center"><a href="#" class="remove-check-row"><i class="fa fa-trash"></i></a></td></tr>';
            $("#expensesCheckTableModel tbody").append(row);
         },
         
      });
   });

   $(document).on('click', '.remove-check-row', function() {
      $(this).parent().parent().remove();
      //category_amount_total();
   });

   $(document).on('click', '.remove-check-line', function() {
      $('#expensesCheckTableModel tbody tr:last').remove();
      //category_amount_total();
   });
});
</script>