<script>
$(document).ready(function() {      

    $('#btn-quick-add-job-type').on('click', function(){
        $('#modal-quick-add-job-type').modal('show');
    });

    $('#quick-add-job-type-form').on('submit', function(e){
        e.preventDefault();
        var url = base_url + 'job/_quick_create_job_type';

        $.ajax({
            type: "POST",
            url: url,
            dataType: 'json',
            data: $('#quick-add-job-type-form').serialize(),
            success: function(data) {    
                $('#btn-quick-add-job-type-submit').html('Save');                   
                if (data.is_success) {
                    $('#modal-quick-add-job-type').modal('hide');
                    $('#job_type_option').append($('<option>', {
                        value: data.job_type_name,
                        text: data.job_type_name
                    }));
                    $('#job_type_option').val(data.job_type_name);
                }else{
                    Swal.fire({
                        title: 'Error',
                        text: data.msg,
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        
                    });
                }
            },
            beforeSend: function() {
                $('#btn-quick-add-job-type-submit').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });

    $('#btn-quick-add-job-tag').on('click', function(){
        $('#modal-quick-add-job-tag').modal('show');
    });

    $('#quick-add-job-tag-form').on('submit', function(e){
        e.preventDefault();
        var url = base_url + 'job/_quick_create_job_tag';

        $.ajax({
            type: "POST",
            url: url,
            dataType: 'json',
            data: $('#quick-add-job-tag-form').serialize(),
            success: function(data) {    
                $('#btn-quick-add-job-tag-submit').html('Save');                   
                if (data.is_success) {
                    $('#modal-quick-add-job-tag').modal('hide');
                    $('#job_tags').append($('<option>', {
                        value: data.job_tag_name,
                        text: data.job_tag_name
                    }));
                    $('#job_tags').val(data.job_tag_name);
                }else{
                    Swal.fire({
                        title: 'Error',
                        text: data.msg,
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        
                    });
                }
            },
            beforeSend: function() {
                $('#btn-quick-add-job-tag-submit').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });
    
    $(".select_item").click(function () {
        var idd = this.id;
        var title = $(this).data('itemname');
        var price = $(this).data('price');
        var qty = $(this).data('quantity');
        var item_type = $(this).data('item_type');
        var total_ = price * qty;
        var total = parseFloat(total_).toFixed(2);
        var withCommas = Number(total).toLocaleString('en');
        markup = "<tr id=\"ss\">" +
            "<td width=\"35%\"><small>Item name</small><input readonly value='"+title+"' type=\"text\" name=\"item_name[]\" class=\"form-control\" ><input type=\"hidden\" value='"+idd+"' name=\"item_id[]\"></td>\n" +
            "<td><small>Qty</small><input min=\"0\" data-itemid='"+idd+"' id='"+idd+"' value='"+qty+"' type=\"number\" name=\"item_qty[]\" class=\"form-control item-qty-"+idd+" qty\" maxlength=\"1\"></td>\n" +
            "<td><small>Unit Price</small><input data-id='"+idd+"' min=\"0\" id='price"+idd+"' value='"+price+"'  type=\"number\" name=\"item_price[]\" class=\"form-control item-price \" step='any' placeholder=\"Unit Price\"></td>\n" +
            "<td><small>Item Type</small><input readonly type=\"text\" class=\"form-control\" value='"+item_type+"'></td>\n" +
            //"<td width=\"25%\"><small>Inventory Location</small><input type=\"text\" name=\"item_loc[]\" class=\"form-control\"></td>\n" +
            "<td><small>Amount</small><br><b data-subtotal='"+total_+"' id='sub_total"+idd+"' class=\"total_per_item\">$"+total+"</b></td>" +
            "<td style='vertical-align:middle;'><button type=\"button\" class=\"nsm-button btn-sm primary items_remove_btn remove_item_row mt-2\"><i class=\'bx bx-trash\'></i></button></td>\n" +

            "</tr>";
        tableBody = $("#jobs_items");
        tableBody.append(markup);
        markup2 = "<td></td>" +
                  "<td></td>" +
                  "<td></td>" +
                  "<td></td>" +
                  "<td></td>" +
                  "<td></td>" +
                  "<td></td>" +
                  "<td></td>";
        tableBody2 = $("#device_audit_datas");
        tableBody2.append(markup2);
        calculate_subtotal();

        var elem = document.getElementById('quick-add-job-table-items');
        elem.scrollTop = elem.scrollHeight;
    });

    function calculate_subtotal(tax=0, def=false, discount=0){
        var subtotal = 0 ;
        $('.total_per_item').each(function(index) {
            var idd = $(this).data('subtotal');
            // var idd = this.id;
            subtotal = Number(subtotal) + Number(idd);

        });
        var total = parseFloat(subtotal).toFixed(2);
        var tax_total=0;
        if((tax !== 0 || tax !== '') && def == false){
            tax_total = (Number(tax) / 100) * Number(total);
            total = Number(total) + Number(tax_total) - Number(discount);
            total = parseFloat(total).toFixed(2);
            tax_total =  parseFloat(tax_total).toFixed(2);
            var tax_with_comma = Number(tax_total).toLocaleString('en');
            $('#invoice_tax_total').html('$' + tax_with_comma);
            $('#tax_total_form_input').val(tax_with_comma);
        }else if((tax !== 0 || tax !== '') && def == true){
            total = Number(total)+ Number(tax) - Number(discount);
            total = parseFloat(total).toFixed(2);
            tax_total =  parseFloat(tax).toFixed(2);

            var tax_with_comma = Number(tax_total).toLocaleString('en');

            $('#invoice_tax_total').html('$' + tax_total);
        }
        var withCommas = Number(total).toLocaleString('en');
        if(tax_total < 1){
            $('#invoice_sub_total').html('$' + formatNumber(parseFloat(total).toFixed(2)));
        }
        if(discount > 0){
            $('#invoice_discount_total').html('$' + formatNumber(parseFloat(discount).toFixed(2)));
        }
        $('#invoice_overall_total').html('$' + formatNumber(parseFloat(total).toFixed(2)));
        $('#pay_amount').val(withCommas);
        $('#total_amount').val(total);
        $('#total2').val(total);
    }
    //$(".color-scheme").on( 'click', function () {});
    function formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    }
    function numberWithCommas(x) {
        return x.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",");
    }
    // get the changed quantity of each item on item list and multiply it to the cost and put in subtotal
    $("body").delegate(".qty", "keyup", function(){
        //console.log( "Handler for .keyup() called." );
        var id = this.id;
        var qty=this.value;
        var cost = $('#price'+id).val();
        var new_sub_total = Number(qty) * Number(cost);
        $('#sub_total'+id).data('subtotal',new_sub_total);
        $('#sub_total'+id).text('$' + formatNumber(parseFloat(new_sub_total).toFixed(2)));
        $('#device_sub_total'+id).text('$' + formatNumber(parseFloat(new_sub_total).toFixed(2)));
        $('#device_qty'+id).text(qty);
        calculate_subtotal();
    });

    $("body").delegate(".qty", "change", function(){
        //console.log( "Handler for .keyup() called." );
        var id = this.id;
        var qty=this.value;
        var cost = $('#price'+id).val();
        var new_sub_total = Number(qty) * Number(cost);
        $('#sub_total'+id).data('subtotal',new_sub_total);
        $('#sub_total'+id).text('$' + formatNumber(parseFloat(new_sub_total).toFixed(2)));
        $('#device_sub_total'+id).text('$' + formatNumber(parseFloat(new_sub_total).toFixed(2)));
        $('#device_qty'+id).text(qty);
        calculate_subtotal();
    });

    $("body").delegate(".item-price", "change", function(){
        //console.log( "Handler for .keyup() called." );
        var id   = $(this).attr('data-id');
        var qty  = $('.item-qty-'+id).val();
        var cost = $(this).val();
        var new_sub_total = Number(qty) * Number(cost);
        $('#sub_total'+id).data('subtotal',new_sub_total);
        $('#sub_total'+id).text('$' + formatNumber(parseFloat(new_sub_total).toFixed(2)));
        $('#device_sub_total'+id).text('$' + formatNumber(parseFloat(new_sub_total).toFixed(2)));
        $('#device_qty'+id).text(qty);
        calculate_subtotal();
    });

    $("body").delegate(".remove_item_row", "click", function(){
        $(this).parent().parent().remove();
        calculate_subtotal();
    });

    $("body").delegate(".remove_audit_item_row", "click", function(){
        $(this).parent().parent().parent().parent().remove();
        calculate_subtotal();
    });

    

    $("body").delegate(".edit_item_list", "click", function(){
        var id = this.id;
        var node = document.getElementById('device_qty'+id);
        var qty = node.textContent;
        $('#new_items').modal('show');
        $('#item_details_name').val($(this).data('name'));
        $('#item_details_qty').val(qty);
        $('#item_details_cost').val($(this).data('price'));
        $('#item_details_title').html('Edit Points and Location');
        load_item_location(id);
        load_item(id);

    });

    function load_item(id){
        $.ajax({
            type: "POST",
            data: {id : id},
            url: "<?= base_url() ?>/job/get_selected_item",
            success: function(data){
                var template_data = JSON.parse(data);
                $('#description').val(template_data.description);
                $('#brand').val(template_data.brand);
            }
        });
    }

    function load_item_location(id){
        $.ajax({
            type: "POST",
            data: {id : id},
            url: "<?= base_url() ?>/job/get_item_storage_location",
            success: function(data){
                var template_data = JSON.parse(data);
                var toAppend = '';
                $.each(template_data,function(i,o){
                    toAppend += '<option value='+o.name+'>'+o.name + ' - ' + o.qty +'</option>';
                });
                $('#item_location').append(toAppend);
            }
        });
    }

    // get the tax value and deduct it to subtotal then display over all total
    var taxRate = $('#invoice_tax_total').text();
    var discount = $('#invoice_discount_total').text();
    calculate_subtotal(taxRate, true, discount);

    $("#tax_rate").on( 'change', function () {
        var tax = this.value;
    var discount = $('#invoice_discount_total').text();
        calculate_subtotal(tax, false, discount);
    });

    // get the tax value and deduct it to subtotal then display over all total

    

    $("#library_template").on( 'change', function () {
        var lib_id = this.value;
        $.ajax({
            type: "POST",
            url: "<?= base_url() ?>/job/get_esign_selected",
            data: {id : lib_id}, // serializes the form's elements.
            success: function(data)
            {
                var template_data = JSON.parse(data);
                //$('#summernote').summernote('code', template_data.content);
            }
        });
    });


    $("#job_tags").on( 'change', function () {
        var tag_id = this.value;
        $.ajax({
            type: "POST",
            url: "<?= base_url() ?>/job/get_tag_selected",
            data: {id : tag_id}, // serializes the form's elements.
            success: function(data)
            {
                var template_data = JSON.parse(data);
                $('#job_tags_right').val(template_data.name);
            }
        });
    });

    //$('#summernote').summernote('code', '');
    /*$('#summernote').summernote({
        placeholder: 'Type Here ... ',
        tabsize: 2,
        height: 250,
    });*/

    $("#customer_id").on('change', function () {
        
        var customer_selected = this.value;
        if(customer_selected !== ""){
            load_customer_data(customer_selected);
        }else{
            $('#cust_fullname').text('xxxxx xxxxx');
            $('#cust_address').text('-------------');
            $('#cust_number').text('(xxx) xxx-xxxx');
            $('#cust_email').text('xxxxx@xxxxx.xxx');
            initMap();
        }
    });

    function get_employee_name($this){
        $.ajax({
            type: "POST",
            data: {id : $this.value},
            url: "<?= base_url() ?>/events/get_employee_selected",
            success: function(data){
                var emp_data = JSON.parse(data);
                if($this.id === 'employee2' ){
                    $('#emp2_id').val(emp_data.FName);
                }else if($this.id === 'employee3' ){
                    $('#emp3_id').val(emp_data.FName);
                }else if($this.id === 'employee4' ){
                    $('#emp4_id').val(emp_data.FName);
                }
            }
        });
    }

    var ITEMS_TABLE = $('#items_table').DataTable({
        "ordering": false,
    });
    $("#ITEM_CUSTOM_SEARCH").keyup(function() {
        ITEMS_TABLE.search($(this).val()).draw()
    });
    ITEMS_TABLE_SETTINGS = ITEMS_TABLE.settings();
});
    
function load_customer_data($id){
    var ADDR_1 = "";
    var ADDR_2 = "";
    var postData = new FormData();
    postData.append('id', $id);

    fetch(base_url + 'job/_get_customer_information', {
        method: 'POST',
        body: postData,        
    }).then(response => response.json()).then(response => {
        var phone_h = '(xxx) xxx-xxxx';
        var phone_m = '(xxx) xxx-xxxx';            
        if( response.phone_m != '' ){
            phone_m = formatNumber(response.phone_m);
        }

        var address1 = '';
        if( response.mail_add != '' && response.mail_add != 'NA' ){
            address1 = response.mail_add;
        }
        $('#cust_fullname').text(response.first_name + ' ' + response.last_name);        

        ADDR_2 = response.city + ' ' + ' ' + response.state + ', ' + response.zip_code;
        ADDR_1 = address1;
        
        if(response.email != ''){
            $('#cust_email').text(response.email);
        }else{
            $('#cust_email').text('Email is not available.');
        }

        var customer_address = ADDR_1 + ' ' + ADDR_2;
        var link_customer_address = `<a class="btn-use-different-address nsm-link" data-id="${response.prof_id}" href="javascript:void(0);">${customer_address}</a>`;
        $('#cust_address').text(address1);
        $('#cust_address2').html(link_customer_address);

        $('.btn-use-different-address').popover({
            placement: 'top',
            html : true, 
            trigger: "hover focus",
            content: function() {
                return 'Use other address';
            } 
        });

        $("#customer_preview").attr("href", "/customer/preview/"+response.prof_id);
        $('#cust_number').text(phone_m);
        $('#mail_to').attr("href","mailto:"+response.email);
        $("#TEMPORARY_MAP_VIEW").attr('src', 'http://maps.google.com/maps?q='+ADDR_1+' '+ADDR_2+'&output=embed');
        $('.MAP_LOADER').fadeIn();

        $('#job-location').val(customer_address);
        $('#job-address').val(response.mail_add);
        $('#job-city').val(response.city);
        $('#job-state').val(response.state);
        $('#job-zip').val(response.zip_code);

        $("#customer_cc_num").val(response.cc_num);
        $("#customer_cc_expiry_date_month").val(response.cc_exp_month);
        $("#customer_cc_expiry_date_year").val(response.cc_exp_year);
        $("#customer_cc_cvc").val(response.cc_cvc);

        var mmr  = parseFloat(response.mmr);
        var otps = parseFloat(response.otps);
        $("#plan-value").val(mmr.toFixed(2));
        $("#service-ticket-otp").val(otps.toFixed(2));
        $('#span_mmr').html(mmr.toFixed(2));
        $('#span_otp').html(otps.toFixed(2));

        $("#customer_check_account_number").val(response.acct_num);
        $("#customer_check_bank_name").val(response.bank_name);
        $("#customer_check_routing_number").val(response.routing_num);
        $("#customer_check_number").val(response.check_num);

        $("#customer_ach_account_number").val(response.acct_num);
        $("#customer_ach_routing_number").val(response.routing_num);

        //Start Emergency Contacts
        if( response.ec1_firstname != '' && response.ec1_firstname != null ){
            $('#contact_first_name1').val(response.ec1_firstname);
        }else{
            $('#contact_first_name1').val('');
        }

        if( response.ec1_lastname != '' && response.ec1_lastname != null ){
            $('#contact_last_name1').val(response.ec1_lastname);
        }else{
            $('#contact_last_name1').val('');
        }

        if( response.ec1_phone != '' && response.ec1_phone != null ){
            $('#contact_phone1').val(response.ec1_phone);
        }else{
            $('#contact_phone1').val('');
        }

        if( response.ec1_relationship != '' && response.ec1_relationship != null ){
            $('#contact_relationship1').val(response.ec1_relationship);
        }else{
            $('#contact_relationship1').val('');
        }


        if( response.ec2_firstname != '' && response.ec2_firstname != null ){
            $('#contact_first_name2').val(response.ec2_firstname);
        }else{
            $('#contact_first_name2').val('');
        }

        if( response.ec2_lastname != '' && response.ec2_lastname != null ){
            $('#contact_last_name2').val(response.ec2_lastname);
        }else{
            $('#contact_last_name2').val('');
        }

        if( response.ec2_phone != '' && response.ec2_phone != null ){
            $('#contact_phone2').val(response.ec2_phone);
        }else{
            $('#contact_phone2').val('');
        }

        if( response.ec2_relationship != '' && response.ec2_relationship != null ){
            $('#contact_relationship2').val(response.ec2_relationship);
        }else{
            $('#contact_relationship2').val('');
        }


        if( response.ec3_firstname != '' && response.ec3_firstname != null ){
            $('#contact_first_name3').val(response.ec3_firstname);
        }else{
            $('#contact_first_name3').val('');
        }

        if( response.ec3_lastname != '' && response.ec3_lastname != null ){
            $('#contact_last_name3').val(response.ec3_lastname);
        }else{
            $('#contact_last_name3').val('');
        }

        if( response.ec3_phone != '' && response.ec3_phone != null ){
            $('#contact_phone3').val(response.ec3_phone);
        }else{
            $('#contact_phone3').val('');
        }

        if( response.ec3_relationship != '' && response.ec3_relationship != null ){
            $('#contact_relationship3').val(response.ec3_relationship);
        }else{
            $('#contact_relationship3').val('');
        }
        //End Emergency contacts

        if( response.bill_method == 'CC' ){
            $('#bill_method').val('CC');
            $('.grp-billing-cc').show();
            $('.grp-billing-check').hide();
            $('.grp-billing-ach').hide();
        }else if( response.bill_method == 'ACH' ){
            $('#bill_method').val('ACH');
            $('.grp-billing-cc').hide();
            $('.grp-billing-check').hide();
            $('.grp-billing-ach').show();
        }else{
            $('#bill_method').val('CHECK');
            $('.grp-billing-cc').hide();
            $('.grp-billing-check').show();
            $('.grp-billing-ach').hide();
        }
    })
}

function formatNumber(num) {
    num = num.replace(/(\d{3})(\d{3})(\d{4})/, "$1-$2-$3");
    return num;
}
</script>