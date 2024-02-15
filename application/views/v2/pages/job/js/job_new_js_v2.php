<script>
$(function(){

    //Quick Add
    $('.btn-quick-add-job-type').on('click', function(){
        $('#quick_add_job_type').modal('show');
    });
    $('.btn-quick-add-job-tag').on('click', function(){
        $('#quick_add_job_tag').modal('show');
    });
    
    $("#start_time").on( 'change', function () {
        var tag_id = this.value;
        var end_time = moment.utc(tag_id,'hh:mm a').add(<?= $time_interval; ?>,'hour').format('h:mm a');

        if(end_time === 'Invalid date') {
            $('#end_time').val("");
        }else{
            $('#end_time').val(end_time);
        }
    });

    $(".color-scheme").on("click", function(){
        var id = this.id;
        $('[id="job_color_id"]').val(id);
        $( "#"+id ).append( "<i class=\"bx bx-check calendar_button\" aria-hidden=\"true\"></i>" );
        remove_others(id);
    });

    $(document).on('click', '.btn-job-import', function(){
        var wid  = $(this).attr('data-id');
        var type = $(this).attr('data-type');

        location.href = base_url + `job/add?import_id=${wid}&type=${type}`;
    });

    function remove_others (color_id){
        $('.color-scheme').each(function(index) {
            var idd = this.id;
            if(idd !== color_id){
                $( "#"+idd ).empty();
            }
        });
    }

    $("#new_customer_form").submit(function(e) {
        $('#NEW_CUSTOMER_MODAL_CLOSE').click();
        e.preventDefault(); 
        var form = $(this);        
        $.ajax({
            type: "POST",
            url: base_url + "customer/_quick_add_customer",
            data: form.serialize(),
            dataType:'json',
            success: function(result)
            {
                if( result.is_success == 0 ){
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        html: result.msg
                    });
                }else{
                    var o = $("<option/>", {value: result.customer.id, text: result.customer.name});
                    $('#customer-id').append(o);
                    $('#customer-id option[value="' + result.customer.id + '"]').prop('selected',true);
                    $('#customer-id').trigger('change'); 
                }
            }
        });
    });
});

function formatPhoneNumber(phoneNumberString) {
    var cleaned = ('' + phoneNumberString).replace(/\D/g, '');
    var match = cleaned.match(/^(\d{3})(\d{3})(\d{4})$/);
    if (match) {
    return '(' + match[1] + ') ' + match[2] + '-' + match[3];
    }else{
    return phoneNumberString;
    }      
}

function load_import_workorder_data(){
    $.ajax({
        type: "POST",
        url: base_url + 'job/_list_workorder_import',
        beforeSend: function(response) {
            $('#import-workorder-container').html("<span class='bx bx-loader bx-spin'></span>");
        },
        success: function(html) {
            $('#import-workorder-container').html(html);
        },
        error: function(e) {
            
        }
    });
}

function searchImportWorkorderList(query){
	$.ajax({
		type: "POST",
		url: base_url + 'job/_list_workorder_import',
		data: {query:query},
		beforeSend:function(){
			$('#import-workorder-container').html('<span class="bx bx-loader bx-spin"></span>');
		},
		success: function(html)
		{
			setTimeout(
				function(){$('#import-workorder-container').html(html);}, 
			500);    
		}
	});
}

function load_import_invoice_data(){
    $.ajax({
        type: "POST",
        url: base_url + 'job/_list_invoice_import',
        beforeSend: function(response) {
            $('#import-invoice-container').html("<span class='bx bx-loader bx-spin'></span>");
        },
        success: function(html) {
            $('#import-invoice-container').html(html);
        },
        error: function(e) {
            
        }
    });
}

function searchImportInvoiceList(query){
	$.ajax({
		type: "POST",
		url: base_url + 'job/_list_invoice_import',
		data: {query:query},
		beforeSend:function(){
			$('#import-invoice-container').html("<span class='bx bx-loader bx-spin'></span>");
		},
		success: function(html)
		{
			setTimeout(
				function(){$('#import-invoice-container').html(html);}, 
			500);    
		}
	});
}

function load_import_estimate_data(){
    $.ajax({
        type: "POST",
        url: base_url + 'job/_list_estimate_import',
        beforeSend: function(response) {
            $('#import-estimate-container').html("<span class='bx bx-loader bx-spin'></span>");
        },
        success: function(html) {
            $('#import-estimate-container').html(html);
        },
        error: function(e) {
            
        }
    });
}

function searchImportEstimateList(query){
	$.ajax({
		type: "POST",
		url: base_url + 'job/_list_estimate_import',
		data: {query:query},
		beforeSend:function(){
			$('#import-estimate-container').html("<span class='bx bx-loader bx-spin'></span>");
		},
		success: function(html)
		{
			setTimeout(
				function(){$('#import-estimate-container').html(html);}, 
			500);    
		}
	});
}

function load_customer_data(customer_id){
    $.ajax({
        type: "POST",
        url: base_url + 'customer/_get_customer_data',
        data: {customer_id:customer_id},
        dataType:'json',
        beforeSend: function(response) {
            $('.MAP_LOADER').hide().html("<span class='bx bx-loader bx-spin'></span>").fadeIn('slow');
        },
        success: function(response) {
            setTimeout(function(){
                var customer_business_name = response.business_name;
                var customer_name = response.first_name + ' ' + response.last_name;
                var customer_email = response.email;
                var customer_phone = response.phone_h;
                var customer_mobile = response.phone_m;
                var customer_address = response.mail_add + ' ' + response.city + ', ' + ' ' + response.state + ' ' + response.zip_code;

                if( customer_business_name == '' ){
                    customer_business_name = 'Not Specified';
                }
                $('.info-customer-business-name').text(customer_business_name);

                if( customer_email == '' ){
                    customer_email = 'Not Specified';
                }
                $('.info-customer-email').text(customer_email);

                if( customer_phone == '' ){
                    customer_phone = 'Not Specified';
                }
                $('.info-customer-phone').text(customer_phone);

                if( customer_mobile == '' ){
                    customer_mobile = 'Not Specified';
                }
                $('.info-customer-mobile').text(customer_phone);

                $('.info-customer-name').text(customer_name);
                $('.info-customer-address').text(customer_address);

                var map_source = 'http://maps.google.com/maps?q='+customer_address+'&output=embed';
                var map_iframe = '<iframe id="TEMPORARY_MAP_VIEW" src="'+map_source+'" height="370" width="100%" style=""></iframe>';
                $('.MAP_LOADER').hide().html(map_iframe).fadeIn('slow');
            },700);                
        },
        error: function(e) {
            
        }
    });
}
</script>