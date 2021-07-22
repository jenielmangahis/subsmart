<script>
    var table_lt = $('#leadtype').DataTable({
        "lengthChange": false,
        "searching" : false,
        "pageLength": 10
    });
    var table_sa =$('#salesarea').DataTable({
        "lengthChange": false,
        "searching" : false,
        "pageLength": 10
    });

    var table_ls =$('#leadsource').DataTable({
        "lengthChange": false,
        "searching" : false,
        "pageLength": 10
    });

    $('#rate_plan').DataTable({
        "lengthChange": false,
        "searching" : false,
        "pageLength": 10
    });

    $('#activation_fee').DataTable({
        "lengthChange": false,
        "searching" : false,
        "pageLength": 10
    });

    $('#system_package_type').DataTable({
        "lengthChange": false,
        "searching" : false,
        "pageLength": 10
    });

    $("#add_ls").on( "click", function( event ) {
        $('#leadSourceForm')[0].reset();
        $('#lead_source_header').text('Add Lead Source');
        $('#modal_lead_source').modal('show');
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
                    sucess_add('Nice!',data,0);
                }else{
                    sucess_add('Good Job!','Successfully Added!','salesArea');
                }
                $('#modal_sales_area').modal('hide');
                $('#salesAreaForm')[0].reset();
            }
        });
    });

    $(document).on('click', '.edit-rate-plan', function(){
        var rate_plan_id = $(this).attr("data-id");
        var rate_plan_amount = $(this).attr("data-amount");
        var plan_name = $(this).attr("data-name");

        $("#rate-plan-id").val(rate_plan_id);
        $("#edit-rate-plan-amount").val(rate_plan_amount);
        $("#edit-plan-name").val(plan_name);

        $("#modal_edit_rate_plan").modal("show");
    });

    $("body").delegate(".delete_sales_area", "click", function(){
        var ID=this.id;
        Swal.fire({
            title: 'Are you sure you want to DELETE this Sales Area?',
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
                    url: "/customer/delete_sales_area",
                    data: { id:ID }, // serializes the form's elements.
                    success: function(data){
                        console.log(data);
                        if(data === '1'){
                            sucess_add('Nice!','Successfully Removed!','salesArea');
                        }
                    }
                });
            }
        });

    });

    $("body").delegate(".delete_lead_source", "click", function(){
        var ID=this.id;
        Swal.fire({
            title: 'Are you sure you want to remove this lead source?',
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
                    url: "/customer/delete_lead_source",
                    data: { id:ID }, // serializes the form's elements.
                    success: function(data){
                        console.log(data);
                        if(data === '1'){
                            sucess_add('Nice!','Successfully Removed!','leadSource');
                        }
                    }
                });
            }
        });
    });

    $("#leadSourceForm").submit(function(e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.
        var form = $(this);
        //var url = form.attr('action');
        $.ajax({
            type: "POST",
            url: "/customer/add_leadsource_ajax",
            data: form.serialize(), // serializes the form's elements.
            success: function(data)
            {
                console.log(data);
                if(data === "Updated"){

                }else{
                    sucess_add('Good Job!','Successfully Added!','leadSource');
                }
                $('#modal_lead_source').modal('hide');
                $('#leadSourceForm')[0].reset();
            }
        });
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

                }else{
                    sucess_add('Good Job!','Successfully Added!','leadTypes');
                }
                $('#modal_lead_type').modal('hide');
                $('[id="lead_name"]').val("");
                $('[id="lead_id"]').val("");
            }
        });
    });

    $("#ratePlanForm").submit(function(e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.
        var form = $(this);
        //var url = form.attr('action');
        $.ajax({
            type: "POST",
            url: base_url + "customer/add_rate_plan_ajax",
            data: form.serialize(), // serializes the form's elements.
            success: function(data)
            {
                if(data === "Updated"){

                }else{
                    sucess_add('Good Job!','Successfully Added!','ratePlan');
                }
                $('#modal_lead_type').modal('hide');
                $('[id="lead_name"]').val("");
                $('[id="lead_id"]').val("");
            }
        });
    });

    $("#editRatePlanForm").submit(function(e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.
        var form = $(this);
        //var url = form.attr('action');
        $.ajax({
            type: "POST",
            url: base_url + "customer/update_rate_plan_ajax",
            data: form.serialize(), // serializes the form's elements.
            success: function(data)
            {
                if(data === "Updated"){

                }else{
                    sucess_add('Good Job!','Successfully Added!','ratePlan');
                }
                $('#modal_lead_type').modal('hide');
                $('[id="lead_name"]').val("");
                $('[id="lead_id"]').val("");
            }
        });
    });

    $("#activationFeeForm").submit(function(e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.
        var form = $(this);
        //var url = form.attr('action');
        $.ajax({
            type: "POST",
            url: "/customer/add_activation_fee_ajax",
            data: form.serialize(), // serializes the form's elements.
            success: function(data)
            {
                if(data === "Updated"){

                }else{
                    sucess_add('Good Job!','Successfully Added!','activationFee');
                }
                $('#modal_lead_type').modal('hide');
                $('[id="lead_name"]').val("");
                $('[id="lead_id"]').val("");
            }
        });
    });

    $("#sptForm").submit(function(e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.
        var form = $(this);
        $.ajax({
            type: "POST",
            url: "/customer/add_spt_ajax",
            data: form.serialize(), // serializes the form's elements.
            success: function(data)
            {
                if(data === "Updated"){

                }else{
                    sucess_add('Good Job!','Successfully Added!','spt');
                }
                $('#modal_lead_type').modal('hide');
                $('[id="lead_name"]').val("");
                $('[id="lead_id"]').val("");
            }
        });
    });

    $("body").delegate(".delete_rate_plan", "click", function(){
        var ID=this.id;
        Swal.fire({
            title: 'Are you sure you want to remove this rate plan?',
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
                    url: "/customer/delete_rate_plan",
                    data: { id:ID }, // serializes the form's elements.
                    success: function(data){
                        console.log(data);
                        if(data === '1'){
                            sucess_add('Nice!','Successfully Removed!','ratePlan');
                        }
                    }
                });
            }
        });
    });


    $("body").delegate(".delete_spt", "click", function(){
        var ID=this.id;
        Swal.fire({
            title: 'Are you sure you want to remove this package type?',
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
                    url: "/customer/delete_spt",
                    data: { id:ID }, // serializes the form's elements.
                    success: function(data){
                        console.log(data);
                        if(data === '1'){
                            sucess_add('Nice!','Successfully Removed!','spt');
                        }
                    }
                });
            }
        });
    });

    $("body").delegate(".delete_leadtype", "click", function(){
        var ID=this.id;
        Swal.fire({
            title: 'Are you sure you want to remove this lead type?',
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
                    url: "/customer/delete_lead_type",
                    data: { id:ID }, // serializes the form's elements.
                    success: function(data){
                        console.log(data);
                        if(data === '1'){
                            sucess_add('Nice!','Successfully Removed!','leadTypes');
                        }
                    }
                });
            }
        });
    });


    $("body").delegate(".delete_activation_fee", "click", function(){
        var ID=this.id;
        Swal.fire({
            title: 'Are you sure you want to DELETE this Fee?',
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
                    url: "/customer/delete_activation_fee",
                    data: { id:ID }, // serializes the form's elements.
                    success: function(data){
                        console.log(data);
                        if(data === '1'){
                            sucess_add('Nice!','Successfully Removed!','activationFee');
                        }
                    }
                });
            }
        });

    });

    function sucess_add($title,information,is_reload){
        Swal.fire({
            title: $title,
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
            }else{
                window.location.href='<?= base_url(); ?>customer/settings/'+is_reload;
            }
        });
    }
</script>