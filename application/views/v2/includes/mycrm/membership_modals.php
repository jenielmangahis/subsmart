<div class="modal fade nsm-modal fade" id="upgrade_plan_modal" tabindex="-1" aria-labelledby="upgrade_plan_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">        
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Upgrade Plan</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <form method="POST" id="frm-upgrade-subscription">
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-12">
                        <label class="content-subtitle d-block mb-2"><b>Subscription Plan</b> <a href="<?= base_url("/pricing"); ?>" target="_new" class="content-subtitle nsm-link pull-right">See Plan List</a></label>
                        <select class="nsm-field form-select mb-1 subscription_plans" name="plan_id" required>
                            <option value="" selected="selected" disabled>Select Plan</option>
                            <?php foreach ($nsPlans as $ns) : ?>
                                <option value="<?= $ns->nsmart_plans_id; ?>" data-price="<?= $ns->price; ?>"><?= $ns->plan_name; ?></option>
                            <?php endforeach; ?>
                        </select>
                        
                    </div>
                    <div class="col-12">
                        <label class="content-subtitle fw-bold d-block mb-2">Subscription Type</label>
                        <select class="nsm-field form-select" name="subscription_type" id="upgrade-subscription-type" required>
                            <option value="" selected="selected" disabled>Select Type</option>
                            <option value="monthly">Monthly</option>
                            <option value="yearly">Yearly</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="content-subtitle fw-bold d-block mb-2">Card Number</label>
                        <input type="text" placeholder="" name="card_number" class="nsm-field form-control" required />
                    </div>
                    <div class="col-12">
                        <label class="content-subtitle fw-bold d-block mb-2">Expiration</label>
                        <div class="row g-3">
                            <div class="col-12 col-md-5">
                                <select class="nsm-field form-select" name="exp_month" required>
                                    <option value="" selected="selected" disabled>Month</option>
                                    <option value="01">01</option>
                                    <option value="02">02</option>
                                    <option value="03">03</option>
                                    <option value="04">04</option>
                                    <option value="05">05</option>
                                    <option value="06">06</option>
                                    <option value="07">07</option>
                                    <option value="08">08</option>
                                    <option value="09">09</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-5">
                                <select class="nsm-field form-select" name="exp_year" required>
                                    <option value="" selected="selected" disabled>Year</option>
                                    <?php for( $x = date("Y"); $x<=date("Y", strtotime("+20 years")); $x++ ){ ?>
                                        <option value="<?= $x; ?>"><?= $x; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-12 col-md-2">
                                <input type="password" placeholder="CVC" name="cvc" class="nsm-field form-control" required maxlength="4" />
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="content-subtitle fw-bold d-block mb-2">Plan Amount</label>
                        <input type="number" name="plan_amount" class="nsm-field form-control" id="upgrade_plan_amount" value="0.00" disabled />
                    </div>
                    <div class="col-12">
                        <label class="content-subtitle fw-bold d-block mb-2">Total Amount <span class="upgrade-text-subscription-type">Monthly</span></label>
                        <input type="number" name="total_amount" class="nsm-field form-control" id="upgrade_total_amount" value="0.00" disabled />
                    </div>
                    <?php if ($client->num_months_discounted > 0) : ?>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="same_as_residential" name="is_residential_default" checked="checked">
                                <label class="form-check-label" for="same_as_residential">
                                    By upgrading you agree to discontinue the discounted period and start a new plan.
                                </label>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="nsm-button primary" id="btn-modal-upgrade-plan">Upgrade</button>
            </div>
            </form>
        </div>        
    </div>
</div>

<div class="modal fade nsm-modal fade" id="modal-buy-license" tabindex="-1" aria-labelledby="modal-buy-license_label" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">        
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Buy License</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <form id="frm-buy-license" method="post">
            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                        <label>Price per license</label>
                        <div class="col-auto">
                            <label class="visually-hidden" for="price-per-license">Amount</label>
                            <div class="input-group">
                                <div class="input-group-text">$</div>
                                <input type="text" class="form-control" id="price-per-license" value="<?= number_format($plan->price_per_license, 2); ?>" disabled="" />
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <label>Number of license to buy</label>
                        <input type="number" step="1" min="1" class="form-control" name="num_license" id="num-license" value="1" required/>
                    </div>
                    <div class="col-6 mt-4">
                        <label>Card Number</label>
                        <input type="text" class="form-control" name="card_number" id="" value="" required/>
                    </div>
                    <div class="col-6 mt-4">
                        <label>Expiration</label>
                        <br />
                        <select class="nsm-field form-select" name="exp_month" style="width:33%;display:inline-block;">
                            <option value="" selected="selected" disabled>MM</option>
                            <option value="01">01</option>
                            <option value="02">02</option>
                            <option value="03">03</option>
                            <option value="04">04</option>
                            <option value="05">05</option>
                            <option value="06">06</option>
                            <option value="07">07</option>
                            <option value="08">08</option>
                            <option value="09">09</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </select>
                        <select class="nsm-field form-select" name="exp_year" style="width:37%;display:inline-block;">
                            <option value="" selected="selected" disabled>YY</option>
                            <?php for( $x = date("Y"); $x<=date("Y", strtotime("+20 years")); $x++ ){ ?>
                                <option value="<?= $x; ?>"><?= $x; ?></option>
                            <?php } ?>
                        </select>
                        <input type="password" maxlength="4" class="form-control" name="cvc" id="cvc" value="" style="width:26%;display:inline-block;" placeholder="CVC" required/>
                    </div>
                    <div class="col-6 mt-2">
                        <label>Total Amount</label>
                        <div class="col-auto">
                            <label class="visually-hidden" for="license-total-amount">Total Amount</label>
                            <div class="input-group">
                                <div class="input-group-text">$</div>
                                <input type="number" class="form-control" name="total_license"  id="license-total-amount" value="<?= number_format($plan->price_per_license, 2); ?>" disabled="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="nsm-button primary" id="btn-buy-license">Buy</button>
            </div>
            </form>
        </div>        
    </div>
</div>

<div class="modal fade nsm-modal fade" id="modal-pay-subscription" tabindex="-1" aria-labelledby="modal-pay-subscription_label" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">        
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">
                    <?php if($client->is_plan_active == 1){ ?>
                        Pay Subscription Plan
                    <?php }else{ ?>
                        Renew Subscription
                    <?php } ?>
                </span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <form id="frm-pay-subscription" method="post">
            <div class="modal-body">
                <div class="row g-3">   
                    <div class="col-12">
                        <label class="content-subtitle fw-bold d-block mb-2">Subscription Plan</label>
                        <input type="text" class="field form-control" value="<?= $plan->plan_name; ?>" readonly="">
                    </div>
                    <div class="col-12">
                        <label class="content-subtitle fw-bold d-block mb-2">Plan Amount</label>
                        <input type="text" class="field form-control" value="<?= number_format($total_plan_cost,2); ?>" readonly="">
                    </div>
                    <div class="col-12">
                        <label class="content-subtitle fw-bold d-block mb-2">Addon Amount</label>
                        <input type="text" class="field form-control" value="<?= number_format($total_addon_price,2); ?>" readonly="">
                    </div>
                    <div class="col-12">
                        <label class="content-subtitle fw-bold d-block mb-2">Total Amount</label>
                        <input type="text" class="field form-control" value="<?= number_format($total_membership_cost,2); ?>" readonly="">
                    </div>                 
                    <div class="col-12">
                        <label class="content-subtitle fw-bold d-block mb-2">Card Number</label>
                        <input type="text" placeholder="" name="card_number" class="nsm-field form-control" required />
                    </div>
                    <div class="col-12">
                        <label class="content-subtitle fw-bold d-block mb-2">Expiration</label>
                        <div class="row g-3">
                            <div class="col-12 col-md-5">
                                <select class="nsm-field form-select" name="exp_month" required>
                                    <option value="" selected="selected" disabled>Month</option>
                                    <option value="01">01</option>
                                    <option value="02">02</option>
                                    <option value="03">03</option>
                                    <option value="04">04</option>
                                    <option value="05">05</option>
                                    <option value="06">06</option>
                                    <option value="07">07</option>
                                    <option value="08">08</option>
                                    <option value="09">09</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-5">
                                <select class="nsm-field form-select" name="exp_year" required>
                                    <option value="" selected="selected" disabled>Year</option>
                                    <?php for( $x = date("Y"); $x<=date("Y", strtotime("+20 years")); $x++ ){ ?>
                                        <option value="<?= $x; ?>"><?= $x; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-12 col-md-2">
                                <input type="password" placeholder="CVC" name="cvc" class="nsm-field form-control" required maxlength="4" />
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="nsm-button primary" id="btn-modal-pay-subscription">Pay</button>
            </div>
            </form>
        </div>        
    </div>
</div>

<script>
$(function(){

    $('.subscription_plans').select2({
        dropdownParent: $("#upgrade_plan_modal")
    });

    $("#num-license").change(function(){
        var price       = $("#price-per-license").val();
        var num_license = $(this).val();
        var total_price = parseFloat(price) * parseFloat(num_license);

        $("#license-total-amount").val(total_price.toFixed(2));
    });

    function compute_plan_amount(){
        var subscription_type = $("#upgrade-subscription-type").val();
        var plan_price = parseFloat($(".subscription_plans").find(":selected").data("price")); 

        if( subscription_type == 'monthly' ){
            var total_amount = plan_price;
        }else{
            var total_amount = plan_price * 12;
        }

        $("#upgrade_total_amount").val(total_amount.toFixed(2));
        $("#upgrade_plan_amount").val(plan_price.toFixed(2));
    }

    $(".subscription_plans").change(function(){        
        compute_plan_amount();
    });

    $("#upgrade-subscription-type").change(function(){
        var selected = $(this).val();
        if( selected == 'monthly' ){
            $(".upgrade-text-subscription-type").text("Monthly")
        }else{
            $(".upgrade-text-subscription-type").text("Yearly")
        }

        compute_plan_amount();
    });
});
</script>