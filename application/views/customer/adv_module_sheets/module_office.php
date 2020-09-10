<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class=" module_ac" >
    <div class="row">
        <div class="col-md-12 module_header">
            <p class="module_title">Office Use Information</p>
        </div>
        <div class="col-sm-12" id="address_module">
            <div class="col-sm-12 text-right-sm" style="align:right;">
                <span class="text-ter" style="position: absolute; right: 83px !important; top: 8px;">Customize</span>
                <div class="onoffswitch grid-onoffswitch" style="position: relative; margin-top: 7px;">
                    <input type="checkbox" name="office_switch" class="onoffswitch-checkbox" data-customize="open" id="onoff-office">
                    <label class="onoffswitch-label" for="onoff-office">
                        <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="welcome_sent"><span>Welcome kit Sent</span>
                </div>
                <div class="col-md-8">
                    <input type="checkbox" name="welcome_sent" checked value="1" id="welcome_sent">
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-3">
                    <label for="rebate1"><span>Rebate Received</span>
                </div>
                <div class="col-md-1">
                    <input type="radio" name="rebate[]" value="1" id="rebate1" checked >
                </div>
                <div class="col-md-3">
                    <label for="rebate"><span>Rebate Paid</span>
                </div>
                <div class="col-md-1">
                    <input type="radio" name="rebate[]" value="0"  id="rebate">
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-5">
                    <label for="">Commision Scheme Override</label>
                </div>
                <div class="col-md-7">
                    <input type="radio" name="commision_scheme[]" value="1" id="commision_scheme1" checked >
                    <label for="commision_scheme1"><span>On</span></label>

                    <input type="radio" name="commision_scheme[]" value="0" id="commision_scheme">
                    <label for="commision_scheme"><span>Off</span></label>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Rep Commission $</label>
                </div>
                <div class="col-md-8">
                    <input type="number" class="form-control" name="rep_comm" id="rep_comm" />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Rep Upfront Pay</label>
                </div>
                <div class="col-md-8">
                    <input type="number" class="form-control" name="rep_upfront_pay" id="rep_upfront_pay" />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Tech Commission $</label>
                </div>
                <div class="col-md-8">
                    <input type="number" class="form-control" name="tech_comm" id="tech_comm" />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="tech_upfront_pay">Tech Upfront Pay $</label>
                </div>
                <div class="col-md-8">
                    <input type="number" class="form-control" name="tech_upfront_pay" id="tech_upfront_pay" />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Rep Tiered Upfront Bonus</label>
                </div>
                <div class="col-md-8">
                    <i>$0.00</i>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Rep Tiered Holdfund Bonus</label>
                </div>
                <div class="col-md-8">
                    <i>$0.00</i>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Rep Deductions Total</label>
                </div>
                <div class="col-md-8">
                    <i>$0.00</i>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Tech Deductions Total</label>
                </div>
                <div class="col-md-8">
                    <i>$0.00</i>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">RepHold Fund Charge Back $</label>
                </div>
                <div class="col-md-8">
                    <input type="number" class="form-control" name="rep_charge_back" id="rep_charge_back" />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Rep Payroll Charge Back $</label>
                </div>
                <div class="col-md-8">
                    <input type="number" class="form-control" name="rep_payroll_charge_back" id="rep_payroll_charge_back" />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Points Scheme Override</label>
                </div>
                <div class="col-md-8">
                    <input type="radio" name="pso[]" value="1" id="pso1" checked >
                    <label for="pso1"><span>On</span></label>

                    <input type="radio" name="pso[]" value="0" id="pso">
                    <label for="pso"><span>Off</span></label>
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Points Included</label>
                </div>
                <div class="col-md-8">
                    <input type="number" class="form-control" name="points_include" id="points_include" />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Price Per Point $</label>
                </div>
                <div class="col-md-8">
                    <input type="number" class="form-control" name="price_per_point" id="price_per_point" />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Purchase Price $</label>
                </div>
                <div class="col-md-8">
                    <input type="number" class="form-control" name="purchase_price" id="purchase_price" />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Purchase Multiple</label>
                </div>
                <div class="col-md-8">
                    <input type="number" class="form-control" name="purchase_multiple" id="purchase_multiple" />
                </div>
            </div>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Purchase Discount $</label>
                </div>
                <div class="col-md-8">
                    <input type="number" class="form-control" name="purchase_discount" id="purchase_discount" />
                </div>
            </div>
        </div>
    </div>
</div>