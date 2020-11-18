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
                        <h1 class="page-title">Upgrades</h1>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card" style="min-height: 400px !important;">
                        <div class="row dashboard-container-1">
                            <div class="col-md-12 text-right">
                                <a class="btn btn-info" href="<?php echo base_url('nsmart_upgrades/add_new_upgrade'); ?>"><i class="fa fa-file"></i> New Upgrade</a>
                            </div>
                        </div>       
                        <hr />
                        <?php include viewPath('flash'); ?>
                        <table class="table table-hover" data-id="coupons">
                            <thead>
                                <tr>
                                    <th style="width: 20%;">Name</th>
                                    <th style="width: 30%;">Description</th>
                                    <th style="width: 8%;">SMS Price</th>
                                    <th style="width: 8%;">Service Price</th>
                                    <th style="width: 15%;">Status</th>
                                    <th style="width: 15%;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach( $nSmartUpgrades as $upgrade ){ ?>
                                    <?php 
                                        if( $upgrade->status == 1 ){
                                            $cell = 'cell-active';
                                            $status = "Active";
                                        }else{
                                            $cell = 'cell-inactive';
                                            $status = "Inactive";
                                        }
                                    ?>
                                    <tr>
                                        <td><?= $upgrade->name; ?></td>
                                        <td><?= $upgrade->description; ?></td>
                                        <td><?= "$" . number_format($upgrade->sms_fee,2); ?></td>
                                        <td><?= "$" . number_format($upgrade->service_fee,2); ?></td>
                                        <td class="<?= $cell; ?>"><?= $status; ?></td>
                                        <td>
                                            <a class="btn btn-info btn-sm" href="<?php echo base_url('nsmart_upgrades/edit_upgrade/'.$upgrade->id); ?>"><i class="fa fa-pencil"></i> Edit</a>
                                            <a class="btn btn-sm btn-danger btn-delete-upgrade" href="javascript:void(0);" data-id="<?= $upgrade->id; ?>"><i class="fa fa-trash"></i> Delete</a>
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
<?php //include viewPath('includes/footer'); ?>

<script type="text/javascript">  
$(function(){
    $(".btn-delete-upgrade").click(function(){
        var u_id = $(this).attr("data-id");
        $("#u_id").val(u_id);

        $("#modalDeleteUpgrade").modal("show");
    });
});
</script>
