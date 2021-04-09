<!-- Modal for add account-->
<div class="full-screen-modal">
   <div id="addrefundreceiptModal" class="modal fade modal-fluid" role="dialog">
      <div class="modal-dialog">
         <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header">
               <div class="modal-title">
                  <a href=""><i class="fa fa-history fa-lg" style="margin-right: 10px"></i></a>
                  Refund Receipt
               </div>
               <button type="button" class="close" id="closeModalExpense" data-dismiss="modal" aria-label="Close"><i class="fa fa-times fa-lg"></i></button>
            </div>
                <form action="<?php echo site_url()?>accounting/addRefundReceipt" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3">
                                    Customer
                                    <select class="form-control" name="customer_id">
                                        <option></option>
                                        <?php foreach($customers as $customer) : ?>
                                            <option value="<?php echo $customer->prof_id; ?>"><?php echo $customer->first_name . ' ' . $customer->last_name; ?></option>
                                            <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    Email
                                    <input type="email" class="form-control" name="email">
                                    <a href="#" style="text-align:right;color:blue;"><i> Cc/Bcc </i></a>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    Billing address
                                    <textarea style="height:100px;width:100%;" name="billing_address"></textarea>
                                </div>
                                <div class="col-md-3">
                                    Refund Receipt date<br>
                                    <input type="text" class="form-control" name="receipt_date" id="datepickerinv10">
                                </div>                                
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    Tags <a href="#" style="float:right;color:blue;">Manage tags</a>
                                    <input type="text" class="form-control" name="tags">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    Payment method
                                    <select class="form-control" name="payment_method"  id="rr_payment_method">
                                        <option></option>
                                        <option value="0">Add New</option>
                                        <?php foreach($paymethods as $paymethod) { ?>
                                            <option value="<?php echo $paymethod->payment_method_id ; ?>"> <?php echo $paymethod->quick_name; ?></option>
                                            <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    Refund From
                                    <select class="form-control" name="refund_form">
                                        <option></option>
                                        <option value="1">A</option>
                                        <option value="2">B</option>
                                        <option value="3">C</option>
                                    </select>
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-md-6" align="right">
                            AMOUNT<h2><input type="text" class="form-control" style="font-size:36px;border: 0px;background: transparent;text-align:right;" name="total_amount" value="0.00" readonly></h2><br>
                            Location of sale<br>
                            <input type="text" class="form-control" style="width:200px;" name="location_scale">
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                        <table class="table table-bordered" id="reportstable">
                                <thead>
                                    <!-- <th></th>
                                    <th>#</th>
                                    <th>PRODUCT/SERVICE</th>
                                    <th>DESCRIPTION</th>
                                    <th>QTY</th>
                                    <th>RATE</th>
                                    <th>AMOUNT</th>
                                    <th>TAX</th>
                                    <th></th> -->
                                    <th>Name</th>
                                            <th>Type</th>
                                            <!-- <th>Description</th> -->
                                            <th width="150px">Quantity</th>
                                            <!-- <th>Location</th> -->
                                            <th width="150px">Price</th>
                                            <th width="150px">Discount</th>
                                            <th width="150px">Tax (Change in %)</th>
                                            <th>Total</th>
                                </thead>
                                <tbody id="items_table_body3a">
                                <tr>
                                            <td>
                                                <input type="text" class="form-control getItems"
                                                       onKeyup="getItems(this)" name="items[]">
                                                <ul class="suggestions"></ul>
                                            </td>
                                            <td><select name="item_type[]" class="form-control">
                                                    <option value="product">Product</option>
                                                    <option value="material">Material</option>
                                                    <option value="service">Service</option>
                                                    <option value="fee">Fee</option>
                                                </select></td>
                                            <td width="150px"><input type="number" class="form-control quantity" name="quantity[]"
                                                       data-counter="0" id="quantity_0" value="1"></td>
                                            <td width="150px"><input type="number" class="form-control price" name="price[]"
                                                       data-counter="0" id="price_0" min="0" value="0"></td>
                                            <td width="150px"><input type="number" class="form-control discount" name="discount[]"
                                                       data-counter="0" id="discount_0" min="0" value="0" ></td>
                                            <td width="150px"><input type="text" class="form-control tax_change" name="tax[]"
                                                       data-counter="0" id="tax1_0" min="0" value="0">
                                                       <!-- <span id="span_tax_0">0.0</span> -->
                                                       </td>
                                            <td width="150px"><input type="hidden" class="form-control " name="total[]"
                                                       data-counter="0" id="item_total_0" min="0" value="0">
                                                       $<span id="span_total_0">0.00</span></td>
                                        </tr>
                                </tr>
                                </tbody>
                            </table>
                        <div>
                    </div>
                    <hr>
                
                    <div class="row">
                        <div class="col-md-1">
                           <!-- <button class="btn1">Add lines</button> -->
                           <a class="link-modal-open" href="#" id="add_another_items" data-toggle="modal" data-target="#item_list3"><span class="fa fa-plus-square fa-margin-right"></span>Add Items</a>
                        </div>
                        <!-- <div class="col-md-1">
                           <button class="btn1">Clear all lines</button>
                        </div>
                        <div class="col-md-1">
                        </div>
                        <div class="col-md-7">
                        </div>
                        <div class="col-md-1">
                            <b>Subtotal</b>
                        </div>
                        <div class="col-md-1">
                            <b>$0.00</b>
                        </div> -->
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-md-2">
                            Message displayed on refund receipt<br>
                            <textarea style="height:100px;width:100%;" name="message_refund"></textarea><br>
                            Message displayed on statement<br>
                            <textarea style="height:100px;width:100%;" name="mess_statement"></textarea>
                        </div>
                        <div class="col-md-7">
                        </div>
                        <div class="col-md-3">
                            <!-- Taxable subtotal <b>$0.00</b><br>
                            <table class="table table-borderless" style="text-align:right;">
                                <tr>
                                    <td colspan="2">
                                        <select class="form-control" name="tax_rate">
                                            <option value="1">Based on location</option>
                                            <option readonly>CUSTOMER RATES</option>
                                            <option value="2">+ Add rate</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><b>$0.00</b><br><a href="">See the math</a></td>
                                </tr>
                                <tr>
                                    <td>Shipping</td>
                                    <td align="right"><input type="text" name="shipping" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td>Tax on shipping</td>
                                    <td>0.00</td>
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td>$0.00</td>
                                </tr>
                                <tr>
                                    <td>Balance due</td>
                                    <td>$0.00</td>
                                </tr>
                            </table> -->
                            <table class="table" style="text-align:left;">
                                        <tr>
                                            <td>Subtotal</td>
                                            <td></td>
                                            <td>$ <span id="span_sub_total_invoice">0.00</span>
                                                <input type="hidden" name="subtotal" id="item_total"></td>
                                        </tr>
                                        <tr>
                                            <td>Taxes</td>
                                            <td></td>
                                            <td>$ <span id="total_tax_">0.00</span><input type="hidden" name="taxes" id="total_tax_input"></td>
                                        </tr>
                                        <tr>
                                            <td style="width:250px;"><input type="text" name="adjustment_name" id="adjustment_name" placeholder="Adjustment Name" class="form-control" style="width:200px; display:inline; border: 1px dashed #d1d1d1"></td>
                                            <td style="width:150px;">
                                            <input type="number" name="adjustment_value" id="adjustment_input" value="0" class="form-control adjustment_input" style="width:100px; display:inline-block">
                                                <span class="fa fa-question-circle" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="Optional it allows you to adjust the total amount Eg. +10 or -10." data-original-title="" title=""></span>
                                            </td>
                                            <td>0.00</td>
                                        </tr>
                                        <!-- <tr>
                                            <td>Markup $<span id="span_markup"></td> -->
                                            <!-- <td><a href="#" data-toggle="modal" data-target="#modalSetMarkup" style="color:#02A32C;">set markup</a></td> -->
                                            <input type="hidden" name="markup_input_form" id="markup_input_form" class="markup_input" value="0">
                                        <!-- </tr> -->
                                        <tr id="saved" style="color:green;font-weight:bold;display:none;">
                                            <td>Amount Saved</td>
                                            <td></td>
                                            <td><span id="offer_cost">0.00</span><input type="hidden" name="voucher_value" id="offer_cost_input"></td>
                                        </tr>
                                        <tr style="color:blue;font-weight:bold;font-size:18px;">
                                            <td><b>Grand Total ($)</b></td>
                                            <td></td>
                                            <td><b><span id="grand_total">0.00</span>
                                                <input type="hidden" name="grand_total" id="grand_total_input" value='0'></b></td>
                                        </tr>
                            </table>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="file-upload">
                                <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Attachments</button>

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

<!-- Modal -->
<div class="modal fade" id="item_list3" tabindex="-1" role="dialog" aria-labelledby="newcustomerLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document" style="width:800px;position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="newcustomerLabel">Item Lists</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table id="items_table_estimate" class="table table-hover" style="width: 100%;">
                                        <thead>
                                        <tr>
                                            <td> Name</td>
                                            <td> Qty</td>
                                            <td> Price</td>
                                            <td> Action</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($items as $item){ // print_r($item); ?>
                                            <tr>
                                                <td><?php echo $item->title; ?></td>
                                                <td></td>
                                                <td><?php echo $item->price; ?></td>
                                                <td><button id="<?= $item->id; ?>" data-quantity="<?= $item->units; ?>" data-itemname="<?= $item->title; ?>" data-price="<?= $item->price; ?>" type="button" data-dismiss="modal" class="btn btn-sm btn-default select_item3">
                                                <span class="fa fa-plus"></span>
                                            </button></td>
                                            </tr>
                                            
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer modal-footer-detail">
                            <div class="button-modal-list">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><span class="fa fa-remove"></span> Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<script>
  function totalfunc(){
    var inputs = document.getElementsByName('amount[]');
    // alert(inputs);
    var sum = 0;
    for(var i = 0; i<inputs.length; i++){
      sum += parseInt(inputs[i].value);
    }
    document.getElementById('total_amount').value = sum;

  }
</script>

<?php include viewPath('accounting/add_new_payment_method'); ?>