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
function setitem(obj, title, price, discount, itemid) {
  jQuery(obj).parent().parent().find(".getItems").val(title);
  jQuery(obj).parent().parent().parent().find(".price").val(price);
  jQuery(obj).parent().parent().parent().find(".discount").val(discount);
  jQuery(obj).parent().parent().parent().find(".itemid").val(itemid);
  var counter = jQuery(obj)
    .parent()
    .parent()
    .parent()
    .find(".price")
    .data("counter");
  jQuery(obj).parent().empty();
  calculation(counter);
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
$(document).on("focusout", ".markup_input", function () {
  // alert('yeah');
  var counter = $(this).data("counter");
  calculation(counter);
});

$(document).on("focusout", ".adjustment_input", function () {
  var counter = $(this).data("counter");
  calculation(counter);
});

$(document).on("focusout", ".setmarkup", function () {
  var counter = $(this).data("counter");
  calculation(counter);
});

$(document).on('change','#span_total_0',function(){
    alert('Change Happened');
});

$(document).on("focusout", ".quantity", function () {
  var counter = $(this).data("counter");
  calculation(counter);
});
$(document).on("focusout", ".discount", function () {
  var counter = $(this).data("counter");
  calculation(counter);
});

function calculation(counter) {
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
  $("#tax_" + counter).val(tax1);

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

  var sls = (parseFloat(eqpt_cost).toFixed(2) * 7.5) / 100;
  sls = parseFloat(sls).toFixed(2);
  $("#sales_tax").val(sls);
  cal_total_due();
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
  jQuery(obj).parent().parent().find(".getItems").val(title);
  jQuery(obj).parent().parent().parent().find(".price").val(price);
  jQuery(obj).parent().parent().parent().find(".discount").val(discount);
  jQuery(obj).parent().parent().parent().find(".itemid").val(itemid);
  var counter = jQuery(obj)
    .parent()
    .parent()
    .parent()
    .find(".price")
    .data("counter");
  jQuery(obj).parent().empty();
  calculation(counter);
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

$(document).on("focusout", ".quantity", function () {
  var counter = $(this).data("counter");
  calculation(counter);
});
$(document).on("focusout", ".discount", function () {
  var counter = $(this).data("counter");
  calculation(counter);
});

function calculation(counter) {
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
  $("#span_tax_" + counter).text(tax1);
  $("#discount_" + counter).val(discount);

  if( $('#tax_'+ counter).length ){
    $('#tax_'+counter).val(tax1);
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
  

  $("#grand_total").text(grand_total_w.toFixed(2));
  $("#grand_total_input").val(grand_total_w.toFixed(2));

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

$(document).on("click", ".remove", function (e) {
  e.preventDefault();
  $(this).parent().parent().remove();
  var count = parseInt($("#count").val()) - 1;
  $("#count").val(count);
  calculation(count);
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

