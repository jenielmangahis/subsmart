<!-- Modal for add account-->
<div class="full-screen-modal">
   <div id="adddelayedchargeModal" class="modal fade modal-fluid" role="dialog">
      <div class="modal-dialog">
         <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header">
               <div class="modal-title">
                  <a href=""><i class="fa fa-history fa-lg" style="margin-right: 10px"></i></a>
                  Delayed Charge
               </div>
               <button type="button" class="close" id="closeModalExpense" data-dismiss="modal" aria-label="Close"><i class="fa fa-times fa-lg"></i></button>
            </div>
                <form action="<?php echo site_url()?>accounting/addDelayedCharge" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3">
                                    Customer
                                    <select id="sel-customer" name="customer_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                        <option value="0">- none -</option>
                                        <?php foreach($customers as $c){ ?>
                                            <option value="<?= $c->prof_id; ?>"><?= $c->first_name . ' ' . $c->last_name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    Delayed Credit date<br>
                                    <input type="text" class="form-control" name="charge_date" id="datepickerinv12">
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
                            AMOUNT<h2><input type="text" class="form-control" style="font-size:36px;border: 0px;background: transparent;text-align:right;" name="total_amount" value="0.00" readonly></h2>
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
                                <tbody id="items_table_body">
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
                           <a class="link-modal-open" href="#" id="add_another_items" data-toggle="modal" data-target="#item_list_delayed_charge"><span class="fa fa-plus-square fa-margin-right"></span>Add Items</a>
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
                            <b><input type="text" class="form-control" style="font-size:36px;border: 0px;background: transparent;text-align:right;" name="sub_total" value="0.00" readonly></b>
                        </div> -->
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-md-2">
                            Memo<br>
                            <textarea style="height:100px;width:100%;" name="memo"></textarea><br>
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
</div>

<!-- Modal -->
<div class="modal fade" id="item_list_delayed_charge" tabindex="-1" role="dialog" aria-labelledby="newcustomerLabel" aria-hidden="true">
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
                                    <table id="items_table_delayed_charge" class="table table-hover" style="width: 100%;">
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
                                                <td><button id="<?= $item->id; ?>" data-quantity="<?= $item->units; ?>" data-itemname="<?= $item->title; ?>" data-price="<?= $item->price; ?>" type="button" data-dismiss="modal" class="btn btn-sm btn-default select_item2">
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
    function validatecard() {
        var inputtxt = $('.card-number').val();

        if (inputtxt == 4242424242424242) {
            $('.require-validation').submit();
        } else {
            alert("Not a valid card number!");
            return false;
        }
    }


    $(document).ready(function () {
        $('#sel-customer').select2();
        var customer_id = "<?php echo isset($_GET['customer_id']) ? $_GET['customer_id'] : '' ?>";

        /*$('#customers')
            .empty() //empty select
            .append($("<option/>") //add option tag in select
                .val(customer_id) //set value for option to post it
                .text("<?php echo get_customer_by_id($_GET['customer_id'])->contact_name ?>")) //set a text for show in select
            .val(customer_id) //select option of select2
            .trigger("change"); //apply to select2*/
    });
</script>

<script>

$(".select_item2").click(function () {
            $("#addcreditmemoModal").modal('show')
            var idd = this.id;
            console.log(idd);
            console.log($(this).data('itemname'));
            var title = $(this).data('itemname');
            var price = $(this).data('price');
            
            $("#item_list").modal('hide')

            if(!$(this).data('quantity')){
              // alert($(this).data('quantity'));
              var qty = 0;
            }else{
              // alert('0');
              var qty = $(this).data('quantity');
            }

            var count = parseInt($("#count").val()) + 1;
            $("#count").val(count);
            var total_ = price * qty;
            var total = parseFloat(total_).toFixed(2);
            var withCommas = Number(total).toLocaleString('en');
            total = '$' + withCommas + '.00';
            // console.log(total);
            // alert(total);
            markup = "<tr id=\"ss\">" +
                "<td width=\"35%\"><input value='"+title+"' type=\"text\" name=\"items[]\" class=\"form-control\" ><input type=\"hidden\" value='"+idd+"' name=\"item_id[]\"></td>\n" +
                "<td width=\"20%\"><select name=\"item_type[]\" class=\"form-control\"><option value=\"product\">Product</option><option value=\"material\">Material</option><option value=\"service\">Service</option><option value=\"fee\">Fee</option></select></td>\n" +
                "<td width=\"10%\"><input data-itemid='"+idd+"' id='quantity_"+idd+"' value='"+qty+"' type=\"number\" name=\"quantity[]\" data-counter=\"0\"  min=\"0\" class=\"form-control qtyest\"></td>\n" +
                // "<td>\n" + '<input type="number" class="form-control qtyest" name="quantity[]" data-counter="' + count + '" id="quantity_' + count + '" min="1" value="1">\n' + "</td>\n" +
                "<td width=\"10%\"><input id='price_"+idd+"' value='"+price+"'  type=\"number\" name=\"price[]\" class=\"form-control\" placeholder=\"Unit Price\"></td>\n" +
                // "<td width=\"10%\"><input type=\"number\" class=\"form-control discount\" name=\"discount[]\" data-counter="0" id=\"discount_0\" min="0" value="0" ></td>\n" +
                // "<td width=\"10%\"><small>Unit Cost</small><input type=\"text\" name=\"item_cost[]\" class=\"form-control\"></td>\n" +
                "<td width=\"10%\"><input type=\"number\" name=\"discount[]\" class=\"form-control discount\" id='discount_"+idd+"' readonly></td>\n" +
                // "<td width=\"25%\"><small>Inventory Location</small><input type=\"text\" name=\"item_loc[]\" class=\"form-control\"></td>\n" +
                "<td width=\"20%\"><input type=\"text\" data-itemid='"+idd+"' class=\"form-control tax_change2\" name=\"tax[]\" data-counter=\"0\" id='tax1_"+idd+"' min=\"0\" value=\"0\"></td>\n" +
                "<td style=\"text-align: center\" class=\"d-flex\" width=\"15%\"><span data-subtotal='"+total_+"' id='span_total_"+idd+"' class=\"total_per_item\">"+total+
                // "</span><a href=\"javascript:void(0)\" class=\"remove_item_row\"><i class=\"fa fa-times-circle\" aria-hidden=\"true\"></i></a>"+
                "<input type=\"hidden\" name=\"total[]\" id='sub_total_text"+idd+"' value='"+total+"'></td>" +
                "</tr>";
            tableBody = $("#items_table_body");
            tableBody.append(markup);
            markup2 = "<tr id=\"sss\">" +
                "<td >"+title+"</td>\n" +
                "<td ></td>\n" +
                "<td ></td>\n" +
                "<td >"+price+"</td>\n" +
                "<td ></td>\n" +
                "<td >"+qty+"</td>\n" +
                "<td ></td>\n" +
                "<td ></td>\n" +
                "<td >0</td>\n" +
                "<td ></td>\n" +
                "<td ><a href=\"#\" data-name='"+title+"' data-price='"+price+"' data-quantity='"+qty+"' id='"+idd+"' class=\"edit_item_list\"><span class=\"fa fa-edit\"></span></i></a> <a href=\"javascript:void(0)\" class=\"remove_audit_item_row\"><span class=\"fa fa-trash\"></span></i></a></td>\n" +
                "</tr>";
            tableBody2 = $("#device_audit_datas");
            tableBody2.append(markup2);
            // calculate_subtotal();
            // var counter = $(this).data("counter");
            // calculation(idd);

  var in_id = idd;
  var price = $("#price_" + in_id).val();
  var quantity = $("#quantity_" + in_id).val();
  var discount = $("#discount_" + in_id).val();
  var tax = (parseFloat(price) * 7.5) / 100;
  var tax1 = (((parseFloat(price) * 7.5) / 100) * parseFloat(quantity)).toFixed(
    2
  );
  if( discount == '' ){
    discount = 0;
  }
  
  var total = (
    (parseFloat(price) + parseFloat(tax)) * parseFloat(quantity) -
    parseFloat(discount)
  ).toFixed(2);

  // alert( 'yeah' + total);

  $("#span_total_" + in_id).text(total);
  $("#tax_1_" + in_id).text(tax1);
  $("#tax1_" + in_id).val(tax1);
  $("#discount_" + in_id).val(discount);

  if( $('#tax_1_'+ in_id).length ){
    $('#tax_1_'+in_id).val(tax1);
  }

  if( $('#item_total_'+ in_id).length ){
    $('#item_total_'+in_id).val(total);
  }

  var eqpt_cost = 0;
  var cnt = $("#count").val();
  var total_discount = 0;
  for (var p = 0; p <= cnt; p++) {
    var prc = $("#price_" + p).val();
    var quantity = $("#quantity_" + p).val();
    var discount = $("#discount_" + p).val();
    // var discount= $('#discount_' + p).val();
    // eqpt_cost += parseFloat(prc) - parseFloat(discount);
    eqpt_cost += parseFloat(prc) * parseFloat(quantity);
    total_discount += parseFloat(discount);
  }
//   var subtotal = 0;
// $( total ).each( function(){
//   subtotal += parseFloat( $( this ).val() ) || 0;
// });

  eqpt_cost = parseFloat(eqpt_cost).toFixed(2);
  total_discount = parseFloat(total_discount).toFixed(2);
  // var test = 5;

  var subtotal = 0;
  // $("#span_total_0").each(function(){
    $('*[id^="span_total_"]').each(function(){
    subtotal += parseFloat($(this).text());
  });
  // $('#sum').text(subtotal);

  var subtotaltax = 0;
  // $("#span_total_0").each(function(){
    $('*[id^="tax_1_"]').each(function(){
      subtotaltax += parseFloat($(this).text());
  });

  // alert(subtotaltax);

  $("#eqpt_cost").val(eqpt_cost);
  $("#total_discount").val(total_discount);
  $("#span_sub_total_0").text(total_discount);
  $("#span_sub_total_invoice").text(subtotal.toFixed(2));
  $("#item_total").val(subtotal.toFixed(2));
  
  var s_total = subtotal.toFixed(2);
  var adjustment = $("#adjustment_input").val();
  var grand_total = s_total - parseFloat(adjustment);
  var markup = $("#markup_input_form").val();
  var grand_total_w = grand_total + parseFloat(markup);

  $("#total_tax_").text(subtotaltax.toFixed(2));
  $("#total_tax_").val(subtotaltax.toFixed(2));
  

  $("#grand_total").text(grand_total_w.toFixed(2));
  $("#grand_total_input").val(grand_total_w.toFixed(2));

  var sls = (parseFloat(eqpt_cost).toFixed(2) * 7.5) / 100;
  sls = parseFloat(sls).toFixed(2);
  $("#sales_tax").val(sls);
  cal_total_due();
        });
</script>