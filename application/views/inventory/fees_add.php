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
                                    <h3 class="page-title mt-0">Add New Fee</h3>
                                    <div class="pl-3 pr-3 mt-1 row">
                                        <div class="col mb-4 left alert alert-warning mt-0 mb-2">
                                          <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">
                                              Create new inventory fee.
                                          </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" style="padding: 0px;">
                        <div class="row">
                            <div class="col-md-12">
                                <form id="fees_form">
                                    <div class="form-group">
                                        <label>Name</label> <span class="form-required">*</span>
                                        <input type="text" class="form-control" value="" name="title" id="title" required/>
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label> <span class="form-required">*</span>
                                        <input type="text" class="form-control" value="" name="description" id="description"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Price</label> <span class="form-required">*</span>
                                        <input type="number" step="any" class="form-control" value="" name="price" id="price" required/>
                                    </div>
                                    <div class="form-group">
                                        <label>Frequency</label> <span class="form-required">*</span>
                                        <select class="form-control" name="frequency" id="frequency">
                                            <option value="One Time" selected>One Time</option>
                                            <option value="Daily">Daily</option>
                                            <option value="Monthly">Monthly</option>
                                            <option value="Yearly">Yearly</option>
                                        </select>
                                    </div>
                                    <div class="d-md-block">
                                        <input type="hidden" name="type" value="fees"/>                                        
                                        <button type="submit" class="btn btn-flat btn-primary">Save</button>
                                        <a class="btn btn-primary" href="<?php echo base_url('inventory/fees'); ?>">Back to list</a>
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
        $("#fees_form").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            //var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: "<?= base_url() ?>/inventory/save_new_item",
                data: form.serialize(), // serializes the form's elements.
                success: function(data) {
                    window.location.href="<?= base_url()?>/inventory/fees";
                    //sucess_add_job(data);
                }, beforeSend: function() {
                    document.getElementById('overlay').style.display = "flex";
                }
            });
        });
    });
</script>
