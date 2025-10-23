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
                                                <span class="page-title " style="font-weight: bold;font-size: 18px;"><i class='bx bxs-layer-plus'></i>&nbsp;Add New Item</span>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                                <hr>
                                <div class="nsm-card-body">
                                    <form id="inventory_form">
                                    <div class="row">
                                        <div class="col-lg-4 mb-2">
                                            <strong>Item Name</strong>
                                            <input type="text" class="form-control" maxlength="50" placeholder="Maximum 50 characters only" name="title" id="title" required/>
                                        </div>
                                        <div class="col-lg-4 mb-2">
                                            <strong>Brand</strong>
                                            <input type="text" class="form-control " name="brand" id="brand" />
                                        </div>
                                        <div class="col-lg-2 mb-2">
                                            <strong>Price/Cost</strong>
                                            <input type="number" step="any" class="form-control" min="0" step="any" name="price" id="price" required/>
                                        </div>
                                        <div class="col-lg-2 mb-2">
                                            <strong>Retail Price</strong>
                                            <input type="number" step="any" class="form-control " min="0" step="any" name="retail" id="retail" />
                                        </div>
                                        <div class="col-lg-2 mb-2">
                                            <strong>Unit of measurement</strong>
                                            <input type="text" class="form-control" name="units" id="units" />
                                        </div>
                                        <div class="col-lg-2 mb-2">
                                            <strong>Cost per unit</strong>
                                            <input type="number" step="any" class="form-control " name="cost_per" id="units" />
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
                                                <option value="Product">Product</option>
                                                <option value="Service">Service</option>
                                                <option value="Non Inventory">Non Inventory</option>
                                                <option value="QSP">QSP</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-3 mb-2">
                                            <strong>Product URL</strong>
                                            <input type="text" class="form-control " name="url" id="url" />
                                        </div>
                                        <div class="col-lg-2 mb-2">
                                            <strong>Costs of Goods</strong>
                                            <input type="number" step="any" class="form-control " name="COGS" id="COGS" />
                                        </div>
                                        <div class="col-lg-4 mb-2">
                                            <strong>Model Number</strong>
                                            <input type="text" class="form-control " name="model" id="model" />
                                        </div>
                                        <div class="col-lg-4 mb-2">
                                            <strong>Serial Number</strong>
                                            <input type="text" class="form-control " name="serial_number" id="serial_number" />
                                        </div>
                                        <div class="col-lg-2 mb-2">
                                            <strong>Points</strong>
                                            <input type="number" step="any" class="form-control " name="points" id="points" />
                                        </div>
                                        <div class="col-lg-4 mb-2">
                                            <strong>Quantity Order</strong>
                                            <input type="number" step="any" class="form-control " name="qty_order" id="qty_order" />
                                        </div>
                                        <div class="col-lg-4 mb-2">
                                            <strong>Reorder Point</strong>
                                            <input type="number" step="any" class="form-control " name="re_order_points" id="re_order_points" /> 
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
                                            <textarea rows="3" id="descriptionItem" name="description" class="form-control"  required></textarea>
                                        </div>
                                        <!-- <div class="col-lg-12 mb-2">
                                            <img src="" id="img_profile">
                                            </div> -->
                                        <div class="col-lg-12 mb-2">
                                            <strong>Attach Image</strong>
                                            <input type="file" onchange="readURL(this);" name="attached_image" class="form-control" id="attached_image">
                                        </div>
                                        <div class="col-lg-9 mb-2">
                                            <strong>Location</strong>
                                            <select id="locations" name="loc_id[]" class="form-select" placeholder="Select" multiple="multiple" required>
                                                <option value='0' onselect="alert('test');">All Locations</option>
                                                    <?php
                                                    foreach ($location as $locations) {
                                                        if ($locations->default == "true") {
                                                            echo "<option value='$locations->loc_id' selected>$locations->location_name</option>";
                                                        } else {
                                                            echo "<option value='$locations->loc_id'>$locations->location_name</option>";
                                                        }
                                                    }
                                                    ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-3 mb-2">
                                            <strong>Initial Quantity</strong>
                                            <input type="number" class="form-control " name="initial_quantity" step="any" min="0" id="initial_quantity" required />
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
                                                <button class="nsm-button" id="CANCEL_BUTTON_INVENTORY" type="button">Cancel</button>
                                                <button type="submit" class="nsm-button primary" id="btn-submit">Save</button>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
    $('#locations').on('select2:select', function (e) {
      if (e.params.data.id === '0') {
        $(this).val(null).trigger('change');
        $(this).val(e.params.data.id).change();
      }
    });    

    $(document).ready(function() {
        $("#locations").select2({
            placeholder: "Choose Location..."
        });

        $('#CANCEL_BUTTON_INVENTORY').on('click', function(){
            location.href = base_url + 'inventory'
        });
    });
    $(function(){
        $('#location_id').select2({
            ajax: {
                url: base_url + 'inventory/selectLocation',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    console.log(params);
                  return {
                    q: params.term, // search term
                    page: params.page
                  };
                },
                processResults: function (data, params) {
                  params.page = params.page || 1;
                  return {
                    results: data,
                  };
                },
                cache: true
              },
              minimumInputLength: 0,
              templateResult: formatRepoLocation,
              templateSelection: formatRepoLocationSelection
        });
    })
    
    function formatRepoLocationSelection(repo) {

            if( repo.loc_id != null ){
                return repo.location_name;      
            }else{
                return repo.text;
            }
          
        }
        function formatRepoLocation(repo) {
          if (repo.loading) {
            return repo.text;
          }

          var $container = $(
            '<div>'+repo.location_name + '</div>'
          );

          return $container;
        }
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
    e.preventDefault();

    var form = $(this);    

    $.ajax({
        type: "POST",
        url: base_url + "inventory/save_new_item",
        data: form.serialize(), 
        dataType:'json',
        success: function(response) {
            if( response.is_success == 1 ){
                Swal.fire({
                    title: 'Add New Item',
                    text: "Item was added successfully!",
                    icon: 'success',
                    showCancelButton: false,
                    confirmButtonText: 'Okay'
                }).then((result) => {
                    //if (result.value) {
                    location.href = base_url + 'inventory';                        
                    //}
                });
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response.msg,
                });  
            }
        },
        beforeSend: function(){
            $("#btn-submit").html('<span class="bx bx-loader bx-spin"></span>');
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