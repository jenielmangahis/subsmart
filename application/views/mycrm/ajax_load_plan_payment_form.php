<input type="hidden" id="payment-grand-total" name="membership_grand_total" id="membership-grand-total" value="<?= $grand_total; ?>">
<input type="hidden" name="membership_plan_type" value="<?= $plan_type; ?>">
<input type="hidden" name="membership_license_amount" value="<?= $license_total_price; ?>">
<div class="row margin-bottom-sec">
    <div class="col-md-2">Membership</div>
    <div class="col-md-2"><?= $plan->plan_name; ?> / <?= $plan_type == 'monthly' ? 'Monthly Plan' : 'Yearly Plan'; ?></div>
    <div class="col-md-2 text-right">
        <div class="plan-item__price-total">$<?= number_format($membership_price, 2); ?></div>
    </div>
</div>
<div class="row margin-bottom-sec">
    <div class="col-md-2">Plan number of license</div>
    <div class="col-md-2"><?= $plan->num_license; ?> licenses</div>
    <div class="col-md-2 text-right"></div>
</div>
<div class="row margin-bottom-sec">
    <div class="col-md-2">Remaining License</div>
    <div class="col-md-2"><?= $remaining_license; ?> <?= $remaining_license > 1 ? 'licenses' : 'license'; ?></div>
    <div class="col-md-2 text-right"></div>
</div>

<div class="row margin-bottom-sec">
    <div class="col-md-2">
        <div class="form-control-text">Employees</div>
    </div>
    <div class="col-md-1">
        <select name="num_license" id="num-license"  class="form-control">
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
    <div class="col-md-2">
        <div class="form-control-text">
            <span class="text-ter">x</span>&nbsp;$<?= number_format($plan->price_per_license, 2); ?>/mo <?= $plan_type == 'yearly' ? ' x 12 months' : ''; ?></div>
    </div>
    <div class="col-md-1 text-right">
        <div class="form-control-text plan-item__price-total">$<span id="total-license-price"><?= number_format($license_total_price, 2); ?></span></div>
    </div>
</div>

<!-- <div class="row margin-bottom-sec">
    <div class="col-md-2">
        <div class="form-control-text">Postcard Automation</div>
    </div>
    <div class="col-md-1">
        <div class="form-control-text">0</div>
    </div>
    <div class="col-md-1">
        <div class="form-control-text">
            <span class="text-ter">x</span> &nbsp;$0.90/mo
        </div>
    </div>
    <div class="col-md-2 text-right">
        <div class="form-control-text plan-item__price-total">$0.00</div>
    </div>
</div>

<div class="row margin-bottom-sec">
    <div class="col-md-2">
        <div class="form-control-text">SMS Automation</div>
    </div>
    <div class="col-md-1">
        <div class="form-control-text">0</div>
    </div>
    <div class="col-md-1">
        <div class="form-control-text">
            <span class="text-ter">x</span> &nbsp;$0.10/mo
        </div>
    </div>
    <div class="col-md-2 text-right">
        <div class="form-control-text plan-item__price-total">$0.00</div>
    </div>
</div> -->

<div class="row margin-bottom-sec">
    <div class="col-md-5 text-right">
        <span class="bold">Total</span>
    </div>
    <div class="col-md-1 text-right">
        <div class="plan-item__price-total"><span class="bold">$<span id="total-amount"><?= number_format($grand_total, 2); ?></span></span></div>
    </div>
</div>
<hr class="card-hr">

<div class="row margin-bottom-sec">
    <div class="col-md-2">Billing Period</div>
    <div class="col-md-5">
        <span data-plan="billing-period"><?= $billing_period; ?></span>
    </div>
</div>
<div class="row margin-bottom">
    <div class="col-md-2">
        <strong>You need to Pay</strong>
    </div>
    <div class="col-md-5">
        <span class="bold" data-plan="price">$<span id="grand-total"><?= number_format($grand_total, 2); ?></span>/<?= $plan_type == 'monthly' ? 'month' : 'year'; ?></span>
        <div class="text-ter price-total__text">(this amount will be charged every <?= $plan_type == 'monthly' ? 'month' : 'year'; ?>)</div>
    </div>
</div>
<div class="row margin-bottom">
    <div class="col-md-2"></div>
    <div class="col-md-4">
        <a class="btn btn-primary btn-lg btn-pay-subscription" href="javascript:void(0);">&nbsp; Pay Now &nbsp;</a>        
    </div>
</div>
<script>
$(function(){
    var price_per_license = "<?= $plan->price_per_license; ?>";
    var membership_price  = parseFloat("<?= $membership_price; ?>");
    var plan_type = "<?= $plan_type; ?>";

    load_default_values();

    function load_default_values(){
        var num_selected = 1;
        if( plan_type == 'monthly' ){
            var total_license_price = parseFloat(price_per_license * num_selected);
        }else{
            var total_license_price = parseFloat((price_per_license * num_selected) * 12);
        }

        var grand_total = parseFloat(total_license_price) + parseFloat(membership_price);

        $("#m-license-amount").val(total_license_price.toFixed(2));
        $("#m-grand-total").val(grand_total.toFixed(2));       
        $("#m-membership-amount").val(membership_price.toFixed(2)); 
    }

    $("#num-license").change(function(){
        var num_selected = $(this).val();
        if( plan_type == 'monthly' ){
            var total_license_price = parseFloat(price_per_license * num_selected);
        }else{
            var total_license_price = parseFloat((price_per_license * num_selected) * 12);
        }

        var grand_total = parseFloat(total_license_price) + parseFloat(membership_price);

        $("#total-amount").text(grand_total.toFixed(2));
        $("#grand-total").text(grand_total.toFixed(2));
        $("#membership-grand-total").val(grand_total.toFixed(2));
        $("#total-license-price").text(total_license_price.toFixed(2));        

        //Modal input
        $("#m-license-amount").val(total_license_price.toFixed(2));
        $("#m-grand-total").val(grand_total.toFixed(2));
    });
});
</script>