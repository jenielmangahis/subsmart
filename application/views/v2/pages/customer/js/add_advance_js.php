<script>
    $(function() {
        $("#fk_sa_id").select2({
            placeholder: "Select Sales Area"
        });
        $("#prefix").select2({
            placeholder: "Select Name Prefix",
            allowClear: true
        });
        $("#suffix").select2({
            placeholder: "Select Name Suffix",
            allowClear: true
        });
        $("#pay_history").select2({
            placeholder: "Select Pay History"
        });
        $("#mmr").select2({
            placeholder: "Select Month Rate"
        });
        $("#bill_freq").select2({
            placeholder: "Select"
        });
        $("#bill_day").select2({
            placeholder: "Select Billing Day"
        });
        $("#contract_term").select2({
            placeholder: "Select Contract Term"
        });
        $("#bill_method").select2({
            placeholder: "Select Bill Method"
        });
        $("#assign_to").select2({
            placeholder: "Select Assign To"
        });
        $("#purchase_multiple").select2({
            placeholder: "Select Purchase Multiple"
        });
        $("#language").select2({
            placeholder: "Select Language"
        });
        $("#fk_sales_rep_office").select2({
            placeholder: "Select Sales Rep Office"
        });
        $("#technician").select2({
            placeholder: "Select Technician"
        });
        $("#save_by").select2({
            placeholder: "Select Pay History"
        });
        $("#cancel_reason").select2({
            placeholder: "Select Reason"
        });
        $("#pre_install_survey").select2({
            placeholder: "Select Pre-Install Survey"
        });
        $("#post_install_survey").select2({
            placeholder: "Select Post-Install Survey"
        });
        $("#activation_fee").select2({
            placeholder: "Select Activation Fee"
        });
        $("#lead_source").select2({
            placeholder: "Select Lead Source"
        });
        $("#verification").select2({
            placeholder: "Select Verification"
        });
        $("#warranty_type").select2({
            placeholder: "Select Warranty Type"
        });
        $("#communication_type").select2({
            placeholder: "Select Communication Type"
        });
        $("#acct_type").select2({
            placeholder: "Select Account Type"
        });
        $("#proposed_offset").select2({
            placeholder: "Select Offset"
        });

        $(".solar_infos").select2({
            placeholder: "Select"
        });

        $("#panel_type").select2({
            placeholder: "Select Panel Type"
        });
        $("#mon_waived").select2({
            placeholder: "Select Monitoring Waived"
        });
        $("#status").select2({
            placeholder: "Select Status"
        });
        $("#customer_type").select2({
            placeholder: "Select Customer Type"
        });
        $("#customer_group").select2({
            placeholder: "Select Customer Group"
        });
        $("#industry_type").select2({
            placeholder: "Select Industry Type"
        });
        $("#pay_method").select2({
            placeholder: "Select Payment Type"
        });
        $("#credit_score").select2({
            placeholder: "Select Credit Score"
        });
        $("#monitoring_waived").select2({
            placeholder: "Select Month"
        });
        $("#frequency").select2({
            placeholder: "Select"
        });
        $("#transaction_category").select2({
            placeholder: "Select Category"
        });
        $("#system_type").select2({
            placeholder: "Select System Type"
        });
        $("#dealer").select2({
            placeholder: "Select Alarm Login"
        });
        $("#monitor_comp").select2({
            placeholder: "Select Company"
        });
        $("#online").select2({
            placeholder: "Select"
        });
        $("#in_service").select2({
            placeholder: "Select"
        });
        $("#collections").select2({
            placeholder: "Select"
        });
        $("#equipment").select2({
            placeholder: "Select"
        });
        $("#invoice_term").select2({
            placeholder: ""
        });

        $("#site_type").select2({
            placeholder: "Select Site Type"
        });

        $("#install_type").select2({
            placeholder: "Select Install Type"
        });

        $("#secondary_system_type").select2({
            placeholder: "Select Secondary System Type"
        });

        $("#service_provider").select2({
            placeholder: "Select Service Provider"
        });

        $("#dsl_voip").select2({
            placeholder: "Select DSL VOIP"
        });

        $("#contract_status").select2({
            placeholder: "Select Contract Status"
        });

        $("#connection_type").select2({
            placeholder: "Select Connection Type"
        });
    });
    $(function() {
        $("nav:first").addClass("closed");
        $(".date_checkbox").on('change', function(event) {
            const date_id = this.value;
            if (event.currentTarget.checked) {
                event.preventDefault();
                $('#' + date_id).prop("disabled", false);
            } else {
                event.preventDefault();
                $('#' + date_id).val(""); // Element(s) are now enabled.
                $('#' + date_id).prop("disabled", true); // Element(s) are now enabled.
            }
        });

        $('#acct_type').on('change',function(){
            let acct_type = $(this).val();
            if( acct_type == 'In-House' ){
                $('#funding-information-container').hide();
            }else{
                $('#funding-information-container').show();
            }
        });

        $('#financing-payment-amount').on('change', function(){
            let amount = $(this).val();

            const today = new Date();
            const formattedDate = today.toLocaleDateString('en-US');
            let current_date = formattedDate;
            
            if( amount <= 0 ){
                $('#recurring_start_date').val('');
                $('#recurring_end_date').val('');
            }else{
                $('#recurring_start_date').val(current_date);
                $('#recurring_end_date').val(current_date);
            }
        });

        $(document).on('change', '#status', function(){
            let status = $(this).val();
            if( status == 'Cancelled' || status == 'Cancel' || status == 'Charge Back' || status == 'Collection' || status == 'Competition Lost' ){
                $('#office-info-cancel-date').attr('required', 'required');
                $('#cancel_reason').attr('required', 'required');
                //$('#collections').attr('required', 'required');
                //$('#office-use-collection-date').attr('required', 'required');
                //$('#office-info-collect-amount').attr('required', 'required');
                $('#cancelled-related-fields-container-a').show();
            }else{
                $('#office-info-cancel-date').removeAttr('required');
                $('#cancel_reason').removeAttr('required');
                //$('#collections').removeAttr('required');
                //$('#office-use-collection-date').removeAttr('required');
                //$('#office-info-collect-amount').removeAttr('required');
                $('#cancelled-related-fields-container-a').hide();
            }
        });

        $(".paper-chk").click(function() { 
            return false; 
        });

        $('#chkRecurringActive').click(function(){
            return false;
        });

        $('#rep_paper_date').on('change', function(){
            let val = $(this).val();            
            if( val != '' ){
                $('#chk_rep_paper').prop('checked', true);
            }else{
                $('#chk_rep_paper').prop('checked', false);
            }   
        });

        $('#tech_paper_date').on('change', function(){
            let val = $(this).val();            
            if( val != '' ){
                $('#chk_paper_date').prop('checked', true);
            }else{
                $('#chk_paper_date').prop('checked', false);
            }   
        });

        $('#paper_imagine_count').on('change', function(){
            let val = $(this).val();            
            if( val > 0 ){
                $('#chk_imagine_count').prop('checked', true);
            }else{
                $('#chk_imagine_count').prop('checked', false);
            }   
        });

        $('#paper_paperwork').on('change', function(){
            let val = $(this).val();            
            if( val != '' ){
                $('#chk_paper_paperwork').prop('checked', true);
            }else{
                $('#chk_paper_paperwork').prop('checked', false);
            }   
        });

        $('#paper_submitted').on('change', function(){
            let val = $(this).val();            
            if( val != '' ){
                $('#chk_paper_submitted').prop('checked', true);
            }else{
                $('#chk_paper_submitted').prop('checked', false);
            }   
        });

        $('#paper_funded').on('change', function(){
            let val = $(this).val();            
            if( val > 0 ){
                $('#chk_paper_funded').prop('checked', true);
            }else{
                $('#chk_paper_funded').prop('checked', false);
            }   
        });

        $('#paper_charged_back').on('change', function(){
            let val = $(this).val();            
            if( val > 0 ){
                $('#chk_charged_back').prop('checked', true);
            }else{
                $('#chk_charged_back').prop('checked', false);
            }   
        });
    });

    $(document).on('click', '#btn-notify-customer-new-pw', function(e) {
        e.preventDefault();

        var url = base_url + 'customer/_send_login_details';
        var cid = $(this).attr('data-id');

        Swal.fire({
            title: 'Email Notification',
            html: "Are you sure you want to send to customer email their login access?",
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: url,
                    dataType: 'json',
                    data: {
                        cid: cid
                    },
                    success: function(o) {
                        if (o.is_success == 1) {
                            Swal.fire({
                                title: 'Email Sent!',
                                text: "An email was sent to customer of their login details!",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonText: 'Okay'
                            }).then((result) => {
                                //if (result.value) {

                                //}
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                html: o.msg
                            });
                        }
                    },
                });
            }
        });
    });
</script>

<script>
    $(document).ready(function() {

        $("body").delegate(".remove_item_row", "click", function() {
            $(this).parent().parent().remove();
        });

        $("#add_field").click(function() {
            const custom_field_form = "<div class=\"row form_line\">\n" +
                "                <div class=\"col-md-5\">\n" +
                "                    Name\n" +
                "                    <input type=\"text\" class=\"form-control\" name=\"custom_name[]\" id=\"office_custom_field1\" value=\"\" />\n" +
                "                </div>\n" +
                "                <div class=\"col-md-5\">\n" +
                "                    Value\n" +
                "                    <input type=\"text\" class=\"form-control\" name=\"custom_value[]\" id=\"office_custom_field1\" value=\"\" />\n" +
                "                </div>\n" +
                "                <div class=\"col-md-2\">\n" +
                "                    <button style=\"margin-top: 22px; font-size:12px;\" type=\"button\" class=\"nsm-button primary items_remove_btn remove_item_row\"><i class='bx bx-trash'></i></button>\n" +
                "                </div>\n" +
                "            </div>";
            $("#custom_field").append(custom_field_form);
        });

        $("#bill_start_date").datepicker({
            onselect: function(dateText) {
                //console.log('adsfsdf');
                //console.log("Selected date: " + dateText + "; input's current value: " + this.value);
            },
            dateFormat: 'dd/mm/yy'
        }).on("changeDate", function(e) {
            console.log(e.date);
            var selected_data = moment(e.date).format('L');
            var contract = $('#contract_term').val();
            var plus_date = moment.utc(selected_data).add(contract, 'months');

            $('#bill_end_date').datepicker("setDate", plus_date.toDate());
            $('#bill_day').val(plus_date.format('D')).trigger("change");
        });

        $("#contract_term").change(function() {
            var terms = $(this).val();
            var start_date = $("#bill_start_date").val();
            if (start_date != '') {
                var selected_data = moment(start_date).format('L');
                var plus_date = moment.utc(selected_data).add(terms, 'months');
                $('#bill_end_date').val(moment(plus_date).format('L'));
            }
        });

        $(".datepicker").datepicker();
        $("#recurring_end_date").datepicker();
        $("#bill_end_date").datepicker();
        $("#date_of_birth").datepicker();


        $("#first_name").on("keyup change", function(e) {
            $('#card_fname').val(this.value);
        });
        $("#last_name").on("keyup change", function(e) {
            $('#card_lname').val(this.value);
        });
        // rucurring monthly revenue(RMR)

        //$("#businessName").hide("slow");
        //$("#fax_").hide("slow");
        $("#customer_type").on('change', function() {
            var c_type = this.value;
            if (c_type === 'Residential') {
                $("#businessName").hide("slow");
                $("#fax_").hide("slow");
            } else {
                $("#businessName").show('slow').css("display", "");
                $("#fax_").show('slow').css("display", "");
            }
        });


        hide_all();
        load_default_bill_method();

        function load_default_bill_method(){
            var prof_id = $('#prof_id').val();            
            if( prof_id > 0 ){
                var c_type  = $('#bill_method').val();
                if (c_type === 'CC' || c_type === 'DC' || c_type === 'OCCP') {
                    hide_all();
                    card_show();
                } else if (c_type === 'CASH') {
                    hide_all();
                } else if (c_type === 'CHECK') {
                    hide_all();
                    $("#checkNumber").show("slow");
                    $("#bankName").show("slow");
                    route_show();
                } else if (c_type === 'ACH') {
                    hide_all();
                    route_show();
                } else if (c_type === 'Invoicing') {
                    hide_all();
                    $(".invoicing_field").show("slow");
                } else if (c_type === 'VENMO' || c_type === 'PP' || c_type === 'SQ') {
                    hide_all();
                    $(".account_cred").show('slow');
                } else if (c_type === 'WW' || c_type === 'HOF' || c_type === 'eT' || c_type === 'OPT') {
                    hide_all();
                    $(".account_cred").show('slow');
                    $("#confirmationPD").hide("slow");
                }
            }else{
                card_show();
            }
        }

        $("#bill_method").on('change', function() {
            var c_type = this.value;
            if (c_type === 'CC' || c_type === 'DC' || c_type === 'OCCP') {
                hide_all();
                card_show();
            } else if (c_type === 'CASH') {
                hide_all();
            } else if (c_type === 'CHECK') {
                hide_all();
                $("#checkNumber").show("slow");
                $("#bankName").show("slow");
                route_show();
            } else if (c_type === 'ACH') {
                hide_all();
                route_show();
            } else if (c_type === 'Invoicing') {
                hide_all();
                $(".invoicing_field").show("slow");
            } else if (c_type === 'VENMO' || c_type === 'PP' || c_type === 'SQ') {
                hide_all();
                $(".account_cred").show('slow');
            } else if (c_type === 'WW' || c_type === 'HOF' || c_type === 'eT' || c_type === 'OPT') {
                hide_all();
                $(".account_cred").show('slow');
                $("#confirmationPD").hide("slow");
            }else if (c_type === 'APPLE PAY') {
                hide_all();
            }
        });

        function card_show() {
            $("#CCN").show('slow');
            $("#CCE").show('slow');
            $("#checkNumber").hide("slow");
            $("#routingNumber").hide("slow");
            $("#accountNumber").hide("slow");
        }

        function route_show() {
            $("#CCN").hide('slow');
            $("#CCE").hide('slow');
            $("#routingNumber").show("slow");
            $("#accountNumber").show("slow");
        }

        function hide_all() {
            $(".invoicing_field").hide("slow");
            $("#checkNumber").hide("slow");
            $("#routingNumber").hide("slow");
            $("#accountNumber").hide("slow");
            $("#bankName").hide("slow");
            $("#CCN").hide('slow');
            $("#CCE").hide('slow');
            $(".account_cred").hide('slow');
        }

        $('#ssn').keydown(function(e) {
            var key = e.charCode || e.keyCode || 0;
            $text = $(this);
            if (key !== 8 && key !== 9) {
                if ($text.val().length === 3) {
                    $text.val($text.val() + '-');
                }
                if ($text.val().length === 6) {
                    $text.val($text.val() + '-');
                }
            }
            return (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));
        });

        $('.phone_number').keydown(function(e) {
            var key = e.charCode || e.keyCode || 0;
            $text = $(this);
            if (key !== 8 && key !== 9) {
                if ($text.val().length === 3) {
                    $text.val($text.val() + '-');
                }
                if ($text.val().length === 7) {
                    $text.val($text.val() + '-');
                }
            }
            return (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));
        });

        //$('.date_picker').val(new Date().toLocaleDateString());

        //$('.time_picker').val(new Date().toLocaleTimeString());

        // $(".time_picker").datetimepicker({
        //     format: "LT",
        // });

        $("#rep_comm").keyup(function() {
            $('#rep_paid').val(this.value);
        });

        $("#tech_comm").keyup(function() {
            $('#tech_paid').val(this.value);
        });

        $("#rep_paid").keyup(function() {
            var repPaid = this.value;
            var techPaid = $('#tech_paid').val();
            var new_sub_total = Number(repPaid) + Number(techPaid);
            $('#labor_cost').val(new_sub_total);
            console.log(new_sub_total);
        });

        $("#tech_paid").keyup(function() {
            var repPaid = this.value;
            var techPaid = $('#rep_paid').val();
            var new_sub_total = Number(repPaid) + Number(techPaid);
            $('#labor_cost').val(new_sub_total);
            console.log(new_sub_total);
        });


        $('.timepicker').timepicker('setTime', new Date().toLocaleTimeString());
        //$('#tech_depart_time').timepicker('setTime', moment.utc(new Date().toLocaleTimeString()).add(2,'hours'));
        $('#tech_depart_time').timepicker('setTime', moment.utc(new Date().toLocaleTimeString(), 'hh:mm a').add(2, 'hour').format('h:mm a'));

        $("#tech_arrive_time").on("keyup change", function(e) {
            //$('#card_fname').val(this.value);
            $('#tech_depart_time').timepicker('setTime', moment.utc(this.value, 'hh:mm a').add(2, 'hour').format('h:mm a'));
        });

        $("#monitor_id").on("keyup change", function(e) {
            $('#alarm_cs_account').val(this.value);
        });

        var table_assign_module = $('#assign_module_table').DataTable({
            "lengthChange": false,
            "searching": true,
            "pageLength": 5
        });
        var note = $('#notes_table').DataTable({
            "lengthChange": false,
            "searching": true,
            "pageLength": 5
        });
        var devices_table = $('#devices_table').DataTable({
            "lengthChange": false,
            "searching": true,
            "pageLength": 5
        });
    });

    function print_data_sheet() {
        let currentHtml = $('#print').html();
        var a = window.open('', '_selfs', '');
        a.document.write('<html>');
        a.document.write('<head>');
        a.document.write('<link rel="stylesheet" href="http://nsmartrac/assets/dashboard/css/bootstrap.min.css">');
        a.document.write('<style>');
        a.document.write('body{ font-size : 10px; }');
        a.document.write('</style>');
        a.document.write('</head>');
        a.document.write('<body>');
        a.document.write(currentHtml);
        a.document.write('</body></html>');
        a.document.close();
        a.print();
    }
</script>
<script>
    $(document).ready(function() {
        $("#customer_form").submit(async function(e) {
            e.preventDefault();
            var form = $(this);
            var is_valid = 1;
            var err_msg = '';
            
            var post_data = new FormData(this);

            if (is_valid == 1) {     
                /*$.ajax({
                    type: "POST",
                    url: base_url + "customer/save_customer_profile",
                    dataType: 'json',
                    data: form.serialize(), // serializes the form's elements.
                    success: function(data) {
                        document.getElementById('overlay').style.display = "none";
                        if (data) {
                            <?php if (isset($profile_info)) : ?>
                                sucess("Customer Information has been Updated Successfully!", data.profile_id);
                            <?php else : ?>
                                sucess("New Customer has been Added Successfully!", data.profile_id);
                            <?php endif; ?>
                        } else {
                            error(data.message);
                        }
                        console.log(data);
                    },
                    beforeSend: function() {
                        document.getElementById('overlay').style.display = "flex";
                    },
                    error: function(xhr, ajaxOptions, thrownError, data) {
                        document.getElementById('overlay').style.display = "none";
                        Swal.fire({
                            text: 'Customer profile was successfully updated!',
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#32243d',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.value) {
                                window.location.href = "<?= base_url(); ?>customer";
                            }
                        });
                    }
                });*/

                $.ajax({
                    type: 'POST',
                    url: base_url + "customer/save_customer_profile",
                    data: post_data,
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    success: function(data) {
                        document.getElementById('overlay').style.display = "none";
                        if (data) {
                            <?php if (isset($profile_info)) : ?>
                                sucess("Customer Information has been Updated Successfully!", data.profile_id);
                            <?php else : ?>
                                sucess("New Customer has been Added Successfully!", data.profile_id);
                            <?php endif; ?>
                        } else {
                            error(data.message);
                        }
                        console.log(data);
                    },
                    beforeSend: function() {
                        document.getElementById('overlay').style.display = "flex";
                    },
                    error: function(xhr, ajaxOptions, thrownError, data) {
                        document.getElementById('overlay').style.display = "none";
                        Swal.fire({
                            text: 'Customer profile was successfully updated!',
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#32243d',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.value) {
                                window.location.href = "<?= base_url(); ?>customer";
                            }
                        });
                    }
                });               
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    html: err_msg
                });
            }
        });

        $("#person_and_company_form").submit(async function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            var is_valid = 1;
            var err_msg = '';
            const isCompany = $("#page_type").val() == "company" ? true : false;
               console.log(isCompany);

            if (is_valid == 1) {                
                $.ajax({
                    type: "POST",
                    url: base_url + "customer/save_person_profile",
                    dataType: 'json',
                    data: form.serialize(), // serializes the form's elements.
                    success: function(data) { 
                        $('#btn-save-residential-commercial-customer').html('Save');                       
                        if( isCompany ){
                            $('#company_modal').modal('hide');
                        }else{
                            $('#person_modal').modal('hide');
                        }

                        if (data.message === 'Data updated successfully') {
                            isCompany == true ? success_person_and_company("Commercial list customer has been updated successfully","company") 
                            : success_person_and_company("Residential list customer has been updated successfully","person");
                            
                        } else {
                            isCompany == true ? success_person_and_company("New commercial customer has been added successfully","company") 
                            : success_person_and_company("New residential customer has been added successfully","person");
                             
                        }
                        //console.log(data);
                    },
                    beforeSend: function(){
                        $('#btn-save-residential-commercial-customer').html('<span class="bx bx-loader bx-spin"></span>');
                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    html: err_msg
                });
            }
        });

        function save_sucess(information) {
            Swal.fire(
                'Good job!',
                information,
                'success'
            );
        }

        function error(information) {
            Swal.fire({
                title: 'Sorry!',
                text: information,
                icon: 'error',
                showCancelButton: false,
                confirmButtonColor: '#32243d',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ok'
            }).then((result) => {
                if (result.value) {
                    //window.location.href="/customer";
                }
            });
        }

        function sucess(information, id) {
            Swal.fire({
                //title: 'Good job!',
                text: information,
                icon: 'success',
                showCancelButton: false,
                confirmButtonColor: '#32243d',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ok'
            }).then((result) => {
                if (result.value) {
                    window.location.href = "<?= base_url(); ?>customer/preview_/" + id;
                }
            });
        }

        function success_person_and_company(information,type) {
            Swal.fire({
                title: 'Add Customer',
                text: information,
                icon: 'success',
                showCancelButton: false,
                confirmButtonColor: '#32243d',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ok'
            }).then((result) => {
                //if (result.value) {
                    if(type === "person"){
                        //window.location.href = "<?= base_url(); ?>customer/residential";
                        PERSON_LIST_TABLE.ajax.reload();  
                    }else{
                        //window.location.href = "<?= base_url(); ?>customer/commercial";
                        COMPANY_LIST_TABLE.ajax.reload();  
                    }
                //}
            });
        }

        var counter = 0;

        function moreFields() {
            counter++;
            var newFields = document.getElementById('readroot').cloneNode(true);
            newFields.id = '';
            newFields.style.display = 'inline';
            var newField = newFields.childNodes;

            //console.log(newField);
            for (var i = 0; i < newField.length; i++) {
                var theName = newField[i].name;
                if (theName) {
                    //  newField[i].name = theName+'[]';
                }

            }
            var insertHere = document.getElementById('writeroot');
            insertHere.parentNode.insertBefore(newFields, insertHere);
        }
        // window.onload = moreFields;
        // $("#moreFields").on( "click", function( event ) {
        //     alert("sf");
        //
        // });
        // $("#moreFields").on( "click", function( event ) {
        //     moreFields();
        // });

        $("body").delegate("#moreFields", "click", function() {
            //alert("Delegated Button Clicked");
            //moreFields();
            counter++;
            var newFields = document.getElementById('readroot').cloneNode(true);
            newFields.id = '';
            newFields.style.display = 'inline';
            var newField = newFields.childNodes;

            //console.log(newField);
            for (var i = 0; i < newField.length; i++) {
                var theName = newField[i].name;
                if (theName) {
                    //  newField[i].name = theName+'[]';
                }

            }
            var insertHere = document.getElementById('writeroot');
            insertHere.parentNode.insertBefore(newFields, insertHere);
        });

        $(".remove_device").on("click", function(event) {
            var ID = this.id;
            //alert(ID);
            $.ajax({
                type: "POST",
                url: "/customer/remove_devices",
                data: {
                    id: ID
                }, // serializes the form's elements.
                success: function(data) {
                    if (data === "Done") {
                        window.location.reload();
                    } else {
                        console.log(data);
                    }
                }
            });
        });

        $('#btn-quick-add-financing-category').on('click', function(){
            $('#frm-quick-add-financing-category')[0].reset();
            $('#quick_add_financing_category').modal('show');
        });

        $('#btn-manage-financing-category').on('click', function(){
            window.open(
                base_url + 'customer/settings_financing_categories',
                '_blank' 
            );
        });

        $('#frm-quick-add-financing-category').on('submit', function(e){
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: base_url + 'customers/_create_financing_category',
                dataType: 'json',
                data: $('#frm-quick-add-financing-category').serialize(),
                success: function(data) {    
                    $('#btn-save-financing-category').html('Save');                   
                    if (data.is_success) {
                        $('#quick_add_financing_category').modal('hide');
                        $('#transaction_category').append($('<option>', {
                            value: data.value,
                            text: data.name
                        }));
                        $('#transaction_category').val(data.value);
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
                    $('#btn-save-financing-category').html('<span class="bx bx-loader bx-spin"></span>');
                }
            });
        });

        $('#btn-quick-add-customer-status').on('click', function(){
            $('#frm-quick-add-customer-status')[0].reset();
            $('#quick_add_customer_status').modal('show');
        });

        $('#btn-manage-customer-status').on('click', function(){
            window.open(
                base_url + 'customer/status',
                '_blank' 
            );
        });

        $('#frm-quick-add-customer-status').on('submit', function(e){
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: base_url + 'customers/_create_customer_status',
                dataType: 'json',
                data: $('#frm-quick-add-customer-status').serialize(),
                success: function(data) {    
                    $('#btn-save-customer-status').html('Save');                   
                    if (data.is_success) {
                        $('#quick_add_customer_status').modal('hide');
                        $('#status').append($('<option>', {
                            value: data.status_name,
                            text: data.status_name
                        }));
                        $('#status').val(data.status_name);
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
                    $('#btn-save-customer-status').html('<span class="bx bx-loader bx-spin"></span>');
                }
            });
        });

        $('#btn-quick-add-customer-group').on('click', function(){
            $('#frm-quick-add-customer-group')[0].reset();
            $('#quick_add_customer_group').modal('show');
        });

        $('#btn-manage-customer-group').on('click', function(){
            window.open(
                base_url + 'customer/group',
                '_blank' 
            );
        });

        $('#frm-quick-add-customer-group').on('submit', function(e){
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: base_url + 'customers/_create_customer_group',
                dataType: 'json',
                data: $('#frm-quick-add-customer-group').serialize(),
                success: function(data) {    
                    $('#btn-save-customer-group').html('Save');                   
                    if (data.is_success) {
                        $('#quick_add_customer_group').modal('hide');
                        $('#customer_group').append($('<option>', {
                            value: data.group_id,
                            text: data.group_name,
                        }));
                        $('#customer_group').val(data.group_id);
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
                    $('#btn-save-customer-group').html('<span class="bx bx-loader bx-spin"></span>');
                }
            });
        });

        $('#btn-quick-installer-code').on('click', function(){
            $('#frm-quick-add-installer-code')[0].reset();
            $('#quick_add_installer_code').modal('show');
        });

        $('#btn-manage-installer-code').on('click', function(){
            window.open(
                base_url + 'customer/settings_alarm_installer_codes',
                '_blank' 
            );
        });

        $('#frm-quick-add-installer-code').on('submit', function(e){
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: base_url + 'customers/_create_installer_code',
                dataType: 'json',
                data: $('#frm-quick-add-installer-code').serialize(),
                success: function(data) {    
                    $('#btn-save-installer-code').html('Save');                   
                    if (data.is_success) {
                        $('#quick_add_installer_code').modal('hide');
                        $('#install_code').append($('<option>', {
                            value: data.installer_code,
                            text: data.installer_code,
                        }));
                        $('#install_code').val(data.installer_code);
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
                    $('#btn-save-installer-code').html('<span class="bx bx-loader bx-spin"></span>');
                }
            });
        });

        $('#btn-manage-panel-type').on('click', function(){
            window.open(
                base_url + 'tickets/settings_panel_types',
                '_blank' 
            );
        });

        $('#frm-add-panel-type').on('submit', function(e){
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: base_url + 'tickets/_create_panel_type',
                dataType: 'json',
                data: $('#frm-add-panel-type').serialize(),
                success: function(data) {    
                    $('#btn-add-panel-type').html('Save');                   
                    if (data.is_success) {
                        $('#modal-add-panel-type').modal('hide');
                        $('#panel_type').append($('<option>', {
                            value: data.panel_type,
                            text: data.panel_type,
                        }));
                        $('#panel_type').val(data.panel_type);
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
                    $('#btn-add-panel-type').html('<span class="bx bx-loader bx-spin"></span>');
                }
            });
        });

        $('#btn-quick-panel-type').on('click', function(){
            $('#frm-add-panel-type')[0].reset();
            $('#modal-add-panel-type').modal('show');
        });

        $('#btn-quick-site-type').on('click', function(){
            $('#frm-add-panel-type')[0].reset();
            $('#quick_add_site_type').modal('show');
        });

        $('#btn-quick-add-sales-area').on('click', function(){
            $('#frm-quick-add-sales-area')[0].reset();
            $('#quick_add_sales_area').modal('show');
        });

        $('#btn-manage-sales-area').on('click', function(){
            window.open(
                base_url + 'customer/settings_sales_area',
                '_blank' 
            );
        });

        $('#btn-quick-account-type').on('click', function(){
            $('#frm-quick-add-account-type')[0].reset();
            $('#quick_add_account_type').modal('show');
        });

        $('#btn-manage-account-type').on('click', function(){
            window.open(
                base_url + 'customer/settings_account_types',
                '_blank' 
            );
        });

        $('#frm-quick-add-site-type').on('submit', function(e){
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: base_url + 'customers/_create_site_type',
                dataType: 'json',
                data: $('#frm-quick-add-site-type').serialize(),
                success: function(data) {    
                    $('#btn-quick-add-site-type').html('Save');                   
                    if (data.is_success) {
                        $('#quick_add_site_type').modal('hide');
                        $('#site_type').append($('<option>', {
                            value: data.site_type_name,
                            text: data.site_type_name,
                        }));
                        $('#site_type').val(data.site_type_name);
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
                    $('#btn-quick-add-site-type').html('<span class="bx bx-loader bx-spin"></span>');
                }
            });
        });

        $('#frm-quick-add-sales-area').on('submit', function(e){
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: base_url + 'customers/_create_sales_area',
                dataType: 'json',
                data: $('#frm-quick-add-sales-area').serialize(),
                success: function(data) {    
                    $('#btn-save-sales-area').html('Save');                   
                    if (data.is_success) {
                        $('#quick_add_sales_area').modal('hide');
                        $('#sales-area').append($('<option>', {
                            value: data.sa_id,
                            text: data.sa_name,
                        }));
                        $('#sales-area').val(data.sa_id);
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
                    $('#btn-save-sales-area').html('<span class="bx bx-loader bx-spin"></span>');
                }
            });
        });

        $('#btn-quick-add-rate-plan').on('click', function(){
            $('#frm-quick-add-rate-plan')[0].reset();
            $('#quick_add_rate_plan').modal('show');
        });  
        
        $('#btn-manage-rate-plan').on('click', function(){
            window.open(
                base_url + 'customer/settings_system_package',
                '_blank' 
            );
        });

        $('#frm-quick-add-rate-plan').on('submit', function(e){
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: base_url + 'customers/_create_rate_plan',
                dataType: 'json',
                data: $('#frm-quick-add-rate-plan').serialize(),
                success: function(data) {    
                    $('#btn-save-rate-plan').html('Save');                   
                    if (data.is_success) {
                        $('#quick_add_rate_plan').modal('hide');
                        $('#mmr').append($('<option>', {
                            value: data.plan_amount,
                            text: data.plan_amount,
                        }));
                        $('#mmr').val(data.plan_amount);
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
                    $('#btn-save-rate-plan').html('<span class="bx bx-loader bx-spin"></span>');
                }
            });
        });

        $('#btn-quick-add-system-package-type').on('click', function(){
            $('#frm-quick-add-system-package')[0].reset();
            $('#quick_add_system_package').modal('show');
        });  

        $('#btn-manage-system-package').on('click', function(){
            window.open(
                base_url + 'customer/settings_system_package',
                '_blank' 
            );
        });

        $('#frm-quick-add-system-package').on('submit', function(e){
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: base_url + 'customers/_create_system_package_type',
                dataType: 'json',
                data: $('#frm-quick-add-system-package').serialize(),
                success: function(data) {    
                    $('#btn-save-system-package').html('Save');                   
                    if (data.is_success) {
                        $('#quick_add_system_package').modal('hide');
                        $('#system-type').append($('<option>', {
                            value: data.package_name,
                            text: data.package_name,
                        }));
                        $('#system-type').val(data.package_name);
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
                    $('#btn-save-system-package').html('<span class="bx bx-loader bx-spin"></span>');
                }
            });
        });

        $('#btn-quick-add-activation-fee').on('click', function(){
            $('#frm-quick-add-activation-fee')[0].reset();
            $('#quick_add_activation_fee').modal('show');
        });  

        $('#btn-manage-activation-fee').on('click', function(){
            window.open(
                base_url + 'customer/settings_activation_fee',
                '_blank' 
            );
        });

        $('#frm-quick-add-activation-fee').on('submit', function(e){
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: base_url + 'customers/_create_activation_fee',
                dataType: 'json',
                data: $('#frm-quick-add-activation-fee').serialize(),
                success: function(data) {    
                    $('#btn-save-activation-fee').html('Save');                   
                    if (data.is_success) {
                        $('#quick_add_activation_fee').modal('hide');
                        $('#activation-fee').append($('<option>', {
                            value: data.amount,
                            text: data.amount,
                        }));
                        $('#activation-fee').val(data.amount);
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
                    $('#btn-save-activation-fee').html('<span class="bx bx-loader bx-spin"></span>');
                }
            });
        });

        $('#btn-quick-add-communication-type').on('click', function(){
            $('#frm-quick-add-activation-fee')[0].reset();
            $('#quick_add_activation_fee').modal('show');
        });  

        $('#btn-manage-communication-type').on('click', function(){
            window.open(
                base_url + 'customer/settings_solar_lender_type',
                '_blank' 
            );
        });

        $('#btn-quick-add-lender-type').on('click', function(){
            $('#frm-quick-add-lender-type')[0].reset();
            $('#quick_add_lender_type').modal('show');
        }); 

        $('#btn-manage-lender-types').on('click', function(){
            window.open(
                base_url + 'customer/settings_solar_lender_type',
                '_blank' 
            );
        });

        $('#frm-quick-add-lender-type').on('submit', function(e){
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: base_url + 'customers/_create_lender_type',
                dataType: 'json',
                data: $('#frm-quick-add-lender-type').serialize(),
                success: function(data) {    
                    $('#btn-save-lender-type').html('Save');                   
                    if (data.is_success) {
                        $('#quick_add_lender_type').modal('hide');
                        $('#lender_type').append($('<option>', {
                            value: data.name,
                            text: data.name,
                        }));
                        $('#lender_type').val(data.name);
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
                    $('#btn-save-lender-type').html('<span class="bx bx-loader bx-spin"></span>');
                }
            });
        });

        $('#btn-quick-add-system-size').on('click', function(){
            $('#frm-quick-add-system-size')[0].reset();
            $('#quick_add_system_size').modal('show');
        }); 

        $('#btn-manage-system-size').on('click', function(){
            window.open(
                base_url + 'customer/settings_solar_system_size',
                '_blank' 
            );
        });

        $('#frm-quick-add-system-size').on('submit', function(e){
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: base_url + 'customers/_create_system_size',
                dataType: 'json',
                data: $('#frm-quick-add-system-size').serialize(),
                success: function(data) {    
                    $('#btn-save-system-size').html('Save');                   
                    if (data.is_success) {
                        $('#quick_add_system_size').modal('hide');
                        $('#proposed_system_size').append($('<option>', {
                            value: data.name,
                            text: data.name,
                        }));
                        $('#proposed_system_size').val(data.name);
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
                    $('#btn-save-system-size').html('<span class="bx bx-loader bx-spin"></span>');
                }
            });
        });

        $('#btn-quick-add-proposed-module').on('click', function(){
            $('#frm-quick-add-proposed-module')[0].reset();
            $('#quick_add_proposed_module').modal('show');
        }); 

        $('#btn-manage-proposed-module').on('click', function(){
            window.open(
                base_url + 'customer/settings_solar_modules',
                '_blank' 
            );
        });

        $('#frm-quick-add-proposed-module').on('submit', function(e){
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: base_url + 'customers/_create_proposed_module',
                dataType: 'json',
                data: $('#frm-quick-add-proposed-module').serialize(),
                success: function(data) {    
                    $('#btn-save-proposed-module').html('Save');                   
                    if (data.is_success) {
                        $('#quick_add_proposed_module').modal('hide');
                        $('#proposed_modules').append($('<option>', {
                            value: data.name,
                            text: data.name,
                        }));
                        $('#proposed_modules').val(data.name);
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
                    $('#btn-save-proposed-module').html('<span class="bx bx-loader bx-spin"></span>');
                }
            });
        });

        $('#btn-quick-add-proposed-inverter').on('click', function(){
            $('#frm-quick-add-proposed-inverter')[0].reset();
            $('#quick_add_proposed_inverter').modal('show');
        }); 

        $('#btn-manage-proposed-inverter').on('click', function(){
            window.open(
                base_url + 'customer/settings_solar_inverter',
                '_blank' 
            );
        });

        $('#frm-quick-add-proposed-inverter').on('submit', function(e){
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: base_url + 'customers/_create_proposed_inverter',
                dataType: 'json',
                data: $('#frm-quick-add-proposed-inverter').serialize(),
                success: function(data) {    
                    $('#btn-save-proposed-inverter').html('Save');                   
                    if (data.is_success) {
                        $('#quick_add_proposed_inverter').modal('hide');
                        $('#proposed_inverter').append($('<option>', {
                            value: data.name,
                            text: data.name,
                        }));
                        $('#proposed_inverter').val(data.name);
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
                    $('#btn-save-proposed-inverter').html('<span class="bx bx-loader bx-spin"></span>');
                }
            });
        });

        $('#frm-quick-add-account-type').on('submit', function(e){
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: base_url + 'customers/_create_account_type',
                dataType: 'json',
                data: $('#frm-quick-add-account-type').serialize(),
                success: function(data) {    
                    $('#btn-quick-add-account-type').html('Save');                   
                    if (data.is_success) {
                        $('#quick_add_account_type').modal('hide');
                        $('#acct_type').append($('<option>', {
                            value: data.account_type,
                            text: data.account_type,
                        }));
                        $('#acct_type').val(data.account_type);
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
                    $('#btn-quick-add-account-type').html('<span class="bx bx-loader bx-spin"></span>');
                }
            });
        });

        $('#panel_type').on('change', function(){
            let selected = $(this).val();
            let find_string = 'Honeywell';
            if( selected.includes(find_string) ){
                $('#service_provider').val('AlarmNet').trigger("change");
                $('#dealer').val('AlarmNet').trigger("change");
            }else{
                $('#service_provider').val('Alarm.com').trigger("change");
                $('#dealer').val('Alarm.com').trigger("change");
            }
        });

        $('#communication_type').on('change', function(){
            load_account_cost();
        });

        $('#service_provider').on('change', function(){
            load_account_cost();
        });

        $('#contract_status').on('change', function(){
            let selected = $(this).val();
            if( selected == 'Contract Monitoring' ){
                $('#acct_type').val('In-House').trigger('change');
            } 
        });

        function load_account_cost(){
            let service_provider = $('#service_provider').val();
            let service_package_type = $('#communication_type').val();

            $.ajax({
                type: 'POST',
                url: base_url + 'customer/_get_account_cost',
                dataType: 'json',
                data: {
                    service_provider: service_provider,
                    service_package_type:service_package_type
                },
                success: function(o) {
                    let account_cost = parseFloat(o.account_cost);
                    $('#account_cost').val(account_cost.toFixed(2));
                },
            });
        }
    });
</script>