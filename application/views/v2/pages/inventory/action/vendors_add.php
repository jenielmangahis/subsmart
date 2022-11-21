<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/inventory/inventory_settings_modals'); ?>

<div class="row page-content g-0">
<div class="col-12 mb-3">
    <?php include viewPath('v2/includes/page_navigations/inventory_tabs'); ?>
</div>
<div class="col-12">
    <div class="nsm-callout primary">
        <button><i class='bx bx-x'></i></button>
        Create New Vendor.
    </div>
</div>
<form id="vendor_form">
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
                                                <span class="page-title " style="font-weight: bold;font-size: 18px;"><i class='bx bx-fw bx-store-alt'></i>&nbsp;Add New Vendor</span>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                                <hr>
                                <div class="nsm-card-body">
                                    <div class="row">
                                        <div class="col-lg-4 mb-2">
                                            <strong>Name</strong>
                                            <input type="text" class="form-control" value="" name="vendor_name" id="vendor-name" required/>
                                        </div>
                                        <div class="col-lg-8 mb-2">
                                            <strong>Website</strong>
                                            <input type="text" class="form-control" value="" name="vendor_website" id="vendor-website" required/>
                                        </div>
                                        <div class="col-lg-6 mb-2">
                                            <strong>Email</strong>
                                            <input type="email" class="form-control" value="" name="vendor_email" id="vendor-email" required/>
                                        </div>
                                        
                                        <div class="col-lg-3 mb-2">
                                            <strong>Mobile</strong>
                                            <input type="text" class="form-control" value="" name="vendor_mobile" id="vendor-mobile" required/>
                                        </div>
                                        <div class="col-lg-3 mb-2">
                                            <strong>Phone</strong>
                                            <input type="text" class="form-control" value="" name="vendor_phone" id="vendor-phone" required/>
                                        </div>
                                        <div class="col-lg-5 mb-2">
                                            <strong>City</strong>
                                            <input type="text" class="form-control" value="" name="vendor_city" id="vendor-city" required/>
                                        </div>
                                        <div class="col-lg-5 mb-2">
                                            <strong>State</strong>
                                            <input type="text" class="form-control" value="" name="vendor_state" id="vendor-state" required/>
                                        </div>
                                        <div class="col-lg-2 mb-2">
                                            <strong>Postal Code</strong>
                                            <input type="text" class="form-control" value="" name="vendor_postal_code" id="vendor-postal-code" required/>
                                        </div>
                                        <div class="col-lg-6 mb-2">
                                            <strong>Suite / Unit</strong>
                                            <textarea name="vendor_suite_unit" id="vendor-suite-unit" class="form-control"></textarea>
                                        </div>
                                        <div class="col-lg-6 mb-2">
                                            <strong>Address</strong>
                                            <textarea name="vendor_address" id="vendor-address" class="form-control"></textarea>
                                        </div>
                                        <div class="col-lg-12 mt-2">
                                            <div class="float-end">
                                            	<input type="hidden" name="type" value="fees"/>    
                                                <button class="nsm-button" type="button" onclick="window.location.replace('/inventory/vendors')">Cancel</button>
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
$("#vendor_form").submit(function(e) {
    e.preventDefault(); // avoid to execute the actual submit of the form.
    var form = $(this);
    // console.log(form);
    //var url = form.attr('action');
    $.ajax({
        type: "POST",
        url: "<?= base_url() ?>/inventory/_create_vendor",
        data: form.serialize(), // serializes the form's elements.
        success: function(data) {
            // console.log(data);
        }
    });
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: 'Vendor was added successfully!',
    }).then((result) => {
        window.location.href = "/inventory/vendors";
    });
});
</script>
<?php include viewPath('v2/includes/footer'); ?>