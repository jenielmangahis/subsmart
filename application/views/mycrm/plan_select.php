<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style>
.input-group-prepend {
    height: 48px !important;
}
.form_line{
    margin-bottom: 10px;
}
.hide {
    display:none;
}
.plan{
    padding: 0px;
}
.card-type.visa {
    background-position: 0 0;
}
.card-type {
    display: inline-block;
    width: 30px;
    height: 20px;
    background: url(<?= base_url("/assets/img/credit_cards.png"); ?>) no-repeat 0 0;
    background-size: cover;
    vertical-align: middle;
    margin-right: 10px;
}
.card-type.americanexpress {
    background-position: -83px 0;
}
.expired-text{
    color: #fff;
    background-color: #dc3545;
    font-size: 12px;
}
.form-payment-container{
    font-size: 18px;
}
.card-hr {
    margin: 66px 0 !important;
    border-color: #dfdfdf;
}
.price-total__text {
    padding-top: 10px;
    font-size: 14px;
}
.text-ter {
    color: #888888;
}
.plan-box-info {
    margin-bottom: 0px;
    font-size: 16px;
}
.plan-box-savings {
    font-size: 14px;
}
.btn-plan-selected{
    color:#ffffff;
}
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/mycrm'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-page">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-lg-12">

                        <div class="row align-items-center" style="margin-top: 30px;">
                          <div class="col-sm-12">
                              <h3 class="page-title">Membership Options</h3>
                          </div>
                        </div>
                        <div class="pl-3 pr-3 mt-1 row">
                            <div class="col mb-4 left alert alert-warning mt-0 mb-2">
                                <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Select a membership and the number of employees that will have access to the app.</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="plan-box">
                            <div class="plan-box-name">Monthly</div>
                            <div class="plan-box-price">
                                <span class="plan-box-price-currency">$</span><span class="plan-box-price-base"><?= $a_monthly[0]; ?></span><span class="plan-box-price-decimals">.<?= $a_monthly[1]; ?></span>
                                <span class="plan-box-price-interval">/month</span>
                            </div>
                            <div class="plan-box-info text-ter">Billed as one payment of $<?= $a_monthly[0] . "." . $a_monthly[1]; ?></div>
                            <div class="plan-box-savings">&nbsp;</div>

                            <a class="btn plan-box-btn btn-primary btn-default-plan" href="javascript:void(0);" data-type="monthly"><span class="btn-icon fa fa-check"></span> <span class="btn-text">Selected</span></a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="plan-box">
                            <span class="plan-box-best">Best Value</span>
                            <div class="plan-box-name">Yearly</div>
                            <div class="plan-box-price">
                                <span class="plan-box-price-currency">$</span><span class="plan-box-price-base"><?= $a_yearly[0]; ?></span><span class="plan-box-price-decimals">.<?= $a_yearly[1]; ?></span>
                                <span class="plan-box-price-interval">/month</span>
                            </div>
                            <div class="plan-box-info text-ter">Billed as one payment of $<?= $a_yearly[0] . "." . $a_yearly[1]; ?></div>
                            <div class="plan-box-savings">You save 13%</div>
                            <a class="btn plan-box-btn btn-default" href="javascript:void(0);" data-type="yearly"><span class="btn-text">Select</span></a>
                        </div>
                    </div>
                </div>

                <div class="form-payment-container"></div>


            </div>
        </div>
    </div>
</div>
<?php include viewPath('includes/footer'); ?>
<script>
$(function(){
    $(".plan-box-btn").click(function(){
        load_plan_type_form_payment(this);
    });

    $(".btn-default-plan").trigger("click");

    function load_plan_type_form_payment(btn){
        var plan_type      = $(btn).attr('data-type');
        var url = base_url + 'mycrm/_get_plan_payment_details';
        //$(".btn-modal-remove-addon").html('<span class="spinner-border spinner-border-sm m-0"></span>');
        $('.plan-box-btn').removeClass('btn-primary');
        $('.plan-box-btn').addClass('btn-default');
        $('.plan-box-btn .fa-check').addClass('hide');
        $('.plan-box-btn').html('<span class="btn-text">Select</span>');

        $(btn).removeClass('btn-default');
        $(btn).addClass('btn-primary');
        $(btn).html('<span class="btn-icon fa fa-check"></span> <span class="btn-text">Selected</span>');

        setTimeout(function () {
            $.ajax({
               type: "POST",
               url: url,
               data: {plan_type:plan_type},
               success: function(o)
               {
                 $(".form-payment-container").hide().html(o).fadeIn();
               }
            });
        }, 100);
    }
});
</script>