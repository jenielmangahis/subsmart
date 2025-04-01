<?php include viewPath('v2/includes/header'); ?>
<div class="row page-content g-0">
<div class="col-12 mb-3">
    <?php include viewPath('v2/includes/page_navigations/inventory_tabs'); ?>
</div>
<div class="col-12">
    <div class="nsm-callout primary">
        <button><i class='bx bx-x'></i></button>
        Create New Inventory Fee.
    </div>
</div>
<form id="fees_form">
    <div class="row">
        <div class="col-lg-12">
            <div class="nsm-card primary">                
                <div class="nsm-card-body">
                    <div class="row">
                        <div class="mb-2 col-md-6">
                            <strong>Name</strong>
                            <input type="text" class="form-control " name="title" id="title" required/>
                        </div>
                        <div class="mb-2 col-md-2">
                            <strong>Price</strong>
                            <input type="number" step="any" class="form-control" name="price" id="price" value="0.00" required/>
                        </div>
                        <div class="mb-2 col-md-2">
                            <strong>Frequency</strong>
                            <select class="form-control" name="frequency" id="frequency" required>
                                <option value="One Time" selected>One Time</option>
                                <option value="Daily">Daily</option>
                                <option value="Monthly">Monthly</option>
                                <option value="Yearly">Yearly</option>
                            </select>
                        </div>
                        <div class="col-lg-12 mb-2">
                            <strong>Description</strong>
                            <textarea class="form-control " name="description" id="description"></textarea>
                        </div>
                        <div class="col-lg-12 mt-2">
                            <div class="float-end">
                                <input type="hidden" name="type" value="fees"/>    
                                <button class="nsm-button" type="button" id="btn-cancel">Cancel</button>
                                <button type="submit" class="nsm-button primary" id="btn-save-inventory-fee">Save</button>
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
        location.href = base_url + 'inventory/fees';
    });
    $("#fees_form").submit(function(e) {
        e.preventDefault(); 

        var form = $(this);
        $.ajax({
            type: "POST",
            url: base_url + "inventory/_create_inventory_fee",
            data: form.serialize(), 
            dataType:'json',
            success: function(data) {
                $("#btn-save-inventory-fee").html('Save');
                if (data.is_success) {
                    Swal.fire({
                        title: 'Add Inventory Fee',
                        text: "Inventory fees has been added successfully!",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        //if (result.value) {
                            location.href = base_url + "inventory/fees";
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
            },
            beforeSend: function(){
                $("#btn-save-inventory-fee").html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });
});
</script>
<?php include viewPath('v2/includes/footer'); ?>