<div class="row emergency-contacts-information">
	<div class="col-md-12 mb-3">
		<h1 class="customer-info-heading"><i class='bx bx-fw bxs-contact'></i>Emergency Contacts Information</h1>
	</div>

	<div class="col-md-6 mb-3">
		<div class="form-group">
			<label>Contact Name 1</label>
			<input type="text" class="form-control" placeholder="First Name" name="contact_first_name1" id="contact_first_name1" value="" required />
			<input type="text" class="form-control mt-2" placeholder="Last Name" name="contact_last_name1" id="contact_last_name1" value=""  required />
		</div>
	</div>

	<div class="col-md-6 mb-3">
		<div class="form-group">
			<label>Relationship</label>
			<select class="form-control emergency-contacts-searchable-dropdown" name="contact_relationship1" required>
				<?php foreach($optionRelations as $relation){ ?>
					<option value="<?= $relation; ?>"><?= $relation; ?></option>
				<?php } ?>
			</select>
		</div>
	</div>

	<div class="col-md-6 mb-3">
		<div class="form-group">
			<label>Phone Number</label>
			<input type="text" class="form-control phone_number" maxlength="12" placeholder="xxx-xxx-xxxx" name="contact_phone1" id="contact_phone1" value="" required />
		</div>
	</div>

	<div class="col-md-12  mb-3"><hr /></div>

	<div class="col-md-6 mb-3">
		<div class="form-group">
			<label>Contact Name 2</label>
			<input type="text" class="form-control" placeholder="First Name" name="contact_first_name2" id="contact_first_name2" value=""/>
			<input type="text" class="form-control mt-2" placeholder="Last Name" name="contact_last_name2" id="contact_last_name2" value="" />
		</div>
	</div>

	<div class="col-md-6 mb-3">
		<div class="form-group">
			<label>Relationship</label>
			<select class="form-control emergency-contacts-searchable-dropdown" name="contact_relationship2">
				<?php foreach($optionRelations as $relation){ ?>
					<option value="<?= $relation; ?>"><?= $relation; ?></option>
				<?php } ?>
			</select>
		</div>
	</div>

	<div class="col-md-6 mb-3">
		<div class="form-group">
			<label>Phone Number</label>
			<input type="text" class="form-control phone_number" maxlength="12" placeholder="xxx-xxx-xxxx" name="contact_phone2" id="contact_phone2" value=""/>
		</div>
	</div>

	<div class="col-md-12  mb-3"><hr /></div>

	<div class="col-md-6 mb-3">
		<div class="form-group">
			<label>Contact Name 3</label>
			<input type="text" class="form-control" placeholder="First Name" name="contact_first_name3" id="contact_first_name3" value=""/>
			<input type="text" class="form-control mt-2" placeholder="Last Name" name="contact_last_name3" id="contact_last_name3" value="" />
		</div>
	</div>

	<div class="col-md-6 mb-3">
		<div class="form-group">
			<label>Relationship</label>
			<select class="form-control emergency-contacts-searchable-dropdown" name="contact_relationship3">
				<?php foreach($optionRelations as $relation){ ?>
					<option value="<?= $relation; ?>"><?= $relation; ?></option>
				<?php } ?>
			</select>
		</div>
	</div>

	<div class="col-md-6 mb-3">
		<div class="form-group">
			<label>Phone Number</label>
			<input type="text" class="form-control phone_number" maxlength="12" placeholder="xxx-xxx-xxxx" name="contact_phone3" id="contact_phone3" value=""/>
		</div>
	</div>

</div>
<script>
$(function(){
	$('.emergency-contacts-searchable-dropdown').select2({
        dropdownParent: $('.emergency-contacts-information')
    });
});
</script>