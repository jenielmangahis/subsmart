
var price = $("#price2_" + counter).val();
  var quantity = $("#quantity2_" + counter).val();
  var discount = $("#discount2_" + counter).val();
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

  $("#span_total2_" + counter).text(total);
  $("#tax2_" + counter).text(tax1);
  $("#discount2_" + counter).val(discount);

  if( $('#tax2_'+ counter).length ){
    $('#tax2_'+counter).val(tax1);
  }

  if( $('#item_total2_'+ counter).length ){
    $('#item_total2_'+counter).val(total);
  }

  var eqpt_cost = 0;
  var cnt = $("#count2").val();
  var total_discount = 0;
  for (var p = 0; p <= cnt; p++) {
    var prc = $("#price2_" + p).val();
    var quantity = $("#quantity2_" + p).val();
    var discount = $("#discount2_" + p).val();
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
    $('*[id^="span_total2_"]').each(function(){
    subtotal += parseFloat($(this).text());
  });
  // $('#sum').text(subtotal);

  var subtotaltaxx = 0;
  // $("#span_total_0").each(function(){
    $('*[id^="tax2_0"]').each(function(){
      subtotaltaxx += parseFloat($(this).val());
  });

  // alert(subtotaltaxx);

  // alert('dri');

  $("#eqpt_cost").val(eqpt_cost);
  $("#total_discount").val(total_discount);
  $("#span_sub_total_0").text(total_discount);
  $("#span_sub_total_invoice2").text(subtotal.toFixed(2));
  $("#item_total2").val(subtotal.toFixed(2));
  
  var s_total = subtotal.toFixed(2);
  var adjustment = $("#adjustment_input").val();
  var grand_total = s_total - parseFloat(adjustment);
  var markup = $("#markup_input_form").val();
  var grand_total_w = grand_total + parseFloat(markup);

  $("#total_tax2_").text(subtotaltaxx.toFixed(2));
  $("#total_tax2_input").val(subtotaltaxx.toFixed(2));
  

  $("#grand_total2").text(grand_total_w.toFixed(2));
  $("#grand_total_input2").val(grand_total_w.toFixed(2));
  $("#grandtotal_input").val(grand_total_w.toFixed(2));

  if($("#grand_total").length && $("#grand_total").val().length)
  {
    // console.log('none');
    // alert('none');
  }else{
    $("#grand_total").text(grand_total_w.toFixed(2));
    $("#grand_total_input").val(grand_total_w.toFixed(2));
    $("#grand_total_inputs").val(grand_total_w.toFixed(2));

    var bundle1_total = $("#grand_total").text();
    var bundle2_total = $("#grand_total2").text();
    var super_grand = parseFloat(bundle1_total) + parseFloat(bundle2_total);
  }

  var sls = (parseFloat(eqpt_cost).toFixed(2) * 7.5) / 100;
  sls = parseFloat(sls).toFixed(2);
  $("#sales_tax").val(sls);
  cal_total_due();

//   $(".select_item").click(function () {
//     var idd = this.id;
//     console.log(idd);
//     console.log($(this).data('itemname'));
//     var title = $(this).data('itemname');
//     var price = $(this).data('price');
    
//     if(!$(this).data('quantity')){
//       // alert($(this).data('quantity'));
//       var qty = 0;
//     }else{
//       // alert('0');
//       var qty = $(this).data('quantity');
//     }

//     var count = parseInt($("#count").val()) + 1;
//     $("#count").val(count);
//     var total_ = price * qty;
//     var tax_ =(parseFloat(total_).toFixed(2) * 7.5) / 100;
//     var taxes_t = parseFloat(tax_).toFixed(2);
//     var total = parseFloat(total_).toFixed(2);
//     var withCommas = Number(total).toLocaleString('en');
//     total = '$' + withCommas + '.00';
//     // console.log(total);
//     // alert(total);
//     markup = "<tr id=\"ss\">" +
//         "<td width=\"35%\"><input value='"+title+"' type=\"text\" name=\"items[]\" class=\"form-control getItems\" ><input type=\"hidden\" value='"+idd+"' name=\"item_id[]\"><div class=\"show_mobile_view\"><span class=\"getItems_hidden\">"+title+"</span></div><input type=\"hidden\" name=\"itemid[]\" id=\"itemid\" class=\"itemid\" value='"+idd+"'></td>\n" +
//         "<td width=\"20%\"><div class=\"dropdown-wrapper\"><select name=\"item_type[]\" class=\"form-control\"><option value=\"product\">Product</option><option value=\"material\">Material</option><option value=\"service\">Service</option><option value=\"fee\">Fee</option></select></div></td>\n" +
//         "<td width=\"10%\"><input data-itemid='"+idd+"' id='quantity_"+idd+"' value='"+qty+"' type=\"number\" name=\"quantity[]\" data-counter=\"0\"  min=\"0\" class=\"form-control qtyest2 mobile_qty \"></td>\n" +
//         // "<td>\n" + '<input type="number" class="form-control qtyest" name="quantity[]" data-counter="' + count + '" id="quantity_' + count + '" min="1" value="1">\n' + "</td>\n" +
//         "<td width=\"10%\"><input id='price_"+idd+"' value='"+price+"'  type=\"number\" name=\"price[]\" class=\"form-control hidden_mobile_view\" placeholder=\"Unit Price\"><input type=\"hidden\" class=\"priceqty\" id='priceqty_"+idd+"'><div class=\"show_mobile_view\"><span class=\"price\">"+price+"</span></div></td>\n" +
//         // "<td width=\"10%\"><input type=\"number\" class=\"form-control discount\" name=\"discount[]\" data-counter="0" id=\"discount_0\" min="0" value="0" ></td>\n" +
//         // "<td width=\"10%\"><small>Unit Cost</small><input type=\"text\" name=\"item_cost[]\" class=\"form-control\"></td>\n" +
//         "<td width=\"10%\" class=\"hidden_mobile_view\"><input type=\"number\" name=\"discount[]\" class=\"form-control discount\" id='discount_"+idd+"' readonly></td>\n" +
//         // "<td width=\"25%\"><small>Inventory Location</small><input type=\"text\" name=\"item_loc[]\" class=\"form-control\"></td>\n" +
//         "<td width=\"20%\" class=\"hidden_mobile_view\"><input type=\"text\" data-itemid='"+idd+"' class=\"form-control tax_change2\" name=\"tax[]\" data-counter=\"0\" id='tax1_"+idd+"' min=\"0\" value='"+taxes_t+"'></td>\n" +
//         "<td style=\"text-align: center\" class=\"hidden_mobile_view\" width=\"15%\"><span data-subtotal='"+total_+"' id='span_total_"+idd+"' class=\"total_per_item\">"+total+
//         // "</span><a href=\"javascript:void(0)\" class=\"remove_item_row\"><i class=\"fa fa-times-circle\" aria-hidden=\"true\"></i></a>"+
//         "</span> <input type=\"hidden\" name=\"total[]\" id='sub_total_text"+idd+"' value='"+total+"'></td>" +
//         "<td>\n" +
//         "<a href=\"#\" class=\"remove btn btn-sm btn-success\" id='"+idd+"'><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></a>\n" +
//         "</td>\n" +
//         "</tr>";
//     tableBody = $("#jobs_items_table_body");
//     tableBody.append(markup);
//     markup2 = "<tr id=\"sss\">" +
//         "<td >"+title+"</td>\n" +
//         "<td ></td>\n" +
//         "<td ></td>\n" +
//         "<td >"+price+"</td>\n" +
//         "<td ></td>\n" +
//         "<td >"+qty+"</td>\n" +
//         "<td ></td>\n" +
//         "<td ></td>\n" +
//         "<td >0</td>\n" +
//         "<td ></td>\n" +
//         "<td ><a href=\"#\" data-name='"+title+"' data-price='"+price+"' data-quantity='"+qty+"' id='"+idd+"' class=\"edit_item_list\"><span class=\"fa fa-edit\"></span></i></a> <a href=\"javascript:void(0)\" class=\"remove_audit_item_row\"><span class=\"fa fa-trash\"></span></i></a></td>\n" +
//         "</tr>";
//     tableBody2 = $("#device_audit_datas");
//     tableBody2.append(markup2);
//     // calculate_subtotal();
//     // var counter = $(this).data("counter");
//     // calculation(idd);

// var in_id = idd;
// var price = $("#price_" + in_id).val();
// var quantity = $("#quantity_" + in_id).val();
// var discount = $("#discount_" + in_id).val();
// var tax = (parseFloat(price) * 7.5) / 100;
// var tax1 = (((parseFloat(price) * 7.5) / 100) * parseFloat(quantity)).toFixed(
// 2
// );
// if( discount == '' ){
// discount = 0;
// }

// var total = (
// (parseFloat(price) + parseFloat(tax)) * parseFloat(quantity) -
// parseFloat(discount)
// ).toFixed(2);

// var total_wo_tax = price * quantity;

// // alert( 'yeah' + total);


// $("#priceqty_" + in_id).val(total_wo_tax);
// $("#span_total_" + in_id).text(total);
// $("#sub_total_text" + in_id).val(total);
// $("#tax_1_" + in_id).text(tax1);
// $("#tax1_" + in_id).val(tax1);
// $("#discount_" + in_id).val(discount);

// if( $('#tax_1_'+ in_id).length ){
// $('#tax_1_'+in_id).val(tax1);
// }

// if( $('#item_total_'+ in_id).length ){
// $('#item_total_'+in_id).val(total);
// }

// var eqpt_cost = 0;
// var total_costs = 0;
// var cnt = $("#count").val();
// var total_discount = 0;
// var pquantity = 0;
// for (var p = 0; p <= cnt; p++) {
// var prc = $("#price_" + p).val();
// var quantity = $("#quantity_" + p).val();
// var discount = $("#discount_" + p).val();
// var pqty = $("#priceqty_" + p).val();
// // var discount= $('#discount_' + p).val();
// // eqpt_cost += parseFloat(prc) - parseFloat(discount);
// pquantity += parseFloat(pqty);
// total_costs += parseFloat(prc);
// eqpt_cost += parseFloat(prc) * parseFloat(quantity);
// total_discount += parseFloat(discount);
// }
// //   var subtotal = 0;
// // $( total ).each( function(){
// //   subtotal += parseFloat( $( this ).val() ) || 0;
// // });

// var total_cost = 0;
// // $("#span_total_0").each(function(){
// $('*[id^="price_"]').each(function(){
// total_cost += parseFloat($(this).val());
// });

// // var totalcosting = 0;
// // $('*[id^="span_total_"]').each(function(){
// //   totalcosting += parseFloat($(this).val());
// // });


// // alert(total_cost);

// var tax_tot = 0;
// $('*[id^="tax1_"]').each(function(){
// tax_tot += parseFloat($(this).val());
// });

// over_tax = parseFloat(tax_tot).toFixed(2);
// // alert(over_tax);

// $("#sales_taxs").val(over_tax);
// $("#total_tax_input").val(over_tax);
// $("#total_tax_").text(over_tax);


// eqpt_cost = parseFloat(eqpt_cost).toFixed(2);
// total_discount = parseFloat(total_discount).toFixed(2);
// stotal_cost = parseFloat(total_cost).toFixed(2);
// priceqty = parseFloat(pquantity).toFixed(2);
// // var test = 5;

// var subtotal = 0;
// // $("#span_total_0").each(function(){
// $('*[id^="span_total_"]').each(function(){
// subtotal += parseFloat($(this).text());
// });
// // $('#sum').text(subtotal);

// var subtotaltax = 0;
// // $("#span_total_0").each(function(){
// $('*[id^="tax_1_"]').each(function(){
// subtotaltax += parseFloat($(this).text());
// });


// var priceqty2 = 0;
// $('*[id^="priceqty_"]').each(function(){
// priceqty2 += parseFloat($(this).val());
// });

// $("#span_sub_total_invoice").text(priceqty2.toFixed(2));
// // $("#span_sub_total_invoice").text(priceqty);

// $("#eqpt_cost").val(eqpt_cost);
// $("#total_discount").val(total_discount);
// $("#span_sub_total_0").text(total_discount);
// // $("#span_sub_total_invoice").text(stotal_cost);
// // $("#item_total").val(subtotal.toFixed(2));
// $("#item_total").val(priceqty2.toFixed(2));

// var s_total = subtotal.toFixed(2);
// var adjustment = $("#adjustment_input").val();
// var grand_total = s_total - parseFloat(adjustment);
// var markup = $("#markup_input_form").val();
// var grand_total_w = grand_total + parseFloat(markup);

// // $("#total_tax_").text(subtotaltax.toFixed(2));
// // $("#total_tax_").val(subtotaltax.toFixed(2));




// $("#grand_total").text(grand_total_w.toFixed(2));
// $("#grand_total_input").val(grand_total_w.toFixed(2));
// $("#grand_total_inputs").val(grand_total_w.toFixed(2));

// var sls = (parseFloat(eqpt_cost).toFixed(2) * 7.5) / 100;
// sls = parseFloat(sls).toFixed(2);
// $("#sales_tax").val(sls);
// cal_total_due();
// });


$(document).on("focusout", ".qtyest2", function () {
  // alert('yeah');
  var in_id = $(this).attr('data-itemid');
  var price = $("#price_" + in_id).val();
  var quantity = $("#quantity_" + in_id).val();
  var taxes = (parseFloat(price) * 7.5) / 100;
  var o_total = (
    (parseFloat(price) + parseFloat(taxes)) * parseFloat(quantity)
  ).toFixed(2);
  var tax1 = (((parseFloat(price) * 7.5) / 100) * parseFloat(quantity)).toFixed(2);
  $("#tax1_" + in_id).val(tax1);
  // var o_total = ;

  var total = price * quantity;

  $("#priceqty_" + in_id).val(total);

  var priceqty = 0;
    $('*[id^="priceqty_"]').each(function(){
      priceqty += parseFloat($(this).val());
  });

  var subtotaltax = 0;
  // $("#span_total_0").each(function(){
    $('*[id^="tax1_"]').each(function(){
      subtotaltax += parseFloat($(this).val());
  });

  // alert(priceqty);

  $("#sales_taxs").val(subtotaltax.toFixed(2));
  $("#total_tax_").text(subtotaltax.toFixed(2));
  $("#total_tax_input").val(subtotaltax.toFixed(2));
  $("#span_total_" + in_id).text(o_total);
  // $("#sub_total_text" + in_id).text(o_total);
  $("#sub_total_text" + in_id).val(o_total);
  $("#span_sub_total_invoice").text(priceqty.toFixed(2));
  $("#item_total").val(priceqty.toFixed(2));

  var one_time  = $("#one_time").val();
  var m_monitoring  = $("#m_monitoring").val();

  // var grandtotal = priceqty + subtotaltax + one_time + m_monitoring;
  var grandtotal = priceqty + subtotaltax + parseFloat(one_time) + parseFloat(m_monitoring);

  $("#grand_total_input").val(grandtotal);
  $("#grand_total_inputs_a").val(grandtotal);
  $("#payment_amount").val(grandtotal.toFixed(2));
  // alert(grandtotal);
  // standard form
  var taxtotal  = $("#total_tax_input").val();
  var pricetotal  = $("#item_total").val();
  var s_grandtotal = subtotaltax + priceqty;
  $("#grand_total").text(s_grandtotal.toFixed(2));
  $("#grand_total_input").val(s_grandtotal.toFixed(2));
  $("#grand_total_inputs").val(s_grandtotal.toFixed(2));
  $("#payment_amount").val(s_grandtotal.toFixed(2));
  $("#balanceDueText").text(s_grandtotal.toFixed(2));
  
});

$(document).on("focusout", ".qtyest3", function () {
  // alert('yeah');
  var in_id = $(this).attr('data-itemid');
  var price = $("#price_" + in_id).val();
  var quantity = $("#quantity_" + in_id).val();
  var taxes = (parseFloat(price) * 7.5) / 100;
  var o_total = (
    (parseFloat(price) + parseFloat(taxes)) * parseFloat(quantity)
  ).toFixed(2);
  var tax1 = (((parseFloat(price) * 7.5) / 100) * parseFloat(quantity)).toFixed(2);
  $("#tax1_" + in_id).val(tax1);
  // var o_total = ;

  var total = price * quantity;

  $("#priceqty_" + in_id).val(total);

  var priceqty = 0;
    $('*[id^="priceqty_"]').each(function(){
      priceqty += parseFloat($(this).val());
  });

  var subtotaltax = 0;
  // $("#span_total_0").each(function(){
    $('*[id^="tax1_"]').each(function(){
      subtotaltax += parseFloat($(this).val());
  });

  // alert(priceqty);

  $("#sales_taxs").val(subtotaltax.toFixed(2));
  $("#total_tax_").text(subtotaltax.toFixed(2));
  $("#total_tax_input").val(subtotaltax.toFixed(2));
  $("#span_total_" + in_id).text(o_total);
  $("#sub_total_text" + in_id).text(o_total);
  $("#item_total_" + in_id).val(o_total);
  $("#span_sub_total_invoice").text(priceqty.toFixed(2));
  $("#item_total").val(priceqty.toFixed(2));

  var one_time  = $("#one_time").val();
  var m_monitoring  = $("#m_monitoring").val();

  var grandtotal = priceqty + subtotaltax + parseFloat(one_time) + parseFloat(m_monitoring);
  // alert(grandtotal);

  $("#grand_total_input").val(grandtotal);
  $("#grand_total_inputs").val(grandtotal);
  $("#payment_amount").val(grandtotal.toFixed(2));
  // alert(grandtotal);
  // standard form
  var taxtotal  = $("#total_tax_input").val();
  var pricetotal  = $("#item_total").val();
  var s_grandtotal = subtotaltax + priceqty;
  $("#grand_total").text(s_grandtotal.toFixed(2));
  $("#grand_total_input").val(s_grandtotal.toFixed(2));
  // $("#grand_total_inputs").val(s_grandtotal.toFixed(2));
  $("#payment_amount").val(s_grandtotal.toFixed(2));
  
});

$(document).on("focusout", ".adjustment_input_cm_c", function () {
  // var counter = $(this).data("counter");
  // alert('yeah');
  // calculationcm(counter);
  var grand_total = $("#grand_total_input").val();
  var adjustment = $("#adjustment_input_cm").val();

  grand_total = parseFloat(grand_total) + parseFloat(adjustment);

  var subtotal = 0;
  // $("#span_total_0").each(function(){
    $('*[id^="span_total_"]').each(function(){
    subtotal += parseFloat($(this).text());
  });

  // alert(subtotaltax);
  
  var s_total = subtotal.toFixed(2);
  var grand_total_w = s_total - parseFloat(adjustment);
  // var markup = $("#markup_input_form").val();
  // var grand_total_w = s_total + parseFloat(adjustment);

  // $("#total_tax_").text(subtotaltax.toFixed(2));
  // $("#total_tax_").val(subtotaltax.toFixed(2));

  $("#grand_total_input").val(grand_total_w.toFixed(2));
  $("#grand_total_cm").text(grand_total_w.toFixed(2));
  $("#adjustment_area").text(adjustment);
  $("#grand_total_cm_t").text(grand_total_w.toFixed(2));
  // alert(adjustment);
});

function getItemscm(obj) {
  var sk = jQuery(obj).val();
  var site_url = jQuery("#siteurl").val();
  jQuery.ajax({
    url: site_url + "items/getitems_cm",
    data: { sk: sk },
    type: "GET",
    success: function (data) {
      /* alert(data); */
      jQuery(obj).parent().find(".suggestions").empty().html(data);
    },
    error: function () {
      alert("An error has occurred");
    },
  });
}
over_tax = parseFloat(tax_tot).toFixed(2);
// alert(over_tax);

function setitemCM(obj, title, price, discount, itemid) {

// alert('setitemCM');
  jQuery(obj).parent().parent().find(".getItemsCM").val(title);
  jQuery(obj).parent().parent().parent().find(".pricecm").val(price);
  jQuery(obj).parent().parent().parent().find(".discountcm").val(discount);
  jQuery(obj).parent().parent().parent().find(".itemid").val(itemid);
  var counter = jQuery(obj)
    .parent()
    .parent()
    .parent()
    .find(".pricecm")
    .data("counter");
  jQuery(obj).parent().empty();
  calculationcm(counter);
}

$(document).on("focusout", ".pricecm", function () {
  var counter = $(this).data("counter");
  calculationcm(counter);
});

// $(document).on("focusout", ".quantitycm", function () {
//   var counter = $(this).data("counter");
//   calculationcm(counter);
// });
$(document).on("focusout", ".discountcm", function () {
  var counter = $(this).data("counter");
  calculationcm(counter);
});


$(document).on("focusout", ".quantitycm2", function () {
  // var counter = $(this).data("counter");
//   calculationcm(counter);
// var idd = this.id;
var idd = $(this).attr('data-itemid');
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

//   alert( 'yeah' + total);

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

  var subtotalcm = 0;
  // $("#span_total_0").each(function(){
    $('*[id^="span_total_"]').each(function(){
    subtotalcm += parseFloat($(this).text());
  });
  // $('#sum').text(subtotal);

  var subtotaltax = 0;
  // $("#span_total_0").each(function(){
    $('*[id^="tax_1_"]').each(function(){
      subtotaltax += parseFloat($(this).text());
  });

  // alert(subtotalcm);

  $("#eqpt_cost").val(eqpt_cost);
  $("#total_discount").val(total_discount);
  $("#span_sub_total_0").text(total_discount);
  $("#span_sub_total_cm").text(subtotal.toFixed(2));
  $("#item_total").val(subtotal.toFixed(2));

  var s_total = subtotal.toFixed(2);
  var adjustment = $("#adjustment_input_cm").val();
  var grand_total = s_total - parseFloat(adjustment);
  var markup = $("#markup_input_form").val();
  var grand_total_w = grand_total + parseFloat(markup);

  $("#total_tax_").text(subtotaltax.toFixed(2));
  $("#total_tax_").val(subtotaltax.toFixed(2));


  $("#grand_total_cm").text(grand_total_w.toFixed(2));
  $("#grand_total_cm_t").text(grand_total_w.toFixed(2));
  $("#grand_total_input").val(grand_total_w.toFixed(2));

  var sls = (parseFloat(eqpt_cost).toFixed(2) * 7.5) / 100;
  sls = parseFloat(sls).toFixed(2);
  $("#sales_tax").val(sls);
  cal_total_due();
});

function calculationcm(counter) {
  var price = $("#price_" + counter).val();
  var quantity = $("#quantity_" + counter).val();
  var discount = $("#discount_" + counter).val();
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

  $("#span_total_" + counter).text(total);
  $("#tax_1_" + counter).text(tax1);
  $("#tax_111_" + counter).text(tax1);
  $("#tax_1_" + counter).val(tax1);
  $("#discount_" + counter).val(discount);
  $("#tax1_" + counter).val(tax1);
  // $("#tax1_" + counter).val(tax1);
  // $("#tax_" + counter).val(tax1);
  // alert(tax1);

  if( $('#tax_1_'+ counter).length ){
    $('#tax_1_'+counter).val(tax1);
  }

  if( $('#item_total_'+ counter).length ){
    $('#item_total_'+counter).val(total);
  }

  // alert('dri');

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

//   alert(subtotal);

  $("#eqpt_cost").val(eqpt_cost);
  $("#total_discount").val(total_discount);
  $("#span_sub_total_0").text(total_discount);
  $("#span_sub_total_cm").text(subtotal.toFixed(2));
  $("#item_total").val(subtotal.toFixed(2));

  var s_total = subtotal.toFixed(2);
  var adjustment = $("#adjustment_input_cm").val();
  var grand_total = s_total - parseFloat(adjustment);
  var markup = $("#markup_input_form").val();
  var grand_total_w = grand_total + parseFloat(markup);

  $("#total_tax_").text(subtotaltax.toFixed(2));
  $("#total_tax_input").val(subtotaltax.toFixed(2));


  $("#grand_total_cm").text(grand_total_w.toFixed(2));
  $("#grand_total_cm_t").text(grand_total_w.toFixed(2));
  $("#grand_total_input").val(grand_total_w.toFixed(2));
  $("#grandtotal_input").val(grand_total_w.toFixed(2));

  if($("#grand_total").length && $("#grand_total").val().length)
  {
    // console.log('none');
    // alert('none');
  }else{
    $("#grand_total_cm").text(grand_total_w.toFixed(2));
    $("#grand_total_input").val(grand_total_w.toFixed(2));

    var bundle1_total = $("#grand_total").text();
    var bundle2_total = $("#grand_total2").text();
    var super_grand = parseFloat(bundle1_total) + parseFloat(bundle2_total);

    $("#supergrandtotal").text(super_grand.toFixed(2));
    $("#supergrandtotal_input").val(super_grand.toFixed(2));
  }

  var sls = (parseFloat(eqpt_cost).toFixed(2) * 7.5) / 100;
  sls = parseFloat(sls).toFixed(2);
  $("#sales_tax").val(sls);
  cal_total_due();
}

function getItemCredit_k(obj) {
  var sk = jQuery(obj).val();
  var site_url = jQuery("#siteurl").val();
  jQuery.ajax({
    url: site_url + "items/getitem_Credit",
    data: { sk: sk },
    type: "GET",
    success: function (data) {
      /* alert(data); */
      jQuery(obj).parent().find(".suggestions").empty().html(data);
    },
    error: function () {
      alert("An error has occurred");
    },
  });
}
over_tax = parseFloat(tax_tot).toFixed(2);
// alert(over_tax);

function setitemCredit(obj, title, price, discount, itemid) {
  // alert( 'yeah');
// alert('setitemCM');
  jQuery(obj).parent().parent().find(".getItemCredit").val(title);
  jQuery(obj).parent().parent().parent().find(".pricedc").val(price);
  jQuery(obj).parent().parent().parent().find(".discountdc").val(discount);
  jQuery(obj).parent().parent().parent().find(".itemid").val(itemid);
  var counter = jQuery(obj)
    .parent()
    .parent()
    .parent()
    .find(".pricedc")
    .data("counter");
  jQuery(obj).parent().empty();
  calculationCredit(counter);
}

$(document).on("focusout", ".pricedc", function () {
  var counter = $(this).data("counter");
  calculationCredit(counter);
});

// $(document).on("focusout", ".quantitycm", function () {
//   var counter = $(this).data("counter");
//   calculationcm(counter);
// });
$(document).on("focusout", ".discountdc", function () {
  var counter = $(this).data("counter");
  calculationCredit(counter);
});


$(document).on("focusout", ".quantitydc2", function () {
  // var counter = $(this).data("counter");
//   calculationcm(counter);
// var idd = this.id;
var idd = $(this).attr('data-itemid');
var in_id = idd;
  var price = $("#price_dc_" + in_id).val();
  var quantity = $("#quantity_" + in_id).val();
  var discount = $("#discount_dc_" + in_id).val();
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

//   alert( 'yeah' + total);

  $("#span_total_credit_" + in_id).text(total);
  $("#tax_1_" + in_id).text(tax1);
  $("#tax1_dc_" + in_id).val(tax1);
  $("#discount_dc_" + in_id).val(discount);

  if( $('#tax_1_'+ in_id).length ){
    $('#tax_1_'+in_id).val(tax1);
  }

  if( $('#item_total_dc_'+ in_id).length ){
    $('#item_total_dc_'+in_id).val(total);
  }

  var eqpt_cost = 0;
  var cnt = $("#count").val();
  var total_discount = 0;
  for (var p = 0; p <= cnt; p++) {
    var prc = $("#price_dc_" + p).val();
    var quantity = $("#quantity_" + p).val();
    var discount = $("#discount_dc_" + p).val();
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

  var subtotaldc = 0;
  // $("#span_total_0").each(function(){
    $('*[id^="span_total_credit_"]').each(function(){
    subtotaldc += parseFloat($(this).text());
  });
  // $('#sum').text(subtotal);

  var subtotaltax = 0;
  // $("#span_total_0").each(function(){
    $('*[id^="tax_1_"]').each(function(){
      subtotaltax += parseFloat($(this).text());
  });

  // alert(subtotalcm);

  $("#eqpt_cost").val(eqpt_cost);
  $("#total_discount").val(total_discount);
  $("#span_sub_total_0").text(total_discount);
  $("#span_sub_total_dc").text(subtotal.toFixed(2));
  $("#item_total_dc").val(subtotal.toFixed(2));

  var s_total = subtotal.toFixed(2);
  var adjustment = $("#adjustment_input_dc").val();
  var grand_total = s_total - parseFloat(adjustment);
  var markup = $("#markup_input_form").val();
  var grand_total_w = grand_total + parseFloat(markup);

  $("#total_tax_dc_").text(subtotaltax.toFixed(2));
  $("#total_tax_dc_").val(subtotaltax.toFixed(2));


  $("#grand_total_dc").text(grand_total_w.toFixed(2));
  $("#grand_total_dc_total").text(grand_total_w.toFixed(2));
  $("#grand_total_dc_total_val").val(grand_total_w.toFixed(2));
  $("#grand_total_input").val(grand_total_w.toFixed(2));

  var sls = (parseFloat(eqpt_cost).toFixed(2) * 7.5) / 100;
  sls = parseFloat(sls).toFixed(2);
  $("#sales_tax").val(sls);
  cal_total_due();
});

function calculationCredit(counter) {
  // alert( 'yeah');
  var price = $("#price_dc_" + counter).val();
  var quantity = $("#quantity_" + counter).val();
  var discount = $("#discount_dc_" + counter).val();
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

  // console.log( 'yeah' + total);

  $("#span_total_credit_" + counter).text(total);
  $("#tax_1_" + counter).text(tax1);
  $("#tax_111_" + counter).text(tax1);
  $("#tax_1_" + counter).val(tax1);
  $("#discount_dc_" + counter).val(discount);
  $("#tax1_dc_" + counter).val(tax1);
  // $("#tax1_" + counter).val(tax1);
  // $("#tax_" + counter).val(tax1);
  // alert(tax1);

  if( $('#tax_1_'+ counter).length ){
    $('#tax_1_'+counter).val(tax1);
  }

  if( $('#item_total_dc_'+ counter).length ){
    $('#item_total_dc_'+counter).val(total);
  }

  // alert('dri');

  var eqpt_cost = 0;
  var cnt = $("#count").val();
  var total_discount = 0;
  for (var p = 0; p <= cnt; p++) {
    var prc = $("#price_dc_" + p).val();
    var quantity = $("#quantity_" + p).val();
    var discount = $("#discount_dc_" + p).val();
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
    $('*[id^="span_total_credit_"]').each(function(){
    subtotal += parseFloat($(this).text());
  });
  // $('#sum').text(subtotal);
  var subtotaltax = 0;
  // $("#span_total_0").each(function(){
    $('*[id^="tax_1_"]').each(function(){
      subtotaltax += parseFloat($(this).text());
  });

//   alert(subtotal);

  $("#eqpt_cost").val(eqpt_cost);
  $("#total_discount").val(total_discount);
  $("#span_sub_total_0").text(total_discount);
  $("#span_sub_total_dc").text(subtotal.toFixed(2));
  $("#item_total_dc").val(subtotal.toFixed(2));

  var s_total = subtotal.toFixed(2);
  var adjustment = $("#adjustment_input_dc").val();
  var grand_total = s_total - parseFloat(adjustment);
  var markup = $("#markup_input_form").val();
  var grand_total_w = grand_total + parseFloat(markup);

  $("#total_tax_dc_").text(subtotaltax.toFixed(2));
  $("#total_tax_input_dc").val(subtotaltax.toFixed(2));


  $("#grand_total_dc").text(grand_total_w.toFixed(2));
  $("#grand_total_dc_total").text(grand_total_w.toFixed(2));
  $("#grand_total_dc_total_val").val(grand_total_w.toFixed(2));
  $("#grand_total_input").val(grand_total_w.toFixed(2));
  $("#grandtotal_input").val(grand_total_w.toFixed(2));
  // alert(grand_total_w);

  if($("#grand_total").length && $("#grand_total").val().length)
  {
    // console.log('none');
    // alert('none');
  }else{
    $("#grand_total_dc").text(grand_total_w.toFixed(2));
    $("#grand_total_input").val(grand_total_w.toFixed(2));

    var bundle1_total = $("#grand_total").text();
    var bundle2_total = $("#grand_total2").text();
    var super_grand = parseFloat(bundle1_total) + parseFloat(bundle2_total);

    $("#supergrandtotal").text(super_grand.toFixed(2));
    $("#supergrandtotal_input").val(super_grand.toFixed(2));
  }

  var sls = (parseFloat(eqpt_cost).toFixed(2) * 7.5) / 100;
  sls = parseFloat(sls).toFixed(2);
  $("#sales_tax").val(sls);
  cal_total_due();
}


$(".select_item_dch").click(function () {
  var idd = this.id;
  console.log(idd);
  console.log($(this).data('itemname'));
  var title = $(this).data('itemname');
  var price = $(this).data('price');
  
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
  var tax_ =(parseFloat(total_).toFixed(2) * 7.5) / 100;
  var taxes_t = parseFloat(tax_).toFixed(2);
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
      "<td width=\"10%\"><input id='price_dch_"+idd+"' value='"+price+"'  type=\"number\" name=\"price[]\" class=\"form-control\" placeholder=\"Unit Price\"></td>\n" +
      // "<td width=\"10%\"><input type=\"number\" class=\"form-control discount\" name=\"discount[]\" data-counter="0" id=\"discount_0\" min="0" value="0" ></td>\n" +
      // "<td width=\"10%\"><small>Unit Cost</small><input type=\"text\" name=\"item_cost[]\" class=\"form-control\"></td>\n" +
      "<td width=\"10%\"><input type=\"number\" name=\"discount[]\" class=\"form-control discount\" id='discount_dch_"+idd+"'></td>\n" +
      // "<td width=\"25%\"><small>Inventory Location</small><input type=\"text\" name=\"item_loc[]\" class=\"form-control\"></td>\n" +
      "<td width=\"20%\"><input type=\"text\" data-itemid='"+idd+"' class=\"form-control tax_change2\" name=\"tax[]\" data-counter=\"0\" id='tax1_dch_"+idd+"' min=\"0\" value='"+taxes_t+"'></td>\n" +
      "<td style=\"text-align: center\" class=\"d-flex\" width=\"15%\"><span data-subtotal='"+total_+"' id='span_total_charge_"+idd+"' class=\"total_per_item\">"+total+
      // "</span><a href=\"javascript:void(0)\" class=\"remove_item_row\"><i class=\"fa fa-times-circle\" aria-hidden=\"true\"></i></a>"+
      "</span> <input type=\"hidden\" name=\"total[]\" id='sub_total_text"+idd+"' value='"+total+"'></td>" +
      "</tr>";
  tableBody = $("#items_table_body_delayed_charge");
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
var price = $("#price_dch_" + in_id).val();
var quantity = $("#quantity_" + in_id).val();
var discount = $("#discount_dch_" + in_id).val();
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

$("#span_total_charge_" + in_id).text(total);
$("#sub_total_text" + in_id).val(total);
$("#tax_1_" + in_id).text(tax1);
$("#tax1_dch_" + in_id).val(tax1);
$("#discount_dch_" + in_id).val(discount);

if( $('#tax_1_'+ in_id).length ){
$('#tax_1_'+in_id).val(tax1);
}

if( $('#item_total_dch_'+ in_id).length ){
$('#item_total_dch_'+in_id).val(total);
}

var eqpt_cost = 0;
// var total_cost = 0;
var cnt = $("#count").val();
var total_discount = 0;
for (var p = 0; p <= cnt; p++) {
var prc = $("#price_dch_" + p).val();
var quantity = $("#quantity_" + p).val();
var discount = $("#discount_dch_" + p).val();
// var discount= $('#discount_' + p).val();
// eqpt_cost += parseFloat(prc) - parseFloat(discount);
// total_cost += parseFloat(prc);
eqpt_cost += parseFloat(prc) * parseFloat(quantity);
total_discount += parseFloat(discount);
}
//   var subtotal = 0;
// $( total ).each( function(){
//   subtotal += parseFloat( $( this ).val() ) || 0;
// });

var total_cost = 0;
// $("#span_total_0").each(function(){
$('*[id^="price_dch_"]').each(function(){
total_cost += parseFloat($(this).val());
});

var tax_tot = 0;
$('*[id^="tax1_dch_"]').each(function(){
tax_tot += parseFloat($(this).val());
});

over_tax = parseFloat(tax_tot).toFixed(2);
// alert(over_tax);

$("#sales_taxs").val(over_tax);
$("#total_tax_input_dch").val(over_tax);
$("#total_tax_dch_").text(over_tax);


eqpt_cost = parseFloat(eqpt_cost).toFixed(2);
total_discount = parseFloat(total_discount).toFixed(2);
stotal_cost = parseFloat(total_cost).toFixed(2);
// var test = 5;

var subtotal = 0;
// $("#span_total_0").each(function(){
$('*[id^="span_total_charge_"]').each(function(){
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
$("#span_sub_total_invoice_dch").text(subtotal.toFixed(2));
// $("#item_total").val(subtotal.toFixed(2));
$("#item_total_dch").val(stotal_cost);

var s_total = subtotal.toFixed(2);
var adjustment = $("#adjustment_input_dch").val();
var grand_total = s_total - parseFloat(adjustment);
var markup = $("#markup_input_form").val();
var grand_total_w = grand_total + parseFloat(markup);

// $("#total_tax_").text(subtotaltax.toFixed(2));
// $("#total_tax_").val(subtotaltax.toFixed(2));




$("#grand_total_dch").text(grand_total_w.toFixed(2));
$("#grand_total_input").val(grand_total_w.toFixed(2));
$("#grand_total_dch_total").text(grand_total_w.toFixed(2));
$("#grand_total_dc_total_val_dc").val(grand_total_w.toFixed(2));
$("#grand_total_dch").text(grand_total_w.toFixed(2));
$("#span_sub_total_dch").text(grand_total_w.toFixed(2));

var sls = (parseFloat(eqpt_cost).toFixed(2) * 7.5) / 100;
sls = parseFloat(sls).toFixed(2);
$("#sales_tax").val(sls);
cal_total_due();
});

function getItemReceipt_k(obj) {
  var sk = jQuery(obj).val();
  var site_url = jQuery("#siteurl").val();
  jQuery.ajax({
    url: site_url + "items/getitem_Receipt",
    data: { sk: sk },
    type: "GET",
    success: function (data) {
      /* alert(data); */
      jQuery(obj).parent().find(".suggestions").empty().html(data);
    },
    error: function () {
      alert("An error has occurred");
    },
  });
}
over_tax = parseFloat(tax_tot).toFixed(2);
// alert(over_tax);

$(".select_item_sr").click(function() {
  var idd = this.id;
  console.log(idd);
  console.log($(this).data('itemname'));
  var title = $(this).data('itemname');
  var price = $(this).data('price');

  if (!$(this).data('quantity')) {
      // alert($(this).data('quantity'));
      var qty = 0;
  } else {
      // alert('0');
      var qty = $(this).data('quantity');
  }
  var number_of_items_added = 0;
  $('*[id^="span_total_sr_"]').each(function() {
      number_of_items_added++;
  });
  var count = parseInt($("#count").val()) + 1;
  $("#count").val(count);
  var total_ = price * qty;
  var tax_ = (parseFloat(total_).toFixed(2) * 7.5) / 100;
  var taxes_t = parseFloat(tax_).toFixed(2);
  var total = parseFloat(total_).toFixed(2);
  var withCommas = Number(total).toLocaleString('en');
  total = '$' + withCommas + '.00';
  // console.log(total);
  // alert(total);
  markup = "<tr id=\"ss\">" +
      "<td width=\"35%\"><input value='" + title +
      "' type=\"text\" name=\"items[]\" class=\"form-control getItemssr required\"  required onKeyup=\"getItemssr(this)\" ><input type=\"hidden\" value='" +
      idd +
      "' name=\"item_id[]\"><ul class=\"suggestions\"></ul></td>\n" +
      "<td width=\"20%\"><select name=\"item_type[]\" class=\"form-control\"><option value=\"product\">Product</option><option value=\"material\">Material</option><option value=\"service\">Service</option><option value=\"fee\">Fee</option></select></td>\n" +
      "<td width=\"10%\"><input data-itemid='" + idd + "' id='quantity_" + idd + "' value='" + qty +
      "' type=\"number\" name=\"quantity[]\" data-counter=\"" + number_of_items_added +
      "\" min=\"0\" class=\"form-control quantitysr  required item-field-monitary\"></td>\n" +
      // "<td>\n" + '<input type="number" class="form-control qtyest" name="quantity[]" data-counter="' + count + '" id="quantity_' + count + '" min="1" value="1">\n' + "</td>\n" +
      "<td width=\"10%\"><input id='price_sr_" + idd + "' value='" + price +
      "'  type=\"number\"  data-counter=\"" + number_of_items_added +
      "\" name=\"price[]\" class=\"form-control pricesr required item-field-monitary\" placeholder=\"Unit Price\"></td>\n" +
      // "<td width=\"10%\"><input type=\"number\" class=\"form-control discount\" name=\"discount[]\" data-counter="0" id=\"discount_0\" min="0" value="0" ></td>\n" +
      // "<td width=\"10%\"><small>Unit Cost</small><input type=\"text\" name=\"item_cost[]\" class=\"form-control\"></td>\n" +
      "<td width=\"10%\"><input type=\"number\" name=\"discount[]\" class=\"form-control discountsr item-field-monitary\"  data-counter=\"" +
      number_of_items_added +
      "\" id='discount_sr_" +
      idd + "'></td>\n" +
      // "<td width=\"25%\"><small>Inventory Location</small><input type=\"text\" name=\"item_loc[]\" class=\"form-control\"></td>\n" +
      "<td width=\"20%\"><input type=\"text\" data-itemid='" + idd +
      "' class=\"form-control tax_change item-field-monitary\" data-itemfieldtype=\"tax\"  data-counter=\"" +
      number_of_items_added +
      "\" name=\"tax[]\" data-counter=\"" + number_of_items_added +
      "\" id='tax1_sr_" + idd +
      "' min=\"0\" value='" + taxes_t +
      "'><input type=\"text\" class=\"tax-hide\" value=\"0\" type=\"hidden\"></td>\n" +
      "<td style=\"text-align: center\"  width=\"15%\">$<span data-subtotal='" + total_ +
      "' id='span_total_sr_" + idd + "' class=\"total_per_item\">" + total +
      // "</span><a href=\"javascript:void(0)\" class=\"remove_item_row\"><i class=\"fa fa-times-circle\" aria-hidden=\"true\"></i></a>"+
      "</span> <input type=\"hidden\" name=\"total[]\" class=\"total_per_input\" id='sub_total_text" +
      idd + "' value='" + total +
      "'></td>" +
      "</tr>";
  tableBody = $("#items_table_body_sales_receipt");
  tableBody.append(markup);
  markup2 =
      "<tr id=\"sss\">" +
      "<td >" + title + "</td>\n" +
      "<td ></td>\n" +
      "<td ></td>\n" +
      "<td >" + price + "</td>\n" +
      "<td ></td>\n" +
      "<td >" + qty + "</td>\n" +
      "<td ></td>\n" +
      "<td ></td>\n" +
      "<td >0</td>\n" +
      "<td ></td>\n" +
      "<td ><a href=\"#\" data-name='" + title + "' data-price='" + price + "' data-quantity='" + qty +
      "' id='" + idd +
      "' class=\"edit_item_list\"><span class=\"fa fa-edit\"></span></i></a> <a href=\"javascript:void(0)\" class=\"remove_audit_item_row\"><span class=\"fa fa-trash\"></span></i></a></td>\n" +
      "</tr>";
  tableBody2 = $("#device_audit_datas");
  tableBody2.append(markup2);
  // calculate_subtotal();
  // var counter = $(this).data("counter");
  // calculation(idd);

  var in_id = idd;
  var price = $("#price_sr_" + in_id).val();
  var quantity = $("#quantity_" + in_id).val();
  var discount = $("#discount_sr_" + in_id).val();
  var tax = (parseFloat(price) * 7.5) / 100;
  var tax1 = (((parseFloat(price) * 7.5) / 100) * parseFloat(quantity)).toFixed(
      2
  );
  if (discount == '') {
      discount = 0;
  }

  var total = (
      (parseFloat(price) + parseFloat(tax)) * parseFloat(quantity) -
      parseFloat(discount)
  ).toFixed(2);

  // alert( 'yeah' + total);

  $("#span_total_sr_" + in_id).text(total);
  $("#sub_total_text" + in_id).val(total);
  $("#tax_1_" + in_id)
      .text(tax1);
  $("#tax1_sr_" + in_id).val(tax1);
  $("#discount_sr_" + in_id).val(discount);

  if ($('#tax_1_' + in_id).length) {
      $('#tax_1_' + in_id).val(tax1);
  }

  if ($('#item_total_sr_' + in_id).length) {
      $('#item_total_sr_' + in_id).val(total);
  }

  var eqpt_cost = 0;
  // var total_cost = 0;
  var cnt = $("#count").val();
  var total_discount = 0;
  for (var p = 0; p <= cnt; p++) {
      var prc = $("#price_sr_" + p).val();
      var quantity = $("#quantity_" + p).val();
      var discount = $("#discount_sr_" + p).val();
      // var discount= $('#discount_' + p).val();
      // eqpt_cost += parseFloat(prc) - parseFloat(discount);
      // total_cost += parseFloat(prc);
      eqpt_cost += parseFloat(prc) * parseFloat(quantity);
      total_discount += parseFloat(discount);
  }
  //   var subtotal = 0;
  // $( total ).each( function(){
  //   subtotal += parseFloat( $( this ).val() ) || 0;
  // });

  var total_cost = 0;
  // $("#span_total_0").each(function(){
  $('*[id^="price_sr_"]').each(function() {
      total_cost += parseFloat($(this).val());
  });

  var tax_tot = 0;
  $('*[id^="tax1_sr_"]').each(function() {
      tax_tot += parseFloat($(this).val());
  });

  over_tax = parseFloat(tax_tot).toFixed(2);
  // alert(over_tax);

  $("#sales_taxs").val(over_tax);
  $("#total_tax_input_sr").val(over_tax);
  $("#total_tax_sr_").text(over_tax);


  eqpt_cost = parseFloat(eqpt_cost).toFixed(2);
  total_discount = parseFloat(total_discount).toFixed(
      2);
  stotal_cost = parseFloat(total_cost).toFixed(2);
  // var test = 5;

  var subtotal = 0;
  // $("#span_total_0").each(function(){
  $('*[id^="span_total_sr_"]').each(function() {
      subtotal += parseFloat($(this).text());
  });
  // $('#sum').text(subtotal);

  var subtotaltax = 0;
  // $("#span_total_0").each(function(){
  $('*[id^="tax_1_"]').each(function() {
      subtotaltax += parseFloat($(this).text());
  });

  // alert(subtotaltax);

  $("#eqpt_cost").val(eqpt_cost);
  $("#total_discount").val(total_discount);
  $("#span_sub_total_0").text(
      total_discount);
  $("#span_sub_total_invoice_sr").text(subtotal.toFixed(2));
  // $("#item_total").val(subtotal.toFixed(2));
  $("#item_total_sr").val(stotal_cost);

  var s_total = subtotal.toFixed(2);
  var adjustment = $("#adjustment_input_sr").val();
  var grand_total = s_total - parseFloat(adjustment);
  var markup = $("#markup_input_form").val();
  var grand_total_w = grand_total + parseFloat(markup);

  // $("#total_tax_").text(subtotaltax.toFixed(2));
  // $("#total_tax_").val(subtotaltax.toFixed(2));




  $("#grand_total_sr").text(grand_total_w.toFixed(2));
  $("#grand_total_input").val(grand_total_w.toFixed(
      2));
  $("#grand_total_sr_t").text(grand_total_w.toFixed(2));
  $("#grand_total_sr_g").val(grand_total_w
      .toFixed(2));
  $("#span_sub_total_sr").text(grand_total_w.toFixed(2));

  var sls = (parseFloat(eqpt_cost).toFixed(2) * 7.5) / 100;
  sls = parseFloat(sls).toFixed(2);
  $("#sales_tax")
      .val(sls);
  cal_total_due();

});

// var price = $("#price2_" + counter).val();
// var quantity = $("#quantity2_" + counter).val();
// var discount = $("#discount2_" + counter).val();
// var tax = (parseFloat(price) * 7.5) / 100;
// var tax1 = (((parseFloat(price) * 7.5) / 100) * parseFloat(quantity)).toFixed(
//     2
// );
// if (discount == '') {
//     discount = 0;
// }

// var total = (
//     (parseFloat(price) + parseFloat(tax)) * parseFloat(quantity) -
//     parseFloat(discount)
// ).toFixed(2);

// // alert( 'yeah' + total);

// $("#span_total2_" + counter).text(total);
// $("#tax2_" + counter).text(tax1);
// $("#discount2_" + counter).val(discount);

// if ($('#tax2_' + counter).length) {
//     $('#tax2_' + counter).val(tax1);
// }

// if ($('#item_total2_' + counter).length) {
//     $('#item_total2_' + counter).val(total);
// }



$('.close').on('hidden.bs.modal', function (e) {
  $(this)
    .find("input,textarea,select")
       .val('')
       .end()
    .find("input[type=checkbox], input[type=radio]")
       .prop("checked", "")
       .end();

       if(check_original != check_updated){
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to leave without saving?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#2ca01c',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, leave without saving!'
        }).then((result) => {
            if (result.value) {
            if(attachment == 0){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "There is/are a attachment that temporarily removed?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#2ca01c',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, remove it permanently!'
                }).then((result) => {
                    if (result.value) {
                    $(".loader").fadeIn('fast',function(){
                        $('.loader').show();
                    });
                    $('#edit-expensesCheck').modal('hide');
                    $(".loader").fadeOut('fast',function(){
                        $('.loader').hide();
                    });
                    attachment = null;
                    attachment_id = [];
                }
            });
            }else{
                $(".loader").fadeIn('fast',function(){
                    $('.loader').show();
                });
                $('#edit-expensesCheck').modal('hide');
                $(".loader").fadeOut('fast',function(){
                    $('.loader').hide();
                });
                attachment = null;
                attachment_id = [];
            }
        }
    });
    }else{
        if(attachment == 0){
            Swal.fire({
                title: 'Are you sure?',
                text: "There is/are a attachment that temporarily removed?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#2ca01c',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, remove it permanently!'
            }).then((result) => {
                if (result.value) {
                $.ajax({
                    url:"/accounting/removePermanentlyAttachment",
                    type:"POST",
                    data:{attachment_id:attachment_id},
                    success:function () {
  
                    }
                });
                $(".loader").fadeIn('fast',function(){
                    $('.loader').show();
                });
                $('#edit-expensesCheck').modal('hide');
                $(".loader").fadeOut('fast',function(){
                    $('.loader').hide();
                });
                attachment = null;
                attachment_id = [];
            }
        });
        }else{
            $(".loader").fadeIn('fast',function(){
                $('.loader').show();
            });
            $('#edit-expensesCheck').modal('hide');
            $(".loader").fadeOut('fast',function(){
                $('.loader').hide();
            });
            attachment = null;
            attachment_id = [];
        }
    }
});

document.getElementById("payment_method_pay").onchange = function() {
  if (this.value == 'Cash') {
      // alert('cash');
  // $('#exampleModal').modal('toggle');
      $('#cash_area').show();
      $('#check_area').hide();
      $('#credit_card').hide();
      $('#debit_card').hide();
      $('#ach_area').hide();
      $('#venmo_area').hide();
      $('#paypal_area').hide();
      $('#invoicing').hide();
      $('#square_area').hide();
      $('#warranty_area').hide();
      $('#home_area').hide();
      $('#e_area').hide();
      $('#other_credit_card').hide();
      $('#other_payment_area').hide();
    }
  else if(this.value == 'Invoicing'){

      $('#cash_area').hide();
      $('#check_area').hide();
      $('#invoicing').show();
      $('#credit_card').hide();
      $('#debit_card').hide();
      $('#ach_area').hide();
      $('#venmo_area').hide();
      $('#paypal_area').hide();
      $('#square_area').hide();
      $('#warranty_area').hide();
      $('#home_area').hide();
      $('#e_area').hide();
      $('#other_credit_card').hide();
      $('#other_payment_area').hide();
  }

  else if(this.value == 'Check'){
      // alert('Check');
      $('#cash_area').hide();
      $('#check_area').show();
      $('#credit_card').hide();
      $('#debit_card').hide();
      $('#invoicing').hide();
      $('#ach_area').hide();
      $('#venmo_area').hide();
      $('#paypal_area').hide();
      $('#square_area').hide();
      $('#warranty_area').hide();
      $('#home_area').hide();
      $('#e_area').hide();
      $('#other_credit_card').hide();
      $('#other_payment_area').hide();
  }
  else if(this.value == 'Credit Card'){
      // alert('Credit card');
      $('#cash_area').hide();
      $('#check_area').hide();
      $('#credit_card').show();
      $('#debit_card').hide();
      $('#invoicing').hide();
      $('#ach_area').hide();
      $('#venmo_area').hide();
      $('#paypal_area').hide();
      $('#square_area').hide();
      $('#warranty_area').hide();
      $('#home_area').hide();
      $('#e_area').hide();
      $('#other_credit_card').hide();
      $('#other_payment_area').hide();
  }
  else if(this.value == 'Debit Card'){
      // alert('Credit card');
      $('#cash_area').hide();
      $('#check_area').hide();
      $('#credit_card').hide();
      $('#debit_card').show();
      $('#ach_area').hide();
      $('#venmo_area').hide();
      $('#invoicing').hide();
      $('#paypal_area').hide();
      $('#square_area').hide();
      $('#warranty_area').hide();
      $('#home_area').hide();
      $('#e_area').hide();
      $('#other_credit_card').hide();
      $('#other_payment_area').hide();
  }
  else if(this.value == 'ACH'){
      // alert('Credit card');
      $('#cash_area').hide();
      $('#check_area').hide();
      $('#credit_card').hide();
      $('#debit_card').hide();
      $('#invoicing').hide();
      $('#ach_area').show();
      $('#venmo_area').hide();
      $('#paypal_area').hide();
      $('#square_area').hide();
      $('#warranty_area').hide();
      $('#home_area').hide();
      $('#e_area').hide();
      $('#other_credit_card').hide();
      $('#other_payment_area').hide();
  }
  else if(this.value == 'Venmo'){
      // alert('Credit card');
      $('#cash_area').hide();
      $('#check_area').hide();
      $('#credit_card').hide();
      $('#debit_card').hide();
      $('#ach_area').hide();
      $('#invoicing').hide();
      $('#venmo_area').show();
      $('#paypal_area').hide();
      $('#square_area').hide();
      $('#warranty_area').hide();
      $('#home_area').hide();
      $('#e_area').hide();
      $('#other_credit_card').hide();
      $('#other_payment_area').hide();
  }
  else if(this.value == 'Paypal'){
      // alert('Credit card');
      $('#cash_area').hide();
      $('#check_area').hide();
      $('#credit_card').hide();
      $('#debit_card').hide();
      $('#invoicing').hide();
      $('#ach_area').hide();
      $('#venmo_area').hide();
      $('#paypal_area').show();
      $('#square_area').hide();
      $('#warranty_area').hide();
      $('#home_area').hide();
      $('#e_area').hide();
      $('#other_credit_card').hide();
      $('#other_payment_area').hide();
  }
  else if(this.value == 'Square'){
      // alert('Credit card');
      $('#cash_area').hide();
      $('#check_area').hide();
      $('#credit_card').hide();
      $('#invoicing').hide();
      $('#debit_card').hide();
      $('#ach_area').hide();
      $('#venmo_area').hide();
      $('#paypal_area').hide();
      $('#square_area').show();
      $('#warranty_area').hide();
      $('#home_area').hide();
      $('#e_area').hide();
      $('#other_credit_card').hide();
      $('#other_payment_area').hide();
  }
  else if(this.value == 'Warranty Work'){
      // alert('Credit card');
      $('#cash_area').hide();
      $('#check_area').hide();
      $('#credit_card').hide();
      $('#invoicing').hide();
      $('#debit_card').hide();
      $('#ach_area').hide();
      $('#venmo_area').hide();
      $('#paypal_area').hide();
      $('#square_area').hide();
      $('#warranty_area').show();
      $('#home_area').hide();
      $('#e_area').hide();
      $('#other_credit_card').hide();
      $('#other_payment_area').hide();
  }
  else if(this.value == 'Home Owner Financing'){
      // alert('Credit card');
      $('#cash_area').hide();
      $('#check_area').hide();
      $('#credit_card').hide();
      $('#debit_card').hide();
      $('#invoicing').hide();
      $('#ach_area').hide();
      $('#venmo_area').hide();
      $('#paypal_area').hide();
      $('#square_area').hide();
      $('#warranty_area').hide();
      $('#home_area').show();
      $('#e_area').hide();
      $('#other_credit_card').hide();
      $('#other_payment_area').hide();
  }
  else if(this.value == 'e-Transfer'){
      // alert('Credit card');
      $('#cash_area').hide();
      $('#check_area').hide();
      $('#credit_card').hide();
      $('#debit_card').hide();
      $('#invoicing').hide();
      $('#ach_area').hide();
      $('#venmo_area').hide();
      $('#paypal_area').hide();
      $('#square_area').hide();
      $('#warranty_area').hide();
      $('#home_area').hide();
      $('#e_area').show();
      $('#other_credit_card').hide();
      $('#other_payment_area').hide();
  }
  else if(this.value == 'Other Credit Card Professor'){
      // alert('Credit card');
      $('#cash_area').hide();
      $('#check_area').hide();
      $('#credit_card').hide();
      $('#debit_card').hide();
      $('#invoicing').hide();
      $('#ach_area').hide();
      $('#venmo_area').hide();
      $('#paypal_area').hide();
      $('#square_area').hide();
      $('#warranty_area').hide();
      $('#home_area').hide();
      $('#e_area').hide();
      $('#other_credit_card').show();
      $('#other_payment_area').hide();
  }
  else if(this.value == 'Other Payment Type'){
      // alert('Credit card');
      $('#cash_area').hide();
      $('#check_area').hide();
      $('#credit_card').hide();
      $('#debit_card').hide();
      $('#invoicing').hide();
      $('#ach_area').hide();
      $('#venmo_area').hide();
      $('#paypal_area').hide();
      $('#square_area').hide();
      $('#warranty_area').hide();
      $('#home_area').hide();
      $('#e_area').hide();
      $('#other_credit_card').hide();
      $('#other_payment_area').show();
  }
}