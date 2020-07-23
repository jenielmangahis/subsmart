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
                    <div class="col-sm-6">
                        <h1 class="page-title">Active Campaign</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">

                            </li>
                        </ol>
                    </div>
                    <div class="col-sm-8">
                        <h5>Coming Soon!</h5>
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

