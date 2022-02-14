<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<style>
.form_line{
    padding: 5px;
}
</style>
<?php include viewPath('includes/header'); ?>
<?php //include viewPath('inventory/css/add_css'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/inventory'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>        
        <div class="container-fluid p-40">
        <section class="content">
            <div class="box">
                <div class="row custom__border">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="row pl-0 pr-0">
                            <div class="col-md-12 pl-0 pr-0">
                                <div class="col-md-12 pr-3" style="padding-left: 15px;">
                                    <h3 class="page-title mt-0">Edit Vendor</h3>
                                    <div class="pl-3 pr-3 mt-1 row">
                                        <div class="col mb-4 left alert alert-warning mt-0 mb-2">
                                          <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">
                                              Edit vendor details.
                                          </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" style="padding: 0px;">
                        <div class="row">
                            <div class="col-md-12">
                                <form id="vendor_form">
                                    <input type="hidden" name="vid" value="<?php echo $vendor->vendor_id; ?>">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Name</label> <span class="form-required">*</span>
                                                <input type="text" class="form-control" value="<?php echo $vendor->vendor_name; ?>" name="vendor_name" id="vendor-name" required/>
                                            </div>
                                            <div class="form-group">
                                                <label>Email</label> <span class="form-required">*</span>
                                                <input type="text" class="form-control" value="<?php echo $vendor->email; ?>" name="vendor_email" id="vendor-email" required/>
                                            </div>
                                            <div class="form-group">
                                                <label>Website</label> <span class="form-required">*</span>
                                                <input type="text" class="form-control" value="<?php echo $vendor->business_URL; ?>" name="vendor_website" id="vendor-website" required/>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Mobile</label> <span class="form-required">*</span>
                                                <input type="text" class="form-control" value="<?php echo $vendor->mobile; ?>" name="vendor_mobile" id="vendor-mobile" required/>
                                            </div>
                                            <div class="form-group">
                                                <label>Phone</label> <span class="form-required">*</span>
                                                <input type="text" class="form-control" value="<?php echo $vendor->phone; ?>" name="vendor_phone" id="vendor-phone" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6"> 
                                            <div class="form-group">
                                                <label>Suite / Unit</label> <span class="form-required">*</span>
                                                <textarea name="vendor_suite_unit" id="vendor-suite-unit" class="form-control"><?php echo $vendor->suite_unit; ?></textarea>
                                            </div>                                           
                                            <div class="form-group">
                                                <label>Address</label> <span class="form-required">*</span>
                                                <textarea name="vendor_address" id="vendor-address" class="form-control"><?php echo $vendor->street_address; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>City</label> <span class="form-required">*</span>
                                                <input type="text" class="form-control" value="<?php echo $vendor->city; ?>" name="vendor_city" id="vendor-city" required/>
                                            </div>
                                            <div class="form-group">
                                                <label>State</label> <span class="form-required">*</span>
                                                <input type="text" class="form-control" value="<?php echo $vendor->state; ?>" name="vendor_state" id="vendor-state" required/>
                                            </div>
                                            <div class="form-group">
                                                <label>Postal Code</label> <span class="form-required">*</span>
                                                <input type="text" class="form-control" value="<?php echo $vendor->postal_code; ?>" name="vendor_postal_code" id="vendor-postal-code" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-md-block">                                  
                                        <button type="submit" class="btn btn-flat btn-primary btn-vendor-save">Save</button>
                                        <a class="btn btn-primary" href="<?php echo base_url('inventory/vendors'); ?>">Back to list</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </section>
        </div>
    </div>
</div>
<!-- end container-fluid -->
<?php include viewPath('includes/footer'); ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<?php //include viewPath('customer/js/add_advance_js'); ?>
<script>
    $(document).ready(function() {
        $("#vendor_form").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            $(".btn-vendor-save").html('<span class="spinner-border spinner-border-sm m-0"></span> Saving');
            var form = $(this);
            setTimeout(function () {
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "<?= base_url() ?>/inventory/_update_vendor",
                    data: form.serialize(), // serializes the form's elements.
                    success: function(data) {                        
                        $(".btn-vendor-save").html('Save');
                        if( data.is_success == 1 ){
                            Swal.fire({
                              title: 'Great!',
                              text: 'Vendor was successfully updated.',
                              icon: 'success',
                              showCancelButton: false,
                              confirmButtonColor: '#32243d',
                              cancelButtonColor: '#d33',
                              confirmButtonText: 'Ok'
                            }).then((result) => {
                              location.href = base_url + "/inventory/vendors";
                            });
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                confirmButtonColor: '#32243d',
                                html: 'Cannot find data'
                              });
                        }                        
                    }, beforeSend: function() {
                        //document.getElementById('overlay').style.display = "flex";
                    }
                });
            }, 800);
        });
    });
</script>
