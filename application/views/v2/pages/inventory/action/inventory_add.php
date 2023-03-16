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
                                            <input type="text" class="form-control" maxlength="25" placeholder="Maximum 25 characters only" name="title" id="title" required/>
                                        </div>
                                        <div class="col-lg-4 mb-2">
                                            <strong>Brand</strong>
                                            <input type="text" class="form-control " name="brand" id="brand" />
                                        </div>
                                        <div class="col-lg-2 mb-2">
                                            <strong>Price</strong>
                                            <input type="number" step="any" class="form-control " name="price" id="price" required/>
                                        </div>
                                        <div class="col-lg-2 mb-2">
                                            <strong>Retail Price</strong>
                                            <input type="text" class="form-control " name="retail" id="retail" />
                                        </div>
                                        <div class="col-lg-2 mb-2">
                                            <strong>Cost Per</strong>
                                            <select class="form-control" name="cost_per" id="cost_per" required>
                                                <option value="Each" selected>Each</option>
                                                <option value="Weight">Weight</option>
                                                <option value="Length">Length</option>
                                                <option value="Area">Area</option>
                                                <option value="Volume">Volume</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-2 mb-2">
                                            <strong>Unit</strong>
                                            <input type="text" class="form-control " name="units" id="units" />
                                        </div>
                                        <div class="col-lg-3 mb-2">
                                            <strong>Vendor</strong>
                                            <select class="form-control" name="vendor_id" id="vendor_id" required>
                                                <option value="0">Select</option>
                                                <?php foreach($vendors as $vendor) : ?>
                                                <option value="<?= $vendor->id; ?>"><?= $vendor->vendor_name; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-2 mb-2">
                                            <strong>Item Type</strong>
                                            <select class="form-control" name="type" id="type" required>
                                                <option value="Product">Product</option>
                                                <option value="Service">Service</option>
                                                <option value="QSP">QSP</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-3 mb-2">
                                            <strong>Product URL</strong>
                                            <input type="text" class="form-control " name="url" id="url" />
                                        </div>
                                        <div class="col-lg-2 mb-2">
                                            <strong>Costs of Goods</strong>
                                            <input type="text" class="form-control " name="COGS" id="COGS" />
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
                                            <input type="text" class="form-control " name="points" id="points" />
                                        </div>
                                        <div class="col-lg-4 mb-2">
                                            <strong>Quantity Order</strong>
                                            <input type="text" class="form-control " name="qty_order" id="qty_order" />
                                        </div>
                                        <div class="col-lg-4 mb-2">
                                            <strong>Reorder Point</strong>
                                            <input type="text" class="form-control " name="re_order_points" id="re_order_points" /> 
                                        </div>
                                        <div class="col-lg-4 mb-2">
                                            <strong>Item Group</strong>
                                            <select class="form-control" name="item_categories_id" id="item_categories_id">
                                                <option value="">Select</option>
                                                <?php foreach($item_categories as $cat) : ?>
                                                <option value="<?= $cat->item_categories_id; ?>"><?= $cat->name; ?></option>
                                                <?php endforeach; ?>
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
                                        <div class="row">
                                            <div class="col-lg-8 mb-2">
                                                <strong>Location</strong>
                                                <select id="locations" name="loc_id" class="form-control" placeholder="Select" required>
                                                    <?php foreach($location as $locations) : ?>
                                                        <option value="<?= $locations->loc_id ?>"> <?= $locations->location_name ?></option>
                                                        <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-lg-4 mb-2">
                                                <strong>Initial Quantity</strong>
                                                <input type="number" class="form-control " name="qty" id="qty" required />
                                            </div>
                                        </div>
                                        <?php foreach($custom_fields as $field) : ?>
                                        <div class="col-12 col-lg-6 mb-2">
                                            <div class="row g-3">
                                                <div class="col-6">
                                                    <strong class="content-subtitle fw-bold d-block mb-2"><?=$field->name; ?></strong>
                                                </div>
                                                <div class="col-6 text-end">
                                                    <a href="javascript:void(0);" class="content-subtitle d-block mb-2 nsm-link btn-edit-field" data-id="<?=$field->id; ?>" data-name="<?=$field->name; ?>">Edit</a>
                                                </div>
                                            </div>
                                            <input type="text" name="custom_field[<?=$field->id?>]" class="nsm-field form-control"/>
                                        </div>
                                        <?php endforeach; ?>
                                        <div class="col-lg-12 mt-2">
                                            <div class="float-end">
                                                <button class="nsm-button CANCEL_BUTTON_INVENTORY" type="button" onclick="window.location.replace('/inventory')">Cancel</button>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
    $(document).ready(function() {
        $("#locations").select2({
            placeholder: "Choose Location..."
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
    e.preventDefault(); // avoid to execute the actual submit of the form.
    var form = $(this);
    // console.log(form.serialize());
    var url = form.attr('action');
    $.ajax({
        type: "POST",
        url: "<?= base_url() ?>inventory/save_new_item",
        data: form.serialize(), // serializes the form's elements.
        // success: function(data) {
        //     console.log(data);
        // }    
    });
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: 'Item was added successfully!',
    }).then((result) => {
        // if (result.isConfirmed) {
            window.location.href = "<?= base_url()?>/inventory";
        // }
    });
});

$(document).ready(function() {
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