$(document).ready(function () {
  // $("#yrMybus").datetimepicker({
  //   viewMode: 'years',
  //   format: 'YYYY'
  // });

  $('#monHoursFromAvail').timepicker();
  $('#tueHoursFromAvail').timepicker();
  $('#wedHoursFromAvail').timepicker();
  $('#thuHoursFromAvail').timepicker();
  $('#friHoursFromAvail').timepicker();
  $('#satHoursFromAvail').timepicker();
  $('#sunHoursFromAvail').timepicker();
  $('#monHoursToAvail').timepicker();
  $('#tueHoursToAvail').timepicker();
  $('#wedHoursToAvail').timepicker();
  $('#thuHoursToAvail').timepicker();
  $('#friHoursToAvail').timepicker();
  $('#satHoursToAvail').timepicker();
  $('#sunHoursToAvail').timepicker();
  $('#hoursToAvail').timepicker();
  $('#timeoff_from').timepicker();
  $('#timeoff_to').timepicker();

  $('input[type=checkbox]').each(function () {
    // $(this).click(function() {

    // });
  });
});

function getplanItems(pid) {
  var site_url = jQuery("#siteurl").val();
  jQuery.ajax({
    url: site_url + "plans/getitems",
    data: { pid: pid },
    type: "GET",
    success: function (data) {
      jQuery("#plansItemDiv").empty().html(data);
    },
    error: function () {
      alert("An error has occurred");
    },
  });
}

// $(document).ready(function () {
//   $(".form-validate").validate();
//   //Initialize Select2 Elements
//   $(".select2").select2();
// });

function getplanItems(pid) {
  var site_url = jQuery("#siteurl").val();
  jQuery.ajax({
    url: site_url + "plans/getitems",
    data: { pid: pid },
    type: "GET",
    success: function (data) {
      jQuery("#plansItemDiv").empty().html(data);
    },
    error: function () {
      alert("An error has occurred");
    },
  });
}

function getItems(obj) {
  var sk = jQuery(obj).val();
  var site_url = jQuery("#siteurl").val();
  jQuery.ajax({
    url: site_url + "items/getitems",
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

function getItemsOption2(obj) {
  var sk = jQuery(obj).val();
  var site_url = jQuery("#siteurl").val();
  jQuery.ajax({
    url: site_url + "items/getitems2",
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

// function setitem(obj, title, price, discount, itemid) {
//   // alert('here');
//   // var total = price * 1;
//   jQuery(obj).parent().parent().find(".getItems").val(title);
//   jQuery(obj).parent().parent().find(".getItems_hidden").text(title);
//   jQuery(obj).parent().parent().parent().find(".price").val(price);
//   jQuery(obj).parent().parent().parent().find(".priceqty").val(price);
//   jQuery(obj).parent().parent().parent().find(".price").text(price);
//   jQuery(obj).parent().parent().parent().find(".discount").val(discount);
//   jQuery(obj).parent().parent().parent().find(".itemid").val(itemid);
//   var counter = jQuery(obj)
//     .parent()
//     .parent()
//     .parent()
//     .find(".price")
//     .data("counter");
//   jQuery(obj).parent().empty();
//   calculation(counter);
// }

function setitem2(obj, title, price, discount, itemid) {
  jQuery(obj).parent().parent().find(".getItems2").val(title);
  jQuery(obj).parent().parent().parent().find(".price2").val(price);
  jQuery(obj).parent().parent().parent().find(".discount2").val(discount);
  jQuery(obj).parent().parent().parent().find(".priceqty2").val(price);
  jQuery(obj).parent().parent().parent().find(".itemid").val(itemid);
  jQuery(obj).parent().parent().parent().find(".itemid2").val(itemid);
  var counter = jQuery(obj)
    .parent()
    .parent()
    .parent()
    .find(".price2")
    .data("counter");
  jQuery(obj).parent().empty();
  calculation2(counter);
}

// function setitem2(obj, title, price, discount, itemid) {
//   jQuery(obj).parent().parent().find(".getItems2").val(title);
//   jQuery(obj).parent().parent().parent().find(".price2").val(price);
//   jQuery(obj).parent().parent().parent().find(".discount2").val(discount);
//   jQuery(obj).parent().parent().parent().find(".itemid").val(itemid);
//   var counter = jQuery(obj)
//     .parent()
//     .parent()
//     .parent()
//     .find(".price2")
//     .data("counter");
//   jQuery(obj).parent().empty();
//   calculation(counter);
// }

function previewImage(input, previewDom) {
  if (input.files && input.files[0]) {
    $(previewDom).show();
    var reader = new FileReader();
    reader.onload = function (e) {
      $(previewDom).find("img").attr("src", e.target.result);
    };
    reader.readAsDataURL(input.files[0]);
  } else {
    $(previewDom).hide();
  }
}

function createUsername(name) {
  return name
    .toLowerCase()
    .replace(/ /g, "_")
    .replace(/[^\w-]+/g, "");
}

// $(document).on("focusout", ".price", function () {
//   var counter = $(this).data("counter");
//   calculation(counter);
// });
$(document).on("focusout", ".markup_input", function () {
  // alert('yeah');
  var counter = $(this).data("counter");
  calculation(counter);
});

$(document).on("focusout", ".adjustment_input", function () {
  // alert($(this).val());
  var counter = $(this).data("counter");
  // calculation(counter);
  var subtotal = $('#item_total').val();
  var taxes = $('#total_tax_input').val();
  var adjustment = $(this).val();
  // if( adjustment <= 0 ){
  //   adjustment = 0;
  // }
  var grand = parseFloat(subtotal) + parseFloat(taxes);  
  var new_grand = parseFloat(grand) + parseFloat(adjustment);

  // alert(adjustment);

  $('#grand_total_input').val(new_grand.toFixed(2)).trigger('change');
  $('#grand_total').text(new_grand.toFixed(2));
  $('#adjustmentText').text(adjustment);
  $("#payment_amount").val(new_grand.toFixed(2));

});

$(document).on("focusout", ".setmarkup", function () {
  var counter = $(this).data("counter");
  calculation(counter);
});

$(document).on('change','#span_total_0',function(){
    //alert('Change Happened');
});

$(document).on('change paste keyup select','#price_2',function(){
  //alert('Change Happened');
});

$(document).on("focusout", ".quantity", function () {
  var counter = $(this).data("counter");
  calculation(counter);
});

$(document).on("focusout", ".discount", function () {
  var counter = $(this).data("counter");
  calculation(counter);
});

$(document).on("focusout", ".tax_change", function () {
  var counter = $(this).data("counter");
  calculation(counter);
});


$(document).on("focusout", ".tax_change2", function () {
  // var counter = $(this).data("counter");
  var counter = $(this).attr('data-itemid');
  // alert(counter);
  //calculation(counter);
  var price = $("#price_" + counter).val();
  var quantity = $("#quantity_" + counter).val();
  var discount = $("#discount_" + counter).val();
  var rate_val = this.value;
  // alert(rate_val);
  var tax = (parseFloat(price) * parseFloat(rate_val)) / 100;
  var tax1 = (((parseFloat(price) * parseFloat(rate_val)) / 100) * parseFloat(quantity)).toFixed(
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
  $("#grand_total_input").val(grand_total_w.toFixed(2)).trigger('change');
  $("#grand_total_inputs").val(grand_total_w.toFixed(2));
  $("#payment_amount").val(grand_total_w.toFixed(2));

  var sls = (parseFloat(eqpt_cost).toFixed(2) * 7.5) / 100;
  sls = parseFloat(sls).toFixed(2);
  $("#sales_tax").val(sls);
  cal_total_due();
});

// option2 data
$(document).on("focusout", ".price2", function () {
  var counter = $(this).data("counter");
  calculation2(counter);
});


$(document).on("focusout", ".quantity2", function () {
  var counter = $(this).data("counter");
  calculation2(counter);
});
$(document).on("focusout", ".discount2", function () {
  var counter = $(this).data("counter");
  calculation2(counter);
});


$(".select_item3").click(function () {
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
  var total = parseFloat(total_).toFixed(2);
  var tax_ =(parseFloat(total_).toFixed(2) * 7.5) / 100;
  var taxes_t = parseFloat(tax_).toFixed(2);
  var withCommas = Number(total).toLocaleString('en');
  total = '$' + withCommas + '.00';
  // console.log(total);
  // alert(total);
  markup = "<tr id=\"ss\">" +
      "<td width=\"35%\"><input value='"+title+"' type=\"text\" name=\"items[]\" class=\"form-control\" ><input type=\"hidden\" value='"+idd+"' name=\"item_id[]\"></td>\n" +
      "<td width=\"20%\"><select name=\"item_type[]\" class=\"form-control\"><option value=\"product\">Product</option><option value=\"material\">Material</option><option value=\"service\">Service</option><option value=\"fee\">Fee</option></select></td>\n" +
      "<td width=\"10%\"><input data-itemid='"+idd+"' id='quantity_"+idd+"' value='"+qty+"' type=\"number\" name=\"quantity[]\" data-counter='"+count+"'  min=\"0\" class=\"form-control qtyest\"></td>\n" +
      // "<td>\n" + '<input type="number" class="form-control qtyest" name="quantity[]" data-counter="' + count + '" id="quantity_' + count + '" min="1" value="1">\n' + "</td>\n" +
      "<td width=\"10%\"><input id='price_"+idd+"' value='"+price+"'  type=\"number\" name=\"price[]\" data-counter='"+count+"' class=\"form-control\" placeholder=\"Unit Price\"></td>\n" +
      // "<td width=\"10%\"><input type=\"number\" class=\"form-control discount\" name=\"discount[]\" data-counter="0" id=\"discount_0\" min="0" value="0" ></td>\n" +
      // "<td width=\"10%\"><small>Unit Cost</small><input type=\"text\" name=\"item_cost[]\" class=\"form-control\"></td>\n" +
      "<td width=\"10%\"><input type=\"number\" name=\"discount[]\" class=\"form-control discount\" data-counter='"+count+"' id='discount_"+idd+"' readonly></td>\n" +
      // "<td width=\"25%\"><small>Inventory Location</small><input type=\"text\" name=\"item_loc[]\" class=\"form-control\"></td>\n" +
      "<td width=\"20%\"><input type=\"text\" data-itemid='"+idd+"' class=\"form-control tax_change2\" name=\"tax[]\" data-counter=\"0\" id='tax1_"+idd+"' min=\"0\" value='"+taxes_t+"'></td>\n" +
      "<td style=\"text-align: center\" class=\"d-flex\" width=\"15%\"><span data-subtotal='"+total_+"' id='span_total_"+idd+"' class=\"total_per_item\">"+total+
      // "</span><a href=\"javascript:void(0)\" class=\"remove_item_row\"><i class=\"fa fa-times-circle\" aria-hidden=\"true\"></i></a>"+
      "<input type=\"hidden\" name=\"total[]\" id='sub_total_text"+idd+"' value='"+total+"'></td>" +
      "<td>\n" +
      "<a href=\"#\" class=\"remove btn btn-sm btn-success\" id='"+idd+"'><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></a>\n" +
      "</td>\n" +
      "</tr>";
  tableBody = $("#items_table_body3a");
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
$("#grand_total_input").val(grand_total_w.toFixed(2)).trigger('change');
$("#grand_total_inputs").val(grand_total_w.toFixed(2));
$("#payment_amount").val(grand_total_w.toFixed(2));

var sls = (parseFloat(eqpt_cost).toFixed(2) * 7.5) / 100;
sls = parseFloat(sls).toFixed(2);
$("#sales_tax").val(sls);
cal_total_due();
});


$(".select_item2").click(function () {
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
  var total = parseFloat(total_).toFixed(2);
  var tax_ =(parseFloat(total_).toFixed(2) * 7.5) / 100;
  var taxes_t = parseFloat(tax_).toFixed(2);
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
      "<td width=\"20%\"><input type=\"text\" data-itemid='"+idd+"' class=\"form-control tax_change2\" name=\"tax[]\" data-counter=\"0\" id='tax1_"+idd+"' min=\"0\"  value='"+taxes_t+"'></td>\n" +
      "<td style=\"text-align: center\" class=\"d-flex\" width=\"15%\"><span data-subtotal='"+total_+"' id='span_total_"+idd+"' class=\"total_per_item\">"+total+
      // "</span><a href=\"javascript:void(0)\" class=\"remove_item_row\"><i class=\"fa fa-times-circle\" aria-hidden=\"true\"></i></a>"+
      "<input type=\"hidden\" name=\"total[]\" id='sub_total_text"+idd+"' value='"+total+"'></td>" +
      "<td>\n" +
      "<a href=\"#\" class=\"remove btn btn-sm btn-success\" id='"+idd+"'><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></a>\n" +
      "</td>\n" +
      "</tr>";
  tableBody = $("#items_table_body2a");
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
$("#grand_total_input").val(grand_total_w.toFixed(2)).trigger('change');
$("#grand_total_inputs").val(grand_total_w.toFixed(2));
$("#payment_amount").val(grand_total_w.toFixed(2));

var sls = (parseFloat(eqpt_cost).toFixed(2) * 7.5) / 100;
sls = parseFloat(sls).toFixed(2);
$("#sales_tax").val(sls);
cal_total_due();
});


$(".select_item").click(function () {
  //
  // alert('testing');
            var idd = this.id;
            //console.log(idd);
            //console.log($(this).data('itemname'));
            var title = $(this).data('itemname');
            var price = $(this).data('price');
            
            if(!$(this).data('quantity')){
              // alert($(this).data('quantity'));
              var qty = 1;
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
                "<td width=\"35%\"><input value='"+title+"' type=\"text\" name=\"items[]\" class=\"form-control getItems\" ><input type=\"hidden\" value='"+idd+"' name=\"item_id[]\"><div class=\"show_mobile_view\"><span class=\"getItems_hidden\">"+title+"</span></div><input type=\"hidden\" name=\"itemid[]\" id=\"itemid\" class=\"itemid\" value='"+idd+"'><input type=\"hidden\" name=\"packageID[]\" value=\"0\"></td>\n" +
                "<td width=\"20%\"><div class=\"dropdown-wrapper\"><select name=\"item_type[]\" class=\"form-control\"><option value=\"product\">Product</option><option value=\"material\">Material</option><option value=\"service\">Service</option><option value=\"fee\">Fee</option></select></div></td>\n" +
                "<td width=\"10%\"><input data-itemid='"+idd+"' id='quantity_"+count+"' value='"+qty+"' type=\"number\" name=\"quantity[]\" data-counter='"+count+"'  min=\"0\" class=\"form-control quantity mobile_qty \"></td>\n" +
                // "<td>\n" + '<input type="number" class="form-control qtyest" name="quantity[]" data-counter="' + count + '" id="quantity_' + count + '" min="1" value="1">\n' + "</td>\n" +
                "<td width=\"10%\"><input data-itemid='"+idd+"' id='price_"+count+"' value='"+price+"'  type=\"number\" name=\"price[]\" data-counter='"+count+"' class=\"form-control price hidden_mobile_view\" placeholder=\"Unit Price\"><input type=\"hidden\" class=\"priceqty\" id='priceqty_"+idd+"'><div class=\"show_mobile_view\"><span class=\"price\">"+price+"</span></div></td>\n" +
                // "<td width=\"10%\"><input type=\"number\" class=\"form-control discount\" name=\"discount[]\" data-counter="0" id=\"discount_0\" min="0" value="0" ></td>\n" +
                // "<td width=\"10%\"><small>Unit Cost</small><input type=\"text\" name=\"item_cost[]\" class=\"form-control\"></td>\n" +
                "<td width=\"10%\" class=\"hidden_mobile_view\"><input type=\"number\" name=\"discount[]\" value=\"0\" class=\"form-control discount\" data-counter='"+count+"' id='discount_"+count+"'></td>\n" +
                // "<td width=\"25%\"><small>Inventory Location</small><input type=\"text\" name=\"item_loc[]\" class=\"form-control\"></td>\n" +
                "<td width=\"20%\" class=\"hidden_mobile_view\"><input type=\"text\" data-itemid='"+idd+"' class=\"form-control tax_change\" name=\"tax[]\" data-counter='"+count+"' id='tax1_"+count+"'  min=\"0\" value='"+taxes_t+"'></td>\n" +
                "<td style=\"text-align: center\" class=\"hidden_mobile_view\" width=\"15%\"><span data-subtotal='"+total_+"' id='span_total_"+count+"' class=\"total_per_item\">"+total+
                // "</span><a href=\"javascript:void(0)\" class=\"remove_item_row\"><i class=\"fa fa-times-circle\" aria-hidden=\"true\"></i></a>"+
                "</span> <input type=\"hidden\" name=\"total[]\" id='sub_total_text"+count+"' value='"+total+"'></td>" +
                "<td>\n" +
                "<a href=\"#\" class=\"remove nsm-button danger\" id='"+idd+"'><i class=\"bx bx-fw bx-trash\"></i></a>\n" +
                "</td>\n" +
                "</tr>";
            tableBody = $("#jobs_items_table_body");
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
  calculation(count);
  // taxRate();
});


$("#createNewItem").click(function () {
  //
  // alert('testing');
            var idd = 0;
            //console.log(idd);
            //console.log($(this).data('itemname'));
            var title = $(this).data('itemname');
            var price = 0;
            
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
                "<td width=\"35%\"><input value=\"\" type=\"text\" name=\"temp_items[]\" class=\"form-control getItems\" ><input type=\"hidden\" value='"+idd+"' name=\"temp_item_id[]\"><div class=\"show_mobile_view\"><span class=\"getItems_hidden\"></span></div><input type=\"hidden\" name=\"temp_itemid[]\" id=\"itemid\" class=\"itemid\" value='"+idd+"'><input type=\"hidden\" name=\"temp_packageID[]\" value=\"0\"> <input type=\"checkbox\" value=\"1\" name=\"saveForFuture[]\"> Save the item for future reference </td>\n" +
                "<td width=\"20%\"><div class=\"dropdown-wrapper\"><select name=\"temp_item_type[]\" class=\"form-control\"><option value=\"product\">Product</option><option value=\"material\">Material</option><option value=\"service\">Service</option><option value=\"fee\">Fee</option></select></div></td>\n" +
                "<td width=\"10%\"><input data-itemid='"+idd+"' id='quantity_"+count+"' value='"+qty+"' type=\"number\" name=\"temp_quantity[]\" data-counter='"+count+"'  min=\"0\" class=\"form-control quantity mobile_qty \"></td>\n" +
                // "<td>\n" + '<input type="number" class="form-control qtyest" name="quantity[]" data-counter="' + count + '" id="quantity_' + count + '" min="1" value="1">\n' + "</td>\n" +
                "<td width=\"10%\"><input data-itemid='"+idd+"' id='price_"+count+"' value=\"0\"  type=\"number\" name=\"temp_price[]\" data-counter='"+count+"' class=\"form-control price hidden_mobile_view\" placeholder=\"Unit Price\"><input type=\"hidden\" class=\"priceqty\" id='priceqty_"+idd+"'><div class=\"show_mobile_view\"><span class=\"price\"></span></div></td>\n" +
                // "<td width=\"10%\"><input type=\"number\" class=\"form-control discount\" name=\"discount[]\" data-counter="0" id=\"discount_0\" min="0" value="0" ></td>\n" +
                // "<td width=\"10%\"><small>Unit Cost</small><input type=\"text\" name=\"item_cost[]\" class=\"form-control\"></td>\n" +
                "<td width=\"10%\" class=\"hidden_mobile_view\"><input type=\"number\" name=\"temp_discount[]\" value=\"0\" class=\"form-control discount\" data-counter='"+count+"' id='discount_"+count+"'></td>\n" +
                // "<td width=\"25%\"><small>Inventory Location</small><input type=\"text\" name=\"item_loc[]\" class=\"form-control\"></td>\n" +
                "<td width=\"20%\" class=\"hidden_mobile_view\"><input type=\"text\" data-itemid='"+idd+"' class=\"form-control tax_change\" name=\"temp_tax[]\" data-counter='"+count+"' id='tax1_"+count+"' readonly min=\"0\" value='"+taxes_t+"'></td>\n" +
                "<td style=\"text-align: center\" class=\"hidden_mobile_view\" width=\"15%\"><span data-subtotal='"+total_+"' id='span_total_"+count+"' class=\"total_per_item\">"+total+
                // "</span><a href=\"javascript:void(0)\" class=\"remove_item_row\"><i class=\"fa fa-times-circle\" aria-hidden=\"true\"></i></a>"+
                "</span> <input type=\"hidden\" name=\"temp_total[]\" id='sub_total_text"+count+"' value='"+total+"'></td>" +
                "<td>\n" +
                "<a href=\"#\" class=\"remove nsm-button danger\" id='"+idd+"'><i class=\"bx bx-fw bx-trash\"></i></a>\n" +
                "</td>\n" +
                "</tr>";
            tableBody = $("#jobs_items_table_body");
            tableBody.append(markup);
            markup2 = "<tr id=\"sss\">" +
                "<td ></td>\n" +
                "<td ></td>\n" +
                "<td ></td>\n" +
                "<td ></td>\n" +
                "<td ></td>\n" +
                "<td >"+qty+"</td>\n" +
                "<td ></td>\n" +
                "<td ></td>\n" +
                "<td >0</td>\n" +
                "<td ></td>\n" +
                "<td ><a href=\"#\" data-name=\"\" data-price=\"\" data-quantity='"+qty+"' id='"+idd+"' class=\"edit_item_list\"><span class=\"fa fa-edit\"></span></i></a> <a href=\"javascript:void(0)\" class=\"remove_audit_item_row\"><span class=\"fa fa-trash\"></span></i></a></td>\n" +
                "</tr>";
            tableBody2 = $("#device_audit_datas");
            tableBody2.append(markup2);
            // calculate_subtotal();
            // var counter = $(this).data("counter");
            // calculation(idd);
  calculation(count);
});


$(".select_itemEstimate").click(function () {
  //
            var idd = this.id;
            //console.log(idd);
            //console.log($(this).data('itemname'));
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
                "<td width=\"35%\"><input value='"+title+"' type=\"text\" name=\"items[]\" class=\"form-control getItems\" ><input type=\"hidden\" value='"+idd+"' name=\"item_id[]\"><div class=\"show_mobile_view\"><span class=\"getItems_hidden\">"+title+"</span></div><input type=\"hidden\" name=\"itemid[]\" id=\"itemid\" class=\"itemid\" value='"+idd+"'><input type=\"hidden\" name=\"packageID[]\" value=\"0\"></td>\n" +
                "<td width=\"20%\"><div class=\"dropdown-wrapper\"><select name=\"item_type[]\" class=\"form-control\"><option value=\"product\">Product</option><option value=\"material\">Material</option><option value=\"service\">Service</option><option value=\"fee\">Fee</option></select></div></td>\n" +
                "<td width=\"10%\"><input data-itemid='"+idd+"' id='quantity_"+count+"' value='"+qty+"' type=\"number\" name=\"quantity[]\" data-counter='"+count+"'  min=\"0\" class=\"form-control quantity mobile_qty \"></td>\n" +
                // "<td>\n" + '<input type="number" class="form-control qtyest" name="quantity[]" data-counter="' + count + '" id="quantity_' + count + '" min="1" value="1">\n' + "</td>\n" +
                "<td width=\"10%\"><input data-itemid='"+idd+"' id='price_"+count+"' value='"+price+"'  type=\"number\" name=\"price[]\" data-counter='"+count+"' class=\"form-control price hidden_mobile_view\" placeholder=\"Unit Price\"><input type=\"hidden\" class=\"priceqty\" id='priceqty_"+idd+"'><div class=\"show_mobile_view\"><span class=\"price\">"+price+"</span></div></td>\n" +
                // "<td width=\"10%\"><input type=\"number\" class=\"form-control discount\" name=\"discount[]\" data-counter="0" id=\"discount_0\" min="0" value="0" ></td>\n" +
                // "<td width=\"10%\"><small>Unit Cost</small><input type=\"text\" name=\"item_cost[]\" class=\"form-control\"></td>\n" +
                "<td width=\"10%\" class=\"hidden_mobile_view\"><input type=\"number\" name=\"discount[]\" value=\"0\" class=\"form-control discount\" data-counter='"+count+"' id='discount_"+count+"'></td>\n" +
                // "<td width=\"25%\"><small>Inventory Location</small><input type=\"text\" name=\"item_loc[]\" class=\"form-control\"></td>\n" +
                "<td width=\"20%\" class=\"hidden_mobile_view\"><input type=\"text\" data-itemid='"+idd+"' class=\"form-control tax_change\" name=\"tax[]\" data-counter='"+count+"' id='tax1_"+count+"' readonly min=\"0\" value='"+taxes_t+"'></td>\n" +
                "<td style=\"text-align: center\" class=\"hidden_mobile_view\" width=\"15%\"><span data-subtotal='"+total_+"' id='span_total_"+count+"' class=\"total_per_item\">"+total+
                // "</span><a href=\"javascript:void(0)\" class=\"remove_item_row\"><i class=\"fa fa-times-circle\" aria-hidden=\"true\"></i></a>"+
                "</span> <input type=\"hidden\" name=\"total[]\" id='sub_total_text"+count+"' value='"+total+"'></td>" +
                "<td>\n" +
                "<a href=\"#\" class=\"remove nsm-button danger\" id='"+idd+"'><i class=\"bx bx-fw bx-trash\"></i></a>\n" +
                "</td>\n" +
                "</tr>";
            tableBody = $("#jobs_items_table_bodyEstimate");
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
  calculation(count);
});

$(".select_itemnew").click(function () {
  var idd = this.id;
  //console.log(idd);
  //console.log($(this).data('itemname'));
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
      "<td width=\"35%\"><input value='"+title+"' type=\"text\" name=\"items[]\" class=\"form-control getItems\" ><input type=\"hidden\" value='"+idd+"' name=\"item_id[]\"><div class=\"show_mobile_view\"><span class=\"getItems_hidden\">"+title+"</span></div><input type=\"hidden\" name=\"itemid[]\" id=\"itemid\" class=\"itemid\" value='"+idd+"'><input type=\"hidden\" name=\"packageID[]\" value=\"0\"></td>\n" +
      "<td width=\"10%\"><input data-itemid='"+idd+"' id='quantity_"+count+"' value='"+qty+"' type=\"number\" name=\"quantity[]\" data-counter='"+count+"'  min=\"0\" class=\"form-control quantity mobile_qty \"></td>\n" +
      // "<td>\n" + '<input type="number" class="form-control qtyest" name="quantity[]" data-counter="' + count + '" id="quantity_' + count + '" min="1" value="1">\n' + "</td>\n" +
      "<td width=\"20%\"><input data-itemid='"+idd+"' id='price_"+count+"' value='"+price+"'  type=\"number\" name=\"price[]\" data-counter='"+count+"' class=\"form-control price hidden_mobile_view\" placeholder=\"Unit Price\"><input type=\"hidden\" class=\"priceqty\" id='priceqty_"+idd+"'><div class=\"show_mobile_view\"><span class=\"price\">"+price+"</span></div></td>\n" +
      // "<td width=\"10%\"><input type=\"number\" class=\"form-control discount\" name=\"discount[]\" data-counter="0" id=\"discount_0\" min="0" value="0" ></td>\n" +
      // "<td width=\"10%\"><small>Unit Cost</small><input type=\"text\" name=\"item_cost[]\" class=\"form-control\"></td>\n" +
      "<td width=\"10%\" class=\"hidden_mobile_view\"><input type=\"number\" name=\"discount[]\" value=\"0\" class=\"form-control discount\" data-counter='"+count+"' id='discount_"+count+"'></td>\n" +
      // "<td width=\"25%\"><small>Inventory Location</small><input type=\"text\" name=\"item_loc[]\" class=\"form-control\"></td>\n" +
      "<td width=\"10%\" class=\"hidden_mobile_view\"><input type=\"text\" data-itemid='"+idd+"' class=\"form-control tax_change\" name=\"tax[]\" data-counter='"+count+"' id='tax1_"+count+"' readonly min=\"0\" value='"+taxes_t+"'></td>\n" +
      "<td style=\"text-align: center\" class=\"hidden_mobile_view\" width=\"15%\"><span data-subtotal='"+total_+"' id='span_total_"+count+"' class=\"total_per_item\">"+total+
      // "</span><a href=\"javascript:void(0)\" class=\"remove_item_row\"><i class=\"fa fa-times-circle\" aria-hidden=\"true\"></i></a>"+
      "</span> <input type=\"hidden\" name=\"total[]\" id='sub_total_text"+count+"' value='"+total+"'></td>" +
      "<td>\n" +
      "<a href=\"#\" class=\"remove btn btn-sm btn-success\" id='"+idd+"'><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></a>\n" +
      "</td>\n" +
      "</tr>";
  tableBody = $("#jobs_items_table_body");
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
calculation(count);
});

$(".select_item_package").click(function () {
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
      "<td width=\"35%\"><input value='"+title+"' type=\"text\" name=\"items[]\" class=\"form-control getItems\" ><input type=\"hidden\" value='"+idd+"' name=\"item_id[]\"><div class=\"show_mobile_view\"><span class=\"getItems_hidden\">"+title+"</span></div><input type=\"hidden\" name=\"itemidPackage[]\" id=\"itemidPackage\" class=\"itemid\" value='"+idd+"'></td>\n" +
      "<td width=\"25%\"><div class=\"dropdown-wrapper\"><select name=\"item_typePackage[]\" class=\"form-control\"><option value=\"product\">Product</option><option value=\"material\">Material</option><option value=\"service\">Service</option><option value=\"fee\">Fee</option></select></div></td>\n" +
      "<td width=\"\"><input data-itemid='"+idd+"' id='quantity_package_"+idd+"' value='"+qty+"' type=\"number\" name=\"quantityPackage[]\" data-counter=\"0\"  min=\"0\" class=\"form-control quantityPackage2\"></td>\n" +
      // "<td>\n" + '<input type="number" class="form-control qtyest" name="quantity[]" data-counter="' + count + '" id="quantity_' + count + '" min="1" value="1">\n' + "</td>\n" +
      "<td width=\"\"><input data-itemid='"+idd+"' id='price_package_"+idd+"' value='"+price+"'  type=\"number\" name=\"pricePackage[]\" class=\"form-control price_package2 hidden_mobile_view\" placeholder=\"Unit Price\"><input type=\"hidden\" class=\"priceqty\" id='priceqtypackage_"+idd+"' value='"+total_+"'><div class=\"show_mobile_view\"><span class=\"price\">"+price+"</span></div></td>\n" +
      // "<td width=\"10%\"><input type=\"number\" class=\"form-control discount\" name=\"discount[]\" data-counter="0" id=\"discount_0\" min="0" value="0" ></td>\n" +
      // "<td width=\"10%\"><small>Unit Cost</small><input type=\"text\" name=\"item_cost[]\" class=\"form-control\"></td>\n" +
      // "<td width=\"10%\" class=\"hidden_mobile_view\"><input type=\"number\" name=\"discount[]\" class=\"form-control discount\" id='discount_"+idd+"' readonly></td>\n" +
      // "<td width=\"25%\"><small>Inventory Location</small><input type=\"text\" name=\"item_loc[]\" class=\"form-control\"></td>\n" +
      // "<td width=\"20%\" class=\"hidden_mobile_view\"><input type=\"text\" data-itemid='"+idd+"' class=\"form-control tax_change2\" name=\"tax[]\" data-counter=\"0\" id='tax1_"+idd+"' min=\"0\" value='"+taxes_t+"'></td>\n" +
      // "<td style=\"text-align: center\" class=\"hidden_mobile_view\" width=\"15%\"><span data-subtotal='"+total_+"' id='span_total_"+idd+"' class=\"total_per_item\">"+total+
      // "</span><a href=\"javascript:void(0)\" class=\"remove_item_row\"><i class=\"fa fa-times-circle\" aria-hidden=\"true\"></i></a>"+
      // "</span> <input type=\"hidden\" name=\"total[]\" id='sub_total_text"+idd+"' value='"+total+"'></td>" +
      "<td>\n" +
      "<a href=\"#\" class=\"remove btn btn-sm btn-success\" id='"+idd+"'><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></a>\n" +
      "</td>\n" +
      "</tr>";
  tableBody = $("#items_package_table");
  tableBody.append(markup);
  markup2 = "<tr id=\"sss\">" +
      "<td >"+title+"</td>\n" +
      "<td ></td>\n" +
      "<td ></td>\n" +
      "<td >"+price+"</td>\n" +
      "<td ></td>\n" +
      "<td >"+qty+"</td>\n" +
      "<td ></td>\n" +
      // "<td ></td>\n" +
      // "<td >0</td>\n" +
      // "<td ></td>\n" +
      "<td ><a href=\"#\" data-name='"+title+"' data-price='"+price+"' data-quantity='"+qty+"' id='"+idd+"' class=\"edit_item_list\"><span class=\"fa fa-edit\"></span></i></a> <a href=\"javascript:void(0)\" class=\"remove_audit_item_row\"><span class=\"fa fa-trash\"></span></i></a></td>\n" +
      "</tr>";
  tableBody2 = $("#device_audit_datas");
  tableBody2.append(markup2);
  // calculate_subtotal();
  // var counter = $(this).data("counter");
  // calculation(idd);

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

var total_cost = 0;
// $("#span_total_0").each(function(){
$('*[id^="priceqtypackage_"]').each(function(){
total_cost += parseFloat($(this).val());
});

$("#package_price").val(total_cost.toFixed(2));

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
});


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
  $("#grand_total_input").val(s_grandtotal.toFixed(2)).trigger('change');
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
  $("#grand_total_input").val(s_grandtotal.toFixed(2)).trigger('change');
  // $("#grand_total_inputs").val(s_grandtotal.toFixed(2));
  $("#payment_amount").val(s_grandtotal.toFixed(2));
  
});


        // $("body").delegate(".qtyest", "keyup", function(){
        //     //console.log( "Handler for .keyup() called." );
        //     var id = this.id;
        //     var qty=this.value;
        //     var cost = $('#price'+id).val();
        //     var new_sub_total = Number(qty) * Number(cost);
        //     $('#sub_total'+id).data('subtotal',new_sub_total);
        //     $('#sub_total'+id).text('$' + formatNumber(new_sub_total));
        //     calculate_subtotal();
        // });
        $(document).on("focusout", ".qtyest", function () {
        // alert('yeah');
        var id = this.id;
        var in_id = $(this).attr('data-itemid');
            var qty=this.value;
            var cost = $('#price'+id).val();
            var new_sub_total = Number(qty) * Number(cost);
            var new_sub_total_val = Number(qty) * Number(cost);
            var tax = '0.075';
            var new_sub_total_tax =  new_sub_total * tax;
            // $('#sub_total'+id).data('subtotal',new_sub_total);
            // $('#sub_total'+id).text('$' + formatNumber(new_sub_total));
            $("#span_total_"+id).text(new_sub_total.toFixed(2));
            // $("#sub_total_text" + id).val(new_sub_total.toFixed(2));
            $("#sub_total_text"+id).val(new_sub_total.toFixed(2));
            // $(".total_per_item").text(new_sub_total_tax.toFixed(2));
            var counter = $(this).data("counter");
            // var counter = jQuery(obj)
            // .parent()
            // .parent()
            // .parent()
            // .find(".price")
            // .data("counter");
            // calculate_subtotal();

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
  $("#tax_1_" + in_id).val(tax1);
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

  // alert(subtotal);

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
  $("#grand_total_input").val(grand_total_w.toFixed(2)).trigger('change');
  $("#grand_total_inputs").val(grand_total_w.toFixed(2));
  $("#payment_amount").val(grand_total_w.toFixed(2));

  var sls = (parseFloat(eqpt_cost).toFixed(2) * 7.5) / 100;
  sls = parseFloat(sls).toFixed(2);
  $("#sales_tax").val(sls);
  cal_total_due();
            // calculation(id);
        });

        // function calculate_subtotal(tax=0){
        //     var subtotal = 0 ;
        //     $('.total_per_item').each(function(index) {
        //         var idd = $(this).data('subtotal');
        //         // var idd = this.id;
        //         subtotal = Number(subtotal) + Number(idd);
        //     });
        //     var total = parseFloat(subtotal).toFixed(2);
        //     var tax_total=0;
        //     if(tax !== 0 || tax !== ''){
        //         tax_total = Number(total) *  Number(tax);
        //         total = Number(total) - Number(tax_total);
        //         total = parseFloat(total).toFixed(2);
        //         tax_total =  parseFloat(tax_total).toFixed(2);
        //         var tax_with_comma = Number(tax_total).toLocaleString('en');
        //         $('#invoice_tax_total').html('$' + tax_with_comma);
        //     }
        //     var withCommas = Number(total).toLocaleString('en');
        //     if(tax_total < 1){
        //         $('#invoice_sub_total').html('$' + formatNumber(total));
        //     }
        //     $('#invoice_overall_total').html('$' + formatNumber(total));
        //     $('#pay_amount').val(withCommas);
        // }




function calculation_x(counter) {
  // alert('calc 1');
  var price = $("#price_" + counter).val();
  var quantity = $("#quantity_" + counter).val();
  var discount = $("#discount_" + counter).val()
    ? $("#discount_" + counter).val()
    : 0;
  var tax = (parseFloat(price) * 7.5) / 100;
  var tax1 = (((parseFloat(price) * 7.5) / 100) * parseFloat(quantity)).toFixed(
    2
  );
  var total = (
    (parseFloat(price) + parseFloat(tax)) * parseFloat(quantity) -
    parseFloat(discount)
  ).toFixed(2);

  $("#span_total_" + counter).text(total);
  $("#total_" + counter).val(total);
  $("#span_tax_" + counter).text(tax1);
  $("#tax1_" + counter).val(tax1);
  // $("#tax1_" + counter).val(tax1);
  // $("#tax_" + counter).val(tax1);
  // alert(tax1);

  if( $('#tax_'+ counter).length ){
    $('#tax_'+counter).val(tax1);
  }

  if( $('#item_total_'+ counter).length ){
    $('#item_total_'+counter).val(total);
  }

  var eqpt_cost = 0;
  var subtotal = 0;
  var adjustment_amount = 0;
  var cnt = $("#count").val();

  if (
    $("#adjustment_input").val() &&
    $("#adjustment_input").val().toString().length > 1
  ) {
    adjustment_amount = $("#adjustment_input").val().substr(1);
  }
  for (var p = 0; p <= cnt; p++) {
    var prc = $("#price_" + p).val();
    var quantity = $("#quantity_" + p).val();
    // var discount= $('#discount_' + p).val();
    // eqpt_cost += parseFloat(prc) - parseFloat(discount);
    subtotal += parseFloat($("#span_total_" + p).text());
    eqpt_cost += parseFloat(prc) * parseFloat(quantity);
  }

  $("#adjustment_amount").text(parseFloat(adjustment_amount));
  $("#adjustment_amount_form_input").val(parseFloat(adjustment_amount));
  $("#invoice_sub_total").text(subtotal.toFixed(2));
  $("#sub_total_form_input").val(subtotal.toFixed(2));

  $("#span_sub_total_0").text(subtotal.toFixed(2));

  var grandTotal = eval(
    $("#invoice_sub_total").text() + $("#adjustment_input").val()
  );
  $("#invoice_grand_total").text(parseFloat(grandTotal).toFixed(2));
  $("#grand_total_form_input").val(parseFloat(grandTotal).toFixed(2));

  eqpt_cost = parseFloat(eqpt_cost).toFixed(2);
  $("#eqpt_cost").val(eqpt_cost);

  // alert('dri');
  // grand_total_input

  if($("#grand_total").length && $("#grand_total").val().length)
  {
    // console.log('none');
    // alert('none');
  }else{
    $("#grand_total").text(grand_total_w.toFixed(2));
    $("#grand_total_input").val(grand_total_w.toFixed(2)).trigger('change');
    $("#grand_total_inputs").val(grand_total_w.toFixed(2));
    $("#payment_amount").val(grand_total_w.toFixed(2));
    $("#balanceDueText").text(grand_total_w.toFixed(2));

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
//   var price = $("#price_" + counter).val();
//   var quantity = $("#quantity_" + counter).val();
//   var discount = $("#discount_" + counter).val();
//   var tax = (parseFloat(price) * 7.5) / 100;
//   var tax1 = (((parseFloat(price) * 7.5) / 100) * parseFloat(quantity)).toFixed(
//     2
//   );
//   if( discount == '' ){
//     discount = 0;
//   }
  
//   var total = (
//     (parseFloat(price) + parseFloat(tax)) * parseFloat(quantity) -
//     parseFloat(discount)
//   ).toFixed(2);

//   // alert( 'yeah' + total);

//   $("#span_total_" + counter).text(total);
//   $("#tax_1_" + counter).text(tax1);
//   $("#tax_111_" + counter).text(tax1);
//   $("#tax_1_" + counter).val(tax1);
//   $("#discount_" + counter).val(discount);
//   $("#tax1_" + counter).val(tax1);
//   // $("#tax1_" + counter).val(tax1);
//   // $("#tax_" + counter).val(tax1);
//   // alert(tax1);

//   if( $('#tax_1_'+ counter).length ){
//     $('#tax_1_'+counter).val(tax1);
//   }

//   if( $('#item_total_'+ counter).length ){
//     $('#item_total_'+counter).val(total);
//   }

//   // alert('dri');

//   var eqpt_cost = 0;
//   var total_cost = 0;
//   var cnt = $("#count").val();
//   var total_discount = 0;
//   var pquantity  = 0;
//   for (var p = 0; p <= cnt; p++) {
//     var prc = $("#price_" + p).val();
//     var quantity = $("#quantity_" + p).val();
//     var discount = $("#discount_" + p).val();
//     var pqty = $("#priceqty_" + p).val();
//     // var discount= $('#discount_' + p).val();
//     // eqpt_cost += parseFloat(prc) - parseFloat(discount);
//     pquantity += parseFloat(pqty);
//     total_cost += parseFloat(prc);
//     eqpt_cost += parseFloat(prc) * parseFloat(quantity);
//     total_discount += parseFloat(discount);
//   }
// //   var subtotal = 0;
// // $( total ).each( function(){
// //   subtotal += parseFloat( $( this ).val() ) || 0;
// // });

//   eqpt_cost = parseFloat(eqpt_cost).toFixed(2);
//   total_discount = parseFloat(total_discount).toFixed(2);
//   stotal_cost = parseFloat(total_cost).toFixed(2);
//   priceqty = parseFloat(pquantity).toFixed(2);
//   // var test = 5;

//   var subtotal = 0;
//   // $("#span_total_0").each(function(){
//     $('*[id^="span_total_"]').each(function(){
//     subtotal += parseFloat($(this).text());
//   });
//   // $('#sum').text(subtotal);

//   var subtotaltax = 0;
//   // $("#span_total_0").each(function(){
//     $('*[id^="tax_1_"]').each(function(){
//       subtotaltax += parseFloat($(this).text());
//   });

//   // alert(subtotaltax);
//   // var priceqty = 0;
//   //   $('*[id^="priceqty_"]').each(function(){
//   //     priceqty += parseFloat($(this).text());
//   // });
//   // alert(priceqty);

//   $("#span_sub_total_invoice").text(priceqty);

//   $("#item_total").val(stotal_cost);
//   $("#item_total_text").html(stotal_cost);
  
//   $("#eqpt_cost").val(eqpt_cost);
//   $("#total_discount").val(total_discount);
//   $("#span_sub_total_0").text(total_discount);
//   $("#span_sub_total_invoice").text(stotal_cost);
//   // $("#item_total").val(subtotal.toFixed(2));
  
//   var s_total = subtotal.toFixed(2);
//   var adjustment = $("#adjustment_input").val();
//   var grand_total = s_total - parseFloat(adjustment);
//   var markup = $("#markup_input_form").val();
//   var grand_total_w = grand_total + parseFloat(markup);

//   $("#total_tax_").text(subtotaltax.toFixed(2));
//   $("#total_tax_input").val(subtotaltax.toFixed(2));
  

//   $("#grand_total").text(grand_total_w.toFixed(2));
//   $("#grand_total_input").val(grand_total_w.toFixed(2));
//   $("#grand_total_inputs").val(grand_total_w.toFixed(2));
//   $("#grandtotal_input").val(grand_total_w.toFixed(2));
  

//   if($("#grand_total").length && $("#grand_total").val().length)
//   {
//     // console.log('none');
//     // alert('none');
//   }else{
//     $("#grand_total").text(grand_total_w.toFixed(2));
//     $("#grand_total_input").val(grand_total_w.toFixed(2));
//     $("#grand_total_inputs").val(grand_total_w.toFixed(2));

//     var bundle1_total = $("#grand_total").text();
//     var bundle2_total = $("#grand_total2").text();
//     var super_grand = parseFloat(bundle1_total) + parseFloat(bundle2_total);

//     $("#supergrandtotal").text(super_grand.toFixed(2));
//     $("#supergrandtotal_input").val(super_grand.toFixed(2));
//   }

//   var sls = (parseFloat(eqpt_cost).toFixed(2) * 7.5) / 100;
//   sls = parseFloat(sls).toFixed(2);
//   $("#sales_taxs").val(sls);
//   $("#total_tax_").html(sls);
//   $("#total_tax_input").val(sls);
//   cal_total_due();
}
function getplanItems(pid) {
  var site_url = jQuery("#siteurl").val();
  jQuery.ajax({
    url: site_url + "plans/getitems",
    data: { pid: pid },
    type: "GET",
    success: function (data) {
      jQuery("#plansItemDiv").empty().html(data);
    },
    error: function () {
      alert("An error has occurred");
    },
  });
}
function getItems(obj) {
  var sk = jQuery(obj).val();
  var site_url = jQuery("#siteurl").val();
  jQuery.ajax({
    url: site_url + "items/getitems",
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
function setitem(obj, title, price, discount, itemid) {
  // alert(price);
  jQuery(obj).parent().parent().find(".getItems").val(title);
  jQuery(obj).parent().parent().find(".getItems_hidden").text(title);
  jQuery(obj).parent().parent().parent().find(".price").val(price);
  jQuery(obj).parent().parent().parent().find(".priceqty").val(price);
  // jQuery(obj).parent().parent().parent().find(".price").text(price);
  jQuery(obj).parent().parent().parent().find(".discount").val(discount);
  jQuery(obj).parent().parent().parent().find(".itemid").val(itemid);

  // var test = $('.pirce').val();
  // alert('testing ' + test);

  var counter = jQuery(obj)
    .parent()
    .parent()
    .parent()
    .find(".price")
    .data("counter");
  jQuery(obj).parent().empty();
  calculation(counter);
}

// function setitem(obj, title, price, discount, itemid) {
//   // alert('here');
//   // var total = price * 1;
//   jQuery(obj).parent().parent().find(".getItems").val(title);
//   jQuery(obj).parent().parent().find(".getItems_hidden").text(title);
//   jQuery(obj).parent().parent().parent().find(".price").val(price);
//   jQuery(obj).parent().parent().parent().find(".priceqty").val(price);
//   jQuery(obj).parent().parent().parent().find(".price").text(price);
//   jQuery(obj).parent().parent().parent().find(".discount").val(discount);
//   jQuery(obj).parent().parent().parent().find(".itemid").val(itemid);
//   var counter = jQuery(obj)
//     .parent()
//     .parent()
//     .parent()
//     .find(".price")
//     .data("counter");
//   jQuery(obj).parent().empty();
//   calculation(counter);
// }

function getItemsPackage(obj) {
  var sk = jQuery(obj).val();
  var site_url = jQuery("#siteurl").val();
  jQuery.ajax({
    url: site_url + "items/getitemsPackage",
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

function setitemPackage(obj, title, price, discount, itemid) {
  jQuery(obj).parent().parent().find(".getItemsPackage").val(title);
  // jQuery(obj).parent().parent().find(".getItems_hidden").text(title);
  jQuery(obj).parent().parent().parent().find(".price_package").val(price);
  jQuery(obj).parent().parent().parent().find(".priceqty_package").val(price);
  // jQuery(obj).parent().parent().parent().find(".price").text(price);
  // jQuery(obj).parent().parent().parent().find(".discount").val(discount);
  jQuery(obj).parent().parent().parent().find(".itemid_package").val(itemid);
  var counter = jQuery(obj)
    .parent()
    .parent()
    .parent()
    .find(".price_package")
    .data("counter");
  jQuery(obj).parent().empty();
  packageCalculation(counter);
}

$(document).on("focusout", ".quantityPackage", function () {
  var counter = $(this).data("counter");
  packageCalculation(counter);
});

$(document).on("focusout", ".price_package", function () {
  var counter = $(this).data("counter");
  packageCalculation(counter);
});

$(document).on("focusout", ".quantityPackage2", function () {
  // alert('test');
  var id = $(this).attr('data-itemid');
  // packageCalculation(counter);

  var quantity = $("#quantity_package_" + id).val();
  var price = $("#price_package_" + id).val();

  var subtotal = parseFloat(price) * parseFloat(quantity);

  $("#priceqtypackage_" + id).val(subtotal.toFixed(2));

  var total_cost = 0;
  // $("#span_total_0").each(function(){
  $('*[id^="priceqtypackage_"]').each(function(){
  total_cost += parseFloat($(this).val());
  });

  $("#package_price").val(total_cost.toFixed(2));
});

$(document).on("focusout", ".price_package2", function () {
  var counter = $(this).attr('data-itemid');
  // packageCalculation(counter);

  var id = $(this).attr('data-itemid');
  // packageCalculation(counter);

  var quantity = $("#quantity_package_" + id).val();
  var price = $("#price_package_" + id).val();

  var subtotal = parseFloat(price) * parseFloat(quantity);

  $("#priceqtypackage_" + id).val(subtotal.toFixed(2));

  var total_cost = 0;
  // $("#span_total_0").each(function(){
  $('*[id^="priceqtypackage_"]').each(function(){
  total_cost += parseFloat($(this).val());
  });

  $("#package_price").val(total_cost.toFixed(2));
});

function packageCalculation(counter)
{
  var quantity = $("#quantity_package_" + counter).val();
  var price = $("#price_package_" + counter).val();

  var subtotal = parseFloat(price) * parseFloat(quantity);

  $("#priceqtypackage_" + counter).val(subtotal.toFixed(2));

  var total_cost = 0;
  // $("#span_total_0").each(function(){
  $('*[id^="priceqtypackage_"]').each(function(){
  total_cost += parseFloat($(this).val());
  });

  $("#package_price").val(total_cost.toFixed(2));
}

function previewImage(input, previewDom) {
  if (input.files && input.files[0]) {
    $(previewDom).show();
    var reader = new FileReader();
    reader.onload = function (e) {
      $(previewDom).find("img").attr("src", e.target.result);
    };
    reader.readAsDataURL(input.files[0]);
  } else {
    $(previewDom).hide();
  }
}

function createUsername(name) {
  return name
    .toLowerCase()
    .replace(/ /g, "_")
    .replace(/[^\w-]+/g, "");
}

$(document).on("focusout", ".price", function () {
  var counter = $(this).data("counter");
  calculation(counter);
});

$(document).on("focusout", ".price2", function () {
  var counter = $(this).data("counter");
  // calculation(counter);
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
  $("#item_total_" + in_id).val(o_total);
  $("#sub_total_text" + in_id).text(o_total);
  $("#span_sub_total_invoice").text(priceqty.toFixed(2));
  $("#item_total").val(priceqty.toFixed(2));

  var one_time  = $("#one_time").val();
  var m_monitoring  = $("#m_monitoring").val();

  var grandtotal = priceqty + subtotaltax + parseFloat(one_time) + parseFloat(m_monitoring);
  // alert(grandtotal);

  $("#grand_total_input").val(grandtotal);
  $("#grand_total_inputs").val(grandtotal);
  $("#grand_total_inputs_a").val(grandtotal);
  $("#payment_amount").val(grandtotal.toFixed(2));
  // alert(grandtotal);
  // standard form
  var taxtotal  = $("#total_tax_input").val();
  var pricetotal  = $("#item_total").val();
  var s_grandtotal = subtotaltax + priceqty;
  $("#grand_total").text(s_grandtotal.toFixed(2));
  $("#balanceDueText").text(s_grandtotal.toFixed(2));
  $("#grand_total_input").val(s_grandtotal.toFixed(2)).trigger('change');
  // $("#grand_total_inputs").val(s_grandtotal.toFixed(2));
  $("#payment_amount").val(s_grandtotal.toFixed(2));
});

$(document).on("focusout", ".price_w", function () {
  var counter = $(this).data("counter");
  // calculation(counter);
  var in_id = $(this).attr('data-counter');
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
  $("#item_total_" + in_id).val(o_total);
  $("#sub_total_text" + in_id).text(o_total);
  $("#span_sub_total_invoice").text(priceqty.toFixed(2));
  $("#item_total").val(priceqty.toFixed(2));

  var one_time  = $("#one_time").val();
  var m_monitoring  = $("#m_monitoring").val();

  var grandtotal = priceqty + subtotaltax + parseFloat(one_time) + parseFloat(m_monitoring);
  // alert(grandtotal);

  $("#grand_total_input").val(grandtotal);
  $("#grand_total_inputs").val(grandtotal);
  $("#grand_total_inputs_a").val(grandtotal);
  $("#payment_amount").val(grandtotal.toFixed(2));
  // alert(grandtotal);
  // standard form
  var taxtotal  = $("#total_tax_input").val();
  var pricetotal  = $("#item_total").val();
  var s_grandtotal = subtotaltax + priceqty;
  $("#grand_total").text(s_grandtotal.toFixed(2));
  $("#grand_total_input").val(s_grandtotal.toFixed(2)).trigger('change');
  // $("#grand_total_inputs").val(s_grandtotal.toFixed(2));
  $("#payment_amount").val(s_grandtotal.toFixed(2));
});

$(document).on("focusout", ".price_inv", function () {
  var counter = $(this).data("counter");
  // calculation(counter);
  var in_id = $(this).attr('data-counter');
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
  $("#item_total_" + in_id).val(o_total);
  $("#sub_total_text" + in_id).text(o_total);
  $("#span_sub_total_invoice").text(priceqty.toFixed(2));
  $("#item_total").val(priceqty.toFixed(2));

  var one_time  = $("#one_time").val();
  var m_monitoring  = $("#m_monitoring").val();

  var grandtotal = priceqty + subtotaltax + parseFloat(one_time) + parseFloat(m_monitoring);
  // alert(grandtotal);

  $("#grand_total_input").val(grandtotal);
  $("#grand_total_inputs").val(grandtotal);
  $("#grand_total_inputs_a").val(grandtotal);
  $("#payment_amount").val(grandtotal.toFixed(2));
  // alert(grandtotal);
  // standard form
  var taxtotal  = $("#total_tax_input").val();
  var pricetotal  = $("#item_total").val();
  var s_grandtotal = subtotaltax + priceqty;
  $("#grand_total").text(s_grandtotal.toFixed(2));
  $("#grand_total_input").val(s_grandtotal.toFixed(2)).trigger('change');
  // $("#grand_total_inputs").val(s_grandtotal.toFixed(2));
  $("#payment_amount").val(s_grandtotal.toFixed(2));
});

$(document).on("focusout", ".quantity", function () {
  var counter = $(this).data("counter");
  calculation(counter);
});

$(document).on("focusout", ".quantity_w", function () {

var in_id = $(this).attr('data-counter');
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
  $("#grand_total_input").val(s_grandtotal.toFixed(2)).trigger('change');
  $("#grand_total_inputs").val(s_grandtotal.toFixed(2));
  $("#payment_amount").val(s_grandtotal.toFixed(2));
});

$(document).on("focusout", ".quantity_inv", function () {

  var in_id = $(this).attr('data-counter');
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
    $("#grand_total_input").val(s_grandtotal.toFixed(2)).trigger('change');
    $("#grand_total_inputs").val(s_grandtotal.toFixed(2));
    $("#payment_amount").val(s_grandtotal.toFixed(2));
  });

$(document).on("focusout", ".discount", function () {
  var counter = $(this).data("counter");
  calculation(counter);
});

function calculation(counter) {
  // alert('calc 2');
  // alert('test');
  var price = $("#price_" + counter).val();
  var quantity = $("#quantity_" + counter).val();
  var discount = $("#discount_" + counter).val();
  var tax = (parseFloat(price) * 7.5) / 100;
  var tax1 = (((parseFloat(price) * 7.5) / 100) * parseFloat(quantity)).toFixed(2);
  var subtotaltax = 0;
  var stotal_cost = 0;

  if( discount == '' ){
    discount = 0;
  }
  
  var total = (
    (parseFloat(price) + parseFloat(tax)) * parseFloat(quantity) -
    parseFloat(discount)
  ).toFixed(2);

  // alert( 'yeah ' + price);

  $("#span_total_" + counter).text(total);
  $("#sub_total_text" + counter).val(total);
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
  var total_cost = 0;
  var cnt = $("#count").val();
  var total_discount = 0;
  var pquantity  = 0;

  for (var p = 0; p <= cnt; p++) {
    var prc = $("#price_" + p).val();
    var quantity = $("#quantity_" + p).val();
    var discount = $("#discount_" + p).val();
    var pqty = $("#priceqty_" + p).val();
    var tax  = $("#tax1_" + p).val();
    if( prc > 0 ){
      // var discount= $('#discount_' + p).val();
      // eqpt_cost += parseFloat(prc) - parseFloat(discount);
      pquantity += parseFloat(pqty);
      total_cost += parseFloat(prc);
      eqpt_cost += parseFloat(prc) * parseFloat(quantity);
      total_discount += parseFloat(discount);
      subtotaltax += parseFloat(tax);
      stotal_cost += parseFloat(prc) * parseFloat(quantity);
    }
  }
//   var subtotal = 0;
// $( total ).each( function(){
//   subtotal += parseFloat( $( this ).val() ) || 0;
// });

  eqpt_cost = parseFloat(eqpt_cost).toFixed(2);
  total_discount = parseFloat(total_discount).toFixed(2);
  priceqty = parseFloat(pquantity).toFixed(2);
  // var test = 5;

  var subtotal = 0;
  // $("#span_total_0").each(function(){
    $('*[id^="span_total_"]').each(function(){
    subtotal += parseFloat($(this).text());
  });
  // $('#sum').text(subtotal);
  
  // $("#span_total_0").each(function(){
  /*$('*[id^="tax_1_"]').each(function(){
      alert(parseFloat($(this).text()));
      subtotaltax += parseFloat($(this).text());
  });*/

  // alert(subtotaltax);
  // var priceqty = 0;
  //   $('*[id^="priceqty_"]').each(function(){
  //     priceqty += parseFloat($(this).text());
  // });
  // alert(priceqty);

  //$("#span_sub_total_invoice").text(priceqty);

  $("#item_total").val(stotal_cost.toFixed(2));
  $("#item_total_text").html(stotal_cost.toFixed(2));
  
  $("#eqpt_cost").val(eqpt_cost);
  $("#total_discount").val(total_discount);
  $("#span_sub_total_0").text(total_discount);
  $("#span_sub_total_invoice").text(stotal_cost.toFixed(2));
  // $("#item_total").val(subtotal.toFixed(2));
  
  var s_total = subtotal.toFixed(2);
  var adjustment = $("#adjustment_input").val();
  var grand_total = s_total - parseFloat(adjustment);
  var markup = $("#markup_input_form").val();
  var grand_total_w = grand_total + parseFloat(markup);

  $("#total_tax_").text(subtotaltax.toFixed(2));
  $("#total_tax_input").val(subtotaltax.toFixed(2));
  
  // grand_total_input
  $("#grand_total").text(grand_total_w.toFixed(2));
  $("#grand_total_input").val(grand_total_w.toFixed(2)).trigger('change');
  $("#grand_total_inputs").val(grand_total_w.toFixed(2));
  $("#grandtotal_input").val(grand_total_w.toFixed(2));
  $("#payment_amount").val(grand_total_w.toFixed(2));
  $("#balanceDueText").text(grand_total_w.toFixed(2));
  

  if($("#grand_total").length && $("#grand_total").val().length)
  {
    // console.log('none');
    // alert('none'); grand_total
  }else{
    $("#grand_total").text(grand_total_w.toFixed(2));
    $("#grand_total_input").val(grand_total_w.toFixed(2)).trigger('change');
    $("#grand_total_inputs").val(grand_total_w.toFixed(2));
    $("#payment_amount").val(grand_total_w.toFixed(2));
    $("#balanceDueText").text(grand_total_w.toFixed(2));

    var bundle1_total = $("#grand_total").text();
    var bundle2_total = $("#grand_total2").text();
    var super_grand = parseFloat(bundle1_total) + parseFloat(bundle2_total);

    $("#supergrandtotal").text(super_grand.toFixed(2));
    $("#supergrandtotal_input").val(super_grand.toFixed(2));
  }

  var sls = (parseFloat(eqpt_cost).toFixed(2) * 7.5) / 100;
  sls = parseFloat(sls).toFixed(2);
  $("#sales_taxs").val(sls);
  $("#total_tax_").html(sls);
  $("#total_tax_input").val(sls);
  cal_total_due();

  const fixedSubtotal = calculateSubtotal();
  $("#item_total").val(fixedSubtotal);
  $("#item_total_text").html(fixedSubtotal);
  $("#span_sub_total_invoice").text(fixedSubtotal);

  const fixedTaxes = calculateTaxes();
  $("#total_tax_").text(fixedTaxes);
  $("#total_tax_input").val(fixedTaxes);
}

function taxRate()
{
  $.ajax({
    type : 'POST',
    url : "<?php echo base_url(); ?>workorder/getTaxRate",
    dataType: 'json',
    success: function(response){
      alert(response);
    }
  });
}

function calculateSubtotal() {
  let retval = 0;
  const $rows = document.querySelectorAll("#jobs_items_table_body tr");

  [...$rows].forEach($row => {
    const $price = $row.querySelector("[name^=price]");
    const $quantity = $row.querySelector("[name^=quantity]");
    const $discount = $row.querySelector("[name^=discount]");

    const price = Number($price.value);
    const quantity = Number($quantity.value);
    const discount = Number($discount.value);
    retval = retval + (price * quantity) - discount;
  });

  return retval.toFixed(2);
}

function calculateTaxes() {
  let retval = 0;
  const $rows = document.querySelectorAll("#jobs_items_table_body tr");

  [...$rows].forEach($row => {
    const $tax = $row.querySelector("[name^=tax]");
    retval = retval + Number($tax.value);
  });

  return retval.toFixed(2);
}

function calculation2(counter) {
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
  $("#tax2_1_" + counter).val(tax1);
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
  var total_cost = 0;
  for (var p = 0; p <= cnt; p++) {
    var prc = $("#price2_" + p).val();
    var quantity = $("#quantity2_" + p).val();
    var discount = $("#discount2_" + p).val();
    // var discount= $('#discount_' + p).val();
    // eqpt_cost += parseFloat(prc) - parseFloat(discount);
    total_cost += parseFloat(prc);
    eqpt_cost += parseFloat(prc) * parseFloat(quantity);
    total_discount += parseFloat(discount);
  }
//   var subtotal = 0;
// $( total ).each( function(){
//   subtotal += parseFloat( $( this ).val() ) || 0;
// });

  eqpt_cost = parseFloat(eqpt_cost).toFixed(2);
  total_discount = parseFloat(total_discount).toFixed(2);
  stotal_cost = parseFloat(total_cost).toFixed(2);
  // var test = 5;

  var subtotal = 0;
  // $("#span_total_0").each(function(){
    $('*[id^="span_total2_"]').each(function(){
    subtotal += parseFloat($(this).text());
  });
  // $('#sum').text(subtotal);

  var subtotaltaxx = 0;
  // $("#span_total_0").each(function(){
    $('*[id^="tax2_"]').each(function(){
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

  // $("#total_tax2_1_").text(subtotaltaxx.toFixed(2));
  $("#total_tax2_").text(subtotaltaxx.toFixed(2));
  $("#total_tax2_input").val(subtotaltaxx.toFixed(2));
  

  $("#grand_total2").text(grand_total_w.toFixed(2));
  $("#grand_total_input2").val(grand_total_w.toFixed(2));
  $("#grandtotal_input").val(grand_total_w.toFixed(2));
  $("#payment_amount").val(grand_total_w.toFixed(2));

  if($("#grand_total2").length && $("#grand_total2").val().length)
  {
    // console.log('none');
    // alert('none');
  }else{
    $("#grand_total2").text(grand_total_w.toFixed(2));
    $("#grand_total_input").val(grand_total_w.toFixed(2)).trigger('change');
    $("#grand_total_inputs").val(grand_total_w.toFixed(2));
    $("#payment_amount").val(grand_total_w.toFixed(2));

    var bundle1_total = $("#grand_total").text();
    var bundle2_total = $("#grand_total2").text();
    var super_grand = parseFloat(bundle1_total) + parseFloat(bundle2_total);
  }

  var sls = (parseFloat(eqpt_cost).toFixed(2) * 7.5) / 100;
  sls = parseFloat(sls).toFixed(2);
  $("#sales_tax").val(sls);
  cal_total_due();
}

$(document).on("click", "#add_another", function (e) { 
  e.preventDefault();
  var count = parseInt($("#count").val()) + 1;
  $("#count").val(count);

  var html =
    "<tr>\n" +
    '<td><select name="item_type[]" class="form-control"><option value="product">Product</option><option value="material">Material</option><option value="service">Service</option></select></td>\n' +
    "<td>\n" +
    '<input type="text" autocomplete="off" class="form-control getItems" onKeyup="getItems(this)" name="item[]"><ul class="suggestions"></ul>\n' +
    "</td>\n" +    
    "<td>\n" +
    '<input type="text" class="form-control quantity" name="quantity[]" data-counter="' +
    count +
    '" id="quantity_' +
    count +
    '" value="1">\n' +
    "</td>\n" +
    "<td>\n" +
    '<input type="text" class="form-control" name="location[]">\n' +
    "</td>\n" +
    "<td>\n" +
    '<input type="number" class="form-control price" name="price[]" data-counter="' +
    count +
    '" id="price_' +
    count +
    '" min="0" value="0">\n' +
    "</td>\n" +
    "<td>\n" +
    '<input type="number" class="form-control discount" name="discount[]" data-counter="' +
    count +
    '" id="discount_' +
    count +
    '" min="0" value="0" readonly>\n' +
    "</td>\n" +
    "<td>\n" +
    '<span id="span_tax_' +
    count +
    '">0.00 (7.5%)</span>\n' +
    "</td>\n" +
    "<td>\n" +
    '<span id="span_total_' +
    count +
    '">0.00</span>\n' +
    "</td>\n" +
    "<td>\n" +
    '<a href="#" class="remove btn btn-sm btn-success"><i class="fa fa-trash" aria-hidden="true"></i></a>\n' +
    "</td>\n" +
    "</tr> ";

  $("#table_body").append(html);
});

$(document).on("click", "#add_another_estimate", function (e) { 
  e.preventDefault();
  var count = parseInt($("#count").val()) + 1;
  $("#count").val(count);

  var html =
    "<tr>\n" +
    "<td>\n" +
    '<input type="text" autocomplete="off" class="form-control getItems" onKeyup="getItems(this)" name="item[]"><ul class="suggestions"></ul>\n' +
    "</td>\n" +    
    '<td><select name="item_type[]" class="form-control"><option value="product">Product</option><option value="material">Material</option><option value="service">Service</option></select></td>\n' +
    // "<td>\n" +
    // '<input type="text" class="form-control quantity" name="desc[]">\n' +
    // "</td>\n" +
    "<td>\n" +
    '<input type="number" class="form-control quantity" name="quantity[]" data-counter="' +
    count +
    '" id="quantity_' +
    count +
    '" min="1" value="1">\n' +
    "</td>\n" +
    // "<td>\n" +
    // '<input type="text" class="form-control" name="location[]">\n' +
    // "</td>\n" +
    "<td>\n" +
    '<input type="number" class="form-control price" name="price[]" data-counter="' +
    count +
    '" id="price_' +
    count +
    '" min="0" value="0">\n' +
    "</td>\n" +
    "<td>\n" +
    '<input type="number" class="form-control discount" name="discount[]" data-counter="' +
    count +
    '" id="discount_' +
    count +
    '" min="0" value="0" >\n' +
    "</td>\n" +
    "<td>\n" +
    '<input type="hidden" class="form-control tax" name="tax[]" data-counter="' +
    count +
    '" id="tax_' +
    count +
    '" min="0" value="0">\n' +
    '<span id="span_tax_' +
    count +
    '">0.00 (7.5%)</span>\n' +
    "</td>\n" +
    "<td>\n" +
    '<input type="hidden" class="form-control total" name="total[]" data-counter="' +
    count +
    '" id="item_total_' +
    count +
    '" min="0" value="0">\n' +
    '<span id="span_total_' +
    count +
    '">0.00</span>\n' +
    "</td>\n" +
    "<td>\n" +
    '<a href="#" class="remove btn btn-sm btn-success"><i class="fa fa-trash" aria-hidden="true"></i></a>\n' +
    "</td>\n" +
    "</tr> ";

  $("#table_body").append(html);
});

$(document).on("click", "#add_another_workOr", function (e) 
{
  // alert('yeah');
  e.preventDefault();
  var count = parseInt($("#count").val()) + 1;
  $("#count").val(count);

  var html =
    "<tr>\n" +
    '<td><input type="text" class="form-control" name="order_items[]"></td>\n' +
    "<td>\n" +
    '<input type="text" class="form-control quantity" name="quantity[]" data-counter="' +
    count +
    '" id="quantity_' +
    count +
    '" value="1">\n' +
    "</td>\n" +
    "<td>\n" +
    '<input type="number" class="form-control price" name="price[]" data-counter="' +
    count +
    '" id="price_' +
    count +
    '" min="0" value="0">\n' +
    "</td>\n" +
    "<td>\n" +
    '<a href="#" class="remove btn btn-sm btn-success"><i class="fa fa-trash" aria-hidden="true"></i></a>\n' +
    "</td>\n" +
    "</tr> ";

  $("#table_body_work").append(html);
});


$(document).on("click", "#add_another_option1", function (e) { 
  e.preventDefault();
  var count = parseInt($("#count").val()) + 1;
  $("#count").val(count);

  var html =
    "<tr>\n" +
    '<td><select name="item_type[]" class="form-control"><option value="product">Product</option><option value="material">Material</option><option value="service">Service</option></select></td>\n' +   
    "<td>\n" +
    '<input type="text" class="form-control quantity" name="quantity[]" data-counter="' +
    count +
    '" id="quantity_' +
    count +
    '" value="1">\n' +
    "</td>\n" +
    "<td>\n" +
    '<input type="number" class="form-control price" name="price[]" data-counter="' +
    count +
    '" id="price_' +
    count +
    '" min="0" value="0">\n' +
    "</td>\n" +
    "<td>\n" +
    '<span id="span_total_' +
    count +
    '">0.00</span>\n' +
    "</td>\n" +
    "<td>\n" +
    '<a href="#" class="remove btn btn-sm btn-success"><i class="fa fa-trash" aria-hidden="true"></i></a>\n' +
    "</td>\n" +
    "</tr> ";

  $("#table_body_option1").append(html);
});

$(document).on("click", "#add_another_option2", function (e) { 
  e.preventDefault();
  var count = parseInt($("#count").val()) + 1;
  $("#count").val(count);

  var html =
    "<tr>\n" +
    '<td><select name="item_type[]" class="form-control"><option value="product">Product</option><option value="material">Material</option><option value="service">Service</option></select></td>\n' +   
    "<td>\n" +
    '<input type="text" class="form-control quantity" name="quantity[]" data-counter="' +
    count +
    '" id="quantity_' +
    count +
    '" value="1">\n' +
    "</td>\n" +
    "<td>\n" +
    '<input type="number" class="form-control price" name="price[]" data-counter="' +
    count +
    '" id="price_' +
    count +
    '" min="0" value="0">\n' +
    "</td>\n" +
    "<td>\n" +
    '<span id="span_total_' +
    count +
    '">0.00</span>\n' +
    "</td>\n" +
    "<td>\n" +
    '<a href="#" class="remove btn btn-sm btn-success"><i class="fa fa-trash" aria-hidden="true"></i></a>\n' +
    "</td>\n" +
    "</tr> ";

  $("#table_body_option2").append(html);
});

$(document).on("click", "#add_another_bundle1", function (e) { 
  e.preventDefault();
  var count = parseInt($("#count").val()) + 1;
  $("#count").val(count);

  var html =
    "<tr>\n" +
    '<td><select name="item_type[]" class="form-control"><option value="product">Product</option><option value="material">Material</option><option value="service">Service</option></select></td>\n' +   
    "<td>\n" +
    '<input type="text" class="form-control quantity" name="quantity[]" data-counter="' +
    count +
    '" id="quantity_' +
    count +
    '" value="1">\n' +
    "</td>\n" +
    "<td>\n" +
    '<input type="number" class="form-control price" name="price[]" data-counter="' +
    count +
    '" id="price_' +
    count +
    '" min="0" value="0">\n' +
    "</td>\n" +
    "<td>\n" +
    '<span id="span_total_' +
    count +
    '">0.00</span>\n' +
    "</td>\n" +
    "<td>\n" +
    '<a href="#" class="remove btn btn-sm btn-success"><i class="fa fa-trash" aria-hidden="true"></i></a>\n' +
    "</td>\n" +
    "</tr> ";

  $("#table_body_bundle1").append(html);
});

$(document).on("click", "#add_another_bundle2", function (e) { 
  e.preventDefault();
  var count = parseInt($("#count").val()) + 1;
  $("#count").val(count);

  var html =
    "<tr>\n" +
    '<td><select name="item_type[]" class="form-control"><option value="product">Product</option><option value="material">Material</option><option value="service">Service</option></select></td>\n' +   
    "<td>\n" +
    '<input type="text" class="form-control quantity" name="quantity[]" data-counter="' +
    count +
    '" id="quantity_' +
    count +
    '" value="1">\n' +
    "</td>\n" +
    "<td>\n" +
    '<input type="number" class="form-control price" name="price[]" data-counter="' +
    count +
    '" id="price_' +
    count +
    '" min="0" value="0">\n' +
    "</td>\n" +
    "<td>\n" +
    '<span id="span_total_' +
    count +
    '">0.00</span>\n' +
    "</td>\n" +
    "<td>\n" +
    '<a href="#" class="remove btn btn-sm btn-success"><i class="fa fa-trash" aria-hidden="true"></i></a>\n' +
    "</td>\n" +
    "</tr> ";

  $("#table_body_bundle2").append(html);
});

$(document).on("click", "#add_another_zone", function (e) {
  e.preventDefault();
  var count = parseInt($("#count").val()) + 1;
  $("#count").val(count);

  var html =
    "<tr>\n" +
    "<td>\n" +
    '<select name="zone[existing][]" class="form-control"><option value="0">No</option><option value="1">Yes</option></select>\n' +
    "</td>\n" +
    // '<td><select name="item_type[]" class="form-control"><option value="product">Product</option><option value="material">Material</option><option value="service">Service</option></select></td>\n'+
    "<td>\n" +
    '<input type="text" class="form-control quantity" name="zone[zone_number][]" data-counter="' +
    count +
    '" id="quantity_' +
    count +
    '" value="1">\n' +
    "</td>\n" +
    "<td>\n" +
    '<select name="zone[repeat_issue][]" class="form-control"> <option value="0">No</option><option value="1">Yes</option></select>\n' +
    "</td>\n" +
    "<td>\n" +
    '<input type="text" class="form-control" name="zone[location][]">\n' +
    "</td>\n" +
    "<td>\n" +
    '<a href="#" class="remove">X</a>\n' +
    "</td>\n" +
    "</tr> ";

  $("#table_body_zone").append(html);
});
var isConfirm = 0;
$(document).on("click", ".remove", function (e) {
  e.preventDefault();
  $(this).parent().parent().remove();
  var idd = this.id;
  isConfirm = 1;
  console.log(isConfirm);
  var count = parseInt($("#count").val()) - 1;
  $("#count").val(count);
  // calculation(count);


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

  var total_wo_tax = price * quantity;

  // alert( 'yeah' + total);

  
  $("#ITEMLIST_PRODUCT_"+idd).show();
  $("#priceqty_" + in_id).val(total_wo_tax);
  $("#span_total_" + in_id).text(total);
  $("#sub_total_text" + in_id).val(total);
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
  var total_costs = 0;
  var cnt = $("#count").val();
  var total_discount = 0;
  var pquantity = 0;
  for (var p = 0; p <= cnt; p++) {
    var prc = $("#price_" + p).val();
    var quantity = $("#quantity_" + p).val();
    var discount = $("#discount_" + p).val();
    var pqty = $("#priceqty_" + p).val();
    // var discount= $('#discount_' + p).val();
    // eqpt_cost += parseFloat(prc) - parseFloat(discount);
    pquantity += parseFloat(pqty);
    total_costs += parseFloat(prc);
    eqpt_cost += parseFloat(prc) * parseFloat(quantity);
    total_discount += parseFloat(discount);
  }
//   var subtotal = 0;
// $( total ).each( function(){
//   subtotal += parseFloat( $( this ).val() ) || 0;
// });

var total_cost = 0;
  // $("#span_total_0").each(function(){
    $('*[id^="price_"]').each(function(){
      total_cost += parseFloat($(this).val());
  });

// var totalcosting = 0;
// $('*[id^="span_total_"]').each(function(){
//   totalcosting += parseFloat($(this).val());
// });


// alert(total_cost);

var tax_tot = 0;
$('*[id^="tax1_"]').each(function(){
  tax_tot += parseFloat($(this).val());
});

over_tax = parseFloat(tax_tot).toFixed(2);
// alert(over_tax);

$("#sales_taxs").val(over_tax);
$("#total_tax_input").val(over_tax);
$("#total_tax_").text(over_tax);


  eqpt_cost = parseFloat(eqpt_cost).toFixed(2);
  total_discount = parseFloat(total_discount).toFixed(2);
  stotal_cost = parseFloat(total_cost).toFixed(2);
  priceqty = parseFloat(pquantity).toFixed(2);
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


  var priceqty2 = 0;
    $('*[id^="priceqty_"]').each(function(){
      priceqty2 += parseFloat($(this).val());
  });

  $("#span_sub_total_invoice").text(priceqty2.toFixed(2));
  // $("#span_sub_total_invoice").text(priceqty);

  $("#eqpt_cost").val(eqpt_cost);
  $("#total_discount").val(total_discount);
  $("#span_sub_total_0").text(total_discount);
  // $("#span_sub_total_invoice").text(stotal_cost);
  // $("#item_total").val(subtotal.toFixed(2));
  $("#item_total").val(priceqty2.toFixed(2));
  
  var s_total = subtotal.toFixed(2);
  var adjustment = $("#adjustment_input").val();
  var grand_total = s_total - parseFloat(adjustment);
  var markup = $("#markup_input_form").val();
  var grand_total_w = grand_total + parseFloat(markup);

  // $("#total_tax_").text(subtotaltax.toFixed(2));
  // $("#total_tax_").val(subtotaltax.toFixed(2));
  
  
  

  $("#grand_total").text(grand_total_w.toFixed(2));
  $("#grand_total_input").val(grand_total_w.toFixed(2)).trigger('change');
  $("#grand_total_inputs").val(grand_total_w.toFixed(2));
  $("#payment_amount").val(grand_total_w.toFixed(2));

  var sls = (parseFloat(eqpt_cost).toFixed(2) * 7.5) / 100;
  sls = parseFloat(sls).toFixed(2);
  $("#sales_tax").val(sls);
  cal_total_due();
});

$(document).on("click", ".remove2", function (e) {
  e.preventDefault();
  $(this).parent().parent().remove();
  var idd = this.id;
  var count = parseInt($("#count").val()) - 1;
  $("#count").val(count);
  // calculation(count);


  var in_id = idd;
  var price = $("#price2_" + in_id).val();
  var quantity = $("#quantity2_" + in_id).val();
  var discount = $("#discount2_" + in_id).val();
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

  $("#span_total2_" + in_id).text(total);
  $("#tax2_" + in_id).text(tax1);
  $("#tax2_1_" + in_id).val(tax1);
  $("#discount2_" + in_id).val(discount);

  if( $('#tax2_'+ in_id).length ){
    $('#tax2_'+in_id).val(tax1);
  }

  if( $('#item_total2_'+ in_id).length ){
    $('#item_total2_'+in_id).val(total);
  }

  var eqpt_cost = 0;
  var cnt = $("#count2").val();
  var total_discount = 0;
  var total_cost = 0;
  for (var p = 0; p <= cnt; p++) {
    var prc = $("#price2_" + p).val();
    var quantity = $("#quantity2_" + p).val();
    var discount = $("#discount2_" + p).val();
    // var discount= $('#discount_' + p).val();
    // eqpt_cost += parseFloat(prc) - parseFloat(discount);
    total_cost += parseFloat(prc);
    eqpt_cost += parseFloat(prc) * parseFloat(quantity);
    total_discount += parseFloat(discount);
  }
//   var subtotal = 0;
// $( total ).each( function(){
//   subtotal += parseFloat( $( this ).val() ) || 0;
// });

  eqpt_cost = parseFloat(eqpt_cost).toFixed(2);
  total_discount = parseFloat(total_discount).toFixed(2);
  stotal_cost = parseFloat(total_cost).toFixed(2);
  // var test = 5;

  var subtotal = 0;
  // $("#span_total_0").each(function(){
    $('*[id^="span_total2_"]').each(function(){
    subtotal += parseFloat($(this).text());
  });
  // $('#sum').text(subtotal);

  var subtotaltaxx = 0;
  // $("#span_total_0").each(function(){
    $('*[id^="tax2_"]').each(function(){
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

  // $("#total_tax2_1_").text(subtotaltaxx.toFixed(2));
  $("#total_tax2_").text(subtotaltaxx.toFixed(2));
  $("#total_tax2_input").val(subtotaltaxx.toFixed(2));
  

  $("#grand_total2").text(grand_total_w.toFixed(2));
  $("#grand_total_input2").val(grand_total_w.toFixed(2));
  $("#grandtotal_input").val(grand_total_w.toFixed(2));
  $("#payment_amount").val(grand_total_w.toFixed(2));

  if($("#grand_total2").length && $("#grand_total2").val().length)
  {
    // console.log('none');
    // alert('none');
  }else{
    $("#grand_total2").text(grand_total_w.toFixed(2));
    $("#grand_total_input").val(grand_total_w.toFixed(2)).trigger('change');
    $("#grand_total_inputs").val(grand_total_w.toFixed(2));
    $("#payment_amount").val(grand_total_w.toFixed(2));

    var bundle1_total = $("#grand_total").text();
    var bundle2_total = $("#grand_total2").text();
    var super_grand = parseFloat(bundle1_total) + parseFloat(bundle2_total);
  }

  var sls = (parseFloat(eqpt_cost).toFixed(2) * 7.5) / 100;
  sls = parseFloat(sls).toFixed(2);
  $("#sales_tax").val(sls);
  cal_total_due();
});

function cal_total_due() {
  var eqpt_cost = parseFloat($("#eqpt_cost").val());
  var sales_tax = parseFloat($("#sales_tax").val());
  var inst_cost = parseFloat($("#inst_cost").val());
  var one_time = parseFloat($("#one_time").val());
  var m_monitoring = parseFloat($("#m_monitoring").val());
  var total_discount = parseFloat($("#total_discount").val());
  var total_due = parseFloat((eqpt_cost + sales_tax + inst_cost + one_time + m_monitoring) - total_discount).toFixed(2);
  
  $("#total_due").text(total_due);
  $("#g_total_due").val(total_due);
}

$(document).ready(function () {
  // $("#date_issued").datepicker();
  // $("#date_of_trans").datepicker();
  // $("#date_later_midnight").datepicker();
  // $("#workorder_date").datepicker();
  // $("#contact_dob").datepicker();
  // $("#cancel_trans_date").datepicker();
  // $("#start_date").datepicker();
  // $("#end_time").timepicker({});
  // $("#start_time").timepicker({});
  // $("#end_date").datepicker();
  // $("#inst_date").datepicker();

  var cookie = {
    create: function (name, value, days) {
      var expires;
      if (days) {
        var date = new Date();
        date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
        expires = "; expires=" + date.toGMTString();
      } else {
        expires = "";
      }
      document.cookie =
        encodeURIComponent(name) +
        "=" +
        JSON.stringify(value) +
        expires +
        "; path=/";
    },
    read: function (name) {
      var nameEQ = encodeURIComponent(name) + "=";
      var ca = document.cookie.split(";");
      for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) === " ") c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) === 0)
          return JSON.parse(c.substring(nameEQ.length, c.length));
      }
      return null;
    },
  };
  $(".nav-close").on("click", function () {
    $(".navbar-side").toggleClass("closed");

    if (cookie.read("navsidebar") === "closed") {
      cookie.create("navsidebar", "", 5);
    } else {
      cookie.create("navsidebar", "closed", 5);
    }
  });

  if (cookie.read("navsidebar") === "closed") {
    $(".navbar-side").addClass("closed");
  }

  $(".bcc-toggle").on("click", function () {
    $("#bcc-cnt").fadeToggle();
  });

  // $(".send-to-email, .send-cc-email, .send-bcc-email").select2({
  //   ajax: {
  //     url: "http://example.org/api/test",
  //     cache: false,
  //   },
  // });

  // tinymce.init({
  //   selector: "textarea#send-email",
  //   height: 500,
  //   menubar: false,
  //   plugins: [
  //     "advlist autolink lists link image charmap print preview anchor",
  //     "searchreplace visualblocks code fullscreen",
  //     "insertdatetime media table paste code help wordcount",
  //   ],
  //   toolbar:
  //     "undo redo | formatselect | " +
  //     "bold italic backcolor | alignleft aligncenter " +
  //     "alignright alignjustify | bullist numlist outdent indent | " +
  //     "removeformat | help",
  //   content_css: "//www.tiny.cloud/css/codepen.min.css",
  // });
});

$(document).on("click", "#add_another_new_invoice", function (e) {
  e.preventDefault();
  var count = parseInt($("#count").val()) + 1;
  $("#count").val(count);

  var html =
    "<tr>\n" +
    "<td>\n" +
    '<input type="text" autocomplete="off" class="form-control getItems" onKeyup="getItems(this)" name="item[]"><ul class="suggestions"></ul>\n' +
    "</td>\n" +
    '<td><select name="item_type[]" class="form-control"><option value="service">Service</option><option value="material">Material</option><option value="product">Product</option></select></td>\n' +
    "<td>\n" +
    '<input type="text" class="form-control quantity" name="quantity[]" data-counter="' +
    count +
    '" id="quantity_' +
    count +
    '" value="1">\n' +
    "</td>\n" +
    "<td>\n" +
    '<input type="number" class="form-control price" name="price[]" data-counter="' +
    count +
    '" id="price_' +
    count +
    '" min="0" value="0">\n' +
    "</td>\n" +
    "<td>\n" +
    '<input type="number" class="form-control discount" name="discount[]" data-counter="' +
    count +
    '" id="discount_' +
    count +
    '" min="0" value="0.00" readonly>\n' +
    "</td>\n" +
    "<td>\n" +
    '<input type="hidden" class="form-control tax" name="tax[]" data-counter="' +
    count +
    '" id="tax_' +
    count +
    '" min="0" value="0">\n' +
    '<span id="span_tax_' +
    count +
    '">0.00 (7.5%)</span>\n' +
    "</td>\n" +
    "<td>\n" +
    '<input type="hidden" class="form-control total" name="total[]" data-counter="' +
    count +
    '" id="item_total_' +
    count +
    '" min="0" value="0">\n' +
    '<span id="span_total_' +
    count +
    '">0.00</span>\n' +
    "</td>\n" +
    "<td>\n" +
    '<a href="#" class="remove"><span class="fa fa-trash" /></a>\n' +
    "</td>\n" +
    "</tr> ";

  $("#table_body_new").append(html);
});

// signature for Technician
$("#smoothed1a").signaturePad({
  drawOnly: true,
  drawBezierCurves: true,
  lineTop: 200,
});

function myFunction() {
  var x = document.getElementById("sign");
  if (x.style.pointerEvents === "auto") {
    x.style.pointerEvents = "none";
  } else {
    x.style.pointerEvents = "auto";
    x.style.cursor = "alias";
  }
}

function myFunctiontwo() {
  var x = document.getElementById("sign2");
  if (x.style.pointerEvents === "auto") {
    x.style.pointerEvents = "none";
  } else {
    x.style.pointerEvents = "auto";
    x.style.cursor = "alias";
  }
}

function myFunctionthree() {
  var x = document.getElementById("sign3");
  if (x.style.pointerEvents === "auto") {
    x.style.pointerEvents = "none";
  } else {
    x.style.pointerEvents = "auto";
    x.style.cursor = "alias";
  }
}


$("#company_representative_approval_signature1a").on("click touchstart",
  function () {
    var canvas = document.getElementById(
      "company_representative_approval_signature1a"
    );    
    var dataURL = canvas.toDataURL("image/png");
    $("#saveCompanySignatureDB1a").val(dataURL);
  }
);

// signature for Technician
$("#smoothed2a").signaturePad({
  drawOnly: true,
  drawBezierCurves: true,
  lineTop: 200,
});
$("#primary_account_holder_signature2a").on("click touchstart", function () {
  var canvas = document.getElementById("primary_account_holder_signature2a");
  var dataURL = canvas.toDataURL("image/png");
  $("#savePrimaryAccountSignatureDB2a").val(dataURL);
});

// signature for Technician
$("#smoothed3a").signaturePad({
  drawOnly: true,
  drawBezierCurves: true,
  lineTop: 200,
});
$("#secondary_account_holder_signature3a").on("click touchstart", function () {
  var canvas = document.getElementById("secondary_account_holder_signature3a");
  var dataURL = canvas.toDataURL("image/png");
  $("#saveSecondaryAccountSignatureDB3a").val(dataURL);
});

// $('.sigPad > div').each(function(){
//   var container = $(this);
//   if(this.scrollWidth !== $(this).width()) {
//     container.find('.pad').each(function(){
//       var child = $(this);
//       child.width(container.get(0).scrollWidth);
//     });
//   }
// });

//mobile

$("#smoothed1am").signaturePad({
  drawOnly: true,
  drawBezierCurves: true,
  lineTop: 200,
});
$("#company_representative_approval_signature1aM").on("click touchstart",
  function () {
    // alert('yeah');
    var canvas = document.getElementById(
      "signM"
    );    
    var dataURL = canvas.toDataURL("image/png");
    $("#saveCompanySignatureDB1aM").val(dataURL);
    // console.log(dataURL);
  }
);

$("#smoothed2am").signaturePad({
  drawOnly: true,
  drawBezierCurves: true,
  lineTop: 200,
});
$("#primary_account_holder_signature2aM").on("click touchstart", function () {
  var canvas = document.getElementById("primary_account_holder_signature2aM");
  var dataURL = canvas.toDataURL("image/png");
  $("#savePrimaryAccountSignatureDB2aM").val(dataURL);
});

$("#smoothed3am").signaturePad({
  drawOnly: true,
  drawBezierCurves: true,
  lineTop: 200,
});
$("#secondary_account_holder_signature3aM").on("click touchstart", function () {
  var canvas = document.getElementById("secondary_account_holder_signature3aM");
  var dataURL = canvas.toDataURL("image/png");
  $("#saveSecondaryAccountSignatureDB3aM").val(dataURL);
});

function myFunctionM() {
  // alert('yeah');
  var x = document.getElementById("signM");
  if (x.style.pointerEvents === "auto") {
    x.style.pointerEvents = "none";
    // alert('none');
  } else {
    x.style.pointerEvents = "auto";
    x.style.cursor = "alias";
    // alert('auto');
  }
}

function myFunctiontwoM() {
  var x = document.getElementById("sign2M");
  if (x.style.pointerEvents === "auto") {
    x.style.pointerEvents = "none";
  } else {
    x.style.pointerEvents = "auto";
    x.style.cursor = "alias";
  }
}

function myFunctionthreeM() {
  var x = document.getElementById("sign3M");
  if (x.style.pointerEvents === "auto") {
    x.style.pointerEvents = "none";
  } else {
    x.style.pointerEvents = "auto";
    x.style.cursor = "alias";
  }
}

$(".addCreatePackage").click(function () {
  // var item = $("#itemidPackage").val();
  var item = $('input[name="itemidPackage[]"]').map(function () {
      return this.value; // $(this).val()
  }).get();
  
  var type = $('input[name="item_typePackage[]"]').map(function () {
      return this.value; // $(this).val()
  }).get();
  
  var quantity = $('input[name="quantityPackage[]"]').map(function () {
      return this.value; // $(this).val()
  }).get();
  
  var price = $('input[name="pricePackage[]"]').map(function () {
      return this.value; // $(this).val()
  }).get();
  
  var package_name =  $("#package_name").val();
  var package_price =  $("#package_price").val();
  var package_price_set =  $("#package_price_set").val();
  
  // console.log('items '+item);
  // console.log('type '+type);
  // console.log('quantity '+quantity);
  // console.log('price '+price);
      $.ajax({
          type : 'POST',
          url : "<?php echo base_url(); ?>workorder/createPackage",
          data : {item: item, type:type, quantity:quantity, price:price, package_price:package_price, package_name:package_name, package_price_set:package_price_set },
          dataType: 'json',
          success: function(response){
  
          // console.log(result);
          var Randnumber = 1 + Math.floor(Math.random() * 99999);
  
          console.log(response['pName']);
  
                      // var inputs1 = "";
                          $.each(response['pName'], function (a, b) {
                              // inputs1 += b.name;
                              var pName = b.name;
                              // var Rnumber = 3 + Math.floor(Math.random() * 9);
                              var Rnumber = Math.floor(Math.random()*(9999-10000+1)+100);
  
                          
  
                  markup = "<tr id=\"ss\">" +
                          // "<td width=\"35%\"><input value='"+title+"' type=\"text\" name=\"items[]\" class=\"form-control getItems\" ><input type=\"hidden\" value='"+idd+"' name=\"item_id[]\"><div class=\"show_mobile_view\"><span class=\"getItems_hidden\">"+title+"</span></div><input type=\"hidden\" name=\"itemidPackage[]\" id=\"itemidPackage\" class=\"itemid\" value='"+idd+"'></td>\n" +
                          // "<td width=\"25%\"><div class=\"dropdown-wrapper\"><select name=\"item_typePackage[]\" class=\"form-control\"><option value=\"product\">Product</option><option value=\"material\">Material</option><option value=\"service\">Service</option><option value=\"fee\">Fee</option></select></div></td>\n" +
                          // "<td width=\"\"><input data-itemid='"+idd+"' id='quantity_package_"+idd+"' value='"+qty+"' type=\"number\" name=\"quantityPackage[]\" data-counter=\"0\"  min=\"0\" class=\"form-control quantityPackage2\"></td>\n" +
                          // "<td width=\"\"><input data-itemid='"+idd+"' id='price_package_"+idd+"' value='"+price+"'  type=\"number\" name=\"pricePackage[]\" class=\"form-control price_package2 hidden_mobile_view\" placeholder=\"Unit Price\"><input type=\"hidden\" class=\"priceqty\" id='priceqty_package_"+idd+"' value='"+total_+"'><div class=\"show_mobile_view\"><span class=\"price\">"+price+"</span></div></td>\n" +
                          // "<td>\n" +
                          // "<a href=\"#\" class=\"remove btn btn-sm btn-success\" id='"+idd+"'><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></a>\n" +
                          // "</td>\n" +
                          "<td colspan=\"6\" ><h6>"+ pName +"</h6><div><table class=\"table table-hover\" ><thead><th width=\"10%\" ></th><th>Item Name</th><th>Quantity</th><th>Price</th></thead> <tbody id='packageBody"+Randnumber+"'>" +
                          "<input type=\"hidden\" class=\"priceqty\" id='priceqty_"+Rnumber+"' value='"+b.amount_set+"'><input type=\"hidden\" name=\"itemid[]\" value=\"0\"><input type=\"hidden\" name=\"packageID[]\" value='"+b.id+"'><input type=\"hidden\" name=\"quantity[]\" value=\"1\"><input type=\"hidden\" name=\"price[]\" value='"+b.amount_set+"'><input type=\"hidden\" name=\"tax[]\" value=\"0\"><input type=\"hidden\" name=\"discount[]\" value=\"0\">"+
  
                          "</tbody></table></div></td>\n" +
                          "<td style=\"text-align: center\" class=\"hidden_mobile_view\" width=\"15%\">$ <span data-subtotal='"+b.amount_set+"' id='span_total_"+Rnumber+"' class=\"total_per_item\">"+b.amount_set+
                          "</span> <input type=\"hidden\" name=\"total[]\" id='sub_total_text"+Rnumber+"' value='"+b.amount_set+"'></td>" +
                      "</tr>";
                      tableBody = $("#jobs_items_table_body");
                      tableBody.append(markup);
                  });
                      
                      var inputs = "";
                          $.each(response['details'], function (i, v) {
                              inputs += v.package_name ;
                              // "<tr>"+
                              // "<td>"+ v.item_id +"</td>"+
                              // "<td>"+ v.quantity +"</td>"+
                              // "<td>"+ v.price +"</td>"+
                              // "</tr>"+
                          // });
  
                      markup2 = "<tr width=\"10%\" id=\"sss\">" +
                          // "<tr>"+
                              "<td></td>"+
                              "<td>"+ v.title +"</td>"+
                              "<td>"+ v.quantity +"</td>"+
                              "<td>"+ v.price +"</td>"+
                          "</tr>";
                      tableBody2 = $("#packageBody"+Randnumber);
                      tableBody2.append(markup2);
  
                  });
  
  
                  var priceqty2 = 0;
                  $('*[id^="priceqty_"]').each(function(){
                  priceqty2 += parseFloat($(this).val());
                  });
                  $("#item_total").val(priceqty2.toFixed(2));
                  $("#span_sub_total_invoice").text(priceqty2.toFixed(2));
  
                  
                  var subtotal = 0;
                  // $("#span_total_0").each(function(){
                  $('*[id^="span_total_"]').each(function(){
                  subtotal += parseFloat($(this).text());
                  });
                  var s_total = subtotal.toFixed(2);
                  var adjustment = $("#adjustment_input").val();
                  var grand_total = s_total - parseFloat(adjustment);
                  var markup = $("#markup_input_form").val();
                  var grand_total_w = grand_total + parseFloat(markup);
                  $("#grand_total_inputs").val(grand_total_w.toFixed(2));
                  $("#grand_total").text(grand_total_w.toFixed(2));
                  $("#grand_total_input").val(grand_total_w.toFixed(2)).trigger('change');
                  $("#payment_amount").val(grand_total_w.toFixed(2));
  
                  $("#balanceDueText").text(grand_total_w.toFixed(2));
  
          },
      });
  
      
  
      $(".createPackage").modal("hide");
      // $('#divcreatePackage').load(window.location.href +  '#divcreatePackage');
      // $(document.body).on('hidden.bs.modal', function () {
      //     $('.createPackage').removeData('bs.modal')
      // });
      $("#divcreatePackage").load(" #divcreatePackage");
  
  });

  $(".addNewPackageToList").click(function () {
    var packId = $(this).attr('pack-id');

    $.ajax({
        type : 'POST',
        url : "<?php echo base_url(); ?>workorder/addNewPackageToList",
        data : {packId: packId },
        dataType: 'json',
        success: function(response){

        // console.log(result);
        var Randnumber = 1 + Math.floor(Math.random() * 99999);

        console.log(response['pName']);

                    // var inputs1 = "";
                        $.each(response['pName'], function (a, b) {
                            // inputs1 += b.name;
                            var pName = b.name;
                            // var Rnumber = 3 + Math.floor(Math.random() * 9);
                            var Rnumber = Math.floor(Math.random()*(9999-10000+1)+100);

                        

                markup = "<tr id=\"ss\">" +
                        // "<td width=\"35%\"><input value='"+title+"' type=\"text\" name=\"items[]\" class=\"form-control getItems\" ><input type=\"hidden\" value='"+idd+"' name=\"item_id[]\"><div class=\"show_mobile_view\"><span class=\"getItems_hidden\">"+title+"</span></div><input type=\"hidden\" name=\"itemidPackage[]\" id=\"itemidPackage\" class=\"itemid\" value='"+idd+"'></td>\n" +
                        // "<td width=\"25%\"><div class=\"dropdown-wrapper\"><select name=\"item_typePackage[]\" class=\"form-control\"><option value=\"product\">Product</option><option value=\"material\">Material</option><option value=\"service\">Service</option><option value=\"fee\">Fee</option></select></div></td>\n" +
                        // "<td width=\"\"><input data-itemid='"+idd+"' id='quantity_package_"+idd+"' value='"+qty+"' type=\"number\" name=\"quantityPackage[]\" data-counter=\"0\"  min=\"0\" class=\"form-control quantityPackage2\"></td>\n" +
                        // "<td width=\"\"><input data-itemid='"+idd+"' id='price_package_"+idd+"' value='"+price+"'  type=\"number\" name=\"pricePackage[]\" class=\"form-control price_package2 hidden_mobile_view\" placeholder=\"Unit Price\"><input type=\"hidden\" class=\"priceqty\" id='priceqty_package_"+idd+"' value='"+total_+"'><div class=\"show_mobile_view\"><span class=\"price\">"+price+"</span></div></td>\n" +
                        // "<td>\n" +
                        // "<a href=\"#\" class=\"remove btn btn-sm btn-success\" id='"+idd+"'><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></a>\n" +
                        // "</td>\n" +
                        "<td colspan=\"6\" ><h6>"+ pName +"</h6><div><table class=\"table table-hover\" ><thead><th width=\"10%\" ></th><th>Item Name</th><th>Quantity</th><th>Price</th></thead> <tbody id='packageBody"+Randnumber+"'>" +
                        "<input type=\"hidden\" class=\"priceqty\" id='priceqty_"+Rnumber+"' value='"+b.amount_set+"'><input type=\"hidden\" name=\"itemid[]\" value=\"0\"><input type=\"hidden\" name=\"packageID[]\" value='"+b.id+"'><input type=\"hidden\" name=\"quantity[]\" value=\"1\"><input type=\"hidden\" name=\"price[]\" value='"+b.amount_set+"'><input type=\"hidden\" name=\"tax[]\" value=\"0\"><input type=\"hidden\" name=\"discount[]\" value=\"0\">"+

                        "</tbody></table></div></td>\n" +
                        "<td style=\"text-align: center\" class=\"hidden_mobile_view\" width=\"15%\">$ <span data-subtotal='"+b.amount_set+"' id='span_total_"+Rnumber+"' class=\"total_per_item\">"+b.amount_set+
                        "</span> <input type=\"hidden\" name=\"total[]\" id='sub_total_text"+Rnumber+"' value='"+b.amount_set+"'></td>" +
                    "</tr>";
                    tableBody = $("#jobs_items_table_body");
                    tableBody.append(markup);
                });
                    
                    var inputs = "";
                        $.each(response['details'], function (i, v) {
                            inputs += v.package_name ;
                            // "<tr>"+
                            // "<td>"+ v.item_id +"</td>"+
                            // "<td>"+ v.quantity +"</td>"+
                            // "<td>"+ v.price +"</td>"+
                            // "</tr>"+
                        // });

                    markup2 = "<tr width=\"10%\" id=\"sss\">" +
                        // "<tr>"+
                            "<td></td>"+
                            "<td>"+ v.title +"</td>"+
                            "<td>"+ v.quantity +"</td>"+
                            "<td>"+ v.price +"</td>"+
                        "</tr>";
                    tableBody2 = $("#packageBody"+Randnumber);
                    tableBody2.append(markup2);

                });


                var priceqty2 = 0;
                $('*[id^="priceqty_"]').each(function(){
                priceqty2 += parseFloat($(this).val());
                });
                $("#item_total").val(priceqty2.toFixed(2));
                $("#span_sub_total_invoice").text(priceqty2.toFixed(2));

                
                var subtotal = 0;
                // $("#span_total_0").each(function(){
                $('*[id^="span_total_"]').each(function(){
                subtotal += parseFloat($(this).text());
                });
                var s_total = subtotal.toFixed(2);
                var adjustment = $("#adjustment_input").val();
                var grand_total = s_total - parseFloat(adjustment);
                var markup = $("#markup_input_form").val();
                var grand_total_w = grand_total + parseFloat(markup);
                $("#grand_total_inputs").val(grand_total_w.toFixed(2));
                $("#grand_total").text(grand_total_w.toFixed(2));
                $("#grand_total_input").val(grand_total_w.toFixed(2)).trigger('change');
                $("#payment_amount").val(grand_total_w.toFixed(2));

                $("#balanceDueText").text(grand_total_w.toFixed(2));

        },
    });

    $(".createPackage").modal("hide");
    // $('#divcreatePackage').load(window.location.href +  '#divcreatePackage');
    // $(document.body).on('hidden.bs.modal', function () {
    //     $('.createPackage').removeData('bs.modal')
    // });
    // $("#divcreatePackage").load(" #divcreatePackage");

});

$(document).ready(function() {
  $(".btnAdd").click(function() {
      alert('test');
      $.ajax({
          type: "POST",
          url: "<?php echo base_url(); ?>accounting/customer_credit_memo_modal",
          success: function(returndata) {
              // $('#myModal').modal('show');
                alert('test');
              $('.testingNi').html(returndata);

              //  $('#myModal').html(returndata);
              $('#addcreditmemoModal').modal('show');
          },
          dataType: "html"
      });
  });

  $(".btn-markup-percent").click(function(){
    $(this).removeClass('btn-default');
    $(this).addClass('btn-success');

    $(".btn-markup-dollar").removeClass('btn-success');
    $(".btn-markup-dollar").addClass('btn-default');
  });

  $(".btn-markup-dollar").click(function(){
    $(this).removeClass('btn-default');
    $(this).addClass('btn-success');

    $(".btn-markup-percent").removeClass('btn-success');
    $(".btn-markup-percent").addClass('btn-default');
  });
});