<script>
    $(function(){
        $("#fk_sa_id").select2({
            placeholder: "Select Sales Area"
        });
        $("#prefix").select2({
            placeholder: "Select Name Prefix"
        });
        $("#suffix").select2({
            placeholder: "Select Name Suffix"
        });
        $("#pay_history").select2({
            placeholder: "Select Pay History"
        });
        $("#mmr").select2({
            placeholder: "Select Month Rate"
        });
        $("#bill_freq").select2({
            placeholder: "Select Billing Frequency"
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
            placeholder: "Select Saved By"
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
        $("#acct_type").select2({
            placeholder: "Select Account Type"
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
            placeholder: "Select Month"
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
    });
    $(function() {
        $("nav:first").addClass("closed");
        $(".date_checkbox").on( 'change', function (event) {
            const date_id = this.value;
            if (event.currentTarget.checked) {
                event.preventDefault();
                $('#'+date_id).prop("disabled", false);
            } else {
                event.preventDefault();
                $('#'+date_id).val(""); // Element(s) are now enabled.
                $('#'+date_id).prop("disabled", true); // Element(s) are now enabled.
            }
        });
    });
</script>

<script>
    $(document).ready(function () {


        $("#first_name").on("keyup change", function(e) {
            $('#card_fname').val(this.value);
        });
        $("#last_name").on("keyup change", function(e) {
            $('#card_lname').val(this.value);
        });
        // rucurring monthly revenue(RMR)

        $("#businessName").hide("slow");
        $("#fax_").hide("slow");
       $("#customer_type").on( 'change', function () {
            var c_type = this.value;
            if(c_type === 'Residential'){
                $("#businessName").hide("slow");
                $("#fax_").hide("slow");
            }else{
                $("#businessName").show('slow');
                $("#fax_").show('slow');
            }
        });


        hide_all();
        card_show();
        $("#bill_method").on( 'change', function () {
            var c_type = this.value;
            if(c_type === 'CC' || c_type === 'DC' || c_type === 'OCCP'){
                hide_all();
                card_show();
            }else if(c_type === 'CASH'){
                hide_all();
            }else if(c_type === 'CHECK'){
                hide_all();
                $("#checkNumber").show("slow");
                route_show();
            }else if(c_type === 'ACH'){
                hide_all();
                route_show();
            }else if(c_type === 'Invoicing'){
                hide_all();
                $(".invoicing_field").show("slow");
            }else if(c_type === 'VENMO' || c_type === 'PP' || c_type === 'SQ'){
                hide_all();
                $(".account_cred").show('slow');
            }else if(c_type === 'WW' || c_type === 'HOF' || c_type === 'eT' || c_type === 'OPT'){
                hide_all();
                $(".account_cred").show('slow');
                $("#confirmationPD").hide("slow");
            }
        });

        function card_show(){
            $("#CCN").show('slow');
            $("#CCE").show('slow');
            $("#checkNumber").hide("slow");
            $("#routingNumber").hide("slow");
            $("#accountNumber").hide("slow");
        }
        function route_show(){
            $("#CCN").hide('slow');
            $("#CCE").hide('slow');
            $("#routingNumber").show("slow");
            $("#accountNumber").show("slow");
        }
        function hide_all(){
            $(".invoicing_field").hide("slow");
            $("#checkNumber").hide("slow");
            $("#routingNumber").hide("slow");
            $("#accountNumber").hide("slow");
            $("#CCN").hide('slow');
            $("#CCE").hide('slow');
            $(".account_cred").hide('slow');
        }

        $('#ssn').keydown(function (e) {
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



        $("#date_picker").datetimepicker({
            format: "l",
            //minDate: new Date(),
        });
        $("#recurring_start_date").datetimepicker({
            format: "l",
            //minDate: new Date(),
        });
        $("#recurring_end_date").datetimepicker({
            format: "l",
            //minDate: new Date(),
        });
        $("#bill_start_date").datetimepicker({
            format: "l",
            //minDate: new Date(),
        }); 
        // .on('dp.change', function (e) {
        //     var selected_data = moment(e.date._d).format('L');
        //     var contract = $('#contract_term').val();
        //     var plus_date = moment.utc(selected_data).add(contract,'months');
        //     console.log( moment(plus_date).format('l'));
        //     //console.log( moment(plus_date).format('D'));
        //     $('#bill_end_date').val(moment(plus_date).format('l'));
        //     $('#bill_day ').val(moment(plus_date).format('D'));
        //     //$('#bill_day option[value='+moment(plus_date).format('D')+']').prop('selected',true);
        //     //var billDay = moment(plus_date).format('D');
        // });

        $("#bill_end_date").datetimepicker({
            format: "l",
            //minDate: new Date(),
        });
        $(".date_picker").datetimepicker({
            format: "l",
            //'setDate': new Date(),
            //minDate: new Date(),
        });
        //$('.date_picker').val(new Date().toLocaleDateString());

        //$('.time_picker').val(new Date().toLocaleTimeString());

        // $(".time_picker").datetimepicker({
        //     format: "LT",
        // });

        $("#rep_comm").keyup(function(){
            $('#rep_paid').val(this.value);
        });

        $("#tech_comm").keyup(function(){
            $('#tech_paid').val(this.value);
        });

        $("#rep_paid").keyup(function(){
            var repPaid=this.value;
            var techPaid = $('#tech_paid').val();
            var new_sub_total = Number(repPaid) + Number(techPaid);
            $('#labor_cost').val(new_sub_total);
            console.log(new_sub_total);
        });

        $("#tech_paid").keyup(function(){
            var repPaid=this.value;
            var techPaid = $('#rep_paid').val();
            var new_sub_total = Number(repPaid) + Number(techPaid);
            $('#labor_cost').val(new_sub_total);
            console.log(new_sub_total);
        });


        $('.timepicker').timepicker('setTime', new Date().toLocaleTimeString());
        //$('#tech_depart_time').timepicker('setTime', moment.utc(new Date().toLocaleTimeString()).add(2,'hours'));
        $('#tech_depart_time').timepicker('setTime',  moment.utc(new Date().toLocaleTimeString(),'hh:mm a').add(2,'hour').format('h:mm a'));

        $("#tech_arrive_time").on("keyup change", function(e) {
            //$('#card_fname').val(this.value);
            $('#tech_depart_time').timepicker('setTime',  moment.utc(this.value,'hh:mm a').add(2,'hour').format('h:mm a'));
        });

        $("#monitor_id").on("keyup change", function(e) {
            $('#alarm_cs_account').val(this.value);
        });

        var table_assign_module = $('#assign_module_table').DataTable({
            "lengthChange": false,
            "searching" : true,
            "pageLength": 5
        });
        var note = $('#notes_table').DataTable({
            "lengthChange": false,
            "searching" : true,
            "pageLength": 5
        });
        var devices_table= $('#devices_table').DataTable({
            "lengthChange": false,
            "searching" : true,
            "pageLength": 5
        });
    });

    function print_data_sheet(){
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
        $("#customer_form").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            //var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: base_url + "customer/save_customer_profile",
                data: form.serialize(), // serializes the form's elements.
                success: function(data)
                {
                    if(isNaN(data)){
                        error(data);
                    }else{
                        <?php if(isset($profile_info)): ?>
                        sucess("Customer Information has been Updated Successfully!",data);
                        <?php else: ?>
                        sucess("New Customer has been Added Successfully!",data);
                        <?php endif; ?>
                    }
                    console.log(data);
                }
            });
        });
        function save_sucess(information){
            Swal.fire(
                'Good job!',
                information,
                'success'
            );
        }
        function error(information){
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
        function sucess(information,$id){
            Swal.fire({
                title: 'Good job!',
                text: information,
                icon: 'success',
                showCancelButton: false,
                confirmButtonColor: '#32243d',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ok'
            }).then((result) => {
                if (result.value) {
                    window.location.href="<?= base_url(); ?>customer/preview/"+$id;
                }
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
            for (var i=0;i<newField.length;i++) {
                var theName = newField[i].name;
                if (theName){
                    //  newField[i].name = theName+'[]';
                }

            }
            var insertHere = document.getElementById('writeroot');
            insertHere.parentNode.insertBefore(newFields,insertHere);
        }
        // window.onload = moreFields;
        // $("#moreFields").on( "click", function( event ) {
        //     alert("sf");
        //
        // });
        // $("#moreFields").on( "click", function( event ) {
        //     moreFields();
        // });

        $("body").delegate("#moreFields", "click", function(){
            //alert("Delegated Button Clicked");
            //moreFields();
            counter++;
            var newFields = document.getElementById('readroot').cloneNode(true);
            newFields.id = '';
            newFields.style.display = 'inline';
            var newField = newFields.childNodes;

            //console.log(newField);
            for (var i=0;i<newField.length;i++) {
                var theName = newField[i].name;
                if (theName){
                    //  newField[i].name = theName+'[]';
                }

            }
            var insertHere = document.getElementById('writeroot');
            insertHere.parentNode.insertBefore(newFields,insertHere);
        });

        $(".remove_device").on( "click", function( event ) {
            var ID=this.id;
            //alert(ID);
            $.ajax({
                type: "POST",
                url: "/customer/remove_devices",
                data: {id : ID}, // serializes the form's elements.
                success: function(data){
                    if(data === "Done"){
                        window.location.reload();
                    }else{
                        console.log(data);
                    }
                }
            });
        });



    });
</script>