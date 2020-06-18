<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('includes/header'); ?>
<!-- page wrapper start -->
<div class="wrapper">
	<br/>
	<div class="container-fluid">
		<?php echo form_open_multipart('esign/photoSave', [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
		<div class="card">
			<div class="form-group">
				<label for="docPhoto">Upload photo</label>
				<input  type="file" class="form-control" id="docPhoto" name="docPhoto" accept="image/gif, image/jpeg, image/png">
			</div>
			<div class="form-group">
				<button type="submit" id="click" class="btn btn-primary save-signature">Upload Photo</button>
			</div>
		</div>
		<?php echo form_close(); ?>
		<div class="card">
			
			<div class="row">
			<?php foreach ( $users as $key => $value ) { ?>
				<div class="col-md-2">
				
					<div class="shadow" style="background-color: white;">
						<img src="<?=url("");?>uploads/docPhoto/<?php echo $value->docphoto; ?>" height="170" width="180">
					</div>
				</div>
				<?php } ?>
			</div>
				
		</div>
	</div>

</div><!-- page wrapper end -->

<?php include viewPath('includes/footer'); ?>