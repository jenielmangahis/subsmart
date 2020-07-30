<input type="hidden" name="inquiry_id" id="inquiry_id" value="<?php echo $inquiry_id; ?>">
<div class="form-group">
	<label>Status</label>
	<select name="status" id="status" class="form-control">
		<option <?php echo $inquiry->status == 1 ? 'selected="selected"' : ''; ?> value="1">New</option>
		<option <?php echo $inquiry->status == 2 ? 'selected="selected"' : ''; ?> value="2">Contacted</option>
		<option <?php echo $inquiry->status == 3 ? 'selected="selected"' : ''; ?> value="3">Follow Up</option>
		<option <?php echo $inquiry->status == 4 ? 'selected="selected"' : ''; ?> value="4">Assigned</option>
		<option <?php echo $inquiry->status == 5 ? 'selected="selected"' : ''; ?> value="5">Closed</option>
	</select>
</div>