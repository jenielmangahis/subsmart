<?php include viewPath('v2/includes/header'); ?>
<div class="row page-content g-0">
<div class="col-12 mb-3">
    <?php include viewPath('v2/includes/page_navigations/inventory_tabs'); ?>
</div>
<div class="col-12">
    <div class="nsm-callout primary">
        <button><i class='bx bx-x'></i></button>
        Create a New Product Service.
    </div>
</div>
<form id="service_form">
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="nsm-card primary">
                                <div class="nsm-card-header">
                                    <div class="nsm-card-title">
                                        <span class="d-block">
                                            <div class="right-text">
                                                <span class="page-title " style="font-weight: bold;font-size: 18px;"><i class='bx bxs-wrench'></i>&nbsp;Add New Service</span>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                                <hr>
                                <div class="nsm-card-body">
                                    <div class="row">
                                        <div class="col-lg-3 mb-2">
                                            <strong>Service Name</strong>
                                            <input type="text" class="form-control " name="title" id="title" required/>
                                        </div>
                                        <div class="col-lg-3 mb-2">
                                            <strong>Price</strong>
                                            <input type="number" step="any" class="form-control" name="price" id="price" required/>
                                        </div>
                                        <div class="col-lg-3 mb-2">
                                            <strong>Frequency</strong>
                                            <select class="form-control" name="frequency" id="frequency" required>
                                                        <option value="One Time" selected>One Time</option>
                                                        <option value="Daily">Daily</option>
                                                        <option value="Monthly">Monthly</option>
                                                        <option value="Yearly">Yearly</option>
											</select>
                                        </div>
                                        <div class="col-lg-3 mb-2">
                                            <strong>Estimated Time / Duration</strong>
                                            <div class="input-group" style="width:43%;">            
                                                <input type="number" step="any" class="form-control" name="estimated_time" id="" required/>                                                                                    
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">HRS</div>
                                                </div>
                                            </div>                                                                                        
                                        </div>
                                        <div class="col-lg-12 mb-2">
                                            <strong>Description</strong>
                                            <textarea class="form-control " name="description" id="description"></textarea>
                                        </div>
                                        <div class="col-lg-12 mt-2">
                                            <div class="float-end">
                                            	<input type="hidden" name="type" value="service"/>
                                                <button class="nsm-button" type="button" id="btn-cancel">Cancel</button>
                                                <button type="submit" class="nsm-button primary">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
$(function(){
    $('#btn-cancel').on('click', function(){
        location.href = base_url + 'inventory/services';
    });

    $("#service_form").submit(function(e) {
        e.preventDefault(); 
        var form = $(this);
        $.ajax({
            type: "POST",
            url: base_url + "inventory/_create_service",
            data: form.serialize(), 
            dataType:'json',
            success: function(data) {
                if (data.is_success) {
                    Swal.fire({
                        title: 'Add New Service',
                        text: "Product service has been added successfully!",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        //if (result.value) {
                            location.href = base_url + "inventory/services";
                        //}
                    });
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: data.msg,
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    });
                }
            }
        });
    });

    $('#TIME_ESTIMATE').change(function(event) {
        $('#estimated_time').val(moment($('#TIME_ESTIMATE').val(), 'hh:mm').format('hh:mm A'));
    });
});
</script>
<?php include viewPath('v2/includes/footer'); ?>