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
<form id="inventory_form">
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
                                                <span class="page-title " style="font-weight: bold;font-size: 18px;"><i class='bx bxs-layer-plus'></i>&nbsp;Edit Item</span>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                                <hr>
                                <div class="nsm-card-body">
                                    <div class="row">
                                        <div class="col-lg-12 mb-2 d-none">
                                            <strong>Item ID</strong>
                                            <input value="<?php echo $item->id; ?>" type="text" class="form-control" name="item_id" readonly/>
                                        </div>
                                        <div class="col-lg-4 mb-2">
                                            <strong>Item Name</strong>
                                            <input value="<?php echo $item->title; ?>" type="text" class="form-control" maxlength="25" placeholder="Maximum 25 characters only" name="title" id="title" required/>
                                        </div>
                                        <div class="col-lg-4 mb-2">
                                            <strong>Brand</strong>
                                            <input value="<?php echo $item->brand; ?>" type="text" class="form-control " name="brand" id="brand" />
                                        </div>
                                        <div class="col-lg-2 mb-2">
                                            <strong>Price/Cost</strong>
                                            <input value="<?php echo $item->price; ?>" type="number" step="any" min="0" class="form-control" name="price" id="price" required/>
                                        </div>
                                        <div class="col-lg-2 mb-2">
                                            <strong>Retail Price</strong>
                                            <input value="<?php echo $item->retail; ?>" type="number" step="any" min="0" type="text" class="form-control " name="retail" id="retail" />
                                        </div>
                                        <div class="col-lg-2 mb-2">
                                            <strong>Unit of measurement</strong>
                                            <input value="<?php echo $item->units; ?>" type="text" class="form-control " name="units" id="units" />                                            
                                        </div>
                                        <div class="col-lg-2 mb-2">
                                            <strong>Cost per unit</strong>
                                            <input value="<?php echo $item->cost_per; ?>" type="number" step="any" class="form-control " name="cost_per" id="cost_per" />
                                        </div>
                                        <div class="col-lg-3 mb-2">
                                            <strong>Vendor</strong>
                                            <select class="form-select" name="vendor_id" id="vendor_id" required>
                                                <option value="">Select</option>
                                                <?php 
                                                    foreach ($vendors as $vendor) { 
                                                        if ($item->vendor_id == $vendor->vendor_id) {
                                                            echo "<option selected value='$vendor->vendor_id'>$vendor->vendor_name</option>";
                                                        } else {
                                                            echo "<option value='$vendor->vendor_id'>$vendor->vendor_name</option>";
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-2 mb-2">
                                            <strong>Item Type</strong>
                                            <select class="form-select" name="type" id="type" required>
                                                <option <?php echo (stripos("$item->type", "Product") !== false) ? "selected" : ""; ?> value="Product">Product</option>
                                                <option <?php echo (stripos("$item->type", "Service") !== false) ? "selected" : ""; ?> value="Service">Service</option>
                                                <option <?php echo (stripos("$item->type", "QSP") !== false) ? "selected" : ""; ?> value="QSP">QSP</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-3 mb-2">
                                            <strong>Product URL</strong>
                                            <input value="<?php echo $item->url; ?>" type="text" class="form-control " name="url" id="url" />
                                        </div>
                                        <div class="col-lg-2 mb-2">
                                            <strong>Costs of Goods</strong>
                                            <input value="<?php echo $item->COGS; ?>" type="number" step="any" class="form-control " name="COGS" id="COGS" />
                                        </div>
                                        <div class="col-lg-4 mb-2">
                                            <strong>Model Number</strong>
                                            <input value="<?php echo $item->model; ?>" type="text" class="form-control " name="model" id="model" />
                                        </div>
                                        <div class="col-lg-4 mb-2">
                                            <strong>Serial Number</strong>
                                            <input value="<?php echo $item->serial_number; ?>" type="text" class="form-control " name="serial_number" id="serial_number" />
                                        </div>
                                        <div class="col-lg-2 mb-2">
                                            <strong>Points</strong>
                                            <input value="<?php echo $item->points; ?>" type="number" step="any" class="form-control " name="points" id="points" />
                                        </div>
                                        <div class="col-lg-4 mb-2">
                                            <strong>Quantity Order</strong>
                                            <input value="<?php echo $item->qty_order; ?>" type="number" step="any" min="0" class="form-control " name="qty_order" id="qty_order" />
                                        </div>
                                        <div class="col-lg-4 mb-2">
                                            <strong>Reorder Point</strong>
                                            <input value="<?php echo $item->re_order_points; ?>" type="number" step="any" class="form-control " name="re_order_points" id="re_order_points" /> 
                                        </div>
                                        <div class="col-lg-4 mb-2">
                                            <strong>Item Group</strong>
                                            <select class="form-select" name="item_categories_id" id="item_categories_id" required>
                                                <option value="">Select</option>
                                                <?php 
                                                    foreach ($item_categories as $cat) { 
                                                        if ($item->item_categories_id == $cat->item_categories_id) {
                                                            echo "<option selected value='$cat->item_categories_id'>$cat->name</option>";
                                                        } else {
                                                            echo "<option value='$cat->item_categories_id'>$cat->name</option>";
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-12 mb-2">
                                            <strong>Description</strong>
                                            <textarea id="descriptionItem" name="description" class="form-control"  required><?php echo $item->description; ?></textarea>
                                        </div>
                                        <!-- <div class="col-lg-12 mb-2">
                                            <img src="" id="img_profile">
                                            </div> -->
                                        <div class="col-lg-12 mb-2">
                                            <strong>Attach Image</strong>
                                            <input value="<?php echo $item->attached_image; ?>" type="file" onchange="readURL(this);" name="attached_image" class="form-control" id="attached_image">
                                        </div>
                                        <div class="col-lg-9 mb-2">
                                            <strong>Location</strong>
                                            <select id="locations" name="loc_id[]" class="form-select" placeholder="Select" multiple="multiple" required>
                                                <option value='0' onselect="alert('test');">All Locations</option>
                                                    <?php
                                                    foreach ($selectedLocation as $selectedLocations) {
                                                        echo "<option value='$selectedLocations->loc_id' selected>$selectedLocations->location_name</option>";
                                                    }
                                                    foreach ($getAllLocation as $getAllLocations) {
                                                        echo "<option value='$getAllLocations->loc_id'>$getAllLocations->location_name</option>";
                                                    }
                                                    ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-3 mb-2">
                                            <strong>Initial Quantity</strong>
                                            <input type="number" class="form-control" value="<?php echo getItemQtyOH($item->id); ?>" name="initial_quantity" step="any" min="0" id="initial_quantity" required />
                                        </div>
                                        <?php foreach($custom_fields as $field) : ?>
                                            <div style="position: relative;" class="col-lg-6 mt-2">
                                                <strong class="content-subtitle fw-bold d-block mb-2"><?=$field->name; ?></strong>
                                                <a style="position: absolute; top: 1px; right: 15px;" href="javascript:void(0);" class="content-subtitle d-block mb-2 nsm-link btn-edit-field" data-id="<?=$field->id; ?>" data-name="<?=$field->name; ?>">Edit</a>
                                                <input type="text" name="custom_field[<?=$field->id?>]" class="nsm-field form-control" />
                                            </div>
                                        <?php endforeach; ?>
                                        <div class="col-lg-12 mt-2">
                                            <div class="float-end">
                                                <input type="hidden" name="id" value="<?php echo $item->id; ?>">
                                                <button class="nsm-button" id="CANCEL_BUTTON_INVENTORY" type="button">Cancel</button>
                                                <button type="submit" class="nsm-button primary"><i class='bx bx-save'></i>&nbsp;Save</button>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>

$(document).ready(function() {
        $("#locations").select2({
            placeholder: "Choose Location..."
        });

        $('#CANCEL_BUTTON_INVENTORY').on('click', function(){
            location.href = base_url + 'inventory'
        });
});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $("#img_profile").attr("src", e.target.result).width(300).height(300);
        };
        reader.readAsDataURL(input.files[0]);
    }
}
$("#inventory_form").submit(function(e) {
    e.preventDefault(); // avoid to execute the actual submit of the form.
    var form = $(this);
    // console.log(form.serialize());
    var url = form.attr('action');
    $.ajax({
        type: "POST",
        url: "<?= base_url() ?>/inventory/update_item",
        data: form.serialize(), // serializes the form's elements.
        success: function(data) {
            // console.log(data);
        }
    });
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: 'Item was updated successfully!',
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "<?= base_url()?>/inventory";
        }
    });
});

$(document).ready(function() {
    $(document).on("click", ".btn-edit-field", function() {
        let _this = $(this);
        let id = _this.attr("data-id");
        let name = _this.attr("data-name");
        let _modal = $("#edit-custom-field-modal");

        _modal.find(".modal-title").html("Update " + name);
        _modal.find('form').attr('action', `${base_url}inventory/update-custom-field/${id}`);
        _modal.find('#custom-field-name').val(name);
        _modal.find('#edit-custom-field-name').val(name);
        _modal.find('#default-custom-field_name').val(name);
        _modal.find('#cfid').val(id);
        _modal.modal("show");
    });

    $('#form-update-custom-field').on('submit', function(e){            
        let _this = $(this);
        e.preventDefault();

        var url = base_url + "inventory/_update_custom_field";
        _this.find("button[type=submit]").html("Saving");
        _this.find("button[type=submit]").prop("disabled", true);

        $.ajax({
            type: 'POST',
            url: url,
            data: _this.serialize(),
            dataType:'json',
            success: function(result) {
                if (result.is_success === 1) {
                    $("#edit-custom-field-modal").modal('hide');
                    _this.trigger("reset");
                    
                    Swal.fire({
                        title: 'Save Successful!',
                        text: "Custom field has been upated successfully.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        //if (result.value) {
                            location.reload();
                        //}
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
});
</script>
<?php include viewPath('v2/includes/footer'); ?>