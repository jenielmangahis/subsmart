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
            placeholder: "Select Pay History"
        });
        $("#bill_freq").select2({
            placeholder: "Select Pay History"
        });
        $("#bill_day").select2({
            placeholder: "Select Pay History"
        });
        $("#contract_term").select2({
            placeholder: "Select Pay History"
        });
        $("#bill_method").select2({
            placeholder: "Select Pay History"
        });
        $("#assign_to").select2({
            placeholder: "Select Pay History"
        });
        $("#purchase_multiple").select2({
            placeholder: "Select Pay History"
        });
        $("#language").select2({
            placeholder: "Select Pay History"
        });
        $("#fk_sales_rep_office").select2({
            placeholder: "Select Pay History"
        });
        $("#technician").select2({
            placeholder: "Select Pay History"
        });
        $("#save_by").select2({
            placeholder: "Select Pay History"
        });
        $("#cancel_reason").select2({
            placeholder: "Select Pay History"
        });
        $("#pre_install_survey").select2({
            placeholder: "Select Pay History"
        });
        $("#post_install_survey").select2({
            placeholder: "Select Pay History"
        });
        $("#activation_fee").select2({
            placeholder: "Select Pay History"
        });
        $("#lead_source").select2({
            placeholder: "Select Pay History"
        });
        $("#verification").select2({
            placeholder: "Select Pay History"
        });
        $("#warranty_type").select2({
            placeholder: "Select Pay History"
        });
        $("#acct_type").select2({
            placeholder: "Select Pay History"
        });
        $("#panel_type").select2({
            placeholder: "Select Pay History"
        });
        $("#mon_waived").select2({
            placeholder: "Select Pay History"
        });
        $("#status").select2({
            placeholder: "Select Pay History"
        });
    });
    $(function() {
        $("nav:first").addClass("closed");
    });
</script>

<script>
    $(document).ready(function () {
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
        $("#bill_start_date").datetimepicker({
            format: "l",
            //minDate: new Date(),
        });
        $("#bill_end_date").datetimepicker({
            format: "l",
            //minDate: new Date(),
        });



        $(".date_picker").datetimepicker({
            format: "l",
            //'setDate': new Date(),
            //minDate: new Date(),
        });
        $('.date_picker').val(new Date().toLocaleDateString());

        //$('.time_picker').val(new Date().toLocaleTimeString());

        // $(".time_picker").datetimepicker({
        //     format: "LT",
        // });

        $('.timepicker').timepicker('setTime', new Date().toLocaleTimeString());

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
                url: base_url + "customer/add_data_sheet",
                data: form.serialize(), // serializes the form's elements.
                success: function(data)
                {
                    if(data === "Added"){
                        sucess("New Customer has been Added Successfully!");
                    }else if(data === "Updated"){
                        sucess("Customer Info has been Updated Successfully!");
                    }else{
                        console.log(data);
                    }

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
        function sucess(information){
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
                    window.location.href="/customer";
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