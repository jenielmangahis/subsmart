<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/inventory/inventory_settings_modals'); ?>

<div class="row page-content g-0">
<div class="col-12 mb-3">
    <?php include viewPath('v2/includes/page_navigations/inventory_tabs'); ?>
</div>
<div class="col-12">
    <div class="nsm-callout primary">
        <button><i class='bx bx-x'></i></button>
        Update a Vendor.
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
                                                <span class="page-title " style="font-weight: bold;font-size: 18px;"><i class='bx bx-fw bx-store-alt'></i>&nbsp;Edit Vendor</span>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                                <hr>
                                <div class="nsm-card-body">
                                    <div class="row">
                                    <input type="hidden" name="vid" value="<?= $vendor->vendor_id; ?>">
                                        <div class="col-6">
                                            <div class="row">
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label for="vendor-name"><b>Name</b></label>
                                                        <input type="text" class="form-control" value="<?= $vendor->vendor_name; ?>" name="vendor_name" id="vendor-name" required/>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="vendor-email"><b>Email</b></label>
                                                        <input type="email" class="form-control" value="<?= $vendor->email; ?>" name="vendor_email" id="vendor-email" required/>
                                                    </div>
                                                </div>

                                                <div class="form-group row mt-4">
                                                    <div class="col-sm-6">
                                                        <label for="vendor-mobile"><b>Mobile Number</b></label>
                                                        <input type="text" class="form-control" value="<?= $vendor->mobile; ?>" name="vendor_mobile" id="vendor-mobile" required/>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="vendor-phone"><b>Phone Number</b></label>
                                                        <input type="text" class="form-control" value="<?= $vendor->phone; ?>" name="vendor_phone" id="vendor-phone" required/>
                                                    </div>
                                                </div>
                                                <div class="form-group row mt-4">
                                                    <div class="col-sm-6">
                                                        <label for="vendor-website"><b>Website</b></label>
                                                        <input type="text" class="form-control" value="<?= $vendor->business_URL; ?>" name="vendor_website" id="vendor-website" />
                                                    </div>
                                                </div>
                                            </div>                                            
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group row">
                                                <div class="col-sm-5">
                                                    <label for="vendor-city"><b>City</b></label>
                                                    <input type="text" class="form-control" value="<?= $vendor->city; ?>" name="vendor_city" id="vendor-city" required/>
                                                </div>
                                                <div class="col-sm-5">
                                                    <label for="vendor-state"><b>State</b></label>
                                                    <input type="text" class="form-control" value="<?= $vendor->state; ?>" name="vendor_state" id="vendor-state" required/>
                                                </div>
                                                <div class="col-sm-2">
                                                    <label for="vendor-postal-code"><b>Postal Code</b></label>
                                                    <input type="text" class="form-control" value="<?= $vendor->postal_code; ?>" name="vendor_postal_code" id="vendor-postal-code" required/>
                                                </div>
                                            </div>

                                            <div class="form-group row mt-4">
                                                <div class="col-sm-12">
                                                    <label for="vendor-suite-unit"><b>Suite / Unit</b></label>
                                                    <textarea name="vendor_suite_unit" id="vendor-suite-unit" class="form-control"><?= $vendor->suite_unit; ?></textarea>
                                                </div>
                                                <div class="col-sm-12 mt-4">
                                                    <label for="vendor-address"><b>Address</b></label>
                                                    <textarea name="vendor_address" id="vendor-address" class="form-control"><?= $vendor->street_address; ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-4">
                                            <div class="float-end">                                            	
                                                <button class="nsm-button" type="button" id="btn-cancel">Cancel</button>
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
<script>
$(function(){
    $('#btn-cancel').on('click', function(){
        location.href = base_url + 'inventory/vendors';
    });

    $("#vendor_form").submit(function(e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.
        var form = $(this);
        // console.log(form);
        //var url = form.attr('action');
        $.ajax({
            type: "POST",
            url: base_url + "/inventory/_update_vendor",
            data: form.serialize(), // serializes the form's elements.
            // success: function(data) {
            //     console.log(data);
            // }
        });
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Vendor was updated successfully!',
        }).then((result) => {
            //if (result.isConfirmed) {
                window.location.href = base_url + "/inventory/vendors";
            //}
        });
    });
});
</script>
<?php include viewPath('v2/includes/footer'); ?>