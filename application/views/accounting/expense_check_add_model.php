<style>
   .input-tags {
  width: 100%;
  padding: 15px;
  display: block;
  margin: 0 auto;
}

.label-info {
  background-color: #5bc0de;
  padding: 3px;
  color: #fff;
}
</style>

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
            <form action="<?php echo base_url('accounting/addCheckModel');?>" method="post" enctype="multipart/form-data">
               <div class="modal-body" style="margin-bottom: 100px">
                  <div class="row">
                     <div class="col-md-3">
                        <label for="">Payee</label>
                        <select name="check_vendor_id" id="check_vendor_id" class="form-control" required>
                           <option value=""></option>
                           <?php foreach ($vendors as $vendor):?>
                           <option value="<?php echo $vendor->vendor_id?>"><?php echo $vendor->f_name."&nbsp;".$vendor->l_name;?> </option>
                           <?php endforeach; ?>
                        </select>
                     </div>
                     <div class="col-md-3">
                        <label for="">Bank Account</label>
                        <select name="check_bank_id" id="check_bank_id" class="form-control" required>
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
                           <div  style="font-size: 30px; font-weight: bold;">AMOUNT   $ 
                              <span id="check_total_amount">0.00</span>
                           </div>
                           <input type="hidden" name="check_total" id="check_total">
                        </div>
                     </div>
                  </div>
                  <div class="row" style="margin-top: 20px">
                     <div class="col-md-3">
                        <label for="">Mailing address</label>
                        <textarea name="check_mailing_address" id="check_mailing_address" cols="40" rows="4" placeholder="" style="resize: none;" class="form-control"></textarea>
                     </div>
                     <div class="col-md-3">
                        <label for="">Payment date</label>
                        <input type="date" name="check_payment_date" id="check_payment_date" class="form-control">
                     </div>
                     <div class="col-md-3">
                        <div class="form-group">
                           <label for="">Check no.</label>
                           <input type="text" name="check_check_num" id="check_check_num" class="form-control" value="1">
                        </div>
                        <div class="form-group">
                           <input type="checkbox" name="check_print_later" id="check_print_later" checked>
                           <label for="">Print later</label>
                        </div>
                     </div>
                     <div class="col-md-3">
                        <div class="form-group">
                           <label for="">Permit no.</label>
                           <input type="text" name="check_permit_num" id="check_permit_num" class="form-control">
                        </div>
                     </div>
                  </div>
                  <div class="row" style="margin-top: 20px">
                     <div class="col-md-7">
                        <label for="">Tags</label>
                        <input type="text" name="check_tag" id="check_tag" class="form-control input-tags" data-role="tagsinput">
                     </div>
                  </div>
                  <div class="table-container">
                     <div class="table-loader">
                        <p class="loading-text">Loading records</p>
                     </div>
                     <div class="accordion" id="accordionExample">
                        <div class="table-custom">
                           <div id="headingOne">
                              <a class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="font-size: 20px;">
                              <i class="fa fa-caret-right mr-2" aria-hidden="true"></i>Category Details
                              </a>
                           </div>
                           <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
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
                                       <td style="font-weight: bold; font-size: 20px;">
                                          $ <span id="total-amount-expense-check">0.00</span>
                                          <input type="hidden" name="expense_check_category_total" id="expense_check_category_total" value="0">
                                       </td>
                                       <td></td>
                                    </tr>
                                 </tfoot>
                              </table>
                              <div class="addAndRemoveRow">
                                 <button type="button" class="add-check-line">Add line</button>
                                 <button type="button" class="remove-check-line">Clear line</button>
                              </div>
                           </div>
                        </div>
                        <div class="table-custom">
                           <div id="headingTwo">
                              <a class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo" style="font-size: 20px;">
                              <i class="fa fa-caret-right mr-2 " aria-hidden="true"></i>Item Details
                              </a>
                           </div>
                           <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                              <table id="expensesCheckItemTable" class="table table-striped table-bordered" style="width:100%;margin-top: 20px;">
                                 <thead>
                                    <tr>
                                       <th>#</th>
                                       <th>PRODUCT/SERVICES</th>
                                       <th>DESCRIPTION</th>
                                       <th>QTY</th>
                                       <th>RATE</th>
                                       <th>AMOUNT</th>
                                       <th></th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <tr>
                                       <td>1</td>
                                       <td>
                                          <div>
                                             <select name="item[]" class="form-control expenseCheckCategory" data-id="1">
                                                <option value="">Select Product / Service</option>
                                                <?php foreach ($items as $item): ?>
                                                <option value="<?php echo $item->id?>"><?php echo $item->title;?></option>
                                                <?php endforeach;?>
                                             </select>
                                          </div>
                                       </td>
                                       <td><input type="text" name="product_description[]" class="form-control" id="productDescription1" data-id="1"></td>
                                       <td><input type="text" name="quantity[]" class="form-control ProductQuantity" id="ProductQuantity1" data-id="1"></td>
                                       <td><input type="text" name="rate[]" class="form-control productRate" id="productRate1" readonly="readonly" data-id="1"></td>
                                       <td><input type="text" name="product_amount[]" class="form-control expenseCheckItemAmount" id="productAmount1" data-id="1"></td>
                                       <td style="text-align: center"><a href="#" class="remove-check-item-row"><i class="fa fa-trash"></i></a></td>
                                    </tr>
                                    
                                 </tbody>
                                 <tfoot>
                                    <tr>
                                       <td colspan="5" style="text-align: right; font-weight: bold; font-size: 20px;">Total</td>
                                       <td style="font-weight: bold; font-size: 20px;">
                                          $ <span id="total-check-item-amount">0.00</span>
                                          <input type="hidden" name="expense_check_item_total" id="expense_check_item_total" value="0">
                                       </td>
                                       <td></td>
                                    </tr>
                                 </tfoot>
                              </table>
                              <div class="addAndRemoveRow">
                                 <button type="button" class="add-check-item-line">Add line</button>
                                 <button type="button" class="remove-check-item-line">Clear line</button>
                              </div>
                           </div>
                        </div>
                     </div>
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
                              <textarea name="checkMemo" id="checkMemo" cols="30" rows="3" placeholder="" style="width: 100%;resize: none;" class="form-control"></textarea>
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
                           <button type="submit" class="btn btn-success">Save</button>
                           <!-- <button class="btn btn-success" type="button" data-toggle="dropdown" style="border-radius: 0 20px 20px 0;margin-left: -5px;">
                           <span class="fa fa-caret-down"></span></button>
                           <ul class="dropdown-menu dropdown-menu-right" role="menu">
                              <li><button type="submit" data-dismiss="modal">Save and close</button></li>
                           </ul> -->
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
      check_item_category_total();
      check_total();
   });

   $(document).on('click', '.remove-check-line', function() {
      $('#expensesCheckTableModel tbody tr:last').remove();
      check_item_category_total();
      check_total();
   });

   $(document).on('click', '.add-check-item-line', function() {
      var rowCount = $('#expensesCheckItemTable >tbody >tr').length;
      rowCount++;
      var html = '';
      $.ajax({
         url : "<?php echo base_url('accounting/get_data');?>",
         type : "GET",
         dataType : 'json',
         success: function(data){
            var html = '<option value="">Select Product / Service</option>';
            var i;
            for(i=0; i<data.items.length; i++){
               html += '<option value='+data.items[i].id+'>'+data.items[i].title+'</option>';
            }
            var row = '<tr><td>'+rowCount+'</td><td><div><select name="item[]" class="form-control expenseCheckCategory" data-id="'+rowCount+'">'+html+'</select></div></td><td><input type="text" name="product_description[]" class="form-control" id="productDescription'+rowCount+'" data-id="'+rowCount+'"></td><td><input type="text" name="quantity[]" class="form-control ProductQuantity" id="ProductQuantity'+rowCount+'" data-id="'+rowCount+'"></td><td><input type="text" name="rate[]" class="form-control productRate" id="productRate'+rowCount+'" readonly="readonly" data-id="'+rowCount+'"></td><td><input type="text" name="product_amount[]" class="form-control expenseCheckItemAmount" id="productAmount'+rowCount+'" data-id="'+rowCount+'"></td><td style="text-align: center"><a href="#" class="remove-check-item-row"><i class="fa fa-trash"></i></a></td></tr>';
            $("#expensesCheckItemTable tbody").append(row);
         },
      });
   });

   $(document).on('click', '.remove-check-item-line', function() {
      $('#expensesCheckItemTable tbody tr:last').remove();
      check_item_total();
      check_total();
   });

   $(document).on('click', '.remove-check-item-row', function() {
      $(this).parent().parent().remove();
      check_item_total();
      check_total();
   });

   $(document).on('keyup', '.checkModelAmount', function() {
      check_item_category_total();
      check_total();
   });

   function check_item_category_total(){
      var total = 0;
      var inputs = $(".checkModelAmount");
      if(inputs.length > 0)
      {
         for(var i = 0; i < inputs.length; i++){
            if($(inputs[i]).val() != '')
            {
               total = parseFloat(total) + parseFloat($(inputs[i]).val());
            }
         
         }
         $("#total-amount-expense-check").text(total.toFixed(2));
         $("#expense_check_category_total").val(total.toFixed(2));
      }else{
         $("#total-amount-expense-check").text(total.toFixed(2));
         $("#expense_check_category_total").val(total.toFixed(2));
      }
      
   }

   function check_total() {
      var check_total = 0;
      var cat_amount = $("#expense_check_category_total").val();
      var item_amount = $("#expense_check_item_total").val();
      check_total = parseFloat(cat_amount) + parseFloat(item_amount);
      $("#check_total_amount").text(check_total.toFixed(2));
      $("#check_total").val(check_total.toFixed(2));
   }

   $(document).on('change', '.expenseCheckCategory', function() {
      var itemId = $(this).val();
      var id = $(this).attr("data-id");
      $.ajax({
         url : "<?php echo base_url('accounting/get_data_post');?>",
         type : "POST",
         dataType : 'json',
         data : {itemId : itemId},
         success: function(data){
            $("#productDescription"+id).val(data.product_detail.description);
            $("#ProductQuantity"+id).val(1);
            $("#productRate"+id).val(data.product_detail.price);
            $("#productAmount"+id).val(data.product_detail.price);
            check_item_total();
            check_total();
         },
      });
   });

   $(document).on('keyup', '.ProductQuantity', function() {
      var productAmount = 0;
      var quantity = $(this).val();
      var id = $(this).attr("data-id");
      var price = $("#productRate"+id).val();
      if(quantity != ''){
         var productAmount = parseInt(quantity) * parseFloat(price);
      }else{
         var productAmount = 0;
      }
      $("#productAmount"+id).val(productAmount.toFixed(2));
      check_item_total();
      check_total();
   });

   function check_item_total(){
      var itemtotal = 0;
      var inputs = $(".expenseCheckItemAmount");
      if(inputs.length > 0){
         for(var i = 0; i < inputs.length; i++){
            if($(inputs[i]).val() != '')
            {
               itemtotal = parseFloat(itemtotal) + parseFloat($(inputs[i]).val());
            }
         }
         $("#total-check-item-amount").text(itemtotal.toFixed(2));
         $("#expense_check_item_total").val(itemtotal.toFixed(2));
      }else{
         $("#total-check-item-amount").text(itemtotal.toFixed(2));
         $("#expense_check_item_total").val(itemtotal.toFixed(2));
      }
      
   }

});
</script>