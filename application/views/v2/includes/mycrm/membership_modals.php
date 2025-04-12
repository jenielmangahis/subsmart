<div class="modal fade nsm-modal fade" id="upgrade_plan_modal" tabindex="-1" aria-labelledby="upgrade_plan_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" id="upgrade_subscription_form">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Upgrade Plan</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="content-subtitle fw-bold d-block mb-2">Subscription Plan</label>
                            <select class="nsm-field form-select mb-1" name="plan_id">
                                <option value="" selected="selected" disabled>Select Plan</option>
                                <?php foreach ($nsPlans as $ns) : ?>
                                    <option value="<?= $ns->nsmart_plans_id; ?>" data-price="<?= $ns->price; ?>"><?= $ns->plan_name; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <a href="<?= base_url("/pricing"); ?>" class="content-subtitle nsm-link">See Plan List</a>
                        </div>
                        <div class="col-12">
                            <label class="content-subtitle fw-bold d-block mb-2">Subscription Type</label>
                            <select class="nsm-field form-select" name="subscription_type">
                                <option value="" selected="selected" disabled>Select Type</option>
                                <option value="monthly">Monthly</option>
                                <option value="yearly">Yearly</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="content-subtitle fw-bold d-block mb-2">Card Number</label>
                            <input type="text" placeholder="Name" name="card_number" class="nsm-field form-control" required />
                        </div>
                        <div class="col-12">
                            <label class="content-subtitle fw-bold d-block mb-2">Expiration</label>
                            <div class="row g-3">
                                <div class="col-12 col-md-5">
                                    <select class="nsm-field form-select" name="exp_month">
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
                                    <select class="nsm-field form-select" name="exp_year">
                                        <option value="" selected="selected" disabled>Year</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                        <option value="2024">2024</option>
                                        <option value="2025">2025</option>
                                        <option value="2026">2026</option>
                                        <option value="2027">2027</option>
                                        <option value="2028">2028</option>
                                        <option value="2029">2029</option>
                                        <option value="2030">2030</option>
                                        <option value="2031">2031</option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-2">
                                    <input type="text" placeholder="CVC" name="cvc" class="nsm-field form-control" required maxlength="3" />
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
                    <button type="button" class="nsm-button primary">Upgrade</button>
                </div>
            </div>
        </form>
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
                        <input type="text" class="form-control" name="cvc" id="cvc" value="" style="width:58%;display:inline-block;" placeholder="MM/YY" required/>
                        <input type="text" maxlength="4" class="form-control" name="cvc" id="cvc" value="" style="width:40%;display:inline-block;" placeholder="CVC" required/>
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
<script>
$(function(){
    $("#num-license").change(function(){
        var price       = $("#price-per-license").val();
        var num_license = $(this).val();
        var total_price = parseFloat(price) * parseFloat(num_license);

        $("#license-total-amount").val(total_price.toFixed(2));
    });
});
</script>