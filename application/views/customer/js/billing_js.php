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

        // hide default
        $("#print_invoice").hide("slow");
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
        $('#method').val(method);
        if(method === 'CASH'){
            hide_all();
            $("#payment_collected").show('slow');
        }else if(method === 'CC' || method === 'OCCP' || method === 'NMI'){
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
            $(".invoicing_field").show("slow");
            $("#print_invoice").show("slow");
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

    $("#pay_billing").submit(function(e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.
        var form = $(this);
        var url = form.attr('action');
        $.ajax({
            type: "POST",
            url: base_url + "customer/save_billing",
            data: form.serialize(), // serializes the form's elements.
            success: function(data)
            {
                if(data === '0'){
                    sweetalert('Good Job!','Payment has been Captured.','success', 0)
                }else{
                    sweetalert('Sorry',data,'error', 1)
                }
                console.log(data);
            }
        });
    });

    function sweetalert($title,information,$icon,$is_error){
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
                if( $is_error == 0 ){
                    window.location.reload(true);
                }                
            }
        });
    }
</script>
