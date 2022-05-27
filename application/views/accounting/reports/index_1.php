<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style type="text/css">
    .report-group-items li {
        margin-bottom: 15px;
    }

    .report-group-items li a {
        color: #259e57;
        text-decoration: none;
        outline: none;
        font-size: 16px
    }

    .report-group {
        font-size: 20px;
        font-weight: normal;
        margin-bottom: 25px;
        color: #2c3659;
    }

    .report-group span {
        margin-right: 10px;
    }

    .report-group-items {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    ul li .cursor-pointer a {
        font-size: 12px;
    }
</style>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/accounting/accounting'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <?php include viewPath('includes/notifications'); ?>
        <div class="container-fluid">
            <div class="page-title-box">

            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body hid-desk" style="padding-bottom:0px;">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3 class="page-title" style="margin: 0 !important">Reports</h3>
                                </div>
                                <div class="col-sm-12">
                                    <div class="alert alert-warning mt-4 mb-4" role="alert">
                                        <span style="color:black;">CRM reporting helps businesses in a few key ways: It can helps you distill what is happening in your business, a key advantage of deploying a CRM. Your data will help provides different ways to make strategic business decisions. Your management team can track performance and make tactical changes where necessary.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row pb-3">
                                <div class="col-md-12 banking-tab-container">
                                    <a href="<?php echo url('/accounting/reports')?>" class="banking-tab-active text-decoration-none">Standard</a>
                                    <a href="<?php echo url('/accounting/custom-reports')?>" class="banking-tab">Custom Reports</a>
                                    <a href="<?php echo url('/accounting/management-reports')?>" class="banking-tab">Management Reports</a>
                                    <a href="<?php echo url('/accounting/activities-reports')?>" class="banking-tab">Activities Reports</a>
                                    <a href="<?php echo url('/accounting/analytics')?>" class="banking-tab">Analytics</a>
                                    <a href="<?php echo url('/accounting/payscale')?>" class="banking-tab">PayScale</a>
                                </div>
                            </div>
                        </div>

                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">
                                <div id="favorites">
                                    <div class="card p-0">
                                        <div class="card-header p-4">
                                            <a class="card-link collapsed h5 text-dark" data-toggle="collapse" href="#favoritesCollapse" aria-expanded="false">
                                                <span class="fa fa-chevron-right rotate-icon"></span>
                                                <span class="pl-3">Favorites</span>
                                            </a>
                                        </div>
                                        <div id="favoritesCollapse" class="collapse" data-parent="#favorites">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <ul class="list-unstyled">
                                                        <li class="border-bottom p-3 cursor-pointer">
                                                            <a href="<?php echo url('accounting/aging_summary_report')?>"
                                                                class=" font-weight-normal">Accounts receivable
                                                                aging summary</a>
                                                            <a href="#"
                                                                class="pl-1 text-secondary h6 position-relative top-1"><i
                                                                    class="fa fa-question-circle-o "></i></a>

                                                            <div class="dropdown pull-right d-inline-block">
                                                                <span type="button" data-toggle="dropdown"
                                                                    aria-expanded="false">
                                                                    <i class="fa fa-ellipsis-v fa-lg"></i>
                                                                </span>
                                                                <ul class="dropdown-menu dropdown-menu-right"
                                                                    x-placement="bottom-end">
                                                                    <li><a href="#"
                                                                            class="dropdown-item">Customize</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <a href="#" onclick="addToFavorites(this)"
                                                                data-name="Accounts receivable aging summary"
                                                                data-link="#"
                                                                class="pr-4 text-secondary h6 pull-right"><i
                                                                    class="fa fa-star-o fa-lg"></i></a>
                                                        </li>
                                                        <li class="border-bottom p-3 cursor-pointer">
                                                            <a href="<?php echo url('accounting/balance_sheet')?>"
                                                                class=" font-weight-normal">Balance Sheet</a>
                                                            <a href="#"
                                                                class="pl-1 text-secondary h6 position-relative top-1"><i
                                                                    class="fa fa-question-circle-o "></i></a>

                                                            <div class="dropdown pull-right d-inline-block">
                                                                <span type="button" data-toggle="dropdown"
                                                                    aria-expanded="false">
                                                                    <i class="fa fa-ellipsis-v fa-lg"></i>
                                                                </span>
                                                                <ul class="dropdown-menu dropdown-menu-right"
                                                                    x-placement="bottom-end">
                                                                    <li><a href="#"
                                                                            class="dropdown-item">Customize</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <a href="#" onclick="addToFavorites(this)"
                                                                data-name="Balance Sheet" data-link="#"
                                                                class="pr-4 text-secondary h6 pull-right"><i
                                                                    class="fa fa-star-o fa-lg"></i></a>
                                                        </li>
                                                        <li class="border-bottom p-3 cursor-pointer">
                                                            <a href="<?php echo url('accounting/profit_and_loss')?>"
                                                                class=" font-weight-normal">Profit and Loss</a>
                                                            <a href="#"
                                                                class="pl-1 text-secondary h6 position-relative top-1"><i
                                                                    class="fa fa-question-circle-o "></i></a>

                                                            <div class="dropdown pull-right d-inline-block">
                                                                <span type="button" data-toggle="dropdown"
                                                                    aria-expanded="false">
                                                                    <i class="fa fa-ellipsis-v fa-lg"></i>
                                                                </span>
                                                                <ul class="dropdown-menu dropdown-menu-right"
                                                                    x-placement="bottom-end">
                                                                    <li><a href="#"
                                                                            class="dropdown-item">Customize</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <a href="#" onclick="addToFavorites(this)"
                                                                data-name="Profit and Loss" data-link="#"
                                                                class="pr-4 text-secondary h6 pull-right"><i
                                                                    class="fa fa-star-o fa-lg"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-md-5">
                                                </div>
                                                <div class="col-md-2">
                                                    <img class="growth-icon-hover" src="<?php echo $url->assets; ?>/img/reportIcons/favorites.PNG" style="position: absolute;right: 0px;bottom: 0px;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
</div>


<!-- page wrapper end -->
<?php include viewPath('includes/footer_accounting'); ?>