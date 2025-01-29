<script>
    $(function(){
        $("#exp_month").select2({
            placeholder: "Select Month"
        });
        $("#transaction_category").select2({
            placeholder: "Select Category"
        });
        $("#exp_year").select2({
            placeholder: "Select Year"
        });
        $("#day_of_month_ach").select2({
            placeholder: "Day of Month"
        });
        $("#invoice_term").select2({
            placeholder: ""
        });
        $("#frequency").select2({
            placeholder: ""
        });

        // hide default
        $("#payment_collected").hide("slow");
        $("#day_of_month").hide("slow");
        $("#account_number").hide("slow");
        $("#check_number").hide("slow");
        $("#docu_signed").hide("slow");
        $(".CNRN").hide("slow");
        $(".account_cred").hide("slow");
        $(".invoicing_field").hide("slow");

        $('.phone_number').keydown(function (e) {
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

        $('#btn-quick-add-term').on('click', function(){
            $('#quick_add_terms').modal('show');
            $('#frm-quick-add-term')[0].reset();
        });

        $('#frm-quick-add-term').on('submit', function(e){
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: base_url + 'customers/_create_accounting_terms',
                dataType: 'json',
                data: $('#frm-quick-add-term').serialize(),
                success: function(data) {    
                    $('#btn-save-terms').html('Save');                   
                    if (data.is_success) {
                        $('#quick_add_terms').modal('hide');
                        $('#invoice_term').append($('<option>', {
                            value: data.term_due_days,
                            text: data.term_name,
                        }));
                        $('#invoice_term').val(data.term_due_days);
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
                    $('#btn-save-terms').html('<span class="bx bx-loader bx-spin"></span>');
                }
            });
        });

        $('#btn-edit-customer-information').click(function () {
            $('.subs-payment-form-container .container-left .form_line input[type=text]').removeAttr('readonly');
            $('.subs-payment-form-container .container-left .form_line input[type=email]').removeAttr('readonly');
            $('#btn-update-customer-information').show();
            $('#btn-cancel-customer-information').show();
            $('#btn-edit-customer-information').hide();
        })    

        $('#btn-cancel-customer-information').click(function () {
            $('.subs-payment-form-container .container-left .form_line input[type=text]').prop('readonly', true);
            $('.subs-payment-form-container .container-left .form_line input[type=email]').prop('readonly', true);
            $('#btn-update-customer-information').hide();
            $('#btn-cancel-customer-information').hide();
            $('#btn-edit-customer-information').show();
        });
    });

    $('#btn-add-subscription-plan').on('click', function(){
        location.href = '<?= base_url('customer/subscription_new/'.$this->uri->segment(3)); ?>';
    });

    $('#invoice_term').on('change', function(){
        var selected = $(this).val();

        if( selected == '0' || selected == '' || selected == null ){
            var new_date = moment(moment(), "YYYY-MM-DD");
            var new_due_date = moment(moment(), "YYYY-MM-DD").add(5, 'days');
        }else{
            var days = parseFloat(selected);
            var new_date = moment(moment(), "YYYY-MM-DD").add(days, 'days');
            var new_due_date = moment(moment(), "YYYY-MM-DD").add(days + 5, 'days');
        }
        
        //$('#invoice_date').val(new_date.format('YYYY-MM-DD'));
        $('#invoice_due_date').val(new_due_date.format('YYYY-MM-DD'));
    });

    $('.payment_method').on( 'change', function () {
        var method = this.value;

        $('#method').val(method);
        remove_required();

        $('#payment-button').show();

        if(method !== 'PP'){
            //document.getElementById('payment-button').style.display = "flex";            
            document.getElementById('paypal-button-container').style.display = "none";
        }

        if(method === 'CASH'){
            hide_all();
            $("#payment_collected").show('slow');
            $('#is_collected').prop("required", true);
            $('#btn-save-payment').show();
        }else if(method === 'CC' || method === 'OCCP' || method === 'NMI'){
            hide_all();
            $("#credit_card").show('slow');
            $('#exp_month').prop("required", true);
            $('#exp_year').prop("required", true);
            $('#cvc').prop("required", true);
            $('#btn-save-payment').show();
        }else if(method === 'CHECK'){
            hide_all();
            $("#check_number").show('slow');
            $(".CNRN").show('slow');
            $('#btn-save-payment').show();
        }else if(method === 'ACH'){
            hide_all();
            $(".CNRN").show('slow');
            $("#day_of_month").show('slow');
            $('#btn-save-payment').show();
        }else if(method === 'PP'){
            hide_all();
            $(".account_cred").show('slow');
            document.getElementById('payment-button').style.display = "none";
            document.getElementById('paypal-button-container').style.display = "flex";
            $('#btn-save-payment').hide();
        }else if(method === 'VENMO' || method === 'PP' || method === 'SQ'){
            hide_all();
            $(".account_cred").show('slow');
            $('#btn-save-payment').show();
        }else if(method === 'WW' || method === 'HOF' || method === 'OPT'){
            hide_all();
            $(".account_cred").show('slow');
            $("#confirmationPD").hide('slow');
            $("#docu_signed").show('slow');
            $('#btn-save-payment').show();
        }else if(method === 'Invoicing'){
            hide_all();
            $('#card_number').prop("required", false);
            $('#payment-button').hide();
            $(".invoicing_field").show("slow");
            $('#btn-save-payment').show();
        }
    });

    function remove_required(){
        $('#exp_month').prop("required", false);
        $('#exp_year').prop("required", false);
        $('#cvc').prop("required", false);
        $('#is_collected').prop("required", false);
    }

    function hide_all(){
        $("#credit_card").hide("slow");
        $("#account_number").hide("slow");
        $(".CNRN").hide('slow');
        $("#day_of_month").hide('slow');
        $("#payment_collected").hide('slow');
        $(".account_cred").hide('slow');
        $("#check_number").hide('slow');
        $("#docu_signed").hide('slow');
        $(".invoicing_field").hide("slow");
    }

    $("#pay_billing").submit(function(e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.
        var form = $(this);
        var url = form.attr('action');
        Swal.fire({
            title: 'Confirmation',
            html: 'Are all entries correct? Proceeding will create customer subscription payment.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: base_url + "customer/save_subscription",
                    data: form.serialize(), 
                    dataType:'json',
                    success: function(result) {
                        if( result.is_success == 1 ) {
                            Swal.fire({
                            icon: 'success',
                            title: 'Subscription Payment',
                            text: result.msg,
                            }).then((result) => {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: result.msg,
                            });
                        }
                    }
                });
            }
        });
    });

    $("#subs_payment_cust_info_update_form").submit(function(e) {
        e.preventDefault();
        var form = $(this);
        var url = form.attr('action');
        $.ajax({
            type: "POST",
            url: base_url + "customer/_update_sub_payment_customer_info",
            data: form.serialize(),
            success: function(o)
            {
                if(o === 'true'){
                    sweetalert('Good Job!','Customer Info has been updated.','success')
                }else{
                    sweetalert('Sorry',o,'error')
                }
                console.log(o);
            }
        });        
    });

    $('#btn-quick-add-transaction-category').on('click', function(){
        $('#frm-quick-add-transaction-category')[0].reset();
        $('#quick_add_transaction_category').modal('show');
    });

    $('#frm-quick-add-transaction-category').on('submit', function(e){
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: base_url + 'customers/_create_financing_category',
            dataType: 'json',
            data: $('#frm-quick-add-transaction-category').serialize(),
            success: function(data) {    
                $('#btn-save-transaction-category').html('Save');                   
                if (data.is_success) {
                    $('#quick_add_transaction_category').modal('hide');
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
                $('#btn-save-transaction-category').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });    

    function sweetalert($title,information,$icon){
        Swal.fire({
            title: $title,
            text: information,
            icon: $icon,
            showCancelButton: false,
            confirmButtonColor: '#32243d',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value) {
                window.location.reload(true);
            }
        });
    }
</script>
