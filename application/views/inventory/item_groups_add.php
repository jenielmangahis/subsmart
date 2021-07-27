<?php
defined('BASEPATH') or exit('No direct script access allowed');
add_css(array(
    'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css',
    'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css',
));
?>
<?php include viewPath('includes/header'); ?>
<?php include viewPath('inventory/css/add_css'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/inventory'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid p-40">
            <div class="card">
                <div class="row pl-0 pr-0">
                    <div class="col-md-12 pl-0 pr-0">
                        <div class="col-md-12 pr-3" style="padding-left: 15px;">
                            <h3 class="page-title mt-0">Add New Item Group</h3>
                            <div class="pl-3 pr-3 mt-1 row">
                                <div class="col mb-4 left alert alert-warning mt-0 mb-2">
                                  <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">
                                      No Description yet.
                                  </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <form id="item_group_form">
                            <div class="row ">
                                <div class="col-md-6">
                                    <div class="row form_line">
                                        <div class="col-md-4">
                                            Group Name
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="groupName" id="groupName" required/>
                                        </div>
                                    </div>
                                    <div class="row form_line">
                                        <div class="col-md-4">
                                            Description
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="descriptionItemCat" id="descriptionItemCat" />
                                        </div>
                                    </div>
                                    <br><br>
                                    <div class="float-right d-md-block" style="position: relative;text-align:right;right: 0;">
                                        <a href="<?= base_url('inventory/item_groups') ?>" class="btn btn-default"><span class="fa fa-remove"></span> Cancel</a>
                                        <button type="submit" class="btn btn-primary"><span class="fa fa-paper-plane-o"></span> Save</button>
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
<!-- end container-fluid -->
<?php
// JS to add only Customer module
add_footer_js(array(
    'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js',
    'https://code.jquery.com/ui/1.12.1/jquery-ui.js',
));
?>
<?php include viewPath('includes/footer'); ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js" integrity="sha512-2xXe2z/uA+2SyT/sTSt9Uq4jDKsT0lV4evd3eoE/oxKih8DSAsOF6LUb+ncafMJPAimWAXdu9W+yMXGrCVOzQA==" crossorigin="anonymous"></script>
<?php include viewPath('customer/js/add_advance_js'); ?>
<script>
    $(document).ready(function() {
        $("#item_group_form").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
                //var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: "<?= base_url() ?>/inventory/saveItemsCategories",
                data: form.serialize(), // serializes the form's elements.
                success: function(data) {
                    document.getElementById('overlay').style.display = "none";
                    console.log(data);
                    window.location.href="<?= base_url()?>/inventory/item_groups";
                    //sucess_add_job(data);
                }, beforeSend: function() {
                    document.getElementById('overlay').style.display = "flex";
                }
            });
        });
    });
</script>
