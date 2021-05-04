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
                            <h3 class="page-title mt-0">Add New Item</h3>
                            <div class="pl-3 pr-3 mt-1 row">
                                <div class="col mb-4 left alert alert-warning mt-0 mb-2">
                                  <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">
                                      No description yet.
                                  </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <form method="post">
                    <div class="row ">
                        <div class="col-md-6">
                            <div class="row form_line">
                                <div class="col-md-4">
                                    Item Name
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control " name="item_name" id="item_name" required/>
                                </div>
                            </div>
                            <div class="row form_line">
                                <div class="col-md-4">
                                    Brand
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control " name="brand" id="brand" />
                                </div>
                            </div>
                            <div class="row form_line">
                                <div class="col-md-4">
                                    Cost
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control " name="cost" id="cost" required/>
                                </div>
                            </div>
                            <div class="row form_line">
                                <div class="col-md-4">
                                    Retail Price
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control " name="retailField" id="retailField" />
                                </div>
                            </div>
                            <div class="row form_line">
                                <div class="col-md-4">
                                    Cost Per
                                </div>
                                <div class="col-md-8">
                                    <select class="form-control" name="cost_per" id="cost_per" required>
                                        <option value="each" selected>Each</option>
                                        <option>Weight</option>
                                        <option>Length</option>
                                        <option>Area</option>
                                        <option>Volume</option>
                                        <option>Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row form_line">
                                <div class="col-md-4">
                                    Unit
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control " name="unit" id="unit" />
                                </div>
                            </div>
                            <div class="row form_line">
                                <div class="col-md-4">
                                    Vendor
                                </div>
                                <div class="col-md-8">
                                    <select class="form-control" name="vendor" id="exampleFormControlSelect1" required>
                                        <option value="0">Select</option>
                                        <option value="1">Vendor A</option>
                                        <option value="2">Vendor B</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row form_line">
                                <div class="col-md-4">
                                    Item Type
                                </div>
                                <div class="col-md-8">
                                    <select class="form-control" name="type" id="type" required>
                                        <option value="Product">Product</option>
                                        <option value="Service">Service</option>
                                        <option value="QSP">QSP</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row form_line">
                                <div class="col-md-4">
                                    Product URL
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control " name="product_url" id="product_url" />
                                </div>
                            </div>
                            <div class="row form_line">
                                <div class="col-md-4">
                                    Costs of Goods
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control " name="cost_of_goods" id="cost_of_goods" />
                                </div>
                            </div>
                            <div class="row form_line">
                                <div class="col-md-4">
                                    Model Number
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control " name="model_number" id="model_number" />
                                </div>
                            </div>
                            <div class="row form_line">
                                <div class="col-md-4">
                                    Serial Number
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control " name="serial_number" id="serial_number" />
                                </div>
                            </div>
                            <div class="row form_line">
                                <div class="col-md-4">
                                    Points
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control " name="points" id="points" />
                                </div>
                            </div>
                            <div class="row form_line">
                                <div class="col-md-4">
                                    Quantity Order
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control " name="qty_order" id="qty_order" />
                                </div>
                            </div>
                            <div class="row form_line">
                                <div class="col-md-4">
                                    Reorder Point
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control " name="re_order_points" id="re_order_points" />
                                </div>
                            </div>


                        </div>
                        <div class="col-md-6">
                            <div class="row form_line">
                                <div class="col-md-4">
                                    Item Group
                                </div>
                                <div class="col-md-8">
                                    <select class="form-control" name="item_category" id="exampleFormControlSelect1">
                                        <?php foreach($items_categories as $cat) : ?>
                                            <option value="<?php echo $cat->item_categories_id; ?>"><?php echo $cat->name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row form_line">
                                <div class="col-md-4">
                                    Description
                                </div>
                                <div class="col-md-8">
                                    <textarea rows="3" style="width: 100% !important; "  id="descriptionItem" name="description" class="form-controls"  required></textarea>
                                </div>
                            </div>
                            <div class="row form_line">
                                <div class="col-md-4">
                                    Attach Image
                                </div>
                                <div class="col-md-8">
                                    <input type="file" onchange="readURL(this);" name="attach_photo" id="attach_photo">
                                </div>
                            </div>
                            <br><br>
                            <div class="float-right d-md-block" style="position: relative;text-align:right;right: 0;">
                                <button type="button" class="btn btn-default"><span class="fa fa-remove"></span> Cancel</button>
                                <button type="submit" class="btn btn-primary"><span class="fa fa-paper-plane-o"></span> Save</button>
                            </div>
                        </div>
                    </div>
                </form>
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
