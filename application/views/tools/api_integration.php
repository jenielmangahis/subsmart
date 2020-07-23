<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/api_connectors'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <h1 class="page-title">Api Integration</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">

                            </li>
                        </ol>
                    </div>

                    <div class="col-sm-12">
                        <hr>
                        <div class="col-md-6">
                            <div class="md-form">
                                <label for="name" class="">Api Key </label>
                                <input type="text" id="name" name="name" class="form-control">
                            </div>
                            <div class="md-form">
                                <label for="name" class="">Api Secret Key </label>
                                <input type="text" id="name" name="name" class="form-control">
                            </div>

                            <div class="md-form">
                                <label for="name" class="">Redirect Url </label>
                                <input type="text" id="name" name="name" class="form-control">
                            </div>
                        </div>
                    </div>
                    <!-- end container-fluid -->
                </div>
                <!-- page wrapper end -->
            </div>
            <?php include viewPath('includes/footer'); ?>

            <script>
                $('.dataTableCampaign').DataTable({
                    'searching' : false,
                    "lengthChange": false
                });
            </script>

