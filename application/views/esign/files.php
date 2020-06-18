<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('includes/header'); ?>
<!-- page wrapper start -->
<div class="wrapper">
	<br/>
	<div class="container-fluid">
		<?php echo form_open_multipart('esign/fileSave', [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
		<div class="card">
			<div class="form-group">
				<label for="docFile">Upload File</label>
				<input type="file" class="form-control" id="docFile" name="docFile" accept="application/pdf,application/vnd.ms-excel">
			</div>
			<div class="form-group">
				<button type="submit" id="click" class="btn btn-primary save-signature">Upload File</button>
			</div>
		</div>
		<?php echo form_close(); ?>
	</div>
</div><!-- page wrapper end -->

<?php include viewPath('includes/footer'); ?>