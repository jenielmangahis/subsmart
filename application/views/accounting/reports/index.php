<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?php include viewPath('includes/header'); ?>
<style>
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
<div class="wrapper reports-page" role="wrapper">
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="row align-items-center mt-5 bg-white">
                <div class="card">
                    <div class="card-body">
                        <div class="col-sm-12">
                            <h3 class="page-title pull-left col-lg-6">Reports</h3>
                            <div class="col-lg-6 pull-right">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div
                                            class="input-group-prepend bg-white border-top border-left border-bottom border-secondary rounded">
                                            <div class="input-group-text bg-white border-0"><span
                                                    class="fa fa-search"></span></div>
                                        </div>
                                        <input type="text"
                                            class="form-control border-left-0 border-top border-right border-bottom border-secondary rounded-right"
                                            id="searcReportByName" placeholder="Find report by name">
                                    </div>
                                </div>
                            </div>
                            <div class="row alert alert-warning col-md-12 mt-4 mb-4" role="alert">
                                <span style="color:black;">
                                    CRM reporting helps businesses in a few key ways: It can helps you distill what is
                                    happening in your business, a key advantage of deploying a CRM. Your data will help
                                    provides different ways to make strategic business decisions. Your management team
                                    can track performance and make tactical changes where necessary.
                                </span>
                            </div>
                        </div>

                        <div class="row align-items-center pt-3 bg-white">
                            <div class="col-md-12">
                                <!-- Nav tabs -->
                                <div class="banking-tab-container">
                                    <div class="rb-01">
                                        <ul class="nav nav-tabs border-0">
                                            <li class="nav-item">
                                                <a class="h6 mb-0 nav-link banking-sub-tab active" data-toggle="tab"
                                                    href="#standard">Standard</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="h6 mb-0 nav-link banking-sub-tab" data-toggle="tab"
                                                    href="#custom">Custom Reports</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="h6 mb-0 nav-link banking-sub-tab" data-toggle="tab"
                                                    href="#management">Management Reports</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="h6 mb-0 nav-link banking-sub-tab" data-toggle="tab"
                                                    href="#activities">Activities Reports</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="h6 mb-0 nav-link banking-sub-tab" data-toggle="tab"
                                                    href="#analytics">Analytics</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="h6 mb-0 nav-link banking-sub-tab" data-toggle="tab"
                                                    href="#payscale">PayScale</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- Tab panes -->
                                <div class="tab-content mt-4">
                                    <div class="tab-pane active standard-accordion" id="standard">
                                        <div id="favorites">
                                            <div class="card p-0">
                                                <div class="card-header p-4">
                                                    <a class="card-link collapsed h5 text-dark" data-toggle="collapse"
                                                        href="#favoritesCollapse" aria-expanded="false"><span
                                                            class="fa fa-chevron-right rotate-icon"></span><span
                                                            class="pl-3">Favorites</span></a>
                                                </div>
                                                <div id="favoritesCollapse" class="collapse" data-parent="#favorites"
                                                    style="">
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
                                                            <img class="growth-icon-hover"
                                                                src="<?php echo $url->assets; ?>/img/reportIcons/favorites.PNG"
                                                                alt=""
                                                                style="position: absolute;right: 0px;bottom: 0px;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="businessOverview" class="menu-reports">
                                            <div class="card p-0">
                                                <div class="card-header p-4">
                                                    <a class="card-link collapsed h5 text-dark" data-toggle="collapse"
                                                        href="#businessOverviewCollapseOne" aria-expanded="false"><span
                                                            class="fa fa-chevron-right rotate-icon"></span><span
                                                            class="pl-3">Business overview</span></a>
                                                </div>
                                                <div id="businessOverviewCollapseOne" class="collapse"
                                                    data-parent="#businessOverview">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <ul class="list-unstyled">
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="<?php echo url('accounting/audit_log_report'); ?>"
                                                                        class=" font-weight-normal">Audit Log</a>
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
                                                                        data-name="Audit Log" data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="<?php echo url('accounting/balance_sheet_comparison'); ?>"
                                                                        class=" font-weight-normal">Balance Sheet
                                                                        Comparison</a>
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
                                                                        data-name="Balance Sheet Comparison"
                                                                        data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="<?php echo url('accounting/balance_sheet_detail'); ?>"
                                                                        class=" font-weight-normal">Balance Sheet
                                                                        Detail</a>
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
                                                                        data-name="Balance Sheet Detail" data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="<?php echo url('accounting/balance_sheet_summary')?>"
                                                                        class=" font-weight-normal">Balance Sheet
                                                                        Summary</a>
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
                                                                        data-name="Balance Sheet Summary" data-link="#"
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
                                                                    <a href="<?php echo url('accounting/business_snapshot')?>"
                                                                        class=" font-weight-normal">Business
                                                                        Snapshot</a>
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
                                                                        data-name="Business Snapshot" data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Profit and
                                                                        Loss as % of total income</a>
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
                                                                        data-name="Profit and Loss as % of total income"
                                                                        data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Profit and
                                                                        Loss Comparison</a>
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
                                                                        data-name="Profit and Loss Comparison"
                                                                        data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <ul>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Profit and
                                                                        Loss Detail</a>
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
                                                                        data-name="Profit and Loss Detail" data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Profit and
                                                                        Loss year-to-date comparison</a>
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
                                                                        data-name="Profit and Loss year-to-date comparison"
                                                                        data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Profit and
                                                                        Loss by Customer</a>
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
                                                                        data-name="Profit and Loss by Customer"
                                                                        data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Profit and
                                                                        Loss by Month</a>
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
                                                                        data-name="Profit and Loss by Month"
                                                                        data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Profit and
                                                                        Loss</a>
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
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Quarterly
                                                                        Profit and Loss Summary</a>
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
                                                                        data-name="Quarterly Profit and Loss Summary"
                                                                        data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Statement of
                                                                        Cash Flows</a>
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
                                                                        data-name="Statement of Cash Flows"
                                                                        data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <img class="growth-icon-hover"
                                                                src="<?php echo $url->assets; ?>/img/reportIcons/business_overview.PNG"
                                                                alt=""
                                                                style="position: absolute;right: 0px;bottom: 0px;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="whoOwesYou" class="menu-reports">
                                            <div class="card p-0">
                                                <div class="card-header p-4">
                                                    <a class="card-link collapsed h5 text-dark" data-toggle="collapse"
                                                        href="#whoOwesYouCollapseOne" aria-expanded="false"><span
                                                            class="fa fa-chevron-right rotate-icon"></span><span
                                                            class="pl-3">Who owes you</span></a>
                                                </div>
                                                <div id="whoOwesYouCollapseOne" class="collapse"
                                                    data-parent="#whoOwesYou" style="">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <ul class="list-unstyled">
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Accounts
                                                                        receivable aging detail</a>
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
                                                                        data-name="Accounts receivable aging detail"
                                                                        data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Accounts
                                                                        receivable aging summary</a>
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
                                                                    <a href="#" class=" font-weight-normal">Collections
                                                                        Report</a>
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
                                                                        data-name="Collections Report" data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Customer
                                                                        Balance Detail</a>
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
                                                                        data-name="Customer Balance Detail"
                                                                        data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Customer
                                                                        Balance Summary</a>
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
                                                                        data-name="Customer Balance Summary"
                                                                        data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Invoice
                                                                        List</a>
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
                                                                        data-name="Invoice List" data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <ul>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Invoices and
                                                                        Received Payments</a>
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
                                                                        data-name="Invoices and Received Payments"
                                                                        data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Open
                                                                        Invoices</a>
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
                                                                        data-name="Open Invoices" data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Statement
                                                                        List</a>
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
                                                                        data-name="Statement List" data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Terms
                                                                        List</a>
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
                                                                        data-name="Terms List" data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Unbilled
                                                                        charges</a>
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
                                                                        data-name="Unbilled charges" data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Unbilled
                                                                        time</a>
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
                                                                        data-name="Unbilled time" data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>

                                                        <div class="col-md-2">
                                                            <img class="growth-icon-hover"
                                                                src="<?php echo $url->assets; ?>/img/reportIcons/who_owes_you.PNG"
                                                                alt=""
                                                                style="position: absolute;right: 0px;bottom: 0px;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="salesAndCustomers" class="menu-reports">
                                            <div class="card p-0">
                                                <div class="card-header p-4">
                                                    <a class="card-link collapsed h5 text-dark" data-toggle="collapse"
                                                        href="#salesAndCustomersCollapseOne" aria-expanded="false"><span
                                                            class="fa fa-chevron-right rotate-icon"></span><span
                                                            class="pl-3">Sales and customers</span></a>
                                                </div>
                                                <div id="salesAndCustomersCollapseOne" class="collapse"
                                                    data-parent="#salesAndCustomers" style="">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <ul class="list-unstyled">
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Customer
                                                                        Contact List</a>
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
                                                                        data-name="Customer Contact List" data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Deposit
                                                                        Detail</a>
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
                                                                        data-name="Deposit Detail" data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Estimates &
                                                                        Progress Invoicing Summary by Customer</a>
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
                                                                        data-name="Estimates & Progress Invoicing Summary by Customer"
                                                                        data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Estimates by
                                                                        Customer</a>
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
                                                                        data-name="Estimates by Customer" data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Income by
                                                                        Customer Summary</a>
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
                                                                        data-name="Income by Customer Summary"
                                                                        data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Inventory
                                                                        Valuation Detail</a>
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
                                                                        data-name="Inventory Valuation Detail"
                                                                        data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Inventory
                                                                        Valuation Summary</a>
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
                                                                        data-name="Inventory Valuation Summary"
                                                                        data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Payment
                                                                        Method List</a>
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
                                                                        data-name="Payment Method List" data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Physical
                                                                        Inventory Worksheet</a>
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
                                                                        data-name="Physical Inventory Worksheet"
                                                                        data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <ul>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#"
                                                                        class=" font-weight-normal">Product/Service
                                                                        List</a>
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
                                                                        data-name="Product/Service List" data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Sales by
                                                                        Customer Detail</a>
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
                                                                        data-name="Sales by Customer Detail"
                                                                        data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Sales by
                                                                        Customer Summary</a>
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
                                                                        data-name="Sales by Customer Summary"
                                                                        data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Sales by
                                                                        Customer Type Detail</a>
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
                                                                        data-name="Sales by Customer Type Detail"
                                                                        data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Sales by
                                                                        Product/Service Detail</a>
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
                                                                        data-name="Sales by Product/Service Detail"
                                                                        data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Sales by
                                                                        Product/Service Summary</a>
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
                                                                        data-name="Sales by Product/Service Summary"
                                                                        data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Time
                                                                        Activities by Customer Detail</a>
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
                                                                        data-name="Time Activities by Customer Detail"
                                                                        data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Transaction
                                                                        List by Customer</a>
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
                                                                        data-name="Transaction List by Customer"
                                                                        data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <img class="growth-icon-hover"
                                                                src="<?php echo $url->assets; ?>/img/reportIcons/sales_and_customers.PNG"
                                                                alt=""
                                                                style="position: absolute;right: 0px;bottom: 0px;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="whatYouOwe" class="menu-reports">
                                            <div class="card p-0">
                                                <div class="card-header p-4">
                                                    <a class="card-link collapsed h5 text-dark" data-toggle="collapse"
                                                        href="#whatYouOweCollapseOne" aria-expanded="false"><span
                                                            class="fa fa-chevron-right rotate-icon"></span><span
                                                            class="pl-3">What you owe</span></a>
                                                </div>
                                                <div id="whatYouOweCollapseOne" class="collapse"
                                                    data-parent="#whatYouOwe" style="">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <ul class="list-unstyled">
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">1099
                                                                        Contractor Balance Detail</a>
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
                                                                        data-name="1099 Contractor Balance Detail"
                                                                        data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">1099
                                                                        Contractor Balance Summary</a>
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
                                                                        data-name="1099 Contractor Balance Summary"
                                                                        data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Accounts
                                                                        payable aging detail</a>
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
                                                                        data-name="Accounts payable aging detail"
                                                                        data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Accounts
                                                                        payable aging summary</a>
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
                                                                        data-name="Accounts payable aging summary"
                                                                        data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Bill Payment
                                                                        List</a>
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
                                                                        data-name="Bill Payment List" data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <ul>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Bills and
                                                                        Applied Payments</a>
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
                                                                        data-name="Bills and Applied Payments"
                                                                        data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Unpaid
                                                                        Bills</a>
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
                                                                        data-name="Unpaid Bills" data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Vendor
                                                                        Balance Detail</a>
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
                                                                        data-name="Vendor Balance Detail" data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Vendor
                                                                        Balance Summary</a>
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
                                                                        data-name="Vendor Balance Summary" data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <img class="growth-icon-hover"
                                                                src="<?php echo $url->assets; ?>/img/reportIcons/what_you_owe.PNG"
                                                                alt=""
                                                                style="position: absolute;right: 0px;bottom: 0px;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="expensesAndVendors" class="menu-reports">
                                            <div class="card p-0">
                                                <div class="card-header p-4">
                                                    <a class="card-link collapsed h5 text-dark" data-toggle="collapse"
                                                        href="#expensesAndVendorsCollapseOne"
                                                        aria-expanded="false"><span
                                                            class="fa fa-chevron-right rotate-icon"></span><span
                                                            class="pl-3">Expenses and vendors</span></a>
                                                </div>
                                                <div id="expensesAndVendorsCollapseOne" class="collapse"
                                                    data-parent="#expensesAndVendors" style="">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <ul class="list-unstyled">
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">1099
                                                                        Transaction Detail Report
                                                                    </a>
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
                                                                        data-name="1099 Transaction Detail Report"
                                                                        data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Check
                                                                        Detail</a>
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
                                                                        data-name="Check Detail" data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Expenses by
                                                                        Vendor Summary</a>
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
                                                                        data-name="Expenses by Vendor Summary"
                                                                        data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Transaction
                                                                        List by Vendor</a>
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
                                                                        data-name="Transaction List by Vendor"
                                                                        data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Vendor
                                                                        Contact List</a>
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
                                                                        data-name="Vendor Contact List" data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-5">
                                                        </div>
                                                        <div class="col-md-2">
                                                            <img class="growth-icon-hover"
                                                                src="<?php echo $url->assets; ?>/img/reportIcons/what_you_owe.PNG"
                                                                alt=""
                                                                style="position: absolute;right: 0px;bottom: 0px;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="salesTax" class="menu-reports">
                                            <div class="card p-0">
                                                <div class="card-header p-4">
                                                    <a class="card-link collapsed h5 text-dark" data-toggle="collapse"
                                                        href="#salesTaxCollapseOne" aria-expanded="false"><span
                                                            class="fa fa-chevron-right rotate-icon"></span><span
                                                            class="pl-3">Sales tax</span></a>
                                                </div>
                                                <div id="salesTaxCollapseOne" class="collapse" data-parent="#salesTax"
                                                    style="">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <ul class="list-unstyled">
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Sales Tax
                                                                        Liability Report</a>
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
                                                                        data-name="Sales Tax Liability Report"
                                                                        data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Taxable
                                                                        Sales Detail</a>
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
                                                                        data-name="Taxable Sales Detail" data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Taxable
                                                                        Sales Summary</a>
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
                                                                        data-name="Taxable Sales Summary" data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-5">
                                                        </div>
                                                        <div class="col-md-2">
                                                            <img class="growth-icon-hover"
                                                                src="<?php echo $url->assets; ?>/img/reportIcons/sales_tax.PNG"
                                                                alt=""
                                                                style="position: absolute;right: 0px;bottom: 0px;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="employees" class="menu-reports">
                                            <div class="card p-0">
                                                <div class="card-header p-4">
                                                    <a class="card-link collapsed h5 text-dark" data-toggle="collapse"
                                                        href="#employeesCollapseOne" aria-expanded="false"><span
                                                            class="fa fa-chevron-right rotate-icon"></span><span
                                                            class="pl-3">Employees</span></a>
                                                </div>
                                                <div id="employeesCollapseOne" class="collapse" data-parent="#employees"
                                                    style="">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <ul class="list-unstyled">
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#"
                                                                        class=" font-weight-normal">Recent/Edited Time
                                                                        Activities</a>
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
                                                                        data-name="Recent/Edited Time Activities"
                                                                        data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Time
                                                                        Activities by Employee Detail</a>
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
                                                                        data-name="Time Activities by Employee Detail"
                                                                        data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-5">
                                                        </div>
                                                        <div class="col-md-2">
                                                            <img class="growth-icon-hover"
                                                                src="<?php echo $url->assets; ?>/img/reportIcons/employees.PNG"
                                                                alt=""
                                                                style="position: absolute;right: 0px;bottom: 0px;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="forMyAccountant" class="menu-reports">
                                            <div class="card p-0">
                                                <div class="card-header p-4">
                                                    <a class="card-link collapsed h5 text-dark" data-toggle="collapse"
                                                        href="#forMyAccountantCollapseOne" aria-expanded="false"><span
                                                            class="fa fa-chevron-right rotate-icon"></span><span
                                                            class="pl-3">For my accountant</span></a>
                                                </div>
                                                <div id="forMyAccountantCollapseOne" class="collapse"
                                                    data-parent="#forMyAccountant" style="">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <ul class="list-unstyled">
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Account
                                                                        List</a>
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
                                                                        data-name="Account List" data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Balance
                                                                        Sheet Comparison</a>
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
                                                                        data-name="Balance Sheet Comparison"
                                                                        data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Balance
                                                                        Sheet</a>
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
                                                                    <a href="#" class=" font-weight-normal">General
                                                                        Ledger</a>
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
                                                                        data-name="General Ledger" data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Journal</a>
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
                                                                        data-name="Journal" data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Profit and
                                                                        Loss Comparison</a>
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
                                                                        data-name="Profit and Loss Comparison"
                                                                        data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Profit and
                                                                        Loss</a>
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
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Recent
                                                                        Transactions</a>
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
                                                                        data-name="Recent Transactions" data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <ul>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#"
                                                                        class=" font-weight-normal">Reconciliation
                                                                        Reports</a>
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
                                                                        data-name="Reconciliation Reports" data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Recurring
                                                                        Template List</a>
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
                                                                        data-name="Recurring Template List"
                                                                        data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Statement of
                                                                        Cash Flows</a>
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
                                                                        data-name="Statement of Cash Flows"
                                                                        data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Transaction
                                                                        Detail by Account</a>
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
                                                                        data-name="Transaction Detail by Account"
                                                                        data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Transaction
                                                                        List by Date</a>
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
                                                                        data-name="Transaction List by Date"
                                                                        data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Transaction
                                                                        List with Splits</a>
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
                                                                        data-name="Transaction List with Splits"
                                                                        data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Trial
                                                                        Balance</a>
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
                                                                        data-name="Trial Balance" data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <img class="growth-icon-hover"
                                                                src="<?php echo $url->assets; ?>/img/reportIcons/for_my_account.PNG"
                                                                alt=""
                                                                style="position: absolute;right: 0px;bottom: 0px;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="payroll" class="menu-reports">
                                            <div class="card p-0">
                                                <div class="card-header p-4">
                                                    <a class="card-link collapsed h5 text-dark" data-toggle="collapse"
                                                        href="#payrollCollapseOne" aria-expanded="false"><span
                                                            class="fa fa-chevron-right rotate-icon"></span><span
                                                            class="pl-3">Payroll</span></a>
                                                </div>
                                                <div id="payrollCollapseOne" class="collapse" data-parent="#payroll"
                                                    style="">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <ul class="list-unstyled">
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Employee
                                                                        Details</a>
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
                                                                        data-name="Employee Details" data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Employee
                                                                        Directory</a>
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
                                                                        data-name="Employee Directory" data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Multiple
                                                                        Worksites</a>
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
                                                                        data-name="Multiple Worksites" data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Paycheck
                                                                        List</a>
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
                                                                        data-name="Paycheck List" data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Payroll
                                                                        Billing Summary</a>
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
                                                                        data-name="Payroll Billing Summary"
                                                                        data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Payroll
                                                                        Deductions/Contributions</a>
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
                                                                        data-name="Payroll Deductions/Contributions"
                                                                        data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Payroll
                                                                        Details</a>
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
                                                                        data-name="Payroll Details" data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Payroll
                                                                        Summary by Employee</a>
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
                                                                        data-name="Payroll Summary by Employee"
                                                                        data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Payroll
                                                                        Summary</a>
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
                                                                        data-name="Payroll Summary" data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Payroll Tax
                                                                        Liability</a>
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
                                                                        data-name="Payroll Tax Liability" data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <ul>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Payroll Tax
                                                                        Payments</a>
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
                                                                        data-name="Payroll Tax Payments" data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Payroll Tax
                                                                        and Wage Summary</a>
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
                                                                        data-name="Payroll Tax and Wage Summary"
                                                                        data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#"
                                                                        class=" font-weight-normal">Recent/Edited Time
                                                                        Activities</a>
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
                                                                        data-name="Recent/Edited Time Activities"
                                                                        data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Retirement
                                                                        Plans</a>
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
                                                                        data-name="Retirement Plans" data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Time
                                                                        Activities by Employee Detail</a>
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
                                                                        data-name="Time Activities by Employee Detail"
                                                                        data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Total
                                                                        Pay</a>
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
                                                                        data-name="Total Pay" data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Total
                                                                        Payroll Cost</a>
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
                                                                        data-name="Total Payroll Cost" data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Vacation and
                                                                        Sick Leave</a>
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
                                                                        data-name="Vacation and Sick Leave"
                                                                        data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                                <li class="border-bottom p-3 cursor-pointer">
                                                                    <a href="#" class=" font-weight-normal">Workers'
                                                                        Compensation</a>
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
                                                                        data-name="Workers' Compensation" data-link="#"
                                                                        class="pr-4 text-secondary h6 pull-right"><i
                                                                            class="fa fa-star-o fa-lg"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <img class="growth-icon-hover"
                                                                src="<?php echo $url->assets; ?>/img/reportIcons/payroll.PNG"
                                                                alt=""
                                                                style="position: absolute;right: 0px;bottom: 0px;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="custom">
                                        <div class="px-4 pb-4">
                                            <table id="all_sales_table"
                                                class="table table-striped table-bordered w-100">
                                                <thead>
                                                    <tr>
                                                        <th>NAME</th>
                                                        <th>CREATED</th>
                                                        <th>DATE RANGE</th>
                                                        <th>EMAIL</th>
                                                        <th>ACTION</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>John Meyer</td>
                                                        <td>01-01-01</td>
                                                        <td>09-09-09</td>
                                                        <td>test@gmail.com</td>
                                                        <td><a href="">View</a></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="management">
                                        <div class="px-4 pb-4">
                                            <table id="manage_reports_table"
                                                class="table table-striped table-bordered w-100">
                                                <thead>
                                                    <tr>
                                                        <th>NAME</th>
                                                        <th>CREATED BY</th>
                                                        <th>LAST MODIFIED</th>
                                                        <th>REPORT PERIOD</th>
                                                        <th>ACTION</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    foreach ($management_reports as $report) {
                                                        ?>
                                                    <tr>
                                                        <td><?=$report->template_name?></td>
                                                        <td><?php if ($report->created_by == 0) {
                                                            echo "nSmarTrac";
                                                        } else {
                                                            $user_details = $this->users_model->getUser($report->created_by);
                                                            if($user_details != null){
                                                                $lname=$user_details->LName;
                                                                echo $user_details->FName." ".strtoupper($lname[0]).".";
                                                            }
                                                        } ?>
                                                        </td>
                                                        <td>

                                                        <?php
                                                        if ($report->updated_by > 0) {
                                                            $user_details = $this->users_model->getUser($report->updated_by);
                                                            if($user_details != null){
                                                                $lname=$user_details->LName;
                                                                echo $user_details->FName." ".strtoupper($lname[0]).".";
                                                            }
                                                                
                                                        }?>
                                                        </td>
                                                        <td>
                                                            <select class="form-control " name="filter_date">
                                                                <option <?php if($report->report_period=="All Dates"){echo "selected";}?>>All Dates</option>
                                                                <option <?php if($report->report_period=="Custom"){echo "selected";}?>>Custom</option>
                                                                <option <?php if($report->report_period=="Today"){echo "selected";}?>>Today </option>
                                                                <option <?php if($report->report_period=="This Week"){echo "selected";}?>>This Week </option>
                                                                <option <?php if($report->report_period=="This Week-to-date"){echo "selected";}?>>This Week-to-date </option>
                                                                <option <?php if($report->report_period=="This Month"){echo "selected";}?>>This Month </option>
                                                                <option <?php if($report->report_period=="This Month-to-date"){echo "selected";}?>>This Month-to-date </option>
                                                                <option <?php if($report->report_period=="This Quarter"){echo "selected";}?>>This Quarter </option>
                                                                <option <?php if($report->report_period=="This Quarter-to-date"){echo "selected";}?>>This Quarter-to-date </option>
                                                                <option <?php if($report->report_period=="This Year"){echo "selected";}?>>This Year </option>
                                                                <option <?php if($report->report_period=="This Year-to-date"){echo "selected";}?>>This Year-to-date </option>
                                                                <option <?php if($report->report_period=="This Year-to-last-month"){echo "selected";}?>>This Year-to-last-month </option>
                                                                <option <?php if($report->report_period=="Yesterday"){echo "selected";}?>>Yesterday </option>
                                                                <option <?php if($report->report_period=="Recent"){echo "selected";}?>>Recent </option>
                                                                <option <?php if($report->report_period=="Last Week"){echo "selected";}?>>Last Week </option>
                                                                <option <?php if($report->report_period=="Last Week-to-date"){echo "selected";}?>>Last Week-to-date </option>
                                                                <option <?php if($report->report_period=="Last Month"){echo "selected";}?>>Last Month </option>
                                                                <option <?php if($report->report_period=="Last Month-to-date"){echo "selected";}?>>Last Month-to-date </option>
                                                                <option <?php if($report->report_period=="Last Quarter"){echo "selected";}?>>Last Quarter </option>
                                                                <option <?php if($report->report_period=="Last Quarter-to-date"){echo "selected";}?>>Last Quarter-to-date </option>
                                                                <option <?php if($report->report_period=="Last Year"){echo "selected";}?>>Last Year </option>
                                                                <option <?php if($report->report_period=="Last Year-to-date"){echo "selected";}?>>Last Year-to-date </option>
                                                                <option <?php if($report->report_period=="Since 30 Days Ago"){echo "selected";}?>>Since 30 Days Ago </option>
                                                                <option <?php if($report->report_period=="Since 60 Days Ago"){echo "selected";}?>>Since 60 Days Ago </option>
                                                                <option <?php if($report->report_period=="Since 90 Days Ago"){echo "selected";}?>>Since 90 Days Ago </option>
                                                                <option <?php if($report->report_period=="Since 365 Days Ago"){echo "selected";}?>>Since 365 Days Ago </option>
                                                                <option <?php if($report->report_period=="Next Week"){echo "selected";}?>>Next Week </option>
                                                                <option <?php if($report->report_period=="Next 4 Weeks"){echo "selected";}?>>Next 4 Weeks </option>
                                                                <option <?php if($report->report_period=="Next Month"){echo "selected";}?>>Next Month </option>
                                                                <option <?php if($report->report_period=="Next Quarter"){echo "selected";}?>>Next Quarter </option>
                                                                <option <?php if($report->report_period=="Next Year"){echo "selected";}?>>Next Year </option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <div class="dropdown dropdown-btn">
                                                                <a href="#" class="view-management_report" data-id="<?=$report->id?>">View</a>
                                                                <a type="button" id="dropdown-button-icon"
                                                                    data-toggle="dropdown" aria-expanded="true">
                                                                    <span class="btn-label"><i
                                                                            class="fa fa-chevron-down"></i></span>
                                                                </a>
                                                                <ul class="dropdown-menu dropdown-menu-right report_options"
                                                                    role="menu" aria-labelledby="dropdown-edit"
                                                                    x-placement="bottom-end">
                                                                    <li class="edit" data-id="<?=$report->id?>"
                                                                        data-target="#management_reports_modal">
                                                                        <a href="javascript:void(0)">
                                                                            Edit
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="javascript:void(0)" class="send-email" data-target="#management_reports_email_modal"  data-id="<?=$report->id?>" data-report="<?=$report->template_name?>" data-company="<?=$company_details->business_name?>">
                                                                            Send
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="javascript:void(0)" class="export-pdf" data-id="<?=$report->id?>" data-report="<?=$report->template_name?>" data-company="<?=$company_details->business_name?>">
                                                                            Export as PDF
                                                                        </a>
                                                                    </li>
                                                                    <li style="display: none;">
                                                                        <a href="javascript:void(0)"
                                                                            class="export-docx" data-id="<?=$report->id?>">
                                                                            Export as DOCX
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="javascript:void(0)"
                                                                            class="time-activity-btn"
                                                                            data-toggle="modal" data-target="#">
                                                                            Copy
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="payscale">
                                        <div class="px-4 pb-4">
                                            <div class="">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <!-- <div class="card"> -->
                                                        <!-- <div class="card-body p-0">

                                                                <div class="row pb-5 p-5">
                                                                    <div class="col-md-6">
                                                                        <p class="font-weight-bold mb-4">Comp Summary</p>
                                                                        <p class="mb-1">John Doe, Mrs Emma Downson</p>
                                                                        <p>Acme Inc</p>
                                                                        <p class="mb-1">Berlin, Germany</p>
                                                                        <p class="mb-1">6781 45P</p>
                                                                    </div>
                                                                </div>

                                                                <div class="row p-5">
                                                                    <div class="col-md-12">
                                                                        <table class="table" id="reportstable">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th class="border-0 text-uppercase small font-weight-bold">ID</th>
                                                                                    <th class="border-0 text-uppercase small font-weight-bold">Company</th>
                                                                                    <th class="border-0 text-uppercase small font-weight-bold">Employee</th>
                                                                                    <th class="border-0 text-uppercase small font-weight-bold">Salary</th>
                                                                                    <th class="border-0 text-uppercase small font-weight-bold">Classification</th>
                                                                                    <th class="border-0 text-uppercase small font-weight-bold">Action</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td>1</td>
                                                                                    <td>Company 1</td>
                                                                                    <td>John Doe</td>
                                                                                    <td>$321</td>
                                                                                    <td>Fulltime</td>
                                                                                    <td><a href="<?php //echo url('/accounting/employeeinfo')?>"
                                                        class="btn btn-info">View</a></td>
                                                        </tr>
                                                        <tr>
                                                            <td>1</td>
                                                            <td>Company 1</td>
                                                            <td>Sam Smith</td>
                                                            <td>$6356</td>
                                                            <td>Partime</td>
                                                            <td><a href="#" class="btn btn-info">View</a></td>
                                                        </tr>
                                                        <tr>
                                                            <td>1</td>
                                                            <td>Company 1</td>
                                                            <td>Delta Alpha</td>
                                                            <td>$354</td>
                                                            <td>Fulltime</td>
                                                            <td><a href="#" class="btn btn-info">View</a></td>
                                                        </tr>
                                                        </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                            </div>-->

                                            <h4>Salary</h4> <br>

                                            <div style="float:right;padding:1%;">
                                                <a href="#" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#addrole">Add role</a>
                                            </div>
                                            <table class="table">
                                                <thead style="background-color:#EEEEEE;font-weight:bold;">
                                                    <th><b>EMPLOYEE</b></th>
                                                    <th><b>ROLE</b></th>
                                                    <th><b>START DATE</b></th>
                                                    <th><b>LOCATION</b></th>
                                                    <th><b>SALARY</b></th>
                                                    <th><b>ACTION</b></th>
                                                </thead>
                                                <tbody>
                                                    <!-- <tr>
                                                                    <td>John Doe</td>
                                                                    <td>Web Developer</td>
                                                                    <td>03/06/18</td>
                                                                    <td>New York, NY, USA</td>
                                                                    <td>$30,000.00</td>
                                                                    <td><a href="<?php echo url('/accounting/employee_payscale') ?>"
                                                    class="btn btn-success">Manage</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Lheiann Vhiev</td>
                                                        <td>Accountant</td>
                                                        <td>03/20/20</td>
                                                        <td>Boston, MA, USA</td>
                                                        <td>$40,000.00</td>
                                                        <td><a href="#" class="btn btn-success">Manage</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Ronah Jay</td>
                                                        <td>Marketing</td>
                                                        <td>03/20/20</td>
                                                        <td>San Francisco, CA, USA</td>
                                                        <td>$20,000.00</td>
                                                        <td><a href="#" class="btn btn-success">Manage</a></td>
                                                    </tr> -->
                                                    <?php foreach ($employees as $employee): ?>
                                                    <tr>
                                                        <td><?php echo $employee->FName .' '. $employee->LName; ?>
                                                        </td>
                                                        <td><?php echo $employee->title; ?>
                                                        </td>
                                                        <td><?php echo $employee->date_hired; ?>
                                                        </td>
                                                        <td><?php echo $employee->address; ?>
                                                        </td>
                                                        <td>$40,000.00</td>
                                                        <td><a href="<?php echo url('/accounting/employee_payscale/'.$employee->uid) ?>"
                                                                class="btn btn-success">Manage</a></td>
                                                    </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>

                                            <!-- </div>  -->
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="addrole" tabindex="-1" role="dialog" aria-labelledby="addroleLabel"
                            aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addroleLabel">Add Role</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <span>Role name</span>
                                        <input type="texy" class="form-control role_name_text" name="role_name"
                                            placeholder="e.g Developer">
                                        <br>
                                        <span>Amount</span>
                                        <input type="texy" class="form-control role_amount" name="role_amount"
                                            placeholder="$0.00">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary save_role">Save role</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="activities">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="card border-0 py-0 px-2 shadow-none">
                                            <div class="container-fluid p-0">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h1 class="mt-0">Activities Reports</h1>
                                                        <p class="margin-bottom">
                                                            Monitor your business activity with these reports.
                                                        </p>
                                                        <div class="row margin-bottom">
                                                            <div class="col-md-4">
                                                                <h3 class="report-group"><span
                                                                        class="fa fa-server"></span> Popular Reports
                                                                </h3>
                                                                <ul class="report-group-items">
                                                                    <li><a
                                                                            href="<?php echo base_url() . 'reports/main/report/monthly-closeout' ?>"><span
                                                                                class="fa fa-angle-right fa-margin-right"></span>
                                                                            Monthly Closeout</a></li>
                                                                    <li><a
                                                                            href="<?php echo base_url() . 'reports/main/report/yearly-closeout' ?>"><span
                                                                                class="fa fa-angle-right fa-margin-right"></span>
                                                                            Yearly Closeout</a></li>
                                                                    <li><a
                                                                            href="<?php echo base_url() . 'reports/main/report/profit-loss' ?>"><span
                                                                                class="fa fa-angle-right fa-margin-right"></span>
                                                                            
                                                                            </a></li>
                                                                    <li><a
                                                                            href="<?php echo base_url() . 'reports/main/report/work-order-by-employee' ?>"><span
                                                                                class="fa fa-angle-right fa-margin-right"></span>
                                                                            Sales Leaderboard</a></li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <h3 class="report-group"><span class="fa fa-usd"
                                                                        style="font-size:18px;"></span> Sales</h3>
                                                                <ul class="report-group-items">
                                                                    <li><a
                                                                            href="<?php echo base_url() . 'reports/main/report/payment-by-method' ?>"><span
                                                                                class="fa fa-angle-right fa-margin-right"></span>
                                                                            Payments Type Summary</a></li>
                                                                    <li><a
                                                                            href="<?php echo base_url() . 'reports/main/report/payment-by-month' ?>"><span
                                                                                class="fa fa-angle-right fa-margin-right"></span>
                                                                            Payments Received</a></li>
                                                                    <li><a
                                                                            href="<?php echo base_url() . 'reports/main/report/payment-by-item' ?>"><span
                                                                                class="fa fa-angle-right fa-margin-right"></span>
                                                                            Sales By Items</a></li>
                                                                    <li><a
                                                                            href="<?php echo base_url() . 'reports/main/report/payment-by-material-item' ?>"><span
                                                                                class="fa fa-angle-right fa-margin-right"></span>
                                                                            Material Sales Report</a></li>
                                                                    <li><a
                                                                            href="<?php echo base_url() . 'reports/main/report/payment-by-product-item' ?>"><span
                                                                                class="fa fa-angle-right fa-margin-right"></span>
                                                                            Product Sales Report</a></li>
                                                                    <li><a
                                                                            href="<?php echo base_url() . 'reports/main/report/payment-repeated-by-customer' ?>"><span
                                                                                class="fa fa-angle-right fa-margin-right"></span>
                                                                            Repeated Business</a></li>
                                                                    <li><a
                                                                            href="<?php echo base_url() . 'reports/main/report/sales-demographics' ?>"><span
                                                                                class="fa fa-angle-right fa-margin-right"></span>
                                                                            Sales Demographics</a></li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <h3 class="report-group"><span class="fa fa-ticket"
                                                                        style="font-size:19px;"></span> Receivables</h3>
                                                                <ul class="report-group-items">
                                                                    <li><a
                                                                            href="<?php echo base_url() . 'reports/main/report/account-receivable' ?>"><span
                                                                                class="fa fa-angle-right fa-margin-right"></span>
                                                                            Account Receivable</a></li>
                                                                    <li><a
                                                                            href="<?php echo base_url() . 'reports/main/report/invoice-by-date' ?>"><span
                                                                                class="fa fa-angle-right fa-margin-right"></span>
                                                                            Invoice by Date</a></li>
                                                                    <li><a
                                                                            href="<?php echo base_url() . 'reports/main/report/invoice-aging-summary' ?>"><span
                                                                                class="fa fa-angle-right fa-margin-right"></span>
                                                                            Aging Summary</a></li>
                                                                    <li><a
                                                                            href="<?php echo base_url() . 'reports/main/report/account-receivable-com-vs-res' ?>"><span
                                                                                class="fa fa-angle-right fa-margin-right"></span>
                                                                            Commercial vs Residential</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="row margin-bottom">
                                                            <div class="col-md-4">
                                                                <h3 class="report-group"><span class="fa fa-ticket"
                                                                        style="font-size:19px;"></span> Expenses</h3>
                                                                <ul class="report-group-items">
                                                                    <li><a
                                                                            href="<?php echo base_url() . 'reports/main/report/expense-by-category' ?>"><span
                                                                                class="fa fa-angle-right fa-margin-right"></span>
                                                                            Expenses By Category Summary</a></li>
                                                                    <li><a
                                                                            href="<?php echo base_url() . 'reports/main/report/expense-by-month-by-category' ?>"><span
                                                                                class="fa fa-angle-right fa-margin-right"></span>
                                                                            Expenses By Category</a></li>
                                                                    <li><a
                                                                            href="<?php echo base_url() . 'reports/main/report/expense-by-month-by-customer' ?>"><span
                                                                                class="fa fa-angle-right fa-margin-right"></span>
                                                                            Expenses By Customer</a></li>
                                                                    <li><a
                                                                            href="<?php echo base_url() . 'reports/main/report/expense-by-month-by-work-order' ?>"><span
                                                                                class="fa fa-angle-right fa-margin-right"></span>
                                                                            Expenses By Work Order</a></li>
                                                                    <li><a
                                                                            href="<?php echo base_url() . 'reports/main/report/expense-by-month-by-vendor' ?>"><span
                                                                                class="fa fa-angle-right fa-margin-right"></span>
                                                                            Expenses By Vendor</a></li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <h3 class="report-group"><span class="fa fa-file-text-o"
                                                                        style="font-size:16px;"></span> Estimates</h3>
                                                                <ul class="report-group-items">
                                                                    <li><a
                                                                            href="<?php echo base_url() . 'reports/main/report/estimate-status-by-month' ?>"><span
                                                                                class="fa fa-angle-right fa-margin-right"></span>
                                                                            Estimates Summary</a></li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <h3 class="report-group"><span class="fa fa-user"
                                                                        style="font-size:16px;"></span> Customers</h3>
                                                                <ul class="report-group-items">
                                                                    <li><a
                                                                            href="<?php echo base_url() . 'reports/main/report/payment-by-customer' ?>"><span
                                                                                class="fa fa-angle-right fa-margin-right"></span>
                                                                            Sales Summary By Customer</a></li>
                                                                    <li><a
                                                                            href="<?php echo base_url() . 'reports/main/report/customer-sales' ?>"><span
                                                                                class="fa fa-angle-right fa-margin-right"></span>
                                                                            Sales By Customer</a></li>
                                                                    <li><a
                                                                            href="<?php echo base_url() . 'reports/main/report/payment-by-customer-group' ?>"><span
                                                                                class="fa fa-angle-right fa-margin-right"></span>
                                                                            Sales By Customer Groups</a></li>
                                                                    <li><a
                                                                            href="<?php echo base_url() . 'reports/main/report/customer-source' ?>"><span
                                                                                class="fa fa-angle-right fa-margin-right"></span>
                                                                            Sales By Customer Source</a></li>
                                                                    <li><a
                                                                            href="<?php echo base_url() . 'reports/main/report/customer-tax-by-month' ?>"><span
                                                                                class="fa fa-angle-right fa-margin-right"></span>
                                                                            Tax Paid by Customers</a></li>
                                                                    <li><a
                                                                            href="<?php echo base_url() . 'reports/main/report/customer-by-city-state' ?>"><span
                                                                                class="fa fa-angle-right fa-margin-right"></span>
                                                                            Customer Demographics</a></li>
                                                                    <li><a
                                                                            href="<?php echo base_url() . 'reports/main/report/customer-by-source' ?>"><span
                                                                                class="fa fa-angle-right fa-margin-right"></span>
                                                                            Customer Source</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="row margin-bottom">
                                                            <div class="col-md-4">
                                                                <h3 class="report-group"><span class="fa fa-user"
                                                                        style="font-size:16px;"></span> Employees</h3>
                                                                <ul class="report-group-items">
                                                                    <li><a
                                                                            href="<?php echo base_url() . 'reports/main/report/employee-payroll-summary' ?>"><span
                                                                                class="fa fa-angle-right fa-margin-right"></span>
                                                                            Payroll Summary</a></li>
                                                                    <li><a
                                                                            href="<?php echo base_url() . 'reports/main/report/employee-payroll-by-employee' ?>"><span
                                                                                class="fa fa-angle-right fa-margin-right"></span>
                                                                            Payroll By Employee</a></li>
                                                                    <li><a
                                                                            href="<?php echo base_url() . 'reports/main/report/employee-payroll-log' ?>"><span
                                                                                class="fa fa-angle-right fa-margin-right"></span>
                                                                            Payroll Log Details</a></li>
                                                                    <li><a
                                                                            href="<?php echo base_url() . 'reports/main/report/employee-payroll-percent-commission' ?>"><span
                                                                                class="fa fa-angle-right fa-margin-right"></span>
                                                                            Percent Sales Commission Report</a></li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <h3 class="report-group"><span class="fa fa-clock-o"
                                                                        style="font-size:16px;"></span> Timesheet</h3>
                                                                <ul class="report-group-items">
                                                                    <li><a
                                                                            href="<?php echo base_url() . 'reports/main/report/summary-by-period' ?>"><span
                                                                                class="fa fa-angle-right fa-margin-right"></span>
                                                                            Time Log Summary</a></li>
                                                                    <li><a
                                                                            href="<?php echo base_url() . 'reports/main/report/timesheet-entries' ?>"><span
                                                                                class="fa fa-angle-right fa-margin-right"></span>
                                                                            Time Log Details</a></li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <h3 class="report-group"><span class="fa fa-file-text-o"
                                                                        style="font-size:16px;"></span> Work Orders</h3>
                                                                <ul class="report-group-items">
                                                                    <li><a
                                                                            href="<?php echo base_url() . 'reports/main/report/work-order-status' ?>"><span
                                                                                class="fa fa-angle-right fa-margin-right"></span>
                                                                            Work Order Status</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="row margin-bottom">
                                                            <div class="col-md-4">
                                                                <h3 class="report-group"><span class="fa fa-percent"
                                                                        style="font-size:16px;"></span> Taxes</h3>
                                                                <ul class="report-group-items">
                                                                    <li><a
                                                                            href="<?php echo base_url() . 'reports/main/report/sales-tax' ?>"><span
                                                                                class="fa fa-angle-right fa-margin-right"></span>
                                                                            Sales Tax</a></li>
                                                                    <li><a
                                                                            href="<?php echo base_url() . 'reports/main/report/invoice-items-no-tax' ?>"><span
                                                                                class="fa fa-angle-right fa-margin-right"></span>
                                                                            Non Taxable Sales</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end card -->
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                                <!-- end row -->
                            </div>
                            <!-- end container-fluid -->
                        </div>
                        <div class="tab-pane fade" id="analytics">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="card border-0 py-0 px-2 shadow-none">
                                            <div class="container-fluid p-0">
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <script type="text/javascript"
                                                            src="https://www.gstatic.com/charts/loader.js"></script>

                                                        <h1 class="mt-0">Analytics for <?php echo getLoggedName(); ?>
                                                        </h1>
                                                        <div class="row" style="margin-bottom: 40px;">
                                                            <div class="col-sm-8 col-md-8">
                                                                Insights for your Business. See how your Business
                                                                performs daily and analyse the trends to optimise it.
                                                            </div>
                                                            <div class="col-sm-4 col-md-4 text-right">
                                                                <a class="margin-right-sec link-modal-open"
                                                                    href="<?php echo base_url() . 'report/main/preview?format=csv&type=summary_report' ?>"
                                                                    target="_blank"><span class="fa fa-download"></span>
                                                                    CSV Export</a>
                                                                <a class="link-modal-open"
                                                                    href="<?php echo base_url() . 'report/main/preview?format=pdf&type=summary_report' ?>"
                                                                    target="_blank"><span
                                                                        class="fa fa-file-pdf-o"></span> Get PDF</a>
                                                            </div>
                                                        </div>
                                                        <ul class="stats">
                                                            <li>
                                                                <a
                                                                    href="<?php echo base_url() . 'report/main/summary?type=invoices' ?>">
                                                                    <span class="stats-name">Invoices Total</span>
                                                                    <span class="stats-value">$10,575.48</span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a
                                                                    href="<?php echo base_url() . 'report/main/summary?type=estimates' ?>">
                                                                    <span class="stats-name">Estimates Total</span>
                                                                    <span class="stats-value">$10,996.24</span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="#">
                                                                    <span class="stats-name">Customers Total</span>
                                                                    <span class="stats-value">381</span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="#">
                                                                    <span class="stats-name">Active Deals</span>
                                                                    <span class="stats-value">0</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                        <div class="header-top">
                                                            <h3>Business Profile</h3>
                                                            <div class="avatar">
                                                                <!-- <img class="user-avatar" src="#"> -->
                                                                <img src="<?= getCompanyBusinessProfileImage(); ?>"
                                                                    class=""
                                                                    style="max-width: 200px; max-height: 200px;display: inline-block;" />
                                                                <div class="avatar-cnt">
                                                                    <?php echo $clients->business_name; ?>
                                                                    <br><a class="a-ter" href="#">view public
                                                                        profile</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <p class="margin-bottom">Views per day for period: Mar 31, 2020
                                                            - Apr 30, 2020</p>
                                                        <div id="chart-profile"
                                                            style="text-align: left; width: 100%; height: 300px;"></div>
                                                        <table
                                                            class="table table-hover table-to-list fix-reponsive-table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Metric</th>
                                                                    <th class="text-right" style="width: 40px;"></th>
                                                                    <th class="text-right" style="width: 10%">Feb '20
                                                                    </th>
                                                                    <th class="text-right" style="width: 10%">Mar '20
                                                                    </th>
                                                                    <th class="text-right" style="width: 10%">Apr '20
                                                                    </th>
                                                                    <th class="text-right" style="width: 10%">Total</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td data-title="Metric">
                                                                        Your business viewed<br>
                                                                        <p class="help help-sm"
                                                                            style="margin-top: 5px; margin-bottom: 5px;">
                                                                            How many times your business has been viewed
                                                                            by customers</p>
                                                                    </td>
                                                                    <td class="text-right" data-title="">
                                                                        <span class="bubble-set bubble-set-0"></span>
                                                                    </td>
                                                                    <td class="text-right" data-title="Feb '20">21</td>
                                                                    <td class="text-right" data-title="Mar '20">15</td>
                                                                    <td class="text-right" data-title="Apr '20">10</td>
                                                                    <td class="text-right" data-title="Total">81</td>
                                                                </tr>
                                                                <tr>
                                                                    <td data-title="Metric">
                                                                        Your business shown on homepage / search<br>
                                                                        <p class="help help-sm"
                                                                            style="margin-top: 5px; margin-bottom: 5px;">
                                                                            How many times your business has been shown
                                                                            to customers on home page and in search
                                                                            results</p>
                                                                    </td>
                                                                    <td class="text-right" data-title="">
                                                                        <span class="bubble-set bubble-set-1"></span>
                                                                    </td>
                                                                    <td class="text-right" data-title="Feb '20">0</td>
                                                                    <td class="text-right" data-title="Mar '20">0</td>
                                                                    <td class="text-right" data-title="Apr '20">0</td>
                                                                    <td class="text-right" data-title="Total">0</td>
                                                                </tr>
                                                                <tr>
                                                                    <td data-title="Metric">
                                                                        Customers who viewed your contact details<br>
                                                                        <p class="help help-sm"
                                                                            style="margin-top: 5px; margin-bottom: 5px;">
                                                                            How many times customers have seen your
                                                                            contact details</p>
                                                                    </td>
                                                                    <td class="text-right" data-title=""></td>
                                                                    <td class="text-right" data-title="Feb '20">20</td>
                                                                    <td class="text-right" data-title="Mar '20">15</td>
                                                                    <td class="text-right" data-title="Apr '20">10</td>
                                                                    <td class="text-right" data-title="Total">80</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <div style="margin: 40px 0;"></div>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <h3>Job Leads</h3>
                                                            </div>
                                                            <div class="col-sm-12 text-right">
                                                                <a class="a-ter" href="#">view job leads</a>
                                                            </div>
                                                        </div>
                                                        <hr>

                                                        <p class="margin-bottom">Jobs per day for time period: Mar 31,
                                                            2020 - Apr 30, 2020</p>

                                                        <div id="chart-jobs"
                                                            style="text-align: left; width: 100%; height: 300px;"></div>
                                                        <table
                                                            class="table table-hover table-to-list fix-reponsive-table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Metric</th>
                                                                    <th class="text-right" style="width: 40px;"></th>
                                                                    <th class="text-right" style="width: 10%">Feb '20
                                                                    </th>
                                                                    <th class="text-right" style="width: 10%">Mar '20
                                                                    </th>
                                                                    <th class="text-right" style="width: 10%">Apr '20
                                                                    </th>
                                                                    <th class="text-right" style="width: 10%">Total</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td data-title="Metric">
                                                                        Total jobs posted<br>
                                                                        <p class="help help-sm"
                                                                            style="margin-top: 5px; margin-bottom: 5px;">
                                                                            All jobs posted in your coverage areas, that
                                                                            are requesting business services you are
                                                                            offering</p>
                                                                    </td>
                                                                    <td class="text-right" data-title="">
                                                                        <span class="bubble-set bubble-set-0"></span>
                                                                    </td>
                                                                    <td class="text-right" data-title="Feb '20">0</td>
                                                                    <td class="text-right" data-title="Mar '20">0</td>
                                                                    <td class="text-right" data-title="Apr '20">0</td>
                                                                    <td class="text-right" data-title="Total">0</td>
                                                                </tr>
                                                                <tr>
                                                                    <td data-title="Metric">
                                                                        Your exclusive job leads<br>
                                                                        <p class="help help-sm"
                                                                            style="margin-top: 5px; margin-bottom: 5px;">
                                                                            The total number of job leads, you have been
                                                                            invited to estimate</p>
                                                                    </td>
                                                                    <td class="text-right" data-title="">
                                                                        <span class="bubble-set bubble-set-1"></span>
                                                                    </td>
                                                                    <td class="text-right" data-title="Feb '20">0</td>
                                                                    <td class="text-right" data-title="Mar '20">0</td>
                                                                    <td class="text-right" data-title="Apr '20">0</td>
                                                                    <td class="text-right" data-title="Total">0</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>

                                                        <div style="margin: 40px 0;"></div>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <h3>Deals</h3>
                                                            </div>
                                                            <div class="col-sm-12 text-right">
                                                                <a class="a-ter" href="#">view deals</a>
                                                            </div>
                                                        </div>
                                                        <hr>

                                                        <p class="margin-bottom">Views per day for period: Mar 31, 2020
                                                            - Apr 30, 2020</p>
                                                        <div id="chart-deals"
                                                            style="text-align: left; width: 100%; height: 300px;"></div>
                                                        <table
                                                            class="table table-hover table-to-list fix-reponsive-table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Metric</th>
                                                                    <th class="text-right" style="width: 40px;"></th>
                                                                    <th class="text-right" style="width: 10%">Feb '20
                                                                    </th>
                                                                    <th class="text-right" style="width: 10%">Mar '20
                                                                    </th>
                                                                    <th class="text-right" style="width: 10%">Apr '20
                                                                    </th>
                                                                    <th class="text-right" style="width: 10%">Total</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td data-title="Metric">
                                                                        Your deal viewed<br>
                                                                        <p class="help help-sm"
                                                                            style="margin-top: 5px; margin-bottom: 5px;">
                                                                            How many times your deal has been viewed by
                                                                            customers</p>
                                                                    </td>
                                                                    <td class="text-right" data-title="">
                                                                        <span class="bubble-set bubble-set-0"></span>
                                                                    </td>
                                                                    <td class="text-right" data-title="Feb '20">0</td>
                                                                    <td class="text-right" data-title="Mar '20">0</td>
                                                                    <td class="text-right" data-title="Apr '20">0</td>
                                                                    <td class="text-right" data-title="Total">0</td>
                                                                </tr>
                                                                <tr>
                                                                    <td data-title="Metric">
                                                                        Your deal shown on homepage / search<br>
                                                                        <p class="help help-sm"
                                                                            style="margin-top: 5px; margin-bottom: 5px;">
                                                                            How many times your deal has been shown to
                                                                            customers on home page and in search results
                                                                        </p>
                                                                    </td>
                                                                    <td class="text-right" data-title="">
                                                                        <span class="bubble-set bubble-set-1"></span>
                                                                    </td>
                                                                    <td class="text-right" data-title="Feb '20">0</td>
                                                                    <td class="text-right" data-title="Mar '20">0</td>
                                                                    <td class="text-right" data-title="Apr '20">0</td>
                                                                    <td class="text-right" data-title="Total">0</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end container-fluid -->
                                </div>
                                <!-- page wrapper end -->
                            </div>

                        </div>
                    </div>
                </div>

            </div>
            <!-- end row -->
            <div class="row ml-2"></div>
            <!-- end row -->
        </div>
    </div>
    <!-- end container-fluid -->
</div>
</div>
</div>
<!-- page wrapper end -->
<?php include viewPath('includes/sidebars/accounting/accounting'); ?>
</div>
<?php include viewPath('accounting/reports/management_reports/management_reports_modal'); ?>
<?php include viewPath('accounting/reports/management_reports/management_reports_viewer_modal'); ?>
<?php include viewPath('accounting/reports/management_reports/management_reports_email_modal'); ?>
<?php include viewPath('includes/footer_accounting'); ?>


<script>
    $(document).on('click touchstart', '.save_role', function() {
        // alert('test');

        var role_name = $(".role_name_text").val();
        var role_amount = $(".role_amount").val();

        $.ajax({
            type: 'POST',
            url: "<?php echo base_url(); ?>accounting/save_role",
            data: {
                role_name: role_name,
                role_amount: role_amount
            },
            success: function(result) {
                sucess("Added Successfully!");

                // $('.employee_details').html(result);
                // alert('Email Successfully!');
            },
            error: function() {
                alert("An error has occurred");
            },

        });

        // else 
        // {
        // 	alert('no');
        // }

    });

    function sucess(information, $id) {
        Swal.fire({
            title: 'Success!',
            text: information,
            icon: 'success',
            showCancelButton: false,
            confirmButtonColor: '#32243d',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value) {
                location.reload();
            }
        });
    }
</script>