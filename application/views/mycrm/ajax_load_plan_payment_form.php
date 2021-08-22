<div class="row margin-bottom-sec">
    <div class="col-md-2">Membership</div>
    <div class="col-md-2"><?= $plan->plan_name; ?> / <?= $plan_type == 'monthly' ? 'Monthly Plan' : 'Yearly Plan'; ?></div>
    <div class="col-md-2 text-right">
        <div class="plan-item__price-total">$<?= number_format($membership_price, 2); ?></div>
    </div>
</div>

<div class="row margin-bottom-sec">
    <div class="col-md-2">
        <div class="form-control-text">Employees</div>
    </div>
    <div class="col-md-1">
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
    <div class="col-md-1">
        <div class="form-control-text">
            <span class="text-ter">x</span>&nbsp;$<?= number_format($plan->price_per_license, 2); ?>/mo</div>
    </div>
    <div class="col-md-2 text-right">
        <div class="form-control-text plan-item__price-total">$<?= number_format($plan->price_per_license, 2); ?></div>
    </div>
</div>

<div class="row margin-bottom-sec">
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
</div>

<div class="row margin-bottom-sec">
    <div class="col-md-5 text-right">
        <span class="bold">Total</span>
    </div>
    <div class="col-md-1 text-right">
        <div class="plan-item__price-total"><span class="bold">$34.95</span></div>
    </div>
</div>
<hr class="card-hr">

<div class="row margin-bottom-sec">
    <div class="col-md-2">Billing Period</div>
    <div class="col-md-5">
        <span data-plan="billing-period">22-Aug-2021 to 22-Sep-2021</span>
    </div>
</div>
<div class="row margin-bottom">
    <div class="col-md-2">
        <strong>You need to Pay</strong>
    </div>
    <div class="col-md-5">
        <span class="bold" data-plan="price">$34.95/month</span>
        <div class="text-ter price-total__text">(this amount will be charged every month)</div>
    </div>
</div>
<div class="row margin-bottom">
    <div class="col-md-2"></div>
    <div class="col-md-4">
        <button class="btn btn-primary btn-lg" data-plan="to-cart">&nbsp; Pay Now &nbsp;</button>
    </div>
</div>