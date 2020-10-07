<script>
    $(document).ready(function () {
        var table_lt = $('#leadtype').DataTable({
            "lengthChange": false,
            "searching" : false,
            "pageLength": 5
        });
        var table_sa =$('#salesarea').DataTable({
            "lengthChange": false,
            "searching" : false,
            "pageLength": 5
        });

        var table_ls =$('#leadsource').DataTable({
            "lengthChange": false,
            "searching" : false,
            "pageLength": 5
        });

        display_leadtype_data();
        display_salesarea_data();

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
                    console.log(lead_types_data.length);
                    console.log(lead_types_data);
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


        $("#leadTypeForm").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            //var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: "/customer/add_leadtype_ajax",
                data: form.serialize(), // serializes the form's elements.
                success: function(data)
                {
                    if(data === "Updated"){
                        alert("Updated Succesfully");
                    }else{
                        document.getElementById('alert_box').style.display = "block";
                        setTimeout(function () {
                            document.getElementById('alert_box').style.display = 'none'
                        }, 5000);
                        display_leadtype_data();
                    }
                    $('#modal_lead_type').modal('hide');
                    $('[id="lead_name"]').val("");
                    $('[id="lead_id"]').val("");
                }
            });
        });

        $("#salesAreaForm").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            //var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: "/customer/add_salesarea_ajax",
                data: form.serialize(), // serializes the form's elements.
                success: function(data)
                {
                    console.log(data);
                    if(data === "Updated"){
                        document.getElementById('alert_box').style.display = "block";
                        setTimeout(function () {
                            document.getElementById('alert_box').style.display = 'none'
                        }, 5000);
                        display_salesarea_data();
                    }else{
                        $('#alert_box').removeClass('invisible');
                        if(data === "Sales Area Added!"){
                            document.getElementById('alert_box').style.display = "block";
                            setTimeout(function () {
                                document.getElementById('alert_box').style.display = 'none'
                            }, 5000);
                            display_salesarea_data();
                        }
                        // $('.toast').toast('show');
                    }
                    $('#modal_sales_area').modal('hide');
                    $('#salesAreaForm')[0].reset();
                    //$('[id="lead_name"]').val("");
                    //$('[id="lead_id"]').val("");
                }
            });
        });

        $(".edit_leadtype").on( "click", function( event ) {
            var ID=this.id;
            $('#modal_lead_type').modal('show');
            $('[id="lead_name"]').val($(this).data('name'));
            $('[id="lead_id"]').val(ID);
        });

        // script for customizable module
        $("body").delegate("#more_custom_fields", "click", function(){
           // alert("Delegated Button Clicked");
            //moreFields();
            counter++;
            var newFields = document.getElementById('custom_form').cloneNode(true);
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
            var insertHere = document.getElementById('write_custom_form');
            insertHere.parentNode.insertBefore(newFields,insertHere);
        });
        window.onload = more_custom_fields();

        var counter = 0;
        function more_custom_fields() {
            counter++;
            var newFields = document.getElementById('custom_form').cloneNode(true);
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
            var insertHere = document.getElementById('write_custom_form');
            insertHere.parentNode.insertBefore(newFields,insertHere);
        }

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

</script>