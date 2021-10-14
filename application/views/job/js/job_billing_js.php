<script>

    $(document).ready(function() {
        $("#payment_info").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            var payment_method = $("#pay_method").val();
            //var url = form.attr('action');
            if( payment_method == 'CC' ){
                $(".btn-save-payment").html('<span class="spinner-border spinner-border-sm m-0"></span>');
                setTimeout(function () {
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url() ?>job/update_payment_details_cc",
                        data: form.serialize(), // serializes the form's elements.
                        dataType:'json',
                        success: function(data) {
                            if(data.is_success){
                                sucess();
                            }else{
                                Swal.fire({
                                    title: 'Sorry!',
                                    text: data.msg,
                                    icon: 'error',
                                    showCancelButton: false,
                                    confirmButtonColor: '#32243d',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Ok'
                                }).then((result) => {

                                });
                            }

                            $(".btn-save-payment").html('Save');
                        }
                    });
                }, 500);
            }else{
                $.ajax({
                    type: "POST",
                    url: "<?= base_url() ?>job/update_payment_details",
                    data: form.serialize(), // serializes the form's elements.
                    success: function(data) {
                        console.log(data);
                        if(data === '1'){
                            sucess();
                        }else{
                            error();
                        }
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
            if (result.value) {
                window.location.href='<?= base_url(); ?>job/';
            }
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
        $("#exp_month").select2({
            placeholder: "Month"
        });

        $("#exp_year").select2({
            placeholder: "Year"
        });
        $("#day_of_month_ach").select2({
            placeholder: "Day of Month"
        });
        $("#invoice_term").select2({
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



</script>
