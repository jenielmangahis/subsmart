<div class="modal fade nsm-modal fade" id="upgrade_plan_modal" tabindex="-1" aria-labelledby="upgrade_plan_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">        
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Upgrade Plan</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>            
            <div class="modal-body">
                <form method="POST" id="frm-upgrade-subscription">
                <input type="hidden" id="upgrade-plan-payment-intent-id" name="payment_intent_id" value="" />
                <div class="row g-3" id="upgrade-plan-details">
                    <div class="col-12">
                        <label class="content-subtitle d-block mb-2"><b>Subscription Plan</b> <a href="<?= base_url("/pricing"); ?>" target="_new" class="content-subtitle nsm-link pull-right">See Plan List</a></label>
                        <select class="nsm-field form-select mb-1 subscription_plans" id="upgrade-subscription-plan" name="plan_id" required>
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
                </form>
                <form id='upgrade-plan-payment-form' method='post' action=""> 
                    <div class="mt-2" id="stripe-upgrade-plan-form-container"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button primary" id="btn-upgrade-plan">Payment</button>
                <button type="button" class="nsm-button primary" id="btn-upgrade-plan-back" style="display:none;">Back</button>
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
            </div>
            
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
            <div class="modal-body">
                <form id="frm-buy-license" method="post">
                <input type="hidden" id="payment-intent-id" name="payment_intent_id" value="" />
                <div id="license-details">
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
                        <div class="col-6"></div>
                        <div class="col-6 mt-2">
                            <label>Number of license to buy</label>
                            <input type="number" step="1" min="1" class="form-control" name="num_license" id="num-license" value="1" required/>
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
                </form>
                <form id='payment-form' method='post' action=""> 
                    <div class="mt-2" id="stripe-form-container"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button primary" id="btn-buy-license">Payment</button>
                <button type="button" class="nsm-button primary" id="btn-buy-license-back" style="display:none;">Back</button>
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>                
            </div>
        </div>        
    </div>
</div>

<div class="modal fade nsm-modal fade" id="modal-pay-subscription" tabindex="-1" aria-labelledby="modal-pay-subscription_label" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">        
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
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <form id="frm-pay-subscription" method="post">
                        <input type="hidden" id="subscription-payment-intent-id" name="payment_intent_id" value="" />
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
                        </div>
                        </form>
                    </div>
                    <div class="col-12 col-md-6">
                        <form id='subscription-payment-form' method='post' action=""> 
                            <div class="mt-2" id="stripe-subscription-payment-form-container"></div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>                
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

    $('#btn-upgrade-plan').on('click', function(){
        var subscription_plan = $("#upgrade-subscription-plan").val();
        var subscription_type = $("#upgrade-subscription-type").val();
		var url = base_url + 'mycrm/_upgrade_plan_card_payment_form';

        if( subscription_plan === null ){
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Please select plan'
            });
        }else if( subscription_type === null ){
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Please select plan type'
            });
        }else{
            $.ajax({
                type: "POST",
                url: url,
                data: {subscription_plan:subscription_plan, subscription_type:subscription_type},
                success: function(o)
                {	
                    $('#stripe-upgrade-plan-form-container').html(o);
                },
                beforeSend:function(){
                    $('#upgrade-plan-details').hide();
                    $('#btn-upgrade-plan').hide();
                    $('#btn-upgrade-plan-back').show();
                    $('#stripe-upgrade-plan-form-container').html('<span class="bx bx-loader bx-spin"></span> loading payment form...');
                }
            });
        }
    });

    $('#btn-buy-license').on('click', function(){
        var num_license = $("#num-license").val();
		var url = base_url + 'mycrm/_license_card_payment_form';

		$.ajax({
			type: "POST",
			url: url,
			data: {num_license:num_license},
			success: function(o)
			{	
				$('#stripe-form-container').html(o);
			},
			beforeSend:function(){
                $('#license-details').hide();
                $('#btn-buy-license').hide();
                $('#btn-buy-license-back').show();
				$('#stripe-form-container').html('<span class="bx bx-loader bx-spin"></span> loading payment form...');
			}
		});
    });

    $('#btn-buy-license-back').on('click', function(){
        $('#license-details').show();
        $('#btn-buy-license').show();

        $('#stripe-form-container').html('');
        $(this).hide();
    });

    $('#btn-upgrade-plan-back').on('click', function(){
        $('#upgrade-plan-details').show();
        $('#btn-upgrade-plan').show();

        $('#stripe-upgrade-plan-form-container').html('');
        $(this).hide();
    });
});
</script>