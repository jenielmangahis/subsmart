<script>
    window.onload = function() { // same as window.addEventListener('load', (event) => {
        //alert('Page loaded');
        $.ajax({
            type: "GET",
            url: "/job/get_customers",
            success: function(data)
            {
                var template_data = JSON.parse(data);
                var toAppend = '';
                $.each(template_data,function(i,o){
                    toAppend += '<option value='+o.prof_id+'>'+o.last_name + ', ' + o.first_name +'</option>';
                });
                $('#customer_id').append(toAppend);
                //console.log(template_data);
            }
        });
    };
    $(document).ready(function() {

        $("#jobs_form").submit(function(e) {
            //alert("asf");
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            //var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: "/job/save_job",
                data: form.serialize(), // serializes the form's elements.
                success: function(data) {
                    console.log(data);
                }
            });
        });

        $("#fill_esign_btn").click(function () {
            $.ajax({
                type: "GET",
                url: "/job/get_esign_template",
                success: function(data)
                {
                    var template_data = JSON.parse(data);
                    var toAppend = '';
                    $.each(template_data,function(i,o){
                        toAppend += '<option value='+o.esignLibraryTemplateId+'>'+o.title+'</option>';
                    });
                    $('#library_template').append(toAppend);
                    //console.log(template_data);
                }
            });
        });

        $("#add_another_item").click(function () {
            // var newFields = document.getElementById('custom_form').cloneNode(true);
            markup = "<tr id=\"ss\">" +
                "<td width=\"35%\"><small>Item name</small><input type=\"text\" name=\"item_name[]\" class=\"form-control checkDescription\" ></td>\n" +
                "<td width=\"10%\"><small>Qty</small><input type=\"text\" name=\"item_qty[]\" class=\"form-control checkDescription\"></td>\n" +
                "<td width=\"10%\"><small>Unit Price</small><input type=\"text\" name=\"item_price[]\" class=\"form-control checkModelAmount\" value=\"0\" placeholder=\"Unit Price\"></td>\n" +
                "<td width=\"10%\"><small>Unit Cost</small><input type=\"text\" name=\"item_cost[]\" class=\"form-control checkDescription\"></td>\n" +
                "<td width=\"25%\"><small>Inventory Location</small><input type=\"text\" name=\"item_loc[]\" class=\"form-control checkDescription\"></td>\n" +
                "<td style=\"text-align: center\" class=\"d-flex\" width=\"15%\">$00<a href=\"javascript:void(0)\" class=\"remove_item_row\"><i class=\"fa fa-times-circle\" aria-hidden=\"true\"></i></a></td>" +
                "</tr>";
            tableBody = $("#jobs_items_table_body");
            tableBody.append(markup);
        });

        //$(".color-scheme").on( 'click', function () {});

        $("body").delegate(".remove_item_row", "click", function(){
            $(this).parent().parent().remove();
        });

        $("body").delegate(".color-scheme", "click", function(){
            var id = this.id;
            $('[id="job_color_id"]').val(id);
            console.log(id);
            $( "#"+id ).append( "<i class=\"fa fa-check calendar_button\" aria-hidden=\"true\"></i>" );
            remove_others(id);
        });

        function remove_others (color_id){
            $('.color-scheme').each(function(index) {
                var idd = this.id;
                if(idd !== color_id){
                    $( "#"+idd ).empty();
                }
            });
        }

        $("#library_template").on( 'change', function () {
            var lib_id = this.value;
            $.ajax({
                type: "POST",
                url: "/job/get_esign_selected",
                data: {id : lib_id}, // serializes the form's elements.
                success: function(data)
                {
                    var template_data = JSON.parse(data);
                    $('#summernote').summernote('code', template_data.content);
                    //console.log(data);
                }
            });
        });
        $("#job_tags").on( 'change', function () {
            var tag_id = this.value;
            $.ajax({
                type: "POST",
                url: "/job/get_tag_selected",
                data: {id : tag_id}, // serializes the form's elements.
                success: function(data)
                {
                    var template_data = JSON.parse(data);
                    $('#job_tags_right').val(template_data.name);
                    //console.log(data);
                }
            });
        });

        //$('#summernote').summernote('code', '');
        $('#summernote').summernote({
            placeholder: 'Type Here ... ',
            tabsize: 2,
            height: 250,
        });
        var signaturePad = new SignaturePad(document.getElementById('signature-pad'));
        $('#click').click(function(e){
            e.preventDefault();
            var data = signaturePad.toDataURL('image/png');
            $('#output').val(data);
            var url = '/job/save_esign';
            $.ajax({
                url: url,
                type: "POST",
                data:{base64: data}
            }).done(function(e){
                //$('#updateSignature').modal('hide');
                $('#authorizer').html($('#authorizer_name').val());
                $('#appoval_name_right').html($('#authorizer_name').val());
                $('#date_signed').html(e);
                $('#datetime_signed').val(e);
                $('#name').val($('#authorizer_name').val());
                $('#signature_link').val(data);
                $("#customer-signature").attr("src",data);
                $("#customer_signature_right").attr("src",data);
                //location.reload();
            });
        });

        document.getElementById('check_form').style.display = "none";
        document.getElementById('cash_form').style.display = "none";
        document.getElementById('ach_form').style.display = "none";
        document.getElementById('others_warranty_form').style.display = "none";
        document.getElementById('svp_form').style.display = "none";
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
            }
            else if(method === 'ACH'){
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

        $("#notes_edit_btn").on( "click", function( event ) {
            document.getElementById('notes_input_div').style.display = "block";
            document.getElementById('notes_edit_btn').style.display = "none";
        });

        $("#edit_note").on( "click", function( event ) {
            console.log('asdsad');
            document.getElementById('notes_edit_btn').style.display = "none";
            document.getElementById('notes_input_div').style.display = "block";
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

        $("#attachment-file").change(function(){
            console.log("A file has been selected.");
            // var form = $('form')[0]; // You need to use standard javascript object here
            // var formData = new FormData(form);
            // var form = $('#upload_library_form').serialize();
            // var formData = new FormData($(form)[0]);
            var input = document.getElementById('attachment-file');
            //  console.log(formData);
            // console.log(input.files);
            // for (var i = 0; i < input.files.length; i++) {
            //     console.log(input.files[i]);
            // }
            // The Javascript
            var fileInput = document.getElementById('attachment-file');
            var file = fileInput.files[0];
            var formDatas = new FormData();
            formDatas.append('file', file);
            //console.log(formDatas);
            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: "/job/add_job_attachments",
                data: formDatas,
                processData: false,
                contentType: false,
                cache: false,
                beforeSend: function() {

                },
                success: function (data) {
                    $('#attachment').val('/'+data);
                    $("#attachment-image").attr("src",'/'+data);
                },
                error: function (e) {
                    //$("#result").text(e.responseText);
                    console.log("ERROR : ", e);
                    // $("#btnSubmit").prop("disabled", false);
                }
            });
        });

        $("#save_memo").on( "click", function( event ) {
            var note = $('#note_txt').val();
            $('#notes_edit_btn').text(note);
            $('#notes_right_display').text(note);
            //$.ajax({
            //    type: "POST",
            //    url: "/customer/update_customer_profile",
            //    data: { notes : note , id : <?//= isset($customer_profile_id) ? $customer_profile_id : 0; ?>// }, // serializes the form's elements.
            //    success: function(data)
            //    {
            //        if(data === "Success"){
            //            //$('#momo_edit_btn').text("");
            //            $('#momo_edit_btn').text(note);
            //            // $('#memo_txt').text(note);
            document.getElementById('notes_input_div').style.display = "none";
            document.getElementById('notes_edit_btn').style.display = "block";
            //        }else {
            //            console.log(data);
            //        }
            //    }
            //});
        });

        $("#new_customer_form").submit(function(e) {
            //alert("asf");
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
                        //window.location.reload();
                        sucess_add('Customer Added Successfully!',1);
                    }else {
                        warning('There is an error adding Customer. Contact Administrator!');
                        console.log(data);
                    }
                }
            });
        });
        function sucess_add(information,is_reload){
            Swal.fire({
                title: 'Good job!',
                text: information,
                icon: 'success',
                showCancelButton: false,
                confirmButtonColor: '#32243d',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ok'
            }).then((result) => {
                if(is_reload === 1){
                    if (result.value) {
                        window.location.reload();
                    }
                }
            });
        }
        function warning(information){
            Swal.fire({
                title: 'Warning!',
                text: information,
                icon: 'warning',
                showCancelButton: false,
                confirmButtonColor: '#32243d',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ok'
            }).then((result) => {

            });
        }

        $("#customer_id").on( 'change', function () {
            var customer_selected = this.value;
            //console.log(customer_selected);
            if(customer_selected !== ""){
                $.ajax({
                    type: "POST",
                    url: "/job/get_customer_selected",
                    data: {id : customer_selected}, // serializes the form's elements.
                    success: function(data)
                    {
                        var customer_data = JSON.parse(data);
                        //console.log(customer_data);
                        $('#cust_fullname').text(customer_data.first_name + ' ' + customer_data.last_name);
                        $('#cust_address').text(customer_data.mail_add + ' ' + customer_data.city + ',' + ' ' + customer_data.state + ' ' + customer_data.zip_code);
                        $('#cust_number').text(customer_data.phone_h);
                        $('#cust_email').text(customer_data.email);
                        $('#mail_to').attr("href","mailto:"+customer_data.email);
                        initMap(customer_data.mail_add + ' ' + customer_data.city + ' ' + ' ' + customer_data.state + ' ' + customer_data.zip_code);
                    }
                });
            }else{
                $('#cust_fullname').text('xxxxx xxxxx');
                $('#cust_address').text('-------------');
                $('#cust_number').text('(xxx) xxx-xxxx');
                $('#cust_email').text('xxxxx@xxxxx.xxx');
                initMap();
            }
        });

    });

</script>