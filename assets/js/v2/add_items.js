function loadAddProductList(){
	$.ajax({
		type: "POST",
		url: base_url + "/items/_add_product_list",
		beforeSend:function(){
			$('#modal-product-list .modal-body .product-list-container').html('<span class="bx bx-loader bx-spin"></span>');
		},
		success: function(html)
		{
			setTimeout(
				function(){$('#modal-product-list .modal-body .product-list-container').html(html);}, 
			1000);    
		}
	});
}

function loadAddServicesList(){
	$.ajax({
		type: "POST",
		url: base_url + "/items/_add_services_list",
		beforeSend:function(){
			$('#modal-services-list .modal-body .services-list-container').html('<span class="bx bx-loader bx-spin"></span>');
		},
		success: function(html)
		{
			setTimeout(
				function(){$('#modal-services-list .modal-body .services-list-container').html(html);}, 
			1000);    
		}
	});
}

function productSearch(product_name){
	$.ajax({
		type: "POST",
		url: base_url + "/items/_add_product_list",
		data: {product_name:product_name},
		beforeSend:function(){
			$('#modal-product-list .modal-body .product-list-container').html('<span class="bx bx-loader bx-spin"></span>');
		},
		success: function(html)
		{
			setTimeout(
				function(){$('#modal-product-list .modal-body .product-list-container').html(html);}, 
			500);    
		}
	});
}

function serviceSearch(service_name){
	$.ajax({
		type: "POST",
		url: base_url + "/items/_add_services_list",
		data: {service_name:service_name},
		beforeSend:function(){
			$('#modal-services-list .modal-body .services-list-container').html('<span class="bx bx-loader bx-spin"></span>');
		},
		success: function(html)
		{
			setTimeout(
				function(){$('#modal-services-list .modal-body .services-list-container').html(html);}, 
			500);    
		}
	});
}

function computeItemTax(rate_percentage, item_cost){
	var total_tax_amount = (parseFloat(item_cost) * parseFloat(rate_percentage)) / 100;

	if( isNaN(total_tax_amount) ){
		return '0.00';
	}
	
	return total_tax_amount.toFixed(2);
}

function computeItemRowTotal(qty,item_cost,discount){
	var total_item_cost = (parseFloat(qty) * parseFloat(item_cost)) - parseFloat(discount);

	if( isNaN(total_item_cost) ){
		return '0.00';
	}
	
	return total_item_cost.toFixed(2);

}

function computeProductSubTotal(){
	var product_sub_total = 0;
	$('.row-product-qty').each(function(i, obj) {
		var row_number = $(obj).attr('data-row');
		var row_product_quantity = $(obj).val();
	    var row_product_price    = $('.row-product-price-'+row_number).val();
        var row_product_discount = $('.row-product-discount-'+row_number).val();
        var row_product_total    = computeItemRowTotal(row_product_quantity,row_product_price,row_product_discount);
		
		product_sub_total = parseFloat(product_sub_total) + parseFloat(row_product_total);
	});

	if( isNaN(product_sub_total) ){
		return '0.00';
	}
	
	return product_sub_total.toFixed(2);
}

function computeProductTotalTax(default_tax_percentage){
	var product_total_tax = 0;
	$('.row-product-qty').each(function(i, obj) {
		var row_number = $(obj).attr('data-row');
		var row_product_quantity = $('.row-product-qty-'+row_number).val();
	    var row_product_price    = $('.row-product-price-'+row_number).val();
        var row_product_discount = $('.row-product-discount-'+row_number).val();
        var row_product_total    = computeItemRowTotal(row_product_quantity,row_product_price,row_product_discount);
        var row_product_tax      = computeItemTax(default_tax_percentage, row_product_total);

		product_total_tax = parseFloat(product_total_tax) + parseFloat(row_product_tax);
	});

	if( isNaN(product_total_tax) ){
		return '0.00';
	}
	
	return product_total_tax.toFixed(2);
}

function computeServicesSubTotal(){
	var service_sub_total = 0;
	$('.row-service-qty').each(function(i, obj) {
		var row_number = $(obj).attr('data-row');
		var row_service_quantity = $(obj).val();
	    var row_service_price    = $('.row-service-price-'+row_number).val();
        var row_service_discount = $('.row-service-discount-'+row_number).val();
        var row_service_total    = computeItemRowTotal(row_service_quantity,row_service_price,row_service_discount);
		
		service_sub_total = parseFloat(service_sub_total) + parseFloat(row_service_total);
	});

	if( isNaN(service_sub_total) ){
		return '0.00';
	}
	
	return service_sub_total.toFixed(2);
}

function computeServicesTotalTax(default_tax_percentage){
	var service_total_tax = 0;
	$('.row-service-qty').each(function(i, obj) {
		var row_number = $(obj).attr('data-row');
		var row_service_quantity = $('.row-service-qty-'+row_number).val();
	    var row_service_price    = $('.row-service-price-'+row_number).val();
        var row_service_discount = $('.row-service-discount-'+row_number).val();
        var row_service_total    = computeItemRowTotal(row_service_quantity,row_service_price,row_service_discount);
        var row_service_tax      = computeItemTax(default_tax_percentage, row_service_total);

		service_total_tax = parseFloat(service_total_tax) + parseFloat(row_service_tax);
	});

	if( isNaN(service_total_tax) ){
		return '0.00';
	}
	
	return service_total_tax.toFixed(2);
}

function computeGradTotal(default_tax_percentage){
	var product_sub_total = computeProductSubTotal();
	var product_total_tax = computeProductTotalTax();
	var grand_total = parseFloat(product_sub_total) + parseFloat(product_total_tax);

	if( isNaN(grand_total) ){
		return '0.00';
	}
	
	return grand_total.toFixed(2);
}