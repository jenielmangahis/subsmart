<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/inventory/inventory_settings_modals'); ?>
<div class="row page-content g-0">
<div class="col-12 mb-3">
    <?php include viewPath('v2/includes/page_navigations/inventory_tabs'); ?>
</div>
<div class="col-12 mb-3">
    <?php include viewPath('v2/includes/page_navigations/inventory_subtabs'); ?>
</div>
<div class="col-12">
    <div class="nsm-callout primary">
        <button><i class='bx bx-x'></i></button>
        Locations are places, like warehouses, sites, or work vehicles, where inventory is stored. Product items represent products in your inventory stored at a particular location, such as bolts stored in a warehouse. Each product item is associated with a product and a location in nSmarTrac.
    </div>
</div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="nsm-card primary GET_INVENTORY_FORM_UI">
                                <div class="nsm-card-header">
                                    <div class="nsm-card-title">
                                        <span class="d-block">
                                            <div class="right-text">
                                                <span class="page-title " style="font-weight: bold;font-size: 18px;"><i class='bx bxs-layer-plus'></i>&nbsp;Add New Location</span>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                                <hr>
                                <div class="nsm-card-body">
                                    <form id="inventory_form">
                                    <div class="row">
                                        <div class="col-lg-12 mb-2">
                                            <strong>Location</strong>
                                            <input type="text" class="form-control" maxlength="25" placeholder="Maximum 25 characters only" name="name" id="title" required>
                                        </div>
                                        <div class="col-lg-12 mb-2">
                                            <input class="form-check-input" type="checkbox" value="" id="DEFAULT_LOCATION">
                                            <label class="form-check-label" for="DEFAULT_LOCATION">
                                             Set to Default Location
                                            </label>
                                            <input type="hidden" name="DEFAULT_LOCATION" value="false" readonly>
                                        </div>
                                    </div>
                                    <!-- <div class="row">
                                        <div class="col-lg-12 mb-2">
                                            <strong>Quantity</strong>
                                            <input type="number" class="form-control " name="qty" id="qty" />
                                        </div>
                                    </div> -->
                                    <!-- <div class="row">
                                        <div class="col-lg-12 mb-2">
                                            <strong>Item</strong>
                                            <select id="customer_id" name="item_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select"  required>
                                                <option value="2" selected>Test</option>    
                                        </select>
                                            </div>
                                    </div> -->
                                        <div class="col-lg-12 mt-2">
                                            <div class="float-end">
                                                <button class="nsm-button" id="btn-cancel" type="button">Cancel</button>
                                                <button type="submit" class="nsm-button primary"><i class='bx bx-save'></i>&nbsp;Save</button>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
    $("#DEFAULT_LOCATION").on('change', function(event) {
        event.preventDefault();
        if ($(this).prop("checked") == true) {
            $("input[name='DEFAULT_LOCATION']").val("true");
        } else {
            $("input[name='DEFAULT_LOCATION']").val("false");
        }
    });
    
    $("#inventory_formOld").submit(function(e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.
        var form = $(this);
        // console.log(form.serialize());
        var url = form.attr('action');
        $.ajax({
            type: "POST",
            url: "<?= base_url() ?>inventory/addNewLocation",
            data: form.serialize(), // serializes the form's elements.
            // success: function(data) {
            //     console.log(data);
            // }
        });
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Storage location was added successfully!',
        }).then((result) => {
            // if (result.isConfirmed) {
                window.location.href = "<?= base_url()?>inventory/location";
            // }
        });
    });

    $('#inventory_form').on('submit', function(e){            
        let _this = $(this);
        e.preventDefault();

        var url = base_url + "inventory/addNewLocation";
        _this.find("button[type=submit]").html("Saving");
        _this.find("button[type=submit]").prop("disabled", true);

        $.ajax({
            type: 'POST',
            url: url,
            data: _this.serialize(),
            dataType:'json',
            success: function(result) {
                if (result.is_success === 1) {
                    _this.trigger("reset");
                    
                    Swal.fire({
                        title: 'Save Successful!',
                        text: "Storage location was added successfully!",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        window.location.href = "<?= base_url()?>inventory/location";
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        html: result.msg
                    });
                }
                
                _this.find("button[type=submit]").html("Save");
                _this.find("button[type=submit]").prop("disabled", false);
            },
        });
    });     

    $(document).ready(function() {
        $('#btn-cancel').on('click', function(){
            location.href = base_url + 'inventory/location';
        });
        $(document).on("click", ".btn-edit-field", function() {
            let _this = $(this);
            let id = _this.attr("data-id");
            let name = _this.attr("data-name");
            let _modal = $("#custom-field-modal");

            _modal.find(".modal-title").html("Update " + name);
            _modal.find('form').attr('action', `${base_url}inventory/update-custom-field/${id}`);
            _modal.find('#custom-field-name').val(name);
            _modal.modal("show");
        });
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>