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
.modal-dialog {
    max-width: 596px !important;
}
.modal-body{
    font-size: 19px;
}
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/mycrm'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-page">
            <form id="frm-renew-membership">
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
                            <?php 
                                $diff_increase  = $plan->price - $plan->discount;
                                $percentage_off = ($diff_increase / $plan->price) * 100; 
                            ?>
                            <div class="plan-box-info text-ter">Billed as one payment of $<?= $a_yearly_total[0] . "." . $a_yearly_total[1]; ?></div>
                            <div class="plan-box-savings">You save <?= number_format($percentage_off,2); ?>%</div>
                            <a class="btn plan-box-btn btn-default" href="javascript:void(0);" data-type="yearly"><span class="btn-text">Select</span></a>
                        </div>
                    </div>
                </div>

                <div class="form-payment-container"></div>
            </div>

            <div class="modal fade" id="modal-pay-renewal-subscription" tabindex="-1" role="dialog" aria-labelledby="modalLoadingMsgTitle" aria-hidden="true">
                <div class="modal-dialog modal-md" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="">Renew Subscription</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body" style="padding-bottom: 0px;">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-body">                            
                                    <div id="credit_card">
                                        <div class="row form_line">
                                            <div class="col-md-4">
                                                Card Number
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="card_number" id="" value="" required/>
                                            </div>
                                        </div>
                                        <div class="row form_line">
                                            <div class="col-md-4">
                                                <label for="">Expiration 
                                            </div>
                                            <div class="col-md-8">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <select id="exp_month" name="exp_month" class="input_select exp_month" required>
                                                            <option  value=""></option>
                                                            <option  value="01">01</option>
                                                            <option  value="02">02</option>
                                                            <option  value="03">03</option>
                                                            <option  value="04">04</option>
                                                            <option  value="05">05</option>
                                                            <option  value="06">06</option>
                                                            <option  value="07">07</option>
                                                            <option  value="08">08</option>
                                                            <option  value="09">09</option>
                                                            <option  value="10">10</option>
                                                            <option  value="11">11</option>
                                                            <option  value="12">12</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <select id="exp_year" name="exp_year" class="input_select exp_year" required>
                                                            <option  value=""></option>
                                                            <option  value="2021">2021</option>
                                                            <option  value="2022">2022</option>
                                                            <option  value="2023">2023</option>
                                                            <option  value="2024">2024</option>
                                                            <option  value="2025">2025</option>
                                                            <option  value="2026">2026</option>
                                                            <option  value="2027">2027</option>
                                                            <option  value="2028">2028</option>
                                                            <option  value="2029">2029</option>
                                                            <option  value="2030">2030</option>
                                                            <option  value="2031">2031</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="text" maxlength="3" class="form-control" name="cvc" id="cvc" value="" placeholder="CVC" required/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row form_line">
                                            <div class="col-md-4">
                                                Membership Amount
                                            </div>
                                            <div class="col-md-8">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">$</span>
                                                    </div>
                                                    <input type="number" class="form-control" id="m-membership-amount" value="" disabled="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row form_line">
                                            <div class="col-md-4">
                                                License Amount
                                            </div>
                                            <div class="col-md-8">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">$</span>
                                                    </div>
                                                    <input type="number" class="form-control" id="m-license-amount" value="" disabled="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row form_line">
                                            <div class="col-md-4">
                                                Total Amount
                                            </div>
                                            <div class="col-md-8">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">$</span>
                                                    </div>
                                                    <input type="number" class="form-control" id="m-grand-total" id="" value="" disabled="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary btn-modal-renew-subscription" type="submit">Pay</button>
                    </div>
                  </div>
                </div>
            </div>
            </form>

            <div class="modal fade" id="modal-manage-employees" tabindex="-1" role="dialog" aria-labelledby="modalLoadingMsgTitle" aria-hidden="true">
                <div class="modal-dialog modal-md" style="max-width: 896px !important;" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id=""><i class="fa fa-user"></i> Employees</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body" style="padding-bottom: 0px;">
                        <div class="manage-employee-container"></div>
                        <hr />
                        <br />
                        <form id="frm-add-employee">
                        <div class="row margin-bottom-sec">
                            <div class="col-md-7"><b>Add Employee Name</b></div>
                            <div class="col-md-3"><b>Employee Email</b></div>
                            <div class="col-md-1 text-right"></div>
                        </div>
                        <div class="row margin-bottom-sec">
                            <div class="col-md-7">
                                <input type="text" class="form-control" style="width:45%; display: inline-block;" name="manage_employee_fname" placeholder="First Name" required="">
                                <input type="text" class="form-control" style="width:45%; display: inline-block;" name="manage_employee_lname" placeholder="Last Name" required="">
                            </div>
                            <div class="col-md-3">
                                <input type="email" class="form-control" name="manage_employee_email" required="">
                            </div>
                            <div class="col-md-1 text-right">
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
            </div>

        </div>
    </div>
</div>
<?php include viewPath('includes/footer'); ?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

    $(".exp_month").select2({
        placeholder: "Select Month"
    });
    $(".exp_year").select2({
        placeholder: "Select Year"
    });

    $(document).on('submit', '#frm-add-employee', function(e){
        e.preventDefault();

        var url = base_url + 'mycrm/_add_employee';

        $.ajax({
           type: "POST",
           url: url,
           dataType: "json",
           data: $('#frm-add-employee').serialize(),
           success: function(o)
           {
                if( o.is_success ){
                    var total_license = parseInt($('.company-remaining-license').html());
                    $('.company-remaining-license').html(total_license - 1);
                    load_employee_list();
                    Swal.fire({
                        title: 'Success!',
                        text: 'User was successfully added.',
                        icon: 'success',
                        confirmButtonColor: '#32243d'
                    });
                    $("#frm-add-employee").trigger('reset');
                }else{
                    if( o.err_num == 1 ){
                        Swal.fire({
                            title: 'Error!',
                            text: 'Cannot add employee. Insufficient license!',
                            icon: 'error',
                            confirmButtonColor: '#32243d'
                        });
                    }else if( o.err_num == 2 ){
                        Swal.fire({
                            title: 'Error!',
                            text: 'Email already taken!',
                            icon: 'error',
                            confirmButtonColor: '#32243d'
                        });
                    }
                    
                }
           }
        });   
    });

    $(document).on('click', '.btn-pay-subscription', function(){        
        $("#modal-pay-renewal-subscription").modal('show');
    });

    $(document).on('click', '.btn-manage-employees', function(){
        $("#modal-manage-employees").modal('show');
        $(".manage-employee-container").html('<span class="spinner-border spinner-border-sm m-0"></span>');
        load_employee_list();
    });

    $(document).on('click', '.btn-delete-employee', function(){
        var url = base_url + 'mycrm/_delete_employee';
        var eid = $(this).attr('data-id');
        
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#32243d',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Delete'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
               type: "POST",
               url: url,
               dataType: "json",
               data: {eid:eid},
               success: function(o)
               {
                    if( o.is_success ){
                        var total_license = parseInt($(".company-remaining-license").html());
                        $(".company-remaining-license").html(total_license + 1);
                        load_employee_list();
                        Swal.fire({
                            title: 'Deleted!',
                            text: "User was successfully deleted.",
                            icon: 'success',
                            confirmButtonColor: '#32243d'
                        });
                    }else{
                        Swal.fire(
                          'Error!',
                          'Cannot find user',
                          'danger'
                        );
                    }
               }
            });            
          }
        });
    });

    function load_employee_list(){
        var url = base_url + 'mycrm/_get_employee_list';
        setTimeout(function () {
            $.ajax({
               type: "POST",
               url: url,
               success: function(o)
               {
                 $(".manage-employee-container").hide().html(o).fadeIn();
               }
            });
        }, 10);
    }

    $("#frm-renew-membership").submit(function(e){
        e.preventDefault();
        var url = base_url + 'mycrm/_renew_membership_plan';
        $(".btn-modal-renew-subscription").html('<span class="spinner-border spinner-border-sm m-0"></span>');

        setTimeout(function () {
            $.ajax({
               type: "POST",
               url: url,
               dataType: "json",
               data: $("#frm-renew-membership").serialize(),
               success: function(o)
               {
                    $("#modal-buy-license").modal('hide'); 
                    if( o.is_success == 1 ){
                      $("#modal-pay-renewal-subscription").modal('hide');
                      Swal.fire({
                          title: 'Payment Successful!',
                          text: "Your plan subscription was successfully renewed",
                          icon: 'success',
                          showCancelButton: false,
                          confirmButtonColor: '#32243d',
                          cancelButtonColor: '#d33',
                          confirmButtonText: 'Ok'
                      }).then((result) => {
                          if (result.value) {
                              location.href = base_url + 'mycrm/membership';
                          }
                      });
                    }else{
                      Swal.fire({
                        icon: 'error',
                        title: 'Cannot process payment',
                        text: o.message
                      });
                    }

                    $(".btn-modal-renew-subscription").html('Pay');
                }
            });
        }, 1000);
    });
});
</script>