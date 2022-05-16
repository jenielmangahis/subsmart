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

    var customer_status = $('#customer_status').DataTable({
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
            url: base_url + "customer/add_salesarea_ajax",
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

    $("#customerStatusForm").submit(function(e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.
        var form = $(this);
        //var url = form.attr('action');
        $.ajax({
            type: "POST",
            url: base_url + "customer/customer_settings_ajax_process",
            data: form.serialize(), // serializes the form's elements.
            success: function(data)
            {
                console.log(data);
                if(data === "Updated"){
                    sucess_add('Nice!',data,0);
                }else{
                    sucess_add('Good Job!','Successfully Added!','customerStatus');
                }
                $('#modal_customer_settings').modal('hide');
                $('#customerStatusForm')[0].reset();0
            }
        });
    });

    $("#editSalesAreaForm").submit(function(e) {
        e.preventDefault(); 
        var form = $(this);
        $.ajax({
            type: "POST",
            url: base_url + "customer/update_sales_area_ajax",
            data: form.serialize(), // serializes the form's elements.
            success: function(data)
            {
                console.log(data);
                if(data === "Updated"){
                    sucess_add('Nice!',data,0);
                }else{
                    sucess_add('Good Job!','Successfully Updated!','salesArea');
                }
                $('#modal_edit_sales_area').modal('hide');
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

    $(document).on('click', '.edit-system-package', function(){
        var spt_id = $(this).attr("data-id");
        var spt_name = $(this).attr("data-name");

        $("#spt-edit-id").val(spt_id);        
        $("#spt-edit-name").val(spt_name);

        $("#modal_edit_system_package").modal("show");
    });

    $(document).on('click', '.edit-sales-area', function(){
        var sales_area_id = $(this).attr("data-id");
        var sales_area_name = $(this).attr("data-name");

        $("#edit_sa_id").val(sales_area_id);
        $("#edit_sa_name").val(sales_area_name);

        $("#modal_edit_sales_area").modal("show");
    });

    $(document).on('click', '.edit-lead-source', function(){
        var ls_id = $(this).attr("data-id");
        var ls_name = $(this).attr("data-name");

        $("#edit_ls_id").val(ls_id);
        $("#edit_ls_name").val(ls_name);

        $("#modal_edit_lead_source").modal("show");
    });

    $(document).on('click', '.edit-lead-type', function(){
        var lt_id = $(this).attr("data-id");
        var lt_name = $(this).attr("data-name");

        $("#edit_lead_id").val(lt_id);
        $("#edit_lead_name").val(lt_name);

        $("#modal_edit_lead_type").modal("show");
    });

    $(document).on('click', '.edit-activation-fee', function(){
        var af_id = $(this).attr("data-id");
        var af_amount = $(this).attr("data-amount");

        $("#edit_activation_fee_id").val(af_id);
        $("#edit_activation_fee_amount").val(af_amount);

        $("#modal_edit_activation_fee").modal("show");
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
                    url: base_url + "customer/delete_sales_area",
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

    $("body").delegate(".deleteCustomerStatus", "click", function(){
        var ID=this.id;
        Swal.fire({
            title: 'Are you sure you want to DELETE this Status?',
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
                    url: base_url + "customer/customer_settings_delete",
                    data: { id:ID }, // serializes the form's elements.
                    success: function(data){
                        console.log(data);
                        if(data === '1'){
                            sucess_add('Nice!','Successfully Removed!','customerStatus');
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

    $("#editLeadSourceForm").submit(function(e) {
        e.preventDefault();
        var form = $(this);        
        $.ajax({
            type: "POST",
            url: base_url + "customer/update_leadsource_ajax",
            data: form.serialize(),
            success: function(data)
            {
                console.log(data);
                if(data === "Updated"){

                }else{
                    sucess_add('Good Job!','Successfully Updated!','leadSource');
                }
                $('#modal_lead_source').modal('hide');
                $('#editLeadSourceForm')[0].reset();
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

    $("#editLeadTypeForm").submit(function(e) {
        e.preventDefault(); 
        var form = $(this);        
        $.ajax({
            type: "POST",
            url: base_url + "customer/update_lead_type_ajax",
            data: form.serialize(),
            success: function(data)
            {
                if(data === "Updated"){

                }else{
                    sucess_add('Good Job!','Successfully Updated!','leadTypes');
                }
                $('#editLeadTypeForm').modal('hide');
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
            url: base_url + "customer/add_activation_fee_ajax",
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

    $("#editActivationFeeForm").submit(function(e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.
        var form = $(this);
        //var url = form.attr('action');
        $.ajax({
            type: "POST",
            url: base_url + "customer/update_activation_fee_ajax",
            data: form.serialize(), // serializes the form's elements.
            success: function(data)
            {
                if(data === "Updated"){

                }else{
                    sucess_add('Good Job!','Successfully Updated!','activationFee');
                }
                $('#modal_edit_activation_fee').modal('hide');
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

    $("#editSptForm").submit(function(e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.
        var form = $(this);
        $.ajax({
            type: "POST",
            url: base_url + "customer/update_spt_ajax",
            data: form.serialize(), // serializes the form's elements.
            success: function(data)
            {
                if(data === "Updated"){

                }else{
                    sucess_add('Good Job!','Successfully Updated!','spt');
                }
                $('#modal_edit_system_package').modal('hide');
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