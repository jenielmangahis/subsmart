<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
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
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/upgrades'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid p-20">
            <div class="row">
                <div class="col">
                  <h3 class="page-title mt-0">Online Booking</h3>
                </div>
                <div class="col-auto">
                    <div class="h1-spacer">
                        <a class="btn btn-primary btn-md" href="#modalAddCoupon" data-toggle="modal" data-target="#modalAddCoupon"><span class="fa fa-plus-square fa-margin-right"></span> Add Coupon</a>
                    </div>
                </div>
            </div>
            <div class="pl-3 pr-3 mt-2 row" style="position: relative;top: 7px;">
              <div class="col mb-4 left alert alert-warning mt-0 mb-0">
                  <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Manage coupons that users can input on the booking form.</span>
              </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card" style="min-height: 400px !important;">
                        <?php include viewPath('includes/booking_tabs'); ?>   
                        <div class="tabs">
                            <ul class="clearfix">
                                <li class="<?php echo $active_tab == 'active' ? 'active' : ''; ?>">
                                    <a href="<?php echo base_url('more/addon/booking/coupons/coupon_tab/active') ?>">Active <span>(<?php echo $total_active; ?>)</span></a>
                                </li>
                                <li class="<?php echo $active_tab == 'closed' ? 'active' : ''; ?>">
                                    <a href="<?php echo base_url('more/addon/booking/coupons/coupon_tab/closed') ?>">Closed <span>(<?php echo $total_closed; ?>)</span></a>
                                </li>
                            </ul>
                        </div>
                        <?php include viewPath('flash'); ?>
                        <table class="table table-hover" data-id="coupons">
                            <thead>
                                <tr class="row-header">
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
                                                <span class="badge badge-primary" style="background-color:#007bff; padding:10px;font-size: 14px;">Active</span>
                                            <?php }else{ ?>
                                                <span class="badge badge-danger" style="background-color: #ec4561; padding: 10px;font-size: 14px;">Closed</span>
                                            <?php } ?>
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-btn">
                                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdown-edit" data-toggle="dropdown" aria-expanded="true">
                                                    <span class="btn-label">Manage</span><span class="caret-holder"><span class="caret"></span></span>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdown-edit">   
                                                    <li role="presentation">
                                                        <a role="menuitem" class="coupon__edit margin-right-sec" data-id="<?php echo $c->id; ?>" href="javascript:void(0);"><span class="fa fa-pencil icon"></span> Edit</a>
                                                    </li>
                                                    <li role="presentation">
                                                        <a role="menuitem" class="coupon__delete" data-id="<?php echo $c->id; ?>" data-name="<?php echo $c->coupon_name; ?>" href="javascript:void(0);"><span class="fa fa-trash-o icon"></span> Delete</a>
                                                    </li>
                                                </ul>
                                            </div>
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