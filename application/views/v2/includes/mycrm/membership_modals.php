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