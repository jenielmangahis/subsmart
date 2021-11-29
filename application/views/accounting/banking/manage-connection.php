<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style>
    tr.hide-table-padding td {
        padding: 0;
    }
    svg#svg-sprite-menu-close {
        position: relative;
        bottom: 178px !important;
    }
    .nav-close {
        margin-top: 52% !important;
    }
    .bank-img-container img{
        width:auto !important;
    }
    .btn {
        border-radius: 0 !important;
    }
    .card{
        box-shadow: 0 0 13px 0 rgb(116 116 117 / 44%) !important;
    }
    label>input {
        visibility: visible !important;
        position: inherit !important;
    }
</style>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper" style="">
    <?php include viewPath('includes/sidebars/accounting/accounting'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">

                <div class="card">
                    <!-- <h3 style="font-family: Sarabun, sans-serif">&nbsp;Bank and Credit Cards</h3> -->
                    <div class="col-sm-12">
                        <h3 class="page-title left" style="font-family: Sarabun, sans-serif !important;font-size: 1.75rem !important;font-weight: 600 !important;">Manage Connections</h3>
                    </div>
                    <div style="background-color:#fdeac3; width:100%;padding:.5%;margin-bottom:28px;margin-top:13px;">
                        One place to manage your linked accounts and the data we get from them.
                    </div>
                    <div class="row" style="padding-bottom: 20px;">

                    </div>

                </div>
            </div>
            <!-- end row -->
            <div class="row"></div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->

</div>
<?php include viewPath('includes/footer_accounting'); ?>

<script>
    // Expand row table
    $(document).ready(function () {

    });
</script>
