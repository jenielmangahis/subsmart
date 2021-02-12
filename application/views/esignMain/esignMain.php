<?php
defined('BASEPATH') or exit('No direct script access allowed');?>

<?php include viewPath('includes/header');?>
<!-- page wrapper start -->
<div class="wrapper esign">
	<br/>
	<div class="container-fluid" style="font-size:14px;">
		<div class="row esign__inner">
			<div class="esign__header">
				<h1 class="esign__title">eSign Tools</h1>
				<div class="alert alert-warning mt-2" role="alert">
					<span style="color:black;">
					Sign and send documents for signing from your automated workflows on any device. Quickly configure
					templates & deploy legally-binding e-signatures for your documents, contracts, and web-forms. Draw or
					create your unique e-signature in a few clicks and sign documents online with your own ready-made
					templates.
					</span>
				</div>
			</div>

			<div class="col-md-2 esign__item" style="margin-top:12px;">
				<a href="<?php echo base_url('esign/Files') ?>">
					<div class="shadow" style="background-color: white;text-align:center;">
						<img src="<?=url("");?>uploads/image/esign/envelope_builder.png" style="margin:0 auto;" height="150" width="180" title="Scan">
						<button type="button" class="form-control btn btn-success">eSign Builder</button>
					</div>
				</a>
			</div>

			<div class="col-md-2 esign__item" style="margin-top:12px;">
				<a href="<?php echo base_url('esign/createTemplate') ?>">
					<div class="shadow" style="background-color: white;text-align:center;">
						<img src="<?=url("");?>uploads/image/esign/editor.png" style="margin:0 auto;" height="150" width="180" title="Scan">
						<button type="button" class="form-control btn btn-success">eSign Editor</button>
					</div>
				</a>
			</div>

			<!-- <div class="col-md-2 " style="margin-top:12px;">
				<a href="<?php echo base_url('esign/Photos') ?>">
					<div class="shadow" style="background-color: white;text-align:center;">
						<img style="margin:0 auto;" src="<?=url("");?>uploads/image/gallery.jpg" height="150" width="180" title="Photos">
						<button type="button" class="form-control btn btn-success">Photos</button>
					</div>
				</a>
			</div> -->
			<!-- <div class="col-md-2 " style="margin-top:12px;">
				<a href="<?php echo base_url('esign/Files') ?>">
					<div class="shadow" style="background-color: white;text-align:center;">
						<img style="margin:0 auto;" src="<?=url("");?>uploads/image/folder.png" height="150" width="180" title="Files">
						<button type="button" class="form-control btn btn-success">Files</button>
					</div>
				</a>
			</div> -->
			<div class="col-md-2 esign__item" style="margin-top:12px;">
				<a href="<?php echo base_url('vault/mylibrary') ?>">
					<div class="shadow" style="background-color: white;text-align:center;">
						<img style="margin:0 auto;" src="<?=url("");?>uploads/image/esign/templates.png" height="150" width="180" title="Template">
						<button type="button" class="form-control btn btn-success">Templates</button>
					</div>
				</a>
			</div>
			<div class="col-md-2 esign__item" style="margin-top:12px;">
				<a href="<?php echo base_url('esign/templateLibrary') ?>">
					<div class="shadow" style="background-color: white;text-align:center;">
						<img style="margin:0 auto;" src="<?=url("");?>uploads/image/esign/library.png" height="150" width="180" title="Library">
						<button type="button" class="form-control btn btn-success">Library</button>
					</div>
				</a>
			</div>
			<div class="col-md-2 esign__item" style="margin-top:12px;">
				<div class="shadow" style="background-color: white;text-align:center;">
					<img style="margin:0 auto;" src="<?=url("");?>uploads/image/esign/dropbox.png" height="150" width="180" title="Dropbox">
					<button type="button" class="form-control btn btn-success">Dropbox</button>
				</div>
			</div>

			<div class="col-md-2 esign__item" style="margin-top:12px;">
				<div class="shadow" style="background-color: white;text-align:center;">
					<img style="margin:0 auto;" src="<?=url("");?>uploads/image/esign/google_drive.png" height="150" width="180" title="Box">
					<button type="button" class="form-control btn btn-success">Google Drive</button>
				</div>
			</div>

			<div class="col-md-2 esign__item" style="margin-top:12px;">
				<div class="shadow" style="background-color: white;text-align:center;">
					<img style="margin:0 auto;" src="<?=url("");?>uploads/image/esign/box.png" height="150" width="180" title="Box">
					<button type="button" class="form-control btn btn-success">Box</button>
				</div>
			</div>

			<div class="col-md-2 esign__item" style="margin-top:12px;">
				<a href="<?php echo base_url('esign') ?>">
					<div class="shadow" style="background-color: white;text-align:center;">
						<img style="margin:0 auto;" src="<?=url("");?>uploads/image/esign/fill_and_esign.png" height="150" width="180" title="Sign">
						<button type="button" class="form-control btn btn-success">Fill & eSign</button>
					</div>
				</a>
			</div>

			<div class="col-md-2 esign__item" style="margin-top:12px;">
				<a href="#">
					<div class="shadow" style="background-color: white;text-align:center;">
						<img style="margin:0 auto;" src="<?=url("");?>uploads/image/esign/esign.png" height="150" width="180" title="Sign">
						<button type="button" class="form-control btn btn-success">eSign</button>
					</div>
				</a>
			</div>
		</div>
		<br/>
		<div class="row">


		</div>
	</div>
</div><!-- page wrapper end -->

<?php include viewPath('includes/footer');?>
