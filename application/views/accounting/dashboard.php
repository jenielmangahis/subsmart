<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header_accounting'); ?>
<div class="wrapper" role="wrapper">
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid" >
            <div class="page-title-box">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="income tile-container">
                            <div class="inner-container">
                                <div class="tileContent">
                                    <div class="clear">
                                        <div class="inner-content">
                                            <div class="header-container">
                                                <h3 class="header-content">Income</h3>
                                                <div class="header-separator">
                                                    <div class="hs-content">Last 365 Days</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="expenses tile-container">
                            <div class="inner-container">
                                <div class="tileContent">
                                    <div class="clear">
                                        <div class="inner-content">
                                            <div class="header-container">
                                                <h3 class="header-content">Expenses</h3>
                                                <div class="header-separator">
                                                    <div class="hs-content">Last 30 Days</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="bank-accounts tile-container">
                            <div class="inner-container">
                                <div class="tileContent">
                                    <div class="clear">
                                        <div class="inner-content">
                                            <div class="header-container">
                                                <h3 class="header-content">Bank Accounts</h3>
                                                <div class="header-separator">
                                                    <div class="hs-content"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <!--                        <div class="col-sm-6">-->
                    <!--                            <div class="float-right d-none d-md-block">-->
                    <!--                                <div class="dropdown">-->
                    <!--                                    --><?php ////if (hasPermissions('users_add')): ?>
                    <!--                                        <!-- <a href="--><?php ////echo url('users/add') ?><!--" class="btn btn-primary"-->
                    <!--                                       aria-expanded="false">-->
                    <!--                                        <i class="mdi mdi-settings mr-2"></i> New Employee-->
                    <!--                                    </a> -->
                    <!--                                    --><?php //endif ?>
                    <!--                                </div>-->
                    <!--                            </div>-->
                    <!--                        </div>-->

                <div class="row">
                    <div class="col-sm-4">
                        <div class="sales tile-container" >
                            <div class="inner-container">
                                <div class="tileContent">
                                    <div class="clear">
                                        <div class="inner-content">
                                            <div class="header-container">
                                                <h3 class="header-content">Sales</h3>
                                                <div class="header-separator">
                                                    <div class="hs-content"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="more tile-container" >
                            <div class="inner-container">
                                <div class="tileContent">
                                    <div class="clear">
                                        <div class="inner-content">
                                            <div class="header-container">
                                                <h3 class="header-content">Discover More</h3>
                                                <div class="header-separator">
                                                    <div class="hs-content"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4"></div>
                </div>
                <div class="activity-container">
                    <a href="<?php echo url('/accounting/audit_log') ?>" class="activityLink">See all activity</a>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
    <?php include viewPath('includes/sidebars/accounting/accounting'); ?>
</div>
<?php include viewPath('includes/footer_accounting'); ?>


