<?php
defined('BASEPATH') or exit('No direct script access allowed');
add_css(array(
    'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css',
    'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css',
    'https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css',
    'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css',
    //'assets/frontend/css/workorder/main.css',
    // 'assets/css/beforeafter.css',
));
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
                                                <span class="page-title " style="font-weight: bold;font-size: 18px;"><i class='bx bxs-layer-plus'></i>&nbsp;Edit Inventory Location</span>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                                <hr>
                                <div class="nsm-card-body">
                                    <form id="inventory_form">
                                    <div class="row">
                                        <div class="col-lg-12 mb-2">
                                            <strong>Item Name</strong>
                                            <input type="text" class="form-control" maxlength="25" value="<?php echo $location->name?>" placeholder="Maximum 25 characters only" name="name" id="title" required/>
                                            <input type="text" value="<?php echo $location->id?>" name="id" hidden/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 mb-2">
                                            <strong>Quantity</strong>
                                            <input type="number" class="form-control " name="qty" id="qty" value="<?php echo $location->qty?>" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 mb-2">
                                            <strong>Item</strong>
                                            <select id="customer_id" name="item_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select"  required>
                                                <option value="111">Test</option>
                                            </select>
                                            </div>
                                    </div>
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
    $(function(){
        $('#customer_id').select2({
            ajax: {
                url: base_url + 'inventory/selectItems',
                dataType: 'json',
                delay: 250,
                data: function (params) {
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
              placeholder: 'Select Item',
              minimumInputLength: 0,
              templateSelection: formatRepoCustomerSelection
        });
    })
    function formatRepoCustomerSelection(repo) {
            if( repo.id != null ){
                return repo.title;      
            }else{
                return repo.text;
            }
          
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
        url: "<?= base_url() ?>inventory/editItemLocation",
        data: form.serialize(), // serializes the form's elements.
        // success: function(data) {
        //     console.log(data);
        // }
    });
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: 'Item was updated successfully!',
    }).then((result) => {
        // if (result.isConfirmed) {
            window.location.href = "<?= base_url()?>inventory/location";
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