<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header_plan_builder'); ?>
<style>
.cell-active{
    background-color: #53b94a;
    color: white;
    padding: 4px 0px;
    width: 75px;
    display: block;
    text-align: center;
    border-radius: 20px;
}
.cell-inactive{
    background-color: #585858;
    color: white;
    padding: 4px 0px;
    width: 75px;
    display: block;
    text-align: center;
    border-radius: 20px;
}
a.btn-add {
    background: #38a4f8;
    color: white;
    padding: 10px 30px;
    border-radius: 25px;
    font-size: 15px;
    box-shadow: rgb(0 0 0 / 32%) 0 1px 4px 0px;
    margin-right: 60px;
}
@media only screen and (max-width: 1024px) {
  h1.page-title {
      margin-bottom: 11px !important;
  }
  .col-xl-12 div.card {
      padding-top: 20px !important;
      width: 1000px;
  }
  a.btn-add {
    margin-right: 0px;
  }
}
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/nsmart_plans'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6 mt-3">
                        <h1 class="page-title">Current Plans</h1>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card" style="min-height: 400px !important;">
                        <div class="row dashboard-container-1">
                            <div class="col-md-12 text-right">
                                <a class="btn-add" href="<?php echo base_url('nsmart_plans/add_new_plan'); ?>"><i class="fa fa-plus"></i> New Plan</a>
                            </div>
                        </div>
                        <br class="clear"/>
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
                                <?php foreach( $nSmartPlans as $p ){ ?>
                                    <?php
                                        if( $p->status == 1 ){
                                            $cell = 'cell-active';
                                        }else{
                                            $cell = 'cell-inactive';
                                        }
                                    ?>
                                    <tr>
                                        <td><?= $p->plan_name; ?></td>
                                        <td><?= $p->plan_description; ?></td>
                                        <td><?= $p->price; ?></td>
                                        <td><?= $p->discount . " / " . $option_discount_types[$p->discount_type]; ?></td>
                                        <td><span class="<?= $cell; ?>"><?= $option_status[$p->status]; ?><span></td>
                                        <td>
                                            <a class="btn btn-info btn-sm mr-1" href="<?php echo base_url('nsmart_plans/edit_plan/'.$p->nsmart_plans_id); ?>"><i class="fa fa-pencil"></i> Edit</a>
                                            <a class="btn btn-sm btn-danger btn-delete-plan" href="javascript:void(0);" data-id="<?= $p->nsmart_plans_id; ?>"><i class="fa fa-trash"></i> Delete</a>
                                        </td>
                                    </tr>
                                <?php } ?>
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
