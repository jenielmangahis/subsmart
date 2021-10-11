
$(".select_package").click(function() {
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


    $.ajax({
        type: 'POST',
        url: "<?php echo base_url(); ?>workorder/select_package",
        data: {
            idd: idd
        },
        dataType: 'json',
        success: function(response) {
            // alert('Successfully Change');
            console.log(response['items']);

            // var objJSON = JSON.parse(response['items'][0].title);
            var inputs = "";
            $.each(response['items'], function(i, v) {
                inputs += v.title;
                var total_pu = v.price * v.units;
                var total_tax = (v.price * v.units) * 7.5 / 100;
                var total_temp = total_pu + total_tax;
                var total = total_temp.toFixed(2);


                markup = "<tr id=\"ss\">" +
                    "<td width=\"35%\"><input value='" + v.title +
                    "' type=\"text\" name=\"items[]\" class=\"form-control getItems\" ><input type=\"hidden\" value='" +
                    v.id +
                    "' name=\"item_id[]\"><div class=\"show_mobile_view\"><span class=\"getItems_hidden\">" +
                    v.title + "</span></div></td>\n" +
                    "<td width=\"20%\"><div class=\"dropdown-wrapper\"><select name=\"item_type[]\" class=\"form-control\"><option value=\"product\">Product</option><option value=\"material\">Material</option><option value=\"service\">Service</option><option value=\"fee\">Fee</option></select></div></td>\n" +
                    "<td width=\"10%\"><input data-itemid='" + v.id +
                    "' id='quantity_" + v.id + "' value='" + v.units +
                    "' type=\"number\" name=\"quantity[]\" data-counter=\"0\"  min=\"0\" class=\"form-control qtyest2 mobile_qty \"></td>\n" +
                    "<td width=\"10%\"><input id='price_" + v.id + "' value='" + v
                    .price +
                    "'  type=\"number\" name=\"price[]\" class=\"form-control hidden_mobile_view \" placeholder=\"Unit Price\"><input type=\"hidden\" class=\"priceqty\" id='priceqty_" +
                    v.id + "' value='" + total_pu +
                    "'><div class=\"show_mobile_view\"><span class=\"price\">" + v
                    .price +
                    "</span><input type=\"hidden\" class=\"form-control price\" name=\"price[]\" data-counter=\"0\" id=\"priceM_0\" min=\"0\" value='" +
                    v.price + "'></div></td>\n" +
                    //   "<td width=\"10%\"><input type=\"number\" class=\"form-control discount\" name=\"discount[]\" data-counter=\"0\" id=\"discount_0\" value=\"0\" ></td>\n" +
                    // //  "<td width=\"10%\"><small>Unit Cost</small><input type=\"text\" name=\"item_cost[]\" class=\"form-control\"></td>\n" +
                    "<td width=\"10%\" class=\"hidden_mobile_view\"><input type=\"number\" name=\"discount[]\" class=\"form-control discount\" id='discount_" +
                    v.id + "' value=\"0\"></td>\n" +
                    // "<td width=\"25%\"><small>Inventory Location</small><input type=\"text\" name=\"item_loc[]\" class=\"form-control\"></td>\n" +
                    "<td width=\"20%\" class=\"hidden_mobile_view\"><input type=\"text\" data-itemid='" +
                    v.id +
                    "' class=\"form-control tax_change2\" name=\"tax[]\" data-counter=\"0\" id='tax1_" +
                    v.id + "' min=\"0\" value='" + total_tax + "'></td>\n" +
                    "<td style=\"text-align: center\" class=\"hidden_mobile_view\" width=\"15%\"><span data-subtotal='" +
                    total + "' id='span_total_" + v.id + "' class=\"total_per_item\">" +
                    total +
                    // "</span><a href=\"javascript:void(0)\" class=\"remove_item_row\"><i class=\"fa fa-times-circle\" aria-hidden=\"true\"></i></a>"+
                    "</span> <input type=\"hidden\" name=\"total[]\" id='sub_total_text" +
                    v.id + "' value='" + total + "'></td>" +
                    "<td>\n" +
                    '<a href="#" class="remove btn btn-sm btn-success"><i class="fa fa-trash" aria-hidden="true"></i></a>\n' +
                    "</td>\n" +
                    "</tr>";
                tableBody = $("#jobs_items_table_body");
                tableBody.append(markup);
                markup2 = "<tr id=\"sss\">" +
                    "<td >" + v.title + "</td>\n" +
                    "<td ></td>\n" +
                    "<td ></td>\n" +
                    "<td >" + v.price + "</td>\n" +
                    "<td ></td>\n" +
                    "<td >" + v.units + "</td>\n" +
                    "<td ></td>\n" +
                    "<td ></td>\n" +
                    "<td >0</td>\n" +
                    "<td ></td>\n" +
                    "<td ></td>\n" +
                    "</tr>";

            });
            // $("#input_container").html(inputs);

            tableBody2 = $("#device_audit_datas");
            tableBody2.append(markup2);
            // alert(inputs);

            var in_id = idd;
            var price = $("#price_" + in_id).val();
            var quantity = $("#quantity_" + in_id).val();
            var discount = $("#discount_" + in_id).val();
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

            var total_wo_tax = price * quantity;

            // alert( 'yeah' + total);


            $("#priceqty_" + in_id).val(total_wo_tax);
            $("#span_total_" + in_id).text(total);
            $("#sub_total_text" + in_id).val(total);
            $("#tax_1_" + in_id).text(tax1);
            $("#tax1_" + in_id).val(tax1);
            $("#discount_" + in_id).val(discount);

            if ($('#tax_1_' + in_id).length) {
                $('#tax_1_' + in_id).val(tax1);
            }

            if ($('#item_total_' + in_id).length) {
                $('#item_total_' + in_id).val(total);
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
            $('*[id^="price_"]').each(function() {
                total_cost += parseFloat($(this).val());
            });

            // var totalcosting = 0;
            // $('*[id^="span_total_"]').each(function(){
            //   totalcosting += parseFloat($(this).val());
            // });


            // alert(total_cost);

            var tax_tot = 0;
            $('*[id^="tax1_"]').each(function() {
                tax_tot += parseFloat($(this).val());
            });

            var over_tax = parseFloat(tax_tot).toFixed(2);
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
            $('*[id^="span_total_"]').each(function() {
                subtotal += parseFloat($(this).text());
            });
            // $('#sum').text(subtotal);

            var subtotaltax = 0;
            // $("#span_total_0").each(function(){
            $('*[id^="tax_1_"]').each(function() {
                subtotaltax += parseFloat($(this).text());
            });


            var priceqty2 = 0;
            $('*[id^="priceqty_"]').each(function() {
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
            $("#grand_total_input").val(grand_total_w.toFixed(2));
            $("#grand_total_inputs").val(grand_total_w.toFixed(2));

            var sls = (parseFloat(eqpt_cost).toFixed(2) * 7.5) / 100;
            sls = parseFloat(sls).toFixed(2);
            $("#sales_tax").val(sls);
            cal_total_due();


        },
        error: function(response) {
            alert('Error' + response);

    }
});

});

$(document).ready(function() {

    $('#sel-customer').change(function() {
        var id = $(this).val();
        // alert(id);

        $.ajax({
            type: 'POST',
            url: "<?php echo base_url(); ?>accounting/addLocationajax",
            data: {
                id: id
            },
            dataType: 'json',
            success: function(response) {
                // alert('success');
                // console.log(response['customer']);
                // $("#job_location").val(response['customer'].mail_add + ' ' + response['customer'].cross_street + ' ' + response['customer'].city + ' ' + response['customer'].state + ' ' + response['customer'].country);
                $("#job_location").val(response['customer'].mail_add);
                $("#email").val(response['customer'].email);
                $("#date_of_birth").val(response['customer'].date_of_birth);
                $("#phone_no").val(response['customer'].phone_h);
                $("#mobile_no").val(response['customer'].phone_m);
                $("#city").val(response['customer'].city);
                $("#state").val(response['customer'].state);
                $("#zip").val(response['customer'].zip_code);
                $("#cross_street").val(response['customer'].cross_street);

            },
            error: function(response) {
                alert('Error' + response);

            }
        });
    });


    $(document).on('click', '.setmarkup', function() {
        // alert('yeah');
        var markup_amount = $('#markup_input').val();

        $("#markup_input_form").val(markup_amount);
        $("#span_markup_input_form").text(markup_amount);
        $("#span_markup").text(markup_amount);

        $('#modalSetMarkup').modal('toggle');
    });
});

$(document).ready(function() {
     
	$('#filter_from').datepicker({
		 dateFormat: 'mm/dd/yy',
		 minDate: 0,
			 
	});

    $('#filter_to').datepicker({
		 dateFormat: 'mm/dd/yy',
		 minDate: 0,
			 
	});
});


function getItemCharge_k(obj) {
    var sk = jQuery(obj).val();
    var site_url = jQuery("#siteurl").val();
    jQuery.ajax({
      url: site_url + "items/getitem_Charge",
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
  // var over_tax = parseFloat(tax_tot).toFixed(2);
  // alert(over_tax);
  
  function setitemCharge(obj, title, price, discount, itemid) {
    // alert( 'yeah');
  // alert('setitemCM');
    jQuery(obj).parent().parent().find(".getItemCharge").val(title);
    jQuery(obj).parent().parent().parent().find(".pricedch").val(price);
    jQuery(obj).parent().parent().parent().find(".discountdch").val(discount);
    jQuery(obj).parent().parent().parent().find(".itemid").val(itemid);
    var counter = jQuery(obj)
      .parent()
      .parent()
      .parent()
      .find(".pricedch")
      .data("counter");
    jQuery(obj).parent().empty();
    calculationCharge(counter);
  }
  
  $(document).on("focusout", ".pricedch", function () {
    var counter = $(this).data("counter");
    calculationCharge(counter);
  });
  
  // $(document).on("focusout", ".quantitycm", function () {
  //   var counter = $(this).data("counter");
  //   calculationcm(counter);
  // });
  $(document).on("focusout", ".discountdch", function () {
    var counter = $(this).data("counter");
    calculationCharge(counter);
  });
  
  
  $(document).on("focusout", ".quantitydch2", function () {
    // var counter = $(this).data("counter");
  //   calculationcm(counter);
  // var idd = this.id;
  var idd = $(this).attr('data-itemid');
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
  
  //   alert( 'yeah' + total);
  
    $("#span_total_charge_" + in_id).text(total);
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
    var cnt = $("#count").val();
    var total_discount = 0;
    for (var p = 0; p <= cnt; p++) {
      var prc = $("#price_dch_" + p).val();
      var quantity = $("#quantity_" + p).val();
      var discount = $("#discount_dch_" + p).val();
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
  
    var subtotaldch = 0;
    // $("#span_total_0").each(function(){
      $('*[id^="span_total_charge_"]').each(function(){
      subtotaldch += parseFloat($(this).text());
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
    $("#span_sub_total_dch").text(subtotal.toFixed(2));
    $("#item_total_dch").val(subtotal.toFixed(2));
  
    var s_total = subtotal.toFixed(2);
    var adjustment = $("#adjustment_input_dch").val();
    var grand_total = s_total - parseFloat(adjustment);
    var markup = $("#markup_input_form").val();
    var grand_total_w = grand_total + parseFloat(markup);
  
    $("#total_tax_dch_").text(subtotaltax.toFixed(2));
    $("#total_tax_dch_").val(subtotaltax.toFixed(2));
  
  
    $("#grand_total_dch").text(grand_total_w.toFixed(2));
    $("#grand_total_dch_total").text(grand_total_w.toFixed(2));
    $("#grand_total_dc_total_val_dc").val(grand_total_w.toFixed(2));
    $("#grand_total_input").val(grand_total_w.toFixed(2));
  
    var sls = (parseFloat(eqpt_cost).toFixed(2) * 7.5) / 100;
    sls = parseFloat(sls).toFixed(2);
    $("#sales_tax").val(sls);
    cal_total_due();
  });
  
  function calculationCharge(counter) {
    // alert( 'yeah');
    var price = $("#price_dch_" + counter).val();
    var quantity = $("#quantity_" + counter).val();
    var discount = $("#discount_dch_" + counter).val();
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
  
    $("#span_total_charge_" + counter).text(total);
    $("#tax_1_" + counter).text(tax1);
    $("#tax_111_" + counter).text(tax1);
    $("#tax_1_" + counter).val(tax1);
    $("#discount_dch_" + counter).val(discount);
    $("#tax1_dch_" + counter).val(tax1);
    // $("#tax1_" + counter).val(tax1);
    // $("#tax_" + counter).val(tax1);
    // alert(tax1);
  
    if( $('#tax_1_'+ counter).length ){
      $('#tax_1_'+counter).val(tax1);
    }
  
    if( $('#item_total_dch_'+ counter).length ){
      $('#item_total_dch_'+counter).val(total);
    }
  
    // alert('dri');
  
    var eqpt_cost = 0;
    var cnt = $("#count").val();
    var total_discount = 0;
    for (var p = 0; p <= cnt; p++) {
      var prc = $("#price_dch_" + p).val();
      var quantity = $("#quantity_" + p).val();
      var discount = $("#discount_dch_" + p).val();
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
      $('*[id^="span_total_charge_"]').each(function(){
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
    $("#span_sub_total_dch").text(subtotal.toFixed(2));
    $("#item_total_dch").val(subtotal.toFixed(2));
  
    var s_total = subtotal.toFixed(2);
    var adjustment = $("#adjustment_input_dch").val();
    var grand_total = s_total - parseFloat(adjustment);
    var markup = $("#markup_input_form").val();
    var grand_total_w = grand_total + parseFloat(markup);
  
    $("#total_tax_dch_").text(subtotaltax.toFixed(2));
    $("#total_tax_input_dch").val(subtotaltax.toFixed(2));
  
  
    $("#grand_total_dch").text(grand_total_w.toFixed(2));
    $("#grand_total_dch_total").text(grand_total_w.toFixed(2));
    $("#grand_total_dc_total_val_dc").val(grand_total_w.toFixed(2));
    $("#grand_total_input").val(grand_total_w.toFixed(2));
    $("#grandtotal_input").val(grand_total_w.toFixed(2));
    // alert(grand_total_w);
  
    if($("#grand_total").length && $("#grand_total").val().length)
    {
      // console.log('none');
      // alert('none');
    }else{
      $("#grand_total_dch").text(grand_total_w.toFixed(2));
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

var over_tax = parseFloat(tax_tot).toFixed(2);
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

jQuery(document).ready(function() {
  $('#all_sales_table').DataTable({
      order: [[ 1, 'desc' ]],
  });
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

$(document).ready(function(){
 
  $('#sel-customer').change(function(){
  var id  = $(this).val();
 //  alert(id);
 
      $.ajax({
          type: 'POST',
          url:"<?php echo base_url(); ?>accounting/addLocationajax",
          data: {id : id },
          dataType: 'json',
          success: function(response){
             //  alert('success');
              console.log(response);
          $("#email").val(response['customer'].email);
          $("#billing_address").html(response['customer'].billing_address);
      
          },
              error: function(response){
              alert('Error'+response);
     
              }
      });
  });
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
    // var over_tax = parseFloat(tax_tot).toFixed(2);
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

    $(".select_itemcm").click(function () {
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
          "<td width=\"10%\"><input id='price_"+idd+"' value='"+price+"'  type=\"number\" name=\"price[]\" class=\"form-control\" placeholder=\"Unit Price\"></td>\n" +
          // "<td width=\"10%\"><input type=\"number\" class=\"form-control discount\" name=\"discount[]\" data-counter="0" id=\"discount_0\" min="0" value="0" ></td>\n" +
          // "<td width=\"10%\"><small>Unit Cost</small><input type=\"text\" name=\"item_cost[]\" class=\"form-control\"></td>\n" +
          "<td width=\"10%\"><input type=\"number\" name=\"discount[]\" class=\"form-control discount\" id='discount_"+idd+"'></td>\n" +
          // "<td width=\"25%\"><small>Inventory Location</small><input type=\"text\" name=\"item_loc[]\" class=\"form-control\"></td>\n" +
          "<td width=\"20%\"><input type=\"text\" data-itemid='"+idd+"' class=\"form-control tax_change2\" name=\"tax[]\" data-counter=\"0\" id='tax1_"+idd+"' min=\"0\" value='"+taxes_t+"'></td>\n" +
          "<td style=\"text-align: center\" class=\"d-flex\" width=\"15%\"><span data-subtotal='"+total_+"' id='span_total_"+idd+"' class=\"total_per_item\">"+total+
          // "</span><a href=\"javascript:void(0)\" class=\"remove_item_row\"><i class=\"fa fa-times-circle\" aria-hidden=\"true\"></i></a>"+
          "</span> <input type=\"hidden\" name=\"total[]\" id='sub_total_text"+idd+"' value='"+total+"'></td>" +
          "</tr>";
      tableBody = $("#items_table_body_credit_memo");
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
// var total_cost = 0;
var cnt = $("#count").val();
var total_discount = 0;
for (var p = 0; p <= cnt; p++) {
var prc = $("#price_" + p).val();
var quantity = $("#quantity_" + p).val();
var discount = $("#discount_" + p).val();
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
$('*[id^="price_"]').each(function(){
total_cost += parseFloat($(this).val());
});

var tax_tot = 0;
$('*[id^="tax1_"]').each(function(){
tax_tot += parseFloat($(this).val());
});

var over_tax = parseFloat(tax_tot).toFixed(2);
// alert(over_tax);

$("#sales_taxs").val(over_tax);
$("#total_tax_input").val(over_tax);
$("#total_tax_").text(over_tax);


eqpt_cost = parseFloat(eqpt_cost).toFixed(2);
total_discount = parseFloat(total_discount).toFixed(2);
stotal_cost = parseFloat(total_cost).toFixed(2);
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
// $("#item_total").val(subtotal.toFixed(2));
$("#item_total").val(stotal_cost);

var s_total = subtotal.toFixed(2);
var adjustment = $("#adjustment_input_cm").val();
var grand_total = s_total - parseFloat(adjustment);
var markup = $("#markup_input_form").val();
var grand_total_w = grand_total + parseFloat(markup);

// $("#total_tax_").text(subtotaltax.toFixed(2));
// $("#total_tax_").val(subtotaltax.toFixed(2));



$("#item_total").val(grand_total_w.toFixed(2));
$("#grand_total").text(grand_total_w.toFixed(2));
$("#grand_total_input").val(grand_total_w.toFixed(2));
$("#grand_total_cm_t").text(grand_total_w.toFixed(2));
$("#grand_total_cm").text(grand_total_w.toFixed(2));
$("#span_sub_total_cm").text(grand_total_w.toFixed(2));

var sls = (parseFloat(eqpt_cost).toFixed(2) * 7.5) / 100;
sls = parseFloat(sls).toFixed(2);
$("#sales_tax").val(sls);
cal_total_due();
});

// $('#addcreditmemoModal').modal({
//     backdrop: 'static',
//     keyboard: false
// });

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

$("#filter_estimates").click(function() {
  // alert('filter_estimates');
  
  // $('#sales_receipt_rows').hide();
  $("#sales_receipt_rows").parents("tr").hide();
});

$("#filter_unbilled").click(function() {
  alert('filter_unbilled');
});

$("#filter_overdue").click(function() {
  alert('filter_overdue');
});

$("#filter_invoices").click(function() {
  alert('filter_invoices');
});

$("#filter_paid30").click(function() {
  alert('filter_paid30');
});

// test datatable filter
// $(document).ready(function() {
//   function cbDropdown(column) {
//     return $('<ul>', {
//       'class': 'cb-dropdown'
//     }).appendTo($('<div>', {
//       'class': 'cb-dropdown-wrap'
//     }).appendTo(column));
//   }

//   $('#example').DataTable({
//     initComplete: function() {
//       this.api().columns().every(function() {
//         var column = this;
//         var ddmenu = cbDropdown($(column.header()))
//           .on('change', ':checkbox', function() {
//             var active;
//             var vals = $(':checked', ddmenu).map(function(index, element) {
//               active = true;
//               return $.fn.dataTable.util.escapeRegex($(element).val());
//             }).toArray().join('|');

//             column
//               .search(vals.length > 0 ? '^(' + vals + ')$' : '', true, false)
//               .draw();

//             // Highlight the current item if selected.
//             if (this.checked) {
//               $(this).closest('li').addClass('active');
//             } else {
//               $(this).closest('li').removeClass('active');
//             }

//             // Highlight the current filter if selected.
//             var active2 = ddmenu.parent().is('.active');
//             if (active && !active2) {
//               ddmenu.parent().addClass('active');
//             } else if (!active && active2) {
//               ddmenu.parent().removeClass('active');
//             }
//           });

//         column.data().unique().sort().each(function(d, j) {
//           var // wrapped
//             $label = $('<label>'),
//             $text = $('<span>', {
//               text: d
//             }),
//             $cb = $('<input>', {
//               type: 'checkbox',
//               value: d
//             });

//           $text.appendTo($label);
//           $cb.appendTo($label);

//           ddmenu.append($('<li>').append($label));
//         });
//       });
//     }
//   });
// });


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
})

// $('.close').on('hidden.bs.modal', function () {
//   $(this).find('form').trigger('reset');
// });

// $(document).on('click','#closeModalExpense',function () {
//   if(check_original != check_updated){
//       Swal.fire({
//           title: 'Are you sure?',
//           text: "You want to leave without saving?",
//           icon: 'warning',
//           showCancelButton: true,
//           confirmButtonColor: '#2ca01c',
//           cancelButtonColor: '#d33',
//           confirmButtonText: 'Yes, leave without saving!'
//       }).then((result) => {
//           if (result.value) {
//           if(attachment == 0){
//               Swal.fire({
//                   title: 'Are you sure?',
//                   text: "There is/are a attachment that temporarily removed?",
//                   icon: 'warning',
//                   showCancelButton: true,
//                   confirmButtonColor: '#2ca01c',
//                   cancelButtonColor: '#d33',
//                   confirmButtonText: 'Yes, remove it permanently!'
//               }).then((result) => {
//                   if (result.value) {
//                   $(".loader").fadeIn('fast',function(){
//                       $('.loader').show();
//                   });
//                   $('#edit-expensesCheck').modal('hide');
//                   $(".loader").fadeOut('fast',function(){
//                       $('.loader').hide();
//                   });
//                   attachment = null;
//                   attachment_id = [];
//               }
//           });
//           }else{
//               $(".loader").fadeIn('fast',function(){
//                   $('.loader').show();
//               });
//               $('#edit-expensesCheck').modal('hide');
//               $(".loader").fadeOut('fast',function(){
//                   $('.loader').hide();
//               });
//               attachment = null;
//               attachment_id = [];
//           }
//       }
//   });
//   }else{
//       if(attachment == 0){
//           Swal.fire({
//               title: 'Are you sure?',
//               text: "There is/are a attachment that temporarily removed?",
//               icon: 'warning',
//               showCancelButton: true,
//               confirmButtonColor: '#2ca01c',
//               cancelButtonColor: '#d33',
//               confirmButtonText: 'Yes, remove it permanently!'
//           }).then((result) => {
//               if (result.value) {
//               $.ajax({
//                   url:"/accounting/removePermanentlyAttachment",
//                   type:"POST",
//                   data:{attachment_id:attachment_id},
//                   success:function () {

//                   }
//               });
//               $(".loader").fadeIn('fast',function(){
//                   $('.loader').show();
//               });
//               $('#edit-expensesCheck').modal('hide');
//               $(".loader").fadeOut('fast',function(){
//                   $('.loader').hide();
//               });
//               attachment = null;
//               attachment_id = [];
//           }
//       });
//       }else{
//           $(".loader").fadeIn('fast',function(){
//               $('.loader').show();
//           });
//           $('#edit-expensesCheck').modal('hide');
//           $(".loader").fadeOut('fast',function(){
//               $('.loader').hide();
//           });
//           attachment = null;
//           attachment_id = [];
//       }
//   }
// });


$(".estchangestatus").click(function() {
  var id = $(this).attr('data-id');
  var est_number = $(this).attr('est-num');
  var est_status = $(this).attr('est-status');
  
  // alert('nisulod');
  $('#estchangestatus').modal('show'); 

  $('#est_number_status').text(est_number);
  $('.estID').val(id);
  $(".est_status").val(est_status);

});


$(".sendESTemail").click(function() {
  var id = $(this).attr('data-id');
  var est_number = $(this).attr('est-num');
  var est_status = $(this).attr('est-status');
  var est_email = $(this).attr('est-email');
  var est_cust = $(this).attr('est-cust');

  var message = 'Dear ' + est_cust + ', <br><br> Please review the estimate below.  Feel free to contact us if you have any questions.  <br> We look forward to working with you. <br><br> Thanks for your business!';
  
  // alert('nisulod');
  $('#sendESTemail').modal('show'); 

  $('#est_number_email').text(est_number);
  $('.estID').text(id);
  $('.custEmail').val(est_email);
  $('.custname').val(est_cust);
  $('.custmessage').val(`Dear {est_cust}, 
      
Please review the estimate below.  Feel free to contact us if you have any questions.  
We look forward to working with you. 
      
Thanks for your business!`);


});

$(".sendESTemail_sr").click(function() {
  var id = $(this).attr('data-id');
  var number = $(this).attr('sr-num');
  // var est_status = $(this).attr('est-status');
  var est_email = $(this).attr('est-email');
  var est_cust = $(this).attr('est-cust');

  var message = 'Dear ' + est_cust + ', <br><br> Please review the estimate below.  Feel free to contact us if you have any questions.  <br> We look forward to working with you. <br><br> Thanks for your business!';
  
  // alert('nisulod');
  $('#sendESTemail_sr').modal('show'); 

  $('#est_number_email_sr').text(number);
  $('.estID_sr').text(id);
  $('.custEmail_sr').val(est_email);
  // $('.custname').val(est_cust);
  $('.custmessage_sr').val(`Dear {est_cust}, 
      
  Please review the sales receipt below.
  We appreciate it very much.
  
  Thanks for your business!
  nSmarTrac`);


});

jQuery(function($){
  $("#custmessage").html(function() { 
    var Cname = $('.custname').val();

   return $(this).html().replace("{est_cust}", Cname);  
  
  });
});
