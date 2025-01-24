<div class="row basic-information">	
	<div class="col-md-12 mb-3">
		<h1 class="customer-info-heading"><i class="bx bx-fw bx-user"></i>Customer Information</h1>
	</div>
	<div class="col-md-12 mb-3">
		<div class="form-group">
			<label>Customer Type</label>
			<select id="customer_type" name="customer_type" class="form-control">
				<option value="Residential">Residential</option>
				<option value="Commercial">Commercial</option>
			</select>
		</div>                            
	</div> 
	<div class="col-md-4 mb-3">
		<div class="form-group">
			<label>First Name</label>
			<input type="text" name="first_name" class="form-control" required>
		</div>
	</div>
	<div class="col-md-4 mb-3">
		<div class="form-group">
			<label>Last Name</label>
			<input type="text" name="last_name" class="form-control" required>
		</div>
	</div>
	<div class="col-md-4 mb-3">
		<div class="form-group">
			<label>Middle Name</label>
			<input type="text" name="middle_name" class="form-control" placeholder="" >
		</div>
	</div>                        
	<div class="col-md-4 mb-3">
		<div class="form-group">
			<label>Email</label>
			<input type="email" name="email" class="form-control" required>
		</div>
	</div>
	<div class="col-md-4 mb-3">
		<div class="form-group">
			<label>Social Security Number</label>
			<input type="text" name="ssn" class="form-control" required>
		</div>
	</div>
	<div class="col-md-4 mb-3">
		<div class="form-group">
			<label>Status</label>
			<select name="status" class="form-control searchable-dropdown">
				<?php foreach($customerStatus as $status){ ?>
					<option value="<?= $status->name; ?>"><?= $status->name; ?></option>
				<?php } ?>
			</select>
		</div>
	</div>
	<div class="col-md-12 mb-3 grp-customer-business" style="display:none;">
		<div class="form-group">
			<label>Business Name</label>
			<input type="text" name="business_name" class="form-control">
		</div>
	</div>
	<div class="col-md-6 mb-2">
		<div class="form-group">
			<label>Mobile</label>
			<input type="text" name="phone_m" class="form-control phone_number" maxlength="12" placeholder="xxx-xxx-xxxx" required>
		</div>
	</div>
	<div class="col-md-6 mb-2">
		<div class="form-group">
			<label>Phone</label>
			<input type="text" name="phone_h" class="form-control phone_number" maxlength="12" placeholder="xxx-xxx-xxxx" required>
		</div>
	</div>
	<div class="col-md-12 mb-2">
		<div class="form-group">
			<label>Address</label>
			<input type="text" name="mail_add" class="form-control" required>
		</div>
	</div>
	<div class="col-md-4 mb-2">
		<div class="form-group">
			<label>City</label>
			<input type="text" name="city" class="form-control" required>
		</div>
	</div>
	<div class="col-md-4 mb-2">
		<div class="form-group">
			<label>State</label>
			<input type="text" name="state" class="form-control" required>
		</div>
	</div>
	<div class="col-md-4 mb-4">
		<div class="form-group">
			<label>Zip Code</label>
			<input type="text" name="zip_code" class="form-control" required>
		</div>
	</div>
</div>
<script>
$(function(){
	$('#customer_type').on('change', function(){
        var type = $(this).val();
        if( type == 'Commercial' ){
            $('.grp-customer-business').show();
        }else{
            $('.grp-customer-business').hide();
        }
    });

	$('.phone_number').keydown(function(e) {
        var key = e.charCode || e.keyCode || 0;
        $text = $(this);
        if (key !== 8 && key !== 9) {
            if ($text.val().length === 3) {
                $text.val($text.val() + '-');
            }
            if ($text.val().length === 7) {
                $text.val($text.val() + '-');
            }
        }
        return (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));
    });

    $('.searchable-dropdown').select2({
        dropdownParent: $('.basic-information')
    });
});
</script>