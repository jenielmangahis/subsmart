<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/admin_header'); ?>
<style>
.cell-active{
    background-color: #5bc0de;
}
.cell-inactive{
    background-color: #d9534f;
}
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/admin/nsmart_plans'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card" style="min-height: 400px !important;">
                        <div class="row align-items-center">
                            <div class="col-sm-12">
                                <h3 class="page-title" style="margin-top: 5px;margin-bottom:10px;">Subscribers</h3>
                            </div>
                        </div>
                        <div class="pl-3 pr-3 mt-0 row">
                            <div class="col mb-4 left alert alert-warning mt-0 mb-2">
                                <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Manage Subscribers</span>
                            </div>
                        </div>
                        <br />
                        <?php include viewPath('flash'); ?>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Business Name</th>
                                    <th>Industry</th>
                                    <th>Plan</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($subscriptions as $subscription) { ?>
                                    <?php 
                                        $status = "-";
                                        if( $subscription->is_plan_active == 1 ){
                                            $cell = 'cell-active';
                                            $status = "Active";
                                        }else{
                                            $cell = 'cell-inactive';
                                            $status = "Expire";
                                        }
                                    ?>                                    
                                    <tr>
                                        <td><?= $subscription->id; ?></td>
                                        <td><?= $subscription->first_name; ?> <?= $subscription->last_name; ?></td>
                                        <td><?= $subscription->email_address; ?></td>
                                        <td><?= $subscription->business_name; ?></td>
                                        <td><?= $subscription->industry_type_name; ?></td>
                                        <td>
                                            
                                            <div class="col-sm-8 col-md-8" style="background-color: #909da7;padding:5px">
                                                <div class="plan-option-box" style="color: #ffffff;">
                                                    <span class="plan-option-box-header">
                                                       <?= $subscription->plan_name; ?>
                                                    </span>
                                                    <div class="plan-option-box-cnt">
                                                        <span class="plan-option-box-value">$<?= $subscription->price; ?></span>
                                                        <span class="plan-option-box-name">Subscription</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- <span class=""><strong>Next Billing:</strong> Month XX, XXXX</span> -->

                                        </td>
                                        <td class="<?= $cell; ?>" style="text-align: center;color:#ffffff;"><?= $status; ?></td>
                                        <td>
                                            <a class="btn btn-sm btn-default btn-view-subscription-details" href="javascript:void(0);" data-id="<?= $subscription->id; ?>"><i class="fa fa-view"></i> View Details</a>
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
<?php include viewPath('includes/admin_mgt_modals'); ?> 
<?php include viewPath('includes/admin_footer'); ?>
<script>
$(function(){
    $(".btn-view-subscription-details").click(function(){
        $("#modalViewSubscriptionDetails").modal('show');

        var sid = $(this).attr("data-id");
        
        var msg = '<div class="alert alert-info" role="alert"><img src="'+base_url+'/assets/img/spinner.gif" style="display:inline;" /> Loading...</div>';
        var url = base_url + 'admin/ajax_load_subscriber_details';

        $(".modal-view-subscription-details-container").html(msg);
        setTimeout(function () {
            $.ajax({
               type: "POST",
               url: url,
               data: {sid:sid},
               success: function(o)
               {
                  $(".modal-view-subscription-details-container").html(o);
               }
            });
        }, 500);

    });
});
</script>