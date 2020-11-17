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
        $has_sidebar = true;
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
        }elseif( $module == 'customer_source' ){
            $module_title = "Customer Source";
            include viewPath('includes/sidebars/customer');
        }elseif( $module == 'customer_type' ){
            $module_title = "Customer Type";
            include viewPath('includes/sidebars/customer');
        }elseif( $module == 'customer_leads' ){
            $module_title = "Customer Leads";
            include viewPath('includes/sidebars/customer');
        }elseif( $module == 'estimate' ){
            $module_title = "Estimates";
            include viewPath('includes/sidebars/estimate');
        }elseif( $module == 'items' ){
            $module_title = "Items";
            include viewPath('includes/sidebars/items');
        }elseif( $module == 'items_add' ){
            $module_title = "Items";
            include viewPath('includes/sidebars/items');
        }elseif( $module == 'plans' ){
            $module_title = "Plans";
            include viewPath('includes/sidebars/inventory');
        }elseif( $module == 'workorder' ){
            $module_title = "Workorder";
            include viewPath('includes/sidebars/workorder');
        }elseif( $module == 'bird_eye_view' ){
            $module_title = "Bird Eye View";
            include viewPath('includes/sidebars/workorder');
        }elseif( $module == 'job_type_list' ){
            $module_title = "Job Type List";
            include viewPath('includes/sidebars/workorder');
        }elseif( $module == 'priority_list' ){
            $module_title = "Priority List";
            include viewPath('includes/sidebars/workorder');
        }elseif( $module == 'settings2' ){
            $module_title = "Settings";
            include viewPath('includes/sidebars/workorder');
        }elseif( $module == 'status' ){
            $module_title = "Status";
            include viewPath('includes/sidebars/workorder');
        }elseif( $module == 'basic_work_order' ){
            $module_title = "Basic Work Order";
            include viewPath('includes/sidebars/workorder');
        }elseif( $module == 'invoice' ){
            $module_title = "Invoice";
            include viewPath('includes/sidebars/invoice');
        }elseif( $module == 'recurring_invoices' ){
            $module_title = "Recurring Invoices";
            include viewPath('includes/sidebars/invoice');
        }elseif( $module == 'settings3' ){
            $module_title = "Settings";
            include viewPath('includes/sidebars/invoice');
        }elseif( $module == 'service_ticket' ){
            $module_title = "Service Ticket";
            include viewPath('includes/sidebars/ticket');
        }elseif( $module == 'customer_add_leads' ){
            $module_title = "Customer New Lead form";
            include viewPath('includes/sidebars/customer');
        }elseif( $module == 'accounting' ){
            $module_title = "Accounting";
            include viewPath('includes/sidebars/accounting/accounting');
        }elseif( $module == 'vault' ){
            $module_title = "File Vault";
            include viewPath('includes/sidebars/filevault');
        }elseif( $module == 'marketing' ){
            $module_title = "Marketing";
            include viewPath('includes/sidebars/marketing');
        }elseif( $module == 'business_tools' ){
            $module_title = "Business Tools";
            include viewPath('includes/sidebars/business_tools');
        }elseif( $module == 'affiliates' ){
            $module_title = "Affiliates";
            include viewPath('includes/sidebars/affiliate');
        }elseif( $module == 'form_builder' ) {
            $module_title = "Form Builder";
            $has_sidebar = false;
        }elseif( $module == 'eSign_main' ) {
            $module_title = "eSign";
            $has_sidebar = false;
        }

        
    ?>
    <?php if($has_sidebar){ ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-12">
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
    <?php }else{ ?>
    <div class="wrapper">
      <div __wrapper_section>
        <div class="card my-2">
          <div class="text-left"><h1><?= $module_title ?></h1></div>
          <hr/>
          <div class="row">
            <div class="col-xs-12 col-md-12">
                <div class="alert danger lert-dismissible fade show" style="width: 100%;margin-top: 10px;margin-bottom: 10px; text-align: left;color: #721c24;background-color: #f8d7da;border-color: #f5c6cb;">
                  <p>No access to module</p>
                </div>
            </div>
          </div>
        </div>
      </div>

    </div>
    <?php } ?>
</div>
<?php include viewPath('includes/footer'); ?>