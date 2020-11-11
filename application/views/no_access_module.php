<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header_plan_builder'); ?>
<style>
.cell-active{
    background-color: #5bc0de;
}
.cell-inactive{
    background-color: #d9534f;
}
</style>
<div class="wrapper" role="wrapper">
    <?php //include viewPath('includes/sidebars/nsmart_plans'); ?>
    <?php 
        if( $module == 'calendar' ){
            $module_title = "Calendar";
            include viewPath('includes/sidebars/schedule');
            include viewPath('includes/notifications');
        }elseif( $module == 'settings' ){
            $module_title = "Settings";
            include viewPath('includes/sidebars/schedule');
            include viewPath('includes/notifications');
        }elseif( $module == 'taskhub' ){
            $module_title = "Taskhub";
            include viewPath('includes/sidebars/schedule');
        }elseif( $module == 'online_booking' ){
            $module_title = "Online Booking";
            include viewPath('includes/sidebars/upgrades');
        }elseif( $module == 'customer' ){
            $module_title = "Customer";
            include viewPath('includes/sidebars/customer');
        }elseif( $module == 'customer_group' ){
            $module_title = "Customer Group";
            include viewPath('includes/sidebars/customer');
        }elseif( $module == 'customer_type' ){
            $module_title = "Customer Type";
            include viewPath('includes/sidebars/customer');
        }elseif( $module == 'customer_leads' ){
            $module_title = "Leads";
            include viewPath('includes/sidebars/customer');
        }elseif( $module == 'job' ){
            $module_title = "Jobs";
            include viewPath('includes/sidebars/job');
        }


     

    ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title"><?= $module_title ?></h1>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="alert danger lert-dismissible fade show" style="width: 100%;margin-top: 10px;margin-bottom: 10px; text-align: left;color: #721c24;background-color: #f8d7da;border-color: #f5c6cb;">
                          <p>No access to module</p>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer'); ?>