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
    <?php include viewPath('includes/sidebars/nsmart_plans'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title">Features List</h1>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card" style="min-height: 400px !important;">
                        <div class="row dashboard-container-1">
                            <div class="col-md-12 text-right">
                                <a class="btn btn-info" href="<?php echo base_url('plan_headings/add_new_headings'); ?>"><i class="fa fa-file"></i> Create Heading</a>
                                <a class="btn btn-info" href="<?php echo base_url('nsmart_features/add_new_feature'); ?>"><i class="fa fa-file"></i> Create Feature</a>
                            </div>
                        </div>       
                        <hr />
                        <?php include viewPath('flash'); ?>
                        <table class="table table-hover" data-id="coupons">
                            <thead>
                                <tr>
                                    <th style="width: 20%;">Plan</th>
                                    <th style="width: 30%;">Description</th>
                                    <th style="width: 8%;">Price</th>
                                    <th style="width: 15%;">Discount Price</th>
                                    <th style="width: 5%;">Is Active</th>
                                    <th style="width: 15%;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php //foreach( $nSmartPlans as $p ){ ?>
                                    <?php 
                                        $cell = 'cell-active';
                                    ?>
                                    <tr>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td class="<?= $cell; ?>">-</td>
                                        <td>
                                            -
                                        </td>
                                    </tr>
                                <?php //} ?>
                            </tbody>
                        </table>
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
<?php include viewPath('includes/plan_builder_modals'); ?> 
<?php include viewPath('includes/footer_plan_builder'); ?>