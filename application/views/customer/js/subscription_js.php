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
    });

    $('#btn-add-subscription-plan').on('click', function(){
        location.href = '<?= base_url('customer/subscription_new/'.$this->uri->segment(3)); ?>';
    });

    $('#invoice_term').on('change', function(){
        var selected = $(this).val();
        var selected = selected.replace('Net ', '');

        if( selected == 'Due On Receipt' ){
            var new_date = moment(moment(), "YYYY-MM-DD");
        }else{
            var days = parseFloat(selected);
            var new_date = moment(moment(), "YYYY-MM-DD").add(days, 'days');
        }
        
        $('#invoice_date').val(new_date.format('YYYY-MM-DD'));
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
        }else if(method === 'CC' || method === 'OCCP' || method === 'NMI'){
            hide_all();
            $("#credit_card").show('slow');
            $('#exp_month').prop("required", true);
            $('#exp_year').prop("required", true);
            $('#cvc').prop("required", true);
        }else if(method === 'CHECK'){
            hide_all();
            $("#check_number").show('slow');
            $(".CNRN").show('slow');
        }else if(method === 'ACH'){
            hide_all();
            $(".CNRN").show('slow');
            $("#day_of_month").show('slow');
        }else if(method === 'PP'){
            hide_all();
            $(".account_cred").show('slow');
            document.getElementById('payment-button').style.display = "none";
            document.getElementById('paypal-button-container').style.display = "flex";
        }else if(method === 'VENMO' || method === 'PP' || method === 'SQ'){
            hide_all();
            $(".account_cred").show('slow');
        }else if(method === 'WW' || method === 'HOF' || method === 'OPT'){
            hide_all();
            $(".account_cred").show('slow');
            $("#confirmationPD").hide('slow');
            $("#docu_signed").show('slow');
        }else if(method === 'Invoicing'){
            hide_all();
            $('#payment-button').hide();
            $(".invoicing_field").show("slow");
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
        $.ajax({
            type: "POST",
            url: base_url + "customer/save_subscription",
            data: form.serialize(), // serializes the form's elements.
            success: function(data)
            {
                if(data === '0'){
                    sweetalert('Good Job!','Payment has been Captured.','success')
                }else{
                    sweetalert('Sorry',data,'error')
                }
                console.log(data);
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
