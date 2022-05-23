<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/upgrades'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title">Online Booking</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Manage your online booking</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card" style="min-height: 400px !important;">
                        <?php include viewPath('includes/booking_tabs'); ?>   

                        <div class="row dashboard-container-1">
                            <div class="col-md-8"><strong>Manage coupons that users can input on the booking form.</strong></div>
                        </div>       
                        <hr />
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
                                <tr>
                                    <th>Coupon</th>
                                    <th>Code</th>
                                    <th>Discount</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- <tr>
                                    <td>
                                        test coupon 
                                        <div class="text-ter">
                                            Uses: 1<br>
                                            Valid: 14-Jul-2020-31-Jul-2020 
                                        </div>
                                    </td>
                                    <td>dx123</td>
                                    <td>$1.00</td>
                                    <td>Active</td>
                                    <td class="text-right">
                                        <a class="coupon__edit margin-right-sec" data-coupon-edit-modal="open" data-id="165" href="#"><span class="fa fa-edit"></span> edit</a>
                                        <a class="coupon__delete" data-coupon-delete-modal="open" data-id="165" data-name="test coupon" href="#"><span class="fa fa-trash"></span></a>
                                    </td>
                                </tr> -->
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
                                        <td>Active</td>
                                        <td class="text-right">
                                            <a class="coupon__edit margin-right-sec" data-id="<?php echo $c->id; ?>" href="javascript:void(0);"><span class="fa fa-edit"></span> edit</a>
                                            <a class="coupon__delete" data-id="<?php echo $c->id; ?>" data-name="<?php echo $c->coupon_name; ?>" href="javascript:void(0);"><span class="fa fa-trash"></span></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <a href="#modalAddCoupon" data-toggle="modal" data-target="#modalAddCoupon"><span class="fa fa-plus-square fa-margin-right"></span> Add Coupon</a>
                        <hr />
                        <div class="margin-top text-right">
                            <a class="btn btn-primary" href="<?php echo base_url('more/addon/booking/settings') ?>">Continue &raquo;</a>
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
<?php include viewPath('includes/booking_modals'); ?> 
<?php include viewPath('includes/footer_booking'); ?>
<script>
$(function(){
    var base_url = "<?php echo base_url(); ?>";

    $("#coupon_valid_from").datepicker();
    $("#coupon_valid_to").datepicker();

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
        var msg = '<div class="alert alert-info" role="alert"><img src="'+base_url+'/assets/img/spinner.gif" /> Loading...</div>';
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