<script>
    var memo_note = '';

        $(document).ready(function () {
        var table_dispute_items =$('#dispute_table').DataTable({
            "lengthChange": false,
            "searching" : false,
            "pageLength": 20,
            "info": false,
            "order": [],
            initComplete: function () {
            }
        });

        var table_notes =$('#internal_notes_table').DataTable({
            "lengthChange": false,
            "searching" : false,
            "pageLength": 20,
            "info": false,
            "order": [],
        });

        var table_quick_list =$('#customer_list_quick').DataTable({
            "lengthChange": false,
            "searching" : false,
            "pageLength": 20,
            "info": false
        });

        var table_cust_list =$('#customer_list_table').DataTable({
            "lengthChange": true,
            "searching" : true,
            "pageLength": 10,
            "info": true,
            "responsive": true,

            "order": [],
            initComplete: function () {
                this.api().columns([11]).every( function () {
                    var column = this;
                    var select = $('<select class="input_select" style="padding: 5px;border-radius: 5px;display: inline-block !important;"><option value="">All</option></select>').appendTo($(".dataTables_filter"))
                        .on( 'change', function () {
                            var val = $.fn.dataTable.util.escapeRegex($(this).val());
                            column.search( val ? val : '', false, true ).draw();
                            $(this).val();
                        } );
                    column.data().unique().sort().each( function ( d, j ) {
                        //var val = $('<div/>').html(d).text();
                        //select.append( '<option value="' + val + '">' + val + '</option>' );
                        select.append( '<option value="'+d+'">'+d+'</option>' )
                        //console.log(val);
                    });
                } );
            }
        });
        // var table_clt =$('#customerListTable').DataTable({
        //     "lengthChange": false,
        //     "searching" : true,
        //     "pageLength": 20
        // });

        function display_leadtype_data(){
            table_lt.clear();
            $.ajax({
                type: "POST",
                url: "/customer/fetch_leadtype_data",
                data: {name : "leadtype"}, // serializes the form's elements.
                success: function(data)
                {
                    var lead_types_data = JSON.parse(data);
                    for(var x=0;x<lead_types_data.length;x++){
                        var html = '<tr role="row">';
                        html += '<td class="sorting_1">'+lead_types_data[x].lead_name+'</td>';
                        html += '<td>'+'<button class="btn btn-sm btn-default edit_leadtype" id="'+lead_types_data[x].lead_id+'" data-name="'+lead_types_data[x].lead_name+'" ><i class="fa fa-pencil"></i></button>' +
                            '<button id="'+lead_types_data[x].lead_id+'" class="btn btn-sm btn-default delete_leadtype" title="Delete Lead Type" data-toggle="tooltip"><i class="fa fa-trash"></i></button>'+'</td></tr>';
                        table_lt.rows.add($(html)).draw();
                        //$('#leadtype_table_data').append(html);
                        $('#leadTypeForm')[0].reset();
                    }
                    console.log(lead_types_data.length);
                    console.log(lead_types_data);
                }
            });
        }
        function display_salesarea_data(){
            table_sa.clear();
            $.ajax({
                type: "POST",
                url: "/customer/fetch_salesarea_data",
                data: {name : "leadtype"}, // serializes the form's elements.
                success: function(data)
                {
                    var lead_types_data = JSON.parse(data);
                    for(var x=0;x<lead_types_data.length;x++){
                        var html = '<tr role="row">';
                        html += '<td class="sorting_1">'+lead_types_data[x].sa_name+'</td>';
                        html += '<td>'+'<button class="btn btn-sm btn-default edit_salesarea" id="'+lead_types_data[x].sa_id+'" data-name="'+lead_types_data[x].sa_name+'" ><i class="fa fa-pencil"></i></button>' +
                            '<button id="'+lead_types_data[x].sa_id+'" class="btn btn-sm btn-default delete_salesarea" title="Delete Lead Type" data-toggle="tooltip"><i class="fa fa-trash"></i></button>'+'</td></tr>';
                        table_sa.rows.add($(html)).draw();
                        //$('#leadtype_table_data').append(html);
                        $('#salesAreaForm')[0].reset();
                    }
                  //  console.log(lead_types_data.length);
                   // console.log(lead_types_data);
                }
            });
        }
        function display_leadsource_data(){
            table_ls.clear();
            $.ajax({
                type: "POST",
                url: "/customer/fetch_leadsource_data",
                data: {name : "leadsource"}, // serializes the form's elements.
                success: function(data)
                {
                    var lead_types_data = JSON.parse(data);
                    for(var x=0;x<lead_types_data.length;x++){
                        var html = '<tr role="row">';
                        html += '<td class="sorting_1">'+lead_types_data[x].ls_name+'</td>';
                        html += '<td>'+'<button class="btn btn-sm btn-default edit_ls" id="'+lead_types_data[x].ls_id+'" data-name="'+lead_types_data[x].ls_name+'" ><i class="fa fa-pencil"></i></button>' +
                            '<button id="'+lead_types_data[x].ls_id+'" class="btn btn-sm btn-default delete_ls" title="Delete Lead Type" data-toggle="tooltip"><i class="fa fa-trash"></i></button>'+'</td></tr>';
                        table_ls.rows.add($(html)).draw();
                        //$('#leadtype_table_data').append(html);
                        $('#leadSourceForm')[0].reset();
                    }
                    console.log(lead_types_data.length);
                    console.log(lead_types_data);
                }
            });
        }

        $(".delete_cust").on( "click", function( event ) {
            var ID=this.id;
            // alert(ID);
            Swal.fire({
                title: 'Are you sure you want to DELETE this customer?',
                text: "All customer data will be remove as well as module information.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#32243d',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: "/customer/remove_customer",
                        data: {prof_id : ID}, // serializes the form's elements.
                        success: function(data)
                        {
                            if(data === "Done"){
                                sucess("Customer Remove Successfully!");
                            }else{
                                console.log(data);
                            }
                        }
                    });
                    // window.location.href="/customer";
                }
            });
        });

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

        $("body").delegate(".delete_leadtype", "click", function(){
            //alert("Delegated Button Clicked");
            var ID=this.id;
            $.ajax({
                type: "POST",
                url: "/customer/delete_data",
                data: { id:ID,table:"lt" }, // serializes the form's elements.
                success: function(data){
                    console.log(data);
                    display_leadtype_data();
                }
            });
        });

        $("body").delegate(".delete_salesarea", "click", function(){
            //alert("Delegated Button Clicked");
            var ID=this.id;
            $.ajax({
                type: "POST",
                url: "/customer/delete_data",
                data: { id:ID,table:"sa" }, // serializes the form's elements.
                success: function(data){
                    console.log(data);
                    display_salesarea_data();
                }
            });
        });

        $("body").delegate(".delete_ls", "click", function(){
            //alert("Delegated Button Clicked");
            var ID=this.id;
            $.ajax({
                type: "POST",
                url: "/customer/delete_data",
                data: { id:ID,table:"ls" }, // serializes the form's elements.
                success: function(data){
                    console.log(data);
                    display_salesarea_data();
                }
            });
        });

        $("body").delegate(".edit_leadtype", "click", function(){
            //alert("Delegated Button Clicked");
            var ID=this.id;
            $('#modal_lead_type').modal('show');
            $('[id="lead_name"]').val($(this).data('name'));
            $('[id="lead_id"]').val(ID);
        });

        $("body").delegate(".edit_salesarea", "click", function(){
            //alert("Delegated Button Clicked");
            $('#sales_area_header').text('Edit Sales Area');
            var ID=this.id;
            $('#modal_sales_area').modal('show');
            $('[id="sa_name"]').val($(this).data('name'));
            $('[id="sa_id"]').val(ID);
        });

        $("body").delegate(".edit_ls", "click", function(){
            //alert("Delegated Button Clicked");
            $('#lead_source_header').text('Edit Lead Source');
            var ID=this.id;
            $('#modal_lead_source').modal('show');
            $('[id="ls_name"]').val($(this).data('name'));
            $('[id="ls_id"]').val(ID);
        });

        $("#save_memo").on( "click", function( event ) {
            var note = $('#memo_txt').val();
            $.ajax({
                type: "POST",
                url: base_url + "/customer/update_customer_profile",
                data: { notes : note , memo_note:memo_note, id : <?= isset($customer_profile_id) ? $customer_profile_id : 0; ?> }, // serializes the form's elements.
                success: function(data)
                {
                    if(data === "Success"){
                        memo_note = $('#memo_txt').val();
                        $('#memo_txt').attr('disabled', true);
                        $('#memo_txt').attr('readonly', true);

                        $('.memo-edit-tools').show();
                        $('.memo-update-tools').hide();
                       //$('#momo_edit_btn').text("");
                       //$('#momo_edit_btn').text(note);
                       // $('#memo_txt').text(note);
                       //document.getElementById('memo_input_div').style.display = "none";
                       //document.getElementById('momo_edit_btn').style.display = "block";
                    }
                }
            });
        });

        $("#clear_memo").on( "click", function( event ) {
            var note = '';
            $.ajax({
                type: "POST",
                url: base_url + "/customer/update_customer_profile",
                data: { notes : note , id : <?= isset($customer_profile_id) ? $customer_profile_id : 0; ?> }, // serializes the form's elements.
                success: function(data)
                {
                    if(data === "Success"){
                        $('#memo_txt').attr('disabled', false);
                        $('#memo_txt').attr('readonly', false);

                        $('#memo_txt').val(note);

                        $('#memo_txt').attr('disabled', true);
                        $('#memo_txt').attr('readonly', true);
                    }
                }
            });
        });

        $('#edit_memo').on('click', function(e){
            memo_note = $('#memo_txt').val();
            $('.memo-edit-tools').hide();
            $('.memo-update-tools').show();

            $('#memo_txt').attr('disabled', false);
            $('#memo_txt').attr('readonly', false);
        });

        $("#momo_edit_btn").on( "click", function( event ) {
            document.getElementById('memo_input_div').style.display = "block";
            document.getElementById('momo_edit_btn').style.display = "none";
        });

        $("#memo_cancel").on( "click", function( event ) {
            $('#memo_txt').val(memo_note);

            $('.memo-edit-tools').show();
            $('.memo-update-tools').hide();

            $('#memo_txt').attr('disabled', true);
            $('#memo_txt').attr('readonly', true);
            //document.getElementById('memo_input_div').style.display = "none";
            //document.getElementById('momo_edit_btn').style.display = "block";
        });

        $("#add_ls").on( "click", function( event ) {
            $('#leadSourceForm')[0].reset();
            $('#lead_source_header').text('Add Lead Source');
            $('#modal_lead_source').modal('show');
        });

        $("#add_task").on( "click", function( event ) {
            alert(4);
            $('#task_form')[0].reset();
            //$('#lead_source_header').text('Add Lead Source');
            $('#modal_task').modal('show');
        });

        $("#add_furnishers").on( "click", function( event ) {
            $('#form_creditor_furnisher')[0].reset();
            //$('#lead_source_header').text('Add Lead Source');
            $('#modal_furnishers').modal('show');
        });

        $("#add_reasons").on( "click", function( event ) {
            $('#form_reasons')[0].reset();
            //$('#lead_source_header').text('Add Lead Source');
            $('#modal_reasons').modal('show');
        });

        $("#import_audit").on( "click", function( event ) {
            $('#audit_import_form')[0].reset();
            //$('#lead_source_header').text('Add Lead Source');
            $('#modal_import_credit').modal('show');
        });

        $("#form_creditor").submit(function(e) {
            //alert("asf");
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            //var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: "/customer/add_furnisher_ajax",
                data: form.serialize(), // serializes the form's elements.
                success: function(data)
                {
                    if(data === "Success"){
                        //window.location.reload();
                        sucess_add('Furnisher Added Successfully!',1);
                    }else {
                        warning('There is an error adding Creditor/Furnisher. Contact Administrator!');
                        console.log(data);
                    }
                }
            });
        });

        // reasons script
        $("#form_reasons").submit(function(e) {
            //alert("asf");
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            //var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: "/customer/add_reasons_ajax",
                data: form.serialize(), // serializes the form's elements.
                success: function(data)
                {
                    if(data === "Success"){
                        $('[id="reason_form_id"]').val("");
                        display_reasons("/customer/fetch_reasons_data");
                        sucess_add('Furnisher Added Successfully!',0);
                    }else {
                        warning('There is an error adding Reason. Contact Administrator!');
                        console.log(data);
                    }
                }
            });
        });
        var table_reasons = $('#reasons_table').DataTable({
            "lengthChange": false,
            "searching" : false,
            "paging": false,
            "ordering": false,
        });

        function display_reasons(url){
            if(url === "/customer/fetch_all_reasons_data"){
                table_reasons.clear();
            }
            $.ajax({
                type: "POST",
                url: url,
                data: {name : "reasons"}, // serializes the form's elements.
                success: function(data)
                {
                    var reasons_data = JSON.parse(data);
                    for(var x=0;x<reasons_data.length;x++){
                        var html = '<tr role="row">';
                        html += '<td class="sorting_1">'+reasons_data[x].reason+'</td>';
                        html += '<td>'+'<a href="javascript:void(0);" id="'+reasons_data[x].reason_id+'" class="delete_reason" style="text-decoration:none;display:inline-block;" title="Edit Customer">'+
                            '<img src="/assets/img/customer/actions/cross.png" width=16" alt="Delete" height="16" border="0" title="Delete Lead">'+
                            '</a> </td></tr>';
                        table_reasons.rows.add($(html)).draw();
                        //$('#leadtype_table_data').append(html);
                        $('#form_reasons')[0].reset();
                        $('#dispute_reason').append($('<option>', {
                            value: reasons_data[x].reason,
                            text: reasons_data[x].reason
                        }));
                    }
                }
            });
        }

        $("body").delegate(".delete_reason", "click", function(){
            var ID=this.id;
            // alert(ID);
            Swal.fire({
                title: 'Are you sure you want to DELETE this reason?',
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#32243d',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: "/customer/delete_reason",
                        data: {reason_id : ID}, // serializes the form's elements.
                        success: function(data)
                        {
                            console.log(data);
                            if(data === "Done"){
                                sucess_add("Reason Remove Successfully!",0);
                                display_reasons("/customer/fetch_all_reasons_data");
                            }else{
                                warning('There is an error removing this reason. Contact Administrator!');
                            }
                        }
                    });
                    // window.location.href="/customer";
                }
            });
        });

        $(".delete_reason").on( "click", function( event ) {
            var ID=this.id;
            // alert(ID);
            Swal.fire({
                title: 'Are you sure you want to DELETE this reason?',
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#32243d',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: "/customer/delete_reason",
                        data: {reason_id : ID}, // serializes the form's elements.
                        success: function(data)
                        {
                            console.log(data);
                            if(data === "Done"){
                                sucess_add("Reason Remove Successfully!",0);
                                display_reasons("/customer/fetch_all_reasons_data");
                            }else{
                                warning('There is an error removing this reason. Contact Administrator!');
                            }
                        }
                    });
                    // window.location.href="/customer";
                }
            });
        });
        // end reasons script

        $("#audit_import_form").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            //var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: "/customer/add_audit_import_ajax",
                data: form.serialize(), // serializes the form's elements.
                success: function(data)
                {
                    if(data === "Success"){
                        window.location.reload();
                    }else {
                        console.log(data);
                    }
                }
            });
        });

        $("#task_form").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            //var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: "/customer/add_task_ajax",
                data: form.serialize(), // serializes the form's elements.
                success: function(data)
                {
                    if(data === "Success"){
                        window.location.reload();
                    }else {
                        console.log(data);
                    }
                }
            });
        });


        $(".edit_leadtype").on( "click", function( event ) {
            var ID=this.id;
            $('#modal_lead_type').modal('show');
            $('[id="lead_name"]').val($(this).data('name'));
            $('[id="lead_id"]').val(ID);
        });
        // $("body").delegate("#more_custom_fields", "click", function(){
        //     // alert("Delegated Button Clicked");
        //     //moreFields();
        //     counter++;
        //     var newFields = document.getElementById('custom_form').cloneNode(true);
        //     newFields.id = '';
        //     newFields.style.display = 'inline';
        //     var newField = newFields.childNodes;
        //
        //     //console.log(newField);
        //     for (var i=0;i<newField.length;i++) {
        //         var theName = newField[i].name;
        //         if (theName){
        //             //  newField[i].name = theName+'[]';
        //         }
        //
        //     }
        //     var insertHere = document.getElementById('write_custom_form');
        //     insertHere.parentNode.insertBefore(newFields,insertHere);
        // });

        $(".more_custom").click(function () {
           // var newFields = document.getElementById('custom_form').cloneNode(true);
            markup = "<tr id=\"ss\">" +
                        "<td><input type=\"text\" class=\"form-control col-md-12\" name=\"fieldname[]\" id=\"fieldname\" /></td>" +
                        "<td><input type=\"text\" class=\"form-control col-md-12\" name=\"fieldvalue[]\" id=\"fieldvalue\" /></td> " +
                        "<td><a href=\"javascript:void(0);\" type=\"button\" class=\"delete_custom\"><span class=\"fa fa-trash-o\"></span></a></td>" +
                    "</tr>";
            tableBody = $("#custom_table");
            tableBody.append(markup);
        });

        $("#customizable_form").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            //var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: "/customer/update_custom_fields",
                data: form.serialize(), // serializes the form's elements.
                success: function(data)
                {
                    if(data === "Success"){
                        Swal.fire({
                            title: 'Success!',
                            text: "Custom Fields Upddated!",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#32243d',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ok'
                        }).then((result) => {

                        });

                    }
                    console.log(data);
                }
                //$('#modal_sales_area').modal('hide');
                //$('#salesAreaForm')[0].reset();
            });
        });

        $(".delete_custom").on('click', function(event) {
            $(this).parent().parent().remove();
        });

        $('#custom_table tr').click(function(){
            //$(this).remove();
           // return false;
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



        // window.onload = more_custom_fields();
        //
        // var counter = 0;
        // function more_custom_fields() {
        //     counter++;
        //     var newFields = document.getElementById('custom_form').cloneNode(true);
        //     newFields.id = '';
        //     newFields.style.display = 'inline';
        //     var newField = newFields.childNodes;
        //
        //     //console.log(newField);
        //     for (var i=0;i<newField.length;i++) {
        //         var theName = newField[i].name;
        //         if (theName){
        //             //  newField[i].name = theName+'[]';
        //         }
        //
        //     }
        //     var insertHere = document.getElementById('write_custom_form');
        //     insertHere.parentNode.insertBefore(newFields,insertHere);
        // }
        <?php if (isset($letter_template)): ?>

            let url = "<?= isset($letter_template) ? htmlentities($letter_template->content)  : ''?>";

            let result = {
                'client_first_name': '<?= $profile_info->first_name; ?>',
                'client_last_name':'<?= $profile_info->last_name; ?>',
                'client_address':'<?= $profile_info->mail_add.' '.$profile_info->city.' '.$profile_info->state.' '.$profile_info->country.' '.$profile_info->zip_code; ?>',
                'curr_date': new Date().toJSON().slice(0,10).replace(/-/g,'/'),
                'client_signature': '<img src="<?= $profile_info->prof_sign_img; ?>" style="width: 200px;">',
            };

            let replaceDoubleBraces = (str,result) =>{
                return str.replace(/{(.+?)}/g, (_,g1) => result[g1] || g1)
            };

            let content = replaceDoubleBraces(url,result);
        //console.log(content);
        $.ajax({
            type: "POST",
            url: "/esign/content_editor",
            data: { contents : content}, // serializes the form's elements.
            success: function(data){
                $('#summernote').summernote('code', data);
                //console.log(data);
            }
        });

        <?php  endif; ?>


    });

    $('#dataTable1').DataTable({
        columnDefs: [{
            orderable: true,
            className: 'select-checkbox',
            targets: 0,
            checkboxes: {
                selectRow: true
            }
        }],
        select: {
            'style': 'multi'
        },
        order: [[1, 'asc']],
    });

    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

    elems.forEach(function (html) {
        var switchery = new Switchery(html, {size: 'small'});
    });

    window.updateUserStatus = (id, status) => {
        $.get('<?php echo url('company/change_status') ?>/' + id, {
            status: status
        }, (data, status) => {
            if (data == 'done') {
                // code
            } else {
                alert('Unable to change Status ! Try Again');
            }
        })
    }

    function handleClick(myRadio) {
        if( $('input:checkbox.bureau_checkbox:checked').length < 1){
            warning("Please select at least one Credit Bureau");
        }else{
            if(myRadio.value === 'same'){
                document.getElementById('same_all_details').style.display = "block";
                document.getElementById('different_details').style.display = "none";
            }else{
                document.getElementById('same_all_details').style.display = "none";
                document.getElementById('different_details').style.display = "block";
            }

            document.getElementById('equifax_details').style.display = "none";
            document.getElementById('equifax_details_same').style.display = "none";
            document.getElementById('experian_details').style.display = "none";
            document.getElementById('experian_details_same').style.display = "none";
            document.getElementById('transunion_details').style.display = "none";
            document.getElementById('transunion_details_same').style.display = "none";

            $(".bureau_checkbox:checked").each(function(){
                if($(this).val() === "1"){
                    document.getElementById('equifax_details').style.display = "block";
                    document.getElementById('equifax_details_same').style.display = "inline-block";
                }else if($(this).val() === "2"){
                    document.getElementById('experian_details').style.display = "block";
                    document.getElementById('experian_details_same').style.display = "inline-block";
                }else if($(this).val() === "3"){
                    document.getElementById('transunion_details').style.display = "block";
                    document.getElementById('transunion_details_same').style.display = "inline-block";
                }
                //alert( $(this).val());
            });
        }
       // alert($('input:checkbox.bureau_checkbox:checked').length);
        //alert(myRadio.value);
    }

    $(".bureau_checkbox").change(function(){
        //var checkedValue = document.querySelector('.bureau_checkbox:checked').value;
        console.log($(this).val());
    });

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

    // form submit for customer signature upload
        $("#submit_signature").on( "click", function( e ) {
        //$("#customer_signature").submit(function(e) {
            console.log("Customer Signature");
            //e.preventDefault(); // avoid to execute the actual submit of the form.
            //var form = $(this);
            //var url = form.attr('action');
            var input = document.getElementById('prof_sign_img');
            //  console.log(formData);
            console.log(input.files);
            for (var i = 0; i < input.files.length; i++) {
                console.log(input.files[i]);
            }
            // The Javascript
            var fileInput = document.getElementById('prof_sign_img');
            var file = fileInput.files[0];
            var formDatas = new FormData();
            formDatas.append('file', file);
            formDatas.append('id', <?= $profile_info->prof_id; ?>);

            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: "/customer/customer_signature_upload",
                data: formDatas, // serializes the form's elements.
                processData: false,
                contentType: false,
                cache: false,
                success: function(data)
                {
                    console.log(data);
                    if(data === 'Error'){

                    }else{
                        $("#prof_sign_img").val('');
                        $('#customer-signature').attr('src',data);
                    }
                },
                error: function (e) {
                    //$("#result").text(e.responseText);
                    console.log("ERROR : ", e);
                    // $("#btnSubmit").prop("disabled", false);
                }
            });
        });

</script>