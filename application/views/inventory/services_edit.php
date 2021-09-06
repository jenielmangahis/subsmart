<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
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
                                    <h3 class="page-title mt-0">Edit Service</h3>
                                    <div class="pl-3 pr-3 mt-1 row">
                                        <div class="col mb-4 left alert alert-warning mt-0 mb-2">
                                          <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">
                                              Edit service.
                                          </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" style="padding: 0px;">
                        <div class="row">
                            <div class="col-md-12">
                                <form id="service_form">
                                    <div class="row ">
                                        <div class="col-md-6">
                                            <div class="row form_line">
                                                <div class="col-md-4">
                                                    <label for="title">Service Name</label>                                            
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control " name="title" id="title" required/>
                                                </div>
                                            </div>
                                            <div class="row form_line">
                                                <div class="col-md-4">
                                                    <label for="description">Description</label>                                            
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control " name="description" id="description"/>
                                                </div>
                                            </div>
                                            <div class="row form_line">
                                                <div class="col-md-4">
                                                    <label for="price">Price</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="number" step="any" class="form-control" name="price" id="price" required/>
                                                </div>
                                            </div>
                                            <div class="row form_line">
                                                <div class="col-md-4">
                                                    <label for="frequency">Frequency</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <select class="form-control" name="frequency" id="frequency">
                                                        <option value="One Time" selected>One Time</option>
                                                        <option value="Daily">Daily</option>
                                                        <option value="Monthly">Monthly</option>
                                                        <option value="Yearly">Yearly</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row form_line">
                                                <div class="col-md-4">
                                                    <label for="estimated_time">Time Estimate</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control timepicker col-md-5" name="estimated_time" id="estimated_time" />
                                                </div>
                                            </div>
                                            <br><br>
                                            <div class="d-md-block">
                                                <input type="hidden" name="type" value="service"/>                                        
                                                <button type="submit" class="btn btn-flat btn-primary">Save</button>
                                                <a class="btn btn-primary" href="<?php echo base_url('inventory/services'); ?>">Cancel</a>
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
        </section>
        </div>
    </div>
</div>
<!-- end container-fluid -->
<?php include viewPath('includes/footer'); ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<?php //include viewPath('customer/js/add_advance_js'); ?>
<script>
    $(document).ready(function() {
        $('.timepicker').timepicker({
            timeFormat: 'h:mm p',
            interval: 60,
            minTime: '10',
            maxTime: '6:00pm',
            defaultTime: '11',
            startTime: '10:00',
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });
        $("#service_form").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            //var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: "<?= base_url() ?>/inventory/save_new_item",
                data: form.serialize(), // serializes the form's elements.
                success: function(data) {
                    console.log(data);
                    window.location.href="<?= base_url()?>/inventory/services";
                    //sucess_add_job(data);
                }, beforeSend: function() {
                    document.getElementById('overlay').style.display = "flex";
                }
            });
        });
    });
</script>
