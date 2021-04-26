<script>
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

        // hide default
        $("#payment_collected").hide("slow");
        $("#day_of_month").hide("slow");
        $("#account_number").hide("slow");
        $("#check_number").hide("slow");
        $("#docu_signed").hide("slow");
        $(".CNRN").hide("slow");
        $(".account_cred").hide("slow");
    });

    $('.payment_method').on( 'change', function () {
        var method = this.value;
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
        }else if(method === 'VENMO' || method === 'PP' || method === 'SQ'){
            hide_all();
            $(".account_cred").show('slow');
        }else if(method === 'WW' || method === 'HOF' || method === 'OPT'){
            hide_all();
            $(".account_cred").show('slow');
            $("#confirmationPD").hide('slow');
            $("#docu_signed").show('slow');
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
    }
</script>
