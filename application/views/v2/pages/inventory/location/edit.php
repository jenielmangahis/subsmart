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
                                                <span class="page-title " style="font-weight: bold;font-size: 18px;"><i class='bx bxs-layer-plus'></i>&nbsp;Edit Location</span>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                                <hr>
                                <div class="nsm-card-body">
                                    <form id="location_form">
                                    <div class="row">
                                        <div class="col-lg-12 mb-2">
                                            <strong>Location Name</strong>
                                            <input type="hidden" value="<?php echo $location->location_name?>" name="default_location_name" />
                                            <input type="text" class="form-control" maxlength="25" value="<?php echo $location->location_name?>" placeholder="Maximum 25 characters only" name="location_name" required/>
                                            <input type="text" value="<?php echo $location->loc_id?>" name="loc_id" hidden/>
                                        </div>
                                        <div class="col-lg-12 mb-2">
                                            <input class="form-check-input" type="checkbox" id="DEFAULT_LOCATION" <?php echo ($location->default == "true") ? "checked" : "" ; ?>>
                                            <label class="form-check-label" for="DEFAULT_LOCATION">
                                             Set to Default Location
                                            </label>
                                            <input type="hidden" name="DEFAULT_LOCATION" value="<?php echo ($location->default == "true") ? "true" : "false" ; ?>" readonly>
                                        </div>
                                    </div>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script>
    $("#DEFAULT_LOCATION").on('change', function(event) {
        event.preventDefault();
        if ($(this).prop("checked") == true) {
            $("input[name='DEFAULT_LOCATION']").val("true");
        } else {
            $("input[name='DEFAULT_LOCATION']").val("false");
        }
    });
    
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

$("#location_formOld").submit(function(e) {
    e.preventDefault(); // avoid to execute the actual submit of the form.
    var form = $(this);
    // console.log(form.serialize());
    var url = form.attr('action');
    $.ajax({
        type: "POST",
        url: "<?= base_url() ?>inventory/editLocation",
        data: form.serialize(), // serializes the form's elements.
        // success: function(data) {
        //     console.log(data);
        // }
    });
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: 'Storage location was updated successfully!',
    }).then((result) => {
        // if (result.isConfirmed) {
            window.location.href = "<?= base_url()?>inventory/location";
        // }
    });
});

$('#location_form').on('submit', function(e){            
    let _this = $(this);
    e.preventDefault();

    var url = base_url + "inventory/editLocation";
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
                    text: "Storage location was updated successfully!",
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