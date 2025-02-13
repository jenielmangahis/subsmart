<script>

    $(document).ready(function() {
        $("#payment_info").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            var payment_method = $("#MODE_OF_PAYMENT").val();
            if( payment_method != 'BRAINTREE' ){
                //var url = form.attr('action');
                $.ajax({
                    type: "POST",
                    url: "<?= base_url() ?>job/update_payment_details",
                    data: form.serialize(), // serializes the form's elements.
                    dataType: 'json',
                    success: function(o) {                    
                        if(o.is_success === 1){
                            sucess();
                        }else{
                            Swal.fire({
                                title: 'Error!',
                                text: o.msg,
                                icon: 'error',
                                showCancelButton: false,
                                confirmButtonColor: '#32243d',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Ok'
                            }).then((result) => {

                            });
                        }

                        $("#btn-billing-pay-now").html('Pay Now');
                    },beforeSend: function() {
                        $("#btn-billing-pay-now").html('<span class="spinner-border spinner-border-sm m-0"></span>');
                    }
                }); 
            }            
        });
    });

    function sucess(){
        Swal.fire({
            title: 'Good Job!',
            text: 'Job has been paid!',
            icon: 'success',
            showCancelButton: false,
            confirmButtonColor: '#32243d',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ok'
        }).then((result) => {
            //if (result.value) {
                window.location.href='<?= base_url(); ?>job/';
            //}
        });
    }

    function error(){
        Swal.fire({
            title: 'Sorry!',
            text: 'Something goes wrong, contact your administrator!',
            icon: 'error',
            showCancelButton: false,
            confirmButtonColor: '#32243d',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ok'
        }).then((result) => {

        });
    }

    $(function(){
        // $("#exp_month").select2({
        //     placeholder: "Month"
        // });

        // $("#exp_year").select2({
        //     placeholder: "Year"
        // });
        // $("#day_of_month_ach").select2({
        //     placeholder: "Day of Month"
        // });
        // $("#invoice_term").select2({
        //     placeholder: ""
        // });

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

    $('.payment_method').on( 'change', function () {
        var method = this.value;
        $('#pay_method').val(method);
        if(method !== 'PP'){
            document.getElementById('payment-button').style.display = "flex";
            document.getElementById('paypal-button-container').style.display = "none";
        }

        if(method === 'CASH'){
            hide_all();
            $("#payment_collected").show('slow');
        }else if(method === 'CC' || method === 'OCCP'){
            hide_all();
            $("#credit_card").show('slow');
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
        }else if(method === 'VENMO'  || method === 'SQ'){
            hide_all();
            $(".account_cred").show('slow');
        }else if(method === 'WW' || method === 'HOF' || method === 'OPT'){
            hide_all();
            $(".account_cred").show('slow');
            $("#confirmationPD").hide('slow');
            $("#docu_signed").show('slow');
        }else if(method === 'Invoicing'){
            hide_all();
            $(".invoicing_field").show("slow");
        }
        console.log(method);
    });
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

    function HIDE_ALL() {
        $('#square-card-button').hide();
        $('.CASH, .CREDIT_CARD, .ACH, .VENMO, .PAYPAL, .INVOICING_FIELD, .DOCUMENT_SIGNED, .CHECK_NUMBER, .STRIPE, .BRAINTREE, .SQUARE').hide();
    }
    function SHOW_ALL() {
        $('.PAYMENT_BUTTON').show();
        $('#btn-billing-pay-now').show();
    }
    HIDE_ALL();
    $('.CREDIT_CARD').show();
    $('#MODE_OF_PAYMENT').change(function(event) {
        var SELECTED_PAYMENT = $('#MODE_OF_PAYMENT').val();
        if (SELECTED_PAYMENT == "CREDIT_CARD") {
            HIDE_ALL();
            SHOW_ALL()
            $('.CREDIT_CARD').fadeIn('fast');
        }
        if (SELECTED_PAYMENT == "CASH") {
            HIDE_ALL();
            SHOW_ALL()
            $('.CASH').fadeIn('fast');
        }
        if (SELECTED_PAYMENT == "CHECK") {
            HIDE_ALL();
            SHOW_ALL()
            $('.CHECK_NUMBER').fadeIn('fast');
        }
        if (SELECTED_PAYMENT == "ACH") {
            HIDE_ALL();
            SHOW_ALL()
            $('.ACH').fadeIn('fast');
        }
        if (SELECTED_PAYMENT == "VENMO") {
            HIDE_ALL();
            SHOW_ALL()
            $('.VENMO').fadeIn('fast');
        }
        if (SELECTED_PAYMENT == "SQUARE") {
            HIDE_ALL();
            SHOW_ALL()
            $('.SQUARE').fadeIn('fast');
            $('#square-card-button').show();
            $('#btn-billing-pay-now').hide();
        }
        if (SELECTED_PAYMENT == "PAYPAL") {
            HIDE_ALL();
            $('.PAYMENT_BUTTON').hide();
            //$('.VENMO').fadeIn('fast');
            $('.PAYPAL').fadeIn('fast');
        }
        if (SELECTED_PAYMENT == "STRIPE") {
            HIDE_ALL();
            $('.PAYMENT_BUTTON').hide();
            //$('.VENMO').fadeIn('fast');
            $('.STRIPE').fadeIn('fast');
        }
        if (SELECTED_PAYMENT == "BRAINTREE") {
            HIDE_ALL();            
            $('.BRAINTREE').fadeIn('fast');
        }
        if (SELECTED_PAYMENT == "INVOICING") {
            HIDE_ALL();
            SHOW_ALL()
            $('.INVOICING_FIELD').fadeIn('fast');
        }
        if (SELECTED_PAYMENT == "WARRANTY_WORK" || SELECTED_PAYMENT == "HOME_OWNER_FINANCING" || SELECTED_PAYMENT == "OTHERS") {
            HIDE_ALL();
            SHOW_ALL()
            $('.DOCUMENT_SIGNED').fadeIn('fast');
            $('.VENMO').fadeIn('fast');
            $('.VENMO_CONFIRMATION').hide();
        }
    });
</script>
