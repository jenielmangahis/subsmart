<?php
if(isset($jobs_data)){
    $customer = $jobs_data->customer_id;
}else{
    $customer = 0;
}
?>

<script>
<?php 
$ALERT_SESSION = $this->session->userdata('CREATE_INITIAL_INVOICE_ALERT');
if ($jobs_data && $jobs_data->status == "Scheduled" && $ALERT_SESSION == "true") { ?>
    Swal.fire({
        title: 'Job has been scheduled',
        text: 'An initial invoice can now be created',
        icon: 'success',
        confirmButtonText: 'Create Initial Invoice',
    }).then((result) => {
        var redirect_calendar = $('#redirect-calendar').val();
        if (redirect_calendar == 1) {
            window.location.href = '<?= base_url(); ?>workcalender';
        } else {
            <?php $this->session->set_userdata('CREATE_INITIAL_INVOICE_ALERT', 'false'); ?>
            window.open("<?php echo base_url('job/createInvoice/').$jobs_data->id; ?>", '_blank', 'location=yes,height=650,width=1200,scrollbars=yes,status=yes');
            return;
        }
        <?php $this->session->set_userdata('CREATE_INITIAL_INVOICE_ALERT', 'false'); ?>
    });
<?php } ?>


$(".REMOVE_THUMBNAIL").click(function(event) {
    event.preventDefault();
    $("#attachment-file").val(null);
    $("#attachment-image").attr("src", null);
    $("#attachment").val(null);
    $(".IMG_PREVIEW, .REMOVE_THUMBNAIL").addClass("d-none");
    $(".THUMBNAIL_BOX").removeClass("d-none");
});
$("#attachment-file").change(function() {
    var input = document.getElementById('attachment-file');
    var fileName = document.getElementById("attachment-file").value;
    var idxDot = fileName.lastIndexOf(".") + 1;
    var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
    if (extFile != "") {
        if (extFile == "jpg" || extFile == "jpeg" || extFile == "png" || extFile == "bmp" || extFile == "ico" || extFile == ".jfif" || extFile == ".pjpeg" || extFile == ".pjp") {
            $(".IMG_PREVIEW, .REMOVE_THUMBNAIL").removeClass("d-none");
            $(".THUMBNAIL_BOX").addClass("d-none");
            var fileInput = document.getElementById('attachment-file');
            var file = fileInput.files[0];
            var formDatas = new FormData();
            formDatas.append('file', file);
            // console.log(formDatas);
            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: "<?= base_url() ?>/job/add_job_attachments",
                data: formDatas,
                processData: false,
                contentType: false,
                cache: false,
                beforeSend: function() {

                },
                success: function(data) {
                    if (data.search("png") != -1 || data.search("jpeg") != -1 || data.search("jpg") != -1 || data.search("bmp") != -1 || data.search("ico") != -1 || data.search("jfif") != -1 || data.search("pjpeg") != -1 || data.search("pjp") != -1) {
                        $('#attachment').val('/' + data);
                        $("#attachment-image").attr("src", base_url + data);
                    } else {
                        $(".IMG_PREVIEW, .REMOVE_THUMBNAIL").addClass("d-none");
                        $(".THUMBNAIL_BOX").removeClass("d-none");
                    }
                },
                error: function(e) {
                    console.log("ERROR : ", e);
                }
            });
        } else {
            error('', 'Only png, jpg, jpeg, bmp or ico files are allowed for Thumbnails!', 'error');
        }
    }
});


    $( window ).on( "load", function() {
    var cust_id = <?php echo $customer  ?>;
      fetch('<?= base_url() ?>/job/get_customers', {
                method: 'GET',
            }) .then(response => response.json() ).then(response => {
              var { message, data } = response;
              if(message){
                var toAppend = '';
                $.each(data,function(i,o){
                    var selected = '';
                    if(o.prof_id == cust_id){
                        selected = "selected";
                    }
                    toAppend += '<option '+selected+' value='+o.prof_id+'>'+o.first_name + ' ' + o.last_name +'</option>';
                });
                $('#customer_id').append(toAppend);
              }
            })
            
    });

    // function get_customers($id=null){
    //     $.ajax({
    //         type: "GET",
    //         url: "<?= base_url() ?>/job/get_customers",
    //         success: function(data)
    //         {
    //             //console.log(data);
    //             var template_data = JSON.parse(data);
    //             var toAppend = '';
    //             $.each(template_data,function(i,o){
    //                 var selected = '';
    //                 if(o.prof_id == $id){
    //                     selected = "selected";
    //                 }
    //                 //console.log(cust_id);
    //                 toAppend += '<option '+selected+' value='+o.prof_id+'>'+o.last_name + ', ' + o.first_name +'</option>';
    //             });
    //             $('#customer_id').append(toAppend);
    //             //console.log(template_data);
    //         }
    //     });
    //     if($id != null){
    //         load_customer_data($id);
    //     }
    // }

    

    function loadStreetView(address)
    {
        $.ajax({
            type: "POST",
            url: "<?= base_url() ?>job/loadStreetView",
            data: {address : address}, // serializes the form's elements.
            success: function(data)
            {
                $('#streetViewBody').html(data);
            }
        });
    }
    

    $(document).ready(function() {
        load_customer_data(<?= $customer  ?>);
        // var id1 = <?php echo $customer  ?>;
        // var postData1 = new FormData();
        // postData1.append('id', id1);

        // fetch('<?= base_url('job/get_customer_selected') ?>', {
        //     method: 'POST',
        //     body: postData1
        // }).then(response => response.json()).then(response => {
        //     console.log(response);
        //     var {success, data} = response;

        //     if(success){
        //         var phone_h = '(xxx) xxx-xxxx';
        //         $('#cust_fullname').text(data.first_name + ' ' + data.last_name);
        //         if(data.mail_add !== null){
        //             $('#cust_address').text(data.mail_add + ' ');
        //         }
        //         if(data.phone_h){
        //             if(data.phone_h.includes('Mobile:')){
        //             phone_h = ((data.phone_h).slice(0,13))
        //         }else{
        //             phone_h = data.phone_h;
        //         }
        //         }
        //         if(data.city || data.state || data.zip_code){
        //             $('#cust_address2').text(data.city + ',' + ' ' + data.state + ' ' + data.zip_code);
        //         }else{
        //             $('#cust_address2').text('-------------');
        //         }

        //         if(data.email){
        //             $('#cust_email').text(data.email);
        //         }else{
        //             $('#cust_email').text('xxxxx@xxxxx.xxx');
        //         }
        //         $("#customer_preview").attr("href", "/customer/preview/"+data.prof_id);
        //         $('#cust_number').text(phone_h);
        //         $('#mail_to').attr("href","mailto:"+data.email);
        //         initMap(data.mail_add + ' ' + data.city + ' ' + ' ' + data.state + ' ' + data.zip_code);
        //         loadStreetView(data.mail_add + ' ' + data.city + ',' + ' ' + data.state + ' ' + data.zip_code);
            
        //     }
        // })
        //JOB
        $("#jobs_form").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            $(".customer_message_input").val(window.CKEDITOR.instances.Message_Editor.getData());
            if($('#job_color_id').val()=== ""){
                error('Error','Event Color is required','error');
            }else if( $('#EMPLOYEE_SELECT_2').val() === "" ){
                error('Error','Assigned To is required','error');
            }else{

                var form = $(this);
                console.log(form);
                const $overlay = document.getElementById('overlay');
 
                //var url = form.attr('action');
                $.ajax({
                    type: "POST",
                    url: "<?= base_url() ?>/job/save_job",
                    data: form.serialize(), // serializes the form's elements.
                    dataType:'json',
                    success: function(data) {
                        if( data.is_success == 1 ){
                            if ($overlay) $overlay.style.display = "none";
                            sucess_add_job(data);
                            if ($('#SEND_EMAIL_ON_SCHEDULE').prop('checked') == true) {
                                $.get("<?= base_url('job/sendCustomerJobScheduled/').$jobs_data->id; ?>"+data.job_id); 
                            }
                        }else{
                            error('Error',data.msg,'error');
                        }
                        
                    }, beforeSend: function() {
                        if ($overlay) $overlay.style.display = "flex";
                    }
                });
            }
        });
        
        $("#fill_esign_btn").click(function () {
            $.ajax({
                type: "GET",
                url: "<?= base_url() ?>/job/get_esign_template",
                success: function(data)
                {
                    var template_data = JSON.parse(data);
                    var toAppend = '';
                    $.each(template_data,function(i,o){
                        toAppend += '<option value='+o.esignLibraryTemplateId+'>'+o.title+'</option>';
                    });
                    $('#library_template').append(toAppend);
                }
            });
        });

        $(".estimate_select").click(function () {
            var idd = this.id;
            $('#customer_id').empty().append('<option value="">Select Existing Customer</option>');
            get_customers(idd);
        });

        $(".workorder_select").click(function () {
            window.location.href='<?= base_url(); ?>job/work_order_job/'+this.id;
            //$('#customer_id').empty().append('<option value="">Select Existing Customer</option>');
            //get_customers(idd);
        });

        $(".invoice_select").click(function () {
            var idd = this.id;
            $('#customer_id').empty().append('<option value="">Select Existing Customer</option>');
            get_customers(idd);
        });

        $(".select_item").click(function () {
            var idd = this.id;
            var title = $(this).data('itemname');
            var price = parseInt($(this).attr('data-price'));
            var qty = parseInt($(this).attr('data-quantity'));
            var location_name = $(this).data('location_name');
            var location_id = $(this).data('location_id');
            var item_type = $(this).data('item_type');
            // var total_ = price * qty;
            var total_ = 0;
            var total = parseFloat(total_).toFixed(2);
            var withCommas = Number(total).toLocaleString('en');
            $("#ITEMLIST_PRODUCT_"+idd).hide();
            markup = "<tr id='ss'>" +
                "<td width='35%'><small>Item name</small><input readonly value='"+title+"' type='text' name='item_name[]' class='form-control' ><input type='hidden' value='"+idd+"' name='item_id[]'></td>" +
                "<td><small>Qty</small><input data-itemid='"+idd+"' id='"+idd+"' value='0' type='number' name='item_qty[]' class='form-control item-qty-"+idd+" qty' min='0' max='"+qty+"'></td>" +
                "<td><small>Unit Price</small><input data-id='"+idd+"' id='price"+idd+"' value='"+price+"'  type='number' name='item_price[]' class='form-control item-price' step='any' placeholder='Unit Price'></td>" +
                "<td><small>Item Type</small><input readonly type='text' class='form-control' value='"+item_type+"'></td>" +
                // "<td width='25%'><small>Inventory Location</small><input type='text' name='item_loc[]' class='form-control'></td>" +
                "<td><small>Amount</small><br><b data-subtotal='"+total_+"' id='sub_total"+idd+"' class='total_per_item'>$"+total+"</b></td>" +
                "<td><button type='button' class='nsm-button items_remove_btn remove_item_row mt-2' onclick='$(`#ITEMLIST_PRODUCT_"+idd+"`).show();'><i class='bx bx-trash'></i></button></td>" +
                "</tr>";
            tableBody = $("#jobs_items");
            tableBody.append(markup);
            // markup2 = "<tr id=\"sss\">" +
            //     "<td >"+title+"</td>\n" +
            //     "<td >0</td>\n" +
            //     "<td >"+price+"</td>\n" +
            //     "<td id='device_qty"+idd+"'>"+qty+"</td>\n" +
            //     "<td id='device_sub_total"+idd+"'>"+total+"</td>\n" +
            //     "<td ></td>\n" +
            //     "<td ><a href=\"#\" data-name='"+title+"' data-price='"+price+"' data-quantity='"+qty+"' id='"+idd+"' class=\"edit_item_list\"><span class=\"fa fa-edit\"></span></a> </td>\n" + // <a href="javascript:void(0)" class="remove_audit_item_row"><span class="fa fa-trash"></span></i></a>
            //     "</tr>";
            markup2 = "<td></td>" +
                      "<td></td>" +
                      "<td></td>" +
                      "<td></td>" +
                      "<td></td>" +
                      "<td></td>" +
                      "<td></td>" +
                      "<td></td>";

            //device audit
            markup3 ="<tr id='ss'>" +
                "<td>" + title + "</td>" +
                "<td>" + item_type + "</td>" +
                "<td></td>" +
                "<td>" + price + "</td>" +
                "<td id='device_qty"+idd+"'>"+ qty + "</td>" +
                "<td id='device_sub_total"+idd+"'>" + total + "</td>" +
                "<td>" +
                "<input hidden name='item_id1[]' value='"+ idd +"'>" +
                "<input hidden name='location_qty[]' id='location_qty"+idd+"' value='"+ qty +"'>" +
                "<select id='location"+idd+"' name='location[]' class='form-control location'>" +
                "<option>Select Location</option>" +
                "<option value='" +location_id+ "' selected>" +location_name+ "</option>" +
                "<?php if ($getAllLocation) { foreach ($getAllLocation as $getAllLocations) { echo "<option value='$getAllLocations->loc_id'>$getAllLocations->location_name</option>"; } } ?>" +
                "</select>" +
                "</td>";

            tableBody3 = $("#device_audit_append");
            tableBody3.append(markup3);


            tableBody2 = $("#device_audit_datas");
            tableBody2.append(markup2);
            calculate_subtotal();
            $(".location").select2({
                placeholder: "Choose Location"
            });
        });

        async function getLoc(id, qty) {
            var postData = new FormData();
            postData.append('id', id);
            postData.append('qty', qty);
            fetch('<?= base_url('job/getItemLocation') ?>',{
                method: 'POST',
                body: postData
            }).then(response => response.json()).then(response => {
                var { locations } = response;
                var select = document.querySelector('#location'+id);
                const locations_len = Object.keys(locations);
                // Avoid TypeError: Cannot set properties of null (setting 'innerHTML')
                if (select === null) return;
                console.log(locations);
                select.innerHTML = '';
                // Loop through each location and append a new option element to the select
                if(locations_len.length > 1){
                    var options = document.createElement('option');
                    options.text = "Select Location";
                    options.value = "0";
                    select.appendChild(options);
                }
                

                // Get all the location name promises
                var promises = locations.map(function(location) {
                    return getLocName(location.loc_id);
                });

                // Wait for all the promises to resolve
                Promise.all(promises).then(function(names) {
                    // Loop through each location and append a new option element to the select
                    locations.forEach(function(location, index) {
                        var option = document.createElement('option');
                        option.text = names[index];
                        option.value = location.id;
                        select.appendChild(option);
                    }); 
                });
            }).catch((error) =>{
                console.log(error);
            })
        }

        function getLocName(id){
            var postData = new FormData();
            postData.append('id', id);
            return fetch('<?= base_url('inventory/getLocationNameById') ?>',{
                method: 'POST',
                body: postData
            }).then(response => response.json()).then(response => {
                var { location } = response;
                return location.location_name;
            }).catch((error) =>{
                console.log(error);
            })
        }

        function calculate_subtotal(tax=0, def=false, discount=0){
            console.log("Calculating subtotal...");
            var subtotal = 0 ;
            $('.total_per_item').each(function(index) {
                var idd = $(this).data('subtotal');
                // var idd = this.id;
                subtotal = Number(subtotal) + Number(idd);

            });
            var total = parseFloat(subtotal).toFixed(2);
            var tax_total=0;

            if( tax == 0 ){
                //For tax selected
                if( $('#tax_rate').val() != '' ){
                    var tax = $('#tax_rate').val();
                    var discount = $('#invoice_discount_total').text();
                }
            }

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
                        
            const $requestedDeposit = document.getElementById("invoice_requested_deposit");
            if ($requestedDeposit && $requestedDeposit.dataset.value) {
                const value = parseFloat($requestedDeposit.dataset.value);
                const invoiceTotal = parseFloat(parseFloat(total) - value);
                total = parseFloat(invoiceTotal).toFixed(2);                
                $("#invoice_overall_total_without_deposited_amount").html('$' + formatNumber(total));
            }

            const adjustmentIdSelectors = ["adjustment_ic", "adjustment_otps", "adjustment_mm"];
            adjustmentIdSelectors.forEach(selector => {
                const $element = document.getElementById(selector);
                if ($element) {
                    total = parseFloat(parseFloat(total) + parseFloat($element.value)).toFixed(2);                
                }
            })

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
        window.__calculate_subtotal = calculate_subtotal;
        //$(".color-scheme").on( 'click', function () {});
        function formatNumber(num) {
            num = num.replace(/(\d{3})(\d{3})(\d{4})/, "$1-$2-$3");
            return num;
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
            $('#location_qty'+id).val(qty);
            // getLoc(id, qty);
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
            $('#location_qty'+id).val(qty);
            // getLoc(id, qty);
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
            var row = $(this).closest('tr');
            var index = row.index();
            $('.job_items_tbl tr').filter(function() {
                return $(this).index() === index;
            }).remove();
            $('#device_audit tr').filter(function() {
                return $(this).index() === index;
            }).remove();
            // $(this).parent().parent().remove();
            console.log(row);
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
                    $('#summernote').summernote('code', template_data.content);
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

        $("#start_time").on( 'change', function () {
            var tag_id = this.value;
            var end_time = moment.utc(tag_id,'hh:mm a').add(<?= $settings['job_time_setting']; ?>,'hour').format('h:mm a');

            if(end_time === 'Invalid date') {
                $('#end_time').val("");
            }else{
               $('#end_time').val(end_time);
            }
        });

        $("#job_type_option").on( 'change', function () {
            var type_id = this.value;
            $.ajax({
                type: "POST",
                url: "<?= base_url() ?>/job/get_type_selected",
                data: {id : type_id}, // serializes the form's elements.
                success: function(data)
                {
                    var template_data = JSON.parse(data);
                    $('#job_type').val(template_data.title);
                }
            });
        });

        //$('#summernote').summernote('code', '');
        $('#summernote').summernote({
            placeholder: 'Type Here ... ',
            tabsize: 2,
            height: 250,
        });
        // var signaturePad = new SignaturePad(document.getElementById('signature-pad'));
        // $('#click').click(function(e){
        //     e.preventDefault();
        //     var data = signaturePad.toDataURL('image/png');
        //     $('#output').val(data);
        //     var url = '<?= base_url() ?>/job/save_esign';
        //     $.ajax({
        //         url: url,
        //         type: "POST",
        //         data:{base64: data}
        //     }).done(function(e){
        //         //$('#updateSignature').modal('hide');
        //         var name = $('#authorizer_name').val();
        //         $('#authorizer').html(name);
        //         $('#appoval_name_right').html(name);
        //         $('#date_signed').html(e);
        //         $('#datetime_signed').val(e);
        //         $('#name').val(name);
        //         $('#signature_link').val(data);
        //         $("#customer-signature").attr("src",data);
        //         $("#customer_signature_right").attr("src",data);
        //         //location.reload();
        //     });
        // });

        // $('#clear-signature').click(function(e){
        //     signaturePad.clear();
        // });

        <?php if(isset($jobs_data) && $jobs_data->status == 'Started') : ?>
            document.getElementById('check_form').style.display = "none";
            document.getElementById('cash_form').style.display = "none";
            document.getElementById('ach_form').style.display = "none";
            document.getElementById('others_warranty_form').style.display = "none";
            document.getElementById('svp_form').style.display = "none";
        <?php endif; ?>

        $("#pay_method").on( 'change', function () {
            var method = this.value;
            if(method === 'CHECK'){
                document.getElementById('check_form').style.display = "block";
                document.getElementById('credit_card_form').style.display = "none";
                document.getElementById('cash_form').style.display = "none";
                document.getElementById('ach_form').style.display = "none";
                document.getElementById('others_warranty_form').style.display = "none";
                document.getElementById('svp_form').style.display = "none";
            }else if(method === 'CC'|| method === 'OCCP'){
                document.getElementById('check_form').style.display = "none";
                document.getElementById('credit_card_form').style.display = "block";
                document.getElementById('cash_form').style.display = "none";
                document.getElementById('ach_form').style.display = "none";
                document.getElementById('others_warranty_form').style.display = "none";
                document.getElementById('svp_form').style.display = "none";
            }else if(method === 'CASH'){
                document.getElementById('check_form').style.display = "none";
                document.getElementById('credit_card_form').style.display = "none";
                document.getElementById('cash_form').style.display = "block";
                document.getElementById('ach_form').style.display = "none";
                document.getElementById('others_warranty_form').style.display = "none";
                document.getElementById('svp_form').style.display = "none";
            }else if(method === 'ACH'){
                document.getElementById('check_form').style.display = "none";
                document.getElementById('credit_card_form').style.display = "none";
                document.getElementById('cash_form').style.display = "none";
                document.getElementById('ach_form').style.display = "block";
                document.getElementById('others_warranty_form').style.display = "none";
                document.getElementById('svp_form').style.display = "none";
            }else if(method === 'OPT' || method === 'WW'){
                document.getElementById('check_form').style.display = "none";
                document.getElementById('credit_card_form').style.display = "none";
                document.getElementById('cash_form').style.display = "none";
                document.getElementById('ach_form').style.display = "none";
                document.getElementById('others_warranty_form').style.display = "block";
                document.getElementById('svp_form').style.display = "none";
            }
            else if(method === 'SQ' || method === 'PP' || method === 'VENMO'){
                document.getElementById('check_form').style.display = "none";
                document.getElementById('credit_card_form').style.display = "none";
                document.getElementById('cash_form').style.display = "none";
                document.getElementById('ach_form').style.display = "none";
                document.getElementById('others_warranty_form').style.display = "none";
                document.getElementById('svp_form').style.display = "block";
            }
        });

        $("#save_payment").on( "click", function( event ) {
            $('#pay_method_right').html($('#pay_method').val());
            $('#pay_amount_right').html($('#pay_amount').val());
        });
        $("#approval_btn_left").on( "click", function( event ) {
            document.getElementById('approval_card_right').style.display = "block";
            document.getElementById('approval_card_left').style.display = "none";
        });

        $("#approval_btn_right").on( "click", function( event ) {
            document.getElementById('approval_card_left').style.display = "block";
            document.getElementById('approval_card_right').style.display = "none";
        });

        $("#pd_left").on( "click", function( event ) {
            document.getElementById('pd_right_card').style.display = "block";
            document.getElementById('pd_left_card').style.display = "none";
        });

        $("#pd_right").on( "click", function( event ) {
            document.getElementById('pd_left_card').style.display = "block";
            document.getElementById('pd_right_card').style.display = "none";
        });

        $("#notes_edit_btn_right").on( "click", function( event ) {
            document.getElementById('notes_input_div_right').style.display = "block";
            document.getElementById('notes_edit_btn_right').style.display = "none";
        });

        $("#notes_edit_btn").on( "click", function( event ) {
            document.getElementById('notes_input_div').style.display = "block";
            document.getElementById('notes_edit_btn').style.display = "none";
        });

        $("#edit_note").on( "click", function( event ) {
            document.getElementById('notes_edit_btn').style.display = "none";
            document.getElementById('notes_input_div').style.display = "block";
        });

        $("#edit_note_right").on( "click", function( event ) {
            document.getElementById('notes_edit_btn_right').style.display = "none";
            document.getElementById('notes_input_div_right').style.display = "block";
        });

        $("#notes_left").on( "click", function( event ) {
            document.getElementById('notes_left_card').style.display = "none";
            document.getElementById('notes_right_card').style.display = "block";
        });

        $("#notes_right").on( "click", function( event ) {
            document.getElementById('notes_right_card').style.display = "none";
            document.getElementById('notes_left_card').style.display = "block";
        });

        $("#url_left_btn_column").on( "click", function( event ) {
            document.getElementById('url_left_card').style.display = "none";
            document.getElementById('url_right_card').style.display = "block";
        });

        $("#url_right_btn_column").on( "click", function( event ) {
            document.getElementById('url_right_card').style.display = "none";
            document.getElementById('url_left_card').style.display = "block";
        });

        $("#attach_right_btn_column").on( "click", function( event ) {
            document.getElementById('attach_right_card').style.display = "none";
            document.getElementById('attach_left_card').style.display = "block";
        });

        $("#attach_left_btn_column").on( "click", function( event ) {
            document.getElementById('attach_left_card').style.display = "none";
            document.getElementById('attach_right_card').style.display = "block";
        });

        $("#save_memo").on( "click", function( event ) {
            var note = $('#note_txt').val();
            $('#notes_edit_btn').text(note);
            $('#note_txt').text(note);

            // update right box note
            $('#note_txt_right').text(note);
            $('#notes_edit_btn_right').text(note);

            document.getElementById('notes_input_div').style.display = "none";
            document.getElementById('notes_edit_btn').style.display = "block";
        });

        $("#save_memo_right").on( "click", function( event ) {
            var note = $('#note_txt_right').val();
            $('#notes_edit_btn_right').text(note);
            $('#notes_right_display_right').text(note);
            $('#note_txt_right').text(note);

            // update left box note
            $('#notes_edit_btn').text(note);
            $('#note_txt').text(note);

            document.getElementById('notes_input_div_right').style.display = "none";
            document.getElementById('notes_edit_btn_right').style.display = "block";
        });

        $("#fillAndSignNext").on( "click", function( event ) {
            return; // moved implementation to script.js@onClickNext

            var formData = {
                'status': $(this).data('status'),
                'id': $(this).data('id'),
            };
            $.ajax({
                type: "POST",
                url: "<?= base_url() ?>/job/update_jobs_status",
                data: formData, // serializes the form's elements.
                //dataType : 'json',
                //encode : true,
                success: function(data)
                {
                    if(data === "Success"){
                        sucess_add('Job is now Approved!',1);
                    }else {
                        warning('There is an error adding Customer. Contact Administrator!');
                    }
                },
                error : function(data) {
                }
            });
        });

        $("#new_customer_form").submit(function(e) {
            $('#NEW_CUSTOMER_MODAL_CLOSE').click();
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            //var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: "/customer/add_new_customer_from_jobs",
                data: form.serialize(), // serializes the form's elements.
                success: function(data)
                {
                    if(data === "Success"){
                        sucess_add('Customer Added Successfully!',1);
                    }else {
                        warning('There is an error adding Customer. Contact Administrator!');
                    }
                }
            });
        });
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

        $("#employee2").on( 'change', function () {
            $('#employee2_id').val(this.value);
        });
        $("#employee3").on( 'change', function () {
            $('#employee3_id').val(this.value);
        });
        $("#employee4").on( 'change', function () {
            $('#employee4_id').val(this.value);
        });

        $("#start_date").on("change", function(){
            $('#end_date').val(this.value);
        });

        var ITEMS_TABLE = $('#items_table').DataTable({
            "ordering": false,
        });
        $("#ITEM_CUSTOM_SEARCH").keyup(function() {
            ITEMS_TABLE.search($(this).val()).draw()
        });
        ITEMS_TABLE_SETTINGS = ITEMS_TABLE.settings();

        // $('#device_audit').DataTable({
        //     "lengthChange": false,
        //     "searching" : false,
        //     "pageLength": 5,
        //     "paging" : false,
        //     "ordering" : false,
        // });

        $('#estimates_table').DataTable({
            "lengthChange": false,
            "searching" : true,
            "pageLength": 10,
            "order": [],
        });

        $('#workorder_table').DataTable({
            "lengthChange": false,
            "searching" : true,
            "pageLength": 10,
            "order": [],
        });

        $('#invoices_table').DataTable({
            "lengthChange": false,
            "searching" : true,
            "pageLength": 10,
            "order": [],
        });

    });

    $("#update_status_to_omw").submit(function(e) {
            //alert("asf");
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            var job_id = $('#jobid').val();
            var omw_time = $('#omw_time').val();
            var status = $('#status').val();
            var omw_date = $('#omw_date').val();

            const fd = new FormData();
            fd.append('id', job_id);
            fd.append('status', status);
            fd.append('omw_time', omw_time);
            fd.append('omw_date', omw_date);
            
            fetch('<?= base_url('job/update_jobs_status') ?>',{
                method: 'POST',
                body: fd
            }).then(response => response.json()).then(response => {
                var { success, message} = response;
                if(success){
                    $('#omw_modal').modal('hide');
                    sucess_add(message,1);
                }else{
                    warning(message)
                }
            }).catch((error) =>{
                console.log(error);
            })
            //var url = form.attr('action');
            // $.ajax({
            //     type: "POST",
            //     url: "<?= base_url() ?>/job/update_jobs_status",
            //     data: form.serialize(), // serializes the form's elements.
            //     success: function(data)
            //     {
            //         console.log(data);
            //         if(data === "Success"){
            //             //window.location.reload();
            //             sucess_add('Job Status Updated!',1);
            //         }else {
            //             warning('There is an error adding Customer. Contact Administrator!');
            //         }
            //     }
            // });
        });

        $("#update_status_to_started").submit(function(e) {
            //alert("asf");
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            var job_id = $('#jobid').val();
            var job_start_time = $('#job_start_time').val();
            var status = $('#start_status').val();
            var job_start_date = $('#job_start_date').val();

            const fd1 = new FormData();
            fd1.append('id', job_id);
            fd1.append('status', status);
            fd1.append('job_start_time', job_start_time);
            fd1.append('job_start_date', job_start_date);
            
            fetch('<?= base_url('job/update_jobs_status') ?>',{
                method: 'POST',
                body: fd1
            }).then(response => response.json()).then(response => {
                var { success, message} = response;
                if(success){
                    $('#start_modal').modal('hide');

                    // console.log(response);
                    sucess_add(message, 1);
                }else{
                    warning(message);
                    // console.log(response);
                }
            }).catch((error) =>{
                console.log(error);
            })
            //var url = form.attr('action');
        //     $.ajax({
        //         type: "POST",
        //         url: "<?= base_url() ?>/job/update_jobs_status",
        //         data: form.serialize(), // serializes the form's elements.
        //         success: function(data)
        //         {
        //             if(data === "Success"){
        //                 //window.location.reload();
        //                 sucess_add('Job Status Updated!',1);
        //             }else {
        //                 warning('There is an error adding Customer. Contact Administrator!');
        //             }
        //         }
        //     });
        });
    $("#update_status_to_approved").submit(function(e) {
            //alert("asf");
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var job_id = $('#jobid').val();
            var status = $('#approved_status').val();

            const fd2 = new FormData();
            fd2.append('id', job_id);
            fd2.append('status', status);
            
            fetch('<?= base_url('job/update_jobs_status') ?>',{
                method: 'POST',
                body: fd2
            }).then(response => response.json()).then(response => {
                var { success, message} = response;
                if(success){
                    $('#approved_modal').modal('hide');
                    // console.log(response);
                    sucess_add(message);
                }else{
                    warning(message);
                    // console.log(response);
                }
            }).catch((error) =>{
                console.log(error);
            })
            //var url = form.attr('action');
        //     $.ajax({
        //         type: "POST",
        //         url: "<?= base_url() ?>/job/update_jobs_status",
        //         data: form.serialize(), // serializes the form's elements.
        //         success: function(data)
        //         {
        //             if(data === "Success"){
        //                 //window.location.reload();
        //                 sucess_add('Job Status Updated!',1);
        //             }else {
        //                 warning('There is an error adding Customer. Contact Administrator!');
        //             }
        //         }
        //     });
        });
        function sucess_add(message){
            Swal.fire({
                title: 'Nice!',
                text: message,
                icon: 'success',
                showCancelButton: false,
                confirmButtonColor: '#32243d',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ok'
            }).then((result) => {
                if (result.value) {
                    location.reload();
                }
            });
        }
        function sucess_add_job(data) {
            if( data.is_update == 1 ){ //Update
                Swal.fire({
                    text: 'Job has been updated',                    
                    icon: 'success',
                    showCancelButton: false,
                    confirmButtonColor: '#32243d',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    location.href = base_url + 'job';
                });
            }else{ //Create
                Swal.fire({
                    title: 'Job has been added',
                    text: 'An initial invoice can now be created',
                    icon: 'success',
                    confirmButtonText: 'Create Initial Invoice',
                    confirmButtonColor: '#32243d',
                }).then((result) => {
                    var redirect_calendar = $('#redirect-calendar').val();
                    if (redirect_calendar == 1) {
                        window.location.href = '<?= base_url(); ?>workcalender';
                    } else {
                        // console.log({ data });
                        if (data.job_id) {
                            window.open("<?php echo base_url('job/createInvoice/'); ?>" + data.job_id, '_blank','location=yes,height=650,width=1200,scrollbars=yes,status=yes');
                            window.location.href = "<?php echo base_url('job/new_job1/'); ?>" + data.job_id;
                            return;
                        }
                    }
                });
            }
            
    }
        function error(title,text,icon){
            Swal.fire({
                title: title,
                text: text,
                icon: icon,
                showCancelButton: false,
                confirmButtonColor: '#32243d',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ok'
            }).then((result) => {

            });
        }
    <?php if( $default_customer_id > 0 ){ ?>
            $('#customer_id').click();
            load_customer_data('<?= $default_customer_id; ?>');
        <?php } ?>
    function load_customer_data($id){
        // $.ajax({
        //     type: "POST",
        //     url: "<?= base_url() ?>/job/get_customer_selected",
        //     data: {id : $id}, // serializes the form's elements.
        //     success: function(data)
        //     {
        //         console.log(data);
        //         var customer_data = JSON.parse(data);
        //         $('#cust_fullname').text(customer_data.first_name + ' ' + customer_data.last_name);
        //         if(customer_data.mail_add !== null){
        //             $('#cust_address').text(customer_data.mail_add + ' ');
        //         }
        //         $("#customer_preview").attr("href", "/customer/preview/"+customer_data.prof_id);
        //         $('#cust_address2').text(customer_data.city + ',' + ' ' + customer_data.state + ' ' + customer_data.zip_code);
        //         $('#cust_number').text(customer_data.phone_h);
        //         $('#cust_email').text(customer_data.email);
        //         $('#mail_to').attr("href","mailto:"+customer_data.email);
        //         initMap(customer_data.mail_add + ' ' + customer_data.city + ' ' + ' ' + customer_data.state + ' ' + customer_data.zip_code);
        //         loadStreetView(customer_data.mail_add + ' ' + customer_data.city + ',' + ' ' + customer_data.state + ' ' + customer_data.zip_code);
        //     }
        // });
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
                if(data.phone_m){
                    if(data.phone_m.includes('Mobile:')){
                        phone_m = ((data.phone_m).slice(0,13))
                    }else{
                        //phone_h = data.phone_h;
                        phone_m = formatPhoneNumber(data.phone_m);
                    }
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
                $('#TEMPORARY_MAP_VIEW').hide();
                // console.log(data.cross_street + ' ' + data.city + ' ' + ' ' + data.state + ' ' + data.zip_code);
                // initMap(data.mail_add + ' ' + data.city + ' ' + ' ' + data.state + ' ' + data.zip_code);
                // loadStreetView(data.mail_add + ' ' + data.city + ',' + ' ' + data.state + ' ' + data.zip_code);
            }
        })
    }

    function formatPhoneNumber(phoneNumberString) {
      var cleaned = ('' + phoneNumberString).replace(/\D/g, '');
      var match = cleaned.match(/^(\d{3})(\d{3})(\d{4})$/);
      if (match) {
        return '(' + match[1] + ') ' + match[2] + '-' + match[3];
      }else{
        return phoneNumberString;
      }      
    }

// $('#TEMPORARY_MAP_VIEW').load(function(){
//     alert('loaded!');
// });

$('#TEMPORARY_MAP_VIEW').on("load", function() {
   $('.MAP_LOADER').hide();
   $('#TEMPORARY_MAP_VIEW').fadeIn();
});

</script>