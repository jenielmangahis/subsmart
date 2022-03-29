<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('includes/header'); ?>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<style>
    #draggable { width: 150px; height: 150px; padding: 0.5em; }
</style>
<style>
    label>input {
      visibility: initial !important;
      position: initial !important; 
    }
    ul.timeline {
        list-style-type: none;
        position: relative;
    }
    ul.timeline:before {
        content: ' ';
        background: #d4d9df;
        display: inline-block;
        position: absolute;
        left: 29px;
        width: 2px;
        height: 100%;
        z-index: 400;
    }
    ul.timeline > li {
        margin: 20px 0;
        padding-left: 20px;
    }
    ul.timeline > li:before {
        content: ' ';
        background: white;
        display: inline-block;
        position: absolute;
        border-radius: 50%;
        border: 3px solid #22c0e8;
        left: 20px;
        width: 20px;
        height: 20px;
        z-index: 400;
    }
</style>

<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/customer'); ?>
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
                        <div class="card-body hid-desk" >
                            <div class="row margin-bottom-ter align-items-center">
                                <!-- Nav tabs -->
                                <div class="col-auto">
                                    <h2 class="page-title" style="display:inline-block;">Customer Activites </h2>
                                    <span style="display:inline-block;color:#4a4a4a;font-size: 28px;margin-left: 9px;">(<i><?= $customer->first_name . ' ' . $customer->last_name; ?></i>)</span>
                                </div>
                                <div class="alert alert-warning col-md-12 mt-4 mb-4" role="alert">
                                    <span style="color:black;">
                                       Customer audit trail logs.
                                    </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="banking-tab-container mb-5">
                                        <div class="rb-01">
                                            <?php include_once('cus_module_tabs.php'); ?>
                                        </div>
                                    </div>
                                    <div class="tab-content mt-4" >
                                        <ul class="timeline">
                                            <?php foreach ($activities as $ac) { ?>
                                                <li>
                                                    <span style="color:#007bff;font-size: 17px;"><?= $ac->employee_name; ?></span>
                                                    <span class="float-right" style="color:#007bff; font-size: 17px;"><?= date("d F, Y g:i A", strtotime($ac->date_created)); ?></span>
                                                    <p style="font-size:17px;"><?= $ac->remarks; ?></p>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- page wrapper end -->
<?php include viewPath('includes/footer'); ?>
<?php include viewPath('customer/adv_cust/css_list'); ?>
<?php include viewPath('customer/adv_cust/js_list'); ?>
<script>
$(document).ready(function () {
    $('#activitiesListTable').DataTable({
        "lengthChange": true,
        "searching": true,
        "pageLength": 10,
        "order": [],
    });
});
</script>
