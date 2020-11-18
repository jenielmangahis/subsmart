<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
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
                        <h1 class="page-title">Industry Type</h1>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card" style="min-height: 400px !important;">
                        <div class="row dashboard-container-1">
                            <div class="col-md-12 text-right">
                                <a class="btn btn-info" href="<?php echo base_url('industry_type/add_new_industry_type'); ?>"><i class="fa fa-file"></i> New Industry Type</a>
                            </div>
                        </div>       
                        <hr />
                        <?php include viewPath('flash'); ?>
                        <table class="table table-hover" data-id="coupons">
                            <thead>
                                <tr>
                                    <th style="width: 40%;">Industry Type Name</th>
                                    <th style="width: 20%;">Business Type Name</th>
                                    <th style="width: 10%;">Status</th>
                                    <th style="width: 15%;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach( $industryTypes as $industryType){ ?>
                                    <?php 
                                        if( $industryType->status == 1 ){
                                            $cell = 'cell-active';
                                            $status = "Active";
                                        }else{
                                            $cell = 'cell-inactive';
                                            $status = "Inactive";
                                        }
                                    ?>
                                    <tr>
                                        <td><?= $industryType->name; ?></td>
                                        <td><?= $industryType->business_type_name; ?></td>
                                        <td class="<?= $cell; ?>" style="text-align: center;color:#ffffff;"><?= $status; ?></td>
                                        <td>
                                            <a class="btn btn-info btn-sm" href="<?php echo base_url('industry_type/edit_industry_type/'.$industryType->id); ?>"><i class="fa fa-pencil"></i> Edit</a>
                                            <a class="btn btn-sm btn-danger btn-delete-type" href="javascript:void(0);" data-id="<?= $industryType->id; ?>"><i class="fa fa-trash"></i> Delete</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <div style="margin: 0 auto; margin-top: 45px;">
                            <?= $pagination; ?>
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
<?php include viewPath('includes/plan_builder_modals'); ?> 
<?php include viewPath('includes/footer_plan_builder'); ?>

<script type="text/javascript">  
$(function(){
    $(".btn-delete-type").click(function(){
        var type_id = $(this).attr("data-id");
        $("#type_id").val(type_id);

        $("#modalDeleteIndustryType").modal("show");
    });
});
</script>
