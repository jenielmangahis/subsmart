<script>
$(document).ready(function() {        
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

    fetch('<?= base_url('job/get_customer_selected') ?>', {
        method: 'POST',
        body: postData
    }).then(response => response.json()).then(response => {
        var {success, data} = response;

        if(success){
            var phone_h = '(xxx) xxx-xxxx';
            var phone_m = '(xxx) xxx-xxxx';
            $('#cust_fullname').text(data.first_name + ' ' + data.last_name);
            // if(data.mail_add !== null){
            //     $('#cust_address').text(data.mail_add + ' ');
            // }
            if(data.cross_street != null){
                $('#cust_address').text(data.cross_street + ' ');
                ADDR_1 = data.cross_street;
            } else {
                $('#cust_address').text(data.mail_add + ' ');
                ADDR_1 = data.mail_add;
            }
            /*if(data.phone_h){
                if(data.phone_h.includes('Mobile:')){
                    phone_h = ((data.phone_h).slice(0,13))
                }else{
                    phone_h = data.phone_h;
                }
            }*/
            if( data.phone_m ){
                phone_m = formatNumber(data.phone_m);
            }
            
            if(data.city || data.state || data.zip_code){
                $('#cust_address2').text(data.city + ' ' + ' ' + data.state + ', ' + data.zip_code);
                ADDR_2 = data.city + ' ' + ' ' + data.state + ', ' + data.zip_code;
            }else{
                $('#cust_address2').text('-------------');
            }
            if(data.email){
                $('#cust_email').text(data.email);
            }else{
                $('#cust_email').text('Email is not available.');
            }
            $("#customer_preview").attr("href", "/customer/preview/"+data.prof_id);
            $('#cust_number').text(phone_m);
            $('#mail_to').attr("href","mailto:"+data.email);
            $("#TEMPORARY_MAP_VIEW").attr('src', 'http://maps.google.com/maps?q='+ADDR_1+' '+ADDR_2+'&output=embed');
            $('.MAP_LOADER').fadeIn();
            //$('#TEMPORARY_MAP_VIEW').hide();
        }
    })
}

function formatNumber(num) {
    num = num.replace(/(\d{3})(\d{3})(\d{4})/, "$1-$2-$3");
    return num;
}
</script>