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
                                                                <span class="plan-box-price-currency">$</span><span class="plan-box-price-base">29</span><span class="plan-box-price-decimals">.95</span>
                                <span class="plan-box-price-interval">/month</span>
                            </div>
                            <div class="plan-box-info text-ter">Billed as one payment of $29.95</div>

                            <div class="plan-box-savings">
                                                        &nbsp;
                                                        </div>

                            <a class="btn plan-box-btn btn-primary" data-plan="price-select" data-plan-price-id="15" data-label="Select|Selected" style="color: #ffffff;"><span class="btn-icon fa fa-check"></span> <span class="btn-text">Selected</span></a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="plan-box">
                            <span class="plan-box-best">Best Value</span>
                            <div class="plan-box-name">Yearly</div>
                            <div class="plan-box-price">
                                                                <span class="plan-box-price-currency">$</span><span class="plan-box-price-base">25</span><span class="plan-box-price-decimals">.95</span>
                                <span class="plan-box-price-interval">/month</span>
                            </div>
                            <div class="plan-box-info text-ter">Billed as one payment of $311.40</div>

                            <div class="plan-box-savings">
                                                        You save 13%
                                                        </div>

                            <a class="btn plan-box-btn btn-default" data-plan="price-select" data-plan-price-id="17" data-label="Select|Selected"><span class="btn-icon fa fa-check hide"></span> <span class="btn-text">Select</span></a>
                        </div>
                    </div>
                </div>

                <div data-plan="form-content"><div class="row margin-bottom-sec">
                    <div class="col-sm-8">Membership</div>
                    <div class="col-sm-12">Monthly Plan</div>
                    <div class="col-sm-4 text-right">
                        <div class="plan-item__price-total">$29.95</div>
                    </div>
                </div>
                
                <div class="row margin-bottom-sec">
                    <div class="col-sm-8">
                        <div class="form-control-text">Employees</div>
                    </div>
                    <div class="col-sm-4">
                        <select name="qty[8]" data-plan="plan-item-qty" class="form-control">
                <option value="1" selected="selected">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="17">17</option>
                <option value="18">18</option>
                <option value="19">19</option>
                <option value="20">20</option>
                <option value="21">21</option>
                <option value="22">22</option>
                <option value="23">23</option>
                <option value="24">24</option>
                <option value="25">25</option>
                <option value="26">26</option>
                <option value="27">27</option>
                <option value="28">28</option>
                <option value="29">29</option>
                <option value="30">30</option>
                </select>
                    </div>
                    <div class="col-sm-8">
                        <div class="form-control-text">
                            <span class="text-ter">x</span> &nbsp;$5.00/mo
                                    </div>
                    </div>
                    <div class="col-sm-4 text-right">
                        <div class="form-control-text plan-item__price-total">
                            $5.00        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-8"></div>
                    <div class="col-sm-16">
                        <a data-employee-modal="open" href="#">Manage Employees</a>
                    </div>
                </div>



                <div class="row margin-bottom-sec">
                    <div class="col-sm-8">
                        <div class="form-control-text">Postcard Automation</div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-control-text">
                            0        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="form-control-text">
                            <span class="text-ter">x</span> &nbsp;$0.90/mo
                        </div>
                    </div>
                    <div class="col-sm-4 text-right">
                        <div class="form-control-text plan-item__price-total">
                            $0.00        </div>
                    </div>
                </div>



                <div class="row margin-bottom-sec">
                    <div class="col-sm-8">
                        <div class="form-control-text">SMS Automation</div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-control-text">
                            0        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="form-control-text">
                            <span class="text-ter">x</span> &nbsp;$0.10/mo
                        </div>
                    </div>
                    <div class="col-sm-4 text-right">
                        <div class="form-control-text plan-item__price-total">
                            $0.00        </div>
                    </div>
                </div>



                <div class="row margin-bottom-sec">
                    <div class="col-sm-20 text-right">
                        <span class="bold">Total</span>
                    </div>
                    <div class="col-sm-4 text-right">
                        <div class="plan-item__price-total"><span class="bold">$34.95</span></div>
                    </div>
                </div>

                <hr class="card-hr">

                <div class="row margin-bottom-sec">
                    <div class="col-sm-8">Billing Period</div>
                    <div class="col-sm-16">
                        <span data-plan="billing-period">19-Aug-2021 to 19-Sep-2021</span>
                    </div>
                </div>
                <div class="row margin-bottom">
                    <div class="col-sm-8">
                        <strong>You need to Pay</strong>
                    </div>
                    <div class="col-sm-16">
                        <span class="bold" data-plan="price">$34.95/month</span>
                        <div class="text-ter price-total__text">(this amount will be charged every month)</div>
                    </div>
                </div></div>

            </div>
        </div>
    </div>
</div>
<?php include viewPath('includes/footer'); ?>
<script>
$(function(){

});
</script>