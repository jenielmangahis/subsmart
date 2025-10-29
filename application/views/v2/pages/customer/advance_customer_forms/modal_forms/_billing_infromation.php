<div class="row billing-information">
	<div class="col-md-12 mb-3">
		<h1 class="customer-info-heading"><i class='bx bx-fw bx-credit-card'></i>Billing Information</h1>
	</div>
	<div class="col-md-6 mb-3">
		<div class="form-group">
			<label>Card First Name</label>
			<input type="text" class="form-control" name="card_fname" id="card_fname" value="" />
		</div>
	</div>

	<div class="col-md-6 mb-3">
		<div class="form-group">
			<label>Card Last Name</label>
			<input type="text" class="form-control" name="card_lname" id="card_lname" value=""/>
		</div>
	</div>

	<div class="col-md-6 mb-3">
		<div class="form-group">
			<label>Card Number</label>
			<input type="text" class="form-control" name="card_number" id="card_number" value="" />
		</div>
	</div>

	<div class="col-md-4 mb-3">
		<div class="form-group">
			<label>Card Exp</label>
			<input id="card_exp" type="tel" class="form-control cc-exp cc-exp__example" placeholder="MM / YYYY" autocompletetype="cc-exp">
		</div>
	</div>

	<div class="col-md-2 mb-3">
		<div class="form-group">
			<label>CVC</label>
			<input id="card_cvc" type="text" maxlength=4 class="form-control" placeholder="1234">
		</div>
	</div>


	<div class="col-md-12 mb-3">
		<div class="form-group">
			<label>Card Address </label>
			<input data-type="billing_address" type="text" class="form-control" name="card_address" id="card_address" value=""/>
		</div>
	</div>

	<div class="col-md-4 mb-3">
		<div class="form-group">
			<label>City </label>
			<input data-type="billing_address_city" type="text" class="form-control" name="billing_city" id="billing_city" value="" />
		</div>
	</div>

	<div class="col-md-4 mb-3">
		<div class="form-group">
			<label>State </label>
			<input data-type="billing_address_state" type="text" class="form-control" name="billing_state" id="billing_state" value=""/>
		</div>
	</div>

	<div class="col-md-4 mb-3">
		<div class="form-group">
			<label>ZIP </label>
			<input data-type="billing_address_zip" type="text" class="form-control" name="billing_zip" id="billing_zip" value=""/>
		</div>
	</div>
	<div class="col-md-12 mb-3"><hr /></div>
	<div class="col-md-6 mb-3">
		<div class="form-group">
			<label>Equipment </label>
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text" id="basic-addon1">$</span>
				</div>
				<input type="number" step="0.01" class="form-control" name="equipment" value="" placeholder="0.00" />
			</div>
		</div>
	</div>

	<div class="col-md-6 mb-3">
		<div class="form-group">
			<label>Initial Deposit</label>
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text" id="basic-addon1">$</span>
				</div>
				<input type="number" step="0.01" class="form-control" name="initial_dep" value="" placeholder="0.00" />
			</div>
		</div>
	</div>

	<div class="col-md-6 mb-3">
		<div class="form-group">
			<label>Rate Plan </label>
			<select name="mmr" class="form-control" >
				<?php foreach($ratePlans as $rp){ ?>
					<option value="<?= $rp->amount; ?>"><?= $rp->amount; ?></option>
				<?php } ?>
			</select>
		</div>
	</div>

	<div class="col-md-6 mb-3">
		<div class="form-group">
			<label>Billing Frequency </label>
			<select name="bill_freq" class="form-control billing-searchable-dropdown">
				<option value="">- Select -</option>
				<option value="One Time Only">One Time Only</option>
				<option value="Every 1 Month">Every 1 Month</option>
				<option value="Every 3 Months">Every 3 Months</option>
				<option value="Every 6 Months">Every 6 Months</option>
				<option value="Every 1 Year">Every 1 Year</option>
			</select>
		</div>
	</div>

	<div class="col-md-6 mb-3">
		<div class="form-group">
			<label>Contract Term </label>
			<select name="contract_term" class="form-control billing-searchable-dropdown" >
				<option value="0">- Select -</option>
				<option value="1">1 month</option>
				<option value="6">6 months</option>
				<option value="12">12 months</option>
				<option value="18">18 months</option>
				<option value="24">24 months</option>
				<option value="36">36 months</option>
				<option value="42">42 months</option>
				<option value="48">48 months</option>
				<option value="60" selected="">60 months</option>
				<option value="72">72 months</option>
			</select>
		</div>
	</div>

	<div class="col-md-6 mb-3">
		<div class="form-group">
			<label>Billing Start Date </label>
			<input data-type="billing_start_date" type="date" class="form-control " name="bill_start_date" id="bill_start_date" value="<?= date("Y-m-d"); ?>" />
		</div>
	</div>

	<div class="col-md-6 mb-3">
		<div class="form-group">
			<label>Billing End Date </label>
			<input data-type="billing_end_date" type="date" class="form-control " name="bill_end_date" id="bill_end_date" value="<?= date("Y-m-d"); ?>"/>
		</div>
	</div>

	<div class="col-md-6 mb-3">
		<div class="form-group">
			<label>Billing Day of Month </label>
			<select id="bill_day" name="bill_day" class="form-control billing-searchable-dropdown">
				<option selected value="0">Select Day</option>
				<?php for ($days=0;$days<32;$days++){ ?>
					<option value="<?= days_of_month($days); ?>"><?= days_of_month($days) < 1 ? '' : days_of_month($days) ; ?></option>
				<?php } ?>
			</select>
		</div>
	</div>

	<div class="col-md-6 mb-3">
		<div class="form-group">
			<label>Late Fee </label>
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text" style="width:35px;" id="">$</span>
				</div>
				<input type="number" step="any" class="form-control" name="late_fee" value="" placeholder="0.00" >
			</div>
		</div>
	</div>

	<div class="col-md-6 mb-3">
		<div class="form-group">
			<label>Payment Fee </label>
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text" style="width:35px;" id="">%</span>
				</div>
				<input type="number" step="any" class="form-control" name="payment_fee" value="" placeholder="0.00">
			</div>
		</div>
	</div>
</div>

<script>
$(function(){
	$('.billing-searchable-dropdown').select2({
        dropdownParent: $('.billing-information')
    });

	$('#card_exp').payment('formatCardExpiry');
});
</script>