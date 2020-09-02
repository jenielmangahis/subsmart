<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="tab-pane fade standard-accordion" id="office">
    <form id="office_form">
        <div class="row">
        <div class="col-sm-12">
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
        <div class="col-md-3">
            <div class="checkbox checkbox-sec margin-right">
                <input type="checkbox" name="welcome_sent" value="1" id="welcome_sent">
                <label for="welcome_sent"><span>Welcome kit Sent</span></label>
            </div>
        </div>
        <div class="col-md-9"></div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-3">
                    <div class="checkbox checkbox-sec margin-right">
                        <input type="radio" name="rebate[]" value="1" id="rebate1" checked required>
                        <label for="rebate1"><span>Rebate Received</span></label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="checkbox checkbox-sec margin-right">
                        <input type="radio" name="rebate[]" value="0"  id="rebate">
                        <label for="rebate"><span>Rebate Paid</span></label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <label for="">Commision Scheme Override</label><br/>
            <div class="checkbox checkbox-sec margin-right">
                <input type="radio" name="commision_scheme[]" value="1" id="commision_scheme1" checked required>
                <label for="commision_scheme1"><span>On</span></label>
            </div>
            <div class="checkbox checkbox-sec margin-right">
                <input type="radio" name="commision_scheme[]" value="0" id="commision_scheme">
                <label for="commision_scheme"><span>Off</span></label>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Rep Commission $</label><br/>
                <input type="number" class="form-control" name="rep_comm" id="rep_comm" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Rep Upfront Pay</label><br/>
                <input type="number" class="form-control" name="rep_upfront_pay" id="rep_upfront_pay" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Tech Commission $</label><br/>
                <input type="number" class="form-control" name="tech_comm" id="tech_comm" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Tech Upfront Pay $</label><br/>
                <input type="number" class="form-control" name="tech_upfront_pay" id="tech_upfront_pay" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Rep Tiered Upfront Bonus</label><br/>
                <i>$0.00</i>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Rep Tiered Holdfund Bonus</label><br/>
                <i>$0.00</i>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Rep Deductions Total</label><br/>
                <i>$0.00</i>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Tech Deductions Total</label><br/>
                <i>$0.00</i>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Rep Hold Fund Charge Back $</label><br/>
                <input type="number" class="form-control" name="rep_charge_back" id="rep_charge_back" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Rep Payroll Charge Back $</label><br/>
                <input type="number" class="form-control" name="rep_payroll_charge_back" id="rep_payroll_charge_back" />
            </div>
        </div>
        <div class="col-md-6"></div>
        <div class="col-md-12">
            <label for="">Points Scheme Override</label><br/>
            <div class="checkbox checkbox-sec margin-right">
                <input type="radio" name="pso[]" value="1" id="pso1" checked required>
                <label for="pso1"><span>On</span></label>
            </div>
            <div class="checkbox checkbox-sec margin-right">
                <input type="radio" name="pso[]" value="0" id="pso">
                <label for="pso"><span>Off</span></label>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Points Included</label><br/>
                <input type="number" class="form-control" name="points_include" id="points_include" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Price Per Point $</label><br/>
                <input type="number" class="form-control" name="price_per_point" id="price_per_point" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Purchase Price $</label><br/>
                <input type="number" class="form-control" name="purchase_price" id="purchase_price" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Purchase Multiple</label><br/>
                <input type="number" class="form-control" name="purchase_multiple" id="purchase_multiple" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group" id="customer_type_group">
                <label for="">Purchase Discount $</label><br/>
                <input type="number" class="form-control" name="purchase_discount" id="purchase_discount" />
            </div>
        </div>

        <hr>
        <div class="col-sm-12">
            <div class="col-md-1" style="display: none;">
                <div class="form-group" id="customer_type_group">
                    <input type="text" class="form-control" name="fk_prof_id" id="fk_prof_id" value="<?php if(isset($profile_info->prof_id)){ echo $profile_info->prof_id; } ?>">
                </div>
            </div>
            <div class="col-sm-12 text-right-sm" style="align:right;">
                <button type="submit" class="btn btn-flat btn-primary"><span class="fa fa-send"></span> Save</button>
            </div>
        </div>
    </div>
    </form>
</div>