<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include viewPath('v2/includes/header'); ?>
<style>
.row-header{
    background-color: #32243d;
    color: #ffffff;
}
.p-20 {
  padding-top: 25px !important;
  padding-bottom: 25px !important;
  padding-right: 5px !important;
  padding-left: 39px !important;
  margin-top: 55px !important;
}
.hide{
    display: none;
}
.tbl-coupons .badge{
    display: block;
    width: 100%;
}
</style>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/upgrades_tabs'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/online_booking_subtabs'); ?>
    </div>
    <!-- end tabs -->
    <div class="col-12">
        <div class="row">
            <div class="col">
                <h3 class="page-title mt-0">Online Booking</h3>
            </div>
            <div class="col-auto">
                <div class="h1-spacer">
                    <a class="nsm-button primary" href="#modalAddCoupon" data-toggle="modal" data-target="#modalAddCoupon"><i class='bx bx-plus-circle'></i> Add Coupon</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            Manage coupons that users can input on the booking form.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mb-3">
                        <?php include viewPath('v2/includes/page_navigations/coupons_subtabs'); ?>
                    </div>
                    <div class="col-md-12" style="margin-top: 20px;">
                        <?php include viewPath('flash'); ?>
                        <table class="nsm-table" data-id="coupons">
                            <thead>
                                <tr>
                                    <th style="width:60%;">Coupon</th>
                                    <th>Code</th>
                                    <th>Discount</th>
                                    <th>Status</th>
                                    <th style="width: 5%;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach( $coupons as $c ){ ?>
                                    <tr>
                                        <td>
                                            <b><?php echo $c->coupon_name; ?></b>
                                            <div class="text-ter">
                                                Uses: <?php echo $c->used_per_coupon; ?><br>
                                                Valid: <?php echo date("Y-m-d", strtotime($c->date_valid_from)) . ' to ' . date("Y-m-d", strtotime($c->date_valid_to)) ?>
                                            </div>
                                        </td>
                                        <td><?php echo $c->coupon_code; ?></td>
                                        <?php $discount_type = ""; ?>
                                        <?php $discount_type = $c->discount_from_total_type == 1 ? '%' : '$'; ?>
                                        <td><?php echo $c->discount_from_total . " " . $discount_type; ?></td>
                                        <td>
                                            <?php if( $c->status == 1 ){ ?>
                                                <?php 
                                                    $date = date("Y-m-d");
                                                    $is_expired = 0;
                                                    if( $date > $c->date_valid_to ){
                                                        $is_expired = 1;
                                                    }
                                                ?>
                                                <?php if( $is_expired == 1 ){ ?>    
                                                    <span class="nsm-badge secondary">Expired</span>
                                                <?php }else{ ?>
                                                    <span class="nsm-badge success">Active</span>
                                                <?php } ?>
                                                
                                            <?php }else{ ?>
                                                <span class="nsm-badge secondary">Closed</span>
                                            <?php } ?>
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown table-management">
                                                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li role="presentation">
                                                        <a class="dropdown-item coupon__edit margin-right-sec" data-id="<?php echo $c->id; ?>" href="javascript:void(0);"><span class="fa fa-pencil icon"></span> Edit</a>
                                                    </li>
                                                    <li role="presentation">
                                                        <a class="dropdown-item coupon__delete" data-id="<?php echo $c->id; ?>" data-name="<?php echo $c->coupon_name; ?>" href="javascript:void(0);"><span class="fa fa-trash-o icon"></span> Delete</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?php include viewPath('includes/booking_modals'); ?> 
<?php include viewPath('includes/footer_booking'); ?>
<script>
$(function(){
    var base_url = "<?php echo base_url(); ?>";

    $("#coupon_valid_from").datepicker();
    $("#coupon_valid_to").datepicker();

    $("#edit_coupon_valid_from").datepicker();
    $("#edit_coupon_valid_to").datepicker();

    $(".coupon-discount-type").change(function(){
        var type = $(this).val();
        if( type == 1 ){
            $("#discount_percent_cnt").removeClass("hide");
            $("#discount_amount_cnt").addClass("hide");
        }else{
            $("#discount_percent_cnt").addClass("hide");
            $("#discount_amount_cnt").removeClass("hide");
        }
    });

    $(".coupon__edit").click(function(){
        $("#modalEditCoupon").modal('show');

        var cid = $(this).attr("data-id");
        var msg = '<div class="alert alert-info" role="alert"><span class="spinner-border spinner-border-sm m-0"></span></div>';
        var url = base_url + '/booking/_edit_coupon';

        $(".modal-edit-coupon").html(msg);
        setTimeout(function () {
            $.ajax({
               type: "POST",
               url: url,
               data: {cid:cid},
               success: function(o)
               {
                  $(".modal-edit-coupon").html(o);
               }
            });
        }, 1000);

    });

    $(".coupon__delete").click(function(){
        var cid = $(this).attr("data-id");
        $("#cid").val(cid);
        $("#modalDeleteCoupon").modal('show');
    });
});
</script>
<?php include viewPath('v2/includes/footer'); ?>
