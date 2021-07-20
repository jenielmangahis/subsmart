<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php include viewPath('includes/header'); ?>
<?php include viewPath('inventory/css/lists_css'); ?>
    <div class="wrapper" role="wrapper">
        <?php include viewPath('includes/sidebars/inventory'); ?>
        <!-- page wrapper start -->
        <div wrapper__section>
            <?php include viewPath('includes/notifications'); ?>
            <div class="container-fluid p-40">
                <div class="row custom__border">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body hid-desk pt-0"
                                 style="padding-bottom:0px; padding-left:0px; padding-right:0px;">
                                <div class="row margin-bottom-ter mb-2 align-items-center"
                                     style="background-color:white; padding:0px;">
                                    <div class="col-auto pl-0">
                                        <h5 class="page-title pt-0 mb-0 mt-0" style="position:relative;top:2px;">Inventory Import</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="pl-3 pr-3 mt-0 row">
                                <div class="col mb-4 left alert alert-warning mt-0 mb-2">
                                    <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Invetory description here...</span>
                                </div>
                            </div>

                            <form id="import_customer" enctype="multipart/form-data" style="text-align: center;">
                                <label for="file-upload" class="" style="font-size: 16px !important;">
                                    Choose file to Import ( .csv)
                                </label>
                                <hr>
                                <br>
                                <input id="file-upload" name="file" type="file" accept=".csv"/>
                                <input  name="file2" value="1" type="hidden"/>
                                <br><br>
                                <div class="">
                                    <a href="<?= url('customer/') ?>">
                                        <button type="button" class="btn btn-primary btn-md" id="exportCustomers"><span class="fa fa-remove"></span> Cancel</button>
                                    </a>
                                    <button type="submit" class="btn btn-primary btn-md" id="exportCustomers"><span class="fa fa-download"></span> Import</button>
                                </div>
                            </form>
                        </div>
                        <!-- end card -->
                    </div>
                </div>
            </div>

        </div>
        <!-- page wrapper end -->
    </div>
<?php include viewPath('includes/footer'); ?>